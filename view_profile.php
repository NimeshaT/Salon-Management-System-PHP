<?php
session_start();
if (!isset($_SESSION['CUSTOMERID'])) {
    header("Location:login.php");
}
include 'system/function.php';
?>
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

        <!--        ========================NavBar Section==================-->
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
                            <a class="nav-link  " aria-current="page" href="index2.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="services2.php">Services</a>
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
                            <a class="nav-link " aria-current="page" href="index.php">Add-to-Cart</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link active" aria-current="page" href="edit_profile.php">My Profile</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--        =================================View Profile Section=============================-->
        
        <div class="container mt-3 mb-3">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="text-center">--My Profile--</h5>
                </div>
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_customers LEFT JOIN  tbl_districts ON tbl_customers.DistrictId =tbl_districts.DistrictId WHERE CustomerId = '{$_SESSION['CUSTOMERID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card ms-3" style="width: 15rem;">
                                        <img class="img-fluid " width="300" src="uploads2/<?php echo $row['ProfileImage']; ?>">
                                        <ul class="list-group list-group-flush ">
                                            <li class="list-group-item text-center"><?php echo $row['RegNo']; ?></li>
                                            <li class="list-group-item text-center"><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            Personal Information
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Address: <?php echo $row['AddressLine1']; ?> <?php echo $row['AddressLine2']; ?> <?php echo $row['AddressLine3']; ?> <?php echo $row['AddressLine4']; ?></li>
                                                <li class="list-group-item">City: <?php echo $row['City']; ?></li>
                                                <li class="list-group-item">District: <?php echo $row['DistrictName']; ?></li>
                                                <li class="list-group-item">Nic: <?php echo $row['NicNumber']; ?></li>
                                                <li class="list-group-item">City: <?php echo $row['Email']; ?></li>
                                                <li class="list-group-item">Contact No: <?php echo $row['PhoneNumber1']; ?>/ <?php echo $row['PhoneNumber2']; ?> </li>
                                                <li class="list-group-item">User Name: <?php echo $row['UserName']; ?></li>
                                            </ul>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="edit_profile_image.php" class="btn btn-warning" >Edit Profile Image</a>
                                                <a href="edit_profile.php" class="btn btn-primary" >Edit Profile</a>
                                                <a href="change_password.php" class="btn btn-success" >Change Password</a>
                                            </div><br><br>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="#" class="btn btn-outline-warning " >My Orders</a>
                                                <a href="#" class="btn btn-outline-warning " >My rent items</a>
                                                <a href="viewAppointments.php" class="btn btn-outline-warning " >My Personal Care Services</a>
                                                <a href="#" class="btn btn-outline-warning " >My Bridals</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

<!--        =======================Footer Section=======================-->
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
