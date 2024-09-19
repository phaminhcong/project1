
<?php
$conn = initConnection();
if(isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $level = $_POST['level'];
    $created_at = $_POST['created_at'];
    $update_at = $_POST['update_at'];
    $sqlCheck = "SELECT * FROM users WHERE email = '$email'";
    $queryCheck = mysqli_query($conn,$sqlCheck);
    if( mysqli_num_rows($queryCheck) > 0) {
          $error = '<div class="alert alert-danger"> Email đã tồn tại !</div>';
	}else { 	
		$sqlInsertUser = "INSERT INTO users(username,email,fullname,password,level,created_at,update_at)
		                      VALUE ('$username','$email','$fullname','$password','$level','$created_at','$update_at')";
		$queryInsertUser = mysqli_query($conn, $sqlInsertUser);
		if($queryInsertUser) {
			header ("location:index.php?page=user");
		}		
}
}

?>	
<div class="row">
			<div class="col-9">
				<h1 class="page-header">Thêm thành viên</h1>
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
                            	
                                <form role="form" method="post">
                                <div class="form-group">
                                    <label> Username </label>
                                    <input name="username" required class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" required type="text" class="form-control">
                                </div>   
                                <div class="form-group">
                                    <label> Họ và tên </label>
                                    <input name="fullname" required type="text" class="form-control">
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
                                <button name="sbm" type="submit" class="btn btn-success"> +Thêm mới</button>
                                <button type="reset" class="btn btn-default btn-warning"> ↺ Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	


