<style>
    @media (min-width:961px)  {
        .noproduct {
            /* position: relative; */
            /* left: 17%; */
        }
    }

    .abs-btn{
        height: 30px;
        line-height: 30px;
        padding: 0 20px;
        text-transform: capitalize;
        color: #ffffff;
        background: var(--thm-blue);
        border: 0;
        border-radius: 30px;
        float: left;
        -webkit-transition: 0.3s;
        transition: 0.3s;
    }
</style>
<?php
$basename_get = basename($this->input->server('REQUEST_URI'));
//$find = ['/?','?'];
if (strpos($basename_get, '?')) {
    $basename = substr($basename_get, 0, strpos($basename_get, '?'));
} else {
    $basename = $basename_get;
}
//pr($basename); 
?>
<?php
   $basename_get = basename($this->input->server('REQUEST_URI'));
   //$find = ['/?','?'];
   if (strpos($basename_get, '?')) {
       $basename = substr($basename_get, 0, strpos($basename_get, '?'));
   } else {
       $basename = $basename_get;
   }
   
   $request_uri = substr($this->input->server('REQUEST_URI'), 1);
   
   $request_uri_explode = explode('/', $request_uri);
   // echo "<pre>";
   // print_r($request_uri_explode);
   // exit;
   if($request_uri_explode[0] == 'products') {
       $request_uri = 'web';
   }
   if($request_uri_explode[0] == 'sub-cat-products') {
       $request_uri = 'web';
   }
   
   // pr($request_uri); 
   
   ?>
<!--breadcrumbs area start-->

<div class="breadcrumbs_area mb-3 mt-72">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                <?php 
                // echo "<pre>";
                // print_r($searchdata);
                $sub_cat_na=$this->db->query("select sub_category_name from sub_categories where id='".$sub_cat_id."'");
                $sub_re=$sub_cat_na->row();
                // print_r($sub_re->sub_category_name);
                // exit; ?>
            <ul>
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                           <?php if ($category != null) {?>
                     <li>
                        <a href="<?=base_url()?>web/view_subcategories/<?=$category->seo_url?>"><?php echo $category->category_name; ?> </a>
                            </li><?php }?><li class="mylink"><?php
                  if ($category != null && $sub_cat_id != null) {
                      echo  $sub_re->sub_category_name;
                  } else if ($searchdata!=null) {
                      echo  $searchdata;
                  } else if ($sub_cat_id && $sub_cat_id != null) {
                      echo $sub_re->sub_category_name;
                  } else {
                      echo '';
                  }
                  ?></li></ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--breadcrumbs area end-->
<!--slider area start-->
<!--<section class="slider_section slider_s_three d-none">
    <div class="slider_area owl-carousel">
<?php foreach ($banners as $ban) { ?>
                                                                            <div class="single_slider inner_slider">
                                                                                <img src="<?php echo $ban['image']; ?>" alt="" class="home-slider-img" width="100%">
                                                                            </div>
<?php } ?>
    </div>
</section>-->

<style type="text/css">
    .inner_slider{
        width: 100%;
        height: 300px;
        object-fit: contain;
    }
</style>


