<?php
include 'controllers/product_controller.php'; 
include 'header.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>styles.css">
</head>
<body>

<main class="main-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><a href="?category=Laptop"><span class="icon">💻</span>Laptop</a></li>
            <li><a href="?category=Điện thoại"><span class="icon">📱</span>Điện thoại</a></li>
            <li><a href="?category=Phụ kiện Gaming"><span class="icon">🎮</span>Phụ kiện Gaming</a></li>
            <li><a href="?category=Phụ kiện Điện Thoại"><span class="icon">📟</span>Phụ kiện Điện Thoại</a></li>
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
$category = isset($_GET['category']) ? $_GET['category'] : null;
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;

$start = ($page - 1) * $productsPerPage;

if ($keyword) {
    $products = getProductsByLimit($start, $productsPerPage, $category, $keyword); // Hàm tìm kiếm sản phẩm
    $totalProducts = getTotalProductCount($keyword, $keyword); // Hàm đếm số sản phẩm theo từ khóa
} else {
    // Nếu không có từ khóa, lấy tất cả sản phẩm (có thể theo danh mục)
    $products = getProductsByLimit($start, $productsPerPage, $category, $keyword); // Hàm tìm kiếm sản phẩm
    $totalProducts = getTotalProductCount($keyword, $keyword); // Hàm đếm số sản phẩm theo từ khóa
}

// Tính tổng số trang
$totalPages = ceil($totalProducts / $productsPerPage);
?>

<section class="product-section">
    <?php foreach ($products as $product): ?>
        <article class="product">
            <img src="./assets/product/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p><?php echo number_format($product['price'], 0, ',', '.') . " VND"; ?></p>
            <a href="./views/product_detail.php?product_id=<?php echo $product['product_id']; ?>" class="btn">Mua hàng</a>
        </article>
    <?php endforeach; ?>
</section>

<div class="pagination">
    <?php 
    if ($totalPages > 1): ?>
        <ul class="pagination-list">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="pagination-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a href="?page=<?php echo $i; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>