<?php
session_start();
if (!isset($_SESSION['CUSTOMERID'])) {
    header("Location:login.php");
}
date_default_timezone_set('Asia/Colombo');

include 'system/function.php';


if (isset($_GET["getappointments"])) {
    $date = $_GET["date"];

    $serviceId = $_GET["serviceId"];

    $db = dbConn();
    $sql = "SELECT * FROM tbl_appointments WHERE AppointmentDate='$date' AND ServiceId='$serviceId'; ";
    $result = $db->query($sql);

    $rows = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    exit(json_encode($rows));
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
        <script src="system/plugins/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/luxon@2.3.1/build/global/luxon.min.js"></script>
    </head>

    <body>
        <!--        ==========================NavBar Section=========================-->
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
                        <li class="nav-item ps-2">
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

        <!--        ==========================Booking Form Section===================-->
        <div class="container mt-3 mb-3">
            <div class="card mx-auto" style="width: 60%">
                <?php
                extract($_POST);

                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {

                    $message = array();

//                    if (empty($AppointmentDate)) {
//                        $message['AppointmentDate'] = 'Appointment Date should not be empty..!';
//                    }
//                    if (empty($StartTime)) {
//                        $message['StartTime'] = 'Start Time should not be empty..!';
//                    }
//                    if (empty($EndTime)) {
//                        $message['EndTime'] = 'End Time should not be empty..!';
//                    }
                    //  
                    //                                              ================check date and time===================
                    $isBooked = false;

                    if (empty($message)) {
                        $db = dbConn();
                        echo $sql = "SELECT * FROM tbl_appointments WHERE ServiceId='$ServiceId' AND AppointmentDate='$AppointmentDate' AND ((StartTime BETWEEN '$StartTime' AND '$EndTime') OR (EndTime BETWEEN '$StartTime' AND '$EndTime')); ";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                print_r($row);
                                $isBooked = true;
                                ?>

                                <h6>Already Booked.Please select different date or time</h6>
                                <?php
//                                echo 'Already booked';
                            }
                        }
                    }

                    if (empty($message) && !$isBooked) {
                        $db = dbConn();
                        $sql = "INSERT INTO tbl_appointments("
                                . "CustomerId,"
                                . "RegNo,"
                                . "FirstName,"
                                . "LastName,"
                                . "NicNumber,"
                                . "AppointmentTypeId,"
                                . "ServiceTypeId,"
                                . "ServiceCategoryId,"
                                . "ServiceId,"
                                . "Charge,"
                                . "AppointmentDate,"
                                . "StartTime,"
                                . "ServiceDurationId,"
                                . "EndTime)VALUES("
                                . "'$CustomerId',"
                                . "'$RegNo',"
                                . "'$FirstName',"
                                . "'$LastName',"
                                . "'$NicNumber',"
                                . "'$AppointmentTypeId',"
                                . "'$ServiceTypeId',"
                                . "'$ServiceCategoryId',"
                                . "'$ServiceId',"
                                . "'$Charge',"
                                . "'$AppointmentDate',"
                                . "'$StartTime1',"
                                . "'$ServiceDurationId1',"
                                . "'$EndTime1')";
                        $db->query($sql);
                        $AId = $db->insert_id;
                        ?>
                        <div class="card " style="background-color: #FFD700">
                            <div class="card-header text-center">
                                <h3 class="text-center text-dark">Appointment successfully..!<i class="far fa-thumbs-up"></i></h3>
                                <h5 class="card-title text-center">Your Appointment No: <?php echo $AId ?></h5>
                                <a class="btn btn-warning btn-sm" href="viewAppointments.php" role="button">View Appointments</a>
                            </div>
                        </div>
                        <?php
                    }
                }

