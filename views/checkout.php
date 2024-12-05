<?php

include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../header.php';


// Check if the cart is not empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "Your cart is empty!";
    exit;
}

// Calculate the total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
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
        <form action="process_checkout.php" method="POST" class="checkout-form">
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

                <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price'] * $item['quantity']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h3 class="section-title">Personal Information</h3>
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" required></textarea>
            </div>
            <div class="form-group">
                <label for="note">Order Note:</label>
                <textarea name="note"></textarea>
            </div>
            <div class="form-group">
                <label for="order_date">Order Date:</label>
                <input type="date" name="order_date" required>
            </div>
            <div class="form-group">
                <label for="status">Order Status (0=Pending):</label>
                <input type="number" name="status" value="0" required>
            </div>
            <div class="form-group">
                <label for="total_money">Total Amount:</label>
                <input type="text" name="total_money" value="<?php echo $total_price; ?>" required>
            </div>

            <button type="submit" class="submit-btn">Place Order</button>
        </form>
    </div>
</body>
</html>
