<?php
include_once __DIR__ . '/../controllers/product_manager.php';
include_once __DIR__ . '/../controllers/review_manager.php';
include_once __DIR__ . '/../header.php';

if (!isset($_SESSION['user_id'])) {
    $loginRequired = true; 
} else {
    $loginRequired = false;
}
$productId = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

if ($productId > 0) {
    $product = getProductById($productId);
    if (!$product) {
        echo "Sản phẩm không tồn tại.";
        exit;
    }
} else {
    echo "Không tìm thấy sản phẩm.";
    exit;
}

// Hàm lấy đánh giá sản phẩm
$reviews = getReviewsByProductId($productId);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="../css/product_detail.css">
</head>
<body>
    <section class="product-detail">
        <div class="product-detail-container">
            <div class="product-image">
                <img src="<?php echo IMAGES_PATH; ?>product/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="price"><?php echo number_format($product['price'], 0, ',', '.') . " VND"; ?></p>
                <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                <a href="cart.php?&id=<?php echo $product['product_id']; ?>" class="btn">Thêm vào giỏ hàng</a>
            </div>
        </div>

        <div class="reviews">
            <h2>Đánh giá sản phẩm</h2>
            <?php if (count($reviews) > 0): ?>
                <ul class="review-list">
                    <?php foreach ($reviews as $review): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($review['username']); ?></strong>
                            <span class="rating"><?php echo str_repeat('⭐', $review['rating']); ?></span>
                            <p><?php echo htmlspecialchars($review['comment']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Chưa có đánh giá nào.</p>
            <?php endif; ?>
        </div>

        <div class="comment-section">
            <h2>Để lại bình luận</h2>
            <?php if ($loginRequired): ?>
                <p class="login-required">Bạn phải <a href="login.php">đăng nhập</a> và mua hàng để bình luận.</p>
            <?php else: ?>
                <form action="submit_comment.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <div class="star">
                        <p>Chọn sao đánh giá</p>
                        <select name="" id="">
                            <option value="">⭐</option>
                            <option value="">⭐⭐</option>
                            <option value="">⭐⭐⭐</option>
                            <option value="">⭐⭐⭐⭐</option>
                            <option value="">⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>
                    <textarea name="comment" placeholder="Nhập bình luận của bạn..." required></textarea>
                    <button type="submit" class="btn">Gửi</button>
                </form>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>