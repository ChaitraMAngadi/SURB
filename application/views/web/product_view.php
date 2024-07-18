<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
        
    
<style>

/* Add additional styling as needed */

    /* Add styles for the expanded and collapsed states */
   
    .bar-<?php echo $rating['four']; ?> {
        /* width: 80%; */
    /* height: 18px; */
    /* background-color: #2196F3; */
    background: #59918D 0% 0% no-repeat padding-box;
    border-radius: 5px 0px 0px 5px;
    opacity:0.8;
}
.bar-<?= $rating['five'] ?>{
    /* width: 100%; */
    /* height: 18px; */
    /* background-color: #04AA6D; */
    background: #59918D 0% 0% no-repeat padding-box;
    border-radius: 5px 5px 5px 5px;
    opacity:1;
}
.bar-<?= $rating['three'] ?>{
    /* width: 60%; */
    /* height: 18px; */
    /* background-color: #00bcd4; */
    border-radius: 5px 0px 0px 5px;
    background: #59918D 0% 0% no-repeat padding-box;
opacity: 0.6;
}
.bar-<?= $rating['two'] ?>{
    /* width: 40%; */
    /* height: 18px; */
    /* background-color: #ff9800; */
    background: #FF9A24 0% 0% no-repeat padding-box;
opacity: 1;
    border-radius: 5px 0px 0px 5px;
}
.bar-<?= $rating['one'] ?>{
    /* width: 20%; */
    /* height: 18px; */
    border-radius: 5px 0px 0px 5px;
    /* background-color: #f44336; */
    background: #C64208 0% 0% no-repeat padding-box;
opacity: 1;
}
    .accord{
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
background: #FFFFFF 0% 0% no-repeat padding-box;

border:none;
border-top: 1px solid #0000000D;
    }
.accordion-toggle {
    cursor: pointer;
    color: #333;
    padding: 8px;
    font-size:17px;
    font-weight:bold;
    /* border-radius:15px; */
    border-top: 1px solid #ededed;
}
.toggle-icon {
    float: right;
    font-size: 20px;
    font-weight:bold;
    padding-right:10px;
}
    .owl-prev, .owl-next {
        background: #0857c0 !important;
    }
    .owl-prev .fa, .owl-next .fa {
        font-size: 30px !important;
        color: white;
    }
    #id_work_days{
  height: 44px;
  border: none;
  overflow: hidden;
  border-radius: 15px;
 margin-left:20px;
  
}
#id_work_days::-moz-focus-inner {
  border: 0;
}
#id_work_days:focus {
  outline: none;
}
#id_work_days option{
    width: 97px;
  font-size: 1.2em;
  padding: 10px 0;
  text-align: center;
  display: inline-block;
  cursor: pointer;
  border: 1px solid var(--thm-blue);
border-radius: 15px;
opacity: 1;
  color: var(--thm-blue);
 
}
.card-header{
    background-color: white;
    border:none;
}
</style>
</head>
<!--product details start-->

<?php
$request_urione = $this->input->get();
// pr($request_urione);
?>
<div class="product_details pt-100">
    <div class="container">
        <div class="row">
        <?php
// echo "<pre>";
// print_r($product_details);
// exit;
$categorySums = [];
$subcategorySums = [];

