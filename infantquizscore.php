<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ── Fetch quiz settings for dynamic label and max_mistakes ──
$qs = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT quiz_label, max_mistakes FROM quiz_settings WHERE quiz_id = 'infant'"));
$quizLabel   = $qs ? htmlspecialchars($qs['quiz_label']) : 'Infant Care - Quiz';
$maxMistakes = $qs ? (int)$qs['max_mistakes'] : 3;

// ── Fetch this user's score ──
$stmt = mysqli_prepare($conn,
    "SELECT * FROM quiz_scores WHERE user_id=? AND quiz_name='infant'
     ORDER BY id DESC LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$score = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$score) {
    $score = [
        'steps' => 0, 'total_steps' => 0,
        'percentage' => 0, 'mistakes' => 0, 'status' => 'Not Taken'
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Infant Care Quiz Score</title>
<style>
:root { --primary: #536dfe; }
* { font-family: "Segoe UI", sans-serif; box-sizing: border-box; }
body {
  margin: 0;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  align-items: center; justify-content: space-between;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 25px; font-size: 18px; font-weight: 500; }
nav a:hover { text-decoration: underline; }
.logout { background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; font-weight: bold; }
.main {
  max-width: 800px;
  margin: 80px auto;
  flex: 1;
  width: 100%;
  padding: 0 20px;
}
.title {
  color: var(--primary);
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 35px;
  line-height: 1.3;
  text-align: center;
}
p {
  font-size: 18px;
  margin: 18px 0;
  text-align: left;
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

<div class="main">

  <h2 class="title">QUIZ SCORE FOR<br>
    <?php echo strtoupper(str_replace(' - Quiz', '', $quizLabel)); ?>
  </h2>

  <p><b>STEPS ACHIEVED:</b>
    <?php echo $score['steps'] . "/" . $score['total_steps']; ?></p>

  <p><b>PERCENTAGE:</b>
    <?php echo $score['percentage']; ?>%</p>

  <p><b>MISTAKES:</b>
    <?php echo $score['mistakes']; ?>/<?php echo $maxMistakes; ?></p>

  <p><b>OVERALL SCORE:</b>
    <?php echo $score['status']; ?></p>

</div>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>