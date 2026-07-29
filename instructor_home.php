<?php
session_start();
include "db.php";

/* ADMIN ONLY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header("Location: instructor_home.php");
    exit();
}

/* GET NAME */
$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name FROM users WHERE id=?";
$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);
$first_name = $user['first_name'];

/* SAVE ANNOUNCEMENT */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = $_POST['announcement'];

    $sql = "INSERT INTO announcements (message) VALUES (?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$msg);
    mysqli_stmt_execute($stmt);
}

/* GET LATEST ANNOUNCEMENT (1 DAY ONLY) */
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
<title>Admin Dashboard</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#4f6cf5;
}

/* COLORS */
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

/* SIDE IMAGE BOXES */
.side-container {
    position: absolute;
    top: 160px;
    width: 100%;
    pointer-events: none;
}

/* FIXED RESPONSIVE BOX */
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

/* ORIGINAL POSITIONS (kept for desktop) */
.left-top { left:120px; top:0; }
.left-bottom { left:120px; top:360px; }

.right-top { right:220px; top:0; }
.right-bottom { right:220px; top:360px; }

/* MAIN CARD */
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

.stat{
background:#eef2ff;
padding:15px;
border-radius:8px;
margin-top:15px;
}

textarea{
width:90%;
padding:10px;
border-radius:8px;
border:none;
resize:none;
height:80px;
}

button{
margin-top:10px;
padding:10px 20px;
border:none;
background:#4f6cf5;
color:white;
border-radius:8px;
cursor:pointer;
}

button:hover{
background:#3f51b5;
}

/* TABLET */
@media (max-width: 1024px) {

  .side-box {
    position: relative;
    max-width: 45%;
    height: 180px;
  }

  .side-container {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    top: 0;
    margin-top: 20px;
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
  margin-top: 50px;
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

<!-- CENTER CARD -->
<div class="card">

<img src="blankuser.png">

<h1>Welcome, <?php echo htmlspecialchars($first_name); ?> 👋</h1>

<!-- ANNOUNCEMENT INPUT -->
<div class="stat">
<p><b>POST ANNOUNCEMENT:</b></p>

<form method="POST">
<textarea name="announcement" required></textarea>
<button type="submit">Post</button>
</form>
</div>

<!-- DISPLAY ANNOUNCEMENT -->
<div class="stat">
<p><b>LATEST ANNOUNCEMENT:</b></p>

<h2>
<?php 
echo $announcement 
? htmlspecialchars($announcement['message']) 
: "No active announcement"; 
?>
</h2>

</div>

</div>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>