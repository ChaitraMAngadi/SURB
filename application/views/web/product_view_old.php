<?php $this->load->view("web/includes/header_styles"); ?>
<!--product details start-->
<div class="product_details pt-100">
    <div class="container">
        <div class="row">
            <div id="show_errormsg1"></div>



            <?php //echo "<pre>"; print_r($product_details['attributes']); ?>
            <div class="col-lg-4 col-md-5">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img id="zoom1" src="<?php echo $product_details['link_variants'][0]['imageslist'][0]['image']; ?>" data-zoom-image="<?php echo $product_details['link_variants'][0]['imageslist'][0]['image']; ?>" alt="big-1" style="width: 100%; height: 400px; object-fit: contain;">
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
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="product_d_right">
                    <!-- <div class="label_product">
                                    <a href="#"><span class="label_wishlist"><i class="fal fa-heart"></i></span></a>
                                </div> -->
                    <div class="productd_title_nav">
                        <h1><a href="#"><?php echo $product_details['name']; ?></a></h1>



                        <?php if ($search_title == 'nodata') { ?>
                            <button onclick="goBack()" class="btn btn-outline-primary">Back</button>
                        <?php } else { ?>
                            <form  enctype="multipart/form-data" method="post" accept-charset="utf-8" class="user" action="<?= site_url('web/search_report'); ?>">

                                <input name="searchdata" type="hidden" value="<?php echo $search_title; ?>">

                                <button type="submit" class="btn btn-outline-primary">Back</button>
                            </form>

                        <?php } ?>

                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                    </div>
                    <!-- <p><small>(6 GB RAM)</small></p> -->
                    <div class="price_box">
                        <span class="old_price"><small><i class="fal fa-rupee-sign"></i> <?php echo $product_details['link_variants'][0]['price']; ?></small></span>
                        <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $product_details['link_variants'][0]['saleprice']; ?></span>
                        <?php
                        $discount = (($product_details['link_variants'][0]['price'] - $product_details['link_variants'][0]['saleprice']) * 100) / $product_details['link_variants'][0]['price'];
                        ?>
                        <span class="text-success"><small><?php echo number_format($discount, 2); ?>% OFF</small></span>
                    </div>
                    <!-- <div class="price_box"><span class="text-success"><small>Extra ₹3000 OFF</small></span></div> -->
                    <div class="product_desc">
<!--                        <p class="shopName"><b>Shop : </b><a href="<?php echo base_url(); ?>web/store/<?php echo $product_details['seo_url']; ?>/shop"><?php echo $product_details['shop']; ?></a>( <?php echo $product_details['vendor_description']; ?> )</p>-->
                        <p><?php echo $product_details['category_name']; ?> <i class="fal fa-angle-right"></i> <?php echo $product_details['subcategory_name']; ?></p>
                        <p><b>Brand : </b><?php echo $product_details['brand_id']; ?></p>

                        <p><b>Description : </b><?php echo $product_details['description']; ?></p>

<!--                        <p><b>Return Availability : </b><?php echo $product_details['return_status']; ?></p>-->

