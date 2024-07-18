<head>
    <!-- <link rel="stylesheet" href="web_assets/bootstrap.min.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
  .float-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            background-color: #25D366; /* WhatsApp green color */
            color: white;
            border: none;
        }
        .float-button i {
            font-size: 30px; /* Increase font size */
        }
</style>
<?php include('products-26102022.php');?>
<?php
$session_id = $_SESSION['session_data']['session_id'];
$user_id = $_SESSION['userdata']['user_id'];
$cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
$cart_count = $cart_qry->num_rows();
?>

<input type="hidden" id="cart_count_hidden_input" value="<?php echo $cart_count; ?>">
<input type="hidden" id="session_id" value="<?php echo $session_id; ?>">
<input type="hidden" id="vendor_id" value="<?php echo $_SESSION['session_data']['vendor_id']; ?>">

<!--footer area start-->
<input type="hidden" id="login_quantity" >
<input type="hidden" id="login_vendor_id" >
<input type="hidden" id="login_session_id">
<input type="hidden" id="login_variant_id" >
<input type="hidden" id="login_saleprice" >
<footer class="footer_widgets1">

    <div class="container">



        <div class="footer_middle">

            <div class="row">

                <div class="col-lg-10 offset-lg-1">
                
                    <div class="row off">
                        

                                               <!-- <div class="col-lg-3 col-md-6 col-6"> -->
                                               <div class="col-lg-7">
                                                    <h4>Popular Category</h4>

                                                   

                        
                                                    <ul class="links">
                        <?php
                       
                        foreach ($categories as $category) {
                            
                                ?>
                          <!-- <li><a href="<?php echo base_url(); ?>web/store/<?php echo $category['vendor_seo_url']; ?>/<?php echo $category['seo_url']; ?>/shop"><?php echo $category['title']; ?></a></li> -->
                         <li><a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>"><?= ($category['title']) ? $category['title'] : $category['category_name'] ?></a></li>
                                <?php
                           
                        }
                        ?>
                        
                                                        
                                                    </ul>
                        
                                                </div>
                    </div>
                   

   


                    <div class="row off">

                                               <!-- <div class="col-lg-3 col-md-6 col-6"> -->
                                               <div class="col-lg-12 col-12 col-sm-12 col-xs-12 col-md-12">
                                                    <h4>Popular Searches</h4>
                                                    
                                                    <ul class="list-unstyled five-column">
                                                  <?php  $arr=array("Hairfall","shampoo","Facecream","Hair oil","Glooming kit","Saving cream","Fitness");
                                                  $i=1;
                                                 
                        
                                                  while($i<=4){?>
                          
                          <?php for($j=0;$j<count($arr);$j++){
                                                         
                          
                          
                                 
                                                    
                                                         ?>
                                                  
                                                  
                                            <form  enctype="multipart/form-data" method="get" action="<?= base_url('search') ?>" accept-charset="utf-8" class="user">
                                        
                                                <div class="input-group">
                                                    <input id="searchdata" name="searchdata" onkeyup="getdatasearch(<?php echo $arr[$j];?>)"value="<?php echo $arr[$j];?>" type="hidden">
                                                   <li> <button type="submit" class="popular"><?php echo $arr[$j];?>&nbsp;|&nbsp;</button></li>
                                                </div>

                                            </form>
                                            <?php }
                                            $i++;
                                            ?>
                                            <?php }?>
                                            </ul>
                                          <script>         
                                
                                function getdatasearch(val)
            {
                var keyword = val.value;
                if (keyword.length > 1) {
                    $('#search_report').show();
                    $('.error').remove();
                    var errr = 0;
                    $.ajax({
                        url: "<?php echo base_url(); ?>web/searchdata",
                        method: "POST",
                        data: {keyword: keyword},
                        success: function (data)
                        {
                            if (data != '') {
                                var element = document.getElementById("search_report");
                                element.classList.add("scrollsea");
                                $('#search_report').html(data);
                            } else {
                                $('#search_report').html('<li>No products found.</li>');
                            }
                        }
                    });
                } else {
                    $('#search_report').hide();
                }
            }
               </script>                 
                                                   
                                                                             
                        
                                                    
                        
                                                </div>
                    </div>
                    
                    <div class="footer_bottom">


    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <div class="col-lg-8 col-md-8">

                    <div class="footer_bottom_left">

                        <!--                        	<div class="footer_logo">

                                                                                   <a href="#"><img src="<?php echo base_url(); ?>web_assets/img/logo.png" alt=""></a>

                                                                                </div>-->

                        <div class="copyright_area">

                            <p>© <?php echo date('Y') -1 . '-' . (date('Y') );?> Copyright  <a href="<?php echo base_url(); ?>" target="_blank">AbsoluteMens.com Fashion Services Private Limited.</a>  
<!-- Design &amp; Developed By<a href="https://thecolourmoon.com/" target="_blank">Colourmoon</a></p> -->

                        </div>

                    </div>

                </div>

                <!-- <div class="col-lg-4 col-md-4">

                    <div class="footer_paypal text-right">

                        <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>web_assets/img/icon/payment.png" alt="" height="20"></a>


                    </div>

                </div> -->

            </div>
        </div>
    </div>

</div>























                        <div class="col-lg-12">

                           
                                
                            
                            <div class="footer_social">

                                <ul>
                                <div>
                                    <span><a href="<?php echo base_url(); ?>web/privacy_policy">Privacy Policy | </a></span>

                                <span><a href="<?php echo base_url(); ?>web/refund_policy">Cancellation and Refund Policy |</a></span>

                                <span><a href="<?php echo base_url(); ?>web/terms_and_conditions">Terms and Conditions | </a></span>

                                <span><a href="<?php echo base_url(); ?>web/delivery_partner">Delivery Partner | </a></span>
                                <span><a href="<?php echo base_url(); ?>web/shipping_policy">Shipping Policy</a></span>&nbsp;&nbsp;&nbsp;
                                </div>
                                
                                    <li><a href="<?= $social_media_links->facebook; ?>" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>

                                    <li><a href="<?= $social_media_links->twitter; ?>" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>

                                    <li><a href="<?= $social_media_links->youtube; ?>" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>

                                    <li><a href="<?= $social_media_links->instagram; ?>" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                              
                              </ul>
                                

                            </div>
                        </div>

                        <!-- <button class="float-button">
        <i class="fab fa-whatsapp"></i>
    </button> -->
                        <!--                        <div class="col-lg-3 col-md-6 col-12">
                                                    <h4>Download Our App</h4>
                                                    <div class="app-links">
                                                        <a href="" target="_blank" class="mb-2 mr-2">
                                                            <img src="<?php echo base_url(); ?>web_assets/img/app-logo-two.png" alt="" width="120" style="height:38px">
                                                        </a>
                                                        <a href="" target="_blank" class="mb-0">
                                                            <img src="<?php echo base_url(); ?>web_assets/img/app-logo-one.png" alt="" width="120" style="height:38px">
                                                        </a>

                                                    </div>
                                                </div>-->



                        <!--  <ul class="" style="color: #fff;" >

                                 <li style="float: left; margin-left: 10px;"><a href="<?php echo base_url(); ?>web/privacy_policy">Privacy Policy</a>  |  </li>

                                 <li style="float: left; margin-left: 10px;"><a href="<?php echo base_url(); ?>web/refund_policy">Refund and Return Policy</a> | </li>

                                 <li style="float: left; margin-left: 10px;"><a href="<?php echo base_url(); ?>web/terms_and_conditions">Terms and Conditions</a></li>

                             </ul> -->


                    </div>

                </div>

            </div>
            <a href="javascript:void(0);" class="gototop"><i class="fal fa-angle-up"></i></a>
        </div>

        <!-- <div class="footer_bottom">

            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="row align-items-center">

                            <div class="col-lg-8 col-md-8">

                                <div class="footer_bottom_left">

                                                           	<div class="footer_logo">

                                                                                               <a href="#"><img src="<?php echo base_url(); ?>web_assets/img/logo.png" alt=""></a>

                                                                                            </div>-->
