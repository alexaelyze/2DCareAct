<?php
$host = "localhost";
$user = "your_username";
$pass = "your_password";
$db   = "your_database";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed.");
}
?>
