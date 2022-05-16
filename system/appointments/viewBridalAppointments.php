<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Completed Bridal Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Completed Bridal Appointments</a></li>
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
                            <input type="text" name="p_Id" placeholder="Enter package Id">
                            <input type="text" name="cus_Reg" placeholder="Enter Customer RegNo">
                            <input type="text" name="EmpId" placeholder="Enter Employee Id">
                            <input type="text" name="JobId" placeholder="Enter Job Card No">
                            <input type="date" name="from" placeholder="Enter from date">
                            <input type="date" name="to" placeholder="Enter to date">
                            <button type="submit" class="bg-success mt-2">Search</button>
                        </form>

                        <?php
                        extract($_POST);
                        $db = dbConn();
                        $where = null;
                        //dynamically generate the query
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //check service id
                            if (!empty($p_Id)) {
                                $where .= "tbl_services_job_card.BridalPackageId='$p_Id' AND";
                            }
                            //check customer reg no
                            if (!empty($cus_Reg)) {
                                $where .= " tbl_services_job_card.CRegNo='$cus_Reg' AND";
                            }
                            //check employee id
                            if (!empty($EmpId)) {
                                $where .= " tbl_services_job_card.EmployeeId='$EmpId' AND";
                            }
                            //check job card No
                            if (!empty($JobId)) {
                                $where .= " tbl_services_job_card.JobCardNo='$JobId' AND";
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

                        $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId INNER JOIN tbl_personal_care_services_duration ON tbl_services_job_card.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId WHERE AppointmentTypeId='2' AND tbl_services_job_card.StatusId='3' $where";
                        $result = $db->query($sql);
                        ?>
                        <table id="appointment_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>AppointmentId</th>
                                    <th>Appointment Date</th>
                                    <th>Job Card No</th>
                                    <th>Customer Name</th>
                                    <th>Reg.No</th>
                                    <th>EmployeeId</th>
                                    <th>Employee Name</th>
                                    <th>Package</th>
                                    <th>Service Duration</th>
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

                                            <td><?php echo $row['AppointmentId']; ?></td>
                                            <td><?php echo $row['AppointmentDate']; ?></td>
                                            <td><?php echo $row['JobCardNo']; ?></td>
                                            <td><?php echo $row['CFirstName']; ?> <?php echo $row['CLastName']; ?></td>
                                            <td><?php echo $row['CRegNo']; ?></td>
                                            <td><?php echo $row['EmployeeId']; ?></td>
                                            <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                            <td><?php echo $row['PackageName']; ?></td>
                                            <td><?php echo getDuration($row['ServiceDuration']); ?></td>
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








