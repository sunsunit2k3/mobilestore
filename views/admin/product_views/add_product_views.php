<?php
include_once '../header.php';
include_once __DIR__ . '/../../../controllers/product_controller.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('location:../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>update_product.css">
</head>
<body>
    <div class="container">
    <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
        <h1>Thêm sản phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id">
            
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" require></textarea>

            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" required>

            <label for="quantity">Số lượng:</label>
            <input type="number" id="quantity" name="quantity"  required>

            <label for="category">Danh mục:</label>
            <input type="text" id="category" name="category" required>

            <label for="image">Chọn (Chọn tệp):</label>
            <input type="file" id="image" name="image">
            <button type="submit" name="add" class="btn-submit">Thêm</button>
        </form>
    </div>
</body>
</html>
