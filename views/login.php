<?php
session_start();
include_once __DIR__ . '/../config.php'; // Kết nối tới cơ sở dữ liệu
$conn = getDbConnection();
// Kiểm tra khi người dùng nhấn nút "Đăng nhập"
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);  // Làm sạch dữ liệu đầu vào
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Truy vấn kiểm tra email trong cơ sở dữ liệu
    $query = "SELECT * FROM User WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Kiểm tra mật khẩu bằng password_verify()
        if (password_verify($password, $row['password'])) {
            // Chuyển hướng người dùng sau khi đăng nhập thành công
            if ($row['role'] == 'Admin') { 
                header('Location: ../admin/home-admin.php');
            } else {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                header('Location: ../index.php');
            }
            exit();
        } else {
            echo "<script>alert('Mật khẩu không chính xác!');</script>";
        }
    } else {
        echo "<script>alert('Email không tồn tại!');</script>";
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
                <a  href="sign_up.php">Đăng ký</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>