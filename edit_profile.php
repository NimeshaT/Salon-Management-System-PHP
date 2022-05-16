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

        <!--        ========================NavBar Section=========================-->
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
                            <a class="nav-link " aria-current="page" href="index2.php">Home</a>
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
                            <a class="nav-link active " aria-current="page" href="view_profile.php">My Profile</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<!--        ===========================Edit Profile Form===========================-->
        <div class="container mt-3 mb-3">
            <div class="card mx-auto" style="width: 60%">
                <?php
                
                include 'system/function.php';
                extract($_POST);

                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                    $FirstName = dataClean($FirstName);
                    $LastName = dataClean($LastName);
                    $AddressLine1 = dataClean($AddressLine1);
                    $AddressLine2 = dataClean($AddressLine2);
                    $AddressLine3 = dataClean($AddressLine3);
                    $AddressLine4 = dataClean($AddressLine4);
                    $City = dataClean($City);
                    $NicNumber = dataClean($NicNumber);
                    $Email = dataClean($Email);
                    $PhoneNumber1 = dataClean($PhoneNumber1);
                    $PhoneNumber2 = dataClean($PhoneNumber2);
                    $UserName = dataClean($UserName);

//                    ==============Start Validation===================
                    $message = array();
                    if (empty($FirstName)) {
                        $message['FirstName'] = "First Name should not be empty..!";
                    }
                    if (empty($LastName)) {
                        $message['LastName'] = "Last Name should not be empty..!";
                    }
                    if (empty($AddressLine1)) {
                        $message['AddressLine1'] = "AddressLine1 should not be empty..!";
                    }
                    if (empty($AddressLine2)) {
                        $message['AddressLine2'] = "AddressLine2 should not be empty..!";
                    }
                    if (empty($AddressLine3)) {
                        $message['AddressLine3'] = "AddressLine3 should not be empty..!";
                    }
                    if (empty($City)) {
                        $message['City'] = "City should not be empty..!";
                    }
                    if (empty($DistrictId)) {
                        $message['DestrictId'] = "Destrict should not be empty..!";
                    }
                    if (empty($NicNumber)) {
                        $message['NicNumber'] = "NicNumber should not be empty..!";
                    }
                    if (empty($Email)) {
                        $message['Email'] = "Email should not be empty..!";
                    }
                    if (empty($PhoneNumber1)) {
                        $message['PhoneNumber1'] = "PhoneNumber1 should not be empty..!";
                    }
                    if (empty($PhoneNumber2)) {
                        $message['PhoneNumber2'] = "PhoneNumber2 should not be empty..!";
                    }
                    if (empty($UserName)) {
                        $message['UserName'] = "UserName should not be empty..!";
                    }
                    if (empty($Password)) {
                        $message['Password'] = "Password should not be empty..!";
                    }



                    if (!empty($FirstName)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($FirstName, 0, 1))) {
                            $message['FirstName'] = 'First Letter should be in uppercase';
                        }
                    }
                    if (!empty($LastName)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($LastName, 0, 1))) {
                            $message['LastName'] = 'First Letter should be in uppercase';
                        }
                    }
                    if (!empty($City)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($City, 0, 1))) {
                            $message['City'] = 'First Letter should be in uppercase';
                        }
                    }

                    if (!empty($NicNumber)) {
                        $test1 = strlen($NicNumber);
                        $test2 = substr($NicNumber, -1, 1);
                        if (!(($test1 == 10 && $test2 == "V") || $test1 == 12)) {
                            $message['NicNumber'] = 'Nic number';
                        }
                    }

                    if (!empty($Email)) {
                        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                            $message['Email'] = 'invalid email';
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers WHERE Email='$Email'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['Email'] = ' Email already exist';
                            }
                        }
                    }

                    if (!empty($PhoneNumber1)) {
                        $test1 = substr($PhoneNumber1, 0, 3);
                        $test2 = strlen($PhoneNumber1);
                        if (!(($test1 == "+94") && $test2 == 12)) {
                            $message['PhoneNumber1'] = 'invalid phone number';
                        }
                    }
                    if (!empty($PhoneNumber2)) {
                        $test1 = substr($PhoneNumber2, 0, 3);
                        $test2 = strlen($PhoneNumber2);
                        if (!(($test1 == "+94") && $test2 == 12)) {
                            $message['PhoneNumber2'] = 'invalid phone number';
                        }
                    }

                    if (!empty($Password)) {
                        if (strlen($Password) < 8) {
                            $message['Password'] = "Password too short!";
                        }
                    }
                    if (!empty($Password)) {
                        if (!preg_match("#[0-9]+#", $Password)) {
                            $message['Password'] = "Password must include at least one number!";
                        }
                    }
                    if (!empty($Password)) {
                        if (!preg_match("#[a-zA-Z]+#", $Password)) {
                            $message['Password'] = "Password must include at least one letter!";
                        }
                    }

