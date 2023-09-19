<?php

session_start();
include("../DataBase/db.php");

if (isset($_POST['banner']) && isset($_FILES['banner_img'])) {


    $img_name = $_FILES['banner_img']['name'];
    $tmp_name = $_FILES['banner_img']['tmp_name'];

    $check = move_uploaded_file($tmp_name, "../images/banner/" . $img_name);
    $sql = "INSERT INTO banner (img) VALUES ('$img_name')";

    $conn->query($sql);
} else {

    echo 'banner failed';
}

if (isset($_POST['product']) && isset($_FILES['product'])) {

    $product_name = $_FILES['product']['name'];
    $tmp_name = $_FILES['product']['tmp_name'];

    $title = $_POST['title'];
    $category = $_POST['category'];

    $check = move_uploaded_file($tmp_name, "../images/product/" . $product_name);

    $sql = "INSERT INTO products (img,title,category) VALUES ('$product_name', '$title', '$category' )";

    $conn->query($sql);
} else {

    echo "new launch failed";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="upload.php" method="POST" enctype="multipart/form-data">

        <h2>upload banner image</h2>

        <input type="file" name="banner_img">
        <input type="submit" name="banner" value="upload">

    </form>

    <form action="upload.php" method="POST" enctype="multipart/form-data">

    <h2>Upload products</h2>
        <input type="file" name="product"><br>
        <label> Enter Title</label>
        <input type="text" name="title">

        <label for="category">Select Category:</label>
        <select id="category" name="category">
            <option value="newLaunch">new Launch</option>
            <option value="birthday">birthday</option>
            <option value="wedding">wedding</option>
        </select>

        <input type="submit" name="product" value="upload">
    </form>


</body>

</html>