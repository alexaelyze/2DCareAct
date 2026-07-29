<?php
/**
 * module_template.php
 * ---------------------------------------------------------------
 * Universal template for modules 1–8.
 * Copy this file and change ONLY the two constants at the top:
 *   MODULE_ID  — matches the module_id column in module_contents
 *   MODULE_LINK — matches the link column in the modules table
 * ---------------------------------------------------------------
 */
define('MODULE_ID',   'module5');          // ← change per module
define('MODULE_LINK', 'module5.php');      // ← change per module
define('MODULE_NUM',  '5');                // ← change per module (for <title>)

// Special rendering mode for module 3 (infographic — no description bar)
define('IS_INFOGRAPHIC', MODULE_ID === 'module3');

// ---------------------------------------------------------------
session_start();
include "db.php";

$isInstructor = isset($_SESSION['role']) && $_SESSION['role'] === 'instructor';
$editMode     = isset($_GET['edit'])     && $_GET['edit'] == 1;
$moduleFile   = MODULE_LINK;

// ---------- SAVE MODULE TITLE ----------
if ($isInstructor && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['module_title'])) {
    $t = $_POST['module_title'];
    $s = mysqli_prepare($conn, "UPDATE modules SET title=? WHERE link=?");
    mysqli_stmt_bind_param($s, "ss", $t, $moduleFile);
    mysqli_stmt_execute($s);
    header("Location: " . $moduleFile);
    exit();
}

// ---------- DELETE STEP ----------
if ($isInstructor && isset($_GET['delete_step'])) {
    $sid = (int)$_GET['delete_step'];
    $mid = MODULE_ID;
    $s   = mysqli_prepare($conn, "DELETE FROM module_contents WHERE id=? AND module_id=?");
    mysqli_stmt_bind_param($s, "is", $sid, $mid);
    mysqli_stmt_execute($s);
    header("Location: " . $moduleFile . "?edit=1");
    exit();
}

/* ---------- REORDER STEPS ---------- */
if ($isInstructor && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reorder'])) {

    $order = $_POST['order'];

    foreach ($order as $index => $id) {
        $sort = $index + 1;

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE module_contents SET sort_order=? WHERE id=? AND module_id=?"
        );

        $mid = MODULE_ID;
        mysqli_stmt_bind_param($stmt, "iis", $sort, $id, $mid);
        mysqli_stmt_execute($stmt);
    }

    echo json_encode(["success" => true]);
    exit();
}

// ---------- ADD STEP ----------
if ($isInstructor && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['new_image'])) {
    $desc      = trim($_POST['new_description'] ?? '');
    $secLabel  = trim($_POST['new_section_label'] ?? '') ?: null;
    $imgPath   = '';

    if ($_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['png', 'gif'])) {
    header("Location: " . $moduleFile . "?edit=1&err=notpng");
    exit();
}
        $folder = 'm' . MODULE_NUM . '/';
        if (!is_dir($folder)) { mkdir($folder, 0755, true); }
        $filename = 'step_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['new_image']['tmp_name'], $folder . $filename);
        $imgPath = $folder . $filename;
    }

    // Get next sort_order
    $r    = mysqli_query($conn, "SELECT COALESCE(MAX(sort_order),0)+1 AS next FROM module_contents WHERE module_id='" . MODULE_ID . "'");
    $row  = mysqli_fetch_assoc($r);
    $next = (int)$row['next'];

    $s = mysqli_prepare($conn,
        "INSERT INTO module_contents (module_id, image, description, sort_order, section_label)
         VALUES (?, ?, ?, ?, ?)");
    $mid = MODULE_ID;
    mysqli_stmt_bind_param($s, "sssis", $mid, $imgPath, $desc, $next, $secLabel);
    mysqli_stmt_execute($s);
    header("Location: " . $moduleFile . "?edit=1");
    exit();
}

