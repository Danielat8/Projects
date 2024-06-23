<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";

checkLogin(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $published_year = $_POST['published_year'];
    $page = $_POST['page'];
    $cover_url = $_POST['cover_url'];
    $cover_url2 = $_POST['cover_url2'];


    $sql = "INSERT INTO  books (title, author_id, category_id , published_year,page,cover_url,cover_url2) VALUES (:title, :author_id, :category_id, :published_year,:page,:cover_url,:cover_url2)";
    $pdo_statement = $conObj->prepare($sql);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':author_id', $author_id, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_STR);
    $stmt->bindParam(':published_year', $published_year, PDO::PARAM_STR);
    $stmt->bindParam(':page', $page, PDO::PARAM_STR);
    $stmt->bindParam(':cover_url', $cover_url, PDO::PARAM_STR);
    $stmt->bindParam(':cover_url2', $cover_url2, PDO::PARAM_STR);
    $stmt->execute();
}
$sql = "SELECT * FROM  books";
$pdo_statement = $conObj->prepare($sql);
$pdo_statement->execute();
$books = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
