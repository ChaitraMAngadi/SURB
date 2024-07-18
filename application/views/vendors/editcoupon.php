<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/coupons">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/coupons/update">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $coupons->id?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Coupon Code</label>
                        <div class="col-sm-6">
                            <input type="text" id="coupon_code" name="coupon_code" class="form-control" value="<?php echo $coupons->coupon_code; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Percentage</label>
                        <div class="col-sm-6">
                            <input type="text" id="percentage" name="percentage" class="form-control" value="<?php echo $coupons->percentage; ?>"> %
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Maximum Amount</label>
                        <div class="col-sm-6">
                            <input type="text" id="maximum_amount" name="maximum_amount" class="form-control" value="<?php echo $coupons->maximum_amount; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-6">
                            <input type="text" id="start_date" name="start_date" class="form-control" value="<?php echo date("m/d/Y",strtotime($coupons->start_date)); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry Date</label>
                        <div class="col-sm-6">
                            <input type="text" id="expiry_date" name="expiry_date" class="form-control" value="<?php echo date("m/d/Y",strtotime($coupons->expiry_date)); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Utilization Coupon Count</label>
                        <div class="col-sm-6">
                            <input type="number" id="utilization" name="utilization" class="form-control" value="<?php echo $coupons->utilization; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Minimum Order Amount</label>
                        <div class="col-sm-6">
                            <input type="number" id="minimum_order_amount" name="minimum_order_amount" value="<?php echo $coupons->minimum_order_amount; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control"><?php echo $coupons->description; ?></textarea>
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