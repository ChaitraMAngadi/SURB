<style>
    @media (min-width:961px)  {
        .noproduct {
            /* position: relative; */
            /* left: 17%; */
        }
    }
    .quantity label {
    font-weight: 500;
    text-transform: capitalize;
    font-size: 14px;
    /* margin-bottom: 0; */
    align-items: center;
    /* margin-top:auto; */
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

.quantity input {
    width: 50px;
    border: 1px solid #ebebeb;
    background: none;
    height: 30px;
    padding: 0 12px;
    border-radius: 5px;
    margin-left: 10px;
    text-align: center;
    margin-top:auto;
}
.quantity {
    /* display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    /* align-items: center; */
    /* margin-bottom: 10px; */
    margin-top: auto;
    /* align-self: flex-end;  */
    /* padding-top: 5px;  */

    /* bottom:0; */
    left:0;
    right:0;
    position:relative;
    align-items: center;
    bottom: -10; 

    /* position: absolute; */
            /* bottom: 0;
            right: 0;
            left: 0;
            /* display: flex; */
            /* justify-content: center;
            padding: 10px; */ 
   
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
<!--breadcrumbs area start-->

<div class="breadcrumbs_area mb-3 mt-72">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                <ul>
                            <li><a href="<?php echo base_url(); ?>">home</a></li>

                            <li>banners</li>
                </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<!--breadcrumbs area end-->
<!--slider area start-->
<!--<section class="slider_section slider_s_three d-none">
    <div class="slider_area owl-carousel">

    </div>
</section>-->

<style type="text/css">
    .inner_slider{
        width: 100%;
        height: 300px;
        object-fit: contain;
    }
</style>
<?php 
// echo "<pre>";
// print_r($banner_products[0]);
// exit;
?>
<?php 
$categorySums = [];
$subcategorySums = [];

// Iterate through topdeals
// echo "<pre>";
foreach ($banner_products as $product) {
    // echo "<pre>";

    // print_r($deals);
    $cat_qry=$this->db->query("select category_name from categories where id='".$product->cat_id."'");
    $cat_qry_res=$cat_qry->row();
    // print_r($cat_qry_res->category_name);
    $sub_qry=$this->db->query("select sub_category_name from sub_categories where id='".$product->sub_cat_id."'");
    $sub_qry_res=$sub_qry->row();
    // print_r($sub_qry_res);


    $cat_name = $cat_qry_res->category_name;
    $sub_name = $sub_qry_res->sub_category_name;
    $orders_placed = $product->orders_placed;

    // // Increment sums for categories and subcategories
    $categorySums[$cat_name] = isset($categorySums[$cat_name]) ? $categorySums[$cat_name] + $orders_placed : $orders_placed;
    $subcategorySums[$sub_name] = isset($subcategorySums[$sub_name]) ? $subcategorySums[$sub_name] + $orders_placed : $orders_placed;
}
// exit;
// Sort categories and subcategories based on sums in descending order
arsort($categorySums);
arsort($subcategorySums);

// // Get the top 3 categories and subcategories
$top3Categories = array_slice($categorySums, 0, 3, true);
$top3Subcategories = array_slice($subcategorySums, 0, 3, true);


?>
<!--slider area end-->
<!--categories product area start-->
<div class="categories_product_area mb-30">
    <div class="container">
        <div class="row">
            <!--            <div class="col-lg-3">
                            sidebar widget start
                            
                            sidebar widget end
                        </div>-->
                       
            <div class="fil col-lg-12">
                <div class="row banfilter">
                    <?php
                    if ($banner_products) {
                        // echo "<pre>";
                        // print_r($banner_products);
                        // exit;
                        foreach ($banner_products as $product) {
                            if($product->variant->stock>0){
                            
                        // echo "<pre>";print_r($product->stock);exit;
                            //  echo "<pre>";print_r($product->rating['reviews']);exit;
                        
                            $qry = $this->db->query("select * from attr_brands where id='" . $product->brand . "'");
                            $brand_detail = $qry->row();
                            ?>
                            <div class="filter_cards  col-lg-3 col-md-3 col-sm-3 col-xl-3 col-xxl-3 " style="flex: 0;">
                                <article class=" banner single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><img src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""></a>
                                            <a class="secondary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><img src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""></a>
                                            <div class="label_product">
                                                <?php
                                                //  if ($deals['on_sale'] == "active") { ?>
                                                    <!-- <span class="label_sale">Sale</span> -->
                                                <?php 
                                            // } ?>

<?php 


$count_arr[] = $product->orders_placed;

// Update the maximum values
if ($product->orders_placed > $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $product->orders_placed);
} elseif ($product->orders_placed > $max2['orders_placed'] && $product->orders_placed < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $product->orders_placed);
} elseif ($product->orders_placed > $max3['orders_placed'] && $product->orders_placed < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $product->orders_placed);
}

$cat_qry=$this->db->query("select category_name from categories where id='".$product->cat_id."'");
$cat_qry_res=$cat_qry->row();
// print_r($cat_qry_res->category_name);
$sub_qry=$this->db->query("select sub_category_name from sub_categories where id='".$product->sub_cat_id."'");
$sub_qry_res=$sub_qry->row();
$cat_name=$cat_qry_res->category_name;
$sub_name=$sub_qry_res->sub_category_name;
// echo $product->orders_placed;
// echo $cat_name;
// echo $sub_name;
if (isset($top3Categories[$cat_name]) && isset($top3Subcategories[$sub_name]) &&
    ($product->orders_placed == $max1['orders_placed'] ||
     $product->orders_placed == $max2['orders_placed'] ||
     $product->orders_placed == $max3['orders_placed'])&& ($product->orders_placed!=null || $product->orders_placed!=''|| $product->orders_placed!=0)) {
    // echo $product->orders_placed;?>
    <span class="label_sale">Best seller</span>
<?php } ?>


                                            </div>
                                            <div class="wishlist">
                                                <a title="Add to Wishlist" onclick="addremoveFavorite('<?php echo $product->variant->id; ?>')"><span id="favoritecls_<?php echo $product->variant->id; ?>" class="<?php
                                                    if ($product->whishlist_status == true) {
                                                        echo 'fas';
                                                    } else {
                                                        echo 'fal';
                                                    }
                                                    ?> fa-heart"></span></a>
                                            </div>
                                            <div class="add1"><?php if ($product->rating['rating_data']>0) {?>
                                        <div class="starrating2">
                                      
                                       <?php
$reviews_arr1 = 0; 
$review_count = 0; 

foreach ($product->rating['reviews']as $rat) {
   
        $reviews_arr1 += $rat['review']; 
        $review_count++;
    
}


if ($review_count > 0) {
    $avg = $reviews_arr1 / $review_count;
} else {
    $avg = 0; 
}
?>

<span class="rating-number"><?php 
echo round($avg,1); ?></span>
<span class="star-symbol"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
</div> <?php }?>
                                        
                                            <div class="add_to_cart d-lg-block d-md-block d-sm-none d-none">
                                                <?php if ($product->in_cart == 0) { ?>
                                                    <a class="not_in_cart_<?php echo $product->variant->id; ?>" onclick="addtocartSingleProduct('<?php echo $product->variant->id; ?>', '<?php echo $product->shop_id; ?>', '<?php echo $product->variant->saleprice; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                                <?php } ?>
                                                <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            </div>
                                                </div>
                                        </div>
                                       <div class="add2"> <?php if ($product->rating['rating_data']>0) {?>
                                        <div class="starrating1 rating_add">
                                      
                                       <?php
$reviews_arr1 = 0; 
$review_count = 0; 

foreach ($product->rating['reviews']as $rat) {
   
        $reviews_arr1 += $rat['review']; 
        $review_count++;
    
}


if ($review_count > 0) {
    $avg = $reviews_arr1 / $review_count;
} else {
    $avg = 0; 
}
?>

<span class="rating-number1"><?php 
echo round($avg,1); ?></span>
<span class="star-symbol1"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
</div> <?php }?>
                                        
                                            <div class="add_to_cart  d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                                                <?php if ($product->in_cart == 0) { ?>
                                                    <a class="not_in_cart_<?php echo $product->variant->id; ?>" onclick="addtocartSingleProduct('<?php echo $product->variant->id; ?>', '<?php echo $product->shop_id; ?>', '<?php echo $product->variant->saleprice; ?>')">Add to cart</a>
                                                <?php } else { ?>
                                                    <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                                <?php } ?>
                                                <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            </div></div>
                                        <figcaption class="product_content">
                                            <div class="product_content_inner">
                                            <div class="product-info">
                                                <p class="shop-name">Brand: <?php echo $brand_detail->brand_name; ?></p>
                                                <h4 class="product_name" title="<?php echo $product->name; ?>"><a href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><?php echo $product->name; ?></a></h4>

                                                <div class="price_box">
                                                    <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->saleprice; ?></span>
                                                    <?php if ($product->variant->saleprice != $product->variant->price) { ?>
                                                        <del><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->price; ?></del>
                                                        <span class="discount" style="color: #FF6200;"><?php $offer = ($product->variant->price - $product->variant->saleprice) * 100 / $product->variant->price;
    if(!$offer==0){
        echo "(" . round($offer) . "% OFF)";
    }
             ?></span>
                                                    <?php } ?>
                                                </div></div><?php 
                                                $stock=$product->variant->stock;
                                                $cartlimit=$product->cart_limit;
                                                // print_r($product->cart_limit);
                                                // print_r($product->variant->id);?>
                                                <div class="myquant"><?php if ($product->in_cart == 0) { ?>
                                                    <div id="qty-<?= $product->variant->id; ?>">
                                                    <label for="quantity-select-<?php  echo $product->variant->id; ?>" class="mr-2">Quantity:</label>
                                                    <select id="quantity-select-<?php  echo $product->variant->id; ?>" class="select-style quantity_<?php echo $product->variant->id;  ?>" name="quantity" onchange="checkcart_limit(<?php echo $product->variant->id;  ?>)">
                                                    <?php 
                                                     if($stock<$cartlimit){
                                                        $limit=$stock;
                                                    }
                                                    else{
                                                        $limit = $cartlimit <= 10  || $cartlimit <= $stock? $cartlimit :10;
                                                    }?>
                                                    <?php for ($i = 1; $i <= $limit; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?></select>
                                                </div>
                                            </div>
                                            <?php } ?>
                                           
                                        </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            <?php
                        }}
                    }  else {
                        ?> </div>
                       
                       <div class="noproduct">
               <center>
                                <a href="<?=base_url()?>"><button class="abs-btn"  type="button">Back</button></a>
                                
                               
                              
                            </center>
               </div><div class="nopro">
                   <h3 style="font-size: 17px;
    text-align: center;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0 auto;">No products found!</h3>
    <img src="<?=base_url()?>web_assets/img/noproducts.jpg"/>
    </div>         
                    <?php } ?>
                
            </div>
        </div>
    </div>
</div>

<script>
    function chk_filter(filter_id) {
        var already_checked = 0;
        $(".option_" + filter_id).each(function () {
            if ($(this).prop("checked") == true) {
                $("#" + filter_id).prop("checked", true);
                already_checked += 1;
            }
        });
        if (already_checked > 0) {
            $("#" + filter_id).prop("checked", true);
        } else {
            $("#" + filter_id).prop("checked", false);
        }
    }

    function filter_by_brand(brand_id) {
        $('#brand-' + brand_id).submit();
    }
</script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 