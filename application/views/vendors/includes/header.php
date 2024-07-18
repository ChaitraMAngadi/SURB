<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Absolutemens | Dashboard</title>

         <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>web_assets/img/favicon.png">

        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/style.css" rel="stylesheet">
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/custom_css.css" rel="stylesheet">
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

        <script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-2.1.1.js"></script>

       <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

    </head>
<!-- <body oncopy="return false" oncut="return false" onpaste="return false" oncontextmenu="return false;"> -->
    <body >
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <span>
                                         <!--<img alt="image" class="img-circle" src="<?= ADMIN_ASSETS_PATH ?>assets/img/profile_small.jpg" />-->
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">Absolutemens</strong>
                                        </span>
                                        <span class="text-muted text-xs block">Vendor Control Panel <b class="caret"></b>
                                        </span>
                                    </span>
                                </a>
                                <!-- <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="<?= base_url() ?>vendors/settings">Settings</a></li>
                                    <li><a href="#">Database Backup</a></li>
                                    <li><a href="#">Login Logs</a></li>
                                    <li><a href="#">SMS Gateway Settings</a></li>
                                    <li><a href="#">Change Password</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= base_url() ?>vendors/logout">Logout</a></li>
                                </ul> -->
                            </div>
                            <div class="logo-element">
                                AM
                            </div>
                        </li>
                        <li class="<?php  if($page_name == 'dashboard'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li class="<?php  if($page_name == 'settings'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/settings"><i class="fa fa-th-large"></i> <span class="nav-label">Profile</span></a>
                        </li>
<!--                        <li class="<?php  if($page_name == 'banners'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/banners"><i class="fa fa-th-large"></i> <span class="nav-label">Banners</span></a>
                        </li>

                        <li class="<?php  if($page_name == 'banneradds'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/banneradds"><i class="fa fa-user"></i> <span class="nav-label">Banner AD's</span></a>
                        </li>-->

                        <li class="<?php  if($page_name == 'categories'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/categories"><i class="fa fa-user"></i> <span class="nav-label">Categories</span></a>
                        </li>
                        <!-- <li class="<?php  if($page_name == 'sub_categories'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/sub_categories"><i class="fa fa-user"></i> <span class="nav-label">Sub Categories</span></a>
                        </li> -->

                        
                        <li class="<?php  if($page_name == 'products' || $page_name == 'inactive_products'){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label">Products</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'products' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/products">Active Products</a>
                                    </li>
                                    <li class="<?= $page_name == 'inactive_products' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/inactive_products">Inactive Products</a>
                                    </li>
                            </ul>
                        </li>
                        

                        <!-- <li class="<?php  if($page_name == 'products'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/products"><i class="fa fa-th-large"></i> <span class="nav-label">Products</span></a>
                        </li> -->
                        <li class="<?php  if($page_name == 'request_payment'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/request_payment"><i class="fa fa-th-large"></i> <span class="nav-label">Request Payment</span></a>
                        </li>



<!-- 
                        <li class="<?php  if($page_name == 'cities' || $page_name == 'locations' || $page_name == 'pincodes'){ echo 'active'; } ?>">
                                    <a>Location Management
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-second-level collapse">
                                             <li  class="<?=  $page_name == 'states' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>vendors/states">States</a>
                                            </li>
                                            <li class="<?= $page_name == 'cities' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>vendors/cities">Cities</a>
                                            </li> 
                                            <li class="<?= $page_name == 'pincodes' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>vendors/pincodes">Pincode</a>
                                            </li>
                                            <li class="<?= $page_name == 'locations' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>vendors/locations">Areas</a>
                                            </li>
                                    </ul>
                                </li> -->
                                <?php

$this->db->where('name', 'Sales_report');
$query = $this->db->get('features');
$feature = $query->row();
$show_sales = !empty($feature) && $feature->status == 1;
?>
<?php if($show_sales): ?>
                                <li class="<?php  if($page_name == 'order_daily_reports' || $page_name == 'order_weekly_reports' || $page_name == 'order_monthly_reports' ){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label">Sales Reports</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'order_daily_reports' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/order_daily_reports">Daily Reports</a>
                                    </li>
                                    <li class="<?= $page_name == 'order_weekly_reports' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/order_weekly_reports">Weekly Reports</a>
                                    </li>
                                     <li class="<?= $page_name == 'order_monthly_reports' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/order_monthly_reports">Monthly Reports</a>
                                    </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li class="<?= $page_name =='Vendor_payouts'? 'active':''?>">
                        <a href="<?= base_url() ?>vendors/Vendor_payouts"><i class="fa fa fa-money"></i><span class="nav-label">vendor payouts</span></a>
                        </li>
                        
                        <!-- <li class="<?php  if($page_name == 'orders'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/orders"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span></a>
                        </li> -->
                        <li class="<?php if($page_name == 'orders' || $page_name == 'orders_daily' || $page_name == 'orders_weekly'|| $page_name == 'orders_monthly'){ echo 'active'; }?>">
                        <a><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">

                                    <li class="<?= $page_name ==  'orders' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>vendors/orders">Lifetime Orders</a>
                                    </li>
                                    <li  class="<?=  $page_name == 'orders_daily' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/orders_daily">Daily orders</a>
                                    </li>
                                    <li class="<?= $page_name == 'orders_weekly' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/orders_weekly">Weekly orders</a>
                                    </li>
                                     <li class="<?= $page_name == 'orders_monthly' ? 'active' : ''?>">
                                        <a href="<?= base_url() ?>vendors/orders_monthly">Monthly orders</a>
                                    </li>
                            </ul>
                        </li>
                        <?php 
                        // print_r($page_name);?>
                        <li class="<?php  if($page_name == 'warehouses'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/warehouses"><i class="fa fa-home"></i><span class="nav-label">Warehouses</span></a>
                        </li>
                        <li class="<?php  if($page_name == 'pickuprequest'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/pickuprequests"><i class="fa fa-truck" aria-hidden="true"></i><span class="nav-label">pickup requests</span></a>
                        </li>
                        <li class="<?php  if($page_name == 'return'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/orders/return"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Return Requests</span></a>
                        </li>
                        <!-- <li class="<?php  if($page_name == 'businesshours'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/businesshours"><i class="fa fa-clock-o"></i><span class="nav-label">Business Hours</span></a>
                        </li> -->
                        <!-- <li>
                            <a href="<?= base_url() ?>/vendors/settlements"><i class="fa fa fa-money"></i> <span class="nav-label">Settlements</span></a>
                        </li> -->
                        <!-- <li class="<?php  if($page_name == 'users'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/users"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a>
                        </li> -->
                        <?php

$this->db->where('name', 'Reviews');
$query = $this->db->get('features');
$feature = $query->row();
$show_reviews = !empty($feature) && $feature->status == 1;
?>
<?php if($show_reviews): ?>
                        <li class="<?php  if($page_name == 'reviews'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>vendors/reviews"><i class="fa fa-star"></i> <span class="nav-label">User Reviews</span></a>
                        </li>
                        <?php endif; ?>       
                        <?php

$this->db->where('name', 'Notifications');
$query = $this->db->get('features');
$feature = $query->row();
$show_notifications = !empty($feature) && $feature->status == 1; 
?>
<?php if($show_notifications): ?>

    <li class="<?php if($page_name == 'notifications' || $page_name == 'notification_preferences' ){ echo 'active'; }?>">
                        <a><i class="fa fa-bell-o"></i> <span class="nav-label">Notifications</span>
                        <span class="fa arrow"></span> 
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'notifications' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>vendors/notifications"> <span class="nav-label">Notifications</span></a>
                                    </li>
                                    <li class="<?= $page_name == 'notification_preferences' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>vendors/notifications/notification_preferences">Notification Preferences</a>
                                    </li>
                            </ul>
                        </li>



                       
                        <?php endif; ?>  

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);"><i class="fa fa-bars"></i> </a>      
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <?php        
                            $num_rows = $this->db->where(['vendor_read_status' => 0, 'vendor_id' => $_SESSION['vendors']['vendor_id']])->get('admin_notifications')->num_rows();
                            ?>
                                                        <?php
