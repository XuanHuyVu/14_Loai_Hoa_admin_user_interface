<?php
if (!isset($_GET['id'])) {
    header('Location: ../view/flowers.php');
    exit();
}

$id = $_GET['id'];
try {
    require_once '../data/connect.php';
    $stmt = $conn->prepare("DELETE FROM flowers WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect with success message
    header('Location: ../view/flowers.php?msg=deleted');
    exit();
} catch (PDOException $e) {
    // Redirect with error message
    echo "Lỗi: " . $e->getMessage();
    header('Location: ../view/flowers.php?error=delete_failed');
    exit();
}
?>
