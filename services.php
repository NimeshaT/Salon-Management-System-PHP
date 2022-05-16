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
        <!--        ====================NavBar Section=====================-->
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
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="services.php">Services</a>
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
                            <a class="nav-link  " aria-current="page" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!--        ======================Services section===========================-->
        <?php
        include 'system/function.php';
        $db = dbConn();
        $sql = "SELECT * FROM tbl_personal_care_services_type LIMIT 5";
        $serviceTypeRes = $db->query($sql);
        while ($serviceType = $serviceTypeRes->fetch_assoc()) {
            $serviceTypeName = $serviceType["ServiceTypeName"];
            $serviceTypeId = $serviceType["ServiceTypeId"];
            echo '<div class="container-fluid mt-2 ">';
            echo "<h2 class=\"text-center\">- $serviceTypeName Services -</h2>";
            echo '<div class="container mt-2 ">';
            echo '<div class="row">';
            $sql = "SELECT * FROM tbl_personal_care_services_category LEFT JOIN tbl_personal_care_services_type ON tbl_personal_care_services_category.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId  WHERE tbl_personal_care_services_category.ServiceTypeId='$serviceTypeId' ";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($service = $result->fetch_assoc()) {
                    $categoryImage = $service["CategoryImage"];
                    $categoryName = $service["ServiceCategoryName"];
                    $categoryId = $service["ServiceCategoryId"];
                    $description = $service["Description"];
                    echo '<div class="col">';
                    echo '        <div class="card mb-3" style="width: 18rem;">';
                    echo '            <img class="img-fluid" src="system/uploads/' . $categoryImage . '" class="card-img-top" alt="...">';
                    echo '            <div class="card-body">';
                    echo '                <h5 class="card-title">' . $categoryName . '</h5>';
                    echo '                <p class="card-text">' . $description . '</p>';
                    echo '                <form action="hairTreatments.php" method="post" >';
                    echo '                    <input type="hidden" name="ServiceCategoryId" value="' . $categoryId . '">';
                    echo '                    <button type="submit" class="btn btn-warning">View More</button>';
                    echo '                </form>                            </div>';
                    echo '        </div>';
                    echo ' </div>';
                }
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>

        <!--   ==============================Footer Section=====================-->

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
