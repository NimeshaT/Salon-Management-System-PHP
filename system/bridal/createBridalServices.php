<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bridal Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bridal Services</a></li>
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
                            $BridalServiceName = dataClean($BridalServiceName);

                            // Start validation
                            $message = array();
                            if (empty($BridalServiceName)) {
                                $message['BridalServiceName'] = " Bridal Service Name should not be empty..!";
                            }


                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_bridal_services("
                                        . "BridalServiceName)VALUES("
                                        . "'$BridalServiceName')";
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

                        //Start Update Records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $db = dbConn();
                            $sql = "UPDATE tbl_bridal_services SET "
                                    . "BridalServiceName='$BridalServiceName' "
                                    . "WHERE BridalServiceId='$BridalServiceId'";
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

                        //start edit records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_bridal_services WHERE BridalServiceId='$BridalServiceId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $BridalServiceName = $row['BridalServiceName'];
                            $BridalServiceId = $row['BridalServiceId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Bridal Service Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="BridalServiceName">Bridal Service Name</label>
                                    <input type="text" class="form-control" id="BridalServiceName" name="BridalServiceName" placeholder="Enter BridalServiceName" value="<?php echo @$BridalServiceName; ?>">
                                    <div class="text-danger"><?php echo @$message['BridalServiceName']; ?></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="BridalServiceId" value="<?php echo @$BridalServiceId; ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Bridal Service Details</h3>
                        </div>
                        <div class="card-body">

<?php
$db = dbConn();
$sql = "SELECT * FROM tbl_bridal_services";
$result = $db->query($sql);
?>

                            <table id="bridal_service_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Service Name</th>
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
                                                        <input type="hidden" name="BridalServiceId" value="<?php echo $row['BridalServiceId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['BridalServiceName']; ?></td>
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
        $('#bridal_service_list').DataTable({
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


