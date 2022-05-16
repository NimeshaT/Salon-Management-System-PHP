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
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Employee</a></li>
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
                            $FirstName = dataClean($FirstName);
                            $LastName = dataClean($LastName);
                            $Address = dataClean($Address);
                            $NicNumber = dataClean($NicNumber);
                            $Email = dataClean($Email);
                            $TelNo = dataClean($TelNo);
                            $UserName = dataClean($UserName);

//                            ============================Start Validation=====================
                            $message = array();
                            if (empty($EmployeeRegDate)) {
                                $message['EmployeeRegDate'] = "Register date should not be empty..!";
                            }

                            if (empty($FirstName)) {
                                $message['FirstName'] = "First Name should not be empty..!";
                            }
                            if (empty($LastName)) {
                                $message['LastName'] = "Last Name should not be empty..!";
                            }
                            if (empty($Address)) {
                                $message['Address'] = "Address should not be empty..!";
                            }
                            if (empty($NicNumber)) {
                                $message['NicNumber'] = "Nic Number should not be empty..!";
                            }
                            if (empty($Email)) {
                                $message['Email'] = "Email should not be empty..!";
                            }
                            if (empty($TelNo)) {
                                $message['TelNo'] = "Tel No. should not be empty..!";
                            }
                            if (empty($UserName)) {
                                $message['UserName'] = "User Name should not be empty..!";
                            }
                            if (empty($Password)) {
                                $message['Password'] = "Password should not be empty..!";
                            }
                            if (empty($message)) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["EmployeeImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["EmployeeImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['EmployeeImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['EmployeeImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["EmployeeImage"]["size"] > 5000000) {
                                    $message['EmployeeImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['EmployeeImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["EmployeeImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["EmployeeImage"]["name"]));
                                    } else {
                                        $message['EmployeeImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }
//=========================Start Validation=========================
                            if (!empty($FirstName)) {
                                if (!preg_match("/^[A-Z ]*$/", substr($FirstName, 0, 1))) {
                                    $message['FirstName'] = 'First Letter should be in uppercase';
                                }
                            }
                            if (!empty($LastName)) {
                                if (!preg_match("/^[A-Z ]*$/", substr($LastName, 0, 1))) {
                                    $message['LastName'] = 'First Letter should be in uppercase';
                                }
                            }
                            if (!empty($NicNumber)) {
                                $test1 = strlen($NicNumber);
                                $test2 = substr($NicNumber, -1, 1);
                                if (!(($test1 == 10 && $test2 == "V") || $test1 == 12)) {
                                    $message['NicNumber'] = 'Invalid Nic number';
                                }
                            }
                            if (!empty($Email)) {
                                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                                    $message['Email'] = 'invalid email';
                                }
                            }
                            if (!empty($TelNo)) {
                                $test1 = substr($TelNo, 0, 3);
                                $test2 = strlen($TelNo);
                                if (!(($test1 == "+94") && $test2 == 12)) {
                                    $message['TelNo'] = 'invalid phone number';
                                }
                            }
                            if (!empty($Password)) {
                                if (strlen($Password) < 8) {
                                    $message['Password'] = "Password too short!";
                                }
                            }
                            if (!empty($Password)) {
                                if (!preg_match("#[0-9]+#", $Password)) {
                                    $message['Password'] = "Password must include at least one number!";
                                }
                            }
                            if (!empty($Password)) {
                                if (!preg_match("#[a-zA-Z]+#", $Password)) {
                                    $message['Password'] = "Password must include at least one letter!";
                                }
                            }


//                            ==================Insert Records===================
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_employees("
                                        . "TitleId,"
                                        . "EmployeeRegDate,"
                                        . "FirstName,"
                                        . "LastName,"
                                        . "DesignationId,"
                                        . "Address,"
                                        . "NicNumber,"
                                        . "Email,"
                                        . "TelNo,"
                                        . "EmployeeImage,"
                                        . "UserName,"
                                        . "Password)VALUES("
                                        . "'$TitleId',"
                                        . "'$EmployeeRegDate',"
                                        . "'$FirstName',"
                                        . "'$LastName',"
                                        . "'$DesignationId',"
                                        . "'$Address',"
                                        . "'$NicNumber',"
                                        . "'$Email',"
                                        . "'$TelNo',"
                                        . "'$Photo',"
                                        . "'$UserName',"
                                        . "'" . sha1($Password) . "')";
                                $db->query($sql);

                                $EmployeeId = $db->insert_id;
                                foreach ($PersonalCareServices as $Value) {
                                    $sql = "INSERT INTO tbl_employee_personal_care_services_type(EmployeeId,ServiceTypeId) VALUES('$EmployeeId','$Value')";
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

//                        ================================Update Records==========================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $FirstName = dataClean($FirstName);
                            $LastName = dataClean($LastName);
                            $Address = dataClean($Address);
                            $NicNumber = dataClean($NicNumber);
                            $Email = dataClean($Email);
                            $TelNo = dataClean($TelNo);
                            $UserName = dataClean($UserName);

//                            ============================Start Validation=====================
                            $message = array();
                            if (empty($FirstName)) {
                                $message['FirstName'] = "First Name should not be empty..!";
                            }
                            if (empty($LastName)) {
                                $message['LastName'] = "Last Name should not be empty..!";
                            }
                            if (empty($Address)) {
                                $message['Address'] = "Address should not be empty..!";
                            }
                            if (empty($NicNumber)) {
                                $message['NicNumber'] = "Nic Number should not be empty..!";
                            }
                            if (empty($Email)) {
                                $message['Email'] = "Email should not be empty..!";
                            }
                            if (empty($TelNo)) {
                                $message['TelNo'] = "Tel No. should not be empty..!";
                            }
                            if (empty($UserName)) {
                                $message['UserName'] = "User Name should not be empty..!";
                            }
                            if (empty($Password)) {
                                $message['Password'] = "Password should not be empty..!";
                            }

                            if (empty($message) AND!empty($_FILES["EmployeeImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["EmployeeImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["EmployeeImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['EmployeeImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['EmployeeImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["EmployeeImage"]["size"] > 5000000) {
                                    $message['EmployeeImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['EmployeeImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["EmployeeImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["EmployeeImage"]["name"]));
                                    } else {
                                        $message['EmployeeImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousEmployeeImage;
                            }

                            //=========================Start Validation=========================
                            if (!empty($FirstName)) {
                                if (!preg_match("/^[A-Z ]*$/", substr($FirstName, 0, 1))) {
                                    $message['FirstName'] = 'First Letter should be in uppercase';
                                }
                            }
                            if (!empty($LastName)) {
                                if (!preg_match("/^[A-Z ]*$/", substr($LastName, 0, 1))) {
                                    $message['LastName'] = 'First Letter should be in uppercase';
                                }
                            }
                            if (!empty($NicNumber)) {
                                $test1 = strlen($NicNumber);
                                $test2 = substr($NicNumber, -1, 1);
                                if (!(($test1 == 10 && $test2 == "V") || $test1 == 12)) {
                                    $message['NicNumber'] = 'Invalid Nic number';
                                }
                            }
                            if (!empty($Email)) {
                                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                                    $message['Email'] = 'invalid email';
                                }
                            }
                            if (!empty($TelNo)) {
                                $test1 = substr($TelNo, 0, 3);
                                $test2 = strlen($TelNo);
                                if (!(($test1 == "+94") && $test2 == 12)) {
                                    $message['TelNo'] = 'invalid phone number';
                                }
                            }

                            $db = dbConn();
                            $sql = "UPDATE tbl_employees SET "
                                    . "TitleId='$TitleId',"
                                    . "EmployeeRegDate='$EmployeeRegDate',"
                                    . "FirstName='$FirstName',"
                                    . "LastName='$LastName',"
                                    . "DesignationId='$DesignationId',"
                                    . "Address='$Address',"
                                    . "NicNumber='$NicNumber',"
                                    . "Email='$Email',"
                                    . "TelNo='$TelNo',"
                                    . "EmployeeImage='$Photo',"
                                    . "UserName='$UserName'"
                                    . "WHERE EmployeeId='$EmployeeId'";
                            $db->query($sql);
//                            ==========checkboxupdate=========
                            $sql = "DELETE FROM tbl_employee_personal_care_services_type WHERE EmployeeId='$EmployeeId'";
                            $db->query($sql);
                            foreach ($PersonalCareServices as $Value) {
                                $sql = "INSERT INTO tbl_employee_personal_care_services_type(EmployeeId,ServiceTypeId) VALUES('$EmployeeId','$Value')";
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

//                        ======================Edit Records===============================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_employees WHERE EmployeeId='$EmployeeId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $TitleId = $row['TitleId'];
                            $EmployeeRegDate = $row['EmployeeRegDate'];
                            $FirstName = $row['FirstName'];
                            $LastName = $row['LastName'];
                            $DesignationId = $row['DesignationId'];
                            $Address = $row['Address'];
                            $NicNumber = $row['NicNumber'];
                            $Email = $row['Email'];
                            $TelNo = $row['TelNo'];
                            $EmployeeImage = $row['EmployeeImage'];
                            $UserName = $row['UserName'];
                            $Password = $row['Password'];
                            $EmployeeId = $row['EmployeeId'];

                            //checkboxes
                            $sql = "SELECT * FROM tbl_employee_personal_care_services_type WHERE EmployeeId='$EmployeeId'";
                            $result = $db->query($sql);
                            $PersonalCareServices = array();
                            while ($row = $result->fetch_assoc()) {
                                $PersonalCareServices[] = $row['ServiceTypeId'];
                            }

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Employee Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="EmployeeRegDate">Register Date</label>
                                    <input type="Date" class="form-control" id="EmployeeRegDate" name="EmployeeRegDate" placeholder="Enter Date" value="<?php echo @$EmployeeRegDate; ?>">
                                    <div class="text-danger"><?php echo @$message['EmployeeRegDate']; ?></div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_employees_title";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="TitleId">Select Title</label>
                                    <select class="form-control" name="TitleId" id="TitleId">
                                        <option value="">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['TitleId']; ?>" <?php if (@$TitleId == $row['TitleId']) { ?> selected <?php } ?>><?php echo $row['TitleName']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="FirstName">First Name</label>
                                    <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name" value="<?php echo @$FirstName; ?>">
                                    <div class="text-danger"><?php echo @$message['FirstName']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name" value="<?php echo @$LastName; ?>">
                                    <div class="text-danger"><?php echo @$message['LastName']; ?></div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_designations";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="DesignationId">Select Designation</label>
                                    <select class="form-control" name="DesignationId" id="DesignationId">
                                        <option value="">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['DesignationId']; ?>" <?php if (@$DesignationId == $row['DesignationId']) { ?> selected <?php } ?>><?php echo $row['DesignationName']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="serviceAreas">Select Services</label>
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_personal_care_services_type";
                                    $result = $db->query($sql);
                                    ?>

                                    <div class="row">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['ServiceTypeId']; ?>" id="<?php echo $row['ServiceTypeId']; ?>" name="PersonalCareServices[]"
                                                        <?php
                                                        if (!empty($PersonalCareServices)) {
                                                            if (in_array($row['ServiceTypeId'], @$PersonalCareServices)) {
                                                                ?>
                                                                       checked
                                                                       <?php
                                                                   }
                                                               }
                                                               ?>
                                                               >
                                                        <label class="form-check-label" for="ServiceTypeId">
                                                            <?php echo $row['ServiceTypeName']; ?>
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
                                    <label for="Address">Address</label>
                                    <textarea class="form-control" id="Address" name="Address" placeholder="Enter Address"><?php echo @$Address; ?></textarea>
                                    <div class="text-danger"><?php echo @$message['Address']; ?></div>
                                </div>


                                <div class="form-group">
                                    <label for="NicNumber">NicNumber </label>
                                    <input type="text" class="form-control" id="NicNumber" name="NicNumber" placeholder="Enter NicNumber" value="<?php echo @$NicNumber; ?>">
                                    <div class="text-danger"><?php echo @$message['NicNumber']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="Email">Email </label>
                                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email" value="<?php echo @$Email; ?>">
                                    <div class="text-danger"><?php echo @$message['Email']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="TelNo">Tel No. </label>
                                    <input type="tex" class="form-control" id="TelNo" name="TelNo" placeholder="Enter Tel No." value="<?php echo @$TelNo; ?>">
                                    <div class="text-danger"><?php echo @$message['TelNo']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="UserName">User Name</label>
                                    <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter User Name" value="<?php echo @$UserName; ?>">
                                    <div class="text-danger"><?php echo @$message['UserName']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" value="<?php echo @$Password; ?>">
                                    <div class="text-danger"><?php echo @$message['Password']; ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="EmployeeImage" class="form-label">Profile Image</label>
                                    <input class="form-control" type="file" id="EmployeeImage" name="EmployeeImage">
                                    <input type="hidden" name="PreviousEmployeeImage" value="<?php echo @$EmployeeImage; ?>">
                                    <div class="text-danger"><?php echo @$message['EmployeeImage']; ?></div>

                                </div>

                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="EmployeeId" value="<?php echo @$EmployeeId; ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Employee Details</h3>
                        </div>
                        <div class="card-body">
                            <!--                            ================search==================-->
                            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                                Email:
                                <input type="text" name="Email" id="ServiceName" class="form-control" placeholder="Enter Email">
                                <div class="row mb-3 mt-2">
                                    <div class="col">
                                        From:
                                        <input type="date" name="EmployeeRegDate1" id="EmployeeRegDate1" class="form-control" placeholder="Enter Start Date">
                                    </div>
                                    <div class="col">
                                        To:
                                        <input type="date" name="EmployeeRegDate2" id="EmployeeRegDate2" class="form-control" placeholder="Enter End Date" >
                                    </div>
                                </div>
                                <button type = "submit" name = "action" value = "search_account" class = "btn btn-success mt-2 mb-3" >Search</button>

                            </form>
                            <?php
                            $where = null;
                            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "search_account") {
                                if (!empty($Email)) {
                                    $where = "WHERE Email='$Email'";
                                }
                                if (!empty($EmployeeRegDate1 && $EmployeeRegDate2)) {
                                    $where = "WHERE EmployeeRegDate BETWEEN '$EmployeeRegDate1' AND '$EmployeeRegDate2'";
                                }
                            }
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_employees LEFT JOIN tbl_employees_title ON tbl_employees.TitleId=tbl_employees_title.TitleId $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="employee_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Profile Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Register Date</th>  
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
                                                        <input type="hidden" name="EmployeeId" value="<?php echo $row['EmployeeId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['EmployeeImage']; ?>"></td>
                                                <td><?php echo $row['TitleName']; ?> <?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                                <td><?php echo $row['Email']; ?></td>
                                                <td><?php echo $row['EmployeeRegDate']; ?></td>
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
        $('#employee_list').DataTable({
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


