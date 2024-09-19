
<?php
if(isset($_POST['sbm'])) {
	$name = $_POST['name'];
	$conn = initConnection();
	$splCheckExists = "SELECT * FROM categories WHERE name = '$name' ";
	$queryCheckExists = mysqli_query($conn, $splCheckExists );
	if( mysqli_num_rows($queryCheckExists) > 0) {
	
          $error = '<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
	}else {
	$sqlInsertCategory = "INSERT INTO categories(name)
		                      VALUE ('$name')";
		$queryInsertCategory = mysqli_query($conn, $sqlInsertCategory);
		if($queryInsertCategory) {
		
	
		header ("location:index.php?page=category");
	   } else {
		$insertFailed = 'div class="alert alert-danger">Thêm danh mục không thành công</div>';

	   }
	}
}
?>
	
<div class="row">
			<div class="col-9">
				<h1 class="page-header">Thêm danh mục</h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                        <?php
							if(isset($error)) {
								echo $error;
							}
							?>
							<?php
							if(isset($insertFailed)) {
								echo $insertFailed;
							}
							?>
                            <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input required type="text" name="name" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button name="sbm" type="submit"  class="btn btn-success"> + Thêm mới</button>
                            <button type="reset" class="btn btn-default btn-warning"> ↺ Làm mới</button>
                        </div>
                    	</form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	