<?php

session_start();

//if seesion array is not set logout
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] != true) {
    header("Location: /cakes/login.php");
    exit;
}

include("./db.php");

$sql_banner = "SELECT * FROM banner";
$banner = $conn->query($sql_banner);

$sql_new_launch = "SELECT * FROM new_launch";
$new_launch = $conn->query($sql_new_launch);

$sql_birthday = "SELECT * FROM birthday";
$birthday = $conn->query($sql_birthday);

$sql_wedding = "SELECT * FROM wedding";
$wedding = $conn->query($sql_wedding);

//checking for message
$alert_message = null;

if (isset($_SESSION['cart_message'])) {

    $alert_message = $_SESSION['cart_message'];

    unset($_SESSION['cart_message']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>server</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Other meta tags and stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


    <!-- My own Style sheet Css -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">

    <!-- NAVIGATION STARTS  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid">
            <a class="navbar-brand text-color font-weight-bold" href="#">Cake World</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">

                        <a href="./profile.php">
                            <button type="button nav-link dropdown-toggle" class="btn btn-outline-danger position-relative">
                                My Profile
                            </button>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">Customize</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Order
                        </a>
                        <ul class="dropdown-menu">

                            <li><a class="dropdown-item" href="./viewcart.php">Cart</a></li>
                            <li><a class="dropdown-item" href="#">Previous Order</a></li>
                            <li><a class="dropdown-item" href="#">Support</a></li>

                        </ul>
                    </li>

                </ul>
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- NAVIGATION ENDS  -->


    <!-- MAIN BODY SECTION -->
    <div class="container-fluid mt-2">

        <?php if (!empty($alert_message)) { ?>

            <div style="color: black; background-color:goldenrod">
                <p> <?php echo $alert_message ; ?> </p>
            </div>
        <?php } ?>
        
        <!-- CAROUSEL STARTS -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade pt-3 " data-bs-ride="carousel">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">

                <?php
                while ($row = $banner->fetch_assoc()) {
                ?>
                    <div class="carousel-item active">
                        <img src="<?php echo  $row["url"]; ?>" class="d-block w-100 rounded" alt="<?php echo $row["title"]; ?>" style="height: 80vh;">
                    </div>
                <?php } ?>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- CAROUSEL ENDS -->

        <!-- NEW LAUNCH SECTION -->
        <div class="container mt-5 ">

            <div id="section1" class="text-center">
                <h1>New Launch</h1>
            </div>


            <div class="row gy-4 mt-3">

                <?php
                while ($row = $new_launch->fetch_assoc()) {
                ?>

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="card shadow">

                            <div class="inner">
                                <img class="card-img-top" src="<?php echo $row["url"]; ?>" alt="Card image">
                            </div>

                            <div class="card-body">
                                <div class="card-title"><?php echo $row["title"] ?></div>
                                <div class="card-text"><?php echo $row["text"] ?></div>

                                <form action="./addtocart.php" method="post">
                                    <input type="hidden" name="item_name" value="<?php echo $row["title"] ?>">
                                    <button type="submit" name="addToCart" class="btn btn-danger">Buy now</button>
                                </form>

                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>
        <!-- NEW LAUNCH SECTION -->

        <!-- BEST SELLER SECTION -->
        <!-- <div class="container mt-5">

            <div class="text-center">
                <h1>Best Seller</h1>
            </div>


            <div class="container-fluid ">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center">
                                <div class="product-card p-3">
                                    <h4>Product 1</h4>
                                    <p>Description of Product 1.</p>
                                </div>

                                <div class="product-card p-3">
                                    <h4>Product 2</h4>
                                    <p>Description of Product 2.</p>
                                </div>

                                <div class="product-card p-3">
                                    <h4>Product 2</h4>
                                    <p>Description of Product 3.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <div class="product-card p-3">
                                    <h4>Product 2</h4>
                                    <p>Description of Product 4.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div> -->
        <!-- BEST SELLER SECTION -->

        <!-- BIRTHDAY SECTION -->
        <div class="container mt-5">

            <div class="text-center">
                <h1>Happy Birthday</h1>
            </div>

            <!-- ROW 1 -->
            <div class="row gy-4 mt-3">

                <?php
                while ($row = $birthday->fetch_assoc()) {
                ?>

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="card shadow">

                            <div class="inner">
                                <img class="card-img-top" src="<?php echo $row["url"]; ?>" alt="Card image">
                            </div>

                            <div class="card-body">
                                <div class="card-title"><?php echo $row["title"] ?></div>
                                <div class="card-text"><?php echo $row["text"] ?></div>
                                <a href="#" class="btn btn-danger">Buy now</a>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>



        </div>
        <!-- BIRTHDAY SECTION -->

        <!-- WEDDING SECTION -->
        <div class="container mt-5">

            <div class="text-center">
                <h1>Wedding</h1>
            </div>

            <!-- ROW 1 -->
            <div class="row gy-4 mt-3">

                <?php
                while ($row = $wedding->fetch_assoc()) {
                ?>

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="card shadow">

                            <div class="inner">
                                <img class="card-img-top" src="<?php echo $row["url"]; ?>" alt="Card image">
                            </div>

                            <div class="card-body">
                                <div class="card-title"><?php echo $row["title"] ?></div>
                                <div class="card-text"><?php echo $row["text"] ?></div>
                                <a href="#" class="btn btn-danger">Buy now</a>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>
        <!-- WEDDING SECTION -->

        <!-- BOUGHT ALONG SECTION -->
        <div class="container mt-5">
            <div class="container pt-5">

                <div class="text-center">
                    <h1>Add On</h1>
                </div>


                <div class="container-fluid ">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="d-flex justify-content-center">
                                    <div class="product-card p-3">
                                        <div class="card">
                                            <div class="inner">
                                                <img class="card-img-top img-fluid" src="./images/1.jpg" alt="Card image" style="height: 150px; width:150px">
                                            </div>

                                            <div class="card-img-overlay">
                                                <a class="btn text-dark btn-floating m-1" style="background-color: white;" href="#!" role="button">
                                                    <i class="fa fa-shopping-cart "></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-card p-3">
                                        <div class="card">
                                            <div class="inner">
                                                <img class="card-img-top img-fluid" src="./images/1.jpg" alt="Card image" style="height: 150px; width:150px">
                                            </div>

                                            <div class="card-img-overlay">
                                                <a class="btn text-dark btn-floating m-1" style="background-color: white;" href="#!" role="button">
                                                    <i class="fa fa-shopping-cart "></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="product-card p-3">

                                        <div class="card">
                                            <div class="inner">
                                                <img class="card-img-top img-fluid" src="./images/1.jpg" alt="Card image" style="height: 150px; width:150px">
                                            </div>

                                            <div class="card-img-overlay">
                                                <a class="btn text-dark btn-floating m-1" style="background-color: white;" href="#!" role="button">
                                                    <i class="fa fa-shopping-cart "></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="product-card p-3">

                                        <div class="card">
                                            <div class="inner">
                                                <img class="card-img-top img-fluid" src="./images/1.jpg" alt="Card image" style="height: 150px; width:150px">
                                            </div>

                                            <div class="card-img-overlay">
                                                <a class="btn text-dark btn-floating m-1" style="background-color: white;" href="#!" role="button">
                                                    <i class="fa fa-shopping-cart "></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex justify-content-center">
                                    <div class="product-card p-3">
                                        <!-- Product card content for the second item -->
                                        <h4>Product 2</h4>
                                        <p>Description of Product 4.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more carousel items as needed -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <!-- BOUGHT ALONG SECTION -->



    </div><!-- MAIN BODY SECTION -->

    <!-- Footer -->
    <footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1">
        <!-- Section: Social media -->

        <div class="container-fluid">

            <div class="row p-3" style="background-color: #EC268F;">

                <div class="col-12 col-md-6 text-white">
                    <span>Get connected with us on social networks:</span>
                </div>

                <!-- Right -->
                <div class="col-12 col-md-6 text-md-end text-center">
                    <a href="" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-"></i>
                    </a>
                </div>
                <!-- Right -->
            </div>

        </div>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">Company name</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            Here you can use rows and columns to organize your footer
                            content. Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Products</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-dark">Wedding Cake</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Birthday Cake</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Occassional Cake</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Party</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-dark">Your Account</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Become an Affiliate</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Shipping Rates</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> Brampton, ON L6Y 6H8, CA</p>
                        <p><i class="fas fa-envelope mr-3"></i> hassan.nazamul05@gmail.com</p>
                        <p><i class="fas fa-phone mr-3"></i> + 01 226 998 5138</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>