// ---------- UPDATE DESCRIPTION (inline save) ----------
if ($isInstructor && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_desc'])) {
    foreach ($_POST['update_desc'] as $id => $desc) {
        $id   = (int)$id;
        $desc = trim($desc);
        $s    = mysqli_prepare($conn, "UPDATE module_contents SET description=? WHERE id=? AND module_id=?");
        $mid  = MODULE_ID;
        mysqli_stmt_bind_param($s, "sis", $desc, $id, $mid);
        mysqli_stmt_execute($s);
    }
    header("Location: " . $moduleFile . "?edit=1");
    exit();
}

// ---------- FETCH DATA ----------
$titleRes = mysqli_query($conn, "SELECT title FROM modules WHERE link='" . $moduleFile . "'");
$titleRow = mysqli_fetch_assoc($titleRes);
$pageTitle = $titleRow['title'] ?? 'Module ' . MODULE_NUM;

$stepsRes = mysqli_query($conn,
    "SELECT * FROM module_contents WHERE module_id='" . MODULE_ID . "' ORDER BY sort_order ASC");
$steps = [];
while ($row = mysqli_fetch_assoc($stepsRes)) {
    $steps[] = $row;
}

$pngError = isset($_GET['err']) && $_GET['err'] === 'notpng';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Module <?php echo MODULE_NUM; ?> - CareAct</title>

<style>
:root {
  --primary: #536dfe;
  --card-bg: #7a7f9a;
}

* {
  box-sizing: border-box;
  font-family: "Segoe UI", sans-serif;
  margin: 0;
  padding: 0;
}

