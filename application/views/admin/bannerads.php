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
                    <h5>Banners AD's</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        
                        <a href="<?= base_url() ?>admin/banneradds/add">
                            <button class="btn btn-primary">+ Add Banner AD</button>
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
                                    <th>Title</th>
                                    <th>Web Image</th>
                                     <th>App Image</th>
                                     <th>Blocks</th>
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
                                        <td><?php echo $v->title; ?></td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?php echo base_url(); ?>uploads/bannerads/<?php echo $v->web_image; ?>" title="Banner image">
                                        </td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?php echo base_url(); ?>uploads/bannerads/<?php echo $v->app_image; ?>" title="Banner image">
                                        </td>
                                           <td><?php if($v->blocks==1){ echo "Banner AD 1"; }else if($v->blocks==2){echo "Banner AD 2";} ?></td>
                                            <td>
                                            <a href="<?= base_url() ?>admin/banneradds/edit/<?= $v->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <!-- <a href="<?= base_url() ?>admin/banneradds/delete/<?= $v->id ?>">
                                                <button title="Delete Category" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a> -->
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
