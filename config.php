<?php
// Định nghĩa đường dẫn gốc
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/mobilestore/'); // Đường dẫn gốc của website
define('CSS_PATH', BASE_URL . 'css/');
define('JS_PATH', BASE_URL . 'js/');
define('IMAGES_PATH', BASE_URL . 'assets/');


// Nhúng file kết nối cơ sở dữ liệu
require_once BASE_PATH . '/database/conn.php';
?>
