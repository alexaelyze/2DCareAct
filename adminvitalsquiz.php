<?php
session_start();
include "db.php";

/* ADMIN ONLY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

/* GET USERS */
$sql = "SELECT id, first_name, last_name FROM users WHERE role != 'admin'";
$result = mysqli_query($conn, $sql);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - User Scores</title>

<style>
:root {
  --primary: #536dfe;
  --light: #eef2ff;
}

body{
margin:0;
font-family:Segoe UI;
background:#4f6cf5;
}

/* HEADER */
header {
  background: var(--primary);
  color: white;
  padding: 20px 40px;
  display: flex;
  justify-content: space-between;
}

.logo {
  font-size: 32px;
  font-weight: bold;
}

nav a {
  color: white;
  text-decoration: none;
  margin: 0 20px;
  font-size: 18px;
  font-weight: 500;
}

/* MAIN LAYOUT */
.wrapper {
  display: flex;
  gap: 30px;
  padding: 40px;
}

/* LEFT ICON BOX */
.profile-box {
  width: 200px;
  height: 200px;
  background: #ffffff;
  border-radius: 10px;
  display:flex;
  align-items:center;
  justify-content:center;
}

.profile-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* MAIN BOX */
.container{
flex:1;
background:white;
padding:30px;
border-radius:25px;
}

/* TITLE */
.title{
text-align:center;
background:var(--primary);
color:white;
padding:15px;
border-radius:25px;
font-size:22px;
font-weight:bold;
margin-bottom:25px;
}

/* LIST */
.list{
background:linear-gradient(to right,#5f6df5,#4b5fe0);
padding:20px;
border-radius:25px;
max-height:400px;
overflow-y:auto;
}

/* USER ROW */
.user{
background:white;
padding:18px;
border-radius:30px;
margin-bottom:15px;
display:flex;
justify-content:space-between;
font-weight:bold;
font-size:18px;
}

/* STATUS COLORS */
.good { color: green; }
.bad { color: red; }
.not { color: gray; }
</style>
</head>

<body>

<header>
  <div class="logo">CareAct</div>
  <nav>
    <a href="home.php">Home</a>
    <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="admin_users.php">Users</a>
    <a href="admin_user_scores.php">User Scores</a>
<?php endif; ?>
    <a href="modules.html">Modules</a>
    <a href="quizandlab.html">Quiz and Lab Assessments</a>
    <a href="scores.html">Overall Scores</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>

<div class="wrapper">

  <!-- LEFT ICON -->
  <div class="profile-box">
    <img src="blankuser.png" alt="Admin Icon">
  </div>

  <!-- MAIN CONTENT -->
  <div class="container">

    <div class="title">Checking Vital Signs Quiz Scores</div>

    <div class="list">

<?php foreach ($users as $u): ?>

<?php
$user_id = $u['id'];

/* GET QUIZ STATUS */
$q_sql = "SELECT status FROM quiz_scores 
          WHERE user_id=? AND quiz_name='vitals' LIMIT 1";
$stmt = mysqli_prepare($conn,$q_sql);
mysqli_stmt_bind_param($stmt,"i",$user_id);
mysqli_stmt_execute($stmt);
$q_res = mysqli_stmt_get_result($stmt);
$q_data = mysqli_fetch_assoc($q_res);

$quiz_status = $q_data ? $q_data['status'] : "Not Taken";

/* STYLE */
$class = "not";
if ($quiz_status === "Competent") $class = "good";
if ($quiz_status === "Incompetent") $class = "bad";
?>

<div class="user">
  <span><?php echo htmlspecialchars($u['first_name']." ".$u['last_name']); ?></span>
  <span>-</span>
  <span class="<?php echo $class; ?>">
    <?php echo $quiz_status; ?>
  </span>
</div>

<?php endforeach; ?>

    </div>
  </div>

</div>

</body>
</html>