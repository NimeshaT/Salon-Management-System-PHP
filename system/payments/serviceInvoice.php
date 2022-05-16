<?php
include '../header.php';
include '../nav.php';
?>

<!--stdClass Object
(
    [subTotal] => 5000
    [discountPerc] => 3%
    [discountAmount] => 150
    [total] => 4850
    [cash] => 0
    [balance] => 0
    [customerServices] => Array
        (
            [0] => stdClass Object
                (
                    [jobCardNo] => J2022041981
                    [appointmentId] => 28
                    [serviceId] => 4
                    [netPrice] => 1500
                )

            [1] => stdClass Object
                (
                    [jobCardNo] => J2022050191
                    [appointmentId] => 40
                    [serviceId] => 24
                    [netPrice] => 3500
                )

        )

)
-->


<?php
   if (isset($_POST["paymentSubmit"])) {
        $data = json_decode($_POST["data"], true);

       $customerId = $_SESSION["CustomerId"];
       $subTotal = $data["subTotal"];
       $discountPerc = $data["discountPerc"];
       $discountAmount = $data["discountAmount"];
       $total = $data["total"];
       $cash = $data["cash"];
       $balance = $data["balance"];
       
       $db= dbConn();
       
       $sql = "INSERT INTO tbl_invoice(CustomerId, TotalPrice, DiscountAmount, Cash, Balance) VALUES('$customerId', '$total', '$discountAmount', '$cash', '$balance')";
       $db->query($sql);
       
       $invoiceId = $db->insert_id;
       
       foreach ($data["customerServices"] as $i) {
           $jobCardNo = $i["jobCardNo"];
           $serviceId = $i["serviceId"];
           $netPrice = $i["netPrice"];
           
           $sql="SELECT * FROM tbl_services_job_card WHERE JobCardNo = '$jobCardNo'";
           $result=$db->query($sql);
           
           $data = $result->fetch_assoc();
           $servicesJobCardId = $data["ServicesJobCardId"]; 
           
           
           $sql = "INSERT INTO tbl_services_job_card_invoice(InvoiceId, ServicesJobCardId, JobCardNo, ServiceId, Charge) VALUES('$invoiceId','$servicesJobCardId','$jobCardNo','$serviceId','$netPrice')";
            $db->query($sql);
        }
       
   }
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
                </div>
            </div>
        </div>
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
                        ?>

                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        Salon Kanchana
                                        <small class="float-right">Date: <?php echo date('y-m-d') ?></small>
                                    </h4>
                                </div>
                            </div>
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
                                <div class="col-sm-4 invoice-col">
                                    <!--                                    <b>Invoice #007612</b><br>
                                                                        <br>
                                                                        <b>Order ID:</b> 4F3S8J<br>
                                                                        <b>Payment Due:</b> 2/22/2014<br>
                                                                        <b>Account:</b> 968-34567-->
                                </div>
                            </div>
                            <?php
                            IF ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'Save') {
                                $db = dbConn();
                                $sql = "";
                            }
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped" id="jobCardTable">
                                                <thead>
                                                    <tr>
                                                        <th>JobCardNo</th>
                                                        <th>AppointmentId</th>
                                                        <th>Service Name</th>
                                                        <th>Net Price (Lkr)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($_SESSION['create_invoice'] as $service) {
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
                                                            <td style="display:none"><?php echo $s; ?></td>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-6">

                                        </div>
                                        <div class="col-6">
                                            <p class="lead">     Amount due date: <?php echo date('y-m-d'); ?></p>
                                            <div class="table-responsive">
                                                <?php
                                                $total_amount = 0;
                                                foreach ($_SESSION['create_invoice'] as $service) {
                                                    ?>
                                                    <h5><?php $total_amount += $service['Charge'] ?></h5>
                                                    <?php
                                                }
                                                ?>
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Sub Total (Lkr) </th>
                                                        <td id="lblSubTotal"><?php echo $total_amount ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <?php
                                                        if ($total_amount >= 5000) {
                                                            ?>
                                                            <td id="lblDiscountPerc"><?php echo '3%'; ?></td>
                                                            <?php
                                                        } elseif ($total_amount >= 10000) {
                                                            ?>
                                                            <td id="lblDiscountPerc"><?php echo '7%'; ?></td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td id ="lblDiscountPerc"><?php echo '8%'; ?></td>
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
                                                            <td id="lblDiscountAmount"><?php echo $discountAmount; ?></td>
                                                            <?php
//                                                        $rate='3%';
                                                        } elseif ($total_amount >= 10000) {
                                                            $discountAmount = $total_amount * 7 / 100;
                                                            ?>
                                                            <td id="lblDiscountAmount"><?php echo $discountAmount; ?></td>
                                                            <?php
                                                        } else {
                                                            $discountAmount = $total_amount * 8 / 100;
                                                            ?>
                                                            <td id="lblDiscountAmount"><?php echo $discountAmount; ?></td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <?php
                                                        $total = $total_amount - $discountAmount
                                                        ?>
                                                        <td id="lblTotal"><?php echo $total ?></td>
                                                    </tr>
                                                    <?php
                                                    extract($_POST);
                                                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'Enter') {
                                                        echo 'hi';
                                                        echo $balance = $cash - $total;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th>Cash (Lkr)</th>
                                                        <td>
                                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                                <input type="text"  name="cash" id="cash" value="<?php echo isset($cash)? $cash : '0' ?>"><br><br>
                                                                <button type="submit" class="btn btn-warning" id="action" name="action" value="Enter">Enter</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Balance (Lkr)</th>
                                                        <td>
                                                            <form >
                                                                <input type="text"  id="balance" name="balance" value="<?php echo isset($balance)? $balance : '0' ?>"readonly>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                        <button  id="btnSubmitPayment" type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                            Payment
                                        </button>
                                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Generate PDF
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $("form").on("submit", e => {
        e.preventDefault();
    })
 

$("#btnSubmitPayment").on("click", submitPayment);

$("#cash").on("keyup change", (e) => {
    const total = parseFloat($("#lblTotal").text());
    let amount = parseFloat(e.target.value);
    if (isNaN(amount)) amount = 0;
    if (amount > total) amount = total;
    $("#balance").val(total - amount)
})


function submitPayment() {
    const subTotal = $("#lblSubTotal").text();
    const discountPerc = $("#lblDiscountPerc").text();
    const discountAmount = $("#lblDiscountAmount").text()
    const total = $("#lblTotal").text();
    const cash = $("#cash").val();
    const balance = $("#balance").val();
    
    const customerServices = [];
        
    $("#jobCardTable tbody tr").each((i, el) => {
        const children = $(el).children("td");
        const jobCardNo = $(children[0]).text();
        const appointmentId = parseInt($(children[1]).text());
        const serviceId = parseInt($(children[2]).text());
        const netPrice = parseFloat( $(children[4]).text());
        customerServices.push({jobCardNo,appointmentId, serviceId, netPrice})
    });
    
    const data = {
        subTotal,discountPerc,discountAmount,total,cash,balance,customerServices
    }
    
    $.post("/sms/system/payments/serviceInvoice.php", {data: JSON.stringify(data), paymentSubmit: true}, () => {
        
        
            // edit div here
        
        
        
        
    })
}

</script>


