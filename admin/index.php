<?php
session_start();
include_once "../config/db.php";
if(!isset($_SESSION['user_logged'])) {
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="public/css/bootstrap-table.css" rel="stylesheet">
	<style>
		.container-fluid {
			float: left;
		}
		a{
			text-decoration: none;
		}
	</style>
   
	
	
</head>
<body>
<!-- As a link -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class=" navbar-brand" href="#">BOOKSHOP QUẢN TRỊ</a>
	<div class="btn-group">
  <button type="button" class="btn btn-danger"> <a href="logout.php"> <ion-icon name="exit-outline"></ion-icon>
 ĐĂNG XUẤT </a></button>

 
</div>

</nav>


      
  <div class="row">
	
    
    <ul class="nav nav-pills flex-column mb-auto col-3">
      
      <li>
        <a href="index.php?page=user" class="nav-link text-black <?php if(isset($_GET['page']) && $_GET['page'] == 'user' ) echo 'active' ?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
          <ion-icon name="person-outline"></ion-icon>Quản lý thành viên
        </a>
      </li>
      <li>
        <a href="index.php?page=category" class="nav-link text-black <?php if(isset($_GET['page']) && $_GET['page'] == 'category') echo 'active' ?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
          <ion-icon name="folder-outline"></ion-icon>Quản lý danh mục
        </a>
      </li>
      <li>
        <a href="index.php?page=product" class="nav-link text-black <?php if(isset($_GET['page']) && $_GET['page'] == 'product' ) echo 'active' ?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
          <ion-icon name="server-outline"></ion-icon>Quản lý sản phẩm
        </a>
      </li>
	  <li>
        <a href="index.php?page=cut" class="nav-link text-black <?php if(isset($_GET['page']) && $_GET['page'] == 'cut' ) echo 'active' ?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
          <ion-icon name="server-outline"></ion-icon>Danh sách khách hàng
        </a>
      </li>
	  <li>
        <a href="index.php?page=order" class="nav-link text-black <?php if(isset($_GET['page']) && $_GET['page'] == 'order' ) echo 'active' ?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
          <ion-icon name="server-outline"></ion-icon>Quản lý đơn hàng
        </a>
      </li>
	  
	  <li>
        <a href="index.php?page=comment" class="nav-link text-black <?php if(isset($_GET['page']) && $_GET['page'] == 'comment' ) echo 'active' ?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
          <ion-icon name="server-outline"></ion-icon>Bình luận sản phẩm
        </a>
      </li>
    </ul>


    
      <div class="col-9">
      <?php
	  echo '<div class = " content "> ';
	       if(isset($_GET['page'])) {
			$page = strtolower($_GET['page']);
			switch($page) {
				case 'admin':
					include_once "modules/user/user.php";
					break;
					
				case 'user' :
					include_once "modules/user/user.php";
					break;
				case 'add_user' :
				    include_once "modules/user/add_user.php";
				    break;					
				case 'edit_user' :
					include_once "modules/user/edit_user.php";
					break;	
				case 'delete_user' :
					include_once "modules/user/delete_user.php";
					break;
				case 'category' :
					include_once "modules/category/category.php";
					break;	
				case 'add_category' :
					include_once "modules/category/add_category.php";
					break;		
				case 'edit_category' :
					include_once "modules/category/edit_category.php";
					break;
				case 'delete_category' :
					include_once "modules/category/delete_category.php";
					break;					
							
				case 'product' :
					include_once "modules/product/product.php";
					break;	
				case 'add_product' :
					include_once "modules/product/add_product.php";
					break;	
				case 'edit_product' :
					include_once "modules/product/edit_product.php";
					break;	
				case 'delete_product' :
					include_once "modules/product/delete_product.php";
					break;	
				case 'order' :
					include_once "modules/order/order.php";		
					break;
				case 'delete_order' :
					include_once "modules/order/delete_order.php";	
					break;
				case 'order_detail' :
					include_once "modules/order_detail/order_detail.php";	
					break;				
				case 'delete_order_detail' :
					include_once "modules/order_detail/delete_order_detail.php";	
					break;	
				case 'update_status' :
					include_once "modules/order_detail/update_status.php";	
					break;	
				case 'comment' :
				    include_once "modules/comment/comment.php";	
					break;		
				case 'delete_comment' :
					include_once "modules/comment/delete_comment.php";	
					break;	
				case 'cut' :
					include_once "modules/customers/cut.php";	
					break;					
			}	
		   }
		   else {
			include_once "modules/user/user.php";
		   }
	 echo '</div>';
	   ?>
	   </div>
	   </div>
    <script src="public/js/jquery-1.11.1.min.js"></script>
	<script src="public/js/bootstrap.min.js"></script>	
	<script src="public/js/bootstrap-table.js"></script>    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
