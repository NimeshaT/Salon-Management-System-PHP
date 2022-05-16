<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);
//==================================================
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($UpdateJobCardNo) && @$action == 'update') {
                $db = dbConn();
                echo $StatusId;
                $StatusId = $StatusId == '4' ? '5' : '4';
                $sql = "UPDATE tbl_services_job_card SET statusId='$StatusId' WHERE JobCardNo='$UpdateJobCardNo'";
                $db->query($sql);
            }
            //===========================================================
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($UpdateEmployee) && @$action == 'change') {
                echo $UpdateEmployee;
                $db = dbConn();
                $WorkingStatusId = $WorkingStatusId == '1' ? '2' : '1';
                $sql = "UPDATE tbl_employees SET WorkingStatusId='$WorkingStatusId' WHERE EmployeeId='$UpdateEmployee'";
                $db->query($sql);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($UpdateJobCardNo) && isset($UpdateEmployee) && @$action == 'Save') {
                //                ====================Before photo========================
                if (empty($message)) {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["BeforePhoto"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["BeforePhoto"]["tmp_name"]);
                    if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                        $uploadOk = 1;
                    } else {
                        $message['BeforePhoto'] = "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $message['BeforePhoto'] = "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
// Check file size
                    if ($_FILES["BeforePhoto"]["size"] > 5000000) {
                        $message['BeforePhoto'] = "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $message['BeforePhoto'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 1) {
                        if (move_uploaded_file($_FILES["BeforePhoto"]["tmp_name"], $target_file)) {
                            $Photo2 = htmlspecialchars(basename($_FILES["BeforePhoto"]["name"]));
                        } else {
                            $message['BeforePhoto'] = "Sorry, there was an error uploading your file.";
                        }
                    }
                }

                //                ====================After photo========================
                if (empty($message)) {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["AfterPhoto"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["AfterPhoto"]["tmp_name"]);
                    if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                        $uploadOk = 1;
                    } else {
                        $message['AfterPhoto'] = "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $message['AfterPhoto'] = "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
// Check file size
                    if ($_FILES["AfterPhoto"]["size"] > 5000000) {
                        $message['AfterPhoto'] = "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $message['AfterPhoto'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 1) {
                        if (move_uploaded_file($_FILES["AfterPhoto"]["tmp_name"], $target_file)) {
                            $Photo1 = htmlspecialchars(basename($_FILES["BeforePhoto"]["name"]));
                        } else {
                            $message['AfterPhoto'] = "Sorry, there was an error uploading your file.";
                        }
                    }
                }

                $db = dbConn();
                echo $sql = "UPDATE tbl_services_job_card SET Comment='$Comment',BeforePhoto='$Photo2',AfterPhoto='$Photo1',StatusId='3' WHERE JobCardNo='$UpdateJobCardNo'";
                $db->query($sql);
                echo $sql = "UPDATE tbl_employees SET WorkingStatusId='4' WHERE EmployeeId='$UpdateEmployee'";
                $db->query($sql);
                //                                ===========successful meesage=============
                ?>
                <div class="card " style="background-color: #FFD700">
                    <div class="card-header text-center">
                        <h3 class="text-center text-dark">Insert successfully..! and Completed the task<i class="far fa-thumbs-up"></i></h3>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_employees LEFT JOIN tbl_designations ON tbl_employees.DesignationId=tbl_designations.DesignationId WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="<?php echo SITE_URL; ?>uploads/<?php echo $row['EmployeeImage']; ?>"
                                             alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $_SESSION['FIRSTNAME'] ?> <?php echo $_SESSION['LASTNAME'] ?></h3>
                                    <p class="text-muted text-center"><?php echo $row['DesignationName'] ?></p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <?php
                                        $db = dbConn();
                                        $currentD = date('y-m-d');
                                        $sql2 = "SELECT COUNT(ServicesJobCardId) AS todayappointments FROM tbl_services_job_card WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}' AND AppointmentDate='$currentD'";
                                        $result2 = $db->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                <li class="list-group-item">
                                                    <b>Today's Appointments</b> <a class="float-right"><?php echo $row2['todayappointments']; ?></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $db = dbConn();

                                        $sql3 = "SELECT COUNT(ServicesJobCardId) AS totalappointments FROM tbl_services_job_card WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}'";
                                        $result3 = $db->query($sql3);
                                        if ($result3->num_rows > 0) {
                                            while ($row3 = $result3->fetch_assoc()) {
                                                ?>
                                                <li class="list-group-item">
                                                    <b>Total Appointments</b> <a class="float-right"><?php echo $row3['totalappointments']; ?></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <!--                           =====================About me box=================================-->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-book mr-1"></i> Nic Number</strong>
                                    <p class="text-muted">
                                        <?php echo $row['NicNumber'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <p class="text-muted"><?php echo $row['Address'] ?></p>
                                    <hr>
                                    <strong><i class="fas fa-pencil-alt mr-1"></i> Service Areas</strong>
                                    <?php
                                    $db = dbConn();
                                    $sql1 = "SELECT * FROM tbl_employee_personal_care_services_type LEFT JOIN tbl_employees ON tbl_employee_personal_care_services_type.EmployeeId=tbl_employees.EmployeeId LEFT JOIN tbl_personal_care_services_type ON tbl_employee_personal_care_services_type.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId WHERE tbl_employee_personal_care_services_type.EmployeeId='{$_SESSION['EMPLOYEEID']}'";
                                    $result1 = $db->query($sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            ?>
                                            <p class="text-muted">
                                                <span class="tag tag-danger"><?php echo $row1['ServiceTypeName'] ?></span>
                                            </p>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <hr>
                                    <strong><i class="far fa-file-alt mr-1"></i> Contact No:</strong>
                                    <p class="text-muted"><?php echo $row['TelNo'] ?></p>
                                    <hr>
                                    <strong><i class="far fa-file-alt mr-1"></i> Email</strong>
                                    <p class="text-muted"><?php echo $row['Email'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Today's Service Appointments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">All Service Appointments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bridal1" data-toggle="tab">Today'bridal Appointments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bridal2" data-toggle="tab">All Bridal Appointments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#attendance" data-toggle="tab">Attendance</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!--                                ==============Todays Appointments=================-->
                                <div class="active tab-pane" id="activity">

                                    <?php
                                    $db = dbConn();
                                    $curdate = date('y/m/d');
                                    echo $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId  LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId WHERE tbl_services_job_card.EmployeeId='{$_SESSION['EMPLOYEEID']}' AND tbl_appointments.AppointmentDate='$curdate' AND tbl_services_job_card.AppointmentTypeId='1'";
                                    $result = $db->query($sql);

                                    $jobCardNo1;
                                    $jobCardId;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $jobCardNo1 = $row['JobCardNo'];
                                            $statusId1 = $row['StatusId'];
                                            $EmpId = $row['EmployeeId'];
                                            $jobCardId = $row['ServicesJobCardId'];
                                            echo $EmpId;
                                            ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Job Card No: <?php echo $row['JobCardNo']; ?></a>
                                                    <span class="float-right">Appointment Id: <?php echo $row['AppointmentId']; ?></span>
                                                </div>

                                                <!-- /.user-block -->
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Appointment Date: <?php echo $row['AppointmentDate']; ?></a>
                                                    <span class="float-right">Service Name: <?php echo $row['ServiceName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Customer Reg No: <?php echo $row['RegNo']; ?></a>
                                                    <span class="float-right">Customer Name: <?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Start Time: <?php echo $row['StartTime']; ?></a>
                                                    <span class="float-right">End Time: <?php echo $row['EndTime']; ?></span>
                                                </div>

                                                <?php
                                                $StatusId = $row['StatusId'];
                                                ?>
                                                <h6 class="text-danger">When you start the task.Please update your status</h6>
                                                <h6 class="text-success">Job card status</h6>

                                                <div class="btn-group mt-2 mb-3">


                                                    <?php
                                                    if ($StatusId == 4) {
                                                        ?>
                                                        <button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                                        <input type="text" name="UpdateJobCardNo" value="<?php echo $row['JobCardNo']; ?>"/>
                                                        <button type="submit" id="action" name="action" value="update" class="btn btn-danger btn-sm" onclick="update(this)">Update</button><input type="hidden" id="StatusId" name="StatusId" value="<?php echo @$StatusId ?>">

                                                    </form>
                                                </div>
                                                <h6 class="text-success">Employee status</h6>
                                                <?php
//                                                echo $job=$row['JobCardNo'];

                                                $db = dbConn();
                                                $sql = "SELECT * FROM tbl_employees INNER JOIN tbl_working_status ON tbl_employees.WorkingStatusId=tbl_working_status.WorkingStatusId WHERE EmployeeId='$EmpId'";
                                                $result = $db->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <div class="btn-group mt-2">
                                                            <?php
                                                            if ($row['WorkingStatusId'] == 1) {
                                                                ?>
                                                                <button type="button" class="btn btn-primary btn-sm"><?php echo $row['WorkingStatusName']; ?></button>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <button type="button" class="btn btn-success btn-sm"><?php echo $row['WorkingStatusName']; ?></button>
                                                                <?php
                                                            }
                                                            ?>
                                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                                                <input type="text" name="UpdateEmployee" value="<?php echo $row['EmployeeId']; ?>"/>
                                                                <button type="submit" id="action" name="action" value="change" class="btn btn-danger btn-sm" onclick="update(this)">Update</button><input type="text" id="WorkingStatusId" name="WorkingStatusId" value="<?php echo @$WorkingStatusId ?>">

                                                            </form>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <fieldset class="border border-2 p-2 mt-4">
                                                    <legend  class="float-none w-auto p-2 mb-0"><h5>Add before after photos</h5></legend>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                                        <!--                                                        <h6 class="text-danger">If complete your task, please fill the form and update your status</h6>-->
                                                        <div class="mb-3">
                                                            <label for="BeforePhoto" class="form-label">Select a before photo</label>
                                                            <input class="form-control" type="file" id="BeforePhoto" name="BeforePhoto">
                                                            <input type="hidden" name="PreviousBeforePhoto" value="<?php echo @$BeforePhoto; ?>">

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="AfterPhoto" class="form-label">Select an after photo</label>
                                                            <input class="form-control" type="file" id="AfterPhoto" name="AfterPhoto">
                                                            <input type="hidden" name="PreviousAfterPhoto" value="<?php echo @$AfterPhoto; ?>">

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Comment">Type a comment</label>
                                                            <input type="text" class="form-control" id="Comment" name="Comment" value="<?php echo @$Comment ?>" >
                                                        </div>
                                                        <h6 class="text-success">When you submit the save button, it will update your status as completed automatically</h6>
                                                        <div class="btn-group mt-2">
                                                            <input type="text" name="UpdateJobCardNo" value="<?php echo $jobCardNo1; ?>"/>
                                                            <input type="text" name="UpdateEmployee" value="<?php echo $EmpId; ?>"/>
                                                            <button type="submit" id="action" name="action" value="Save" class="btn btn-warning" onclick="update(this.value)">Save</button>
                                                            <button type="submit" id="action" name="action" value="Cancel" class="btn btn-danger">Cancel</button>
                                                        </div>

                                                    </form>
                                                </fieldset>


                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!--                                ===========================Completed appointments===================-->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->

                                    <?php
                                    $db = dbConn();
                                    $curdate = date('y/m/d');
                                    $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId WHERE tbl_services_job_card.EmployeeId='{$_SESSION['EMPLOYEEID']}' AND tbl_services_job_card.StatusId='3'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Job Card No: <?php echo $row['JobCardNo']; ?></a>
                                                    <span class="float-right">Appointment Id: <?php echo $row['AppointmentId']; ?></span>
                                                </div>

                                                <!-- /.user-block -->
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Appointment Date: <?php echo $row['AppointmentDate']; ?></a>
                                                    <span class="float-right">Service Name: <?php echo $row['ServiceName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Customer Reg No: <?php echo $row['RegNo']; ?></a>
                                                    <span class="float-right">Customer Name: <?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Start Time: <?php echo $row['StartTime']; ?></a>
                                                    <span class="float-right">End Time: <?php echo $row['EndTime']; ?> <?php echo $row['LastName']; ?></span>
                                                </div>

                                                <?php
                                                $StatusId = $row['StatusId'];
                                                ?>
                                                <div class="btn-group mt-2">
                                                    <?php
                                                    if ($StatusId == 4) {
                                                        ?>
                                                        <button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                                <!--                                ===================Edit profile====================-->
                                <div class="tab-pane" id="settings">
                                    <?php
                                    extract($_POST);
                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "upload_image") {

                                        if (empty($message) AND!empty($_FILES["EmployeeImage"]["name"])) {
                                            $target_dir = "../uploads/";
                                            $target_file = $target_dir . basename($_FILES["EmployeeImage"]["name"]);
                                            $uploadOk = 1;
                                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                            $check = getimagesize($_FILES["EmployeeImage"]["tmp_name"]);
                                            if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                                $uploadOk = 1;
                                            } else {
                                                $message['EmployeeImage'] = "File is not an image.";
                                                $uploadOk = 0;
                                            }
                                            // Check if file already exists
                                            if (file_exists($target_file)) {
                                                $message['EmployeeImage'] = "Sorry, file already exists.";
                                                $uploadOk = 0;
                                            }
// Check file size
                                            if ($_FILES["EmployeeImage"]["size"] > 5000000) {
                                                $message['EmployeeImage'] = "Sorry, your file is too large.";
                                                $uploadOk = 0;
                                            }

                                            // Allow certain file formats
                                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                                $message['EmployeeImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                $uploadOk = 0;
                                            }
                                            if ($uploadOk == 1) {
                                                if (move_uploaded_file($_FILES["EmployeeImage"]["tmp_name"], $target_file)) {
                                                    $Photo = htmlspecialchars(basename($_FILES["EmployeeImage"]["name"]));
                                                } else {
                                                    $message['EmployeeImage'] = "Sorry, there was an error uploading your file.";
                                                }
                                            }
                                        } else {
                                            $Photo = $PreviousProfileImage;
                                        }


//                    ================Start Update Records==================
                                        $db = dbConn();
                                        echo $sql = "UPDATE tbl_employees SET "
                                        . "EmployeeImage='$Photo'"
                                        . "WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}'";
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
                                    ?>
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="EmployeeImage" class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" id="EmployeeImage" name="EmployeeImage">
                                            <input type="hidden" name="PreviousProfileImage" value="<?php echo @$EmployeeImage; ?>">
                                        </div>

                                        <div class="form-group ms-4">
                                            <button type="submit" class="btn btn-warning" id="action" name="action" value="upload_image">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!--                                =====================================Todays bridal appointment========================-->

                                <div class="tab-pane" id="bridal1">
                                    <?php
                                    $db = dbConn();
                                    $curdate = date('y/m/d');
                                    $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId INNER JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId WHERE tbl_services_job_card.EmployeeId='{$_SESSION['EMPLOYEEID']}' AND tbl_services_job_card.AppointmentDate='$curdate' AND tbl_services_job_card.AppointmentTypeId='2'";
                                    $result = $db->query($sql);

                                    $jobCardNo1;
                                    $jobCardId;
                                    $EmpId;
                                    $AppointmentId1;
                                    $CustId;
                                    $CFName;
                                    $CLName;
                                    $CustRNo;
                                    $PKiD;
                                    $PKName;
                                    $JobId;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $jobCardNo1 = $row['JobCardNo'];
                                            $statusId1 = $row['StatusId'];
                                            $EmpId = $row['EmployeeId'];
                                            $jobCardId = $row['ServicesJobCardId'];
                                            $AppointmentId1 = $row['AppointmentId'];
                                            $CustId = $row['CustomerId'];
                                            $CFName = $row['FirstName'];
                                            $CLName = $row['LastName'];
                                            $CustRNo = $row['CRegNo'];
                                            $PKiD = $row['BridalPackageId'];
                                            $PKName = $row['PackageName'];
                                            $JobId = $row['ServicesJobCardId'];
                                            ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Job Card No: <?php echo $row['JobCardNo']; ?></a>
                                                    <span class="float-right">Appointment Id: <?php echo $row['AppointmentId']; ?></span>
                                                </div>

                                                <!-- /.user-block -->
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Appointment Date: <?php echo $row['AppointmentDate']; ?></a>
                                                    <span class="float-right">Package Name: <?php echo $row['PackageName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Customer Reg No: <?php echo $row['RegNo']; ?></a>
                                                    <span class="float-right">Customer Name: <?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Start Time: <?php echo $row['StartTime']; ?></a>
                                                    <span class="float-right">End Time: <?php echo $row['EndTime']; ?></span>
                                                </div>

                                                <?php
                                                $StatusId = $row['StatusId'];
                                                ?>
                                                <h6 class="text-danger">When you start the task.Please update your status</h6>
                                                <h6 class="text-success">Job card status</h6>

                                                <div class="btn-group mt-2 mb-3">


                                                    <?php
                                                    if ($StatusId == 4) {
                                                        ?>
                                                        <button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                                        <input type="hidden" name="UpdateJobCardNo" value="<?php echo $row['JobCardNo']; ?>"/>
                                                        <button type="submit" id="action" name="action" value="update" class="btn btn-danger btn-sm" onclick="update(this)">Update</button><input type="hidden" id="StatusId" name="StatusId" value="<?php echo @$StatusId ?>">

                                                    </form>
                                                </div>
                                                <h6 class="text-success">Employee status</h6>
                                                <?php
//                                                echo $job=$row['JobCardNo'];

                                                $db = dbConn();
                                                $sql = "SELECT * FROM tbl_employees INNER JOIN tbl_working_status ON tbl_employees.WorkingStatusId=tbl_working_status.WorkingStatusId WHERE EmployeeId='$EmpId'";
                                                $result = $db->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <div class="btn-group mt-2">
                                                            <?php
                                                            if ($row['WorkingStatusId'] == 1) {
                                                                ?>
                                                                <button type="button" class="btn btn-primary btn-sm"><?php echo $row['WorkingStatusName']; ?></button>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <button type="button" class="btn btn-success btn-sm"><?php echo $row['WorkingStatusName']; ?></button>
                                                                <?php
                                                            }
                                                            ?>
                                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                                                <input type="hidden" name="UpdateEmployee" value="<?php echo $row['EmployeeId']; ?>"/>
                                                                <button type="submit" id="action" name="action" value="change" class="btn btn-danger btn-sm" onclick="update(this)">Update</button><input type="hidden" id="WorkingStatusId" name="WorkingStatusId" value="<?php echo $row['WorkingStatusId'] ?>">

                                                            </form>
                                                        </div>
                                                        <div class="user-block mt-4">
                                                            <form action="createSchedule.php" method="post">
                                                                <input type="text" name="JobCardNo" value="<?php echo $jobCardNo1; ?>"/>
                                                                <button type="submit" class="btn btn-danger btn-sm">Create Schedule</button>
                                                            </form>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!--                                ===============================Bridal All Appointments=========================-->
                                <div class="tab-pane" id="bridal2">
                                    <?php
                                    $db = dbConn();
                                    $curdate = date('y/m/d');
                                    $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId WHERE tbl_services_job_card.EmployeeId='{$_SESSION['EMPLOYEEID']}' AND tbl_services_job_card.StatusId='3' AND tbl_appointments_type.AppointmentTypeId='2'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Job Card No: <?php echo $row['JobCardNo']; ?></a>
                                                    <span class="float-right">Appointment Id: <?php echo $row['AppointmentId']; ?></span>
                                                </div>

                                                <!-- /.user-block -->
                                                <div class="user-block">
                                                    <a href="#" class="link-black">Appointment Date: <?php echo $row['AppointmentDate']; ?></a>
                                                    <span class="float-right">Package Name: <?php echo $row['PackageName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Customer Reg No: <?php echo $row['RegNo']; ?></a>
                                                    <span class="float-right">Customer Name: <?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></span>
                                                </div>

                                                <div class="user-block">
                                                    <a href="#" class="link-black">Start Time: <?php echo $row['StartTime']; ?></a>
                                                    <span class="float-right">End Time: <?php echo $row['EndTime']; ?> <?php echo $row['LastName']; ?></span>
                                                </div>

                                                <?php
                                                $StatusId = $row['StatusId'];
                                                ?>
                                                <div class="btn-group mt-2">
                                                    <?php
                                                    if ($StatusId == 4) {
                                                        ?>
                                                        <button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!--=========================Attendance==================================-->
                                <div class="tab-pane" id="attendance">
                                    <section class="content">
                                        <div class="container-fluid">
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                <input type="date" name="from" placeholder="Enter from date">
                                                <input type="date" name="to" placeholder="Enter to date">
                                                <button type="submit" class="bg-success">Search</button>
                                            </form>
                                            <?php
                                            extract($_POST);
                                            $db = dbConn();
                                            $where = null;
                                            //dynamically generate the query
                                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                                //check from to dates
                                                if (!empty($from) && !empty($to)) {
                                                    $where .= " tbl_attendance.AttendanceDate BETWEEN  '$from' AND '$to' AND";
                                                }
                                                //generate dynamic query remove AND last characters from the string
                                                if (!empty($where)) {
                                                    $where = substr($where, 0, -3);
                                                    $where = " AND $where";
                                                }

//            echo $where;
                                            }

                                            echo $sql = "SELECT * FROM tbl_attendance INNER JOIN tbl_working_status ON tbl_attendance.WorkingStatusId=tbl_working_status.WorkingStatusId WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}' $where";
                                            $result = $db->query($sql);
                                            ?>
                                            <table border='1' width='100%' class="mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>Attendance Date</th>
                                                        <th>In Time</th>
                                                        <th>Off Time</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['AttendanceDate'] ?></td>
                                                                <td><?php echo $row['AttendTime'] ?></td>
                                                                <td><?php echo $row['OffTime'] ?></td>
                                                                <td><?php echo $row['WorkingStatusName'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </section>
            </div>

            <?php
            include '../footer.php';
            ?>

            <script>

                function update(element) {
                    $(element).parent().submit();
                }
            </script>
