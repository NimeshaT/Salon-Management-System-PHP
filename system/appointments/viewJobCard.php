<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">JobCard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">JobCard</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Job Card Details</h3>
                            <?php
                           
                            extract($_POST);
                            $db= dbConn();
                            $sql = "SELECT tbl_services_job_card.* ,  tbl_employees.* , tbl_customers.* , tbl_appointments_type.* , tbl_personal_care_services_type.* ,tbl_personal_care_services.* , tbl_personal_care_services_duration.* , tbl_employees.FirstName AS EFName , tbl_employees.LastName AS ELName , tbl_customers.FirstName AS CFName , tbl_customers.LastName AS CLName FROM tbl_services_job_card  INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId INNER JOIN tbl_personal_care_services_type ON tbl_services_job_card.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId INNER JOIN tbl_personal_care_services_duration ON tbl_services_job_card.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId WHERE AppointmentId='$AppointmentId'";
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
                                            <li class="list-group-item">Service Name: <?php echo $row['ServiceName']; ?></li>
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
                                                <?php echo getDuration($row["ServiceDuration"]) ?>
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
    </section>
</div>

<?php
include '../footer.php';
?>









