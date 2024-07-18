<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">



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

                <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/attributes/insert">
                        <p>If you want to add color , Please <a onclick="showdiv('show')" >click here</a></p> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type: *</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                      <div class="input_fields_wrap" id="hidetype">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Value: *</label>
                                <div class="col-sm-8">
                                    <input type="text" id="values" name="values[]" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                  <a class="add_field_button btn btn-info" >Add More</a>
                                </div>
                                
                            </div>
                      </div>

                      <div class="input_fields_wrap1" id="showcolor" style="display: none;">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Value: *</label>
                                <div class="col-sm-4">
                                    <input type="text" id="values" name="values[]" class="form-control">
                                </div>
                                <label class="col-sm-1 control-label">Color Code: *</label>
                                <div class="col-sm-4">
                                    <input type="text" id="color" name="color[]" class="form-control">
                                </div>
                                <div class="col-sm-1">
                                  <a class="add_field_button1 btn btn-info" >Add More</a>
                                </div>
                                
                            </div>
                      </div>


                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" type="submit" id="btn_attributes">Save</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">

    function showdiv(val)
    {
        if(val=='show')
        {
                document.getElementById("showcolor").style.display = "block";
                document.getElementById("hidetype").style.display = "none";
        }
    }
  $(document).ready(function() {
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div><div class="input_fields_wrap"><div class="form-group"><label class="col-sm-2 control-label">Value: *</label><div class="col-sm-8"><input type="text" name="values[]" id="values" class="form-control"></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
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
          $(wrapper).append('<div><div class="input_fields_wrap1"><div class="form-group"><label class="col-sm-2 control-label">Value: *</label><div class="col-sm-4"><input type="text" name="values[]" id="values" class="form-control"></div><label class="col-sm-1 control-label">Color Code: *</label><div class="col-sm-4"><input type="text" name="color[]" id="color" class="form-control"></div><a href="#" class="remove_field1 btn btn-danger">Remove</a></div></div></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });
</script>

<script type="text/javascript">
    $('#btn_attributes').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#title').val()=='')
      {
         $('#title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Type</span>');
         $('#title').focus();
         return false;
      }
      else if($('#values').val()=='')
      {
         $('#values').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Values</span>');
         $('#values').focus();
         return false;
      }
 });

</script>