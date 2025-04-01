<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold" style="color: #ff6b81; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        <i class="bi bi-cart3 me-2"></i> Giỏ hàng của bạn
    </h1>

    <?php if (!empty($cart)): ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <ul class="list-group list-group-flush">
                        <?php $total = 0; ?>
                        <?php foreach ($cart as $id => $item): ?>
                            <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                            <li class="list-group-item py-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    <?php if ($item['image']): ?>
                                        <img src="/webbanhang/<?php echo htmlspecialchars($item['image']); ?>" 
                                             alt="Product Image" 
                                             class="img-thumbnail me-3 rounded" 
                                             style="width: 100px; height: 100px; object-fit: cover; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                    <?php endif; ?>
                                    <div>
                                        <h5 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                        <p class="mb-1">Giá: <span class="fw-bold text-danger price" data-price="<?php echo $item['price']; ?>"><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</span></p>
                                        <div class="d-flex align-items-center">
                                            <label for="quantity-<?php echo $id; ?>" class="me-2 mb-0 text-muted">Số lượng:</label>
                                            <input type="number" 
                                                   id="quantity-<?php echo $id; ?>" 
                                                   class="form-control quantity" 
                                                   name="quantity" 
                                                   value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                   min="1" 
                                                   data-id="<?php echo $id; ?>" 
                                                   style="width: 80px; border-radius: 8px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <p class="subtotal fs-5 text-primary" id="subtotal-<?php echo $id; ?>">
                                        <?php echo number_format($subtotal, 0, ',', '.'); ?> VND
                                    </p>
                                    <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" class="text-danger small" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 p-4 rounded-3 sticky-top" style="top: 20px;">
                    <h4 class="mb-4 fw-bold text-dark">Tổng thanh toán</h4>
                    <h3 id="total" class="text-success mb-4 fw-bold"><?php echo number_format($total, 0, ',', '.'); ?> VND</h3>
                    <div class="d-grid gap-3">
                        <a href="/webbanhang/Product/checkout" class="btn btn-success btn-lg rounded-pill" style="background: #28a745; border: none; transition: all 0.3s;">
                            <i class="bi bi-credit-card me-2"></i> Thanh toán ngay
                        </a>
                        <a href="/webbanhang/Product/updateCart" id="continue-shopping" class="btn btn-outline-dark btn-lg rounded-pill" style="transition: all 0.3s;">
                            <i class="bi bi-arrow-left me-2"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-5 rounded-3 shadow-sm">
            <i class="bi bi-cart-x fs-1 mb-3"></i>
            <p class="fs-4">Giỏ hàng của bạn đang trống.</p>
            <a href="/webbanhang/Product" class="btn btn-primary mt-3 rounded-pill px-4" style="background: #ff6b81; border: none;">
                <i class="bi bi-bag-plus me-2"></i> Mua sắm ngay
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- JavaScript cập nhật tổng tiền và lưu số lượng -->
<script>
    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('change', function() {
            let quantity = parseInt(this.value);
            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                this.value = quantity;
            }

            const price = parseFloat(this.closest('li').querySelector('.price').dataset.price);
            const subtotal = quantity * price;
            const productId = this.dataset.id;

            // Cập nhật subtotal trên giao diện
            this.closest('li').querySelector('.subtotal').innerText = subtotal.toLocaleString('vi-VN') + ' VND';

            // Gửi yêu cầu AJAX để cập nhật số lượng trong session
            fetch('/webbanhang/Product/updateCartQuantity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateTotal();
                } else {
                    alert('Cập nhật số lượng thất bại!');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(subtotal => {
            const subtotalValue = parseInt(subtotal.innerText.replace(/[^0-9]/g, ''));
            total += subtotalValue;
        });
        document.getElementById('total').innerText = total.toLocaleString('vi-VN') + ' VND';
    }

    // Khởi tạo tổng khi load trang
    updateTotal();

    // Xử lý nút "Tiếp tục mua sắm"
    document.getElementById('continue-shopping').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '/webbanhang/Product'; // Chuyển hướng mà không reset giỏ hàng
    });
</script>

<!-- CSS tùy chỉnh -->
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .list-group-item {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    .btn-outline-dark:hover {
        background-color: #343a40;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #e65b70;
        transform: scale(1.05);
    }

    .text-danger a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .list-group-item {
            padding: 15px;
        }

        .img-thumbnail {
            width: 80px;
            height: 80px;
        }

        .quantity {
            width: 60px;
        }
    }
</style>