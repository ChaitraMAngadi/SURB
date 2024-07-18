<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3>Contact Us</h3> -->
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--about section area -->
<section class="pt-0">


    <div id="contact_msg"></div>
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="row py-5 justify-content-between">

                    <div class="col-lg-5 col-md-6 order-0 condetails">

                        <div class="row">

                            <div class="col-3"><i class="fal fa-map-marker-alt"></i></div>

                            <div class="col-9">

                                <h4>Address</h4>
                                <p><?php echo $contactinfo->address; ?></p>

                            </div>

                        </div>

                        <div class="row ">

                            <div class="col-3"><i class="fal fa-phone"></i></div>

                            <div class="col-9">

                                <h4>Phone</h4>

                                <a href="tel:<?php echo $contactinfo->mobile; ?>"><p>+91 <?php echo $contactinfo->mobile; ?></p></a>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-3"><i class="fal fa-envelope-open"></i></div>

                            <div class="col-9">

                                <h4>Email</h4>

                                <a href="mailto:<?php echo $contactinfo->email; ?>" target="_blank"><p><?php echo $contactinfo->email; ?></p></a>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6  order-1">
                        <div id="show_message"></div>

                        <div class="contact_message form">

                            <h3>Get In Touch</h3>

                            <form class="form-horizontal" enctype="multipart/form-data"  >

                                <p>

                                    <input type="text" class="onlyCharacter" id="name_contact" placeholder="Name *">

                                </p>
                                <p>

<input type="text"  id="company_name_contact" placeholder="company Name *">

</p>
<p>

<input type="text" class="onlyCharacter" id="Designation" placeholder="Designation">

</p>

                                <p>

                                    <input type="email" id="email_contact" placeholder="Email *">

                                </p>

                                <p>

                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" id="mobile_contact" placeholder="Mobile *" >

                                </p>

                                    <div class="form-group mb-3">
                                        <select class="form-select" name="request_type" id="request_type"> 
                                            <option value="">Select Nature of Request *</option>
                                            <option value="Partner with us" selected>Partner with us</option>
                                            <option value="Work with us">Work with us</option>
                                            <option value="Know delivery status">Know delivery status</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                <div class="contact_textarea">

                                    <textarea placeholder="Message *" id="message" class="form-control2" maxlength="240"></textarea>

                                </div><br>

                                <button type="button"  onclick="validatecontactForm()"><i class="fal fa-paper-plane"></i> Send</button>


                                <p class="form-messege"></p><br>

                            </form>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>


    <!--  <div class="row">
    
        <div class="col-lg-12 col-md-12">
    
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243208.17099284945!2d83.12250476374943!3d17.738622503826665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a39431389e6973f%3A0x92d9c20395498468!2sVisakhapatnam%2C%20Andhra%20Pradesh!5e0!3m2!1sen!2sin!4v1611571676704!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    
        </div>
    
      </div>-->

</section>

<!--about section end-->


