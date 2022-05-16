<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Schedule</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);
            echo $JobCardNo;
            ?>
            <div class="row mb-3">
                <div class="col">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "SaveSchedule") {
                        $message = array();
                        if (empty($EmployeeId)) {
                            $message['EmployeeId'] = "Employee should not be empty..!";
                        }

                        //Start Insert Records
                        if (empty($message)) {
                            $db = dbConn();
                            echo $sql = "INSERT INTO tbl_bridal_schedules("
                            . "ServicesJobCardId,"
                            . "JobCardNo,"
                            . "AppointmentId,CustomerId,CustomerRNo,BridalPackageId,WeddingDay,HomecomingDay,EmployeeId)VALUES("
                            . "'$UpdateJobCardId',"
                            . "'$JobCardNo',"
                            . "'$AppointmentId',"
                            . "'$CustomerId',"
                            . "'$CustomerRNo',"
                            . "'$BridalPackageId',"
                            . "'$WeddingDay',"
                            . "'$HomecomingDay',"
                            . "'$EmployeeId')";
                            $db->query($sql);


//
                            $BridalScheduleId = $db->insert_id;
                            foreach ($Services as $Value) {
                                $sql = "INSERT INTO tbl_schedule_additional_service(BridalScheduleId,AdditionalId) VALUES('$BridalScheduleId','$Value')";
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
                    }
                    ?>
                    <fieldset class="border border-2 p-2 mt-4">
                        <legend  class="float-none w-auto p-2 mb-0"><h5>Create Bridal Schedule</h5></legend>
                        <?php
                        $db = dbConn();
                        echo $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId WHERE JobCardNo='$JobCardNo'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo $JobCardId = $row['ServicesJobCardId'];
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="row  mb-2">
                                        <div class="col">
                                            <label for="JobCardNo" class="form-label">Job Card No</label>
                                            <input type="text" class="form-control" id="JobCardNo" name="JobCardNo" value="<?php echo $JobCardNo ?>"readonly>
                                        </div>
                                        <div class="col">
                                            <label for="AppointmentId" class="form-label">Appointment Id</label>
                                            <input type="text" class="form-control" id="AppointmentId" name="AppointmentId" value="<?php echo $row['AppointmentId'] ?>"readonly>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col">
                                            <label for="CustomerRNo" class="form-label">Customer Reg No</label>
                                            <input type="text" class="form-control" id="CustomerRNo" name="CustomerRNo" value="<?php echo $row['CRegNo'] ?>"readonly>
                                        </div>
                                        <div class="col">
                                            <label for="CustomerId" class="form-label">Customer Name</label>
                                            <input type="hidden" class="form-control" id="CustomerId" name="CustomerId" value="<?php echo $CustId ?>">
                                            <input type="text" class="form-control" value="<?php echo $row['CFirstName'] ?> <?php echo $row['CLastName'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="BridalPackageId">Package Name</label>
                                        <input type="hidden" class="form-control" id="BridalPackageId" name="BridalPackageId" value="<?php echo $PKiD ?>">
                                        <input type="text" class="form-control" value="<?php echo $row['PackageName'] ?>" readonly >
                                    </div>
                                    <h6 class="text-danger">If package is Homecoming Day, Please input only Homecoming Day and If package is Wedding Day, Please input only Wedding Day.Unless, Please input both days.</h6>
                                    <div class="row mt-2 mb-2">
                                        <div class="col">
                                            <label for="WeddingDay" class="form-label">Wedding Day</label>
                                            <input type="date" class="form-control" id="WeddingDay" name="WeddingDay" value="<?php echo @$WeddingDay ?>">
                                        </div>
                                        <div class="col">
                                            <label for="HomecomingDay" class="form-label">Homecoming Day</label>
                                            <input type="date" class="form-control" id="HomecomingDay" name="HomecomingDay" value="<?php echo @$HomeComingDay ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM tbl_employees INNER JOIN tbl_employee_personal_care_services_type ON tbl_employees.EmployeeId=tbl_employee_personal_care_services_type.EmployeeId WHERE ServiceTypeId='44'";
                                        $result = $db->query($sql);
                                        ?>
                                        <label for="EmployeeId" class="form-label">Select Beautician</label>
                                        <select class="form-control form-select" name="EmployeeId" id="EmployeeId">
                                            <option value="">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['EmployeeId']; ?>" <?php if (@$EmployeeId == $row['EmployeeId']) { ?> selected <?php } ?>><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="text-danger"><?php echo @$message['EmployeeId']; ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="serviceAreas">Select more services</label>
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM tbl_additional_services";
                                        $result = $db->query($sql);
                                        ?>
                                        <div class="row">
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="<?php echo $row['AdditionalId']; ?>" id="<?php echo $row['AdditionalId']; ?>" name="Services[]"
                                                            <?php
                                                            if (!empty($Services)) {
                                                                if (in_array($row['AdditionalId'], @$Services)) {
                                                                    ?>
                                                                           checked
                                                                           <?php
                                                                       }
                                                                   }
                                                                   ?>
                                                                   >
                                                            <label class="form-check-label" for="AdditionalId">
                                                                <?php echo $row['AdditionalServiceName']; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="btn-group mt-2">

                                        <input type="text" name="UpdateJobCardId" value="<?php echo $JobCardId; ?>"/>
                                        <button type="submit" id="action" name="action" value="SaveSchedule" class="btn btn-warning" onclick="update(this.value)">Save</button>
                                        <button type="submit" id="action" name="action" value="Cancel" class="btn btn-danger">Cancel</button>
                                    </div>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </fieldset>
                </div>
                <div class="col">
                    <fieldset class="border border-2 p-2 mt-4">
                        <legend  class="float-none w-auto p-2 mb-0"><h5>Add before after photos</h5></legend>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <!--                                                        <h6 class="text-danger">If complete your task, please fill the form and update your status</h6>-->
                            <div class="mb-3">
                                <label for="BeforePhoto" class="form-label">Select a before photo</label>
                                <input class="form-control" type="file" id="BeforePhoto" name="BeforePhoto">
                                <input type="hidden" name="PreviousBeforePhoto" value="<?php echo @$BeforePhoto; ?>">

                            </div>
                            <div class="mb-3">
                                <label for="AfterPhoto" class="form-label">Select an after photo</label>
                                <input class="form-control" type="file" id="AfterPhoto" name="AfterPhoto">
                                <input type="hidden" name="PreviousAfterPhoto" value="<?php echo @$AfterPhoto; ?>">

                            </div>

                            <div class="form-group">
                                <label for="Comment">Type a comment</label>
                                <input type="text" class="form-control" id="Comment" name="Comment" value="<?php echo @$Comment ?>" >
                            </div>
                            <h6 class="text-success">When you submit the save button, it will update your status as completed automatically</h6>
                            <div class="btn-group mt-2">
                                <input type="text" name="UpdateJobCardNo" value="<?php echo $JobCardNo; ?>"/>
<!--                                                        <input type="text" name="UpdateEmployee" value="<?php echo $EmpId; ?>"/>-->
                                <button type="submit" id="action" name="action" value="Save" class="btn btn-warning" onclick="update(this.value)">Save</button>
                                <button type="submit" id="action" name="action" value="Cancel" class="btn btn-danger">Cancel</button>
                            </div>

                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

