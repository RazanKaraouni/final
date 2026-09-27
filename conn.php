<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mugStore";

//create connection:
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection:
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE IF NOT EXISTS `users` (
    `users_id` INT NOT NULL AUTO_INCREMENT,
    `usersname` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`users_id`)
)");

$conn->query("CREATE TABLE IF NOT EXISTS `categories` (
    `categories_id` INT NOT NULL AUTO_INCREMENT,
    `categories_name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`categories_id`)
)");

$conn->query("CREATE TABLE IF NOT EXISTS `clients` (
    `clients_id` INT NOT NULL AUTO_INCREMENT,
    `clients_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`clients_id`)
)");

$productsTable = $conn->query("SHOW TABLES LIKE 'products'");
if ($productsTable && $productsTable->num_rows > 0) {
    $categoryColumn = $conn->query("SHOW COLUMNS FROM `products` LIKE 'categories_id'");
    if ($categoryColumn && $categoryColumn->num_rows == 0) {
        $conn->query("ALTER TABLE `products` ADD `categories_id` INT NULL");
    }
}

$adminCheck = $conn->query("SELECT `users_id` FROM `users` LIMIT 1");
if ($adminCheck && $adminCheck->num_rows == 0) {
    $defaultPassword = '$2y$10$FvshBSzE0gz7er75K6Njs.IMouq4h4x2z0ozazeVLxtVUzXZ2egAK';
    $conn->query("INSERT INTO `users` (`usersname`, `password`, `role`) VALUES ('admin', '$defaultPassword', 'admin')");
}
?>