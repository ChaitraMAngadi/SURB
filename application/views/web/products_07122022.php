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
                            <li><a href="<?php echo base_url(); ?>">Home</a></li><li><?php
                        if ($category != null && $sub_category == null) {
                            echo  $category->category_name;
                        } else if ($searchdata) {
                            echo  $searchdata;
                        } else if ($sub_category) {
                            echo $sub_category->sub_category_name;
                        } else {
                            echo '';
                        }
                        ?></li></ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--breadcrumbs area end-->
<!--slider area start-->
<!--<section class="slider_section slider_s_three d-none">
    <div class="slider_area owl-carousel">
<?php foreach ($banners as $ban) { ?>
                                                            <div class="single_slider inner_slider">
                                                                <img src="<?php echo $ban['image']; ?>" alt="" class="home-slider-img" width="100%">
                                                            </div>
<?php } ?>
    </div>
</section>-->

<style type="text/css">
    .inner_slider{
        width: 100%;
        height: 300px;
        object-fit: contain;
    }
</style>

<!--slider area end-->
<!--categories product area start-->
<div class="categories_product_area mb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!--sidebar widget start-->
                <div class="filter-sidebar d-none">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" onClick="openNav()">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                    <div id="mySidenav" class="sidenav visible-sm visible-xs">
                        <a href="javascript:void(0)" class="closebtn" onClick="closeNav()">&times;</a>
                        test
                    </div>
                </div>
                <aside class="sidebar_widget">
                    <div class="widget_inner">
                        <div class="widget_list widget_filter">
                            <?php
                            if ($basename == 'products-filter-by-questionaries') {
                                unset($_POST['amount_range']);
                                unset($_POST['brand_id']);
                                unset($_POST['filter']);
                                unset($_POST['option']);
                                ?>
                                <form method="post" action="<?= base_url() ?>products-filter-by-questionaries">
                                    <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                                    <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                                    <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                                    <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                                    <input type="hidden" name="message" value="<?php echo $message; ?>" />
                                    <button type="submit">Clear All Filters</button>
                                </form>
                                <?php
                            } else if ($basename == 'search') {
                                unset($_POST['amount_range']);
                                unset($_POST['brand_id']);
                                unset($_POST['filter']);
                                unset($_POST['option']);
                                ?>
                                <form method="post" action="<?= base_url('search') ?>">
                                    <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />
                                    <button type="submit">Clear All Filters</button>
                                </form>
                            <?php } else { ?>
                                <form>
                                    <a href="<?= base_url() ?><?= 'products/' . $category->seo_url . '/' . $option_details->seo_url; ?>"><button>Clear All Filters</button></a>
                                </form>
                            <?php } ?>

                        </div>
                        <?php if ($products) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="widget_list widget_filter">
                                        <h3>Price</h3>
                                        <form method="post" action="<?= base_url() ?><?php
                                        if ($basename == 'products-filter-by-questionaries') {
                                            echo 'products-filter-by-questionaries';
                                        } else if ($basename == 'search') {
                                            echo 'search';
                                        } else {
                                            echo 'products/' . $category->seo_url . '/' . $option_details->seo_url;
                                        }
                                        ?>">
                                            <div id="slider-range"></div>
                                            <input type="text" name="amount_range" id="amount" readonly/>
                                            <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                                            <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                                            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                                            <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                                            <input type="hidden" name="message" value="<?php echo $message; ?>" />
                                            <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />

                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="widget_list widget_brand">
                                        <h3>Brand</h3>
                                        <ul>
                                            <?php
                                            $vals = array_count_values($brands);
                                            $brand = array_unique($brands);
                                            $brand_selected = explode(',', $brand_checked);
                                            foreach ($brand as $brand_id) {
                                                $qry = $this->db->query("select * from attr_brands where id='" . $brand_id . "'");
                                                $brand_detail = $qry->row();
                                                $brand_count = $vals[$brand_detail->id];
                                                ?>
                                                <li>
                                                    <input type="checkbox" class="questions" name="brand_id[]" value="<?= $brand_detail->id ?>" <?= in_array($brand_detail->id, $brand_selected) ? 'checked' : '' ?>/> <?= $brand_detail->brand_name ?> <span>(<?= $brand_count ?>)</span>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <?php
                                    $filter_explode = explode(',', $filter);
                                    $option_explode = explode(',', $option);
                                    ?>

                                    <?php
                                    foreach ($unique_filter_ids as $id) {
                                        $filter_title = ($this->common_model->get_data_row(['id' => $id], 'filters'))->title;
                                        $options_arr = [];
                                        ?>
                                        <div class="widget_list widget_brand">

                                            <input type="checkbox" style="display:none" id="<?= $id ?>" name="filter[]" value="<?= $id ?>" <?php
                                            if ($filter_explode) {
                                                if (in_array($id, $filter_explode)) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> />
                                            <h3><?= $filter_title ?></h3>
                                            <ul>
                                                <?php
                                                foreach ($filters as $option) {
                                                    if ($id == $option['filter_id']) {
                                                        array_push($options_arr, $option['option']);
                                                    }
                                                }
                                                $options = array_unique(explode(',', (implode(',', $options_arr))));
                                                foreach ($options as $option_id) {
                                                    $option = $this->common_model->get_data_row(['id' => $option_id], 'filter_options');
                                                    $option_name = $option->options;
                                                    ?>
                                                    <li>
                                                        <label class="custradiobtn">
                                                            <input type="checkbox" class="questions option_<?= $id ?>" name="option[]" value="<?= $option_id ?>" onchange="chk_filter('<?= $id ?>')" <?php
                                                            if ($option_explode) {
                                                                if (in_array($option_id, $option_explode)) {
                                                                    echo 'checked';
                                                                }
                                                            }
                                                            ?> />
                                                            <span class="checkmark"></span>
                                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span><?= $option_name ?></span>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    <center><button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp;Filter</button></center>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    if ($products) {
                        foreach ($products as $product) {
                            $qry = $this->db->query("select * from attr_brands where id='" . $product->brand . "'");
                            $brand_detail = $qry->row();
                            ?>
                            <div class="col-lg-3">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><img src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""></a>
                                            <a class="secondary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><img src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""></a>
                                            <div class="label_product">
                                                <?php if ($deals['on_sale'] == "active") { ?>
                                                    <span class="label_sale">Sale</span>
                                                <?php } ?>
                                            </div>
                                            <div class="wishlist">
                                                <a title="<?= ($product->whishlist_status == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite('<?php echo $product->variant->id; ?>')"><span id="favoritecls_<?php echo $product->variant->id; ?>" class="<?php
                                                    if ($product->whishlist_status == true) {
                                                        echo 'fas';
                                                    } else {
                                                        echo 'fal';
                                                    }
                                                    ?> fa-heart"></span></a>
                                            </div>
                                            <div class="add_to_cart">
                                                <a onclick="addtocart('<?php echo $product->variant->id; ?>', '<?php echo $product->shop_id; ?>', '<?php echo $product->variant->saleprice; ?>', '1')">Add to cart</a>
                                            </div>

                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_content_inner">
                                                <?php if ($brand_detail->brand_name) { ?><p class="shop-name">Brand: <?php echo $brand_detail->brand_name; ?></p><?php } ?>
                                                <h4 class="product_name"><a href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>"><?php echo $product->name; ?></a></h4>

                                                <div class="price_box">
                                                    <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->saleprice; ?></span>
                                                    <?php if ($product->variant->saleprice != $product->variant->price) { ?>
                                                        <del><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->price; ?></del>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div style="position: relative;left: 20%;">
                            <h3 style="font-size: 20px;">No products found</h3>
                        </div>            
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
                                                    $(function () {
                                                        var min_price = '<?= $min_price ?>';
                                                        var max_price = '<?= $max_price ?>';
                                                        $("#slider-range").slider({
                                                            range: true,
                                                            min: 50,
                                                            max: 5000,
                                                            values: [min_price, max_price],
                                                            slide: function (event, ui) {
                                                                $("#amount").val("Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ]);
                                                            }
                                                        });
                                                        $("#amount").val("Rs." + $("#slider-range").slider("values", 0) +
                                                                " - Rs." + $("#slider-range").slider("values", 1));
                                                    });

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


<script>
    /* Set the width of the side navigation to 250px */
         function openNav() {
            document.getElementById("mySidenav").style.width = "260px";
            }
/* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            }
</script>