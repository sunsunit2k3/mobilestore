<?php
ob_start();
include_once __DIR__ . '/../controllers/order_controller.php';
include_once __DIR__ . '/../controllers/order_detail_controller.php';
include_once '../header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('location:../index.php');
    exit();
}
// Lấy danh sách đơn hàng theo user_id
$list_order = getOrderByField('user_id', $_SESSION['user_id']);
?>
<link rel="stylesheet" href="<?php echo CSS_PATH?>list_order.css">
<body>
    <div class="order-container">
        <h1>Danh sách đơn hàng của bạn</h1>
        <table class="order-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và Tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền (VND)</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($list_order)): ?>
                    <?php foreach ($list_order as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['user_id']);?></td>
                            <td><?php echo htmlspecialchars($order['fullname']);?></td>
                            <td><?php echo htmlspecialchars($order['phone_number']);?></td>
                            <td><?php echo htmlspecialchars($order['email']);?></td>
                            <td><?php echo htmlspecialchars($order['address']);?></td>
                            <td><?php echo htmlspecialchars($order['note']);?></td>
                            <td><?php echo htmlspecialchars($order['order_date']);?></td>
                            <td class="status-<?php echo $order['status'];?>">
                                <?php 
                                switch ($order['status']) {
                                    case 0:
                                        echo 'Chờ xử lý';
                                        break;
                                    case 1:
                                        echo 'Đang giao hàng';
                                        break;
                                    case 2:
                                        echo 'Hoàn thành';
                                        break;
                                    default:
                                        echo 'Không xác định';
                                }
                                ?>
                            </td>
                            <td><?php echo number_format($order['total_money'], 0, ',', '.'); ?></td>
                            <?php if ($order['status'] == 0): ?>
                            <td>
                            <?php if ($order['status'] == 0): ?>
                                <form method="POST" action="list_order.php" style="display: inline-block;">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <button type="submit" class="btn-delete" name="delete_order">Xóa</button>
                                </form>
                                <?php endif; ?>
                                <form method="POST" action="update_order_view.php?order_id=<?php echo $order["order_id"]?>" style="display: inline-block;">
                                    <button type="submit" class="btn-update">Cập nhật</button>
                                </form>
                            </td>
                            <?php else: ?>
                            <td>No Action</td>
                            <?php endif; ?> 
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Không có đơn hàng nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_POST['delete_order']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Xóa chi tiết đơn hàng trước
    $delete_details = deleteOrderDetail($order_id);
    
    if ($delete_details) {
        // Sau khi xóa chi tiết đơn hàng, tiến hành xóa đơn hàng
        $delete_order = deleteOrder($order_id);
        if ($delete_order) {
            // Gọi header để chuyển hướng sau khi xóa thành công
            header("Location: list_order.php"); 
            exit; // Thêm exit() để dừng quá trình tiếp tục thực thi mã
        } else {
            echo "Error deleting order.";
        }
    } else {
        echo "Error deleting order details.";
    }
}
ob_end_flush();
?>

