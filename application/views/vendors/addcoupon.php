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
                <?php if (!empty($this->session->tempdata('success_message'))) { ?>
                        <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($this->session->tempdata('error_message'))) { ?>
                        <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Failed!</strong> <?= $this->session->tempdata('error_message') ?>
                        </div>
                    <?php } ?>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/coupons/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Coupon Code</label>
                        <div class="col-sm-6">
                            <input type="text" id="coupon_code" name="coupon_code" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Percentage</label>
                        <div class="col-sm-6">
                            <input type="number" onkeyup="this.value = minmax(this.value, '', 100)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" id="percentage" name="percentage" class="form-control"> %
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Maximum Amount</label>
                        <div class="col-sm-6">
                            <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" id="maximum_amount" name="maximum_amount" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-6">
                            <input type="date" min="<?= date('Y-m-d')?>" name="start_date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry Date</label>
                        <div class="col-sm-6">
                            <input type="date" min="<?= date('Y-m-d')?>" name="expiry_date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Utilization Coupon Count</label>
                        <div class="col-sm-6">
                            <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" id="utilization" name="utilization" class="form-control">
                        </div>
                    </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Minimum Order Amount</label>
                        <div class="col-sm-6">
                            <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" min="1" id="minimum_order_amount" name="minimum_order_amount" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_coupon" type="submit"> <i class="fa fa-plus-circle"></i> Add</button>
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
         $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Description</span>');
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
     $('#start_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');

     $('#expiry_date').datepicker();
     $('#expiry_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');
  });
  

  </script>
  
  <script type="text/javascript">
function minmax(value, min, max) 
{
    if(parseInt(value) < min || isNaN(parseInt(value))) 
        return min; 
    else if(parseInt(value) > max) 
        return max; 
    else return value;
}
</script>