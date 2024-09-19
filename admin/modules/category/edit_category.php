<?php
$conn = initConnection();
// lay du lieu cu 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlOldCategory = "SELECT * FROM categories WHERE id = '$id'";
    $queryOldCategory = mysqli_query($conn, $sqlOldCategory);
    if(mysqli_num_rows( $queryOldCategory) > 0) {
        $result = mysqli_fetch_assoc($queryOldCategory);
    } else {
        header("location:index.php?page=category");
    }
 
    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $splCheckExists = " SELECT * FROM categories WHERE name = '$name' ";
        $queryCheckExists = mysqli_query($conn, $splCheckExists);
        if( mysqli_num_rows($queryCheckExists) > 0) {
        $error = '<div class="alert alert-danger"> Danh mục đã tồn tại !</div>';
        }else {
            $sqlUpdateCategory = " UPDATE categories SET name = '$name' WHERE id = '$id' ";
            $queryUpdateCategory = mysqli_query($conn, $sqlUpdateCategory);
            header("location:index.php?page=category");
        }
        }
    }else {
            header("location:index.php?page=category");
        }
?>
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
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="name" required value = "<?php echo $result['name'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button name="sbm" type="submit"  class="btn btn-success"> 🠣 Cập nhật</button>
                            <button type="reset" class="btn btn-default btn-warning"> ↺ Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	
