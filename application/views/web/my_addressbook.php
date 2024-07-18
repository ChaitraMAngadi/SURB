<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        
<style>
.address_liner{
    line-height:1.5em;
}
</style>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3 breads">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3>My Addressbook</h3> -->
<!--                    <ul>
                        <li><a href="<?php echo base_url() ?>web/myaccount">Dashboard</a></li>
                        <li>My Addressbook</li>
                    </ul>-->
                    <span style=" font-size:15px;
        text-transform: capitalize;
        font-weight: bold;line-height:1.5em;"><?php print_r($firstname." ".$lastname);?></span><br>
                    <span style="font-size:13px;"><?php
                     print_r($email);?></span>
                    <ul>
<!--                        <li><a href="<?php echo base_url(); ?>"><?php echo $shop_name; ?>, <?php echo $city; ?></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<!--about section area -->
<section class="dashboard">
    <div class="container">
        <div class="row">
            
                    <div class="col-lg-2 col-md-12 address_book">
                        <?php include 'dashboard_menu.php' ?>
                    </div>
                
                    <div class="col-lg-10 col-md-12 address_page">
                    <div class="address_header">
                        <h4 class="addresshead">My Address</h4>
                        </div>
                    <div class="myenclose">
                        
                        <button class="btn mb-2 addressbtn" type="button" data-toggle="modal" data-target="#addnewaddress">Add New Address</button>
                        
                       
                       
                       
                        <p id="addressmsg"></p>
                        <div class="addressbox">
                        <?php
                        // echo "<pre>";
                        // print_r($addresslist);
                        // exit;
                        if (count($addresslist) > 0) {?>
                        
                           <?php foreach ($addresslist as $address) {
                                ?>
                               
                                
                                   
                                        <div class="address-cards">
                                            <div class="row">
                                                <div class="col-lg-10 col-md-10 col-10 col-xs-10 col-sm-10">
                                                <p><strong style="color:#5087F5;
                                                font: normal normal bold 14px/18px Muli;
letter-spacing: 0px;
color: #5087F5;
opacity: 1;"><?php echo $address['address_type']; ?></strong></p>
                                                <div class="row address_liner">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                                    <p><strong><?php echo $address['name']; ?></strong>&nbsp;&nbsp;<strong><?php echo $address['mobile']; ?></strong><br><br>
                                                    <strong> <?php echo $address['address']; ?>,<br><?php echo $address['landmark']; ?> ,
                                                        <?php echo $address['city']; ?> , <?php echo $address['state']; ?>&nbsp;-
                                                         <?php echo $address['pincode']; ?></p></strong>
                                                </div>  </div>
                                                        
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-2 col-sm-2 col-xs-2 text-right" style="display:flex;gap:1.2rem;justify-content:end;">
                                                    <a data-toggle="modal" data-target="#editaddress<?php echo $address['id']; ?>" style="color: var(--unnamed-color-000000);
text-align: left;
font: normal normal bold 14px/18px Muli;
letter-spacing: 0px;
color: #000000;
opacity: 1;"><strong>Edit</strong></a>
                                                    <a href="<?php echo base_url(); ?>web/deleteaddressinbook/<?php echo $address['id']; ?>"  onclick="if (!confirm('Are you sure you want to delete this address?'))
                                          return false;"><strong style="text-align: left;
font: normal normal bold 14px/18px Muli;
letter-spacing: 0px;
color: #E92C0E;
opacity: 1;">Delete</strong></a>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="modal fade" id="editaddress<?php echo $address['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div id="editaddress"> 

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-body">
<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
<div class="row newaddressbox" id="editaddress<?php echo $address['id']; ?>">

                                   <!-- <?php echo $address['id'];?> -->
                                        <h4>Edit Address</h4>
                                        <form class="form-horizontal row" enctype="multipart/form-data"  >
                                        <div class="col-lg-12 col-md-12">

                                            <div class="form-group">
                                               
                                                <input type="hidden" class="styling" id="aid" value="<?php echo $address['id']; ?>">
                                                <input type="text" class="styling name onlyCharacter" minlength="3" maxlength="20" id="name<?php echo $address['id']; ?>" placeholder="Name" value="<?php echo $address['name']; ?>">

                                            </div>

                                        </div>

                                        <div class="col-lg-12 col-md-12">

                                            <div class="form-group">
                                               
                                                <input type="text" class="styling mobile" id="mobile<?php echo $address['id']; ?>" placeholder="Mobile Number" value="<?php echo $address['mobile']; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">

                                            </div>

                                        </div>

                                        <div class="col-lg-12 col-md-12">

                                            <div class="form-group">
                                                
                                                <input type="text" class="styling" id="address<?php echo $address['id']; ?>" placeholder="Address (Building Number, street etc)" value="<?php echo $address['address']; ?>">

                                            </div>

                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                               
                                                <select class="styling" id="state<?php echo $address['id']; ?>" onchange="getCities(this.value)">
                                                    <option value="">Select State</option>
                                                    <?php foreach ($states as $state) { ?>
                                                        <option value="<?php echo $state->id; ?>" <?php if ($state->id == $address['state_id']) {
                                                echo "selected='selected'";
                                            } ?>><?php echo $state->state_name; ?></option>
                                              <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                       <!--  <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>City : </label>
                                                <select class="form-control downarrow cities" id="cities<?php echo $address['id']; ?>" onchange="getPincodes(this.value, '<?php echo $address['id']; ?>')">
                                                    <?php
                                                    $city_qry = $this->db->query("select * from cities where state_id='" . $address['state_id'] . "'");
                                                    $city_row = $city_qry->result();
                                                    foreach ($city_row as $cit) {
                                                        ?>
                                                        <option value="<?php echo $cit->id; ?>" <?php if ($cit->id == $address['city_id']) {
                                                echo "selected='selected'";
                                            } ?>><?php echo $cit->city_name; ?></option>
                                              <?php } ?>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                               
                                                <input type="text" class="styling" name="city" id="cities<?php echo $address['id']; ?>" placeholder="Enter Cities" value="<?php echo $address['city']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                
                                                <input class="styling" type="text" name="pincode" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="pincode<?php echo $address['id']; ?>" placeholder="Enter Pincode" value="<?= $address['pincode'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">

                                            <div class="form-group">
                                                
                                                <input type="text" class="styling" id="landmark<?php echo $address['id']; ?>" placeholder="Location / Landmark" value="<?php echo $address['landmark']; ?>">

                                            </div>

                                        </div>

                                        
                                        <div class="col-lg-12 check_rad">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" type="radio" <?php if ($address['address_status'] == 1) {
            echo "checked='checked'";
        } ?> name="inlineRadioOption<?php echo $address['id']; ?>" id="inlineRadio1<?php echo $address['id']; ?>" value="1">

                                                <label class="form-check-label" for="inlineRadio1" >Home</label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" type="radio" <?php if ($address['address_status'] == 2) {
            echo "checked='checked'";
        } ?> name="inlineRadioOption<?php echo $address['id']; ?>" id="inlineRadio1<?php echo $address['id']; ?>" value="2">

                                                <label class="form-check-label" for="inlineRadio2">Office</label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                              <input class="form-check-input" type="radio" <?php if ($address['address_status'] == 3) {
            echo "checked='checked'";
        } ?> name="inlineRadioOption<?php echo $address['id']; ?>" id="inlineRadio1<?php echo $address['id']; ?>" value="3">

                                              <label class="form-check-label" for="inlineRadio3">Default Address</label>

                                            </div>

                                        </div>

                                        <div class="col-lg-12" style="padding-left:40px;">

                                            <button type="button" class="btn btn-address validate"  onclick="validateupdateAddressForm1('<?php echo $address['id']; ?>')">UPDATE ADDRESS</button>

                                        </div>
                                    </form>
    </div>
                                    
    </div>
    </div>
    </div>
    </div>
    </div>

                                   
                                    

                               
                           
                       

                                
                              <?php }} else {
                                 ?>


                                   
                                    

                               
                           
                       

                                
     
                               <div class="row">
                                <div class="col-lg-12 col-md-12">



                                    <!-- <img src="<?php echo base_url(); ?>/uploads/address.png" style="text-align: center; width: 16%; margin: auto; display: block;"> -->
                                    <h4 style="text-align: center;" class="addresshead">No Address yet please Add Address</h4>

                                </div>
                                </div>


<?php } ?>
                    </div>
                    </div>
                    </div>




                
        </div>
    </div>
