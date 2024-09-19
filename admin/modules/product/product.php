<?php
$conn = initConnection();
$limit = 5;
$sqlTotal = "SELECT id FROM products";
$querytotal = mysqli_query($conn,$sqlTotal);
// dem
$TotalRecords = mysqli_num_rows($querytotal);
$TotalPages = ceil($TotalRecords / $limit);
if(isset($_GET['current_page'])) {
    $current_page = $_GET['current_page'];

}else {
    $current_page = 1;
}
if($current_page < 1) {
    $current_page = 1;
}
if ($current_page > $TotalPages && $TotalPages > 1 ) {
    $current_page = $TotalPages;
}
$start = ($current_page - 1) * $limit;
$sqlAllProduct = "SELECT p.*, c.name FROM products p INNER JOIN categories c ON p.cat_id = c.id ORDER BY id LIMIT $start,$limit";
$queryAllProduct = mysqli_query($conn, $sqlAllProduct);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
   	
		
		
		<div class="row">
			
            
                <h1 class="page-header">Danh sách sản phẩm</h1>
         
        <!--/.row-->
        <div id="toolbar" class="btn-group">
            <a href="index.php?page=add_product" class="btn btn-info">
                <i class="glyphicon glyphicon-plus"></i> + Thêm sản phẩm
            </a>
                 </div>
        
                        <table data-toolbar="#toolbar"
                            data-toggle="table" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th> Ảnh sản phẩm  </th>
                                    
                                    <th>Thể loại</th>
                                    <th> Tác giả </th> 
                                    <th> Số lượng</th>
                                    <th>Hành động</th>
                                    
                                    
                                      
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //lay du lieu
                                if(mysqli_num_rows($queryAllProduct) > 0) {
                                    while($row = mysqli_fetch_assoc($queryAllProduct)) {
                                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['prd_name']; ?></td>
                                    <td><?php echo number_format ($row['prd_price'],0,',','.'); ?> VNĐ</td>
                                    <td> <img width="90" height="120" src="../upload/img/<?php echo $row['prd_image']; ?> "></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td> <?php echo $row['prd_qty']?></td>
                                    <td>  <a href="index.php?page=delete_product&id=<?php echo $row['id'] ?>" onclick = " return xoa(); " >❌</a>
										         <a href="index.php?page=edit_product&id=<?php echo $row['id'] ?> "><ion-icon name="pencil-outline"></ion-icon></a></td>
                                    
                                    </td>             

                                </tr>
                                <?php
                                    }
                                 }
                                ?>
                                
                            </tbody>
                        </table>
                                </div>  
                            </div>
                             <!-- footer  -->
                 <nav aria-label="Page navigation example">

                   <ul class="pagination">
                   <?php
                   if($current_page >1) {
                              ?>
                              <li class="page-item">
                                  <a class="page-link" href="index.php?page=product&current_page=<?php echo $prev ; ?>">&laquo;</a></li>
                              <?php
                          }
                          ?>
                              <!-- in các trang -->
                              <?php for($i=1; $i<= $TotalPages; $i++) {?>
                                  <li class="page-item <?php if($i == $current_page) {echo 'active';} ?>"><a class="page-link" href="index.php?page=product&current_page=<?php echo $i; ?>"><?php echo $i; ?>
                              </a></li> 

                              <?php } ?>    
                              
                              <?php
                              if($current_page < $TotalPages) {
                              ?>
                              <li class="page-item">
                                  <a class="page-link" href="index.php?page=product&current_page=<?php echo $next ; ?>">&raquo;</a></li>
                              <?php
                          }
                          ?>           
                             </ul>
                        </nav>
<!-- end -->          
        </div>   
 
        <script>
            function xoa() {
                return confirm("Bạn có muốn xóa?");
            }
        </script>
