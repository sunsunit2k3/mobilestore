<?php

include_once __DIR__ . '/../controllers/order_detail_controller.php';
include_once __DIR__ . '/../header.php';
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_detail = getOrderDetails($order_id);
} else {
    echo "No order ID provided.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH?>checkout.css">
</head>
<body>
    <div class="checkout-container">
        <h2 class="checkout-title">Checkout</h2>
        <form action="update_order.php" method="POST" class="checkout-form">
            <h3 class="section-title">Order Details</h3>
            
            <!-- Display Cart Products -->
            <table class="cart-table">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>

                <?php foreach ($order_detail as $item): ?>
                <tr>
                    <td><?php echo $item['product_id']; ?></td>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price'] * $item['quantity']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h3 class="section-title">Personal Information</h3>
            <div class="form-group">
                <label for="fullname">Mã đơn hàng: <?php echo $order_id?></label>
                <input type="text" name="order_id" required hidden value="<?php echo $order_id?>">
            </div>
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" name="fullname" value="<?php echo $item['fullname']?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" value="<?php echo $item['phone_number']?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $item['email']?>"required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address"  required></textarea>
            </div>
            <div class="form-group">
                <label for="note">Order Note:</label>
                <textarea name="note"></textarea>
            </div>
            <div class="form-group">
                <label for="order_date">Order Date:</label>
                <input type="date" name="order_date" value="<?php echo $item['order_date']; ?>" required>
            </div>
            <div class="form-group">
                <label class="total" for="total_money">Total Amount: <?php echo $item['total_product_price']; ?></label>
                <input type="hidden" name="total_money" value="<?php echo $item['total_product_price']; ?>" required>
            </div>
            <div class="btn">
                <button type="submit" class="btn-checkout">Cập nhật</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php include '../footer.php'; ?>
