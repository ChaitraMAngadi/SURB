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
                    <h5>Vendor Banners</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <!-- <a href="<?= base_url() ?>vendors/banners/add">
                            <button class="btn btn-primary">+ Add Banner</button>
                        </a> -->
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
                    <?php } ?>
                    
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Details</th>
                                    <th>Title</th>
                                    <th>Web Image</th>
                                     <th>App Image</th>
                                     <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($banners as $v) {

                                    $vendor = $this->db->query("select * from vendor_shop where id='".$v->shop_id."'"); 
                                    $vendor_shops = $vendor->row();


                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><p><b>Shop Name : </b><?php echo $vendor_shops->shop_name; ?></p>
                                            <p><b>Owner Name :</b> <?php echo $vendor_shops->shop_name; ?></p>
                                            <p><b>Email :</b> <?php echo $vendor_shops->email; ?></p>
                                            <p><b>Mobile :</b> <?php echo $vendor_shops->mobile; ?></p>
                                        </td>
                                        <td><?php echo $v->title; ?></td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?php echo base_url(); ?>uploads/banners/<?php echo $v->web_banner; ?>" title="Banner image">
                                        </td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?php echo base_url(); ?>uploads/banners/<?php echo $v->app_banner; ?>" title="Banner image">
                                        </td>
                                        <td><?php
                                        if ($v->status == 1) {
                                            ?>
                                            <a href="<?= base_url() ?>admin/vendor_banners/changeStatus/<?= $v->id ?>/0"><button title="Active" class="btn btn-xs btn-green">Active</button></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?= base_url() ?>admin/vendor_banners/changeStatus/<?= $v->id ?>/1"><button title="Inactive" class="btn btn-xs btn-danger">
                                                Inactive
                                            </button></a>
                                            <?php
                                        }
                                        ?></td>

                                        <td>
                                            <!-- <a href="<?= base_url() ?>vendors/banners/edit/<?= $v->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a> -->
                                            <a href="<?= base_url() ?>vendors/banners/delete/<?= $v->id ?>">
                                                <button title="Delete Banner" class="btn btn-xs btn-danger">
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
