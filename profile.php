<?php 

session_start();

//if seesion array is not set logout
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] != true) {
    header("Location: /cakes/login.php");
    exit;
}

include("./db.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

echo $_SESSION['user_email'];
?>
    
</body>
</html>