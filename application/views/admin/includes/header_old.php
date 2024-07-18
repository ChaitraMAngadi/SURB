<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Absolutemens | Dashboard</title>

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

    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu" style="height: 100vh; overflow-y: scroll;">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <span>
                                         <!--<img alt="image" class="img-circle" src="<?= ADMIN_ASSETS_PATH ?>assets/img/profile_small.jpg" />-->
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">Absolutemens</strong>
                                        </span>
                                        <span class="text-muted text-xs block">Admin Control Panel <!-- <b class="caret"></b> -->
                                        </span>
                                    </span>
                                </a>
                                <!-- <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="#">Settings</a></li>
                                    <li><a href="#">Database Backup</a></li>
                                    <li><a href="#">Login Logs</a></li>
                                    <li><a href="#">SMS Gateway Settings</a></li>
                                    <li><a href="#">Change Password</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= base_url() ?>admin/logout">Logout</a></li>
                                </ul> -->
                            </div>
                            <div class="logo-element">
                                FM
                            </div>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse in">
                                <!-- <li>
                                    <a href="#">Localization
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-second-level collapse">
                                        <li><a href="<?= base_url() ?>admin/localisation/languages">Languages</a></li>
                                        <li><a href="<?= base_url() ?>admin/localisation/currencies">Currencies</a></li>
                                    </ul>
                                </li> -->


                                <li class="<?php  if($page_name == 'states' || $page_name == 'cities' || $page_name == 'locations' || $page_name == 'pincodes'){ echo 'active'; } ?>">
                                    <a>Locations
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-second-level collapse">
                                            <li  class="<?=  $page_name == 'states' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>admin/states">States</a>
                                            </li>
                                            <li class="<?= $page_name == 'cities' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>admin/cities">Cities</a>
                                            </li>
                                            <!-- <li class="<?= $page_name == 'locations' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>admin/locations">Locations</a>
                                            </li> -->

                                            <li class="<?= $page_name == 'pincodes' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>admin/pincodes">Pincode</a>
                                            </li>
                                            
                                            <li class="<?= $page_name == 'locations' ? 'active' : '' ?>">
                                                <a href="<?= base_url() ?>admin/locations">Areas</a>
                                            </li>
                                    </ul>
                                </li>

                                <li class="<?= $page_name == 'banners' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/banners">Banners</a>
                                </li>

                                

                                <!-- <li class="<?= $page_name == 'banneradds' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/banneradds">Banners AD's</a>
                                </li> -->

                                <li class="<?= $page_name == 'categories' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/categories">Categories</a>
                                </li>
                                <li class="<?= $page_name == 'sub_categories' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/sub_categories">Sub Categories</a>
                                </li>

                                 
                                <li class="<?php  if($page_name == 'attributes' || $page_name == 'manage_attributes' || $page_name == 'brands' || $page_name == 'tags' || $page_name == 'tax'){ echo 'active'; } ?>">
                                    <a href="#">Product Attributes
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-second-level collapse">
                                        <!-- <li><a href="<?= base_url() ?>admin/colors">Colors</a></li>-->
                                        <li class="<?=  $page_name == 'attributes' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/attributes">Attributes Types</a>
                                        </li> 
                                        <li class="<?= $page_name == 'manage_attributes' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/manage_attributes">Manage Attributes</a>
                                        </li>
                                        <li class="<?= $page_name == 'brands' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/brands">Brands</a>
                                        </li>
                                        <li class="<?= $page_name == 'tags' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/tags">Tags</a>
                                        </li>
                                        <!-- <li class="<?= $page_name == 'tax' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/tax">Tax Management</a>
                                        </li> -->
                                    </ul>

                                </li>

                                

                               <!--  <li><a href="<?= base_url() ?>admin/filtergroups">Filter Groups</a></li>
                                <li><a href="#">Manage App Versions</a></li>
                                <li><a href="<?= base_url() ?>admin/payment_gateway">Payment Gateway</a></li> -->
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="<?= base_url() ?>admin/attributes"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Attributes</span></a>
                        </li> -->
                        <!-- <li class="<?= $page_name == 'deals' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/deals"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Deals of the Day</span></a>
                        </li> -->

                        <!--<li>
                            <a href="<?= base_url() ?>admin/deals"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Deals of the Day</span></a>
                        </li>-->

                        <!-- <li>
                            <a href="<?= base_url() ?>admin/ads"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Ads Management</span></a>
                        </li> -->


                        <li class="<?php  if($page_name == 'products' || $page_name == 'inactive_products'){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> Products
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'products' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/products">Active Products</a>
                                    </li>
                                    <li class="<?= $page_name == 'inactive_products' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/inactive_products">Inactive Products</a>
                                    </li>
                            </ul>
                        </li>



                        

                         <li class="<?= $page_name == 'coupons' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/coupons"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Coupon codes</span></a>
                        </li>


                         <li class="<?php  if($page_name == 'vendor_banners'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/vendor_banners"><i class="fa fa-th-large"></i> <span class="nav-label">Vendor Banners</span></a>
                        </li>
                        
                        <li class="<?php  if($page_name == 'questionaries'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/questionaries"><i class="fa fa-th-large"></i> <span class="nav-label">Questionaries</span></a>
                        </li>
                       
                         <li class="<?php  if($page_name == 'filters'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/filters"><i class="fa fa-th-large"></i> <span class="nav-label">Filters</span></a>
                        </li>
                        
                        <li class="<?= $page_name == 'orders' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/orders"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span></a>
                        </li>

                        <!-- <li class="<?= $page_name == 'vendors_shops' || $page_name == 'vendors_shops/add' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/vendors_shops/"><i class="fa fa-list"></i>  <span class="nav-label">Vendors</span></a>
                        </li> -->

                        <li class="<?= $page_name == 'vendors_shops' || $page_name == 'inactive_vendors_shops' || $page_name == 'vendors_shops/add' ? 'active' : '' ?>">
                            <a><i class="fa fa-table"></i> Vendors
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'vendors_shops' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/vendors_shops">Active Vendors</a>
                                    </li>
                                    <li class="<?= $page_name == 'inactive_vendors_shops' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/inactive_vendors_shops">Inactive Vendors</a>
                                    </li>
                            </ul>
                        </li>

                        <!-- <li class="<?= $page_name == 'delivery_boy' || $page_name == 'delivery_boy/add' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/delivery_boy"><i class="fa fa-truck"></i> <span class="nav-label">Delivery Boys</span>
                            </a>
                        </li> -->


                        <!-- <li class="<?= $page_name == 'vendors_shops' || $page_name == 'vendors_shops/add' ? 'active' : '' ?>">
                            <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Vendors/Shops</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li class="<?= $page_name == 'vendors_shops' ? 'active' : '' ?>"><a href="<?= base_url() ?>admin/vendors_shops/">Vendors</a></li>
                                <li class="<?= $page_name == 'vendors_shops/add' ? 'active' : '' ?>"><a href="<?= base_url() ?>admin/vendors_shops/add">Add Vendor</a></li>
                            </ul>
                        </li> -->
                        <!-- <li class="<?= $page_name == 'visual_merchants' || $page_name == 'visual_merchants/add' ? 'active' : '' ?>">
                            <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Visual Merchants</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li class="<?= $page_name == 'visual_merchants' ? 'active' : '' ?>"><a href="<?= base_url() ?>/admin/visual_merchants">Merchants</a></li>
                                <li class="<?= $page_name == 'visual_merchants/add' ? 'active' : '' ?>"><a href="<?= base_url() ?>/admin/visual_merchants/add">Add Merchant</a></li>
                            </ul>
                        </li> -->
                         <li class="<?= $page_name == 'settlements' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>/admin/settlements"><i class="fa fa fa-money"></i> <span class="nav-label">Settlements</span></a>
                        </li> 
                        <li class="<?= $page_name == 'users' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/users"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a>
                        </li>
                        <li class="<?= $page_name == 'become_vendors' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/become_vendors"><i class="fa fa-user"></i> <span class="nav-label">Become a Vendors</span></a>
                        </li>
                        <li class="<?= $page_name == 'notifications' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/notifications"><i class="fa fa-bell-o"></i> <span class="nav-label">Notifications</span></a>
                        </li>
                        <li class="<?= $page_name == 'pushnotifications_list' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/Pushnotifications"><i class="fa fa-bell-o"></i> <span class="nav-label">Push Notifications</span></a>
                        </li>

                         <li class="<?= $page_name == 'transactions' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/transactions"><i class="fa fa fa-money"></i> <span class="nav-label">Transactions</span></a>
                        </li>


                       


                        
                        <li class="<?= $page_name == 'content' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/content"><i class="fa fa-book"></i> <span class="nav-label">CMS Pages</span></a>
                        </li>

                        <li class="<?= $page_name == 'settings' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/settings"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span></a>
                        </li>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <!-- <form role="search" class="navbar-form-custom" action="search_results.html">
                                <div class="form-group">
                                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                                </div>
                            </form> -->
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                           <!--  <li>
                                <span class="m-r-sm text-muted welcome-message">Welcome to Absolutemens.</span>
                            </li> -->
                            <?php   
                                
                            $qry = $this->db->query("SELECT orders.*,admin_notifications.* FROM orders LEFT JOIN admin_notifications ON orders.id=admin_notifications.order_id WHERE admin_notifications.status=0 and orders.order_status=2");
                                              $num_rows = $qry->num_rows(); ?>
                            <li id="here">
                                <a href="<?= base_url() ?>admin/notifications">
                                    <i class="fa fa-bell" aria-hidden="true" style="background-color: #"></i> Notifications <b> ( <?php echo $num_rows; ?> )</b>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/logout">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>

                    </nav>

