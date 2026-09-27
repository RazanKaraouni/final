<?php
require('common/auth.php');
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: users.php");
    exit;
}

$id = $conn->real_escape_string($_POST['id']);
$username = $conn->real_escape_string($_POST['username']);
$role = $conn->real_escape_string($_POST['role']);

$sql = "UPDATE users SET usersname = '$username', role = '$role' WHERE users_id = '$id'";
$conn->query($sql);

header("Location: users.php");
exit;
