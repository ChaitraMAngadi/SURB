<html class="no-js" lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Absolutemens</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta property="al:android:app_name" content="App Links" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>web_assets/img/favicon.png">
        <link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Archivo Narrow' rel='stylesheet'>
        

        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Muli" />

        <!-- CSS
        ========================= -->
        <!--bootstrap min css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/bootstrap.min.css">
        <!--owl carousel min css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/owl.carousel.min.css">
        <!--slick min css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/slick.css">
        <!--magnific popup min css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/magnific-popup.css">
        <!--font awesome css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/all.css">
        <!--ionicons css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/ionicons.min.css">
        <!--7 stroke icons css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/pe-icon-7-stroke.css">
        <!--animate css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/animate.css">
        <!--jquery ui min css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/jquery-ui.min.css">
        <!--plugins css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/plugins.css">

        <!-- Main Style CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/style.css?r=<?= time() ?>">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/costumnew.css?r=<?= time() ?>">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/newresponsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/tablesaw.css">

        <!--modernizr min js here-->
        <script src="<?php echo base_url(); ?>web_assets/js/vendor/modernizr-3.7.1.min.js"></script>
        <!--        toaster-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
        <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        
<!--  Prevent confirm resubmission-->
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
       

    </head>
    <body>
        <!--header area start-->
        <div class="off_canvars_overlay">
        </div>

        <header class="navbar navbar-expand-lg">
            
            <?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
            <div class="main_header header_two header_transparent sticky-header sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12  col-md-12 col-xs-12 col-sm-12">
                            
                            <div class="header2_container">
                            <div class="logo logo2">
                                        <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>uploads/images/<?= $this->data['site']->logo ?>"></a>
                                       <!--  <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>web_assets/img/logo-white.svg" alt=""></a> -->
                                    </div>
                                    <div class="logo logo2_sticky">
                                        <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>web_assets/img/logo.png"></a>
                                       <!--  <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>web_assets/img/logo-white.svg" alt=""></a> -->
                                    </div>
                                <!--offcanvas menu area start-->
                                <div class="offcanvas_menu offcanvas_two">
                                    <!-- <div class="canvas_open">
                                        <a href="javascript:void(0)"><i class="fal fa-bars"></i></a>
                                    </div> -->
                                    <div class="offcanvas_menu_wrapper">
                                        <div class="canvas_close">
                                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                        </div>
                                        <div id="menu" class="text-left ">
                                            <?php
                                            if ($_SESSION['userdata']['guest_logged_in'] == 1) {
                                                $guest_user_id = $_SESSION['userdata']['guest_user_id'];
                                                $guest_qry = $this->db->query("select * from guest_users where id='" . $guest_user_id . "'");
                                                $guest_row = $guest_qry->row();
                                                $location = $guest_row->location;
                                            } else if ($_SESSION['userdata']['logged_in'] == 1) {
                                                $user_id = $_SESSION['userdata']['user_id'];
                                                $user_qry = $this->db->query("select * from users where id='" . $user_id . "'");
                                                $user_row = $user_qry->row();
                                                $location = $user_row->home_location;
                                            }
                                            ?>
                                            <ul class="offcanvas_main_menu">
                                                <li class="menu-item-has-children d-none">
                                                    <a href="javascript:void(0);" clas="d-none"><i class="fal fa-map-marker-alt" title="<?php
                                                        if ($location != '') {
                                                            echo $location;
                                                        } else {
                                                            echo "Location Name";
                                                        }
                                                        ?>"></i><?php
                                                                                 if ($location != '') {
                                                                                     echo $location;
                                                                                 } else {
                                                                                     echo "Location Name";
                                                                                 }
                                                                                 ?></a>
                                                </li>
                                              <li class="menu-item-has-children">  <a href="<?= base_url('web/myprofile') ?>" > <img src="<?php echo base_url(); ?>uploads/images/person.svg" alt="noimg" 
> <span>Profile</span></a></li>
                    <li class="menu-item-has-children"><a href="<?= base_url('web/my_addressbook') ?>" ><img src="<?php echo base_url(); ?>uploads/images/manageaddress.svg" alt="noimg" 
> <span>Manage Address</span></a></li>
                    <li class="menu-item-has-children"><a href="<?= base_url('web/checkout') ?>" ><img src="<?php echo base_url(); ?>uploads/images/cart.svg" alt="noimg" 
> <span>My Cart</span></a></li>
                 <li class="menu-item-has-children">   <a href="<?= base_url('web/my_wishlist') ?>" ><img src="<?php echo base_url(); ?>uploads/images/wishlist.svg" alt="noimg" 
> <span>My Wishlist</span></a></li>
<li class="menu-item-has-children"><a href="<?= base_url('web/my_orders') ?>" ><img src="<?php echo base_url(); ?>uploads/images/Myorders.svg" alt="noimg" 
> <span>My Orders</span></a></li>
<?php $user_qry = $this->db->query("select * from users where id='".$user_id."'");
$user_qry_res = $user_qry->row();
$date=date('Y-m-d');
$user_expiry_date = ($user_qry_res->expiry_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->expiry_member_date)) : null;

