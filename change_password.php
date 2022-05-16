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
            <?php
            extract($_POST);

            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                $message = array();

                if (empty($Password)) {
                    $message['Password'] = "Existing Password should not be empty..!";
                }
                if (empty($NewPassword)) {
                    $message['NewPassword'] = "New Password should not be empty..!";
                }
                if (empty($ConfirmPassword)) {
                    $message['ConfirmPassword'] = "Confirm Password should not be empty..!";
                }

//                =======================start validation===================
                if (!empty($Password)) {
                    $db = dbConn();
                    echo $sql = "SELECT * FROM tbl_customers WHERE Password=sha1('$Password')";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
//                        $message['Password'] = ' Password already exist';
                    } else {
                        $message['Password'] = ' Password not match';
                    }
                }
                
                if (!empty($NewPassword)) {
                        if ($NewPassword != $ConfirmPassword) {
                            $message['ConfirmPassword'] = "Confirm Password not match";
                        }
                    }
//                  if  ================Start Update Records==================
                if (empty($message)) {
                    $db = dbConn();
                    echo $sql = "UPDATE tbl_customers SET "
                            . "Password='" . sha1($NewPassword) . "'"
                            . "WHERE CustomerId='{$_SESSION['CUSTOMERID']}'";
                    $db->query($sql);
                    ?>

                                        <div class="card mx-auto" style="background-color: #FFD700;width: 60%">
                                            <div class="card-header text-center">
                                                <h3 class="text-center text-dark">Update successfully <i class="far fa-thumbs-up"></i></h3>
                                                <a class="btn btn-warning btn-sm" href="view_profile.php" role="button">View Profile</a>
                                            </div>
                                        </div>

                    <?php
                }
            }

            IF ($_SERVER ['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                $Password = "";
                $NewPassword="";
                $ConfirmPassword="";
            }
            ?>
            <div class="card mx-auto" style="width: 60%">
                <div class="card-header bg-warning">
                    <h5 class="">Change password form</h5>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="card" >
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
                                <div class="mb-3 mt-2 ms-3">
                                    <label for="Password" class="form-label">Existing password</label>
                                    <input class="form-control" type="password" id="Password" name="Password" placeholder="Enter existing password" value="<?php echo @$Password ?>">
                                    <div class="text-danger"><?php echo @$message['Password']; ?></div>
                                </div>
                                <div class="mb-3 mt-2 ms-3">
                                    <label for="NewPassword" class="form-label">New password</label>
                                    <input class="form-control" type="password" id="NewPassword" name="NewPassword" placeholder="Enter new password">
                                    <div class="text-danger"><?php echo @$message['NewPassword']; ?></div>
                                </div>
                                <div class="mb-3 mt-2 ms-3">
                                    <label for="ConfirmPassword" class="form-label">Confirm password</label>
                                    <input class="form-control" type="password" id="ConfirmPassword" name="ConfirmPassword" placeholder="Re enter your new password">
                                    <div class="text-danger"><?php echo @$message['ConfirmPassword']; ?></div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning" name="action"  value="save">Update</button>
                                    <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
