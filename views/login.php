<?php
include_once "../controllers/auth.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];  
    $password = $_POST['pwd'];
    $loginResult = loginUser($email, $password);

    if ($loginResult === true) {
        $redirectPage = ($_SESSION['role'] == 'admin') ? './admin/index.php' : '../index.php';
        echo "<script>
                alert('{$_SESSION['success_message']}');
                window.location.href = '$redirectPage';
              </script>";
        unset($_SESSION['success_message']); 
        exit();
    } else {
        echo "<script>alert('$loginResult');</script>";
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
    <title>Đăng Nhập</title>
</head>
<body>
    <div class="wrapper">
        <form action="" id="form-login" method="POST">
            <h1 class="form-header">Đăng nhập</h1>
            <div class="form-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="text" class="form-input" placeholder="Tên email đăng nhập" name="email" required>
            </div>
            <div class="form-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" class="form-input" placeholder="Mật khẩu" name="pwd" required>
                <div id="eye">
                    <i class="fa-solid fa-eye"></i>
                </div>
            </div>
            <input type="submit" name="submit" class="form-submit" value="Đăng nhập">
            <div class="signup">
                <a href="sign_up.php">Đăng ký</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>