<script type="text/javascript">
    // $('#btn_register').click(function(){




    // function validatecontactForm()
    // {
    //     $('.error').remove();
    //     var errr = 0;
    //     var ph = $('#mobile_contact').val();

    //     if ($('#name_contact').val() == '' || $('#name_contact').val().trim() == "")
    //     {
    //         $('#name_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter First Name</span>');
    //         $('#name_contact').focus();
    //         return false;
    //     } else if ($('#email_contact').val() == '')
    //     {
    //         $('#email_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Email</span>');
    //         $('#email_contact').focus();
    //         return false;
    //     } else if (!validateEmail($('#email_contact').val()))
    //     {
    //         $('#email_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Invalid Email Address</span>');
    //         $('#email_contact').focus();
    //         return false;
    //     } else if ($('#mobile_contact').val() == '')
    //     {
    //         $('#mobile_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Mobile</span>');
    //         $('#mobile_contact').focus();
    //         return false;
    //     } else if (ph.length != 10)
    //     {
    //         $('#mobile_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Valid 10 digit Phone Number</span>');
    //         $('#mobile_contact').focus();
    //         return false;
    //     } else if ($('#request_type').val() == '')
    //     {
    //         $('#request_type').after('<span class="error" style="color:red;font-size: 17px; width:100%">Select Nature of Request</span>');
    //         $('#request_type').focus();
    //         return false;
    //     } else if ($('#message').val() == '' || $('#message').val().trim() == "")
    //     {
    //         $('#message').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Message</span>');
    //         $('#message').focus();
    //         return false;
    //     } 
    //     else if ($('#company_name_contact').val() == '' || $('#company_name_contact').val().trim() == "")
    //     {
    //         $('#company_name_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter company Name</span>');
    //         $('#company_name_contact').focus();
    //         return false;
    //     } 
    //     else if ($('#Designation').val() == '' || $('#Designation').val().trim() == "")
    //     {
    //         $('#Designation').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Designation</span>');
    //         $('#Designation').focus();
    //         return false;
    //     } 
    //     else
    //     {
    //         var name = $('#name_contact').val();
    //         var company_name=$('#company_name_contact').val();
    //         var Designation=$('#Designation').val();
    //         var email = $('#email_contact').val();
    //         var mobile = $('#mobile_contact').val();
    //         var message = $('#message').val();
    //         var request_type = $('#request_type').val();
            
    //         $.ajax({
    //             url: "<?php echo base_url(); ?>web/savecontactus",
    //             method: "POST",
    //             data: {name: name,company_name:company_name,Designation:Designation, mobile: mobile, email: email, message: message, request_type: request_type},
    //             success: function (data)
    //             {
    //                 var str = data;
    //                 var res = str.split("@");
    //                 //alert(JSON.stringify(res));
    //                 $('#name_contact').val('');
    //                 $('#email_contact').val('');
    //                 $('#mobile_contact').val('');
    //                 $('#message').val('');
    //                 $('#request_type').val('');
    //                 $('#company_name_contact').val('');
    //                 $('#Designation').val('');
    //                 if (res[1] == 'success')
    //                 {
    //                     $('html, body').animate({
    //                         scrollTop: $('#contact_msg').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
    //                     }, 'slow');

    //                     $('#show_message').after('<span class="error" style="color:green;font-size: 18px; width:100%">Message sent successfully</span>');
    //                     $('#show_message').focus();
    //                     return false;
    //                 } else
    //                 {
    //                     $('#show_message').after('<span class="error" style="color:red;font-size: 18px; width:100%">Something went wrong, Please try again</span>');
    //                     $('#show_message').focus();
    //                     return false;
    //                 }
    //             }
    //         });
    //     }


    // }

    function validatecontactForm() {
    $('.error').remove();
    var errr = 0;
    var ph = $('#mobile_contact').val();
    
    var sanitizeInput = function(input) {
        return input.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    };

    var name_contact = sanitizeInput($('#name_contact').val());
    var email_contact = sanitizeInput($('#email_contact').val());
    var mobile_contact = sanitizeInput($('#mobile_contact').val());
    var request_type = sanitizeInput($('#request_type').val());
    var message = sanitizeInput($('#message').val());
    var company_name_contact = sanitizeInput($('#company_name_contact').val());
    var designation = sanitizeInput($('#Designation').val());

    if (name_contact == '' || name_contact.trim() == "") {
        $('#name_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter First Name</span>');
        $('#name_contact').focus();
        return false;
    } else if (email_contact == '') {
        $('#email_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Email</span>');
        $('#email_contact').focus();
        return false;
    } else if (!validateEmail(email_contact)) {
        $('#email_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Invalid Email Address</span>');
        $('#email_contact').focus();
        return false;
    } else if (mobile_contact == '') {
        $('#mobile_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Mobile</span>');
        $('#mobile_contact').focus();
        return false;
    } else if (ph.length != 10) {
        $('#mobile_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Valid 10 digit Phone Number</span>');
        $('#mobile_contact').focus();
        return false;
    } else if (request_type == '') {
        $('#request_type').after('<span class="error" style="color:red;font-size: 17px; width:100%">Select Nature of Request</span>');
        $('#request_type').focus();
        return false;
    } else if (message == '' || message.trim() == "") {
        $('#message').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Message</span>');
        $('#message').focus();
        return false;
    } else if (company_name_contact == '' || company_name_contact.trim() == "") {
        $('#company_name_contact').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter company Name</span>');
        $('#company_name_contact').focus();
        return false;
    } else if (designation == '' || designation.trim() == "") {
        $('#Designation').after('<span class="error" style="color:red;font-size: 17px; width:100%">Enter Designation</span>');
        $('#Designation').focus();
        return false;
    } else {
        $.ajax({
            url: "<?php echo base_url(); ?>web/savecontactus",
            method: "POST",
            data: {
                name: name_contact,
                company_name: company_name_contact,
                Designation: designation,
                mobile: mobile_contact,
                email: email_contact,
                message: message,
                request_type: request_type
            },
            success: function (data) {
                var str = data;
                var res = str.split("@");
                $('#name_contact').val('');
                $('#email_contact').val('');
                $('#mobile_contact').val('');
                $('#message').val('');
                $('#request_type').val('');
                $('#company_name_contact').val('');
                $('#Designation').val('');
                if (res[1] == 'success') {
                    $('html, body').animate({
                        scrollTop: $('#contact_msg').offset().top - 100
                    }, 'slow');
                    $('#show_message').after('<span class="error" style="color:green;font-size: 18px; width:100%">Message sent successfully</span>');
                    $('#show_message').focus();
                    return false;
                } else {
                    $('#show_message').after('<span class="error" style="color:red;font-size: 18px; width:100%">Something went wrong, Please try again</span>');
                    $('#show_message').focus();
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