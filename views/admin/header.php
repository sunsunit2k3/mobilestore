<?php
session_start();
include_once __DIR__ . '/../../config.php';
if(!isset($_SESSION['role'])&& $_SESSION['role'] != 'admin'){
    header('location:../../index.php');
}
?>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>home_admin.css">
<header>
    <div class="header-top">
        <p class="address">Địa chỉ: Số 46 Ngõ 68 Trung Kính - Cầu Giấy - HN</p>
        <p class="contact">CSKH: 0813053555</p>
    </div>
    <nav class="navbar">
        <div class="logo">
            <a href="<?php echo BASE_URL?>views/admin/index.php">Admin Technology Store</a>
        </div>
            <ul class="nav-list">
                <li>
                    <a href="<?php echo BASE_URL?>views/admin/product_views/manage_product.php" class="nav-item">Quản lý sản phẩm</a>
                    <a href="<?php echo BASE_URL?>views/admin/order_views/order_manager.php" class="nav-item">Quản lý đơn hàng</a>
                </li>
            </ul>
            <div class="user-info">
                <a href="<?php echo BASE_URL?>views/logout.php" class="logout-button"><button>Đăng xuất</button></a>
            </div>
    </nav>
</header>