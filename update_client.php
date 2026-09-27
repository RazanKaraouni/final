<?php
require('common/auth.php');
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: clients.php");
    exit;
}

$id = $conn->real_escape_string($_POST['id']);
$clients_name = $conn->real_escape_string($_POST['clients_name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);

$sql = "UPDATE clients SET clients_name = '$clients_name', email = '$email', phone = '$phone' WHERE clients_id = '$id'";
$conn->query($sql);

header("Location: clients.php");
exit;
