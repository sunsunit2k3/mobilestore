<?php
session_start();
include("../controllers/order_controller.php");
include("../controllers/order_detail_controller.php");


// Kiểm tra nếu giỏ hàng trống
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<script>alert('Your cart is empty!'); window.location.href='checkout.php';</script>";
    exit;
}

// Lấy dữ liệu từ biểu mẫu
$fullname = $_POST['fullname'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$note = $_POST['note'];
$order_date = $_POST['order_date'];
$total_money = $_POST['total_money'];

$order_id = addOrder($_SESSION['user_id'], $fullname, $phone_number, $email, $address, $note, $order_date, $total_money);
// Duyệt qua từng sản phẩm trong giỏ hàng
foreach ($_SESSION['cart'] as $item) {
    // Gọi hàm addOrder để thêm đơn hàng vào bảng orders
    $order_id = addOrderDetail($order_id, $item['id'], $item['price'], $item['quantity']);
}

// Xóa giỏ hàng sau khi xử lý xong
unset($_SESSION['cart']);

// Hiển thị thông báo đặt hàng thành công
echo "<script>alert('Order placed successfully!'); window.location.href='../index.php';</script>";
exit;

?>
