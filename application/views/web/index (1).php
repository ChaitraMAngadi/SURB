<!--header area end-->
<style>
    .product_name{
        overflow: hidden; 
        max-height:3em;
    }
   /* Apply general styles to the select element */
</style>

                                      
<?php 


// echo "<pre>";
// print_r($trending);
// exit;
// echo "<pre>";
// print_r($topdeals);
// exit;

$categorySums = [];
$subcategorySums = [];


// Iterate through topdeals
foreach ($topdeals as $deals) {
    $cat_name = $deals['category_name'];
    $sub_name = $deals['subcategory_name'];
    $orders_placed = $deals['orders_placed'];

    // Increment sums for categories and subcategories
    $categorySums[$cat_name] = isset($categorySums[$cat_name]) ? $categorySums[$cat_name] + $orders_placed : $orders_placed;
    $subcategorySums[$sub_name] = isset($subcategorySums[$sub_name]) ? $subcategorySums[$sub_name] + $orders_placed : $orders_placed;
    
}

// Sort categories and subcategories based on sums in descending order
arsort($categorySums);
arsort($subcategorySums);

// Get the top 3 categories and subcategories
$top3Categories = array_slice($categorySums, 0, 3, true);
$top3Subcategories = array_slice($subcategorySums, 0, 3, true);


// echo "<pre>";
$categorySums1 = [];
$subcategorySums1 = [];

// Iterate through topdeals
foreach ($new_arrival as $deals) {
    $cat_name = $deals['category_name'];
    $sub_name = $deals['subcategory_name'];
    $orders_placed = $deals['orders_placed'];

    // Increment sums for categories and subcategories
    $categorySums1[$cat_name] = isset($categorySums1[$cat_name]) ? $categorySums1[$cat_name] + $orders_placed : $orders_placed;
    $subcategorySums1[$sub_name] = isset($subcategorySums1[$sub_name]) ? $subcategorySums1[$sub_name] + $orders_placed : $orders_placed;
}

// Sort categories and subcategories based on sums in descending order
arsort($categorySums1);
arsort($subcategorySums1);

// Get the top 3 categories and subcategories
$top3Categories1 = array_slice($categorySums1, 0, 3, true);
$top3Subcategories1 = array_slice($subcategorySums1, 0, 3, true);




$categorySums2 = [];
$subcategorySums2 = [];

// Iterate through topdeals
foreach ($trending as $deals) {
    $cat_name = $deals['category_name'];
    $sub_name = $deals['subcategory_name'];
    $orders_placed = $deals['orders_placed'];

    // Increment sums for categories and subcategories
    $categorySums2[$cat_name] = isset($categorySums2[$cat_name]) ? $categorySums2[$cat_name] + $orders_placed : $orders_placed;
    $subcategorySums2[$sub_name] = isset($subcategorySums2[$sub_name]) ? $subcategorySums2[$sub_name] + $orders_placed : $orders_placed;
}

// Sort categories and subcategories based on sums in descending order
arsort($categorySums2);
arsort($subcategorySums2);

// Get the top 3 categories and subcategories
$top3Categories2 = array_slice($categorySums2, 0, 3, true);
$top3Subcategories2 = array_slice($subcategorySums2, 0, 3, true);

// Output the result for the top 3 categories and subcategories
// print_r($top3Categories2);
// print_r($top3Subcategories2);

// exit;
?>
<!--slider area start-->
<?php if (sizeof($banners) > 0) { ?>
    <section class="slider_section slider_s_three">

        <div class="slider_area owl-carousel">
            <?php
            // echo "<pre>"; print_r($banners); die;
            foreach ($banners as $bnr) {
                $cat_seo_url = ($this->common_model->get_data_row(['id' => $bnr['product_details']['cat_id']], 'categories'))->seo_url;
                //print_r($cat_seo_url);die;
                ?>

                        <a href="<?php echo base_url(); ?>bannerproduct/<?php echo $bnr['tag_id']; ?>">

                                                            <!-- <div class="single_slider d-flex align-items-center" data-bgimg="<?php echo $bnr['image']; ?>"> -->
                                                           
                            <div class="single_slider img-fluid">
                          

                                <img src="<?php echo $bnr['image']; ?>" alt="" class="home-slider-img" width="100%" id="loadingImage">



                            </div></a>
                <?php } ?>

        </div>
        <!-- <div>
        <img src="<?php echo $bnr['image']; ?>" alt="" class="home-slider-img" width="100%" id="loadingImage">
        </div> -->

    </section>
<?php } ?>

<!--slider area end-->
<div class="mars" style="display:none;">

    <div class="contains">

        <div class="row">

        <marquee   class="marquee_tag" width="100%" behavior="scroll" scrollamount="5" scrolldelay="50">
            Hey Folks, Thanks for visiting our website!

We are in the testing stage, Will be happy to serve you soon
</marquee>
        </div>
    </div>
</div>
<!-- <div class="vh">
  <div>
   <div class="wrap">
	
	<h2><p>  Hey Folks, Thanks for visiting our website!<br>We are in the testing stage, Will be happy to serve you soon<br><br></p></h2>
	
	</div>
  </div>
</div> -->

<div id="show_errormsg1"></div>


<!--categories product area start-->

