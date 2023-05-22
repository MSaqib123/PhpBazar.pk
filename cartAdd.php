<?php
    include 'config.php';
    session_start();

    $pId = $_GET["id"];
    $query = "SELECT * FROM product WHERE pId = $pId";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
    
    if(isset($_SESSION["cart"])){
        $cart = $_SESSION["cart"];
        if(isset($cart[$pId])){
            $cart[$pId]['quantity']++;
            $_SESSION['cart']=$cart;
            $_SESSION["cAdd"] = "OK";
            header("location: shop.php");
        }
        else{
            $cart[$pId] = [
                    'img'=> $row["imgUrl"],
                    'name'=> $row["Name"],
                    'price'=> $row["Price"],
                    'quantity'=> 1
            ];

            $_SESSION['cart']=$cart;
            $_SESSION["cAdd"] = "OK";
            header("location: shop.php");
        }
    }
    else{
        $array = [
            $_GET["id"] => [
                'img'=> $row["imgUrl"],
                'name'=> $row["Name"],
                'price'=> $row["Price"],
                'quantity'=> 1
            ]
        ];  

        $_SESSION["cart"] = $array;
        
        $_SESSION["cAdd"] = "OK";
        header("location: shop.php");
    }

?>