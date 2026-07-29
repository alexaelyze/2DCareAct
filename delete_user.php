<?php
session_start();
include "db.php";

/* CHECK ADMIN ACCESS */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    /* PREVENT ADMIN FROM DELETING SELF */
    if ($id == $_SESSION['user_id']) {
        die("You cannot delete your own account.");
    }

    /* DELETE USER */
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: admin_users.php");
exit();
?>