<div class="categories_product_area mb-30" style="display: none;">

    <div class="container">

        <div class="row">

            <div class="col-12 mt-5">

                <div class="section_title product_shop_title">

                    <h2>Start shopping by category</h2>
                </div>

            </div>

        </div>

   

        <div class="row  card"  >
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($categories as $k => $category) {
                            ?>

                                <div class="col-lg-2 col-md-3 col-sm-4 col-4 categories_div">
                                    <article class="single_categories">
                                        <figure>
                                            <div class="categories_thumb">
                                                <!-- <?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?> -->
                                                <?php if ($category['sub_cat_rows'] == 0) { ?>
                                                    <?php if (sizeof($category['question']) > 0) { ?>
                                                        <a href="#productQAModal<?php echo $category['id']; ?>" data-toggle="modal"><img src="<?php echo $category['image']; ?>" alt=""></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>"><img src="<?php echo $category['image']; ?>" alt=""></a>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url(); ?>web/view_subcategories/<?php echo $category['seo_url']; ?>"><img src="<?php echo $category['image']; ?>" alt=""></a>
                                            <?php } ?>
                                            </div>
                                            <!-- <figcaption class="categories_content">
                                                <?php if ($category['sub_cat_rows'] == 0) { ?>
                                                    <?php if (sizeof($category['question']) > 0) { ?>
                                                        <h4 class="product_name"><a href="#productQAModal<?php echo $category['id']; ?>" data-toggle="modal"><?php echo $category['title']; ?></a></h4>
                                                <?php } else { ?>
                                                    <h4 class="product_name"><a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></h4>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <h4 class="product_name"><a href="<?php echo base_url(); ?>web/view_subcategories/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></h4>
                                            <?php } ?>
                                            </figcaption> -->
                                        </figure>
                                    </article>
                                </div>
                                <div class="modal fade" id="productQAModal<?php echo $category['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div id="productQAModal"> 
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                
                                                   
                                                   
                                                    <p></p>
        <!--                                                <a href="#" data-dismiss="modal" class="btn-skip"><i class="fal fa-undo"></i> SKIP</a>-->
                                                
                                                <div class="modal-body">

                                                    <div class="row justify-content-end">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-5 align-self-center d-lg-block d-none">
                                                                    <!-- <img src="<?php echo base_url(); ?>web_assets/img/qaside.png" class="img-fluid1"/> -->
                                                                    <!-- <img src="<?php echo base_url(); ?>uploads/<?php $category['question'][0]->app_image; ?>" alt="Image Description"> -->
                                                                    <img src="<?php echo base_url(); ?>uploads/questionaries/<?php echo $category['question'][0]->app_image; ?>"/>

                                                                </div>
                                                                <div class="col-lg-7">
                                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                                                                <span class="head">
                                                                <h4><?php echo $category['question'][0]->question; ?></h4></span>
                                                                <div class="mymodal-content">    
                                                                    <form method="post" id='questionary-form' action="<?php echo base_url(); ?>products-filter-by-questionaries" onsubmit="return chkform()">
                                                                        <input type="hidden" name="cat_id" value="<?php echo $category['id']; ?>">
                                                                        <input type="hidden" name="question_id" value="<?php echo $category['question'][0]->id; ?>">
                                                                        <?php if (!empty($category['question'][0]->sub_cat_id) && $category['question'][0]->sub_cat_id > 0) { ?>
                                                                            <input type="hidden" name="sub_cat_id" value="<?php echo $category['question'][0]->sub_cat_id; ?>">
                                                                    <?php } ?>
                                                                        <div class="row qaoptions1">

                                                                            <?php
                                                                            $ques_id = $category['question'][0]->id;
                                                                            $options = $this->common_model->get_data_with_condition(['ques_id' => $ques_id], 'options');
                                                                            foreach ($options as $key => $val) {
                                                                                ?>
                                                                                <div class="col-md-12 font">
                                                                                    <label class="custradiobtn"><?php echo $val->option; ?>
                                                                                        <input type="checkbox" onchange="chkbox(this, '<?php echo $k; ?>')" class="options" name="ques_options[]" value="<?php echo $value->id; ?>">
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </div>
                                                                        <?php } ?>
                                                                            <div class="col-md-12 font">
                                                                                <label class="custradiobtn">Others
                                                                                    <input type="checkbox" onchange="msgbox(this, '<?php echo $k; ?>')" class="other" name="ques_options[]" value="other">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>

                                                                            <div class="col-md-12 msgothers" id="message-<?php echo $k; ?>" style="display:none;">
                                                                                <input type="text" name="message" id="message-input-<?php echo $k; ?>"  placeholder="Please enter your issues..." class="othersmsg"/>
                                                                            </div><br>
                                                                            <div class="modal-buttons" style="display:flex;gap:1.3rem;">
                                                                               
                                                                                <a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>"  class="btn btn-outline-primary text-primary btn-lg skip-btn" onmouseover="this.style.color = 'blue'" onmouseout="this.style.color = 'blue'">SKIP</a>
                                                                                <button type="submit"class="btn text-white  btn-lg float-right sub-btn">Submit</button>
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
                                </div>
                        <?php }
                        ?>



                        <!--            <div class="product_carouseld product_column4d owl-carouseld">
                                    </div>-->

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!--categories product area end-->

<!--banner area start-->
<?php if (sizeof($bannerads) > 0) { ?>
    <div class="banner_area banner_area3 mb-5">

        <div class="container">

            <div class="row">
                <!--            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="#">
                                    <div class="single_banner">
                                        <div class="banner_thumb">
                                            <img src="https://colormoon.in/absolute_mens_new/uploads/banners/202204221532559461469_add_1.png" alt="">
                                        </div>
                                        <h4>Flat 30% OFF</h4>
                                    </div>
                                </a>
                            </div>-->
                <?php
                foreach ($bannerads as $banner) {
                    $cat_seo_url = ($this->common_model->get_data_row(['id' => $banner['product_details']['cat_id']], 'categories'))->seo_url;
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">

                        <a href="<?php echo base_url(); ?>bannerproduct/<?php echo $banner['random_number']; ?>">

                            <div class="single_banner">

                                <div class="banner_thumb">

                                    <img src="<?php echo $banner['image']; ?>" alt="">

                                </div>
                                <h4><?php echo $banner['flat_discount']; ?></h4>
                            </div>
                        </a>
                    </div>

                <?php } ?>



                <!-- <div class="col-lg-4 col-md-4 col-sm-6">

                    <div class="single_banner">

                        <div class="banner_thumb">

                            <a href="#"><img src="<?php echo base_url(); ?>web_assets/img/add-2.jpg" alt=""></a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">

                    <div class="single_banner col3">

                        <div class="banner_thumb">

                            <a href="#"><img src="<?php echo base_url(); ?>web_assets/img/add-3.jpg" alt=""></a>

                        </div>

                    </div>

                </div> -->

            </div>

        </div>

    </div>
<?php } ?>
<!--banner area end-->


<!--product area start-->
<!--<div id="top_fav_msg" style="text-align: center; padding: 10px;"></div>-->
<?php if (sizeof($topdeals) > 0) { ?>
    <div class="product_area  mb-5" style="display: none;">

        <div class="container-fluid">

            <!-- <div class="row"> -->

                <!-- <div class="col-12"> -->

                    <!-- <div class="section_title product_shop_title"> -->

                        <!-- <h2>Top Deals</h2> -->
                        
                        <!-- <a href="<?php echo base_url() ?>web/viewallProducts/topdeals" class="btn btn-sm pink-btn float-right"> View All </a> -->
                    <!-- </div> -->

                <!-- </div> -->

            <!-- </div> -->

            <div class="row mygrid">
            
            <div class="top">
                    <div style=" position: relative;">
                    <img src="<?php echo base_url(); ?>uploads/images/Top-deals.png" class="topdealsimage">
                    <div class="text-overlay"><h2 class="absolute">AbsoluteMen</h2>
                    
                    <span class="top-deals">Top deals</span>
                    <a href="<?php echo base_url() ?>web/viewallProducts/topdeals" class="btn btn-light  bottom"> View All</a> 
                    </div>
                </div> 
                
                    </div>
                    
            <div class="product_carousel product_column5 owl-carousel col-lg-9 col-md-12 col-xs-12 col-sm-12 col-12">
           
           
                    <?php  
                    // echo "<pre>";
                    $count_arr = array();
                    $max1 = array('orders_placed' => 0);
                    $max2 = array('orders_placed' => 0);
                    $max3 = array('orders_placed' => 0);
                   
                    foreach ($topdeals as $deals) {
                        // $order_count_arr[]=$deals['order_count'];
                            // sort($order_count_arr);
                       
                        // print_r("order count".$deals['order_count']);
                         
                        ?>

                                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 col-3">
                                    <article class="single_product">
                                        <figure>
                                            <div class="product_thumb">
                                                <a class="primary_img" href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                                <a class="secondary_img" href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                                <!-- <div class="label_product"> -->
                                                <?php  
                                                // foreach($arr as $a){
                                                    // 
                                                    // if($a['max1']==$deals['order_count']){?>
                                                      <!-- <span class="label_sale">Best seller</span> -->
                                                    <?php 
                                                    // }
                                                    // else if($a['max2'] ==$deals['order_count']){?>
                                                        <!-- <span class="label_sale">Best seller</span> -->
                                                   <?php 
                                                //    }
                                                    // else if($a['max3']== $deals['order_count']){?>
                                                       <!-- <span class="label_sale">Best seller</span> -->
                                                   <?php 
                                                //    }
                                                // }
                                                
                                               
?>  
<!-- </div> -->

                                                <div class="label_product">
                                                <?php 


$count_arr[] = $deals['orders_placed'];

// Update the maximum values
if ($deals['orders_placed'] > $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $deals['orders_placed']);
} elseif ($deals['orders_placed'] > $max2['orders_placed'] && $deals['orders_placed'] < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $deals['orders_placed']);
} elseif ($deals['orders_placed'] > $max3['orders_placed'] && $deals['orders_placed'] < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $deals['orders_placed']);
}

$cat_name = $deals['category_name'];
$sub_name = $deals['subcategory_name'];
// echo $deals['orders_placed'];
if (isset($top3Categories[$cat_name]) && isset($top3Subcategories[$sub_name]) &&
    ($deals['orders_placed'] == $max1['orders_placed'] ||
     $deals['orders_placed'] == $max2['orders_placed'] ||
     $deals['orders_placed'] == $max3['orders_placed'])&& ($deals['orders_placed']!=null || $deals['orders_placed']!=''|| $deals['orders_placed']!=0)) {
    // echo $deals['orders_placed'];?>
    <span class="label_sale">Best seller</span>
<?php } ?>

                                                  
                                                   
                                            
                                                </div>
                                      
                                                <div class="wishlist">
                                                    <a title="<?= ($deals['whishlist_status'] == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite(<?php echo $deals['variant_id']; ?>)"><span id="" class="<?php
                                                               if ($deals['whishlist_status'] == true) {
                                                                   echo 'fas';
                                                               } else {
                                                                   echo 'fal';
                                                               }
                                                               ?> fa-heart favoritecls_<?php echo $deals['variant_id']; ?>"></span></a>
                                                </div>
                                                 
                                              <div class="add1">
                                                <?php



   
foreach($rating as $rat){
if($deals['id']==$rat['product_id']){

   
    

     // Print the rating
     ?>
     <div class="starrating">
         <span class="rating-number"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
     </div>
     <?php

    
}    
}

?>
                                             
                                             

                                               
                             
                                      
                                      
                                        
                                                <div class="add_to_cart d-lg-block d-md-block d-sm-none d-none">
                                                    <?php if ($deals['in_cart'] == 0) { ?>
                                                        <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>

                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            
                                                </div>
                                              </div>
                                            </div>
                                            <div class="add2">
                                                <?php



   
foreach($rating as $rat){
if($deals['id']==$rat['product_id']){

   
    

     // Print the rating
     ?>
     <div class="starrating1 rating_add">
         <span class="rating-number1"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol1"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
     </div>
     <?php

    
}    
}

?>
                                             
                                             

                                               
                             
                                      
                                      
                                        
                                                <div class="add_to_cart d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                                                    <?php if ($deals['in_cart'] == 0) { ?>
                                                        <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>

                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            
                                                </div>
                                                </div>
                                            <figcaption class="product_content">
                                                <div class="product_content_inner">
                                                    
                                                <div class="product-info">
                                                    <?php if ($deals['brand']) { ?>
                                                        <p class="shop-name">Brand: <?php echo $deals['brand']; ?></p>
                                                <?php } ?>
                                                    <h4 class="product_name" title="<?php echo $deals['name']; ?>"><a href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><?php echo $deals['name']; ?></a></h4>

                                                                                                                                                                                                               <!--                                        <p class="shop-name"><?php echo $deals['shop']; ?></p>-->
                                                    <div class="price_box">
                                                        <span class="current_price"> Rs. <?php echo $deals['saleprice']; ?></span>
                                                        <?php if ($deals['saleprice'] != $deals['price']) { ?>
                                                            <del>Rs. <?php echo $deals['price']; ?></del>
                                                    <?php } ?>
                                                    <span class="discount"><?php $offer = ($deals['price'] - $deals['saleprice']) * 100 / $deals['price'];
    if(!$offer==0){
        echo "(" . round($offer) . "% off)";
    }
             ?></span>
                                            </div></div><?php 
                                            // print_r($deals['cart_limit']);?>
                                            <div class="product_variant quantity">
    <?php if ($deals['in_cart'] == 0) { ?>
        <div id="qty-<?= $deals['variant_id'] ?>">
            <label for="quantity-select-<?php echo $deals['variant_id']; ?>" class="mr-2">Quantity:</label>
            <select id="quantity-select-<?php echo $deals['variant_id']; ?>" class="select-style quantity_<?php echo $deals['variant_id']; ?>" name="quantity" onchange="checkcart_limit(<?php echo $deals['variant_id']; ?>)">
            <?php 
            $stock=$deals['stock'];
            $cart_limit=$deals['cart_limit'];
            // $limit = $deals['stock'] < 10 ? $deals['stock']:10;
            if($stock<$cart_limit){
                $limit=$stock;
            }
            else{
                $limit = $cart_limit <= 10  || $cart_limit <= $stock? $cart_limit :10;
            }?>
    <?php for ($i = 1; $i <= $limit; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>

        </div>
    </div>
    <?php } ?>
                                                    
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </article>

                                   
                                </div>
                                <?php
                    }
                    // exit;
                    ?>

                </div>

            </div>

        </div>

    </div>
    <!--products toneswari added-->

    <?php if (sizeof($new_arrival) > 0) { ?>
<div class="product_area  mb-5 container-fluid" style="display: none;">


<div class="row mygrid">
 <div class="new-arrivals">
                  <div class="newarrivaldirection">
                   <div class="arrived"> 
                    <span class="new">NEW</span><span><lottie-player src="web_assets/js/68064-success-celebration.json" class="lot" background="transparent" speed="1"  loop autoplay></lottie-player></span></div>
                    <div class="viewbutton">
                   <span class="arrival">ARRIVALS</span>
                   <a href="<?php echo base_url() ?>web/viewallProducts/new_arrival" class="btn btn-outline-primary view"> View All</a>
                </div>
                </div>
                    
                </div> 
  
            <div class="row">
                <div class="product_carousel product_column2 owl-carousel col-lg-9 col-md-12 col-xs-12 col-sm-12 col-12" id="topdeals">

                <?php
                                    $count_arr = array();
                                    $max1 = array('orders_placed' => 0);
                                    $max2 = array('orders_placed' => 0);
                                    $max3 = array('orders_placed' => 0);
                    foreach ($new_arrival as $deals) {
                        ?>

                                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 col-3">
                                    <article class="single_product">
                                        <figure>
                                            <div class="product_thumb">
                                                <a class="primary_img" href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                                <a class="secondary_img" href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                                <div class="label_product">
                                                 
                                                <?php 


$count_arr[] = $deals['orders_placed'];

// Update the maximum values
if ($deals['orders_placed'] > $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $deals['orders_placed']);
} elseif ($deals['orders_placed'] > $max2['orders_placed'] && $deals['orders_placed'] < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $deals['orders_placed']);
} elseif ($deals['orders_placed'] > $max3['orders_placed'] && $deals['orders_placed'] < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $deals['orders_placed']);
}

$cat_name = $deals['category_name'];
$sub_name = $deals['subcategory_name'];
// echo $deals['orders_placed'];
if (isset($top3Categories1[$cat_name]) && isset($top3Subcategories1[$sub_name]) &&
    ($deals['orders_placed'] == $max1['orders_placed'] ||
     $deals['orders_placed'] == $max2['orders_placed'] ||
     $deals['orders_placed'] == $max3['orders_placed'])&& ($deals['orders_placed']!=null || $deals['orders_placed']!=''|| $deals['orders_placed']!=0)) {
    // echo $deals['orders_placed'];?>
    <span class="label_sale">Best seller</span>
<?php } ?>

                                                    
                                                </div>
                                                <!-- <div class="label_product"> -->
                                                <?php  
                                                // foreach($arr as $a){
                                                    // if($a['max1']==$deals['order_count']){?>
                                                      <!-- <span class="label_sale">Best seller</span> -->
                                                    <?php 
                                                    // }
                                                    // else if($a['max2'] ==$deals['order_count']){?>
                                                        <!-- <span class="label_sale">Best seller</span> -->
                                                   <?php 
                                                //    }
                                                    // else if($a['max3']== $deals['order_count']){?>
                                                       <!-- <span class="label_sale">Best seller</span> -->
                                                   <?php 
                                                //    }
                                                // }
                                                
                                               
?> 
 <!-- </div> -->
                                                <div class="wishlist">
                                                    <a title="<?= ($deals['whishlist_status'] == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite(<?php echo $deals['variant_id']; ?>)"><span class="<?php
                                                               if ($deals['whishlist_status'] == true) {
                                                                   echo 'fas';
                                                               } else {
                                                                   echo 'fal';
                                                               }
                                                               ?> fa-heart favoritecls_<?php echo $deals['variant_id']; ?>"></span></a>
                                                </div>
                                                <div class="add1">   <?php



   
foreach($rating1 as $rat){
if($deals['id']==$rat['product_id']){

   
    

     // Print the rating
     ?>
     <div class="starrating">
         <span class="rating-number"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
     </div>
     <?php

    
}    
}

?>                                                 <div class="add_to_cart d-lg-block d-md-block d-sm-none d-none">
                                                    <?php if ($deals['in_cart'] == 0) { ?>
                                                        <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>
                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                                </div>

                                            </div></div>
                                            <div class="add2">
                                                <?php



   
foreach($rating1 as $rat){
if($deals['id']==$rat['product_id']){

   
    

     // Print the rating
     ?>
     <div class="starrating1 rating_add">
         <span class="rating-number1"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol1"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
     </div>
     <?php

    
}    
}

?>
                                             
                                             

                                               
                             
                                      
                                      
                                        
                                                <div class="add_to_cart d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                                                    <?php if ($deals['in_cart'] == 0) { ?>
                                                        <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>

                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            
                                                </div>
                                                </div>
                                            <figcaption class="product_content">
                                                <div class="product_content_inner">
                                                <div class="product-info">
                                                    <?php if ($deals['brand']) { ?>
                                                        <p class="shop-name">Brand: <?php echo $deals['brand']; ?></p>
                                                <?php } ?>
                                                    <h4 class="product_name" title="<?php echo $deals['name']; ?>"><a href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><?php echo $deals['name']; ?></a></h4>

                                                <!-- <p class="shop-name"><?php echo $deals['shop']; ?></p> -->
                                                    <div class="price_box">
                                                        <span class="current_price">Rs.
                                                            <!-- <i class="fal fa-rupee-sign"></i> -->
                                                             <?php echo $deals['saleprice']; ?></span>
                                                        <?php if ($deals['saleprice'] != $deals['price']) { ?>
                                                            <del>Rs.
                                                                <!-- <i class="fal fa-rupee-sign"></i> -->
                                                                 <?php echo $deals['price']; ?></del>
                                                    <?php } ?>
                                                    <span class="discount"><?php $offer = ($deals['price'] - $deals['saleprice']) * 100 / $deals['price'];
    if(!$offer==0){
        echo "(" . round($offer) . "% off)";
    }
             ?></span>
                                                    </div>
                                                   
                                                </div>
                                                    <div class="product_variant quantity">
    <?php if ($deals['in_cart'] == 0) { ?>
        <div id="qty-<?= $deals['variant_id'] ?>">
            <label for="quantity-select-<?php echo $deals['variant_id']; ?>" class="mr-2">Quantity:</label>
            <select id="quantity-select-<?php echo $deals['variant_id']; ?>" class="select-style quantity_<?php echo $deals['variant_id']; ?>" name="quantity" onchange="checkcart_limit(<?php echo $deals['variant_id']; ?>)">
            <?php 
            $stock=$deals['stock'];
            $cart_limit=$deals['cart_limit'];
            // $limit = $deals['stock'] < 10 ? $deals['stock']:10;
            if($stock<$cart_limit){
                $limit=$stock;
            }
            else{
                $limit = $cart_limit <= 10  || $cart_limit <= $stock? $cart_limit :10;
            }?>
            <?php for ($i = 1; $i <= $limit; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>

        </div>
    </div>
    <?php } ?>
                                                </div>
                                       
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>
                                <?php
                    }
                    ?>

                </div>

            </div>

        

    
<?php } ?>
            
                   
         

    

  </div>
        

    </div>
 <!--products toneswari added-->
 <?php } ?>
