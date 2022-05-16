<?php
include '../header.php';
include '../nav.php';
//include 'system/function.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <input type="text" name="s_Id" placeholder="Enter Service Id">
                <input type="text" name="cus_Reg" placeholder="Enter Customer RegNo">
                <input type="date" name="from" placeholder="Enter from date">
                 <input type="date" name="to" placeholder="Enter to date">
                <button type="submit" class="bg-success">Search</button>
            </form>
            <?php
            extract($_POST);
            $db= dbConn();
            $where=null;
            //dynamically generate the query
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //check service id
            if(!empty($s_Id)){
                $where.="ServiceId='$s_Id' AND";
            }
            //check customer reg no
            if(!empty($cus_Reg)){
                $where.=" CRegNo='$cus_Reg' AND";
            }
            //check from to dates
            if(!empty($from)&& !empty($to)){
                $where.=" AppointmentDate BETWEEN  '$from' AND '$to' AND";
            }
            //generate dynamic query remove AND last characters from the string
            if(!empty($where)){
                $where= substr($where, 0,-3);
                $where=" WHERE $where";
            }
            
//            echo $where;
            }
            
            echo $sql="SELECT * FROM tbl_services_job_card $where";
            $result=$db->query($sql);
            ?>
            <table border='1' width='100%' class="mt-3">
                <thead>
                    <tr>
                        <th>AppointmentId</th>
                        <th>Service Id</th>
                        <th>Customer Reg No</th>
                        <th>AppointmentDate</th>
                        <th>StartTime</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result->num_rows>0){
                                while ($row=$result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['AppointmentId']?></td>
                        <td><?php echo $row['ServiceId']?></td>
                        <td><?php echo $row['CRegNo']?></td>
                        <td><?php echo $row['AppointmentDate']?></td>
                        <td><?php echo $row['StartTime']?></td>
                        <td><?php echo $row['EndTime']?></td>
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

<?php
include '../footer.php';
?>

