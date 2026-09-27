<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

$sql = "DELETE FROM users WHERE users_id = '$id'";
$conn->query($sql);

header("Location: users.php");
exit;
