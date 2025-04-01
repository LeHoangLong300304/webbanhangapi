<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center py-3">
            <h2 class="mb-0">Chi tiết sản phẩm</h2>
        </div>

        <div class="card-body">
            <?php if ($product): ?>
                <div class="row">
                    <!-- Ảnh sản phẩm -->
                    <div class="col-md-6 text-center mb-4">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                 class="img-fluid rounded shadow-sm" 
                                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            <img src="/webbanhang/images/no-image.png"
                                 class="img-fluid rounded shadow-sm" 
                                 alt="Không có ảnh">
                        <?php endif; ?>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="col-md-6">
                        <h3 class="card-title text-dark font-weight-bold mb-3">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </h3>

                        <p class="card-text mb-4" style="white-space: pre-wrap;">
                            <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                        </p>

                        <p class="text-danger font-weight-bold h4 mb-4">
                            💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </p>

                        <p class="mb-4">
                            <strong>Danh mục:</strong>
                            <span class="badge bg-info text-white p-2">
                                <?php echo !empty($product->category_name) 
                                    ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') 
                                    : 'Chưa có danh mục'; ?>
                            </span>
                        </p>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                               class="btn btn-success px-4 py-2 shadow-sm">
                                ➕ Thêm vào giỏ hàng
                            </a>

                            <!-- Sửa link quay lại danh sách -->
                            <a href="/webbanhang/Product/index"
                               class="btn btn-secondary px-4 py-2 shadow-sm">
                                ⬅️ Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="alert alert-danger text-center">
                    <h4>Không tìm thấy sản phẩm!</h4>
                    <a href="/webbanhang/Product/index" class="btn btn-outline-primary mt-3">
                        ⬅️ Quay lại danh sách
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
