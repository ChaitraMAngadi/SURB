<?php
$features = $this->session->userdata('admin_login')['features'];
$role_name = $this->session->userdata('admin_login')['role_name'];
$this->db->where('status', 1);
$query = $this->db->get('features');
$features_data = $query->result_array();
$active_features = array_column($features_data, 'name');
?>
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
                                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">Absolutemens</strong>
                                        </span>
                                        <span class="text-muted text-xs block"><?= $role_name ?> Control Panel</span>
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
                                AM
                            </div>
                        </li>
                        <li class="<?=  $page_name == 'dashboard' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>admin/dbbackup"><i class="fa fa-database" aria-hidden="true"></i> <span class="nav-label">DBbackup</span></a>
                        </li>
<!--                        <li class="<?= $page_name == 'site_settin   gs' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/site_settings"><i class="fa fa-cog"></i> <span class="nav-label">Site Settings</span></a>
                        </li>-->
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-table"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
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
                                <?php if(in_array('Locations', $active_features)  && in_array('Locations', $features)): ?>

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
                                <?php endif; ?>                  
<?php if(in_array('Attributes', $active_features)  && in_array('Attributes', $features)||in_array('Brands', $active_features)  && in_array('Brands', $features)||in_array('Tags', $active_features)  && in_array('Tags', $features) ): ?>
<li class="<?php  if($page_name == 'attributes' || $page_name == 'manage_attributes' || $page_name == 'brands' || $page_name == 'tags' || $page_name == 'tax'){ echo 'active'; } ?>">
<a href="javascript:void(0);">Product Attributes
<span class="fa arrow"></span>
</a>
<ul class="nav nav-second-level collapse">

<?php if(in_array('Attributes', $active_features)  && in_array('Attributes', $features)): ?>
<li class="<?=  $page_name == 'attributes' ? 'active' : '' ?>">
    <a href="<?= base_url() ?>admin/attributes">Attributes Types</a>
</li> 
<li class="<?= $page_name == 'manage_attributes' ? 'active' : '' ?>">
    <a href="<?= base_url() ?>admin/manage_attributes">Manage Attributes</a>
</li>
<?php endif; ?>

<?php if(in_array('Brands', $active_features)  && in_array('Brands', $features)): ?>
<li class="<?= $page_name == 'brands' ? 'active' : '' ?>">
    <a href="<?= base_url() ?>admin/brands">Brands</a>
</li>
<?php endif; ?>
<?php if(in_array('Tags', $active_features)  && in_array('Tags', $features)): ?>
<li class="<?= $page_name == 'tags' ? 'active' : '' ?>">
    <a href="<?= base_url() ?>admin/tags">Tags</a>
</li>
<?php endif; ?>
<!-- <li class="<?= $page_name == 'tax' ? 'active' : '' ?>">
    <a href="<?= base_url() ?>admin/tax">Tax Management</a>
</li> -->
</ul>

</li>
<?php endif; ?>
<?php if(in_array('Banners', $active_features) && in_array('Banners', $features)): ?>
    <li class="<?= $page_name == 'banners' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/banners">Banners</a>
                                </li>

<?php endif; ?>
<?php if(in_array('Role', $active_features) && in_array('Role', $features)): ?>
<li class="<?= $page_name == 'Admin_roles' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/admin_role">Admin Roles</a>
                                </li>
                                <?php endif; ?>
<?php if(in_array('App_user', $active_features)  && in_array('App_user', $features)): ?>
<li class="<?= $page_name == 'Admin_users' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/admin_users">Admin Users</a>
                                </li>
                                <?php endif; ?>
                                <?php if(in_array('Categories', $active_features)  && in_array('Categories', $features)): ?>
                                <li class="<?= $page_name == 'categories' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/categories">Categories</a>
                                </li>
                                <?php endif; ?>
                                <?php if(in_array('Sub_Categories', $active_features)  && in_array('Sub_Categories', $features)): ?>
                                <li class="<?= $page_namSub_Categoriese == 'sub_categories' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/sub_categories">Sub Categories</a>
                                </li>
                                <?php endif; ?>

<?php if(in_array('Chatbot', $active_features) && in_array('Chatbot', $features)): ?>
    <li class="<?= $page_name == 'chatbot' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/chatbot">Chat bot</a>
                                </li>

<?php endif; ?>


<?php if(in_array('Payment_mode', $active_features) && in_array('Payment_mode', $features)): ?>
     
    <li class="<?= $page_name == 'payment_mode' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/payment_mode">Payment Mode</a>
                                </li>

<?php endif; ?>
                                