<!-- 
                                    <div class="copyright_area">

                                        <p>Copyright  © <?php echo date('Y'); ?>  <a href="<?php echo base_url(); ?>" target="_blank">Absolutemens</a> All rights reserved.  Design &amp; Developed By<a href="https://thecolourmoon.com/" target="_blank">Colourmoon</a> </p>

                                     </div>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4">

                                <div class="footer_paypal text-right">

                                    <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>web_assets/img/icon/payment.png" alt="" height="20"></a>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div> --> 

    </div>

</footer>

<!--footer area end-->



<!--loginmodal-start-->

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times" aria-hidden="true"></i></button>

                <div class="row">

                    <div class="col-lg-12" id="loginDiv">

                       <h4>Login to your Account</h4>

                        <p class="pb-3">Enter your registered Mobile/Email.</p>
                   
                        <!-- <div class="input-group" id="otp_show_errormsg" style="display:none"></div> -->
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            <div class="input-group mb-3">

                                
                                <input type="text" class="form-control" id="email_phone" name="email_phone" placeholder="Enter Mobile or email ID">

                            </div>

                            <div class="input-group mb-3 continue-btn">

                                <button type="button" id="logotpbtn" onclick="validateLoginOTP()" class="btn btn-pink btn-block">Continue</button>
                                  
                            </div>
                            <hr>
                            <div class="input-group mb-3 mypass-btn" style="justify-content:center;align-items:center;">
                            <button onclick="goLoginOTP()" type="button" class="btn btn-login-gmail">Login With Password</button>
                            </div>
                            <!-- <p>or Login using social media</p>
                            <div class="input-group mb-3">
   <div class="social" style="display:flex;justify-content:center;gap:1.5rem;">
 

<div class="go"><i class="fab fa-google"><a href="https://www.google.com/login"></i></a></div>
<div class="fb">
<a href="https://www.facebook.com/login" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true" style="color:white;"></i></a>
</div></div>
</div> -->

   <p>Don't have an Account?</p><!-- <a href="#registerModal" data-toggle="modal" data-dismiss="modal">Register</a> --><p><br><a onclick="showRegistration()" data-toggle="modal" data-dismiss="modal">Register Here</a>
       </p>
                            
                        </form>

                    </div>

                    <!--                    otp login div-->

                    <div class="col-lg-12" id="loginWithOTP" style="display: none">

<h4>Login to your Account</h4>
<p>Enter your registered Mobile or Email ID</p>
<!-- <span class="input-group" id="login_show_errormsg" style="display:none"></span> -->
<form class="form-horizontal" enctype="multipart/form-data" autocomplete="on">
   <div class="input-group mb-3">

       

       <input type="text" class="form-control" id="email" name="email" placeholder="Mobile or Email Address">

   </div>

   <div class="input-group mb-3 password-container">

      

       <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="margin-right: -17px;" autocomplete="on">
       <i class="fal fa-eye-slash" id="passeye" style="position:relative;z-index:999;left: -14px;cursor: pointer" onclick="togglePassword(this)"></i>
   </div>
   <div class="input-group" style="justify-content:end;">
       <a onclick="goForgot()" style="text-decoration:underline;color:#2556B9;">Forgot Password?</a>
   </div>
   

  


   <div class="input-group mb-3 mt-2 mycontinue-btn">
   <button type="button" onclick="validateloginForm()" id="validateLogin" class="btn btn-pink btn-block">Continue</button>
   </div>
   <hr>
   <div class="input-group mb-3 passotp-btn">
       <button onclick="showLoginForm()" type="button" class="btn btn-login-gmail">Login with OTP</button>
       

      
   </div>
   <!-- <p>or Login using social media</p>
   <div class="input-group mb-3" style="justify-content:center;align-items:center;">
   <div class="social" style="display:flex;justify-content:center;gap:1.5rem;">
 

<div class="go"><i class="fab fa-google"><a href="https://www.google.com/login"></i></a></div>
<div class="fb">
<a href="https://www.facebook.com/login" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true" style="color:white;"></i></a>
</div>
</div></div> -->

   <p>Don't have an Account?</p><!-- <a href="#registerModal" data-toggle="modal" data-dismiss="modal">Register</a> --><p><br><a onclick="showRegistration()" data-toggle="modal" data-dismiss="modal">Register Here</a>
       </p>
       <!-- <a href="#registerModal" data-toggle="modal" data-dismiss="modal">Register</a> -->
   <!--                            <div class="input-group mb-3">
                                                               <button type="button" class="btn btn-login-gmail"><i class="fab fa-google"></i> - Login With Gmail</button>
                                                               </p>
                                                           </div>-->
   
   


</form>

</div>


                    <!<!-- verify login otp -->

                    <div class="col-lg-12" id="showotpform" style="display: none">

                        <h4>Enter Code</h4>

                        <p class="pb-3" id="otpMsg">We send OTP code to your Mobile.</p>

                        <form class="form-horizontal" enctype="multipart/form-data" autocomplete="on">

                            <input type="hidden" id="user_mobile" name="user_mobile" oninput="this.value = Math.abs(this.value)">

                            <div class="input-group mb-3">

                                <!-- <span class="input-group-text"><i class="fal fa-password-open"></i></span> -->

                                <!-- <input type="text" class="form-control" id="login_otp" oninput="this.value = Math.abs(this.value)" name="login_otp" maxlength="4" placeholder="Enter OTP" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"> -->
                                <div id="error-toast"></div> 
                                <div class="otp-container" id="one_by_one">
    <input class="otp-input" type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="moveToNext(this, 2)">
    <input class="otp-input" type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="moveToNext(this, 3)">
    <input class="otp-input" type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="moveToNext(this, 4)">
    <input class="otp-input" type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" onclick="moveToNext(this, 5)" id="login_by_otp">
  </div>

  

                            </div><br>

                            <div class="input-group mb-3">

                                <button type="button" onclick="verifyOtp()" id="login_by_otp" class="btn btn-pink btn-block">Continue</button>

                            </div>
                            <div class="input-group mb-3 mygroup">
  <div class="row" style="display: flex; justify-content: center;">
    <div class="col-lg-12" style="display: flex;">
      <p  style="align-self: center;">Didn't Receive Code</p>
      <p style="align-self: center;"><a onclick="resendLoginOTP()">Resend</a></p>
    </div>
    <!-- <div class="col-lg-2" style="display: flex; justify-content: flex-end; align-items: center;">
     <p style="align-self: center;"><a onclick="goLoginOTP()">Back</a></p>
    </div> -->
  </div>
</div>


                            <div class="input-group mb-3 mypass-btn">
       <button onclick="showLoginForm()" type="button" class="btn btn-login-gmail">Login with password</button>
       

      
   </div>
   <!-- <p>or Login using social media</p><div class="input-group mb-3">
   <div class="social" style="display:flex;justify-content:center;gap:1.5rem;">
 

