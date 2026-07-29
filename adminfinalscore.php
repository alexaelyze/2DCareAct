<?php
session_start();
include "db.php";

/* FETCH QUIZ LABELS */
$quizLabels = [];
$qRes = mysqli_query($conn, "SELECT quiz_id, quiz_label FROM quiz_settings");
while ($row = mysqli_fetch_assoc($qRes)) {
    $quizLabels[$row['quiz_id']] = $row['quiz_label'];
}

/* FETCH SIMULATION TITLES */
$simTitles = [];
$sRes = mysqli_query($conn, "SELECT sim_id, sim_title FROM simulation_settings");
while ($row = mysqli_fetch_assoc($sRes)) {
    $simTitles[$row['sim_id']] = $row['sim_title'];
}

$module = $_GET['module'] ?? 'vitals';
$type   = $_GET['type']   ?? 'quiz';

/* ADMIN ONLY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header("Location: instructor_home.php");
    exit();
}

/* SORTING & FILTERING PARAMS */
$sortBy     = $_GET['sort']   ?? 'name_asc';   // name_asc, name_desc, status_asc, status_desc, date_asc, date_desc
$filterStatus = $_GET['status'] ?? 'all';       // all, Competent, Incompetent, Not Taken
$search     = trim($_GET['search'] ?? '');

/* BUILD QUERY based on type */
if ($type === 'quiz') {
    $scoreTable  = 'quiz_scores';
    $nameColumn  = 'quiz_name';
    $dateColumn  = 'updated_at';
} else {
    $scoreTable  = 'simulation_scores';
    $nameColumn  = 'simulation_name';
    $dateColumn  = 'created_at';
}

/* SORT SQL */
$orderClause = "u.first_name ASC, u.last_name ASC"; // default
switch ($sortBy) {
    case 'name_desc': $orderClause = "u.first_name DESC, u.last_name DESC"; break;
    case 'status_asc':  $orderClause = "COALESCE(s.status, 'Not Taken') ASC";  break;
    case 'status_desc': $orderClause = "COALESCE(s.status, 'Not Taken') DESC"; break;
    case 'date_asc':    $orderClause = "s.$dateColumn ASC";  break;
    case 'date_desc':   $orderClause = "s.$dateColumn DESC"; break;
}

/* FILTER SQL */
$filterClause = "";
if ($filterStatus !== 'all') {
    if ($filterStatus === 'Not Taken') {
        $filterClause = "AND (s.status IS NULL OR s.status = '')";
    } else {
        $safe_status  = mysqli_real_escape_string($conn, $filterStatus);
        $filterClause = "AND s.status = '$safe_status'";
    }
}

/* SEARCH SQL */
$searchClause = "";
if (!empty($search)) {
    $safe_search  = mysqli_real_escape_string($conn, $search);
    $searchClause = "AND (u.first_name LIKE '%$safe_search%' OR u.last_name LIKE '%$safe_search%')";
}

/* SAFE MODULE */
$safe_module = mysqli_real_escape_string($conn, $module);

/* MAIN QUERY — LEFT JOIN so users with no score still appear */
$sql = "
SELECT
    u.id,
    u.first_name,
    u.last_name,
    COALESCE(s.status, 'Not Taken') AS status,
    s.$dateColumn AS score_date
FROM users u
LEFT JOIN $scoreTable s
    ON s.user_id = u.id
    AND s.$nameColumn = '$safe_module'
    AND s.$dateColumn = (
        SELECT MAX(sub.$dateColumn)
        FROM $scoreTable sub
        WHERE sub.user_id = u.id
        AND sub.$nameColumn = '$safe_module'
    )
WHERE u.role != 'instructor'
AND u.role != 'admin'
$searchClause
$filterClause
ORDER BY $orderClause
";

$result = mysqli_query($conn, $sql);
$users  = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

/* LABEL */
if ($type === "quiz") {
    $label = $quizLabels[$module] ?? $module;
} else {
    $label = $simTitles[$module] ?? $module;
}
$label = str_ireplace(["quiz", "simulation"], "", $label);
$label = trim($label);
$displayModule = strtoupper($label);

