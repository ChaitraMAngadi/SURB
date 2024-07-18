<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">
                    
                     <a href="<?= base_url() ?>admin/attributes">
                            <button class="btn btn-primary">Back</button>
                        </a>

                </div>

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

            <div class="ibox-content">

                <?php if($edit_status=='color'){ ?>
                        <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/attributes/update_color">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Type: *</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="aid" value="<?php echo $attributes->id; ?>" >
                                    <input type="text" name="title" id="title" value="<?php echo $attributes->title; ?>" class="form-control">
                                </div>
                            </div>

                                <?php   
                                    $qry = $this->db->query("select * from attributes_values where attribute_titleid='".$attributes->id."'");
                                    $result = $qry->result(); 
                                    foreach ($result as $value) 
                                    {
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Value: *</label>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="id[]" class="form-control" required value="<?php echo $value->id; ?>">
                                        <input type="text" name="values[]" class="form-control" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9]/g, '')" required value="<?php echo $value->value; ?>">
                                    </div>
                                    <label class="col-sm-1 control-label">Color Code: *</label>
                                    <div class="col-sm-4">
                                        <input type="color" name="color_code[]" value="<?php echo $value->code; ?>" class="form-control" style="width: 100px; padding: 0px;">
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="input_fields_wrap1">
                            <div class="col-sm-12" style="text-align: right;">
                                  <a class="add_field_button1 btn btn-info" >Add More</a>
                                </div>
                          </div> -->
                            
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>

                <?php }else{ ?>

                        <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/attributes/update">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Type: *</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="aid" value="<?php echo $attributes->id; ?>" >
                                <input type="text" name="title" id="title" value="<?php echo $attributes->title; ?>" class="form-control onlyCharacter">
                            </div>
                        </div>
                      <div class="input_fields_wrap">
                            <?php   
                                $qry = $this->db->query("select * from attributes_values where attribute_titleid='".$attributes->id."'");
                                $result = $qry->result(); 
                                foreach ($result as $value) 
                                {
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Value: *</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="id[]" class="form-control" required value="<?php echo $value->id; ?>">
                                    <input type="text" name="values[]" class="form-control" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9]/g, '')" required value="<?php echo $value->value; ?>">
                                </div>

                            </div>
                        <?php } ?>

                             <div class="col-sm-12" style="text-align: right;">
                                  <a class="add_field_button btn btn-info" >Add More</a>
                                </div> 
                          
                      </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_attributes" type="submit">Save</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
                

            </div>

        </div>

    </div>

</div>

 
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div><div class="input_fields_wrap"><div class="form-group"><label class="col-sm-2 control-label">Value: *</label><div class="col-sm-8"><input type="hidden" name="id[]" class="form-control" value="0" required><input type="text" name="values[]" id="values" class="form-control" required></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });

    $(document).ready(function() {
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap1"); //Fields wrapper
      var add_button      = $(".add_field_button1"); //Add button ID
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div><div class="input_fields_wrap1"><div class="form-group"><label class="col-sm-2 control-label">Value: *</label><div class="col-sm-4"><input type="text" name="values[]" id="values" class="form-control" required></div><label class="col-sm-1 control-label">Color Code: *</label><div class="col-sm-4"><input type="color" name="color_code[]" value="#000" class="form-control" style="width: 100px; padding: 0px;" required></div><a href="#" class="remove_field1 btn btn-danger">Remove</a></div></div></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });
</script>

<script type="text/javascript">

	 function getsub(cat_id)
        {
        	//var cat_id = $('#category').val();
        	//alert(cat_id)
             $.get("<?= base_url() ?>api/admin_ajax/admin/get_sub_categories", "cat_id=" + cat_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#sub_category1').html(response);
                    }, "html");

             $.get("<?= base_url() ?>api/admin_ajax/admin/get_filter_groups", "cat_id=" + cat_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#filtergroups_container').html(response);
                    }, "html");
        }

   /* $(document).ready(function () {

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
            $.get("<?= base_url() ?>api/admin_ajax/admin/get_sub_categories", "cat_id=" + cat_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#sub_category1').html(response);
                    }, "html");
        }

        function loadFilterGroups(cat_id) {
            $.get("<?= base_url() ?>api/admin_ajax/admin/get_filter_groups", "cat_id=" + cat_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#filtergroups_container').html(response);
                    }, "html");
        }





    });*/
    
    $('#btn_attributes').click(function () {
        $('.error').remove();
        var errr = 0;
        if ($('#title').val() == '' || $('#title').val().trim() == "")
        {
            $('#title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Type</span>');
            $('#title').focus();
            return false;
        } else if ($('#values').val() == '' || $('#values').val().trim() == "")
        {
            $('#values').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Values</span>');
            $('#values').focus();
            return false;
        }
        
        $("input[name='values[]']").each(function () {
            if ($(this).val() == 0) {
                alert('Attribute value can not be zero');
                return false;
            }
        });
    });
    
</script>