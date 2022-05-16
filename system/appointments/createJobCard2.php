<?php

include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Job Card</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Job Card</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-warning">
                        <?php
                        extract($_POST);

                        // Start validation
                        $message = array();

//                        start add records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add") {
                            $db = dbConn();
                            echo $sql = "INSERT INTO tbl_services_job_card("
                            . "EmployeeId,"
                            . "CustomerId,"
                            . "CRegNo,"
                            . "CFirstName,"
                            . "CLastName,"
                            . "CNic,"
                            . "AppointmentId,"
                            . "AppointmentTypeId,"
                            . "ServiceTypeId,"
                            . "AppointmentDate,"
                            . "ServiceDurationId,"
                            . "StartTime,"
                            . "EndTime,StatusId,BridalPackageId)VALUES("
                            . "'$EmployeeId',"
                            . "'$CustomerId',"
                            . "'$CRegNo',"
                            . "'$CFirstName',"
                            . "'$CLastName',"
                            . "'$CNic',"
                            . "'$AppointmentId',"
                            . "'$AppointmentTypeId',"
                            . "'$ServiceTypeId',"
                            . "'$AppointmentDate',"
                            . "'$ServiceDurationId1',"
                            . "'$StartTime',"
                            . "'$EndTime','4','$BridalPackageId')";
                            $db->query($sql);

                            $id = $db->insert_id;
                            $jobCardNo = 'J' . date('Y') . date('m') . date('d') . $id;
                            $sql = "UPDATE tbl_services_job_card SET JobCardNo='$jobCardNo' WHERE ServicesJobCardId='$id'";
                            $db->query($sql);
                            
                            echo $sql="UPDATE tbl_employees SET WorkingStatusId='1' WHERE EmployeeId='$EmployeeId'";
                            $db->query($sql);
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title">Create Job Card </h3>
                        </div>
                        <form id="form1" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <?php
                            extract($_POST);
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_appointments LEFT JOIN tbl_appointments_type ON tbl_appointments.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId LEFT JOIN tbl_personal_care_services_type ON tbl_appointments.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId LEFT JOIN tbl_personal_care_services_duration ON tbl_appointments.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId LEFT JOIN tbl_bridal_packages ON tbl_appointments.BridalPackageId=tbl_bridal_packages.BridalPackageId WHERE AppointmentId='$AppointmentId'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $ServiceTypeId = $row['ServiceTypeId'];
                                    ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="CRegNo">Customer Reg.No</label>
                                                    <input type="text" class="form-control" id="CRegNo" name="CRegNo" value="<?php echo $row['RegNo']; ?>" readonly>
                                                </div>

                                            </div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="CustomerId">Customer Id</label>
                                                            <input type="text" class="form-control" id="CustomerId" name="CustomerId" value="<?php echo $row['CustomerId']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="AppointmentId">Appointment Id</label>
                                                            <input type="text" class="form-control" id="AppointmentId" name="AppointmentId" value="<?php echo $row['AppointmentId']; ?>" readonly >
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="CFirstName">Customer First Name</label>
                                                    <input type="text" class="form-control" id="CFirstName" name="CFirstName" value="<?php echo $row['FirstName']; ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="CLastName">Customer Last Name</label>
                                                    <input type="text" class="form-control" id="CLastName" name="CLastName" value="<?php echo $row['LastName']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="CNic">NIC</label>
                                            <input type="text" class="form-control" id="CNic" name="CNic" value="<?php echo $row['NicNumber']; ?>" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="AppointmentTypeId">Appointment Type</label>
                                                    <input type="hidden" class="form-control" id="AppointmentTypeId" name="AppointmentTypeId" value="<?php echo $row['AppointmentTypeId']; ?>" readonly>
                                                    <input type="text" class="form-control" id="Form1AppointmentTypeName" value="<?php echo $row['AppointmentTypeName']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="BridalPackageId">Package Name</label>
                                                    <input type="hidden" class="form-control" id="AppointmentTypeId" name="BridalPackageId" value="<?php echo $row['BridalPackageId']; ?>" readonly>
                                                    <input type="text" class="form-control" id="Form1AppointmentTypeName" value="<?php echo $row['PackageName']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="ServiceTypeId">Service Type</label>
                                                    <input type="hidden" class="form-control" id="ServiceTypeId" name="ServiceTypeId" value="<?php echo $row['ServiceTypeId']; ?>">
                                                    <input type="text" class="form-control" id="Form1ServiceTypeName" value="<?php echo $row['ServiceTypeName']; ?>" readonly>
                                                </div>
                                            </div>
<!--                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="ServiceCategoryId">Service Category</label>
                                                    <input type="hidden" class="form-control" id="ServiceCategoryId" name="ServiceCategoryId" value="<?php echo $row['ServiceCategoryId']; ?>">
                                                    <input type="text" class="form-control" id="Form1ServiceCategoryName" value="<?php echo $row['ServiceCategoryName']; ?>" readonly>
                                                </div>
                                            </div>-->
                                        </div>

<!--                                        <div class="form-group">
                                            <label for="ServiceId">Service Name</label>
                                            <input type="hidden" class="form-control" id="ServiceId" name="ServiceId" value="<?php echo $row['ServiceId']; ?>">
                                            <input type="text" class="form-control" id="Form1ServiceName" value="<?php echo $row['ServiceName']; ?>" readonly>
                                        </div>-->


