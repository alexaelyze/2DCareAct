<?php
session_start();
include "db.php";

/* ADMIN ONLY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

/* CLEAR LOGS */
if (isset($_POST['clear_logs'])) {
    mysqli_query($conn, "DELETE FROM activity_logs");
    mysqli_query($conn, "ALTER TABLE activity_logs AUTO_INCREMENT = 1");
    header("Location: activity_logs.php");
    exit();
}

/* FILTER PARAMS */
$search      = trim($_GET['search']   ?? '');
$filterRole  = $_GET['role']          ?? 'all';
$filterPage  = $_GET['page_filter']   ?? 'all';
$sortBy      = $_GET['sort']          ?? 'date_desc';
$dateFrom    = $_GET['date_from']     ?? '';
$dateTo      = $_GET['date_to']       ?? '';

/* BUILD WHERE */
$where = [];

if (!empty($search)) {
    $safe = mysqli_real_escape_string($conn, $search);
    $where[] = "(u.first_name LIKE '%$safe%' OR u.last_name LIKE '%$safe%' OR a.action LIKE '%$safe%')";
}

if ($filterRole !== 'all') {
    $safe_role = mysqli_real_escape_string($conn, $filterRole);
    $where[] = "(a.role = '$safe_role' OR u.role = '$safe_role')";
}

if ($filterPage !== 'all') {
    $safe_page = mysqli_real_escape_string($conn, $filterPage);
    $where[] = "a.page = '$safe_page'";
}

if (!empty($dateFrom)) {
    $safe_from = mysqli_real_escape_string($conn, $dateFrom);
    $where[] = "DATE(a.created_at) >= '$safe_from'";
}

if (!empty($dateTo)) {
    $safe_to = mysqli_real_escape_string($conn, $dateTo);
    $where[] = "DATE(a.created_at) <= '$safe_to'";
}

$whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

/* SORT */
$orderClause = "a.created_at DESC";
switch ($sortBy) {
    case 'date_asc':  $orderClause = "a.created_at ASC";  break;
    case 'name_asc':  $orderClause = "u.first_name ASC, u.last_name ASC"; break;
    case 'name_desc': $orderClause = "u.first_name DESC, u.last_name DESC"; break;
    case 'role_asc':  $orderClause = "a.role ASC"; break;
    case 'page_asc':  $orderClause = "a.page ASC"; break;
}

/* MAIN QUERY */
$sql = "
SELECT a.*, u.first_name, u.last_name, u.role AS urole
FROM activity_logs a
LEFT JOIN users u ON a.user_id = u.id
$whereClause
ORDER BY $orderClause
LIMIT 300
";
$result = mysqli_query($conn, $sql);

$logs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
}

/* GET DISTINCT PAGES FOR FILTER DROPDOWN */
$pagesRes = mysqli_query($conn, "SELECT DISTINCT page FROM activity_logs WHERE page IS NOT NULL AND page != '' ORDER BY page ASC");
$pages = [];
while ($p = mysqli_fetch_assoc($pagesRes)) {
    $pages[] = $p['page'];
}

