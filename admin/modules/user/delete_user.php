<?php
$conn = initConnection();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = "DELETE FROM users WHERE id = '$id' ";
    $querydelete = mysqli_query($conn,$delete);
    header("location:index.php?page=user");
    
}
?>