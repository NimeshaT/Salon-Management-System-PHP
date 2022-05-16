<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Services Category</a></li>
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
                            $ServiceCategoryName = dataClean($ServiceCategoryName);
                            $Description = dataClean($Description);

//                            ======================Start Validation====================
                            $message = array();
                            if (empty($ServiceTypeId)) {
                                $message['ServiceTypeId'] = "Service Type Name should not be empty..!";
                            }
                            if (empty($ServiceCategoryName)) {
                                $message['ServiceCategoryName'] = "Service Category Name should not be empty..!";
                            }
                            if (empty($Description)) {
                                $message['Description'] = "Description should not be empty..!";
                            }
                            if (empty($message)) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["CategoryImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["CategoryImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['CategoryImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['CategoryImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["CategoryImage"]["size"] > 5000000) {
                                    $message['CategoryImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['CategoryImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["CategoryImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["CategoryImage"]["name"]));
                                    } else {
                                        $message['CategoryImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }

//                            =================Insert Records=========================
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_personal_care_services_category("
                                        . "ServiceTypeId,"
                                        . "ServiceCategoryName,"
                                        . "Description,CategoryImage)VALUES("
                                        . "'$ServiceTypeId',"
                                        . "'$ServiceCategoryName',"
                                        . "'$Description','$Photo')";
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
//                        =====================Update Records===================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            if (empty($message) AND!empty($_FILES["CategoryImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["CategoryImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["CategoryImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['CategoryImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['CategoryImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["CategoryImage"]["size"] > 5000000) {
                                    $message['CategoryImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['CategoryImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["CategoryImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["CategoryImage"]["name"]));
                                    } else {
                                        $message['CategoryImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousCategoryImage;
                            }
                            $db = dbConn();
                            $sql = "UPDATE tbl_personal_care_services_category SET "
                                    . "ServiceTypeId='$ServiceTypeId',"
                                    . "ServiceCategoryName='$ServiceCategoryName',"
                                    . "Description='$Description',"
                                    . "CategoryImage='$Photo'"
                                    . "WHERE ServiceCategoryId='$ServiceCategoryId'";
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


//                       =====================Edit Records=======================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_personal_care_services_category WHERE ServiceCategoryId='$ServiceCategoryId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();
                            
                            $ServiceTypeId = $row['ServiceTypeId'];
                            $ServiceCategoryName = $row['ServiceCategoryName'];
                            $Description=$row['Description'];
                            $CategoryImage=$row['CategoryImage'];
                            $ServiceCategoryId = $row['ServiceCategoryId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }


                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Service Category Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                        $db= dbConn();
                                        $sql="SELECT * FROM tbl_personal_care_services_type";
                                        $result=$db->query($sql);
                                        ?>
                                    <label for="ServiceTypeId">Select Type</label>
                                    <select class="form-control" name="ServiceTypeId" id="ServiceTypeId">
                                    <option selected>--</option>
                                    <?php
                                            if($result->num_rows > 0){
                                                while ($row=$result->fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $row['ServiceTypeId']; ?>" <?php if (@$ServiceTypeId == $row['ServiceTypeId']) { ?> selected <?php } ?>><?php echo $row['ServiceTypeName']; ?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                </select>
                                    <div class="text-danger"><?php echo @$message['ServiceTypeId']; ?></div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="ServiceCategoryName">Service Category Name</label>
                                    <input type="text" class="form-control" id="ServiceCategoryName" name="ServiceCategoryName" placeholder="Enter ServiceCategoryName" value="<?php echo @$ServiceCategoryName; ?>">
                                    <div class="text-danger"><?php echo @$message['ServiceCategoryName']; ?></div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea class="form-control" id="Description" name="Description" rows="3"><?php echo @$Description; ?></textarea>
                                    <div class="text-danger"><?php echo @$message['Description']; ?></div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="CategoryImage" class="form-label">Service Type Image</label>
                                    <input class="form-control" type="file" id="CategoryImage" name="CategoryImage">
                                     <input type="hidden" name="PreviousCategoryImage" value="<?php echo @$CategoryImage; ?>">
                                    <div class="text-danger"><?php echo @$message['CategoryImage']; ?></div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="ServiceCategoryId" value="<?php echo @$ServiceCategoryId; ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Service Category Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_personal_care_services_category";
                            $result = $db->query($sql);
                            ?>

                            <table id="service_category_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Image</th>
                                        <th>Service Category Name</th>
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
                                                        <input type="hidden" name="ServiceCategoryId" value="<?php echo $row['ServiceCategoryId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                               <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['CategoryImage']; ?>"></td>
                                                <td><?php echo $row['ServiceCategoryName']; ?></td>
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
        $('#service_category_list').DataTable({
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


