<?php
require_once __DIR__ . "/../conn.php";

function portfolio_products(mysqli $conn): array
{
    $sql = "SELECT products.*, categories.categories_name
            FROM products
            LEFT JOIN categories ON products.categories_id = categories.categories_id
            ORDER BY products.id DESC";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function portfolio_image(array $product): string
{
    $image = $product["image"] ?? "";
    if ($image !== "" && is_file(__DIR__ . "/../uploads/products/" . $image)) {
        return "../uploads/products/" . rawurlencode($image);
    }
    return "assets/mug.jpg";
}

function portfolio_price($price): string
{
    return "$" . number_format((float) $price, 2);
}
