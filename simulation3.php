<?php
/**
 * simulation_template.php
 * ─────────────────────────────────────────────────────
 * Universal template for all 5 simulations.
 * Copy and change only ONE constant per file:
 *
 *   define('SIM_ID', 'mobilitysimulation');  ← simulation1.php
 *   define('SIM_ID', 'cpr_simulation');       ← simulation2.php
 *   define('SIM_ID', 'mobilitysimulation');   ← simulation3.php
 *   define('SIM_ID', 'infantsimulation');     ← simulation4.php
 *   define('SIM_ID', 'hygienesimulation');    ← simulation5.php
 * ─────────────────────────────────────────────────────
 */
define('SIM_ID', 'mobilitysimulation'); // ← change per file

session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sid  = SIM_ID;
$safe = mysqli_real_escape_string($conn, $sid);

// ── Fetch settings ──
$settingsRow = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM simulation_settings WHERE sim_id='$safe'"));
if (!$settingsRow) die("Simulation not found: $sid");

// ── Fetch steps ──
$stepsRes = mysqli_query($conn,
    "SELECT * FROM simulation_steps WHERE sim_id='$safe' ORDER BY sort_order ASC");
$steps = [];
while ($r = mysqli_fetch_assoc($stepsRes)) $steps[] = $r;

// ── Fetch actions ──
$actionsRes = mysqli_query($conn,
    "SELECT * FROM simulation_actions WHERE sim_id='$safe' ORDER BY id ASC");
$actions = [];
while ($r = mysqli_fetch_assoc($actionsRes)) $actions[] = $r;

$totalSteps     = count($steps);
$maxMistakes    = (int)$settingsRow['max_mistakes'];
$scoreRedirect  = htmlspecialchars($settingsRow['score_redirect']);
$simTitle       = htmlspecialchars($settingsRow['sim_title']);
$scenario       = htmlspecialchars($settingsRow['scenario']);

