<?php
session_start();
include "db.php";

$isInstructor = isset($_SESSION['role']) && $_SESSION['role'] === 'instructor';

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

$quizzes = [
    ['id' => 'vitals',   'link' => 'quiz1.php', 'fallback' => 'CHECKING VITAL SIGNS'],
    ['id' => 'cpr',      'link' => 'quiz2.php', 'fallback' => 'CPR TRAINING'],
    ['id' => 'mobility', 'link' => 'quiz3.php', 'fallback' => 'ASSISTED MOBILITY'],
    ['id' => 'infant',   'link' => 'quiz4.php', 'fallback' => 'INFANT CARE'],
    ['id' => 'hygiene',  'link' => 'quiz5.php', 'fallback' => 'ELDERLY HYGIENE AND GROOMING'],
];

$simulations = [
    ['id' => 'vitalsignsimulation', 'link' => 'simulation1.php', 'fallback' => 'CHECKING VITAL SIGNS'],
    ['id' => 'cpr_simulation',      'link' => 'simulation2.php', 'fallback' => 'CPR TRAINING'],
    ['id' => 'mobilitysimulation',  'link' => 'simulation3.php', 'fallback' => 'ASSISTED MOBILITY'],
    ['id' => 'infantsimulation',    'link' => 'simulation4.php', 'fallback' => 'INFANT CARE'],
    ['id' => 'hygienesimulation',   'link' => 'simulation5.php', 'fallback' => 'ELDERLY HYGIENE AND GROOMING'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareAct Quiz and Lab</title>
<style>
:root {
  --primary: #536dfe;
}
* { box-sizing: border-box; font-family: "Segoe UI", sans-serif; margin: 0; padding: 0; }
body { background: white; }

header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  align-items: center; justify-content: space-between;
  margin-bottom: 30px;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 25px; font-size: 18px; font-weight: 500; }
nav a:hover { text-decoration: underline; }
.logout { background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; margin-left: 20px; font-weight: bold; }
.logout:hover { background: #e0e7ff; text-decoration: none; }

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

.card-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

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

.edit-quiz-btn {
  display: block;
  margin: 0 auto;
  background: var(--primary);
  color: white;
  border: 3px solid white;
  outline: 3px solid var(--primary);
  padding: 8px 16px;
  border-radius: 50px;
  font-size: 15px;
  font-weight: bold;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  width: 100%;
}
.edit-quiz-btn:hover { background: #3d57e8; }

@media (max-width: 1100px) {
  .grid { grid-template-columns: repeat(3, 1fr); }
  .container { padding: 30px 40px; }
}
@media (max-width: 700px) {
  .grid { grid-template-columns: repeat(2, 1fr); }
  .container { padding: 20px; }
}

footer {
  background: #4f6cf5; color: white;
  text-align: center; padding: 15px 20px;
  margin-top: 40px;
}
footer h3 { margin: 0; font-size: 18px; }
footer p  { margin: 5px 0; font-size: 14px; }
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

  <!-- ===== QUIZZES ===== -->
  <div class="section">
    <div class="section-heading">Quizzes</div>
    <div class="grid">
      <?php foreach ($quizzes as $i => $quiz):
        $num   = $i + 1;
        $label = strtoupper($quizLabels[$quiz['id']] ?? $quiz['fallback']);
        $label = str_replace([' - QUIZ', ' - Quiz'], '', $label);
      ?>
      <div class="card-wrap">
        <div class="item-label">Quiz <?php echo $num; ?></div>
        <a href="<?php echo $quiz['link']; ?>" class="card">
          <?php echo $label; ?>
        </a>
        <?php if ($isInstructor): ?>
        <a href="quiz_editor.php?quiz=<?php echo $quiz['id']; ?>"
           class="edit-quiz-btn">Edit Quiz</a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- ===== SIMULATIONS ===== -->
  <div class="section">
    <div class="section-heading">Simulations</div>
    <div class="grid">
      <?php foreach ($simulations as $i => $sim):
        $num   = $i + 1;
        $label = strtoupper($simTitles[$sim['id']] ?? $sim['fallback']);
        $label = str_replace([' SIMULATION', ' Simulation'], '', $label);
      ?>
      <div class="card-wrap">
        <div class="item-label">Simulation <?php echo $num; ?></div>
        <a href="<?php echo $sim['link']; ?>" class="card">
          <?php echo $label; ?>
        </a>
        <?php if ($isInstructor): ?>
        <a href="simulation_editor.php?sim=<?php echo $sim['id']; ?>"
           class="edit-quiz-btn">Edit Simulation</a>
        <?php endif; ?>
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