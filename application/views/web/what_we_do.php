<!--breadcrumbs area start-->

<div class="breadcrumbs_area mb-3">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="breadcrumb_content">

                    <!-- <h3>What We Do</h3> -->

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

            <div class="col-lg-10 whatwedo">
                <p><?php echo $content->description; ?></p>
            </div>

        </div>

    </div>

</section>

<!--about section end-->