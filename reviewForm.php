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
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
        <title>Salon Management System</title>
        <script src="system/plugins/jquery/jquery.min.js" type="text/javascript"></script>
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
                            <a class="nav-link  " aria-current="page" href="index2.php">Home</a>
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
                            <a class="nav-link " aria-current="page" href="index.php">Add-to-Cart</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link active" aria-current="page" href="view_profile.php"> My Profile</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--        ========================View Pending Appointments Section===================-->
        <div class="container">
            <?php
            extract($_POST);

            echo $Aid;
            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save" && isset($Aid)) {
                echo $Aid;
                $Review= dataClean($Review);
                $message = array();
                if (empty($ReviewDate)) {
                    $message['ReviewDate'] = 'Review date should not be empty..!';
                }
                if (empty($Review)) {
                    $message['Review'] = 'Review should not be empty..!';
                }

                echo $cusId = $_SESSION['CUSTOMERID'];
                if (empty($message)) {
                    $db = dbConn();
                    $sql = "INSERT INTO tbl_review (AppointmentId,CustomerId,ServiceId,ReviewDate,Review,StatusId) VALUES ('$Aid','$cusId','$ServiceId','$ReviewDate','$Review','1')";
                    $db->query($sql);
                    ?>
                    <div class="card mx-auto" style="background-color: #FFD700;width: 60%">
                        <div class="card-header text-center">
                            <h3 class="text-center text-dark">Insert successfully..!<i class="far fa-thumbs-up"></i></h3>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <?php
//            extract($_POST);
//            echo $Aid;
            $db = dbConn();
            $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId WHERE AppointmentId='$Aid'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card mx-auto mb-3 mt-3" style="width: 60%">
                        <div class="card-header bg-warning">
                            Review Form
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="mb-3 ms-2">
                                    <label class="ReviewDate">Date</label>
                                    <input type="date" class="form-control" id="ReviewDate" name="ReviewDate" value="<?php echo @$ReviewDate ?>">
                                <div class="text-danger"><?php echo @$message['ReviewDate']; ?></div>
                                </div>
                                <div class="mb-3 ms-2">
                                    <div class="row">
                                        <div class="col">
                                            <label class="CustomerId">Customer Name</label>
                                            <input type="hidden" class="form-control" id="CustomerId" name="CustomerId" value="<?php echo $row['CustomerId'] ?>">
                                            <input type="text" class="form-control"  value="<?php echo $row['CFirstName'] ?> <?php echo $row['CLastName'] ?>" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="ServiceId">Service Name</label>
                                            <input type="text" class="form-control" id="ServiceId" name="ServiceId" value="<?php echo $row['ServiceId'] ?>">
                                            <input type="text" class="form-control"  value="<?php echo $row['ServiceName'] ?>" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3 ms-2">
                                    <label for="Review" class="form-label">Type your review</label>
                                    <textarea class="form-control" id="Review" name="Review" rows="3"><?php echo @$Review ?></textarea>
                                    <div class="text-danger"><?php echo @$message['Review']; ?></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="text" name="Aid" value="<?php echo $Aid ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="save">Save</button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
            ?>
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