<!--slider area end-->
<!--categories product area start-->
<div class="categories_product_area mb-30">
    <div class="container">
        <div class="row">
            <?php if ($products) { ?>
                <div class="col-lg-3">
                    <!--sidebar widget start-->
                    <div class="filter-sidebar d-lg-none d-block">
                        <button type="button" data-toggle="collapse" onclick="openNav()" style="border:none; background-color:#fff ; color:#333; border-radius: 5px; padding:3px 10px;">
                            <i class="fal fa-filter fa-lg"></i> <span>FILTERS</span>
                        </button>
                        <div id="mySidenav" class="sidenav visible-sm visible-xs">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNavbar()">&times;</a>
                            <?php $this->load->view("web/filter"); ?> 
                        </div>
                    </div>
                    <aside class="sidebar_widget d-lg-block d-none">
                        <div class="widget_inner">
                            <div class="widget_list widget_filter">
                                <?php
                                if ($basename == 'products-filter-by-questionaries') {
                                    unset($_POST['amount_range']);
                                    unset($_POST['brand_id']);
                                    unset($_POST['filter']);
                                    unset($_POST['option']);
                                    ?>
                                    <form method="post" action="<?= base_url() ?>products-filter-by-questionaries">
                                        <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                                        <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                                        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                                        <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                                        <input type="hidden" name="message" value="<?php echo $message; ?>" />
                                        <button type="submit">Clear All Filters</button>
                                        <a href="<?=base_url()?>products-filter-by-questionaries"><button style="margin-left: 10px;" type="button">Back</button></a>
                                    </form>
                                    <?php
                                } else if ($basename == 'search') {
                                    unset($_POST['amount_range']);
                                    unset($_POST['brand_id']);
                                    unset($_POST['filter']);
                                    unset($_POST['option']);
                                    ?>
                                    <form method="post" action="<?= base_url('search') ?>">
                                        <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />
                                        <button type="submit">Clear All Filters</button>
                                        <a href="<?=base_url()?>"><button style="margin-left: 10px;" type="button">Back</button></a>
                                    </form>
                                <?php } else { ?>
                                    <form>
                                        <a href="<?= base_url() ?><?= 'sub-cat-products/' . $sub_category->seo_url . '/' . $option_details->seo_url; ?>"><button>Clear All Filters</button></a>
                                        <a href="<?=base_url()?>"><button style="margin-left: 10px;" type="button">Back</button></a>
                                    </form>
                                <?php } ?>

                            </div>
                           
                                <!-- <div class="card mb-3"> -->
                                    <!-- <div class="card-body"> -->
                                        <!-- <div class="widget_list widget_filter"> -->
                                            <!-- <h3>Price</h3> -->
                                            <form method="post" action="<?php
                                            if ($basename == 'products-filter-by-questionaries') {
                                                echo 'products-filter-by-questionaries';
                                            } else if ($basename == 'search') {
                                                echo base_url().'search';
                                            } else {
                                                echo 'sub-cat-products/' . $sub_category->seo_url . '/' . $option_details->seo_url;
                                                // echo base_url().$request_uri_explode[1]."/".$request_uri_explode[2];
                                            }
                                            ?>">
                                                <!-- <div id="slider-range"></div>
                                                <input type="text" name="amount_range" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"/>
                                                <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                                                <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />

                                                <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                                                <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                                                <input type="hidden" name="message" value="<?php echo $message; ?>" />
                                                <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" /> -->

                                        <!-- </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="widget_list widget_brand">
                                            <h3>Brand</h3>
                                            <ul>
                                                <?php
                                                $vals = array_count_values($brands);
                                                $brand = array_unique($brands);


                                                $brand_selected = explode(',', $brand_checked);
                                                //print_r($brand_selected); die;
                                                foreach ($brand as $brand_id) {
                                                    $qry = $this->db->query("select * from attr_brands where id='" . $brand_id . "'");
                                                    $brand_detail = $qry->row();
                                                    $brand_count = $vals[$brand_detail->id];
                                                    ?>
                                                    <li>
                                                        <input type="checkbox" class="questions" name="brand_id[]" value="<?= $brand_detail->id ?>" <?= in_array($brand_detail->id, $brand_selected) ? 'checked' : '' ?>/> <?= $brand_detail->brand_name ?> 
                                                        <!-- <span>(<?= $brand_count ?>)</span> -->
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <?php
                                        $filter_explode = explode(',', $filter);
                                        $option_explode = explode(',', $option);
                                        ?>

                                        <?php
                                        foreach ($unique_filter_ids as $id) {
                                            $filter_title = ($this->common_model->get_data_row(['id' => $id], 'filters'))->title;
                                            $options_arr = [];
                                            ?>
                                            <div class="widget_list widget_brand">

                                                <input type="checkbox" style="display:none" id="<?= $id ?>" name="filter[]" value="<?= $id ?>" <?php
                                                if ($filter_explode) {
                                                    if (in_array($id, $filter_explode)) {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?> />
                                                <h3><?= $filter_title ?></h3>
                                                <ul>
                                                    <?php
                                                    foreach ($filters as $option) {
                                                        if ($id == $option['filter_id']) {
                                                            array_push($options_arr, $option['option']);
                                                        }
                                                    }
                                                    $options = array_unique(explode(',', (implode(',', $options_arr))));
                                                    foreach ($options as $option_id) {
                                                        $option = $this->common_model->get_data_row(['id' => $option_id], 'filter_options');
                                                        $option_name = $option->options;
                                                        ?>
                                                        <li>
                                                            <label class="cust">
                                                                <input type="checkbox" class="questions option_<?= $id ?>" name="option[]" value="<?= $option_id ?>" onchange="chk_filter('<?= $id ?>')" <?php
                                                                if ($option_explode) {
                                                                    if (in_array($option_id, $option_explode)) {
                                                                        echo 'checked';
                                                                    }
                                                                }
                                                                ?> />
                                                                <span class="checkmark1"></span>
                                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span><?= $option_name ?></span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                        <center><button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp;Filter</button></center>
                                        </form>
                                    </div>
                                </div>
                           
                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>
            <?php } ?>
            <div class="fil col-lg-9">
                <div class="row myfilter">
                    <?php
                    if ($products) {
                        foreach ($products as $product) {
                            $qry = $this->db->query("select * from attr_brands where id='" . $product->brand . "'");
                            $brand_detail = $qry->row();
                            ?>
                            <div class="col-lg-3">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><img src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""></a>
                                            <a class="secondary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><img src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""></a>
                                            <div class="label_product">
                                                <?php if ($deals['on_sale'] == "active") { ?>
                                                    <span class="label_sale">Sale</span>
                                                <?php } ?>
                                            </div>
                                            <div class="wishlist">
                                                <a title="<?= ($product->whishlist_status == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite('<?php echo $product->variant->id; ?>')"><span id="favoritecls_<?php echo $product->variant->id; ?>" class="<?php
                                                    if ($product->whishlist_status == true) {
                                                        echo 'fas';
                                                    } else {
                                                        echo 'fal';
                                                    }
                                                    ?> fa-heart"></span></a>
                                            </div>
                                            <div class="add_to_cart">
                                                <?php if ($product->in_cart == 0) { ?>
                                                    <a class="not_in_cart_<?php echo $product->variant->id; ?>" onclick="addtocart('<?php echo $product->variant->id; ?>', '<?php echo $product->shop_id; ?>', '<?php echo $product->variant->saleprice; ?>', '1')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>" style="background: steelblue;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                                <?php } ?>
                                                <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>" style="background: steelblue;display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            </div>

                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_content_inner">
                                                <?php if ($brand_detail->brand_name) { ?><p class="shop-name">Brand: <?php echo $brand_detail->brand_name; ?></p><?php } ?>
                                                <h4 class="product_name"><a href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><?php echo $product->name; ?></a></h4>

                                                <div class="price_box">
                                                    <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->saleprice; ?></span>
                                                    <?php if ($product->variant->saleprice != $product->variant->price) { ?>
                                                        <del><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->price; ?></del>
                                                    <?php } ?>
                                                    <?php if ($product->variant->saleprice != $product->variant->price) { 
                                    $discount = (($product->variant->price - $product->variant->saleprice)/$product->variant->price)*100;?>
                                 <span class="discount" style="color: #FF6200;">(<?php echo round($discount); ?>% OFF)</span>
                                 <?php } ?>
                                                </div>
                                                <div class="quants">
                                 <?php if ($product->in_cart == 0) { ?>

                                    <div id="qty-<?= $product->variant->$variant_id;?>">


                                    <label for="quantity-select-<?php echo $product->variant->$variant_id; ?>" class="mr-2">Quantity:</label>
            <select id="quantity-select-<?php echo $product->variant->$variant_id; ?>" class="select-style quantity_<?php echo $product->variant->$variant_id; ?>" name="quantity" onchange="checkcart_limit(<?php echo $product->variant->$variant_id; ?>)">
    <?php for ($i = 1; $i <= 10; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>
                                    </div>
                                    <?php } ?>
                              </div>
                                            </div>
                                            
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="noproduct">
                            <center>
                                <a href="<?=base_url()?>"><button class="abs-btn"  type="button">Back</button></a>
                                
                            </center>
                            <!-- <h3 style="font-size: 15px;text-align:center;justify-content:center;align-items:center;">No products found</h3> -->
                        </div>   
                        <div class="nopro">    
                        <img src="<?=base_url()?>web_assets/img/noproducts.jpg"/>
                        </div> 

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
                                                        $(function () {
                                                            var min_price = '<?= $min_price ?>';
                                                            var max_price = '<?= $max_price ?>';
                                                            $("#slider-range").slider({
                                                                range: true,
                                                                min: 50,
                                                                max: 5000,
                                                                values: [min_price, max_price],
                                                                slide: function (event, ui) {
                                                                    $("#amount").val("Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ]);
                                                                }
                                                            });
                                                            $("#slider_range_mob").slider({
                                                                range: true,
                                                                min: 50,
                                                                max: 5000,
                                                                values: [min_price, max_price],
                                                                slide: function (event, ui) {
                                                                    $("#amount_mob").val("Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ]);
                                                                }
                                                            });

                                                            $("#amount").val("Rs." + $("#slider-range").slider("values", 0) +
                                                                    " - Rs." + $("#slider-range").slider("values", 1));
                                                            $("#amount_mob").val("Rs." + $("#slider_range_mob").slider("values", 0) +
                                                                    " - Rs." + $("#slider_range_mob").slider("values", 1));
                                                        });

                                                        function chk_filter(filter_id) {
                                                            var already_checked = 0;
                                                            $(".option_" + filter_id).each(function () {
                                                                if ($(this).prop("checked") == true) {
                                                                    already_checked += 1;
                                                                }
                                                            });
                                                            if (already_checked > 0) {
                                                                $("#" + filter_id).prop("checked", true);
                                                                $("#mob_" + filter_id).prop("checked", true);
                                                            } else {
                                                                $("#" + filter_id).prop("checked", false);
                                                                $("#mob_" + filter_id).prop("checked", false);
                                                            }
                                                        }

                                                        function filter_by_brand(brand_id) {
                                                            $('#brand-' + brand_id).submit();
                                                        }
</script>


<script>
      document.addEventListener("DOMContentLoaded", function() {
    // var image="<?php echo $category_title;?>";
    // var myimage=null;
    // image.style.backgroundColor="#2556B9";
            var buttons = document.querySelectorAll(".mylink");
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
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "260px";
    }
    /* Set the width of the side navigation to 0 */
    function closeNavbar() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>