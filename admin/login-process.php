<?php
session_start();
include_once "../config/db.php";
$email = $_POST['email'];
$pass = $_POST['pass'];
if(empty($_POST['email'])) {
    $_SESSION['error']['email'] = '<div class="error-text text-danger"> Email không được để trống! </div>';
    header("location:login.php");
}else {
   
   $email = $_POST['email'];
   $_SESSION['old_email'] = $email;
 }
if(empty($_POST['pass'])) {
    $_SESSION['error']['pass'] = '<div class="error-text text-danger"> Mật khẩu không được để trống! </div>';
     header("location:login.php");
   
    }else {
     $pass = $_POST['pass'];
  } 
// dang nhap 
if(isset($email) && isset($pass)) {
    $conn = initConnection();
    $sqlLogin = "SELECT * FROM users WHERE email = '$email' AND password  = '$pass' ";
    $queryLogin = mysqli_query($conn,$sqlLogin);
    // kiem tra du lieu
    if(mysqli_num_rows($queryLogin) > 0) {
        $result = mysqli_fetch_assoc($queryLogin);
        //luu tru thong tin vao session
        $_SESSION['user_logged']['id'] = $result['id'];
        $_SESSION['user_logged']['username'] = $result['username'];
        $_SESSION['user_logged']['email'] = $result['email'];
        $_SESSION['user_logged']['level'] = $result['level'];
        header("Location:index.php");

    }
else {
    $_SESSION['error']['invalid_account'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
    header ("Location:login.php");
}
closeConnection();

}

?>