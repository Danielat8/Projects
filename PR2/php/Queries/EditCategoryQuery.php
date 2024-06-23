<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";

checkLogin(true);


if (isset($_GET['id'])) {
    $userId = $_GET['id'];
}

$sql = "SELECT * FROM categories WHERE id = :id";
$pdo_statement = $conObj->prepare($sql);
$pdo_statement->bindParam(":id", $userId, PDO::PARAM_INT);
$pdo_statement->execute();
$title = $pdo_statement->fetch(PDO::FETCH_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category_id = $_POST['category_id'];

    if (empty($category_id)) {
        $errors['category_id'] = "Title is required.";
    }

    if (empty($errors)) {
        $sql = "UPDATE categories SET title = :title WHERE id = :id";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(":id", $userId, PDO::PARAM_INT);
        $pdo_statement->bindParam(':title', $category_id, PDO::PARAM_STR);
        $pdo_statement->execute();
        header("Location:Category.php");
    }
}
