<?php $this->load->view("web/includes/header_styles"); ?>
<!--header area end-->


<!--slider area start-->

<section class="slider_section slider_s_three">

    <div class="slider_area owl-carousel">
        <?php
        //echo "<pre>"; print_r($banners); die;
        foreach ($banners as $bnr) {
            ?>
            <?php if ($bnr['type'] == 'products') { ?>
                <a href="<?php echo base_url(); ?>web/product_view/<?php echo $bnr['product_details']['seo_url']; ?>">
                <?php } else { ?>
                    <a href="<?php echo base_url(); ?>web/store/<?php echo $bnr['product_details']['seo_url']; ?>/shop">
                    <?php } ?>
    <!-- <div class="single_slider d-flex align-items-center" data-bgimg="<?php echo $bnr['image']; ?>"> -->
                    <div class="single_slider">

                        <img src="<?php echo $bnr['image']; ?>" alt="" class="home-slider-img" width="100%">



                    </div></a>
            <?php } ?>

    </div>

</section>

<!--slider area end-->

<div id="show_errormsg1"></div>


<!--categories product area start-->

<div class="categories_product_area mb-30">

    <div class="container">

        <!--        <div class="row">

                    <div class="col-lg-12">

                        <div class="section_title product_shop_title">

                            <h2>Categories</h2> <a href="<?php echo base_url() ?>web/viewAllCategories" class="btn btn-sm pink-btn float-right"> View All </a>

                        </div>



                    </div>


                </div>-->

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="newcategorybox">
                    <div class="row justify-content-center">
                        <?php foreach ($categories as $category) { 
                             ?>
                            
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                <article class="single_categories">
                                    <figure>
                                        <div class="categories_thumb">
                                            <!-- <?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?> -->
                                             <?php if($category['sub_cat'] =="0" || $category['sub_cat'] == ""){?>
                                             <a href="#productQAModal<?php echo $category['id']; ?>" data-toggle="modal"><img src="<?php echo $category['image']; ?>" alt=""></a>
                                             <?php }else{ ?>
                                             
                                             <a href="<?php echo base_url(); ?>web/view_subcategories/<?php echo $category['seo_url']; ?>"><img src="<?php echo $category['image']; ?>" alt=""></a>
                                             <?php }?>
                                        </div>
                                        <figcaption class="categories_content">
                                            <h4 class="product_name"><a><?php echo $category['title']; ?></a></h4>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
<div class="modal fade" id="productQAModal<?php echo $category['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="productQAModal"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header position-relative">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times-circle"></i></button>
                <h4>Question and Answers</h4>
                <p><?php echo $category['question']; ?></p>
                <a href="#" data-dismiss="modal" class="btn-skip"><i class="fal fa-undo"></i> SKIP</a>
            </div>
            <div class="modal-body">

                <div class="row justify-content-end">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-5 align-self-center d-lg-block d-none">
                                <img src="<?php echo base_url(); ?>web_assets/img/qaside.png" class="img-fluid1"/>
                            </div>
                            <div class="col-lg-7">
                                <form method="post" action="<?php echo base_url(); ?>web/options">">
                                    <input type="hidden" name="cat_id" value="">
                                <div class="row qaoptions">
                                    
                                    <?php  foreach ($category['options'] as $option) {  
                                         
                                          ?>
                                    <div class="col-md-12">
                                        <label class="custradiobtn"><?php echo $option->option; ?>
                                            <input type="checkbox" name="option" value="<?php echo $option->id; ?>">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <?php }?>
                                    
<!--                                    <div class="col-md-12">
                                        <label class="custradiobtn">Dandruff
                                            <input type="checkbox" name="dandruff" value="dandruff">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="custradiobtn">Hair fall
                                            <input type="checkbox" name="hairfall" value="hairfall ">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="custradiobtn">Others
                                            <input type="checkbox" name="others" value="others" class="othbtn">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>-->
                                    <div class="col-md-12 msgothers">
                                        <input type="text" name="message" class="form-control" placeholder="Message"/>
                                    </div>
                                    <div class="col-md-12" style="background-color:#081f66;">
                                        <button type="submit" class="btn btn-outline-light mt-2 btn-lg float-right">SUBMIT</button>
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
   } ?>

                          
                        
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

<div class="banner_area banner_area3 mb-50">

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
            <?php foreach ($bannerads as $banner) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a <?php if ($banner['type'] == 'shops') { ?> href="<?php echo base_url(); ?>web/store/<?php echo $banner['product_details']['seo_url']; ?>/shop" <?php } else { ?>href="<?php echo base_url(); ?>web/product_view/<?php echo $banner['product_details']['seo_url']; ?>"<?php } ?>>
                        <div class="single_banner">

                            <div class="banner_thumb">

                                <img src="<?php echo $banner['image']; ?>" alt="">

                            </div>
                            <h4>Flat 30% OFF</h4>
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

<!--banner area end-->


