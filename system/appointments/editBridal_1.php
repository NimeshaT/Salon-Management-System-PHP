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

                <div class="card card-warning">
                    <?php
                    extract($_POST);
                    if (!isset($action)) {
                        @$AppointmentTypeId = "";
                        @$ServiceTypeId = "";
                        @$AppointmentId = "";
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


                </div>
                <!-- /.card -->


                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="card-title">Appointments Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

 <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="A_Id" placeholder="Enter Appointment Id">
                            <input type="text" name="cus_Reg" placeholder="Enter Customer RegNo">
                            <input type="text" name="Pid" placeholder="Enter Package Id">
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
                            //check service id
                            if (!empty($A_Id)) {
                                $where .= "tbl_appointments.AppointmentId='$A_Id' AND";
                            }
                            //check customer reg no
                            if (!empty($cus_Reg)) {
                                $where .= " tbl_appointments.RegNo='$cus_Reg' AND";
                            }
                            //check package Id
                            if (!empty($Pid)) {
                                $where .= " tbl_appointments.BridalPackageId='$Pid' AND";
                            }
                            //check from to dates
                            if (!empty($from) && !empty($to)) {
                                $where .= " AppointmentDate BETWEEN  '$from' AND '$to' AND";
                            }
                            //generate dynamic query remove AND last characters from the string
                            if (!empty($where)) {
                                $where = substr($where, 0, -3);
                                $where = " AND $where";
                            }

//            echo $where;
                        }
                        echo $sql = "SELECT * FROM tbl_appointments LEFT JOIN tbl_bridal_packages ON tbl_appointments.BridalPackageId=tbl_bridal_packages.BridalPackageId LEFT JOIN tbl_appointments_type ON tbl_appointments.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId LEFT JOIN tbl_customers ON tbl_appointments.CustomerId=tbl_customers.CustomerId WHERE tbl_appointments.AppointmentTypeId='2' $where ORDER BY AppointmentId DESC ";
                        $result = $db->query($sql);
                        ?>
                        <table id="appointment_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
<!--                                        <th></th>-->
                                    <th></th>
                                    <th>Appointment Id</th>
                                    <th>Customer Name</th>
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
        <!--                                                <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="AppointmentId" value="<?php echo $row['AppointmentId']; ?>">
                                                    <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                </form>
                                            </td>-->
                                            <td>
                                                <?php
                                                $AppNo = $row['AppointmentId'];
                                                $sql = "SELECT * FROM tbl_services_job_card WHERE AppointmentId='$AppNo'";
                                                $res = $db->query($sql);
                                                if ($res->num_rows == 0) {
                                                    ?>

                                                    <form action="createJobCard2.php" method="post">
                                                        <input type="text" name="AppointmentId" value="<?php echo $row['AppointmentId']; ?>">
                                                        <button type="submit" class="btn btn-success">Create Job Card</button>
                                                    </form>
                                                    <?php
                                                } else {
                                                    ?>
                                                <form action="viewJobCard2.php" method="post">
                                                        <input type="text" name="AppointmentId" value="<?php echo $row['AppointmentId']; ?>">
                                                        <button type="submit" class="btn btn-primary">View Job Card</button>
                                                    </form>
                                                <?php
                                                }
                                                ?>




                                            </td>
                                            <td><?php echo $row['AppointmentId']; ?></td>
                                             <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
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






