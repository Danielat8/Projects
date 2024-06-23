<?php
require_once __DIR__ . "/../php/Autoload.php";
require_once __DIR__ . "/../php/guards/authentication.php";

checkLogin(true);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $authorId = $_GET["id"];
    $sql = "UPDATE authors SET deleted_at = NOW() WHERE id = :id";
    $pdo_statement = $conObj->prepare($sql);
    $pdo_statement->bindParam(":id", $authorId, PDO::PARAM_INT);
    $authSoftDeleted = $pdo_statement->execute();
    if (!$authSoftDeleted) {
        echo "Something went wrong when deleting the author, please try again later.";
    } else {
        header("Location: Author.php");
    }
}
