<?php
$message = "";
// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $image = htmlspecialchars(trim($_POST['image']));

    if (empty($name) || empty($description) || empty($image)) {
        $message = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        try {
            require_once '../data/connect.php';
            // Chuẩn bị câu lệnh SQL để chèn dữ liệu
            $sql = "INSERT INTO flowers (name, description, image) VALUES (:name, :description, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            $message = "Thêm thành công!";
        } catch (PDOException $e) {
            $message = "Lỗi: " . $e->getMessage();
        }
        // Đóng kết nối
        $conn = null;
    }
}
?>