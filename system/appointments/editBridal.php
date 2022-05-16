<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Appointments</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card card-warning">
                        <?php
                        extract($_POST);
                        if (!isset($action)) {
                            @$AppointmentTypeId = "";
                            @$ServiceTypeId="";
                            @$AppointmentId="";
                        }


                        //Start Update Records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $db = dbConn();
                            $sql = "UPDATE tbl_appointments SET "
                                    . "AppointmentDate='$AppointmentDate',"
                                    . "StartTime='$StartTime1',"
                                    . "EndTime='$EndTime1'"
                                    . "WHERE AppointmentId='$AppointmentId'";
                            $db->query($sql);
                        }

                        //start edit records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_appointments WHERE AppointmentId='$AppointmentId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $RegNo = $row['RegNo'];
                            $FirstName = $row['FirstName'];
                            $LastName = $row['LastName'];
                            $NicNumber = $row['NicNumber'];
                            $AppointmentTypeId = $row['AppointmentTypeId'];
                            $ServiceTypeId = $row['ServiceTypeId'];
                            $AppointmentDate = $row['AppointmentDate'];
                            $StartTime = $row['StartTime'];
                            $ServiceDurationId = $row['ServiceDurationId'];
                            $EndTime = $row['EndTime'];
                            $BridalPackageId = $row['BridalPackageId'];
                            $AppointmentId = $row['AppointmentId'];

                            $action = 'update_account';
                            $form_title = "Update ";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Appointments Account</h3>

                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="RegNo">Customer Registration No:</label>
                                    <input type="text" class="form-control" id="RegNo" name="RegNo" value="<?php echo @$RegNo ?>" readonly>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="FirstName">First Name</label>
                                            <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo @$FirstName ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="LastName">Last Name</label>
                                            <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo @$LastName ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="NicNumber">NIC</label>
                                    <input type="text" class="form-control" id="NicNumber" name="NicNumber" value="<?php echo @$NicNumber ?>" readonly>
                                </div>
                                <div class="row">

                                    <?php
                                    $db = dbConn();

                                    $sql = "SELECT * FROM  tbl_appointments_type WHERE AppointmentTypeId='$AppointmentTypeId'";
                                    $result = $db->query($sql);
                                    ?>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="AppointmentTypeId" >Appointment Type</label>
                                                    <input type="text" style="display: none;" class="form-control" id="AppointmentTypeId" name="AppointmentTypeId" value="<?php echo $row['AppointmentTypeId'] ?>" readonly>
                                                    <input type="text" class="form-control" value="<?php echo $row['AppointmentTypeName']; ?>" readonly>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="AppointmentTypeId" >Appointment Type</label>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="col">
                                    </div>
                                </div>

                                <?php
