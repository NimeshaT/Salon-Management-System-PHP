<?php
//session_start();
include '../header.php';
include '../nav.php';
//session_destroy();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Payments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_services_job_card LEFT JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId LEFT JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId LEFT JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId LEFT JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId WHERE tbl_services_job_card.StatusId='3' AND tbl_services_job_card.AppointmentTypeId='2'";

            $result = $db->query($sql);
//            $JobCardNo1;
            ?>
            <table class="table table-striped" id="tbl_manager">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Job Card No</th>
                        <th>Appointment Id</th>
                        <th>Package Name</th>
                        <th>Status</th>
                        <th>Add Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
//                            $jobCardNo1 =  $row['JobCardNo'];
                            ?>

                            <tr>
                                <td><?php echo $row['JobCardNo']; ?></td>
                                <td><?php echo $row['AppointmentId']; ?></td>
                                <td><?php echo $row['PackageName']; ?></td>
                                <td><button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button></td>
                                <td>

                                    <?php
                                        echo $job=$row['JobCardNo'];
                                        ?>
                                    <form action="bridalInvoice.php" method="post">
                                        
                                        <input type="text" name="JobCardNo" value="<?php echo $job ?>">
                                        <input type="text" name="BridalPackageId" value="<?php echo $row['BridalPackageId'] ?>">
                                        <button type="submit" name="action" value="add_item" class="btn btn-primary" >Add Invoice</button>
                                    </form>
                                </td>
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

