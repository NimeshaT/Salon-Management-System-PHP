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

        <!--NavBar Section-->
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
                                <li><a class="dropdown-item" href="clothes.php">Clothes</a></li>
                            </ul>
                        </li>

                        <li class="nav-item ps-2">
                            <a class="nav-link   " aria-current="page" href="rent2.php">Rent</a>
                        </li>

                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Add-to-Cart</a>
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

        

        <!--            Rent Section-->

        <div class="container-fluid mt-5" >
            <h4 class="text-center mt-3"> - Rent Now -</h4>
            <h5 class="text-center">We have wide range of bridal items for hire</h5>
            <div class="container-fluid mt-5">
                <div class="row">
                    <?php
                    include 'system/function.php';
                $db = dbConn();
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
                                        <!--                                        <a href="rentBridal2.php" class="btn btn-outline-warning d-flex justify-content-center">View More..</a>-->
                                        <form action="rentBridal2.php" method="post">
                                            <input type="hidden" name="ItemTypeId" value="<?php echo $row['ItemTypeId']; ?>">
                                            <button type="submit" class="btn btn-warning">View More</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!--                    <div class="col">
                                            <div class="card">
                                                <img src="images/bridalsaree.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center">Bridal Sarees</h6>
                                                    <a href="rentBridalSarees.php" class="btn btn-outline-warning d-flex justify-content-center">View More..</a>
                                                </div>
                                            </div>
                                        </div>-->
                    <!--                    <div class="col">
                                            <div class="card">
                                                <img src="images/bridalshoes.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center">Bridal Shoes</h6>
                                                    <a href="rentBridalShoes.php" class="btn btn-outline-warning d-flex justify-content-center">View More..</a>
                                                </div>
                                            </div>
                                        </div>-->
                    <!--                    <div class="col">
                                            <div class="card">
                                                <img src="images/bridesmaiddress.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center">Bridesmaid's Dress</h6>
                                                    <a href="rentBridesmaidDress.php" class="btn btn-outline-warning d-flex justify-content-center">View More..</a>
                                                </div>
                                            </div>
                                        </div>-->
                    <!--                    <div class="col">
                                            <div class="card">
                                                <img src="images/jewelry.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center">Jewelry</h6>
                                                    <a href="rentjewelry.php" class="btn btn-outline-warning d-flex justify-content-center">View More..</a>
                                                </div>
                                            </div>
                                        </div>-->

                </div>
            </div>
        </div>

        

        <!--            Footer Section-->

        <footer class="p-0 m-0 mt-5"> 
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
