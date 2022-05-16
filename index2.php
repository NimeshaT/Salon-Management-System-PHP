<?php
session_start();
if (!isset($_SESSION['CUSTOMERID'])) {
    header("Location:login.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
        <link href="css/style2.css" rel="stylesheet" type="text/css"/>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
        <title>Salon Management System</title>
    </head>

    <body>

        <!--        =============================Navbar Section=======================-->
        <nav class="navbar navbar-light bg-dark">
            <div class="container-fluid justify-content-center">
                <span class="navbar-text">
                    <p class="text-warning ">Welcome <?php echo $_SESSION['FIRSTNAME']; ?> <?php echo $_SESSION['LASTNAME']; ?></p>
                </span>
            </div>
        </nav>

        <nav class="navbar bg-dark">
            <div class="container justify-content-center">
                <img src="images/logo.png" alt="logo" width="150" height="100" > 
            </div>              
        </nav>

        <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
            <div class="container-fluid ">
                <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div  class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active " aria-current="page" href="index2.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="services2.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="prePackages2.php">Bridal</a>
                        </li>
                        <li class="nav-item dropdown ps-2">
                            <a class="nav-link dropdown-toggle  " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Shop
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="products.php">Products</a></li>
                                <li><a class="dropdown-item" href="clothes2.php">Clothes</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link   " aria-current="page" href="rent2.php">Rent</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="addCart.php">Add-to-Cart</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="view_profile.php"> My Profile</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--        ===================Carousal Section================================-->
        <div class="container mt-2">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/sliderimg1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bridal Packages<a class="btn btn-warning ms-2 btn-sm" href="prePackages.php" role="button">>>></a></h5>
                            <p>Pre-Bridal Packages | Discounts</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/sliderimg2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Services<a class="btn btn-warning ms-2 btn-sm" href="services.php" role="button">>>></a></h5>
                            <p>Facial Clean | Body Health | Nail Love | Hair Treatments | Attractive Dressings</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/sliderimg3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Products<a class="btn btn-warning ms-2 btn-sm" href="products.php" role="button">>>></a></h5>
                            <p>Skin Care | Shampoo & Conditioner | Perfumes | Hair Care | Facial Scrubs | Facial Creams</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>


        <!--        =================Personal Care Services Section============================-->
        <div class="container-fluid mt-5">
            <h4 class="text-center">- Our Services -</h4>
            <h5 class="text-center">Facial Clean, Body Health, Nail Love, Hair Treatments, Attractive Dressings</h5>
            <div class="container-fluid mt-4">
                <?php
                include 'system/function.php';
                $db = dbConn();
                $sql = "SELECT * FROM tbl_personal_care_services_type LIMIT 5";
                $result = $db->query($sql);
                ?>
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col">
                                <div class="card" style="width: 15rem;">
                                    <img class="img-fluid" src="system/uploads/<?php echo $row['Image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><?php echo $row['ServiceTypeName']; ?></h5>
                                        <a href="services2.php" class="btn btn-outline-warning d-flex justify-content-center">View More..</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--        =============================Shop Now Section===========================-->
        <div class="container mt-5">
            <h4 class="text-center mt-3"> - Shop Now -</h4>
            <h5 class="text-center">Our products are available for delivery or pick-up at the Salon</h5>
            <div class="container mx-auto " style="width: 70%">
                <div class="row mt-5">
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_items_type LIMIT 2";
                    $ItemTypeRes = $db->query($sql);

                    while ($ItemType = $ItemTypeRes->fetch_assoc()) {
                        $ItemTypeId = $ItemType["ItemTypeId"];
                        $ItemTypeName = $ItemType["ItemTypeName"];
                        $ItemTypeImage = $ItemType["ItemTypeImage"];
                        echo '<div class="col">';
                        echo '<div class="card" style="width: 20rem;">';
                        echo '<img class="img-fluid" src="system/uploads/' . $ItemTypeImage . '" class="card-img-top" alt="...">';
                        echo '<div class="card-body">';
                        echo "<h5 class=\"card-title\">$ItemTypeName</h5>";

                        $sql = "SELECT * FROM tbl_items_category WHERE ItemTypeId='$ItemTypeId'";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($ItemCategory = $result->fetch_assoc()) {
                                $ItemCategoryId = $ItemCategory["ItemCategoryId"];
                                $ItemCategoryName = $ItemCategory["ItemCategoryName"];
                                echo '<ul>';
                                echo '<li>' . $ItemCategoryName . '</li>';
                                echo '</ul>';
                            }
                        }
                        if ($ItemTypeId == 1) {
                            echo '<a href="#" class="btn btn-warning mt-4">View More..</a>';
                        } else {
                            echo '<a href="clothes2.php" class="btn btn-warning mt-4">View More..</a>';
                        }

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--        =============================Bridal Section===========================-->
        <div class="container mt-5">
            <h4 class="text-center mt-5"> - Bridal -</h4>
            <h5 class="text-center">We offer affordable price pre-bridal packages for you</h5>
            <div class="card mb-3">
                <img src="images/bridalheader.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Pre-Bridal Packages</h5>
                    <p class="card-text"> We provide 3 pre bridal packages which are the names of Wedding Day Package, Home Coming Day Package & Wedding with Homecoming Days Package.</p>

                </div>
            </div>
        </div>

        <!--        ===========================Rent Section===============================-->
        <div class="container-fluid mt-5" >
            <h4 class="text-center mt-3"> - Rent Now -</h4>
            <h5 class="text-center">We have wide range of bridal items for hire</h5>
            <div class="container-fluid mt-5">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM tbl_items_type WHERE  ItemTypeId !=1 AND ItemTypeId !=2 ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col">
                                <div class="card">
                                    <img class="img-fluid" src="system/uploads/<?php echo $row['ItemTypeImage']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title text-center"><?php echo $row['ItemTypeName']; ?></h6>
                                        <form action="rentBridal2.php" method="post">
                                            <input type="hidden" name="ItemTypeId" value="<?php echo $row['ItemTypeId']; ?>">
                                            <div class="row justify-content-center">
                                                <button type="submit" class="btn btn-outline-warning">View More</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--        =========================Reviews Section======================-->
        <div class="container-fluid mt-5">
            <h4 class="text-center mt-5">- Reviews -</h4>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/review2.jpeg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">Thilini</h6>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/review2.jpeg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">Thanuri</h6>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/review2.jpeg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">Hasini</h6>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-2">
                <a href="#" class="btn btn-warning">View More...</a>     
            </div>
        </div>

        <!--        ======================Contact Us Section==============================-->
        <div class="container-fluid mt-5 contact">
            <h4 class="text-center mt-3"> - Contact Us -</h4>
            <h5 class="text-center">We'd love to hear from you</h5>
            <div class="row mt-4 bg-warning">
                <div class="col">
                    <h5 class="mt-4" >Contact Us</h5>
                    <hr ">
                    <ul class="list-unstyled">
                        <li>G. M. N. Kanchana Fernando.</li><br>
                        <li>No :35</li>
                        <li>Horana Road,</li>
                        <li>Bandaragama.</li><br>
                        <li>+94 770347984</li><br>
                        <li>kanchanafernando37@gmail.com</li>
                    </ul>

                </div>
                <div class="col">
                    <h5 class="mt-4">Navigation</h5>
                    <hr>
                    <ul class="list-unstyled">
                        <li><a href="index2.php" class="link-dark text-decoration-none">Home</a><br></li>
                        <li><a href="about2.php" class="link-dark text-decoration-none" >About</a><br></li>
                        <li><a href="gallery.php" class="link-dark text-decoration-none">Gallery</a><br></li>
                        <li><a href="#" class="link-dark text-decoration-none">Reviews</a><br></li>
                        <li><a href="#" class="link-dark text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5 class="mt-4">Follow Us</h5>
                    <hr >
                    <i class="fab fa-facebook fa-2x"></i>
                    <i class="fab fa-facebook-messenger fa-2x"></i>
                    <i class="fab fa-instagram-square fa-2x"></i>
                    <i class="fab fa-twitter fa-2x"></i>
                </div>
                <div class="col">
                    <h5 class="mt-4">Opening Hours</h5>
                    <hr >
                    <ul class="list-unstyled">
                        <li>Monday 09:00 - 19:00</li>
                        <li>Tuesday 09:00 - 19:00</li>
                        <li>Wednesday 09:00 - 19:00</li>
                        <li>Thursday 09:00 - 19:00</li>
                        <li>Friday 09:00 - 19:00</li>
                        <li>Saturday 09:00 - 19:00</li>
                        <li>Sunday 09:00 - 19:00</li>
                    </ul>
                </div>
            </div>    
        </div>

        <!--====================Footer Section=====================-->
        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-warning">Copyright 1990-2020 by Data. All Rights Reserved.</p>
        </footer>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </body>
</html>