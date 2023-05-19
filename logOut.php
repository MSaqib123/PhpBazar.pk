<?php
ob_start();
session_start();
session_destroy();


header("location: index.php")
// unset($_SESSION["products"])

?>