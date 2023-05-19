<?php
    session_start();
    include 'config.php';
    $id = $_GET['id'];
    $query = "select * from category where catId  = $id";
    $result  = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
    unlink("Photos/".$row['imgUrl']);
    $query = "delete from category where catId = $id";
    $result = mysqli_query($con,$query);
    if($result){
        $_SESSION["Delete"] = "deleted";      
        header("Location: category.php");
    }
?>