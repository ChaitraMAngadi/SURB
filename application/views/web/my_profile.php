
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3 breads">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3>My Profile</h3> -->
<!--                    <ul>
                        <li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
                        <li>My Profile</li>
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
                    <div class="col-lg-2 col-md-12 my_profile">
                        <?php include 'dashboard_menu.php' ?>
                    </div>
                    <div class="col-lg-10 col-md-12 my_pro">
                    <?php $user_qry = $this->db->query("select * from users where id='".$user_id."'");
$user_qry_res = $user_qry->row();
$date=date('Y-m-d');
$user_expiry_date = ($user_qry_res->expiry_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->expiry_member_date)) : null;

$user_created_date = ($user_qry_res->created_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->created_member_date)) : null;
// print_r($user_qry_res);
?>
                    <div class="prof_header">
                        <span class="prof">My Profile </span>
                        <a href="#" class="ed" id="edit">Edit</a>
                       <?php 
                       if (($user_expiry_date != null && $user_expiry_date >= $date && $user_qry_res->expiry_member_date!='') && 
                       ($user_created_date != null && $user_created_date <= $date && $user_qry_res->created_member_date!='')&& $user_qry_res->membership=='yes' && $user_qry_res->plan!=0 && $user_qry_res->plan!=''&& $user_qry_res->plan!=null&& $user_qry_res->plan!='0' ) {?>
                        <span class="prime-member-tag">
                            <span class="tick-mark">&#9733;</span><span>pro</span>
                        </span>

                    <?php 
                }?>
                    </div>
                    

                    <div class="profilebox">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="profile_success_message" class="alert-success"></div>
                                <form class="form-horizontal" enctype="multipart/form-data"  >


                                    <div class="row newprofilebox">

                                        <div class="col-lg-4 left">
                                            <div class="form-group">
                                               
                                                <div class="input-group mb-3">
                                                    <!-- <span class="input-group-text"><i class="fal fa-user"></i></span> -->
                                                    <input type="text" class="onlyCharacter profile" readonly="" id="profile_first_name" name="first_name" placeholder="First Name" value="<?php echo $profiledata['first_name'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 ">
                                            <div class="form-group">
                                                
                                                <div class="input-group mb-3">
                                                    <!-- <span class="input-group-text"><i class="fal fa-user"></i></span> -->
                                                    <input type="text" class="onlyCharacter profile" readonly="" id="profile_last_name" name="last_name" placeholder="last Name" value="<?php echo $profiledata['last_name'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                
                                                <div class="input-group mb-3">
                                                    <!-- <span class="input-group-text"><i class="fal fa-mobile"></i></span> -->
                                                    <input type="text" class="profile" name="phone" readonly="" id="mobile" placeholder="Mobile"value="<?php echo $profiledata['phone'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                
                                                <div class="input-group mb-3">
                                                    <!-- <span class="input-group-text"><i class="fal fa-envelope"></i></span> -->
                                                    <input type="text" class="profile" name="email" readonly="" id="email" placeholder="Email" value="<?php echo $profiledata['email'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div>
                                        <!-- <a href="<?php echo base_url(); ?>web/change_password" class="ed">Change Password</a> -->
                                        <a  class="ed1"  data-toggle="modal" data-target="#changepass">Change Password</a>
                                        </div><br><br>
                                        



                                        <!-- <div class="col-lg-12">
                                          <div class="form-group">
                                           <label for="">Current Password</label>
                                            <div class="input-group mb-3">
                                         <span class="input-group-text"><i class="fal fa-key"></i></span>
                                         <input type="password" class="form-control" value="xxxxxx">
                                       </div>
                                          </div>
                                        </div>

                                       <div class="col-lg-6">
                                         <div class="form-group">
                                           <label for="">New Password</label>
                                           <div class="input-group mb-3">
                                         <span class="input-group-text"><i class="fal fa-key"></i></span>
                                         <input type="password" class="form-control" value="">
                                       </div>
                                         </div>
                                       </div>

                                       <div class="col-lg-6">
                                         <div class="form-group">
                                           <label for="">Confirm Password</label>
                                           <div class="input-group mb-3">
                                         <span class="input-group-text"><i class="fal fa-key"></i></span>
                                         <input type="password" class="form-control" value="">
                                       </div>
                                         </div>
                                       </div> -->

