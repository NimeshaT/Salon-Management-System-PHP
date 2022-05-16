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
<!--        ============================Navbar section=========================-->
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
                            <a class="nav-link active " aria-current="page" href="index.php">Home</a>
                        </li>
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
                        <li class="nav-item ps-2">
                            <a class="nav-link   " aria-current="page" href="rent.php">Rent</a>
                        </li>
                        
                        <li class="nav-item ps-2">
                            <a class="nav-link  " aria-current="page" href="customer_registration.php">Register</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link  "  href="login.php">Login</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </nav>

<!--        ============================About us Section========================-->
        <div class="container-fluid" id="about">
            <h4 class="text-center mt-3">- Some words about us -</h4>
            <div class="card mb-3 mx-auto" style="max-width: 740px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/kanchana.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Salon Kanchana</h5>
                            <p class="card-text">
                            Salon Kanchana bridal, hair and beauty care and sales center is based on the belief that our customers' needs are of the utmost importance. Our entire team is committed to meeting those needs.As a result, a high percentage of our business is from repeat customers and referrals.
                            </p><br>
                            <p>We would welcome the opportunity to earn your trust and deliver you the best service in the industry. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--        ==========================Choose us section=====================-->
        <div class="container-fluid mt-3" >
            <h4 class="text-center mt-4"> Why you choose us? </h4>
            <h5 class="text-center">--Our advantages--</h5>
            <div class="container-fluid ">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                    <div class="card-body bg-secondary">
                                        <h5 class="card-title text-center">We care about you</h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                    <div class="card-body bg-warning">
                                        <h5 class="card-title text-center">Experience & Expertise</h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                    <div class="card-body bg-secondary">
                                        <h5 class="card-title text-center">Quality products </h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                    <div class="card-body bg-warning">
                                        <h5 class="card-title text-center">Quality Services</h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                    <div class="card-body bg-secondary">
                                        <h5 class="card-title text-center">Affordable price</h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                    <div class="card-body bg-warning">
                                        <h5 class="card-title text-center">Our Location</h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

<!--        ====================Meet our team section========================-->
        <div class="container-fluid mt-3 mb-3" >
            <h4 class="text-center"> - Meet Our Team - </h4>
           <?php
           include 'system/function.php';
                $db = dbConn();
                $sql = "SELECT * FROM tbl_employees LEFT JOIN tbl_employees_title ON tbl_employees.TitleId=tbl_employees_title.TitleId LEFT JOIN tbl_designations ON tbl_employees.DesignationId=tbl_designations.DesignationId LIMIT 4";
                $result = $db->query($sql);
                ?>
            <div class="row">
                <?php
                    if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col">
                    <div class="card" style="max-width: 300px;">
                        <img class="img-fluid" src="system/uploads/<?php echo $row['EmployeeImage']; ?>" class="card-img-top" alt="...">';
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['TitleName']; ?><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></h5>
                            <h6><?php echo $row['DesignationName']; ?></h6>
                        </div>
                    </div>
                </div>
                <?php
                }
                    }
               
                ?>

            </div>
                 
        </div>

        <!--            Footer Section-->

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














