<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Item</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Item</a></li>
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
                            $ItemName = dataClean($ItemName);
                            $Description = dataClean($Description);


                            // Start validation
                            $message = array();
                            if (empty($ItemName)) {
                                $message['ItemName'] = "Item Name should not be empty..!";
                            }
                            if (empty($ItemTitleId)) {
                                $message['ItemTitleId'] = "Item Title should not be empty..!";
                            }
                            if (empty($ItemTypeId)) {
                                $message['ItemTypeId'] = "Item Type should not be empty..!";
                            }

                            if (empty($Description)) {
                                $message['Description'] = "Description should not be empty..!";
                            }
                            
                            if (empty($message)) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["ItemImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["ItemImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['ItemImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['ItemImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["ItemImage"]["size"] > 5000000) {
                                    $message['ItemImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['ItemImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["ItemImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["ItemImage"]["name"]));
                                    } else {
                                        $message['ItemImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }



                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_items("
                                        . "ItemName,"
                                        . "ItemTitleId,"
                                        . "ItemTypeId,"
                                        . "ItemCategoryId,"
                                        . "ItemBrandId,"
                                        . "Description,ItemImage)VALUES("
                                        . "'$ItemName',"
                                        . "'$ItemTitleId',"
                                        . "'$ItemTypeId',"
                                        . "'$ItemCategoryId',"
                                        . "'$ItemBrandId',"
                                        . "'$Description','$Photo')";
                                $db->query($sql);
                            }
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        //Start Update Records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            if (empty($message) AND!empty($_FILES["ItemImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["ItemImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["ItemImage"]["tmp_name"]);
                                if ($check !== false) {
//Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['ItemImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['ItemImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["ItemImage"]["size"] > 5000000) {
                                    $message['ItemImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['ItemImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["ItemImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["ItemImage"]["name"]));
                                    } else {
                                        $message['ItemImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousItemImage;
                            }
                            
                            $db = dbConn();
                            echo $sql = "UPDATE tbl_items SET "
                                    . "ItemName='$ItemName',"
                                    . "ItemTitleId='$ItemTitleId',"
                                    . "ItemTypeId='$ItemTypeId',"
                                    . "ItemCategoryId='$ItemCategoryId',"
                                    . "ItemBrandId='$ItemBrandId',"
                                    . "Description='$Description',"
                                    . "ItemImage='$Photo'"
                                    . "WHERE ItemId='$ItemId'";
                            $db->query($sql);

                            $submit = "update";
                        }
                        
                        //start edit records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            echo $sql = "SELECT * FROM tbl_items WHERE ItemId='$ItemId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $ItemName = $row['ItemName'];
                            $ItemTitleId = $row['ItemTitleId'];
                            $ItemTypeId = $row['ItemTypeId'];
                            $ItemCategoryId = $row['ItemCategoryId'];
                            $ItemBrandId = $row['ItemBrandId'];
                            $Description = $row['Description'];
                            $ItemImage = $row['ItemImage'];
                            $ItemId = $row['ItemId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Item Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" >
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="ItemName">Item Name</label>
                                    <input type="text" class="form-control" id="ItemName" name="ItemName" placeholder="Enter Item Name" value="<?php echo @$ItemName; ?>">
                                    <div class="text-danger"><?php echo @$message['ItemName']; ?></div>
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
                                            <select class="form-control" name="ItemTitleId" id="ItemTitleId" onchange="loadItemType(this.value);changeVisibility(this.value);">
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
                                                    <select class="form-control" name="ItemTypeId" id="ItemTypeId" onchange="loadItemCategory(this.value);loadItemBrand(this.value);">
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

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="ItemCategoryId" id="LblItemCategoryId">Select Item Category</label>
                                            <div id="category_list">
                                                <?php
                                                if (@$action == "update_account") {
                                                    $db = dbConn();
                                                    $sql = "SELECT * FROM tbl_items_category WHERE ItemTypeId='$ItemTypeId'";
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <select class="form-control" name="ItemCategoryId" id="ItemCategoryId">
                                                        <option value="">--</option>
                                                        <?php
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?php echo $row['ItemCategoryId']; ?>" <?php if ($row['ItemCategoryId'] == $ItemCategoryId) { ?>selected <?php } ?>><?php echo $row['ItemCategoryName']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <select class="form-control" name="ItemCategoryId" id="ItemCategoryId">
                                                        <option value="">--</option>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="ItemBrandId" id="LblItemBrandId">Select Item Brand</label>
                                            <div id="brand_list">
                                                <?php
                                                if (@$action == "update_account") {
                                                    $db = dbConn();
                                                    $sql = "SELECT * FROM tbl_items_brand WHERE ItemTypeId='$ItemTypeId'";
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <select class="form-control" name="ItemBrandId" id="ItemBrandId">
                                                        <option value="">--</option>
                                                        <?php
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?php echo $row['ItemBrandId']; ?>" <?php if ($row['ItemBrandId'] == $ItemBrandId) { ?>selected <?php } ?>><?php echo $row['ItemBrand']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <select class="form-control" name="ItemBrandId" id="ItemBrandId">
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
                                    <label for="Description">Description</label>
                                    <textarea class="form-control" id="Description" name="Description" placeholder="Enter Description"><?php echo @$Description; ?></textarea>
                                    <div class="text-danger"><?php echo @$message['Description']; ?></div>
                                </div>


                                <div class="mb-3">
                                    <label for="ItemImage" class="form-label">Item Image</label>
                                    <input class="form-control" type="file" id="ItemImage" name="ItemImage">
                                    <input type="hidden" name="PreviousItemImage" value="<?php echo @$ItemImage; ?>">
                                    <div class="text-danger"><?php echo @$message['ItemImage']; ?></div>

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="ItemId" value="<?php echo @$ItemId; ?>">
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
                            <h3 class="card-title">Item Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_items";
                            $result = $db->query($sql);
                            ?>

                            <table id="item_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Item Image</th>
                                        <th>Name</th>
<!--                                        <th>Designation</th>-->
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
                                                        <input type="hidden" name="ItemId" value="<?php echo $row['ItemId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['ItemImage']; ?>"></td>
                                                <td><?php echo $row['ItemName']; ?></td>
        <!--                                        <td></td>-->
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
        $('#item_list').DataTable({
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
            url: 'load_type.php',
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

    function loadItemCategory(ItemTypeId) {
        var c = "ItemTypeId=" + ItemTypeId + "&";
        $.ajax({
            type: 'POST',
            data: c,
            url: 'loadCategory.php',
            success: function (response) {
//                alert(response)
                $("#category_list").html(response)
            },
            error: function (request, status, error) {
                alert(error)
            }
        });
    }
</script>
<script>

    function loadItemBrand(ItemTypeId) {
        var c = "ItemTypeId=" + ItemTypeId + "&";
        $.ajax({
            type: 'POST',
            data: c,
            url: 'loadBrand.php',
            success: function (response) {
//                alert(response)
                $("#brand_list").html(response)
            },
            error: function (request, status, error) {
                alert(error)
            }
        });
    }

</script>
<script>
    $("#ItemCategoryId,#LblItemCategoryId,#ItemBrandId,#LblItemBrandId").hide();
    function changeVisibility(ItemTitleId) {
        if (ItemTitleId == 2) {
            $("#ItemCategoryId,#LblItemCategoryId,#ItemBrandId,#LblItemBrandId,#brand_list,#category_list").hide();
        }
        if (ItemTitleId == 1) {
            $("#ItemCategoryId,#LblItemCategoryId,#ItemBrandId,#LblItemBrandId").show();
        }
    }
</script>
<!--<script>
     $("#Size,#LblSize,#Gram,#LblGram").hide();
    function hiddenFields(ItemTypeId) {
       
        if (ItemTypeId == 2) {
            $("#Size,#LblSize").hide();
            $("#Gram,#LblGram").show();
        }
        if (ItemTypeId == 1) {
            $("#Size,#LblSize").show();
            $("#Gram,#LblGram").hide();
        }
    }
</script>-->
<!--<script>
function hiddenFields(ItemTitleId) {
    var c = "ItemTitleId=" + ItemTitleId + "&";
    $.ajax({
        type: 'POST',
        data: c,
        url: 'loadBrand.php',
        success: function (response) {
//                alert(response)
            $("#brand_list").html(response)
        },
        error: function (request, status, error) {
            alert(error)
        }
    });
}
</script>-->