<div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-body">

            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
        

            <div id="profile_success_message" class="alert-success"></div>
                                <form class="form-horizontal" enctype="multipart/form-data"  >

                                    <div class="row prof_box">
                                        <h4>Change Password</h4>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                
                                                <div class="input-group mb-3">
                                                    
                                                    <input type="password" name="current_password" id="current_password" class="styling2" placeholder="Current Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                
                                                <div class="input-group mb-3">
                                                    
                                                    <input type="password" name="new_password" id="new_password" class="styling2" placeholder="New Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                
                                                <div class="input-group mb-3">
                                                    
                                                    <input type="password" name="confirm_password" id="confirm_password" class="styling2" placeholder="Confirm New Password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="input-group mb-3">
                                            <button type="button" onclick="change_pass_form()" class="btn  submit-btn">Update Password</button>
                                        </div>
                                        </div>

                                    </div>
                                </form>



</div>
</div>
</div>
</div>













                                        <div class="input-group mb-3">
                                            <button type="button" onclick="validateprofileForm()" class="btn btn-pink"  id="updateButton">Update</button>
                                        </div>

                                    </div>
                                </form>




                            </div>
                        </div>
                    </div>
                   
                   
               
                        



                        
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // When the "Edit" link is clicked
    $('#edit').click(function(e) {
        e.preventDefault(); // Prevent the link from navigating to another page

        // Toggle the read-only state of the form fields
        $('#profile_first_name').prop('readonly', function (_, val) {
            return !val;
        });
        $('#profile_last_name').prop('readonly', function (_, val) {
            return !val;
        });
        $('#mobile').prop('readonly', function (_, val) {
            return !val;
        });
        $('#email').prop('readonly', function (_, val) {
            return !val;
        });

        // Update the text of the "Edit" link
        // $(this).text(function(_, text) {
        //     return text === 'Edit' ? 'Save' : 'Edit';
        // });
       $('#updateButton').show();

     
    });

    // You can also use a button element instead of an anchor link
    /* $('#editButton').click(function() {
        // Same code as above
    }); */
});
</script>

<script type="text/javascript">


    function validateprofileForm()
    {
        $('.error').remove();
        var errr = 0;

        if ($('#profile_first_name').val() == '')
        {
            $('#profile_first_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter First Name</span>');
            $('#profile_first_name').focus();
            return false;
        } else if ($('#profile_last_name').val() == '')
        {
            $('#profile_last_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Last Name</span>');
            $('#profile_last_name').focus();
            return false;
        } 
        else if ($('#email').val() == '')
        {
            $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Email</span>');
            $('#email').focus();
            return false;
        }else if ($('#mobile').val() == '')
        {
            $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Mobile Number</span>');
            $('#mobile').focus();
            return false;
        }else
        {
            var first_name = $('#profile_first_name').val();
            var last_name = $('#profile_last_name').val();
            var mobile= $('#mobile').val();
            var email=$('#email').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/updateUserdata",
                method: "POST",
                data: {first_name: first_name, last_name: last_name,mobile:mobile,email:email},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    // alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        toastr.success("Profile updated successfully");
                        // $('#profile_success_message').html('<span class="error" style="color:green;font-size: 18px;margin-left: 18px; width:100%">Profile Updated success</span>');
                        $('#profile_success_message').focus();


                        //return false;

                        setTimeout(function () {
                            $('#profile_success_message').hide();

                        }, 10000);

                    } else
                    {
                        $('#profile_success_message').html('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Something went wrong, Please try again</span>');
                        $('#profile_success_message').focus();
                        return false;

                    }

                    window.location.href = "<?php echo base_url(); ?>web/myprofile";
                }
            });
        }


    }





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
                        toastr.success("Password changed successfully!");
                        location.reload();

                    } else if(result == 'cur_pas_wrong') {
                        toastr.error("Current password wrong!")
                        $('#current_password').focus();
                    } else if(result == 'mis_match') {
                        toastr.error("New password & confirm password mismatched!");
                        $('#confirm_password').focus();
                    } else {
                        toastr.error("Something went wrong. Please try again!");
                    }
                }

            });
        }
    }


</script>

<!--about section end-->