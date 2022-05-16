<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
        <link href="css/style2.css" rel="stylesheet" type="text/css"/>
        <title>Salon Management System</title>
    </head>
    <body>
        <!--NavBar Section-->
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
                            <a class="nav-link  " aria-current="page" href="index.php">Home</a>
                        </li>

                        <!--                        <li class="nav-item dropdown ps-2">
                                                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Service
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                        <li><a class="dropdown-item" href="hairTreatments.php">Hair Treatments</a></li>
                                                        <li><a class="dropdown-item" href="hairColouring.php">Hair Colourings</a></li>
                                                        <li><a class="dropdown-item" href="hairStyling.php">Hair Stylings</a></li>
                                                        <li><a class="dropdown-item" href="cleanUp.php">Clean-Up</a></li>
                                                        <li><a class="dropdown-item" href="facial.php">Facial</a></li>
                                                        <li><a class="dropdown-item" href="threading.php">Threadings</a></li>
                                                        <li><a class="dropdown-item" href="makeUp.php">Make Up</a></li>
                                                        <li><a class="dropdown-item" href="waxing.php">Waxing</a></li>
                                                        <li><a class="dropdown-item" href="manicure.php">Manicure</a></li>
                                                        <li><a class="dropdown-item" href="pedicure.php">Pedicure</a></li>
                                                        <li><a class="dropdown-item" href="sareeDressing.php">Saree Dressings</a></li>
                                                        <li><a class="dropdown-item" href="lehenga.php">Lehenga Dressings</a></li>
                                                    </ul>
                                                </li>-->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="prePackages.php">Bridal</a>
                        </li>
                        <li class="nav-item dropdown ps-2">
                            <a class="nav-link dropdown-toggle  " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Shop
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="products.php">Products</a></li>
                                <li><a class="dropdown-item" href="clothes.php">Clothes</a></li>
                            </ul>
                        </li>
                        <!--                        <li class="nav-item dropdown ps-2">
                                                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Rent
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                        <li><a class="dropdown-item" href="rentBridalFrocks.php">Bridal Frocks</a></li>
                                                        <li><a class="dropdown-item" href="rentBridalSarees.php">Bridal Sarees</a></li>
                                                        <li><a class="dropdown-item" href="rentBridalShoes.php">Bridal Shoes</a></li>
                                                        <li><a class="dropdown-item" href="rentBridesmaidDress.php">Bridesmaid's Dress</a></li>
                                                        <li><a class="dropdown-item" href="rentjewelry.php">Jewelry</a></li>
                                                    </ul>
                                                </li>-->
                        <li class="nav-item ps-2">
                            <a class="nav-link  active " aria-current="page" href="rent.php">Rent</a>
                        </li>
<!--                        <li class="nav-item ps-2">
                            <a class="nav-link   " aria-current="page" href="offer.php">Offers</a>
                        </li>-->
                        <li class="nav-item ps-2">
                            <a class="nav-link  " aria-current="page" href="customer_registration.php">Register</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link  " aria-current="page" href="index.php">Login</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Add-to-Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--        rent Section-->
        <div class="container mt-3">
            <h2 class="text-center mt-3"> - Bridal Shoes -</h2>
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/pakistanishoe.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pakistani Shoes</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-warning">View More..</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/styloshoe.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Stylo Shoes</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-warning">View More..</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/dullgold.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Dull Gold</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-warning">View More..</a>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <div class="card" style="width: 18rem;">
                        <img src="images/fancukhussa.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Fancy Kussa</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                           <a href="#" class="btn btn-warning">View More..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--            Footer Section-->

        <footer class="p-0 m-0 mt-3"> 
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



