<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";

checkLogin(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $sql = "INSERT INTO categories (title) VALUES (:title)";
    $pdo_statement = $conObj->prepare($sql);
    $pdo_statement->bindParam(":title", $title, PDO::PARAM_STR);
    $pdo_statement->execute();
}
$sql = "SELECT * FROM categories WHERE deleted_at is NULL";
$pdo_statement = $conObj->prepare($sql);
$pdo_statement->execute();
$categories = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
