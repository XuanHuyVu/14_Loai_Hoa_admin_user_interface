<?php
$message = "";
$flower_id = isset($_GET['id']) ? $_GET['id'] : 0;

try {
    require_once '../data/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST['name']));
        $description = htmlspecialchars(trim($_POST['description']));
        $image = htmlspecialchars(trim($_POST['image']));

        if (empty($name) || empty($description) || empty($image)) {
            $message = "Vui lòng nhập đầy đủ thông tin!";
        } else {
            $stmt = $conn->prepare("UPDATE flowers SET name = :name, description = :description, image = :image WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':id', $flower_id);
            $stmt->execute();
            header("Location: ../view/flowers.php");
        }
    } else {
        $stmt = $conn->prepare("SELECT name, description, image FROM flowers WHERE id = :id");
        $stmt->bindParam(':id', $flower_id);
        $stmt->execute();

        $flower = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$flower) {
            echo "Hoa không tồn tại.";
            exit;
        }
    }
} catch (PDOException $e) {
    $message = "Lỗi: " . $e->getMessage();
} finally {
    $conn = null;
}
?>