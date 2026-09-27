<?php
require("common/auth.php");
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: products.php");
    exit;
}

$id = (int) ($_POST["id"] ?? 0);
$name = trim($_POST["name"] ?? "");
$description = trim($_POST["description"] ?? "");
$price = $_POST["price"] ?? 0;
$categories_id = (int) ($_POST["categories_id"] ?? 0);
$categories_id = $categories_id > 0 ? $categories_id : null;

if ($id <= 0 || $name === "" || $description === "") {
    header("Location: products.php");
    exit;
}

$stmt = $conn->prepare("SELECT `image` FROM `products` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$current = $stmt->get_result()->fetch_assoc();
$stmt->close();

$imageName = $current["image"] ?? "";
$uploadDir = __DIR__ . "/uploads/products/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    $originalName = basename($_FILES["image"]["name"]);
    $safeName = preg_replace("/[^a-zA-Z0-9._-]/", "", $originalName);
    $newImage = time() . "_" . $safeName;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $newImage)) {
        if (!empty($imageName) && file_exists($uploadDir . $imageName)) {
            unlink($uploadDir . $imageName);
        }
        $imageName = $newImage;
    }
}

$update = $conn->prepare("UPDATE `products` SET `name` = ?, `description` = ?, `price` = ?, `image` = ?, `categories_id` = ? WHERE `id` = ?");
$update->bind_param("ssssii", $name, $description, $price, $imageName, $categories_id, $id);
$update->execute();
$update->close();

header("Location: products.php");
exit;