<div class="go"><i class="fab fa-google"><a href="https://www.google.com/login"></i></a></div>
<div class="fb">
<a href="https://www.facebook.com/login" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true" style="color:white;"></i></a>
</div></div>
</div><br> -->

   <p>Don't have an Account?</p><!-- <a href="#registerModal" data-toggle="modal" data-dismiss="modal">Register</a> --><p><br><a onclick="showRegistration()" data-toggle="modal" data-dismiss="modal">Register Here</a>
       </p>
   <!--                            <div class="input-group mb-3">
                                                               <button type="button" class="btn btn-login-gmail"><i class="fab fa-google"></i> - Login With Gmail</button>
                                                               </p>
                                                           </div>-->
   
   

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="<?php echo base_url(); ?>web_assets/js/vendor/jquery-3.4.1.min.js"></script>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
                                // Set the options that I want for toastr
                                toastr.options = {
                                    "closeButton": true,
                                    "newestOnTop": true,
                                    "progressBar": true,
                                    "positionClass": "toast-top-full-width",
                                    "preventDuplicates": true,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "2000",
                                    "timeOut": "2000",
                                    "extendedTimeOut": "2000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
</script>
<script type="text/javascript">

    document.onkeydown = function (e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }

    $('#email').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#validateLogin').click();
            return false;
        }
    });

    $('#password').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#validateLogin').click();
            return false;
        }
    });
    $('#email_phone').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#logotpbtn').click();
            return false;
        }
    });


    function showRegistration()
    {
        $('#email').val("");
        $('#password').val("");
        $('#registerModal').modal('show');

    }
    // $('#btn_register').click(function(){

    function goForgot()
    {
        document.getElementById("showforgotform").style.display = "block";
        document.getElementById("showresetform").style.display = "none";
        $('#loginModal').modal('hide');
        $('#forgotModal').modal('show');

    }

    function goLoginOTP() {
        $('#showotpform').hide();
        $('#loginDiv').hide();
        $('#loginWithOTP').show();
    }
    function goBackRegister(){
        $('#otpModal').modal('hide');
        $('#registerModal').modal('show');
    }
    function goOTPForm(){
        $('#Mail_model').modal('hide');
        $('#otpModal').modal('show');
    }

    function showLoginForm() {
        $('.error').remove();
        // $('#login_show_errormsg').hide();
        // $('#otp_show_errormsg').hide();
        $('#email').val('');
        $('#password').val('');
        $('#email_phone').val('');

        $('#loginWithOTP').hide();
        $('#showotpform').hide();
        $('#loginDiv').show();
    }


    function validateloginForm()
    {
        $('.error').remove();
        var errr = 0;
        // $('#login_show_errormsg').hide();
        // $('#otp_show_errormsg').hide();
        var login_quantity = $('#login_quantity').val();
        var login_vendor_id = $('#login_vendor_id').val();
        var login_session_id = $('#login_session_id').val();
        var login_variant_id = $('#login_variant_id').val();
        var login_saleprice = $('#login_saleprice').val();


        if ($('#email').val() == '')
        {
            toastr.error("Enter Mobile or  Email Address");
            // $('#email').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Mobile or  Email Address</span>');
            $('#email').focus();
            return false;
        } else if ($('#password').val() == '')
        {
            toastr.error("Enter Password");
            // $('#passeye').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Password</span>');
            $('#password').focus();
            return false;
        } else if ($('#password').val().length < 6)
        {
            toastr.error("Password must be more than 5 digits");
            // $('#passeye').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Password must be more than 5 digits</span>');
            $('#password').focus();
            return false;
        } else
        {
            var email = $('#email').val();
            var password = $('#password').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/userLogin",
                method: "POST",
                data: {username: email, password: password},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    if (res[1] == 'success')
                    {
                        //alert(login_quantity);
                        if (login_quantity != '')
                        {
                            addtocartWithoutLogin(login_variant_id, login_vendor_id, login_saleprice, login_quantity, login_session_id, res[2]);

                            var loc = '<?php echo $_SERVER['REQUEST_URI']; ?>';

                            window.location.href = "";
                        } else
                        {
                            window.location.href = "";
                        }



                    } else
                    {
                        // $('#login_show_errormsg').show();
                        toastr.error("Invalid Login Details,Please try again");
                        // $('#login_show_errormsg').html('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Invalid Login Details,Please try again</span>');
                        // $('#show_errormsg').focus();
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


<!--loginmodal-end-->



<!--forgotmodal-start-->

<div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>

                <div class="row justify-content-end">

                    <div class="col-lg-12" id="showforgotform">

                        <h4>FORGOT PASSWORD</h4>

                        <p class="pb-3">Enter your registered Mobile or Email Address to reset/change your password.</p>
                        <!-- <div id="forgot_show_errormsg"></div> -->
                        <form class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            <div class="input-group mb-3">

                                <!-- <span class="input-group-text"><i class="fal fa-envelope-open"></i></span> -->

                                <input type="text" class="form-control" id="username" name="username" placeholder="Mobile or Email Address">

                            </div><br>

                            <div class="input-group mb-3">

                                <button type="button" id="forpassbtn" onclick="validateForgotPassword()" class="btn btn-pink btn-block">SUBMIT</button>

                            </div><br>
                         <div class="row" style="justify-content:center;display:flex;"><div class="col-lg-6"><p><a onclick="showLogin()" data-toggle="modal" data-dismiss="modal" style="text-decoration: underline;color:#2556B9">Login</a></p></div></div>
                        </form>

                    </div>

                    <div class="col-lg-12" id="showresetform">

                        <h4>RESET PASSWORD</h4>

                        <p class="pb-3">Enter OTP to reset your password.</p>

                        <form class="form-horizontal" id="resetpassform" enctype="multipart/form-data" autocomplete="off">

                            <input type="hidden" id="forgot_user_id" name="user_id">

                            <div class="input-group mb-3">

                                <!-- <span class="input-group-text"><i class="fas fa-password-open"></i></span> -->

                                <input type="text" class="form-control" id="fotp" name="otp" maxlength="4" placeholder="Enter OTP" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">

                            </div>

                            <div class="input-group mb-3 password-container">

                                <!-- <span class="input-group-text"><i class="fas fa-password-open"></i></span> -->

                                <input type="password" class="form-control" id="npassword" name="password" placeholder="New Password" style="margin-right: -17px;">
                                <i class="fal fa-eye-slash" id="regPassEye" style="position:relative;z-index:999;left: -14px;cursor: pointer" onclick="togglePassword(this)"></i>
                            </div>

                            <div class="input-group mb-3 password-container">

                                <!-- <span class="input-group-text"><i class="fas fa-password-open"></i></span> -->

                                <input type="password" class="form-control" id="ncpassword" name="cpassword" placeholder="Confirm Password" style="margin-right: -17px;">
                                <i class="fal fa-eye-slash" id="regPassEyeone" style="position:relative;z-index:999;left: -14px;cursor: pointer" onclick="togglePassword(this)"></i>
                            </div><br>


                            <div class="input-group mb-3">

                                <button type="button" id="resetpassbtn" onclick="validateResetPassword()" class="btn btn-pink btn-block">SUBMIT</button>

                            </div><br>
                            <p><a onclick="showLogin()" data-toggle="modal" data-dismiss="modal">Login</a></p>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    function validateForgotPassword()
    {
        $('.error').remove();
        var errr = 0;

        if ($('#username').val() == '')
        {
            toastr.error("Enter Mobile or  Email Address");
            // $('#username').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Mobile or  Email Address</span>');
            $('#username').focus();
            return false;
        } else
        {
            $('#forpassbtn').prop('disabled', true);
            var username = $('#username').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/forgotPassword",
                method: "POST",
                data: {username: username},
                success: function (data)
                {
                    $('#forpassbtn').prop('disabled', false);
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        document.getElementById("resetpassform").reset();
                        document.getElementById("forgot_user_id").value = res[2];
                        document.getElementById("showforgotform").style.display = "none";
                        document.getElementById("showresetform").style.display = "block";
                        /*$('#forgotModal').modal('show');
                         $('#loginModal').modal('hide');*/
                    } else
                    {
                        toastr.error("Invalid Email or Phone Number");
                        // $('#forgot_show_errormsg').html('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Invalid Email or Phone Number</span>');
                        // $('#forgot_show_errormsg').focus();
                        return false;
                    }



                }
            });
        }


    }

    function validateLoginOTP()
    {
        $('.error').remove();
        var errr = 0;

        if ($('#email_phone').val() == '')
        {
            toastr.error("Enter registered mobile or email");
            // $('#email_phone').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter registered mobile or email</span>');
            $('#email_phone').focus();
            return false;
        } else
        {
            $('#logotpbtn').prop('disabled', true);
            var username = $('#email_phone').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/send_login_otp",
                method: "POST",
                data: {username: username},
                success: function (data)
                {
                    $('#logotpbtn').prop('disabled', false);
                    var str = data;
                    var res = str.split("#");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        // console.log(res[3]);
                        document.getElementById("user_mobile").value = res[2];
                    
                        // var otpCharacters = res[3].split('');


// var otpInputBoxes = document.getElementsByClassName("otp-input");


// for (var i = 0; i < otpCharacters.length; i++) {
//     otpInputBoxes[i].value = otpCharacters[i];
// }
// verifyOtp();
                        $('#loginDiv').hide();
                        $('#loginWithOTP').hide();
                        $('#showotpform').show();
                        toastr.success("OTP Sent successfully. Check your mobile/email!");

                    } else
                    {
                        // $('#otp_show_errormsg').show();
                        toastr.error("Please register you are not registered yet");
                        // $('#otp_show_errormsg').html('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Invalid Mobile/Email</span>');
                        // $('#otp_show_errormsg').focus();
                        // toastr.error("Something Wents Wrong");
                        return false;
                    }



                }
            });
        }


    }

    function validateResetPassword()
    {
        $('.error').remove();
        var errr = 0;

        if ($('#fotp').val() == '')
        {
            toastr.error("Enter OTP");
            // $('#fotp').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter OTP</span>');
            $('#fotp').focus();
            return false;
        } else if ($('#npassword').val() == '')
        {
            toastr.error("Enter New Password");
            // $('#regPassEye').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter New Password</span>');
            $('#npassword').focus();
            return false;
        } else if ($('#ncpassword').val() == '')
        {
            toastr.error("Enter Confirm Password");
            // $('#regPassEyeone').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Confirm Password</span>');
            $('#ncpassword').focus();
            return false;
        } else if ($('#npassword').val() != $('#ncpassword').val())
        {
            toastr.error("Password Mismatched");
            // $('#regPassEyeone').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Password Mismatched</span>');
            $('#ncpassword').focus();
            return false;
        } else
        {
            var otp = $('#fotp').val();
            var user_id = $('#forgot_user_id').val();
            var npassword = $('#npassword').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/resetPassword",
                method: "POST",
                data: {otp: otp, user_id: user_id, password: npassword},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        window.location.href = "<?php echo base_url(); ?>web";
                    } else
                    {
                        toastr.error("Invalid OTP");
                        // $('#fotp').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Invalid OTP</span>');
                        $('#fotp').focus();
                        return false;


                    }

                }
            });
        }


    }

    // // function loginbyotp()
    // // {
    // //     $('.error').remove();
    // //     var errr = 0;

    // //     if ($('.login_otp').val() == '')
    // //     {
    // //         $('.login_otp').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter OTP</span>');
    // //         $('.login_otp').focus();
    // //         return false;
    // //     } else
    // //     {
    // //         var otp = $('.login_otp').val();
    // //         var user_mobile = $('#user_mobile').val();

    // //         $.ajax({
    // //             url: "<?php echo base_url(); ?>web/verify_login_otp",
    // //             method: "POST",
    // //             data: {otp: otp, user_mobile: user_mobile},
    // //             success: function (data)
    // //             {
    // //                 var str = data;
    // //                 var res = str.split("@");
    // //                 //alert(JSON.stringify(res));
    // //                 if (res[1] == 'success')
    // //                 {
    // //                     window.location.href = "<?php echo base_url(); ?>";
    // //                 } else
    // //                 {
    // //                     $('.login_otp').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Invalid OTP</span>');
    // //                     $('.login_otp').focus();
    // //                     return false;


    // //                 }

    // //             }
    // //         });
    // //     }


    // }

    function resendLoginOTP() {
        var username = $('#user_mobile').val();

        $.ajax({
            url: "<?php echo base_url(); ?>web/send_login_otp",
            method: "POST",
            data: {username: username},
            success: function (data)
            {
                var str = data;
                var res = str.split("#");
                // alert(JSON.stringify(res));
                if (res[1] == 'success')
                {
                    document.getElementById("user_mobile").value = res[2];
                    $('#loginDiv').hide();
                    $('#loginWithOTP').hide();
                    $('#showotpform').show();
                    toastr.success("OTP resend successfully. Check your mobile/email!");
                    $('#otpMsg').html('OTP resend successfully. Check your mobile/email!');
                } else
                {
                    toastr.error("Please register you are not registered yet");
                    // $('#otp_show_errormsg').html('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Invalid Mobile/Email</span>');
                    // $('#otp_show_errormsg').focus();
                    return false;
                }



            }
        });
    }
