<?php
include_once './header.php';


// Kết nối cơ sở dữ liệu
$conn = getDbConnection();

// Lấy tháng và năm hiện tại
$currentMonth = date('m');
$currentYear = date('Y');

// Truy vấn danh sách sản phẩm đã bán trong tháng hiện tại
$query = "
    SELECT 
        od.product_id,
        p.name AS product_name,
        od.quantity,
        od.price,
        o.order_date
    FROM 
        OrderDetail od
    INNER JOIN `Order` o ON od.order_id = o.order_id
    INNER JOIN Product p ON od.product_id = p.product_id
    WHERE 
        o.status = 2 AND 
        MONTH(o.order_date) = $currentMonth AND 
        YEAR(o.order_date) = $currentYear
";


$result = mysqli_query($conn, $query);
$soldProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Tính tổng doanh thu của tháng hiện tại
$revenueQuery = "
    SELECT 
        SUM(od.quantity * od.price) AS total_revenue
    FROM 
        OrderDetail od
    INNER JOIN `Order` o ON od.order_id = o.order_id
    WHERE 
        o.status = 2 AND 
        MONTH(o.order_date) = $currentMonth AND 
        YEAR(o.order_date) = $currentYear
";

$revenueResult = mysqli_query($conn, $revenueQuery);
$revenueData = mysqli_fetch_assoc($revenueResult);
$totalRevenue = $revenueData['total_revenue'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology Store</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>home_admin.css">
</head>
<body>
    <main>
        <!-- Hiển thị danh sách sản phẩm đã bán -->
        <div class="container  ">
            <section>
                <h2>Sản phẩm đã bán trong tháng <?php echo $currentMonth; ?> năm <?php echo $currentYear; ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Ngày bán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($soldProducts as $product): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                                <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</td>
                                <td><?php echo htmlspecialchars($product['order_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

        <!-- Hiển thị tổng doanh thu -->
            <section class="section-2">
                <h2>Tổng doanh thu tháng <?php echo $currentMonth; ?>: 
                    <?php echo number_format($totalRevenue, 0, ',', '.'); ?> VND
                </h2>
            </section>
        </div>
    </main>
</body>
</html>