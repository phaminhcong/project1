<?php
//ket noi csdl
$conn=initConnection();
?>
	
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm sản phẩm</h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                
                    
                            <div class="col-4">
                                <form action="modules/product/add_product_process.php" role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required name="prd_name" class="form-control" placeholder="">
                                </div>
                                                                
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input required name="prd_qty" type="number" min="0" class="form-control">
                                </div>
                                  
                                
                                <div class="form-group">
                                    <label> Giá thành  </label>
                                    <input required name="prd_price" type="text" class="form-control">
                                </div> 
                                <div class="form-group">
                                    <label> tác giả   </label>
                                    <input required name="author" type="text" class="form-control">
                                </div>  
                                 

                                
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    
                                    <input required name="prd_image" type="file" onchange = "preview();">
                                    <br>
                                    <div>
                                        <img src="../upload/img/imgno.jpg" id="prd_image" width ="150" height="200">
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
                                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                        }
                                        ?>
                                        
                                        
                                    </select>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>Sản phẩm nổi bật</label>
                                    <div class="checkbox">
                                        <label>
                                            <input name="prd_like" type="checkbox" value=1>Nổi bật
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea required name="prd_desc" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button name="sbm" type="submit"  class="btn btn-success"> + Thêm mới</button>
                            <button type="reset" class="btn btn-default btn-warning"> ↺ Làm mới</button>
                            </div>
                        </form>
                       
                    
               
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
    <script>
        function preview() {
        prd_image.src= URL.createObjectURL(event.target.files[0]);
        }

    
</script>