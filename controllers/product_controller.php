<?php
include_once __DIR__ . '/../config.php';

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

function getProductByField($field, $value) {
    $conn = getDbConnection(); 
    $sql = "SELECT * FROM Product WHERE $field = '$value'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        return $product; 
    } else {
        mysqli_close($conn);
        return [];
    }
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
// Hàm lấy sản phẩm theo giới hạn
function getProductsByLimit($start, $limit, $category = null, $name = null) {
    $conn = getDbConnection();

    // Xây dựng câu truy vấn SQL cơ bản
    $query = "SELECT * FROM Product";
    
    // Thêm điều kiện nếu có category hoặc name
    if ($category || $name) {
        $query .= " WHERE ";
        if ($category) {
            $query .= "category = '" . mysqli_real_escape_string($conn, $category) . "'";
        }
        if ($category && $name) {
            $query .= " AND ";
        }
        if ($name) {
            $query .= "name LIKE '%" . mysqli_real_escape_string($conn, $name) . "%'";
        }
    }

    $query .= " LIMIT $start, $limit";

    // Thực hiện truy vấn
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


// Hàm đếm tổng số sản phẩm
function getTotalProductCount($category = null, $name = null) {
    $conn = getDbConnection();

    // Xây dựng câu truy vấn SQL cơ bản
    $query = "SELECT COUNT(*) as total FROM Product";

    // Thêm điều kiện nếu có category hoặc name
    if ($category || $name) {
        $query .= " WHERE ";
        if ($category) {
            $query .= "category = '" . mysqli_real_escape_string($conn, $category) . "'";
        }
        if ($category && $name) {
            $query .= " AND ";
        }
        if ($name) {
            $query .= "name LIKE '%" . mysqli_real_escape_string($conn, $name) . "%'";
        }
    }

    // Thực hiện truy vấn
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}



// Kiểm tra nếu có yêu cầu thêm, sửa sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $image = $_FILES['image'];
    
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/mobilestore/assets/product/';
        $imageFileName = null;
    
        if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
            $originalFileName = basename($image['name']);
            $targetFile = $uploadDir . $originalFileName;
    
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($image['type'], $allowedTypes)) {
                if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                    $imageFileName = $originalFileName;
                } else {
                    echo "Không thể tải ảnh lên.";
                    exit;
                }
            } else {
                echo "Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPEG, PNG, JPG.";
                exit;
            }
        } else {
            echo "Vui lòng tải lên một tệp ảnh hợp lệ.";
            exit;
        }
    
        $addProduct=addProduct($name, $description, $price, $quantity, $category, $imageFileName);
        if ($addProduct) {
            $message = "Cập nhật sản phẩm thành công.";
        } else {
            $message = "Đã xảy ra lỗi khi cập nhật sản phẩm.";
        }
    }

    if (isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
    
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/mobilestore/assets/product/'; 
        $product = getProductByField("product_id", $product_id);
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $originalFileName = $_FILES['image']['name'];
    
            $targetFile = $uploadDir . basename($originalFileName);
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imageFileName = basename($originalFileName);
            } else {
                $imageFileName = $product['image']; 
            }
        } else {
            $imageFileName = $product['image'];
        }
    
        // Update the product in the database
        $updateResult = updateProduct($product_id, $name, $description, $price, $quantity, $category, $imageFileName);
        if ($updateResult) {
            $message = "Cập nhật sản phẩm thành công.";
        } else {
            $message = "Đã xảy ra lỗi khi cập nhật sản phẩm.";
        }
    }    
}



?>