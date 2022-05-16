<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services Type</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Services Type</a></li>
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
                        extract($_FILES);
                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {
                            $ServiceTypeName = dataClean($ServiceTypeName);

//                            ======================Start Validation=================
                            $message = array();
                            if (empty($ServiceTypeName)) {
                                $message['ServiceTypeName'] = "Service Type Name should not be empty..!";
                            }

                            if (empty($message)) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["Image"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["Image"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['Image'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['Image'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["Image"]["size"] > 5000000) {
                                    $message['Image'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['Image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["Image"]["name"]));
                                    } else {
                                        $message['Image'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }

//                            =======================Insert Records=======================
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_personal_care_services_type("
                                        . "ServiceTypeName,Image)VALUES("
                                        . "'$ServiceTypeName','$Photo')";
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
                            if (empty($message) AND!empty($_FILES["Image"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["Image"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["Image"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['Image'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['Image'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["Image"]["size"] > 5000000) {
                                    $message['Image'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['Image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["Image"]["name"]));
                                    } else {
                                        $message['Image'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousImage;
                            }
                            
                            $db = dbConn();
                            $sql = "UPDATE tbl_personal_care_services_type SET "
                                    . "ServiceTypeName='$ServiceTypeName',"
                                    . "Image='$Photo'"
                                    . "WHERE ServiceTypeId='$ServiceTypeId'";
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


//                        =======================Edit Recors===============
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_personal_care_services_type WHERE ServiceTypeId='$ServiceTypeId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $ServiceTypeName = $row['ServiceTypeName'];
                            $Image = $row['Image'];
                            $ServiceTypeId = $row['ServiceTypeId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }


                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Service Type Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="ServiceTypeName">Service Type Name</label>
                                    <input type="text" class="form-control" id="ServiceTypeName" name="ServiceTypeName" placeholder="Enter ServiceTypeName" value="<?php echo @$ServiceTypeName; ?>">
                                    <div class="text-danger"><?php echo @$message['ServiceTypeName']; ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="Image" class="form-label">Service Type Image</label>
                                    <input class="form-control" type="file" id="Image" name="Image">
                                    <input type="hidden" name="PreviousImage" value="<?php echo @$Image; ?>">
                                    <div class="text-danger"><?php echo @$message['Image']; ?></div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="ServiceTypeId" value="<?php echo @$ServiceTypeId; ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Service Type Details</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_personal_care_services_type";
                            $result = $db->query($sql);
                            ?>
                            <table id="service_type_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Image</th>
                                        <th>Service Type Name</th>
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
                                                        <input type="hidden" name="ServiceTypeId" value="<?php echo $row['ServiceTypeId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['Image']; ?>"></td>
                                                <td><?php echo $row['ServiceTypeName']; ?></td>
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
        $('#service_type_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
//    $(function () {
//        $('#birthdate').datetimepicker({
//        format: 'L',
//        orientation: 'top',
//        
//    });
//    });
</script>


