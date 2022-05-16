<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-warning">
                        <?php
                        extract($_POST);
                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {
                            $RoleCode = dataClean($RoleCode);
                            $RoleName = dataClean($RoleName);

//                            ======================Start Validation=================
                            $message = array();
                            if (empty($RoleCode)) {
                                $message['RoleCode'] = "Role code should not be empty..!";
                            }
                            if (empty($RoleName)) {
                                $message['RoleName'] = "Role name should not be empty..!";
                            }


//                            =======================Insert Records=======================
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_users_role("
                                        . "RoleCode,RoleName)VALUES("
                                        . "'$RoleCode','$RoleName')";
                                $db->query($sql);
                                
                                 //                                ===========successful meesage=============
                                ?>
                                <div class="card " style="background-color: #FFD700">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-dark">Insert successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                                <?php
                            }
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        //                        =======================Update Records======================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $db = dbConn();
                            $sql = "UPDATE tbl_users_role SET "
                                    . "RoleName='$RoleName'"
                                    . "WHERE RoleCode='$RoleCode'";
                            $db->query($sql);

                            //                                ===========successful meesage=============
                                ?>
                                <div class="card " style="background-color: #FFD700">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-dark">Update successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                                <?php
                            $submit = "update";
                        }


//                        =======================Edit Records===============
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_users_role WHERE RoleCode='$RoleCode'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $RoleName = $row['RoleName'];
                            $RoleCode = $row['RoleCode'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }


                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Users Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="RoleCode">User role code</label>
                                    <input type="text" class="form-control" id="RoleCode" name="RoleCode" placeholder="Enter RoleCode" value="<?php echo @$RoleCode; ?>">
                                    <div class="text-danger"><?php echo @$message['RoleCode']; ?></div>
                                </div>
                                <div class="form-group">
                                    <label for="RoleName">User role name</label>
                                    <input type="text" class="form-control" id="RoleName" name="RoleName" placeholder="Enter RoleName" value="<?php echo @$RoleName; ?>">
                                    <div class="text-danger"><?php echo @$message['RoleName']; ?></div>
                                </div>
                               
                            </div>
                            <div class="card-footer">
<!--                                <input type="hidden" name="RoleCode" value="<?php echo @$RoleCode; ?>">-->
                                <button type="submit" class="btn btn-warning" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Users Role Details</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_users_role";
                            $result = $db->query($sql);
                            ?>
                            <table id="role_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Role Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="RoleCode" value="<?php echo $row['RoleCode']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['RoleName']; ?></td>
                                            </tr>  
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {
        $('#role_list').DataTable({
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


