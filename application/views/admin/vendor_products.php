<style>
    .product_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
        border: 1px solid #edecec;
    }
    .shop_title{
        font-size:17px !important;
        color: #f39c5a;
    }
    .mangeImagesGrid{
        border: 1px solid #ebe9e9;
    }
    .manageImagesGridImgView{
        width:100%;
        /*border: 1px solid #e5e5e5;*/
        margin-bottom: 4px;
    }
    .previewImage{
        padding: 3px;
        border: 1px solid #ccc;
        margin:4px;
        width:30%;
        float:left;
    }
    .dataTables_paginate{
        display: none !important;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

<!--                    <h5 class="shop_title"><?= $title ?>'s Products</h5>-->
                    <h5>Vendor Products</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
<!--                        <a href="<?= base_url() ?>vendors/products/add_product?shop_id=<?= $_SESSION['vendors']['vendor_id'] ?>">
                            <button class="btn btn-primary">+ Add Product</button>
                        </a>-->
                        <!-- <a href="<?= base_url() ?>vendors/products/import_product?shop_id=<?= $_SESSION['vendors']['vendor_id'] ?>">
                            <button class="btn btn-primary">+ Import Excel</button>
                        </a> -->

                        <?php if ($back1 == 'button1') { ?>
                            <button onclick="goBack()" class="btn btn-primary">Back</button>
                        <?php } ?>

                    </div>

                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>


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
                    <form method="post" action="<?=base_url()?>admin/vendors_shops/vendor_products">
                        <input type="hidden" name="shop_id" value="<?= $shop_id ?>" />
                        <input class="form-control input-sm w-50 border-primary" type="text" name="keyword" required="" placeholder="Enter keyword" style="width:350px;"><br>
                        <input type="submit" class="btn btn-success mt-2" name="submit" value="Search">
                        <a href="<?= base_url() ?>admin/vendors_shops/vendor_products?shop_id=<?= $shop_id ?>"><input type="button" class="btn btn-danger mt-2" name="reset" value="Reset"></a>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover " >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Questionary</th>
                                    <th>Options</th>
                                    <th>Status</th>
<!--                                    <th>Action</th>-->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 if($kk==""){
                                    $kk=1;
                                }
                                foreach ($products as $pr) {

                                    $cat = $this->db->query("select * from categories where id='" . $pr->cat_id . "'");
                                    $category = $cat->row();
                                    $subcat = $this->db->query("select * from sub_categories where id='" . $pr->sub_cat_id . "'");
                                    $subcategory = $subcat->row();

                                    $questionary = $this->db->where(array("id" => $pr->ques_id))->get("questionaries")->row();

                                    $option_exp = explode(',', $pr->option_id);
                                    $opt_data = [];
                                    foreach ($option_exp as $option_data) {

                                        $option = $this->db->where(array("id" => $option_data))->get("options")->row();

                                        $opt_data[] = $option->option;
                                    }
                                    $option_imp = implode(',', $opt_data);
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $kk ?></td>
                                        <td><?= $pr->id ?></td>
                                        <td>

                                            <?php
                                            $pro_im = $this->db->query("select * from product_images where product_id='" . $pr->id . "'");
                                            $pro_imgs = $pro_im->row();
                                            if ($pro_im->num_rows() > 0) {
                                                ?>
                                                <img class="product_image" align="left" src="<?php echo base_url(); ?>uploads/products/<?php echo $pro_imgs->image; ?>" title="Product image">
                                            <?php } else { ?>
                                                <img class="product_image" align="left" src="<?= DEFAULT_IMAGE_PATH ?>" title="Product image">
                                            <?php } ?>
                                            <?= $pr->name ?>

                                        </td>
                                        <td><?= $category->category_name ?></td>
                                        <td><?= $subcategory->sub_category_name ?></td>
                                        <td><?= $questionary->question ?></td>
                                        <td><?= $option_imp ?></td>

                                        <td><?php
                                            if ($pr->status == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Inactive";
                                            }
                                            ?></td>
                                        <!-- <td>
                                        <?php
                                        $c = $this->db->query("select * from product_images where product_id='" . $pr->id . "'");
                                        $num_rows = $c->num_rows();
                                        ?>
                                            <p>Images - <?php echo $num_rows; ?></p>

                                        </td> -->
<!--                                        <td>
                                            <?php
                                            if ($pr->variant_product == 'no') {
                                                
                                            } else {
                                                ?>
                                                <a href="<?= base_url() ?>vendors/products/addvariant/<?php echo $pr->id; ?>">
                                                    <button class="btn btn-xs btn-info">+ Add Variant</button>
                                                </a>
                                                <a href="<?= base_url() ?>vendors/products/show_filters/<?php echo $pr->id; ?>">
                                                    <button class="btn btn-xs btn-info">View Filter</button>
                                                </a>

                                            <?php } ?>
                                            <a href="<?= base_url() ?>vendors/products/linkvariant/<?php echo $pr->id; ?>">
                                                <button class="btn btn-xs btn-info">  Products </button>
                                            </a>
                                            <a href="<?= base_url() ?>vendors/products/edit/<?php echo $pr->id; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Edit</button>
                                            </a>
                                            <button class="btn btn-xs btn-danger delete_product" data-id="<?= $pr->id; ?>"><i class="fa fa-trash-o"></i> Delete</button>
                                        </td>-->

                                        <td>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?= $pr->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="    width: 150%; margin-left: -261px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Product Add</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insert_subproduct">
                                                                    <div class="col-md-12">
                                                                        <div class="row">


                                                                            <div class="input_fields_wrap">
                                                                                <div class="form-group">

                                                                                    <label class="col-sm-2 control-label">Attributes</label>

                                                                                    <div class="col-sm-4">
                                                                                        <label class="col-sm-2 control-label">Name: *</label>
                                                                                        <input type="text" name="title[]" class="form-control" value="">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <label class="col-sm-2 control-label">Value: *</label>
                                                                                        <input type="text" name="values[]" class="form-control" value="">
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <a class="add_field_button btn btn-info" >add More</a>
                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="pid" value="<?= $pr->id; ?>">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <label class="control-label">MRP: *</label>
                                                                                        <input type="text" name="mrp" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <label class="control-label">Sale Price: *</label>
                                                                                        <input type="text" name="sale_price" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <label class="control-label">SKU: *</label>
                                                                                        <input type="text" name="sku" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <label class="control-label">Manage Stock: *</label>
                                                                                        <select class="form-control" name="manage_stock" onchange="getProducts(this.value)">
                                                                                            <option value="">Select Stock</option>
                                                                                            <option value="1">Yes</option>
                                                                                            <option value="0" selected="">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6" id="displaystock" style="display: none;">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <label class="control-label">Stock: *</label>
                                                                                        <input type="text" name="stock" id="stock" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <label class="control-label">Admin Commission: *</label>
                                                                                        <input type="text" name="admin_commission" class="form-control" value="10" disabled >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <button class="btn btn-primary" style="margin-top: 21px;">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br>

                                                                        </div>
                                                                        <br>


                                                                    </div>
                                                                </form>

                                                                <!-- <div class="col-md-4">
                                                                    <div id="file-list-display" style="max-height:300px;overflow-y: scroll"></div>
                                                                    <input type="file" multiple id="browseimages" style="margin: 20% auto 10px auto;">
                                                                    <button class="btn btn-primary" style="margin: 20px auto;display: block;width: 50%;">Upload</button>
                                            
                                                                </div> -->
                                                            </div>
                                                            <div class="row">
                                                                <table id="classTable" class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <td>S.NO</td>
                                                                            <td>SKU</td>
                                                                            <td>Price</td>
                                                                            <td>Stock</td>
                                                                            <td>Attributes</td>
                                                                            <td>Stock Visibility</td>
                                                                            <td>Admin Comm (%)</td>
                                                                            <!-- <td>Images</td> -->
                                                                            <td>Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        $row1 = $this->db->query("select * from products where parent_id='" . $pr->id . "'");
                                                                        $resu = $row1->result();
                                                                        $i = 1;
                                                                        foreach ($resu as $value) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $i; ?></td>
                                                                                <td><?php echo $value->sku; ?></td>
                                                                                <td><?php echo $value->price; ?></td>
                                                                                <td><?php echo $value->stock; ?></td>
                                                                                <td>
                                                                                    <?php
                                                                                    $at1 = $this->db->query("select * from product_attributes where pid='" . $value->id . "'");
                                                                                    $result1 = $at1->result();
                                                                                    foreach ($result1 as $value1) {
                                                                                        ?>
                                                                                        <div>
                                                                                            <?php echo $value1->name; ?> : <?php echo $value1->value; ?>
                                                                                        </div>
                                                                                    <?php }
                                                                                    ?>
                                                                                </td>

                                                                                <td><?php
                                                                                    if ($value->manage_stock == 1) {
                                                                                        echo "Yes";
                                                                                    } else {
                                                                                        echo "No";
                                                                                    }
                                                                                    ?></td>
                                                                                <td><?php echo $value->admin_commission; ?> %</td>
                                                                                <!-- <td><button class="btn btn-xs btn-primary">Images</button></td> -->
                                                                                <td>
                                                                                    <!-- <button class="btn btn-xs btn-primary">Edit</button> -->
                                                                                    <button class="btn btn-xs btn-primary">Delete</button>
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
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php
                                    $kk++;
                                }
                                ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                        <div class="pagination-bx  clearfix ">
                                        <?= $pagination ?>
                                    </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Logs Modal -->
<div id="StockLogsModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>

                <h4 class="modal-title" id="classModalLabel">
                    Manage Stock of product
                </h4>



            </div>
            <div class="modal-body" id="manageStockContainer">
                <div style="float:right;margin-top: -10px;margin-bottom: 10px;" >
                    <button class="btn btn-xs btn-primary" id="add_stock">Add Stock</button>&nbsp;&nbsp;
                    <button class="btn btn-xs btn-danger" id="remove_stock">Remove Stock</button>
                </div>
                <table id="classTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <td>S.NO</td>
                            <td>Stock</td>
                            <td>Type</td>
                            <td>Note</td>
                            <td>Balance</td>
                        </tr>
                    </thead>
                    <tbody id="stock_logs">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!--Update Stock Modal-->
<div class="modal fade" id="updatestockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
        Content
        <div class="modal-content">

            Body
            <div class="modal-body mb-1">

                <h5 class="mt-1 mb-2">Update Stock</h5>

                <div class="md-form ml-0 mr-0">
                    <input type="text" id="product_stock" class="form-control form-control-sm validate ml-0">
                </div>
                <br>

                <div class="text-center mt-4">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                    <button class="btn btn-primary" id="submit_stock">Update</button>
                </div>
            </div>

        </div>

    </div>
</div>



<!-- Update Prices Modal-->
<style>
    #UpdatePricesModal .form-control{
        margin-bottom: 10px;
    }
