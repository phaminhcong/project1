<?php
$conn = initConnection(); 
if(isset($_GET['id'])) {
$id = $_GET['id'];
$sqlOldUser = " SELECT * FROM users WHERE id = $id ";
$queryOldUser = mysqli_query($conn,$sqlOldUser);
if(mysqli_num_rows($queryOldUser) > 0) {
    $user = mysqli_fetch_assoc($queryOldUser);
} else {
    header ("location:index.php?page=user");
} 
if(isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $level = $_POST['level'];
    $splCheckExists = "SELECT * FROM users WHERE email = '$email' ";
	
	$queryCheckExists = mysqli_query($conn, $splCheckExists );
	
	if( mysqli_num_rows($queryCheckExists) > 0) {
		
          $error = '<div class="alert alert-danger">Email đã tồn tại, Mật khẩu không khớp !</div>';
}else {
    $updateUser = " UPDATE users SET 
                       username = '$username',
                       email = '$email',
                       password = '$password',
                       fullname = '$fullname',
                       level = '$level' WHERE id = '$id' ";  
    mysqli_query($conn,$updateUser);
    header("location:index.php?page=user");                
}
}
}else {
    header("location:index.php?page=user");
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
                                    <label> Username </label>
                                    <input name="username" required class="form-control" placeholder="" value = '<?php echo $user['username'] ?>'>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" required type="text" class="form-control" value = '<?php echo $user['email'] ?>' >
                                </div>   
                                <div class="form-group">
                                    <label> Họ và tên </label>
                                    <input name="fullname" required type="text" class="form-control"  value = '<?php echo $user['fullname'] ?>'>
                                </div>  

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input name="password" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input name="password" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="level" class="form-control">
                                        <option value=1>Admin</option>
                                        <option value=2>Member</option>
                                    </select>
                                </div>
                                <button name="sbm" type="submit" class="btn btn-success"> 🠣 Cập nhật</button>
                                <button type="reset" class="btn btn-default btn-warning"> ↺ Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		