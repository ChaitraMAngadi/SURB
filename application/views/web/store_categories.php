<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h4>Stores</h4>
                    <h3><?php echo $category_name; ?> Near You</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<section class="storesnearbox">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div  class="text_center ">
                    <ul class="store_list">
                        <?php foreach ($sub_category_list as $subcat) { ?>
                            <li class="list <?php if ($subcat['id'] == $subcatid) { ?>storeactive<?php } ?>"><a href="<?php echo base_url(); ?>web/store_wise_categories/<?php echo $seo_url; ?>/<?php echo $subcat['seo_url']; ?>"><?php echo $subcat['title']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">


    </style>

</section>

<section class="storesnearbox">
    <div class="container">
        <div class="row">
            <?php
            if (count($shops) > 0) {
                foreach ($shops as $value) {
                    ?>
                    <div class="col-lg-3 col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div class="img-box">
                                <a href="<?php echo base_url(); ?>web/store/<?php echo $value['seo_url']; ?>/<?php echo $seo_url; ?>/shop"><img src="<?php echo $value['image']; ?>" alt="" class="card-img-top"></a>
                                <!--<h5> <i class="fal fa-badge-percent"></i> OFFERS </h5>-->
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4><a href="<?php echo base_url(); ?>web/store/<?php echo $value['seo_url']; ?>/<?php echo $seo_url; ?>/shop"><?php echo $value['shop_name']; ?></a></h4>
                                        <p><i class="fal fa-map mr-1"></i><?php // echo $value['address'];  ?><?php echo $value['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6"><p><small><i class="fal fa-map-marker-alt"></i> <?php echo $value['distance']; ?>Km</small></p></div>
                                    <div class="col-lg-6 text-right"><p class="pinkcol"><small><?php echo $value['product_total']; ?> Products</small></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                ?>


                <div class="row shop_wrapper" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: center;">
                        <img src="<?php echo base_url(); ?>/uploads/noshop.png" style="width: 11%;margin: 1% 0;">
                        <h3 style="text-align: center; font-size: 20px; color: #d01b76;">No Shops</h3>
                    </div>
                </div>

            <?php } ?>
        </div>


        <style>
            .pagination_new {
                text-align: center;
            }
            .pagination_new a {
                padding: 10px 15px;
                background-color: #ccc;
                color: #333;
                margin: 0px 1px;
            }
            .pagination_new strong {
                padding: 10px 15px;
                background-color: #cf1673;
                color: #fff;
                margin: 0px 1px;
            }
        </style>
        <div class="pagination_new">
            <p><?php echo $links; ?></p>
        </div>

        <!-- <div class="row">
          <div class="col-lg-12">
            <div class="shop_toolbar t_bottom mt-3">
                     <div class="pagination">
                         <ul>
                             <li class="current">1</li>
                             <li><a href="#">2</a></li>
                             <li><a href="#">3</a></li>
                             <li class="next"><a href="#">next</a></li>
                             <li><a href="#">&gt;&gt;</a></li>
                         </ul>
                     </div>
                 </div>
          </div>
        </div> -->
    </div>
</section>