// Iterate through topdeals
foreach ($rel_pro as $deals) {
    $cat_name = $deals['category_name'];
    $sub_name = $deals['sub_category_name'];
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
    //   print_r($top3Categories);
    //   print_r($top3Subcategories);
    //   exit; ?>
            <div id="show_errormsg1"></div>
            <?php //echo "<pre>"; print_r($product_details['attributes']); ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="javascript:void(0);">
                            <img id="zoom1" src="<?php echo $product_details['link_variants'][0]['imageslist'][0]['image']; ?>" data-zoom-image="<?php echo $product_details['link_variants'][0]['imageslist'][0]['image']; ?>" alt="big-1">
                        </a>
                    </div>
                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">

                            <?php foreach ($product_details['link_variants'][0]['imageslist'] as $images) { ?>
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="<?php echo $images['image']; ?>" data-zoom-image="<?php echo $images['image']; ?>">
                                        <img src="<?php echo $images['image']; ?>" alt="zo-th-1"/>
                                    </a>
                                </li>
                            <?php } ?>
                            <!-- <li >
                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/op-1a.jpg" data-zoom-image="assets/img/op-1a.jpg">
                                    <img src="assets/img/op-1a.jpg" alt="zo-th-1"/>
                                </a>
                            </li>
                            <li >
                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/mob-spec.jpg" data-zoom-image="assets/img/mob-spec.jpg">
                                    <img src="assets/img/mob-spec.jpg" alt="zo-th-1"/>
                                </a>
                            </li>
                            <li >
                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/opside.jpg" data-zoom-image="assets/img/opside.jpg">
                                    <img src="assets/img/opside.jpg" alt="zo-th-1"/>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div><br>
                <div class="rate_section">
            <?php if($rating['rating_data']>0){?>
                <h3 class="review_class">Reviews & Rating </h3>
                <div class="product_info_content" >
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 direct_rate">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 col-12 my_boarder"><?php echo $review_count;?>
                                <?php  $reviews_arr=0;?><?php $userCount = array(); 
                                // echo "<pre>"; print_r($rating); exit;?>
                                <?php foreach ($rating['reviews'] as $value) {
                                      $reviews_arr += $value['review'];
                                    //   echo "<pre>";
                                    //   print_r($value['user_id']);
                                    //   echo "</pre>";
                                    if($value['comments']!=''){
                                    $userId = $value['user_id'];
                                    if (array_key_exists($userId, $userCount)) {
                                        $userCount[$userId]++;
                                    } else {
                                        $userCount[$userId] = 1;
                                    }
                                }

                                }?>
                                <?php  
                                // print_r($reviews_arr);
                                if($rating['rating_data']>0){
                                $rate=$reviews_arr/$rating['rating_data'];
                                // print_r($rate);
                                }
                                ?>
                              
                               
                                    <div class="my_flex">
                                        <div class="d-flex">
                                           
                                            <div  class ="row"style="display:flex;">
                                             <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12"> <span class="my_rate_number">  <?php $rate_num=round($rate, 1);
                                             echo $rate_num; ?></span><span><img src="<?php echo base_url(); ?>uploads/images/Polygon 33.png" style="color:#2556B9;font-size:18px;line-height: 12px;padding-bottom:20px;padding-left:5px;"/></span></div>
                                             <!-- <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-6"> </div> -->
                                            </div>
                                        </div>
                                        <div  class ="row"style="display:flex;">
                                        
                                        <div class=" col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 verified">

                                        <?php
                                    // $count_rating=$rating['one']+$rating['review2']+$rating['review3']+$rating['review4']+$rating['review5'];
                                   if($rating['rating_data']>0){ 
                                     echo $rating['rating_data']." <span>verified Buyers</span>";}
                                    ?>
                                       </div>
                            </div>
                                         
                                        
                                    </div>

                                <?php    $reviews_array=[]; 
                                            $reviews_array[]=$value['review'];
                                            $sum_review=0;
                                            for($i=0;$i<count($reviews_array);$i++){
                                                $sum_review+=$reviews_array[$i];
                                            }
                                           
                                            // echo $sum_review; ?>

                                </div>
                                
                                <div class="col-lg-6" style="margin:10px;">
                                <div class="row">
                                <?php  $count_rating=$rating['review1']+$rating['review2']+$rating['review3']+$rating['review4']+$rating['review5'];
                             if($count_rating >0){
                             $base= (100/$count_rating); 
                             //100/4=25
                                // echo $base; 
                                
                                           $ratingpercent5 = $rating['review5'] * $base;//1*25=25%
                                           $ratingpercent4 =$rating['review4'] * $base;//2*25=50%
                                           $ratingpercent3 = $rating['review3'] * $base; //1* 25=25%;
                                           $ratingpercent2 = $rating['review2'] * $base ; //1 * 25 =25%;
                                           $ratingpercent1 =$rating['review1'] * $base ;//1 *25=25%;

                             }?>
                            

                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>5 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['five'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review5'] == "" ? "0" : $rating['review5']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>4 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['four'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review4'] == "" ? "0" : $rating['review4']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>3 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['three'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review3'] == "" ? "0" : $rating['review3']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>2 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['two'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review2'] == "" ? "0" : $rating['review2']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>1 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['one'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review1'] == "" ? "0" : $rating['review1']; ?></div>
                                    </div>
                                </div>
                                   
                                </div>

                            </div>
                        </div>

                            <div class="user-rating-coment" style="border-top:1px solid #0000000D;">
                                
                                <?php   $count = 0;$reviewcount=0;
                                foreach ($rating['reviews'] as $value) {
                                    if($value['comments']!=''){
                                    $count++;$reviewcount++;
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12" style="display:flex;padding:10px;">
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 col-2">
                                        <div class="d-flex" style="align-items:center;text-align:center;">
                                            <!--   <div class="user-profile-img">
                                                  <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                              </div> -->
                                              <span class="rating-btn" style="height: 25px;background: #0E6E06 0% 0% no-repeat padding-box;border-radius: 12px;opacity: 1;padding:6.5px">
                                <a href="#" class="btn-sm" style="font-size: 0.7rem;padding: 0.1rem 0.2rem;"><?php echo $value['review']; ?> </a>
                            </span>
                                        </div>
                                       
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                    <div>
                                            <p class="coment"><?php echo $value['comments']; ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <div class="user-profile-img" style="display:flex;gap:2px;">
                                            <img src="<?php echo base_url(); ?>uploads/images/default_profile_image.svg" alt="" width= "20px"
height=" 20px" style="margin-right:10px;">
                                                <span class="name"><b><?php echo $value['user_lastname']; ?> <?php echo $value['user_firstname']; ?></b></span>  
                                            </div>
                                            
                                               
                                            
                                        </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                <span class="createddate">
                                                    <?= $value['createdat']; ?>
                                                </span>
                                                <?php if ($userCount[$userId] > 1): ?>
                                                    <div class="verified-purchase">
  <span class="icon">&#10003;</span>
  <span class="text_purchase">Verified purchase</span>
</div>
                            <?php endif; ?>
                                </div>
                                </div><hr>
                               
                              <?php  if ($count == 4) {
            // Display only the first three reviews
            break;
            
        }?>
                                <?php } }?>
                                
                                <?php 
                                if($reviewcount>3) { ?>
                                <div>
                                <a href="#" id="viewMoreLink" class="mt-2" style="text-align:right;justify-content:end;color:#2556B9;">+ view more ...</a>
                                </div>
                                <?php 
                            } ?>
                                

                                <!-- <a href="#" id="viewMoreLink" class="mt-2">View More Reviews</a> -->
                                

<!-- Display the remaining reviews initially hidden -->
<div id="remainingReviews" style="display: none;">
    <?php $one=0;
    foreach (array_slice($rating['reviews'], 3) as $value) {
        if($value['comments']!='' && $one!=7){
            $one++;
    ?>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12" style="display:flex;padding:10px;">
            <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 col-2">
                <div class="d-flex mt-2" style="align-items:center;text-align:center;">
                    <span class="rating-btn ml-0" style="height: 25px;background: #0E6E06 0% 0% no-repeat padding-box;border-radius: 12px;opacity: 1;padding:6.5px">
                        <a href="#" class="btn-sm" style="font-size: 0.7rem;padding: 0.1rem 0.2rem;"><?php echo $value['review']; ?> </a>
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                <div>
                    <p class="mb-0 mt-2 coment"><?php echo $value['comments']; ?></p>
                </div>
                <div class="d-flex mt-2">
                    <div class="user-profile-img" style="display:flex;gap:2px;">
                        <img src="<?php echo base_url(); ?>uploads/images/default_profile_image.svg" alt="" width="20px" height="20px" style="margin-right:10px;">
                        <span class="name"><b><?php echo $value['user_lastname']; ?>.<?php echo $value['user_firstname']; ?></b></span> <span>
                        
                               <!-- <?= $value['createdat']; ?> -->
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                <span class="createddate">
                                                    <?= $value['createdat']; ?>
                                                </span>
                                </div>
        </div>
        <hr>
    <?php }} ?>
   
</div>
                               
</div>
<div>
<a href="#" id="showless" class="mt-2" style="text-align:right;justify-content:end;color:#2556B9;display:none;padding:10px;">- show less</a>
</div>
                            
                            
 </div>
                <?php }?>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                <div class="product_d_right">
                    <!-- <div class="label_product">
                                    <a href="#"><span class="label_wishlist"><i class="fal fa-heart"></i></span></a>
                                </div> -->

                    <div class="bck-btn">
                        <?php if ($search_title == 'nodata') { ?>
                            <!-- <button onclick="goBack()" class="btn btn-outline-primary btn-sm mb-3"><i class="fal fa-angle-left"></i> Back</button> -->
                        <?php } else { ?>
                            <form  enctype="multipart/form-data" method="post" accept-charset="utf-8" class="user" action="<?= site_url('search'); ?>" style="float: right;">

                                <input name="searchdata" id="searchdata" type="hidden" value="<?php echo $search_title; ?>">

                                <!-- <button type="submit" class="btn btn-outline-primary">Back</button> -->
                            </form>

                        <?php } ?>

                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                    </div>
                    <div class="productd_title_nav">
                        <h1><a href="#"><?php echo $product_details['name']; ?></a></h1>




                    </div>
                    <div class="brand"><?php if ($product_details['brand']) { ?><p><b>Brand : </b><?php echo $product_details['brand']; ?></p><?php } ?></div>
                    <!-- <p><small>(6 GB RAM)</small></p> -->
                    <div class="price_box">
                        <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $product_details['link_variants'][0]['saleprice']; ?></span>
                        <?php if ($product_details['link_variants'][0]['price'] != $product_details['link_variants'][0]['saleprice']) { ?>
                           <span class="old_price"><small>Rs. <?php echo $product_details['link_variants'][0]['price']; ?></small></span>
                        <?php } ?>
                        <?php
                        $discount = (($product_details['link_variants'][0]['price'] - $product_details['link_variants'][0]['saleprice']) * 100) / $product_details['link_variants'][0]['price'];
                        ?>
                        <?php if ($product_details['link_variants'][0]['price'] != $product_details['link_variants'][0]['saleprice']) { ?>
                            <span class="productdiscounttext" style="color: #FF6200;">(<?php echo round($discount); ?>% OFF)</span>
                        <?php } ?>
                        <?php  $reviews_arr=0;?><?php 
                                // echo "<pre>"; print_r($rating); exit;?>
                                <?php foreach ($rating['reviews'] as $value) {
                                      $reviews_arr += $value['review'];

                                }?>
                                <?php  
                                // print_r($reviews_arr);
                                if($rating['rating_data']>0){
                                $rate=$reviews_arr/$rating['rating_data'];
                                // print_r($rate);
                                }
                                ?>
                        <?php 
                        // foreach ($rating['reviews'] as $value) {
                            ?>       
                             <?php if($rating['rating_data']>0){?><span class="rate-btn   ml-0">
                                <a href="#"><?php $rate_num= round($rate, 1);
                                    echo $rate_num; ?> <img src="<?php echo base_url(); ?>uploads/images/Polygon 1.png" style="font-size:10px;padding-bottom:4px;"></a>
                                
                            </span><?php }?>

                                <?php 
                            // } ?>
                                 <?php 
 $count_arr = array();
 $max1 = array('orders_placed' => 0);
 $max2 = array('orders_placed' => 0);
 $max3 = array('orders_placed' => 0);

$count_arr[] = $product_details['orders_placed'];

// Update the maximum values
if ($product_details['orders_placed'] > $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $product_details['orders_placed']);
} elseif ($product_details['orders_placed'] > $max2['orders_placed'] && $product_details['orders_placed'] < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $product_details['orders_placed']);
} elseif ($product_details['orders_placed'] > $max3['orders_placed'] && $product_details['orders_placed'] < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $product_details['orders_placed']);
}

