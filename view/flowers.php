<?php
require_once '../controller/change_mode.php';
require_once '../controller/pagination.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .admin-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-end mb-4">
            <form method="POST">
                <button type="submit" name="toggleMode" class="btn btn-primary">
                    <i class="bi bi-person-fill-gear me-2"></i>
                    <?php echo ($_SESSION['mode'] === 'admin') ? 'Chế độ người dùng' : 'Chế độ quản trị'; ?>
                </button>
            </form>
        </div>

        <!-- Chế độ User -->
        <?php if ($_SESSION['mode'] === 'user'): ?>
            <div class="row g-4" id="userView">
                <?php foreach ($flowers as $flower): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="../images/<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>"
                                class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                                <p class="card-text"><?php echo $flower['description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php
                                $maxPagesToShow = 5;
                                $halfMax = floor($maxPagesToShow / 2);

                                // Tính toán vùng trang
                                $start = max(1, min($page - $halfMax, $totalPages - $maxPagesToShow + 1));
                                $end = min($totalPages, $start + $maxPagesToShow - 1);

                                // Hiển thị nút đầu và cuối nếu cần thiết
                                $showFirstPage = $start > 1;
                                $showLastPage = $end < $totalPages;
                                ?>

                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php
                                    // Hiển thị nút trang đầu tiên nếu không nằm trong phạm vi
                                    if ($showFirstPage): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=1">1</a>
                                        </li>
                                        <?php if ($start > 2): ?>
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php for ($i = $start; $i <= $end; $i++): ?>
                                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php
                                    // Hiển thị nút trang cuối cùng nếu không nằm trong phạm vi
                                    if ($showLastPage): ?>
                                        <?php if ($end < $totalPages - 1): ?>
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        <?php endif; ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($page < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Chế độ Admin -->
        <?php if ($_SESSION['mode'] === 'admin'): ?>
            <div class="mt-4" id="adminView">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Quản lý danh sách hoa</h4>
                            <button class="btn btn-success">
                                <i class="bi bi-plus-lg me-2"></i>Thêm hoa mới
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark align-middle text-center">
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên hoa</th>
                                        <th>Mô tả</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($flowers)): ?>
                                    <?php foreach ($flowers as $index => $flower): ?>
                                        <tr>
                                            <td class="text-center">
                                                <img src="../images/<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>"
                                                    class="rounded admin-img">
                                            </td>
                                            <td><?php echo $flower['name']; ?></td>
                                            <td><?php echo $flower['description']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="edit.php?id=<?php echo $flower['id']; ?>" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="delete.php?id=<?php echo $flower['id']; ?>" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa hoa này?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <div class="alert alert-warning">Không có hoa nào.</div>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <?php
                                            $maxPagesToShow = 5;
                                            $halfMax = floor($maxPagesToShow / 2);

                                            // Tính toán vùng trang
                                            $start = max(1, min($page - $halfMax, $totalPages - $maxPagesToShow + 1));
                                            $end = min($totalPages, $start + $maxPagesToShow - 1);

                                            // Hiển thị nút đầu và cuối nếu cần thiết
                                            $showFirstPage = $start > 1;
                                            $showLastPage = $end < $totalPages;
                                            ?>

                                            <ul class="pagination justify-content-center">
                                                <?php if ($page > 1): ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php
                                                // Hiển thị nút trang đầu tiên nếu không nằm trong phạm vi
                                                if ($showFirstPage): ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=1">1</a>
                                                    </li>
                                                    <?php if ($start > 2): ?>
                                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php for ($i = $start; $i <= $end; $i++): ?>
                                                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php
                                                // Hiển thị nút trang cuối cùng nếu không nằm trong phạm vi
                                                if ($showLastPage): ?>
                                                    <?php if ($end < $totalPages - 1): ?>
                                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                                    <?php endif; ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($page < $totalPages): ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>