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
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 class="shop_title"><?= $title ?> </h5>
                <div class="ibox-tools"></div>

                <a href="<?= base_url() ?>admin/questionaries" style="float: right;">
                    <button class="btn btn-primary">Back</button>
                </a>
            </div>
            <div class="ibox-content" style="background-color: #f3f3f3;">

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/questionaries/update_questionary">



                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Name: *</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="cat_id" id="category" onchange="getSubcategories(this.value)">
                                <?php
                                foreach ($categories as $cat) {
                                    ?>
                                    <option value="<?= $cat->id ?>" <?php
                                    if ($cat->id == $questionaries->cat_id) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?= $cat->category_name ?></option>
                                            <?php
                                        }
                                        ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Category: </label>
                        <div class="col-sm-6">
                            <select class="form-control" name="sub_cat_id" id="sub_categories">
                            <?php        
                                        $available_sub_cat = [];
                                        $sub_cat_get = $this->db->where(['cat_id' => $questionaries->cat_id, 'status' => 1])->get('sub_categories')->result();
                                        foreach ($sub_cat_get as $sub) {
                                            $this->db->where('id !=', $questionaries->id);
                                            $chk = $this->db->where('sub_cat_id',$sub->id)->get('questionaries')->num_rows();
                                            if($chk == 0) {
                                                array_push($available_sub_cat,$sub);
                                            }
                                        }
                                        foreach ($available_sub_cat as $subcat) { ?>
                                        <option value="<?= $subcat->id ?>" <?php if($questionaries->sub_cat_id == $subcat->id){ echo 'selected="selected"'; }?>><?= $subcat->sub_category_name ?></option>
                                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Question: *</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $questionaries->id; ?>" >
                            <input type="text" id="question" name="question" class="form-control" value="<?php echo $questionaries->question; ?>">
                        </div>
                    </div>

                    <?php foreach ($questionaries->options as $value) { ?>
                        <input type="hidden" name="removed_opt_ids[]" id="removed_opt_id_<?= $value->id ?>" value="" /> 
                        <div class="form-group" id="<?= $value->id ?>">

                            <label class="col-sm-3 control-label">Option: *</label>
                            <div class="col-sm-4">
                                <input type="hidden" name="option_id[]"   value="<?php echo $value->id; ?>"/> 
                                <input type="text" name="options[]" placeholder="Enter Option" id="options" class="form-control name_list" value="<?php echo $value->option; ?>"/>
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
                    <div class="form-group">



                        <label class="col-sm-2 control-label">Category Image</label>

                        <div class="col-sm-10">

                            <input type="file" name="app_image" class="form-control">

                             <span class="help-block m-b-none" style="color:red;">Category Image Width : 500px and height : 500px</span>

                        </div>

                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status *</label>
                        <div class="col-sm-6" style="margin-top: 6px;">
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="1" <?php
                                if ($questionaries->status == 1) {
                                    echo 'selected="selected"';
                                }
                                ?>>Active</option>
                                <option value="0" <?php
                                if ($questionaries->status == 0) {
                                    echo 'selected="selected"';
                                }
                                ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-6">
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="priority" id="priority" class="form-control" value="<?php echo $questionaries->priority; ?>">
                        </div>
                    </div>


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
            $('#dynamic_field').append('<div class="row"><div id="row' + i + '" class="form-group" id="dynamic_field"><label class="col-sm-3 control-label">Option: *</label><div class="col-sm-4"><input type="hidden" name="option_id[]" value="0"/><input type="text" name="options[]" placeholder="Enter Option" class="form-control name_list" required="" /></div><div class="col-sm-5"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div></div></div>');
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">

    $('#btn_product').click(function () {
        $('.error').remove();
        var errr = 0;
        if ($('#category').val() == '' || $('#category').val().trim()=="")
        {
            $('#category').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select Category</span>');
            $('#category').focus();
            return false;
        } else if ($('#question').val() == '' || $('#question').val().trim()=="")
        {
            $('#question').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter question</span>');
            $('#question').focus();
            return false;
        } else if ($('#options').val() == '' || $('#options').val().trim()=="")
        {
            $('#options').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter options</span>');
            $('#options').focus();
            return false;
        } else if ($('#status').val() == '')
        {
            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
            $('#status').focus();
            return false;
        } else if ($('#priority').val() == '')
        {
            $('#priority').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
            $('#priority').focus();
            return false;
        }


    });



//    $('#category').on('change', function () {
//        var cat_id = $('#category').val();
//
//        loadSubcategories(cat_id);
//
//    });

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

    function loadSubcategories(cat_id) {
        //alert(city);
        // $('.modal').modal('show');
        if (cat_id != '')
        {
            $.get("<?= base_url() ?>api/admin_ajax/admin/get_sub_categories_for_questionary", "cat_id=" + cat_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#sub_category').html(response);
                    }, "html");
        }

    }

</script>

<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery.min.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.min.js"></script>
<script>

    $(document).ready(function () {
        $('#datepicker').datepicker();
        $('#datepicker').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');
    });

</script>