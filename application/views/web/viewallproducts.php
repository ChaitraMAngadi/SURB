<!--header area end--><!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3><?php echo $title; ?></h3> -->
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><?php echo $title; ?></li>
                    </ul><br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
// echo "<pre>";
// print_r($products);
// exit;

$categorySums = [];
$subcategorySums = [];


// Iterate through topdeals
foreach ($products as $deals) {
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
?>
<!--breadcrumbs area end-->
<div id="show_errormsg1"></div>

<div class="shop_area mb-80">
    <div class="container">
        <div class="row">
            <div class="fil col-lg-12 col-md-12">
                <!--shop wrapper start-->
<?php 
// echo "<pre>"; ?>
                <!--shop toolbar start-->
                <!-- <div class="shop_toolbar_wrapper">
                    <div class="page_amount">
                        <p>Showing 1–12 of 21 results</p>
                    </div>
                    <div class="niceselect_option">
                        <form class="select_option" action="#">
                            <select name="orderby" id="short">
                                <option selected value="1">Sort by</option>
                                <option  value="2">Price - High to Low</option>
                                <option value="3">Popularity</option>
                                <option value="4">Discount</option>
                                <option value="5">Price - Low to High</option>
                            </select>
                        </form>
                    </div>
                </div> -->
                <!--shop toolbar end-->
                <div id="fav_msg" style="text-align: center;"></div>
                <div class="row  shop_wrapper viewpro" id="products_list">
                    <?php foreach ($products as $deals) { 
                        // print_r($deals);exit;
                        ?>
                        <div class="filter_cards  col-lg-3 col-md-3 col-sm-3 col-xl-3 col-xxl-3 " style="margin-top:20px;flex: 0;">
                            <article class="view_prod single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <!-- <a class="primary_img" href="<?php echo base_url(); ?>single-product/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a> -->
                                        <a class="primary_img" href="<?php echo base_url(); ?>product/<?php echo url_title($deals['id'], '-', TRUE); ?>/<?php echo url_title($deals['name'], '-', TRUE); ?>/<?php echo url_title($deals['descp'], '-', TRUE); ?>/<?php echo url_title($deals['meta_tag_keywords'], '-', TRUE); ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                        <!-- <a class="secondary_img" href="<?php echo base_url(); ?>single-product/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a> -->
                                        <a class="secondary_img" href="<?php echo base_url(); ?>product/<?php echo url_title($deals['id'], '-', TRUE); ?>/<?php echo url_title($deals['name'], '-', TRUE); ?>/<?php echo url_title($deals['descp'], '-', TRUE); ?>/<?php echo url_title($deals['meta_tag_keywords'], '-', TRUE); ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                        <div class="label_product">
                                            <?php
                                            //  if ($deals['on_sale'] == "active") { ?>
                                                <!-- <span class="label_sale">Sale</span> -->
                                            <?php 
                                        // } ?>
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
// echo $cat_name;
// echo $sub_name;
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
                                        <div class="add1">  <?php if ($deals['rating']['rating_data']>0) {?>
                                        <div class="starrating2">
                                      
                                       <?php
$reviews_arr1 = 0; 
$review_count = 0; 

foreach ($deals['rating']['reviews'] as $rat) {
   
        $reviews_arr1 += $rat['review']; 
        // print_r($rat['review']);
        $review_count++;
    
}


if ($deals['rating']['rating_data'] > 0) {
    $avg = $reviews_arr1 / $deals['rating']['rating_data'];
    // $avg1=number_format((float)$avg,2,'.','');
    // print_r( $deals['rating']['rating_data']);
} else {
    $avg = 0; 
}
?>

<span class="rating-number"><?php 
echo round($avg,1); ?></span>
<span class="star-symbol"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
</div> <?php }?>
                                        <div class="add_to_cart d-lg-block d-md-block d-sm-none d-none">
                                            <?php if ($deals['in_cart'] == 0) { ?>
                                                <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                            <?php } else { ?>
                                                <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>
                                            <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                        </div></div>

                                    </div>

                                    <div class="add2">  <?php if ($deals['rating']['rating_data']>0) {?>
                                        <div class="starrating1 rating_add">
                                      
                                       <?php
$reviews_arr1 = 0; 
$review_count = 0; 

foreach ($deals['rating']['reviews'] as $rat) {
   
        $reviews_arr1 += $rat['review']; 
        // print_r($rat['review']);
        $review_count++;
    
}


if ($deals['rating']['rating_data'] > 0) {
    $avg = $reviews_arr1 / $deals['rating']['rating_data'];
    // $avg1=number_format((float)$avg,2,'.','');
    // print_r( $deals['rating']['rating_data']);
} else {
    $avg = 0; 
}
?>

<span class="rating-number1"><?php 
echo round($avg,1); ?></span>
<span class="star-symbol1"><img src="<?php echo base_url(); ?>web_assets/img/star-icon.svg"></span>
</div> <?php }?>
                                        <div class="add_to_cart d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                                            <?php if ($deals['in_cart'] == 0) { ?>
                                                <a class="not_in_cart_<?php echo $deals['variant_id']; ?>" onclick="addtocartSingleProduct(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>')">Add to cart</a>
                                            <?php } else { ?>
                                                <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                            <?php } ?>
                                            <a class="in_cart_<?php echo $deals['variant_id']; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                                        </div></div>

                                    <figcaption class="product_content">
                                        <div class="product_content_inner">
                                        <div class="product-info">
                                            <?php if ($deals['brand']) { ?>
                                                <p class="shop-name">Brand: <?php echo $deals['brand']; ?></p>
                                            <?php } ?>
                                            <h4 class="product_name" title="<?php echo $deals['name']; ?>"><a href="<?php echo base_url(); ?>single-product/<?php echo $deals['seo_url']; ?>"><?php echo $deals['name']; ?></a></h4>

                                                                                                                                                                                <!--                                        <p class="shop-name"><?php echo $deals['shop']; ?></p>-->
                                            <div class="price_box">
                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $deals['saleprice']; ?></span>
                                                <?php if ($deals['saleprice'] != $deals['price']) { ?>
                                                    <del><i class="fal fa-rupee-sign"></i> <?php echo $deals['price']; ?></del>
                                                
                                                <span class="discount" style="color: #FF6200;"><?php $offer = ($deals['price'] - $deals['saleprice']) * 100 / $deals['price'];
    if(!$offer==0){
        echo "(" . round($offer) . "% OFF)";
    }
     }  ?></span>
                                            </div></div><?php
                                             $stock=$deals['stock'];
                                             $cartlimit=$deals['cart_limit'];
                                            //  print_r($deals['stock']);?>
                                            <div class="myquant">
                                            <?php if ($deals['in_cart'] == 0) { ?>
                                                <div id="qty-<?= $deals['variant_id'] ?>">
            <label for="quantity-select-<?php echo $deals['variant_id']; ?>" class="mr-2">Quantity:</label>
            <select id="quantity-select-<?php echo $deals['variant_id']; ?>" class="select-style quantity_<?php echo $deals['variant_id']; ?>" name="quantity" onchange="checkcart_limit(<?php echo $deals['variant_id']; ?>)">
            <?php
            //  $limit=$deals['stock'] < 10 ? $deals['stock'] : 10;
            if($stock<$cartlimit){
                $limit=$stock;
            }
            else{
                $limit = $cartlimit <= 10  || $cartlimit <= $stock? $cartlimit :10;
            }
           ?>
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
                    <?php } ?>
                </div>

                <style>
                    .pagination_new {
                        text-align: center;
                    }
                    .pagination_new a {
                        padding: 10px 15px;
                        background-color: #fff;
                        border:1px solid #ccc;
                        color: #333;
                        margin: 0px 1px;
                    }
                    .pagination_new strong {
                        padding: 10px 15px;
                        background-color: #2556B9;
                        color: #fff;
                        margin: 0px 1px;
                    }
                </style>
                <div class="pagination_new">
                    <p><?php echo $links; ?></p>
                </div>
                <!-- <div class="shop_toolbar t_bottom">
                    <div class="pagination">
                        <ul>
                            <li class="current">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next"><a href="#">next</a></li>
                            <li><a href="#">>></a></li>
                        </ul>
                    </div>
                </div> -->
                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>


        </div>
    </div>
</div>
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
                                                                        $("#bestselling_pro_" + pid).removeClass("fas");
                                                                        $("#bestselling_pro_" + pid).addClass("fal");
                                                                        toastr.info("Removed from wishlist!")
                                                                    } else if (res[1] == 'add')
                                                                    {
                                                                        $("#bestselling_pro_" + pid).removeClass("fal");
                                                                        $("#bestselling_pro_" + pid).addClass("fas");
                                                                        toastr.info("Added to wishlist!")
                                                                    }



                                                                }
                                                            });
                                                        }
                                                    }


                                                    /*function addtocart(variant_id,vendor_id,saleprice,quantity)
                                                     {
                                                     var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
                                                     if(user_id=='')
                                                     {
                                                     
                                                     $('#loginModal').modal('show');
                                                     return false;
                                                     
                                                     }
                                                     else
                                                     {
                                                     
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

</script>