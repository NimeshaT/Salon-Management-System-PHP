<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Customer</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
<!--            ========================Search=========================-->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <input type="text" name="nic" placeholder="Enter Nic Number">
                <input type="text" name="cus_Reg" placeholder="Enter Customer RegNo">
                <input type="date" name="from" placeholder="Enter from date">
                 <input type="date" name="to" placeholder="Enter to date">
                <button type="submit" class="bg-success">Search</button>
            </form>
            <?php
            extract($_POST);
            $where = null;
             $where=null;
            //dynamically generate the query
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //check service id
            if(!empty($nic)){
                $where.="NicNumber='$nic' AND";
            }
            //check customer reg no
            if(!empty($cus_Reg)){
                $where.=" RegNo='$cus_Reg' AND";
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
            $db = dbConn();
 
            echo $sql = "SELECT * FROM tbl_customers LEFT JOIN tbl_districts ON tbl_customers.DistrictId=tbl_districts.DistrictId $where";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped" id="tbl_customer">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Profile Image</th>
                        <th>Customer Id</th>
                        <th>Reg No:</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>District</th>
                        <th>NicNumber</th>
                        <th>Email</th>
                        <th>ContactNo</th>
                        <th>Register Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><img class="img-fluid" width="100" src="../../uploads2/<?php echo $row['ProfileImage']; ?>"></td>
                                <td><?php echo $row['CustomerId']; ?></td>
                                <td><?php echo $row['RegNo']; ?></td>
                                <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['UserName']; ?></td>
                                <td><?php echo $row['AddressLine1']; ?>,<?php echo $row['AddressLine2']; ?>,<?php echo $row['AddressLine3']; ?>,<?php echo $row['AddressLine4']; ?></td>
                                <td><?php echo $row['City']; ?></td>
                                <td><?php echo $row['DistrictName']; ?></td>
                                <td><?php echo $row['NicNumber']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['PhoneNumber1']; ?>,<?php echo $row['PhoneNumber2']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
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

<script>
    $(function () {
//        $("#example1").DataTable({
//            "responsive": true, "lengthChange": false, "autoWidth": false,
//            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#tbl_customer').DataTable({
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
</script>