</section>


<div class="modal fade" id="addnewaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-body">

            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>

                    
                    
                    
                    <div class="row newaddressbox" id="addnewaddress">
                        <form class="form-horizontal row" enctype="multipart/form-data"  >
                            <div class="col-lg-12 col-md-12">
                                <h4>Add Address</h4>

                                <div class="form-group">

                                    <input type="text" class="styling name onlyCharacter" minlength="3" maxlength="20" id="name" placeholder="Name">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">

                                    <input type="text" class="styling mobile" id="mobile" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">

                                    <input type="text" class="styling" id="address" placeholder="Address (Building number, street etc)" style="height:96px;padding:0px 0px 60px 5px;">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <select class="styling" id="state" onchange="getCities(this.value)">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $state) { ?>
                                            <option value="<?php echo $state->id; ?>"><?php echo $state->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <!-- <select class="form-control downarrow cities" id="cities" onchange="getPincodes(this.value)">
                                        <option value="">Select City</option>
                                    </select> -->
                                    <input class="styling" type="text" name="cities" id="cities" placeholder="Enter City">

                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <!-- <select class="form-control downarrow pincode" id="pincode">
                                    </select> -->
                                    <input class="styling" type="text" name="pincode" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="pincode" placeholder="Pincode">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <input type="text" class="styling" id="landmark" placeholder="Location / Landmark">

                                </div>

                            </div>

                            
                                <!-- <h4>Type of Address</h4> -->

                            

                            <div class="col-lg-12 check_rad">

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" checked="" name="inlineRadioOptions" id="inlineRadio1" value="1">

                                    <label class="form-check-label" for="inlineRadio1">Home</label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2">

                                    <label class="form-check-label" for="inlineRadio2">Office</label>

                                </div>
                                <?php
                                  $qry = $this->db->query("select * from user_address where user_id='" . $user_id . "'");

                                  $address_list = $qry->result();
// Extracting the 'address_type' column from the $addresslist array
$address_types = array_column($address_list, 'address_type');

// Checking if 'default address' is present in the $address_types array
if (!in_array('3', $address_types)):
?>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
        <label class="form-check-label" for="inlineRadio3">Default Address</label>
    </div>
<?php endif; ?>



                            </div>

                            <div class="col-lg-12"  style="padding-left:40px;">

                                <button type="button" class="btn btn-address"  onclick="validateAddressForm1()">Continue</button>

                            </div>
                        </form>
                    </div>

                   
                   
        </div>
    </div>
</div>
</div>           

















<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript">
    
    $(".mobile").keypress(function (event) {
            return /\d/.test(String.fromCharCode(event.keyCode));
        });
         $(".name").keypress(function (e) {
                            //var key = e.keyCode;
                            var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
                            if (!valid) {
                                e.preventDefault();
                            }
                        });

    function validateupdateAddressForm1(aid)
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile' + aid).val();
        var pn1 = $('#pincode' + aid).val();

        if (($('#name' + aid).val() == '') || ($('#name' + aid).val().trim() == ''))
        {
            // $('#name' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Name</span>');
            toastr.error('Enter Name');
            $('#name' + aid).focus();
            return false;
        } else if ($('#mobile' + aid).val() == '')
        {
            // $('#mobile' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Mobile</span>');
            toastr.error('Enter Mobile');
            $('#mobile' + aid).focus();
            return false;
        } 
        else if (ph.length != 10)
        {
            // $('#mobile' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Valid 10 digit Phone Number</span>');
            toastr.error('Enter Valid 10 digit Phone Number');
            $('#mobile' + aid).focus();
            return false;
        } 
        else if (ph.length > 10)
        {
            // $('#mobile' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Phone Number length Not greater than 10 digits</span>');
            toastr.error('Phone Number length Not greater than 10 digits');
            $('#mobile' + aid).focus();
            return false;
        } 
        else if ($('#address' + aid).val() == '')
        {
            // $('#address' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Address</span>');
           toastr.error('Enter Address');
            $('#address' + aid).focus();
            return false;
        } else if ($('#state' + aid).val() == '')
        {
            // $('#state' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px; width:100%">Select State</span>');
            toastr.error('Select State');
            $('#state' + aid).focus();
            return false;
        } else if ($('#cities' + aid).val() == '')
        {
            // $('#cities' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter City</span>');
            toastr.error('Enter City');
            $('#cities' + aid).focus();
            return false;
        } 
        else if ($('#pincode' + aid).val() == '')
        {
            // $('#pincode' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Pincode</span>');
            toastr.error('Enter Pincode');
            $('#pincode' + aid).focus();
            return false;
        } 
         else if (pn1.length != 6)
        {
            // $('#pincode' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Valid 6 Digit Pincode</span>');
            toastr.error('Enter Valid 6 Digit Pincode');
            $('#pincode' + aid).focus();
            return false;
        }
        else if ($('#landmark' + aid).val() == '')
        {
            // $('#landmark' + aid).after('<span class="error" style="color:red;font-size: 15px;margin-left: 3px;margin-top:5px; width:100%">Enter landmark</span>');
            toastr.error('Enter landmark');
            $('#landmark' + aid).focus();
            return false;
        } else
        {
            var name = $('#name' + aid).val();
            var mobile = $('#mobile' + aid).val();
            var address = $('#address' + aid).val();
            var state = $('#state' + aid).val();
            var cities = $('#cities' + aid).val();
            var pincode = $('#pincode' + aid).val();
            var landmark = $('#landmark' + aid).val();
            var type_name = 'inlineRadioOption'+aid;
            // var selectedValue = $("input[name^='inlineRadioOption']:checked").val();
    // console.log(selectedValue);
           
            var inlineRadio1 = $("input[name="+type_name+"]:checked").val();
            var status='no';
            if(inlineRadio1 == '3'){
                status='yes';
            }
            else{
                status ='no';
            }
            $.ajax({
                url: "<?php echo base_url(); ?>web/updatebookaddress",
                method: "POST",
                data: {name: name, mobile: mobile, address: address, state: state, cities: cities, pincode: pincode, landmark: landmark, address_type: inlineRadio1, aid: aid,status:status},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        window.location.href = "<?php echo base_url(); ?>web/my_addressbook";
                        toastr.success("Address updated successfully");
                        setTimeout(function () {
                                                                location.reload();
                                                            }, 2000,slow);
                        

                        // $('#addressmsg').html('<span class="error" style="color:green;font-size: 15px;margin-left: 15px; width:100%">Address updated successfully</span>');

                        $('#addressmsg').focus();
                        return false;
                    } else if (res[1] == 'nolocation')
                    {
                        toastr.error("No shops in this location,Please change your location");
                        // $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">No shops in this location,Please change your location</span>');
                        $('#pincode').focus();
                        return false;
                    }
                }
            });
        }
      aid=null;



    }




    function validateAddressForm1()
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile').val();
        var pn = $('#pincode').val();

        if (($('#name').val() == '') || ($('#name').val().trim() == ''))
        {
            // $('#name').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px; margin-top:5px;width:100%">Enter Name</span>');
            toastr.error('Enter Name');
            $('#name').focus();
            return false;
        } else if ($('#mobile').val() == '')
        {
            // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Mobile</span>');
            toastr.error('Enter Mobile');
            $('#mobile').focus();
            return false;
        } else if (ph.length != 10)
        {
            // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Valid 10 digit Phone Number</span>');
            toastr.error('Enter Valid 10 digit Phone Number');
            $('#mobile').focus();
            return false;
        } else if ($('#address').val() == '')
        {
            // $('#address').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Address</span>');
            toastr.error('Enter Address');
            $('#address').focus();
            return false;
        } else if ($('#state').val() == '')
        {
            // $('#state').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Select State</span>');
            toastr.error('Select State');
            $('#state').focus();
            return false;
        } else if ($('#cities').val() == '')
        {
            // $('#cities').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter City</span>');
            toastr.error('Enter City');
            $('#cities').focus();
            return false;
        } 
        else if ($('#pincode').val() == '')
        {
            // $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Pincode</span>');
            toastr.error('Enter Pincode');
            $('#pincode').focus();
            return false;
        } 
         else if (pn.length != 6)
        {
            //  $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Valid 6 Digit Pincode</span>');
            toastr.error('Enter Valid 6 Digit Pincode');
             $('#pincode').focus();
            return false;
        }
        else if ($('#landmark').val() == '')
        {
            // $('#landmark').after('<span class="error" style="color:red;font-size: 15px;margin-left: 3px;margin-top:5px; width:100%">Enter landmark</span>');
            toastr.error('Enter landmark');
            $('#landmark').focus();
            return false;
        } else
        {
            var name = $('#name').val();
            var mobile = $('#mobile').val();
            var address = $('#address').val();
            var state = $('#state').val();
            var cities = $('#cities').val();
            var pincode = $('#pincode').val();
            var landmark = $('#landmark').val();
            var inlineRadio1 = $("input[name='inlineRadioOptions']:checked").val();
            var status ='no';
            if(inlineRadio1 == '3'){
                status ='yes';

            }
            else{
                status ='no';
            }
            $.ajax({
                url: "<?php echo base_url(); ?>web/addbookaddress",
                method: "POST",
                data: {name: name, mobile: mobile, address: address, state: state, cities: cities, pincode: pincode, landmark: landmark, address_type: inlineRadio1,status:status},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        window.location.href = "<?php echo base_url(); ?>web/my_addressbook";
                        toastr.success("Address added successfully");
                        setTimeout(function () {
                        location.reload();
                        }, 2000,slow);

                        // $('#addressmsg').html('<span class="error" style="color:green;font-size: 15px;margin-left: 15px; width:100%">Address added successfully</span>');
                        $('#addressmsg').focus();
                        return false;
                    } else if (res[1] == 'nolocation')
                    {
                        toastr.error("No shops in this location,Please change your location");
                        // $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">No shops in this location,Please change your location</span>');
                        $('#pincode').focus();
                        return false;
                    }



                }
            });
        }


    }



    function getCities(state_id)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>web/getStates",
            method: "POST",
            data: {state_id: state_id},
            success: function (data)
            {
                $('.pincode').html('');
                $('.cities').html(data);

            }
        });
    }


    function getPincodes(city_id, state=null)
    {
        if(state == null) {
        var state_id = $("#state").val();
    } else {
        var state_id = $("#state"+state).val();
    }
        $.ajax({
            url: "<?php echo base_url(); ?>web/getaddresspincodes",
            method: "POST",
            data: {state_id: state_id, city_id: city_id},
            success: function (data)
            {
                $('.pincode').html(data)

            }
        });
    } 

 

    
</script>
<!--about section end-->