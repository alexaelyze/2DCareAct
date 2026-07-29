<?php
session_start();
include "db.php";

/* ADMIN ONLY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

/* FILTER PARAMS */
$search     = trim($_GET['search'] ?? '');
$filterRole = $_GET['role'] ?? 'all';
$sortBy     = $_GET['sort'] ?? 'name_asc';

/* BUILD QUERY */
$where = [];

if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($conn, $search);
    $where[] = "(first_name LIKE '%$safe_search%' OR last_name LIKE '%$safe_search%')";
}

if ($filterRole !== 'all') {
    $safe_role = mysqli_real_escape_string($conn, $filterRole);
    $where[] = "role = '$safe_role'";
}

$whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

/* SORT */
$orderClause = "first_name ASC, last_name ASC";
switch ($sortBy) {
    case 'name_desc': $orderClause = "first_name DESC, last_name DESC"; break;
    case 'role_asc':  $orderClause = "role ASC, first_name ASC"; break;
    case 'role_desc': $orderClause = "role DESC, first_name ASC"; break;
}

$sql    = "SELECT id, first_name, last_name, role FROM users $whereClause ORDER BY $orderClause";
$result = mysqli_query($conn, $sql);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

$total_users = count($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Users</title>
<style>
:root {
  --primary: #536dfe;
  --secondary: #4f6cf5;
  --light: #eef2ff;
}

body { margin: 0; font-family: "Segoe UI", sans-serif; background: #4f6cf5; }

/* HEADER */
header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  align-items: center; justify-content: space-between;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 20px; font-size: 18px; font-weight: 500; }
nav a:hover { text-decoration: underline; }
.logout { background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; margin-left: 20px; font-weight: bold; }
.logout:hover { background: #e0e7ff; }

/* WRAPPER */
.wrapper {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-top: 60px;
  padding-bottom: 60px;
}

/* LEFT BOX */
.admin-box {
  width: 180px; height: 180px;
  background: white; border-radius: 16px;
  display: flex; align-items: center;
  justify-content: center;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  flex-shrink: 0;
}
.admin-box img { width: 80%; height: 80%; object-fit: contain; }

/* MAIN */
.container {
  width: 700px; background: white;
  padding: 30px; border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* TITLE */
.title {
  text-align: center;
  background: var(--primary); color: white;
  padding: 15px; border-radius: 10px;
  font-size: 20px; font-weight: bold;
  margin-bottom: 20px;
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
.stat-total      { background: var(--primary); }
.stat-user       { background: #43a047; }
.stat-instructor { background: #fb8c00; }
.stat-admin      { background: #8e24aa; }

/* CONTROLS */
.controls {
  display: flex; gap: 10px;
  margin-bottom: 18px; flex-wrap: wrap;
  align-items: center;
}

.controls input[type="text"] {
  flex: 1; min-width: 160px;
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
  border: none; padding: 10px 22px;
  border-radius: 50px; font-size: 14px;
  font-weight: bold; cursor: pointer;
}
.btn-filter:hover { background: #3d57e8; }

.btn-reset {
  background: white; color: var(--primary);
  border: 2px solid var(--primary);
  padding: 10px 22px; border-radius: 50px;
  font-size: 14px; font-weight: bold;
  cursor: pointer; text-decoration: none;
  display: inline-block;
}
.btn-reset:hover { background: #eef2ff; }

/* LIST */
.list {
  max-height: 400px;
  overflow-y: auto;
  padding-right: 10px;
}

/* EMPTY MESSAGE */
.empty-msg {
  text-align: center; color: #888;
  padding: 30px; font-size: 16px;
  font-weight: bold;
}

/* USER ROW */
.user {
  background: var(--light);
  padding: 15px 20px; border-radius: 30px;
  margin-bottom: 15px; display: flex;
  justify-content: space-between;
  align-items: center; font-size: 18px;
  font-weight: 600; position: relative;
}

/* ROLE BADGE */
.role-badge {
  display: inline-block;
  padding: 3px 12px; border-radius: 50px;
  font-size: 12px; font-weight: bold;
  color: white; margin-top: 4px;
}
.role-user       { background: #43a047; }
.role-instructor { background: #fb8c00; }
.role-admin      { background: #8e24aa; }

/* ACTIONS */
.actions { display: flex; align-items: center; gap: 10px; }

.role-btn {
  background: #22c55e; color: white;
  border: none; padding: 8px 10px;
  border-radius: 50%; cursor: pointer;
  font-size: 16px;
}
.role-btn:hover { background: #16a34a; }

.delete-btn {
  background: #ef4444; color: white;
  border: none; padding: 8px 12px;
  border-radius: 50%; cursor: pointer;
  font-size: 16px; font-weight: bold;
}
.delete-btn:hover { background: #dc2626; }

/* ROLE DROPDOWN */
.role-dropdown {
  display: none;
  position: absolute; right: 60px; top: 60px;
  background: white; padding: 12px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  z-index: 10;
}
.user.active .role-dropdown { display: block; }
.role-dropdown select {
  padding: 8px; border-radius: 6px;
  border: 1px solid #ccc; margin-right: 8px;
}
.role-dropdown button {
  background: var(--primary); color: white;
  border: none; padding: 8px 16px;
  border-radius: 6px; cursor: pointer;
  font-weight: bold;
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


/* SCROLLBAR */
.list::-webkit-scrollbar { width: 10px; }
.list::-webkit-scrollbar-track { background: #dbeafe; border-radius: 10px; }
.list::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
</style>

<script>
function toggleRole(id) {
    document.getElementById("user-" + id).classList.toggle("active");
}

</script>
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

    <div class="title">List of Users</div>

    <!-- STATS -->
    <?php
      $totalAll      = count(array_filter($users, fn($u) => true));
      $totalUsers    = count(array_filter($users, fn($u) => $u['role'] === 'user'));
      $totalInst     = count(array_filter($users, fn($u) => $u['role'] === 'instructor'));
      $totalAdmins   = count(array_filter($users, fn($u) => $u['role'] === 'admin'));
    ?>
    <div class="stats-bar">
      <span class="stat-badge stat-total">Total: <?php echo $total_users; ?></span>
      <span class="stat-badge stat-user">Users: <?php echo $totalUsers; ?></span>
      <span class="stat-badge stat-instructor">Instructors: <?php echo $totalInst; ?></span>
      <span class="stat-badge stat-admin">Admins: <?php echo $totalAdmins; ?></span>
    </div>

    <!-- FILTER CONTROLS -->
    <form method="GET" action="admin_users.php">
      <div class="controls">

        <input type="text" name="search"
               placeholder="🔍 Search by name..."
               value="<?php echo htmlspecialchars($search); ?>">

        <select name="role">
          <option value="all"        <?php echo $filterRole === 'all'        ? 'selected' : ''; ?>>All Roles</option>
          <option value="user"       <?php echo $filterRole === 'user'       ? 'selected' : ''; ?>>Regular User</option>
          <option value="instructor" <?php echo $filterRole === 'instructor' ? 'selected' : ''; ?>>Instructor</option>
          <option value="admin"      <?php echo $filterRole === 'admin'      ? 'selected' : ''; ?>>IT Admin</option>
        </select>

        <select name="sort">
          <option value="name_asc"  <?php echo $sortBy === 'name_asc'  ? 'selected' : ''; ?>>Name A–Z</option>
          <option value="name_desc" <?php echo $sortBy === 'name_desc' ? 'selected' : ''; ?>>Name Z–A</option>
          <option value="role_asc"  <?php echo $sortBy === 'role_asc'  ? 'selected' : ''; ?>>Role A–Z</option>
          <option value="role_desc" <?php echo $sortBy === 'role_desc' ? 'selected' : ''; ?>>Role Z–A</option>
        </select>

        <button type="submit" class="btn-filter">Apply</button>
        <a href="admin_users.php" class="btn-reset">Reset</a>

      </div>
    </form>

    <!-- USER LIST -->
    <div class="list">

      <?php if (empty($users)): ?>
        <div class="empty-msg">No users found matching your search.</div>

      <?php else: ?>
        <?php foreach ($users as $u):
          $roleClass = 'role-user';
          if ($u['role'] === 'instructor') $roleClass = 'role-instructor';
          if ($u['role'] === 'admin')      $roleClass = 'role-admin';
          $roleLabel = ucfirst($u['role']);
          if ($u['role'] === 'admin') $roleLabel = 'IT Admin';
        ?>
        <div class="user" id="user-<?php echo $u['id']; ?>">

          <!-- NAME + ROLE BADGE -->
          <div>
            <?php echo htmlspecialchars($u['first_name'] . " " . $u['last_name']); ?>
            <br>
            <span class="role-badge <?php echo $roleClass; ?>">
              <?php echo $roleLabel; ?>
            </span>
          </div>

          <!-- ACTIONS -->
          <div class="actions">

            <button class="role-btn"
                    onclick="toggleRole(<?php echo $u['id']; ?>)"
                    title="Change Role">⚙️</button>

            <form method="POST" action="delete_user.php"
                  onsubmit="return confirm('Delete this user?');">
              <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
              <button class="delete-btn" title="Delete User">✕</button>
            </form>

          </div>

          <!-- ROLE DROPDOWN -->
          <div class="role-dropdown">
            <form method="POST" action="update_role.php">
              <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
              <select name="role">
                <option value="user"       <?php echo $u['role'] === 'user'       ? 'selected' : ''; ?>>Regular User</option>
                <option value="instructor" <?php echo $u['role'] === 'instructor' ? 'selected' : ''; ?>>Instructor</option>
                <option value="admin"      <?php echo $u['role'] === 'admin'      ? 'selected' : ''; ?>>IT Admin</option>
              </select>
              <button type="submit">Save</button>
            </form>
          </div>

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