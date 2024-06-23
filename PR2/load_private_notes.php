<?php
require_once __DIR__ . "/php/Autoload.php";
require_once __DIR__ . "/php/Database/Conection.php";
require_once __DIR__ . "/php/guards/RequireAdmin.php";
LoginAdmin(false);

if ($_SESSION['role'] === 'admin') {

    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $bookId = $_POST['book_id'];

    try {
        $stmt = $conObj->prepare("SELECT * FROM private_notes WHERE user_id = ? AND book_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId, $bookId]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($notes as $note) {
?> <li id='note-<?= $note['id'] ?>'> <span> <?= htmlspecialchars($note['note']) ?> </span>
                <button class='btn btn-sm btn-danger delete-note' data-note-id='<?= $note['id'] ?>'>Delete</button>
                <button class='btn btn-sm btn-primary edit-note-btn' data-note-id='<?= $note['id'] ?>'>Edit</button>
            </li>
<?php
        }
    } catch (PDOException $e) {
        echo "Failed to load private notes: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