body { background: #e6e6e6; }

/* HEADER */
header {
  background: var(--primary);
  color: white;
  padding: 20px 40px;
  display: flex;
  align-items: center;
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

nav a:hover {
  text-decoration: underline;
}

.logout {
  background: white;
  color: var(--primary);
  padding: 8px 16px;
  border-radius: 6px;
  font-weight: bold;
}

.logout:hover {
  background: #e0e7ff;
}

/* TITLE BAR */
.title-bar {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 30px 60px 10px 60px;
  flex-wrap: wrap;
}
.module-title-label {
  background: var(--primary);
  color: white;
  display: inline-block;
  padding: 14px 30px;
  font-weight: bold;
  letter-spacing: 1px;
  font-size: 18px;
  text-transform: uppercase;
}
.module-title-input {
  background: var(--primary);
  color: white;
  border: 2px dashed rgba(255,255,255,0.6);
  padding: 14px 20px;
  font-size: 18px;
  font-weight: bold;
  letter-spacing: 1px;
  text-transform: uppercase;
  width: 460px;
  max-width: 100%;
}
.module-title-input::placeholder { color: rgba(255,255,255,0.6); }

/* SECTION LABEL (sub-headings inside content) */
.section-label {
  background: var(--primary);
  color: white;
  display: inline-block;
  padding: 12px 28px;
  margin: 30px 0 10px 0;
  font-weight: bold;
  font-size: 16px;
  white-space: pre-line;
  border-radius: 4px;
}

/* EDIT / DONE buttons */
.btn-edit {
  background: var(--primary); color: white;
  border: none; padding: 12px 36px;
  font-size: 16px; font-weight: bold;
  border-radius: 6px; cursor: pointer; letter-spacing: 1px;
}
.btn-done {
  background: var(--primary); color: white;
  border: 2px solid #222; padding: 12px 36px;
  font-size: 16px; font-weight: bold;
  border-radius: 6px; cursor: pointer; letter-spacing: 1px;
}
.btn-edit:hover, .btn-done:hover { background: #3d57e8; }

/* CONTAINER */
.container { padding: 10px 60px 80px 60px; }

/* STANDARD GRID — 3 columns */
.row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
  margin-bottom: 50px;
}

/* INFOGRAPHIC GRID — 2 columns, wider */
.infographic-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 50px;
  margin-bottom: 60px;
}

/* STEP CARD */
.step { display: flex; flex-direction: column; position: relative; }

.step.dragging {
  opacity: 0.5;
}

.step.over {
  outline: 3px dashed #536dfe;
}

/* DELETE button */
.btn-delete {
  position: absolute; top: -12px; right: -12px;
  width: 30px; height: 30px;
  background: #e53935; color: white;
  border: none; border-radius: 50%;
  font-size: 16px; font-weight: bold;
  cursor: pointer; display: flex;
  align-items: center; justify-content: center;
  z-index: 10; text-decoration: none; line-height: 1;
}
.btn-delete:hover { background: #b71c1c; }

/* IMAGE CARD — flexible height, adapts to image */
.image-card {
  background: var(--card-bg);
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  /* No fixed min-height — image drives the height */
  overflow: hidden;
}

/* Infographic image card — white background like original */
.infographic-card {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Images fill card width, height is natural */
.image-card img,
.infographic-card img {
  width: 100%;
  height: auto;
  object-fit: contain;
  display: block;
}

/* DESCRIPTION */
.description {
  background: var(--primary); color: white;
  padding: 16px 20px; margin-top: 14px;
  font-weight: 600; font-size: 15px;
  text-align: center; line-height: 1.6;
  border-radius: 6px; white-space: pre-line;
}

/* Editable description textarea */
.desc-edit-wrap {
  background: var(--primary);
  margin-top: 14px; border-radius: 6px; padding: 4px;
}
.desc-edit-wrap textarea {
  width: 100%; background: rgba(255,255,255,0.15);
  border: 1px dashed rgba(255,255,255,0.5);
  color: white; font-weight: 600; font-size: 15px;
  text-align: center; line-height: 1.6;
  padding: 12px; border-radius: 4px;
  resize: vertical; font-family: inherit; outline: none;
  min-height: 80px;
}

/* ADD NEW STEP PANEL */
.add-panel {
  background: #d0d5f5;
  border-radius: 10px;
  padding: 30px;
  margin-top: 10px;
  margin-bottom: 40px;
}
.add-panel h3 {
  color: var(--primary); margin-bottom: 20px;
  font-size: 17px; letter-spacing: 0.5px;
}
.upload-slot {
  background: #b0b8d1;
  border-radius: 10px;
  min-height: 180px;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  cursor: pointer; gap: 8px;
  padding: 20px;
  transition: background 0.2s;
}
.upload-slot:hover { background: #9aa3c4; }
.upload-icon { font-size: 40px; }
.upload-hint { font-size: 13px; color: #444; font-weight: 600; }
.upload-slot img { max-width: 100%; max-height: 160px; object-fit: contain; border-radius: 6px; }
.new-desc-input {
  width: 100%; padding: 12px 16px;
  background: var(--primary); color: white;
  border: none; font-size: 14px; font-weight: 600;
  border-radius: 6px; margin-top: 12px;
  font-family: inherit;
}
.new-desc-input::placeholder { color: rgba(255,255,255,0.7); }
.new-section-input {
  width: 100%; padding: 10px 16px;
  background: #3d57e8; color: white;
  border: 1px dashed rgba(255,255,255,0.5);
  font-size: 13px; border-radius: 6px;
  margin-top: 8px; font-family: inherit;
}
.new-section-input::placeholder { color: rgba(255,255,255,0.6); font-style: italic; }
.btn-add {
  background: var(--primary); color: white;
  border: 3px solid white; padding: 12px 40px;
  border-radius: 50px; font-size: 16px;
  font-weight: bold; cursor: pointer;
  letter-spacing: 1px; margin-top: 20px;
  display: block; margin-left: auto; margin-right: auto;
}
.btn-add:hover { background: #3d57e8; }

/* SAVE DESC button */
.btn-save-desc {
  display: block; margin: 0 auto 40px auto;
  background: #4caf50; color: white;
  border: none; padding: 12px 40px;
  border-radius: 50px; font-size: 16px;
  font-weight: bold; cursor: pointer; letter-spacing: 1px;
}
.btn-save-desc:hover { background: #388e3c; }

/* PNG ERROR TOAST */
.toast-error {
  position: fixed; top: 20px; right: 20px;
  background: #e53935; color: white;
  padding: 14px 24px; border-radius: 8px;
  font-weight: bold; font-size: 15px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.2);
  z-index: 9999; animation: fadeOut 4s forwards;
}
@keyframes fadeOut {
  0%   { opacity: 1; }
  70%  { opacity: 1; }
  100% { opacity: 0; pointer-events: none; }
}

@media (max-width: 900px) {
  .container { padding: 0 20px 60px 20px; }
  .title-bar  { padding: 20px 20px 10px 20px; }
  .row, .infographic-row { grid-template-columns: 1fr; }
  .module-title-input { width: 100%; }
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

<!-- PNG ERROR TOAST -->
<?php if ($pngError): ?>
<div class="toast-error" id="pngToast">⚠️ Only PNG and GIF files are supported.</div>
<script>
  setTimeout(function(){ document.getElementById('pngToast').remove(); }, 4000);
</script>
<?php endif; ?>

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

<!-- ===== TITLE BAR ===== -->
<?php if ($isInstructor && $editMode): ?>
  <form method="POST" id="titleForm">
    <div class="title-bar">
      <input class="module-title-input" type="text" name="module_title"
             value="<?php echo htmlspecialchars($pageTitle); ?>"
             placeholder="EDIT TITLE HERE">
      <div style="display:flex;gap:12px;">
        <button type="button" class="btn-edit"
                onclick="window.location='<?php echo $moduleFile; ?>?edit=1'">EDIT</button>
        <button type="submit" class="btn-done">DONE</button>
      </div>
    </div>
  </form>
<?php else: ?>
  <div class="title-bar">
    <div class="module-title-label"><?php echo htmlspecialchars($pageTitle); ?></div>
    <?php if ($isInstructor): ?>
    <button class="btn-edit"
            onclick="window.location='<?php echo $moduleFile; ?>?edit=1'">EDIT</button>
    <?php endif; ?>
  </div>
<?php endif; ?>

<!-- ===== CONTENT ===== -->
<div class="container">

<?php
// ---------------------------------------------------------------
// Render steps
// We chunk into groups of 3 (standard) or 2 (infographic).
// A new section_label on any row triggers a sub-heading banner.
// ---------------------------------------------------------------
$chunkSize   = IS_INFOGRAPHIC ? 2 : 3;
$rowClass    = IS_INFOGRAPHIC ? 'infographic-row' : 'row';
$cardClass   = IS_INFOGRAPHIC ? 'infographic-card' : 'image-card';

// Group steps into rows, inserting section labels at boundaries
// We'll render row by row manually
$i = 0;
$total = count($steps);

while ($i < $total) {
    // Check if the first step of this chunk has a section_label
    if (!empty($steps[$i]['section_label'])) {
        echo '<div class="section-label">' . nl2br(htmlspecialchars($steps[$i]['section_label'])) . '</div>';
    }

    // Open row
    echo '<div class="' . $rowClass . '">';

    $rowSteps = array_slice($steps, $i, $chunkSize);

    foreach ($rowSteps as $step) {
        echo '<div class="step" data-id="' . $step['id'] . '">';

        // Delete button (edit mode only)
        if ($isInstructor && $editMode && $step['id']) {
            echo '<a class="btn-delete" href="' . $moduleFile . '?edit=1&delete_step=' . $step['id'] . '"
                    onclick="return confirm(\'Remove this step?\')">✕</a>';
        }

        // Image card
        echo '<div class="' . $cardClass . '">';
        echo '<img src="' . htmlspecialchars($step['image']) . '" alt="Step image">';
        echo '</div>';

        // Description
        if (!IS_INFOGRAPHIC && !empty($step['description'])) {
            if ($isInstructor && $editMode) {
                // Editable textarea
                echo '<div class="desc-edit-wrap">';
                echo '<textarea name="update_desc[' . $step['id'] . ']" form="descForm">'
                    . htmlspecialchars($step['description']) . '</textarea>';
                echo '</div>';
            } else {
                echo '<div class="description">'
                    . nl2br(htmlspecialchars($step['description']))
                    . '</div>';
            }
        }

        echo '</div>'; // .step

        // Check if the NEXT step has a section_label — if so, end row early
        $nextIdx = $i + array_search($step, $rowSteps) + 1;
        if (isset($steps[$nextIdx]) && !empty($steps[$nextIdx]['section_label'])) {
            // pad remaining cells so grid looks right
            $filled = array_search($step, $rowSteps) + 1;
            for ($p = $filled; $p < $chunkSize; $p++) {
                echo '<div></div>';
            }
            $i = $nextIdx;
            break;
        }
    }

    // Close row if we finished naturally
    if (!isset($steps[$nextIdx]) || empty($steps[$nextIdx]['section_label'])) {
        // Pad if last row is incomplete
        $filled = count($rowSteps);
        for ($p = $filled; $p < $chunkSize; $p++) {
            echo '<div></div>';
        }
        $i += $chunkSize;
    }

    echo '</div>'; // .row
    unset($nextIdx);
}
?>

<?php if ($isInstructor && $editMode): ?>

  <!-- Save description edits -->
  <form method="POST" id="descForm">
    <button type="submit" class="btn-save-desc">Save Description Changes</button>
  </form>

  <!-- Add new step -->
  <form method="POST" enctype="multipart/form-data" id="addForm">
    <div class="add-panel">
      <h3>➕ Add New Step</h3>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;align-items:start;">

        <div>
          <label>
            <div class="upload-slot" id="uploadSlot"
                 onclick="document.getElementById('newImg').click()">
              <div class="upload-icon">🖼️</div>
              <div class="upload-hint">Click to upload PNG/GIF image</div>
            </div>
            <input type="file" name="new_image" id="newImg" accept=".png,.gif"
                   style="display:none"
                   onchange="previewImg(this)">
          </label>
        </div>

        <div>
          <?php if (!IS_INFOGRAPHIC): ?>
          <textarea class="new-desc-input" name="new_description"
                    rows="5" placeholder="Enter step description here..."></textarea>
          <input class="new-section-input" type="text" name="new_section_label"
                 placeholder="Optional: Section sub-heading (e.g. ADULT CPR - TWO RESCUERS)">
          <?php endif; ?>
        </div>

      </div>
      <button type="submit" class="btn-add">+ ADD STEP</button>
    </div>
  </form>

<?php endif; ?>

</div><!-- /container -->

<script>
function previewImg(input) {
  if (!input.files || !input.files[0]) return;
  var file = input.files[0];

  // Client-side PNG check
  const allowed = ['.png', '.gif'];
const fileExt = '.' + file.name.toLowerCase().split('.').pop();
if (!allowed.includes(fileExt)) {
    alert('⚠️ Only PNG and GIF files are supported.');
    input.value = '';
    return;
}

  var reader = new FileReader();
  reader.onload = function(e) {
    var slot = document.getElementById('uploadSlot');
    slot.innerHTML = '<img src="' + e.target.result + '" alt="preview">';
  };
  reader.readAsDataURL(file);
}
</script>

<script>
const canDrag = <?php echo ($isInstructor && $editMode) ? 'true' : 'false'; ?>;

if (canDrag) {

let dragged = null;

const steps = document.querySelectorAll(".step");

steps.forEach(step => {

  step.setAttribute("draggable", "true");

  step.addEventListener("dragstart", () => {
    dragged = step;
    step.classList.add("dragging");
  });

  step.addEventListener("dragend", () => {
    step.classList.remove("dragging");
  });

  step.addEventListener("dragover", (e) => {
    e.preventDefault();
  });

  step.addEventListener("drop", () => {

    if (dragged === step) return;

    const parent = step.parentNode;

    const draggedNext = dragged.nextSibling;

    parent.insertBefore(dragged, step);
    parent.insertBefore(step, draggedNext);

    saveOrder();
  });

});

function saveOrder() {
  let order = [];

  document.querySelectorAll(".step").forEach(step => {
    order.push(step.dataset.id);
  });

  let formData = new FormData();
  formData.append("reorder", 1);

  order.forEach(id => formData.append("order[]", id));

  fetch(window.location.href, {
    method: "POST",
    body: formData
  })
  .then(() => location.reload());
}

}
</script>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>