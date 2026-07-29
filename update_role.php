<?php
session_start();
include "db.php";

/* ADMIN ONLY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET role=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $role, $id);
    mysqli_stmt_execute($stmt);

    /* OPTIONAL: LOG ACTIVITY */
    $admin_id = $_SESSION['user_id'];
    $action = "Updated user ID $id role to $role";

    $log = "INSERT INTO activity_logs (user_id, action) VALUES (?, ?)";
    $stmt2 = mysqli_prepare($conn, $log);
    mysqli_stmt_bind_param($stmt2, "is", $admin_id, $action);
    mysqli_stmt_execute($stmt2);

    header("Location: admin_users.php");
    exit();
}
?>