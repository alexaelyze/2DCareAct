<?php
/**
 * quiz_template.php
 * ─────────────────────────────────────────────
 * Universal template for all quizzes.
 * Copy and change only ONE constant per file:
 *
 *   define('QUIZ_ID', 'infant');   ← quiz1.php
 *   define('QUIZ_ID', 'cpr');      ← quiz2.php
 *   define('QUIZ_ID', 'quiz3');    ← quiz3.php  etc.
 * ─────────────────────────────────────────────
 */
define('QUIZ_ID', 'infant');   // ← change per quiz file

// ── auth ──
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ── fetch settings ──
$sid = QUIZ_ID;
$sr  = mysqli_query($conn,
    "SELECT * FROM quiz_settings WHERE quiz_id = '$sid'");
$settings = mysqli_fetch_assoc($sr);

if (!$settings) {
    die("Quiz settings not found for: " . QUIZ_ID);
}

// ── fetch questions ──
$qr = mysqli_query($conn,
    "SELECT * FROM quiz_questions WHERE quiz_id = '$sid' ORDER BY sort_order ASC");
$questions = [];
while ($row = mysqli_fetch_assoc($qr)) {
    $questions[] = $row;
}

// Pass everything to JS
$questionsJson = json_encode(array_map(function($q) {
    return [
        'question' => $q['question'],
        'options'  => json_decode($q['options']),
        'correct'  => (int)$q['correct_index']
    ];
}, $questions));

