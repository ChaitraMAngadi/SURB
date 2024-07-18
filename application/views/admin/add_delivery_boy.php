<style>
    .category_comm_span{
        top: -5px;
        position: relative;
        left: 10px;
    }
    .cat_commission{
        top: -5px;
        position: relative;
        left: 21px;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                  <a href="<?= base_url() ?>admin/delivery_boy">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>
            <div class="ibox-content test">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/delivery_boy/insert">
                    
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Types</label>
                        <div class="col-sm-10">
                          <select id="delivery_type" name="delivery_type" class="form-control">
                             <option value="">Select Delivery Types</option>
                             <option value="full_time_driver">Full Time Driver</option>
                             <option value="pay_for_driver">Pay for Driver</option>
                          </select>
                        </div>
                    </div>
 -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Boy Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" onkeypress="return isNumberKey(event)" title="Please enter exactly 10 digits" id="mobile" name="mobile" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alternative Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" onkeypress="return isNumberKey(event)" title="Please enter exactly 10 digits" id="alternative_mobile" name="alternative_mobile" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" id="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" id="photo" name="photo" class="form-control">
                            <p>Make sure image Width : 500 px & Height: 500 px</p>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vehicle Number</label>
                        <div class="col-sm-10">
                            <input type="text" id="vehicle_number" name="vehicle_number" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vehicle Type</label>
                        <div class="col-sm-10">
                            <input type="text" id="vehicle_type" name="vehicle_type" class="form-control">
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Driving License Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="driving_license_image" name="driving_license_image" class="form-control">
                            <p>Make sure image Width : 500 px & Height: 500 px</p>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Additional Document</label>
                        <div class="col-sm-10">
                            <input type="file" id="document" name="document" class="form-control">
                            
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Driving License Number</label>
                        <div class="col-sm-10">
                            <input type="text" id="driving_license_number" name="driving_license_number" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Aadhar Card</label>
                        <div class="col-sm-10">
                            <input type="file" id="aadhar_card" name="aadhar_card" class="form-control">
                            <p>Make sure image Width : 500 px & Height: 500 px</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Aadhar Card Number</label>
                        <div class="col-sm-10">
                            <input type="text" id="aadhar_card_number" name="aadhar_card_number" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile Verification</label>
                        <div class="col-sm-10">
                          <select id="mobile_verification" name="mobile_verification" class="form-control">
                             <option value="">Select Mobile Verification</option>
                             <option value="yes">YES</option>
                             <option value="no">NO</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">States</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="state" id="state" onchange="getCities(this.value)">
                                <option value = "">Select State</option>
                                <?php
                                foreach ($states as $state) {
                                    ?>
                                    <option value="<?= $state->id ?>"><?= $state->state_name ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id" id="cities">
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" id="address" name="address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode</label>
                        <div class="col-sm-10">
                            <input type="text" id="pincode" name="pincode" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <a href="https://www.latlong.net/" target="_blank" class="btn btn-primary">Get Latitude and Longitude</a>
                        </div>
                    </div>

                    <div class="form-group">
                                                <label class="col-sm-2 control-label">Latitude</label>
                        <div class="col-sm-10">
                            <input type="text" id="latitude" name="latitude" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" id="longitude" name="longitude" class="form-control">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_delivery" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg" style="width : 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Shop Timings</h4>
            </div>
            <div class="modal-body" >




            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getCities(state_id)
    {
      if(state_id != '')
      {
         $.ajax({
          url:"<?php echo base_url(); ?>admin/delivery_boy/getCities",
          method:"POST",
          data:{state_id:state_id},
          success:function(data)
          {
            //alert(JSON.stringify(data));
           $('#cities').html(data);
          }
         });
      }
    }

    function getLocation(city_id)
    {
      if(city_id != '')
      {
         $.ajax({
          url:"<?php echo base_url(); ?>admin/delivery_boy/getLocation",
          method:"POST",
          data:{city_id:city_id},
          success:function(data)
          {
           //alert(JSON.stringify(data));
           $('#location').html(data);
          }
         });
      }
    }

  </script>
<script type="text/javascript">

  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

  $('#btn_delivery').click(function(){
        $('.error').remove();
            var errr=0;
    var ph = $('#mobile').val();
    var alt_ph = $('#alternative_mobile').val();

    
      if($('#name').val()=='')
      {
         $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Delivery Name</span>');
         $('#name').focus();
         return false;
      }
      else if($('#email').val()=='')
      {
         $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Email</span>');
         $('#email').focus();
         return false;
      }
    else if(!validateEmail($('#email').val())) 
     { 
       $('#email').after('<span class="error" style="color:red">Invalid Email Address</span>');
       $('#email').focus();
        return false;
     }
      else if($('#mobile').val()=='')
      {
         $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Mobile</span>');
         $('#mobile').focus();
         return false;
      }
      else if(ph.length!=10)
      {
         $('#mobile').after('<span class="error" style="color:red">Enter Valid 10 digit Phone Number</span>');
         $('#mobile').focus();
         return false;
      }  
      else if($('#alternative_mobile').val()=='')
      {
         $('#alternative_mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Alternative Mobile</span>');
         $('#alternative_mobile').focus();
         return false;
      }
      else if(alt_ph.length!=10)
      {
         $('#alternative_mobile').after('<span class="error" style="color:red">Enter Valid 10 digit Phone Number</span>');
         $('#alternative_mobile').focus();
         return false;
      }  
       else if($('#password').val()=='')
      {
         $('#password').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Password</span>');
         $('#password').focus();
         return false;
      }
      else if($('#photo').val()=='')
      {
         $('#photo').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Photo</span>');
         $('#photo').focus();
         return false;
      }
      else if($('#vehicle_number').val()=='')
      {
         $('#vehicle_number').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Vehicle Number</span>');
         $('#vehicle_number').focus();
         return false;
      }
      
     
      else if($('#vehicle_type').val()=='')
      {
         $('#vehicle_type').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Vehicle Type</span>');
         $('#vehicle_type').focus();
         return false;
      }
      else if($('#driving_license_image').val()=='')
      {
         $('#driving_license_image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Driving License Image</span>');
         $('#driving_license_image').focus();
         return false;
      }
      else if($('#driving_license_number').val()=='')
      {
         $('#driving_license_number').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Driving License Number</span>');
         $('#driving_license_number').focus();
         return false;
      }
      else if($('#aadhar_card').val()=='')
      {
         $('#aadhar_card').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Aadhar Card</span>');
         $('#aadhar_card').focus();
         return false;
      }
      else if($('#aadhar_card_number').val()=='')
      {
         $('#aadhar_card_number').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Aadhar Card Number</span>');
         $('#aadhar_card_number').focus();
         return false;
      }
      else if($('#mobile_verification').val()=='')
      {
         $('#mobile_verification').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Mobile Verification</span>');
         $('#mobile_verification').focus();
         return false;
      }
       else if($('#state').val()=='')
      {
         $('#state').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select State</span>');
         $('#state').focus();
         return false;
      }
       else if($('#cities').val()=='')
      {
         $('#cities').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select City</span>');
         $('#cities').focus();
         return false;
      }
      else if($('#location').val()=='')
      {
         $('#location').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Location</span>');
         $('#location').focus();
         return false;
      }
      else if($('#address').val()=='')
      {
         $('#address').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Address</span>');
         $('#address').focus();
         return false;
      }
      else if($('#pincode').val()=='')
      {
         $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Pincode</span>');
         $('#pincode').focus();
         return false;
      }
      else if($('#latitude').val()=='')
      {
         $('#latitude').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Latitude</span>');
         $('#latitude').focus();
         return false;
      }
      else if($('#longitude').val()=='')
      {
         $('#longitude').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Longitude</span>');
         $('#longitude').focus();
         return false;
      }
 });

  function validateEmail($email) 
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( $email) ) {
      return false;
    } 
    else
    {
        return true;
    }
}
</script>