<!--product area end-->
<?php if (sizeof($lastbannerads) > 0) { ?>
    <div class="container my-5">
        <div class="row">
            <?php
            foreach ($lastbannerads as $lastbanner) {
                $cat_seo_url = ($this->common_model->get_data_row(['id' => $lastbanner['product_details']['cat_id']], 'categories'))->seo_url;
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">

                    <a href="<?php echo base_url(); ?>bannerproduct/<?php echo $lastbanner['random_number']; ?>">

                        <div class="single_banner">
                            <div class="banner_thumb">
                                <img src="<?php echo $lastbanner['image']; ?>" alt="" style="width: 100%;height: 200px;">
                            </div>
                            <h4><?php echo $lastbanner['flat_discount']; ?></h4>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <!--        <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="#">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <img src="<?php echo base_url(); ?>web_assets/img/add-5.png" alt="" class="img-fluid">
                                </div>
                                <h4>Flat 30% OFF</h4>
                            </div>
                        </a>
                    </div>-->
        </div>
    </div>
<?php } ?>


    
        <div class="bloom" style="display:none;">
    <img src="<?php echo base_url(); ?>uploads/images/bloom.png" class="bloomimage">
            </div>

    
<!--trending offers start-->
<?php if (sizeof($trending) > 0) { ?>
    <div class="product_area  mb-5" style="display: none;">

        <div class="container">

<!--             
                    <div class="section_title product_shop_title">

                        <h2  class="trending" >Trending offers</h2>
                        <a href="<?php echo base_url() ?>web/viewallProducts/trending" class="btn btn-sm pink-btn float-right"> View All </a>
                    </div> -->

                




            <!-- <div class="toast" id="show_errormsg_trending" style="color: green; text-align: center;"> -->
            <!-- <div class="toast" id="show_errormsg_trending" style="color: green; text-align: center; margin:0px auto;">
                <div class="toast-header">
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div>
                 <div class="toast-body">
                    Product Added to cart
                </div>
            </div> -->
            <div class="row trend">
 <div  class="trends">
                  <div class="mytrends">
   

                  <div  class="trending">Trending</div>
                   <div class="myoffers">
                  
                  
                  
                  <span class="offers">offers</span>
                  <lottie-player src="web_assets/js/fzArE0uDLx.json" background="transparent" speed="1" class="lots" loop autoplay></lottie-player>    
                  </div>

    
                        <!-- <a href="<?php echo base_url() ?>web/viewallProducts/trending" class="btn btn-sm pink-btn float-right"> View All </a> -->
                        <!-- <span style="flex: 1;float:left;" > <img src="uploads/images/trendingoffers.png"  style="backgound-color:orange;width: 50px; /* Adjust the width as per your preference */
  height: auto;float:left;"></span> -->
                </div>
                    
                </div>
               <div class="forview">
                <div class="card-container">

                    <?php $counter = 0;
                     $count_arr = array();
                     $max1 = array('orders_placed' => 0);
                     $max2 = array('orders_placed' => 0);
                     $max3 = array('orders_placed' => 0);
                    foreach ($trending as $deals) {
                        $counter++;
                        if ($counter > 10) {
                            break;
                        }
                        ?>
                        
                        <div class="productcard">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb" >
                                        <a class="primary_img" href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                        <a class="secondary_img" href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                        <!-- <div class="label_product"> -->
                                                <?php  
                                                // foreach($t as $a){
                                                    // if($a['max1']==$deals['order_count']){?>
                                                      <!-- <span class="label_sale">Best seller</span> -->
                                                    <?php 
                                                    // }
                                                    // else if($a['max2'] ==$deals['order_count']){?>
                                                        <!-- <span class="label_sale">Best seller</span> -->
                                                   <?php 
                                                //    }
                                                    // else if($a['max3']== $deals['order_count']){?>
                                                       <!-- <span class="label_sale">Best seller</span> -->
                                                   <?php 
                                                //    }
                                                // }
                                                
                                               
?>  
<!-- </div> -->
<div class="label_product">
<?php 


$count_arr[] = $deals['orders_placed'];

// Update the maximum values
if ($deals['orders_placed'] > $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $deals['orders_placed']);
} elseif ($deals['orders_placed'] > $max2['orders_placed'] && $deals['orders_placed'] < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $deals['orders_placed']);
} elseif ($deals['orders_placed'] > $max3['orders_placed'] && $deals['orders_placed'] < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $deals['orders_placed']);
}

