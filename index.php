<?php
include 'controllers/product_manager.php'; // Giả sử file này chứa các hàm quản lý sản phẩm như getAllProducts()
include 'header.php'; // Giả sử đây là phần header của trang web
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Online</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="main-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><span class="icon">💻</span>Laptop Cũ</li>
            <li><span class="icon">📱</span>Điện thoại Cũ</li>
            <li><span class="icon">🎮</span>Phụ kiện Gaming</li>
            <li><span class="icon">📟</span>Phụ kiện Điện Thoại</li>
            <li><span class="icon">👗</span>Phụ kiện Thời Trang</li>
            <li><span class="icon">🏠</span>Gia Dụng Thông Minh</li>
            <li><span class="icon">🔖</span>Outlet – Xả Tồn</li>
            <li><span class="icon">📦</span>Pre-order</li>
        </ul>
    </aside>

    <!-- Banner Carousel -->
    <section class="banner-carousel">
        <div class="carousel-container">
            <!-- Banner 1 -->
            <div class="banner">
                <img src="./assets/banner/banner1.png" alt="Dell Precision 5530" class="banner-image">
            </div>
            <!-- Banner 2 -->
            <div class="banner">
                <img src="./assets/banner/banner2.png" alt="Dell Latitude 5400" class="banner-image">
            </div>
            <!-- Banner 3 -->
            <div class="banner">
                <img src="./assets/banner/banner3.png" alt="Asus TUF Gaming" class="banner-image">
            </div>
        </div>
        <!-- Navigation Buttons -->
        <button class="carousel-btn prev">⟨</button>
        <button class="carousel-btn next">⟩</button>
    </section>

    <!-- Right Sidebar -->
    <aside class="right-sidebar">
        <div class="ad-item">
            <img src="./assets/news/news1.png" alt="Gaming Items">
        </div>
        <div class="ad-item">
            <img src="./assets/news/news2.jpg" alt="Tech News">
        </div>
    </aside>
</main>

<!-- Product Section -->
<section class="product-section">
    <?php 
    $products = getAllProducts(); // Hàm lấy tất cả sản phẩm
    foreach ($products as $product): ?>
        <article class="product">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo number_format($product['price'], 0, ',', '.') . " VND"; ?></p>
        </article>
    <?php endforeach; ?>
</section>
<?php include 'footer.php'; ?>
</body>
</html>
