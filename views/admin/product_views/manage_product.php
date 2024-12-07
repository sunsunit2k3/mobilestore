<?php
include_once '../header.php';
include_once __DIR__ . '/../../../controllers/product_controller.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('location:../../index.php');
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (deleteProduct($product_id)) {
        echo "  <script>
                        alert('Xóa sản phẩm thành công');
                        window.location.href = './manage_product.php';
                </script>";
    } else {
        echo "<script>
                        alert('Lỗi khi xóa sản phẩm hoặc sản phẩm đã tồn tại trong đơn hàng');
                        window.location.href = './manage_product.php';
                </script>";
    }
}

$productsPerPage = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $productsPerPage;

$product = getProductsByLimit($start, $productsPerPage);
$totalProducts = getTotalProductCount();
$totalPages = ceil($totalProducts / $productsPerPage);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>manage_product.css">
    <title>Quản Lý Sản Phẩm</title>
</head>
<body>
    <h1>Quản Lý Sản Phẩm</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Mô Tả</th>
                <th>Giá</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $row): ?>
                <tr>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= number_format($row['price'], 2) ?></td>
                    <td class="actions">
                        <form method="GET" action="./manage_product.php" style="display: inline-block;">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <button type="submit" class="btn-delete">Xóa</button>
                        </form>
                        <form method="POST" action="update_product.php?product_id=<?php echo $row['product_id']; ?>" style="display: inline-block;">
                            <button type="submit" class="btn-update">Cập nhật</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($totalPages > 1): ?>
            <ul class="pagination-list">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="pagination-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>
    </div>
    <h2><a href="./add_product_views.php">Thêm sản phẩm</a></h2>
</body>
</html>
