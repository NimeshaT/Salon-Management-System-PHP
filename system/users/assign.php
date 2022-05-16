<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Assign</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <?php
            $db = dbConn();

            echo $sql = "SELECT * FROM tbl_employees INNER JOIN tbl_users_role ON tbl_employees.RoleCode=tbl_users_role.RoleCode";
            $result = $db->query($sql);
            ?>
            <form>
                <table class="table table-striped" id="tbl_users">
                    <thead class="bg bg-warning">
                        <tr>
                            <th>Employee Id</th>
                            <th>Employee Name</th>
                            <th>Role Name</th>
                            <th>Assign Role Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            echo $result->num_rows;
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td><?php echo $row['EmployeeId']; ?></td>
                                    <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                    <td><?php echo $row['RoleName']; ?></td>
                                    <td>
                                        <div class="col">
                                            <?php
                                            $db = dbConn();
                                            $sql1 = "SELECT * FROM tbl_users_role";
                                            $result1 = $db->query($sql1);
                                            ?>
                                            <select class="form-control form-select" name="RoleCode" id="RoleCode">
                                                <option value="">--</option>
                                                <?php
                                                if ($result1->num_rows > 0) {
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row1['RoleCode']; ?>" <?php if (@$RoleCode == $row1['RoleCode']) { ?> selected <?php } ?>><?php echo $row1['RoleName']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>

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
        $('#tbl_users').DataTable({
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
