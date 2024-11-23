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
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<main class="main-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><span class="icon">💻</span>Laptop</li>
            <li><span class="icon">📱</span>Điện thoại</li>
            <li><span class="icon">🎮</span>Phụ kiện Gaming</li>
            <li><span class="icon">📟</span>Phụ kiện Điện Thoại</li>
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

<?php
// Đặt số lượng sản phẩm hiển thị trên mỗi trang
$productsPerPage = 12;

// Xác định trang hiện tại từ tham số URL, mặc định là trang 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $productsPerPage;

// Truy vấn lấy sản phẩm giới hạn với LIMIT và OFFSET
$products = getProductsByLimit($start, $productsPerPage); // Hàm lấy sản phẩm theo giới hạn
?>

<section class="product-section">
    <?php foreach ($products as $product): ?>
        <article class="product">
            <img src="./assets/product/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p><?php echo number_format($product['price'], 0, ',', '.') . " VND"; ?></p>
            <button class="btn">Mua hàng</button>
        </article>
    <?php endforeach; ?>
</section>

<div class="pagination">
    <?php 
    // Tính tổng số sản phẩm và số trang
    $totalProducts = getTotalProductCount(); // Hàm đếm tổng số sản phẩm
    $totalPages = ceil($totalProducts / $productsPerPage);
    // Hiển thị các liên kết phân trang
    if ($totalPages > 1): ?>
        <ul class="pagination-list">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="pagination-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a href="?page=<?php echo $i; ?>"><?php echo "$i"; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>