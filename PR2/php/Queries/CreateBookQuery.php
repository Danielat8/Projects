<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../guards/authentication.php";

checkLogin(true);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $published_year = $_POST['published_year'];
    $page = $_POST['page'];
    $cover_url = $_POST['cover_url'];
    $cover_url2 = $_POST['cover_url2'];

    if (empty($title)) {
        $errors['title'] = "Title is required.";
    }
    if (empty($author_id)) {
        $errors['author_id'] = "Author ID is required.";
    }
    if (empty($category_id)) {
        $errors['category_id'] = "Category ID is required.";
    }
    if (empty($published_year)) {
        $errors['published_year'] = "Published Year is required.";
    } elseif (!filter_var($published_year, FILTER_VALIDATE_INT)) {
        $errors['published_year'] = "Published Year must be an integer.";
    }
    if (empty($page)) {
        $errors['page'] = "Page is required.";
    } elseif (!filter_var($page, FILTER_VALIDATE_INT)) {
        $errors['page'] = "Page must be an integer.";
    }
    if (empty($cover_url)) {
        $errors['cover_url'] = "Cover URL is required.";
    } elseif (!filter_var($cover_url, FILTER_VALIDATE_URL)) {
        $errors['cover_url'] = "Cover URL must be a valid URL.";
    }
    if (empty($cover_url2)) {
        $errors['cover_url2'] = "Cover URL2 is required.";
    } elseif (!filter_var($cover_url2, FILTER_VALIDATE_URL)) {
        $errors['cover_url2'] = "Cover URL2 must be a valid URL.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO books (title, author_id, category_id, published_year, page, cover_url, cover_url2) VALUES (:title, :author_id, :category_id, :published_year, :page, :cover_url, :cover_url2)";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(':title', $title, PDO::PARAM_STR);
        $pdo_statement->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $pdo_statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $pdo_statement->bindParam(':published_year', $published_year, PDO::PARAM_INT);
        $pdo_statement->bindParam(':page', $page, PDO::PARAM_INT);
        $pdo_statement->bindParam(':cover_url', $cover_url, PDO::PARAM_STR);
        $pdo_statement->bindParam(':cover_url2', $cover_url2, PDO::PARAM_STR);

        try {
            $pdo_statement->execute();
            header("Location: Book.php");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
