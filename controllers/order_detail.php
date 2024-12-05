<?php
function getOrderDetailById($orderdetail_id) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM orderdetail WHERE orderdetail_id = $orderdetail_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $orderDetail = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        return $orderDetail;  // Return the order detail as an associative array
    } else {
        mysqli_close($conn);
        return [];  // Return an empty array if no detail found
    }
}
// Hàm thêm chi tiết đơn hàng
function addOrderDetail($orderdetail_id, $user_id, $order_id, $fullname, $phone_number, $email, $address, $note, $total_money) {
    $conn = getDbConnection();
    $sql = "INSERT INTO orderdetail 
                (orderdetail_id, user_id, order_id, fullname, phone_number, email, address, note, total_money)
            VALUES ('$orderdetail_id', '$user_id', '$order_id', '$fullname', '$phone_number', '$email', '$address', '$note', '$total_money')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
// Hàm sửa chi tiết đơn hàng
function updateOrderDetail($orderdetail_id, $user_id, $fullname, $phone_number, $email, $address, $note, $order_date, $status, $total_money) {
    $conn = getDbConnection();
    $sql = "UPDATE orderdetail SET 
                user_id = '$user_id', 
                fullname = '$fullname', 
                phone_number = '$phone_number', 
                email = '$email', 
                address = '$address', 
                note = '$note', 
                order_date = '$order_date', 
                status = '$status', 
                total_money = '$total_money'
            WHERE orderdetail_id = $orderdetail_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}
// Hàm xóa chi tiết đơn hàng
function deleteOrderDetail($orderdetail_id) {
    $conn = getDbConnection();
    $sql = "DELETE FROM orderdetail WHERE orderdetail_id = $orderdetail_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}


?>