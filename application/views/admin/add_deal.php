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

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/deals/insert">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Categories</label>
                        <div class="col-sm-6">
                            <select name="cat_id" id="cat_id"  class="form-control js-example-basic-multiple">
                                <option value="">Select Category</option>
                                <?php  $cat = $this->db->query("select * from categories");
                                $result = $cat->result();
                                 foreach($result as $c){?>
                                <option value="<?php echo $c->id; ?>"><?php echo $c->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Offer Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" id="title" autocomplete="off" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Offer Start Date</label>
                        <div class="col-sm-6">
                            <input type="date" name="deal_start" id="deal_start" autocomplete="off" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Offer End Date</label>
                        <div class="col-sm-6">
                            <input type="date" name="deal_end" id="deal_end" autocomplete="off" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Web Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="webimage" id="webimage" class="form-control">
                             <span class="help-block m-b-none" style="color:red;">App Image Width : 1024px and height : 500px</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="appimage" id="appimage" class="form-control">
                             <span class="help-block m-b-none" style="color:red;">App Image Width : 500px and height : 250px</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                            <select name="status" id="status"  class="form-control js-example-basic-multiple">
                                <option value="">Select Status</option>
                                <option value="1" selected="">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_deals" type="submit">Save</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">

  
  $('#btn_deals').click(function(){
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
      else if (FileUploadPath == '') 
      {
           $('#webimage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Image</span>');
           $('#webimage').focus();
           return false;
      } 
       else if($('#appimage').val()=='')
      {
           $('#appimage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select App Image</span>');
           $('#appimage').focus();
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