$user_created_date = ($user_qry_res->created_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->created_member_date)) : null;
// print_r($user_qry_res);
?>
 <?php 
                       if (($user_expiry_date != null && $user_expiry_date >= $date && $user_qry_res->expiry_member_date!='') && 
                       ($user_created_date != null && $user_created_date <= $date && $user_qry_res->created_member_date!='')&& $user_qry_res->membership=='yes' && $user_qry_res->plan!=0 && $user_qry_res->plan!=''&& $user_qry_res->plan!=null&& $user_qry_res->plan!='0' ) {?>
                       <li class="menu-item-has-children"><a href="<?= base_url('web/membership') ?>" ><img src="<?php echo base_url(); ?>uploads/images/membership.png" alt="noimg"> <span>Membership</span></a></li><?php }?>
<li class="menu-item-has-children categories_list">
                                                    <a href="#">Categories </a>
                                                    <ul class="sub-menu">
                                                    

                                                        <?php
                                                        foreach ($mega_menu as $cat) {
                                                            if (!empty($cat->sub_cats)) {
                                                                ?>
                                                                <li class="menu-item-has-children">
                                                                    <!-- <a href="<?=base_url()?>web/view_subcategories/<?=$cat->seo_url?>" onclick="toggleNav('<?= $cat->id ?>')"><?= ucwords($cat->category_name) ?></a> -->
                                                                    <a href="#" onclick="toggleNavnew('<?= $cat->id ?>')"><?= ucwords($cat->category_name) ?></a>
                                                                    <ul class="sub-menu" id="sub-<?= $cat->id ?>">
                                                                        <?php
                                                                        foreach ($cat->sub_cats as $sub_cat) {
                                                                            
                                                                            $sub_catss = $sub_cat->sub_categories[0];
                                                                            if ($sub_catss->question_id != '') {
                                                                                ?>
                                                                                <li onclick="closeNav()"><a href="#subCatQA<?php echo $sub_cat->id; ?>" data-toggle="modal" ><?= ucwords($sub_cat->sub_category_name) ?></a></li>
                                                                            <?php } else { ?>
                                                                                <li><a href="<?php echo base_url(); ?>products/<?php echo $cat->seo_url ?>/<?= $sub_cat->seo_url ?>" ><?= ucwords($sub_cat->sub_category_name) ?></a></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children active"><a href="<?php echo base_url(); ?>">Home</a></li>

                                                
                                                <!-- <li class="menu-item-has-children">
                                                    <a href="<?php echo base_url(); ?>web/about_us"> About Us</a>
                                                </li> -->
                                                <li class="menu-item-has-children"><a href="<?php echo base_url(); ?>web/what_we_do">What We Do</a></li>
<!--                                                <li class="menu-item-has-children"><a href="<?php echo base_url(); ?>web/talk_to_expert">Talk To An Expert</a></li>-->
<?php

$this->db->where('name', 'Contact');
$query = $this->db->get('features');
$feature = $query->row();
$show_contact = !empty($feature) && $feature->status == 1;
?>
<?php if($show_contact): ?>                                               
<li class="menu-item-has-children">
                                                    <a href="<?php echo base_url(); ?>web/contact_us"> Contact Us</a>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--offcanvas menu area end-->
                                <div class="header2_left">
                                   
                                    <div class="main_menu menu_two color_three menu_position" id="mainpage">
                                        <nav>
                                            <ul>
                                                <?php
                                                if ($_SESSION['userdata']['guest_logged_in'] == 1) {
                                                    $guest_user_id = $_SESSION['userdata']['guest_user_id'];
                                                    $guest_qry = $this->db->query("select * from guest_users where id='" . $guest_user_id . "'");
                                                    $guest_row = $guest_qry->row();
                                                    $location = $guest_row->location;
                                                } else if ($_SESSION['userdata']['logged_in'] == 1) {
                                                    $user_id = $_SESSION['userdata']['user_id'];
                                                    $user_qry = $this->db->query("select * from users where id='" . $user_id . "'");
                                                    $user_row = $user_qry->row();
                                                    $location = $user_row->home_location;
                                                }
                                                ?>
                                                <li class="menu-item-has-children mr-5 d-none">
                                                    <a class="goglocation" href="#" data-sidebar-target="03" title="<?php
                                                    if ($location != '') {
                                                        echo $location;
                                                    } else {
                                                        echo "Location Name";
                                                    }
                                                    ?>"><i class="fal fa-map-marker-alt"></i> <?php
                                                       if ($location != '') {
                                                           echo $location;
                                                       } else {
                                                           echo "Location Name";
                                                       }
                                                       ?></a>
                                                </li><!--main is added"-->
                                                <li><a  <?php if ($page == 'index.php') { ?>class="active"<?php } ?>  href="<?php echo base_url(); ?>web">Home
                                            </a></li>


                                                <?php /*
                                                 * <li><a>Categories <i class="fa fa-angle-down"></i></a>
                                                 * <?php echo base_url(); ?>web/viewAllCategories
                                                 * <ul class="sub_menu pages">
                                                  <?php foreach ($categories as $category) { ?>
                                                  <li><a href="<?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></li>
                                                  <?php } ?>
                                                  </ul> </li> */ ?>
                 

                                                <li class="mega_items"><a class="" href="javascript:void(0)">Categories</a>
                                                    <div class="mega_menu">
                                                        <ul class="mega_menu_inner">
                                                            <?php
                                                             $this->db->where('name', 'Questionary');
                                                             $query = $this->db->get('features');
                                                             $feature = $query->row();
                                                             $show_Questionary = !empty($feature) && $feature->status == 1;
                                                          
                                                            foreach ($mega_menu as $cat) {
                                                               
                                                                // if (!empty($cat->sub_cats)) {
                                                                    ?>
                                                                    <li><h4><a href="<?=base_url()?>web/view_subcategories/<?= $cat->seo_url ?>" class="cat_name"><?= ucwords($cat->category_name) ?></a></h4>
                                                                        <ul>
                                                                            <?php 
                                                                            foreach ($cat->sub_cats as $sub_cat) {
                                                                               
                                                                                $sub_catss = $sub_cat->sub_categories[0];
                                                                                if (!$show_Questionary) {
                                                                                    $sub_catss->question_id = '';
                                                                                }
                                                                                if ($sub_catss->question_id != '') {
                                                                                    ?>
                                                                                    <li><a href="#subCatQA<?php echo $sub_cat->id; ?>" data-toggle="modal" ><?= ucwords($sub_cat->sub_category_name) ?></a></li>
                                                                                <?php } else { ?>
                                                                                    <li><a href="<?php echo base_url(); ?>products/<?php echo $cat->seo_url ?>/<?= $sub_cat->seo_url ?>" ><?= ucwords($sub_cat->sub_category_name) ?></a></li>
                                                                                    <?php
                                                                                }
                                                                               
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                // }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <!-- <li><a href="<?php echo base_url(); ?>web/about_us"> About  </a></li> -->
                                                <li class="menu-item-has-children"><a href="<?php echo base_url(); ?>web/what_we_do">What We Do</a></li>
<!--                                                <li class="menu-item-has-children"><a href="<?php echo base_url(); ?>web/talk_to_expert">Talk To An Expert</a></li>-->
<?php

$this->db->where('name', 'Contact');
$query = $this->db->get('features');
$feature = $query->row();
$show_contact = !empty($feature) && $feature->status == 1;
?>
<?php if($show_contact): ?>                                                
<li><a href="<?php echo base_url(); ?>web/contact_us"> Contact Us</a></li>
<?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!-- <div id="show_errormsg" class="alert-success"></div>  -->









                                <div class="header_account_area">
                                    <div class="header_account_list search_list">
<!--                                        <a href="javascript:void(0)" class="ml-2"><span class="pe-7s-search"></span></a>-->

                                        <div class="dropdown_search1 d-none d-lg-block d-md-block">

                                            <form  enctype="multipart/form-data" method="get" action="<?= base_url('search') ?>" accept-charset="utf-8" class="user" onsubmit="storesearchdata()">
                                                <div class="input-group topnewsearch">
                                                <button type="submit"><span class="pe-7s-search"></span></button>
                                                    <input id="searchdata" name="searchdata" onkeyup="getdatasearch(this)"  placeholder="Search for products brand and more" type="text">
                                                    <!-- <span class="close-button" id="close">&times;</span> -->
                                                </div>

                                            </form>
                                            <ul class="serchcls" id="search_report">
                                            </ul>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        .serchcls{
                                            padding-left: 10px;
                                            /* margin-left:10px; */
                                            width:300px;
                                          
                                        }
                                        .scrollsea{
                                            height: 250px;
                                            overflow-y:scroll;
                                            width:300px;
                                            overflow-x:hidden;
                                            position: absolute;
                                            background-color: #fff;
                                        }
                                        .serchcls li{
                                            width: 300px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;
                                            border-bottom: 1px solid #f4f4f4;
                                            line-height: 30px;

                                           
                                        }
                                        
                                        .fal{
                                            font-weight: 300!important;
                                        }
                                        .top-wishicon{
                                            padding-top: 2px;
                                            background-position: top right;
                                            background-repeat: no-repeat;
                                            
                                        }
                                        .cartimage{
                                            /* padding-top: 2px; */
                                            background-position: top right;
                                            background-repeat: no-repeat;
                                            
                                        }
                                        .person{
                                        padding-top: 2px;
                                            background-position: top right;
                                            background-repeat: no-repeat;
                                       }
                                       .close-button {
                                        font-size: 12px;
                                        cursor: pointer;
                                        color: #888;
                                        display: inline-block;
                                        width: 10px;
                                        line-height: 1;
                                        justify-content: center;
                                        align-items: center;
                                        text-align: center;
                                        padding: 5px;
                                        display: inline-flex;
                                        border-radius: 50%;
                                        background-color: #f6f6f6 0% 0% no-repeat padding-box;
                                        background:#f6f6f6 0% 0% no-repeat padding-box;
                                        border-top: 1px solid #ccc;
                                        border-bottom: 1px solid #ccc;
                                        border-right: 1px solid #ccc;
                                        /* margin-right: 20px; */
                                        padding-right: 10px;
                                        }

                                       
                                    </style>
                                    <div class="equal">
                                        <!-- <div class="wish"> -->
                                    <?php 
                                    // $session_id = $_SESSION['session_data']['session_id'];
                                        // $user_id = $_SESSION['userdata']['user_id'];
                                        // $qry = $this->db->query("select * from whish_list where user_id='" . $user_id . "'");
                                        // $wish_count=$qry->num_rows();
                                        

                                    if ($_SESSION['userdata']['user_id'] != '') { ?>
                                        
                                    <a href="<?php echo base_url(); ?>web/my_wishlist" class="top-wishicon"><img src="<?php echo base_url(); ?>uploads/images/wishicon.svg">
                                    <!-- <span class="wish_count"><?php 
                                    // echo  
                                    // $wish_count; ?></span> -->
                                </a>
                                    
                                    <?php } else { ?>
                                        <a href="#loginModal" data-toggle="modal" onclick="showLoginForm()" class="top-wishicon"><img src="<?php echo base_url(); ?>uploads/images/wishicon.svg"></a>
                                      <?php } ?> 
                                    <!-- </div>  -->

                                       
                                    <div class="header_account_list  mini_cart_wrapper">
                                        <button data-sidebar-target="03" class="d-none d-lg-none d-md-none float-left mr-1 loc-btn"><i class="pe-7s-map-marker"></i></button>
                                        <?php
                                        $session_id = $_SESSION['session_data']['session_id'];
                                        $user_id = $_SESSION['userdata']['user_id'];
                                        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                                        $cart_count = $cart_qry->num_rows();
                                        ?>
                                        <?php if ($_SESSION['userdata']['user_id'] != '') { ?>
                                        <a href="<?php echo base_url(); ?>web/checkout" class="cartimage"><img src="<?php echo base_url(); ?>uploads/images/cartimage.svg">
                                            <span class="item_count" id="cart_count"><?php echo $cart_count; ?></span>
                                        </a>
                                        <?php } else { ?>
                                             <a href="#loginModal" data-toggle="modal" onclick="showLoginForm()" class="cartimage"><img src="<?php echo base_url(); ?>uploads/images/cartimage.svg">
                                        </a>
                                            <?php } ?> 

                                    </div>
                                      

                                    <div class="language_currency header_account_list ">
                                        <?php if ($_SESSION['userdata']['user_id'] != '') { ?>
                                            <a href="javascript:void();" class="person"><img src="<?php echo base_url(); ?>uploads/images/person.svg"> </a>
                                        <?php } else { ?>
                                            <a href="javascript:void();" class="person"><img src="<?php echo base_url(); ?>uploads/images/person.svg"> </a>
                                        <?php } ?>
                                        <ul class="dropdown_currency">
                                            <?php if ($_SESSION['userdata']['user_id'] != '') { ?>
                                                <li><a href="<?php echo base_url(); ?>web/my_orders" ><i class="fal fa-user-tag fa-lg mr-1"></i>My Orders</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/my_wishlist" ><i class="fal fa-heart fa-lg mr-1"></i>My Wishlist</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/myprofile" ><i class="fal fa-user fa-lg mr-1"></i>My Profile</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/logout"><i class="fal fa-sign-out fa-lg mr-1"></i>Logout</a></li>

                                            <?php } else { ?>
                                                <li><a href="#loginModal" data-toggle="modal" onclick="showLoginForm()"><i class="fal fa-unlock-alt fa-lg mr-1"></i>Login</a></li>
                                                <li><a href="#registerModal" data-toggle="modal"><i class="fal fa-user fa-lg mr-1"></i>Register</a></li>

                                            <?php } ?>
                                        </ul>
                                    </div>
                                    </div>

                                </div>
                                <div class="canvas_open">
                                        <a href="javascript:void(0)"><i class="fal fa-bars"></i></a>
                                    </div>

                            </div>
                            <div class="dropdown_search1 d-block d-lg-none d-md-none">

                                <form  enctype="multipart/form-data" method="get" action="<?= base_url('search') ?>" accept-charset="utf-8" class="user" onsubmit="return storesearchdata()">
                                    <div class="input-group topnewsearch">
                                        <input id="searchdata" name="searchdata" onkeyup="getdatasearch(this)"  placeholder="Search here ..." type="text">
                                        <button type="submit"><!-- <span class="pe-7s-search"></span> --><span class="pe-7s-search"></span></button>
                                    </div>

                                </form>
                                <ul class="serchcls" id="search_report">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <!--mini cart-->




            <!-- <div class="mini_cart" id="loadcart">
            <?php
            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
            $del_b = $qry->row();
            if ($qry->num_rows() > 0) {
                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="cart_gallery">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="cart_close">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="cart_text">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <h3>cart</h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="mini_cart_close">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="pro-cart">
                <?php
                $shop = $this->db->query("select * from vendor_shop where id='" . $del_b->vendor_id . "'");
                $shopdat = $shop->row();
                $min_order_amount = $shopdat->min_order_amount;
                $result = $qry->result();

                $unitprice = 0;
                $gst = 0;
                foreach ($result as $value) {
                    $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "'");
                    $product = $pro->row();
                    if ($product->image != '') {
                        $img = base_url() . "uploads/products/" . $product->image;
                    } else {
                        $img = base_url() . "uploads/noproduct.png";
                    }
                    //$value->variant_id
                    $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
                    $link = $var1->row();
                    $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "'");
                    $product1 = $pro1->row();
                    $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");
                    if ($adm_qry->num_rows() > 0) {
                        $adm_comm = $adm_qry->row();
                        $p_gst = $adm_comm->gst;
                    } else {
                        $p_gst = '0';
                    }
                    $class_percentage = ($value->unit_price / 100) * $p_gst;

                    $variants1 = $var1->result();
                    $att1 = [];
                    foreach ($variants1 as $value1) {

                        $jsondata = $value1->jsondata;
                        $values_ar = [];
                        $json = json_decode($jsondata);
                        foreach ($json as $value123) {
                            $type = $this->db->query("select * from attributes_title where id='" . $value123->attribute_type . "'");
                            $types = $type->row();

                            $val = $this->db->query("select * from attributes_values where id='" . $value123->attribute_value . "'");
                            $value1 = $val->row();
                            $values_ar[] = array('id' => $value1->id, 'title' => $types->title, 'value' => $value1->value);
                        }
                    }
                    $unitprice = $value->unit_price + $unitprice;
                    $gst = $class_percentage + $gst;
                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="cart_item">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="cart_img">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <a href="#"><img src="<?php echo $img; ?>" alt=""></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="cart_info">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <a href="#"><?php echo $product1->name; ?></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <p><?php echo $value->quantity; ?> x <span> <i class="fal fa-rupee-sign"></i> <?php echo $value->price; ?> </span></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="cart_remove">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <a onclick="deletecart(<?php echo $value->id; ?>)"><i class="ion-ios-close-outline"></i></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                    <?php
                }
                $grand_t = $min_order_amount + $unitprice + $gst;
                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           </div>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mini_cart_table">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="cart_table_border">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="cart_total">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>Sub Total :</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span class="price"><i class="fal fa-rupee-sign"></i> <?php echo $unitprice; ?></span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="cart_total mt-10">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>Shipping Charges : </span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span class="price"><i class="fal fa-rupee-sign"></i> <?php echo $min_order_amount; ?></span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <hr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="cart_total mt-10">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>Total</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span class="price"><i class="fal fa-rupee-sign"></i> <?php echo $grand_t; ?></span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mini_cart_footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="cart_button">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="<?php echo base_url(); ?>web/checkout"><i class="fal fa-sign-in"></i> Checkout</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </div>
            <?php } else { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="text-align: center; color: red;">Cart Empty</h3>
            <?php } ?>
            </div> -->
            <!--mini cart end-->
        </header>
        <!-- <script type="text/javascript">
        setTimeout(function() {
        $('.alert-success').fadeOut('fast');
        }, 5000);
        </script> -->

        <div class="sidebar sidebar-left" id="03">
            <div class="d-flex flex-column">
                <div class="flex-grow-0 py-2 px-3 px-md-5 bg-light">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="m-0">Get Location</h5>

                        </div>
                        <div class="col-auto">
                            <button class="btn bg-transparent shadow-none btn-sm" data-sidebar-dismiss="03"><i class="fal fa-times h4 m-0 text-black-50"></i></button>
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-3 px-md-5">
                            <!-- <input  class="pac-input form-control"  type="text" id="pac-input1" placeholder="Search for area, street name.."> -->
                            <p id="show_location_errormsg"></p>
                            <input id="pac-input" class="controls1 pac-input form-control" type="text" placeholder="Search your Location" style="width: 70%;
                                   float: left;">
                            <input type="button" class="btn btn-success" onclick="getLocation()" value="Confirm" style="    float: right;
                                   width: 27%;
                                   font-size: 16px;
                                   text-align: center;">
                        </div>
                        <div id="map" style="width: 100%; height: 500px; display: none;"></div>

                        <div class="list-group-item bg-success text-white px-3 px-md-5">
                            <a onclick="getCurrentLocation()"><div class="row">
                                    <div class="col-auto pr-0"><i class="fal fa-location fa-2x fa-fw"></i></div>
                                    <div class="col">
                                        <strong class="m-0 mb-1">Get current location</strong>
                                        <p class="mb-0 text-white-50">Using GPS</p>
                                    </div>
                                </div></a>
                        </div>
                        <!-- <a class="list-group-item list-group-item-action px-3 px-md-5" ng-repeat="address in homeAddresses">
                            <div class="row">
                                <div class="col-auto pr-0"><i class="fal fa-map-marker fa-2x fa-fw text-muted"></i></div>
                                <div class="col">
                                    <strong class="m-0 mb-1">address</strong>
                                    <p class="mb-0 text-muted">address</p>
                                </div>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
        <?php
        $session_id = $_SESSION['session_data']['session_id'];
        $user_id = $_SESSION['userdata']['user_id'];
        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
        $cart_count = $cart_qry->num_rows();
        ?>

        <input type="hidden" id="cart_count_hidden_input" value="<?php echo $cart_count; ?>">
        <input type="hidden" id="session_id" value="<?php echo $session_id; ?>">
        <input type="hidden" id="vendor_id" value="<?php echo $_SESSION['session_data']['vendor_id']; ?>">


  <!-- <input type="hidden" id="login_quantity" >
<input type="hidden" id="login_vendor_id" >
<input type="hidden" id="login_session_id" >
<input type="hidden" id="login_variant_id" >
<input type="hidden" id="login_saleprice" > -->

        <script type="text/javascript">

            function getCurrentLocation()
            {
                var latitudeAndLongitude = document.getElementById("latitudeAndLongitude"),
                        location = {
                            latitude: '',
                            longitude: ''
                        };

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    latitudeAndLongitude.innerHTML = "Geolocation is not supported by this browser.";
                }

                function showPosition(position)
                {
                    // alert(JSON.stringify(position));
                    location.latitude = position.coords.latitude;
                    location.longitude = position.coords.longitude;
                    //latitudeAndLongitude.innerHTML="Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
                    var geocoder = new google.maps.Geocoder();
                    var latLng = new google.maps.LatLng(location.latitude, location.longitude);

                    if (geocoder) {
                        geocoder.geocode({'latLng': latLng}, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                console.log(results[0].formatted_address);
                                //alert(JSON.stringify(results[0].formatted_address));
                                $('#pac-input').val(results[0].formatted_address);
                            } else {
                                //$('#pac-input').value('Geocoding failed: '+status);
                                alert("Geocoding failed: " + status);
                            }
                        }); //geocoder.geocode()
                    }
                } //showPosition
            }
//            function getdatasearch()
//            {
//                var keyword = $("#searchdata").val();
//                $('.error').remove();
//                var errr = 0;
//                $.ajax({
//                    url: "<?php echo base_url(); ?>web/searchdata",
//                    method: "POST",
//                    data: {keyword: keyword},
//                    success: function (data)
//                    {
//                        var element = document.getElementById("search_report");
//                        element.classList.add("scrollsea");
//                        $('#search_report').html(data);
//                    }
//                });
//            }
// $(document).ready(function() {
//         $('#searchdata').on('input', function() {
//             if ($(this).val().trim() !== '') {
//                 var closeButton = document.getElementById('close');
//                 closeButton.style.display = "block";
//                 $('#close').show();
//             } else {
//                 $('#close').hide();
//             }
//         });
        
//         // Function to clear search data and hide the close button
//         $('#close').click(function() {
//             document.getElementById("searchdata").value = "";
//             $('#searchdata').val('');
//             $(this).hide();
//         });
//     });
            function getdatasearch(val)
            {
                var keyword = val.value;
                if (keyword.length > 1) {
                    $('#search_report').show();
                    // var closeButton = document.getElementById('close');
                    // closeButton.style.display = "block";
                    // $('#close').show();

                    $('.error').remove();
                    var errr = 0;
                    $.ajax({
                        url: "<?php echo base_url(); ?>web/searchdata",
                        method: "POST",
                        data: {keyword: keyword},
                        success: function (data)
                        {
                            if (data != '') {
                                var element = document.getElementById("search_report");
                                element.classList.add("scrollsea");
                                $('#search_report').html(data);
                            } else {
                                $('#search_report').html('<li>No products found.</li>');
                            }
                        }
                    });
                } else {
                    $('#search_report').hide();
                    $('.serchcls').hide();
                }
            }

            function storesearchdata(){

                var keyword = $('#searchdata').val();
                // $keyword = str_replace(['<', '>'], ['&lt;', '&gt;'], $keyword);
                keyword = keyword.replace(/</g, "&lt;").replace(/>/g, "&gt;");
                   

                    $('.error').remove();
                    var errr = 0;
                    $.ajax({
                        url: "<?php echo base_url(); ?>web/searchstore",
                        method: "POST",
                        data: {keyword: keyword},
                        success: function (data)
                        {
                          console.log(data);
                        }
                    });
               

            }
         
        </script>
        <script type="text/javascript">
            function deletecart(cartid)
            {
                if (confirm("Are you sure you want to delete cart item")) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>web/deleteCartItem",
                        method: "POST",
                        data: {cartid: cartid},
                        success: function (data)
                        {
                            var str = data;
                            var res = str.split("@");
                            //alert(JSON.stringify(res));
                            if (res[1] == 'success')
                            {
                                $('#show_errormsg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Cart Item deleted successfully</span>');
                                $('#show_errormsg').focus();
                                location.reload();
                                return false;

                            } else
                            {
                                $('#show_errormsg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Something went wrong , please try again</span>');
                                $('#show_errormsg').focus();
                                return false;
                            }



                        }
                    });
                }
            }
        </script>
        <script type="text/javascript">
            function getLocation()
            {
                $('.error').remove();
                var errr = 0;
                var loc = $("#pac-input").val();

                if ($('#pac-input').val() == '')
                {
                    $('#pac-input').after('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Enter Location</span>');
                    $('#pac-input').focus();
                    return false;
                } else
                {
                    var selectedlocation = $('#pac-input').val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>web/getuserLocation",
                        method: "POST",
                        data: {selectedlocation: selectedlocation},
                        success: function (data)
                        {
                            var str = data;
                            var res = str.split("@");
                            //alert(JSON.stringify(res));
                            if (res[1] == 'success')
                            {
                                window.location.href = "<?php echo base_url(); ?>web";
                            } else
                            {
                                $('#show_location_errormsg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">No shops in this location,Please change your location</span>');
                                $('#show_location_errormsg').focus();
                                return false;
                            }



                        }
                    });
                }
            }
            document.addEventListener("DOMContentLoaded", function() {
    // var image="<?php echo $category_title;?>";
    // var myimage=null;
    // image.style.backgroundColor="#2556B9";
            var buttons = document.querySelectorAll(".cat_name");
            var currentButton = null;

            // Check if there's a stored active button in local storage
            var activeButtonIndex = localStorage.getItem("activeButtonIndex");

            if (activeButtonIndex !== null) {
                // Remove active color from all buttons
                buttons.forEach(function(button) {
                    button.style.backgroundColor = "";
                    button.style.color = "";
                });

                // Apply active color to the previously clicked button
                // buttons[activeButtonIndex].style.backgroundColor = "#2556B9";
                // buttons[activeButtonIndex].style.background = "#2556B9 0% 0% no-repeat padding-box";
                // buttons[activeButtonIndex].style.color = "white";

                currentButton = buttons[activeButtonIndex];
            }

            buttons.forEach(function(button, index) {
                button.addEventListener("click", function() {
                    // Remove active color from the previous button
                    if (currentButton !== null) {
                        currentButton.style.backgroundColor = "";
                        currentButton.style.color = "";
                    }

                    // Apply active color to the clicked button
                    // this.style.backgroundColor = "#2556B9";
                    // this.style.background = "#2556B9 0% 0% no-repeat padding-box";
                    // this.style.color = "white";

                    // Store the index of the clicked button in local storage
                    localStorage.setItem("activeButtonIndex", index);

                    currentButton = this;
                });
            });
            window.addEventListener("load", function() {
        // localStorage.removeItem("activeButtonIndex");
    });
        });
        window.onload = function() {
    // Clear the value of the element with ID "searchdata"
    document.getElementById("searchdata").value = "";
};
         
            function initMap() {
                setTimeout(function () {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: 17.6868, lng: 83.2185},
                        zoom: 13
                    });
                    var input = (document.getElementById('pac-input'));
                    var types = document.getElementById('type-selector');
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo('bounds', map);
                    var infowindow = new google.maps.InfoWindow();

                    var marker = new google.maps.Marker({
                        map: map,
                        anchorPoint: new google.maps.Point(0, -29)
                    });

                    autocomplete.addListener('place_changed', function () {
                        infowindow.close();
                        marker.setVisible(false);
                        var place = autocomplete.getPlace();
                        if (!place.geometry) {
                            window.alert("Autocomplete's returned place contains no geometry");
                            return;
                        }

                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }
                        marker.setIcon(({
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(35, 35)
                        }));
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);

                        var address = '';
                        if (place.address_components) {
                            address = [
                                (place.address_components[0] && place.address_components[0].short_name || ''),
                                (place.address_components[1] && place.address_components[1].short_name || ''),
                                (place.address_components[2] && place.address_components[2].short_name || '')
                            ].join(' ');
                        }

                        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                        infowindow.open(map, marker);
                    });
                    /*function setupClickListener(id, types) {
                     var radioButton = document.getElementById(id);
                     radioButton.addEventListener('click', function () {
                     autocomplete.setTypes(types);
                     });
                     }*/

                    /* setupClickListener('changetype-all', []);
                     console.log("Trigger");*/
                }, 1000);

            }
        </script>


        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA5vejn8Hc8jurJu88B1MX_bDrHC7Utus&libraries=places&callback=initMap&sensor=false" async defer></script> -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA5vejn8Hc8jurJu88B1MX_bDrHC7Utus&libraries=places&callback=initMap&loading=async"></script>


        <!--subcategory wise questionary pop up-->
        <?php
        foreach ($mega_menu as $cat_key => $cat) {
            if (!empty($cat->sub_cats)) {
                foreach ($cat->sub_cats as $sub_cat_key => $sub_cat) {
                    $sub_cats = $sub_cat->sub_categories[0];
                    if ($sub_cats->question_id != '') {
                        // echo "<pre>";
                        // print_r($sub_cats);
                        ?>
                        <div class="modal fade" id="subCatQA<?php echo $sub_cats->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div id="productQAModal"> 
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       
                                        <div class="modal-body">
  
                                            <div class="row justify-content-end">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-5 align-self-center d-lg-block d-none">
                                                            <!-- <img src="<?php echo base_url(); ?>web_assets/img/qaside.png" class="img-fluid1"/> -->
                                                            <!-- <img src="<?php 
                                                            // echo $questionary['app_image']; ?>" > -->
                                                           <?php 
                                                        //    echo $sub_cats->app_image;?>
                                                         <!-- <img src="<?php  
                                                        //  echo base_url(); ?>uploads/questionaries/<?php echo $sub_cats->app_image; ?>"/>
                                                             <img src="<?php echo $sub_cats->app_image; ?>" alt="img"/> -->
                                                            <!-- <img src="<?php 
                                                            // echo base_url('uploads/questionaries/' . $sub_cats->app_image); ?>" alt="Image"/> -->
                                                         <img src=" <?php echo base_url(); ?>uploads/questionaries/<?php echo $sub_cats->image;?>"/>


                                                        </div>
                                                        <div class="col-lg-7">
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                                                        <span class="head">
                                            <h4><?php echo $sub_cats->question; ?></h4>
                                            </span>        <div  class="mymodal-content">
                                                            <form method="get" id='questionary-form1' action="<?php echo base_url(); ?>products-filter-by-questionaries" onsubmit="return chkform1('<?= $cat_key.'_'.$sub_cat_key ?>')">
                                                                <input type="hidden" name="cat_id" value="<?php echo $sub_cats->cat_id; ?>">
                                                                <input type="hidden" name="question_id" value="<?php echo $sub_cats->question_id; ?>">
                                                                <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cats->id; ?>">
                                                                <div class="row qaoptions1">
                                                                    <?php foreach ($sub_cats->options as $option_key => $value) { ?>
                                                                        <div class="col-md-12 font">
                                                                            <label class="custradiobtn"><?php echo $value->option; ?>
                                                                                <input type="checkbox" onchange="chkbox1(this, '<?php echo $cat_key.'_'.$sub_cat_key; ?>')" class="options1_<?= $cat_key.'_'.$sub_cat_key ?>" name="ques_options[]" value="<?php echo $value->id; ?>">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <div class="col-md-12 font">
                                                                        <label class="custradiobtn">Others
                                                                            <input type="checkbox" onchange="msgbox1(this, '<?php echo $cat_key.'_'.$sub_cat_key; ?>')" class="other1" id="other1_<?= $cat_key.'_'.$sub_cat_key ?>" name="ques_options[]" value="other">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 msgothers" id="message1-<?php echo $cat_key.'_'.$sub_cat_key; ?>" style="display:none;">
                                                                        <input type="text" name="message" id="message1-input-<?php echo $cat_key.'_'.$sub_cat_key; ?>"  placeholder="Please enter your issues..." class="othersmsg"/>
                                                                    </div><br>
                                                                    <div   class="modal-buttons" style="display:flex;gap:1.3rem;">
                                                    <a href="<?php echo base_url(); ?>sub-cat-products/<?php echo $sub_cats->seo_url; ?>"  class="btn btn-outline-primary  btn-lg skip-btn" onmouseover="this.style.color = 'white'" onmouseout="this.style.color = 'blue'">Skip</a>

                                                                        <button type="submit" class="btn text-white  btn-lg float-right sub-btn">Submit</button>
                                                                       
                                                                        
                                                                        
                                                                    </div>
                                                                
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>
        <!--subcategory wise questionary pop up ends-->
        <!--subcategory wise questionary pop up ends-->