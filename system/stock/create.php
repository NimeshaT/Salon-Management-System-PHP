<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stock</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Stock</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-warning">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php
                        extract($_POST);

                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {
                            $Price = dataClean($Price);
                            $Qty = dataClean($Qty);


                            // Start validation
                            $message = array();
                            if (empty($StockDate)) {
                                $message['StockDate'] = "Stock Date should not be empty..!";
                            }
                            if (empty($ItemTitleId)) {
                                $message['ItemTitleId'] = "Item Title should not be empty..!";
                            }
                            if (empty($ItemTypeId)) {
                                $message['ItemTypeId'] = "Item Type should not be empty..!";
                            }
                            if (empty($ItemId)) {
                                $message['ItemId'] = "Item  should not be empty..!";
                            }

                            if (empty($Price)) {
                                $message['Price'] = "Price should not be empty..!";
                            }
                            if (empty($Qty)) {
                                $message['Qty'] = "Qty should not be empty..!";
                            }



                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_stock("
                                        . "StockDate,"
                                        . "ItemTitleId,"
                                        . "ItemTypeId,"
                                        . "ItemId,"
                                        . "ItemSizeId,"
                                        . "Gram,"
                                        . "ItemColorId,"
                                        . "Price,"
                                        . "Qty)VALUES("
                                        . "'$StockDate',"
                                        . "'$ItemTitleId',"
                                        . "'$ItemTypeId',"
                                        . "'$ItemId',"
                                        . "'$ItemSizeId',"
                                        . "'$Gram',"
                                        . "'$ItemColorId',"
                                        . "'$Price',"
                                        . "'$Qty')";
                                $db->query($sql);
                            }
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }




                        //start edit records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_stock WHERE StockId='$StockId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $StockDate = $row['StockDate'];
                            $ItemTitleId = $row['ItemTitleId'];
                            $ItemTypeId = $row['ItemTypeId'];
                            $ItemId = $row['ItemId'];
                            $ItemSizeId = $row['ItemSizeId'];
                            $Gram = $row['Gram'];
                            $ItemColorId = $row['ItemColorId'];
                            $Price = $row['Price'];
                            $Qty = $row['Qty'];
                            $StockId = $row['StockId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }

                        //Start Update Records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $db = dbConn();
                            $sql = "UPDATE tbl_stock SET "
                                    . "StockDate='$StockDate',"
                                    . "ItemTitleId='$ItemTitleId',"
                                    . "ItemTypeId='$ItemTypeId',"
                                    . "ItemId='$ItemId',"
                                    . "ItemSizeId='$ItemSizeId',"
                                    . "Gram='$Gram',"
                                    . "ItemColorId='$ItemColorId',"
                                    . "Price='$Price',"
                                    . "Qty='$Qty'"
                                    . "WHERE StockId='$StockId'";
                            $db->query($sql);

                            $submit = "update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Stock Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="StockDate">Stocked Date</label>
                                    <input type="Date" class="form-control" id="StockDate" name="StockDate" placeholder="Enter StockDate" value="<?php echo @$StockDate; ?>">
                                    <div class="text-danger"><?php echo @$message['StockDate']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <?php
                                            $db = dbConn();
                                            $sql = "SELECT * FROM tbl_items_title";
                                            $result = $db->query($sql);
                                            ?>
                                            <label for="ItemTitleId">Select Item Title</label>
                                            <select class="form-control" name="ItemTitleId" id="ItemTitleId" onchange="loadItemType(this.value);">
                                                <option value="">--</option>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['ItemTitleId']; ?>"<?php if (@$ItemTitleId == $row['ItemTitleId']) { ?>selected <?php } ?>><?php echo $row['ItemTitleName']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">

                                        <div class="form-group">
                                            <label for="ItemTypeId">Select Item Type</label>
                                            <div id="type_list">
                                                <?php
                                                if (@$action == "update_account") {
                                                    $db = dbConn();
                                                    $sql = "SELECT * FROM tbl_items_type WHERE ItemTitleId='$ItemTitleId'";
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <select class="form-control" name="ItemTypeId" id="ItemTypeId" onchange="loadItems(this.value);changeVisibility(this.value);">
                                                        <option value="">--</option>
                                                        <?php
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?php echo $row['ItemTypeId']; ?>" <?php if ($row['ItemTypeId'] == $ItemTypeId) { ?>selected <?php } ?>><?php echo $row['ItemTypeName']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <select class="form-control" name="ItemTypeId" id="ItemTypeId" onchange="loadItemCategory(this.value);loadItemBrand(this.value)">
                                                        <option value="">--</option>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ItemId" id="LblItemId">Select Item</label>
                                    <div id="items_list">
                                        <?php
                                        if (@$action == "update_account") {
                                            $db = dbConn();
                                            $sql = "SELECT * FROM tbl_items WHERE ItemTypeId='$ItemTypeId'";
                                            $result = $db->query($sql);
                                            ?>
                                            <select class="form-control" name="ItemId" id="ItemId">
                                                <option value="">--</option>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['ItemId']; ?>" <?php if ($row['ItemId'] == $ItemId) { ?>selected <?php } ?>><?php echo $row['ItemName']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php
                                        } else {
                                            ?>
                                            <select class="form-control" name="ItemId" id="ItemId">
                                                <option value="">--</option>
                                            </select>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_items_size";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="ItemSizeId" id="LblSize">Size</label>
                                    <select class="form-control" name="ItemSizeId" id="ItemSizeId">
                                        <option value="">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['ItemSizeId']; ?>" <?php if (@$ItemSizeId == $row['ItemSizeId']) { ?> selected <?php } ?>><?php echo $row['ItemSize']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Gram" id="LblGram">Gram(g)/Milliliter(ml) </label>
                                    <input type="text" class="form-control" id="Gram" name="Gram" placeholder="Enter Gram">
                                </div>

                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_items_color";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="ItemColorId">Select Color</label>
                                    <select class="form-control" name="ItemColorId" id="ItemColorId">
                                        <option value="">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['ItemColorId']; ?>" <?php if (@$ItemColorId == $row['ItemColorId']) { ?> selected <?php } ?>><?php echo $row['ItemColor']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Price">Price </label>
                                    <input type="text" class="form-control" id="Price" name="Price" placeholder="Enter Price" value="<?php echo @$Price; ?>">
                                    <div class="text-danger"><?php echo @$message['Price']; ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="Qty">Qty </label>
                                    <input type="tex" class="form-control" id="Qty" name="Qty" placeholder="Enter Qty" value="<?php echo @$Qty; ?>">
                                    <div class="text-danger"><?php echo @$message['Qty']; ?></div>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="StockId" value="<?php echo @$StockId; ?>">
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
                            <h3 class="card-title">Stock Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_stock";
                            $result = $db->query($sql);
                            ?>

                            <table id="stock_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Stocked Date</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
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
                                                        <input type="hidden" name="StockId" value="<?php echo $row['StockId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['StockDate']; ?></td>
                                                <td><?php echo $row['ItemId']; ?></td>
                                                <td><?php echo $row['Price']; ?></td>
                                                <td><?php echo $row['Qty']; ?></td>

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
        $('#stock_list').DataTable({
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
<script>
    function loadItemType(ItemTitleId) {
//        alert(ItemTitleId)
        var d = "ItemTitleId=" + ItemTitleId + "&";
        $.ajax({
            type: 'POST',
            data: d,
            url: 'loadType.php',
            success: function (response) {
//                alert(response)
                $("#type_list").html(response)
            },
            error: function (request, status, error) {
                alert(error)
            }
        });
    }

</script>

<script>

    function loadItems(ItemTypeId) {
        var c = "ItemTypeId=" + ItemTypeId + "&";
        $.ajax({
            type: 'POST',
            data: c,
            url: 'loadItems.php',
            success: function (response) {
//                alert(response)
                $("#items_list").html(response)
            },
            error: function (request, status, error) {
                alert(error)
            }
        });
    }
</script>


<script>
    $("#ItemSizeId,#LblSize,#Gram,#LblGram").hide();
    function changeVisibility(ItemTypeId) {

        if (ItemTypeId == 2) {
            $("#ItemSizeId,#LblSize").hide();
            $("#Gram,#LblGram").show();
        } else {
            $("#ItemSizeId,#LblSize").show();
            $("#Gram,#LblGram").hide();
        }

    }
</script>



