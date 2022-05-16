<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reviews</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Reviews</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "change") {
//            extract($_POST);
            echo $Aid;
            echo $Sid;
            $Sid = $Sid == '1' ? '7' : '1';
            echo $Sid;
            $db = dbConn();
            echo $sql = "UPDATE tbl_review SET StatusId='$Sid' WHERE AppointmentId='$Aid'";
            $db->query($sql);
        }
        ?>
        <div class="container-fluid">
            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_review INNER JOIN tbl_customers ON tbl_review.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_personal_care_services ON tbl_review.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_status ON tbl_review.StatusId=tbl_status.StatusId";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped" id="tbl_review">
                <thead class="bg bg-warning">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Review</th>
                        <th>Appointment Id</th>
                        <th>Customer Name</th>
                        <th>Service Name</th>
                        <th>Review Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <button type="submit" class="btn btn-primary btn-sm" name="action" value="change">Change</button>
                                        <input type="text" name="Aid" value="<?php echo $row['AppointmentId'] ?>">
                                        <input type="text" name="Sid" value="<?php echo $row['StatusId'] ?>">
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    if ($row['StatusId'] == 1) {
                                        ?>
                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                        <?php
                                    } else {
                                         ?>
                                        <button type="button" class="btn btn-danger btn-sm"><?php echo $row['StatusName']; ?></button>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['Review']; ?></td>
                                <td><?php echo $row['AppointmentId']; ?></td>
                                <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['ServiceName']; ?></td>
                                <td><?php echo $row['ReviewDate']; ?></td>

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

        $('#tbl_review').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</script>
