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
            <h4 class="text-center mt-2">--Pending Appointments--</h4>
            <?php
            extract($_POST);
            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel" && isset($Aid)) {

//                echo $Eid;
//                echo $Aid;

                $db = dbConn();
                echo $sql = "UPDATE tbl_services_job_card SET StatusId='7' WHERE AppointmentId='$Aid'";
                $result = $db->query($sql);
            }
            ?>
            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_appointments ORDER BY AppointmentId DESC LIMIT 1";
            $result = $db->query($sql);

            $row = $result->fetch_assoc();
            $lastNo = $row['AppointmentId'];


            $sql = "SELECT * FROM tbl_services_job_card WHERE AppointmentId='$lastNo'";
            $result = $db->query($sql);


            if ($result->num_rows == 0) {
                $sql = "SELECT * FROM tbl_appointments WHERE AppointmentId NOT IN (SELECT AppointmentId FROM tbl_services_job_card)AND AppointmentTypeId='1' AND CustomerId='{$_SESSION['CUSTOMERID']}'";
                $res = $db->query($sql);


                $aptIDs = "";

                while ($r = $res->fetch_assoc()) {
                    $aptIDs .= $r["AppointmentId"] . ",";
                }
                ?>

                <h6 class="text-danger">Your pending appointments <?php echo $aptIDs; ?> will be shown after accept your appointments..please be wait..</h6>
                <?php
            }
            ?>
            <?php
            ?>

            <table class="table mt-4">
                <thead class="bg-warning">
                    <tr>
                        <th scope="col">Appointment No:</th>
                        <th scope="col">Reg No:</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Service</th>
                        <th scope="col">Charge</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId WHERE tbl_services_job_card.StatusId='4' AND tbl_services_job_card.CustomerId='{$_SESSION['CUSTOMERID']}' AND tbl_services_job_card.AppointmentTypeId='1'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
//                        $appointmentId = $row['AppointmentId'];
//                        $sql = "SELECT * FROM tbl_services_job_card WHERE AppointmentId = '$appointmentId'";
//                        $res = $db->query($sql);
//
//                        $hasJobCard = $res->num_rows > 0;
//                        if ($hasJobCard) {
//                            echo '<span style="display:none" class="hide_msg"></span>';
//                        }
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['AppointmentId'] ?></td>
                                <td><?php echo $row['RegNo'] ?></td>
                                <td><?php echo $row['FirstName'] ?> <?php echo $row['LastName'] ?></td>
                                <td><?php echo $row['ServiceName'] ?></td>
                                <td>Rs.<?php echo $row['Charge'] ?>.00</td>
                                <td><?php echo $row['AppointmentDate'] ?></td>
                                <td><?php echo $row['StartTime'] ?></td>
                                <td><?php echo $row['EndTime'] ?></td>
                                <td><button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName'] ?></button></td>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <button type="submit" class="btn btn-danger btn-sm" id="action" name="action" value="cancel">Cancel</button>
                                        <input type="hidden" name="Aid" value="<?php echo $row['AppointmentId'] ?>">
        <!--                                        <input type="text" name="Eid" value="<?php echo $row['EmployeeId'] ?>">-->
                                    </form>
                                </td>
                            </tr>

                        </tbody>
                        <?php
                    }
                }
                ?>
            </table>

        </div>

        <!--        ========================View completed Appointments Section===================-->
        <div class="container">
            <h4 class="text-center mt-2">--Completed Appointments--</h4>
            <p class="text-success">Thanks for your appointment.Please be kind enough to give your feedback for our future growing.</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="text" name="Aid" placeholder="Enter Appointment Id">
                <input type="text" name="Sid" placeholder="Enter Service Id">
                <input type="date" name="from" placeholder="Enter from date">
                <input type="date" name="to" placeholder="Enter to date">
                <button type="submit" class="bg-success">Search</button>
            </form>
            <table class="table mt-4">
                <thead class="bg-warning">
                    <tr>
                        <th scope="col">Appointment No:</th>
                        <th scope="col">Reg No:</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Service</th>
                        <th scope="col">Charge</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                extract($_POST);
                $db = dbConn();
                $where = null;
                //dynamically generate the query
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    //check service id
                    if (!empty($Aid)) {
                        $where .= "tbl_services_job_card.AppointmentId='$Aid' AND";
                    }
                    //check customer reg no
                    if (!empty($Sid)) {
                        $where .= " tbl_services_job_card.ServiceId='$Sid' AND";
                    }
                    //check from to dates
                    if (!empty($from) && !empty($to)) {
                        $where .= " tbl_services_job_card.AppointmentDate BETWEEN  '$from' AND '$to' AND";
                    }
                    //generate dynamic query remove AND last characters from the string
                    if (!empty($where)) {
                        $where = substr($where, 0, -3);
                        $where = " AND $where";
                    }

//            echo $where;
                }
                $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId WHERE tbl_services_job_card.StatusId='3' AND tbl_services_job_card.CustomerId='{$_SESSION['CUSTOMERID']}' $where";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['AppointmentId'] ?></td>
                                <td><?php echo $row['RegNo'] ?></td>
                                <td><?php echo $row['FirstName'] ?> <?php echo $row['LastName'] ?></td>
                                <td><?php echo $row['ServiceName'] ?></td>
                                <td>Rs.<?php echo $row['Charge'] ?>.00</td>
                                <td><?php echo $row['AppointmentDate'] ?></td>
                                <td><?php echo $row['StartTime'] ?></td>
                                <td><?php echo $row['EndTime'] ?></td>
                                <td><button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName'] ?></button></td>
                                <td>
                                    <?php
                                    echo $AppNo = $row['AppointmentId'];
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_review WHERE AppointmentId='$AppNo'";
                                    $res = $db->query($sql);
                                    if ($res->num_rows == 0) {
                                        ?>
                                        <form action="reviewForm.php" method="POST">
                                            <button type="submit" class="btn btn-primary btn-sm" >Create Review</button>
                                            <input type="hidden" name="Aid" value="<?php echo $row['AppointmentId'] ?>">
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <button type = "button" class = "btn btn-danger btn-sm" >Review Completed</button>
                                        <?php
                                    }
                                    ?>

                                </td>

                            </tr>

                        </tbody>
                        <?php
                    }
                }
                ?>
            </table>

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

<!--        <script>
            if ($(".hide_msg").length > 0) {
                $("#lblPendingMsg").hide()
            }
        </script>-->

    </body>
</html>