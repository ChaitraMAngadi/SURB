<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3><?php echo $shop_name; ?> </h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>web/store/<?php echo $shop_seourl; ?>/shop"><?php echo $shop_name; ?></a></li>
                        <li><?php echo $subcategory_title; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="show_errormsg1"></div>
<!--breadcrumbs area end-->
<!--shop  area start-->
<div class="shop_area mb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 d-none">
                <!--sidebar widget start-->
                <aside class="sidebar_widget mb-3">
                    <div class="widget_inner">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>web/product_filter/<?php echo $catseo_url; ?>/<?php echo $shop_seourl; ?>" >
                            <input type="hidden" name="attributes_counts" value="<?php echo count($attributes); ?>">
                            <input type="hidden" name="catid" value="<?php echo $catid; ?>">
                            <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
                            <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
                            <input type="hidden" name="catseo_url" value="<?php echo $catseo_url; ?>">
                            <input type="hidden" name="shop_seourl" value="<?php echo $shop_seourl; ?>">
                            <div class="widget_list widget_categories">
                                <?php
                                $i = 0;
                                foreach ($attributes as $val) {
                                    ?>
                                    <h3><?php echo $val['title']; ?></h3>
                                    <input type="hidden" name="attribute_title_id<?php echo $i; ?>" value="<?php echo $val['id']; ?>">
                                    <ul>
                                        <?php foreach ($val['attributes_values'] as $values) { ?>
                                            <li><label ><input type="checkbox" name="atributes_value<?php echo $i; ?>[]" value="<?php echo $values['id']; ?>"><span style="margin-left: 10px;"><?php echo $values['title']; ?></span></label></li>
                                    <?php } ?>
                                    </ul><br>
                                    <?php $i++;
                                }
                                ?>
                            </div>
                            <!-- <div class="widget_list widget_categories">
                                <h3>BATTERY CAPACITY</h3>
                                <ul>
                                    <li><a href="#">2000 - 2999 mAh</a></li>
                                    <li><a href="#">3000 - 3999 mAh</a></li>
                                    <li><a href="#">4000 - 4999 mAh</a></li>
                                    <li><a href="#">5000 mAh & Above</a></li>
                                </ul>
                            </div> -->
                            <!-- <div class="widget_list widget_filter">
                                <h3>Filter by price</h3>
                                <div id="slider-range"></div>

                                    <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>" />
                                    <input type="hidden" name="cat_id" value="<?php echo $catid; ?>" />

                                    <input type="text" name="price" id="amount" />

                            </div> -->
                            <?php if (count($attributes) > 0) { ?>
                                <button class="btn btn-primary" type="submit">Filter</button>
<?php } ?>
                        </form>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-12 col-md-12" id="best_selling">
                <!--shop wrapper start-->

                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div id="fav_msg"></div>
                    <!-- <div class="page_amount">
                        <p>Showing 1–12 of 21 results</p>
                    </div> -->
                    <div class="niceselect_option">

                        <select name="lang" onchange="getProducts(this.value)">
                            <option selected value="">Sort by</option>
                            <option  value="1">Price - High to Low</option>
                            <option value="0">Newest First</option>
                            <option value="2">Price - Low to High</option>
                        </select>

                    </div>
                </div>
                <!--shop toolbar end-->
                <div class="row shop_wrapper" id="product_list">

                    <?php
                    if (count($product_details) > 0) {

                        foreach ($product_details as $prod) {
                            ?>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6" >
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $prod['seo_url']; ?>"><img src="<?php echo $prod['image']; ?>" alt=""></a>
                                        <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $prod['seo_url']; ?>"><img src="<?php echo $prod['image']; ?>" alt=""></a>
                                        <div class="label_product">
                                           <!--  <a href=""><span class="label_wishlist"><i class="fal fa-heart"></i></span></a> -->
                                        </div>

                                        <div class="wishlist">
                                            <a title="Add to Wishlist" onclick="addFavorite(<?php echo $prod['id']; ?>)">
                                                <span id="bestselling_pro_<?php echo $prod['id']; ?>" class="<?php if ($prod['whishlist_status'] == true) {
                        echo 'fas';
                    } else {
                        echo 'fal';
                    } ?> fa-heart"></span>
                                            </a>
                                        </div>
                                        <div class="add_to_cart">
                                            <a onclick="addtocart(<?php echo $prod['variant_id']; ?>,<?php echo $prod['shop_id']; ?>, '<?php echo $prod['saleprice']; ?>', 1)">Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="product_content grid_content">
                                        <div class="product_content_inner">
                                            <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $prod['seo_url']; ?>"><?php echo $prod['name']; ?></a></h4>
                                            <div class="price_box">
                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $prod['saleprice']; ?></span>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>

                        <div class="row shop_wrapper" >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: center;">
                                <img src="<?php echo base_url(); ?>/uploads/web_no_products.png" style="width: 250px">
                                <h3 style="text-align: center;">No Products</h3>
                            </div>
                        </div>

<?php }
?>
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
<!--shop  area end-->


<script type="text/javascript">
    function getProducts(type)
    {
        var shop_id = '<?php echo $shop_id; ?>';
        var catid = '<?php echo $catid; ?>';
        var subcatid = '<?php echo $subcatid; ?>';
        $('.error').remove();
        var errr = 0;
        $.ajax({
            url: "<?php echo base_url(); ?>web/sort_products",
            method: "POST",
            data: {type: type, catid: catid, shop_id: shop_id, subcatid: subcatid},
            success: function (data)
            {
                //alert(JSON.stringify(data));
                $('#product_list').html(data);
            }
        });
    }

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