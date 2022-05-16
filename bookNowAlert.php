<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
        <link href="css/style2.css" rel="stylesheet" type="text/css"/>
        <title>Salon Management System</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
    </head>
    <body style="background-image: url('images/registerImg.jpg');background-repeat: no-repeat;background-size: cover">

        <!--       ==============================Navbar Section==================================-->
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
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  " aria-current="page" href="prePackages.php">Bridal</a>
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
                        <li class="nav-item ps-2">
                            <a class="nav-link   " aria-current="page" href="rent.php">Rent</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link  " aria-current="page" href="customer_registration.php">Register</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link  " aria-current="page" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--        =======================Div section=============================-->
        <div class="container">
            <div class="card mx-auto mt-5" style="width: 60%">
                <div class="card-header" style="background-color: #FFD700">
                    <h6 class="card-text text-center">Welcome to Salon Kanchana!!</h6>
                    <h6 class="text-center text-dark">If you are a registered person please click login button and if not please register to the system.</h6>
                </div>
                <div class="card-body">
                    <?php
                    $current=$_GET['current'];
                    ?>
                    <div class="text-center">
                        <a href="customer_registration.php?current=<?php echo $current;?>" class="btn btn-warning">Register</a>  <a href="login.php?current=<?php echo $current;?>" class="btn btn-warning">Login</a>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>

        <!--       ====================Footer Section====================-->
        <footer class="p-0 m-0 fixed-bottom"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-warning">Copyright 1990-2020 by Data. All Rights Reserved.</p>
        </footer>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    </body>
</html>


