<?php
// Bao gồm lớp SessionHelper để sử dụng trong header
require_once 'app/helpers/SessionHelper.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50;
            transition: color 0.3s;
        }
        .navbar-brand:hover {
            color: #3498db;
        }
        .nav-link {
            color: #34495e;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .nav-link:hover {
            background-color: #e9ecef;
            color: #2980b9;
        }
        .container {
            margin-top: 2rem;
        }
        .product-image {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
        }
        /* Gradient background cho body */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .logo {
            width: 40px; /* Kích thước logo */
            height: auto;
            margin-right: 10px; /* Khoảng cách giữa logo và tên */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a href="/webbanhang/Product/" class="d-flex align-items-center text-decoration-none">
                <img src="/webbanhang/app/images/eee.png" alt="Logo" class="logo"> <!-- Đường dẫn logo -->
                <span class="navbar-brand">Quản lý sản phẩm</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/">Danh sách sản phẩm</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/cart">
                            <i class="bi bi-cart"></i> Giỏ hàng
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <span class="badge bg-danger"><?php echo count($_SESSION['cart']); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link'>" . $_SESSION['username'] . "</a>";
                        } else {
                            echo "<a class='nav-link' href='/webbanhang/account/login'>Login</a>";
                        }
                        ?>
                    </li>
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/webbanhang/account/logout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Nội dung chính của trang sẽ được thêm ở đây -->
    </div>

    <!-- Thêm script Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>