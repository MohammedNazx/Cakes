<?php

session_start();

include("../DataBase/db.php");

$user_id = $_SESSION['user_id'];

//form of in mainp.php
if (isset($_POST['addToCart'])) {

    $item_name= $_POST['item_name'];
    
    $sql = "INSERT INTO `cart` (item_name,user_id) VALUES ('$item_name','$user_id')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['cart_message'] ="New record created successfully";
    } else {
        $_SESSION['cart_message'] ="New record failed";
    }

    header("location: /cakes/Main/main.php");
    exit;

    
}
