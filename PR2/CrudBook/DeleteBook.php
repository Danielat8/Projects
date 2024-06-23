<?php
require_once __DIR__ . "/../php/Autoload.php";
require_once __DIR__ . "/../php/guards/authentication.php";


checkLogin(true);
// 
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    try {

        $conObj->beginTransaction();

        // Delete comments
        $sql = "DELETE FROM comments WHERE book_id = :book_id";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $pdo_statement->execute();
        // Delete  notes
        $sql = "DELETE FROM private_notes WHERE book_id = :book_id";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $pdo_statement->execute();

        // Delete  book
        $sql = "DELETE FROM books WHERE id = :id";
        $pdo_statement = $conObj->prepare($sql);
        $pdo_statement->bindParam(':id', $book_id, PDO::PARAM_INT);
        $pdo_statement->execute();


        $conObj->commit();


        header("Location: Book.php");
        exit;
    } catch (PDOException $e) {

        $conObj->rollBack();
        die("Error: " . $e->getMessage());
    }
} else {
    die("Invalid book ID.");
}
