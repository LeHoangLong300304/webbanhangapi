<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1>Danh sách sản phẩm</h1>
    
    <!-- Nút thêm sản phẩm mới -->
    <a href="/webbanhang/Product/add" class="btn btn-success mb-3">Thêm sản phẩm mới</a>

    <!-- Hiển thị số lượng sản phẩm trong giỏ hàng -->
    <?php 
    $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
    if ($cartCount > 0): ?>
        <p class="text-info">Có <?php echo $cartCount; ?> sản phẩm trong <a href="/webbanhang/Product/cart">giỏ hàng</a>.</p>
    <?php endif; ?>

    <!-- Danh sách sản phẩm -->
    <?php if (!empty($products)): ?>
        <ul class="list-group">
            <?php foreach ($products as $product): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- Hình ảnh sản phẩm -->
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 alt="Product Image" 
                                 style="max-width: 100px; margin-right: 15px;">
                        <?php endif; ?>

                        <!-- Thông tin sản phẩm -->
                        <div>
                            <h2 class="mb-1">
                                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h2>
                            <p class="mb-1"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="mb-1">Giá: <?php echo number_format($product->price, 0, ',', '.') ?> VND</p>
                            <p class="mb-0">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>

                    <!-- Các nút hành động -->
                    <div>
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                           class="btn btn-warning btn-sm mr-2">Sửa</a>
                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" 
                           class="btn btn-danger btn-sm mr-2" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                           class="btn btn-primary btn-sm">Thêm vào giỏ hàng</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted">Hiện tại chưa có sản phẩm nào.</p>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>