<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Employee</a></li>
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
            $sql = "SELECT * FROM tbl_employees LEFT JOIN tbl_employees_title ON tbl_employees.TitleId=tbl_employees_title.TitleId LEFT JOIN tbl_designations ON tbl_employees.DesignationId=tbl_designations.DesignationId";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped" id="tbl_employee">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Employee Image</th>
                        <th>Employee Id</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Designation</th>
                        <th>Address</th>
                        <th>NicNumber</th>
                        <th>Email</th>
                        <th>TelNo</th>
                        <th>UserName</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['EmployeeImage']; ?>"></td>
                                <td><?php echo $row['EmployeeId']; ?></td>
                                <td><?php echo $row['TitleName']; ?></td>
                                <td><?php echo $row['FirstName']; ?></td>
                                <td><?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['DesignationName']; ?></td>
                                <td><?php echo $row['Address']; ?></td>
                                <td><?php echo $row['NicNumber']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['TelNo']; ?></td>
                                <td><?php echo $row['UserName']; ?></td>
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
        $('#tbl_employee').DataTable({
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

