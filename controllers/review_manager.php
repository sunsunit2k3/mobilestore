<?php
include_once __DIR__ . '/../config.php';

function getReviewsByProductId($productId) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM Review WHERE product_id = $productId ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
    mysqli_close($conn);
}

?>