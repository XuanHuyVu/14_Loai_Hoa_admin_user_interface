<?php
try {
    require_once '../data/connect.php';
    $flowersPerPage = 5;

    // Xác định trang hiện tại
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $start = ($page - 1) * $flowersPerPage;

    // Lấy tổng số bài viết
    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM flowers");
    $totalStmt->execute();
    $totalflowers = $totalStmt->fetchColumn();

    $totalPages = ceil($totalflowers / $flowersPerPage);

    // Lấy các bài viết cho trang hiện tại
    $stmt = $conn->prepare("SELECT id,name,description,image FROM flowers ORDER BY id DESC LIMIT :start, :limit");
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $flowersPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    $flowers = [];
}
?>