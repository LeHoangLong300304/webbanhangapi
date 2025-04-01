<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'app/helpers/SessionHelper.php';

// Kiểm tra quyền admin
if (!SessionHelper::isAdmin()) {
    header('Location: /webbanhang/account/login');
    exit;
}

include 'app/views/shares/header.php';
?>

<!-- Nền màu trải rộng đằng sau banner -->
<div class="full-width-bg" style="background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); padding: 60px 0;">
    <div class="container mt-5">
        <!-- Banner Admin -->
        <div class="banner-text mb-5 text-center py-5" style="background: linear-gradient(135deg, rgba(78, 84, 200, 0.9) 0%, rgba(143, 148, 251, 0.9) 100%), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center; background-size: cover; border-radius: 20px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);">
            <h1 class="display-4 fw-bold text-white" style="text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);">HL Mobile Admin</h1>
        </div>
    </div>
</div>

<div class="container">
    <!-- Tabs Điều khiển -->
    <ul class="nav nav-tabs mb-5 justify-content-center" id="adminTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-semibold" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">Sản phẩm</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab">Danh mục</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="accounts-tab" data-bs-toggle="tab" data-bs-target="#accounts" type="button" role="tab">Tài khoản</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">
        <!-- Quản lý Sản phẩm -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold text-dark">Quản lý sản phẩm</h2>
                <a href="/webbanhang/admin/addProduct" class="btn btn-primary shadow-sm"><i class="fas fa-plus me-2"></i> Thêm sản phẩm</a>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($products)): ?>
                                    <tr><td colspan="7" class="py-4 text-muted">Không có sản phẩm nào.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= $product->id ?></td>
                                            <td><?= htmlspecialchars($product->name) ?></td>
                                            <td><?= htmlspecialchars(substr($product->description, 0, 50)) ?>...</td>
                                            <td><?= number_format($product->price, 0, ',', '.') ?> VND</td>
                                            <td><?= htmlspecialchars($product->category_name) ?></td>
                                            <td>
                                                <?php if (!empty($product->image)): ?>
                                                    <img src="/webbanhang/<?= htmlspecialchars($product->image) ?>" alt="Ảnh sản phẩm" class="rounded" style="height: 60px; object-fit: cover;">
                                                <?php else: ?>
                                                    <span class="text-muted">Không có ảnh</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="/webbanhang/admin/editProduct/<?= $product->id ?>" class="btn btn-warning btn-sm me-2 shadow-sm"><i class="fas fa-edit me-1"></i> Sửa</a>
                                                <a href="/webbanhang/admin/deleteProduct/<?= $product->id ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');"><i class="fas fa-trash-alt me-1"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quản lý Danh mục -->
        <div class="tab-pane fade" id="categories" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold text-dark">Quản lý danh mục</h2>
                <a href="/webbanhang/admin/addCategory" class="btn btn-primary shadow-sm"><i class="fas fa-plus me-2"></i> Thêm danh mục</a>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($categories)): ?>
                                    <tr><td colspan="4" class="py-4 text-muted">Không có danh mục nào.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><?= $category->id ?></td>
                                            <td><?= htmlspecialchars($category->name) ?></td>
                                            <td><?= htmlspecialchars($category->description) ?></td>
                                            <td>
                                                <a href="/webbanhang/admin/editCategory/<?= $category->id ?>" class="btn btn-warning btn-sm me-2 shadow-sm"><i class="fas fa-edit me-1"></i> Sửa</a>
                                                <a href="/webbanhang/admin/deleteCategory/<?= $category->id ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');"><i class="fas fa-trash-alt me-1"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quản lý Tài khoản -->
        <div class="tab-pane fade" id="accounts" role="tabpanel">
            <h2 class="h3 fw-bold text-dark mb-4">Quản lý tài khoản</h2>
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Họ tên</th>
                                    <th>Vai trò</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($accounts)): ?>
                                    <tr><td colspan="4" class="py-4 text-muted">Không có tài khoản nào.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($accounts as $account): ?>
                                        <tr>
                                            <td><?= $account->id ?></td>
                                            <td><?= htmlspecialchars($account->username) ?></td>
                                            <td><?= htmlspecialchars($account->fullname) ?></td>
                                            <td><?= htmlspecialchars($account->role) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- Custom Styles -->
<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .full-width-bg {
        width: 100%;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
    }

    .nav-tabs {
        border-bottom: 2px solid #e0e0e0;
    }

    .nav-tabs .nav-link {
        padding: 12px 25px;
        color: #4e54c8;
        border-radius: 8px 8px 0 0;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        background-color: #4e54c8;
        color: white;
        border-color: #4e54c8;
    }

    .nav-tabs .nav-link:hover {
        background-color: #f0f2ff;
        color: #4e54c8;
    }

    .btn-primary {
        background-color: #4e54c8;
        border-color: #4e54c8;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #3d44a6;
        border-color: #3d44a6;
    }

    .btn-warning {
        background-color: #f1c40f;
        border-color: #f1c40f;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #d4ac0d;
        border-color: #d4ac0d;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .table {
        background-color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table-dark {
        background-color: #343a40;
    }
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>