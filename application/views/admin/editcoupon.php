<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/coupons">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/coupons/update">
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
                            <input type="number" id="percentage" name="percentage" class="form-control" value="<?php echo $coupons->percentage; ?>" min="0" max="100" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" onkeyup="this.value = minmax(this.value, '', 100)"> %
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Maximum Amount</label>
                        <div class="col-sm-6">
                            <input type="number" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" id="maximum_amount" name="maximum_amount" class="form-control" value="<?php echo $coupons->maximum_amount; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-6">
                            <input type="date" id="start_date" name="start_date" min="<?= date('Y-m-d')?>" class="form-control" value="<?php echo $coupons->start_date; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry Date</label>
                        <div class="col-sm-6">
                            <input type="date" id="expiry_date" name="expiry_date" min="<?= date('Y-m-d')?>" class="form-control" value="<?php echo $coupons->expiry_date; ?>">
                        </div>
                    </div>
                    <div class="form-group">



                        <label class="col-sm-2 control-label">Coupon Image</label>

                        <div class="col-sm-6">

                            <input type="file" name="app_image" class="form-control">

                             <span class="help-block m-b-none" style="color:red;">Coupon Image Width : 500px and height : 500px</span>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Utilization Coupon Count</label>
                        <div class="col-sm-6">
                            <input type="number" id="utilization" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="utilization" class="form-control" value="<?php echo $coupons->utilization; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Minimum Order Amount</label>
                        <div class="col-sm-6">
                            <input type="number" id="minimum_order_amount" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="minimum_order_amount" value="<?php echo $coupons->minimum_order_amount; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control"><?php echo $coupons->description; ?></textarea>
                        </div>
                    </div>
                    <?php  $selectedtag=$this->db->query("select * from coupon_codes where id='".$id."'");
    $selectedtag_res=$selectedtag->row();?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">limit for each user</label>
                        <div class="col-sm-6">
                            <input type="number" id="limit" name="limit" class="form-control" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" value="<?php echo $selectedtag_res->limit_user;?>">
                        </div>
                    </div>
                    <div class="form-group">

                    <label class="col-sm-2 control-label">Tags</label>

                    <div class="col-sm-6">

                        <?php
                        $tag = $this->db->query("select * from tags");
                        $tags = $tag->result();
                    $tagselected=json_decode($selectedtag_res->Tag);
                        // print_r( );
                        ?>

                        <select name="tags[]" id="tags" class="form-control js-example-basic-multiple" multiple="multiple">

                            <?php foreach ($tags as $value) { ?>

                                <option value="<?php echo $value->title; ?>" <?php if($tagselected[0] == $value->title) echo 'selected'; ?>>
                        <?php echo $value->title; ?>
                    </option>


                            <?php } ?>

                        </select>

                    </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Brands : *</label>

                        <div class="col-sm-6" >

                            

                                <select name="brand[]" id="brand" class="form-control js-example-basic-multiple" multiple="multiple">

                                    <option value="">Select Brand</option>
                
                                                                        <?php
                                    $brands = $this->db->query("select * from attr_brands");

                                    $brand = $brands->result();

                                    foreach ($brand as $value) {
                                        ?>
                                                    
                                        <option value="<?php echo $value->brand_name; ?>"><?php echo $value->brand_name; ?></option>
                                                    
                                    <?php } ?>
                
                                </select> 

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
<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.css" rel="stylesheet" /> 
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery.min.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.js"></script>
<script>
                                $(document).ready(function () {
                                    $('.js-example-basic-multiple').select2({
                                        placeholder: "Select"
                                    });
                                });
                                
</script> 

<script>

  $(document).ready(function() {
    $('#start_date').datepicker();
     //$('#start_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');

     $('#expiry_date').datepicker();
     //$('#expiry_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');
  });

  </script>