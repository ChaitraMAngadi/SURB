<!doctype html>
<html class="no-js" lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta property="al:android:app_name" content="App Links" />
        <title>Absolutemens</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>web_assets/img/favicon.png">

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
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/costumnew.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/newresponsive.css">

        <!--modernizr min js here-->
        <script src="<?php echo base_url(); ?>web_assets/js/vendor/modernizr-3.7.1.min.js"></script></head>

    <!--toaster-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <body >
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
                                                <li class="menu-item-has-children mr-5">
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
                                                </li>
                                                <li class="menu-item-has-children active"><a href="<?php echo base_url(); ?>web">Home</a></li>

                                                <li class="menu-item-has-children d-none">
                                                    <a href="#">Categories  </a>
                                                    <ul class="sub-menu">

                                                        <?php
                                                        foreach ($mega_menu as $cat) {
                                                            if (!empty($cat->sub_cats)) {
                                                                ?>
                                                                <li class="menu-item-has-children">
                                                                    <a href="javascript:void(0)"><?= ucwords($cat->category_name) ?></a>
                                                                    <ul class="sub-menu">
                                                                        <?php
                                                                        foreach ($cat->sub_cats as $sub_cat) {
                                                                            $sub_catss = $sub_cat->sub_categories[0];
                                                                            if ($sub_catss) {
                                                                                ?>
                                                                                <li><a href="#subCatQA<?php echo $sub_cat->id; ?>" data-toggle="modal" class="dropdown-item"><?= ucwords($sub_cat->sub_category_name) ?></a></li>
                                                                            <?php } else { ?>
                                                                                <li><a href="<?php echo base_url(); ?>products/<?php echo $cat->seo_url ?>/<?= $sub_cat->seo_url ?>" class="dropdown-item"><?= ucwords($sub_cat->sub_category_name) ?></a></li>
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
                                                <li class="menu-item-has-children">
                                                    <a href="<?php echo base_url(); ?>about_us"> About Us</a>
                                                </li>
                                                <li class="menu-item-has-children"><a href="#">What We Do</a></li>
                                                <li class="menu-item-has-children"><a href="#">Talk To An Expert</a></li>
                                                <li class="menu-item-has-children">
                                                    <a href="<?php echo base_url(); ?>web/contact_us"> Contact Us</a>
                                                </li>

                                                <!-- <li class="menu-item-has-children">
                                                <a href="<?php echo base_url(); ?>web/changeLocation"> Change Location</a>
                                            </li> -->

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
            <div class="main_header header_two header_transparent sticky-header sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="header2_container">
                                <!--offcanvas menu area start-->
                                <div class="offcanvas_menu offcanvas_two">
                                    <div class="canvas_open">
                                        <a href="javascript:void(0)"><i class="ion-navicon-round"></i></a>
                                    </div>
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
                                                    <a href="#"><i class="fal fa-map-marker-alt" title="<?php
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
                                                <li class="menu-item-has-children active"><a href="<?php echo base_url(); ?>">Home</a></li>

                                                <li class="menu-item-has-children">
                                                    <a href="#">Categories </a>
                                                    <ul class="sub-menu">
                                                        <?php /* foreach ($categories as $category) { ?>
                                                          <li><a href="<?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></li>
                                                          <?php } */ ?>
                                                        <!-- <li><a href="#">Mobiles</a></li>
                                                        <li><a href="#">Electornics</a></li>
                                                        <li><a href="#">Fashion</a></li>
                                                        <li><a href="#">Grocery</a></li> -->
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="<?php echo base_url(); ?>about_us"> About Us</a>
                                                </li>
                                                <li class="menu-item-has-children"><a href="#">What We Do</a></li>
                                                <li class="menu-item-has-children"><a href="#">Talk To An Expert</a></li>
                                                <li class="menu-item-has-children">
                                                    <a href="<?php echo base_url(); ?>web/contact_us"> Contact Us</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--offcanvas menu area end-->
                                <div class="header2_left">
                                    <div class="logo logo2">
                                        <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>uploads/images/<?= $this->data['site']->logo ?>"></a>
                                       <!--  <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>web_assets/img/logo-white.svg" alt=""></a> -->
                                    </div>
                                    <div class="logo logo2_sticky">
                                        <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>web_assets/img/logo.png"></a>
                                       <!--  <a href="<?php echo base_url(); ?>web"><img src="<?php echo base_url(); ?>web_assets/img/logo-white.svg" alt=""></a> -->
                                    </div>
                                    <div class="main_menu menu_two color_three menu_position">
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
                                                </li>
                                                <li><a  <?php if ($page == 'index.php') { ?>class="active"<?php } ?>  href="<?php echo base_url(); ?>web">home</a></li>


                                                <?php /*
                                                 * <li><a>Categories <i class="fa fa-angle-down"></i></a>
                                                 * <?php echo base_url(); ?>web/viewAllCategories
                                                 * <ul class="sub_menu pages">
                                                  <?php foreach ($categories as $category) { ?>
                                                  <li><a href="<?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></li>
                                                  <?php } ?>
                                                  </ul> </li> */ ?>

                                                <li class="mega_items"><a class="active" href="#">Categories <i class="fa fa-angle-down"></i></a>
                                                    <div class="mega_menu">
                                                        <ul class="mega_menu_inner">
                                                            <?php
                                                            foreach ($mega_menu as $cat) {
                                                                if (!empty($cat->sub_cats)) {
                                                                    ?>
                                                                    <li><h4><a href="<?php echo base_url(); ?>products/<?php echo $cat->seo_url ?>"><?= ucwords($cat->category_name) ?></a></h4>
                                                                        <ul>
                                                                            <?php
                                                                            foreach ($cat->sub_cats as $sub_cat) {
                                                                                $sub_catss = $sub_cat->sub_categories[0];
                                                                                if ($sub_catss) {
                                                                                    ?>
                                                                                    <li><a href="#subCatQA<?php echo $sub_cat->id; ?>" data-toggle="modal" class="dropdown-item"><?= ucwords($sub_cat->sub_category_name) ?></a></li>
                                                                                <?php } else { ?>
                                                                                    <li><a href="<?php echo base_url(); ?>products/<?php echo $cat->seo_url ?>/<?= $sub_cat->seo_url ?>" class="dropdown-item"><?= ucwords($sub_cat->sub_category_name) ?></a></li>
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
                                                    </div>
                                                </li>
                                                <li><a href="<?php echo base_url(); ?>web/about_us"> About us </a></li>
                                                <li class="menu-item-has-children"><a href="#">What We Do</a></li>
                                                <li class="menu-item-has-children"><a href="#">Talk To An Expert</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/contact_us"> Contact Us</a></li>

                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!-- <div id="show_errormsg" class="alert-success"></div>  -->









                                <div class="header_account_area">
                                    <div class="header_account_list search_list">
<!--                                        <a href="javascript:void(0)" class="ml-2"><span class="pe-7s-search"></span></a>-->

                                        <div class="dropdown_search1 d-none d-lg-block d-md-block">

                                            <form  enctype="multipart/form-data" method="post" action="<?= base_url('search') ?>" accept-charset="utf-8" class="user">
                                                <div class="input-group topnewsearch">
                                                    <input id="searchdata" name="searchdata" onkeyup="getdatasearch(this)" placeholder="Search here ..." type="text">
                                                    <button type="submit"><!-- <span class="pe-7s-search"></span> --><span class="pe-7s-search"></span></button>
                                                </div>

                                            </form>
                                            <ul class="serchcls" id="search_report">
                                            </ul>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        .serchcls{
                                            padding-left: 10px;
                                            width:370px;
                                        }
                                        .scrollsea{
                                            height: 250px;
                                            width:370px;
                                            overflow-y:scroll;
                                            overflow-x:hidden;
                                            position: absolute;
                                            background-color: #fff;
                                        }
                                        .serchcls li{
                                            width: 370px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;
                                            border-bottom: 1px solid #f4f4f4;
                                            line-height: 30px;
                                        }
                                    </style>
                                    <a href="<?php echo base_url(); ?>web/my_wishlist" class="top-wishicon"><img src="uploads/images/wishicon.svg"></a>
                                    <div class="header_account_list  mini_cart_wrapper">
<!--                                        <button data-sidebar-target="03" class="d-block d-lg-none d-md-block float-left mr-1 loc-btn"><i class="pe-7s-map-marker"></i></button>-->
                                        <?php
                                        $session_id = $_SESSION['session_data']['session_id'];
                                        $user_id = $_SESSION['userdata']['user_id'];
                                        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                                        $cart_count = $cart_qry->num_rows();
                                        ?>
                                        <a href="<?php echo base_url(); ?>web/checkout"><span class="pe-7s-shopbag"></span>

                                            <span class="item_count" id="cart_count"><?php echo $cart_count; ?></span>
                                        </a>

                                    </div>

                                    <div class="language_currency header_account_list ">
                                        <a href="#"> <span class="pe-7s-user"></span></a>
                                        <ul class="dropdown_currency">
                                            <?php if ($_SESSION['userdata']['user_id'] != '') { ?>
                                                <li><a href="<?php echo base_url(); ?>web/my_orders" ><i class="fal fa-user-tag fa-lg mr-1"></i>My Orders</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/my_wishlist" ><i class="fal fa-heart fa-lg mr-1"></i>My Wishlist</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/myprofile" ><i class="fal fa-user fa-lg mr-1"></i>My Profile</a></li>
                                                <li><a href="<?php echo base_url(); ?>web/logout"><i class="fal fa-sign-out fa-lg mr-1"></i>Logout</a></li>

                                            <?php } else { ?>
                                                <li><a href="#loginModal" data-toggle="modal"><i class="fal fa-unlock-alt fa-lg mr-1"></i>Login</a></li>
                                                <li><a href="#registerModal" data-toggle="modal"><i class="fal fa-user fa-lg mr-1"></i>Register</a></li>

                                            <?php } ?>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            <div class="dropdown_search1 d-block d-lg-none d-md-none">

                                <form  enctype="multipart/form-data" method="post" action="<?= base_url('search') ?>" accept-charset="utf-8" class="user">
                                    <div class="input-group topnewsearch">
                                        <input id="searchdata" name="searchdata" onkeyup="getdatasearch(this)" placeholder="Search here ..." type="text">
                                        <button type="submit"><!-- <span class="pe-7s-search"></span> --><span class="pe-7s-search"></span></button>
                                    </div>

                                </form>
                                <ul class="serchcls" id="search_report">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--mega-menu start-->
                <div style="clear:fix;">
                    <?php include 'megamenu.php' ?>
                </div>
                <!--mega-menu end-->
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
                                                                                                                            </div>
            <?php } else { ?>
                                                                                                                            <h3 style="text-align: center; color: red;">Cart Empty</h3>
            <?php } ?>
            </div> -->
            <!--mini cart end-->
        </header>
        <script type="text/javascript">
            function getshopdatasearch()
            {
                var keyword = $("#searchdata").val();
                var shop_id = '<?php echo $shop_id; ?>';
                $('.error').remove();
                var errr = 0;
                $.ajax({
                    url: "<?php echo base_url(); ?>web/storesearchdata",
                    method: "POST",
                    data: {keyword: keyword, shop_id: shop_id},
                    success: function (data)
                    {
                        var element = document.getElementById("store_search_report");
                        element.classList.add("scrollsea");

                        $('#store_search_report').html(data);
                    }
                });
            }
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

            function getdatasearch(val)
            {
                var keyword = val.value;
                if (keyword.length > 1) {
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
                }
            }
        </script>

        <!--subcategory wise questionary pop up-->
        <?php
        foreach ($mega_menu as $cat) {
            if (!empty($cat->sub_cats)) {
                foreach ($cat->sub_cats as $key => $sub_cat) {
                    $sub_cats = $sub_cat->sub_categories[0];
                    if ($sub_cats) {
                        ?>
                        <div class="modal fade" id="subCatQA<?php echo $sub_cats->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div id="productQAModal"> 
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header position-relative">
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times-circle"></i></button>
                                            <h4><?php echo $sub_cats->question; ?></h4>
                                            <p></p>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row justify-content-end">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-5 align-self-center d-lg-block d-none">
                                                            <img src="<?php echo base_url(); ?>web_assets/img/qaside.png" class="img-fluid1"/>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <form method="post" id='questionary-form1' action="<?php echo base_url(); ?>products-filter-by-questionaries" onsubmit="return chkform1()">
                                                                <input type="hidden" name="cat_id" value="<?php echo $sub_cats->cat_id; ?>">
                                                                <input type="hidden" name="question_id" value="<?php echo $sub_cats->question_id; ?>">
                                                                <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cats->id; ?>">

                                                                <div class="row qaoptions">
                                                                    <?php foreach ($sub_cats->options as $value) { ?>
                                                                        <div class="col-md-12">
                                                                            <label class="custradiobtn"><?php echo $value->option; ?>
                                                                                <input type="checkbox" onchange="chkbox1(this, '<?php echo $key; ?>')" class="options1" name="ques_options[]" value="<?php echo $value->id; ?>">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <div class="col-md-12">
                                                                        <label class="custradiobtn">Others
                                                                            <input type="checkbox" onchange="msgbox1(this, '<?php echo $key; ?>')" class="other1" name="ques_options[]" value="other">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12 msgothers" id="message1-<?php echo $key; ?>" style="display:none;">
                                                                        <input type="text" name="message" id="message1-input-<?php echo $key; ?>" class="form-control" placeholder="Message"/>
                                                                    </div>
                                                                    <div class="col-md-12" style="background-color:#081f66;">
                                                                        <button type="submit" class="btn btn-outline-light mt-2 btn-lg float-right">SUBMIT</button>
                                                                        <a href="<?php echo base_url(); ?>sub-cat-products/<?php echo $sub_cats->seo_url; ?>" style="color:white !important" class="btn btn-outline-light mt-2 mr-2 btn-lg float-right">SKIP</a>
                                                                    </div>
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
                        <?php
                    }
                }
            }
        }
        ?>
        <!--subcategory wise questionary pop up ends-->