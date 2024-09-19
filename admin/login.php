<?php
session_start();
if(isset($_SESSION['user_logged'])) {
	header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="public/css/styles.css">
    <style>
   .login-panel {
    background-color: rgb(210, 215, 215);
   }
   </style>
</head>
<body>
    
    <div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading" > <h4> BOOKSHOP --- Quản trị </h4></div>
				<div class="panel-body">
					
					<?php
					 if(isset($_SESSION['error']['invalid_account'])) {
						echo $_SESSION['error']['invalid_account'];
						unset($_SESSION['error']['invalid_account']);
					 }
					?>
					<form action=" login-process.php " role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" value =" <?php if(isset($_SESSION['old_email'])) {echo $_SESSION['old_email'];}?>" type="email" autofocus>
								<?php
								      if(isset($_SESSION['error']['email'])) {
										echo $_SESSION['error']['email'];
										unset($_SESSION['error']['email']);
									  }
								?>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
								<?php
								      if(isset($_SESSION['error']['pass'])) {
										echo $_SESSION['error']['pass'];
										unset($_SESSION['error']['pass']);
									  }
								?>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" class="btn btn-primary">Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
   





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>