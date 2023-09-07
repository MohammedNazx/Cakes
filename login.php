<?php
session_start();

// including database connection 
include './db.php';

//initialization
$error = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // creating local variable for using in php
    $user_email = null;
    $user_password = null;
    $user_id = null;

    //user name
    if (empty($_POST['email'])) {

        $error['user_email'] = "This is required";
    } else {

        // select query to get user detail
        $get_user = "SELECT * FROM `users` WHERE email = '" . $_POST['email'] . "';";
        $user_details = $conn->query($get_user);

        if ($user_details->num_rows > 0) {
            // output data of each row
            while ($user = $user_details->fetch_assoc()) {
                $user_email = $user["email"];
                $user_password = $user["password"];
                $user_id = $user['id'];
            }
        } else {
            $error['user_email'] = "User not found";
        }
    }

    //password
    if (empty($_POST['password'])) {
        $error['password'] = "This is required";
    } else {
        if ($_POST['password'] != $user_password) {
            $error['password'] = "Incorrect Password";
        }
    }



    //adding a session if name passwrd matches
    if ((count($error) <= 0) && strtolower($_POST['email']) == strtolower($user_email) && $_POST['password'] == $user_password) {
        $_SESSION['user_login'] = true;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_id'] = $user_id;
    }
}


if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
    header("Location: /cakes/main.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Other meta tags and stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- My own Style sheet Css -->
    <link rel="stylesheet" href="./CSS/style.css">

</head>

<body>

    <form method="POST" action="login.php">

        <table>

            <tr>
                <td> Email: </td>
                <td>
                    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : null; ?>">
                </td>
            <tr>
            <tr>
                <td></td>
                <td style="color:red;">
                    <?php echo (isset($error['user_email'])) ? $error['user_email'] : ''; ?>
                </td>
            </tr>

            <tr>
                <td> Password : </td>
                <td> <input type="text" name="password" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : null; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td style="color:red;">
                    <?php echo (isset($error['password'])) ? $error['password'] : ''; ?>
                </td>
            </tr>

        </table>
        <button type="submit">Sign in</button>
        <br>
        <br>

    </form>






</body>

</html>