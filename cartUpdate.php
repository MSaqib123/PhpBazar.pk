<?php
session_start();
// include '';
if(isset($_SESSION["cart"])){
    $cart = $_SESSION["cart"];

    //___________ Remove Cart _____________
    if(isset($_GET['removePId'])){
        $removepId = $_GET['removePId'];
        unset($cart[$removepId]);
        $_SESSION["cart"] = $cart;
        $_SESSION["cartAction"] = "Removed";
    }

    //___________ ++ Cart _____________
    if(isset($_GET['increment'])){
        // echo $_GET['increment'];
        $pId = $_GET['increment'];
        if(isset($cart[$pId])){
            $cart[$pId]['quantity']++;
            $_SESSION['cart']=$cart;
            $_SESSION["cartAction"] = "Add";
        }
    }
    //___________ -- Cart _____________
    if(isset($_GET['decrement'])){
        // echo $_GET['increment'];
        $pId = $_GET['decrement'];
        if(isset($cart[$pId])){
            $cart[$pId]['quantity']--;
            if($cart[$pId]['quantity'] ==0){
                unset($cart[$pId]);
                $_SESSION["cartAction"] = "Removed";
            }
            else{
                $_SESSION["cartAction"] = "Minus";
            }
            $_SESSION['cart']=$cart;
        }
    }

    //_________ Rest session if 0 cart _____________
    if(count($cart)== 0){
        unset($_SESSION["cart"]);
    }
    header('location: cart.php');
}
else{
//  header('location: index.php');
}

?>