<?php
require_once 'app/helpers/SessionHelper.php';
include 'app/views/shares/header.php';
?>

<div class="container mt-5">

    <!-- Banner Text -->
    <div class="banner-text mb-4 text-center py-5" style="background: linear-gradient(135deg, #ff6b81 0%, #ffb199 100%); border-radius: 20px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);">
        <h1 class="display-4 fw-bold text-white" style="text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);">HL Mobile Store</h1>
        <p class="lead text-white mb-0" style="font-size: 1.25rem; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">Cửa hàng điện thoại và thiết bị công nghệ hàng đầu</p>
    </div>

    <!-- Banner Hình Ảnh -->
    <div class="banner mb-5">
        <img src="/webbanhang/app/images/Capture.png" alt="Banner Khuyến Mãi" class="img-fluid w-100" style="border-radius: 20px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);">
    </div>

    <!-- Thanh danh mục nằm ngang -->
    <nav class="navbar navbar-expand-lg navbar-light mb-5 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #ff6b81 0%, #ffb199 100%);">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav d-flex gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link active" href="#" onclick="loadProductsByCategory('all', this)">Tất cả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link" href="#" onclick="loadProductsByCategory('phone', this)">Điện thoại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link" href="#" onclick="loadProductsByCategory('laptop', this)">Laptop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link" href="#" onclick="loadProductsByCategory('tablet', this)">Máy tính bảng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link" href="#" onclick="loadProductsByCategory('accessory', this)">Phụ kiện</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link" href="#" onclick="loadProductsByCategory('headphone', this)">Thiết bị âm thanh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold category-link" href="#" onclick="loadProductsByCategory('tivi', this)">Tivi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

    <!-- Tiêu đề danh sách sản phẩm -->
    <h2 class="text-center mb-5" style="color: #ff6b81; font-weight: 700; letter-spacing: 1px;">
        Danh sách sản phẩm
    </h2>

    <!-- Danh sách sản phẩm -->
    <div id="product-list" class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <!-- Các sản phẩm sẽ được render tại đây -->
    </div>

</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- CSS Tùy chỉnh -->
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .nav-link.category-link {
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .nav-link.category-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .nav-link.category-link.active {
        background-color: #fff;
        color: #ff6b81 !important;
        font-weight: bold;
    }

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .btn-outline-dark:hover {
        background-color: #34495e;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #e65b70;
        transform: scale(1.05);
    }
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script fetch API sản phẩm -->
<script>
    function loadProductsByCategory(category, element) {
        // Bỏ class active khỏi tất cả link
        const categoryLinks = document.querySelectorAll('.category-link');
        categoryLinks.forEach(link => link.classList.remove('active'));

        // Thêm class active cho link vừa click
        if (element) {
            element.classList.add('active');
        }

        // Xây dựng URL API theo danh mục
        let url = '/webbanhang/api/product';
        if (category !== 'all') {
            url += `?category=${category}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const productList = document.getElementById('product-list');
                productList.innerHTML = '';

                if (data.length === 0) {
                    productList.innerHTML = `
                        <p class="text-center text-muted py-5" style="font-size: 1.2rem;">
                            Không có sản phẩm nào trong danh mục này.
                        </p>`;
                    return;
                }

                data.forEach(product => {
                    const col = document.createElement('div');
                    col.className = 'col';
                    col.innerHTML = `
                        <div class="card h-100 shadow-sm border-0 product-card" style="border-radius: 15px; overflow: hidden; background: #fff;">
                            <div class="position-relative">
                                <img src="/webbanhang/${product.image}" class="card-img-top" alt="${product.name}" style="object-fit: cover; height: 220px;">
                            </div>
                            <div class="card-body text-center py-4">
                                <h5 class="card-title fw-bold text-dark" style="font-size: 1.25rem; line-height: 1.2;">${product.name}</h5>
                                <p class="card-text text-muted small mb-3" style="font-size: 0.9rem;">
                                    ${product.description.substring(0, 50)}...
                                </p>
                                <p class="card-text fw-bold text-danger" style="font-size: 1.3rem;">
                                    ${Number(product.price).toLocaleString('vi-VN')} VND
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pb-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="/webbanhang/Product/show/${product.id}" class="btn btn-outline-dark btn-sm px-3 py-2" style="border-radius: 25px;">
                                        <i class="bi bi-eye me-1"></i> Xem
                                    </a>
                                    <a href="/webbanhang/Product/addToCart/${product.id}" class="btn btn-primary btn-sm px-3 py-2" style="border-radius: 25px; background: #ff6b81; border: none;">
                                        <i class="bi bi-cart-plus me-1"></i> Giỏ hàng
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                    productList.appendChild(col);
                });
            })
            .catch(error => {
                console.error('Lỗi khi load sản phẩm:', error);
            });
    }

    // Mặc định load tất cả sản phẩm khi vào trang
    document.addEventListener("DOMContentLoaded", function () {
        loadProductsByCategory('all', document.querySelector('.category-link.active'));
    });
</script>
