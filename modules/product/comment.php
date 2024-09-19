


<?php
if(isset($_GET['b'])) {
    $action = $_GET['b'];
    switch ($action) {
        case 'com' :
             addCom();
            break;
          
    }
}
function addCom() {
    
    $conn = initConnection();
    if(isset($_POST['sbm'])) {  
        if(isset($_GET['id'])) {
            $prd_id = $_GET['id'];
        }
    
    $comm_name = $_POST['comm_name'];
    $comm_mail = $_POST['comm_mail'];
    $comm_details = $_POST['comm_details'];
    $sqlCom = "INSERT INTO comments
    (com_name,com_mail,comment_detail,prd_id)
    value
    ('$comm_name','$comm_mail','$comm_details','$prd_id');";
     
     $queryCom = mysqli_query($conn, $sqlCom);  
    }
    
    header("location:index.php?page=detail_product&id=$prd_id");
}

?>

