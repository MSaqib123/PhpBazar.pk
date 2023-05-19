<?php
    session_start();
    include 'config.php';
    $id = $_GET['id'];
    $query = "select * from product where pId  = $id";
    $result  = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
    unlink("Photos/Products/".$row['imgUrl']);
    $query = "delete from product where pId = $id";
    $result = mysqli_query($con,$query);
    if($result){
        $_SESSION["Delete"] = "deleted";      
        header("Location: Product.php");
    }
?>