</style>

<!-- <div id="UpdatePricesModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="classModalLabel">
                    Add/Update Prices
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">SKU: *</label>
                                        <input type="text" name="sku" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Size: *</label>
                                        <select class="form-control" required>
                                            <option>select option</option>
                                            <option>L</option>
                                            <option>XL</option>
                                            <option>XXL</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Color: *</label>
                                        <select class="form-control" required>
                                            <option>select option</option>
                                            <option>Red</option>
                                            <option>Green</option>
                                            <option>Yellow</option>
                                            <option>Blue</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">MRP: *</label>
                                        <input type="text" name="mrp" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Sale Price: *</label>
                                        <input type="text" name="sale_price" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Manage Stock: *</label>
                                        <select class="form-control" required>
                                            <option>select option</option>
                                            <option>Yes</option>
                                            <option>No</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Stock: *</label>
                                        <input type="text" name="stock" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Admin Commission: *</label>
                                        <input type="text" name="admin_commission" class="form-control" value="10" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" style="margin-top: 21px;">Save</button>
                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                        <br>


                    </div>
                    <div class="col-md-4">
                        <div id="file-list-display" style="max-height:300px;overflow-y: scroll"></div>
                        <input type="file" multiple id="browseimages" style="margin: 20% auto 10px auto;">
                        <button class="btn btn-primary" style="margin: 20px auto;display: block;width: 50%;">Upload</button>

                    </div>
                </div>
                <div class="row">
                    <table id="classTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>S.NO</td>
                                <td>SKU</td>
                                <td>Price</td>
                                <td>Stock</td>
                                <td>Stock Visibility</td>
                                <td>Admin Comm (%)</td>
                                <td>Images</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1</td>
                                <td>123456</td>
                                <td>
                                    <p>Mrp: 1500</p>
                                    <p>Sale: 1299</p>
                                </td>
                                <td>10</td>
                                <td>Yes</td>
                                <td>10%</td>
                                <td><button class="btn btn-xs btn-primary">Images</button></td>
                                <td>
                                    <button class="btn btn-xs btn-primary">Edit</button>
                                    <button class="btn btn-xs btn-primary">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>  -->
