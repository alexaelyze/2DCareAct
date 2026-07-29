<?php
session_start();
include "db.php";

$isInstructor = isset($_SESSION['role']) && $_SESSION['role'] === 'instructor';
$editMode = isset($_GET['edit']) && $_GET['edit'] == 1;

/* SAVE CHANGES */
if ($isInstructor && $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['titles'] as $id => $title) {
        $sql = "UPDATE modules SET title=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $title, $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: modules.php");
    exit();
}

/* GET MODULES */
$result = mysqli_query($conn, "SELECT * FROM modules");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareAct Modules</title>

<style>
:root {
  --primary: #536dfe;
}

* {
  box-sizing: border-box;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
}

body {
  background: #f0f0f0;
}

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

/* CONTAINER */
.container {
  padding: 60px 80px;
}

/* GRID */
.grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 35px;
}

/* CARD */
.card {
  background: var(--primary);
  color: white;
  height: 170px; /* match quizandlab */
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
}

.card:hover {
  transform: scale(1.05);
  opacity: 0.9;
}

.card a {
  color: white;
  text-decoration: none;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* EDIT MODE: rename input inside card */
.card input[type="text"] {
  width: 100%;
  padding: 10px;
  border-radius: 6px;
  border: none;
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  background: rgba(255,255,255,0.9);
  color: #333;
}

/* ACTIONS ROW */
.actions {
  text-align: center;
  margin-top: 10px;
}

.btn-rename {
  background: var(--primary);
  color: white;
  border: 3px solid white;
  padding: 14px 50px;
  border-radius: 50px;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  letter-spacing: 1px;
  margin: 0 10px;
}

.btn-done {
  background: var(--primary);
  color: white;
  border: 3px solid #1a1a1a;
  padding: 14px 50px;
  border-radius: 50px;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  letter-spacing: 1px;
  margin: 0 10px;
}

.btn-rename:hover { background: #3d57e8; }
.btn-done:hover { background: #3d57e8; }

@media (max-width: 900px) {
  .grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .container {
    padding: 30px 20px;
  }
}

/* FOOTER */
footer{
  background: #4f6cf5;
  color: white;
  text-align: center;
  padding: 15px 20px;
  margin-top: 263px;
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

.card-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.module-label {
  background: var(--primary);
  color: white;
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 1px;
  text-transform: uppercase;
  width: 100%;
  text-align: center;
  padding: 10px 20px;
  border-radius: 50px;
  border: 3px solid white;
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
  <form method="POST">

    <div class="grid">
      <?php 
$moduleNum = 1;
while($m = mysqli_fetch_assoc($result)): ?>
<div class="card-wrap">
  <div class="module-label">Module <?php echo $moduleNum; ?></div>
  <div class="card">

    <?php if ($isInstructor && $editMode): ?>
      <input type="text"
             name="titles[<?php echo $m['id']; ?>]"
             value="<?php echo htmlspecialchars($m['title']); ?>">

    <?php else: ?>
      <a href="<?php echo htmlspecialchars($m['link']); ?>">
        <?php echo htmlspecialchars($m['title']); ?>
      </a>
    <?php endif; ?>

  </div>
</div>
<?php 
$moduleNum++;
endwhile; ?>
    </div>

    <?php if ($isInstructor): ?>
    <div class="actions">

      <?php if (!$editMode): ?>
        <!-- Show RENAME button to enter edit mode -->
        <button type="button" class="btn-rename"
                onclick="window.location='modules.php?edit=1'">
          RENAME
        </button>

      <?php else: ?>
        <!-- In edit mode: show RENAME (cancel) and DONE (save) -->
        <button type="button" class="btn-rename"
                onclick="window.location='modules.php'">
          RENAME
        </button>
        <button type="submit" class="btn-done">DONE</button>

      <?php endif; ?>

    </div>
    <?php endif; ?>

  </form>
</div>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>