<!-- <?php
// Fetch the 'Banners' feature from the database
$this->db->where('name', 'Partners');
$query = $this->db->get('features');
$feature = $query->row();

// Check if 'Questionaries' feature has status 1
$show_partners = !empty($feature) && $feature->status == 1;
?> -->

<?php if(in_array('Partners', $active_features)  && in_array('Partners', $features)): ?>
     
    <li class="<?= $page_name == 'our_partners' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/our_partners">Our Partners</a>
                                </li>

<?php endif; ?>
</ul>
</li>
                        <?php if(in_array('Product', $active_features)&& in_array('Product', $features)  ): ?>

                        <li class="<?php  if($page_name == 'products' || $page_name == 'inactive_products'){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label"> Products</span>
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
                        <?php endif; ?>


<?php if(in_array('Performance', $active_features)  && in_array('Performance', $features)): ?> 
                        <li class="<?php  if($page_name == 'vendor_ratings'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/vendor_ratings"><i class="fa fa-star"></i> <span class="nav-label">Admin &Vendor performance matrix</span></a>
                        </li>
                        
                        <?php endif; ?>


   
<?php if(in_array('Coupons', $active_features) && in_array('Coupons', $features)): ?>

                         <li class="<?= $page_name == 'coupons' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/coupons"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Coupon codes</span></a>
                        </li>
                        <?php endif; ?>       

<!--                         <li class="<?php  if($page_name == 'vendor_banners'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/vendor_banners"><i class="fa fa-th-large"></i> <span class="nav-label">Vendor Banners</span></a>
                        </li>-->
                        
<!--                        <li class="<?php  if($page_name == 'questionaries'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/questionaries"><i class="fa fa-th-large"></i> <span class="nav-label">Questionaries</span></a>
                        </li>-->

                        
 

<?php if(in_array('Questionary', $active_features)   && in_array('Questionary', $features)): ?>
                        
                        <li class="<?php  if($page_name == 'questionaries' || $page_name == 'questionaries_other'){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label"> Questionary</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'questionaries' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/questionaries">Questionaries</a>
                                    </li>
                                    <li class="<?= $page_name == 'questionaries_other' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/questionaries/other_msg">Other Messages</a>
                                    </li>
                            </ul>
                        </li>
                        
                        <?php endif; ?>

 
<?php if(in_array('Prime', $active_features) && in_array('Prime', $features)): ?>

                        <li class="<?php  if($page_name == 'prime'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/prime"><i class="fa fa-user-plus" aria-hidden="true"></i> <span class="nav-label">Prime Membership</span></a>
                        </li>
                        <?php endif; ?>        

                        <?php if(in_array('Filters', $active_features)  && in_array('Filters', $features)): ?> 
                         <li class="<?php  if($page_name == 'filters'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/filters"><i class="fa fa-th-large"></i> <span class="nav-label">Filters</span></a>
                        </li>
                        <?php endif; ?>  
                        <?php if(in_array('Orders', $active_features)  && in_array('Orders', $features)): ?> 
                        <li class="<?php if($page_name == 'orders' || $page_name == 'orders_daily' || $page_name == 'orders_weekly'|| $page_name == 'orders_monthly'){ echo 'active'; } ?>">
                        <a><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">

                                    <li class="<?= $page_name ==  'orders' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/orders">Lifetime Orders</a>
                                    </li>
                                    <li  class="<?=  $page_name == 'Orders_daily' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/Orders_daily">Daily orders</a>
                                    </li>
                                    <li class="<?= $page_name == 'Orders_weekly' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/Orders_weekly">Weekly orders</a>
                                    </li>
                                     <li class="<?= $page_name == 'Orders_monthly' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/Orders_monthly">Monthly orders</a>
                                    </li>
                            </ul>
                        </li>
                        <?php endif; ?>  
                        <!-- <li class="<?php  if($page_name == 'HeroProducts_week'){ echo 'active'; } ?>">
                            <a href="<?= base_url() ?>admin/HeroProducts_week'"><i class="fa fa-th-large"></i> <span class="nav-label">Hero Products</span></a>
                        </li> -->
<?php if(in_array('Hero_Products', $active_features)  && in_array('Hero_Products', $features)): ?>

                        <li class="<?php if($page_name == 'HeroProducts_week' || $page_name == 'HeroProducts_month'){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label">Hero Products</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'HeroProducts_week' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/HeroProducts_week">week</a>
                                    </li>
                                    <li class="<?= $page_name == 'HeroProducts_month' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/HeroProducts_month">month</a>
                                    </li>
                                   
                            </ul>
                        </li>
                        <?php endif; ?>       
                        <?php if(in_array('Return', $active_features)  && in_array('Return', $features)): ?>       
                        <li class="<?= $page_name == 'product_return_details' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/product_return_details"><i class="fa fa-edit"></i><span class="nav-label">Product return</span></a>
                        </li>
                        <?php endif; ?>   
