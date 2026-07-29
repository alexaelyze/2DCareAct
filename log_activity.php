<?php
function logActivity($conn, $user_id, $role, $action, $page) {

    $sql = "INSERT INTO activity_logs (user_id, role, action, page)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $user_id, $role, $action, $page);
    mysqli_stmt_execute($stmt);
}
?>