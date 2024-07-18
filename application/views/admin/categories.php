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
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <a href="<?= base_url() ?>admin/categories/add">
                            <button class="btn btn-primary">+ Add Category</button>
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
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($categories as $cat) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?= base_url() ?>uploads/categories/<?= $cat->app_image ?>" title="category image">

                                            <p><b>Category Name: </b><span class="font-weight500"><?= $cat->category_name ?></span></p>
                                            <p><b>Description: </b><span class="font-weight500"><?= $cat->description ?></span></p>
                                            <p><b>Sub Categories: </b>
                                                <span>
                                                    <?php
                                                    foreach ($cat->sub_categories as $sub_cat) {
                                                        ?>
                                                        <span>
                                                            <?= $sub_cat->sub_category_name ?> ,
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                </span>
                                                <a href="<?= base_url() ?>admin/sub_categories/add?cat_id=<?=$cat->id?> ">+ Add Sub Category</a>
<!--                                                <a href="<?= base_url() ?>admin/sub_categories/add">+ Add Sub Category</a>-->
                                            </p>
                                        </td>

                                        
                                        <td>
                                            <?php 
                                            if($cat->status==1){?>
                                                <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-success">
                                                Active
                                            </button>
                                            <?php }else{ ?>
                                                <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-danger">
                                                In Active
                                            </button>
                                            <?php } ?>
                                            
                                        </td>

                                        <td><?php echo $cat->priority; ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/categories/edit_category/<?= $cat->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/categories/delete/<?= $cat->id ?>">
                                                <button title="Delete Category" class="btn btn-xs btn-danger" onclick="if(!confirm('Are you sure you want to delete this Category?')) return false;">
                                                    Delete
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/questionaries/other_msg/<?= $cat->id ?>">
                                                <button class="btn btn-xs btn-primary">
                                                    Questionary Message <?= $cat->other_msg_count ? '('.$cat->other_msg_count.')' : '' ?>
                                                </button>
                                            </a>
                                        </td>


                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
