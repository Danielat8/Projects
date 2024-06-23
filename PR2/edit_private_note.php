<?php
require_once __DIR__ . "/php/Autoload.php";
require_once __DIR__ . "/php/Database/Conection.php";
require_once __DIR__ . "/php/guards/authentication.php";

checkLogin(false);
// checkLogin(false);

if ($_SESSION['role'] === 'admin') {
    // echo json_encode(['status' => 'error', 'message' => 'Admins cannot delete notes.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $noteId = $_POST['note_id'];
    $newNote = $_POST['new_note'];

    try {
        $stmt = $conObj->prepare("UPDATE private_notes SET note = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        $stmt->execute([$newNote, $noteId, $userId]);
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to edit private note: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
