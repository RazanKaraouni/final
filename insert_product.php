<?php
require("common/auth.php");
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: products.php");
    exit;
}

$name = trim($_POST["name"] ?? "");
$description = trim($_POST["description"] ?? "");
$price = $_POST["price"] ?? 0;
$categories_id = (int) ($_POST["categories_id"] ?? 0);
$categories_id = $categories_id > 0 ? $categories_id : null;

if ($name === "" || $description === "") {
    header("Location: products.php");
    exit;
}

$uploadDir = __DIR__ . "/uploads/products/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$imageName = "";
if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    $originalName = basename($_FILES["image"]["name"]);
    $safeName = preg_replace("/[^a-zA-Z0-9._-]/", "", $originalName);
    $imageName = time() . "_" . $safeName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $imageName);
}

$stmt = $conn->prepare("INSERT INTO `products` (`name`, `description`, `price`, `image`, `categories_id`, `created_at`) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssi", $name, $description, $price, $imageName, $categories_id);
$stmt->execute();
$stmt->close();

header("Location: products.php");
exit;
