<?php
/**
 * simulation_editor.php
 * Access via: simulation_editor.php?sim=vitalsignsimulation
 *             simulation_editor.php?sim=cpr_simulation
 *             simulation_editor.php?sim=mobilitysimulation
 *             simulation_editor.php?sim=infantsimulation
 *             simulation_editor.php?sim=hygienesimulation
 */
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'instructor') {
    header("Location: login.php");
    exit();
}

$simId = $_GET['sim'] ?? '';
if (empty($simId)) die("No simulation specified. Add ?sim=vitalsignsimulation to the URL.");
$safe = mysqli_real_escape_string($conn, $simId);

// ── Available action keys (for dropdown) ──
$allActionsRes = mysqli_query($conn,
    "SELECT DISTINCT action, icon FROM simulation_actions WHERE sim_id='$safe' ORDER BY id ASC");
$allActions = [];
while ($r = mysqli_fetch_assoc($allActionsRes)) $allActions[$r['action']] = $r['icon'];

// ── HANDLE POSTS ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $act = $_POST['action'];

    // --- Save settings ---
    if ($act === 'save_settings') {
        $title    = mysqli_real_escape_string($conn, trim($_POST['sim_title']));
        $scenario = mysqli_real_escape_string($conn, trim($_POST['scenario']));
        $redirect = mysqli_real_escape_string($conn, trim($_POST['score_redirect']));
        $maxMis   = (int)$_POST['max_mistakes'];
        mysqli_query($conn,
            "UPDATE simulation_settings
             SET sim_title='$title', scenario='$scenario',
                 score_redirect='$redirect', max_mistakes=$maxMis
             WHERE sim_id='$safe'");
        header("Location: simulation_editor.php?sim=$safe&saved=settings");
        exit();
    }

    // --- Add step ---
    if ($act === 'add_step') {
        $text    = mysqli_real_escape_string($conn, trim($_POST['step_text']));
        $correct = mysqli_real_escape_string($conn, trim($_POST['correct_action']));
        $imgPath = '';

        if (isset($_FILES['step_image']) && $_FILES['step_image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['step_image']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['png','jpg','jpeg','gif','webp'])) {
                header("Location: simulation_editor.php?sim=$safe&err=filetype");
                exit();
            }
            $folder = 'sim_uploads/' . $safe . '/';
            if (!is_dir($folder)) mkdir($folder, 0755, true);
            $filename = 'step_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['step_image']['tmp_name'], $folder . $filename);
            $imgPath = $folder . $filename;
        }

        $nextOrder = mysqli_fetch_assoc(mysqli_query($conn,
            "SELECT COALESCE(MAX(sort_order),0)+1 AS n FROM simulation_steps WHERE sim_id='$safe'"))['n'];

        $imgSafe = mysqli_real_escape_string($conn, $imgPath);
        mysqli_query($conn,
            "INSERT INTO simulation_steps (sim_id, step_text, image, correct_action, sort_order)
             VALUES ('$safe', '$text', '$imgSafe', '$correct', $nextOrder)");
        header("Location: simulation_editor.php?sim=$safe&saved=step");
        exit();
    }

    // --- Update step ---
    if ($act === 'update_step') {
        $stepId  = (int)$_POST['step_id'];
        $text    = mysqli_real_escape_string($conn, trim($_POST['step_text']));
        $correct = mysqli_real_escape_string($conn, trim($_POST['correct_action']));

        // Handle image replacement
        $imgSql = '';
        if (isset($_FILES['step_image']) && $_FILES['step_image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['step_image']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['png','jpg','jpeg','gif','webp'])) {
                header("Location: simulation_editor.php?sim=$safe&err=filetype");
                exit();
            }
            $folder = 'sim_uploads/' . $safe . '/';
            if (!is_dir($folder)) mkdir($folder, 0755, true);
            $filename = 'step_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['step_image']['tmp_name'], $folder . $filename);
            $newImg  = mysqli_real_escape_string($conn, $folder . $filename);
            $imgSql  = ", image='$newImg'";
        }

        mysqli_query($conn,
            "UPDATE simulation_steps
             SET step_text='$text', correct_action='$correct' $imgSql
             WHERE id=$stepId AND sim_id='$safe'");
        header("Location: simulation_editor.php?sim=$safe&saved=updated");
        exit();
    }

    // --- Delete step ---
    if ($act === 'delete_step') {
        $stepId = (int)$_POST['step_id'];
        mysqli_query($conn,
            "DELETE FROM simulation_steps WHERE id=$stepId AND sim_id='$safe'");
        // Re-number
        $rows = mysqli_query($conn,
            "SELECT id FROM simulation_steps WHERE sim_id='$safe' ORDER BY sort_order ASC");
        $i = 1;
        while ($r = mysqli_fetch_assoc($rows)) {
            mysqli_query($conn,
                "UPDATE simulation_steps SET sort_order=$i WHERE id={$r['id']}");
            $i++;
        }
        header("Location: simulation_editor.php?sim=$safe&saved=deleted");
        exit();
    }

    // --- Move up / down ---
    if ($act === 'move_up' || $act === 'move_down') {
        $stepId   = (int)$_POST['step_id'];
        $cur      = mysqli_fetch_assoc(mysqli_query($conn,
            "SELECT sort_order FROM simulation_steps WHERE id=$stepId"));
        $curOrder = (int)$cur['sort_order'];
        $dir      = $act === 'move_up' ? -1 : 1;
        $swap     = mysqli_fetch_assoc(mysqli_query($conn,
            "SELECT id, sort_order FROM simulation_steps
             WHERE sim_id='$safe' AND sort_order=" . ($curOrder + $dir)));
        if ($swap) {
            mysqli_query($conn,
                "UPDATE simulation_steps SET sort_order={$swap['sort_order']} WHERE id=$stepId");
            mysqli_query($conn,
                "UPDATE simulation_steps SET sort_order=$curOrder WHERE id={$swap['id']}");
        }
        header("Location: simulation_editor.php?sim=$safe");
        exit();
    }
}

// ── Fetch data ──
$settings = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM simulation_settings WHERE sim_id='$safe'"));
$stepsRes = mysqli_query($conn,
    "SELECT * FROM simulation_steps WHERE sim_id='$safe' ORDER BY sort_order ASC");
$steps = [];
while ($r = mysqli_fetch_assoc($stepsRes)) $steps[] = $r;
$totalSteps = count($steps);

$saved   = $_GET['saved'] ?? '';
$errType = $_GET['err']   ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Simulation Editor — <?php echo htmlspecialchars($settings['sim_title']); ?></title>
<style>
:root { --primary: #4f6cf5; --danger: #e53935; --success: #43a047; }
* { box-sizing: border-box; font-family: "Segoe UI", sans-serif; margin: 0; padding: 0; }
body { background: #eef0ff; }

header {
  background: var(--primary); color: white;
  padding: 18px 40px; display: flex;
  align-items: center; justify-content: space-between;
}
.logo { font-size: 28px; font-weight: bold; }
nav a { color: white; text-decoration: none; margin: 0 14px; font-size: 15px; font-weight: 500; }
nav a:hover { text-decoration: underline; }

.page { max-width: 1100px; margin: 30px auto; padding: 0 20px 80px; }

/* TOAST */
.toast { background: var(--success); color: white; padding: 12px 24px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; display: inline-block; }
.toast.error { background: var(--danger); }

/* CARD */
.card { background: white; border-radius: 10px; padding: 28px 32px; margin-bottom: 28px; box-shadow: 0 2px 8px rgba(0,0,0,.07); }
.card h2 { color: var(--primary); font-size: 18px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e0e4ff; }

/* SETTINGS */
.settings-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px; }
.settings-grid .full { grid-column: 1 / -1; }
.settings-grid label { font-weight: 600; font-size: 13px; color: #555; display: block; margin-bottom: 5px; }
.settings-grid input, .settings-grid textarea {
  width: 100%; padding: 10px 14px;
  border: 1px solid #ccc; border-radius: 6px; font-size: 14px;
}
.settings-grid textarea { resize: vertical; min-height: 80px; }

/* STATS */
.stats-bar { background: #e8ebff; border-radius: 8px; padding: 12px 20px; margin-bottom: 20px; display: flex; gap: 36px; font-size: 14px; }
.stats-bar strong { color: var(--primary); }

/* STEP ITEMS */
.step-item { border: 1px solid #dde; border-radius: 8px; margin-bottom: 14px; overflow: hidden; }
.step-header {
  background: var(--primary); color: white;
  padding: 12px 18px; display: flex;
  align-items: center; justify-content: space-between; cursor: pointer;
}
.step-num { font-weight: bold; min-width: 60px; font-size: 14px; }
.step-preview { flex: 1; font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0 14px; }
.step-badge { background: rgba(255,255,255,0.25); padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; margin-right: 10px; }
.step-btns { display: flex; gap: 6px; flex-shrink: 0; }
.step-btns form { display: inline; }
.step-btns button {
  background: rgba(255,255,255,0.2); color: white;
  border: 1px solid rgba(255,255,255,0.4);
  padding: 5px 10px; border-radius: 5px;
  cursor: pointer; font-size: 12px; font-weight: 600;
}
.step-btns button:hover { background: rgba(255,255,255,0.35); }
.step-btns button.del { background: var(--danger); border-color: var(--danger); }
.step-btns button.del:hover { background: #b71c1c; }

.step-body { padding: 20px 22px; display: none; }
.step-body.open { display: block; }

/* EDIT FORM */
.edit-form label { font-weight: 600; font-size: 13px; color: #555; display: block; margin-bottom: 5px; }
.edit-form textarea, .edit-form select, .edit-form input[type=text] {
  width: 100%; padding: 10px; border: 1px solid #ccc;
  border-radius: 6px; font-size: 14px; margin-bottom: 14px;
}
.edit-form textarea { resize: vertical; min-height: 70px; }

/* IMAGE PREVIEW */
.img-row { display: flex; gap: 20px; align-items: flex-start; margin-bottom: 14px; }
.current-img { width: 160px; height: 120px; object-fit: contain; background: #9aa1bf; border-radius: 6px; }
.upload-area { flex: 1; }
.upload-area input[type=file] { width: 100%; }

/* CORRECT ACTION SELECT */
.action-select-wrap { display: flex; gap: 12px; align-items: center; margin-bottom: 14px; }
.action-icon-preview { width: 50px; height: 50px; object-fit: contain; background: var(--primary); padding: 6px; border-radius: 6px; }

/* ADD PANEL */
.add-panel { background: #f0f2ff; border: 2px dashed var(--primary); border-radius: 10px; padding: 28px; }
.add-panel h3 { color: var(--primary); margin-bottom: 18px; }
.add-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.add-grid .full { grid-column: 1 / -1; }

/* BUTTONS */
.btn-primary { background: var(--primary); color: white; border: none; padding: 11px 32px; border-radius: 8px; cursor: pointer; font-size: 15px; font-weight: 600; }
.btn-primary:hover { background: #3a56d4; }
.btn-save { background: var(--success); color: white; border: none; padding: 10px 26px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 600; }
.btn-save:hover { background: #2e7d32; }
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
    <a href="instructor_home.php">Home</a>
    <a href="quizandlab.php">Quiz and Lab Assessments</a>
    <a href="simulation_editor.php?sim=vitalsignsimulation">Sim 1</a>
    <a href="simulation_editor.php?sim=cpr_simulation">Sim 2</a>
    <a href="simulation_editor.php?sim=mobilitysimulation">Sim 3</a>
    <a href="simulation_editor.php?sim=infantsimulation">Sim 4</a>
    <a href="simulation_editor.php?sim=hygienesimulation">Sim 5</a>
  </nav>
</header>

<div class="page">

  <?php if ($saved): ?>
  <div class="toast">✅ <?php
    echo ['settings'=>'Settings saved.','step'=>'Step added.','updated'=>'Step updated.','deleted'=>'Step deleted.'][$saved] ?? 'Saved.';
  ?></div>
  <?php endif; ?>

  <?php if ($errType === 'filetype'): ?>
  <div class="toast error">⚠️ Only image files (PNG, JPG, GIF, WEBP) are allowed.</div>
  <?php endif; ?>

  <h1 style="color:var(--primary);margin-bottom:24px;">
    Simulation Editor — <?php echo htmlspecialchars($settings['sim_title']); ?>
  </h1>

  <!-- ===== SETTINGS ===== -->
  <div class="card">
    <h2>⚙️ Simulation Settings</h2>
    <div class="stats-bar">
      <span>Total Steps: <strong><?php echo $totalSteps; ?></strong></span>
      <span>Max Mistakes: <strong><?php echo $settings['max_mistakes']; ?></strong></span>
      <span>Redirect: <strong><?php echo htmlspecialchars($settings['score_redirect']); ?></strong></span>
    </div>
    <form method="POST">
      <input type="hidden" name="action" value="save_settings">
      <div class="settings-grid">
        <div class="full">
          <label>Simulation Title</label>
          <input type="text" name="sim_title"
                 value="<?php echo htmlspecialchars($settings['sim_title']); ?>" required>
        </div>
        <div class="full">
          <label>Scenario Text (shown on left panel)</label>
          <textarea name="scenario"><?php echo htmlspecialchars($settings['scenario']); ?></textarea>
        </div>
        <div>
          <label>Score Redirect Page (e.g. vitalssimulationscore.php)</label>
          <input type="text" name="score_redirect"
                 value="<?php echo htmlspecialchars($settings['score_redirect']); ?>" required>
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

  <!-- ===== STEPS LIST ===== -->
  <div class="card">
    <h2>Steps (<?php echo $totalSteps; ?> total)</h2>

    <?php if (empty($steps)): ?>
    <p style="color:#888;">No steps yet. Add one below.</p>
    <?php endif; ?>

    <?php foreach ($steps as $si => $step):
      $correctAct = $step['correct_action'];
      $correctIcon = $allActions[$correctAct] ?? '';
    ?>
    <div class="step-item">
      <div class="step-header" onclick="toggleStep(<?php echo $step['id']; ?>)">
        <span class="step-num">Step <?php echo $si+1; ?></span>
        <span class="step-preview"><?php echo htmlspecialchars(substr($step['step_text'],0,80)); ?>...</span>
        <span class="step-badge">✓ <?php echo htmlspecialchars($correctAct); ?></span>
        <div class="step-btns" onclick="event.stopPropagation()">
          <?php if ($si > 0): ?>
          <form method="POST">
            <input type="hidden" name="action" value="move_up">
            <input type="hidden" name="step_id" value="<?php echo $step['id']; ?>">
            <button type="submit">▲</button>
          </form>
          <?php endif; ?>
          <?php if ($si < $totalSteps-1): ?>
          <form method="POST">
            <input type="hidden" name="action" value="move_down">
            <input type="hidden" name="step_id" value="<?php echo $step['id']; ?>">
            <button type="submit">▼</button>
          </form>
          <?php endif; ?>
          <form method="POST" onsubmit="return confirm('Delete this step?')">
            <input type="hidden" name="action" value="delete_step">
            <input type="hidden" name="step_id" value="<?php echo $step['id']; ?>">
            <button type="submit" class="del">✕ Delete</button>
          </form>
        </div>
      </div>

      <div class="step-body" id="stepbody-<?php echo $step['id']; ?>">
        <form method="POST" enctype="multipart/form-data" class="edit-form">
          <input type="hidden" name="action" value="update_step">
          <input type="hidden" name="step_id" value="<?php echo $step['id']; ?>">

          <label>Step Text</label>
          <textarea name="step_text" required><?php echo htmlspecialchars($step['step_text']); ?></textarea>

          <label>Step Image</label>
          <div class="img-row">
            <img class="current-img" src="<?php echo htmlspecialchars($step['image']); ?>"
                 alt="Current image" id="preview-<?php echo $step['id']; ?>">
            <div class="upload-area">
              <p style="font-size:13px;color:#666;margin-bottom:8px;">
                Current: <code><?php echo htmlspecialchars($step['image']); ?></code>
              </p>
              <input type="file" name="step_image" accept="image/*"
                     onchange="previewImg(this, 'preview-<?php echo $step['id']; ?>')">
              <p style="font-size:12px;color:#999;margin-top:6px;">
                Leave empty to keep current image. Upload to replace it.
              </p>
            </div>
          </div>

          <label>Correct Action Button</label>
          <div class="action-select-wrap">
            <img class="action-icon-preview"
                 id="iconprev-<?php echo $step['id']; ?>"
                 src="<?php echo htmlspecialchars($correctIcon); ?>"
                 alt="icon">
            <select name="correct_action"
                    onchange="updateIconPreview(this, 'iconprev-<?php echo $step['id']; ?>')">
              <?php foreach ($allActions as $aKey => $aIcon): ?>
              <option value="<?php echo htmlspecialchars($aKey); ?>"
                      data-icon="<?php echo htmlspecialchars($aIcon); ?>"
                <?php echo $aKey === $correctAct ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($aKey); ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="submit" class="btn-save">Save Step</button>
        </form>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- ===== ADD NEW STEP ===== -->
  <div class="add-panel">
    <h3>➕ Add New Step</h3>
    <form method="POST" enctype="multipart/form-data" class="edit-form">
      <input type="hidden" name="action" value="add_step">
      <div class="add-grid">
        <div class="full">
          <label>Step Text</label>
          <textarea name="step_text" placeholder="Enter step description..." required></textarea>
        </div>
        <div>
          <label>Step Image</label>
          <input type="file" name="step_image" accept="image/*"
                 onchange="previewImg(this, 'new-preview')">
          <img id="new-preview" style="max-width:160px;max-height:120px;margin-top:8px;display:none;background:#9aa1bf;border-radius:6px;object-fit:contain;">
        </div>
        <div>
          <label>Correct Action Button</label>
          <div class="action-select-wrap">
            <img class="action-icon-preview" id="new-iconprev"
                 src="<?php echo htmlspecialchars(reset($allActions)); ?>" alt="icon">
            <select name="correct_action"
                    onchange="updateIconPreview(this, 'new-iconprev')">
              <?php foreach ($allActions as $aKey => $aIcon): ?>
              <option value="<?php echo htmlspecialchars($aKey); ?>"
                      data-icon="<?php echo htmlspecialchars($aIcon); ?>">
                <?php echo htmlspecialchars($aKey); ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      <button type="submit" class="btn-primary">Add Step</button>
    </form>
  </div>

</div>

<script>
function toggleStep(id) {
  document.getElementById('stepbody-' + id).classList.toggle('open');
}

function previewImg(input, previewId) {
  if (!input.files || !input.files[0]) return;
  const reader = new FileReader();
  reader.onload = e => {
    const img = document.getElementById(previewId);
    img.src = e.target.result;
    img.style.display = 'block';
  };
  reader.readAsDataURL(input.files[0]);
}

function updateIconPreview(select, previewId) {
  const opt  = select.options[select.selectedIndex];
  const icon = opt.getAttribute('data-icon');
  if (icon) document.getElementById(previewId).src = icon;
}
</script>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>