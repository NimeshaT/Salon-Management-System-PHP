<?php
include '../header.php';
include '../nav.php';
date_default_timezone_set("Asia/Colombo");
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Attendance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Attendance</a></li>
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

                        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($EmployeeId) && @$action == "create_account") {

                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                echo $sql = "INSERT INTO tbl_attendance("
                                . "AttendanceDate,"
                                . "EmployeeId,"
                                . "AttendTime,WorkingStatusId)VALUES("
                                . "'$AttendanceDate',"
                                . "'$EmployeeId',"
                                . "'$AttendTime','$WorkingStatusId')";
                                $db->query($sql);

                                echo $sql = "UPDATE tbl_employees SET WorkingStatusId='$WorkingStatusId' WHERE EmployeeId='$EmployeeId'";
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
                            echo $sql = "UPDATE tbl_attendance SET "
                            . "EmployeeId='$EmployeeId',"
                            . "AttendTime='$AttendTime',"
                            . "WorkingStatusId='$WorkingStatusId',"
                            . "OffTime='$OffTime'"
                            . "WHERE AttendanceId='$AttendanceId'";
                            $db->query($sql);

                            $submit = "update";
                            
                             ?>
                                <div class="card " style="background-color: #FFD700">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-dark">Update successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                                <?php
                        }

                        //start edit records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            echo $sql = "SELECT * FROM tbl_attendance WHERE AttendanceId='$AttendanceId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $EmployeeId = $row['EmployeeId'];
                            $AttendTime = $row['AttendTime'];
                            $WorkingStatusId = $row['WorkingStatusId'];
                            $OffTime = $row['OffTime'];
                            $AttendanceId = $row['AttendanceId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                           $EmployeeId="";
                           $AttendTime="";
                           $WorkingStatusId="";
                           $OffTime="";
                              //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Attendance Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="AttendanceDate">Attendance Date</label>
                                    <input type="text" class="form-control" id="AttendanceDate" name="AttendanceDate" value="<?php echo date("y/m/d") ?>" readonly>
                                </div>

                                <div class="form-group">

                                    <label for="EmployeeId">Select Employee</label>
                                    <select class="form-control" name="EmployeeId" id="EmployeeId">
                                        <option value="">--</option>
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM tbl_employees";
                                        $result = $db->query($sql);
                                        ?>
                                        <?php
//                                        $EmpId;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['EmployeeId']; ?>" <?php if (@$EmployeeId == $row['EmployeeId']) { ?> selected <?php } ?>><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></option>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="AttendTime">Attend Time</label>
                                    <input type="Time" class="form-control" id="AttendTime" name="AttendTime" value="<?php echo @$AttendTime ?>">
                                </div>

                                <div class="form-group">

                                    <label for="WorkingStatusId">Mark Attendance</label>
                                    <select class="form-control" name="WorkingStatusId" id="WorkingStatusId">
                                        <option value="">--</option>
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM tbl_working_status WHERE WorkingStatusId IN ('3','5')";
                                        $result = $db->query($sql);
                                        ?>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['WorkingStatusId']; ?>" <?php if (@$WorkingStatusId == $row['WorkingStatusId']) { ?> selected <?php } ?>><?php echo $row['WorkingStatusName']; ?></option>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="OffTime">Off Time</label>
                                    <input type="Time" class="form-control" id="OffTime" name="OffTime" value="<?php echo @$OffTime ?>">
                                </div>

                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="AttendanceId" value="<?php echo @$AttendanceId; ?>">
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
                            <h3 class="card-title">Attendance Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="text" name="FirstName" placeholder="Enter First Name">
                                <input type="text" name="LastName" placeholder="Enter Last Name">
                                <button type="submit" class="bg-success">Search</button>
                            </form>
                            <?php
                            extract($_POST);
                            $db = dbConn();
                            $where = null;
                            //dynamically generate the query
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                //check service id
                                if (!empty($FirstName)) {
                                    $where .= "FirstName='$FirstName' AND";
                                }
                                //check customer reg no
                                if (!empty($LastName)) {
                                    $where .= " LastName='$LastName' AND";
                                }
                                
                                //generate dynamic query remove AND last characters from the string
                                if (!empty($where)) {
                                    $where = substr($where, 0, -3);
                                    $where = " AND $where";
                                }

//            echo $where;
                            }
                            $CurDate = Date('y-m-d');
                            echo $sql = "SELECT * FROM tbl_attendance INNER JOIN tbl_employees ON tbl_attendance.EmployeeId=tbl_employees.EmployeeId WHERE AttendanceDate='$CurDate' $where";
                            $result = $db->query($sql);
                            ?>

                            <table id="attendance_list" class="table table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Employee Image</th>
                                        <th>Employee Name</th>
                                        <th>In Time</th>
                                        <th>Off Time</th>
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
                                                        <input type="hidden" name="AttendanceId" value="<?php echo $row['AttendanceId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['EmployeeImage']; ?>"></td>
                                                <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                                <td><?php echo $row['AttendTime']; ?></td>
                                                <td><?php echo $row['OffTime']; ?></td>
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
        $('#attendance_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>


