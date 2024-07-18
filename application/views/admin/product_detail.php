<style type="text/css">
    h3 {
    margin: 13px 560px;
    color: green;
}
</style>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5><?= $title ?></h5>

                    <div class="ibox-tools">

                        <a href="<?= base_url() ?>admin/products">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                        <!-- <a href="<?= base_url() ?>admin/deals/add">

                            <button class="btn btn-primary">+ Add Deal</button>

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
                    <?php }
                    ?>

                </div>

                <div class="ibox-content">



                    <table class="table table-striped table-bordered table-hover ">

                        <thead>

                            <tr>

                                <th>Products</th>
                                <td><?= $product_view->name; ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?= $product_view->descp; ?></td>
                            </tr>
                                <tr>
                                   <th>Category Name</th> 
                                   <td><?php $cat_name=$this->admin_model->get_data_row('categories',['id'=>$product_view->cat_id]);
                                        echo $cat_name->category_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Sub Category Name </th>
                                    <td><?php $sub_cat_name = $this->admin_model->get_data_row('sub_categories',['id'=>$product_view->sub_cat_id]) ;  echo $sub_cat_name->sub_category_name;?></td>
                                </tr>
                                <tr>
                                    <th>Brand </th>
                                    <td><?php $brand = $this->admin_model->get_data_row('attr_brands',['id'=>$product_view->brand]);
                                         echo $brand->brand_name; ?></td>
                                </tr>

                        </thead>

                        
                    </table>
                    <h3>Variants</h3>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-" >
                          
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Price </th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>                                    
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                               
                                $attributes = []; 

                                foreach ($varient_data as $v) {
                                     $jsondata = json_decode($v->jsondata);
                                     $attribute_type = $jsondata['0']->attribute_type;
                                      //print_r($jsondata->attribute_type);die;
                                     $attribute_value = $jsondata['0']->attribute_value;

                    $type = $this->db->query("select * from attributes_title where id='" . $attribute_type . "'");

                    $types = $type->row();
                    //print_r($types);die;
                    $val12 = $this->db->query("select * from attributes_values where id='" . $attribute_value . "'");
                    $value12 = $val12->row();

                    $product_img = $this->db->query("select * from product_images where variant_id='" .$v->id ."'");
                    $p_image = $product_img->row();

                    $attributes[] = array('attribute_type' => $types->title, 'attribute_values' => $value12->value);
                    // print_r($p_image);die;
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?= base_url() ?>uploads/products/<?= $p_image->image ?>" class="img-responsive" width="50" height="100"/><br>
                                            <b>size : <?= $types->title?></b><br>
                                            <b>value : <?= $value12->value?></b>
                                        </td>
                                        <td>₹<?php echo $v->price; ?></td>
                                        <td>₹<?php echo $v->saleprice; ?></td>
                                        <td><?php echo $v->stock; ?></td>
                                        <td><?= $v->status =="1" ? "Active" : "inactive" ?></td>
                                        
                                        <!-- <td>
                                            <a href="<?= base_url() ?>admin/coupons/edit/<?= $v->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/coupons/delete/<?= $v->id ?>">
                                                <button title="Delete Coupon" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a>
                                        </td> -->


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



