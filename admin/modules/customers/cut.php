<?php
$conn = initConnection();
$limit = 5;
$sqlTotal = "SELECT id FROM customers ";
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
$sqlAllCut = " SELECT * FROM customers ORDER BY id LIMIT $start,$limit ";
$queryAllCut = mysqli_query($conn,$sqlAllCut);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    a {
	text-decoration: none;
}
</style>
</body>
</html>


<div class="row">
			<div class="col-9">
				<h1 class="page-header">Danh sách khách hàng</h1>
			</div>
		</div><!--/.row-->
		
				<div class="panel panel-default">
					<div class="panel-body">
                        <table  data-toolbar="#toolbar"
                            data-toggle="table"  >

						    <thead>
						        <tr>
						        <th>ID</th>
						        <th>username</th>
                                <th>Email</th>
                                <th>ho&ten</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //lay du lieu
                                if(mysqli_num_rows($queryAllCut) > 0) {
                                    while($row = mysqli_fetch_assoc($queryAllCut)) {
                                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['fullname']; ?> </td>
                                    
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
                                    <a class="page-link" href="index.php?page=cut&current_page=<?php echo $prev ; ?>">&laquo;</a></li>
                                <?php
                            }
                            ?>
                                <!-- in các trang -->
                                <?php for($i=1; $i<= $TotalPages; $i++) {?>
                                    <li class="page-item <?php if($i == $current_page) {echo 'active';} ?>"><a class="page-link" href="index.php?page=cut&current_page=<?php echo $i; ?>"><?php echo $i; ?>
                                </a></li> 

                                <?php } ?>    
                                
                                <?php
                                if($current_page < $TotalPages) {
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=cut&current_page=<?php echo $next ; ?>">&raquo;</a></li>
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