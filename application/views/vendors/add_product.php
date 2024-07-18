
<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?> - Add Product</h5>

                <div class="ibox-tools">

                    <a href="<?= base_url() ?>vendors/products" style="float: right; margin: 8px;">

                        <button class="btn btn-primary">Back</button>

                    </a>

                </div>

                <?php if (!empty($this->session->tempdata('success_message'))) { ?>

                    <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">Ã—</a>

                        <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>

                    </div>

                <?php } ?>

                <?php if (!empty($this->session->tempdata('error_message'))) { ?>

                    <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">Ã—</a>

                        <strong>Failed!</strong> <?= $this->session->tempdata('error_message') ?>

                    </div>

                <?php }
                ?>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/inactive_products/insert_product">

                    <input type="hidden" name="shop_id" class="form-control" value="<?= $shop_id ?>" >
<!--                    <input type="hidden" name="shop_id" class="form-control" value="<?= $ques_id ?>" >-->
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Product Name: *</label>

                        <div class="col-sm-10">

<!--                            <input type="hidden" id="pid" name="pid" class="form-control" value="">-->

                            <input type="text" id="name" name="name" class="form-control" value="">

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Category Name: *</label>

                        <div class="col-sm-10">

                            <select class="form-control" name="cat_id" id="category" onchange="getSubcategories(this.value,<?= $shop_id ?>)" >

                                <option value="">Select Category</option>

                                <?php
                                foreach ($categories as $cat) {
                                    ?>

                                    <option value="<?php echo $cat['id']; ?>"><?php echo ucwords($cat['category_name']); ?></option>

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

                            </select>

                        </div>

                    </div>
                    <?php
$this->db->where('name', 'Questionary');
$query = $this->db->get('features');
$feature = $query->row();


$show_questionary = !empty($feature) && $feature->status == 1;
?>
<?php if($show_questionary ): ?>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Questionaries: </label>

                        <div class="col-sm-10">
                            <select class="form-control" name="ques_id" id="questionary" onchange="getOptions(this.value)">                               

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Options</label>

                        <div class="col-sm-10">

                            <select name="option_id[]" id="options"  class="form-control js-example-basic-multiple" multiple="multiple">

                            </select>
                        </div>

                    </div>
                    <?php endif; ?>
                    <div id="filter-option"></div>
                    
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Product Description: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="description" id="description"></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">About: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="about" id="about"></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">How to use: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="how_to_use" id="how_to_use"></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Features: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="key_features" id="key_features"></textarea>

                            <p style="color: red;">Note: If product doesn't have key features? leave it blank</p>

                        </div>

                    </div>

                    <!-- <div class="form-group">

                        <label class="col-sm-2 control-label">Start Selling Date: *</label>

                        <div class="col-sm-10">

                           <input type="text" class="form-control" data-date-format="mm/dd/yyyy" name="selling_date" id="datepicker" value="">

                        </div>

                    </div -->

                    <!-- <div class="form-group">

                        <label class="col-sm-2 control-label">Tags : *</label>

                        <div class="col-sm-10">

                            <textarea rows="5" cols="40" class="form-control" name="product_tags" id="product_tags"></textarea>

                        </div>

                    </div> --> 

                    <!-- <div class="form-group">

                        <label class="col-sm-2 control-label">Tags : *</label>

                        <div class="col-sm-10" >

                            <select name="product_tags[]" id="product_tags" class="form-control js-example-basic-multiple" multiple="multiple">

                                    <option value="">Select Tags</option>

                    <?php
                    $tag = $this->db->query("select * from tags");

                    $tags = $tag->result();

                    foreach ($tags as $value) {
                        ?>

                                                        <option value="<?php echo $value->title; ?>"><?php echo $value->title; ?></option>

                        <?php echo $value->title; ?><input type="checkbox" name="product_tags[]" id="product_tags" class="form-control" value="<?php echo $value->title; ?>">

                    <?php } ?>

                            </select>

                        </div>

                    </div> --> 

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Product Tags: *</label>

                        <div class="col-sm-10">

                            <?php
                            $tag = $this->db->query("select * from tags");
                            $tags = $tag->result();
                            ?>

                            <select name="product_tags[]" id="product_tags" class="form-control js-example-basic-multiple" multiple="multiple">

                                <?php foreach ($tags as $value) { ?>

                                    <!--                                <div style="float: left; margin-right: 10px;" >
                                    
                                                                        <b style="float: left;margin-right: 10px;"><?php echo $value->title; ?> : </b> <input type="checkbox" name="product_tags[]" style="height: 15px;" id="product_tags" value="<?php echo $value->id; ?>">
                                    
                                                                    </div>-->
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>

                                <?php } ?>

                            </select>

                        </div>
                    </div>

<!--                    <div class="form-group">

                        <label class="col-sm-2 control-label">Meta Tag Title: *</label>

                        <div class="col-sm-10">

                            <textarea rows="5" cols="40" class="form-control" name="meta_tag_title" id="meta_tag_title"></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Meta Tag Description: *</label>

                        <div class="col-sm-10">

                            <textarea class="ckeditor-desc" name="meta_tag_description" id="meta_tag_description"></textarea>

                        </div>

                    </div>-->

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Meta Tag Keywords: *</label>

                        <div class="col-sm-10">

                            <textarea rows="5" cols="40" class="form-control" name="meta_tag_keywords" id="meta_tag_keywords"></textarea>

                        </div>

                    </div>

                    <!--                    <div class="form-group">
                    
                                            <label class="col-sm-2 control-label">Brands : *</label>
                    
                                            <div class="col-sm-10" >
                    
                                                <input type="text" name="brand" id="brand" class="form-control">
                    
                                                 <select name="brand" id="brand" class="form-control js-example-basic-multiple">
                    
                                                        <option value="">Select Brand</option>
                                                        <?php
$this->db->where('name', 'Brands');
$query = $this->db->get('features');
$feature = $query->row();
$show_attributes = !empty($feature) && $feature->status == 1;
?>

<?php if($show_attributes): ?>
                    <?php
                    $tag = $this->db->query("select * from attr_brands");

                    $tags = $tag->result();

                    foreach ($tags as $value) {
                        ?>
                                    
                                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->brand_name; ?></option>
                                    
                    <?php } ?>
                    
                                                </select> 
                    
                                            </div>
                    
                                        </div> -->

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Brands : </label>

                        <div class="col-sm-10" >

<!--                            <input type="text" name="brand" id="brand" class="form-control">-->

                            <select name="brand" id="brand" class="form-control js-example-basic-multiple">

                                <option value="">Select Brand</option>

                                <?php
                                $tag = $this->db->query("select * from sub_categories where id='" . $value->brand . "'");

                                $tags = $tag->result();

                                foreach ($tags as $value) {
                                    ?>

                                    <option value="<?php echo $value->id; ?>"><?php echo $value->brand; ?></option>

                                <?php } ?>

                            </select> 

                        </div>

                    </div>

                    <!--  <div class="form-group">
 
                         <label class="col-sm-2 control-label">Brands : *</label>
 
                         <div class="col-sm-10" >
 
                             <select name="brand" id="brand" class="form-control js-example-basic-multiple">
 
                                     <option value="">Select Brand</option>
 
                    <?php
                    $tag = $this->db->query("select * from attr_brands");

                    $tags = $tag->result();

                    foreach ($tags as $value) {
                        ?>
                     
                                                         <option value="<?php echo $value->id; ?>"><?php echo $value->brand_name; ?></option>
                     
                    <?php } ?>
                    <?php endif; ?>
 
                             </select>
 
                         </div>
 
                     </div>  -->

                    <!-- <div class="form-group">

                        <label class="col-sm-2 control-label">Include Tax : *</label>

                        <div class="col-sm-10">

                            <select class="form-control" name="tax_class" id="tax_class" onchange="getProduct(this.value)">

                              <option value="">Select Tax</option>

                                <option value="yes">Yes</option>

                                <option value="no" selected="">No</option>

                            </select>

                        </div>

                    </div>

                    <div class="form-group" id="showtax" style="display: none;">

                        <label class="col-sm-2 control-label">Enter Tax</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select name="taxname" class="form-control">

                                <option value="">Select Tax</option>

                    <?php
                    $tax_qry = $this->db->query("select * from tax");

                    $tax_report = $tax_qry->result();

                    foreach ($tax_report as $value) {
                        ?>

                                                           <option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>    

                    <?php } ?> 

                            </select>

                            

                        </div>

              

                    </div> -->
                    <?php
$this->db->where('name', 'Return');
$query = $this->db->get('features');
$feature = $query->row();


$show_return = !empty($feature) && $feature->status == 1;
?>
<?php if($show_return): ?>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Return Available: *</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="cancel_status" id="cancel_status" onchange="getDaysstatus(this.value)">

                                <option value="">Select Return Available</option>

                                <option value="yes">Yes</option>

                                <option value="no">No</option>

                            </select>

                        </div>

                    </div>



                    <div id="noof_days" style="display: none;">



                        <div class="form-group">

                            <label class="col-sm-2 control-label">Return Number of Days</label>

                            <div class="col-sm-6">

                                <input type="text" name="return_noof_days" id="return_noof_days" class="form-control num_of_days"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                            </div>

                        </div>

                    </div>
                    <?php endif; ?>   
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Deal Product</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="deal_product" id="deal_product">

                                <option value="">Select Deal Product Status</option>

                                <option value="yes" selected="">Yes</option>

                                <option value="no">No</option>

                            </select>

                        </div>

                    </div>



                    <div class="form-group">

                        <label class="col-sm-2 control-label">Manage Stock</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="manage_stock" id="manage_stock">

                                <option value="">Select Manage Stock</option>

                                <option value="yes" selected="">Yes</option>

                                <option value="no">No</option>

                            </select>

                        </div>

                    </div>





                    <!--                    <div class="form-group">
                    
                                            <label class="col-sm-2 control-label">Status</label>
                    
                                            <div class="col-sm-10" style="margin-top: 6px;">
                    
                                                <select class="form-control" name="status" id="status">
                    
                                                    <option value="">Select Status</option>
                    
                                                    <option value="1">Active</option>
                    
                                                    <option value="0">Inactive</option>
                    
                                                </select>
                    
                                            </div>
                    
                                        </div> -->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Stock Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <select class="form-control" name="availabile_stock_status" id="availabile_stock_status">
                                <option value="available">Available</option>
                                <option value="sold">SOLD OUT</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">

                        <label class="col-sm-2 control-label">Select Variant Product</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <select class="form-control" name="variant_product" id="variant_product" onchange="getVariantProduct(this.value)">

                                <option value="">Select Status</option>

                                <option value="yes" selected="">Yes</option>

                                <option value="no">No</option>

                            </select>

                        </div>

                    </div>



                    <div id="variantProduct" style="display: none;">



                        <div class="form-group">

                            <label class="col-sm-2 control-label">Price</label>

                            <div class="col-sm-6">

                                <input type="text" name="price" id="price" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Sale Price</label>

                            <div class="col-sm-6">

                                <input type="text" name="saleprice" id="saleprice" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Stock</label>

                            <div class="col-sm-6">

                                <input type="text" name="stock" id="stock" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                            </div>

                        </div>



                        <div class="form-group">

                            <label class="col-sm-2 control-label">Upload Product Images</label>

                            <div class="col-sm-6">

                                <input type="file" name="images[]" id="images" multiple class="form-control">

                                <p style="color: red;">Select multiple Images <small>( Click Ctrl + Select )</small></p>

                            </div>

                        </div>



                    </div>

                    <div class="form-group">

                            <label class="col-sm-2 control-label">Cart Limit</label>

                            <div class="col-sm-6">

                                <input type="text" name="cart_limit" id="cart_limit" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">

                            </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Priority</label>

                        <div class="col-sm-6">

                            <input type="text" name="priority" id="priority" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" class="form-control">

                        </div>

                    </div>

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

<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.css" rel="stylesheet" /> 
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.js"></script>
<script>
                                $(document).ready(function () {
                                    $('.js-example-basic-multiple').select2({
                                        placeholder: "Select"
                                    });
                                });
</script> 


<script type="text/javascript">



    /*$(document).ready(function() {
     
     $('.products_data').toggle();
     
     $(document).click(function(e) {
     
     alert("alert");
     
     $('.products_data').attr('size',0);
     
     });
     
     });*/





    function getTitle(title)

    {

        if (title != '')

        {

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/getPreloadedProducts",

                method: "POST",

                data: {title: title},

                success: function (data)

                {

                    document.getElementById("products_data").style.display = "block";

                    $('#products_data').html(data);

                }

            });

        }

    }



    function getselectedProducts(pid)

    {

        $.ajax({

            url: "<?php echo base_url(); ?>vendors/products/getPreloadedProductList",

            method: "POST",

            data: {pid: pid},

            success: function (data)

            {







                var str = data;

                var res = str.split("@");

                document.getElementById("pid").value = res[1];

                document.getElementById("name").value = res[2];

                document.getElementById("description").value = res[3];

                document.getElementById("key_features").value = res[4];

                document.getElementById("brand").value = res[5];

                document.getElementById("cancel_status").value = res[6];

                document.getElementById("meta_tag_title").value = res[7];

                document.getElementById("meta_tag_description").value = res[8];

                document.getElementById("meta_tag_keywords").value = res[9];



                document.getElementById("variant_product").value = res[12];

                document.getElementById("price").value = res[13];

                document.getElementById("saleprice").value = res[14];

                document.getElementById("stock").value = res[15];

                //alert(JSON.stringify(res[12]));

                getVariantProduct(res[12]);

                document.getElementById("top_deal").value = res[10];


                document.getElementById("manage_stock").value = res[11];


                //$('#products_data').value(data);

                document.getElementById("products_title").style.display = "none";

                //$('#products_title').hide();

            }

        });

    }

    function getDaysstatus(value)

    {

        var cancel_status = $("#cancel_status").val();

        var return_status = $("#return_status").val();

        if (cancel_status == 'yes' || return_status == 'yes')

        {

            document.getElementById("noof_days").style.display = "block";

        } else

        {

            document.getElementById("noof_days").style.display = "none";

        }

    }

    function getVariantProduct(value)

    {

        if (value == 'no')

        {

            document.getElementById("variantProduct").style.display = "block";

        } else if (value == 'yes')

        {

            document.getElementById("variantProduct").style.display = "none";

        }

    }

    function showselectedTab(title)

    {

        if (title == 'product')

        {

            document.getElementById("product").style.display = "block";

            document.getElementById("addvariant").style.display = "none";

            document.getElementById("linkvariant").style.display = "none";

            document.getElementById("variant_images").style.display = "none";

        } else if (title == 'add_variant')

        {

            document.getElementById("product").style.display = "none";

            document.getElementById("addvariant").style.display = "block";

            document.getElementById("linkvariant").style.display = "none";

            document.getElementById("variant_images").style.display = "none";

        } else if (title == 'link_variant')

        {

            document.getElementById("product").style.display = "none";

            document.getElementById("addvariant").style.display = "none";

            document.getElementById("linkvariant").style.display = "block";

            document.getElementById("variant_images").style.display = "none";

        } else if (title == 'variant_image')

        {

            document.getElementById("product").style.display = "none";

            document.getElementById("addvariant").style.display = "none";

            document.getElementById("linkvariant").style.display = "none";

            document.getElementById("variant_images").style.display = "block";

        }

    }



    function getProduct(value)

    {

        if (value == 'yes')

        {

            document.getElementById("showtax").style.display = "block";

        } else

        {

            document.getElementById("showtax").style.display = "none";

        }

    }

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









