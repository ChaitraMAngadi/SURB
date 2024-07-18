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

<div class="row">
    <div class="col-lg-12">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 class="shop_title"><?= $title ?> </h5>
                <div class="ibox-tools"></div>

                <a href="<?= base_url() ?>admin/filters" style="float: right;">
                    <button class="btn btn-primary">Back</button>
                </a>
            </div>
            <div class="ibox-content" style="background-color: #f3f3f3;">

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/filters/update_filters">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Name: *</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="cat_id" id="category" onchange="getSubcategories(this.value)">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat) { ?>
                                    <option value="<?= $cat->id ?>" <?= ($filters->cat_id == $cat->id) ? 'selected' : '' ?>><?= $cat->category_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Category: </label>
                        <div class="col-sm-8">
                            <select name="sub_cat_id[]" id="sub_categories"  class="form-control js-example-basic-multiple" multiple="multiple">
                            <?php
                                $sub_categories = $this->db->where(['cat_id' => $filters->cat_id, 'status' => 1])->get('sub_categories')->result();
                                foreach($sub_categories as $sub_cat) {
                                    $sub_cat_ids = explode(',', $filters->sub_cat_id);
                                    ?>
                                    <option value="<?= $sub_cat->id ?>" <?= (in_array($sub_cat->id,$sub_cat_ids)) ? 'selected' : '' ?>><?= $sub_cat->sub_category_name ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title: *</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $filters->id; ?>" >
                            <input type="text" id="title" name="title" class="form-control" value="<?php echo $filters->title; ?>">
                        </div>
                    </div>

                    <?php foreach ($filters->options as $value) { ?>
                        <input type="hidden" name="removed_opt_ids[]" id="removed_opt_id_<?= $value->id ?>" value="" /> 
                        <div class="form-group" id="<?= $value->id ?>">

                            <label class="col-sm-3 control-label">Option: *</label>
                            <div class="col-sm-4">
                                <input type="hidden" name="filter_id[]" value="<?php echo $value->id; ?>" />
                                <input type="text" name="options[]" placeholder="Enter Option" id="options" class="form-control name_list" value="<?php echo $value->options; ?>"/>
                            </div>
                            <div class="col-sm-5"><button type="button" class="btn btn-danger" onclick="removeOption(<?= $value->id ?>)">X</button></div>
                        </div>

                    <?php } ?>
                    <div class="form">
                        <div class="form-group" id="dynamic_field">
                            <label class="col-sm-3 control-label"></label>
                            <!--                                                        <div class="col-sm-4">
                                                                                        <input type="hidden" name="option_id[]" value=""/> 
                                                                                        <input type="text" name="options[]" placeholder="Enter Option" id="options" class="form-control name_list"/>
                                                        
                                                                                    </div>-->
                            <div class="col-sm-9">
                                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </div>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6" style="margin-top: 6px;">
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="1" <?php
                                if ($filters->status == 1) {
                                    echo 'selected="selected"';
                                }
                                ?>>Active</option>
                                <option value="0" <?php
                                if ($filters->status == 0) {
                                    echo 'selected="selected"';
                                }
                                ?>>Inactive</option>
                            </select>
                        </div>
                    </div>-->

<!--                    <div class="form-group">
                        <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-6">
                            <input type="text" name="priority" id="priority" class="form-control" value="<?php echo $filters->priority; ?>">
                           
                        </div>
                    </div>-->


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" id="btn_product" >Submit</button>
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

<script>
    $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<div class="row"><div id="row' + i + '" class="form-group" id="dynamic_field"><label class="col-sm-3 control-label">Option: *</label><div class="col-sm-4"><input type="hidden" name="filter_id[]" value="0"/><input type="text" name="options[]" placeholder="Enter Option" class="form-control name_list" required="" /></div><div class="col-sm-5"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div></div></div>');
        });
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");

        $('#row' + button_id + '').remove();
    });
    
    function removeOption(id) {
        $('#'+id).remove();
        $('#removed_opt_id_'+id).val(id);
    }


</script>




<script type="text/javascript">
    
    function getSubcategories(cid)
    {
        if (cid != '')
        {
            $.ajax({
                url: "<?php echo base_url(); ?>admin/products/loadSubcategories",
                method: "POST",
                data: {cid: cid},
                success: function (data)
                {
                    $('#sub_categories').html(data);
                }
            });
        }
    }

    $('#btn_product').click(function () {
       $('.error').remove();
        var errr = 0;

        if ($('#category').val() == '')
        {
            $('#category').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select Category</span>');
            $('#category').focus();
            return false;
        } else if ($('#title').val() == '' || $('#title').val().trim() == "")
        {
            $('#title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Title</span>');
            $('#title').focus();
            return false;
        } else if ($('#options').val() == '' || $('#options').val().trim() == "")
        {
            $('#options').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter options</span>');
            $('#options').focus();
            return false;
        }

    });



    /*$(document).ready(function () {
     
     var defaultCatId = $('#category').val();
     loadSubcategories(defaultCatId);
     
     $('#category').on('change', function () {
     var cat_id = $('#category').val();
     
     loadSubcategories(cat_id);
     loadFilterGroups(cat_id);
     });
     
     function loadSubcategories(cat_id) {
     //alert(city);
     // $('.modal').modal('show');
     if(cat_id!='')
     {
     $.get("<?= base_url() ?>api/admin_ajax/vendors/get_sub_categories", "cat_id=" + cat_id,
     function (response, status, http) {
     //$('.modal').modal('hide');
     $('#sub_category').html(response);
     }, "html");
     }
     
     }
     
     function loadFilterGroups(cat_id) {
     $.get("<?= base_url() ?>api/admin_ajax/vendors/get_filter_groups", "cat_id=" + cat_id,
     function (response, status, http) {
     //$('.modal').modal('hide');
     $('#filtergroups_container').html(response);
     }, "html");
     }
     
     
     
     
     
     });*/
</script>