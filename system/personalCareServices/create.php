<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Service</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Service</a></li>
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
                        $message = array();
                        extract($_POST);
                        extract($_FILES);
                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {
                            $ServiceName = dataClean($ServiceName);
                            $Charge = dataClean($Charge);
                            $Description = dataClean($Description);


//                            ===========Start Validation==================
                            $message = array();
                            if (empty($ServiceName)) {
                                $message['ServiceName'] = "Service Name should not be empty..!";
                            }
                            if (empty($ServiceTypeId)) {
                                $message['ServiceTypeId'] = "Service Type should not be empty..!";
                            }
                            if (empty($ServiceCategoryId)) {
                                $message['ServiceCategoryId'] = "Service Category should not be empty..!";
                            }

                            if (empty($Charge)) {
                                $message['Charge'] = "Charge should not be empty..!";
                            }
                            if (empty($ServiceDurationId)) {
                                $message['ServiceDurationId'] = "ServiceDuration should not be empty..!";
                            }
                            if (empty($Description)) {
                                $message['Description'] = "Description should not be empty..!";
                            }
                            if (empty($message)) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["ServiceImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["ServiceImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['ServiceImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['ServiceImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["ServiceImage"]["size"] > 5000000) {
                                    $message['ServiceImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['ServiceImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["ServiceImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["ServiceImage"]["name"]));
                                    } else {
                                        $message['ServiceImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }


                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_personal_care_services ("
                                        . "ServiceName,"
                                        . "ServiceTypeId,"
                                        . "ServiceCategoryId,"
                                        . "Charge,"
                                        . "ServiceDurationId,"
                                        . "Description,"
                                        . "ServiceImage) VALUES ("
                                        . "'$ServiceName',"
                                        . "'$ServiceTypeId',"
                                        . "'$ServiceCategoryId',"
                                        . "'$Charge',"
                                        . "'$ServiceDurationId',"
                                        . "'$Description',"
                                        . "'$Photo')";
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
                            if (empty($message) AND!empty($_FILES["ServiceImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["ServiceImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["ServiceImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['ServiceImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['ServiceImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["ServiceImage"]["size"] > 5000000) {
                                    $message['ServiceImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['ServiceImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["ServiceImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["ServiceImage"]["name"]));
                                    } else {
                                        $message['ServiceImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousServiceImage;
                            }


                            $db = dbConn();
                            $sql = "UPDATE tbl_personal_care_services SET "
                                    . "ServiceName='$ServiceName',"
                                    . "ServiceTypeId='$ServiceTypeId',"
                                    . "ServiceCategoryId='$ServiceCategoryId',"
                                    . "Charge='$Charge',"
                                    . "ServiceDurationId='$ServiceDurationId',"
                                    . "Description='$Description',"
                                    . "ServiceImage='$Photo'"
                                    . "WHERE ServiceId='$ServiceId'";
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
                            $sql = "SELECT * FROM tbl_personal_care_services WHERE ServiceId='$ServiceId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $ServiceName = $row['ServiceName'];
                            $ServiceTypeId = $row['ServiceTypeId'];
                            $ServiceCategoryId = $row['ServiceCategoryId'];
                            $Charge = $row['Charge'];
                            $ServiceDurationId = $row['ServiceDurationId'];
                            $Description = $row['Description'];
                            $ServiceImage = $row['ServiceImage'];
                            $ServiceId = $row['ServiceId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Service Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="ServiceName">Service Name</label>
                                    <input type="text" class="form-control" id="ServiceName" name="ServiceName" placeholder="Enter Service Name" value="<?php echo @$ServiceName; ?>">
                                    <div class="text-danger"><?php echo @$message['ServiceName']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <?php
                                            $db = dbConn();
                                            $sql = "SELECT * FROM tbl_personal_care_services_type";
                                            $result = $db->query($sql);
                                            ?>
                                            <label for="ServiceTypeId">Service Type</label>
                                            <select class="form-control" name="ServiceTypeId" id="ServiceTypeId" onchange="loadServiceCategory(this.value)">
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
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="ServiceCategoryId">Service Category</label>
                                            <div id="category_list">
                                                <?php
                                                if (@$action == "update_account") {
                                                    $db = dbConn();
                                                    $sql = "SELECT * FROM tbl_personal_care_services_category WHERE ServiceTypeId='$ServiceTypeId'";
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <select class="form-control" name="ServiceCategoryId" id="ServiceCategoryId" >
                                                        <option value="">--</option>
                                                        <?php
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?php echo $row['ServiceCategoryId']; ?>" <?php if ($row['ServiceCategoryId'] == $ServiceCategoryId) { ?>selected <?php } ?>><?php echo $row['ServiceCategoryName']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <select class="form-control" name="ServiceCategoryId" id="ServiceCategoryId">
                                                        <option value="">--</option>
                                                    </select>
                                                    <div class="text-danger"><?php echo @$message['ServiceCategoryId']; ?></div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Charge">Charge </label>
                                    <input type="text" class="form-control" id="Charge" name="Charge" placeholder="Enter Charge" value="<?php echo @$Charge; ?>">
                                    <div class="text-danger"><?php echo @$message['Charge']; ?></div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_personal_care_services_duration";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="ServiceDurationId">Service Duration</label>
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
                                    <label for="Description">Description</label>
                                    <textarea class="form-control" id="Desc" name="Description" placeholder="Enter Description"><?php echo @$Description; ?></textarea>
                                    <div class="text-danger"><?php echo @$message['Description']; ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="ServiceImage" class="form-label">Service Image</label>
                                    <input class="form-control" type="file" id="ServiceImage" name="ServiceImage">
                                    <input type="hidden" name="PreviousServiceImage" value="<?php echo @$ServiceImage; ?>">
                                    <div class="text-danger"><?php echo @$message['ServiceImage']; ?></div>

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="ServiceId" value="<?php echo @$ServiceId; ?>">
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
                            <h3 class="card-title">Service Details</h3>
                        </div>
                        <div class="card-body">
                            <!--                            ================search==================-->
                            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                                Service Name:
                                <input type="text" name="ServiceName" id="ServiceName" class="form-control" placeholder="Enter Service Name">
<!--                                <div class="row mb-3 mt-2">
                                    <div class="col">
                                        From:
                                        <input type="text" name="EmployeeRegDate1" id="EmployeeRegDate1" class="form-control" placeholder="Enter Start Date">
                                    </div>
                                    <div class="col">
                                        To:
                                        <input type="text" name="EmployeeRegDate2" id="EmployeeRegDate2" class="form-control" placeholder="Enter End Date" >
                                    </div>
                                </div>-->
                                <button type = "submit" name = "action" value = "search_account" class = "btn btn-success mt-2 mb-3" >Search</button>

                            </form>
                            <?php
                            $where = null;
                            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "search_account") {
                                if (!empty($ServiceName)) {
                                    $where = "WHERE ServiceName='$ServiceName'";
                                }
                            }
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_personal_care_services $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="service_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Service Image</th>
                                        <th>Name</th>
                                        <th>Charge</th>  
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
                                                        <input type="hidden" name="ServiceId" value="<?php echo $row['ServiceId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['ServiceImage']; ?>"></td>
                                                <td><?php echo $row['ServiceName']; ?></td>
                                                <td><?php echo $row['Charge']; ?></td>
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
        $('#service_list').DataTable({
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
<script>

    function loadServiceCategory(ServiceTypeId) {
        var c = "ServiceTypeId=" + ServiceTypeId + "&";
        $.ajax({
            type: 'POST',
            data: c,
            url: 'loadServiceCategory.php',
            success: function (response) {
//                alert(response)
                $("#category_list").html(response)
            },
            error: function (request, status, error) {
                alert(error)
            }
        });
    }
</script>


