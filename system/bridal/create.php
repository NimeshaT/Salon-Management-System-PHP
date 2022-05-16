<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bridal Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bridal Package</a></li>
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
                            $PackageName = dataClean($PackageName);

                            // Start validation
                            $message = array();
                            if (empty($PackageName)) {
                                $message['PackageName'] = "Package Name should not be empty..!";
                            }
                            if (empty($PackagePrice)) {
                                $message['PackagePrice'] = "Package Price should not be empty..!";
                            }
                            if (empty($DiscountRate)) {
                                $message['DiscountRate'] = "Discount Rate should not be empty..!";
                            }
                            if (empty($ServiceDurationId)) {
                                $message['ServiceDurationId'] = "Consultation Time should not be empty..!";
                            }
                            if (empty($ServiceTypeId)) {
                                $message['ServiceTypeId'] = "ServiceType Name should not be empty..!";
                            }

                            if (empty($message)) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["PackageImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["PackageImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['PackageImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['PackageImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["PackageImage"]["size"] > 5000000) {
                                    $message['PackageImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['PackageImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["PackageImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["PackageImage"]["name"]));
                                    } else {
                                        $message['PackageImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }


                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                echo $sql = "INSERT INTO tbl_bridal_packages("
                                . "PackageName,"
                                . "PackagePrice,"
                                . "DiscountRate,FreeItem,PackageImage,ServiceDurationId,ServiceTypeId)VALUES("
                                . "'$PackageName',"
                                . "'$PackagePrice',"
                                . "'$DiscountRate',"
                                . "'$FreeItem',"
                                . "'$Photo',"
                                . "'$ServiceDurationId',"
                                . "'$ServiceTypeId')";
                                $db->query($sql);



                                $BridalPackageId = $db->insert_id;
                                foreach ($Services as $Value) {
                                    $sql = "INSERT INTO tbl_bridal_packages_services(BridalPackageId,BridalServiceId) VALUES('$BridalPackageId','$Value')";
                                    $db->query($sql);
                                }

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
                            if (empty($message) AND!empty($_FILES["PackageImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["PackageImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["PackageImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['PackageImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['PackageImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["PackageImage"]["size"] > 5000000) {
                                    $message['PackageImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['PackageImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["PackageImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["PackageImage"]["name"]));
                                    } else {
                                        $message['PackageImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousPackageImage;
                            }

                            $db = dbConn();
                            $sql = "UPDATE tbl_bridal_packages SET "
                                    . "PackageName='$PackageName',"
                                    . "PackagePrice='$PackagePrice',"
                                    . "DiscountRate='$DiscountRate',"
                                    . "FreeItem='$FreeItem',"
                                    . "PackageImage='$Photo',"
                                    . "ServiceDurationId='$ServiceDurationId',"
                                    . "ServiceTypeId='$ServiceTypeId' "
                                    . "WHERE BridalPackageId='$BridalPackageId'";
                            $db->query($sql);
                            $sql = "DELETE FROM tbl_bridal_packages_services WHERE BridalPackageId='$BridalPackageId'";
                            $db->query($sql);
                            foreach ($Services as $Value) {
                                $sql = "INSERT INTO tbl_bridal_packages_services(BridalPackageId,BridalServiceId) VALUES('$BridalPackageId','$Value')";
                                $db->query($sql);
                            }
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
                            $sql = "SELECT * FROM tbl_bridal_packages WHERE BridalPackageId='$BridalPackageId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $PackageName = $row['PackageName'];
                            $PackagePrice = $row['PackagePrice'];
                            $DiscountRate = $row['DiscountRate'];
                            $FreeItem = $row['FreeItem'];
                            $PackageImage = $row['PackageImage'];
                            $ServiceDurationId = $row['ServiceDurationId'];
                            $ServiceTypeId = $row['ServiceTypeId'];
                            $BridalPackageId = $row['BridalPackageId'];

                            //checkboxes
                            $sql = "SELECT * FROM tbl_bridal_packages_services WHERE BridalPackageId='$BridalPackageId'";
                            $result = $db->query($sql);
                            $Services = array();
                            while ($row = $result->fetch_assoc()) {
                                $Services[] = $row['BridalServiceId'];
                            }

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Bridal Package Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="PackageName">Package Name</label>
                                    <input type="text" class="form-control" id="PackageName" name="PackageName" placeholder="Enter PackageName" value="<?php echo @$PackageName; ?>">
                                    <div class="text-danger"><?php echo @$message['PackageName']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="PackagePrice">Package Price</label>
                                    <input type="text" class="form-control" id="PackagePrice" name="PackagePrice" placeholder="Enter PackagePrice" value="<?php echo @$PackagePrice; ?>">
                                    <div class="text-danger"><?php echo @$message['PackagePrice']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="DiscountRate">Discount Rate</label>
                                    <input type="text" class="form-control" id="DiscountRate" name="DiscountRate" placeholder="Enter DiscountRate" value="<?php echo @$DiscountRate; ?>">
                                    <div class="text-danger"><?php echo @$message['DiscountRate']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="serviceAreas">Select Services</label>
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_bridal_services";
                                    $result = $db->query($sql);
                                    ?>

                                    <div class="row">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['BridalServiceId']; ?>" id="<?php echo $row['BridalServiceId']; ?>" name="Services[]"
                                                        <?php
                                                        if (!empty($Services)) {
                                                            if (in_array($row['BridalServiceId'], @$Services)) {
                                                                ?>
                                                                       checked
                                                                       <?php
                                                                   }
                                                               }
                                                               ?>
                                                               >
                                                        <label class="form-check-label" for="BridalServiceId">
                                                            <?php echo $row['BridalServiceName']; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>


                                </div>

                                <div class="form-group">
                                    <label for="FreeItem">FreeItem</label>
                                    <input type="text" class="form-control" id="FreeItem" name="FreeItem" placeholder="Enter FreeItem" value="<?php echo @$FreeItem; ?>">

                                </div>

                                <div class="mb-3">
                                    <label for="PackageImage" class="form-label">Package Image</label>
                                    <input class="form-control" type="file" id="PackageImage" name="PackageImage">
                                    <input type="hidden" name="PreviousPackageImage" value="<?php echo @$PackageImage; ?>">
                                    <div class="text-danger"><?php echo @$message['PackageImage']; ?></div>

                                </div>
                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_personal_care_services_duration";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="ServiceDurationId">Consultation Time</label>
                                    <select class="form-control" name="ServiceDurationId" id="ServiceDurationId" >
                                        <option value="">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['ServiceDurationId']; ?>"<?php if (@$ServiceDurationId == $row['ServiceDurationId']) { ?>selected <?php } ?>><?php echo getDuration($row['ServiceDuration']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="text-danger"><?php echo @$message['ServiceDurationId']; ?></div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_personal_care_services_type";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="ServiceTypeId">Service Type</label>
                                    <select class="form-control" name="ServiceTypeId" id="ServiceTypeId" >
                                        <option value="">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['ServiceTypeId']; ?>"<?php if (@$ServiceTypeId == $row['ServiceTypeId']) { ?>selected <?php } ?>><?php echo $row['ServiceTypeName']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="text-danger"><?php echo @$message['ServiceTypeId']; ?></div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="BridalPackageId" value="<?php echo @$BridalPackageId; ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Package Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_bridal_packages";
                            $result = $db->query($sql);
//                            
                            ?>

                            <table id="bridal_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Package Image</th>
                                        <th>Name</th>
<!--                                        <th>Designation</th>-->
                                        <th>Package Price</th>  
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
                                                        <input type="hidden" name="BridalPackageId" value="<?php echo $row['BridalPackageId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['PackageImage']; ?>"></td>
                                                <td><?php echo $row['PackageName']; ?></td>
                                                <td><?php echo $row['PackagePrice']; ?></td>
                                            </tr>  

                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
        $('#bridal_list').DataTable({
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


