<?php
try {
    // Kết nối database
    $conn = new PDO("mysql:host=localhost;dbname=flowers", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>