$this->db->where('name', 'Notifications');
$query = $this->db->get('features');
$feature = $query->row();
$show_notifications = !empty($feature) && $feature->status == 1;
?> 
<?php if($show_notifications): ?>
    <?php   
    // $this->load->model('Vendor_model');
    $vendor_id=$this->session->userdata('vendors')['vendor_id'] ;
    $preferences = $this->vendor_model->get_vendor_preferences($vendor_id);        
    $num_rows = $this->vendor_model->count_notifications($vendor_id,$preferences); 
    // $num_rows = count($res);     
                            ?>
                            <li id="here">
                                <a href="<?= base_url() ?>vendors/notifications">
                                    <i class="fa fa-bell" aria-hidden="true" style="background-color: "></i> Notifications (<?= $num_rows ? $num_rows : '0' ?>)
                                </a>
                            </li>
                            <?php endif; ?> 
                            <li>
                            <li>

                                <button type="button" class="btn" data-toggle="modal" data-target="#logoutModal">
                                  <i class="fa fa-sign-out"></i> Log out
                                </button>
                            </li>
                        </ul>

                    </nav>
                    
                    <div class="modal fade" id="logoutModal" style="max-width: 30%; margin: 6% 35%;">
    <div class="modal-content">
        <div class="modal-header">
            <center><h3>Confirmation !</h3></center>
        </div>
        <div class="modal-body">
            <p style="font-size: 16px">Are you sure you want to logout ?</p>
        </div>
        <div class="modal-footer col-12">
            <div class="col-6" style="float: right;">
                <button class="btn btn-secondary-outline" data-dismiss="modal" data-target="#logoutModal" style="margin-right: 10px;"> No </button>
                <a href="<?= base_url() ?>vendors/logout"><button class="btn btn-danger"> Yes </button></a>
            </div>
        </div>
    </div>
</div>