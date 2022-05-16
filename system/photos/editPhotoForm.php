<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Photos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Photos</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
   
    global $JobCardNo;
//    echo  $JobCardNo;
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save" && isset($JCNo)) {
//         echo $JobCardNo;
//        echo $JCNo;
        
        $isError = false;
        
        
         $message = array();
                    if(!isset($_FILES["BeforePhoto"]) || empty($_FILES["BeforePhoto"]["name"])){
                        $message["BeforePhoto"]="Photo should not be empty...!";
                        $isError = true;
                    }   
        if (empty($message) && !empty($_FILES["BeforePhoto"]["name"]) && !$isError) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["BeforePhoto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["BeforePhoto"]["tmp_name"]);
            if ($check !== false) {
                //Multi-purpose Internet Mail Extensions                       
                $uploadOk = 1;
            } else {
                $message['BeforePhoto'] = "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $message['BeforePhoto'] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["BeforePhoto"]["size"] > 5000000) {
                $message['BeforePhoto'] = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $message['BeforePhoto'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["BeforePhoto"]["tmp_name"], $target_file)) {
                    $Photo = htmlspecialchars(basename($_FILES["BeforePhoto"]["name"]));
                } else {
                    $message['BeforePhoto'] = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $Photo = $PreviousBeforePhoto;
        }


//                  if  ================Start Update Records==================
        if (empty($message)) {
            $db = dbConn();
            echo $sql = "UPDATE tbl_services_job_card SET "
                    . "BeforePhoto='$Photo'"
                    . "WHERE JobCardNo='$JCNo'";
            $db->query($sql);
            ?>

            <div class="card " style="background-color: #FFD700">
                <div class="card-header text-center">
                    <h3 class="text-center text-dark">Update successfully <i class="far fa-thumbs-up"></i></h3>
                </div>
            </div>

            <?php
        }
    }
    ?>

    <section class="content">
        <div class="container-fluid">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-warning">
                                Edit Before Photo
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="BeforePhoto" class="form-label">Before Photo</label>
                                    
                                    <input class="form-control" type="file" id="BeforePhoto" name="BeforePhoto">
                                    <input type="hidden" name="PreviousBeforePhoto" value="<?php echo @$BeforePhoto; ?>">
                                    <div class="text-danger"><?php echo @$message['BeforePhoto']; ?></div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="text" name="JCNo" value="<?php echo $JobCardNo; ?>">
                                <button type="submit" class="btn btn-warning" name="action" value="save">Save</button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-warning">
                                Edit After Photo
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="AfterPhoto" class="form-label">After Photo</label>
                                    <input class="form-control" type="file" id="AfterPhoto" name="AfterPhoto">
                                    <input type="hidden" name="PreviousAfterPhoto" value="<?php echo @$AfterPhoto; ?>">
                                    <div class="text-danger"><?php echo @$message['AfterPhoto']; ?></div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning" name="action" value="save">Save</button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

</div>

<?php
include '../footer.php';
?>

