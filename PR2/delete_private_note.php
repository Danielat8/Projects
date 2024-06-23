<?php
require_once __DIR__ . "/php/Autoload.php";
require_once __DIR__ . "/php/Database/Conection.php";
require_once __DIR__ . "/php/guards/authentication.php";


if ($_SESSION['role'] === 'admin') {

    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $noteId = $_POST['note_id'];

    try {
        $stmt = $conObj->prepare("DELETE FROM private_notes WHERE id = ? AND user_id = ?");
        $stmt->execute([$noteId, $userId]);
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete private note: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
