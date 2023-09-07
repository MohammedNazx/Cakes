<?php

session_start();

include("./db.php");

if (isset($_POST['test'])) {

    $sql = "INSERT INTO item (item_name) VALUES ('cake1')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