$cat_name = $product_details['category_name'];
$sub_name = $product_details['subcategory_name'];
if (isset($top3Categories[$cat_name]) && isset($top3Subcategories[$sub_name]) &&
    ($product_details['orders_placed'] == $max1['orders_placed'] ||
    $product_details['orders_placed'] == $max2['orders_placed'] ||
    $product_details['orders_placed'] == $max3['orders_placed'])&& ($product_details['orders_placed']!=null || $product_details['orders_placed']!=''|| $product_details['orders_placed']!=0)) {
    // echo $product_details['orders_placed'];?>
     <button class="label_sale1">BEST SELLER</button>
<?php } ?>
                                <?php 
                                // if ($product_details['link_variants'][0]['saleprice'] < $product_details['link_variants'][0]['price']) { ?>
                                               
                                            <?php 
                                        // } ?>
                    </div>
                    <!-- <div class="price_box"><span class="text-success"><small>Extra ₹3000 OFF</small></span></div> -->
                    <!-- <div class="product_desc"> -->
<!--                        <p class="shopName"><b>Shop : </b><a href="<?php echo base_url(); ?>web/store/<?php echo $product_details['seo_url']; ?>/shop"><?php echo $product_details['shop']; ?></a>( <?php echo $product_details['vendor_description']; ?> )</p>-->
                        <!-- <p><?php echo $product_details['category_name']; ?> <i class="fal fa-angle-right"></i> <?php echo $product_details['subcategory_name']; ?></p> -->
                        

<!--                        <p><b>Description : </b><?php echo $product_details['description']; ?></p>-->

