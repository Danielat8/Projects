<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";

checkLogin(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $biography = $_POST['biography'];

    $sql = "INSERT INTO  authors (name, surname, biography) VALUES (:name, :surname, :biography)";
    $pdo_statement = $conObj->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
    $stmt->bindParam(':biography', $biography, PDO::PARAM_STR);
    $stmt->execute();
}
$sql = "SELECT * FROM  authors where deleted_at is null";
$pdo_statement = $conObj->prepare($sql);
$pdo_statement->execute();
$authors = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
