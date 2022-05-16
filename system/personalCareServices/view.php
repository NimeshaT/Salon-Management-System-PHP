<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Services</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_personal_care_services "
                    . "LEFT JOIN tbl_personal_care_services_type ON tbl_personal_care_services.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId "
                    . "LEFT JOIN tbl_personal_care_services_category ON tbl_personal_care_services.ServiceCategoryId=tbl_personal_care_services_category.ServiceCategoryId";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped" id="tbl_personal_care_services">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Service Image</th>
                        <th>Service Id</th>
                        <th>Service Name</th>
                        <th>Service Type</th>
                        <th>Service Category</th>
                        <th>Charge</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['ServiceImage']; ?>"></td>
                                <td><?php echo $row['ServiceId']; ?></td>
                                <td><?php echo $row['ServiceName']; ?></td>
                                <td><?php echo $row['ServiceTypeName']; ?></td>
                                <td><?php echo $row['ServiceCategoryName']; ?></td>
                                <td><?php echo $row['Charge']; ?></td>
                                <td><?php echo $row['Description']; ?></td>
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
        $('#tbl_personal_care_services').DataTable({
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
