<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id'])) {
    header("Location: categories.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "DELETE FROM categories WHERE categories_id = '$id'";
$conn->query($sql);

header("Location: categories.php");
exit;