// Pass to JS
$correctActionsJson = json_encode(array_column($steps, 'correct_action'));
$stepImagesJson     = json_encode(array_column($steps, 'image'));
$firstImage         = htmlspecialchars($steps[0]['image'] ?? '');
?>
<!DOCTYPE html>
<html>
<head>
<title>CareAct – <?php echo $simTitle; ?></title>
<style>
body { margin:0; font-family:Segoe UI; background:#4f6cf5; }

header {
  background:#4f6cf5; color:white;
  padding:20px 40px; display:flex;
  align-items:center; justify-content:space-between;
}
.logo { font-size:32px; font-weight:bold; }
nav a { color:white; text-decoration:none; margin:0 25px; font-size:18px; font-weight:500; }
nav a:hover { text-decoration:underline; }
.logout { background:white; color:#4f6cf5; padding:8px 16px; border-radius:6px; font-weight:bold; }

.container {
  display:grid;
  grid-template-columns:300px 1fr 300px;
  gap:30px; padding:30px;
}

.left, .right {
  background:white; padding:20px;
  border-radius:8px; height:600px; overflow-y:auto;
}

.center {
  background:white; padding:20px; border-radius:8px;
  display:flex; flex-direction:column;
  align-items:center; justify-content:center;
}

.sim-image {
  width:600px; height:400px; background:#9aa1bf;
  border-radius:6px; object-fit:contain;
}

.actions {
  margin-top:20px; display:flex; align-items:center;
  gap:20px; overflow-x:auto; overflow-y:hidden;
  padding-bottom:10px; white-space:nowrap; max-width:650px;
}
.actions::-webkit-scrollbar { height:12px; }
.actions::-webkit-scrollbar-track { background:#d1d5db; border-radius:10px; }
.actions::-webkit-scrollbar-thumb { background:#6b7280; border-radius:10px; }
.actions::-webkit-scrollbar-thumb:hover { background:#4b5563; }

.action {
  width:90px; height:90px; background:#4f6cf5;
  padding:10px; border-radius:6px; cursor:pointer;
  transition:0.2s; flex-shrink:0;
}
.action:hover { transform:scale(1.1); }

.step { margin-bottom:12px; font-size:16px; }
.step.done { color:#16a34a; font-weight:bold; }

.score {
  background:#4f6cf5; color:white;
  padding:20px; margin-top:20px;
  border-radius:6px; font-size:18px;
}

/* INSTRUCTOR EDIT BUTTON */
.edit-sim-btn {
  display:block; margin:16px auto 0 auto;
  background:#4f6cf5; color:white;
  border:3px solid white; padding:10px 28px;
  border-radius:50px; font-size:15px; font-weight:bold;
  cursor:pointer; text-decoration:none; text-align:center;
}
.edit-sim-btn:hover { background:#3a56d4; 
}

/* TABLET VIEW */
@media (max-width: 1024px) {

  .container {
    grid-template-columns: 1fr; /* stack layout */
    gap: 20px;
  }

  .left, .right {
    height: auto;
    max-height: none;
  }

  .center {
    order: -1; /* center goes on top */
  }

  .sim-image {
    width: 100%;
    max-width: 500px;
    height: auto;
  }

  .actions {
    max-width: 100%;
  }
}


/* MOBILE VIEW */
@media (max-width: 600px) {

  header {
    flex-direction: column;
    align-items: flex-start;
  }

  nav {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  nav a {
    margin: 5px 0;
  }

  .container {
    padding: 15px;
  }

  .left, .right, .center {
    padding: 15px;
  }

  .sim-image {
    width: 100%;
    max-width: 100%;
  }

  .actions {
    gap: 10px;
  }

  .action {
    width: 70px;
    height: 70px;
  }

  .score {
    font-size: 16px;
  }
}

/* FOOTER */
footer{
  background: #4f6cf5;
  color: white;
  text-align: center;
  padding: 15px 20px;
  margin-top: 58px;
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

  <!-- LEFT -->
  <div class="left">
    <h2><?php echo $simTitle; ?></h2>
    <p><?php echo $scenario; ?></p>
    <h3>Steps</h3>
    <div id="stepList">
      <?php foreach ($steps as $i => $step): ?>
      <div class="step"><?php echo htmlspecialchars($step['step_text']); ?></div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- CENTER -->
  <div class="center">
    <img id="simulationImage" class="sim-image"
         src="<?php echo $firstImage; ?>" alt="Simulation step">

    <div class="actions">
      <?php foreach ($actions as $act): ?>
      <img src="<?php echo htmlspecialchars($act['icon']); ?>"
           class="action"
           title="<?php echo htmlspecialchars($act['action']); ?>"
           onclick="chooseAction('<?php echo htmlspecialchars($act['action']); ?>')">
      <?php endforeach; ?>
    </div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'instructor'): ?>
    <a href="simulation_editor.php?sim=<?php echo $sid; ?>"
       class="edit-sim-btn">Edit Simulation</a>
    <?php endif; ?>
  </div>

  <!-- RIGHT -->
  <div class="right">
    <h3>Simulation Progress</h3>
    <div class="score">
      <p>Step: <span id="stepNum">1</span>/<?php echo $totalSteps; ?></p>
      <p>Mistakes: <span id="mistakes">0</span>/<?php echo $maxMistakes; ?></p>
      <p>Score: <span id="score">0</span>%</p>
    </div>
  </div>

</div>

<script>
const CORRECT_ACTIONS = <?php echo $correctActionsJson; ?>;
const STEP_IMAGES     = <?php echo $stepImagesJson; ?>;
const TOTAL_STEPS     = <?php echo $totalSteps; ?>;
const MAX_MISTAKES    = <?php echo $maxMistakes; ?>;
const SIM_ID          = "<?php echo $sid; ?>";
const SCORE_REDIRECT  = "<?php echo $scoreRedirect; ?>";

let currentStep    = 0;
let mistakes       = 0;
let stepsCompleted = 0;
let scoreSaved     = false;

function chooseAction(action) {
  if (action === CORRECT_ACTIONS[currentStep]) {
    document.querySelectorAll(".step")[currentStep].classList.add("done");
    stepsCompleted++;
    currentStep++;
    updateUI();
    if (currentStep < TOTAL_STEPS) {
      document.getElementById("simulationImage").src = STEP_IMAGES[currentStep];
    } else {
      saveScore();
    }
  } else {
    mistakes++;
    document.getElementById("mistakes").innerText = mistakes;
    if (mistakes >= MAX_MISTAKES) {
      alert("Simulation Failed");
      saveScore();
    }
  }
}

function updateUI() {
  document.getElementById("stepNum").innerText = currentStep + 1;
  document.getElementById("score").innerText =
    Math.round((stepsCompleted / TOTAL_STEPS) * 100);
}

function saveScore() {
  if (scoreSaved) return;
  scoreSaved = true;
  const pct    = Math.round((stepsCompleted / TOTAL_STEPS) * 100);
  const status = (pct >= 75 && mistakes < MAX_MISTAKES) ? "Competent" : "Incompetent";

  fetch("save_simulation_score.php", {
    method:  "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      simulation_name: SIM_ID,
      steps:           stepsCompleted,
      total_steps:     TOTAL_STEPS,
      percentage:      pct,
      mistakes:        mistakes,
      status:          status
    })
  })
  .then(r => r.json())
  .then(d => { if (d.success) window.location.href = SCORE_REDIRECT; })
  .catch(() => alert("Server error while saving score."));
}
</script>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>