<?php

session_start();

include("./DataBase/db.php");

if (isset($_POST['addToCart'])) {

    $item_name= $_POST['item_name'];


    $user_id = $_SESSION['user_id'];

    // SQL Command
    $user = "SELECT * FROM `user` WHERE id = $user_id ";

    $result = $conn->query($user);


    $sql = "INSERT INTO `cart` (item_name,user_id) VALUES ('$item_name','$user_id')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['cart_message'] ="New record created successfully";
    } else {
        $_SESSION['cart_message'] ="New record failed";
    }

    header("location: /cakes/main.php");
    exit;

    
}
