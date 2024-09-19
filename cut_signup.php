<?php
require_once "config/db.php";
$conn = initConnection();
if(isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    
    $sqlCheck = "SELECT * FROM customers WHERE email = '$email'";
    $queryCheck = mysqli_query($conn,$sqlCheck);
    if( mysqli_num_rows($queryCheck) > 0) {
		
          $error = '<div class="alert alert-danger"> Email đã tồn tại !</div>';
	}else { 	
		
		$sqlInsertUser = "INSERT INTO customers(username,email,fullname,password)
		                      VALUE ('$username','$email','$fullname','$password')";
		$queryInsertUser = mysqli_query($conn, $sqlInsertUser);
		if($queryInsertUser) {
			header ("location:cut_login.php");
		}
					  

		
}
}



?>

		
		
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="public/css/bootstrap-table.css" rel="stylesheet">		
<div class="row">
    <div class = "col-3"></div>
			<div class="col-9">
				<h1 class="page-header"> ĐĂNG KÝ </h1>
			</div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-3"></div>
                <div class="col-lg-9">
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
                                
                                <button name="sbm" type="submit" class="btn btn-success"> Đăng ký </button>
                                
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
