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
                        <a href="<?= base_url() ?>vendors/categories">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                    </div>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Details</th>
                                    <th>Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($admin_comission->subcategory_ids as $val) {
                                    $sub_category = $this->common_model->get_data_row(['id' => $val], 'sub_categories');
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td>
                                            <img class="cat_image" align="left" src="<?= base_url() ?>uploads/<?= $sub_category->app_image ? 'sub_categories/'.$sub_category->app_image : 'noproduct.png' ?>" title="">
                                            <p><b>Sub Category Name: </b><span class="font-weight500"><?= $sub_category->sub_category_name ? $sub_category->sub_category_name : 'N/A' ?></span></p>
                                            <p><b>Description: </b><span class="font-weight500"><?= $sub_category->description ? $sub_category->description : 'N/A' ?></span></span></p>
                                        </td>
                                        <td>
                                            <a href="<?= base_url() ?>vendors/sub_categories/viewProducts/<?php echo $admin_comission->cat_id; ?>/<?php echo $val; ?>"><button class="btn btn-primary">VIEW</button></a>
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
