<?php
$conn = initConnection();
$limit = 5;
$sqlTotal = "SELECT id FROM comments ";
$queryTotal = mysqli_query($conn,$sqlTotal);
$TotalRecords = mysqli_num_rows($queryTotal);
$TotalPages = ceil($TotalRecords / $limit);
if(isset($_GET['current_page'])) {
    $current_page = $_GET['current_page'];

}else {
    $current_page = 1;
}
// bam ve trang truoc
if($current_page < 1) {
    $current_page = 1;
}
// trang sau
if($current_page > $TotalPages && $TotalPages > 1) {
    $current_page = $TotalPages;
}
$start = ($current_page - 1) * $limit;
$sqlCom = "SELECT * FROM comments ORDER BY id LIMIT $start,$limit ";
$queryCom = mysqli_query($conn, $sqlCom);
?>
<div class="row">
			<div class="col-9">
				<h1 class="page-header">Bình luận sản phẩm</h1>
			</div>
		</div><!--/.row-->
		
		
								<table  data-toolbar="#toolbar"
                            data-toggle="table">
									
		
									<thead>
									<tr>
										<th>ID</th>
										<th>ID sản phẩm</th>
										<th>Tên khách hàng</th>
										<th>Email </th>
										<th> Bình luận </th>
                                        
										<th>Hành động</th>

									</tr>
									</thead>
									<tbody>
									<?php
									if(mysqli_num_rows($queryCom) > 0) {
                                    while($row = mysqli_fetch_assoc($queryCom)) {

                                    
                                    ?>
                                    

										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['prd_id']; ?></td>
											<td><?php echo $row['com_name']; ?></td>
											<td><?php echo $row['com_mail']; ?></td>
											<td> <?php echo $row['comment_detail']; ?> </td>
                                            
										     <td> <a href="index.php?page=delete_comment&id=<?php echo $row['id'] ?>" onclick = " return xoa(); ">❌</a> </td>
											
											
										</tr>
										<?php
                                    }
                                 }
                                ?>
									</tbody>
								</table>
<!-- footer  -->
<nav aria-label="Page navigation example">

<ul class="pagination">
 <?php
  if($current_page >1) {
			 ?>
			 <li class="page-item">
				 <a class="page-link" href="index.php?page=comment&current_page=<?php echo $prev ; ?>">&laquo;</a></li>
			 <?php
		 }
		 ?>
			 <!-- in các trang -->
			 <?php for($i=1; $i<= $TotalPages; $i++) {?>
				 <li class="page-item <?php if($i == $current_page) {echo 'active';} ?>"><a class="page-link" href="index.php?page=comment&current_page=<?php echo $i; ?>"><?php echo $i; ?>
			 </a></li> 

			 <?php } ?>    
			 
			 <?php
			 if($current_page < $TotalPages) {
			 ?>
			 <li class="page-item">
				 <a class="page-link" href="index.php?page=comment&current_page=<?php echo $next ; ?>">&raquo;</a></li>
			 <?php
		 }
		 ?>           
	   </ul>
 </nav>
<!-- end -->                                
<script>
            function xoa() {
                return confirm("Bạn có muốn xóa?");
            }
        </script>