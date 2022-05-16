<?php
include '../header.php';
include '../nav.php';
?>
<script src="../plugins/jquery/jquery.min.js" type="text/javascript"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <?php
    extract($_POST);
    echo $JobCardNo;
    echo $BridalPackageId;
    $db = dbConn();
    echo $sql = "SELECT * FROM tbl_services_job_card INNER JOIN tbl_customers ON tbl_services_job_card.CustomerId=tbl_customers.CustomerId INNER JOIN tbl_bridal_packages ON tbl_services_job_card.BridalPackageId=tbl_bridal_packages.BridalPackageId WHERE JobCardNo='$JobCardNo'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Note:</h5>
                                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                            </div>


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
                                        <address>
                                            <strong><?php echo $row['CRegNo'] ?></strong><br>
                                            <?php echo $row['FirstName'] ?> <?php echo $row['LastName'] ?><br>
                                            <?php echo $row['AddressLine1'] ?> <?php echo $row['AddressLine2'] ?> <?php echo $row['AddressLine3'] ?> <?php echo $row['AddressLine4'] ?><br>
                                            <?php echo $row['PhoneNumber1'] ?>/ <?php echo $row['PhoneNumber2'] ?><br>
                                            <?php echo $row['Email'] ?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <!--                            <div class="col-sm-4 invoice-col">
                                                                    <b>Invoice #007612</b><br>
                                                                    <br>
                                                                    <b>Order ID:</b> 4F3S8J<br>
                                                                    <b>Payment Due:</b> 2/22/2014<br>
                                                                    <b>Account:</b> 968-34567
                                                                </div>-->
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Job Card No</th>
                                                    <th>Appointment Id</th>
                                                    <th>Package Name</th>
                                                    <th>Free Item</th>
                                                    <th>Package Price</th>
                                                    <th>Discount Rate</th>
                                                    <th>Discount Amount</th>
                                                    <th>Package Net Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row['JobCardNo'] ?></td>
                                                    <td><?php echo $row['AppointmentId'] ?></td>
                                                    <td><?php echo $row['PackageName'] ?></td>
                                                    <td><?php echo $row['FreeItem'] ?></td>
                                                    <td><?php echo $row['PackagePrice'] ?></td>
                                                    <td><?php echo $row['DiscountRate'] ?></td>
                                                    <?php
                                                    $amount = $row['PackagePrice'] - ($row['PackagePrice'] * $row['DiscountRate'] / 100);
                                                    ?>
                                                    <td><?php echo $row['PackagePrice'] * $row['DiscountRate'] / 100 ?></td>
                                                    <td><?php echo $amount ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col mt-3">
                                        <h6 class="text-success">Add your packages additional services</h6>
                                        <form>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Services</th>
                                                        <th scope="col">Price</th>
                                                        <th></th>
                                                        <th scope="col">Qty</th>
                                                        <th></th>
                                                        <th scope="col">Net Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyAdditionalServices">
                                                    <?php
                                                    $db = dbConn();
                                                    $sql = "SELECT * FROM tbl_schedule_additional_service INNER JOIN tbl_bridal_schedules ON tbl_schedule_additional_service.BridalScheduleId=tbl_bridal_schedules.BridalScheduleId INNER JOIN tbl_additional_services ON  tbl_schedule_additional_service.AdditionalId=tbl_additional_services.AdditionalId WHERE tbl_bridal_schedules.JobCardNo='$JobCardNo'";
                                                    $result = $db->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['AdditionalServiceName'] ?></td>
                                                                <td><input type="text" class="servicePrice"></td>
                                                                <td>X</td>
                                                                <td><input type="text" class="serviceQty"></td>
                                                                <td>=</td>
                                                                <td><input type="text" class="serviceNetPrice"></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col">
                                        <p class="lead">Amount Due 2/22/2014</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td id="lblSubTotal">$250.30</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax (9.3%)</th>
                                                    <td>$10.34</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping:</th>
                                                    <td>$5.80</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>$265.24</td>
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
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <?php
        }
    }
    ?>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

//tblAdditionalServices,servicePrice,serviceQty,serviceNetPrice
//element eka sent karanna release karala change karala gannawa
//tbody eke tr eke td wai alla ganna oona.parent ganna oona ekata
//int nisa parse float gattata kamak ne.price
//first element eka ganna oona parameter nisa
//Not a number ekak nan 0 gaththa
$(".servicePrice, .serviceQty").on("keyup change", (e) => {
    const parent = $(e.target).parent().parent();
    
    let servicePrice = parseFloat(parent.find(".servicePrice").first().val());
    if (isNaN(servicePrice)) servicePrice = 0;
    
    let serviceQty =  parseFloat(parent.find(".serviceQty").first().val());
    if (isNaN(serviceQty)) serviceQty = 0;

    //one by one pass karanna oona total cal wenna
    parent.find(".serviceNetPrice").first().val(servicePrice * serviceQty);
    
    updateSubTotal();
})
   
   
  function updateSubTotal() {
      let total = 0;
      //tbody eken catch karaganna oona
      $("#tbodyAdditionalServices tr").each((i, el) => {
          let netPrice = parseFloat($(el).find(".serviceNetPrice").first().val());
          if (isNaN(netPrice)) netPrice = 0;
          
          total += netPrice;
      });
      
      $("#lblSubTotal").text(`Rs. ${total.toFixed(2)}`);
  }


</script>

<?php
include '../footer.php';
?>
  