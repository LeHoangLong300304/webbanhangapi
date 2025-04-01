<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome cho icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        header { background-color: #ffcc00; }
        .form-card { transition: all 0.3s ease; }
        .btn-custom { transition: all 0.3s ease; }
        .btn-custom:hover { transform: scale(1.05); }
    </style>
</head>
<body class="bg-gray-100 font-['Roboto']">
    <!-- Header -->
    <?php include 'app/views/shares/header.php'; ?>

    <div class="container py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6" data-aos="fade-down">Thêm sản phẩm mới</h1>

        <!-- Hiển thị thông báo lỗi PHP (nếu có) -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" data-aos="fade-up">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <div class="card form-card bg-white rounded-lg shadow-md p-6" data-aos="fade-up">
            <form id="add-product-form" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name"
                           value="<?php echo isset($old['name']) ? htmlspecialchars($old['name'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                           class="form-control mt-1 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold">Mô tả:</label>
                    <textarea id="description" name="description"
                              class="form-control mt-1 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                              required><?php echo isset($old['description']) ? htmlspecialchars($old['description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold">Giá:</label>
                    <input type="number" id="price" name="price" step="0.01"
                           value="<?php echo isset($old['price']) ? htmlspecialchars($old['price'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                           class="form-control mt-1 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-semibold">Danh mục:</label>
                    <select id="category_id" name="category_id"
                            class="form-control mt-1 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <!-- JS sẽ load danh mục, nếu không có JS thì PHP fallback -->
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"
                                    <?php echo (isset($old['category_id']) && $old['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option disabled>Đang tải danh mục...</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold">Hình ảnh:</label>
                    <input type="file" id="image" name="image"
                           class="form-control mt-1 rounded-md shadow-sm">
                </div>

                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 btn-custom">
                    <i class="fas fa-plus mr-2"></i>Thêm sản phẩm
                </button>
                <a href="/webbanhang/Product/list"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-600 btn-custom ml-2">
                    <i class="fas fa-arrow-left mr-2"></i>Quay lại
                </a>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'app/views/shares/footer.php'; ?>

    <script>
        AOS.init();

        document.addEventListener("DOMContentLoaded", function() {
            const categorySelect = document.getElementById('category_id');

            // Fetch danh mục từ API
            fetch('/webbanhang/api/category')
                .then(response => response.json())
                .then(data => {
                    categorySelect.innerHTML = ''; // Clear cũ
                    if (data.length === 0) {
                        categorySelect.innerHTML = '<option disabled>Không có danh mục nào</option>';
                    } else {
                        data.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            categorySelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi tải danh mục:', error);
                    categorySelect.innerHTML = '<option disabled>Lỗi tải danh mục</option>';
                });

            // Xử lý submit form
            document.getElementById('add-product-form').addEventListener('submit', function(event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);

                fetch('/webbanhang/api/product', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Phản hồi từ server:', data);

                    if (data.message === 'Product created successfully') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: 'Sản phẩm đã được thêm.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/webbanhang/Product';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: data.message || 'Thêm sản phẩm thất bại'
                        });
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi mạng!',
                        text: 'Không thể kết nối tới server.'
                    });
                });
            });
        });
    </script>
</body>
</html>
