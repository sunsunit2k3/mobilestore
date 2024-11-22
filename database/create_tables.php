<?php
	$server = "localhost"; //127.0.0.1; IP
	$username = "root";
	$password = "";
	$db = "mobilestore";
	$conn = mysqli_connect($server, $username, $password, $db);

	if(!$conn){
		die("Kết nối không thành công: ".mysqli_connect_error());
	}
	echo "Kết nối thành công";

	// BẢNG NGƯỜI DÙNG
	$sql = "CREATE TABLE IF NOT EXISTS User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    role VARCHAR(50) NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

	if(mysqli_query($conn, $sql)){
		echo "<br> Bảng User tạo thành công";
	} else {
		echo "Có lỗi xảy ra: ".mysqli_error($conn);
	}

	// BẢNG SẢN PHẨM
	$sql = "CREATE TABLE IF NOT EXISTS Product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    category VARCHAR(50),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

	if(mysqli_query($conn,$sql)){
		echo "<br> Bảng Product tạo thành công";
	} else {
		echo "Có lỗi xảy ra: ".mysqli_error($conn);
	}

	// BẢNG ORDERDETAIL (Chi tiết đơn hàng)
	$sql = "CREATE TABLE IF NOT EXISTS OrderDetail (
    orderdetail_id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT NOT NULL,
    order_id INT NOT NULL, 
    fullname VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL, 
    address VARCHAR(500) NOT NULL,
    note VARCHAR(300) NOT NULL,
    order_date DATE NOT NULL, 
    status INT NOT NULL DEFAULT 0, 
    total_money INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id),      -- Liên kết với bảng User
    FOREIGN KEY (order_id) REFERENCES `Order`(order_id)   -- Liên kết với bảng Order
    )";

	if(mysqli_query($conn,$sql)){
		echo "<br> Bảng OrderDetail tạo thành công";
	} else {
		echo "Có lỗi xảy ra: ".mysqli_error($conn);
	}

	// BẢNG GIỎ HÀNG (Order)
	$sql = "CREATE TABLE IF NOT EXISTS `Order` (
    order_id INT AUTO_INCREMENT PRIMARY KEY, 
    product_id INT NOT NULL,
    price INT NOT NULL, 
    quantity INT NOT NULL, 
    FOREIGN KEY (product_id) REFERENCES Product(product_id)   -- Liên kết với bảng Product
    )";
    // BẢNG ĐÁNH GIÁ (Reviews)
	if(mysqli_query($conn,$sql)){
		echo "<br> Bảng Order tạo thành công";
	} else {
		echo "Có lỗi xảy ra: ".mysqli_error($conn);
	}
	$sql = "CREATE TABLE IF NOT EXISTS Review (
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),  -- Điểm đánh giá từ 1 đến 5
        comment TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES User(user_id),        -- Liên kết với bảng User
        FOREIGN KEY (product_id) REFERENCES Product(product_id) -- Liên kết với bảng Product
        )";
	// Đóng kết nối

    if(mysqli_query($conn,$sql)){
		echo "<br> Bảng Review tạo thành công";
	} else {
		echo "Có lỗi xảy ra: ".mysqli_error($conn);
	}
	mysqli_close($conn);
?>