</script>

<!--forgotmodal-end-->



<!--registermodal-start-->

<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>

                <div class="row justify-content-end">

                    <div class="col-lg-12">

                        <h4 style="font-style:bold;">REGISTER</h4>
                        <form class="form-horizontal" enctype="multipart/form-data" autocomplete="off">

                            <div class="input-group mb-3">

                                

                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z.\s]/g, '').replace(/(\..*)\./g,'$1');"  minlength="3" maxlength="20" id="first_name" name="first_name" placeholder="First Name">

                            </div>

                            <div class="input-group mb-3">

                               
                                <!-- onlyCharacter -->
                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z.\s]/g, '').replace(/(\..*)\./g,'$1');" minlength="3" maxlength="20" id="last_name" name="last_name" placeholder="Last Name">

                            </div>

                            <div class="input-group mb-3">

                                

                                <input type="text" class="form-control phone" id="mobile" name="mobile" placeholder="Mobile No." maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">

                            </div>

                            <div class="input-group mb-3">


                                <input type="text" class="form-control" id="reg_email" name="email" placeholder="Email ID">

                            </div>

                            <div class="input-group mb-3 password-container">

                              

                                <input type="password" class="form-control" id="newpassword" name="password" placeholder="Password" style="margin-right: -17px;">
                                <i class="fal fa-eye-slash" id="pass1" style="position:relative;z-index:999;left: -14px;text-align:center;align-items:center;cursor: pointer" onclick="togglePassword(this)"></i>
                            </div>

                            <div class="input-group mb-3 password-container">

                               

                                <input type="password" class="form-control"  id="regcpassword" name="cpassword" placeholder="Confirm Password" style="margin-right: -17px;">
                                <i class="fal fa-eye-slash" id="pass2" style="position:relative;z-index:999;left: -14px;text-align:center;align-items:center;cursor: pointer" onclick="togglePassword(this)"></i>
                            </div><br>

                            <div class="input-group mb-3 Regcontinue-btn">

                                <!-- <button type="submit" id="btn_register" class="btn btn-pink btn-block" data-toggle="modal" data-target="#otpModal" data-dismiss="modal">SIGNUP</button> -->

                                <button type="button" id="regBtn"  onclick="validateForm()" class="btn btn-pink btn-block">Continue</button>

                                

                            </div><hr>
                            <p>Already have an Account?</p><br><p><a onclick="showLogin()" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">
    // $('#btn_register').click(function(){

    function showLogin()
    {
        $('#first_name').val("");
        $('#last_name').val("");
        $('#mobile').val("");
        $('#reg_email').val("");
        $('#newpassword').val("");
        $('#loginModal').modal('show');
        $('#loginWithOTP').hide();
        $('#showotpform').hide();
        $('#loginDiv').show();
    }

    $('#first_name').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#regBtn').click();
            return false;
        }
    });
    $('#last_name').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#regBtn').click();
            return false;
        }
    });
    $('#mobile').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#regBtn').click();
            return false;
        }
    });
    $('#reg_email').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#regBtn').click();
            return false;
        }
    });
    $('#newpassword').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#regBtn').click();
            return false;
        }
    });
    $('#regcpassword').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#regBtn').click();
            return false;
        }
    });
    $('#username').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#forpassbtn').click();
            return false;
        }
    });

    $('#fotp').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#resetpassbtn').click();
            return false;
        }
    });
    $('#npassword').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#resetpassbtn').click();
            return false;
        }
    });
    $('#ncpassword').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#resetpassbtn').click();
            return false;
        }
    });

    function validateForm()
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile').val();
        var pass = $('#newpassword').val();
        if ($('#first_name').val() == '')
        {
            toastr.error("Enter First Name");
            // $('#first_name').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter First Name</span>');
            $('#first_name').focus();
            return false;
        } else if ($('#last_name').val() == '')
        {
            toastr.error("Enter Last Name");
            // $('#last_name').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Last Name</span>');
            $('#last_name').focus();
            return false;
        } else if ($('#mobile').val() == '')
        {
            toastr.error("Enter Mobile");
            // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Mobile</span>');
            $('#mobile').focus();
            return false;
        } else if (ph.length != 10)
        {
            toastr.error("Enter Valid 10 digit Phone Number");
            // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Valid 10 digit Phone Number</span>');
            $('#mobile').focus();
            return false;
        } else if ($('#reg_email').val() == '')
        {
            toastr.error("Enter Email");
            // $('#reg_email').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Email</span>');
            $('#reg_email').focus();
            return false;
        } else if (!validateEmail($('#reg_email').val()))
        {
            toastr.error("Invalid Email Address");
            // $('#reg_email').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Invalid Email Address</span>');
            $('#reg_email').focus();
            return false;
        } else if ($('#newpassword').val() == '')
        {
            toastr.error("Enter Password");
            // $('#pass1').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Password</span>');
            $('#newpassword').focus();
            return false;
        } else if (pass.length < 6)
        {
            toastr.error("Password must be more than 5 digits");
            // $('#pass1').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Password must be more than 5 digits</span>');
            $('#newpassword').focus();
            return false;
        } else if ($('#regcpassword').val() == '')
        {
            toastr.error("Enter Confirm Password");
            // $('#pass2').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Enter Confirm Password</span>');
            $('#regcpassword').focus();
            return false;
        } else if ($('#newpassword').val() != $('#regcpassword').val())
        {
            toastr.error("Password Mismatched");
            // $('#pass2').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Password Mismatched</span>');
            $('#regcpassword').focus();
            return false;
        } else
        {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var mobile = $('#mobile').val();
            var email = $('#reg_email').val();
            var password = $('#newpassword').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/userRegister",
                method: "POST",
                data: {first_name: first_name, last_name: last_name, mobile: mobile, email: email, password: password},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                  

                    // res[2].forEach(function(element) {
                    //         console.log(element);
                    // });
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        // console.log((res[2]));
                        $('#otp_mob').val(res[2]);
                        $('#otp_mail').val(res[3]);
                        // console.log((res[4]));
                        // $('#first_name').val("");
                        // $('#last_name').val("");
                        // $('#mobile').val("");
                        // $('#reg_email').val("");
                        // $('#newpassword').val("");
                        document.getElementById("otp_phone").value = res[2];
                        $('#phone_data').html(mobile);
                        $('#email_data').html(email);
                        $('#otpModal').modal('show');
                        $('#registerModal').modal('hide');
                       
                    } else if (res[1] == 'both')
                    {
                        toastr.error("Email already Exist");
                        // $('#reg_email').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Email already Exist</span>');
                        $('#reg_email').focus();
                        toastr.error("Phone Number Already Exist");
                        // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Phone Number Already Exist</span>');
                        $('#mobile').focus();
                        return false;
                    } else if (res[1] == 'invalid_email')
                    {
                        toastr.error("Email Already Exist");
                        // $('#reg_email').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Email Already Exist</span>');
                        $('#reg_email').focus();
                        return false;
                    } else if (res[1] == 'invalid_phone')
                    {
                        toastr.error("Phone Number Already Exist");
                        // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Phone Number Already Exist</span>');
                        $('#mobile').focus();
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


<!--registermodal-end-->

<!--otpmodal-start-->

<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!-- <div class="modal" id="otpModal"> -->
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>

                <div class="row justify-content-end">

                    <div class="col-lg-12">

                        <h4>OTP VERIFICATION</h4>
                        <?php 
                        $user_data = $this->session->userdata('user');
                        // print_r($user_data);?>
                        <!-- <div id="resend_success_msg"></div><br> -->
                        <p class="pb-3">OTP sent to <span>+91 </span><span id="phone_data"></span> & <span id="email_data"></span></p>
                        <form class="form-horizontal" enctype="multipart/form-data" autocomplete="off">

                            <input type="hidden" name="user_id" id="otp_phone">
                            
                            <!-- <input type="hidden" name="user_data" id="user_data" value="<?php 
                            // print_r($user_data);?>"> -->
                            <input type="hidden" name="otp_mob" id="otp_mob">
                            <input type="hidden" name="otp_mail" id="otp_mail">

                            <div class="input-group mb-3">
                                <input type="text" id="verify_otp" name="otp" class="form-control" placeholder="Mobile OTP" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" id="email_otp" name="email_otp" class="form-control" placeholder="Email OTP" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>


                            <!-- <div class="row input-group mb-3">
                                  <input type="hidden" name="user_id" id="otp_phone">
                                <div class="col-12">
                                  <input type="number" id="verify_otp" name="otp" class="form-control" placeholder="OTP" maxlength="4">
                                </div>

                                <div class="col-3"><input type="text" class="form-control" placeholder="0"></div>

                                <div class="col-3"><input type="text" class="form-control" placeholder="0"></div>

                                <div class="col-3"><input type="text" class="form-control" placeholder="0"></div>

                            </div> -->
                            <br>
                            <div class="input-group mb-3">

                                <button type="button" onclick="ValidateOTP()" class="btn btn-pink btn-block">VERIFY</button>

                               

                            </div>
                          <p>Didn't Receive Code </p><br> <div style="display:flex;"> <p><a onclick="resendOTP()">Resend</a></p>
                          <!-- <p><a  onclick="showMailModel()">update mail and phone number</a></p> -->
                          <p style="margin-bottom:15px;"><a onclick="goBackRegister()">go back</a></p></div>
                           

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="modal fade" id="Mail_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!-- <div class="modal" id="otpModal"> -->
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>

                <div class="row justify-content-end">

                    <div class="col-lg-12">

                        <h4>change Mail and phone number</h4><br>
                        <?php 
                        // $user_data = $this->session->userdata('user');
                        // print_r($user_data);?>
                        <!-- <div id="resend_success_msg"></div><br> -->
                        
                        <form class="form-horizontal" enctype="multipart/form-data" autocomplete="off">

                           
                       <?php 
                    //    $user_data = $this->session->userdata('user');
                        // print_r($user_data);?>
                            <!-- <input type="hidden" name="user_data" id="user_data" value="<?php 
                            // print_r($user_data);?>"> -->
                           <input type="hidden" name="user_first" id="user_first">
                           <input type="hidden" name="user_last" id="user_last">
                           <input type="hidden" name="pass" id="pass">


                            <div class="input-group mb-3">
                                <input type="text" id="mail_id" name="mail_id" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" id="phone_number" name="phone_number" class="form-control">
                            </div>


                            
                            <br>
                            <div class="input-group mb-3">

                                <button type="button" onclick="changeMailPhone()" class="btn btn-pink btn-block">Change</button>

                               

                            </div>
                            <p style="align-self: center;"><a onclick="goOTPForm()">Back</a></p>
                           

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="productQAModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header position-relative">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times-circle"></i></button>
                <h4>Question and Answers</h4>
                <p>Pick  the hair related issues that you are currently facing </p>
                <a href="#" data-dismiss="modal" class="btn-skip"><i class="fal fa-undo"></i> SKIP</a>
            </div>
            <div class="modal-body">

                <div class="row justify-content-end">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-5 align-self-center d-lg-block d-none">
                                <img src="<?php echo base_url(); ?>web_assets/img/qaside.png" class="img-fluid1"/>
                            </div>
                            <div class="col-lg-7">
                                <div class="row qaoptions">
                                    <div class="col-md-12">
                                        <label class="custradiobtn">Thin hair
                                            <input type="checkbox" name="hair" checked value="thin-hair">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="custradiobtn">Dandruff
                                            <input type="checkbox" name="dandruff" value="dandruff">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="custradiobtn">Hair fall
                                            <input type="checkbox" name="hairfall" value="hairfall ">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="custradiobtn">Others
                                            <input type="checkbox" name="others" value="others" class="othbtn">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-12 msgothers">
                                        <input type="text" class="form-control" placeholder="Message"/>
                                    </div>
                                    <div class="col-md-12" style="background-color:#081f66;">
                                        <button type="submit" class="btn btn-outline-light mt-2 btn-lg float-right">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    //  $(document).mouseup(function (e) {
    //     var container = $("#otpModal");
    //     if (!container.is(e.target) && container.has(e.target).length === 0) {
    //         container.hide();
    //     }
    // });

    function resendOTP()
    {
        $('.error').remove();
        var errr = 0;
        var user_id = $('#otp_phone').val();
        $.ajax({
            url: "<?php echo base_url(); ?>web/resendOTP",
            method: "POST",
            data: {user_id: user_id},
            success: function (data)
            {
                var str = data;
                var res = str.split("@");
                if (res[1] == 'success')
                {
                    // $('#resend_success_msg').after('<span class="error" style="color:red;font-size: 15px;margin-left: 70px; width:100%">OTP sent to your Mobile Number</span>');
                    toastr.success("OTP sent to your Mobile Number");
                    // $('#resend_success_msg').focus();
                    return false;
                } else
                {
                    toastr.error("Something went wrong , Please try again");
                    // $('#resend_success_msg').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">Something went wrong , Please try again</span>');
                    // $('#resend_success_msg').focus();
                    return false;
                }


            }
        });
    }
    function ValidateOTP()
    {
        $('.error').remove();
        var errr = 0;
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var mobile = $('#mobile').val();
        var email = $('#reg_email').val();
        var password = $('#newpassword').val();
        // var userdata=<?php 
        // print_r(json_encode($this->session->userdata('user')));?>;
        var otp_mob=$('#otp_mob').val();
        var otp_mail=$('#otp_mail').val();
        // console.log(otp_mob);
        // console.log(otp_mail);

        // var userdata = $('#user_data').val();
        // console.log(userdata);
        if ($('#verify_otp').val() == '')
        {
            toastr.error("Enter mobile verification OTP");
            // $('#verify_otp').after('<span class="error" style="color:red;font-size: 15px; width:100%">Enter mobile verification OTP</span>');
            $('#verify_otp').focus();
            return false;
        } else if ($('#email_otp').val() == '')
        {
            toastr.error("Enter email verification OTP");
            // $('#email_otp').after('<span class="error" style="color:red;font-size: 15px; width:100%">Enter email verification OTP</span>');
            $('#email_otp').focus();
            return false;
        } else
        {
            var otp = $('#verify_otp').val();
            var email_otp = $('#email_otp').val();
            var user_id = $('#otp_phone').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/OTPVerification",
                method: "POST",
                data: {otp: otp, user_id: user_id, email_otp: email_otp,
                    first_name: first_name,last_name:last_name,mobile:mobile,email:email,password:password,
                    otp_mob:otp_mob,otp_mail:otp_mail},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    if (res[1] == 'success')
                    {
                        window.location.href = "<?php echo base_url(); ?>web";
                    } else if (res[1] == 'email_otp_err')
                    {
                        toastr.error("Invalid email OTP");
                        // $('#email_otp').after('<span class="error" style="color:red;font-size: 15px;width:100%">Invalid email OTP</span>');
                        $('#email_otp').focus();
                        return false;
                    } else if (res[1] == 'mobile_otp_err')
                    {
                        toastr.error("Invalid mobile OTP");
                        // $('#verify_otp').after('<span class="error" style="color:red;font-size: 15px; width:100%">Invalid mobile OTP</span>');
                        $('#verify_otp').focus();
                        return false;
                    }


                }
            });
        }


    }

