<?php
if(isset($_SESSION['cart'])) {
$conn = initConnection();
$listId = "";
foreach($_SESSION['cart'] as $id => $value) {
   $listId.="$id,";//1,2,3
}
$listId = rtrim($listId,",");//1,2,3
$listId = "(".$listId.")";//(1,2,3)
$sqlCartPrd = "SELECT * FROM products WHERE id IN $listId ";
$queryCartPrd = mysqli_query($conn, $sqlCartPrd);
?>
    <div class="row">
      <div class="col-2"></div>
    <table border="0" cellpadding="30px" cellspacing="0"  class="col-8">
      <thead>
      <th> Thông tin </th>
      <th> Đơn giá </th>
      <th> Số lượng </th>
      <th> Thành tiền</th>
      <th> Hành động</th>
    </thead>
    <tbody>
  <form method="post" action ="index.php?page=process_cart&a=update">
    <?php
                        $total = 0;
                        if(mysqli_num_rows($queryCartPrd) >0) {
                                while($row = mysqli_fetch_assoc($queryCartPrd) ) {
                                    $id = $row['id'];
                                    $price = $_SESSION['cart'][$id]['price'];
                                    $qty = $_SESSION['cart'][$id]['qty'];
                                    $subTotal = $price * $qty;
                                    $total += $subTotal;

                                ?>
      <tr>
        <td><img src="upload/img/<?php echo $row['prd_image']?>" alt="" width="100px" height="150px"> <p> <?php echo $row['prd_name']; ?> </p></td>
        <td> <?php echo $row['prd_price']; ?> VND. </td>
        <td> <input type="number" id="quantity" name = "quantity[<?php echo $id; ?>]"  class="form-control form-blue quantity" value="<?php echo $qty;?>"
                                        min="1"></td>
        <td>     <?php echo $subTotal; ?> VND. </b>   </td>
        <td> <a href="index.php?page=process_cart&a=delete&id=<?php echo $row['id']?>">❌</a>  </td>
      </tr>
      
  <?php
                                }
   ?>
<tr>
        <td colspan="2" > <button class="btn btn-success" type="submit" name="sbm"> Cập nhật giỏ hàng  </button></td>
        
        <td></td>
        <td colspan="2"> <h6>Tổng cộng : <?php echo $total ?> VND.  </h6></td>
      </tr>

  </form>
    </tbody>
    </table>
    <div class="col-2"></div>
  </div>
  <!-- order -->

  <form method="post" action="index.php?page=process_cart&a=checkout" >
  
                          <div class="row" >
                              <div class="col-2"></div>
                                <div id="customer-name" class="col-lg-3 col-md-4 col-sm-12">
                                    <input placeholder=" Họ và tên (bắt buộc)" type="text" name="name"
                                        class="form-control" required>
                                </div>
                                <div id="customer-phone" class="col-lg-2 col-md-4 col-sm-12">
                                    <input placeholder="Số điện thoại(bắt buộc)" type="text" name="phone"
                                        class="form-control" required>
                                </div>
                                <div id="customer-mail" class="col-lg-3 col-md-4 col-sm-12" style = " margin-bottom: 20px;">
                                    <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control"
                                        required>
                                </div>
                                <div class="col-2"></div>
                          </div>
                                
                          <div class="row">
                              <div class="col-2"></div>
                                <div id="customer-add" class="col-lg-8 col-md-12 col-sm-12" style = " margin-bottom: 20px;">
                                    <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text"
                                        name="address" class="form-control" required>
                                </div>
                                </div>
                                <div class="col-2"></div>
                          </div>
                          <div class="row">
                              <div class="col-4"></div>
                             <div class="by-now col-lg-3 col-md-6 col-sm-12">
                                <button class="btn btn-danger" type = "submit">
                                    <div>Mua ngay</div>
                                    <div>Giao hàng tận nơi siêu tốc</span>
                                </button>
                            </div>
                            <div class="by-now col-lg-3 col-md-6 col-sm-12">
                            <button class="btn btn-primary btn-sm">
                                    <div>Trả góp Online</div>
                                    <span>Vui lòng gọi 0987654321</span>
                                </a>
                                </button>
                              <div class="col-4"></div>
                          </div>      
                                
                
  </form>
  <!-- end  -->
  <?php
                        }
   ?>                
   <?php
} else {
  echo '<h1 style = "margin-left: 300px"> Không có sản phẩm nào trong giỏ hàng </h1>';
}
   ?>
   