$cat_name = $deals['category_name'];
$sub_name = $deals['subcategory_name'];
// echo $deals['orders_placed'];
if (isset($top3Categories2[$cat_name]) && isset($top3Subcategories2[$sub_name]) &&
    ($deals['orders_placed'] == $max1['orders_placed'] ||
     $deals['orders_placed'] == $max2['orders_placed'] ||
     $deals['orders_placed'] == $max3['orders_placed']) && ($deals['orders_placed']!=null || $deals['orders_placed']!=''|| $deals['orders_placed']!=0)) {
    // echo $deals['orders_placed'];?>
    <span class="label_sale">Best seller</span>
<?php } ?>

</div>
                                        <!-- <div class="label_product"> -->
                                             <?php 
                                            //  if ($deals['saleprice'] < $deals['price']) { ?>
                                                <!-- <span class="label_sale">Best Seller</span> -->
                                                
                                            <?php 
                                        // } ?> 
                                        <!-- </div> -->
                                        <div class="wishlist">
                                            <a title="<?= ($deals['whishlist_status'] == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite(<?php echo $deals['variant_id']; ?>)"><span class="<?php
                                                       if ($deals['whishlist_status'] == true) {
                                                           echo 'fas';
                                                       } else {
                                                           echo 'fal';
                                                       }
                                                       ?> fa-heart favoritecls_<?php echo $deals['variant_id']; ?>"></span></a>
                                        </div>
                                  <div class="add1">      <?php



   
