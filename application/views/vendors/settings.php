<div class="row">


  <div class="col-lg-12">
    <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                          <table class="table table-striped" style="text-align:center;">
                         <tr>
                            <td colspan="2"><img src="<?php echo base_url(); ?>/uploads/shops/<?php echo $settings->shop_logo; ?>" title="" style="width: 200px;"></td>
                          </tr>
                          <tr>
                            <th>Shop Name</th>
                            <td><?php echo $settings->shop_name; ?></td>
                          </tr>
                          <tr>
                            <th>Your Name</th>
                            <td><?php echo $settings->owner_name; ?></td>
                          </tr>
                          <tr>
                            <th>Mobile</th>
                            <td><?php echo $settings->mobile; ?></td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td><?php echo $settings->email; ?></td>
                          </tr>

                          <tr>
                            <th>Delivery Time</th>
                            <td><?php echo $settings->delivery_time; ?></td>
                          </tr>
                          <tr>
                            <th>Delivery Amount</th>
                            <td><?php echo $settings->min_order_amount; ?></td>
                          </tr>

                          <tr>
                            <th>Pincode</th>
                            <td><?php echo $settings->pincode; ?></td>
                          </tr>


                          <tr>
                            <th>Address</th>
                            <td><?php echo $settings->address; ?></td>
                          </tr>
                          <tr>
                            <th>City</th>
                            <td><?php echo $settings->city; ?></td>
                          </tr>
                          <tr>
                            <th>Pincode</th>
                            <td><?php echo $settings->pincode; ?></td>
                          </tr>
                          <tr>
                            <th>Delhivery partner</th>
                            <td><?php echo $settings->delivery_partner; ?></td>
                          </tr>

                      </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
<?php 
// print_r($settings);?>
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
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/settings/updateVendor">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="shop_name" id="shop_name" class="form-control" value="<?php echo $settings->shop_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Your Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="owner_name" id="name" class="form-control" value="<?php echo $settings->owner_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-10">
                            <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $settings->mobile; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" maxlength="10" minlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" id="email" class="form-control"  value="<?php echo $settings->email; ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="address" id="address" class="form-control"><?php echo $settings->address; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" name="city" id="city" class="form-control" value="<?php echo $settings->city; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode</label>
                        <div class="col-sm-10">
                            <input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo $settings->pincode; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Time</label>
                        <div class="col-sm-10">
                            <input type="text" name="delivery_time" id="delivery_time" class="form-control" value="<?php echo $settings->delivery_time; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Amount</label>
                        <div class="col-sm-10">
                            <input type="text" name="min_order_amount" id="min_order_amount" class="form-control" value="<?php echo $settings->min_order_amount; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div>
                    

                    <div class="form-group">
                      <a href="https://www.latlong.net/" target="_blank" style="text-align: center;">Get Latitude and Longitude</a>
                        <label class="col-sm-2 control-label">Latitude</label>
                        <div class="col-sm-10">
                            <input type="text" name="lat" id="lat" class="form-control" value="<?php echo $settings->lat; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" name="lng" id="lng" class="form-control" value="<?php echo $settings->lng; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="webimage" id="webimage" class="form-control">
                            <img src="<?php echo base_url(); ?>/uploads/shops/<?php echo $settings->shop_logo; ?>" title="" style="width:80px; height: 80px; border-radius:50%;">
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Logo</label>
                        <div class="col-sm-10">
                            <input type="file" name="logo" id="logo" class="form-control">
                            <img src="<?php echo base_url(); ?>/uploads/shops/<?php echo $settings->logo; ?>" title="" style="width:80px; height: 80px; border-radius:50%;">
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select OFFLINE / ONLINE</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" id="status">
                                   <option value="1" <?php if($settings->status==1){ echo 'selected="selected"'; }?>>ONLINE</option>
                                   <option value="0" <?php if($settings->status==0){ echo 'selected="selected"'; }?>>OFFLINE</option>
                          </select>
                           
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Select Delivery Partner</label>
                    <div class="col-sm-10"> 
                        <select class="courierSelection" name="delivery_partner" id="delivery_partner">
                    
                        <option value="<?php echo $settings->delivery_partner;?>" selected><?php echo $settings->delivery_partner;?></option>
                        <?php if($settings->delivery_partner!='delhivery'){?> <option value="delhivery">Delhivery</option>
                            <?php }else if($settings->delivery_partner!='self'){?>
        <option value="self">self</option>
        <?php }?>
    </select> </div>
    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select Status </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="shop_status" id="shop_status">
                                   <option value="1" <?php if($settings->status==1){ echo 'selected="selected"'; }?>> SHOP OPEN</option>
                                   <option value="0" <?php if($settings->status==0){ echo 'selected="selected"'; }?>>SHOP CLOSE</option>
                          </select>
                           
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_vendor_details" type="submit"> <i class="fa fa-plus-circle"></i> Update</button>
                        </div>
                    </div>
                </form>


                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                         <?php if (!empty($this->session->tempdata('success_message1'))) { ?>
                        <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong> Success!</strong> <?= $this->session->tempdata('success_message1') ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($this->session->tempdata('error_message1'))) { ?>
                        <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Failed!</strong> <?= $this->session->tempdata('error_message1') ?>
                        </div>
                    <?php }
                    ?>
                <h1 style="text-align: center;">Change Password</h1>
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/settings/changePassword1">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Old Password : </label>
                        <div class="col-sm-10">
                            <input type="text" id="oldpassword" name="oldpassword" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">New Password : </label>
                        <div class="col-sm-10">
                            <input type="text" id="newpassword" name="newpassword" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Confirm Password : </label>
                        <div class="col-sm-10">
                            <input type="text" id="confirm_password" name="confirm_password" class="form-control" value="">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" id="btn_changePassword"> <i class="fa fa-plus-circle"></i> Update</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            
        </div> 


  