<!--product area start-->
<div id="top_fav_msg" style="text-align: center; padding: 10px;"></div>

<div class="product_area  mb-50">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="section_title product_shop_title">

                    <h2>Top Deals</h2>
                    <a href="<?php echo base_url() ?>web/viewallProducts/topdeals" class="btn btn-sm pink-btn float-right"> View All </a>
                </div>

            </div>

        </div>

        <div class="row" >



            <div class="product_carousel product_column5 owl-carousel" id="topdeals">

                <?php foreach ($topdeals as $deals) { ?>

                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                    <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">Sale</span>
                                    </div>
                                    <div class="wishlist">
                                        <a title="Add to Wishlist" onclick="addremoveTOpDealsFavorite(<?php echo $deals['id']; ?>)"><span id="favoritecls_<?php echo $deals['id']; ?>" class="<?php
                                            if ($deals['whishlist_status'] == true) {
                                                echo 'fas';
                                            } else {
                                                echo 'fal';
                                            }
                                            ?> fa-heart"></span></a>
                                    </div>

                                </div>
                                <figcaption class="product_content">
                                    <div class="product_content_inner">
                                        <p class="shop-name">Brand Name</p>
                                        <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><?php echo $deals['name']; ?></a></h4>

                                                                                                                        <!--                                        <p class="shop-name"><?php echo $deals['shop']; ?></p>-->
                                        <div class="price_box">
                                            <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $deals['price']; ?></span>
                                            <del><i class="fal fa-rupee-sign"></i> <?php echo $deals['saleprice']; ?></del>
                                        </div>
                                    </div>
                                    <div class="add_to_cart">
                                        <a onclick="addtocart(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>', 1)">Add to cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                <?php } ?>

            </div>

        </div>

    </div>

</div>

<!--product area end-->

<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="#">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <img src="<?php echo base_url(); ?>web_assets/img/add-4.png" alt="" class="img-fluid">
                    </div>
                    <h4>Flat 30% OFF</h4>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="#">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <img src="<?php echo base_url(); ?>web_assets/img/add-5.png" alt="" class="img-fluid">
                    </div>
                    <h4>Flat 30% OFF</h4>
                </div>
            </a>
        </div>
    </div>
</div>
<!--trending offers start-->

<div class="product_area  mb-50">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="section_title product_shop_title">

                    <h2>Trending offers</h2>
                    <a href="<?php echo base_url() ?>web/viewallProducts/trending" class="btn btn-sm pink-btn float-right"> View All </a>
                </div>

            </div>

        </div>





        <!-- <div class="toast" id="show_errormsg_trending" style="color: green; text-align: center;"> -->
        <!-- <div class="toast" id="show_errormsg_trending" style="color: green; text-align: center; margin:0px auto;">
            <div class="toast-header">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
             <div class="toast-body">
                Product Added to cart
            </div>
        </div> -->
        <div class="row" id="trending_now">

            <div class="product_carousel product_column5 owl-carousel" >

                <?php foreach ($trending as $deals) { ?>
                    <div class="col-lg-3" >
                        <article class="single_product">
                            <span id="favorites<?php echo $deals['id']; ?>"></span>
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                    <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">Sale</span>
                                    </div>
                                    <div class="wishlist">
                                        <a title="Add to Wishlist" onclick="addFavorite_NEW(<?php echo $deals['id']; ?>)"><span id="rendingfavorites_<?php echo $deals['id']; ?>" class="<?php
                                            if ($deals['whishlist_status'] == true) {
                                                echo 'fas';
                                            } else {
                                                echo 'fal';
                                            }
                                            ?> fa-heart"></span></a>
                                    </div>
                                    <div class="add_to_cart">
                                        <a onclick="addtocart(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>', 1)" >Add to cart</a>
                                    </div>

                                </div>
                                <figcaption class="product_content">
                                    <div class="product_content_inner">
                                        <p class="shop-name">Brand Name</p>
                                        <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><?php echo $deals['name']; ?></a></h4>
    <!--                                        <p class="shop-name"><?php echo $deals['shop']; ?></p>-->
                                        <div class="price_box">
                                            <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $deals['price']; ?></span>
                                            <del><i class="fal fa-rupee-sign"></i> <?php echo $deals['saleprice']; ?></del>

                                        </div>
                                    </div>
                                    
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                <?php } ?>

            </div>

        </div>

    </div>

