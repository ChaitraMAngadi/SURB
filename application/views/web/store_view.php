<!--breadcrumbs area start-->
<?php if (count($banners) == 0) { ?>
    <div class="breadcrumbs_area mb-3 mt-72">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">

                        <h3>Category Name <?php //echo $shop_name;                ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!--breadcrumbs area end-->
<!--slider area start-->
<section class="slider_section slider_s_three d-none">
    <div class="slider_area owl-carousel">
        <?php foreach ($banners as $ban) { ?>
            <div class="single_slider inner_slider">
                <img src="<?php echo $ban['image']; ?>" alt="" class="home-slider-img" width="100%">
            </div>
        <?php } ?>
    </div>
</section>

<style type="text/css">
    .inner_slider{
        width: 100%;
        height: 300px;
        object-fit: contain;
    }
</style>
<!-- <section class="slider_section d-lg-block d-md-block d-none">
  <div class="slider_area owl-carousel">
<?php
foreach ($banners as $ban) {
    ?>
                                                                                                                                                                                                <div class="single_slider d-flex align-items-center" data-bgimg="<?php echo $ban['image']; ?>">

                                                                                                                                                                                                </div>
<?php } ?>

  </div>
</section> -->
<!--slider area end-->
<!--slider area start-->
<!-- <section class="slider_section d-lg-none d-md-none d-block">
  <div class="slider_area owl-carousel">
    <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/store_mobile_banner-1.jpg">

    </div>
    <div class="single_slider d-flex align-items-center"data-bgimg="assets/img/store_mobile_banner-2.jpg">

    </div>
  </div>
</section> -->
<!--slider area end-->
<!--categories product area start-->
<div class="categories_product_area mb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_inner">

                        <!--                        <div class="widget_list widget_categories mb-3">
                                                    <h3>Categories</h3>
                                                    <ul>
                                                        <li class="widget_sub_categories sub_categories1"><a href="javascript:void(0)">Hair Care</a>

                                                            <ul class="widget_dropdown_categories dropdown_categories1">
                                                                <li><a href="#productQAModal" data-toggle="modal">Conditioners</a></li>
                                                                <li><a href="#">Gels & other hair products</a></li>
                        <?php foreach ($subcategories as $cat) { ?>
                                                                        <li><a href="<?php echo base_url(); ?>web/product_categories/<?php echo $cat['id']; ?>/<?php echo $vendor_id; ?>"><?php echo $cat['category_name']; ?></a></li>
                        <?php } ?>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>-->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="widget_list widget_filter">
                                    <h3>Price</h3>
                                    <form action="#">
                                        <div id="slider-range"></div>
                                        <button type="submit">Filter</button>
                                        <input type="text" name="text" id="amount" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="widget_list widget_brand">
                                    <h3>Brand</h3>
                                    <ul>
                                        <li><a href="#">St.Botanica <span>(8)</span></a></li>
                                        <li><a href="#">Naturals <span>(5)</span></a></li>
                                        <li><a href="#">Khadi Natural <span>(5)</span></a></li>
                                        <li><a href="#">WOW <span>(5)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php foreach ($best_selling_products as $value) { ?>
                        <div class="col-lg-4" >
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>/<?php echo $cat_url; ?>"><img src="<?php echo $value['image']; ?>" alt=""></a>
                                        <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>/<?php echo $cat_url; ?>"><img src="<?php echo $value['image']; ?>" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                        </div>
                                        <div class="wishlist">
                                            <a title="Add to Wishlist" onclick="addFavorite(<?php echo $value['id']; ?>)"><span id="bestselling_pro_<?php echo $value['id']; ?>" class="<?php
                                                if ($value['whishlist_status'] == true) {
                                                    echo 'fas';
                                                } else {
                                                    echo 'fal';
                                                }
                                                ?> fa-heart"></span></a>
                                        </div>
                                        <div class="add_to_cart">
                                            <a  onclick="addtocart(<?php echo $value['variant_id']; ?>,<?php echo $value['shop_id']; ?>, '<?php echo $value['saleprice']; ?>', 1)">Add to cart</a>
                                        </div>

                                    </div>
                                    <figcaption class="product_content">
                                        <div class="product_content_inner">
                                            <p class="shop-name">Brand Name</p>
                                            <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>/<?php echo $cat_url; ?>"><?php echo $value['shop']; ?></a></h4>
                                            <div class="price_box">
                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $value['saleprice']; ?></span>
                                                <del><i class="fal fa-rupee-sign"></i> <?php echo $value['saleprice']; ?></del>

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
</div>


<div class="categories_product_area mb-30 d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title product_shop_title">
                    <h2 class="text-capitalize">Shop <span>by Category</span></h2>
                    <?php if ($search_title == 'nodata') { ?>
                        <button onclick="goBack()" style="float: right;" class="btn btn-success">Back</button>
                    <?php } else { ?>
                        <form  enctype="multipart/form-data" method="post" accept-charset="utf-8" class="user" action="<?= site_url('web/search_report'); ?>">

                            <input name="searchdata" type="hidden" value="<?php echo $search_title; ?>">

                            <button type="submit" style="float: right;" class="btn btn-success">Back</button>
                        </form>

                    <?php } ?>


                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                    <?php //echo "<pre>"; print_r($categories); ?>
                </div>
            </div>
        </div>
        <div id="show_errormsg1"></div>
        <div class="row">
            <div id="fav_msg" style="text-align: center; padding: 10px;"></div>

            <div class="product_carousel product_column4 owl-carousel">
                <?php foreach ($subcategories as $cat) { ?>
                    <div class="col-lg-3">
                        <article class="single_categories">
                            <figure>
                                <div class="categories_thumb">
                                    <a href="<?php echo base_url(); ?>web/product_categories/<?php echo $cat['seo_url']; ?>/<?php echo $vendor_seo_url; ?>/<?php echo $cat_url; ?>"><img src="<?php echo $cat['image']; ?>" alt=""></a>
                                </div>
                                <figcaption class="categories_content">
                                    <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_categories/<?php echo $cat['seo_url']; ?>/<?php echo $vendor_seo_url; ?>/<?php echo $cat_url; ?>"><?php echo $cat['category_name']; ?></a></h4>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<!--categories product area end-->
<div class="banner_area banner_area3 mb-50 d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <a href="#"><img src="<?php echo $banneradd2; ?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area start-->
<div class="product_area  mb-50 d-none">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="section_title product_shop_title">
                    <h2>Best <span>Selling</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="product_carousel product_column5 owl-carousel" id="best_selling">
                <?php foreach ($best_selling_products as $value) { ?>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>/<?php echo $cat_url; ?>"><img src="<?php echo $value['image']; ?>" alt=""></a>
                                    <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>/<?php echo $cat_url; ?>"><img src="<?php echo $value['image']; ?>" alt=""></a>

                                    <div class="wishlist">
                                        <a title="Add to Wishlist" onclick="addFavorite(<?php echo $value['id']; ?>)">
                                            <span id="bestselling_pro_<?php echo $value['id']; ?>" class="<?php
                                            if ($value['whishlist_status'] == true) {
                                                echo 'fas';
                                            } else {
                                                echo 'fal';
                                            }
                                            ?> fa-heart"></span>
                                        </a>
                                    </div>
                                    <div class="add_to_cart">
                                        <a onclick="addtocart(<?php echo $value['variant_id']; ?>,<?php echo $value['shop_id']; ?>, '<?php echo $value['saleprice']; ?>', 1)">Add to cart</a>
                                    </div>


                                </div>
                                <figcaption class="product_content">
                                    <div class="product_content_inner">
                                        <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $value['seo_url']; ?>/<?php echo $cat_url; ?>"><?php echo $value['name']; ?></a></h4>
                                        <p class="shop-name"><?php echo $value['shop']; ?></p>
                                        <div class="price_box">
                                            <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $value['saleprice']; ?></span>
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
<!--banner area start-->
<div class="banner_area banner_area3 mb-50 d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <a href="#"><img src="assets/img/add-1.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <a href="#"><img src="assets/img/add-4.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="single_banner col3">
                    <div class="banner_thumb">
                        <a href="#"><img src="assets/img/add-5.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner area end-->
<!--product area end-->

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
                    //alert(JSON.stringify(res));
                    //location.reload();

                    if (res[1] == 'remove')
                    {
                        $("#bestselling_pro_" + pid).removeClass("fas");
                        $("#bestselling_pro_" + pid).addClass("fal");
                    } else if (res[1] == 'add')
                    {
                        $("#bestselling_pro_" + pid).removeClass("fal");
                        $("#bestselling_pro_" + pid).addClass("fas");
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
     location.reload();
     $('#show_errormsg').html('<div class="btn btn-success">Product added to cart</div>');
     $('#show_errormsg').focus();
     return false;
     }
     else
     {
     $('#show_errormsg').html('<div class="btn btn-danger">OUT OF STOCK</div>');
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
     $('#show_errormsg').html('<div class="btn btn-success">Product added to cart</div>');
     $('#show_errormsg').focus();
     return false;
     }
     else
     {
     $('#show_errormsg').html('<div class="btn btn-danger">OUT OF STOCK</div>');
     $('#show_errormsg').focus();
     return false;
     }



     }
     });

     }
     }
     }*/
</script>