<style>

    .shop_title{

        font-size:17px !important;

        color: #f39c5a;

    }

    .bd-example-modal-lg .modal-dialog{

        display: table;

        position: relative;

        margin: 0 auto;

        top: calc(50% - 24px);

    }



    .bd-example-modal-lg .modal-dialog .modal-content{

        /*        background-color: transparent;

                border: none;*/

    }

</style>

<?php
$features = $this->session->userdata('admin_login')['features'];
?>

<div class="row">

    <div class="col-lg-12">



        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5 class="shop_title"><?= $title ?> - Edit Product</h5>

                <div class="ibox-tools"></div>



                <a href="<?= base_url() ?>admin/products" style="float: right;">

                    <button class="btn btn-primary">Back</button>

                </a>

            </div>

            <div class="ibox-content" style="background-color: #f3f3f3;">



                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/inactive_products/update_product/">

                    <input type="hidden" name="shop_id" class="form-control" value="<?= $shop_id ?>">

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Name: *</label>

                        <div class="col-sm-10">

                            <input type="hidden" name="pid" class="form-control" value="<?php echo $products->id; ?>" >

                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $products->name; ?>">

                        </div> 

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Category Name: *</label>

                        <div class="col-sm-10">

                            <select class="form-control" name="cat_id" id="category" onchange="getSubcategories(this.value,<?= $shop_id ?>)">

                                <option value="">Select Category</option>

                                <?php
                                foreach ($categories as $cat) {
                                    ?>

                                    <option value="<?= $cat['id'] ?>" <?php
                                    if ($cat['id'] == $products->cat_id) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?= ucwords($cat['category_name']) ?></option>

                                    <?php
                                }
                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Sub Category: </label>

                        <div class="col-sm-10">

                            <select class="form-control" id="sub_categories" name="sub_cat_id" onchange="getbrands(this.value)" >
                                <!--                                <option value="">Select Sub Category</option>-->
                                <?php
                                $related_sub_cats = $this->common_model->get_data_with_condition(['cat_id' => $products->cat_id, 'status' => 1], 'sub_categories');
                                if (sizeof($related_sub_cats) > 0) {
                                    foreach ($related_sub_cats as $subcat) {
                                        ?>
                                        <option value="<?= $subcat->id ?>" <?php
                                        if ($subcat->id == $products->sub_cat_id) {
                                            echo "selected='selected'";
                                        }
                                        ?>><?= $subcat->sub_category_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>

                        </div>

                    </div>



                    <?php

$this->db->where('name', 'Questionary');
$query = $this->db->get('features');
$feature = $query->row();
$show_questionaries = !empty($feature) && $feature->status == 1;
?>
<?php if ($show_questionaries): ?>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Questionaries: </label>

                        <div class="col-sm-10">
                            <select class="form-control" name="ques_id" id="questionary" onchange="getOptions(this.value)">  
                                <option value="">Select Questionary</option>
                                <?php foreach ($questionaries as $value) {
                                    ?>
                                    <option value="<?= $value->id ?>" <?php
                                    if ($value->id == $products->ques_id) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?= $value->question ?></option>   
                                        <?php } ?>
                            </select>


                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Options: </label>

                        <div class="col-sm-10">

                            <?php $op = explode(',', $products->option_id); ?>
                            <select name="option_id[]" id="options" class="form-control js-example-basic-multiple" multiple="multiple">
                                <option value="">Select Options</option>
                                <?php foreach ($options as $value) {
                                    ?>
                                    <option value="<?= $value->id ?>" <?php
                                    if (in_array($value->id, $op)) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?= $value->option ?></option> 
                                        <?php } ?>
                            </select>

                        </div>

                    </div>
                    <?php endif; ?>

                    <?php
                    $filter_ids = array_column($selected_filters, 'filter_id');
                    foreach ($filters as $fil) {
                        ?>
                        <div class="form-group filter">
                            <label class="col-sm-2 control-label">Filter: </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="filter[]" onchange="getFilterOptions(this)">
                                    <option value="">Select Filter</option>
                                    <option value="<?= $fil->id ?>" <?= in_array($fil->id, $filter_ids) ? 'selected' : '' ?>><?= $fil->title ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Filter Options: </label>
                            <div class="col-sm-10">
                                <select name="filters_<?= $fil->id ?>[]" class="form-control js-example-basic-multiple" multiple="multiple">
                                    <?php
                                    $filter_option_ids = $this->db->where(array("product_id" => $products->id, 'filter_id' => $fil->id))->get('product_filter')->row()->filter_options;
                                    $option_ids = explode(',', $filter_option_ids);
                                    $filter_options = $this->db->where(array("filter_id" => $fil->id))->get('filter_options')->result();
                                    foreach ($filter_options as $opt) {
                                        ?>
                                        <option value="<?= $opt->id ?>" <?= in_array($opt->id, $option_ids) ? 'selected' : '' ?>  ><?php
                                            echo $opt->options;
                                            ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Product Description: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="description" id="description"><?php echo $products->descp; ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">About: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="about" id="about"><?php echo $products->about; ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">How to use: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="how_to_use" id="how_to_use"><?php echo $products->how_to_use; ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Features: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="key_features" ><?php echo $products->key_features; ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Product Tags: *</label>

                        <div class="col-sm-10">

                            <?php
                            $tags_list = explode(",", $products->product_tags);

                            $tags = $this->db->get('tags')->result();
                            ?>

                            <select name="product_tags[]" id="product_tags" class="form-control js-example-basic-multiple" multiple="multiple">

                                <?php foreach ($tags as $value) { ?>
                                    <option value="<?php echo $value->id; ?>" <?php
                                    if (in_array($value->id, $tags_list)) {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?php echo $value->title; ?></option>
                                        <?php } ?>   

                            </select>

                        </div>
                    </div>



<!--                    <div class="form-group">

                        <label class="col-sm-2 control-label">Meta Tag Title: *</label>

                        <div class="col-sm-10">

                            <textarea rows="5" cols="40" class="form-control" name="meta_tag_title" id="meta_tag_title"><?php echo $products->meta_tag_title; ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Meta Tag Description: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="meta_tag_description" id="meta_tag_description"><?php echo $products->meta_tag_description; ?></textarea>

                        </div>

                    </div>-->

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Meta Tag Keywords: *</label>

                        <div class="col-sm-10">

                            <textarea rows="5" cols="40" class="form-control" name="meta_tag_keywords" id="meta_tag_keywords"><?php echo $products->meta_tag_keywords; ?></textarea>

                        </div>

                    </div>
                    <?php
$this->db->where('name', 'Brands');
$query = $this->db->get('features');
$feature = $query->row();
$show_attributes = !empty($feature) && $feature->status == 1;
?>

<?php if($show_attributes  && in_array('Brands', $features)): ?>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Brands : </label>

                        <div class="col-sm-10" >

                            <select name="brand" id="brand" class="form-control js-example-basic-multiple">

                                <option value="">Select Brand</option>

                                <?php
                                $brand = $this->db->query("select * from attr_brands");

                                $brands = $brand->result();

                                foreach ($brands as $value) {
                                    ?>

                                    <option value="<?php echo $value->id; ?>"<?php
                                    if ($value->id == $products->brand) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?= $value->brand_name; ?></option>


                                <?php } ?>

                            </select> 

                        </div>

                    </div>
                    <?php endif; ?>
                    <?php
$this->db->where('name', 'Return');
$query = $this->db->get('features');
$feature = $query->row();


$show_return = !empty($feature) && $feature->status == 1;
?>
<?php if($show_return): ?>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Return Available</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="cancel_status" id="cancel_status">

                                <option value="">Select Return Available</option>

                                <option value="yes" <?php
                                if ($products->cancel_status == 'yes') {
                                    echo 'selected="selected"';
                                }
                                ?>>Yes</option>

                                <option value="no" <?php
                                if ($products->cancel_status == 'no') {
                                    echo 'selected="selected"';
                                }
                                ?>>No</option>

                            </select>

                        </div>

                    </div>

                    <?php if ($products->cancel_status == 'yes') { ?>

                        <div id="noof_days">

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Return Number of Days</label>

                                <div class="col-sm-6">

                                    <input type="text" name="return_noof_days" id="return_noof_days" class="form-control" value="<?php echo $products->return_noof_days; ?>">

                                </div>

                            </div>

                        </div>

                    <?php } ?>


                    <?php endif; ?>  

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Deal Product</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="deal_product" id="deal_product">

                                <option value="">Select Deal Product Status</option>

                                <option value="yes" <?php
                                if ($products->top_deal == 'yes') {
                                    echo 'selected="selected"';
                                }
                                ?>>Yes</option>

                                <option value="no" <?php
                                if ($products->top_deal == 'no') {
                                    echo 'selected="selected"';
                                }
                                ?>>No</option>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Manage Stock</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="manage_stock" id="manage_stock">

                                <option value="">Select Manage Stock</option>

                                <option value="yes" <?php
                                if ($products->manage_stock == 'yes') {
                                    echo 'selected="selected"';
                                }
                                ?>>Yes</option>

                                <option value="no" <?php
                                if ($products->manage_stock == 'no') {
                                    echo 'selected="selected"';
                                }
                                ?>>No</option>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Stock Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <select class="form-control" name="availabile_stock_status" id="availabile_stock_status">
                                <option value="available" <?php
                                if ($products->availabile_stock_status == 'available') {
                                    echo 'selected="selected"';
                                }
                                ?>>Available</option>
                                <option value="sold" <?php
                                if ($products->availabile_stock_status == 'sold') {
                                    echo 'selected="selected"';
                                }
                                ?>>SOLD OUT</option>
                            </select>
                        </div>
                    </div>

                    <?php if ($products->variant_product == 'no') { ?>



                        <div id="variantProduct" >

                            <?php
                            $qry = $this->db->query("select * from link_variant where product_id='" . $products->id . "'");

                            $report = $qry->row();
                            ?>

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Price</label>

                                <div class="col-sm-6">

                                    <input type="hidden" name="vid" class="form-control" value="<?php echo $report->id; ?>" >

                                    <input type="text" name="price" id="price" class="form-control" value="<?php echo $report->price; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Sale Price</label>

                                <div class="col-sm-6">

                                    <input type="text" name="saleprice" id="saleprice" class="form-control" value="<?php echo $report->saleprice; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Stock</label>

                                <div class="col-sm-6">

                                    <input type="text" name="stock" id="stock" class="form-control" value="<?php echo $report->stock; ?>" >

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Upload Product Images</label>

                                <div class="col-sm-6">

                                    <input type="file" name="images[]" id="images" multiple class="form-control">

                                    <p style="color: red;">Select multiple Images <small>( Click Ctrl + Select )</small></p>

                                </div>

                            </div>


                            <div class="form-group" style="margin-left: 250px;">

                                <div class="row">

                                    <?php
                                    $qry = $this->db->query("select * from product_images where product_id='" . $products->id . "' and variant_id='" . $report->id . "'");

                                    $result = $qry->result();

                                    foreach ($result as $value) {
                                        ?>

                                        <div style="float: left;">

                                            <a  href="<?= base_url() ?>admin/products/deleteProductImageInEdit/<?php echo $value->id; ?>/<?php echo $products->id; ?>/<?php echo $value->variant_id; ?>" style="color: red;"><i class="fa fa-trash"></i></a>

                                            <img src="<?php echo base_url(); ?>uploads/products/<?php echo $value->image; ?>" style="width: 100px; height: 100px;"/>

                                        </div>

                                    <?php } ?>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="1" <?php
                                if ($products->status == 1) {
                                    echo 'selected="selected"';
                                }
                                ?>>Active</option>
                                <option value="0" <?php
                                if ($products->status == 0) {
                                    echo 'selected="selected"';
                                }
                                ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group">

                            <label class="col-sm-2 control-label">Cart Limit</label>

                            <div class="col-sm-6">

                                <input type="text" name="cart_limit" id="cart_limit" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" value="<?php echo $products->cart_limit; ?>">

                            </div>

                    </div>


                    <div class="form-group">

                        <label class="col-sm-2 control-label">Priority</label>

                        <div class="col-sm-6">

                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="priority" id="priority" class="form-control" value="<?php echo $products->priority; ?>">

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" type="submit" id="btn_product" >Save</button>

                        </div>

                    </div>

                    <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">

                        <div class="modal-dialog modal-sm">

                            <div class="modal-content" style="width: 108px;color:#f37a20;text-align: center;margin:auto;">

                                <span class="fa fa-spinner fa-spin fa-3x" style="font-size:80px;"></span>

                            </div>

                        </div>

                    </div>

                </form>

            </div>



        </div>

    </div>



</div>

<script type="text/javascript">

    $('#btn_product').click(function () {

        $('.error').remove();

        var errr = 0;

        if ($('#name').val() == '')

        {

            $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Product Name</span>');

            $('#name').focus();

            return false;

        }
//        else if ($('#questionary').val() == '')
//
//        {
//
//            $('#questionary').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Questionary</span>');
//
//            $('#questionary').focus();
//
//            return false;
//
//        }
        else if ($('#category').val() == '')

        {

            $('#category').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Category</span>');

            $('#category').focus();

            return false;

        }
//        else if ($('#sub_categories').val() == '')
//
//        {
//
//            $('#sub_categories').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Sub Category</span>');
//
//            $('#sub_categories').focus();
//
//            return false;
//
//        } 
//        else if ($('#description').val() == '')
//
//        {
//
//            $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Product Description</span>');
//
//            $('#description').focus();
//
//            return false;
//
//        }

        else if ($('#datepicker').val() == '')

        {

            $('#datepicker').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Selling Date</span>');

            $('#datepicker').focus();

            return false;

        } else if ($('#product_tags').val() == '')

        {

            $('#product_tags').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Product Tag</span>');

            $('#product_tags').focus();

            return false;

        } 
//        else if ($('#meta_tag_title').val() == '')
//
//        {
//
//            $('#meta_tag_title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Meta Tag Title</span>');
//
//            $('#meta_tag_title').focus();
//
//            return false;
//
//        }
//        else if ($('#meta_tag_description').val() == '')
//
//        {
//
//            $('#meta_tag_description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Meta Tag Description</span>');
//
//            $('#meta_tag_description').focus();
//
//            return false;
//
//        }
        else if ($('#meta_tag_keywords').val() == '')

        {

            $('#meta_tag_keywords').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Meta Tag Keywords</span>');

            $('#meta_tag_keywords').focus();

            return false;

        } else if ($('#tax_class').val() == '')

        {

            $('#tax_class').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Tax</span>');

            $('#tax_class').focus();

            return false;

        } else if ($('#cancel_status').val() == '')

        {

            $('#cancel_status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Cancel Available</span>');

            $('#cancel_status').focus();

            return false;

        } else if ($('#deal_product').val() == '')

        {

            $('#deal_product').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Deal Product</span>');

            $('#deal_product').focus();

            return false;

        } else if ($('#manage_stock').val() == '')

        {

            $('#manage_stock').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Manage Stock</span>');

            $('#manage_stock').focus();

            return false;

        } else if ($('#status').val() == '')

        {

            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');

            $('#status').focus();

            return false;

        }





    });





    function getSubcategories(cid, shop_id)

    {

        if (cid != '')

        {
            $('#options').html('');

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadSubcategories",

                method: "POST",

                data: {cid: cid, shop_id: shop_id},

                success: function (data)

                {

                    $('#sub_categories').html(data);

                }

            });


            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadQuestionary",

                method: "POST",

                data: {cid: cid},

                success: function (data)

                {

                    $('#questionary').html(data);

                }

            });
            
            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadFilters",

                method: "POST",

                data: {cid: cid},

                success: function (data)

                {
                    $('#filter-option').html('');
                    var result = $.parseJSON(data);
                    $.each(result, function(key,val){
                        $('#filter-option').append(val);
                    });
                }

            });


        } else {
            $('#sub_categories').html('');
            $('#questionary').html('');
            $('#options').html('');
        }

    }

    function getOptions(quesid)

    {

        if (quesid != '')

        {

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadOptions",

                method: "POST",

                data: {quesid: quesid},

                success: function (data)

                {

                    $('#options').html(data);

                }

            });

        } else {
            $('#options').html('');
        }

    }

    function getattributes(subcatid)

    {

        var category = $('#category').val();

        if (subcatid != '')

        {

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadattributes",

                method: "POST",

                data: {category: category, subcatid: subcatid},

                success: function (data)

                {

                    $('#filtergroups_container').html(data);

                }

            });

        }

    }





    function getattributesvalues(title)

    {

        var category = $('#category').val();

        var sub_categories = $('#sub_categories').val();


        if (title != '')

        {

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadattributesvalue",

                method: "POST",

                data: {category: category, subcatid: sub_categories, title: title},

                success: function (data)

                {

                    //alert(JSON.stringify(data));

                    $('#attribute_values').html(data);

                }

            });

        }

    }

    function getbrands(subcatid)

    {


        if (subcatid != '')

        {

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadbrands",

                method: "POST",

                data: {subcatid: subcatid},

                success: function (data)

                {
                    console.log(data);
                    //alert(JSON.stringify(data));

                    $('#brand').html(data);

                }

            });
            
            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadQuestionary",

                method: "POST",

                data: {subcatid: subcatid},

                success: function (data)

                {

                    $('#questionary').html(data);

                }

            });
            
            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadFilters",

                method: "POST",

                data: {subcatid: subcatid},

                success: function (data)

                {
                    $('#filter-option').html('');
                    var result = $.parseJSON(data);
                    $.each(result, function(key,val){
                        $('#filter-option').append(val);
                    });
                }

            });

        }

    }

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
<script>
    var allEditors = document.querySelectorAll('.ck_editor_txt');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>