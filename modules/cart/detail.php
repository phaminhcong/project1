<?php
$conn = initConnection();
if(isset($_GET['cust_id'])) {
$cust_id = $_GET['cust_id'];
$sqlOrder = "SELECT * FROM order_detail WHERE cust_id = $cust_id  ";
$queryOrder = mysqli_query($conn, $sqlOrder);


?>
<div class="row">
	
	
			
				<h1 class="page-header">Chi tiết đơn hàng</h1>
		
								<table  data-toolbar="#toolbar"
                            data-toggle="table">
									<thead>
									<tr>
										<th> Họ tên </th>
										<th>Tên sản phẩm </th>
										<th>
                                            Giá sản phẩm
                                        </th>
										<th>
											Hình ảnh 
										</th>
										<th>Số lượng sản phẩm </th>
										<th> Thời gian đặt hàng </th>
										
										<th> Trạng thái đơn hàng</th>
										<th>
											Tổng 
										</th>
										
										<th>
											Hành động
										</th>
										
                                        
                                        

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
										$order_id = $row['order_id'];
										$sqlOrderDetail = "SELECT * FROM orders WHERE id = $order_id  ";
                                        $queryOrderDetail = mysqli_query($conn,$sqlOrderDetail);
                                        $detail = mysqli_fetch_assoc($queryOrderDetail);
                                    
                                    ?>
										<tr>
											<td> <?php echo  $detail['receiver_name'] ?></td>
											<td><?php echo $image['prd_name']; ?></td>
											<td><?php echo $row['prd_price']; ?></td>
											<td> <img width="90" height="120" src="upload/img/<?php echo $image['prd_image']; ?>"></td>
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
											 
											       
											 <td> <?php echo  $detail['total'] ?> VND </td>
											 <td>
											 <?php if($row['status'] == 0) { ?><form action="index.php?page=update_status_cust&id=<?php echo $order_id ?>" role="form" method="post" enctype="multipart/form-data" >
		                                       <select name="status" id="">
                                                    <option value="6"> Hủy </option>
												</select>
		                                       <button name="sbm" type="submit" onclick = " return xoa(); "  > ⭳ </button> 
	                                         </form></td>
												 <?php  } ?>
											
											
											 
                                               
										
                                            
										     
											
											
										</tr>
										<?php
                                    }
                                 } else {
									echo "<h3>chưa có đơn hàng nào</h3>";
								 }
								
                                ?>
									</tbody>
								</table>
								
									
									
										
									</tbody>
								</table>
								</div>
								</div>
								<?php
}
								?>
<script>
 function xoa() {
    return confirm("Bạn có chắc chắn muốn hủy ?");            
            }           
</script>

    		