foreach($rating2 as $rat){
if($deals['id']==$rat['product_id']){

   
    

     // Print the rating
     ?>
     <div class="starrating">
         <span class="rating-number"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
     </div>
     <?php

    
}    
}

?>

                                        <div class="add_to_cart  d-lg-block d-md-block d-sm-none d-none">
                                            <?php if ($deals['in_cart'] == 0) { ?>
                                                <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')"> Add to cart</a>
                                            <?php } else { ?>
                                                <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>
                                            <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                        </div>

                                    </div></div>

                                    <div class="add2">
                                                <?php



   
foreach($rating2 as $rat){
if($deals['id']==$rat['product_id']){

   
    

     // Print the rating
     ?>
     <div class="starrating1 rating_add">
         <span class="rating-number1"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol1"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
     </div>
     <?php

    
}    
}

?>
                                             
                                             

                                               
                             
                                      
                                      
                                        
                                                <div class="add_to_cart d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                                                    <?php if ($deals['in_cart'] == 0) { ?>
                                                        <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>

                                                    <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            
                                                </div>
                                                </div>
                                    <figcaption class="product_content">
                                        <div class="product_content_inner">
                                        <div class="product-info">
                                            <?php if ($deals['brand']) { ?>
                                                <p class="shop-name">Brand: <?php echo $deals['brand']; ?></p>
                                            <?php } ?>
                                            <h4 class="product_name" title="<?php echo $deals['name']; ?>"><a href="<?php echo base_url(); ?>p/<?php echo $deals['name']; ?>/<?php echo $deals['meta_tag_keywords']; ?>/<?php echo $deals['descp']; ?>" target="_blank"><?php echo $deals['name']; ?></a></h4>
                                           
                                                      
                                            <div class="price_box">
                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $deals['saleprice']; ?></span>
                                                <?php if ($deals['saleprice'] != $deals['price']) { ?>
                                                    <del><i class="fal fa-rupee-sign"></i> <?php echo $deals['price']; ?></del>
                                                <?php } ?>
                                                <span class="discount"><?php $offer = ($deals['price'] - $deals['saleprice']) * 100 / $deals['price'];
    if(!$offer==0){
        echo "(" . round($offer) . "% off)";
    }
             ?></span>
                                            </div> </div><?php 
                                            // print_r($deals['stock']);?>
                                            <div class="myquant">
    <?php if ($deals['in_cart'] == 0) { ?>
        <div id="qty-<?= $deals['variant_id'] ?>">
            <label for="quantity-select-<?php echo $deals['variant_id']; ?>" class="mr-2">Quantity:</label>
            <select id="quantity-select-<?php echo $deals['variant_id']; ?>" class="select-style quantity_<?php echo $deals['variant_id']; ?>" name="quantity" onchange="checkcart_limit(<?php echo $deals['variant_id']; ?>)">
            <?php  $stock=$deals['stock'];
            $cart_limit=$deals['cart_limit'];
            
            if($stock<$cart_limit){
                $limit=$stock;
            }
            else{
                $limit = $cart_limit <= 10  || $cart_limit <= $stock? $cart_limit :10;
            }
           
            // $limit = $deals['stock'] < 10 ? $deals['stock']:10;
            // $limit = $cart_limit <= 10  && $cart_limit <= $stock? $cart_limit :10;?>
    <?php for ($i = 1; $i <= $limit; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>
        </div>
    </div>
    <?php } ?>
                                           
                                        </div>
                                       
                                    </figcaption>
                                </figure>
                            </article>


                          

                        </div>
                        
                    <?php } ?><br>
              
                

                   
            </div>
            <span><a href="<?php echo base_url(); ?>web/viewallProducts/trending" class="viewall">View All</a></span>
            </div>
            
              





            
        </div>

    </div>
<?php } ?>

