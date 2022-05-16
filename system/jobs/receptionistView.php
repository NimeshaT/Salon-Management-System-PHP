<?php
include '../header.php';
include '../nav.php';
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
                        <li class="breadcrumb-item active">Manager View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_services_job_card LEFT JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId LEFT JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId LEFT JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId LEFT JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId";
//            $sql = "SELECT tbl_services_job_card.* ,  tbl_employees.* , tbl_customers.* , tbl_personal_care_services.* , tbl_appointments_type.* , tbl_personal_care_services_type.* , tbl_personal_care_services_category.* , tbl_personal_care_services_duration.* , tbl_employees.FirstName AS EFName , tbl_employees.LastName AS ELName , tbl_customers.FirstName AS CFName , tbl_customers.LastName AS CLName FROM tbl_services_job_card  INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId INNER JOIN tbl_personal_care_services_type ON tbl_services_job_card.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId INNER JOIN tbl_personal_care_services_category ON tbl_services_job_card.ServiceCategoryId=tbl_personal_care_services_category.ServiceCategoryId INNER JOIN tbl_personal_care_services_duration ON tbl_services_job_card.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId";
//            echo $sql = "SELECT * FROM tbl_services_job_card , tbl_employees.FirstName AS EFName , tbl_employees.LastName AS ELName  LEFT JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId LEFT JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId LEFT JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId";

            $result = $db->query($sql);
            ?>
            <table class="table table-striped" id="tbl_manager">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Job Card No</th>
                        <th>Appointment Id</th>
                        <th>Appointment Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Service Name</th>
                        <th>EmployeeId</th>
                        <th>Customer RegNo:</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $row['JobCardNo']; ?></td>
                                <td><?php echo $row['AppointmentId']; ?></td>
                                <td><?php echo $row['AppointmentDate']; ?></td>
                                <td><?php echo $row['StartTime']; ?></td>
                                <td><?php echo $row['EndTime']; ?></td>
                                <td><?php echo $row['ServiceName']; ?></td>
                                <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['RegNo']; ?></td>
                                <?php
                                if ($row['StatusId'] == '3') {
//            $StatusId = $row['StatusId'];
                                    ?>
                                    <td><button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button></td>
                                    <?php
                                } elseif ($row['StatusId'] == '4') {
                                    ?>
                                    <td><button type="button" class="btn btn-primary btn-sm"><?php echo $row['StatusName']; ?></button></td>
                                    <?php
                                }
                                ?>
                        
                
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

<?php
include '../footer.php';
?>

<script>
    $(function () {
//        $("#example1").DataTable({
//            "responsive": true, "lengthChange": false, "autoWidth": false,
//            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#tbl_manager').DataTable({
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
</script>
