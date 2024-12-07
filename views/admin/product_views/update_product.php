<?php
include_once '../header.php';
include_once __DIR__ . '/../../../controllers/product_controller.php';
$product_id = $_GET['product_id'] ?? null;
if ($product_id) {
    $product = getProductByField("product_id", $product_id);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>update_product.css">
</head>
<body>
    <div class="container">
        <h1>Cập nhật sản phẩm</h1>
        <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
        <?php if ($product): ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>

                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>

                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

                <label for="category">Danh mục:</label>
                <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>" required>

                <label for="image">Ảnh hiện tại:</label>
                <img src="<?php echo IMAGES_PATH?>product/<?php echo $product["image"]?>" alt="">
                <label for="image">Thay đổi ảnh (Chọn tệp):</label>
                <input type="file" id="image" name="image">
                <button type="submit" name="update" class="btn-submit">Cập nhật</button>
            </form>
        <?php else: ?>
            <p class="error">Không tìm thấy sản phẩm với ID: <?php echo htmlspecialchars($product_id); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
