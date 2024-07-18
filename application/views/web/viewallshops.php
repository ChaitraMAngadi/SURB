<!--header area end--><!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Nearest Stores</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><?php echo $title;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<section class="storesnearbox">
       <div class="container">
           <div class="row">
               <?php foreach($shops as $shop){ ?>
                <div class="col-lg-3 col-md-4">
                   <div class="card shadow-sm mb-4">
                       <div class="img-box">
                         <a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop"><img src="<?php echo $shop['image']; ?>" alt="" class="card-img-top"></a>
                         <h5><i class="fal fa-badge-percent"></i><?php echo $shop['deal_products']; ?> DEALS</h5>
                       </div>
                       <div class="card-body">
                         <div class="row">
                           <div class="col-lg-12">
                             <h4><a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop"><?php echo $shop['shop_name']; ?></a></h4>
                             <p><?php echo substr($shop['description'],0,40)."..."; ?></p>
                             <p><i class="fal fa-map"></i> <?php echo $shop['address']; ?></p>
                           </div>
                         </div>
                       </div>
                       <div class="card-footer">
                        <div class="row">
                           <div class="col-lg-6"><p><small><i class="fal fa-map-marker-alt"></i> <?php echo $shop['distance']; ?>Km</small></p></div>
                           <div class="col-lg-6 text-right"><p class="pinkcol"><small><?php echo $shop['product_total']; ?> Products</small></p></div>
                        </div>
                      </div>
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