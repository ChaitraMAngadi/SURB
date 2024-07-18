<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                    <a href="<?= base_url() ?>admin/deals" style="float: right; margin: 8px;">
                        <button class="btn btn-primary">Back</button>
                    </a>

                </div>

            </div>

            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/deals/update">
                    <input type="hidden" name="id" value="<?php echo $deals->id; ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-6">
                            <select name="cat_id" id="cat_id"  class="form-control js-example-basic-multiple">
                                <option value="">Select Category</option>
                               <?php  $cat = $this->db->query("select * from categories");
                                      $result = $cat->result();
                                 foreach($result as $shop){?>
                                <option value="<?php echo $shop->id; ?>" <?php if($shop->id==$deals->cat_id){ echo 'selected="selected"'; }?>><?php echo $shop->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" id="title" autocomplete="off" class="form-control" value="<?php echo $deals->title; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal Start Date</label>
                        <div class="col-sm-6">
                            <input type="text" name="deal_start" id="deal_start" autocomplete="off" class="form-control" value="<?php echo $deals->deal_start; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal End Date</label>
                        <div class="col-sm-6">
                            <input type="text" name="deal_end" id="deal_end" autocomplete="off" class="form-control" value="<?php echo $deals->deal_end; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Web Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="webimage" id="webimage" >
                            <span class="help-block m-b-none" style="color:red;">Web Image Width : 1024px and height : 400px</span>
                        </div>

                        <?php

                    if ($deals->web_image) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/deals/<?= $deals->web_image ?> "/>
                                <span class="help-block m-b-none" style="color:red;">Web Image Width : 900px and height : 400px</span>

                            </div>

                        </div>

                        <?php

                    }

                    ?>


                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="appimage" id="appimage" class="form-control">
                        </div>
                        <?php

                    if ($deals->app_image) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/deals/<?= $deals->app_image ?> "/>

                            </div>

                        </div>

                        <?php

                    }

                    ?>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                            <select name="status" id="status"  class="form-control js-example-basic-multiple">
                                <option value="">Select Status</option>
                                <option value="1" <?php if($shop->status==1){ echo 'selected="selected"'; }?>>Active</option>
                                <option value="0" <?php if($shop->status==0){ echo 'selected="selected"'; }?>>Inactive</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_updatedeals" type="submit">Update</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">

  
  $('#btn_updatedeals').click(function(){
        $('.error').remove();
            var errr=0;

             var FileUploadPath = $('#webimage').val();
             var FileSize = document.getElementById("webimage").files[0];
             var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
      if($('#cat_id').val()=='')
      {
         $('#cat_id').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Category</span>');
         $('#cat_id').focus();
         return false;
      }
      else if($('#title').val()=='')
      {
         $('#title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Deal Title</span>');
         $('#title').focus();
         return false;
      }
      else if($('#deal_start').val()=='')
      {
         $('#deal_start').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Deal Start Date</span>');
         $('#deal_start').focus();
         return false;
      }
      else if($('#deal_end').val()=='')
      {
         $('#deal_end').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Deal End Date</span>');
         $('#deal_end').focus();
         return false;
      }
      else if (FileSize.size > 2097152)
      {
              $('#webimage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">File size must under 2mb!</span>');
              $('#webimage').focus();
              return false;
      }
      else if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") 
      {
                if (fuData.files && fuData.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function(e) 
                    {
                        $('#webimage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
      } 
      else  
      {
            $('#webimage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Image only allows file types of PNG , JPG, and JPEG.</span>');
            $('#webimage').focus();
            return false;
      }
     
       
 });

</script>


<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>

  $(document).ready(function() {
   $("#deal_start").datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'yy-mm-dd',
    minDate: 0
});

   $("#deal_end").datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'yy-mm-dd',
    minDate: 0
});
    
   /* $('#deal_start').datepicker();
     $('#deal_start').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');*/
  });

  </script>