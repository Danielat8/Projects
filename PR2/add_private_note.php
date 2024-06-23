<?php
require_once __DIR__ . "/php/Autoload.php";
require_once __DIR__ . "/php/Database/Conection.php";
require_once __DIR__ . "/php/guards/authentication.php";

checkLogin(false);

if ($_SESSION['role'] === 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Admins cannot add notes.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $bookId = $_POST['book_id'];
    $note = $_POST['note'];

    try {
        $stmt = $conObj->prepare("INSERT INTO private_notes (user_id, book_id, note, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$userId, $bookId, $note]);
        $noteId = $conObj->lastInsertId();

        $newNoteStmt = $conObj->prepare("SELECT * FROM private_notes WHERE id = ?");
        $newNoteStmt->execute([$noteId]);
        $newNote = $newNoteStmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'success', 'note' => $newNote]);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add private note: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
