<?php
session_start();
include "db.php";
require_once "log_activity.php";

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Not logged in"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['user_id'];
$quiz_name = $data['quiz_name'];
$steps = $data['steps'];
$total_steps = $data['total_steps'];
$percentage = $data['percentage'];
$mistakes = $data['mistakes'];
$status = $data['status'];

$sql = "
INSERT INTO quiz_scores
(user_id, quiz_name, steps, total_steps, percentage, mistakes, status)
VALUES (?, ?, ?, ?, ?, ?, ?)
ON DUPLICATE KEY UPDATE
steps = VALUES(steps),
total_steps = VALUES(total_steps),
percentage = VALUES(percentage),
mistakes = VALUES(mistakes),
status = VALUES(status),
updated_at = NOW()
";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    exit();
}

mysqli_stmt_bind_param(
    $stmt,
    "isiiiis",
    $user_id,
    $quiz_name,
    $steps,
    $total_steps,
    $percentage,
    $mistakes,
    $status
);

$success = mysqli_stmt_execute($stmt);

if ($success) {
    logActivity(
        $conn,
        $user_id,
        $_SESSION['role'],
        "Completed $quiz_name quiz (Score: $percentage%, Mistakes: $mistakes, Status: $status)",
        "quiz"
    );
}

echo json_encode(["success" => $success]);
