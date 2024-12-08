<?php
include_once __DIR__ . '/../config.php';

function getOrder() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM `order`";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        return [];
    }
    mysqli_close($conn);
}
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
// Cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $conn = getDbConnection();

    $sql = "UPDATE `Order` SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $order_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật trạng thái thành công!');</script>";
    } else {
        echo "<script>alert('Cập nhật trạng thái thất bại!');</script>";
    }
    $stmt->close();
}
?>

