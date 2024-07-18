<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Become a Vendor</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
                        <li>Become a Vendor</li>
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
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <?php $this->load->view("web/dashboard_menu"); ?>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div id="success_message"></div>
                                <div class="newaddressbox">
                                    <form class="form-horizontal row" enctype="multipart/form-data"  >
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="shopname" placeholder="Shop Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="ownername" placeholder="Owner Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <input type="number" maxlength="10" class="form-control" id="mobile" placeholder="Mobile">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="state" placeholder="State">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="city" placeholder="City">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="location" placeholder="Location">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="button" onclick="validatebecomeavendorForm()" class="btn btn-pink btn-block">SUBMIT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    // $('#btn_register').click(function(){




    function validatebecomeavendorForm()
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile').val();

        if ($('#shopname').val() == '')
        {
            $('#shopname').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Shop Name</span>');
            $('#shopname').focus();
            return false;
        } else if ($('#ownername').val() == '')
        {
            $('#ownername').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Owner Name</span>');
            $('#ownername').focus();
            return false;
        } else if ($('#email').val() == '')
        {
            $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Email</span>');
            $('#email').focus();
            return false;
        } else if (!validateEmail($('#email').val()))
        {
            $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Invalid Email Address</span>');
            $('#email').focus();
            return false;
        } else if ($('#mobile').val() == '')
        {
            $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Mobile</span>');
            $('#mobile').focus();
            return false;
        } else if (ph.length != 10)
        {
            $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 10 digit Phone Number</span>');
            $('#mobile').focus();
            return false;
        } else if ($('#state').val() == '')
        {
            $('#state').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter State</span>');
            $('#state').focus();
            return false;
        } else if ($('#city').val() == '')
        {
            $('#city').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter City</span>');
            $('#city').focus();
            return false;
        } else if ($('#location').val() == '')
        {
            $('#location').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter State</span>');
            $('#location').focus();
            return false;
        } else
        {
            var shopname = $('#shopname').val();
            var ownername = $('#ownername').val();
            var mobile = $('#mobile').val();
            var email = $('#email').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var location = $('#location').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/become_vendor",
                method: "POST",
                data: {shopname: shopname, ownername: ownername, mobile: mobile, email: email, state: state, city: city, location: location},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        $('#shopname').val('');
                        $('#ownername').val('');
                        $('#mobile').val('');
                        $('#email').val('');
                        $('#state').val('');
                        $('#city').val('');
                        $('#location').val('');
                        $('#success_message').html('<span class="error" style="color:green;font-size: 18px;margin-left: 18px; width:100%">Vendor Added Successfully</span>');
                        $('#success_message').focus();
                        return false;
                    } else
                    {
                        $('#success_message').html('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Something went wrong, Please try again</span>');
                        $('#success_message').focus();
                        return false;
                    }
                }
            });
        }


    }

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
<!--about section end-->