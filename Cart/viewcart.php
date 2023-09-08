<?php 

session_start();

include("./DataBase/db.php");

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM `cart` WHERE user_id = '$user_id'";

$user = $conn->query($sql);

while($row = $user->fetch_assoc()){

   echo  $row['item_name'] ."<br>";
}


?>
