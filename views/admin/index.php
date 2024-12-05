<?php
session_start();
if(!isset($_SESSION['role'])&& $_SESSION['role'] != 'admin'){
    header('location:../../index.php');
}
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
                <a href=""><i class="fa fa-user-circle  fa-2x" aria-hidden="true"></i></a>
                <div class="user-info">
                    <a href="<?php echo BASE_URL?>views/logout.php" class="logout-button"><button>Đăng xuất</button></a>
                </div>
        </nav>
    </header>
</body>
</html>