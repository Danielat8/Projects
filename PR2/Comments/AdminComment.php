<?php
require_once __DIR__ . "/../php/Database/Conection.php";
require_once __DIR__ . "/../php/Autoload.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /../PR2/LoginIndex.php");
    exit();
}

try {

    $stmt = $conObj->prepare("SELECT * FROM comments");
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-5">Manage Comments</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comment['comment']); ?></td>
                        <td>By User <?php echo htmlspecialchars($comment['user_id']); ?> at <?php echo htmlspecialchars($comment['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($comment['status']); ?></td>
                        <td>
                            <?php if ($comment['status'] == 'pending') : ?>
                                <form method="POST" action="UpdateStatus.php" style="display:inline;">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form method="POST" action="UpdateStatus.php" style="display:inline;">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            <?php elseif ($comment['status'] == 'rejected') : ?>
                                <form method="POST" action="UpdateStatus.php" style="display:inline;">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>