</script>
<!-- watiwidget script start -->

<script>
                var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?47195';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url;
                var options = {
                "enabled":true,
                "chatButtonSetting":{
                    "backgroundColor":"#00e785",
                    "ctaText":"Chat with us",
                    "borderRadius":"25",
                    "marginLeft": "0",
                    "marginRight": "20",
                    "marginBottom": "20",
                    "ctaIconWATI":false,
                    "position":"right"
                },
                "brandSetting":{
                    "brandName":"Wati",
                    "brandSubTitle":"undefined",
                    "brandImg":"https://www.wati.io/wp-content/uploads/2023/04/Wati-logo.svg",
                    "welcomeText":"Hi there!\nHow can I help you?",
                    "messageText":"Hello, %0A I have a question about {{page_link}}{{page_link}}{{page_title}}",
                    "backgroundColor":"#00e785",
                    "ctaText":"Chat with us",
                    "borderRadius":"25",
                    "autoShow":false,
                    "phoneNumber":"918792229974"
                }
                };
                s.onload = function() {
                    CreateWhatsappChatWidget(options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            </script>
<!-- watiwidget script end -->

<!--otpmodal-end-->

<!--bidmodal-start-->





<script type="text/javascript">



    function addtocart(variant_id, vendor_id, saleprice, quantity)
    {
        var session_vendor_id = $("#vendor_id").val();
        var session_id = '<?= $session_id ?>';
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        //alert(user_id);
        if (user_id == '')
        {
            $("#login_quantity").val(quantity);
            $("#login_vendor_id").val(vendor_id);
            $("#login_session_id").val(session_id);
            $("#login_variant_id").val(variant_id);
            $("#login_saleprice").val(saleprice);
            //$('#loginModal').modal('show');
            showLogin();
            return false;
        } else
        {
            //alert(variant_id); alert(vendor_id); alert(saleprice); alert(quantity); alert(session_vendor_id);

            $('.error').remove();
            var errr = 0;
            $.ajax({
                url: "<?php echo base_url(); ?>web/addtocart",
                method: "POST",
                data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: session_id},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    if (res[1] == 'success')
                    {
                        $("#vendor_id").val(vendor_id);
                        $("#session_id").val(res[3]);
                        $('#cart_count').html(res[2]);
                        toastr.success("Product added to cart!");
                        $(".not_in_cart_" + variant_id).remove();
                        $(".in_cart_" + variant_id).show();
                        window.location.href = "<?php echo base_url(); ?>web/checkout";
                    } else if (res[1] == 'shopclosed')
                    {
                        toastr.error("Shop Closed!")
                    } else if (res[1] == 'success_quantity')
                    {
                        toastr.success("Quantity increased successfully!")
                    } else
                    {
                        toastr.error("OUT OF STOCK!")
                    }
                }
            });
        }
    }



    function addtocartWithoutLogin(variant_id, vendor_id, saleprice, quantity, session_id, user_id)
    {
        $('.error').remove();
        var errr = 0;
        $.ajax({
            url: "<?php echo base_url(); ?>web/addtocartWithoutLogin",
            method: "POST",
            data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: session_id, user_id: user_id},
            success: function (data)
            {
                var str = data;
                var res = str.split("@");
                if (res[1] == 'success')
                {
                    $("#vendor_id").val(vendor_id);
                    $("#session_id").val(res[3]);
                    $('#cart_count').html(res[2]);
                    toastr.success("Product added to cart!")
                } else if (res[1] == 'shopclosed')
                {

                    toastr.error("Shop Closed!")
                } else
                {
                    toastr.error("OUT OF STOCK!")
                }
            }
        });
    }
