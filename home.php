<?php
session_start();
include "db.php";
require_once "log_activity.php";

/* BLOCK ACCESS */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

logActivity(
    $conn,
    $_SESSION['user_id'],
    $_SESSION['role'],
    "Visited Home Page",
    "home.php"
);

/* GET USER NAME */
$sql = "SELECT first_name FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
$first_name = $user['first_name'];

/* ============================= */
/* COMPUTE PROGRESS */
/* ============================= */

$total_assignments = 10;

/* QUIZ */
$sql_quiz = "SELECT COUNT(*) as total FROM quiz_scores WHERE user_id = ? AND status = 'Competent'";
$stmt_quiz = mysqli_prepare($conn, $sql_quiz);
mysqli_stmt_bind_param($stmt_quiz, "i", $user_id);
mysqli_stmt_execute($stmt_quiz);
$result_quiz = mysqli_stmt_get_result($stmt_quiz);
$row_quiz = mysqli_fetch_assoc($result_quiz);
$quiz_completed = $row_quiz['total'];

/* SIMULATION */
$sql_sim = "SELECT COUNT(*) as total FROM simulation_scores WHERE user_id = ? AND status = 'Competent'";
$stmt_sim = mysqli_prepare($conn, $sql_sim);
mysqli_stmt_bind_param($stmt_sim, "i", $user_id);
mysqli_stmt_execute($stmt_sim);
$result_sim = mysqli_stmt_get_result($stmt_sim);
$row_sim = mysqli_fetch_assoc($result_sim);
$sim_completed = $row_sim['total'];

$completed = $quiz_completed + $sim_completed;

$completion_percentage = ($total_assignments > 0)
    ? round(($completed / $total_assignments) * 100)
    : 0;

$assignments_left = $total_assignments - $completed;

/* ANNOUNCEMENT */
$sql = "SELECT message FROM announcements 
        WHERE created_at >= NOW() - INTERVAL 1 DAY 
        ORDER BY id DESC LIMIT 1";

$res = mysqli_query($conn,$sql);
$announcement = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareAct Dashboard</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#4f6cf5;
}

:root {
  --primary: #536dfe;
  --light: #f5f6ff;
}

/* HEADER */
header {
  background: var(--primary);
  color: white;
  padding: 20px 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap; /* ✅ FIX */
}

.logo {
  font-size: 32px;
  font-weight: bold;
}

/* NAV FIX */
nav a {
  color: white;
  text-decoration: none;
  margin: 0 25px;
  font-size: 18px;
  font-weight: 500;
}

nav a:hover {
  text-decoration: underline;
}

/* LOGOUT BUTTON STYLE */
.logout {
  background: white;
  color: var(--primary);
  padding: 8px 16px;
  border-radius: 6px;
  margin-left: 20px;
  font-weight: bold;
}

.logout:hover {
  background: #e0e7ff;
  text-decoration: none;
}

/* SIDE IMAGES */
.side-container {
    position: absolute;
    top: 160px;
    width: 100%;
    pointer-events: none;
}

.side-box {
    width: 100%;
    max-width: 350px;
    height: 250px;
    background: #f5f6ff;
    border-radius: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    overflow: hidden;
}

.side-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* POSITIONS (desktop only) */
.left-top { left:120px; top:0; }
.left-bottom { left:120px; top:360px; }

.right-top { right:220px; top:0; }
.right-bottom { right:220px; top:360px; }

/* CARD */
.card{
width:100%;
max-width:420px;
margin:80px auto;
background:white;
padding:30px;
border-radius:12px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.card img{
width:100px;
margin-bottom:10px;
}

h1{
margin-bottom:20px;
color:#333;
}

/* STATS */
.stat{
background:#eef2ff;
padding:15px;
border-radius:8px;
margin-top:15px;
}

.stat p{
margin:0;
font-size:14px;
color:#555;
}

.stat h2{
margin:5px 0;
color:#4f6cf5;
}

/* PROGRESS */
.progress{
background:#dbeafe;
border-radius:10px;
height:20px;
margin-top:15px;
overflow:hidden;
}

.progress-bar{
height:100%;
background:#4f6cf5;
width: <?php echo $completion_percentage; ?>%;
transition:0.5s;
}

/* ============================= */
/* ✅ RESPONSIVE FIXES */
/* ============================= */

/* TABLET */
@media (max-width: 1024px) {

  .side-container {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    top: 0;
    margin-top: 20px;
  }

  .side-box {
    position: relative;
    max-width: 45%;
    height: 180px;
  }

  .left-top,
  .left-bottom,
  .right-top,
  .right-bottom {
    position: relative;
    left: unset;
    right: unset;
    top: unset;
  }
}

/* MOBILE */
@media (max-width: 600px) {

  header {
    flex-direction: column;
    align-items: flex-start;
  }

  nav {
    flex-direction: column;
    width: 100%;
  }

  .card {
    margin: 40px 20px;
    padding: 20px;
  }

  .side-box {
    max-width: 90%;
  }
}

/* FOOTER */
footer{
  background: #4f6cf5;
  color: white;
  text-align: center;
  padding: 15px 20px;
  margin-top: 150px;
}

footer h3{
  margin: 0;
  font-size: 18px;
}

footer p{
  margin: 5px 0;
  font-size: 14px;
}

/* MOBILE */
@media (max-width: 600px){

  footer{
    padding: 12px;
  }

  footer h3{
    font-size: 16px;
  }

  footer p{
    font-size: 12px;
  }

}


</style>
</head>

<body>

<header>

<!-- SIDE IMAGES -->
<div class="side-container">

    <div class="side-box left-top">
        <img src="icons/home1.png">
    </div>

    <div class="side-box left-bottom">
        <img src="icons/home2.png">
    </div>

    <div class="side-box right-top">
        <img src="icons/home3.png">
    </div>

    <div class="side-box right-bottom">
        <img src="icons/home4.png">
    </div>

</div>

<div class="logo">CareAct</div>

<nav>
<a href="home.php">Home</a>

<?php if ($_SESSION['role'] === 'admin'): ?>
<a href="admin_users.php">Users</a>
<a href="admin_user_scores.php">User Scores</a>
<?php endif; ?>

<a href="modules.php">Modules</a>
<a href="quizandlab.php">Quiz and Lab Assessments</a>
<a href="scores.php">Overall Scores</a>
<a href="logout.php" class="logout">Logout</a>

</nav>

</header>

<div class="card">

<img src="blankuser.png">

<h1>Welcome, <?php echo htmlspecialchars($first_name); ?> 👋</h1>

<div class="stat">
<p>COMPLETION PERCENTAGE:</p>
<h2><?php echo $completion_percentage; ?>%</h2>
</div>

<div class="progress">
<div class="progress-bar"></div>
</div>

<div class="stat">
<p>ASSIGNMENTS LEFT:</p>
<h2><?php echo $assignments_left; ?></h2>
</div>

<?php if ($announcement): ?>
<div class="stat">
<p><b>ANNOUNCEMENT:</b></p>
<h2><?php echo htmlspecialchars($announcement['message']); ?></h2>
</div>
<?php endif; ?>

</div>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>