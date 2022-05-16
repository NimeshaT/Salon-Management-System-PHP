<!--====================Profile Management===========================-->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-address-card"></i>
        <p>
            My Profile 
            <i class="right fas fa-angle-left "></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>profile/create.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>View Profile</p>
            </a>
        </li>
    </ul>
</li> 

<!--====================User Management===========================-->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>
            User 
            <i class="right fas fa-angle-left "></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>users/create.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Create User Roles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>users/assign.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Assign User Roles</p>
            </a>
        </li>
    </ul>
</li> 

<!--                ======================Customer Management=================-->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Customer 
            <i class="right fas fa-angle-left "></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>customers/view.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>View Customer</p>
            </a>
        </li>


    </ul>
</li> 

<!--                =================Employee Management=========================-->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Employee 
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>employees/create.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Create Employee</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>employees/view.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>View Employee</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>employees/createDesignation.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Create Designation</p>
            </a>
        </li>

    </ul>
</li> 


<!--                ======================Attendance Management========================-->
<!--<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-hand-paper"></i>
        <p>
            Attendance 
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SITE_URL; ?>attendance/create.php" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Employee Attendance</p>
                                    </a>
                                </li>
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>employees/view.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>View Attendance</p>
            </a>
        </li>

    </ul>
</li> -->

<!--          Items Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Items 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/create.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/view.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>View Items</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/createItemType.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Item Types</p>
                            </a>
                        </li>
                       
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/createItemCategory.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Item Category</p>
                            </a>
                        </li>
                       
                        
                        
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/createItemSize.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Item Size</p>
                            </a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/createItemBrand.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Item Brand</p>
                            </a>
                        </li>
                       
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/createItemColor.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Item Color</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/createPriceRange.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Price Range</p>
                            </a>
                        </li>
                       
                        
                    </ul>
                </li> -->

<!--          Stock Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Stock 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>stock/create.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Stock</p>
                            </a>
                        </li>
                        
                       
                    </ul>
                </li>-->

<!--          Orders Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Orders 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/create.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>items/view.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>View Items</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>-->


<!--          Personal Care Services Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-spa"></i>
                        <p>
                            Personal Care Services 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>personalCareServices/create.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>PersonalCareServices/view.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>View Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>PersonalCareServices/createServiceType.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Services Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>PersonalCareServices/createServiceCategory.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Create Services Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>PersonalCareServices/viewServiceCategory.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>View Services Category</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>-->

<!--          Appointments Management-->
<!--<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>
            Appointments 
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>appointments/edit.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>View Appointments</p>
            </a>
        </li>
                                <li class="nav-item">
                                    <a href="<?php echo SITE_URL; ?>appointments/createJobCard.php" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Create Job Card</p>
                                    </a>
                                </li>

    </ul>
</li>-->

<!--          Jobs Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Jobs 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>jobs/employeeView.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Employee View </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>jobs/cashierView.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Cashier View</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>jobs/managerView.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Manager View</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>jobs/receptionistView.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Receptionist View</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>jobs/employeeProfile.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Employee Profile</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>-->

<!--         Bridal Packages Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-spa"></i>
                        <p>
                            Bridal Packages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>bridal/create.php" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Create Bridal Package</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>bridal/createBridalServices.php" class="nav-link">
                                <i class="fas fa-user-check nav-icon"></i>
                                <p>Create bridal services</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>-->

<!--         Schedule Management-->
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Schedule
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>personalCareServices/create.php" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Create Bridal Package</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL; ?>employees/view.php" class="nav-link">
                                <i class="fas fa-user-check nav-icon"></i>
                                <p>Create bridal services</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>-->

<!--         Report Management-->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class=" nav-icon fa fa-file"></i>
        <p>
            Reports
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>personalCareServices/create.php" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Create Bridal Package</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo SITE_URL; ?>employees/view.php" class="nav-link">
                <i class="fas fa-user-check nav-icon"></i>
                <p>Create bridal services</p>
            </a>
        </li>

    </ul>
</li>