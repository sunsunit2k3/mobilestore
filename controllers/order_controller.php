<?php
include_once __DIR__ . '/../config.php';
function getOrderByField($field, $value) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM `order` WHERE $field = $value";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $order;  
    } else {;
        return []; 
    }
    mysqli_close($conn);
}
// Hàm thêm chi tiết đơn hàng
function addOrder($user_id, $fullname, $phone_number, $email, $address, $note, $order_date, $total_money) {
    $conn = getDbConnection();
    $sql = "INSERT INTO `order` 
                (user_id,  fullname, phone_number, email, address, note, order_date, total_money)
            VALUES ('$user_id',  '$fullname', '$phone_number', '$email', '$address', '$note', '$order_date', '$total_money')";

    if (mysqli_query($conn, $sql)) {
        return $conn->insert_id;
    } else {
        return false;
    }
    mysqli_close($conn);
}

// Hàm sửa chi tiết đơn hàng
function updateOrder($order_id, $fullname, $phone_number, $email, $address, $note, $order_date, $status, $total_money) {
    $conn = getDbConnection();
    $sql = "UPDATE `order`  SET 
                fullname = '$fullname', 
                phone_number = '$phone_number', 
                email = '$email', 
                address = '$address', 
                note = '$note', 
                order_date = '$order_date', 
                status = '$status', 
                total_money = '$total_money'
            WHERE order_id = $order_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
// Hàm xóa chi tiết đơn hàng
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

