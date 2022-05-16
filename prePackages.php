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
        <!--=============================Nav Bar Section======================       -->
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
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " aria-current="page" href="prePackages.php">Bridal</a>
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
                            <a class="nav-link  " aria-current="page" href="index.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--========================Packages Section===============================-->
        <div class="container mt-5 mb-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                include 'system/function.php';
                $db = dbConn();
                $sql = "SELECT * FROM tbl_bridal_packages";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col">
                            <div class="card">
                                <img src="system/uploads/<?php echo $row['PackageImage']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['PackageName']; ?></h5>
                                    <form action="bridalMoreInformation.php" method="post" >
                                        <input type="hidden" name="BridalPackageId" value="<?php echo $row['BridalPackageId']; ?>">
                                        <button type="submit" class="btn btn-outline-warning">View More</button>
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

        <!--        =============================Footer Section============================-->
        <footer class=" mt-3 mb-0 fixed-bottom"> 
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
