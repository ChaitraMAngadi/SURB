<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Payment</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<div class="shopping_cart_area pb-5">
    <div class="container">
        <div class="row justify-content-center" style="min-height:300px;">
            <div class="col-lg-10">
                <div class="row pb-5">
<!--                    <div class="col-lg-12 col-md-12">
                        <?php $this->load->view("web/steps_menu"); ?>
                    </div>-->
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">


                        <div class="form-check pb-2">
                            <input class="form-check-input" type="radio" checked name="inlineRadioOptions" id="inlineRadio2" value="ONLINE" onclick="selectPayment('ONLINE')">
                            <label class="form-check-label" for="inlineRadio2">ONLINE</label>
                        </div>
                        <div class="form-check pb-2">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="COD" onclick="selectPayment('COD')">
                            <label class="form-check-label" for="inlineRadio3">Cash on Delivery</label>
                        </div>

                        <form method="post" action="<?= base_url('web/cashfree_payment') ?>">
                            <input type="hidden" name="totalAmount" value="<?php echo $total_price; ?>" />
                            <input type="hidden" name="address_id" value="<?php echo $aid; ?>" />
                            <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>" />
                            <input type="hidden" name="coupon_code" value="<?php echo $coupon_code; ?>" />
                            <input type="hidden" name="coupon_discount" value="<?php echo $coupon_discount; ?>" />
                            <input type="hidden" name="gst" value="<?php echo $gst; ?>" />
                            <input type="hidden" name="shipping_charge" value="<?php echo $shipping_charge; ?>" />
                            <button type="submit" class="btn btn-pink btn-block" id="online">Pay Now</button>
                        </form>
                        <button type="submit" class="btn btn-pink btn-block" id="offline" style="display: none;" onclick="payoffline(<?php echo $total_price; ?>,<?php echo $aid; ?>,<?= $session_id ?>)">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>


                            function selectPayment(payment_type)
                            {
                                if (payment_type == 'ONLINE')
                                {
                                    document.getElementById("online").style.display = "block";
                                    document.getElementById("offline").style.display = "none";
                                } else if (payment_type == 'COD')
                                {
                                    document.getElementById("offline").style.display = "block";
                                    document.getElementById("online").style.display = "none";
                                }
                            }
                            var SITEURL = "<?php echo base_url() ?>";





                            function payoffline(price, aid, session_id)
                            {
                                $('#offline').prop('disabled', true);
                                var totalAmount = '<?php echo round($total_price); ?>';
                                var coupon_id = '<?php echo $coupon_id; ?>';
                                var coupon_code = '<?php echo $coupon_code; ?>';
                                var coupon_discount = '<?php echo $coupon_discount; ?>';
                                var gst = '<?php echo $gst; ?>';
                                var shipping_charge = '<?php echo $shipping_charge; ?>';
                                $.ajax({
                                    url: SITEURL + 'web/doOrder',
                                    method: "POST",
                                    data: {totalAmount: totalAmount, address_id: aid, coupon_id: coupon_id, coupon_code: coupon_code, coupon_discount: coupon_discount, session_id: session_id, gst: gst, shipping_charge: shipping_charge},
                                    success: function (data)
                                    {
                                        var str = data;
                                        var res = str.split("@");
                                        if (res[1] == 'success')
                                        {
                                            window.location.href = SITEURL + 'web/thankYou';
                                        } else if (res[1] == 'noprod')
                                        {
                                            toastr.error(res[2]);
                                        } else if (res[1] == 'shopclosed')
                                        {
                                            toastr.error("Shop Closed")
                                        } else
                                        {
                                            toastr.error("Something went wrong, Please try again")
                                        }
                                    }
                                });
                            }



                            function paynow(price, aid)
                            {
                                var totalAmount = '<?php echo round($total_price); ?>';
                                var coupon_id = '<?php echo $coupon_id; ?>';
                                var coupon_code = '<?php echo $coupon_code; ?>';
                                var coupon_discount = '<?php echo $coupon_discount; ?>';
                                var phone = '<?php echo $phone; ?>';
                                var email = '<?php echo $email; ?>';

// Rozerpay payment gateway starts                              
                                //alert(phone); alert(email);
// rzp_test_ywjRok0nPJdn2M
//                                var options = {
//                                    "key": "rzp_test_ywjRok0nPJdn2M",
//                                    "amount": (totalAmount * 100), // 2000 paise = INR 20
//                                    "name": "Absolutemens",
//                                    "email": email,
//                                    "phone": phone,
//                                    "description": "Payment",
//                                    "image": "https://colormoon.in/absolute_mens_new/admin_assets/assets/images/logo.png",
//                                    "handler": function (response) {
//
//
//
//                                        $.ajax({
//                                            url: SITEURL + 'web/razorPaySuccess',
//                                            method: "POST",
//                                            data: {razorpay_payment_id: response.razorpay_payment_id, totalAmount: totalAmount, address_id: aid, coupon_id: coupon_id, coupon_code: coupon_code, coupon_discount: coupon_discount},
//                                            success: function (data)
//                                            {
//                                                var str = data;
//                                                var res = str.split("@");
//                                                if (res[1] == 'success')
//                                                {
//                                                    window.location.href = SITEURL + 'web/thankYou';
//                                                } else if (res[1] == 'noprod')
//                                                {
//                                                    toastr.error(res[2]);
//                                                } else if (res[1] == 'shopclosed')
//                                                {
//                                                    toastr.error("Shop Closed")
//                                                } else
//                                                {
//                                                    toastr.error("Something went wrong, Please try again")
//                                                }
//
//
//                                            }
//                                        });
//                                    },
//
//                                    "theme": {
//                                        "color": "#528FF0"
//                                    }
//                                };
//                                var rzp1 = new Razorpay(options);
//                                rzp1.open();
//                                e.preventDefault();
// Rozerpay payment gateway ends

                            }

</script>