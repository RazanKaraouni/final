<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id'])) {
    header("Location: clients.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "DELETE FROM clients WHERE clients_id = '$id'";
$conn->query($sql);

header("Location: clients.php");
exit;
