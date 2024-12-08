<?php
include_once '../header.php';
include_once __DIR__ . '/../../../controllers/order_controller.php';
$result = getOrder();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH?>order_manager.css">
</head>
<body>
    <div class="container">
        <h1>Quản lý đơn hàng</h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result): ?>
                    <?php foreach($result as $row): ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['note']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td>
                                <?php
                                switch ($row['status']) {
                                    case 0:
                                        echo "Chưa duyệt";
                                        break;
                                    case 1:
                                        echo "Đang giao hàng";
                                        break;
                                    case 2:
                                        echo "Đã giao hàng";
                                        break;
                                }
                                ?>
                            </td>
                            <td><?php echo $row['total_money']; ?></td>
                            <?php if($row['status']==2): ?>
                            <td>
                                <p>Đã hoàn thành</p>
                            </td>
                            <?php else: ?>
                                <td>
                                <form method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                    <select name="status">
                                        <?php if($row['status']==0): ?>
                                            <option value="1" <?php echo $row['status'] == 1 ? 'selected' : ''; ?>>Đang giao hàng</option>
                                        <?php else:?>
                                            <option value="2" <?php echo $row['status'] == 2 ? 'selected' : ''; ?>>Đã giao hàng</option>
                                        <?php endif; ?>
                                    </select>
                                    <button type="submit" class="update">Cập nhật</button>
                                </form>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>