</div>
<div class="product_area  mb-50">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="section_title product_shop_title">

                    <h2>New arrivals</h2>
                    <a href="<?php echo base_url() ?>web/viewallProducts/topdeals" class="btn btn-sm pink-btn float-right"> View All </a>
                </div>

            </div>

        </div>

        <div class="row" >



            <div class="product_carousel product_column5 owl-carousel" id="topdeals">

                <?php foreach ($topdeals as $deals) { ?>

                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                    <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">Sale</span>
                                    </div>
                                    <div class="wishlist">
                                        <a title="Add to Wishlist" onclick="addremoveTOpDealsFavorite(<?php echo $deals['id']; ?>)"><span id="favoritecls_<?php echo $deals['id']; ?>" class="<?php
                                            if ($deals['whishlist_status'] == true) {
                                                echo 'fas';
                                            } else {
                                                echo 'fal';
                                            }
                                            ?> fa-heart"></span></a>
                                    </div>
                                    <div class="add_to_cart">
                                        <a onclick="addtocart(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>, '<?php echo $deals['saleprice']; ?>', 1)">Add to cart</a>
                                    </div>

                                </div>
                                <figcaption class="product_content">
                                    <div class="product_content_inner">
                                        <p class="shop-name">Brand Name</p>
                                        <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>"><?php echo $deals['name']; ?></a></h4>

                                                                                                                        <!--                                        <p class="shop-name"><?php echo $deals['shop']; ?></p>-->
                                        <div class="price_box">
                                            <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $deals['price']; ?></span>
                                            <del><i class="fal fa-rupee-sign"></i> <?php echo $deals['saleprice']; ?></del>
                                        </div>
                                    </div>
                                    
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                <?php } ?>

            </div>

        </div>

    </div>

</div>
<!--close trending offers-->

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="img-thubnail rounded">
                <iframe width="100%" height="700" src="https://www.youtube.com/embed/Nn7GxIxnuuI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col-12">

            <div class="section_title product_shop_title">

                <h2>Testimonials</h2>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="product_carousel testimonial_collumn1 owl-carousel" >
                <div class="testimonial">
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis commodo nulla dictum felis sollicitudin,
                        euismod finibus augue vulputate. Sed aliquam, elit eu gravida dignissim, justo dolor vulputate ipsum Pellentesque sagittis pretium nibh, et.
                    </p>
                    <div class="pic">
                        <img src="<?php echo base_url(); ?>web_assets/img/testiimg.jpg" alt="">
                    </div>
                    <h3 class="testimonial-title">
                        <span>Title Here</span>
                        <small>Designation</small>
                    </h3>
                </div>

                <div class="testimonial">
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis commodo nulla dictum felis sollicitudin,
                        euismod finibus augue vulputate. Sed aliquam, elit eu gravida dignissim, justo dolor vulputate ipsum Pellentesque sagittis pretium nibh, et. </p>
                    <div class="pic">
                        <img src="<?php echo base_url(); ?>web_assets/img/testiimg.jpg" alt="">
                    </div>
                    <h3 class="testimonial-title">
                        <span>Title Here</span>
                        <small>Designation</small>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<a onclick="addtocart123()" > Add to cart</a>-->


<script type="text/javascript">

    function addremoveTOpDealsFavorite(pid)
    {
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        if (user_id == '')
        {
            $('#loginModal').modal('show');
            return false;
        } else
        {
            $.ajax({
                url: "<?php echo base_url(); ?>web/add_remove_topdeal_whishList",
                method: "POST",
                data: {pid: pid},
                success: function (data)
                {

                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    //location.reload();
                    // $("#topdeals").load(location.href + " #topdeals");

                    // $('html, body').animate({
                    //           scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                    //       }, 'slow');

                    if (res[1] == 'remove')
                    {

                        /* $("#topdeals").load(location.href + " #topdeals");
                         $('#top_fav_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Removed from the Favourites</span>');
                         $('#top_fav_msg').focus();
                         location.reload();
                         return false;*/
                        $("#favoritecls_" + pid).removeClass("fas");
                        $("#favoritecls_" + pid).addClass("fal");

                    } else if (res[1] == 'add')
                    {
                        $("#favoritecls_" + pid).removeClass("fal");
                        $("#favoritecls_" + pid).addClass("fas");
                        /*$('#top_fav_msg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Added to Favourites</span>');
                         $('#top_fav_msg').focus();

                         location.reload();
                         return false;*/
                    }



                }
            });
        }
    }

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
                    <a <?php if ($lastbannerads['type'] == 'shops') { ?> href="<?php echo base_url(); ?>web/store/<?php echo $lastbannerads['product_details']['seo_url']; ?>" <?php } else { ?>href="<?php echo base_url(); ?>web/product_view/<?php echo $lastbannerads['product_details']['seo_url']; ?>"<?php } ?>><img src="<?php echo $lastbannerads['image']; ?>" alt="" class="img-fluid"></a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="banner_text3">

                <h3><?php echo $lastbannerads['title']; ?></h3>

                <h2>up TO 40% off</h2>

                <p>An exclusive selection of this season’s trends. <span>Exclusively online!</span></p>

                <a <?php if ($lastbannerads['type'] == 'shops') { ?> href="<?php echo base_url(); ?>web/store/<?php echo $lastbannerads['product_details']['seo_url']; ?>" <?php } else { ?>href="<?php echo base_url(); ?>web/product_view/<?php echo $lastbannerads['product_details']['seo_url']; ?>"<?php } ?>>shop now</a>

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





<?php $this->load->view("web/includes/footer"); ?>



