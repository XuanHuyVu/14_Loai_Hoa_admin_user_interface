<?php
require_once '../controller/edit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Hoa | Sửa Bài Viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Sửa Bài Viết</h1>

        <?php if (!empty($message)) : ?>
            <div class="alert alert-primary text-center" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="border p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($flower['name']) ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="5" required><?php echo htmlspecialchars($flower['description']) ?? ''?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (URL):</label>
                <input type="text" id="image" name="image" class="form-control" value="<?php echo htmlspecialchars($flower['image']) ?? ''?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary m-1">Sửa bài viết</button>
                <!-- <button type="button" class="btn btn-danger m-1" onclick="window.location.href='flowers.php';">Quay lại</button> -->
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
