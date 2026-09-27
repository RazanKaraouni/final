<?php
require("common/auth.php");
include("conn.php");

$id = (int) ($_GET["product_id"] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("SELECT `image` FROM `products` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $delete = $conn->prepare("DELETE FROM `products` WHERE `id` = ?");
    $delete->bind_param("i", $id);
    $delete->execute();
    $delete->close();

    if ($product && !empty($product["image"])) {
        $imagePath = __DIR__ . "/uploads/products/" . $product["image"];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

header("Location: products.php");
exit;
