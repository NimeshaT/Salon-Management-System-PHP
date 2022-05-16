<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);
            ?>
            <div class="row">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_employees LEFT JOIN tbl_designations ON tbl_employees.DesignationId=tbl_designations.DesignationId WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="<?php echo SITE_URL; ?>uploads/<?php echo $row['EmployeeImage']; ?>"
                                             alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $_SESSION['FIRSTNAME'] ?> <?php echo $_SESSION['LASTNAME'] ?></h3>
<!--                                    <p class="text-muted text-center"><?php echo $row['DesignationName'] ?></p>-->

                                </div>
                            </div>

                            <!--                           =====================About me box=================================-->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-book mr-1"></i> Nic Number</strong>
                                    <p class="text-muted">
                                        <?php echo $row['NicNumber'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <p class="text-muted"><?php echo $row['Address'] ?></p>
                                    <hr>
                                   
                                   
                                    <strong><i class="far fa-file-alt mr-1"></i> Contact No:</strong>
                                    <p class="text-muted"><?php echo $row['TelNo'] ?></p>
                                    <hr>
                                    <strong><i class="far fa-file-alt mr-1"></i> Email</strong>
                                    <p class="text-muted"><?php echo $row['Email'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#attendance" data-toggle="tab">Attendance</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <!--                                ===================Edit profile====================-->
                                <div class="active tab-pane" id="settings">
                                    <?php
                                    extract($_POST);
                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "upload_image") {

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
                                            $Photo = $PreviousProfileImage;
                                        }


//                    ================Start Update Records==================
                                        $db = dbConn();
                                        echo $sql = "UPDATE tbl_employees SET "
                                        . "EmployeeImage='$Photo'"
                                        . "WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}'";
                                        $db->query($sql);
                                        ?>

                                        <div class="card " style="background-color: #FFD700">
                                            <div class="card-header text-center">
                                                <h3 class="text-center text-dark">Update successfully <i class="far fa-thumbs-up"></i></h3>
                                                <a class="btn btn-warning btn-sm" href="view_profile.php" role="button">View Profile</a>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="EmployeeImage" class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" id="EmployeeImage" name="EmployeeImage">
                                            <input type="hidden" name="PreviousProfileImage" value="<?php echo @$EmployeeImage; ?>">
                                        </div>

                                        <div class="form-group ms-4">
                                            <button type="submit" class="btn btn-warning" id="action" name="action" value="upload_image">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!--                                =================================Attendance=======================-->
                                <div class="tab-pane" id="attendance">
                                    <section class="content">
                                        <div class="container-fluid">
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                <input type="date" name="from" placeholder="Enter from date">
                                                <input type="date" name="to" placeholder="Enter to date">
                                                <button type="submit" class="bg-success">Search</button>
                                            </form>
                                            <?php
                                            extract($_POST);
                                            $db = dbConn();
                                            $where = null;
                                            //dynamically generate the query
                                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                               
                                                //check from to dates
                                                if (!empty($from) && !empty($to)) {
                                                    $where .= " tbl_attendance.AttendanceDate BETWEEN  '$from' AND '$to' AND";
                                                }
                                                //generate dynamic query remove AND last characters from the string
                                                if (!empty($where)) {
                                                    $where = substr($where, 0, -3);
                                                    $where = " AND $where";
                                                }

//            echo $where;
                                            }

                                            echo $sql = "SELECT * FROM tbl_attendance INNER JOIN tbl_working_status ON tbl_attendance.WorkingStatusId=tbl_working_status.WorkingStatusId WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}' $where";
                                            $result = $db->query($sql);
                                            ?>
                                            <table border='1' width='100%' class="mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>Attendance Date</th>
                                                        <th>In Time</th>
                                                        <th>Off Time</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['AttendanceDate'] ?></td>
                                                                <td><?php echo $row['AttendTime'] ?></td>
                                                                <td><?php echo $row['OffTime'] ?></td>
                                                                <td><?php echo $row['WorkingStatusName'] ?></td>
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

                function update(element) {
                    $(element).parent().submit();
                }
            </script>