//                ===================cancel form details================
                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                    $AppointmentDate = "";
                    $StartTime = "";
                    $EndTime = "";
                }
                ?>

                <div class="card-header bg-warning">
                    Book your service Appointment
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="card-body">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_customers WHERE CustomerId = '{$_SESSION['CUSTOMERID']}'";
                        $result = $db->query($sql);
                        ?>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Customer Information</h5></legend>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2">
                                        <label class="CustomerId" style="display: none">Customer ID</label>
                                        <input type="hidden" class="form-control" id="CustomerId" name="CustomerId" value="<?php echo $row['CustomerId']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="RegNo">Customer Registration No:</label>
                                        <input type="text" class="form-control" id="RegNo" name="RegNo" value="<?php echo $row['RegNo']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="FirstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $row['FirstName']; ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="LastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $row['LastName']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="NicNumber">NIC</label>
                                        <input type="text" class="form-control" id="NicNumber" name="NicNumber" value="<?php echo $row['NicNumber']; ?>" readonly>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </fieldset>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Select Service</h5></legend>
                            <div class="mb-3 ms-2 mt-0">
                                <?PHP
                                $sql = "SELECT * FROM  tbl_appointments_type WHERE AppointmentTypeId='1'";
                                $result = $db->query($sql);
                                ?>
                                <div class="row">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="col">
                                                <label for="AppointmentTypeId" class="form-label">Appointment Type</label>
                                                <input type="text" style="display: none" class="form-control" id="AppointmentTypeId" name="AppointmentTypeId" value="<?php echo $row['AppointmentTypeId']; ?>">
                                                <input type="text" class="form-control" value="<?php echo $row['AppointmentTypeName']; ?>" readonly>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <?php
//                            extract($_POST);
                            $sql = "SELECT * FROM tbl_personal_care_services LEFT JOIN tbl_personal_care_services_category ON tbl_personal_care_services.ServiceCategoryId=tbl_personal_care_services_category.ServiceCategoryId LEFT JOIN tbl_personal_care_services_type ON tbl_personal_care_services.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId WHERE ServiceId='$ServiceId'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="ServiceTypeId" class="form-label">Service Type</label>
                                                <input type="text" style="display: none;" class="form-control" id="ServiceTypeId" name="ServiceTypeId" value="<?php echo $row['ServiceTypeId']; ?>">
                                                <input type="text" class="form-control"  value="<?php echo $row['ServiceTypeName']; ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="ServiceCategoryId" class="form-label">Service Category</label>
                                                <input type="text" style="display: none;" class="form-control" id="ServiceCategoryId" name="ServiceCategoryId" value="<?php echo $row['ServiceCategoryId']; ?>">
                                                <input type="text" class="form-control" value="<?php echo $row['ServiceCategoryName']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label for="ServiceName" class="form-label">Service Name</label>
                                        <input type="text"  style="display: none" class="form-control" id="ServiceId" name="ServiceId" value="<?php echo $row['ServiceId']; ?>">
                                        <input type="text" class="form-control"  value="<?php echo $row['ServiceName']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="Charge" class="form-label">Charge (Rs.)</label>
                                                <input type="text" class="form-control" id="Charge" name="Charge" value="<?php echo $row['Charge']; ?>" readonly>
                                            </div>
                                            <div class="col">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </fieldset>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Select Date and Time</h5></legend>
                            <div class="mb-3 ms-2">
                                <label for="AppointmentDate" class="form-label">Select Appointment Date</label>
                                <input type="date" class="form-control" id="AppointmentDate" name="AppointmentDate" value="<?php echo @$AppointmentDate ?>" min="<?= date('Y-m-d'); ?>">
                                <div class="text-danger"><?php echo @$message['AppointmentDate']; ?></div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-danger"><?php echo 'Check available time slots before enter the start time'; ?></div>
                                        <label for="StartTime" class="form-label">Start Time</label>
                                        <input type="Time" class="form-control" id="StartTime" name="StartTime" value="<?php echo @$StartTime ?>" min="09:00" max="18:00" >
                                        <input type="hidden" class="form-control" id="StartTime1" name="StartTime1">
                                        <div class="text-danger"><?php echo @$message['StartTime']; ?></div>
                                        <div class="text-success"><?php echo 'Salon opens at 9.00 a.m'; ?></div>
                                    </div>
                                    <?php