<script type="text/javascript">

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
            $('#filter-option').html('');
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
    
    function getFilterOptions(element)

    {
        var filter_id = element.value;

        if (filter_id != '')

        {

            $.ajax({

                url: "<?php echo base_url(); ?>vendors/products/loadFilterOption",

                method: "POST",

                data: {filter_id: filter_id},

                success: function (data)

                {
                    var option = `<div class="form-group">
                        <label class="col-sm-2 control-label">Filter Options: </label>
                        <div class="col-sm-10">
                            <select name="filters_`+filter_id+`[]" class="form-control js-example-basic-multiple" multiple="multiple">
                                `+data+`    
                            </select>
                        </div>
                    </div>`;
                      $('#'+filter_id).html(option);
                      $(".js-example-basic-multiple").select2();
                }

            });

        } else {
            $('#'+filter_id).html('');
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

                    //alert(JSON.stringify(data));

                    $('#filtergroups_container').html(data);

                }

            });

        }

    }





    function getattributesvalues(title)

    {

        var category = $('#category').val();

        var sub_categories = $('#sub_categories').val();

        //alert(category); alert(sub_categories);

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
//        else if ($('#about').val() == '')
//
//        {
//
//            $('#about').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Product About</span>');
//
//            $('#about').focus();
//
//            return false;
//
//        } else if ($('#how_to_use').val() == '')
//
//        {
//
//            $('#how_to_use').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Product How to use</span>');
//
//            $('#how_to_use').focus();
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

            $('#deal_product').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Deal Status</span>');

            $('#deal_product').focus();

            return false;

        } else if ($('#manage_stock').val() == '')

        {

            $('#manage_stock').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Manage Stock</span>');

            $('#manage_stock').focus();

            return false;

        }

        /*else if($('#status').val()=='')
         
         {
         
         $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
         
         $('#status').focus();
         
         return false;
         
         }*/

        else if ($('#status').val() == '')

        {

            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');

            $('#status').focus();

            return false;

        }





    });



</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
<script>
    var allEditors = document.querySelectorAll('.ck_editor_txt');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
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

    $(".num_of_days").keypress(function (event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
</script>



