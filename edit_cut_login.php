<?php
$conn = initConnection(); 
include_once "config/db.php";
if(isset($_GET['cust_id'])) {
$cust_id = $_GET['cust_id'];
$sqlOldUser = " SELECT * FROM customers WHERE id = $cust_id ";
$queryOldUser = mysqli_query($conn,$sqlOldUser);
if(mysqli_num_rows($queryOldUser) > 0) {
    $user = mysqli_fetch_assoc($queryOldUser);
} else {
    header ("location:index.php");
} 
if(isset($_POST['sbm'])) {
    $username = $_POST['username1'];
    $email = $_POST['email1'];
    $password = $_POST['password1'];
    $fullname = $_POST['fullname1'];
    
    $splCheckExists = "SELECT * FROM customers WHERE email = '$email' ";
	
	$queryCheckExists = mysqli_query($conn, $splCheckExists );
	
	if( mysqli_num_rows($queryCheckExists) > 0) {
		
          $error = '<div class="alert alert-danger">Email đã tồn tại, Mật khẩu không khớp !</div>';
}else {
    $updateUser = " UPDATE customers SET 
                       username = '$username',
                       email = '$email',
                       password = '$password',
                       fullname = '$fullname'
                       WHERE id = '$cust_id'; ";  
    mysqli_query($conn,$updateUser);
    header("location:index.php");                 
    
}
}

}else {
    header("location:index.php");
}


?>

<div class="row">
    <div class = "col-3" ></div>
                <div class="col-9">
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
                                    <label> Username </label>
                                    <input name="username1" required class="form-control" placeholder="" value = '<?php echo $user['username'] ?>'>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email1" required type="text" class="form-control" value = '<?php echo $user['email'] ?>' >
                                </div>   
                                <div class="form-group">
                                    <label> Họ và tên </label>
                                    <input name="fullname1" required type="text" class="form-control"  value = '<?php echo $user['fullname'] ?>'>
                                </div>  

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input name="password1" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input name="password1" required type="password"  class="form-control">
                                </div>
                                
                                <button name="sbm" type="submit" onclick = " return xoa(); " class="btn btn-success"  > 🠣 Cập nhật</button>
                        </form>   
                            
                        
                    </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
            <script>
            function xoa() {
                return confirm("Bạn có muốn thay đổi?");
            }
              </script>
		