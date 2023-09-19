<?php

session_start();

include("../DataBase/db.php");

if (isset($_POST['addToCart'])) {

    $product_id= $_POST['product_id'];

    $user_id = $_SESSION['user_id'];

    // SQL Command
    $user = "SELECT * FROM `users` WHERE id = $user_id ";

    $result = $conn->query($user);


    $sql = "INSERT INTO `cart` (product_id,user_id) VALUES ('$product_id','$user_id')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['cart_message'] ="New record created successfully";
    } else {
        $_SESSION['cart_message'] ="New record failed";
    }

    header("location: /Cakes/Main/main.php");
    exit;

    
}
