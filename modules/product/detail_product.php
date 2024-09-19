<?php
$conn = initConnection();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlPrdDetail = "SELECT * FROM products WHERE id = $id";
    $queryPrdDetail = mysqli_query($conn,$sqlPrdDetail);
} 
?>
<?php
if($prdDetail = mysqli_fetch_assoc($queryPrdDetail)) {
?>
<div class="row">
    <div class="col-1"></div>
    <div class="col-3">
    <img src="upload/img/<?php echo $prdDetail['prd_image']?>" alt="" height="400px" wight ="400px">

    </div>
    <div class="col-1" ></div>
    <div class= "col-6">
        <h1 style="color:red">
        <?php
        echo $prdDetail['prd_name'];
        ?>
        </h1>
        <h4> Mô tả sản phẩm : </h4>
        <div style = "margin-bottom: 10px">
            <?php
            echo $prdDetail['prd_desc'];
            ?>
        </div>
        <div style = "margin-bottom: 10px">  Số lượng :  <?php echo $prdDetail['prd_qty']; ?> sản phẩm.</div>
        <div style = "margin-bottom: 50px"> Giá thành : <?php echo $prdDetail['prd_price']; ?> VND. </div>
        
        <a  href="index.php?page=process_cart&a=add&id=<?php echo $prdDetail['id']?>" class="btn btn-danger"> Mua ngay </a>
        
        
        
    </div>    
</div>
	<!-- Comment	-->
<form method="POST" action="index.php?page=comment&b=com&id=<?php echo $prdDetail['id']?>">
 <div id="comment" class="row">
                             <div class = "col-1"></div>
                            <div class="col-lg-9 col-md-12 col-sm-12" style = "margin-top: 50px">
                                <h3>Bình luận sản phẩm</h3>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Tên:</label>
                                        <input  required type="text" class="form-control" name="comm_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input  required type="email" class="form-control" id="pwd" name="comm_mail">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung:</label>
                                        <textarea  required rows="8" class="form-control" name="comm_details"></textarea>
                                    </div>
                                    <button type="submit" name="sbm" class="btn btn-primary" style = "margin-top: 10px" >Gửi</button>
                                </form>
                            </div>
                        </div>
                        

</form>

<!--	End Comment	-->
<div class="row">
    <div class = "col-1"></div>
    <div class="col-6">
<?php
echo "<h3> Phản hồi của khách hàng </h3>";
$sqlCom = "SELECT * FROM comments WHERE prd_id = $id";
$queryCom = mysqli_query($conn,$sqlCom);    
?>

<?php
if(mysqli_num_rows($queryCom) > 0) {
while($com = mysqli_fetch_assoc($queryCom)) {
?>
<div><?php echo $com['com_name']?></div>
<div><?php echo $com['comment_at'] ?></div>
<div><?php echo $com['comment_detail'] ?></div>
<div>---------------------------------------------------------------------------------------------</div>
<?php
}} else {
    echo "chưa có phản hồi ";
}
?>
</div>
</div>
<!--	End Comment	-->








<?php
}else {
    header("location:index.php?page=detail_product");
}
?>