<!--                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="Charge">Charge</label>
                                                    <input type="text" class="form-control" id="Charge" name="Charge" value="<?php echo $row['Charge']; ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col">

                                            </div>
                                        </div>-->

                                        <div class="mb-3 ms-2">
                                            <label for="AppointmentDate" class="form-label"> Appointment Date</label>
                                            <input type="text" class="form-control" id="AppointmentDate" name="AppointmentDate" value="<?php echo $row['AppointmentDate']; ?>" readonly>
                                        </div>
                                        <div class="mb-3 ms-2">
                                            <label for="ServiceDurationId" class="form-label">Duration</label>
                                            <input type="hidden" class="form-control"  id="ServiceDurationId1" name="ServiceDurationId1" value="<?php echo $row['ServiceDurationId'] ?>" readonly>
                                            <input type="text" style="display: none" class="form-control"  id="ServiceDurationId" name="ServiceDurationId" value="<?php echo getDuration($row['ServiceDuration']) ?>" readonly>
                                            <input type="text" class="form-control" id="Form1Duration" value="<?php echo getDuration($row['ServiceDuration']) ?>" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="StartTime">Start Time</label>
                                                    <input type="text" class="form-control" id="StartTime" name="StartTime" value="<?php echo $row['StartTime']; ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="EndTime">End Time</label>
                                                    <input type="text" class="form-control" id="EndTime" name="EndTime" value="<?php echo $row['EndTime']; ?>" readonly>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            $db = dbConn();
                                            $sql = "SELECT * FROM tbl_employee_personal_care_services_type LEFT JOIN tbl_employees ON tbl_employee_personal_care_services_type.EmployeeId=tbl_employees.EmployeeId WHERE ServiceTypeId='$ServiceTypeId'";
                                            $result = $db->query($sql);
                                            ?>
                                            <label for="EmployeeId">Select Employee</label>
                                            <select class="form-control" name="EmployeeId" id="EmployeeId" onchange="selectEmployee(this.value)">
                                                <option value="">--</option>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <option  value="<?php echo $row['EmployeeId']; ?>" <?php if (@$EmployeeId == $row['EmployeeId']) { ?> selected <?php } ?>><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
<!--                                        <input type="hidden"  id="AppointmentId" name="AppointmentId" value="<?php @$EmployeeId ?>" >-->
                                        <button type="submit" class="btn btn-warning" name="action" value="add" >Submit</button>
                                        <!--                                        <button type="submit" class="btn btn-warning" name="action" value="add" onclick="showForm(this.id)">Submit</button>-->
                                        <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Job Card Details</h3>
                            <?php
                            echo $sql = "SELECT tbl_services_job_card.* ,  tbl_employees.* , tbl_customers.* , tbl_appointments_type.* , tbl_personal_care_services_type.* ,tbl_bridal_packages.* , tbl_personal_care_services_duration.* , tbl_employees.FirstName AS EFName , tbl_employees.LastName AS ELName , tbl_customers.FirstName AS CFName , tbl_customers.LastName AS CLName FROM tbl_services_job_card  INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId INNER JOIN tbl_personal_care_services_type ON tbl_services_job_card.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId INNER JOIN tbl_personal_care_services_duration ON tbl_services_job_card.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId INNER JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId WHERE AppointmentId='$AppointmentId'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class=" mt-3 pb-3 mb-3 d-flex justify-content-center ">
                                            <div class="image text-center">
                                                <img src="../uploads/<?php echo $row['EmployeeImage']; ?>" class="img-circle elevation-2 " width="80">
                                                <p class="d-block" id="EmployeeName"><?php echo $row['EFName']; ?> <?php echo $row["ELName"] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class=" mt-3 pb-3 mb-3 d-flex justify-content-center ">
                                            <div class="image text-center">
                                                <img src="../../uploads2/<?php echo $row['ProfileImage']; ?>" class="img-circle elevation-2 " width="80">
                                                <p class="d-block" id="EmployeeName"><?php echo $row['CFName']; ?> <?php echo $row['CLName']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Job Card No: <?php echo $row['JobCardNo']; ?> </li>
                                            <li class="list-group-item">Package Name: <?php echo $row['PackageName']; ?></li>
                                            <hr>
                                        </ul>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Appointment Id:<br>
                                                <?php echo $row["AppointmentId"] ?>
                                            </li>
                                            <li class="list-group-item">
                                                Customer Id:<br>
                                                <?php echo $row["CustomerId"] ?>
                                            </li>                                            
                                            <li class="list-group-item">
                                                Appointment Type:<br>
                                                <?php echo $row["AppointmentTypeName"] ?>
                                            </li>                                            
<!--                                            <li class="list-group-item">
                                                Service Category:<br>
                                                <?php echo $row["ServiceCategoryName"] ?>
                                            </li>                                            -->
                                            <li class="list-group-item">
                                                Appointment Date:<br>
                                                <?php echo $row["AppointmentDate"] ?>
                                            </li>   
                                            <li class="list-group-item">
                                                Start Time:<br>
                                                <?php echo $row["StartTime"] ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Customer Reg No:<br>
                                                <?php echo $row["RegNo"] ?>
                                            </li>                                            
                                            <li class="list-group-item">
                                                Customer Nic:<br>
                                                <?php echo $row["NicNumber"] ?>
                                            </li>                                            
                                            <li class="list-group-item">
                                                Service Type:<br>
                                                <?php echo $row["ServiceTypeName"] ?>
                                            </li>                                            
<!--                                            <li class="list-group-item">
                                                Charge:<br>
                                                Rs. <?php echo $row["Charge"] ?>
                                            </li>                                            -->
                                            <li class="list-group-item">
                                                Duration:<br>
                                                <?php echo $row["ServiceDuration"] ?>
                                            </li>  
                                            <li class="list-group-item">
                                                End Time:<br>
                                                <?php echo $row["EndTime"] ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                            
                        ?>


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



