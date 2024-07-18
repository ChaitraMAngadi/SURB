<?php $this->load->view("web/includes/subpage_header"); ?>

<!--breadcrumbs area start-->
<?php if (count($banners) > 0) { ?>
    <div class="breadcrumbs_area mb-3 mt-72">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Sub Categories</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="categories_product_area mb-30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="newcategorybox">
                    <div class="row justify-content-center">
                        
                         <?php foreach ($sub_categories as $sub_cat) { 
                             ?>
                        
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                            <article class="single_categories">
                                <figure>
                                    <div class="categories_thumb">
                                        <a href="#sub_catQAModal<?php echo $sub_cat['id']; ?>" data-toggle="modal"><img src="<?php echo $sub_cat['image']; ?>" alt=""></a>
                                    </div>
                                    <figcaption class="categories_content">
                                        <h4 class="product_name"><a href="#sub_catQAModal<?php echo $sub_cat['id']; ?>" data-toggle="modal"><?php echo $sub_cat['title']; ?></a></h4>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                        
                        <div class="modal fade" id="sub_catQAModal<?php echo $sub_cat['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header position-relative">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                <h4>Question and Answers</h4>
                <p><?php echo $sub_cat['question']; ?></p>

                <a href="#" data-dismiss="modal" class="btn-skip"><i class="fal fa-undo"></i> SKIP</a>
            </div>
            <div class="modal-body">
                <div class="row justify-content-end">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-5 align-self-center d-lg-block d-none">
                                <img src="<?php echo base_url(); ?>web_assets/img/qaside.png" class="img-fluid1" style="opacity:0.9"/>
                            </div>
                            <div class="col-lg-7">
                                <div class="row qaoptions">
                                   

                                    <div class="col-md-12 msgothers">
                                        <input type="text" class="form-control" placeholder="Message"/>
                                    </div>
                                    <div class="col-md-12" style="background-color:#081f66;">
                                        <button type="submit" class="btn btn-outline-light mt-2 btn-lg float-right">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                         <?php }?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("web/includes/footer"); ?>