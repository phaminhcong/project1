<?php 

$conn = initConnection();
 $cust_id = $_SESSION['user_logged']['id'];
if(isset($_GET['id'])) {
	$id = $_GET['id'];
if(isset($_POST['sbm'])) {
$status = $_POST['status'];
$sqlUpdate = " UPDATE order_detail SET status = $status WHERE order_id = $id ";
mysqli_query($conn,$sqlUpdate);
header ("location:index.php?page=detail&cust_id=$cust_id");
}}
?>