//                                    extract($_POST);
                                    $sql = "SELECT * FROM tbl_personal_care_services LEFT JOIN tbl_personal_care_services_duration ON tbl_personal_care_services.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId WHERE ServiceId='$ServiceId'";
                                    $result = $db->query($sql);
                                    ?>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="col">
                                                <label for="ServiceDurationId" class="form-label">Duration</label>
                                                <input type="text" class="form-control" placeholder="ServiceDuration" id="ServiceDurationId" name="ServiceDurationId" value="<?php echo getDuration($row['ServiceDuration']) ?>" readonly>
                                                <input type="hidden" class="form-control" placeholder="ServiceDuration" id="ServiceDurationId1" name="ServiceDurationId1" value="<?php echo $row['ServiceDurationId'] ?>" readonly>
                                                <input type="text" style="display: none" class="form-control" placeholder="Duration" id="DurationSeconds" name="DurationSeconds" value="<?php echo $row['ServiceDuration'] ?>">
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="EndTime" class="form-label">End Time</label>
                                        <input type="Time" class="form-control" id="EndTime" name="EndTime" value="<?php echo @$EndTime ?>" readonly>
                                        <input type="hidden" class="form-control" id="EndTime1" name="EndTime1">
                                        <div class="text-danger"><?php echo @$message['EndTime']; ?></div>
                                        <div class="text-success"><?php echo 'Salon closes at 7.00 p.m'; ?></div>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="container">
                                        <span id="freeSlots"></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning" name="action" value="save">Book Now</button>
                        <button type="submit" class="btn btn-warning" name="action" value="cancel">Cancel</button>
                    </div>
                </form>
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
        <script src="system/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script>
            //calculate End Time
            //constant ekak.tawa ekak assign karanna be.uda tiyena url eka access karanawa
            const DateTime = luxon.DateTime;
            //event ekak fire wenna start time eka gannawa
            $("#StartTime").on("change keyup", (e) => {
                //luxon eken ena ISO time format ekata kata karanawa
                const startTime = DateTime.fromISO(e.target.value);
                //end time ekata duration seconds wala value eka ekathu karanawa
                const endTime = startTime.plus({seconds: $("#DurationSeconds").val()});

                $("#EndTime").val(endTime.toLocaleString(DateTime.TIME_24_SIMPLE));
                $("#StartTime1").val(startTime.toISO())
                $("#EndTime1").val(endTime.toISO())
            });
//CHeck Poya days
            const poyaDays = [[2022, 1, 17], [2022, 2, 16], [2022, 3, 17], [2022, 4, 16], [2022, 5, 15], [2022, 6, 14], [2022, 7, 13], [2022, 8, 11], [2022, 9, 10], [2022, 10, 9], [2022, 11, 7], [2022, 12, 7]];

            $("#AppointmentDate").on("change keyup", e => {
                //[2022, 1, 17
                const parts = e.target.value.split("-");
                const year = parseInt(parts[0]);
                const month = parseInt(parts[1]);
                const day = parseInt(parts[2]);

                let isPoya = false;

                for (const i of poyaDays) {
                    if (i[0] == year && i[1] == month && i[2] == day) {
                        isPoya = true;
                        break;
                    }
                }

                if (isPoya) {
                    window.alert("Selected day is a poya day. Please select a different date.");
                    e.target.value = "";
                }

                checkForFreeSlots(e.target.value)

            });
//Check free slots using service id,date,start and end time
            function checkForFreeSlots(appointmentDate) {
                $.get(`http://localhost/sms/bookingServicesForm2.php?getappointments=&date=${appointmentDate}&serviceId=${$("#ServiceId").val()}`, (data) => {
                    //has all appointments for selected date with serviceid
                    const appointments = JSON.parse(data);

                    // to check if there are appinments when saloon is opening and closing
                    let freeAtStart = true;
                    let freeAtEnd = true;

                    let freeTimeSlots = [];

                    let prevAp;

                    for (const a of appointments) {
                        if (!prevAp) {
                            prevAp = a;
                            if (a.StartTime === "09:00:00") {
                                freeAtStart = false;
                            }
                            continue;
                        }

                        if (a.EndTime === "19:00:00") {
                            freeAtEnd = false;
                        }

                        if (prevAp.EndTime == a.StartTime)
                            continue;

                        const freeSlot = prevAp.EndTime + "-" + a.StartTime;
                        freeTimeSlots.push(freeSlot);
                    }

                    if (freeTimeSlots.length > 0) {
                        if (freeAtStart) {
                            freeTimeSlots = [`09:00:00-${appointments[0].StartTime}`, ...freeTimeSlots];
                        }

                        if (freeAtEnd) {
                            freeTimeSlots = [
                                ...freeTimeSlots,
                                `${appointments[appointments.length - 1].EndTime}-19:00:00`,
                            ];
                        }
                    }

                    if (freeTimeSlots.length == 0) {
                        $("#freeSlots").html("<h6 class=\"text-warning\">All time slots are available</h6>")
                    } else {
                        const slotsList = "<ul>" + freeTimeSlots.map(s => `<li>${s}</li>`).join("") + "</ul>";
                        $("#freeSlots").html(`<h6 class="text-warning">The following timeslots are available,</h6>${slotsList}`);
                    }

                });



            }
        </script>


    </body>

</html>
