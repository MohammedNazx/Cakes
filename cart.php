<?php

session_start();

include("./db.php");

if (isset($_POST['test'])) {

    $user_id = $_SESSION['user_id'];

    // SQL Command
    $user = "SELECT * FROM `user` WHERE id = $user_id ";

    $result = $conn->query($user);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . $row["email"] . "<br>";
        }
    }
}



//$sql = "INSERT INTO item (item_name) VALUES ('cake1')";

    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
