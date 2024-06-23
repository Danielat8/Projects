<?php

require_once __DIR__ . "/../php/Database/Conection.php";
require_once __DIR__ . "/../php/Autoload.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /../PR2/LoginIndex.php");
    exit();
}

$comment_id = $_POST['comment_id'];
$status = $_POST['status'];

try {
    $stmt = $conObj->prepare("UPDATE comments SET status = ?, is_approved = ? WHERE id = ?");
    $is_approved = ($status == 'approved') ? 1 : 0;
    $stmt->execute([$status, $is_approved, $comment_id]);
    header("Location: AdminComment.php");
    exit();
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
