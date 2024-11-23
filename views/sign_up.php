<?php
// Kết nối cơ sở dữ liệu
include_once __DIR__ . '/../config.php';
$conn = getDbConnection();
// Kiểm tra khi form được gửi
if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form và làm sạch dữ liệu để tránh SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Kiểm tra username đã tồn tại chưa
    $check_username = "SELECT * FROM User WHERE username = '$username'";
    $result = mysqli_query($conn, $check_username);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Tên tài khoản đã tồn tại!');</script>";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Chèn dữ liệu vào bảng User
        $sql = "INSERT INTO User (email, username, password, fullname, phone) VALUES ('$email', '$username', '$hashed_password', '$fullname', '$phone')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
}

// Đóng kết nối
mysqli_close($conn);
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
