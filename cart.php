<?php

session_start();

include("./db.php");

if (isset($_POST['test'])) {

    $user_id = $_SESSION['user_id'];

    // SQL Command
    $user = "SELECT * FROM `user` WHERE id = $user_id ";

    $result = $conn->query($user);


    $sql = "INSERT INTO item (item_name,user_id) VALUES ('cake1','$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
