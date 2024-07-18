<style>
    .cat_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Sub Categories</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <a href="<?= base_url() ?>admin/sub_categories/add">
                            <button class="btn btn-primary">+ Add Sub Category</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Details</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($sub_categories as $subcat) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td>
                                            <?php if ($subcat->app_image != '') { ?>
                                                <img class="cat_image" align="left" src="<?= base_url() ?>uploads/sub_categories/<?= $subcat->app_image ?>" title="">
                                            <?php } else { ?>
                                                <img class="cat_image" align="left" src="<?= base_url() ?>uploads/noproduct.png" title="">
                                            <?php } ?>

                                            <p><b>Sub Category Name: </b><span class="font-weight500"><?= $subcat->sub_category_name ?></span></p>
    <!--                                            <p><b>Description: </b><span class="font-weight500"><?= $subcat->description ?></span></p>-->
                                            <p><b>Parent Category: </b> <?= $subcat->category_name ?></p>
                                        </td>
    <!--                                        <td>
                                        <?php
                                        $qry = $this->db->query("select * from attr_brands where id='" . $subcat->brand . "'");
                                        $brands = $qry->row();
                                        echo $brands->brand_name;
                                        ?>
    <?php echo $subcat->brand; ?>
                                        </td>-->
                                        <td>
                                            <?php
                                            $brand = explode(',', $subcat->brand);
                                            //print_r($brand);
                                            foreach ($brand as $brands) {
                                                $qry = $this->db->query("select * from attr_brands where id='" . $brands . "'");
                                                $brands1 = $qry->row();
                                                ?>
                                                <span class="badge badge-success"><?= $brands1->brand_name; ?></span>

                                                <?php }
                                            ?> 
                                        </td>
                                        <td>
                                            <?php if ($subcat->status == 1) { ?>
                                                <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-success">
                                                    Active
                                                </button>
                                            <?php } else { ?>
                                                <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-danger">
                                                    In Active
                                                </button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/sub_categories/edit_subcategory/<?= $subcat->id ?>">
                                                <button title="Disabled" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/sub_categories/delete/<?= $subcat->id ?>" onclick="return confirm('Are you sure, You want to delete this?')">
                                                <button title="Delete Sub Catgories" class="btn btn-xs btn-danger">
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
                            <!-- <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
