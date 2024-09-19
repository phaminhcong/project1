<?php
$conn = initConnection();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlCat = "SELECT * FROM categories WHERE id = $id ";
    $queryCat = mysqli_query($conn,$sqlCat);
    $resultCat = mysqli_fetch_assoc($queryCat);
    $cat_name = $resultCat['name'];
    $limit = 4;
    $sqlTotalCatPrd = "SELECT * FROM products WHERE cat_id = $id";
    $queryTotalCatPrd = mysqli_query($conn,$sqlTotalCatPrd);
    $totalRecords = mysqli_num_rows($queryTotalCatPrd);
    $totalPage = ceil($totalRecords/$limit);
    if(isset($_GET['p'])) {
        $p = $_GET['p'];

    }else {
        $p=1;
    }
    if($p<1){
        $p =1;
    }
    if($p > $totalPage && $totalPage > 1) {
        $p = $totalPage;
    }
    $start = ( $p - 1) * $limit;
    $sqlCatPrd = "SELECT * FROM products WHERE cat_id = $id LIMIT $start,$limit ";
    $queryCatPrd = mysqli_query($conn,$sqlCatPrd);
}else {
    header("location:index.php");
}
?>
<div class="t1">
     <h2 class="underline"> <ion-icon name="thumbs-up-outline"></ion-icon>
     <?php echo $cat_name; ?> </h2>
    </div>     
    <div class="row">
         <?php 
         
         if(mysqli_num_rows($queryCatPrd) > 0) {
         while($prd = mysqli_fetch_assoc($queryCatPrd)) { ?>
            <div class="col-md-6 col-lg-3 mb-4">
              <div class="card" style="width: 18rem;">
              <a href="index.php?page=detail_product&id=<?php echo $prd['id']; ?>">
                
                <img src="upload/img/<?php echo $prd['prd_image']?>" height="400px" class="card-img-top" alt="..."  ></a>
                <div class="card-body">
                <h4 class="card-title">
                    <?php echo  $prd['prd_name'] ?>
                </h4>
                <p>Tác giả :  <?php echo $prd['author']?> </p>
                
                <p style="
                  color:green;
                  display:inline-block;
                  white-space: nowrap;
                  overflow: hidden;
                  text-overflow: ellipsis;
                  max-width: 20ch;">
                 <?php echo $prd['prd_desc']?>
                 </p>
                  <h5>Giá : <?php echo $prd['prd_price'] ?> VND </h5>
                <a href="index.php?page=detail_product&id=<?php echo $prd['id']?>" class="btn btn-danger"> Mua ngay </a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">⭐⭐⭐⭐⭐</small>
                </div>
            </div>
            </div>
            <?php }}
            else {
                echo '<h3 style = "margin-left: 400px"> Chưa có sản phẩm nào  </h3>';
            }
            
            ?>
            
            
          </div>

          <div id="pagination">
                        <ul class="pagination">
                            <?php
                            if($p>1){
                                $prev = $p - 1;
                                ?>
                             
                             <li class="page-item  ">
                                <a class="page-link" href="index.php?page=category_product&id=<?php echo $id ?>&p=<?php echo $prev?>">Trang trước</a>
                                 </li>
                            <?php
                            }
                            ?>
                            <!-- giua -->
                            <?php
                            for($i = 1; $i <= $totalPage; $i++){
                            ?>
                            
                            <li class="page-item <?php if( $i == $p) {echo 'active';}?>">
                                <a class="page-link" href="index.php?page=category_product&id=<?php echo $id ?>&p=<?php echo $i;?>">
                                <?php echo $i; ?>
                                </a>
                            </li>
                            
                           <?php
                            }
                           ?>
                           
                        <?php
                            if($p < $totalPage && $totalPage > 1){
                                $next = $p + 1;
                                ?>
                             
                             <li class="page-item">
                                <a class="page-link" href="index.php?page=category_product&id=<?php echo $id ?>&p=<?php echo $next?>">
                                Trang sau</a>
                            
                                 </li>
                            <?php
                            }
                            ?>
                            </ul>
                    </div>         