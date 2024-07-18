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
                    <h5>Categories</h5>

                    <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
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
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($categories as $cat) {
                                        $cat = $this->db->query("select * from categories where id='".$cat->cat_id."'");
                                        $cat_row = $cat->row();
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?= base_url() ?>uploads/categories/<?= $cat_row->app_image ?>" title="category image">

                                            <p><b>Category Name: </b><span class="font-weight500"><?= $cat_row->category_name ?></span></p>
                                            <p><b>Description: </b><span class="font-weight500"><?= $cat_row->description ?></span></p>
                                            <p><a href="<?= base_url() ?>vendors/categories/viewsubCategory/<?php echo $cat_row->id; ?>">View Sub Categories</a>
                                            </p>
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
