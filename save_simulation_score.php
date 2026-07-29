<?php
session_start();
include "db.php";
require_once "log_activity.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success"=>false]);
    exit();
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents("php://input"), true);

$simulation_name = $data['simulation_name'];
$steps = $data['steps'];
$total_steps = $data['total_steps'];
$percentage = $data['percentage'];
$mistakes = $data['mistakes'];
$status = $data['status'];

/* CHECK */
$check = "SELECT id FROM simulation_scores WHERE user_id=? AND simulation_name=?";
$stmt = mysqli_prepare($conn,$check);
mysqli_stmt_bind_param($stmt,"is",$user_id,$simulation_name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

/* UPDATE */
if(mysqli_num_rows($result) > 0){

$sql = "UPDATE simulation_scores
SET steps=?, total_steps=?, percentage=?, mistakes=?, status=?
WHERE user_id=? AND simulation_name=?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"iiiisis",
$steps,$total_steps,$percentage,$mistakes,$status,$user_id,$simulation_name);

}

/* INSERT */
else{

$sql = "INSERT INTO simulation_scores
(user_id,simulation_name,steps,total_steps,percentage,mistakes,status)
VALUES (?,?,?,?,?,?,?)";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"isiiiis",
$user_id,$simulation_name,$steps,$total_steps,$percentage,$mistakes,$status);
}

/* EXECUTE */
mysqli_stmt_execute($stmt);

/* 🔥 LOG */
logActivity(
    $conn,
    $user_id,
    $_SESSION['role'],
    "Completed $simulation_name (Score: $percentage%, Mistakes: $mistakes, Status: $status)",
    "simulation"
);

echo json_encode(["success"=>true]);