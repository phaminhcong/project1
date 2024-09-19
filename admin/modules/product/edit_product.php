<?php
$conn = initConnection();
// lay du lieu cu 
if(isset($_GET['id'])) {
	$id = $_GET['id'];
    $sqlOldProduct = "SELECT * FROM products WHERE id = '$id' ";
    $queryOldProduct = mysqli_query($conn,$sqlOldProduct);
if(mysqli_num_rows($queryOldProduct) > 0) {
   $product = mysqli_fetch_assoc($queryOldProduct);
} else {
    header ("location:index.php?page=product ");
}
if(isset($_POST['sbm'])) {
$prd_name = $_POST['prd_name'];
$prd_price = $_POST['prd_price'];
$prd_qty = $_POST['prd_qty'];
$prd_desc = $_POST['prd_desc'];
$author = $_POST['author'];
$cat_id = $_POST['cat_id'];
$prd_like = $_POST['prd_like'];
if(isset($_POST['prd_like'])) {
    $prd_like = 1;
}else {
    $prd_like = 0;
}
if(isset($_FILES['prd_image']['name'])) {
    $file_name = $_FILES['prd_image']['name'];
    $file_tmp_name = $_FILES['prd_image']['tmp_name'];
    move_uploaded_file($file_tmp_name, '../../../upload/product/'.$file_name);
} else {
    $file_name = $product['prd_image'];
}
$sqlUpdateProduct = " UPDATE products SET 
                          prd_name = '$prd_name',
                          prd_price ='$prd_price',
                          prd_qty ='$prd_qty',
                          prd_desc ='$prd_desc',
                          author = '$author',
                          cat_id ='$cat_id',
                          prd_like = '$prd_like',
                          prd_image = '$file_name' WHERE id = '$id' ";
    mysqli_query($conn,$sqlUpdateProduct);
    header("location:index.php?page=product");
}
}else {
    header ("location:index.php?page=product");
}
?>
<div class="row">
                <div class="col-4">
                    <form action="" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input required name="prd_name" class="form-control" value="<?php echo $product['prd_name']?>" placeholder=""  >
                    </div>
                                                    
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input required name="prd_qty" type="number" min="0" class="form-control" value = "<?php echo $product['prd_qty'] ?>">
                    </div>
                      
                    
                    <div class="form-group">
                        <label> Giá thành  </label>
                        <input required name="prd_price" type="text" class="form-control"  value = "<?php echo $product['prd_price'] ?>">
                    </div> 
                    <div class="form-group">
                        <label> tác giả   </label>
                        <input required name="author" type="text" class="form-control" value = "<?php echo $product['author'] ?>" >
                    </div>  

                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        
                        <input required name="prd_image" type="file" onchange = "preview();">
                        <br>
                        <div>
                            <img src="../upload/img/<?php echo $product['prd_image']?>" id="prd_image" width ="150" height="200">
                        </div>
                    </div>
                    <div class="form-group">
                                <label>Danh mục</label>
                                
                                    <?php
                                    $sqlCategories = "SELECT * FROM categories ORDER BY id";
                                    $queryCategories = mysqli_query($conn,$sqlCategories );
                                    ?>
                                    <select name="cat_id" class="form-control">
                                        <?php
                                        while($row= mysqli_fetch_assoc($queryCategories)) {
                                        ?> 
                                      <option
                                      <?php 
                                        if($row['id'] == $product['cat_id']) {
                                            echo "selected";
                                        }
                                          ?>
                                          value = "<?php echo $row['id'];?>" >
                                        <?php echo $row['name'];?>
                                          
                                      </option>    
                                            
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                       

                                    </select>
                                </div>
                    
                    
                                <div class="form-group">
                                    <label>Sản phẩm nổi bật</label>
                                    <div class="checkbox">
                                        <label>
                                            <input name="prd_like" type="checkbox" value = 1>Nổi bật
                                        </label>
                                        
                                    </div>
                                </div>
                    
                    <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea required name="prd_desc" class="form-control" rows="3" > <?php echo $product['prd_desc'] ?> </textarea>
                        </div>
                        <button name="sbm" type="submit"  class="btn btn-success"> 🠣 Cập nhật</button>
                            <button type="reset" class="btn btn-default btn-warning"> ↺ Làm mới</button>
                </div>
            </form>
           
        
   
</div><!-- /.row -->
<script>
        function preview() {
        prd_image.src= URL.createObjectURL(event.target.files[0]);
        }

    
</script>