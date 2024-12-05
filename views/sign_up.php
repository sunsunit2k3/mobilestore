<?php
include_once "../controllers/auth.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];

    $registerResult = registerUser($email, $username, $password, $fullname, $phone);

    if ($registerResult === true) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('$registerResult');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Đăng Ký</title>
</head>
<body>
    <div class="wrapper">
        <form action="" id="form-login" method="POST">
            <h1 class="form-header">Đăng Ký</h1>
            <div class="form-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" class="form-input" placeholder="Tên email đăng ký" name="email" required>
            </div>
            <div class="form-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" class="form-input" placeholder="Tên tài khoản" name="username" required>
            </div>
            <div class="form-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" class="form-input" placeholder="Mật khẩu" name="pwd" required>
                <div id="eye">
                    <i class="fa-solid fa-eye"></i>
                </div>
            </div>
            <div class="form-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" class="form-input" placeholder="Tên đầy đủ" name="fullname" required>
            </div>
            <div class="form-group">
                <i class="fa-solid fa-phone"></i>
                <input type="text" class="form-input" placeholder="Số điện thoại" name="phone" required>
            </div>
            <input type="submit" name="submit" class="form-submit" value="Đăng Ký">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>