<link href="https://test.indiasmartlife.com/admin_assets/css/jquery.datetimepicker.css" rel="stylesheet">
<script src="https://test.indiasmartlife.com/admin_assets/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.datepicker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            scrollInput: false
        });
        $(document).on('mousewheel', '.datepicker', function () {
            return false;
        });

        $('.datepickertimepicker').datetimepicker({
            timepicker: true,
            format: 'Y-m-d H:i',
            scrollInput: false
        });
        $(document).on('mousewheel', '.datepickertimepicker', function () {
            return false;
        });

        $('#cities').on('change', function () {
            var city_id = $('#cities').val();

            loadCityLocations(city_id);
        });

        function loadCityLocations(city_id) {
            //alert(city);
            // $('.modal').modal('show');
            $.get("<?= base_url() ?>api/admin_ajax/admin/get_city_locations", "city_id=" + city_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#locations').html(response);
                    }, "html");
        }

//        $('input[type="checkbox"].select_category').on('change', function () {
//            console.log('selected');
//            var cat_id = $(this).attr('data-cat-id');
//            if ($(this).prop("checked") == true) {
//
//                var input = '<input type="text" placeholder="Admin commission (%)" class="cat_commission category_comm_input' + cat_id + '"" name="comissions[]" required>';
//                $('.category' + cat_id).append($.parseHTML(input));
//            } else {
//                $('.category_comm_input' + cat_id).remove();
//            }
//        });




    });
</script>