<?php
$conn = initConnection();
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
if(isset($_POST['keyword'])) {
$keyword = $_POST['keyword'];
}

// Tách từ khóa thành các từ riêng biệt
$arr = explode(' ', $keyword);

// Gộp các điều kiện tìm kiếm thành một chuỗi
$str = '%'.implode('%', $arr).'%';
$limit =3;

// Thực hiện truy vấn tìm kiếm với điều kiện gần đúng
$sqlTotalSearch  = "SELECT * FROM products WHERE prd_name LIKE '$str'";

$queryTotalSearch = mysqli_query($conn, $sqlTotalSearch);
$totalRecords = mysqli_num_rows($queryTotalSearch);
$totalPages = ceil($totalRecords/$limit);
if(isset($_GET['p'])) {
    $p = $_GET['p'];
}else {
    $p=1;
}
if($p<1){
    $p =1;
}
if($p > $totalPages && $totalPages > 1) {
    $p = $totalPages;
}
$start = ($p - 1) * $limit;
$sqlSearch = "SELECT * FROM products WHERE prd_name LIKE '$str' LIMIT $start, $limit";
$querySearch = mysqli_query($conn, $sqlSearch);


    
?>

                    <!--	List Product	-->
            <div class="products">
                        
                        <div id="search-result">Kết quả tìm kiếm với sản phẩm <span style="color: red"><?php echo $keyword ?></span>
                        </div>

                        <div class="product-list row">

                           
                            <?php if(mysqli_num_rows($querySearch) > 0) {
                                while($product=mysqli_fetch_assoc($querySearch)) {
                             ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                            <div class="product-item card text-center">
                                <a href="index.php?page=detail_product&id=<?php echo $product['id']?>">
                                <img src="upload/img/<?php echo $product['prd_image']  ?>" height="400px" wight ="400px"></a>
                                <h4><a href="index.php?page=detail_product&id=<?php echo $product['id']?>">
                                <?php echo $product['prd_name']; ?>
                            </a>
                        </h4>
                                <p>Giá Bán: <span><?php echo number_format($product['prd_price'],0,',',',');?> VND </span></p>
                            </div>
                        </div>
                            <?php
                                }
                              } else {
                                echo "khong co san pham nao";
                              }
                            
                                 ?>
                        </div>     
                    </div>
                   <!--	End List Product	-->
                   <div id="pagination">
                        <ul class="pagination">
                            <?php
                            if($p>1){
                                $prev = $p - 1;
                                ?>
                             
                             <li class="page-item  ">
                                <a class="page-link" href="index.php?page=search&p=<?php echo $prev?>&keyword=<?php echo $keyword;  ?>">Trang trước</a>
                                 </li>
                            <?php
                            }
                            ?>
                            <!-- giua -->
                            <?php
                            for($i = 1; $i <= $totalPages; $i++){
                            ?>
                            
                            <li class="page-item <?php if( $i == $p) {echo 'active';}?>">
                                <a class="page-link" href="index.php?page=search&p=<?php echo $i?>&keyword=<?php echo $keyword;?>">
                                <?php echo $i; ?>
                                </a>
                            </li>
                            
                           <?php
                            }
                           ?>
                           
                        <?php
                            if($p < $totalPages && $totalPages > 1){
                                $next = $p + 1;
                                ?>
                             
                             <li class="page-item">
                                <a class="page-link" href="index.php?page=search&p=<?php echo $next?>&keyword=<?php echo $keyword ?>">
                                Trang sau</a>
                            
                                 </li>
                                </ul>
                            <?php
                            }
                            ?>
                            </ul>
                        </div>
                            
                  
                   
             

                    

                

                