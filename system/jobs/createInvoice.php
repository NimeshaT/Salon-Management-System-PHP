<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active">Create Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                    <?php
                    extract($_POST);
                    ?>
                    <?php
                    if (!empty($_SESSION['create_invoice'])) {
//                        $service2 = $_SESSION['create_invoice'];
//                        foreach ($service2 as $x => $x_value) {
//                            echo "Key=" . $x . ", Value=" . $x_value;
//                            echo "<br>";
//                        }
//                        echo (array_keys($_SESSION['create_invoice']));
//                        $c="";
                        ?>

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        Salon Kanchana
                                        <small class="float-right">Date: <?php echo date('y-m-d') ?></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>G M N Kanchana</strong><br>
                                        No: 35<br>
                                        Horana Road<br>
                                        Bandaragama<br>
                                        Phone: (+94) 770347984<br>
                                        Email: kanchanafernando37@gmail.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <?php
                                    $CustomerId = $_SESSION['CustomerId'];
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_customers WHERE CustomerId='$CustomerId'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <address>
                                                <strong><?php echo $row['RegNo'] ?></strong><br>
                                                <?php echo $row['FirstName'] ?> <?php echo $row['LastName'] ?><br>
                                                <?php echo $row['AddressLine1'] ?> <?php echo $row['AddressLine2'] ?> <?php echo $row['AddressLine3'] ?> <?php echo $row['AddressLine4'] ?><br>
                                                <?php echo $row['PhoneNumber1'] ?>/ <?php echo $row['PhoneNumber2'] ?><br>
                                                <?php echo $row['Email'] ?>
                                            </address>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <!--                                    <b>Invoice #007612</b><br>
                                                                        <br>
                                                                        <b>Order ID:</b> 4F3S8J<br>
                                                                        <b>Payment Due:</b> 2/22/2014<br>
                                                                        <b>Account:</b> 968-34567-->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>JobCardNo</th>
                                                <th>AppointmentId</th>
                                                <th>Service Id</th>
                                                <th>Net Price (Lkr)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($_SESSION['create_invoice'] as $service) {
//                                                 $c=$service['CRegNo'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $service['JobCardNo'] ?></td>
                                                    <td><?php echo $service['AppointmentId'] ?></td>

                                                    <?php
                                                    $s = $service['ServiceId'];
                                                    $db = dbConn();
                                                    $sql = "SELECT * FROM tbl_personal_care_services WHERE ServiceId='$s'";
                                                    $result = $db->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>

                                                            <td><?php echo $row['ServiceName'] ?></td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td><?php echo $service['Charge'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">

                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">     Amount due date: <?php echo date('y-m-d'); ?></p>

                                    <div class="table-responsive">
                                        <?php
                                        $total_amount = 0;
                                        foreach ($_SESSION['create_invoice'] as $service) {
//                                                 $c=$service['CRegNo'];
                                            ?>
                                            <h5><?php $total_amount += $service['Charge'] ?></h5>
                                            <?php
                                        }
//                                        $total_amount+=$service['Charge'];
                                        ?>
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Sub Total (Lkr) </th>
                                                <td><?php echo $total_amount ?></td>
                                            </tr>
                                            <tr>
                                                <th>Discount</th>
                                                <?php
                                                if ($total_amount >= 5000) {
                                                    ?>
                                                    <td><?php echo '3%'; ?></td>
                                                    <?php
//                                                        $rate='3%';
                                                } elseif ($total_amount >= 10000) {
                                                    ?>
                                                    <td><?php echo '7%'; ?></td>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td><?php echo '8%'; ?></td>
                                                    <?php
                                                }
                                                ?>

                                            </tr>
                                            <tr>
                                                <th>Discount Amount</th>
                                                <?php
                                                if ($total_amount >= 5000) {
                                                    $discountAmount = $total_amount * 3 / 100;
                                                    ?>
                                                    <td><?php echo $discountAmount; ?></td>
                                                    <?php
//                                                        $rate='3%';
                                                } elseif ($total_amount >= 10000) {
                                                    $discountAmount = $total_amount * 7 / 100;
                                                    ?>
                                                    <td><?php echo $discountAmount; ?></td>
                                                    <?php
                                                } else {
                                                    $discountAmount = $total_amount * 8 / 100;
                                                    ?>
                                                    <td><?php echo $discountAmount; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <?php
                                                $total=$total_amount - $discountAmount
                                                ?>
                                                <td><?php echo $total ?></td>
                                            </tr>
                                            <?php
                                            extract($_POST);
                                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'Enter') {
                                                echo 'hi';
//                                                global $balance;
                                                echo $balance = $cash - $total;
                                            }
//                                            $opt='Enter';
//                                            $opt = @$_POST['action'];
//                                            $n1 = (int) @$_POST['cash'];
//                                            $n2 = (int) @$_POST['num2'];
//                                            $ans = 0;
                                           
                                            ?>
                                            <tr>
                                                <th>Cash (Lkr)</th>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <input type="text"  name="cash" id="cash" value="<?php echo @$cash?>"><br><br>
                                                        <button type="submit" class="btn btn-warning" id="action" name="action" value="Enter">Enter</button>
                                                    </form>
                                                </td>


                                            </tr>
                                            <tr>
                                                <th>Balance (Lkr)</th>
                                                <td>
                                                    <form >
                                                        <input type="text"  id="balance" name="balance" value="<?php echo $balance ?>"readonly>
                                                    </form>
                                                </td>


                                            </tr>
                                        </table>

                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>

<?php
include '../footer.php';
?>

<!--<script>
    $(function () {
//        $("#example1").DataTable({
//            "responsive": true, "lengthChange": false, "autoWidth": false,
//            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
</script>-->
</script>