//                    ================Start Update Records==================
                    if(empty($message)){
                    $db = dbConn();
                    $sql = "UPDATE tbl_customers SET "
                    . "FirstName='$FirstName',"
                    . "LastName='$LastName',"
                    . "AddressLine1='$AddressLine1',"
                    . "AddressLine2='$AddressLine2',"
                    . "AddressLine3='$AddressLine3',"
                    . "AddressLine4='$AddressLine4',"
                    . "City='$City',"
                    . "DistrictId='$DistrictId',"
                    . "NicNumber='$NicNumber',"
                    . "Email='$Email',"
                    . "PhoneNumber1='$PhoneNumber1',"
                    . "PhoneNumber2='$PhoneNumber2'"
                    . "WHERE CustomerId='{$_SESSION['CUSTOMERID']}'";
                    $db->query($sql);
                    
                    ?>
                
                    <div class="card " style="background-color: #FFD700">
                        <div class="card-header text-center">
                            <h3 class="text-center text-dark">Update successfully <i class="far fa-thumbs-up"></i></h3>
                            <a class="btn btn-warning btn-sm" href="view_profile.php" role="button">View Profile</a>
                        </div>
                    </div>
                
                    <?php
                }
                }
                if($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel"){
                    $AddressLine1="";
                    $AddressLine2="";
                    $AddressLine3="";
                    $AddressLine4="";
                    $City="";
                    $DistrictId="";
                    $Email="";
                    $PhoneNumber1="";
                    $PhoneNumber2="";
                    $UserName="";
                }
                ?>

                <div class="card-header bg-warning">
                    Customer profile update
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_customers WHERE CustomerId = '{$_SESSION['CUSTOMERID']}'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <fieldset class="border border-2 p-2">
                                    <legend  class="float-none w-auto p-2 mb-0"><h5>Customer Information</h5></legend>

                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="FirstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name" value="<?php echo $row['FirstName']; ?>" readonly>
                                                <div class="text-danger"><?php echo @$message['FirstName']; ?></div>
                                            </div>
                                            <div class="col">
                                                <label for="LastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name" value="<?php echo $row['LastName']; ?>" readonly>
                                                <div class="text-danger"><?php echo @$message['LastName']; ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="AddressLine1">AddressLine1</label>
                                                <textarea class="form-control" id="AddressLine1" name="AddressLine1" placeholder="Enter AddressLine1"><?php echo $row['AddressLine1']; ?></textarea>
                                                <div class="text-danger"><?php echo @$message['AddressLine1']; ?></div>
                                            </div>
                                            <div class="col">
                                                <label for="AddressLine2">AddressLine2</label>
                                                <textarea class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Enter AddressLine2"><?php echo $row['AddressLine2']; ?></textarea>
                                                <div class="text-danger"><?php echo @$message['AddressLine2']; ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="AddressLine3">AddressLine3</label>
                                                <textarea class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Enter AddressLine3"><?php echo $row['AddressLine3']; ?></textarea>
                                                <div class="text-danger"><?php echo @$message['AddressLine3']; ?></div>
                                            </div>
                                            <div class="col">
                                                <label for="AddressLine4">AddressLine4</label>
                                                <textarea class="form-control" id="AddressLine4" name="AddressLine4" placeholder="Enter AddressLine4"><?php echo $row['AddressLine4']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City" name="City" placeholder="Enter City" value="<?php echo $row['City']; ?>">
                                                <div class="text-danger"><?php echo @$message['City']; ?></div>
                                            </div>
                                            <div class="col">
                                                <?php
                                                $db = dbConn();
                                                $sql1 = "SELECT * FROM tbl_districts";
                                                $result1 = $db->query($sql1);
                                                ?>
                                                <label for="DistrictId" class="form-label">District</label>
                                                <select class="form-control form-select" name="DistrictId" id="DistrictId">
                                                    <option value="">--</option>
                                                    <?php
                                                    if ($result1->num_rows > 0) {
                                                        while ($row1 = $result1->fetch_assoc()) {
                                                            echo $DistrictId;
                                                            ?>
                                                            <option value="<?php echo $row1['DistrictId']; ?>" <?php if (@$row['DistrictId'] == $row1['DistrictId']) { ?> selected <?php } ?>><?php echo $row1['DistrictName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="text-danger"><?php echo @$message['DistrictId']; ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 ms-2">
                                        <label class="NicNumber">NicNumber</label>
                                        <input type="text" class="form-control" id="NicNumber" name="NicNumber" placeholder="Enter NIC Number" value="<?php echo $row['NicNumber']; ?>" readonly>
                                        <div class="text-danger"><?php echo @$message['NicNumber']; ?></div>
                                    </div>

                                    <div class="mb-3 ms-2">
                                        <label class="Email">Email</label>
                                        <input type="text" class="form-control" id="Email" name="Email" placeholder="Enter Email" value="<?php echo $row['Email']; ?>">
                                        <div class="text-danger"><?php echo @$message['Email']; ?></div>
                                    </div>

                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="PhoneNumber1" class="form-label">PhoneNumber1</label>
                                                <input type="text" class="form-control" id="PhoneNumber1" name="PhoneNumber1" placeholder="Enter Phone Number1" value="<?php echo $row['PhoneNumber1']; ?>">
                                                <div class="text-danger"><?php echo @$message['PhoneNumber1']; ?></div>
                                            </div>
                                            <div class="col">
                                                <label for="PhoneNumber2" class="form-label">PhoneNumber2</label>
                                                <input type="text" class="form-control" id="PhoneNumber2" name="PhoneNumber2" placeholder="Enter Phone Number2" value="<?php echo $row['PhoneNumber2']; ?>">
                                                <div class="text-danger"><?php echo @$message['PhoneNumber2']; ?></div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset class="border border-2 p-2">
                                    <legend  class="float-none w-auto p-2 mb-0"><h5>Customer Account Information</h5></legend>


                                    <div class="mb-3 ms-2">
                                        <label class="UserName">UserName</label>
                                        <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter User Name" value="<?php echo $row['UserName']; ?>">
                                        <div class="text-danger"><?php echo @$message['UserName']; ?></div>
                                    </div>

                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="Password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter Password" value="<?php echo $row['Password']; ?>" readonly>
                                                <div class="text-danger"><?php echo @$message['Password']; ?></div>

                                            </div>
                                            <div class="col">
                                                <label for="FirstName" class="form-label">Confirm Password</label>
                                                <input type="text" class="form-control" placeholder="Confirm Password" readonly >
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning" name="action"  value="save">Save</button>
                        <button type="submit" class="btn btn-warning" name="action" value="cancel">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

<!--        =======================Footer Section========================-->
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
