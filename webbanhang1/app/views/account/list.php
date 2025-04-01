<?php 
include 'app/views/shares/header.php'; 
?>

<div class="container mt-5">

    <!-- Banner Text -->
    <div class="banner-text mb-4 text-center py-4" style="background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%); border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
        <h1 class="display-4 fw-bold" style="color: #fff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">HL Mobile Store</h1>
        <p class="lead" style="color: #fff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Cửa hàng điện thoại và thiết bị công nghệ hàng đầu</p>
    </div>

    <!-- Banner Hình Ảnh -->
    <div class="banner mb-5">
        <img src="/webbanhang/app/images/Capture.png" 
             alt="Banner Khuyến Mãi" 
             class="img-fluid w-100" 
             style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
    </div>

    <!-- Thanh danh mục nằm ngang -->
    <nav class="navbar navbar-expand-lg navbar-light mb-4" style="border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link <?php echo ($_GET['category'] ?? '') === 'tivi' ? 'active' : ''; ?>" href="/webbanhang/Product?category=tivi">Tivi</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_GET['category'] ?? '') === 'headphone' ? 'active' : ''; ?>" href="/webbanhang/Product?category=headphone">Thiết bị âm thanh</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_GET['category'] ?? '') === 'accessory' ? 'active' : ''; ?>" href="/webbanhang/Product?category=accessory">Phụ kiện</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_GET['category'] ?? '') === 'tablet' ? 'active' : ''; ?>" href="/webbanhang/Product?category=tablet">Máy tính bảng</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_GET['category'] ?? '') === 'laptop' ? 'active' : ''; ?>" href="/webbanhang/Product?category=laptop">Laptop</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_GET['category'] ?? '') === 'phone' ? 'active' : ''; ?>" href="/webbanhang/Product?category=phone">Điện thoại</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo empty($_GET['category']) ? 'active' : ''; ?>" href="/webbanhang/Product">Tất cả</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Tiêu đề danh sách sản phẩm -->
    <h2 class="text-center mb-4" style="color: #1a73e8; font-weight: 700;">
        <?php echo isset($_GET['category']) ? 'Sản phẩm: ' . htmlspecialchars(ucfirst(str_replace('-', ' ', $_GET['category']))) : 'Tất cả sản phẩm'; ?>
    </h2>

    <!-- Hiển thị số lượng sản phẩm trong giỏ hàng -->
    <?php 
    $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
    if ($cartCount > 0): ?>
        <p class="text-center text-info mb-4">
            Bạn có <strong><?php echo $cartCount; ?></strong> sản phẩm trong <a href="/webbanhang/Product/cart" class="text-decoration-underline">giỏ hàng</a>.
        </p>
    <?php endif; ?>

    <!-- Danh sách sản phẩm dạng lưới ngang -->
    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Hình ảnh sản phẩm -->
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                 style="object-fit: cover; height: 200px;">
                        <?php endif; ?>

                        <!-- Nội dung sản phẩm -->
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title fw-bold">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                            <p class="card-text text-muted small mb-2">
                                <?php echo htmlspecialchars(substr($product->description, 0, 50), ENT_QUOTES, 'UTF-8'); ?>...
                            </p>
                            <p class="card-text fw-bold text-danger">
                                <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                            </p>
                        </div>

                        <!-- Nút hành động -->
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-primary btn-sm mb-2 w-75">
                                <i class="bi bi-eye"></i> Xem chi tiết
                            </a>
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-sm w-75">
                                <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Hiện tại chưa có sản phẩm nào trong danh mục này.</p>
    <?php endif; ?>

</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- CSS tùy chỉnh -->
<style>
    .product-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>
