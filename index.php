<?php 
session_start();
ob_start();
include_once "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phamminhcong</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="csstrangchu/menu.css">
    <link href="admin/public/css/bootstrap-table.css" rel="stylesheet">
    <style>
      a{
        text-decoration: none;
      }
      .footer {
      background-color: aqua;
    }
    .slogan {
      margin-left: 100px;
      color: green;
    }
    html {

height: 100%;

}

.test {
  margin-bottom: 50px;
}

.footer {
 margin-top : 50px;
background: #2c3e50;

text-align: center;

color: #fff;

padding: 1rem; }
    </style>
    

  </head>
  <body>
    <!-- begin header -->

    <nav class="navbar navbar-success bg-light">
      <div class="container-fluid">
        <a href="index.php"><img src="upload/img/bookshop.png" alt
            width="100" height="80"></a> 
        <form action="index.php?page=search" class=" search d-flex" method = "post">
          <input class="form-control me-2" type="search" placeholder="Search"
            aria-label="Search" name="keyword">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <ion-icon name="person-outline"></ion-icon>
        </button>
       <ul class="dropdown-menu">
        
          <?php
          if(!isset($_SESSION['user_logged'])) {
            ?>
            <li><a class="dropdown-item" href="cut_login.php">Đăng nhập</a></li>
           <?php 
          }
          ?>
        
          <?php
          if(isset($_SESSION['user_logged'])) {
            $cust_id = $_SESSION['user_logged']['id'];
            ?>
            <li><a class="dropdown-item" href="cut_logout.php">  Đăng xuất</a></li>
            <li><a class="dropdown-item" href="index.php?page=edit_cut&cust_id=<?php echo $cust_id ?>">
             Sửa thông tin  </a></li>
           <?php 
          }
          ?>
        
          </ul>
       </div>
        <a href="index.php?page=cart"> <h2 style = " color : red; "><ion-icon name="cart-outline"></ion-icon></h2> </a>
      </div>
    </nav>

    <!-- menu -->

  <div class="menu">
      <?php
         $conn = initConnection();
         $sqlcat = " SELECT * FROM categories ORDER BY id ";
         $querycat = mysqli_query($conn,$sqlcat); 
      ?>     
      <div class="dropdown" >
      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
       Danh sách 
     </button>
     <?php
          if(isset($_SESSION['user_logged'])) {
            ?>
         <?php $cust_id = $_SESSION['user_logged']['id']  ?>
         
        <a href="index.php?page=detail&cust_id=<?php echo $cust_id ?>" style="float: right;"> <h5> <ion-icon name="receipt-outline"></ion-icon> Lịch sử đặt hàng
        </h5> </a>
         <?php } ?>
     <ul class="dropdown-menu">
    
    <?php
       while($row = mysqli_fetch_assoc($querycat)) {
      ?>
      <li>
        <a class="dropdown-item" href="index.php?page=category_product&id=<?php echo $row['id'] ?>">
        <?php echo $row['name']; ?>
      </a>
      </li>
      <?php 
       }
      ?>
  </ul>
   </div>
   </div>
    <!-- anh dong -->
  <div class="test">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="upload/img/nhung-cuon-sach-van-hoc-hay.jpg" width="100%" height="200px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="upload/img/Banner-o-nha-doc-sach-925x412px-01.jpg" width="100%" height="200px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="upload/img/tiki-giam-gia-sach-hay-50-70-az-vietnam.jpg" width="100%" height="200px" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
    <!-- end -->
  
        
        <?php
        if(isset($_GET['page'])) {
                    $page = strtolower($_GET['page']);
                    switch($page) {
                        case 'category_product' :
                            include_once "modules/product/category_product.php";
                            break;
                        case 'detail_product' :
                            include_once "modules/product/detail_product.php";  
                            break;   
                        
                        case 'search' :
                          include_once "modules/product/search.php";
                          break;  
                        case 'cart' :
                          include_once "modules/cart/cart.php"  ;
                          break;
                        case 'success':
                          include_once "modules/cart/success.php";
                           break;
                        case 'detail' :
                          include_once "modules/cart/detail.php";
                           break;

                           case 'edit_cut' :
                            include_once "edit_cut_login.php";
                             break;

                        case 'process_cart' :
                          include_once  "modules/cart/process_cart.php" ;
                          break;
                        case 'update_status_cust' :
                          include_once "modules/cart/update_status_cust.php" ;
                          break;
                        case 'comment' :
                          include_once  "modules/product/comment.php" ;
                          break;
                       }

                      } else {
                        include_once "modules/product/like_product.php"; 
                        include_once "modules/product/lastest_product.php";
                    }
                      ?>
        <!-- footer -->
        <div class="footer">
          <h4 class="slogan" >BOOKSHOP - TRI THỨC ĐI MUÔN NƠI</h4>
        </div>
        <script type="module"
          src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule
          src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
          crossorigin="anonymous"></script>
        <script
          src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
          integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
          crossorigin="anonymous"></script>
        <script
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
          integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
          crossorigin="anonymous"></script>
          <script src="admin/public/js/jquery-1.11.1.min.js"></script>
	          <script src="admin/public/js/bootstrap.min.js"></script>	
          <script src="admin/public/js/bootstrap-table.js"></script>
          <?php ob_end_flush(); ?>   
      </body>
    </html>