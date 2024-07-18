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
<?php 
// echo "<pre>";
// print_r($warehouses);
// die();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/warehouses">
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
                    <?php foreach($warehouses as $warehouse){?>
<div class="col-lg-12">
    <form id="update_delivery" method="post" class="form-horizontal" enctype="multipart/form-data">
        <h3 class="text-center text-primary">Update Warehouse</h3>
        <div class="form-group">
            <div class="col-lg-12">
                <?php $qry=$this->db->query("select owner_name from vendor_shop where id='" . $warehouse->vendor_id . "'");
                $res=$qry->result();
                // print_r($res[0]->owner_name);
                ?>
                <select name="owner_name" id="owner_name" class="form-control">
                <option value = ""></option>
                <option  value="<?= $warehouse->id?>"><?php echo $res[0]->owner_name; ?></option>
               
                </select> 
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                
                <!-- <select > -->
                                <option value = ""></option>
                                <?php 
                                // $wa_query=$this->db->Query("select warehouse_name,pincode from warehouses where vendor_id='" . $warehouse->vendor_id . "'");
                                // $warehouse_result=$wa_query->result();
                              ?>
                                
                                <?php
                                // foreach ($warehouse_result as $ct) {
                                    ?>
                                    <!-- <option value="<?= $ct->warehouse_name?>"><?= $ct->warehouse_name ?></option> -->
                                    <?php
                                // }
                                ?>

                            <!-- </select> -->
                              <?php 
                            // print_r($warehouse_result);
                            $qry_ware=$this->db->query("select warehouse_name from warehouses where id='" . $warehouse->id . "'");
                            $res=$qry_ware->result();
                            // echo "<pre>";print_r($res[0]->warehouse_name);exit;?>
                            
                            <input type="text" name="warehouse_name" id="warehouse_name" class="form-control"  value="<?php print_r($res[0]->warehouse_name); ?>" readonly="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <input type="text" onkeypress="return isNumberKey(event)"  id="mobile_number" maxlength="10" name="mobile_number" class="form-control" placeholder="Enter Mobile number" value="<?php echo $warehouse->mobile_number;?>">
            </div>
            <div class="col-lg-6">
                <input type="email" name="email_id" id="email_id" class="form-control" placeholder="Enter Email Id" value="<?php echo $warehouse->Email;?>"  >
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                <input type="text" name="warehouse_address" id="warehouse_address" class="form-control" placeholder="Enter Warehouse Address" value=<?php echo $warehouse->address;?>>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <input type="number" name="pincodes" id="pincodes" class="form-control" placeholder="Enter pincode" value=<?php echo $warehouse->pincode;?> required>
            </div>
            <div class="col-lg-6">
                <input type="text" name="city" id="city" class="form-control" placeholder="Enter city name" value=<?php echo $warehouse->city;?> readonly="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <input type="text" name="state" id="state" class="form-control" placeholder="Enter state" value=<?php echo $warehouse->state;?> readonly="">
            </div>
            <div class="col-lg-6">
                <input type="text" name="country" id="country" class="form-control" placeholder="Enter country name" value=<?php echo $warehouse->country;?> readonly="">
            </div>
        </div>
        <div>
            <input type="checkbox" id="returnSameAsPickup" onchange="toggleReturnAddressForm()" checked>
            <label for="returnSameAsPickup">Return address is the same as Pickup Address</label>
        </div>

        <!-- Additional fields for return address -->
        <div id="returnAddressFields" style="display:none;">
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="text" name="return_address" id="return_address" class="form-control" placeholder="Enter Return Address" value=<?php echo $warehouse->return_address;?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <input type="number" name="return_pincode" id="return_pincode" class="form-control" placeholder="Enter Return pincode" value=<?php echo $warehouse->return_pincode;?>>
                </div>
                <div class="col-lg-6">
                    <input type="text" name="return_city" id="return_city" class="form-control" placeholder="Enter Return city name" value=<?php echo $warehouse->return_city;?> readonly="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <input type="text" name="return_state" id="return_state" class="form-control" placeholder="Enter Return state" value=<?php echo $warehouse->return_state;?> readonly="">
                </div>
                <div class="col-lg-6">
                    <input type="text" name="return_country" id="return_country" class="form-control" placeholder="Enter return country name" value=<?php echo $warehouse->return_country;?> readonly="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-12">
                <input type="submit" value="submit" class="btn btn-primary" onclick="saveData()">
            </div>
        </div>
    </form>
</div><?php }?>
        </div></div></div>

        <script type="text/javascript">			
		function saveData() {
    var owner_name=$("#owner_name").val();
    var warehouse_name = $('#warehouse_name').val();
    var mobile_number = $('#mobile_number').val();
    var email = $('#email_id').val();
    var warehouse_address = $('#warehouse_address').val();
    var pincode = $('#pincodes').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var country = $('#country').val();
    // console.log(owner_name);
    var returnSameAsPickup = $('#returnSameAsPickup').prop('checked'); // true if checked, false if unchecked

    var return_address, return_pincode, return_city, return_state, return_country;

    if (returnSameAsPickup) {
        // If returnSameAsPickup is checked, use the pickup address values for return address
        return_address = warehouse_address;
        return_pincode = pincode;
        return_city = city;
        return_state = state;
        return_country = country;
    } else {
        // If returnSameAsPickup is unchecked, use the values from the return address form
        return_address = $('#return_address').val();
        return_pincode = $('#return_pincode').val();
        return_city = $('#return_city').val();
        return_state = $('#return_state').val();
        return_country = $('#return_country').val();
    }

    // Validate the data
    if (warehouse_name === '') {
        // toastr.error("Enter warehouse name");
        $('#warehouse_name').focus();
        return false;
    } else if (pincode === '') {
        toastr.error("Enter pincode");
        $('#pincodes').focus();
        return false;
    } 

    // Additional validation for the return address form if returnSameAsPickup is unchecked
    if (!returnSameAsPickup) {
        if (return_address === '') {
            // toastr.error("Enter return address");
            // $('#return_address').focus();
            return false;
        } else if (return_pincode === '') {
            // toastr.error("Enter return pincode");
            // $('#return_pincode').focus();
            return false;
        } 
    }

    // Send data to the server using AJAX
    $.ajax({
        url: "<?php echo base_url(); ?>vendors/Warehouses/update_warehouse",
        method: "POST",
        data: {
            owner_name:owner_name,
            warehouse_name: warehouse_name,
            mobile_number: mobile_number,
            email: email,
            warehouse_address: warehouse_address,
            pincode: pincode,
            city: city,
            state: state,
            country: country,
            return_address: return_address,
            return_pincode: return_pincode,
            return_city: return_city,
            return_state: return_state,
            return_country: return_country
        },
        success: function (data) {
            // Handle the success response from the server
            // You can show additional toasts or take further actions here
            toastr.success("Data saved successfully");
        },
        error: function (xhr, status, error) {
            // Handle the error response from the server
            // You can show additional toasts or take further actions here
            toastr.error("Error saving data");
        }
    });
}

function toggleReturnAddressForm() {
        var returnAddressFields = document.getElementById("returnAddressFields");
        var returnSameAsPickupCheckbox = document.getElementById("returnSameAsPickup");

        if (returnSameAsPickupCheckbox.checked) {
            returnAddressFields.style.display = "none";
        } else {
            returnAddressFields.style.display = "block";
        }
    }
    </script>