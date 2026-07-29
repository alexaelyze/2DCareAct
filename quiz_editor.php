<?php
/**
 * quiz_editor.php
 * ──────────────────────────────────────────────────
 * Instructor-only CMS for editing any quiz.
 * Access via: quiz_editor.php?quiz=vitals
 *             quiz_editor.php?quiz=cpr
 *             quiz_editor.php?quiz=mobility
 *             quiz_editor.php?quiz=infant
 *             quiz_editor.php?quiz=hygiene
 * ──────────────────────────────────────────────────
 */
session_start();
include "db.php";

// ── Auth: instructor only ──
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'instructor') {
    header("Location: login.php");
    exit();
}

$quizId = $_GET['quiz'] ?? '';
if (empty($quizId)) {
    die("No quiz specified. Add ?quiz=vitals (or cpr/mobility/infant/hygiene) to the URL.");
}
$safe = mysqli_real_escape_string($conn, $quizId);

// ── Handle SAVE SETTINGS ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    $action = $_POST['action'];

    // --- Save timer / steps / mistakes ---
    if ($action === 'save_settings') {
        $label     = mysqli_real_escape_string($conn, trim($_POST['quiz_label']));
        $redirect  = mysqli_real_escape_string($conn, trim($_POST['score_redirect']));
        $timer     = (int)$_POST['timer_seconds'];
        $stepsPerQ = (int)$_POST['steps_per_q'];
        $maxMis    = (int)$_POST['max_mistakes'];

        mysqli_query($conn,
            "UPDATE quiz_settings
             SET quiz_label='$label', score_redirect='$redirect',
                 timer_seconds=$timer, steps_per_q=$stepsPerQ, max_mistakes=$maxMis
             WHERE quiz_id='$safe'");
        header("Location: quiz_editor.php?quiz=$safe&saved=settings");
        exit();
    }

    // --- Add new question ---
    if ($action === 'add_question') {
        $question = mysqli_real_escape_string($conn, trim($_POST['question']));
        $options  = array_filter(array_map('trim', $_POST['options']));
        $correct  = (int)$_POST['correct_index'];
        $options  = array_values($options); // re-index

        if (!empty($question) && count($options) >= 2) {
            $optJson = mysqli_real_escape_string($conn, json_encode($options));
            $nextOrder = mysqli_fetch_assoc(
                mysqli_query($conn, "SELECT COALESCE(MAX(sort_order),0)+1 AS n FROM quiz_questions WHERE quiz_id='$safe'")
            )['n'];
            mysqli_query($conn,
                "INSERT INTO quiz_questions (quiz_id, question, options, correct_index, sort_order)
                 VALUES ('$safe', '$question', '$optJson', $correct, $nextOrder)");
        }
        header("Location: quiz_editor.php?quiz=$safe&saved=question");
        exit();
    }

    // --- Update existing question ---
    if ($action === 'update_question') {
        $qid      = (int)$_POST['question_id'];
        $question = mysqli_real_escape_string($conn, trim($_POST['question']));
        $options  = array_filter(array_map('trim', $_POST['options']));
        $correct  = (int)$_POST['correct_index'];
        $options  = array_values($options);

        if (!empty($question) && count($options) >= 2) {
            $optJson = mysqli_real_escape_string($conn, json_encode($options));
            mysqli_query($conn,
                "UPDATE quiz_questions
                 SET question='$question', options='$optJson', correct_index=$correct
                 WHERE id=$qid AND quiz_id='$safe'");
        }
        header("Location: quiz_editor.php?quiz=$safe&saved=updated");
        exit();
    }

    // --- Delete question ---
    if ($action === 'delete_question') {
        $qid = (int)$_POST['question_id'];
        mysqli_query($conn, "DELETE FROM quiz_questions WHERE id=$qid AND quiz_id='$safe'");
        // Re-number sort_order
        $rows = mysqli_query($conn, "SELECT id FROM quiz_questions WHERE quiz_id='$safe' ORDER BY sort_order ASC");
        $i = 1;
        while ($r = mysqli_fetch_assoc($rows)) {
            mysqli_query($conn, "UPDATE quiz_questions SET sort_order=$i WHERE id={$r['id']}");
            $i++;
        }
        header("Location: quiz_editor.php?quiz=$safe&saved=deleted");
        exit();
    }

    // --- Reorder (move up / move down) ---
    if ($action === 'move_up' || $action === 'move_down') {
        $qid = (int)$_POST['question_id'];
        $cur = mysqli_fetch_assoc(mysqli_query($conn,
            "SELECT sort_order FROM quiz_questions WHERE id=$qid"));
        $curOrder = (int)$cur['sort_order'];
        $dir      = $action === 'move_up' ? -1 : 1;
        $swapRow  = mysqli_fetch_assoc(mysqli_query($conn,
            "SELECT id, sort_order FROM quiz_questions
             WHERE quiz_id='$safe' AND sort_order = " . ($curOrder + $dir)));
        if ($swapRow) {
            mysqli_query($conn,
                "UPDATE quiz_questions SET sort_order={$swapRow['sort_order']} WHERE id=$qid");
            mysqli_query($conn,
                "UPDATE quiz_questions SET sort_order=$curOrder WHERE id={$swapRow['id']}");
        }
        header("Location: quiz_editor.php?quiz=$safe");
        exit();
    }
}

// ── Fetch data ──
$settings = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM quiz_settings WHERE quiz_id='$safe'"));
if (!$settings) {
    die("Quiz '$safe' not found in quiz_settings table.");
}

$qRows = mysqli_query($conn,
    "SELECT * FROM quiz_questions WHERE quiz_id='$safe' ORDER BY sort_order ASC");
$questions = [];
while ($r = mysqli_fetch_assoc($qRows)) {
    $r['options_arr'] = json_decode($r['options'], true);
    $questions[] = $r;
}

$saved   = $_GET['saved'] ?? '';
$totalQ  = count($questions);
$maxSteps = $totalQ * (int)$settings['steps_per_q'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Quiz Editor — <?php echo htmlspecialchars($settings['quiz_label']); ?></title>
<style>
:root { --primary: #536dfe; --danger: #e53935; --success: #43a047; }
* { box-sizing: border-box; font-family: "Segoe UI", sans-serif; margin: 0; padding: 0; }
body { background: #f0f2ff; }

header {
  background: var(--primary); color: white;
  padding: 18px 40px; display: flex;
  align-items: center; justify-content: space-between;
}
.logo { font-size: 28px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 16px; font-size: 16px; font-weight: 500; }
nav a:hover { text-decoration: underline; }

.page { max-width: 1100px; margin: 30px auto; padding: 0 20px 60px; }

/* TOAST */
.toast {
  background: var(--success); color: white;
  padding: 12px 24px; border-radius: 8px;
  margin-bottom: 20px; font-weight: 600;
  display: inline-block;
}

/* SECTION CARD */
.card {
  background: white; border-radius: 10px;
  padding: 28px 32px; margin-bottom: 28px;
  box-shadow: 0 2px 8px rgba(0,0,0,.07);
}
.card h2 {
  color: var(--primary); font-size: 18px;
  margin-bottom: 20px; padding-bottom: 10px;
  border-bottom: 2px solid #e8ebff;
}

/* SETTINGS FORM */
.settings-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 18px;
  margin-bottom: 18px;
}
.settings-grid label { font-weight: 600; font-size: 14px; color: #444; display: block; margin-bottom: 6px; }
.settings-grid input {
  width: 100%; padding: 10px 14px;
  border: 1px solid #ccc; border-radius: 6px;
  font-size: 15px;
}
.full-width { grid-column: 1 / -1; }
.full-width input { width: 100%; }

/* STATS BAR */
.stats-bar {
  background: #e8ebff; border-radius: 8px;
  padding: 14px 20px; margin-bottom: 20px;
  display: flex; gap: 40px; font-size: 15px;
}
.stats-bar strong { color: var(--primary); }

/* QUESTION LIST */
.q-item {
  border: 1px solid #dde; border-radius: 8px;
  margin-bottom: 16px; overflow: hidden;
}
.q-header {
  background: var(--primary); color: white;
  padding: 12px 18px; display: flex;
  align-items: center; justify-content: space-between;
  cursor: pointer;
}
.q-header .q-num { font-weight: bold; font-size: 15px; min-width: 80px; }
.q-header .q-text {
  flex: 1; font-size: 14px;
  white-space: nowrap; overflow: hidden;
  text-overflow: ellipsis; margin: 0 16px;
}
.q-actions { display: flex; gap: 6px; flex-shrink: 0; }
.q-actions form { display: inline; }
.q-actions button {
  background: rgba(255,255,255,0.2); color: white;
  border: 1px solid rgba(255,255,255,0.4);
  padding: 5px 10px; border-radius: 5px;
  cursor: pointer; font-size: 13px; font-weight: 600;
}
.q-actions button:hover { background: rgba(255,255,255,0.35); }
.q-actions button.del { background: var(--danger); border-color: var(--danger); }
.q-actions button.del:hover { background: #b71c1c; }

.q-body { padding: 20px 22px; display: none; }
.q-body.open { display: block; }

/* EDIT FORM inside question */
.edit-form label { font-weight: 600; font-size: 13px; color: #555; display: block; margin-bottom: 4px; }
.edit-form textarea {
  width: 100%; padding: 10px; border: 1px solid #ccc;
  border-radius: 6px; font-size: 14px; resize: vertical;
  min-height: 70px; margin-bottom: 14px;
}
.options-list { margin-bottom: 14px; }
.option-row {
  display: flex; align-items: center;
  gap: 10px; margin-bottom: 8px;
}
.option-row input[type="text"] {
  flex: 1; padding: 8px 12px;
  border: 1px solid #ccc; border-radius: 6px; font-size: 14px;
}
.option-row input[type="radio"] { width: 18px; height: 18px; cursor: pointer; }
.option-row .remove-opt {
  background: var(--danger); color: white;
  border: none; border-radius: 50%; width: 26px; height: 26px;
  cursor: pointer; font-size: 16px; line-height: 1;
  display: flex; align-items: center; justify-content: center;
}
.add-opt-btn {
  background: #e8ebff; color: var(--primary);
  border: 1px dashed var(--primary);
  padding: 7px 16px; border-radius: 6px;
  cursor: pointer; font-size: 13px; font-weight: 600;
  margin-bottom: 14px;
}
.save-q-btn {
  background: var(--success); color: white;
  border: none; padding: 10px 28px;
  border-radius: 6px; cursor: pointer;
  font-size: 14px; font-weight: 600;
}
.save-q-btn:hover { background: #2e7d32; }

/* ADD QUESTION PANEL */
.add-panel { background: #f7f8ff; border: 2px dashed var(--primary); border-radius: 10px; padding: 28px; }
.add-panel h3 { color: var(--primary); margin-bottom: 18px; }

/* SUBMIT BUTTON */
.btn-primary {
  background: var(--primary); color: white;
  border: none; padding: 11px 32px;
  border-radius: 8px; cursor: pointer;
  font-size: 15px; font-weight: 600;
}
.btn-primary:hover { background: #3d57e8; }

/* Correct indicator */
.correct-label { color: var(--success); font-weight: 700; font-size: 12px; margin-left: 4px; }

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

    <a href="quiz_editor.php?quiz=vitals">Quiz 1</a>
    <a href="quiz_editor.php?quiz=cpr">Quiz 2</a>
    <a href="quiz_editor.php?quiz=mobility">Quiz 3</a>
    <a href="quiz_editor.php?quiz=infant">Quiz 4</a>
    <a href="quiz_editor.php?quiz=hygiene">Quiz 5</a>
  </nav>
</header>

<div class="page">

  <?php if ($saved): ?>
  <div class="toast">
    ✅ <?php
      $msgs = [
        'settings' => 'Quiz settings saved successfully.',
        'question' => 'New question added.',
        'updated'  => 'Question updated.',
        'deleted'  => 'Question deleted.',
      ];
      echo $msgs[$saved] ?? 'Saved.';
    ?>
  </div>
  <?php endif; ?>

  <h1 style="color:var(--primary);margin-bottom:24px;">
    Quiz Editor — <?php echo htmlspecialchars($settings['quiz_label']); ?>
  </h1>

  <!-- ===== SETTINGS ===== -->
  <div class="card">
    <h2>⚙️ Quiz Settings</h2>

    <div class="stats-bar">
      <span>Total Questions: <strong><?php echo $totalQ; ?></strong></span>
      <span>Steps Per Question: <strong><?php echo $settings['steps_per_q']; ?></strong></span>
      <span>Max Steps: <strong><?php echo $maxSteps; ?></strong></span>
      <span>Timer: <strong><?php echo floor($settings['timer_seconds']/60); ?>:<?php echo str_pad($settings['timer_seconds']%60,2,'0',STR_PAD_LEFT); ?></strong></span>
      <span>Max Mistakes: <strong><?php echo $settings['max_mistakes']; ?></strong></span>
    </div>

    <form method="POST">
      <input type="hidden" name="action" value="save_settings">
      <div class="settings-grid">
        <div class="full-width">
          <label>Quiz Label (shown to students)</label>
          <input type="text" name="quiz_label"
                 value="<?php echo htmlspecialchars($settings['quiz_label']); ?>" required>
        </div>
        <div class="full-width">
          <label>Score Redirect Page (e.g. vitalsquizscore.php)</label>
          <input type="text" name="score_redirect"
                 value="<?php echo htmlspecialchars($settings['score_redirect']); ?>" required>
        </div>
        <div>
          <label>Timer (seconds) — e.g. 600 = 10 min</label>
          <input type="number" name="timer_seconds" min="60" max="3600"
                 value="<?php echo $settings['timer_seconds']; ?>" required>
        </div>
        <div>
          <label>Steps Per Question</label>
          <input type="number" name="steps_per_q" min="1" max="100"
                 value="<?php echo $settings['steps_per_q']; ?>" required>
        </div>
        <div>
          <label>Max Mistakes Allowed</label>
          <input type="number" name="max_mistakes" min="1" max="10"
                 value="<?php echo $settings['max_mistakes']; ?>" required>
        </div>
      </div>
      <button type="submit" class="btn-primary">Save Settings</button>
    </form>
  </div>

  <!-- ===== QUESTION LIST ===== -->
  <div class="card">
    <h2>Questions (<?php echo $totalQ; ?> total)</h2>

    <?php if (empty($questions)): ?>
    <p style="color:#888;">No questions yet. Add one below.</p>
    <?php endif; ?>

    <?php foreach ($questions as $qi => $q):
      $opts = $q['options_arr'];
      $correctIdx = (int)$q['correct_index'];
    ?>
    <div class="q-item" id="qitem-<?php echo $q['id']; ?>">

      <!-- HEADER (click to expand) -->
      <div class="q-header" onclick="toggleQ(<?php echo $q['id']; ?>)">
        <span class="q-num">Q<?php echo $qi+1; ?></span>
        <span class="q-text"><?php echo htmlspecialchars($q['question']); ?></span>
        <div class="q-actions" onclick="event.stopPropagation()">

          <!-- Move up -->
          <?php if ($qi > 0): ?>
          <form method="POST">
            <input type="hidden" name="action" value="move_up">
            <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">
            <button type="submit" title="Move up">▲</button>
          </form>
          <?php endif; ?>

          <!-- Move down -->
          <?php if ($qi < $totalQ - 1): ?>
          <form method="POST">
            <input type="hidden" name="action" value="move_down">
            <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">
            <button type="submit" title="Move down">▼</button>
          </form>
          <?php endif; ?>

          <!-- Delete -->
          <form method="POST" onsubmit="return confirm('Delete this question?')">
            <input type="hidden" name="action" value="delete_question">
            <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">
            <button type="submit" class="del" title="Delete">✕ Delete</button>
          </form>
        </div>
      </div>

      <!-- EDIT BODY -->
      <div class="q-body" id="qbody-<?php echo $q['id']; ?>">
        <form method="POST" class="edit-form">
          <input type="hidden" name="action" value="update_question">
          <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">

          <label>Question Text</label>
          <textarea name="question" required><?php echo htmlspecialchars($q['question']); ?></textarea>

          <label>Options <span style="font-weight:400;color:#888;">(select the radio button next to the correct answer)</span></label>
          <div class="options-list" id="opts-<?php echo $q['id']; ?>">
            <?php foreach ($opts as $oi => $opt): ?>
            <div class="option-row">
              <input type="radio" name="correct_index"
                     value="<?php echo $oi; ?>"
                     <?php echo $oi === $correctIdx ? 'checked' : ''; ?>>
              <input type="text" name="options[]"
                     value="<?php echo htmlspecialchars($opt); ?>" required>
              <?php if ($oi === $correctIdx): ?>
              <span class="correct-label">✓ correct</span>
              <?php endif; ?>
              <button type="button" class="remove-opt"
                      onclick="removeOption(this)"
                      title="Remove option">−</button>
            </div>
            <?php endforeach; ?>
          </div>

          <button type="button" class="add-opt-btn"
                  onclick="addOption('opts-<?php echo $q['id']; ?>')">
            + Add Option
          </button>

          <br>
          <button type="submit" class="save-q-btn">💾 Save Changes</button>
        </form>
      </div>

    </div>
    <?php endforeach; ?>
  </div>

  <!-- ===== ADD NEW QUESTION ===== -->
  <div class="add-panel">
    <h3>➕ Add New Question</h3>
    <form method="POST" class="edit-form" id="addForm">
      <input type="hidden" name="action" value="add_question">

      <label>Question Text</label>
      <textarea name="question" placeholder="Enter question here..." required></textarea>

      <label>Options <span style="font-weight:400;color:#888;">(select radio = correct answer)</span></label>
      <div class="options-list" id="new-opts">
        <div class="option-row">
          <input type="radio" name="correct_index" value="0" checked>
          <input type="text" name="options[]" placeholder="Option A" required>
          <button type="button" class="remove-opt" onclick="removeOption(this)">−</button>
        </div>
        <div class="option-row">
          <input type="radio" name="correct_index" value="1">
          <input type="text" name="options[]" placeholder="Option B" required>
          <button type="button" class="remove-opt" onclick="removeOption(this)">−</button>
        </div>
      </div>
      <button type="button" class="add-opt-btn" onclick="addOption('new-opts')">+ Add Option</button>
      <br><br>
      <button type="submit" class="btn-primary">Add Question</button>
    </form>
  </div>

</div><!-- /page -->

<script>
// ── Toggle question expand/collapse ──
function toggleQ(id) {
  const body = document.getElementById('qbody-' + id);
  body.classList.toggle('open');
}

// ── Add option row to a list ──
function addOption(listId) {
  const list  = document.getElementById(listId);
  const rows  = list.querySelectorAll('.option-row');
  const idx   = rows.length;
  const row   = document.createElement('div');
  row.className = 'option-row';
  row.innerHTML = `
    <input type="radio" name="correct_index" value="${idx}">
    <input type="text" name="options[]" placeholder="Option ${String.fromCharCode(65+idx)}" required>
    <button type="button" class="remove-opt" onclick="removeOption(this)">−</button>
  `;
  list.appendChild(row);
  reindexOptions(list);
}

// ── Remove option row ──
function removeOption(btn) {
  const row  = btn.closest('.option-row');
  const list = row.closest('.options-list');
  if (list.querySelectorAll('.option-row').length <= 2) {
    alert('A question must have at least 2 options.');
    return;
  }
  row.remove();
  reindexOptions(list);
}

// ── Re-index radio values after add/remove ──
function reindexOptions(list) {
  list.querySelectorAll('.option-row').forEach((row, i) => {
    const radio = row.querySelector('input[type="radio"]');
    radio.value = i;
  });
}
</script>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>