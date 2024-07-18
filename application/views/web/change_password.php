<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Change Password</h3>
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
                        <?php include 'dashboard_menu.php' ?>
                    </div>
                    <div class="col-lg-9 col-md-12">


                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div id="profile_success_message" class="alert-success"></div>
                                <form class="form-horizontal" enctype="multipart/form-data"  >

                                    <div class="row newaddressbox">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Current Password</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fal fa-key"></i></span>
                                                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter current password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fal fa-key"></i></span>
                                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Confirm Password</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fal fa-key"></i></span>
                                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <button type="button" onclick="change_pass_form()" class="btn btn-primary submit-btn">Update Password</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">

    function change_pass_form() {

        //alert('hii');
        $('.error').remove();
        if ($('#current_password').val() == '')
        {
            toastr.error('Enter your Current Password')
            $('#current_password').focus();
            return false;
        } else if ($('#current_password').val().length < 6)
        {
            toastr.error('Enter minimum 6 character')
            $('#current_password').focus();
            return false;
        } else if ($('#new_password').val() == '')
        {
            toastr.error('Enter new Password')
            $('#new_password').focus();
            return false;
        } else if ($('#new_password').val().length < 6)
        {
            toastr.error('Enter minimum 6 character')
            $('#new_password').focus();
            return false;
        } else if ($('#confirm_password').val() == '')
        {
            toastr.error('Confirm new password')
            $('#confirm_password').focus();
            return false;
        } else if ($('#new_password').val() != $('#confirm_password').val())
        {
            toastr.error('New password & confirm password mismatched')
            $('#confirm_password').focus();
            return false;
        } else {

            var current_password = $('#current_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();

            $.ajax({
                url: '<?= base_url() ?>web/change_pass',
                type: "POST",
                data: {current_password: current_password, new_password: new_password, confirm_password: confirm_password},
                success: function (result) {
                    if (result == 1) {
                        $("#current_password").val("");
                        $('#new_password').val("");
                        $('#confirm_password').val("");
                        toastr.success("Password changed successfully!")
                    } else if(result == 'cur_pas_wrong') {
                        toastr.error("Current password wrong!")
                        $('#current_password').focus();
                    } else if(result == 'mis_match') {
                        toastr.error("New password & confirm password mismatched!")
                        $('#confirm_password').focus();
                    } else {
                        toastr.error("Something went wrong. Please try again!")
                    }
                }

            });
        }
    }


</script>