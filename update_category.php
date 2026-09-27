<?php
require('common/auth.php');
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: categories.php");
    exit;
}

$id = $conn->real_escape_string($_POST['id']);
$categories_name = $conn->real_escape_string($_POST['categories_name']);

$sql = "UPDATE categories SET categories_name = '$categories_name' WHERE categories_id = '$id'";
$conn->query($sql);

header("Location: categories.php");
exit;
