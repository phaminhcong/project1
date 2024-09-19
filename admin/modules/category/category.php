
<?php
$conn = initConnection();
$limit = 5;
$sqlTotal = "SELECT id FROM categories ";
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
$sqlAllCaregories = "SELECT * FROM categories ORDER BY id LIMIT $start,$limit ";
$queryAllCategories = mysqli_query($conn, $sqlAllCaregories);
?>

<body>
<div class="row">
			<div class="col-9">
				<h1 class="page-header">Quản lý danh mục</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page=add_category" class="btn btn-info">
                <i class="glyphicon glyphicon-plus"></i> + Thêm danh mục
            </a>
        </div>
		
								<table  data-toolbar="#toolbar"
                            data-toggle="table">
									
		
									<thead>
									<tr>
										<th>ID</th>
										<th>Tên danh mục</th>
										<th>created</th>
										<th>updated</th>
										<th> Hành động</th>

									</tr>
									</thead>
									<tbody>
									<?php
									if(mysqli_num_rows($queryAllCategories) > 0) {
                                    while($row = mysqli_fetch_assoc($queryAllCategories)) {

                                    
                                    ?>
                                    

										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['created_at']; ?></td>
											<td><?php echo $row['update_at']; ?></td>
											<td> <a href="index.php?page=delete_category&id=<?php echo $row['id'] ?>" onclick = " return xoa(); ">❌</a>
										         <a href="index.php?page=edit_category&id=<?php echo $row['id'] ?> "><ion-icon name="pencil-outline"></ion-icon></a></td>
											
											
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
				 <a class="page-link" href="index.php?page=category&current_page=<?php echo $prev ; ?>">&laquo;</a></li>
			 <?php
		 }
		 ?>
			 <!-- in các trang -->
			 <?php for($i=1; $i<= $TotalPages; $i++) {?>
				 <li class="page-item <?php if($i == $current_page) {echo 'active';} ?>"><a class="page-link" href="index.php?page=category&current_page=<?php echo $i; ?>"><?php echo $i; ?>
			 </a></li> 

			 <?php } ?>    
			 
			 <?php
			 if($current_page < $TotalPages) {
			 ?>
			 <li class="page-item">
				 <a class="page-link" href="index.php?page=category&current_page=<?php echo $next ; ?>">&raquo;</a></li>
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