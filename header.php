<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology Store</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-top">
            <p class="address">Địa chỉ: Số 46 Ngõ 68 Trung Kính - Cầu Giấy - HN</p>
            <p class="contact">CSKH: 0813053555</p>
        </div>
        <nav class="navbar">
            <div class="logo">
                <a href="<?php echo BASE_URL?>index.php">Technology Store</a>
            </div>
            <form method="GET" action="./index.php" class='form-search'>
                <input type="text" placeholder="Nhập từ khóa cần tìm" name="keyword" class="search-bar">
                <button type="submit">Tìm kiếm</button>
            </form>
            <div class="cart-icon"><a href="<?php echo VIEWS_PATH?>cart_view.php">🛒</a></div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?php echo VIEWS_PATH?>list_order.php"><i class="fa fa-list  fa-2x" aria-hidden="true"></i></a>
                <div class="user-info">
                    <a href="<?php echo VIEWS_PATH?>logout.php" class="logout-button"><button>Đăng xuất</button></a>
                </div>
            <?php else: ?>
                <div class="login"><a href="<?php echo VIEWS_PATH?>login.php"><button>Đăng nhập</button></a></div> 
                <div class="signup"><a href="<?php echo VIEWS_PATH?>sign_up.php"><button>Đăng ký</button></a></div>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>