<!--close trending offers-->


<?php if (sizeof($partners) > 0) { ?>



<div class="container-fluid parts" style="display:none;">
    <div class="row">
        <div class="col-lg-12">
            <div class="section_title product_shop_title">
                <h2>Our Partners</h2>
            </div>
        </div>
    </div>
    <div class="row pb-5 part">
        <div class="col-lg-12">
            <div class="carousel partners-scroll owl-carousel" >
                <!-- <div class="partners"> -->
                <?php 
                // $count=0;
                foreach ($partners as $row) {   
                    // $count++;?>
                   
                    <!-- <div class="item"><img src="<?= base_url('uploads/our_partners/') . $row->image ?>" alt=""></div> -->
                    <div class="myitem"><img src="<?= base_url('uploads/our_partners/') . $row->image ?>" alt=""></div>
            <?php } ?><?php print_r($count);?>
            <!-- </div> -->
                </div>
        </div>
    </div>
</div>
<?php } ?>
<br><br>

<!-- <?php if (sizeof($partners) > 0) { ?>



<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="section_title product_shop_title">
                <h2 style="text-align:center;justify-content:center;">Our Customer's Feedback</h2><br>
                <h4 style="color:blue;text-align:center;">What Our Customer's are Saying</h4><br>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-lg-12">
            <div class="product_carousel partners-scroll owl-carousel" >
                <?php foreach ($partners as $row) { ?>
                    <div class="item"><img src="<?= base_url('uploads/our_partners/') . $row->image ?>" alt=""></div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?> -->





<?php 
// if ($home_video->home_video_status == 1) { ?>
    <!-- <section class="videosection"> -->
        <!-- <div class="circle-1"></div> -->
        <!-- <div  class="circle-2"></div> -->
        <!-- <div class="container pb-5" style="position: relative;"> -->
        <!-- <div class="row justify-content-center"> -->
            <!-- <div class="col-lg-7"> -->
                <!-- <div class="videoborder shadow"> -->
                    <!-- <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $home_video->home_video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
    <!-- </section> -->
<?php 
// } ?>
<?php if (sizeof($testimo) > 0) { ?>
    <div class="container">
        <div class="row">

            <div class="col-12 mt-5">

                <div class="section_title product_shop_title">

                    <h2>Testimonials</h2>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12">
                <div class="product_carousel testimonial_collumn1 owl-carousel">
                    <?php
                    foreach ($testimo as $value) {
                        if ($value->status == '1') {
                            ?>
                            <div class="testimonial">
                                <p class="description"><?= $value->description; ?></p>
                                <div class="pic">
                                    <img src="<?= base_url() ?>uploads/testimonials/<?= $value->image ?>" alt="">
                                </div>
                                <h3 class="testimonial-title">
                                    <span><?= $value->name; ?></span>
                                    <small><?= $value->designation; ?></small>
                                </h3>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!--<a onclick="addtocart123()" > Add to cart</a>-->


<script type="text/javascript">

    function addFavorite_NEW(pid)
    {
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        if (user_id == '')
        {
            $('#loginModal').modal('show');
            return false;
        } else
        {
            $.ajax({
                url: "<?php echo base_url(); ?>web/add_most_viewed_removewhishList",
                method: "POST",
                data: {pid: pid},
                success: function (data)
                {

                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    //location.reload();
                    //$("#trending_now").load(location.href + " #trending_now");
                    /*$('html, body').animate({
                     scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                     }, 'slow');*/
                    if (res[1] == 'remove')
                    {

                        /*$("#topdeals").load(location.href + " #topdeals");
                         $('#top_fav_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Removed from the Favourites</span>');
                         $('#top_fav_msg').focus();
                         location.reload();
                         return false;*/
                        $("#rendingfavorites_" + pid).removeClass("fas");
                        $("#rendingfavorites_" + pid).addClass("fal");

                    } else if (res[1] == 'add')
                    {

                        /*$('#top_fav_msg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Added to Favourites</span>');
                         $('#top_fav_msg').focus();
                         
                         location.reload();
                         return false;*/


                        $("#rendingfavorites_" + pid).removeClass("fal");
                        $("#rendingfavorites_" + pid).addClass("fas");
                    }



                }
            });
        }
    }
</script>





<!--product area start-->

<section class="blog_section d-none">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="section_title product_shop_title">

                    <h2>Nearest Stores</h2>
                    <a href="<?php echo base_url() ?>web/viewallshops" class="btn btn-sm pink-btn float-right"> View All </a>
                </div>



            </div>

        </div>

        <div class="row ">

            <div class="blog_carousel blog_column3 owl-carousel storesnearbox pt-2">

                <?php foreach ($shops as $shop) { ?>

                        <div class="col-lg-4">

                            <div class="card shadow-sm mb-3">

                                <div class="img-box">

                                    <a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop"><img src="<?php echo $shop['image']; ?>" alt="" class="card-img-top"></a>

                                    <h5><i class="fal fa-badge-percent"></i> <?php echo $shop['deal_products']; ?> DEALS</h5>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-lg-12">

                                            <h4><a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop"><?php echo $shop['shop_name']; ?></a></h4>

                                            <p><?php echo substr($shop['description'], 0, 40) . "..."; ?></p>

                                            <p><i class="fal fa-map"></i> <?php echo $shop['address']; ?></p>

                                        </div>

                                    </div>

                                </div>

                                <div class="card-footer">

                                    <div class="row">

                                        <div class="col-lg-6"><p><small><i class="fal fa-map-marker-alt"></i> <?php echo $shop['distance']; ?>Km</small></p></div>

                                        <div class="col-lg-6 text-right"><a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop"><p class="pinkcol"><small><?php echo $shop['product_total']; ?> Products</small></p></a></div>

                                    </div>

                                </div>

                            </div>

                        </div>
                <?php } ?>




            </div>

        </div>

    </div>
    <?php
    $session_id = $_SESSION['session_data']['session_id'];
    $user_id = $_SESSION['userdata']['user_id'];
    $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
    $cart_count = $cart_qry->num_rows();
    ?>

</section>
<!--discount banner area start-->

<!-- <div class="discount_banner_area">

    <div class="container-fluid p-0">

        <div class="banner_thumb">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <a <?php if ($lastbannerads['type'] == 'shops') { ?> href="<?php echo base_url(); ?>web/store/<?php echo $lastbannerads['product_details']['seo_url']; ?>" <?php } else { ?>href="<?php echo base_url(); ?>p/<?php echo $lastbannerads['product_details']['name']; ?>"<?php } ?>><img src="<?php echo $lastbannerads['image']; ?>" alt="" class="img-fluid"></a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="banner_text3">

                <h3><?php echo $lastbannerads['title']; ?></h3>

                <h2>up TO 40% off</h2>

                <p>An exclusive selection of this season’s trends. <span>Exclusively online!</span></p>

                <a <?php if ($lastbannerads['type'] == 'shops') { ?> href="<?php echo base_url(); ?>web/store/<?php echo $lastbannerads['product_details']['seo_url']; ?>" <?php } else { ?>href="<?php echo base_url(); ?>p/<?php echo $lastbannerads['product_details']['name']; ?>"<?php } ?>>shop now</a>

            </div>
                </div>
            </div>




        </div>

    </div>

</div> -->






<?php
$session_id = $_SESSION['session_data']['session_id'];
$user_id = $_SESSION['userdata']['user_id'];
$cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
$cart_count = $cart_qry->num_rows();
?>




<!--discount banner area end-->






<script  async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script  src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $('.single_product').hover(function() {
        $('.starrating').hide();
    }, function() {
        $('.starrating').show();
    });
});
</script> -->

<script>

// $(document).ready(function() {
//     // Select the .categories_div element
//     var categories_div = $('.categories_div');

//     // Use setTimeout to create a delay of 2 seconds (2000 milliseconds)
//     setTimeout(function() {
//         // Your code to be executed after 2 seconds
//         // For example, you can do something with categories_div here
//         categories_div.addClass('categories_div');
//     }, 2000);
// });

    function chkform() {
        var already_checked = 0;
        $(".options").each(function () {
            if ($(this).prop("checked") == true) {
                $('.other').prop('checked', false);
                already_checked += 1;
            }
        });

        if ($('.other').prop("checked") == true) {
            already_checked += 1;
        }

        if (already_checked > 0) {
            return true;
        } else {
            toastr.error('Select atleast one option from the list to proceed');
            return false;
        }
        $('#questionary-form').trigger("reset");
    }

    function msgbox(ele, key) {
        if ($(ele).prop("checked") == true) {
            $('.options').prop('checked', false);
            $('.other').prop('checked', true);
            $('#message-' + key).show();
            $('#message-input-' + key).prop('required', true);
        } else {
            $('#message-' + key).hide();
            $('#message-input-' + key).prop('required', false);
        }
    }

    function chkbox(ele, key) {
        if ($(ele).prop("checked") == true) {
            $('.other').prop('checked', false);
            $('#message-' + key).hide();
            $('#message-input-' + key).val('');
            $('#message-input-' + key).prop('required', false);
        }
    }

   
//                     $(document).ready(function() {
//   $(".product_carousel").owlCarousel({
//     // items: 3, // Set the number of visible slides (3 or 4)
//     loop: true,
//     nav: true, // Add navigation buttons if desired
//     dots: false // Remove pagination dots if desired
//     // Add more options and callbacks as needed
//   });
// });

document.addEventListener("DOMContentLoaded", function() {
    // var image="<?php echo $category_title;?>";
    // var myimage=null;
    // image.style.backgroundColor="#2556B9";
            var buttons = document.querySelectorAll(".categories_thumb");
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
        $(document).ready(function(){
    $('#loadingImage').on('load', function() {
        $(this).css('visibility', 'visible'); // Hide the image after it's loaded
    });
});
// $(document).ready(function() {
//         setTimeout(function() {
//             $('.single_categories').fadeIn();
//         }, 5000); // 5000 milliseconds = 5 seconds
//     });
$(document).ready(function() {
        // Once the document is loaded, show the categories
        $('.categories_product_area').fadeIn();
        $('.product_area ').fadeIn();
        $('.parts').fadeIn();
        $('.bloom').fadeIn();
        $('.mars').fadeIn();
        
    });
         
</script>
<!-- <link rel="stylesheet" href="https://code.jqueryui.com/1.12.1/themes/smoothness/jquery-ui.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://code.jqueryui.com/1.12.1/jquery-ui.js"></script> -->
<!-- <script>   -->
<!-- $(document).ready(function () { -->
    <!-- // Initialize tooltips -->
    <!-- $(".product_name").tooltip({ -->
        <!-- background-color: '#ffff'; -->
        <!-- color:'black' -->
    <!-- }); -->


<!-- }); -->
<!-- </script>  -->