$totalLogs = count($logs);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Activity Logs</title>
<style>
:root { --primary: #536dfe; --light: #eef2ff; }
* { box-sizing: border-box; }
body { margin: 0; font-family: "Segoe UI", sans-serif; background: #4f6cf5; }

header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  justify-content: space-between; align-items: center;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; margin: 0 20px; text-decoration: none; font-weight: 500; }
nav a:hover { text-decoration: underline; }
.logout { background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; margin-left: 20px; font-weight: bold; }
.logout:hover { background: #e0e7ff; }

.wrapper {
  display: flex; justify-content: center;
  gap: 30px; margin-top: 60px; padding-bottom: 60px;
}

.admin-box {
  width: 180px; height: 180px; background: white;
  border-radius: 16px; display: flex;
  align-items: center; justify-content: center;
  flex-shrink: 0;
}
.admin-box img { width: 80%; }

.container {
  width: 800px; background: white;
  padding: 30px; border-radius: 16px;
}

.title {
  text-align: center;
  background: var(--primary); color: white;
  padding: 15px; border-radius: 10px;
  font-size: 20px; margin-bottom: 20px;
}

/* STATS */
.stats-bar {
  display: flex; gap: 12px;
  margin-bottom: 16px; flex-wrap: wrap;
}
.stat-badge {
  padding: 7px 18px; border-radius: 50px;
  font-weight: bold; font-size: 13px; color: white;
}
.stat-total { background: var(--primary); }
.stat-quiz  { background: #43a047; }
.stat-sim   { background: #fb8c00; }
.stat-other { background: #9e9e9e; }

/* CONTROLS */
.controls {
  display: flex; gap: 10px;
  margin-bottom: 16px; flex-wrap: wrap;
  align-items: center;
}

.controls input[type="text"],
.controls input[type="date"] {
  flex: 1; min-width: 140px;
  padding: 9px 14px; border-radius: 50px;
  border: 2px solid var(--primary);
  font-size: 13px; outline: none;
}

.controls select {
  padding: 9px 14px; border-radius: 50px;
  border: 2px solid var(--primary);
  font-size: 13px; background: white;
  color: #333; cursor: pointer; outline: none;
}

.btn-filter {
  background: var(--primary); color: white;
  border: none; padding: 9px 20px;
  border-radius: 50px; font-size: 13px;
  font-weight: bold; cursor: pointer;
}
.btn-filter:hover { background: #3d57e8; }

.btn-reset {
  background: white; color: var(--primary);
  border: 2px solid var(--primary);
  padding: 9px 20px; border-radius: 50px;
  font-size: 13px; font-weight: bold;
  cursor: pointer; text-decoration: none;
  display: inline-block;
}
.btn-reset:hover { background: #eef2ff; }

/* LIST */
.list { max-height: 450px; overflow-y: auto; }

/* EMPTY */
.empty-msg {
  text-align: center; color: #888;
  padding: 30px; font-size: 15px; font-weight: bold;
}

/* LOG ITEM */
.log {
  background: var(--light); padding: 14px 18px;
  border-radius: 15px; margin-bottom: 12px;
  font-size: 14px; line-height: 1.6;
}

.log-header {
  display: flex; justify-content: space-between;
  align-items: flex-start; margin-bottom: 4px;
}

.log-name { font-weight: bold; font-size: 15px; }

.role-badge {
  padding: 3px 12px; border-radius: 50px;
  font-size: 11px; font-weight: bold; color: white;
  flex-shrink: 0;
}
.role-user       { background: #43a047; }
.role-instructor { background: #fb8c00; }
.role-admin      { background: #8e24aa; }

.log-action { color: #333; margin-bottom: 4px; }

.log-meta { color: #777; font-size: 12px; }
.log-meta span { margin-right: 12px; }

/* SCROLLBAR */
.list::-webkit-scrollbar { width: 10px; }
.list::-webkit-scrollbar-track { background: #dbeafe; border-radius: 10px; }
.list::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }

/* BOTTOM ACTIONS */
.bottom-actions {
  display: flex; justify-content: space-between;
  align-items: center; margin-top: 16px;
}

.clear-btn {
  background: #ef4444; color: white;
  border: none; padding: 10px 20px;
  border-radius: 8px; font-weight: bold;
  cursor: pointer;
}
.clear-btn:hover { background: #dc2626; }

.log-count { color: #888; font-size: 13px; }

footer {
  background: #4f6cf5;
  color: white;
  text-align: center;
  padding: 15px 20px;
  margin-top: auto;
}
footer h3 { margin: 0; font-size: 18px; }
footer p  { margin: 5px 0; font-size: 14px; text-align: center; }
@media (max-width: 600px) {
  footer { padding: 12px; }
  footer h3 { font-size: 16px; }
  footer p  { font-size: 12px; }
}
</style>
</head>
<body>

<header>
  <div class="logo">CareAct</div>
  <nav>
    <a href="admin_home.php">Home</a>
    <a href="admin_users.php">Users</a>
    <a href="activity_logs.php">Activity Log</a>
    <a href="logout.php" class="logout">Logout</a>
  </nav>
</header>

<div class="wrapper">

  <div class="admin-box">
    <img src="blankuser.png" alt="Admin Icon">
  </div>

  <div class="container">

    <div class="title"><b>Activity Logs</b></div>

    <!-- STATS -->
    <?php
      $quizCount = count(array_filter($logs, fn($l) => str_contains(strtolower($l['page'] ?? ''), 'quiz')));
      $simCount  = count(array_filter($logs, fn($l) => str_contains(strtolower($l['page'] ?? ''), 'sim')));
      $otherCount = $totalLogs - $quizCount - $simCount;
    ?>
    <div class="stats-bar">
      <span class="stat-badge stat-total">Total: <?php echo $totalLogs; ?></span>
      <span class="stat-badge stat-quiz">Quiz Activity: <?php echo $quizCount; ?></span>
      <span class="stat-badge stat-sim">Simulation Activity: <?php echo $simCount; ?></span>
      <span class="stat-badge stat-other">Other: <?php echo $otherCount; ?></span>
    </div>

    <!-- FILTER CONTROLS -->
    <form method="GET" action="activity_logs.php">
      <div class="controls">

        <!-- SEARCH -->
        <input type="text" name="search"
               placeholder="🔍 Search name or action..."
               value="<?php echo htmlspecialchars($search); ?>">

        <!-- FILTER BY ROLE -->
        <select name="role">
          <option value="all"        <?php echo $filterRole === 'all'        ? 'selected' : ''; ?>>All Roles</option>
          <option value="user"       <?php echo $filterRole === 'user'       ? 'selected' : ''; ?>>User</option>
          <option value="instructor" <?php echo $filterRole === 'instructor' ? 'selected' : ''; ?>>Instructor</option>
          <option value="admin"      <?php echo $filterRole === 'admin'      ? 'selected' : ''; ?>>Admin</option>
        </select>

        <!-- FILTER BY PAGE -->
        <select name="page_filter">
          <option value="all">All Pages</option>
          <?php foreach ($pages as $pg): 
          $pgLabel = $pg;
          if ($pg === 'home.php') $pgLabel = 'Home';
            ?>
        <option value="<?php echo htmlspecialchars($pg); ?>"
        <?php echo $filterPage === $pg ? 'selected' : ''; ?>>
        <?php echo htmlspecialchars($pgLabel); ?>
        </option>
            <?php endforeach; ?>
        </select>

        <!-- SORT -->
        <select name="sort">
          <option value="date_desc" <?php echo $sortBy === 'date_desc' ? 'selected' : ''; ?>>Date (Newest)</option>
          <option value="date_asc"  <?php echo $sortBy === 'date_asc'  ? 'selected' : ''; ?>>Date (Oldest)</option>
          <option value="name_asc"  <?php echo $sortBy === 'name_asc'  ? 'selected' : ''; ?>>Name A–Z</option>
          <option value="name_desc" <?php echo $sortBy === 'name_desc' ? 'selected' : ''; ?>>Name Z–A</option>
          <option value="role_asc"  <?php echo $sortBy === 'role_asc'  ? 'selected' : ''; ?>>Role A–Z</option>
          <option value="page_asc"  <?php echo $sortBy === 'page_asc'  ? 'selected' : ''; ?>>Page A–Z</option>
        </select>

      </div>

      <div class="controls">
        <!-- DATE RANGE -->
        <label style="font-size:13px;font-weight:bold;color:#555;">From:</label>
        <input type="date" name="date_from"
               value="<?php echo htmlspecialchars($dateFrom); ?>">
        <label style="font-size:13px;font-weight:bold;color:#555;">To:</label>
        <input type="date" name="date_to"
               value="<?php echo htmlspecialchars($dateTo); ?>">

        <button type="submit" class="btn-filter">Apply</button>
        <a href="activity_logs.php" class="btn-reset">Reset</a>
      </div>
    </form>

    <!-- LOG LIST -->
    <div class="list">

      <?php if (empty($logs)): ?>
        <div class="empty-msg">No activity logs found matching your filters.</div>

      <?php else: ?>
        <?php foreach ($logs as $log):
          $logRole   = !empty($log['role']) ? $log['role'] : ($log['urole'] ?? 'user');
$roleClass = 'role-user';
if ($logRole === 'instructor') $roleClass = 'role-instructor';
if ($logRole === 'admin')      $roleClass = 'role-admin';
          $firstName = trim($log['first_name'] ?? '');
$lastName  = trim($log['last_name']  ?? '');
$name = htmlspecialchars(!empty($firstName) ? "$firstName $lastName" : "Unknown User");
          $formattedDate = date('M d, Y g:i A', strtotime($log['created_at']));
        ?>
        <div class="log">
          <div class="log-header">
            <span class="log-name"><?php echo $name; ?></span>
            <span class="role-badge <?php echo $roleClass; ?>"><?php echo ucfirst($logRole); ?></span>
          </div>
          <div class="log-action"><?php echo htmlspecialchars($log['action']); ?></div>
          <div class="log-meta">
            <span>📄 <?php echo htmlspecialchars($log['page'] ?? ''); ?></span>
            <span>🕐 <?php echo $formattedDate; ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>

    <!-- BOTTOM ACTIONS -->
    <div class="bottom-actions">
      <span class="log-count">Showing <?php echo $totalLogs; ?> log(s)</span>
      <form method="POST"
            onsubmit="return confirm('Are you sure you want to clear all logs?');">
        <button type="submit" name="clear_logs" class="clear-btn">
          Clear All Logs
        </button>
      </form>
    </div>

  </div>
</div>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>