<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Photos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Photos</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">

            <?php
            extract($_POST);
//            echo $Statusid;
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($UpdateJobCardNo)) {
                $db = dbConn();
                $StatusId = $StatusId == '3' ? '4' : '3';
                
                
                $sql = "UPDATE tbl_services_job_card SET statusId='$StatusId' WHERE JobCardNo='$UpdateJobCardNo'";
                
                print_r($sql);
                
                $db->query($sql);
            }
            ?>
            <?php
            $db = dbConn();
            echo $sql = "SELECT * FROM tbl_services_job_card WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}' AND StatusId='3'";

            $result = $db->query($sql);
            ?>
            <table class="table table-striped" id="tbl_manager">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Job Card No</th>
                        <th>Appointment Id</th>
                        <th>Before Photo</th>
                        <th>After Photo</th>
                        <th></th>
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
                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['BeforePhoto']; ?>"></td>
                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['AfterPhoto']; ?>"> </td>
                                <td>
                                    <form action="editPhotoForm.php" method="post">
                                        <input type="text" name="JobCardNo" value="<?php echo $row['JobCardNo']; ?>">
                                        <button class="btn-success">Edit Photos</button>
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
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    
    function update(element) {
      $(element).parent().submit();
    } 
</script>
</script>
