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
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="card-title">Appointments Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="s_Id" placeholder="Enter Service Id">
                            <input type="text" name="cus_Reg" placeholder="Enter Customer RegNo">
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
                            if (!empty($s_Id)) {
                                $where .= "tbl_appointments.ServiceId='$s_Id' AND";
                            }
                            //check customer reg no
                            if (!empty($cus_Reg)) {
                                $where .= " tbl_appointments.RegNo='$cus_Reg' AND";
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

                        $sql = "SELECT * FROM tbl_appointments LEFT JOIN tbl_personal_care_services ON tbl_appointments.ServiceId=tbl_personal_care_services.ServiceId LEFT JOIN tbl_appointments_type ON tbl_appointments.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId LEFT JOIN tbl_customers ON tbl_appointments.CustomerId=tbl_customers.CustomerId WHERE tbl_appointments.AppointmentTypeId='1' ORDER BY AppointmentId DESC $where";
                        $result = $db->query($sql);
                        ?>
                        <table id="appointment_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>AppointmentId</th>
                                    <th>Customer Name</th>
                                    <th>Reg.No</th>
                                    <th>Service</th>
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
                                                <form action="viewJobCard.php" method="post">
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
                                            <td><?php echo $row['ServiceName']; ?></td>
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
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>