</script>



<!--bidmodal-end-->

<!-- JS

============================================ -->

<!--sweetalert-->

<script>
    //Check to see if the window is top if not then display button
    // $(document).ready(function(){
    //     $(window).scroll(function(){
    //     if ($(this).scrollTop() > 200) {
    //         $('.gototop').css('display','block');
    //     } else {
    //         $('.gototop').css('display','none');
    //     }
    // });

    // $('.gototop').click(function(){
    //     $('html, body').animate({scrollTop : 0},800);
    //     return false;
    // });
    // })

    $(function () {

        //Scroll event
        $(window).scroll(function () {
            var scrolled = $(window).scrollTop();
            if (scrolled > 300)
                $('.gototop').fadeIn('slow');
            if (scrolled < 300)
                $('.gototop').fadeOut('slow');
        });

        //Click event
        $('.gototop').click(function () {
            $("html, body").animate({scrollTop: "0"}, 500);
        });

    });

</script>
<script src="<?php echo base_url(); ?>web_assets/js/sweetalert.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>web_assets/css/sweetalert.css" />
<!--close sweetalert-->

<!--popper min js-->

<script src="<?php echo base_url(); ?>web_assets/js/popper.js"></script>

<!--bootstrap min js-->

<script src="<?php echo base_url(); ?>web_assets/js/bootstrap.min.js"></script>

<!--owl carousel min js-->

