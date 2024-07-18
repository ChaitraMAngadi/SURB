<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Edit Order Canceled Invoice</h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/order_canceled_invoice">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>
            
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/order_canceled_invoice/update">
                    
                  <input type="hidden" name="id" class="form-control" value="<?php echo $edit->id;?>" required>
                  
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-6">
                            <input type="text" id="subject" name="subject" value="<?php echo $edit->subject; ?>" class="form-control" required>
                        </div>
                    </div>
                  
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                            <input type="text" id="title" name="title" value="<?php echo $edit->title; ?>" class="form-control" required>
                        </div>
                    </div>
                  
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-6">
                            <textarea id="message" name="message" class="ckeditor-desc" required><?php echo $edit->message; ?></textarea>
                        </div>
                    </div>
                  
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Footer</label>
                        <div class="col-sm-6">
                            <textarea id="footer" name="footer" class="ckeditor-desc" required><?php echo $edit->footer; ?></textarea>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_coupon" type="submit"> <i class="fa fa-plus-circle"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#btn_coupon').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#coupon_code').val()=='')
      {
         $('#coupon_code').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Coupon Code</span>');
         $('#coupon_code').focus();
         return false;
      }
     else if($('#percentage').val()=='')
      {
         $('#percentage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Percentage</span>');
         $('#percentage').focus();
         return false;
      }
      
      else if($('#maximum_amount').val()=='')
      {
         $('#maximum_amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Maximum Amount</span>');
         $('#percentage').focus();
         return false;
      }
      else if($('#start_date').val()=='')
      {
         $('#start_date').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Start Date</span>');
         $('#start_date').focus();
         return false;
      }
      else if($('#expiry_date').val()=='')
      {
         $('#expiry_date').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Expiry Date</span>');
         $('#expiry_date').focus();
         return false;
      }
      else if($('#utilization').val()=='')
      {
         $('#utilization').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Coupon Utilization</span>');
         $('#utilization').focus();
         return false;
      }
      else if($('#minimum_order_amount').val()=='')
      {
         $('#minimum_order_amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Minimum Order Amount</span>');
         $('#minimum_order_amount').focus();
         return false;
      }
      
      else if($('#description').val()=='')
      {
         $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Category</span>');
         $('#description').focus();
         return false;
      }
      

 });

</script>
<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery.min.js"></script>
  <script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.min.js"></script>
<script>

  $(document).ready(function() {
    $('#start_date').datepicker();
     //$('#start_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');

     $('#expiry_date').datepicker();
     //$('#expiry_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');
  });

  </script>