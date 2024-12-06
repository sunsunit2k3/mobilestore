<?php
include_once __DIR__ . '/../controllers/order_controller.php';
include_once __DIR__ . '/../header.php';

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $order_date = $_POST['order_date'];
    $total_money = $_POST['total_money'];
    
    if ($_SESSION["role"] == "admin") {
        $status = $_POST['status'];
    } else {
        $status = 0;
    }

    // Cập nhật thông tin đơn hàng
    $update_order = updateOrder($order_id, $fullname, $phone_number, $email, $address, $note, $order_date, $status, $total_money);

    if ($update_order) {
        // Hiển thị thông báo thành công và chuyển hướng
        echo "<script>alert('Cập nhật đơn hàng thành công!'); window.location.href = 'list_order.php';</script>";
        exit;
    } else {
        echo "Error updating order.";
    }
}
?>