<script type="text/javascript">
    function getProducts(value)
    {
        if (value == 1)
        {
            document.getElementById("displaystock").style.display = "block";
        } else
        {
            document.getElementById("displaystock").style.display = "none";
        }
    }
</script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><div class="input_fields_wrap"><div class="col-sm-12"><label class="col-sm-2 control-label">Attributes</label><div class="col-sm-4"><label class="col-sm-2 control-label">Name: *</label><input type="text" name="title[]" class="form-control" value=""></div><div class="col-sm-4"><label class="col-sm-2 control-label">Value: *</label><input type="text" name="values[]" class="form-control" value=""></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>

<script type="text/javascript">

    function deleteImage(img_id)
    {

        if (img_id != '')
        {
            $.ajax({
                url: "<?php echo base_url(); ?>vendors/products/deleteImage",
                method: "POST",
                data: {img_id: img_id},
                success: function (data)
                {

                    //alert(JSON.stringify(data));
                    alert("Image delted");
                    //var location = '<?= base_url() ?>vendors/products';
                    //console.log(location);
                    //window.location = location;
                    $('#UploadImagesModal').modal('show');
                    //$('#image_id').show("Image delted");
                }
            });
        }
    }
    $(document).ready(function () {

        $('#backNavigation').click(function (e) {
            console.log("log something");
//            window.history.back();
            return false;
        });


        $('.delete_product').on('click', function () {
            var product_id = $(this).attr('data-id');
            console.log(product_id);
            var confirm = window.confirm('Are you sure, you want to delete related Variants and Images ?');
            if (confirm) {
                var location = '<?= base_url() ?>vendors/products/delete_product?product_id=' + product_id;
                console.log(location);
                window.location = location;
            } else {
                console.log('not confirmed');
            }
        })

        $('.StockLogsModal').on('click', function () {
            var product_id = $(this).attr('data-id');
            console.log(product_id);
            $('#StockLogsModal').modal('show');

            $.post("<?= base_url() ?>api/admin_ajax/vendors/get_stock",
                    {
                        product_id: product_id
                    },
                    function (response, status) {
                        console.log("Data: " + response + "\nStatus: " + status);
                        console.log(JSON.stringify(response));

                        if (response['status'] == 'valid') {
//                            $('#manageStockContainer').show();
                            console.log(response['data']);
                            $('#stock_logs').html();
                            var tbody = '';
                            var i = 1;
                            response['data'].forEach(function (obj) {
                                console.log(obj);
                                tbody += ` <tr>
                                        <td>` + i + `</td>
                                        <td>` + obj.stock + `</td>
                                        <td>` + obj.type + `</td>
                                        <td>` + obj.note + `</td>
                                        <td>` + obj.balance + `</td>
                                    </tr>`;
                                i++;

                            });
                            $('#stock_logs').html(tbody);
                        } else {
//                            $('#manageStockContainer').hide();
                        }
                    });
//            $('#product_stock').val(stock);
//            $('#updatestockModal').modal('show')
        });

        $('.upload_images').on('click', function () {
            $('#UploadImagesModal').modal('show');
        });

        var imagesPreview = function (input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        console.log(event);
                        var div = document.createElement('div');
                        div.setAttribute('class', 'previewImage');

                        var img = document.createElement('img');
                        img.src = event.target.result;
                        img.setAttribute('width', '50%');
                        div.appendChild(img);


                        var fileDisplayEl = document.createElement('p');
                        fileDisplayEl.innerHTML = event.target.fileName;
                        div.appendChild(fileDisplayEl);

                        placeToInsertImagePreview.appendChild(div);
                    };
                    console.log(filesAmount);
                    reader.fileName = input.files[i].name;
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#browseimages').on('change', function () {
            var filelistdisplay = document.getElementById('file-list-display');
            imagesPreview(this, filelistdisplay);
        });


        $('.ShowPricesModal').on('click', function () {
//            alert('hello');
            $('#UpdatePricesModal').modal('show');
        })






    });
</script>


