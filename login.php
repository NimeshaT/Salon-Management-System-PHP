<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS | Log in</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="system/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="system/dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition login-page" style="background-image:url('images/loginbg.jpg');background-repeat:no-repeat;background-size: cover">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-dark">
                <div class="card-header text-center bg-dark">
                    <div class="container justify-content-center">
                        <img src="images/logo.png" alt="logo" width="150" height="100" > 
                    </div> 
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <?php
                    include 'system/function.php';
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "login") {
                        $UserName = dataClean($UserName);
                        $message = array();
                        if (empty($UserName)) {
                            $message['UserName'] = "User Name should not be empty..!";
                        }

                        if (empty($Password)) {
                            $message['Password'] = "Password should not be empty..!";
                        }

                        if (empty($message)) {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers WHERE UserName='$UserName' AND Password='" . sha1($Password) . "'";
                            $result = $db->query($sql);
                            if ($result->num_rows == 1) {

                                while ($row = $result->fetch_assoc()) {
                                    $_SESSION['CUSTOMERID'] = $row['CustomerId'];
                                    $_SESSION['FIRSTNAME'] = $row['FirstName'];
                                    $_SESSION['LASTNAME'] = $row['LastName'];
                                }
                                $current = $_GET['current'];
                                if (isset($_GET['current']) && !empty($_GET['current'])) {
                                    header("Location:$current");
                                } else {
                                    header("Location:index2.php");
                                }
                            } else {
                                $message['Password'] = "User Name or Password Invalid..!";
                            }
                        }
                    }

                    //                    =========cancel form details===============
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                        $UserName = "";
                        $Password = "";
                    }
                    $current="";
                    if(isset($_GET['current'])){
                        $current=$_GET['current'];
                    }
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>?current=<?php echo $current?>" method="post">
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="User Name" id="UserName" name="UserName">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo @$message['UserName']; ?></div>
                        <div class="input-group mt-3">
                            <input type="password" class="form-control" placeholder="Password" id="Password" name="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo @$message['Password']; ?></div>
                        <div class="row mt-3 mb-3">
                            <div class="col-8">
                                <button type="submit" class="btn btn-danger " name="action" value="cancel">Cancel</button>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-warning btn-block" name="action" value="login">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
<!--                    <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>-->
                    <p class="mb-0">
                        <a href="customer_registration.php" class="text-center">Register a new membership</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
    </body>
</html>


