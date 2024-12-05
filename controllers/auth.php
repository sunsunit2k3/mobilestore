<?php
session_start();

include_once __DIR__ . '/../config.php';

//Hàm xử lý đăng nhập
function loginUser($email, $password) {
    $conn = getDbConnection();
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM User WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['success_message'] = "Đăng nhập thành công!";
            return true; 
        } else {
            return "Mật khẩu không chính xác!";
        }
    } else {
        return "Email không tồn tại!";
    }
}

function registerUser($email, $username, $password, $fullname, $phone) {
    $conn = getDbConnection();

    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $phone = mysqli_real_escape_string($conn, $phone);

    $check_username = "SELECT * FROM User WHERE username = '$username'";
    $result = mysqli_query($conn, $check_username);

    if (mysqli_num_rows($result) > 0) {
        return "Tên tài khoản đã tồn tại!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO User (email, username, password, fullname, phone) VALUES ('$email', '$username', '$hashed_password', '$fullname', '$phone')";
        
        if (mysqli_query($conn, $sql)) {
            return true; 
        } else {
            return "Lỗi: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}

function logoutUser() {
    session_unset();
    session_destroy();
    return "Đã đăng xuất thành công!";
}
?>