$timerSeconds   = (int)$settings['timer_seconds'];
$stepsPerQ      = (int)$settings['steps_per_q'];
$maxMistakes    = (int)$settings['max_mistakes'];
$quizLabel      = htmlspecialchars($settings['quiz_label']);
$scoreRedirect  = htmlspecialchars($settings['score_redirect']);
$totalQ         = count($questions);
$maxSteps       = $totalQ * $stepsPerQ;
$timerDisplay   = floor($timerSeconds/60) . ':' . str_pad($timerSeconds%60, 2, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<title>CareAct – <?php echo $quizLabel; ?></title>
<style>
:root { --primary: #556df5; --light: #f7f8ff; }
* { box-sizing: border-box; font-family: "Segoe UI", sans-serif; }
body { margin: 0; background: var(--light); }

header {
  background: var(--primary); color: white;
  padding: 20px 40px; display: flex;
  align-items: center; justify-content: space-between;
}
.logo { font-size: 32px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 25px; font-size: 18px; font-weight: 500; }
nav a:hover { text-decoration: underline; }

.container {
  display: grid;
  grid-template-columns: 200px 1fr 280px;
  gap: 40px; padding: 40px;
}

/* TIMER */
.timer-wrapper { display: flex; flex-direction: column; align-items: center; gap: 15px; }
.quiz-label {
  background: var(--primary); color: white;
  padding: 10px 18px; border-radius: 6px;
  font-size: 14px; font-weight: 600;
  text-align: center; max-width: 180px;
}
.timer-circle {
  width: 140px; height: 140px; border-radius: 50%;
  background: var(--primary); display: flex;
  justify-content: center; align-items: center;
  color: white; font-size: 28px; font-weight: bold;
}

/* QUIZ */
.quiz { background: white; padding: 30px; border-radius: 8px; }
.quiz h2 {
  background: var(--primary); color: white;
  padding: 20px; border-radius: 6px; text-align: center;
}
.option {
  background: var(--primary); color: white;
  padding: 16px; margin-top: 15px; border-radius: 6px;
  cursor: pointer; text-align: center;
}
.option.correct { background: #2ecc71; }
.option.wrong   { background: #e74c3c; }
.next-btn {
  margin-top: 25px; padding: 14px; width: 100%;
  border: none; background: var(--primary); color: white;
  font-size: 16px; border-radius: 6px; cursor: pointer; display: none;
}

/* SCORE PANEL */
.score-panel {
  background: var(--primary); color: white;
  padding: 25px; border-radius: 8px;
}

/* MODAL */
.modal {
  position: fixed; inset: 0; background: rgba(0,0,0,.6);
  display: none; justify-content: center; align-items: center;
}
.modal-content {
  background: white; padding: 30px;
  border-radius: 10px; text-align: center;
}
.modal-content button {
  margin-top: 15px; padding: 10px 30px;
  background: var(--primary); color: white;
  border: none; border-radius: 6px;
  font-size: 16px; cursor: pointer;
}

.edit-quiz-btn {
  display: block;
  margin: 10px auto 0 auto;
  background: var(--primary);
  color: white;
  border: 3px solid white;
  padding: 10px 28px;
  border-radius: 50px;
  font-size: 15px;
  font-weight: bold;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  letter-spacing: 0.5px;
}
.edit-quiz-btn:hover { background: #3d57e8; }

/* FOOTER */
footer{
  background: #4f6cf5;
  color: white;
  text-align: center;
  padding: 15px 20px;
  margin-top: 385px;
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

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'instructor'): ?>
  <a href="quiz_editor.php?quiz=infant" class="edit-quiz-btn">Edit Quiz</a>
<?php endif; ?>

<div class="container">

  <div class="timer-wrapper">
    <div class="quiz-label"><?php echo $quizLabel; ?></div>
    <div class="timer-circle" id="timer"><?php echo $timerDisplay; ?></div>
  </div>

  <div class="quiz">
    <h2 id="questionText"></h2>
    <div id="options"></div>
    <button class="next-btn" id="nextBtn">Next</button>
  </div>

  <div class="score-panel">
    <p>Item: <span id="item">1</span>/<?php echo $totalQ; ?></p>
    <p>Steps Achieved: <span id="steps">0</span>/<?php echo $maxSteps; ?></p>
    <p>Percentage: <span id="percentage">0</span>%</p>
    <p>Mistakes: <span id="mistakes">0</span>/<?php echo $maxMistakes; ?></p>
  </div>

</div>

<div class="modal" id="timeUpModal">
  <div class="modal-content">
    <h2>Time's Up!</h2>
    <button onclick="finish()">Next</button>
  </div>
</div>

<div class="modal" id="failModal">
  <div class="modal-content">
    <h2>You Failed!</h2>
    <p>You reached <?php echo $maxMistakes; ?> mistakes.</p>
    <button onclick="finish()">Next</button>
  </div>
</div>

<script>
// ── Settings from PHP ──
const QUESTIONS      = <?php echo $questionsJson; ?>;
const TIMER_SECONDS  = <?php echo $timerSeconds; ?>;
const STEPS_PER_Q    = <?php echo $stepsPerQ; ?>;
const MAX_MISTAKES   = <?php echo $maxMistakes; ?>;
const TOTAL_Q        = <?php echo $totalQ; ?>;
const MAX_STEPS      = <?php echo $maxSteps; ?>;
const QUIZ_ID        = "<?php echo QUIZ_ID; ?>";
const SCORE_REDIRECT = "<?php echo $scoreRedirect; ?>";

// ── State ──
let currentQ    = 0;
let steps       = 0;
let mistakes    = 0;
let answered    = false;
let scoreSaved  = false;
let totalSecs   = TIMER_SECONDS;

// ── Elements ──
const timerEl    = document.getElementById("timer");
const questionEl = document.getElementById("questionText");
const optionsEl  = document.getElementById("options");
const nextBtn    = document.getElementById("nextBtn");
const stepsEl    = document.getElementById("steps");
const percentEl  = document.getElementById("percentage");
const mistakesEl = document.getElementById("mistakes");
const itemEl     = document.getElementById("item");
const timeUpMod  = document.getElementById("timeUpModal");
const failMod    = document.getElementById("failModal");

// ── Timer ──
const timerInterval = setInterval(() => {
  if (totalSecs <= 0) {
    clearInterval(timerInterval);
    timeUpMod.style.display = "flex";
    return;
  }
  totalSecs--;
  const m = Math.floor(totalSecs / 60);
  const s = totalSecs % 60;
  timerEl.textContent = `${m}:${s.toString().padStart(2,"0")}`;
}, 1000);

// ── Load question ──
function loadQuestion() {
  answered = false;
  nextBtn.style.display = "none";
  optionsEl.innerHTML   = "";

  const q = QUESTIONS[currentQ];
  questionEl.textContent = q.question;
  itemEl.textContent     = currentQ + 1;

  q.options.forEach((opt, idx) => {
    const div = document.createElement("div");
    div.className   = "option";
    div.textContent = opt;
    div.onclick     = () => selectAnswer(div, idx === q.correct, q.correct);
    optionsEl.appendChild(div);
  });
}

// ── Select answer ──
function selectAnswer(el, correct, correctIdx) {
  if (answered) return;
  answered = true;

  if (correct) {
    el.classList.add("correct");
    steps += STEPS_PER_Q;
  } else {
    el.classList.add("wrong");
    mistakes++;
    // highlight correct answer
    optionsEl.children[correctIdx].classList.add("correct");
  }

  stepsEl.textContent   = steps;
  percentEl.textContent = Math.round((steps / MAX_STEPS) * 100);
  mistakesEl.textContent = mistakes;

  if (mistakes >= MAX_MISTAKES) {
    clearInterval(timerInterval);
    failMod.style.display = "flex";
    return;
  }

  nextBtn.style.display = "block";
}

// ── Next button ──
nextBtn.onclick = () => {
  currentQ++;
  if (currentQ < TOTAL_Q) {
    loadQuestion();
  } else {
    clearInterval(timerInterval);
    saveScore();
  }
};

// ── Called from modals ──
function finish() {
  clearInterval(timerInterval);
  saveScore();
}

// ── Save score ──
function saveScore() {
  if (scoreSaved) return;
  scoreSaved = true;

  const pct    = Math.round((steps / MAX_STEPS) * 100);
  const status = (pct >= 75 && mistakes < MAX_MISTAKES) ? "Competent" : "Incompetent";

  fetch("save_quiz_score.php", {
    method:  "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      quiz_name:   QUIZ_ID,
      steps:       steps,
      total_steps: MAX_STEPS,
      percentage:  pct,
      mistakes:    mistakes,
      status:      status
    })
  })
  .then(r => r.json())
  .then(d => {
    if (d.success) window.location.href = SCORE_REDIRECT;
    else alert("Failed to save score.");
  })
  .catch(() => alert("Server error while saving score."));
}

loadQuestion();
</script>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>