<!--header area end--><!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3><?php 
                    // echo $content->title; ?></h3> -->
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">home</a></li>
                        <li><?php echo $content->title; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<!--about section area -->
<section class="about_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="about_content">
                            <h1><?php echo $content->title; ?></h1>
                            <p><?php echo $content->description; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="about_thumb">
                            <img src="<?php echo base_url(); ?>web_assets/img/abt.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--about section end-->