<?php
include_once __DIR__ . '/../config.php';

function getReviewsByProductId($productId) {
    $conn = getDbConnection();
    
    // Sử dụng JOIN để lấy fullname từ bảng User
    $sql = "SELECT r.*, u.fullname 
            FROM Review r
            JOIN User u ON r.user_id = u.user_id
            WHERE r.product_id = ?
            ORDER BY r.created_at DESC";
    
    // Chuẩn bị câu lệnh SQL
    if ($stmt = $conn->prepare($sql)) {
        // Liên kết tham số
        $stmt->bind_param("i", $productId);
        
        // Thực thi câu lệnh
        $stmt->execute();
        
        // Lấy kết quả
        $result = $stmt->get_result();
        
        // Kiểm tra và trả về dữ liệu
        if ($result->num_rows > 0) {
            $reviews = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $conn->close();
            return $reviews;
        } else {
            $stmt->close();
            $conn->close();
            return [];
        }
    } else {
        $conn->close();
        return [];
    }
}
function hasUserReviewed($userId, $productId) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM Review WHERE user_id = ? AND product_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    
    return $result->num_rows > 0; 
}

function addReview($productId, $userId, $rating, $comment) {
    // Kết nối cơ sở dữ liệu
    $conn = getDbConnection();
    
    // Chuẩn bị câu lệnh SQL để thêm bình luận vào bảng Review
    $sql = "INSERT INTO Review (product_id, user_id, rating, comment, created_at) 
            VALUES (?, ?, ?, ?, NOW())";
    
    // Chuẩn bị câu lệnh
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iiis", $productId, $userId, $rating, $comment);
        
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true; 
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    } else {
        $conn->close();
        return false;
    }
}
?>