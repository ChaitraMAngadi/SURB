<!--header area end--><!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>"<?php echo $title; ?>" Found  </h3>
                      
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
  <div id="show_errormsg1"></div>
<section class="storesnearbox">
       <div class="container">
           <div class="row justify-content-center">
             <div class="col-lg-10 col-md-12">
                <div class="section_title product_shop_title">
                    <h2>Shops <span>( <?php echo count($shops); ?> )</span></h2>
                </div>
                
              <!-- <h3>Shops ( <?php echo count($shops); ?> )</h3> -->
               <div class="row">
               <?php 
               foreach($shops as $shop){ ?>
                <div class="col-lg-4 col-md-4">
                   <div class="card shadow-sm mb-4">
                       <div class="img-box">
                         <a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop/<?php echo $title;?>"><img src="<?php echo $shop['image']; ?>" alt="" class="card-img-top"></a>
                         <!-- <h5><i class="fal fa-badge-percent"></i><?php echo $shop['deal_products']; ?> DEALS</h5> -->
                       </div>
                       <div class="card-body">
                         <div class="row">
                           <div class="col-lg-12">
                             <h4><a href="<?php echo base_url(); ?>web/store/<?php echo $shop['seo_url']; ?>/shop/<?php echo $title;?>"><?php echo $shop['shop_name']; ?></a></h4>
                             <p><?php //echo substr($shop['description'],0,40)."..."; ?></p>
                             <p><i class="fal fa-map"></i> <?php echo substr($shop['description'],0,40)."..."; ?></p>
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
             </div>
           </div>
       </div>
   </section>


   <div class="shop_area mb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div id="fav_msg" style="text-align: center;"></div>
                <div class="section_title product_shop_title">
                    <h2>Products <span>( <?php echo count($products); ?> )</span></h2>
                </div>
                
                <div class="row shop_wrapper" id="products_list">
                    <?php foreach($products as $deals){ ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>/<?php echo $title;?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>/<?php echo $title;?>"><img src="<?php echo $deals['image']; ?>" alt=""></a>
                                <div class="add_to_cart">
                                    <a  onclick="addtocart(<?php echo $deals['variant_id']; ?>,<?php echo $deals['shop_id']; ?>,'<?php echo $deals['saleprice']; ?>',1)">Add to cart</a>
                                </div>
                            </div>
                            <div class="product_content grid_content">
                                 <a href="<?php echo base_url(); ?>web/product_view/<?php echo $deals['seo_url']; ?>/<?php echo $title;?>"><div class="product_content_inner">
                                    <h4 class="product_name"><a><?php echo $deals['name']; ?></a></h4>
                                    <p class="shop-name"><?php echo $deals['shop']; ?></p>
                                    <div class="price_box">
                                        <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $deals['saleprice']; ?></span>
                                    </div>
                                </div></a>
                                
                            </div>
                            
                        </div>
                    </div>
                    <?php } ?>
                </div>
               
            </div>
            
            
        </div>
    </div>
</div>