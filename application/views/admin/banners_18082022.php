<style>
    .cat_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Banners</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <a href="<?= base_url() ?>admin/banners/add">
                            <button class="btn btn-primary">+ Add Banner</button>
                        </a>
                    </div>

                    <?php if (!empty($this->session->tempdata('success_message'))) { ?>
                        <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($this->session->tempdata('error_message'))) { ?>
                        <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Failed!</strong> <?= $this->session->tempdata('error_message') ?>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
<!--                                    <th>Title</th>-->
                                    <th>Web Image</th>
<!--                                     <th>App Image</th>-->
<!--                                     <th>Location</th>-->
                                     <th>Shop / Product</th>
                                     <th>Position</th>
                                     <th>Flat Discount</th>
                                     <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($banners as $v) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
<!--                                        <td><?php echo $v->title; ?></td>-->
                                        <td>
                                            <img class="cat_image" align="left" src="<?php echo base_url(); ?>uploads/banners/<?php echo $v->web_image; ?>" title="Banner image">
                                        </td>
<!--                                        <td>
                                            <img class="cat_image" align="left" src="<?php echo base_url(); ?>uploads/banners/<?php echo $v->app_image; ?>" title="Banner image">
                                        </td>-->

<!--                                         <td><?php
                                         $loc = $this->db->query("select * from cities where id='".$v->location_id."'");
                                         $locations = $loc->row();
                                            echo $locations->city_name;
                                          ?></td>-->


                                           <td>
                                            <b><?php echo $v->type; ?> : </b>

                                            <?php if($v->type=='products'){
                                            $pro = $this->db->query("select * from products where id='".$v->product_id."'");
                                            $products = $pro->row();
                                            echo $products->name;
                                           }else if($v->type=='shops'){
                                                $vend = $this->db->query("select * from vendor_shop where id='".$v->shop_id."'");
                                                $vendors = $vend->row();
                                                echo $vendors->shop_name;
                                           }  
                                           ?>
                                           </td>
                                         
<!--                                         <td>
                                            <?php 
                                           $pro = $this->db->query("select * from products where id='".$v->product_id."'");
                                            $products = $pro->row();?>
                                           <?=$products->name?></td>-->

                                           <td><?php if($v->position==1){ echo 'First Banner'; }else if($v->position==2){ echo 'Second Banner'; }else if($v->position==3){ echo 'Third Banner'; } ?></td>
                                           <td><?php echo $v->flat_discount; ?></td>
                                           <td>
                                            <?php 
                                            if($v->status==1){?>
                                                <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-success">
                                                Active
                                            </button>
                                            <?php }else{ ?>
                                                <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-danger">
                                                In Active
                                            </button>
                                            <?php } ?>
                                            
                                        </td>
                                        <td> 
                                            <a href="<?= base_url() ?>admin/banners/edit/<?= $v->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/banners/delete/<?= $v->id ?>">
                                                <button title="Delete Category" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a>
                                        </td>


                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
