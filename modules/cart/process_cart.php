<?php

// thêm giỏ hàng
if(isset($_GET['a'])) {
    $action = $_GET['a'];
    switch ($action) {
        case 'add' :
             addToCart();
            break;
        case 'update' : 
            updateCart();
            break;
        case 'delete':
            deleteCart();
            break;   
        case 'checkout' :
            checkOut();
            break;         
    }
}
// cập nhật giỏ hàng

// xóa sản phẩm trong giỏ hàng
function addToCart() {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if(isset($_SESSION['cart'][$id])) {
            // sản phẩm có id là $prdId đã tồn tại trong giỏ hàng
            // thì ta tăng cố lượng của sant phẩm thêm 1 đơn vị 
            $_SESSION['cart'][$id]['qty']++;
        } else {
            // sản phẩm có id là $prdId chưa tồn tại trong giỏ hàng
            // thì ta thực hiện thêm thông tin sản phẩm đó vào trong giỏ hàng
            $conn = initConnection();
            $sqlPrd = "SELECT * FROM products WHERE id = $id";
            $queryPrd = mysqli_query($conn, $sqlPrd);
            $product = mysqli_fetch_assoc($queryPrd);
            $_SESSION['cart'][$id] = [
                'price' => $product['prd_price'],
                'qty'    => 1
            ];
        }
    }
    
    header("location:index.php?page=cart"); 
}
function updateCart(){
    foreach ($_POST['quantity'] as $id => $qty) {
        $_SESSION['cart'][$id]['qty'] =  $qty;
    }
    header("location:index.php?page=cart");
}
function deleteCart() {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]) ;
        if(empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        header("location:index.php?page=cart");
    }else {
        header("location:index.php?page=cart");
    }
}
function checkOut() {
    
    if(isset($_SESSION['user_logged'])) {
    $total = 0;
    foreach($_SESSION['cart'] as $id => $item) {
        $total += $item['qty'] * $item['price'];
    }
    // Thêm vào orders
    $cust_id = $_SESSION['user_logged']['id'];
    $receiverName = $_POST['name'];
    $receiverPhone = $_POST['phone'];
    $receiverEmail = $_POST['mail'];
    $receiverAddress = $_POST['address'];
    $sqlOrder = "INSERT INTO orders (receiver_name,receiver_email,receiver_phone,receiver_address,total,cust_id) 
    VALUES('$receiverName', '$receiverEmail', '$receiverPhone', '$receiverAddress', '$total',$cust_id) ";
    $conn = initConnection();
    $queryOrder = mysqli_query($conn, $sqlOrder);
    $lastInsertedId = mysqli_insert_id($conn);
    
    //Thêm vào Orderdetail: order_id, prd id, qty, price
    foreach ($_SESSION['cart'] as $id => $value) {
    $price = $_SESSION['cart'][$id]['price']; //Đơn giá sản phẩm lưu trong gio hàng
    $qty = $_SESSION['cart'][$id]['qty']; // Số lượng của từng sản phẩm trong giờ hàng =
    $sqlDetailOrder = "INSERT INTO order_detail (order_id, prd_id, qty, prd_price, cust_id) VALUES ($lastInsertedId, $id, $qty, $price,$cust_id)";
    mysqli_query($conn, $sqlDetailOrder);
    }
    header("location:index.php?page=success");
    unset($_SESSION['cart']);// xóa giỏ hàng sau khi mua xong
    
}else {
    header("location:cut_login.php");
}
}




?>

