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
                    <a href="<?= base_url() ?>admin/vendors_shops">
                        <button class="btn btn-primary">BACK</button>
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
                    <?php } ?>
            <div class="ibox-content test">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/vendors_shops/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="shop_name" name="shop_name" class="form-control" value="<?= ($old_data) ? $old_data['shop_name'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="shop_image" name="shop_image" class="form-control" value="<?= ($old_data) ? $old_data['shop_logo'] : '' ?>">
                            <p>Make sure image Width : 500 px & Height: 500 px</p>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Logo</label>
                        <div class="col-sm-10">
                            <input type="file" id="shop_logo" name="shop_logo" class="form-control" value="<?= ($old_data) ? $old_data['logo'] : '' ?>">
                            <p>Make sure image Width : 300 px & Height: 300 px</p>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Owner Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="owner_name" name="owner_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Refferal Code</label>
                        <div class="col-sm-10">
                            <input type="text" id="refferalcode" name="refferalcode" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" onkeypress="return isNumberKey(event)" title="Please enter exactly 10 digits" id="mobile" name="mobile" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" id="password" name="password" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Time</label>
                        <div class="col-sm-10">
                            <input type="text" id="delivery_time" name="delivery_time" placeholder="Ex: 30Min" class="form-control">
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Delivery Amount</label>
                        <div class="col-sm-10">
                            <input type="text" id="min_order_amount" name="min_order_amount" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">States</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="state_id" id="states" onchange="getStateID(this.value)">
                                <option value = "">Select state</option>
                                <?php
                                $stat = $this->db->query("select * from states");
                                $state_list = $stat->result();
                                foreach ($state_list as $st) {
                                    ?>
                                    <option value="<?php echo $st->id; ?>"><?php echo $st->state_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id" id="cities" onchange="getLocations(this.value)">
                                <option value = "">Select City</option>
                                <?php
                                foreach ($cities as $ct) {
                                    ?>
                                    <option value="<?= $ct->id ?>"><?= $ct->city_name ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                       <label class="col-sm-2 control-label">Pincodes</label>
                       <div class="col-sm-10" id="pincodes_data">
                          
                           
                       </div>
                   </div>  -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" id="address" name="address" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode</label>
                        <div class="col-sm-10">
                            <input type="text" id="pincode" name="pincode" class="form-control">
                        </div>
                    </div> -->
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
                            <input type="text" id="latitude" name="latitude" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" id="longitude" name="longitude" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Assign Visual Merchant</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="vm_id" name="vm_id">
                                <option value="">Select Visual Merchant</option>
                    <?php
                    foreach ($visual_merchant as $vm) {
                        ?>
                                        <option value="<?= $vm->id ?>"><?= $vm->name ?>( <?= $vm->mobile ?> )</option>
                        <?php
                    }
                    ?>

                            </select>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Verification Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Verification Status</option>
                                <option value="1" selected="">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Profile Update Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="update_status" name="update_status">
                                <option value="">Profile Update Status</option>
                                <option value="1">No</option>
                                <option value="0">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_vendorshops" type="submit">Save</button>
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

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    $('#btn_vendorshops').click(function () {
        $('.error').remove();
        var errr = 0;
        var FileUploadPath = $('#shop_logo').val();
        var FileSize = document.getElementById("shop_logo").files[0];
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        var ph = $('#mobile').val();
        if ($('#shop_name').val() == '')
        {
            $('#shop_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Shop Name</span>');
            $('#shop_name').focus();
            return false;
        } else if ($('#shop_image').val() == '')
        {
            $('#shop_image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Shop Image</span>');
            $('#shop_image').focus();
            return false;
        } else if ($('#shop_logo').val() == '')
        {
            $('#shop_logo').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Shop Logo</span>');
            $('#shop_logo').focus();
            return false;
        } else if ($('#owner_name').val() == '')
        {
            $('#owner_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Owner Name</span>');
            $('#owner_name').focus();
            return false;
        } else if ($('#email').val() == '')
        {
            $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Email</span>');
            $('#email').focus();
            return false;
        } else if (!validateEmail($('#email').val()))
        {
            $('#email').after('<span class="error" style="color:red">Invalid Email Address</span>');
            $('#email').focus();
            return false;
        } else if ($('#mobile').val() == '')
        {
            $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Mobile</span>');
            $('#mobile').focus();
            return false;
        } else if (ph.length != 10)
        {
            $('#mobile').after('<span class="error" style="color:red">Enter Valid 10 digit Phone Number</span>');
            $('#mobile').focus();
            return false;
        } else if ($('#password').val() == '')
        {
            $('#password').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Password</span>');
            $('#password').focus();
            return false;
        } else if ($('#delivery_time').val() == '')
        {
            $('#delivery_time').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Delivery Time</span>');
            $('#delivery_time').focus();
            return false;
        } else if ($('#min_order_amount').val() == '')
        {
            $('#min_order_amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Delivery Amount</span>');
            $('#min_order_amount').focus();
            return false;
        } else if ($('#description').val() == '')
        {
            $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
            $('#description').focus();
            return false;
        } else if ($('#cities').val() == '')
        {
            $('#cities').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select City</span>');
            $('#cities').focus();
            return false;
        } else if ($('#locations').val() == '')
        {
            $('#locations').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Locations</span>');
            $('#locations').focus();
            return false;
        } else if ($('#address').val() == '')
        {
            $('#address').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Address</span>');
            $('#address').focus();
            return false;
        } else if ($('#pincode').val() == '')
        {
            $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Pincode</span>');
            $('#pincode').focus();
            return false;
        } else if ($('#latitude').val() == '')
        {
            $('#latitude').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Latitude</span>');
            $('#latitude').focus();
            return false;
        } else if ($('#longitude').val() == '')
        {
            $('#longitude').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Longitude</span>');
            $('#longitude').focus();
            return false;
        }
        /*else if($('#vm_id').val()=='')
         {
         $('#vm_id').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Visual Merchant</span>');
         $('#vm_id').focus();
         return false;
         }*/
        else if ($('#status').val() == '')
        {
            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Verification Status</span>');
            $('#status').focus();
            return false;
        } else if (FileSize.size > 2097152)
        {
            $('#shop_logo').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">File size must under 2mb!</span>');
            $('#shop_logo').focus();
            return false;
        } else if (Extension == "png" || Extension == "jpeg" || Extension == "jpg")
        {
            if (fuData.files && fuData.files[0])
            {
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    $('#shop_logo').attr('src', e.target.result);
                }
                reader.readAsDataURL(fuData.files[0]);
            }
        } else
        {
            $('#shop_logo').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Image only allows file types of PNG , JPG, and JPEG.</span>');
            $('#shop_logo').focus();        
        }

    });

    function validateEmail($email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test($email)) {
            return false;
        } else
        {
            return true;
        }
    }
