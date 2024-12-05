<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../header.php';

$cartEmpty = empty($_SESSION['cart']) ? true : false;
$totalPrice = 0;
if (!$cartEmpty) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['quantity'] * $item['price']; 
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
    <div class="cart-container">
        <h1>Giỏ Hàng</h1>

        <?php if ($cartEmpty): ?>
            <p>Giỏ hàng của bạn hiện đang trống. <a href="index.php">Mua sắm ngay!</a></p>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <tr>
                            <td><img src="<?php echo IMAGES_PATH . 'product/' . htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="100"></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>
                                <form action="cart.php" method="GET">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="action" value="update">
                                    <button type="submit">Cập nhật</button>
                                </form>
                            </td>
                            <td><?php echo number_format($item['price'], 0, ',', '.') . " VND"; ?></td>
                            <td><?php echo number_format($item['quantity'] * $item['price'], 0, ',', '.') . " VND"; ?></td>
                            <td>
                                <a href="cart.php?action=delete&id=<?php echo $item['id']; ?>" class="btn-delete">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">
                <p><strong>Tổng cộng: </strong><?php echo number_format($totalPrice, 0, ',', '.') . " VND"; ?></p>
                <?php if (isset($_SESSION['user_id'])):  ?>
                    <a href="./checkout.php" class="btn-checkout">Tiến hành thanh toán</a>
                <?php else: ?>
                    <p>Bạn cần <a href="login.php">đăng nhập</a> để thanh toán.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
