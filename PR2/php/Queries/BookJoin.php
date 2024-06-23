<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../Database/Conection.php";


try {
    $sql = "
      SELECT 
          books.id AS book_id, 
          books.title AS book_title, 
          books.author_id, 
          books.category_id, 
          books.published_year, 
          books.page, 
          books.cover_url, 
          books.cover_url2,
          authors.name AS author_name,
          authors.surname AS author_surname,
          categories.title AS category_title 
      FROM 
          books 
      JOIN 
          categories 
      ON 
          books.category_id = categories.id
      JOIN 
          authors
      ON
          books.author_id = authors.id
      WHERE 
          categories.deleted_at IS NULL
          AND authors.deleted_at IS NULL
  ";

    $stmt = $conObj->prepare($sql);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categoriesStmt = $conObj->prepare("SELECT id, title FROM categories WHERE deleted_at IS NULL");
    $categoriesStmt->execute();
    $categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
