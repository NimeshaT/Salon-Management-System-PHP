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
                                <li><a class="dropdown-item" href="clothes2.php">Clothes</a></li>
                            </ul>
                        </li>

                        <li class="nav-item ps-2">
                            <a class="nav-link   " aria-current="page" href="rent2.php">Rent</a>
                        </li>

                        <li class="nav-item ps-2">
                            <a class="nav-link " aria-current="page" href="addCart.php">Add-to-Cart</a>
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

        <!--        Search Products-->
        <div class="container mt-3">

            <div class="card bg-warning">
                <div class="card-header">
                    Search Clothes
                </div>
            </div>
            <form id="search" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5>Clothes Category</h5>
                            <?php
                            include 'system/function.php';
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_items_category LEFT JOIN tbl_items_type ON tbl_items_category.ItemTypeId=tbl_items_type.ItemTypeId WHERE tbl_items_category.ItemTypeId='1'";
                            $result = $db->query($sql);
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    All Clothes
                                </label>
                            </div>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['ItemCategoryId']; ?>" id="<?php echo $row['ItemCategoryId']; ?>" name="category[]" onchange="search()">
                                        <label class="form-check-label" for="ItemCategoryId">
                                            <?php echo $row['ItemCategoryName']; ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col">
                            <h5>Colour</h5>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_items_color";
                            $result = $db->query($sql);
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    All Colors
                                </label>
                            </div>


                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['ItemColorId']; ?>" id="<?php echo $row['ItemColorId']; ?>" name="color[]" onchange="search()">
                                        <label class="form-check-label" for="ItemColorId">
                                            <?php echo $row['ItemColor']; ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>


                        </div>
                        <div class="col">
                            <h5>Price Range</h5>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_items_price_range";
                            $result = $db->query($sql);
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    All price ranges
                                </label>
                            </div>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['PriceRangeId']; ?>" id="<?php echo $row['PriceRangeId']; ?>">
                                        <label class="form-check-label" for="PriceRangeId">
                                            <?php echo $row['PriceRange']; ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                        <div class="col">
                            <h5>Size</h5>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_items_size";
                            $result = $db->query($sql);
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Free Size
                                </label>
                            </div>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['ItemSizeId']; ?>" id="<?php echo $row['ItemSizeId']; ?>" name="size[]" onchange="search()">
                                        <label class="form-check-label" for="ItemSizeId">
                                            <?php echo $row['ItemSize']; ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!--        Clothes Section-->
        <div class="container">
            <div class="row mb-3 mt-3" id="result">



            </div>
        </div>

        <!--            Footer Section-->

        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-warning">Copyright 1990-2020 by Data. All Rights Reserved.</p>
        </footer>
        <!-- Optional JavaScript; choose one of the two! -->
        <script src="system/plugins/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
        <script>
                                    function search() {
                                        var data = $("#search").serialize();
                                        //serialize form eke data read karanawa
                                        $.ajax({
                                            type: 'POST',
                                            data: data,
                                            url: 'search_clothes.php',
                                            success: function (response) {
                                                $("#result").html(response)
                                            },
                                            error: function (request, status, error) {
                                                alert(error);
                                            }
                                        });

                                    }
        </script>
    </body>
</html>





