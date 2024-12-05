<?php

// Hàm thêm đơn hàng
function addOrder($order_id, $product_id, $price, $quantity) {
    $conn = getDbConnection();
    $sql = "INSERT INTO `order` (order_id, product_id, price, quantity) 
            VALUES ('$order_id', '$product_id', '$price', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
// Hàm sửa đơn hàng
function updateOrder($order_id, $product_id, $price, $quantity) {
    $conn = getDbConnection();
    $sql = "UPDATE `order` SET 
                product_id = '$product_id', 
                price = '$price', 
                quantity = '$quantity' 
            WHERE order_id = $order_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
// Hàm xóa đơn hàng
function deleteOrder($order_id) {
    $conn = getDbConnection();
    $sql = "DELETE FROM `order` WHERE order_id = $order_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
?>