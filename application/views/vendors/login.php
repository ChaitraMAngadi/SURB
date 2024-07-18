<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Vendor | Login</title>

         <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>web_assets/img/favicon.png">

        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?= ADMIN_ASSETS_PATH ?>assets/css/style.css" rel="stylesheet">
        <style>
            body{
                background: url(<?= ADMIN_ASSETS_PATH ?>assets/images/authentication-bg.svg);
                background-size: contain;
                background-position: center;
                min-height: 100vh;
            }
            .customLogin{
                width: 400px;
                background: #e3e5ef;
                padding: 10px 20px;
                border-radius: 10px;
                margin-top: 20px;
            }
            .customLogo{
                margin-top:90px;
            }
            .customLogin h2{
                margin:0px;
            }
        </style>

    </head>

    <body class="gray-bg">
        <div class="customLogo">
            <img src="<?= ADMIN_ASSETS_PATH ?>assets/images/logo.png" style="width:290px;margin:auto;display:block"/>
        </div>
        <div class="middle-box text-center loginscreen animated fadeInDown customLogin" style="width:350px">
            <div>
                <h2>Vendor Login</h2>
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

                <form class="m-t" role="form" action="<?php echo base_url(); ?>vendors/login/admin_login" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="mobile"  name="email" placeholder="Mobile Number" onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" onclick="goValidation()">Login</button>

<!--                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>-->
                </form>
                
                <a href="<?php echo base_url(); ?>vendors/forgotpassword"><small>Forgot password?</small></a>
                
                <p class="m-t"> <small>Sector6 Version 1.0 &copy; 2020</small> </p>
                <p class="m-t"> <small>Powered By Colourmoon Technologies</small> </p>

            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
<script type="text/javascript">
    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

     function goValidation()
     {
        console.log("welcome");
        $('.error').remove();
            var errr=0;
            
    var ph = $('#mobile').val();
      if($('#mobile').val()=='')
      {
         $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Mobile Number</span>');
         $('#mobile').focus();
         return false;
      }
      else if(ph.length!=10)
      {
         $('#mobile').after('<span class="error" style="color:red">Enter Valid 10 digit Phone Number</span>');
         $('#mobile').focus();
         return false;
      }  
      else if($('#password').val()=='')
      {
         $('#password').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Password</span>');
         $('#password').focus();
         return false;
      }
     }
        

</script>