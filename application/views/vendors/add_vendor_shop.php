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
                <div class="ibox-tools"></div>
            </div>
            <div class="ibox-content test">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/vendors_shops/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="shop_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shop Logo</label>
                        <div class="col-sm-10">
                            <input type="file" name="shop_logo" class="form-control" required>
                            <p>Make sure image Width : 300 px & Height: 300 px</p>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Owner Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="owner_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" name="mobile" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Refferal Code</label>
                        <div class="col-sm-10">
                            <input type="text" id="refferalcode" name="refferalcode" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="password" class="form-control" required>
                        </div>
                    </div>
                   <!--  <div class="form-group">
                        <label class="col-sm-2 control-label">Min Order Amount</label>
                        <div class="col-sm-10">
                            <input type="text" name="min_order_amount" class="form-control" required>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="states" required id="state_id">
                                <option value = "">Select State</option>
                                <?php
                                $stat = $this->db->query("select * from states");
                                $states = $stat->result();
                                foreach ($states as $st) {
                                    ?>
                                    <option value="<?php $st->id; ?>"><?= $st->state_name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id" required id="cities">
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Locations</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="loc_id" required id="locations">


                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode</label>
                        <div class="col-sm-10">
                            <input type="text" name="pincode" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Latitude</label>
                        <div class="col-sm-10">
                            <input type="text" name="latitude" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" name="longitude" class="form-control" required>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-2 control-label">Assign Visual Merchant</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="vm_id" required>
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
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Verification Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="1" /> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="0" /> InActive
                            </label>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal of the day</label>
                        <div class="col-sm-10">
                            <label class='text-success'>
                                <input type="radio"
                                       name="is_deal_of_the_day"
                                       id="deal_of_the_day2"
                                       required="required"
                                       data-msg-required="This Deal of the day is required" value="1" checked                                                   /> Yes
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="is_deal_of_the_day"
                                       id="deal_of_the_day9"
                                       required="required"
                                       data-msg-required="This Deal of the day is required" value="0"                                                    /> No
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal of the day image</label>
                        <div class="col-sm-10">
                            <span>
                                <input type="file" accept="image/*" name="deal_image" class="form-control show_selected_image_preview" data-msg-required="This Deal of the day image is required">
                                <span class="help-block m-b-none">Image Width : 310px and height : 155px</span>
<!--                                Previous Image : <img src="https://smartlife-test.s3.ap-south-1.amazonaws.com/uploads/stores/736/4366f8d454869a59cb751c9f4a2f96bc.jpg" style="width:100px; height:100px"/>
                                <button class="btnRmv" type="button">Remove</button>-->
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal start date</label>
                        <div class="col-sm-10">
                            <input type="text" id="deal_start_date"  name="deal_start_date" class="form-control datepicker" value="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deal end date</label>
                        <div class="col-sm-10">
                            <input type="text" id="deal_end_date"  name="deal_end_date" class="form-control datepicker" value="">

                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">Save</button>
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

        $('#states').on('change', function () {
            var state_id = $('#state_id').val();
            alert(state_id);
            loadCities(state_id);
        });

        function loadCities(state_id) {
            //alert(city);
            // $('.modal').modal('show');
            $.get("<?= base_url() ?>api/admin_ajax/vendors/get_cities", "state_id=" + state_id,
                    function (response, status, http) {
                        //$('.modal').modal('hide');
                        $('#cities').html(response);
                    }, "html");
        }


        $('#cities').on('change', function () {
            var city_id = $('#cities').val();

            loadCityLocations(city_id);
        });

        function loadCityLocations(city_id) {
            //alert(city);
            // $('.modal').modal('show');
            $.get("<?= base_url() ?>api/admin_ajax/vendors/get_city_locations", "city_id=" + city_id,
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