<?php
session_start();

// including database connection 
include("../DataBase/db.php");

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
    header("Location: /Cakes/Main/main.php");
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



    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col col-xl-10">

                    <div class="card" style="border-radius: 1rem;">

                        <div class="row g-0">

                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>

                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="login.php" method="POST">

                                        <!-- LOGO AREA -->
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Logo</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Email address</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password"  class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="./register.php" style="color: #393f81;">Register here</a></p>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






</body>

</html>