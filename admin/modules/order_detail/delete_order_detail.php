<?php
$conn = initConnection();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = "DELETE FROM order_detail WHERE order_id = '$id' ";
    $querydelete = mysqli_query($conn,$delete);
    header("location:index.php?page=order_detail");
    
}
?>