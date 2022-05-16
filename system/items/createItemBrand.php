<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Items Brand</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Items Brand</a></li>
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
                            $ItemBrand = dataClean($ItemBrand);
                            

                            // Start validation
                            $message = array();
                            if (empty($ItemBrand)) {
                                $message['ItemBrand'] = "Item Brand should not be empty..!";
                            }
                            if (empty($ItemTypeId)) {
                                $message['ItemTypeId'] = "ItemTypeId should not be empty..!";
                            }
                   
                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_items_brand("
                                        . "ItemTypeId,"
                                        . "ItemBrand)VALUES("
                                        . "'$ItemTypeId',"
                                        . "'$ItemBrand')";
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
                            $sql = "SELECT * FROM tbl_items_brand WHERE ItemBrandId='$ItemBrandId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();
                               
                            $ItemTypeId = $row['ItemTypeId'];
                            $ItemBrand = $row['ItemBrand'];
                            $ItemBrandId = $row['ItemBrandId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }

                        //Start Update Records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $db = dbConn();
                            $sql = "UPDATE tbl_items_brand SET "
                                    . "ItemTypeId='$ItemTypeId',"
                                    . "ItemBrand='$ItemBrand'"
                                    . "WHERE ItemBrandId='$ItemBrandId'";
                            $db->query($sql);

                            $submit = "update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Item Brand Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                        $db= dbConn();
                                        $sql="SELECT * FROM tbl_items_type";
                                        $result=$db->query($sql);
                                        ?>
                                    <label for="ItemTypeId">Select Type</label>
                                    <select class="form-control" name="ItemTypeId" id="ItemTypeId">
                                    <option selected>--</option>
                                    <?php
                                            if($result->num_rows > 0){
                                                while ($row=$result->fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $row['ItemTypeId']; ?>" <?php if (@$ItemTypeId == $row['ItemTypeId']) { ?> selected <?php } ?>><?php echo $row['ItemTypeName']; ?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemBrand">Item Brand</label>
                                    <input type="text" class="form-control" id="ItemBrand" name="ItemBrand" placeholder="Enter ItemBrand" value="<?php echo @$ItemBrand; ?>">
                                    <div class="text-danger"><?php echo @$message['ItemBrand']; ?></div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="ItemBrandId" value="<?php echo @$ItemBrandId; ?>">
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
                            <h3 class="card-title">Item Brand Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_items_brand";
                            $result = $db->query($sql);
                            ?>

                            <table id="item_brand_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Item Brand Id</th>
                                        <th>Item Brand</th>
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
                                                        <input type="hidden" name="ItemBrandId" value="<?php echo $row['ItemBrandId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['ItemBrandId']; ?></td>
                                                <td><?php echo $row['ItemBrand']; ?></td>
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
        $('#item_brand_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
//    $(function () {
//        $('#birthdate').datetimepicker({
//        format: 'L',
//        orientation: 'top',
//        
//    });
//    });
</script>