<?php if(in_array('Sales_report', $active_features) && in_array('Sales_report', $features)): ?>
                          <li class="<?php if($page_name == 'order_daily_reports' || $page_name == 'order_weekly_reports' || $page_name == 'order_monthly_reports'){ echo 'active'; }  ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label">Sales Reports</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'order_daily_reports' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/order_daily_reports">Daily Reports</a>
                                    </li>
                                    <li class="<?= $page_name == 'order_weekly_reports' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/order_weekly_reports">Weekly Reports</a>
                                    </li>
                                     <li class="<?= $page_name == 'order_monthly_reports' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/order_monthly_reports">Monthly Reports</a>
                                    </li>
                            </ul>
                        </li>
                        <?php endif; ?>

<?php if(in_array('Search_data', $active_features) && in_array('Search_data', $features)): ?>
                        <li class="<?= $page_name == 'search_data' || $page_name == 'search_data' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/SearchData"><i class="fa fa-list"></i>  <span class="nav-label">Search Data</span></a>
                        </li>
                       <?php endif; ?>
                       <?php if(in_array('Vendors', $active_features) && in_array('Vendors', $features)): ?>
                       <li class="<?php if($page_name == 'vendors_shops' || $page_name == 'order_weekly_reports' || $page_name == 'inactive_vendors_shops' || $page_name == 'vendors_shops/add' || $page_name == 'vendor_Revenue'){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label">Vendors</span>
                                <span class="fa arrow"></span>
                            </a>
                             <ul class="nav nav-second-level collapse">
                                <li class="<?= $page_name == 'vendors_shops' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/vendors_shops">Active Vendors</a>
                                </li>
                                 <li class="<?= $page_name == 'inactive_vendors_shops' ? 'active' : '' ?>">
                                   <a href="<?= base_url() ?>admin/inactive_vendors_shops">Inactive Vendors</a>
                                </li>
                                <li class="<?= $page_name == 'vendor_Revenue' ? 'active' : '' ?>">
                                   <a href="<?= base_url() ?>admin/vendor_Revenue">Vendor Revenue</a>
                                 </li>
                             </ul>
                        </li>

                        </li>
                        <?php endif; ?>
                        <?php if(in_array('Payouts', $active_features) && in_array('Payouts', $features)): ?>
                        <li class="<?= $page_name =='Admin_payouts'? 'active':''?>">
                        <a href="<?= base_url() ?>admin/Admin_payouts"><i class="fa fa fa-money"></i><span class="nav-label">admin payouts</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('Settlements', $active_features) && in_array('Settlements', $features)): ?>
                         <li class="<?= $page_name == 'settlements' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/settlements"><i class="fa fa fa-money"></i> <span class="nav-label">Settlements</span></a>
                        </li> 
                        <?php endif; ?>
                        <?php if(in_array('Users', $active_features) && in_array('Users', $features)): ?>
                        <li class="<?= $page_name == 'users' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/users"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a>
                        </li>
                        <?php endif; ?>
<?php if(in_array('Notifications', $active_features) && in_array('Notifications', $features)): ?>

                        <li class="<?php if($page_name == 'notifications' || $page_name == 'notification_preferences' ){ echo 'active'; }?>">
                        <a><i class="fa fa-bell-o"></i> <span class="nav-label">Notifications</span>
                        <span class="fa arrow"></span> 
                            <ul class="nav nav-second-level collapse">
                                    <li  class="<?=  $page_name == 'notifications' ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>admin/notifications"> <span class="nav-label">Notifications</span></a>
                                    </li>
                                    <li class="<?= $page_name == 'notification_preferences' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/notifications/notification_preferences">Notification Preferences</a>
                                    </li>
                            </ul>
                        </li>
                        <?php endif; ?>                       
<!--                        <li class="<?= $page_name == 'pushnotifications_list' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/Pushnotifications"><i class="fa fa-bell-o"></i> <span class="nav-label">Push Notifications</span></a>
                        </li>-->
