<?php

$conn = initConnection();
 
if(isset($_GET['id'])) {
$id = $_GET['id'];
$sqlOrder = "SELECT * FROM order_detail WHERE order_id = $id ";
$queryOrder = mysqli_query($conn, $sqlOrder);
$sqlOrderDetail = "SELECT * FROM orders WHERE id = $id";
$queryOrderDetail = mysqli_query($conn,$sqlOrderDetail);
$detail = mysqli_fetch_assoc($queryOrderDetail);

?>



<div class="row">
			<div class="col-9">
				<h1 class="page-header">Chi tiết đơn hàng</h1>
			</div>
		</div><!--/.row-->
		<div> Mã đơn hàng :  <?php echo $detail['id']; ?> </div>
		<div> Họ tên : <?php echo $detail['receiver_name'];  ?></div>
		<div> Số điện thoại : <?php echo $detail['receiver_phone'];  ?></div>
		<div> Địa chỉ : <?php echo $detail['receiver_address'];  ?></div>
		<form action="index.php?page=update_status&id=<?php echo $id ?>" role="form" method="post" enctype="multipart/form-data">
		                                       <select name="status" id="">
													<option value="0"> Đang kiểm tra đơn hàng </option>
													<option value="1"> Đã kiểm tra </option>
													<option value="2"> Đang chuẩn bị đơn hàng </option>
													<option value="3"> Đang giao </option>
													<option value="4"> Đã nhận hàng</option>
													<option value="5"> Từ chối nhận hàng và chuyển về kho</option>
                                                    <option value="6"> Hủy </option>
												</select>
		<button name="sbm" type="submit"  class="btn btn-primary">  ⭳ Cập nhật </button> 
	</form>										

		
								<table  data-toolbar="#toolbar"
                            data-toggle="table">
									
		
									<thead>
									<tr>
										
										<th>Id sản phẩm </th>
										<th>
                                            Giá sản phẩm
                                        </th>
										<th>
											Hình ảnh 
										</th>
										<th>Số lượng sản phẩm </th>
										<th> Thời gian đặt hàng </th>
										
										<th> Trạng thái đơn hàng</th>
										
                                        
                                        

									</tr>
									</thead>
									<tbody>
									<?php
									if(mysqli_num_rows($queryOrder) > 0) {
                                    while($row = mysqli_fetch_assoc($queryOrder)) {
										$prd_image = $row['prd_id'];
										$sqlImage = "SELECT * FROM products WHERE id = $prd_image";
										$queryImage = mysqli_query($conn,$sqlImage);
										$image = mysqli_fetch_assoc($queryImage);
                                    
                                    ?>
                                    

										<tr>
											
											<td><?php echo $row['prd_id']; ?></td>
											<td><?php echo $row['prd_price']; ?></td>
											<td> <img width="90" height="120" src="../upload/img/<?php echo $image['prd_image']; ?>"></td>
											<td><?php echo $row['qty']; ?></td>
											<td> <?php echo $row['order_at']; ?> </td>
											
											<td> 
                                             <?php if($row['status'] == 0) {
												echo "Đang kiểm tra đơn hàng";
											 } if($row['status'] == 1) {
												echo " Đã kiểm tra ";
											 } 
											 if($row['status'] == 2) {
												echo " Đang chuẩn bị đơn hàng ";
											 } 
											 if($row['status'] == 3) {
												echo " Đang giao ";
											 } 
											 if($row['status'] == 4) {
												echo " Đã nhận hàng ";
											 } 
											 if($row['status'] == 5) {
												echo " Từ chối nhận hàng và chuyển về kho ";
											 } 
											 if($row['status'] == 6) {
												echo " Hủy ";
											 } 
											 
											 ?>
											 </td>
											 
											 
											 
                                               
										
                                            
										     
											
											
										</tr>
										<?php
                                    }
                                 }
                                ?>
									</tbody>
								</table>
								
									
									<div> Tổng tiền:  <?php echo $detail['total'] ;  ?> </div>
										
									</tbody>
								</table>

								<?php
}
								?>

    		