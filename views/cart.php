<?php
session_start(); 
include_once __DIR__ . '/../controllers/product_manager.php';


if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 
}
// Kiểm tra xem action có tồn tại không, nếu không thì gán giá trị mặc định là 'add'
$action = isset($_GET['action']) ? $_GET['action'] : 'add';
// Kiểm tra xem quantity có tồn tại không, nếu không thì gán giá trị mặc định là 1
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1; 

if ($quantity <= 0) {
    $quantity = 1;
}

$product = getProductById($id);

if ($product) {
    $item = [
        'id' => $product['product_id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'quantity' => $quantity
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($action == 'update') {
        if (isset($_SESSION['cart'][$id]) && is_array($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = $quantity; 
        }
    } elseif ($action == 'add') {
        if (isset($_SESSION['cart'][$id]) && is_array($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity; 
        } else {
            $_SESSION['cart'][$id] = $item; 
        }
    } elseif ($action == 'delete') {
        unset($_SESSION['cart'][$id]); 
    }
} else {
    echo "Product not found.";
    exit;
}

header('Location: cart_view.php');
exit();
?>