<script src="<?php echo base_url(); ?>web_assets/js/owl.carousel.min.js"></script>

<!--slick min js-->

<script src="<?php echo base_url(); ?>web_assets/js/slick.min.js"></script>

<!--magnific popup min js-->

<script src="<?php echo base_url(); ?>web_assets/js/jquery.magnific-popup.min.js"></script>

<!--jquery countdown min js-->

<script src="<?php echo base_url(); ?>web_assets/js/jquery.countdown.js"></script>

<!--jquery ui min js-->

<script src="<?php echo base_url(); ?>web_assets/js/jquery.ui.js"></script>

<!--jquery elevatezoom min js-->

<script src="<?php echo base_url(); ?>web_assets/js/jquery.elevatezoom.js"></script>

<!--isotope packaged min js-->

<script src="<?php echo base_url(); ?>web_assets/js/isotope.pkgd.min.js"></script>

<!-- Plugins JS -->

<script src="<?php echo base_url(); ?>web_assets/js/plugins.js"></script>

<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<!-- Main JS -->

<script src="<?php echo base_url(); ?>web_assets/js/main.js"></script>

<script src="<?php echo base_url(); ?>web_assets/js/sidebar.js"></script>
<!--<script src="<?php echo base_url(); ?>web_assets/js/tablesaw.js"></script>-->

<script type="text/javascript">
    $(this).children().attr('title');
    $(this).children().prop('title');
    $(this).children(".preview").attr('title');
    $(this).find(".preview").attr('title');
    $(this).find("a").attr('title');

//elevate zoom disable
  // $('.zoomContainer').remove();
  // $('#zoom1').removeAttr('data-zoom-image');
</script>

</body>

</html>

<script>

    function togglePassword(e) {
        var pass = $(e).prev('input').attr('id');
        if ($('#' + pass).attr('type') === 'password') {
            $('#' + pass).attr('type', 'text');
             $(e).removeClass('fa-eye-slash');
            $(e).addClass('fa-eye');
        } else {
            $('#' + pass).attr('type', 'password');
            $(e).removeClass('fa-eye');
            $(e).addClass('fa-eye-slash');
        }
    }

    function addremoveFavorite(vid)
    {
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        if (user_id == '')
        {
            //$('#loginModal').modal('show');
            showLogin();
            return false;
        } else
        {
            $.ajax({
                url: "<?php echo base_url(); ?>web/add_remove_topdeal_whishList",
                method: "POST",
                data: {vid: vid},
                success: function (data)
                {

                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    //location.reload();
                    // $("#topdeals").load(location.href + " #topdeals");

                    // $('html, body').animate({
                    //           scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                    //       }, 'slow');

                    if (res[1] == 'remove')
                    {

                        /* $("#topdeals").load(location.href + " #topdeals");
                         $('#top_fav_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Removed from the Favourites</span>');
                         $('#top_fav_msg').focus();
                         location.reload();
                         return false;*/
                        $("#favoritecls_" + vid).removeClass("fas");
                        $("#favoritecls_" + vid).addClass("fal");
                        $(".favoritecls_" + vid).removeClass("fas");
                        $(".favoritecls_" + vid).addClass("fal");
                        toastr.info('Removed from wishlist.');
//                        setTimeout(function () {
//                            location.href = '<?php echo base_url(); ?>my-wishlist';
//                        }, 2000);

                    } else if (res[1] == 'add')
                    {
                        $("#favoritecls_" + vid).removeClass("fal");
                        $("#favoritecls_" + vid).addClass("fas");
                        $(".favoritecls_" + vid).removeClass("fal");
                        $(".favoritecls_" + vid).addClass("fas");
                        $(".favoritecls_" + vid).addClass("fas");
                        $(".favoritecls_" + vid).css("color", "#2556B9");
                        toastr.info('Added to wishlist.');
//                        setTimeout(function () {
//                            location.href = '<?php echo base_url(); ?>my-wishlist';
//                        }, 2000);
                        /*$('#top_fav_msg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Added to Favourites</span>');
                         $('#top_fav_msg').focus();
                         
                         location.reload();
                         return false;*/
                    }



                }
            });
        }
    }
</script>
<script>
    $(".phone").keypress(function (event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
    $('.login_otp').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#login_by_otp').click();
            return false;
        }
    });
    $(".onlyCharacter").keypress(function (e) {
        //var key = e.keyCode;
        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
        if (!valid) {
            e.preventDefault();
        }
    });
</script>
<script>
    function chkform1(key) {
       
        var already_checked = 0;
        $('.options1_' + key).each(function () {
            if ($(this).prop("checked") == true) {
                $('.other1').prop('checked', false);
                already_checked += 1;
            }
        });

        if ($('#other1_' + key).prop("checked") == true) {
            already_checked += 1;
        }

        if (already_checked > 0) {
            return true;
        } else {
            toastr.error('Select atleast one option from the list to proceed');
            return false;
        }
        $('#questionary-form1').trigger("reset");
    }

    function msgbox1(ele, key) {
        if ($(ele).prop("checked") == true) {
            $('.options1_' + key).prop('checked', false);
            $('#other1_' + key).prop('checked', true);
            $('#message1-' + key).show();
            $('#message1-input-' + key).prop('required', true);
        } else {
            $('.options1_' + key).prop('checked', false);
            $('#other1_' + key).prop('checked', false);
            $('#message1-' + key).hide();
            $('#message1-input-' + key).prop('required', false);
        }
    }

    function chkbox1(ele, key) {
        if ($(ele).prop("checked") == true) {
            $('.other1').prop('checked', false);
            $('#message1-' + key).hide();
            $('#message1-input-' + key).val('');
            $('#message1-input-' + key).prop('required', false);
        }
    }
</script>
<!--<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>-->
<script>
    $(document).ready(function () {
        var isMobile = false;
        // device detection
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
                || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
            isMobile = true;
        }

        if (isMobile == false) {
            $.ajax({
                url: "<?php echo base_url(); ?>web/chatwithus",
                method: "POST",
                success: function (data)
                {

                }
            });
        }
    });

    function toggleNav(cat_id) {
        $('#sub-' + cat_id).slideToggle();
    }

    function closeNav() {
        $('.offcanvas_menu_wrapper').removeClass('active');
    }

    (function ($) {
        $.fn.responsiveTabs = function () {
            this.addClass('responsive-tabs'),
                    this.append($('<span class="dropdown-arrow"></span>')),
                    this.on("click", "li > a.active, span.dropdown-arrow", function () {
                        this.toggleClass('open');
                    }.bind(this)), this.on("click", "li > a:not(.active)", function () {
                this.removeClass("open")
            }.bind(this));
        }
    })(jQuery);

</script>

