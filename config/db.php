<?php 
 define('DB_HOST', 'localhost');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD','');
 define('DB_NAME','bookshop');
 $conn = null;
 function initConnection() {
    global $conn; //gọi biến vào sử dụng
    $conn = mysqli_connect( DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if(!$conn) {
        die(" connection failed " + mysqli_connect_error());
    }else{
        mysqli_set_charset($conn, 'UTF8'); //hiển thị tiếng việt
        
        
    }
    return $conn;

  }
  function closeConnection() {
    global $conn;
    if($conn) {//nếu như kết nối đang được thiết lập
        mysqli_close($conn);//thì thực hiện đóng kết nối
    }
  }
   
?>