</script>

<link href="https://test.indiasmartlife.com/admin_assets/css/jquery.datetimepicker.css" rel="stylesheet">
<script src="https://test.indiasmartlife.com/admin_assets/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">

    function getStateID(state_id)
    {
        $.get("<?= base_url() ?>api/admin_ajax/admin/get_cities", "state_id=" + state_id,
                function (response, status, http) {
                    //$('.modal').modal('hide');
                    $('#cities').html(response);
                }, "html");
    }

    function getLocations(city_id)
    {
        $.get("<?= base_url() ?>api/admin_ajax/admin/get_city_locations", "city_id=" + city_id,
                function (response, status, http) {
                    //$('.modal').modal('hide');
                    $('#pincodes_data').html(response);
                }, "html");
    }

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

    function chk_duplicate(event) {
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        $.ajax({
            url: '<?= base_url() ?>admin/vendors_shops/chk_duplicate',
            type: 'POST',
            data: {email: email, mobile: mobile},
            success: function (data) {
                if (data == 'email_mobile_exists') {
                    $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Email already exists</span>');
                    $('#email').focus();
                    $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Mobile already exists</span>');
                    $('#mobile').focus();
                    event.preventDefault();
                    return false;
                } else if (data == 'email_exists') {
                    $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Email already exists</span>');
                    $('#email').focus();
                    event.preventDefault();
                    return false;
                } else if (data == 'mobile_exists') {
                    $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Mobile already exists</span>');
                    $('#mobile').focus();
                    event.preventDefault();
                    return false;
                } else {
                    return true;
                }
            }
        });
    }
</script>