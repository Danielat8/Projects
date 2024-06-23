<?php
require_once __DIR__ . "/php/Autoload.php";
require_once __DIR__ . "/php/Database/Conection.php";
require_once __DIR__ . "/php/guards/authentication.php";

checkLogin(false);

$userId = $_SESSION['id'];
$bookId = $_POST['book_id'];

try {
    $stmt = $conObj->prepare("SELECT * FROM private_notes WHERE book_id = ? AND user_id = ?");
    $stmt->execute([$bookId, $userId]);
    $privateNotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ob_start();
    foreach ($privateNotes as $note) {
?>
        <li data-note-id="<?php echo $note['id']; ?>"><?php echo htmlspecialchars($note['note']); ?>
            <button class="btn btn-danger btn-sm delete-note" data-note-id="<?php echo $note['id']; ?>">Delete</button>
            <button class="btn btn-primary btn-sm edit-note" data-note-id="<?php echo $note['id']; ?>">Edit</button>
        </li>
<?php
    }
    $html = ob_get_clean();

    echo json_encode(['status' => 'success', 'html' => $html]);
    exit;
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch private notes: ' . $e->getMessage()]);
    exit;
}
?>