<!--                        <p><b>Return Availability : </b><?php echo $product_details['return_status']; ?></p>-->

                        <!--                        <div class="d-inline border border-primary p-2 mr-2 bg-white text-black font-weight-bold" style="cursor:pointer">
                                                    <span>[ 500ml ]</span>
                                                    <span class="current_price text-black font-weight-bold" style="font-size:15px;color:#081f66"><i class="fal fa-rupee-sign"></i> 200</span>
                                                    <del style="font-size:12px;color:black"><i class="fal fa-rupee-sign text-black font-weight-bold"></i> 300</del>
                                                </div>-->

                    <!-- </div> -->
                    <div style="display:flex;border-top: 1px solid #ededed;">
                    <?php if (count($product_details['attributes']) > 0) { ?>
                       
                            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-6 product_variant color" style="border-right:1px solid #0000000D;padding-left:10px;">
                                <!-- <?php if (!empty($this->session->tempdata('success_message'))) { ?>
                                    <div class="btn btn-danger alert-success" ><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($this->session->tempdata('error_message'))) { ?>
                                    <div class="btn btn-danger alert-error"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong>Sorry!</strong> <?= $this->session->tempdata('error_message') ?>
                                    </div>
                                <?php }
                                ?> -->
                   <form method="post" name="radio-form" id="radio-form" action="<?php echo base_url(); ?>web/product_view/<?php echo $seo_url; ?>" class="form-horizontal" enctype="multipart/form-data" >
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <input type="hidden" name="seo_url" value="<?php echo $seo_url; ?>">
                                    <input type="hidden" name="total_count" value="<?php echo count($product_details['attributes']); ?>">
    <!--                                    <input type="hidden" id="varient" name="varient_id" value="">-->
                                    <?php
                                    $attribute_values = $product_details['attributes'];
                                    // print_r($linkvarinats);

                                    $selected_linkvarinats = $linkvarinats;
                                    
                                    $i = 0;
                                    foreach ($attribute_values as $key => $v) {
                                        ?>
                                            <h3>Available <?= ucfirst($v[0]['type']) ?> <br>
                                                <label>
        <!--                                                <input type="hidden" name="attribute_type" value="<?php echo $attribute_values[0]['id']; ?>">-->
                                                </label>
                                            </h3>
                                            <label></label>

                                            <ul>

                                                <li>

                                                    <?php
                                                    foreach ($v as $value) {
                                                        if (isset($type) && $type == 'varient_filter') {
                                                            ?>
                                                            
                                                            <div class="col-3 col-lg-3 col-md-3 col-xs-3 col-sm-3 buttonradio" type="radio">
                                                            <label>
                                                                <input type="hidden" name="attribute_type_<?= $key ?>" value="<?php echo $value['type_id']; ?>">
                                                                <input type="radio" style="display:none" name="attribute_value_<?= $key ?>" id="radio_<?php echo $value['type_id']?>" value="<?php echo $value['value_id']; ?>" onchange="submitForm()" <?= in_array($value['value_id'], $selected_attrIds) ? 'checked' : '' ?>> <span><?php echo $value['value']; ?></span>

                                                            </label></div>
                                                        <?php } else { ?>
                                                           <div class="buttonradio col-xs-3 col-lg-3 col-md-3 col-sm-3 col-3" type="radio"> <label>
                                                                <input type="hidden" name="attribute_type_<?= $key ?>" value="<?php echo $value['type_id']; ?>">
                                                                <input type="radio" style="display:none" name="attribute_value_<?= $key ?>" id="radio_<?php echo $value['type_id']?>" value="<?php echo $value['value_id']; ?>" onchange="submitForm()" <?= in_array($value['value_id'], $selected_attrIds) ? 'checked' : '' ?>> <span><?php echo $value['value']; ?></span>

                                                            </label></div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </li><br>

                                            </ul>
                                        
                                    <?php } ?>
                                </form>  </div>      <?php } ?>
                          <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 col-3" style="padding-left:10px;">
                          <?php 
                        //   print_r($product_details['maximum_quantity']);?>
                                   <?php
                                   // print_r($product_details);die;
                                   if ($product_details['link_variants'][0]['in_cart'] == 0) {
                                       ?>
                                       <label > <span class="myquantity">Quantity</span><br>

        <span id="qty-box right">
            <select id="quantity" class="classic">
                <?php
                $stock=$product_details['product_stock'];
                $cartlimit=$product_details['cart_limit'];
                 if($stock<$cartlimit){
                    $limit=$stock;
                }
                else{
                    $limit = $cartlimit <= 10  || $cartlimit <= $stock? $cartlimit :10;
                }
                // $maxQuantity = $product_details['maximum_quantity']; 
                // $currentQuantity = $product_qry ? $product_qry : 1; 
                // $limit=
                // $limit=$product_details['maximum_quantity']< 10 ?$product_details['maximum_quantity']:10;
        
                for ($i = 1; $i <= $limit; $i++) {
                    $selected = ($i == $currentQuantity) ? 'selected' : '';?>
                   <a onclick="checkcart_limit(<?php echo $product_details['link_variants'][0]['id']; ?>,'single')">
           <?php echo "<option value='$i' $selected>$i</option>"; ?>
            </a>
         <?php       }
                ?>
            </select>
            
        </span>
            </label>
        <?php
                                   }
                                   ?> 
                                  
<!-- <div><img src="<?php echo base_url(); ?>uploads/images/ouofstock.jfif" style="width:100px ;height:70px;margin-left:10px;float:right;"/></div> -->
                                

                                </div>
                          

                                <?php if($product_details['link_variants'][0]['stock']=='0 Left') {?>
                                  
                                  <div class="col-lg-3"><img src="<?php echo base_url(); ?>uploads/images/outofstock.png" class="outofstock"/></div>
                                <?php } ?>



                    </div>
                    
                    <div class="qty" style="display:flex;gap:12px;padding:10px;">
                       
                            <!--  <label>quantity</label> -->
                           
                           <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-6">
                            <?php if ($product_details['link_variants'][0]['in_cart'] == 0) { ?>
                                <button class="button not_in_cart_<?php echo $product_details['link_variants'][0]['id']; ?>" type="submit" onclick="addtocartSingle(<?php echo $product_details['link_variants'][0]['id']; ?>,<?php echo $product_details['shop_id']; ?>, '<?php echo $product_details['link_variants'][0]['saleprice']; ?>')"
                                id ="button_not_in_cart">
                                <i class="fal fa-shopping-bag"></i>&nbsp;<strong>
                                        ADD TO CART
                                    </strong></button>
                            <?php } else { ?>
                                <a class="button ml-2 in_cart_<?php echo $product_details['link_variants'][0]['id']; ?>" href="<?= base_url('web/checkout') ?>" id="button_in_cart">
                                <i class="fal fa-cart-plus" style="color:white;"></i> <strong style="color:white;">
                                        GO TO CART
                                    </strong></a>
                            <?php } ?>
                            <a class="button ml-2 in_cart_<?php echo $product_details['link_variants'][0]['id']; ?>" href="<?= base_url('web/checkout') ?>"  style="display:none;" id="button_in_cart"><i class="fal fa-cart-plus"></i> <strong>
                                    GO TO CART
                                </strong></a></div><div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-6">
                            <a onclick="addremoveFavorite(<?php echo $product_details['link_variants'][0]['id']; ?>)" title="<?= ($product_details['link_variants'][0]['whishlist_status'] == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" class="btn blue-btn">
                                <span  id="" class="<?php
                                if ($product_details['link_variants'][0]['whishlist_status'] == true) {
                                    echo 'fas';
                                } else {
                                    echo 'fal';
                                }
                                ?> fa-heart favoritecls_<?php echo $product_details['link_variants'][0]['id']; ?>">&nbsp;&nbsp;</span><span class="wishengine">WISHLIST</span>
                            </a></div>
                    </div>
                    </div><br>
                    <!-- <div>
                    <h4><b>Use pincode to check delivery info</b></h4><br>
                        <form  enctype="multipart/form-data"  method="post" class="d-flex">
                        
                        <input type="number" placeholder="Enter pincode" name="pincode" id="pincode"class="form-control mr-4" style="width:75%;">
                        <input type="submit" value="submit" class="btn btn-outline-primary text-primary mr-2" id="pin_btn" onclick="validate_code()">
                        

                        </form>
                        <div id="avail"></div>
                        <?php 
                        // echo $data['stringData'];?>
                    </div><br> -->
                   
                        <div class="highlightsection">
                            <div class="highlight">
                                <h3>Highlight</h3>
                                <ul class="highlights">
                                    <li><?php echo $product_details['key_features']; ?></li>
                                </ul>


                                <p style="line-height: 1.5em;"><b style="color: #0857c0;">Image Disclaimer:</b>The product images shown may represent the range of product, or be for illustration purposes only and may not be an exact</p>
                            </div><br><br>
                      
                            
                           
 
                       
                    
                    
                       
                
 
                       
                 
                
 
                        
                       
                
            <div id="accordion">
            <div class="card accord">
                    <button class="card-header collapsed card-link"
                            data-toggle="collapse"
                            data-target="#collapseOne">
                            <h3 class="header-title float-left">Description</h3><i class="fas fa-plus float-right" style="float:right;font-size:15px;"></i> 
                    </button>
                    <div id="collapseOne" class="collapse"
                            data-parent="#accordion">
                        <div class="card-body accordion-content">
        <p><?php echo $product_details['description']; ?></p>
    </div>
    </div>
                    </div>
                    <div class="card accord">
                    <button class="card-header collapsed card-link"
                            data-toggle="collapse"
                            data-target="#collapseTwo">
    <h3 class="header-title float-left">Ingredients</h3><i class="fas fa-plus float-right" style="font-size:15px;"></i> 
    </button>
                     
                    <div id="collapseTwo" class="collapse"
                            data-parent="#accordion">
                        <div class="card-body accordion-content">
        <p><?php echo $product_details['about']; ?></p>
    </div>
    </div>
                    </div>
                    <div class="card accord">
                    <button class="card-header collapsed card-link"
                            data-toggle="collapse"
                            data-target="#collapseThree">
    <h3 class="header-title float-left">How to Use</h3><i class="fas fa-plus float-right" style="font-size:15px;"></i> 
    </button>
                    <div id="collapseThree" class="collapse"
                            data-parent="#accordion">
                        <div class="card-body accordion-content">
        <p><?php echo $product_details['how_to_use']; ?></p>
    </div>
    </div>
                    </div>
                    <div class="card accord">
                    <button class="card-header collapsed card-link"
                            data-toggle="collapse"
                            data-target="#collapseFour">
    <h3 class="header-title float-left"> Return Policy</h3><i class="fas fa-plus float-right" style="font-size:15px;"></i>
    </button>
    <div id="collapseFour" class="collapse"
                            data-parent="#accordion">
                        <div class="card-body accordion-content">        
                            <p>
            Return Policy: <?= $product_details['return_noof_days'] ? $product_details['return_noof_days'] . ' Day(s)' : '' ?>
            <?php if ($product_details['return_noof_days']) { ?>
                <ul>This product can be returned within <?= $product_details['return_noof_days'] ?> Day(s) of delivery if the item is defective, damaged, or incorrect.</ul>
            <?php } else { ?>
                <ul>This is not a returnable product.</ul>
            <?php } ?>
        </p>
        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 rate2_section">
            <?php if($rating['rating_data']>0){?>
                <h3 class="review_class">Reviews & Rating </h3>
                <div class="product_info_content" >
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 direct_rate">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 col-12 my_boarder"><?php echo $review_count;?>
                                <?php  $reviews_arr=0;?><?php 
                                // echo "<pre>"; print_r($rating); exit;?>
                                <?php foreach ($rating['reviews'] as $value) {
                                      $reviews_arr += $value['review'];

                                }?>
                                <?php  
                                // print_r($reviews_arr);
                                if($rating['rating_data']>0){
                                $rate=$reviews_arr/$rating['rating_data'];
                                // print_r($rate);
                                }
                                ?>
                              
                               
                                    <div class="my_flex">
                                        <div class="d-flex">
                                           
                                            <div  class ="row"style="display:flex;">
                                             <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12"> <span class="my_rate_number">  <?php $rate_num=round($rate, 1);
                                             echo $rate_num; ?></span><span><img src="<?php echo base_url(); ?>uploads/images/Polygon 33.png" style="color:#2556B9;font-size:18px;line-height: 12px;padding-bottom:20px;padding-left:5px;"/></span></div>
                                             <!-- <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-6"> </div> -->
                                            </div>
                                        </div>
                                        <div  class ="row"style="display:flex;">
                                        
                                        <div class=" col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 verified">

                                        <?php
                                    // $count_rating=$rating['one']+$rating['review2']+$rating['review3']+$rating['review4']+$rating['review5'];
                                   if($rating['rating_data']>0){ echo $rating['rating_data']." <span>verified Buyers</span>";}
                                    ?>
                                       </div>
                            </div>
                                         
                                        
                                    </div>

                                <?php    $reviews_array=[]; 
                                            $reviews_array[]=$value['review'];
                                            $sum_review=0;
                                            for($i=0;$i<count($reviews_array);$i++){
                                                $sum_review+=$reviews_array[$i];
                                            }
                                           
                                            // echo $sum_review; ?>

                                </div>
                                
                                <div class="col-lg-6" style="margin:10px;">
                                <div class="row">
                                <?php  $count_rating=$rating['review1']+$rating['review2']+$rating['review3']+$rating['review4']+$rating['review5'];
                             if($count_rating >0){
                             $base= (100/$count_rating); 
                             //100/4=25
                                // echo $base; 
                                
                                           $ratingpercent5 = $rating['review5'] * $base;//1*25=25%
                                           $ratingpercent4 =$rating['review4'] * $base;//2*25=50%
                                           $ratingpercent3 = $rating['review3'] * $base; //1* 25=25%;
                                           $ratingpercent2 = $rating['review2'] * $base ; //1 * 25 =25%;
                                           $ratingpercent1 =$rating['review1'] * $base ;//1 *25=25%;

                             }?>
                            

                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>5 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['five'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review5'] == "" ? "0" : $rating['review5']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>4 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['four'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review4'] == "" ? "0" : $rating['review4']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>3 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['three'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review3'] == "" ? "0" : $rating['review3']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>2 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['two'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review2'] == "" ? "0" : $rating['review2']; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 side">
                                        <span>1 <i class="fas fa-star" style="color:#2556B9;font-size:10px;"></i></span>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 col-sm-6 col-6 col-md-6 middle">
                                        <div class="bar-container">
                                            <div class="bar-<?= $rating['one'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 col-sm-3 col-3 col-md-3 sideright">
                                        <div><?= $rating['review1'] == "" ? "0" : $rating['review1']; ?></div>
                                    </div>
                                </div>
                                   
                                </div>

                            </div>
                        </div>

                            <div class="user-rating-coment" style="border-top:1px solid #0000000D;">
                                
                                <?php $count = 0; $reviewcount=0;
                                foreach ($rating['reviews'] as $value) {
                                    if($value['comments']!=''){
                                    $count++;$reviewcount++;
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12" style="display:flex;padding:10px;">
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 col-2">
                                        <div class="d-flex" style="align-items:center;text-align:center;">
                                            <!--   <div class="user-profile-img">
                                                  <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                              </div> -->
                                              <span class="rating-btn" style="height: 25px;background: #0E6E06 0% 0% no-repeat padding-box;border-radius: 12px;opacity: 1;padding:6.5px">
                                <a href="#" class="btn-sm" style="font-size: 0.7rem;padding: 0.1rem 0.2rem;"><?php echo $value['review']; ?> </a>
                            </span>
                                        </div>
                                       
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                    <div>
                                            <p class="coment"><?php echo $value['comments']; ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <div class="user-profile-img" style="display:flex;gap:2px;">
                                            <img src="<?php echo base_url(); ?>uploads/images/default_profile_image.svg" alt="" width= "20px"
height=" 20px" style="margin-right:5px;">
                                                <span class="name"><?php echo $value['user_lastname']; ?> <?php echo $value['user_firstname']; ?></span>  <span>
                                                    <!-- |<?= $value['createdat']; ?> -->
                                                </span>
                                            </div>
                                            
                                               
                                            
                                        </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                <span class="createddate">
                                                    <?= $value['createdat']; ?>
                                                </span>
                                                <?php if ($userCount[$userId] > 1): ?>
                                                    <div class="verified-purchase">
  <span class="icon">&#10003;</span>
  <span class="text_purchase">Verified purchase</span>
</div>
                            <?php endif; ?>
                                </div>
                                <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
                                <span>
                                                    <?= $value['createdat']; ?>
                                                </span>
                                </div> -->

                                </div><hr>
                                <?php  if ($count == 4) {
            // Display only the first three reviews
            break;
        }?>

                                <?php }} ?>
                                <?php if ($reviewcount >3){ ?>
                                    <div>
                                <a href="#" id="viewMoreLink1" class="mt-2" style="text-align:right;float:right;justify-content:end;color:#2556B9;">+ view more ...</a>
                                </div>
                                <?php } ?>
                                <!-- <a href="#" id="showless1" class="mt-2" style="text-align:right;float:right;justify-content:end;color:#2556B9;display:none;">- show less</a> -->

<!-- Display the remaining reviews initially hidden -->
<div id="remainingReviews1" style="display: none;">
    <?php $one=0;
    foreach (array_slice($rating['reviews'], 3) as $value) {
        if($value['comments']!='' && $one!=7){
            $one++;
    ?>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12" style="display:flex;padding:10px;">
            <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 col-2">
                <div class="d-flex mt-2" style="align-items:center;text-align:center;">
                    <span class="rating-btn ml-0" style="height: 25px;background: #0E6E06 0% 0% no-repeat padding-box;border-radius: 12px;opacity: 1;padding:6.5px">
                        <a href="#" class="btn-sm" style="font-size: 0.7rem;padding: 0.1rem 0.2rem;"><?php echo $value['review']; ?> </a>
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                <div>
                    <p class="mb-0 mt-2 coment"><?php echo $value['comments']; ?></p>
                </div>
                <div class="d-flex mt-2">
                    <div class="user-profile-img" style="display:flex;gap:2px;">
                        <img src="<?php echo base_url(); ?>uploads/images/default_profile_image.svg" alt="" width="20px" height="20px" style="margin-right:10px;">
                        <span class="name"><b><?php echo $value['user_lastname']; ?>.<?php echo $value['user_firstname']; ?></b></span> <span>
                            <!-- <?= $value['createdat']; ?> -->
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                <span class="createddate">
                                                    <?= $value['createdat']; ?>
                                                </span>
                                </div>
            <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
                                <span>
                                                    <?= $value['createdat']; ?>
                                                </span>
                                </div> -->
        </div>
        <hr>
    <?php }} ?>
    <div>
    <a href="#" id="showless1" class="mt-2" style="text-align:right;float:right;justify-content:end;color:#2556B9;display:none;padding:10px;">- show less</a> 
    </div>
</div>


                            </div>
                            
                </div>
                <?php }?>
            </div>
        
            
<!-- Include the jQuery library -->
<!-- Include the jQuery library -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
//  $(document).ready(function() {
            // $(".accordion-toggle").click(function() {
                // Toggle the expanded/collapsed class for the clicked element
                // $(this).toggleClass("expanded").toggleClass("collapsed");

                // Toggle the content visibility for the corresponding accordion-content
                // $(this).next(".accordion-content").slideToggle();

                // Update the toggle-icon based on the expanded class
                // $(this).find(".toggle-icon").text(function() {
                    // return $(this).parent().hasClass("expanded") ? "-" : "+";
                // });
            // });
        // });
        $('.card-header').click(function() {
            $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
        });
</script> 













<?php 
// echo "<pre>"; 
// print_r($rel_pro); exit;
?>
 <?php 
//  echo "<pre>";print_r($rel_pro);
                    // foreach ($rel_pro as $value) {
                //  $rate_total=$value['rate_data']['rating_data'];       ?>
                        
                      
    
                               
                               <?php  
                            //    print_r($r['review']);?>
                       <!-- <span class="rating-number"><?php  ?></span> <span class="star-symbol"><img src="web_assets/img/icon/staricon.svg"></span> -->
                      
                  <?php 
                // }?>
                  <?php 
                //   print_r($rate_total);?>

<div class="row mt-5" style="margin-left:2px;">
            <div class="col-12 col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="section_title product_shop_title">
                    <h2>Related Products</h2>
                </div>
            </div>
            <!-- <div class="row" id="trending_now"> -->

                <div class="justify-content-center pro_carousel product_column3 owl-carousel" style="margin-left:10px;">

                    <?php
                   
                    foreach ($rel_pro as $value) {
                        ?>
                        <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 col-3" >
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>"><img src="<?= base_url() ?>uploads/products/<?php echo $value['p_image']; ?>" alt=""></a>
                                        <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>"><img src="<?= base_url() ?>uploads/products/<?php echo $value['p_image']; ?>" alt=""></a>
                                        <div class="label_product">
                                            <?php 
                                            // if ($value['saleprice'] < $value['price']) { ?>
                                                <!-- <span class="label_sale">Best Seller</span> -->
                                            <?php 
                                        // } ?>

<?php 


$count_arr[] = $value['orders_placed'];

// Update the maximum values
if ($value['orders_placed'] > $value['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $value['orders_placed']);
} elseif ($value['orders_placed'] > $max2['orders_placed'] && $value['orders_placed'] < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $value['orders_placed']);
} elseif ($value['orders_placed'] > $max3['orders_placed'] && $value['orders_placed'] < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $value['orders_placed']);
}

$cat_name = $value['category_name'];
$sub_name = $value['sub_category_name'];
// echo $value['orders_placed'];
if (isset($top3Categories[$cat_name]) && isset($top3Subcategories[$sub_name]) &&
    ($value['orders_placed'] == $max1['orders_placed'] ||
    $value['orders_placed'] == $max2['orders_placed'] ||
    $value['orders_placed'] == $max3['orders_placed'])&& ($value['orders_placed']!=null || $value['orders_placed']!=''|| $value['orders_placed']!=0)) {
    // echo $value['orders_placed'];?>
    <span class="label_sale">Best seller</span>
<?php } ?>
                                        </div>
                                        <div class="wishlist">
                                            <a title="<?= ($value['whishlist_status'] == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite(<?php echo $value['variant_id']; ?>)"><span id="" class="<?php
                                                if ($value['whishlist_status'] == true) {
                                                    echo 'fas';
                                                } else {
                                                    echo 'fal';
                                                }
                                                ?> fa-heart favoritecls_<?php echo $value['variant_id']; ?>"></span></a>
                                        </div><div class="add1">
<?php if ($value['rate_data']['rating_data']>0) {?>
                                        <div class="starrating2">
                                      
                                       <?php
$reviews_arr1 = 0; // Initialize a variable to store the sum of reviews
$review_count = 0; // Initialize a variable to count the number of reviews

foreach ($value['rate_data'] as $rat) {
    foreach ($rat as $r) {
        $reviews_arr1 += $r['review']; // Add each review to the sum
        $review_count++; // Increment the review count
    }
}

// Calculate the average rating
if ($review_count > 0) {
    $avg = $reviews_arr1 / $review_count;
} else {
    $avg = 0; // Default to 0 if there are no reviews
}
?>

<span class="rating-number"><?php echo round($avg,1); ?></span>
<span class="star-symbol"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
</div> <?php }?>
                                        <div class="add_to_cart d-lg-block d-md-block d-sm-none d-none">
                                            <?php if ($value['in_cart'] == 0) { ?>
                                                <a class="not_in_cart_<?php echo $value['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $value['variant_id']; ?>,<?php echo $value['shop_id']; ?>, '<?php echo $value['saleprice']; ?>')">Add to cart</a>
                                            <?php } else { ?>
                                                <a class="in_cart_<?php echo $value['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>
                                            <a class="in_cart_<?php echo $value['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                        </div></div>

                                    </div>
                                    <div class="add2">
                                    <?php if ($value['rate_data']['rating_data']>0) {?>
                                        <div class="starrating1 rating_add">
                                      
                                       <?php
$reviews_arr1 = 0; // Initialize a variable to store the sum of reviews
$review_count = 0; // Initialize a variable to count the number of reviews

foreach ($value['rate_data'] as $rat) {
    foreach ($rat as $r) {
        $reviews_arr1 += $r['review']; // Add each review to the sum
        $review_count++; // Increment the review count
    }
}

// Calculate the average rating
if ($review_count > 0) {
    $avg = $reviews_arr1 / $review_count;
} else {
    $avg = 0; // Default to 0 if there are no reviews
}
?>

<span class="rating-number1"><?php echo round($avg,1); ?></span>
<span class="star-symbol1"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
</div> <?php }?>
                                        <div class="add_to_cart d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                                            <?php if ($value['in_cart'] == 0) { ?>
                                                <a class="not_in_cart_<?php echo $value['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $value['variant_id']; ?>,<?php echo $value['shop_id']; ?>, '<?php echo $value['saleprice']; ?>')">Add to cart</a>
                                            <?php } else { ?>
                                                <a class="in_cart_<?php echo $value['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>
                                            <a class="in_cart_<?php echo $value['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                        </div>
                                            </div>
                                    <figcaption class="product_content">
                                        <div class="product_content_inner">
                                        <div class="product-info">
                                            <p class="shop-name"><?= $value['brand_name']; ?></p>
                                            <h4 class="product_name"><a href="#"><?= $value['p_name']; ?></a></h4>
                                            <div class="price_box">
                                                <span class="current_price"><i class="fal fa-rupee-sign"></i><?= $value['saleprice']; ?></span>
                                                <?php if ($value['saleprice'] != $value['price']) { ?>
                                                    <del><i class="fal fa-rupee-sign"></i> <?php echo $value['price']; ?></del>
                                                <?php } ?>
                                                <?php if ($value['price'] != $value['saleprice']) { ?>
                                                    <?Php $discount1 = (($value['price']- $value['saleprice']) * 100) / $value['price'];?>
                                                  <span class="discounttext" style="color: #FF6200;">(<?php echo round($discount1); ?>% OFF)</span>
                                                <?php } ?>

                                            </div></div>
                                            <div class="quantity_div">
                                            <?php if ($value['in_cart'] == 0) { ?>
                                                <div id="qty-<?= $deals['variant_id'] ?>">
                                                <label for="quantity-select-<?php echo $value['variant_id'];?>" class="mr-2">Quantity:</label>
                                                <select id="quantity-select-<?php echo $value['variant_id'];?>" class="select-style quantity_<?php echo $value['variant_id']; ?>" name="quantity" onchange="checkcart_limit(<?php echo $value['variant_id']; ?>)">

                                              <?php  $stock=$value['stock'];
                                              $cartlimit=$value['cart_limit'];
                                              if($stock<$cartlimit){
                                                        $limit=$stock;
                                                    }
                                                    else{
                                                        $limit = $cartlimit <= 10  || $cartlimit <= $stock? $cartlimit :10;
                                                    }?>
    <?php for ($i = 1; $i <= $limit; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>
                                            <?php } ?>
                                            </div>
                                        </div>
                                        
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    <?php } ?>

                </div>

            <!-- </div> -->
        </div>
    </div>
</div>
<!--product details end-->
<!--product info start-->
<!-- <div class="product_d_info mb-77 mt-5">
    <div class="container">

    </div>
</div> -->
<!--product info end-->
<style type="text/css">

    .active_values{
        background-color: #cf1673;
        color: #ffffff;
    }
</style>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">

                                            function addFavorite(pid)
                                            {
                                                var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
                                                if (user_id == '')
                                                {
                                                    $('#loginModal').modal('show');
                                                    return false;
                                                } else
                                                {

                                                    $('.error').remove();
                                                    var errr = 0;
                                                    $.ajax({
                                                        url: "<?php echo base_url(); ?>web/add_remove_favourite",
                                                        method: "POST",
                                                        data: {pid: pid},
                                                        success: function (data)
                                                        {
                                                            var str = data;
                                                            var res = str.split("@");
                                                            if (res[1] == 'remove')
                                                            {
                                                                $("#product_view").removeClass("fas");
                                                                $("#product_view").addClass("fal");
                                                                toastr.info("Removed from wishlist!")
                                                            } else if (res[1] == 'add')
                                                            {
                                                                $("#product_view").removeClass("fal");
                                                                $("#product_view").addClass("fas");
                                                                toastr.info("Added to wishlist!")
                                                            }



                                                        }
                                                    });
                                                }
                                            }


                                            setTimeout(function () {
                                                $('.alert-success').fadeOut('fast');
                                            }, 6000);


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
<section class="product_area related_products mt-4">
</section>
<!-- <section class="product_area related_products mt-4">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="section_title psec_title">
                <h2>Similar <span>Products</span></h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="product_carousel product_column5 owl-carousel">
<?php for ($i = 1; $i <= 8; $i++) { ?>
                                                                                                                                                                                                                                                                                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                                                                                                                                                                                                                                                                                                <div class="single_product">
                                                                                                                                                                                                                                                                                                                                    <div class="product_thumb">
                                                                                                                                                                                                                                                                                                                                        <a class="primary_img" href="product_view.php"><img src="assets/img/op-<?php echo $i ?>.jpg" alt=""></a>
                                                                                                                                                                                                                                                                                                                                        <a class="secondary_img" href="product_view.php"><img src="assets/img/op-<?php echo $i ?>a.jpg" alt=""></a>
                                                                                                                                                                                                                                                                                                                                        <div class="label_product">
                                                                                                                                                                                                                                                                                                                                            <a href="#"><span class="label_wishlist"><i class="fal fa-heart"></i></span></a>
                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                        <div class="action_links">
                                                                                                                                                                                                                                                                                                                                            <ul>
                                                                                                                                                                                                                                                                                                                                                <li class="quick_button"><a href="product_view.php" title="View Details"> <span class="pe-7s-search"></span></a></li>
                                                                                                                                                                                                                                                                                                                                                <li class="wishlist"><a href="#" title="Add to Wishlist"><span class="pe-7s-like"></span></a></li>
                                                                                                                                                                                                                                                                                                                                            </ul>
                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                    <div class="product_content grid_content">
                                                                                                                                                                                                                                                                                                                                        <div class="product_content_inner">
                                                                                                                                                                                                                                                                                                                                            <h4 class="product_name"><a href="product_view.php">Smart Phone Title</a></h4>
                                                                                                                                                                                                                                                                                                                                            <div class="price_box">
                                                                                                                                                                                                                                                                                                                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> 11000</span>
                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                        <div class="add_to_cart">
                                                                                                                                                                                                                                                                                                                                            <a href="cart.php"><i class="fal fa-shopping-cart fa-lg"></i> Add to cart</a>
                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                            </div>
<?php } ?>

        </div>
    </div>
</div>
</section> -->

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function() {
        var viewMoreLink = document.getElementById("viewMoreLink");
        var viewMoreLink1=document.getElementById("viewMoreLink1");
        var showless=document.getElementById("showless");
        var showless1=document.getElementById("showless1");
        var remainingReviews = document.getElementById("remainingReviews");
        var remainingReviews1=document.getElementById("remainingReviews1");
if(viewMoreLink!=null){
        viewMoreLink.addEventListener("click", function(e) {
            e.preventDefault();
            remainingReviews.style.display = "block";
            viewMoreLink.style.display = "none";
            showless.style.display="block";
        });
       showless.addEventListener("click", function(e) {
            e.preventDefault();
            remainingReviews.style.display = "none";
            viewMoreLink.style.display = "block";
            showless.style.display="none";
        });
    }
    if(viewMoreLink1!=null){
        viewMoreLink1.addEventListener("click", function(e) {
            e.preventDefault();
            remainingReviews1.style.display = "block";
            viewMoreLink1.style.display = "none";
            showless1.style.display="block";
        });
        showless1.addEventListener("click", function(e) {
            e.preventDefault();
            remainingReviews1.style.display = "none";
            viewMoreLink1.style.display = "block";
            showless1.style.display="none";
        });
    }
    });

    function increaseQuantity()
    {
        var quantity = $("#quantity").val();
        var qty = 1;
        var final = parseInt(qty) + parseInt(quantity);
        $("#quantity").val(final);
    }

    function decreaseQuantity()
    {
        var quantity = $("#quantity").val();
        if (quantity == 1)
        {
            return false;
        } else
        {
            var qty = 1;
            var final = parseInt(quantity) - parseInt(qty);
            $("#quantity").val(final);
        }
    }



    /*function addtocartSingle(variant_id,vendor_id,saleprice)
     {
     var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
     if(user_id=='')
     {
     $('#loginModal').modal('show');
     return false;
     }
     else
     {
     var quantity = $("#quantity").val();
     var session_vendor_id = '<?php echo $_SESSION['session_data']['vendor_id']; ?>';
     var cart_count= '<?php echo $cart_count; ?>';
     if(session_vendor_id!=vendor_id && cart_count>0)
     {
     
     if(confirm("Are you sure you want to Clear the previous store items"))
     {
     
     $('.error').remove();
     var errr=0;
     
     $.ajax({
     url:"<?php echo base_url(); ?>web/addtocart",
     method:"POST",
     data:{variant_id:variant_id,vendor_id:vendor_id,saleprice:saleprice,quantity:quantity},
     success:function(data)
     {
     var str = data;
     var res = str.split("@");
     if(res[1]=='success')
     {
     
     $('html, body').animate({
     scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
     }, 'slow');
     $('#cart_count').html(res[2]);
     location.reload();
     $('#show_errormsg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Product added to cart</span>');
     $('#show_errormsg').focus();
     return false;
     }
     else
     {
     $('#show_errormsg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">OUT OF STOCK</span>');
     $('#show_errormsg').focus();
     return false;
     }
     
     
     
     }
     });
     }
     }
     else
     {
     
     
     $('.error').remove();
     var errr=0;
     
     $.ajax({
     url:"<?php echo base_url(); ?>web/addtocart",
     method:"POST",
     data:{variant_id:variant_id,vendor_id:vendor_id,saleprice:saleprice,quantity:quantity},
     success:function(data)
     {
     var str = data;
     var res = str.split("@");
     if(res[1]=='success')
     {
     
     $('html, body').animate({
     scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
     }, 'slow');
     location.reload();
     $('#cart_count').html(res[2]);
     $('#show_errormsg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Product added to cart</span>');
     $('#show_errormsg').focus();
     return false;
     }
     else
     {
     $('#show_errormsg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">OUT OF STOCK</span>');
     $('#show_errormsg').focus();
     return false;
     }
     
     
     
     }
     });
     
     }
     }
     }*/

    function addtocartSingle(variant_id, vendor_id, saleprice)
    {

        var session_id = '<?= $session_id ?>';
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        var quantity = $("#quantity").val();

        //alert(user_id);
        if (user_id == '')
        {
            $("#login_quantity").val(quantity);
            $("#login_vendor_id").val(vendor_id);
            $("#login_session_id").val(session_id);

            $("#login_variant_id").val(variant_id);
            $("#login_saleprice").val(saleprice);

            $('#loginModal').modal('show');
            return false;
        } else
        {
            //alert(variant_id); alert(vendor_id); alert(saleprice); alert(quantity); alert(session_vendor_id);

            $('.error').remove();
            var errr = 0;

            $.ajax({
                url: "<?php echo base_url(); ?>web/addtocart",
                method: "POST",
                data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: session_id},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    if (res[1] == 'success')
                    {
                        $("#qty-box").hide();
                        $("#vendor_id").val(vendor_id);
                        $("#session_id").val(res[3]);
                        $('#cart_count').html(res[2]);

                        toastr.success("Product added to cart!");
                        $(".not_in_cart_" + variant_id).remove();
                        $(".in_cart_" + variant_id).show();
                    } else if (res[1] == 'shopclosed')
                    {

                        toastr.error("Shop Closed!")
                    } else if (res[1] == 'cart_limit')
                    {
                        toastr.error("You have exceeded the cart limit of "+res[2]+" for this product!");
                    } else
                    {
                        toastr.error("OUT OF STOCK!");
                    }
                }
            });

        }
    }
