<?php
require_once __DIR__ . "/../php/Autoload.php";
require_once __DIR__ . "/../php/Database/Conection.php";
require_once __DIR__ . "/../php/guards/authentication.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];
    $userId = $_SESSION['id'] ?? null;
    $userRole = $_SESSION['role'] ?? null;

    try {

        $checkStmt = $conObj->prepare("SELECT user_id, is_approved FROM comments WHERE id = ?");
        $checkStmt->execute([$commentId]);
        $comment = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$comment) {
            echo "Comment not found.";
            exit;
        }


        if ($userRole === 'admin') {
            if ($comment['user_id'] == $userId) {
                $deleteStmt = $conObj->prepare("DELETE FROM comments WHERE id = ?");
                $deleteStmt->execute([$commentId]);
            } else {
                echo "Unauthorized to delete this comment.";
                exit;
            }
        }

        if ($comment['user_id'] == $userId) {
            $deleteStmt = $conObj->prepare("DELETE FROM comments WHERE id = ?");
            $deleteStmt->execute([$commentId]);
            echo "Comment deleted successfully.";
        } else {
            echo "Unauthorized to delete this comment.";
            exit;
        }

        header("Location: /../PR2/AboutBook.php?id=" . $_POST['book_id']);
        exit;
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        die();
    }
} else {
    echo "Invalid request.";
}
