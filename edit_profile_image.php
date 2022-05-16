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
                $hasErrors = 0;
                
                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                    $message=array();
//                    if(empty($Photo)){
//                        $message["ProfileImage"]="Profile Image should not be empty...!";
//                         $hasErrors = 1;
//                    }
                    if (empty($message) AND !empty($_FILES["ProfileImage"]["name"])) {
                        $target_dir = "uploads2/";
                        $target_file = $target_dir . basename($_FILES["ProfileImage"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["ProfileImage"]["tmp_name"]);
                        if ($check !== false) {
                        //Multi-purpose Internet Mail Extensions                       
                            $uploadOk = 1;
                        } else {
                            $message['ProfileImage'] = "File is not an image.";
                            $uploadOk = 0;
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $message['ProfileImage'] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["ProfileImage"]["size"] > 5000000) {
                            $message['ProfileImage'] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $message['ProfileImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $target_file)) {
                                $Photo = htmlspecialchars(basename($_FILES["ProfileImage"]["name"]));
                            } else {
                                $message['ProfileImage'] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    } else {
                        $Photo = $PreviousProfileImage;
                    }
                    
                    
//                  if  ================Start Update Records==================
                    if(empty($message)){
                    $db = dbConn();
                    $sql = "UPDATE tbl_customers SET "
                    . "ProfileImage='$Photo'"
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
                
                IF($_SERVER ['REQUEST_METHOD']== "POST" && @$action == "cancel"){
                    $Photo="";
                }
                ?>
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="text-center">--My Profile--</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers LEFT JOIN  tbl_districts ON tbl_customers.DistrictId =tbl_districts.DistrictId WHERE CustomerId = '{$_SESSION['CUSTOMERID']}'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="card ms-3" style="width: 15rem;">
                                        <img class="img-fluid " width="300" src="uploads2/<?php echo $row['ProfileImage']; ?>">
                                        <ul class="list-group list-group-flush ">
                                            <li class="list-group-item text-center"><?php echo $row['RegNo']; ?></li>
                                            <li class="list-group-item text-center"><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    Update your profile image
                                </div>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                    <div class="mb-3 mt-2 ms-3">
                                        <label for="ProfileImage" class="form-label">Profile Image</label>
                                        <input class="form-control" type="file" id="ProfileImage" name="ProfileImage">
                                        <input type="hidden" name="PreviousProfileImage" value="<?php echo @$ProfileImage; ?>">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning" name="action"  value="save">Save</button>
                                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
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
