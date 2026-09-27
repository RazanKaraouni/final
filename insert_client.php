<?php
require('common/auth.php');
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: clients.php");
    exit;
}

$clients_name = $conn->real_escape_string($_POST['clients_name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);

$sql = "INSERT INTO clients (clients_name, email, phone) VALUES ('$clients_name', '$email', '$phone')";
$conn->query($sql);

header("Location: clients.php");
exit;
