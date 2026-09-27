<?php
require('common/auth.php');
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: categories.php");
    exit;
}

$categories_name = $conn->real_escape_string($_POST['categories_name']);
$sql = "INSERT INTO categories (categories_name) VALUES ('$categories_name')";
$conn->query($sql);

header("Location: categories.php");
exit;
