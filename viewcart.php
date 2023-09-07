<?php 

session_start();

$user_id = $_SESSION['user_id'];

$numOfOrder = "SELECT * FROM `cart` WHERE user_id = '$user_id' "



?>
