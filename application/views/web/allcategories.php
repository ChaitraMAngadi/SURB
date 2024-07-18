<!--header area end--><!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">home</a></li>
                        <li>Categories</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<div class="categories">
    <div class="container">
        <div class="row">
            <?php foreach($categories as $category){ ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <article class="single_categories">
                    <figure>
                        <div class="categories_thumb">
                            <a href="<?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?>"><img src="<?php echo $category['image']; ?>" alt=""></a>
                        </div>
                        <figcaption class="categories_content">
                            <h4 class="product_name"><a href="<?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></h4>
                        </figcaption>

                    </figure>
                </article>
            </div>
        <?php } ?> 
        </div>
    </div>
</div>