<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";

checkLogin(true);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category_id = $_POST['category_id'];

    if (empty($category_id)) {
        $errors['category_id'] = "Title is required.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO categories (title) VALUES (:title)";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(':title', $category_id, PDO::PARAM_STR);
        $pdo_statement->execute();
        header("Location:Category.php");
    }
}