</script>


<script type="text/javascript">
    function confirmnewCart(variant_id, vendor_id, saleprice, quantity) {
        var id = $(this).parents("tr").attr("id");

        swal({

            title: "Are you sure?",

            text: "You want to Clear the previous store items",

            type: "warning",

            showCancelButton: true,

            confirmButtonClass: "btn-danger",

            confirmButtonText: "Yes",

            cancelButtonText: "Cancel",

            closeOnConfirm: false,

            closeOnCancel: false

        },
                function (isConfirm) {

                    if (isConfirm) {

                        $.ajax({
                            url: "<?php echo base_url(); ?>web/addtocart",
                            method: "POST",
                            data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity},
                            success: function (data)
                            {
                                var str = data;
                                var res = str.split("@");
                                if (res[1] == 'success')
                                {
                                    $("#vendor_id").val(vendor_id);
                                    $("#session_id").val(res[3]);
                                    $('#cart_count').html(res[2]);

                                    toastr.success("Product added to cart!")
                                } else if (res[1] == 'shopclosed')
                                {

                                    toastr.error("Shop Closed!")
                                } else
                                {
                                    toastr.error("OUT OF STOCK!")
                                }



                            }
                        });


                    } else {

                        toastr.error("Cancelled");

                    }

                });



    }



    function addtocartproductview(variant_id, vendor_id, saleprice)
    {
        var quantity = $("#quantity").val();
        var session_vendor_id = $("#vendor_id").val();
        //alert(session_vendor_id);
        var session_id = $("#session_id").val();
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';


        if (user_id == '')
        {
            $("#login_quantity").val(quantity);
            $("#login_vendor_id").val(vendor_id);
            $("#login_session_id").val(session_id);

            $("#login_variant_id").val(variant_id);
            $("#login_saleprice").val(saleprice);

            $('#loginModal').modal('show');
            return false;
        } else
        {
            //alert(session_vendor_id); alert(vendor_id);
            if (session_vendor_id != vendor_id && session_vendor_id != '')
            {
                confirmnewCart(variant_id, vendor_id, saleprice, quantity);
            } else
            {
                $('.error').remove();
                var errr = 0;

                $.ajax({
                    url: "<?php echo base_url(); ?>web/addtocart",
                    method: "POST",
                    data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: session_id},
                    success: function (data)
                    {
                        var str = data;
                        var res = str.split("@");
                        if (res[1] == 'success')
                        {
                            $("#vendor_id").val(vendor_id);
                            $("#session_id").val(res[3]);
                            $('#cart_count').html(res[2]);

                            toastr.success("Product added to cart!")
                        } else if (res[1] == 'shopclosed')
                        {

                            toastr.error("Shop Closed!")
                        } else
                        {
                            toastr.error("OUT OF STOCK!")
                        }
                    }
                });

            }
        }
    }

    function submitForm() {
//        $('#varient').val(varient_id);
        document.getElementById("radio-form").submit();
        // document.getElementsById("radio_<?php echo $value['type_id']?>").style.backgroundcolor="blue";
    }
    
    // document.getElementById("id_work_days").addEventListener("change", function() {
    //     var select = this;
    //     var options = select.options;

    //     // Deselect all other options
    //     for (var i = 0; i < options.length; i++) {
    //         if (options[i].selected && i !== select.selectedIndex) {
    //             options[i].selected = false;
    //         }
    //     }
    // });
    document.addEventListener("DOMContentLoaded", function() {
    var buttons = document.querySelectorAll(".buttonradio");
    var firstButton = buttons[0]; // Reference to the first button

    // Apply default styles to the first button
    firstButton.style.backgroundColor = "white";
    firstButton.style.color = "#2556B9";
    firstButton.style.border = "1px solid #2556B9";

    // Check if there's a stored active button in local storage
    var activeButtonIndex = localStorage.getItem("activeButtonIndex2");
    if (activeButtonIndex !== null) {
        // Remove styles from the first button if it's not the stored active button
        if (activeButtonIndex !== "0") {
            firstButton.style.backgroundColor = "";
            firstButton.style.color = "";
            firstButton.style.border = "";
        }
        // Apply styles to the stored active button
        buttons[activeButtonIndex].style.backgroundColor = "white";
        buttons[activeButtonIndex].style.color = "#2556B9";
        buttons[activeButtonIndex].style.border = "1px solid #2556B9";
        // Update firstButton reference
        firstButton = buttons[activeButtonIndex];
    }

    buttons.forEach(function(button, index) {
        button.addEventListener("click", function() {
            // Remove styles from the first button if it's not the one clicked
            if (button !== firstButton) {
                firstButton.style.backgroundColor = "";
                firstButton.style.color = "";
                firstButton.style.border = "";
            }

            // Apply styles to the clicked button
            button.style.backgroundColor = "white";
            button.style.color = "#2556B9";
            button.style.border = "1px solid #2556B9";

            // Store the index of the clicked button in local storage
            localStorage.setItem("activeButtonIndex2", index);

            // Update firstButton reference
            firstButton = button;
        });
    });

    // Reset the local storage value to the first index when the page loads
    window.addEventListener("load", function() {
        localStorage.setItem("activeButtonIndex2", "0");
    });
});









</script>
<!--product area end-->

<div class="modal fade" id="productQAModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times-circle"></i></button>
                <div class="row justify-content-end">
                    <div class="col-lg-12">
                        <h4>Pick  the hair related issues that you are currently facing </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>