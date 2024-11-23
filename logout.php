<?php
session_start();
session_destroy(); // Hủy tất cả các session hiện tại
header("Location: ./index.php"); // Chuyển hướng về trang chủ hoặc đăng nhập
exit();
?>