//                                extract($_POST);
                                $sql = "SELECT * FROM tbl_personal_care_services_type WHERE ServiceTypeId='$ServiceTypeId'";
                                $result = $db->query($sql);
                                ?>

                                <?php
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
                                                <!--                                                <div class="col">
                                                                                                    <label for="ServiceCategoryId" class="form-label">Service Category</label>
                                                                                                    <input type="text" style="display: none;" class="form-control" id="ServiceCategoryId" name="ServiceCategoryId" value="<?php echo $row['ServiceCategoryId']; ?>">
                                                                                                    <input type="text" class="form-control" value="<?php echo $row['ServiceCategoryName']; ?>" readonly>
                                                                                                </div>-->
                                            </div>
                                        </div>
                                        <!--                                        <div class="mb-3 ms-2">
                                                                                    <label for="ServiceName" class="form-label">Service Name</label>
                                                                                    <input type="text"  style="display: none" class="form-control" id="ServiceId" name="ServiceId" value="<?php echo $row['ServiceId']; ?>">
                                                                                    <input type="text" class="form-control"  value="<?php echo $row['ServiceName']; ?>" readonly>
                                                                                </div>-->
                                        <!--                                        <div class="mb-3 ms-2 mt-0">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="Charge" class="form-label">Charge</label>
                                                                                            <input type="text" class="form-control" id="Charge" name="Charge" value="<?php echo $row['Charge']; ?>" readonly>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="ServiceTypeId" class="form-label">Service Type</label>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <!--                                            <div class="col">
                                                                                            <label for="ServiceCategoryId" class="form-label">Service Category</label>
                                                                                            <input type="text" class="form-control"  readonly>
                                                                                        </div>-->
                                        </div>
                                    </div>
                                    <!--                                    <div class="mb-3 ms-2">
                                                                            <label for="ServiceName" class="form-label">Service Name</label>
                                                                            <input type="text" class="form-control"  readonly>
                                                                        </div>-->
                                    <!--                                    <div class="mb-3 ms-2 mt-0">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <label for="Charge" class="form-label">Charge</label>
                                                                                    <input type="text" class="form-control"  readonly>
                                                                                </div>
                                                                                <div class="col">
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <?php
                                }
                                ?>


                                <?php
                                $sql1 = "SELECT * FROM tbl_bridal_packages INNER JOIN tbl_appointments ON tbl_bridal_packages.BridalPackageId=tbl_appointments.BridalPackageId WHERE tbl_appointments.AppointmentId='$AppointmentId'";
                                $result1 = $db->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        ?>
                                        <div class="form-group">
                                            <label for="BridalPackageId" class="form-label">Package Name</label>
                                            <input type="hidden" class="form-control" id="BridalPackageId" name="BridalPackageId" value="<?php echo $row1['BridalPackageId']; ?>">
                                            <input type="text" class="form-control"  value="<?php echo $row1['PackageName']; ?>" readonly>

                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="form-group">
                                        <label for="BridalPackageId" class="form-label">Package Name</label>
                                        <input type="text" class="form-control"  >

                                    </div>
                                    <?php
                                }
                                ?>



                                <?php
                                if (@$action == 'update_account') {
                                    ?>

                                    <div class="form-group">
                                        <label for="AppointmentDate">Select Appointment Date</label>
                                        <input type="date" class="form-control" id="AppointmentDate" name="AppointmentDate" value="<?php echo @$AppointmentDate ?>">
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="form-group">
                                        <label for="AppointmentDate">Select Appointment Date</label>
                                        <input type="date" readonly class="form-control" id="AppointmentDate" name="AppointmentDate" value="<?php echo @$AppointmentDate ?>">
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <?php
                                        if (@$action == 'update_account') {
                                            ?>
                                            <div class="form-group">
                                                <label for="StartTime" class="form-label">Start Time</label>
                                                <input type="Time" class="form-control" id="StartTime" name="StartTime" value="<?php echo @$StartTime ?>">
                                                <input type="hidden" class="form-control" id="StartTime1" name="StartTime1">                                           
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="form-group">
                                                <label for="StartTime" class="form-label">Start Time</label>
                                                <input type="Time" class="form-control" id="StartTime" name="StartTime"  readonly>
                                                <input type="hidden" class="form-control" id="StartTime1" name="StartTime1">                                           
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
//                                    extract($_POST);
                                    $sql = "SELECT * FROM tbl_personal_care_services_duration WHERE ServiceDurationId='5'";
                                    $result = $db->query($sql);
                                    ?>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="col">
                                                <label for="ServiceDurationId" class="form-label">Duration</label>
                                                <input type="text" class="form-control"  id="ServiceDurationId" name="ServiceDurationId" value="<?php echo getDuration($row['ServiceDuration']) ?>" readonly>
                                                <input type="text" style="display: none" class="form-control"  id="DurationSeconds" name="DurationSeconds" value="<?php echo $row['ServiceDuration'] ?>">
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col">
                                            <label for="ServiceDurationId" class="form-label">Duration</label>
                                            <input type="text" readonly class="form-control"  id="ServiceDurationId" name="ServiceDurationId" value="" readonly>
                                            <input type="text" style="display: none" class="form-control"  id="DurationSeconds" name="DurationSeconds" value="<?php echo $row['ServiceDuration'] ?>">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="EndTime" class="form-label">End Time</label>
                                            <input type="Time" class="form-control" id="EndTime" name="EndTime" value="<?php echo @$EndTime ?>" readonly>
                                            <input type="hidden" class="form-control" id="EndTime1" name="EndTime1">
                                        </div>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <?php
                                if (@$action == 'update_account') {
                                    ?>
                                    <input type="hidden" name="AppointmentId" value="<?php echo @$AppointmentId; ?>">
                                    <button type="submit" class="btn btn-warning" name="action" value="update_account">Update</button>
                                    <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                                    <?php
                                }
                                ?>

                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Appointments Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">



                            <?php
//                            extract($_POST);

                            $db = dbConn();
                            echo $sql = "SELECT * FROM tbl_appointments LEFT JOIN tbl_bridal_packages ON tbl_appointments.BridalPackageId=tbl_bridal_packages.BridalPackageId LEFT JOIN tbl_appointments_type ON tbl_appointments.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId WHERE tbl_appointments.AppointmentTypeId='2'";
                            $result = $db->query($sql);
                            ?>
                            <table id="appointment_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Customer Reg.No</th>
                                        <th>Package</th>
                                        <th>Appointment Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="AppointmentId" value="<?php echo $row['AppointmentId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="createJobCard2.php" method="post">
                                                        <input type="hidden" name="AppointmentId" value="<?php echo $row['AppointmentId']; ?>">
                                                        <button type="submit" class="btn btn-success">Create Job Card</button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['RegNo']; ?></td>
                                                <td><?php echo $row['PackageName']; ?></td>
                                                <td><?php echo $row['AppointmentDate']; ?></td>
                                                <td><?php echo $row['StartTime']; ?></td>
                                                <td><?php echo $row['EndTime']; ?></td>
                                            </tr>  
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {
        $('#appointment_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>
<script src="system/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

<script>
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
</script>





