<?php
$conn = initConnection();
$sqlProLast = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
$queryProLast = mysqli_query($conn,$sqlProLast);

?>
<div class="t1">
     <h2 class="underline"> <ion-icon style="color: rgb(235, 235, 47);" name="notifications-outline"></ion-icon>
     SẢN PHẨM MỚI NHẬP </h2>
    </div>     
    <div class="row">
         <?php while($prd = mysqli_fetch_assoc($queryProLast)) { ?>
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
            <?php } ?>
            
            
          </div>