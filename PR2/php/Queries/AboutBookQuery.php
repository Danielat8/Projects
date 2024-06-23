<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../Database/Conection.php";

if (!isset($_GET['id'])) {
    "No book ID provided.";
    exit;
}

$bookId = $_GET['id'];
$userId = $_SESSION['id'] ?? null;
$userRole = $_SESSION['role'] ?? null;

try {
    // Fetch book details
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
            books.id = :book_id
    ";

    $stmt = $conObj->prepare($sql);
    $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Book not found.";
        exit;
    }

    // Fetch comments
    $commentsStmt = $conObj->prepare("SELECT * FROM comments WHERE book_id = ?");
    $commentsStmt->execute([$bookId]);
    $comments = $commentsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
// Fetch private notes
$privateNotesStmt = $conObj->prepare("SELECT * FROM private_notes WHERE book_id = ? AND user_id = ?");
$privateNotesStmt->execute([$bookId, $userId]);
$privateNotes = $privateNotesStmt->fetchAll(PDO::FETCH_ASSOC);
