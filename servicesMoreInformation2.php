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
        <!--        <link href="css/style.css" rel="stylesheet" type="text/css"/>-->
        <link href="css/style2.css" rel="stylesheet" type="text/css"/>
        <title>Salon Management System</title>
    </head>

    <body>
        <!--        ===================================NavBar Section============================-->
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
                            <a class="nav-link active" aria-current="page" href="services2.php">Services</a>
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
                        <a class="nav-link   " aria-current="page" href="rent.php">Rent</a>
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

        <!--        ======================More Informatio Section=========================-->
        <div class="container mt-3 mb-3">
            <div class="card">
                <?php
                include 'system/function.php';
                $db = dbConn();
                extract($_POST);
                if(!isset($ServiceId)){
                    global $ServiceId;
                    $ServiceId=$_GET['ServiceId'];
                }
                $sql = "SELECT tbl_personal_care_services.* , tbl_personal_care_services_type.* ,tbl_personal_care_services_duration.* , tbl_personal_care_services_category.* , tbl_personal_care_services.Description AS Descript1, tbl_personal_care_services_category.Description AS Descript FROM tbl_personal_care_services INNER JOIN tbl_personal_care_services_type ON tbl_personal_care_services.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId INNER JOIN tbl_personal_care_services_category ON tbl_personal_care_services.ServiceCategoryId=tbl_personal_care_services_category.ServiceCategoryId INNER JOIN tbl_personal_care_services_duration ON tbl_personal_care_services.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId WHERE ServiceId='$ServiceId'";

                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card-header bg-warning">
                            <?php echo $row['ServiceName'] ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card" style="width: 18rem;">
                                        <img class="img-fluid" width="400" src="system/uploads/<?php echo $row['ServiceImage']; ?>">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Service : <?php echo $row['ServiceName'] ?></li>
                                            <li class="list-group-item">Service Type: <?php echo $row['ServiceTypeName'] ?></li>
                                            <li class="list-group-item">Service Category: <?php echo $row['ServiceCategoryName'] ?></li>
                                            <li class="list-group-item">Duration: <?php echo getDuration($row['ServiceDuration']) ?></li>
                                            <li class="list-group-item">Price: Rs.<?php echo $row['Charge'] ?></li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            Service Description
                                        </div>
                                        <div class="card-body">
                                            <?php echo $row['Descript1'] ?>
                                        </div>
                                        <div class="card-footer">
                                            <form action="bookingServicesForm2.php" method="post" >
                                                <input type="hidden" name="ServiceId" value="<?php echo $row['ServiceId']; ?>">
                                                <button type="submit" class="btn btn-outline-warning">Book Now</button>
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

        <!--        ==========================Footer Section========================-->
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


