<?php
$host = "localhost";
$user = "u707895011_careact";
$pass = "u707895011_CareAct*";
$db   = "u707895011_careact";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
