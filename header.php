<?php
// Bắt đầu session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology Store</title>
    <link rel="stylesheet" href="./css/header.css">
</head>
<body>
    <header>
        <div class="header-top">
            <p class="address">Địa chỉ: Số 46 Ngõ 68 Trung Kính – Cầu Giấy – HN</p>
            <p class="contact">CSKH: 0813053555</p>
        </div>
        <nav class="navbar">
            <div class="logo">Technology Store</div>
                <form method="GET" action="product_list.php" class='form-search'>
                    <input type="text" placeholder="Nhập từ khóa cần tìm" class="search-bar">
                    <button type="submit">Tìm kiếm</button>
                </form>
            <div class="cart-icon">🛒</div>

            <!-- Kiểm tra xem người dùng đã đăng nhập chưa -->
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                <div class="logout-icon"><a href="logout.php">Đăng Xuất</a></div> <!-- Đăng xuất nếu đã đăng nhập -->
            <?php else: ?>
                <div class="login"><a href="login.php"><button>Đăng nhập</button></a></div> 
                <div class="logout"><a href="login.php"><button>Đằng ký</button></a></div>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>

