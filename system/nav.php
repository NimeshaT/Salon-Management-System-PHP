<?php
//include 'function.php';
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo SITE_URL; ?>index.php" class="nav-link">Home</a>
        </li>
        <!--        <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!--        <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>-->

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <!--            <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>-->
            <!--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                 Message Start 
                                <div class="media">
                                    <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                 Message End 
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                 Message Start 
                                <div class="media">
                                    <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                 Message End 
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                 Message Start 
                                <div class="media">
                                    <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                 Message End 
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>-->
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_appointments` AS apt WHERE apt.AppointmentId NOT IN (SELECT AppointmentId FROM tbl_services_job_card)";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                    <span class="badge badge-danger navbar-badge"><?php echo $row["pending_count"]; ?></span>
                <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_appointments` AS apt WHERE apt.AppointmentId NOT IN (SELECT AppointmentId FROM tbl_services_job_card) AND apt.AppointmentTypeId='2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <span class="dropdown-item dropdown-header">Notifications</span>

                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                    <div class="dropdown-divider"></div>
                    <a href="http://localhost/sms/system/appointments/editBridal_1.php" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i><?php echo $row["pending_count"]; ?> New Bridal Appointments
                    </a>
                <?php } ?>

                <div class="dropdown-divider"></div>
                <?php
                    $db = dbConn();
                    $sql = "SELECT COUNT(*) as pending_count FROM `tbl_appointments` AS apt WHERE apt.AppointmentId NOT IN (SELECT AppointmentId FROM tbl_services_job_card) AND apt.AppointmentTypeId='1'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    ?>
                 <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                <a href="http://localhost/sms/system/appointments/edit.php" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> <?php echo $row["pending_count"]; ?> New Service Appointments
                </a>
                  <?php } ?>
                <div class="dropdown-divider"></div>
                <!--                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>-->
                <div class="dropdown-divider"></div>
<!--                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>-->
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="<?php echo SITE_URL; ?>logout.php" role="button">
                Logout
            </a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/sms/system/index.php" class="brand-link text-center">
        <span class="brand-text font-weight-light text-warning" style="font-family: 'Yellowtail', cursive;">Salon Kanchana</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center ">
            <div class="image text-center" >
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_employees INNER JOIN tbl_users_role ON tbl_employees.RoleCode=tbl_users_role.RoleCode WHERE tbl_employees.EmployeeId='{$_SESSION['EMPLOYEEID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <img class="img-fluid" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['EmployeeImage']; ?>">
                        <a href="#" class="d-block text-warning"><?php echo $row['RoleName']; ?></a>
                        <?php
                    }
                }
                ?>

                <a href="#" class="d-block text-warning"><?php echo $_SESSION['FIRSTNAME']; ?> <?php echo $_SESSION['LASTNAME']; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!--        <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>-->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                $menu = "menu_" . $_SESSION['ROLE'] . ".php";
                include $menu;
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

