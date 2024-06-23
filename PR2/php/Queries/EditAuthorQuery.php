<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";


checkLogin(true);

if (isset($_GET['id'])) {
    $authorid = $_GET['id'];
}

$sql = "SELECT * FROM authors WHERE id = :id ";
$pdo_statement = $conObj->prepare($sql);
$pdo_statement->bindParam(":id", $authorid, PDO::PARAM_INT);
$pdo_statement->execute();
$authors = $pdo_statement->fetch(PDO::FETCH_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $biography = $_POST['biography'];

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }
    if (empty($surname)) {
        $errors['surname'] = "Surname is required.";
    }
    if (empty($biography)) {
        $errors['biography'] = "Biography is required.";
    } elseif (strlen($biography) < 20) {
        $errors['biography'] = "Biography must be at least 20 characters.";
    }

    if (empty($errors)) {
        $sql = "UPDATE authors SET name = :name , surname = :surname , biography = :biography WHERE id = :id";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(":id", $authorid, PDO::PARAM_INT);
        $pdo_statement->bindParam(':name', $name, PDO::PARAM_STR);
        $pdo_statement->bindParam(':surname', $surname, PDO::PARAM_STR);
        $pdo_statement->bindParam(':biography', $biography, PDO::PARAM_STR);
        $pdo_statement->execute();
        header("Location:Author.php");
    }
}
