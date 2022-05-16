<?php
include '../header.php';
include '../nav.php';
//session_start();
//if (!isset($_SESSION['EMPLOYEEID'])) {
//    header("Location:login.php");
//}
//session_destroy();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jobs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Jobs</a></li>
                        <li class="breadcrumb-item active">Employee Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);
//            echo $Statusid;
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($UpdateJobCardNo)) {
                $db = dbConn();
                $StatusId = $StatusId == '4' ? '5' : (($StatusId == 5) ? '3' : '4');
                echo $sql = "UPDATE tbl_services_job_card SET statusId='$StatusId' WHERE JobCardNo='$UpdateJobCardNo'";
                print_r($sql);
                $db->query($sql);
                if($StatusId=='3'){
                    $sql="INSERT INTO tbl_job_card_services (Comment) VALUES ('$Comment')";
                    $db->query($sql);
                }
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

                            <!-- Profile Image -->
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
                                        <li class="list-group-item">
                                            <b>Today's Appointments</b> <a class="float-right">1,322</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Total Appointments</b> <a class="float-right">543</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Friends</b> <a class="float-right">13,287</a>
                                        </li>
                                    </ul>

                                    <!--                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <!-- /.card-header -->
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
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                               <?php
                }
            }
            ?>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Today's Appointments</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">All Appointments</a></li>
                                        <!--                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>-->
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">

                                            <?php
                                            $db = dbConn();
                                            $curdate = date('y/m/d');
                                            $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId WHERE tbl_services_job_card.EmployeeId='{$_SESSION['EMPLOYEEID']}' AND tbl_appointments.AppointmentDate='$curdate'";
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
                                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Select a before photo</label>
                                                                <input class="form-control" type="file" id="formFile">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Select an after photo</label>
                                                                <input class="form-control" type="file" id="formFile">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Comment">Type a comment</label>
                                                                <input type="text" class="form-control" id="Comment" name="Comment" placeholder="Type Comment" >
                                                            </div>
                                                        </form>
                                                            
                                                        
                                                            

                                                        <?php
                                                        $StatusId = $row['StatusId'];
                                                        ?>
                                                        <div class="btn-group mt-2">
                                                            <button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName']; ?></button>
                                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                                <input type="text" name="UpdateJobCardNo" value="<?php echo $row['JobCardNo']; ?>"/>
                                                                <button type="submit" id="action" name="action" value="update" class="btn btn-danger btn-sm" onclick="update(this)">Update</button><input type="text" id="StatusId" name="StatusId" value="<?php echo @$StatusId ?>">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <!-- /.post -->

                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">
                                            <!-- The timeline -->
                                            <div class="timeline timeline-inverse">
                                                <h3>hello</h3>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
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