<?php if(in_array('Transaction', $active_features) && in_array('Transaction', $features)): ?>
                         <li class="<?= $page_name == 'transactions' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/transactions"><i class="fa fa fa-money"></i> <span class="nav-label">Transactions</span></a>
                        </li>
                        <?php endif; ?>  
                        <?php if(in_array('Email_invoice', $active_features) && in_array('Email_invoice', $features)): ?>
                       <li class="<?php  if($page_name == 'order_delivered_invoice' || $page_name == 'order_refund_invoice' || $page_name == 'order_shipped_invoice' || $page_name == 'order_canceled_invoice' || $page_name == 'order_placed_invoice'){ echo 'active'; } ?>">
                           <a href="#"><i class="fa fa-inbox"></i><span class="nav-label">Email Invoice</span>
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-second-level collapse">
                                        <!-- <li><a href="<?= base_url() ?>admin/colors">Colors</a></li>-->
                                        <li class="<?=  $page_name == 'order_delivered_invoice' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/order_delivered_invoice">Order Delivered Invoice </a>
                                        </li>
                                        
                                        <li class="<?=  $page_name == 'order_refund_invoice' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/order_refund_invoice">Order Refund Invoice </a>
                                        </li>
                                        
                                        <li class="<?=  $page_name == 'order_shipped_invoice' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/order_shipped_invoice">Order Shipped Invoice </a>
                                        </li>
                                        
                                        <li class="<?=  $page_name == 'order_canceled_invoice' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/order_canceled_invoice">Order Canceled Invoice </a>
                                        </li>
                                        
                                        <li class="<?=  $page_name == 'order_placed_invoice' ? 'active' : '' ?>">
                                            <a href="<?= base_url() ?>admin/order_placed_invoice">Order Placed Invoice </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <?php endif; ?>  

                                <?php if(in_array('CMS', $active_features) && in_array('CMS', $features)): ?>            
                        <li class="<?= $page_name == 'content' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/content"><i class="fa fa-book"></i> <span class="nav-label">CMS Pages</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('Testimonials', $active_features) && in_array('Testimonials', $features)): ?>
                         <li class="<?= $page_name == 'testimonials' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/testimonials"><i class="fa fa-user"></i> <span class="nav-label">Testimonials</span></a>
                        </li>
                        <?php endif; ?>
<?php if(in_array('Contact', $active_features) && in_array('Contact', $features)): ?>
                        <li class="<?= $page_name == 'contact_us' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/contact_us"><i class="fa fa-user"></i> <span class="nav-label">Contact us</span></a>
                        </li>
                        <?php endif; ?>
                        <!-- <li class="<?= $page_name == 'settings' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/settings"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span></a>
                        </li>

                         <li class="<?= $page_name == 'loginlogs' ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>admin/admin_logs"><i class="fa fa-lock"></i> <span class="nav-label">Admin Logs</span></a>
                        </li> -->
<?php if((in_array('Settings', $active_features) || in_array('Admin_logs', $active_features)) && (in_array('Settings', $features)||in_array('Admin_logs', $features))): ?>
                        <li class="<?php if($page_name == 'settings' || $page_name == 'loginlogs' ){ echo 'active'; } ?>">
                            <a><i class="fa fa-table"></i> <span class="nav-label">Settings</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">



<?php if(in_array('Settings', $active_features) && in_array('Settings', $features)): ?>
                                    <li  class="<?=  $page_name == 'settings' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/settings">Settings</a>
                                    </li>
                                    <?php endif; ?> 
                                    
                 
                                    <?php

?>
<?php if(in_array('Admin_logs', $active_features) && in_array('Admin_logs', $features)): ?>                   

                                    <li class="<?= $page_name == 'loginlogs' ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>admin/admin_logs">Admin Logs</a>
                                    </li>

   <?php endif; ?> 
                            </ul>
                        </li>
                        <?php endif; ?> 
                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0)"><i class="fa fa-bars"></i> </a>
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



<?php if(in_array('Notifications', $active_features)   && in_array('Notifications', $features)): ?>

    <?php   

    // $this->load->model('Admin_model');

    $admin_login = $this->session->userdata('admin_login');

    $admin_id = isset($admin_login['id']) ? $admin_login['id'] : null;

    $admin_preferences = $this->admin_model->get_admin_preferences(1);  
    // $admin_preferences = $this->admin_model->get_admin_preferences($admin_id);  
    // var_dump($admin_preferences);      

    $num_rows = $this->admin_model->count_notifications($admin_preferences); 

    // $num_rows = count($res);     

                            ?>
                           
                            <li id="here">
                                <a href="<?= base_url() ?>admin/notifications">
                                    <i class="fa fa-bell" aria-hidden="true" style="background-color: "></i> Notifications (<?= $num_rows ? $num_rows : '0' ?>)
                                </a>
                            </li>
                            <li>
                            <?php endif; ?>  
<!--                                <a href="<?= base_url() ?>admin/logout">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>-->
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
                <a href="<?= base_url() ?>admin/logout"><button class="btn btn-danger"> Yes </button></a>
            </div>
        </div>
    </div>
</div>

