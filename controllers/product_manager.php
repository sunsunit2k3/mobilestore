<?php
include 'database/conn.php';

// Hàm đọc tất cả sản phẩm
function getAllProducts() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM Product";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
    mysqli_close($conn);
}

// Hàm thêm sản phẩm
function addProduct($name, $description, $price, $quantity, $category, $image) {
    $conn = getDbConnection();
    $sql = "INSERT INTO Product (name, description, price, quantity, category, image) 
            VALUES ('$name', '$description', '$price', '$quantity', '$category', '$image')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}

// Hàm sửa sản phẩm
function updateProduct($product_id, $name, $description, $price, $quantity, $category, $image) {
    $conn = getDbConnection();
    $sql = "UPDATE Product SET 
                name = '$name', 
                description = '$description', 
                price = '$price', 
                quantity = '$quantity', 
                category = '$category', 
                image = '$image'
            WHERE product_id = $product_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}

// Hàm xóa sản phẩm
function deleteProduct($product_id) {
    $conn = getDbConnection();
    $sql = "DELETE FROM Product WHERE product_id = $product_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
    mysqli_close($conn);
}

// Kiểm tra nếu có yêu cầu thêm, sửa sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $image = $_POST['image'];

        if (addProduct($name, $description, $price, $quantity, $category, $image)) {
            echo "Sản phẩm đã được thêm thành công!";
        } else {
            echo "Lỗi khi thêm sản phẩm.";
        }
    }

    if (isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $image = $_POST['image'];

        if (updateProduct($product_id, $name, $description, $price, $quantity, $category, $image)) {
            echo "Sản phẩm đã được cập nhật!";
        } else {
            echo "Lỗi khi cập nhật sản phẩm.";
        }
    }
}

// Xử lý xóa sản phẩm
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    if (deleteProduct($product_id)) {
        echo "Sản phẩm đã được xóa!";
    } else {
        echo "Lỗi khi xóa sản phẩm.";
    }
}
?>