<script>
    (function ($) {
        $('.nav-tabs').responsiveTabs();
    })(jQuery);

    function increaseQty(variant_id)
    {
        var quantity = $(".quantity_"+variant_id).val();
        var qty = 1;
        var final = parseInt(qty) + parseInt(quantity);
        $(".quantity_"+variant_id).val(final);
    }

                               function checkcart_limit(variant_id , single=''){
                                   if(single){
                                    var quantity = $("#quantity").val();
                                   } else {
                                     var quantity = $(".quantity_"+variant_id).val();
                                   }
                                //    quantity++;
                                           $.ajax({
                                                url: "<?php echo base_url(); ?>web/checklimit_cart",
                                                method: "POST",
                                                data: {variant_id: variant_id, quantity: quantity},
                                                success: function (data)  
                                                {
                                                 if(data == 'available'){
                                                     var qty = 1;
                                                     // var final = parseInt(qty) + parseInt(quantity);
                                                     var final = parseInt(quantity);
                                                     $(".quantity_"+variant_id).val(final);
                                                     quantity = final;
                                                     if(single){
                                                        $("#quantity").val(final);
                                                         } else {
                                                         $(".quantity_"+variant_id).val(final);
                                                          }     
                                                 
                                                 }   else{
                                                    toastr.error("You have exceeded the cart limit of "+ data +" for this product!");
                                                     // $(".quantity_"+variant_id).val(data);
                                                 }

                                                }
                                            });
                                         }

    function decreaseQty(variant_id)
    {
        var quantity = $(".quantity_"+variant_id).val();
        if (quantity == 1)
        {
            return false;
        } else
        {
            var qty = 1;
            var final = parseInt(quantity) - parseInt(qty);
            $(".quantity_"+variant_id).val(final);
        }
    }

    function showMailModel(){
        $('#Mail_model').modal('show');
        $('#otpModal').modal('hide');
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var mobile = $('#mobile').val();
        var email = $('#reg_email').val();
        var password = $('#newpassword').val();
        $('#mail_id').val(email);
        $('#phone_number').val(mobile);
        $('#user_first').val(first_name);
        $('#user_last').val(last_name);
        $('#pass').val(password);
    }

    function addtocartSingleProduct(variant_id, vendor_id, saleprice)
    {
        // $("#qty-"+variant_id).hide();
        var session_id = '<?= $session_id ?>';
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        var quantity = $(".quantity_"+variant_id).val();

        //alert(user_id);
        if (user_id == '')
        {
            $("#login_quantity").val(quantity);
            $("#login_vendor_id").val(vendor_id);
            $("#login_session_id").val(session_id);

            $("#login_variant_id").val(variant_id);
            $("#login_saleprice").val(saleprice);

            $('#loginModal').modal('show');
            return false;
        } else
        {
            //alert(variant_id); alert(vendor_id); alert(saleprice); alert(quantity); alert(session_vendor_id);

            $('.error').remove();
            var errr = 0;

            $.ajax({
                url: "<?php echo base_url(); ?>web/addtocart",
                method: "POST",
                data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: session_id},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    if (res[1] == 'success')
                    {
                        $("#vendor_id").val(vendor_id);
                        $("#session_id").val(res[3]);
                        $('#cart_count').html(res[2]);

                        toastr.success("Product added to cart!");
                        $(".not_in_cart_" + variant_id).remove();
                        $(".in_cart_" + variant_id).show();
                        $("#qty-"+variant_id).hide();
                    } else if (res[1] == 'shopclosed')
                    {

                        toastr.error("Shop Closed!");
                        $("#qty-"+variant_id).show();
                    } else if (res[1] == 'cart_limit')
                    {

                        toastr.error("You have exceeded the cart limit of "+res[2]+" for this product!");
                        $("#qty-"+variant_id).show();
                    } else
                    {
                        toastr.error("OUT OF STOCK!");
                        $("#qty-"+variant_id).show();
                    }
                }
            });

        }
    }

    $(function () {
        $(document).trigger("enhance.tablesaw")});
</script>

<script type="text/javascript">
$(document).ready(function() {
$('.popup-youtube').magnificPopup({
type: 'iframe'
});
});

    function moveToNext(input, nextInput) {
      const maxLength = input.getAttribute('maxlength');
      const currentValue = input.value;

      if (currentValue.length >= maxLength) {
        const next = document.querySelector(`.otp-input:nth-child(${nextInput})`);
        if (next) {
          next.focus();
        }
      }
    }

    function changeMailPhone() {
    $('.error').remove();
    var errr = 0;

    if ($('#phone_number').val() == '') {
        toastr.error("Enter Phone number");
        $('#phone_number').focus();
        return false;
    } else if ($('#phone_number').val().length != 10) {
        toastr.error("Enter Valid 10 digit Phone Number");
        $('#phone_number').focus();
        return false;
    } else if ($('#mail_id').val() == '') {
        toastr.error("Enter Email");
        $('#mail_id').focus();
        return false;
    } else if (!validateEmail($('#mail_id').val())) {
        toastr.error("Invalid Email Address");
        $('#mail_id').focus();
        return false;
    } else {
        var first_name = $('#user_first').val();
        var last_name = $('#user_last').val();
        var mobile = $('#phone_number').val();
        
      
        var email = $('#mail_id').val();
        $('#reg_email').val(email);
        $('#mobile').val(mobile);
        var password = $('#regcpassword').val();

        $.ajax({
            url: "<?php echo base_url(); ?>web/userRegister",
            method: "POST",
            data: {first_name: first_name, last_name: last_name, mobile: mobile, email: email, password: password},
            success: function(data) {
                var str = data;
                var res = str.split("@");

                if (res[1] == 'success') {
                    $('#otp_mob').val(res[2]);
                    $('#otp_mail').val(res[3]);
                    // $('#first_name').val("");
                    // $('#last_name').val("");
                    // $('#phone_number').val("");
                    // $('#mail_id').val("");
                    // $('#newpassword').val("");
                    document.getElementById("otp_phone").value = res[2];
                    $('#phone_data').html(mobile);
                    $('#email_data').html(email);
                    $('#otpModal').modal('show');
                    $('#Mail_model').modal('hide'); // Fix the syntax issue here
                } else if (res[1] == 'both' || res[1] == 'invalid_email' || res[1] == 'invalid_phone') {
                    toastr.error("Email or Phone Number already Exist");
                    $('#mail_id').focus();
                    return false;
                }
            }
        });
    }
}


    function verifyOtp() {
      $('.error').remove();
      var errr = 0;

      var otp = '';
      $('.otp-input').each(function () {
        otp += $(this).val();
      });

      if (otp == '') {
        // $('.otp-input').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter OTP</span>');
        toastr.error("Enter OTP");
        $('.otp-input:first').focus();
        return false;
      } else {
        var user_mobile = $('#user_mobile').val();

        $.ajax({
          url: "<?php echo base_url(); ?>web/verify_login_otp",
          method: "POST",
          data: {otp: otp, user_mobile: user_mobile},
          success: function (data) {
            var str = data;
            var res = str.split("@");
            //alert(JSON.stringify(res));
            if (res[1] == 'success') {
              window.location.href = "<?php echo base_url(); ?>";
            } else {
            //   $('.otp-input').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Invalid OTP</span>');
            toastr.error("Invalid OTP");
              $('.otp-input:first').focus();
              return false;
            }
          }
        });
      }
    }

//     function verifyOtp() {
//   $('#error-toast').empty(); // Clear previous error message
//   var errr = 0;

//   var otp = '';
//   $('.otp-input').each(function () {
//     otp += $(this).val();
//   });

//   if (otp == '') {
//     showErrorToast('Enter OTP');
//     $('.otp-input:first').focus();
//     return false;
//   } else {
//     var user_mobile = $('#user_mobile').val();

//     $.ajax({
//       url: "<?php echo base_url(); ?>web/verify_login_otp",
//       method: "POST",
//       data: {otp: otp, user_mobile: user_mobile},
//       success: function (data) {
//         var str = data;
//         var res = str.split("@");
//         if (res[1] == 'success') {
//           window.location.href = "<?php echo base_url(); ?>";
//         } else {
//           showErrorToast('Invalid OTP');
//           $('.otp-input:first').focus();
//           return false;
//         }
//       }
//     });
//   }
// }

// function showErrorToast(message) {
//   var toast = $('<div class="error-toast" style="color: red; font-size: 18px; text-align: center; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #fff; padding: 10px 20px; border: 1px solid red; border-radius: 5px;">' + message + '</div>');
//   $('#error-toast').html(toast);

//   // Hide the error toast after a specific time (e.g., 3 seconds)
//   setTimeout(function() {
//     toast.fadeOut(500, function() {
//       $(this).remove();
//     });
//   }, 3000);
// }

  </script>

<!-- <script type="text/javascript">
    var session_user_id = '<?= $_SESSION['userdata']['user_id'] ?>';
       if(session_user_id == '') {
        setInterval(function () {
            $.ajax({
                url: "<?= base_url('web/check_avl_userid') ?>",
                method: "POST",
                success: function (result)
                {
                    if (result > 0) {
                       location.href = '<?php echo base_url(); ?>web/logout';
                    }
                }
            });
        }, 3000);
}

</script>  -->   


<?php
//if ($this->session->userdata('chatscript')) {
// $chatbot = $this->common_model->get_data_row(['id' => 1, 'status' => 'active'], 'chatbot');
// if ($chatbot) {
    // echo $chatbot->script;
// }
//}
?>