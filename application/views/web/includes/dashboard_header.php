<!doctype html>
<html class="no-js" lang="en">
    <head>
        <?php  $this->load->view("web/includes/header_styles"); ?>
    </head>
    <body>
        <?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
        <!--offcanvas menu area start-->
        <div class="off_canvars_overlay">
            
        </div>
        <div class="offcanvas_menu subpage">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="canvas_open">
                            <a href="javascript:void(0)"><i class="ion-navicon-round"></i></a>
                        </div>
                        <div class="offcanvas_menu_wrapper">
                            <div class="canvas_close">
                                <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                            </div>
                            
                            <div id="menu" class="text-left ">
                                <div class="offcanvas_menu">
                                    <div class="canvas_open">
                                        <a href="javascript:void(0)"><i class="ion-navicon-round"></i></a>
                                    </div>
                                    <div class="offcanvas_menu_wrapper">
                                        <div class="canvas_close">
                                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                        </div>
                                        <div id="menu" class="text-left ">
                                            <ul class="offcanvas_main_menu">
                                                <li class="menu-item-has-children">
                                                    <a href="#">Dashboard Menu</a>
                                                    <ul class="sub-menu">
<!--                                                        <li><a href="my_account.php"><i class="fal fa-user-tag"></i> My Account</a></li>-->
                                                        <li><a href="my_orders.php"><i class="fal fa-list-ul"></i> My Orders</a></li>
                                                        <li><a href="my_bids.php"><i class="fal fa-badge-percent"></i> My Bids</a></li>
                                                        <li><a href="my_wishlist.php"><i class="fal fa-heart"></i> My Wishlist</a></li>
                                                        <li><a href="my_addressbook.php"><i class="fal fa-address-book"></i> My Addressbook</a></li>
                                                        <li><a href="my_profile.php"><i class="fal fa-user"></i> My Profile</a></li>
                                                        <li><a href="become_a_vendor.php"><i class="fal fa-store"></i> Become a Vendor</a></li>
                                                        <li><a href="#"><i class="fal fa-sign-out"></i> Logout</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children active"><a href="#">Home</a></li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Categories</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="store_categories.php">Furniture</a></li>
                                                        <li><a href="store_categories.php">Mobiles</a></li>
                                                        <li><a href="store_categories.php">Electornics</a></li>
                                                        <li><a href="store_categories.php">Fashion</a></li>
                                                        <li><a href="store_categories.php">Grocery</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children"><a href="aout_us.php">About</a></li>
                                                <?php

$this->db->where('name', 'Contact');
$query = $this->db->get('features');
$feature = $query->row();
$show_contact = !empty($feature) && $feature->status == 1;
?>
<?php if($show_contact): ?>
                                                <li class="menu-item-has-children">
                                                    <a href="contact_us.php"> Contacts Us</a>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--offcanvas menu area end-->
        
        <header>
            <div class="main_header sticky-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-4 offset-md-4 offset-lg-0 col-5 offset-3 col-sm-5">
                            <div class="logo">
                                <a href="index.php"><img src="web_assets/img/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!--main menu start-->
                            <div class="main_menu menu_position">
                                <nav>
                                    <ul>
                                        <li><a  <?php if ($page == 'index.php') { ?>class="active"<?php } ?>  href="index.php">home</a></li>
                                        <li><a href="#">Categories <i class="fal fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="store_categories.php">Furniture</a></li>
                                            <li><a href="store_categories.php">Mobiles</a></li>
                                            <li><a href="store_categories.php">Electornics</a></li>
                                            <li><a href="store_categories.php">Fashion</a></li>
                                            <li><a href="store_categories.php">Grocery</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about_us.php" <?php if ($page == 'about_us.php') { ?>class="active"<?php } ?>> About us</a></li>
                                    <?php

$this->db->where('name', 'Contact');
$query = $this->db->get('features');
$feature = $query->row();
$show_contact = !empty($feature) && $feature->status == 1;
?>
<?php if($show_contact): ?>
                                    <li><a href="contact_us.php" <?php if ($page == 'contact_us.php') { ?>class="active"<?php } ?>> Contact Us</a></li>
                                    <?php endif; ?>
                              
                                </ul>
                            </nav>
                        </div>
                        <!--main menu end-->
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                        <div class="header_account_area">
                            <div class="header_account_list search_list">
                                <a href="javascript:void(0)"><span class="pe-7s-search"></span></a>
                                <div class="dropdown_search">
                                    <form action="#">
                                        <input placeholder="Search entire store here ..." type="text">
                                        <button type="submit"><span class="pe-7s-search"></span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="header_account_list  mini_cart_wrapper">
                                <a href="javascript:void(0)"><span class="pe-7s-shopbag"></span>
                                <span class="item_count">2</span>
                            </a>
                            
                        </div>
                        <div class="language_currency header_account_list ">
                            <a href="#"> <span class="pe-7s-user"></span></a>
                            <ul class="dropdown_currency">
<!--                                <li><a href="my_account.php">My Account</a></li>-->
                                <li><a href="my_bids.php">My Bids</a></li>
                                <li><a href="my_wishlist.php">My Wishlist</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--mini cart-->
    <!-- <?php include 'mini_cart.php'?> -->
    <?php  $this->load->view("web/mini_cart"); ?>
    <!--mini cart end-->
</header>
<!--header area end-->