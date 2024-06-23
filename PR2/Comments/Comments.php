<?php

require_once __DIR__ . "/../php/Database/Conection.php";
require_once __DIR__ . "/../php/Autoload.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $bookId = $_POST['book_id'];
    $comment = $_POST['comment'];

    try {

        $userCommentStmt = $conObj->prepare("SELECT COUNT(*) as count FROM comments WHERE book_id = ? AND user_id = ?");
        $userCommentStmt->execute([$bookId, $userId]);
        $userCommentCount = $userCommentStmt->fetchColumn();

        if ($userCommentCount == 0) {
            $sql = "INSERT INTO comments (book_id, user_id, comment, is_approved) VALUES (?, ?, ?, 0)";
            $stmt = $conObj->prepare($sql);
            $stmt->execute([$bookId, $userId, $comment]);
        } else {
            echo "You have already commented on this book.";
        }

        header("Location: /../PR2/AboutBook.php?id=" . $bookId);
        exit;
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        die();
    }
} else {
    echo "Unauthorized access.";
}