<!--                        <div class="d-inline border border-primary p-2 mr-2 bg-white text-black font-weight-bold" style="cursor:pointer">
                            <span>[ 500ml ]</span>
                            <span class="current_price text-black font-weight-bold" style="font-size:15px;color:#081f66"><i class="fal fa-rupee-sign"></i> 200</span>
                            <del style="font-size:12px;color:black"><i class="fal fa-rupee-sign text-black font-weight-bold"></i> 300</del>
                        </div>-->

                    </div>

                    <?php if (count($product_details['attributes']) > 0) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (!empty($this->session->tempdata('success_message'))) { ?>
                                    <div class="btn btn-danger alert-success" ><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>
                                    </div>
                                <?php } ?>
                                <form method="post" action="<?php echo base_url(); ?>web/productfilters/<?php echo $product_id; ?>" class="form-horizontal" enctype="multipart/form-data" >
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <input type="hidden" name="seo_url" value="<?php echo $seo_url; ?>">

                                    <input type="hidden" name="total_count" value="<?php echo count($product_details['attributes']); ?>">
                                    <?php
                                    $attribute_values = $product_details['attributes'];
                                    $selected_linkvarinats = $linkvarinats;
                                    $i = 0;
                                    foreach ($attribute_values as $values) {


                                        $type_id = $values['id'];
                                        ?>
                                        <div class="product_variant color">
                                            <h3>Available <?php echo $values['attribute_type']; ?>
                                                <label><input type="hidden" name="attribute_type<?php echo $i; ?>" value="<?php echo $values['id']; ?>"></label>


                                            </h3>
                                            <label></label>
                                            <ul>
                                                <?php
                                                $aatribut_values = $values['attribute_values'];
                                                foreach ($aatribut_values as $values_list) {
                                                    //echo  $values_list['id']."-".$selected_linkvarinats[$i]->attribute_value;
                                                    ?>

                                                    <li style="padding: 5px;" ><label><input type="radio" <?php
                                                            if ($values_list['id'] == $selected_linkvariants[$i]->attribute_value) {
                                                                echo "checked='checked'";
                                                            }
                                                            ?> name="attribute_value<?php echo $i; ?>" value="<?php echo $values_list['id']; ?>"><?php echo $values_list['value']; ?></label></li>
                                                    <?php } ?>

                                            </ul>
                                        </div>

                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    <button type="submit" class="button"> Select</button>
                                </form>

                            </div>





                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="product_variant quantity">
                            <!--  <label>quantity</label> -->
                            <a  onclick="decreaseQty()"><i class="fas fa-minus"></i></a>
                            <input min="1" max="100" id="quantity" value="<?php echo $product_qry; ?>" type="text" readonly="">
                            <a onclick="increaseQty()" class="ml-3"><i class="fas fa-plus"></i></a>
                            <button class="button" type="submit" onclick="addtocartproductview(<?php echo $product_details['link_variants'][0]['id']; ?>,<?php echo $product_details['shop_id']; ?>, '<?php echo $product_details['link_variants'][0]['saleprice']; ?>')"><i class="fal fa-shopping-cart"></i> <strong>
                                    ADD TO CART
                                </strong></button>

                            <a onclick="addFavorite(<?php echo $product_details['id']; ?>)" title="Add to Wishlist" class="btn blue-btn">
                                <span  id="product_view" class="<?php
                                if ($product_details['whishlist_status'] == true) {
                                    echo 'fas';
                                } else {
                                    echo 'fal';
                                }
                                ?> fa-heart"></span>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="product_variant color">
                                <h3>HIGHLIGHTS</h3>
                                <ul class="highlights">
                                    <li><?php echo $product_details['key_features']; ?></li>
                                </ul>

                                <p ><b style="color: #0857c0;">Image Disclaimer:</b> The product images shown may represent the range of product, or be for illustration purposes only and may not be an exact</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li >
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Ingredients</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">How To Use</a>
                            </li>
                              <li>
                                <a data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">User Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" >
                            <div class="product_info_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                <p>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.</p>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Ipsum metus feugiat sem, quis fermentum turpis eros eget velit.</li>
                                    <li>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                </ul>
                                <h4>About</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="sheet" role="tabpanel" >
                            <div class="product_info_content">
                                <h4>Features</h4>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Ipsum metus feugiat sem, quis fermentum turpis eros eget velit.</li>
                                    <li>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel" >
                            <div class="product_info_content">
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Ipsum metus feugiat sem, quis fermentum turpis eros eget velit.</li>
                                    <li>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="comments" role="tabpanel" >
                            <div class="product_info_content">
                                <div class="row">
                                    <div class="col-md-4">
                                      
                                      <div class="side">
                                        <div>5 star</div>
                                      </div>
                                      <div class="middle">
                                        <div class="bar-container">
                                          <div class="bar-5"></div>
                                        </div>
                                      </div>
                                      <div class="side right">
                                        <div>2456</div>
                                      </div>
                                      <div class="side">
                                        <div>4 star</div>
                                      </div>
                                      <div class="middle">
                                        <div class="bar-container">
                                          <div class="bar-4"></div>
                                        </div>
                                      </div>
                                      <div class="side right">
                                        <div>389</div>
                                      </div>
                                      <div class="side">
                                        <div>3 star</div>
                                      </div>
                                      <div class="middle">
                                        <div class="bar-container">
                                          <div class="bar-3"></div>
                                        </div>
                                      </div>
                                      <div class="side right">
                                        <div>245</div>
                                      </div>
                                      <div class="side">
                                        <div>2 star</div>
                                      </div>
                                      <div class="middle">
                                        <div class="bar-container">
                                          <div class="bar-2"></div>
                                        </div>
                                      </div>
                                      <div class="side right">
                                        <div>200</div>
                                      </div>
                                      <div class="side">
                                        <div>1 star</div>
                                      </div>
                                      <div class="middle">
                                        <div class="bar-container">
                                          <div class="bar-1"></div>
                                        </div>
                                      </div>
                                      <div class="side right">
                                        <div>70</div>
                                      </div>

                                    </div><!--col-md-8-->
                                </div><!--row-->

                                <div class="user-rating-coment">
                                    <div class="mt-3">
                                         <div class="d-flex mt-2">
                                   <!--  <div class="user-profile-img">
                                        <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                    </div> -->
                                    <div class="rating-btn ml-0">
                                        <a href="#" class="btn "><i class="fas fa-star"></i> 5</a>
                                    </div>
                                </div><!--row-->
                                <div>
                                    <p class="mb-0 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                                </div>
                                 <div class="d-flex mt-2">
                                    <div class="user-profile-img">
                                      <span>Revathimaheshwar</span>
                                    </div>
                                    <div class="rating-btn">
                                        <span>11months ago</span>
                                    </div>
                                </div><!--row-->
                                    </div>

                                    <div class="mt-3">
                                         <div class="d-flex mt-2">
                                  <!--   <div class="user-profile-img">
                                        <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                    </div> -->
                                    <div class="rating-btn oarnge-btn  ml-0">
                                        <a href="#" class="btn "><i class="fas fa-star"></i> 4</a>
                                    </div>
                                </div><!--row-->
                                <div>
                                    <p class="mb-0 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                                </div>
                                 <div class="d-flex mt-2">
                                    <div class="user-profile-img">
                                      <span>Harish</span>
                                    </div>
                                    <div class="rating-btn">
                                        <span>9 months ago</span>
                                    </div>
                                </div><!--row-->
                                    </div>

                                    <div class="mt-3">
                                         <div class="d-flex mt-2">
                                  <!--   <div class="user-profile-img">
                                        <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                    </div> -->
                                    <div class="rating-btn sky-blue-btn  ml-0">
                                        <a href="#" class="btn "><i class="fas fa-star"></i> 4</a>
                                    </div>
                                </div><!--row-->
                                <div>
                                    <p class="mb-0 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                </div>
                                 <div class="d-flex mt-2">
                                    <div class="user-profile-img">
                                      <span>Vamsi</span>
                                    </div>
                                    <div class="rating-btn">
                                        <span>9 months ago</span>
                                    </div>
                                </div><!--row-->
                                    </div>


                                    <div class="mt-3">
                                         <div class="d-flex mt-2">
                                   <!--  <div class="user-profile-img">
                                        <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                    </div> -->
                                    <div class="rating-btn dark-blue-btn  ml-0">
                                        <a href="#" class="btn "><i class="fas fa-star"></i> 4</a>
                                    </div>
                                </div><!--row-->
                                <div>
                                    <p class="mb-0 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                </div>
                                 <div class="d-flex mt-2">
                                    <div class="user-profile-img">
                                      <span>Manoj</span>
                                    </div>
                                    <div class="rating-btn">
                                        <span>9 months ago</span>
                                    </div>
                                </div><!--row-->
                                    </div>

                                    <div class="mt-3">
                                         <div class="d-flex mt-2">
                                   <!--  <div class="user-profile-img">
                                        <img src="https://colormoon.in/absolute_mens_new/web_assets/img/testiimg.jpg" class="img-fluid" alt="">
                                    </div> -->
                                    <div class="rating-btn red-btn  ml-0">
                                        <a href="#" class="btn "><i class="fas fa-star"></i> 4</a>
                                    </div>
                                </div><!--row-->
                                <div>
                                    <p class="mb-0 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                </div>
                                 <div class="d-flex mt-2">
                                    <div class="user-profile-img">
                                      <span>Kumar</span>
                                    </div>
                                    <div class="rating-btn">
                                        <span>9 months ago</span>
                                    </div>
                                </div><!--row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="section_title product_shop_title">
                    <h2>Related Products</h2>
                </div>
            </div>
            <div class="row" id="trending_now">

                <div class="product_carousel product_column5 owl-carousel" >

                    <?php
                    for ($i = 1;
                            $i <= 5;
                            $i++) {
                        ?>
                        <div class="col-lg-3" >
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="https://colormoon.in/absolute_mens_new/uploads/products/20220422192708299628_product_3.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="https://colormoon.in/absolute_mens_new/uploads/products/20220422192708299628_product_3.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                        </div>
                                        <div class="wishlist">
                                            <a title="Add to Wishlist" onclick="addFavorite_NEW(1)"><span id="rendingfavorites_1" class="fal fa-heart"></span></a>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="#">Add to cart</a>
                                        </div>

                                    </div>
                                    <figcaption class="product_content">
                                        <div class="product_content_inner">
                                            <p class="shop-name">Brand Name</p>
                                            <h4 class="product_name"><a href="#">Ustra Tan Den Cream</a></h4>
                                            <div class="price_box">
                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> 500</span>
                                                <del><i class="fal fa-rupee-sign"></i> 1000</del>

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
<!--product details end-->
<!--product info start-->
<div class="product_d_info mb-77 mt-5">
    <div class="container">

    </div>
</div>
<!--product info end-->
<style type="text/css">

    .active_values{
        background-color: #cf1673;
        color: #ffffff;
    }
</style>

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
                    } else if (res[1] == 'add')
                    {

                        $("#product_view").removeClass("fal");
                        $("#product_view").addClass("fas");
                    }



                }
            });
        }
    }


    setTimeout(function () {
        $('.alert-success').fadeOut('fast');
    }, 5000);
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
    function increaseQty()
    {
        var quantity = $("#quantity").val();
        var qty = 1;
        var final = parseInt(qty) + parseInt(quantity);
        $("#quantity").val(final);
    }

    function decreaseQty()
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



    /*function addtocart(variant_id,vendor_id,saleprice)
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
<?php $this->load->view("web/includes/footer"); ?>