</div>
<script type="text/javascript">

     $('#btn_changePassword').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#oldpassword').val()=='')
      {
         $('#oldpassword').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Old Password</span>');
         $('#oldpassword').focus();
         return false;
      }
      else if($('#newpassword').val()=='')
      {
         $('#newpassword').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter New Password</span>');
         $('#newpassword').focus();
         return false;
      }
      else if($('#confirm_password').val()=='')
      {
         $('#confirm_password').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter New Confirm Password</span>');
         $('#confirm_password').focus();
         return false;
      }
      else if($('#newpassword').val()!=$('#confirm_password').val())
      {
         $('#confirm_password').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Password Mismatched</span>');
         $('#confirm_password').focus();
         return false;
      }
 });
     
  setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 3000);

$("#name").keypress(function (e) {
        //var key = e.keyCode;
        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
        if (!valid) {
            e.preventDefault();
        }
    });
</script>

<script type="text/javascript">

     $('#btn_vendor_details').click(function(){
        $('.error').remove();
            var errr=0;
            var shop_image = '<?php echo $settings->shop_logo; ?>';
            var shop_logo = '<?php echo $settings->logo; ?>';
      if($('#shop_name').val()=='')
      {
         $('#shop_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Shop Name</span>');
         $('#shop_name').focus();
         return false;
      }
      else if($('#name').val()=='')
      {
         $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Name</span>');
         $('#name').focus();
         return false;
      }
      else if($('#mobile').val()=='')
      {
         $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Valid Mobile number</span>');
         $('#mobile').focus();
         return false;
      }
      else if($('#email').val()=='')
      {
         $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Valid Email</span>');
         $('#email').focus();
         return false;
      }
 else if($('#address').val()=='')
      {
         $('#address').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Address</span>');
         $('#address').focus();
         return false;
      }
 else if($('#city').val()=='')
      {
         $('#city').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your City</span>');
         $('#city').focus();
         return false;
      }
 else if($('#pincode').val()=='')
      {
         $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Pincode</span>');
         $('#pincode').focus();
         return false;
      }
 else if($('#delivery_time').val()=='')
      {
         $('#delivery_time').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Delivery Time</span>');
         $('#delivery_time').focus();
         return false;
      }
 else if($('#min_order_amount').val()=='')
      {
         $('#min_order_amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Delivery Amount</span>');
         $('#min_order_amount').focus();
         return false;
      }
      else if($('#lat').val()=='')
      {
         $('#lat').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Lattitude</span>');
         $('#lat').focus();
         return false;
      }
      else if($('#lng').val()=='')
      {
         $('#lng').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Longitude</span>');
         $('#lng').focus();
         return false;
      }
      else if((shop_image == '') && ($('#webimage').val()==''))
      {
         $('#webimage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Please select a file</span>');
         $('#webimage').focus();
         return false;
      } 
      else if((shop_logo == '') && ($('#logo').val()==''))
      {
         $('#logo').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Please Select A Logo</span>');
         $('#logo').focus();
         return false;
      }
      else if($('#status').val()=='')
      {
         $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Please Select Status</span>');
         $('#status').focus();
         return false;
      }
      else if($('#shop_status').val()=='')
      {
         $('#shop_status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Your Longitude</span>');
         $('#shop_status').focus();
         return false;
      }
 
      });
$("#name").keypress(function (e) {
        //var key = e.keyCode;
        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
        if (!valid) {
            e.preventDefault();
        }
    });
</script>