/* COUNTS */
$total      = count($users);
$competent  = count(array_filter($users, fn($u) => $u['status'] === 'Competent'));
$incompetent = count(array_filter($users, fn($u) => $u['status'] === 'Incompetent'));
$notTaken   = count(array_filter($users, fn($u) => $u['status'] === 'Not Taken'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - User Scores</title>
<style>
:root { --primary: #536dfe; }
* { box-sizing: border-box; font-family: "Segoe UI", sans-serif; margin: 0; padding: 0; }
body { margin: 0; background: #4f6cf5; }

header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  align-items: center; justify-content: space-between;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 20px; font-size: 18px; font-weight: 500; }
nav a:hover { text-decoration: underline; }
.logout { background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; font-weight: bold; }
.logout:hover { background: #e0e7ff; }

.wrapper { display: flex; gap: 30px; padding: 40px; }

.profile-box {
  width: 200px; height: 200px;
  background: white; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.profile-box img { width: 100%; height: 100%; object-fit: cover; border-radius: 10px; }

.container { flex: 1; background: white; padding: 30px; border-radius: 25px; }

.title {
  text-align: center;
  background: var(--primary); color: white;
  padding: 15px; border-radius: 25px;
  font-size: 22px; font-weight: bold;
  margin-bottom: 20px;
}

/* STATS BAR */
.stats-bar {
  display: flex; gap: 16px;
  margin-bottom: 20px; flex-wrap: wrap;
}
.stat-badge {
  padding: 8px 20px; border-radius: 50px;
  font-weight: bold; font-size: 14px; color: white;
}
.stat-total      { background: var(--primary); }
.stat-competent  { background: #43a047; }
.stat-incompetent{ background: #e53935; }
.stat-nottaken   { background: #9e9e9e; }

/* CONTROLS */
.controls {
  display: flex; gap: 12px;
  margin-bottom: 20px; flex-wrap: wrap;
  align-items: center;
}

.controls input[type="text"] {
  flex: 1; min-width: 180px;
  padding: 10px 16px; border-radius: 50px;
  border: 2px solid var(--primary);
  font-size: 14px; outline: none;
}

.controls select {
  padding: 10px 16px; border-radius: 50px;
  border: 2px solid var(--primary);
  font-size: 14px; background: white;
  color: #333; cursor: pointer; outline: none;
}

.btn-filter {
  background: var(--primary); color: white;
  border: none; padding: 10px 24px;
  border-radius: 50px; font-size: 14px;
  font-weight: bold; cursor: pointer;
}
.btn-filter:hover { background: #3d57e8; }

.btn-reset {
  background: white; color: var(--primary);
  border: 2px solid var(--primary);
  padding: 10px 24px; border-radius: 50px;
  font-size: 14px; font-weight: bold;
  cursor: pointer; text-decoration: none;
  display: inline-block;
}
.btn-reset:hover { background: #eef2ff; }

/* LIST */
.list {
  background: linear-gradient(to right, #5f6df5, #4b5fe0);
  padding: 20px; border-radius: 25px;
  max-height: 420px; overflow-y: auto;
}

/* USER ROW */
.user {
  background: white; padding: 16px 20px;
  border-radius: 30px; margin-bottom: 12px;
  display: flex; justify-content: space-between;
  align-items: center; font-weight: bold; font-size: 16px;
}

.user:last-child { margin-bottom: 0; }

.user-info { display: flex; flex-direction: column; gap: 2px; }
.user-date { font-size: 12px; color: #999; font-weight: normal; margin-top: 2px; }

.good { color: #43a047; }
.bad  { color: #e53935; }
.not  { color: #9e9e9e; }

.empty-msg {
  color: white; text-align: center;
  padding: 30px; font-size: 16px; font-weight: bold;
}
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
    <?php if ($_SESSION['role'] === 'user'): ?>
      <a href="home.php">Home</a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] === 'instructor'): ?>
      <a href="instructor_home.php">Home</a>
      <a href="admin_user_scores.php">User Scores</a>
    <?php endif; ?>
    <a href="modules.php">Modules</a>
    <a href="quizandlab.php">Quiz and Lab Assessments</a>
    <a href="scores.php">Overall Scores</a>
    <a href="logout.php" class="logout">Logout</a>
  </nav>
</header>

<div class="wrapper">

  <!-- LEFT ICON -->
  <div class="profile-box">
    <img src="blankuser.png" alt="Admin Icon">
  </div>

  <!-- MAIN CONTENT -->
  <div class="container">

    <div class="title">
      <?php echo $displayModule . " " . strtoupper($type) . " SCORES"; ?>
    </div>

    <!-- STATS -->
    <div class="stats-bar">
      <span class="stat-badge stat-total">Total: <?php echo $total; ?></span>
      <span class="stat-badge stat-competent">Competent: <?php echo $competent; ?></span>
      <span class="stat-badge stat-incompetent">Incompetent: <?php echo $incompetent; ?></span>
      <span class="stat-badge stat-nottaken">Not Taken: <?php echo $notTaken; ?></span>
    </div>

    <!-- FILTER & SORT CONTROLS -->
    <form method="GET" action="adminfinalscore.php">
      <input type="hidden" name="module" value="<?php echo htmlspecialchars($module); ?>">
      <input type="hidden" name="type"   value="<?php echo htmlspecialchars($type); ?>">

      <div class="controls">

        <!-- SEARCH -->
        <input type="text" name="search"
               placeholder="🔍 Search by name..."
               value="<?php echo htmlspecialchars($search); ?>">

        <!-- SORT -->
        <select name="sort">
          <option value="name_asc"    <?php echo $sortBy === 'name_asc'    ? 'selected' : ''; ?>>Name A–Z</option>
          <option value="name_desc"   <?php echo $sortBy === 'name_desc'   ? 'selected' : ''; ?>>Name Z–A</option>
          <option value="status_asc"  <?php echo $sortBy === 'status_asc'  ? 'selected' : ''; ?>>Status A–Z</option>
          <option value="status_desc" <?php echo $sortBy === 'status_desc' ? 'selected' : ''; ?>>Status Z–A</option>
          <option value="date_desc"   <?php echo $sortBy === 'date_desc'   ? 'selected' : ''; ?>>Date (Newest)</option>
          <option value="date_asc"    <?php echo $sortBy === 'date_asc'    ? 'selected' : ''; ?>>Date (Oldest)</option>
        </select>

        <!-- FILTER BY STATUS -->
        <select name="status">
          <option value="all"         <?php echo $filterStatus === 'all'         ? 'selected' : ''; ?>>All Status</option>
          <option value="Competent"   <?php echo $filterStatus === 'Competent'   ? 'selected' : ''; ?>>Competent</option>
          <option value="Incompetent" <?php echo $filterStatus === 'Incompetent' ? 'selected' : ''; ?>>Incompetent</option>
          <option value="Not Taken"   <?php echo $filterStatus === 'Not Taken'   ? 'selected' : ''; ?>>Not Taken</option>
        </select>

        <button type="submit" class="btn-filter">Apply</button>
        <a href="adminfinalscore.php?module=<?php echo urlencode($module); ?>&type=<?php echo urlencode($type); ?>"
           class="btn-reset">Reset</a>

      </div>
    </form>

    <!-- USER LIST -->
    <div class="list">

      <?php if (empty($users)): ?>
        <div class="empty-msg">No users found matching your filters.</div>
      <?php else: ?>

        <?php foreach ($users as $u):
          $status = $u['status'];
          $class  = 'not';
          if ($status === 'Competent')   $class = 'good';
          if ($status === 'Incompetent') $class = 'bad';

          // Format date
          $dateDisplay = '';
          if (!empty($u['score_date']) && $u['score_date'] !== '0000-00-00 00:00:00') {
            $dateDisplay = date('M d, Y g:i A', strtotime($u['score_date']));
          }
        ?>
        <div class="user">
          <div class="user-info">
            <span><?php echo htmlspecialchars($u['first_name'] . ' ' . $u['last_name']); ?></span>
            <?php if ($dateDisplay): ?>
              <span class="user-date">📅 <?php echo $dateDisplay; ?></span>
            <?php endif; ?>
          </div>
          <span class="<?php echo $class; ?>"><?php echo $status; ?></span>
        </div>
        <?php endforeach; ?>

      <?php endif; ?>

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