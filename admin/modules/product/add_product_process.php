<?php
require_once "../../../config/db.php";
$conn = initConnection();
$prd_name = $_POST['prd_name'];
$prd_price = $_POST['prd_price'];
$prd_qty = $_POST['prd_qty'];
$prd_desc = $_POST['prd_desc'];
$author = $_POST['author'];
$cat_id = $_POST['cat_id'];
$prd_like = $_POST['prd_like'];
if(isset($_POST['prd_like'])) {
    $prd_like = 1;
}else {
    $prd_like = 0;
}
if(isset($_FILES['prd_image']['name'])) {
    $file_name = $_FILES['prd_image']['name'];
    $file_tmp_name = $_FILES['prd_image']['tmp_name'];
    move_uploaded_file($file_tmp_name, '../../../upload/product/'.$file_name);
}
$sqlInsert = " INSERT INTO products(prd_name,prd_price,prd_qty,prd_desc,author,prd_image,cat_id,prd_like)
              VALUE ('$prd_name','$prd_price','$prd_qty','$prd_desc','$author','$file_name','$cat_id','$prd_like')";
$queryInsert = mysqli_query($conn, $sqlInsert) ;
header("location:../../index.php?page=product");     
?>
