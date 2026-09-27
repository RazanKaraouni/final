<?php
require('common/auth.php');
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: users.php");
    exit;
}

$username = $conn->real_escape_string($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = $conn->real_escape_string($password);
$role = $conn->real_escape_string($_POST['role']);

$sql = "INSERT INTO users (usersname, password, role) VALUES ('$username', '$password', '$role')";
$conn->query($sql);

header("Location: users.php");
exit;
