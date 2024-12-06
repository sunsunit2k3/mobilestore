<?php
include_once __DIR__ . '/../config.php';
// Hàm thêm đơn hàng
function addOrderDetail($order_id, $product_id, $price, $quantity) {
    $conn = getDbConnection();
    // Kiểm tra xem order_id có tồn tại trong bảng `order` không
    $sql_check_order = "SELECT COUNT(*) FROM `order` WHERE `order_id` = ?";
    $stmt_check = $conn->prepare($sql_check_order);
    $stmt_check->bind_param("i", $order_id);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count == 0) {
        // Nếu không tồn tại, thông báo lỗi
        echo "Error: The order_id does not exist in the `order` table.";
        mysqli_close($conn);
        return false;
    }

    $sql = "INSERT INTO `orderdetail` (order_id, product_id, price, quantity) 
            VALUES ('$order_id','$product_id', '$price', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        return true;
     mysqli_close($conn);
    } else {
        return false;
    mysqli_close($conn);
    }
}
// Hàm sửa đơn hàng
function updateOrderDetail($orderdetail_id, $product_id, $price, $quantity) {
    $conn = getDbConnection();
    $sql = "UPDATE `orderdetail` SET 
                product_id = '$product_id', 
                price = '$price', 
                quantity = '$quantity' 
            WHERE orderdetail_id = $orderdetail_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
// Hàm xóa đơn hàng
function deleteOrderDetail($order_id) {
    $conn = getDbConnection();
    $sql = "DELETE FROM `orderdetail` WHERE order_id = $order_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
function getOrderDetails($order_id) {
    $conn = getDbConnection();
    
    // Câu truy vấn SQL
    $sql = "SELECT o.order_id, o.fullname, o.phone_number, o.email, o.address, o.note, o.order_date, o.total_money,
                   od.product_id, p.name AS product_name, od.quantity, od.price, (od.quantity * od.price) AS total_product_price
            FROM `order` o
            JOIN `orderdetail` od ON o.order_id = od.order_id
            JOIN `product` p ON od.product_id = p.product_id  -- Thêm phép JOIN với bảng product
            WHERE o.order_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id); // Liên kết biến $order_id với dấu hỏi trong câu truy vấn
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Lấy tất cả dữ liệu
    $order_details = [];
    while ($row = $result->fetch_assoc()) {
        $order_details[] = $row;
    }
    
    $stmt->close();
    $conn->close();
    
    return $order_details;
}
?>
