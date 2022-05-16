<?php
//session_start();
include '../header.php';
include '../nav.php';
//session_destroy();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Payments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <?php
            extract($_POST);
      if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_item" && isset($JobCardNo)) {
echo 'hiiii';
echo $JobCardNo;
            $sql="SELECT * FROM tbl_services_job_card INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId WHERE JobCardNo='$JobCardNo'";
            $result=$db->query($sql);
            $row=$result->fetch_assoc();
//echo $result->num_rows;
            $jobCardNo=$row['JobCardNo'];
            $CRegNo=$row['CRegNo'];
            $EmployeeId=$row['EmployeeId'];
            $ServiceId=$row['ServiceId'];
            $AppointmentId=$row['AppointmentId'];
            $Charge=$row['Charge'];
            echo $CustomerId=$row['CustomerId'];
            
            echo $_SESSION['CustomerId']=$CustomerId;
         
//            echo $name;
            $invoice=array($jobCardNo=>array("JobCardNo"=>$jobCardNo,"CRegNo"=>$CRegNo,"EmployeeId"=>$EmployeeId,"ServiceId"=>$ServiceId,"AppointmentId"=>$AppointmentId,"Charge"=>$Charge,"CustomerId"=>$CustomerId));

            if(!isset($_SESSION['create_invoice'])){
               $_SESSION['create_invoice']=$invoice;
            } else {
                //array eke keys variable ekata.index array ekak out karanawa indexed array ekak widiyata
                $array_keys = array_keys($_SESSION["create_invoice"]);
                if(in_array($jobCardNo, $array_keys)){
                  echo "Service is already exsist..!";
              } else {
                  //array merge...increment wage..i++
                  $_SESSION['create_invoice']+=$invoice;
                  echo 'Service added to invoice';
                   
              }


            }
            print_r($_SESSION['create_invoice']);

   
        }
            
            ?>
            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_services_job_card LEFT JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId LEFT JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId LEFT JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId LEFT JOIN tbl_status ON tbl_services_job_card.StatusId=tbl_status.StatusId WHERE tbl_services_job_card.StatusId='3' AND tbl_services_job_card.AppointmentTypeId='1'";
//            $sql = "SELECT tbl_services_job_card.* ,  tbl_employees.* , tbl_customers.* , tbl_personal_care_services.* , tbl_appointments_type.* , tbl_personal_care_services_type.* , tbl_personal_care_services_category.* , tbl_personal_care_services_duration.* , tbl_employees.FirstName AS EFName , tbl_employees.LastName AS ELName , tbl_customers.FirstName AS CFName , tbl_customers.LastName AS CLName FROM tbl_services_job_card  INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId INNER JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId INNER JOIN tbl_appointments_type ON tbl_services_job_card.AppointmentTypeId=tbl_appointments_type.AppointmentTypeId INNER JOIN tbl_personal_care_services_type ON tbl_services_job_card.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId INNER JOIN tbl_personal_care_services_category ON tbl_services_job_card.ServiceCategoryId=tbl_personal_care_services_category.ServiceCategoryId INNER JOIN tbl_personal_care_services_duration ON tbl_services_job_card.ServiceDurationId=tbl_personal_care_services_duration.ServiceDurationId";
//            echo $sql = "SELECT * FROM tbl_services_job_card , tbl_employees.FirstName AS EFName , tbl_employees.LastName AS ELName  LEFT JOIN tbl_appointments ON tbl_services_job_card.AppointmentId=tbl_appointments.AppointmentId LEFT JOIN tbl_personal_care_services ON tbl_services_job_card.ServiceId=tbl_personal_care_services.ServiceId LEFT JOIN tbl_employees ON tbl_services_job_card.EmployeeId=tbl_employees.EmployeeId LEFT JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId";

            $result = $db->query($sql);
//            $JobCardNo1;
            ?>
            <table class="table table-striped" id="tbl_manager">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Job Card No</th>
                        <th>Appointment Id</th>
                        <th>Appointment Date</th>
                        <th>Service Name</th>
                        <th>EmployeeId</th>
                        <th>Customer RegNo:</th>
                        <th>Charge</th>
                        <th>Status</th>
                        <th>Add Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
//                            $jobCardNo1 =  $row['JobCardNo'];
                            ?>

                            <tr>
                                <td><?php echo $row['JobCardNo']; ?></td>
                                <td><?php echo $row['AppointmentId']; ?></td>
                                <td><?php echo $row['AppointmentDate']; ?></td>
                                <td><?php echo $row['ServiceName']; ?></td>
                                <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['RegNo']; ?></td>
                                <td>Rs. <?php echo $row['Charge']; ?></td>
                                <td><button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button></td>
                                <td>
                                    <?php
//                                    $job=$row['JobCardNo']; 
                                    ?>
                                    <?php
                                        echo $job=$row['JobCardNo'];
                                        ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        
                                        <input type="text" name="JobCardNo" value="<?php echo $job ?>">
                                        <button type="submit" name="action" value="add_item" class="btn btn-primary" >Add Invoice</button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-danger" href="serviceInvoice.php" role="button">Create Invoice (
                <?php
                            if(!empty($_SESSION['create_invoice'])){
                                echo count(array_keys($_SESSION['create_invoice']));
                            }
                            ?> )</a>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {

        $('#tbl_manager').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

