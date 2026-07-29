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

/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* ADMIN ONLY */
if ($_SESSION['role'] !== 'instructor') {
    header("Location: instructor_home.php");
    exit();
}

$quizzes = [
    ['id' => 'vitals',   'module' => 'vitals',   'type' => 'quiz', 'fallback' => 'CHECKING VITAL SIGNS'],
    ['id' => 'cpr',      'module' => 'cpr',       'type' => 'quiz', 'fallback' => 'CPR TRAINING'],
    ['id' => 'mobility', 'module' => 'mobility',  'type' => 'quiz', 'fallback' => 'ASSISTED MOBILITY'],
    ['id' => 'infant',   'module' => 'infant',    'type' => 'quiz', 'fallback' => 'INFANT CARE'],
    ['id' => 'hygiene',  'module' => 'hygiene',   'type' => 'quiz', 'fallback' => 'ELDERLY HYGIENE AND GROOMING'],
];

$simulations = [
    ['id' => 'vitalsignsimulation', 'module' => 'vitalsignsimulation', 'type' => 'simulation', 'fallback' => 'CHECKING VITAL SIGNS'],
    ['id' => 'cpr_simulation',      'module' => 'cpr_simulation',      'type' => 'simulation', 'fallback' => 'CPR TRAINING'],
    ['id' => 'mobilitysimulation',  'module' => 'mobilitysimulation',  'type' => 'simulation', 'fallback' => 'ASSISTED MOBILITY'],
    ['id' => 'infantsimulation',    'module' => 'infantsimulation',    'type' => 'simulation', 'fallback' => 'INFANT CARE'],
    ['id' => 'hygienesimulation',   'module' => 'hygienesimulation',   'type' => 'simulation', 'fallback' => 'ELDERLY HYGIENE AND GROOMING'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Scores</title>
<style>
:root { --primary: #536dfe; }
* { box-sizing: border-box; font-family: "Segoe UI", sans-serif; margin: 0; padding: 0; }
body { background: white; }

header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  align-items: center; justify-content: space-between;
  margin-bottom: 30px;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 20px; font-size: 18px; font-weight: 500; }
nav a:hover { text-decoration: underline; }
.logout { background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; font-weight: bold; }
.logout:hover { background: #e0e7ff; }

.container { padding: 40px 80px 60px 80px; }

/* SECTION HEADING */
.section-heading {
  font-size: 22px;
  font-weight: bold;
  color: white;
  background: var(--primary);
  border: 3px solid white;
  outline: 3px solid var(--primary);
  display: inline-block;
  padding: 10px 40px;
  border-radius: 50px;
  margin-bottom: 25px;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.section { margin-bottom: 50px; }

/* 5-column grid */
.grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 35px;
}

/* CARD WRAP */
.card-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

/* ITEM LABEL */
.item-label {
  background: var(--primary);
  color: white;
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 1px;
  text-transform: uppercase;
  width: 100%;
  text-align: center;
  padding: 8px 16px;
  border-radius: 50px;
  border: 3px solid white;
  outline: 3px solid var(--primary);
}

/* CARD */
.card {
  background: var(--primary);
  color: white;
  height: 170px;
  border-radius: 8px;
  text-align: center;
  padding: 25px;
  font-size: 20px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: 0.2s ease;
  width: 100%;
  border: 3px solid white;
  outline: 3px solid var(--primary);
}

.card:hover { transform: scale(1.05); opacity: 0.9; }

@media (max-width: 1100px) {
  .grid { grid-template-columns: repeat(3, 1fr); }
  .container { padding: 30px 40px; }
}
@media (max-width: 700px) {
  .grid { grid-template-columns: repeat(2, 1fr); }
  .container { padding: 20px; }
}

/* FOOTER */
footer {
  background: #4f6cf5; color: white;
  text-align: center; padding: 15px 20px;
  margin-top: 40px;
}
footer h3 { margin: 0; font-size: 18px; }
footer p  { margin: 5px 0; font-size: 14px; }
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

<div class="container">

  <!-- ===== QUIZ SCORES ===== -->
  <div class="section">
    <div class="section-heading">User Quiz Scores</div>
    <div class="grid">
      <?php foreach ($quizzes as $i => $q):
        $num   = $i + 1;
        $label = strtoupper($quizLabels[$q['id']] ?? $q['fallback']);
        $label = str_replace([' - QUIZ', ' - Quiz'], '', $label);
      ?>
      <div class="card-wrap">
        <div class="item-label">Quiz <?php echo $num; ?></div>
        <a href="adminfinalscore.php?module=<?php echo urlencode($q['module']); ?>&type=<?php echo $q['type']; ?>"
           class="card">
          <?php echo $label; ?> SCORE
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- ===== SIMULATION SCORES ===== -->
  <div class="section">
    <div class="section-heading">User Simulation Scores</div>
    <div class="grid">
      <?php foreach ($simulations as $i => $s):
        $num   = $i + 1;
        $label = strtoupper($simTitles[$s['id']] ?? $s['fallback']);
        $label = str_replace([' SIMULATION', ' Simulation'], '', $label);
      ?>
      <div class="card-wrap">
        <div class="item-label">Simulation <?php echo $num; ?></div>
        <a href="adminfinalscore.php?module=<?php echo urlencode($s['module']); ?>&type=<?php echo $s['type']; ?>"
           class="card">
          <?php echo $label; ?> SCORE
        </a>
      </div>
      <?php endforeach; ?>
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