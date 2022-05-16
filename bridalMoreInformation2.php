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
        <title>Salon Management System</title>
    </head>
    <body>
        <!--        ===============================NavBar Section=====================-->
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
                            <a class="nav-link active" aria-current="page" href="prePackages2.php">Bridal</a>
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
                            <a class="nav-link " aria-current="page" href="view_profile.php">Profile</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--        ===================More Information Section=================-->
        <div class="container mt-3 mb-3">
            <div class="card">
                <?php
                include 'system/function.php';
                $db = dbConn();
                extract($_POST);
                if(!isset($BridalPackageId)){
                    global $BridalPackageId;
                    $BridalPackageId=$_GET['BridalPackageId'];
                }
                $sql = "SELECT * FROM tbl_bridal_packages WHERE BridalPackageId='$BridalPackageId'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card-header bg-warning">
                            <?php echo $row['PackageName'] ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card" style="width: 18rem;">
                                        <img class="img-fluid" width="400" src="system/uploads/<?php echo $row['PackageImage']; ?>">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Price : Rs. <?php echo $row['PackagePrice'] ?>.00</li>
                                            <li class="list-group-item">Discount: <?php echo $row['DiscountRate'] ?></li>
                                            <li class="list-group-item">Free Item: <?php echo $row['FreeItem'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            Package Services
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                $db = dbConn();
                                                extract($_POST);
                                                $sql = "SELECT * FROM tbl_bridal_packages_services LEFT JOIN tbl_bridal_packages ON tbl_bridal_packages_services.BridalPackageId=tbl_bridal_packages.BridalPackageId LEFT JOIN tbl_bridal_services ON tbl_bridal_packages_services.BridalServiceId=tbl_bridal_services.BridalServiceId WHERE tbl_bridal_packages_services.BridalPackageId='$BridalPackageId'";
                                                $result = $db->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <li class="list-group-item"><?php echo $row['BridalServiceName'] ?></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                            <p class="text-success">Be happy...! If you intend to add more services, we are ready to give opportunity for you..</p>
                                        </div>
                                        <div class="card-footer">
                                            <form action="bridalBookingForm.php" method="post" >
                                                <input type="hidden" name="BridalPackageId" value="<?php echo @$BridalPackageId ?>">
                                                <button type="submit" class="btn btn-warning">Book Now</button>
                                            </form>                               
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


<!--        ===============================Footer Section===========================-->
        <footer class=" mb-0 mt-5"> 
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


