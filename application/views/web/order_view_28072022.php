<?php $this->load->view("web/includes/subpage_header"); ?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Order Details</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>/web">Dashboard</a></li>
                        <li>Order View</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--breadcrumbs area end-->
<div id="move_to_top_scroll"></div>
<!--about section area -->
<section class="dashboard">
    <div id="move_to_top_scroll"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <?php include 'dashboard_menu.php' ?>
                    </div>

                    <div class="col-lg-9 col-md-12">

                        <div id="show_message_alert"></div>
                        <div class="delivery-details">

                            <div class="row">
                                <div class="col-12">
                                <div class="col-lg-12 col-md-12">
                                    <?php $this->load->view("web/steps_menu"); ?>
                                </div>
                                    <a href="<?php echo base_url(); ?>/web/my_orders">
                                    <button onclick="goBack()" class="btn btn-success float-right mb-3">Back</button>
                                    </a>
                                </div>

                                <?php if ($data['ordersdetails']['bid_status'] == 'yes') { ?>
                                    <a class="btn btn-success">Bid Order</a>
                                <?php } ?>
                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body bidfulldetails">


                                            <strong> User Details </strong>
                                            <span>Name</span>  <?php echo $data['ordersdetails']['customer_name']; ?><br>
                                            <span>Phone</span> <?php echo $data['ordersdetails']['mobile']; ?><br>
                                            <span>Address</span> <?php echo $data['ordersdetails']['user_address']; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php /* <div class="col-lg-6 col-md-6">
                                  <div class="card">
                                  <div class="card-body bidfulldetails">
                                  <strong> Shop Details </strong>
                                  <span>Sho Name</span>  <?php echo $data['ordersdetails']['vendor_name']; ?><br>
                                  <span>City</span> <?php echo $data['ordersdetails']['city']; ?>
                                  </div>
                                  </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6">
                                  <div class="card">
                                  <div class="card-body bidfulldetails">
                                  <strong>Delivery Boy Details </strong>
                                  <?php if($data['ordersdetails']['accept_status']==0){ ?>
                                  <span>Name</span>  <?php echo $data['ordersdetails']['delivery_name']; ?><br>
                                  <span>Phone</span> <?php echo $data['ordersdetails']['delivery_phone']; ?><br>
                                  <span>Alternative Phone</span>  <?php echo $data['ordersdetails']['alternative_mobiles']; ?>
                                  <span>Delivery Charge</span>: <?php echo $data['ordersdetails']['deliveryboy_commission']; ?>
                                  <?php }else{ ?>

                                  <span>Name</span>  <?php echo $data['ordersdetails']['owner_name']; ?><br>
                                  <span>Phone</span> <?php echo $data['ordersdetails']['vendor_mobile']; ?><br>
                                  <span>Delivery Charge</span>: <?php echo $data['ordersdetails']['deliveryboy_commission']; ?>
                                  <?php } ?>
                                  </div>
                                  </div>
                                  </div> */ ?>
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body bidfulldetails">
                                            <strong> Order ID # <?php echo $data['ordersdetails']['id']; ?> </strong>
                                            <span>Created Date and Time</span>  <?php echo $data['ordersdetails']['created_date']; ?>
                                            <span>Payment Type</span>  <?php echo $data['ordersdetails']['payment_type']; ?><br>
                                            <span>Payment Status</span> <?php echo $data['ordersdetails']['payment_status']; ?><br>
                                            <span>Order Status</span>  <a class="btn btn-success btn-sm"><?php echo $data['ordersdetails']['order_status']; ?></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-lg-12">
                                <div class="table-responsive" id="no-more-tables">
                                    <table class="table table-striped">
                                        <thead class="bg-blue text-white">
                                            <tr>
                                                <th class="product_thumb">Product</th>
                                                <th class="product_name">Product Name</th>
                                                <th class="product-price">Price</th>
                                                <th class="product_quantity">Quantity</th>
                                                <th class="product_remove">Total</th>
                                                <th class="product_remove">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($data['ordersdetails']['cartdetails'] as $cartdata) { ?>
                                                <tr>
                                                    <td data-title="Product" class="product_thumb1"><a><img src="<?php echo $cartdata['image']; ?>" alt="" class="orderimg"></a></td>
                                                    <td data-title="Product Details" class="product_name"><a ><?php echo $cartdata['productname']; ?></a>
                                                        <?php foreach ($cartdata['attributes'] as $attibut) { ?>
                                                            <div><b><?php echo $attibut['attribute_type']; ?> : </b><?php echo $attibut['attribute_values']; ?></div>
                                                        <?php } ?>
                                                    </td>
                                                    <td data-title="Price" class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $cartdata['price']; ?></td>
                                                    <td data-title="Price" class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $cartdata['quantity']; ?></td>
                                                    <td data-title="Price" class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $cartdata['total_price']; ?></td>
                                                    <td data-title="Price" class="product-price">
                                                        <?php if ($cartdata['refund_status'] == true && $cartdata['status'] == 0) { ?>

                            <!-- <button type="button" onclick="order_refund(<?php echo $cartdata['cartid']; ?>,<?php echo $cartdata['product_id']; ?>,<?php echo $data['ordersdetails']['id']; ?>')" class="btn btn-pink">Return</button> -->

                                                            <a  class="btn btn-outline-success btn-sm" data-toggle="collapse" data-target="#refundorder<?php echo $cartdata['cartid']; ?>">Return</a>

                                                            <div class="row newaddressbox collapse" id="refundorder<?php echo $cartdata['cartid']; ?>">
                                                                <div class="col-lg-12">
                                                                    <h4>Enter Reason</h4>
                                                                </div>

                                                                <form class="form-horizontal" enctype="multipart/form-data"  >
                                                                    <div class="col-lg-12 col-md-12">

                                                                        <div class="form-group">
                                                                            <input type="hidden" class="form-control" id="cart_id" value="<?php echo $cartdata['cartid']; ?>">
                                                                            <input type="hidden" class="form-control" id="product_id" value="<?php echo $cartdata['product_id']; ?>">
                                                                            <input type="hidden" class="form-control" id="order_id" value="<?php echo $data['ordersdetails']['session_id']; ?>">
                                                                            <input type="hidden" class="form-control" id="vendor_id" value="<?php echo $data['ordersdetails']['vendor_id']; ?>">

                                                                            <textarea name="message"  id="message" cols="20" cols="50" ></textarea>
                                                                            <div class="col-lg-12">
                                                                                <button type="button" class="btn btn-address"  onclick="order_refund()">Submit</button>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </form>


                                                            <?php } ?>
                                                            <?php if ($data['ordersdetails']['order_condition'] != 7 && $cartdata['status'] != 0) { ?>
                                                                <div>
                                                                    <b style="color: green;"><?php echo $cartdata['refundmsg']; ?></b><br>
                                                                    <b>Shop Address : </b><br><?php echo $data['ordersdetails']['address']; ?>,<?php echo $data['ordersdetails']['city']; ?>
                                                                </div>
                                                            <?php } ?>

                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end pb-5">
                            <div class="col-lg-6">
                                <div class="coupon_code right">
                                    <h3>Totals</h3>
                                    <div class="coupon_inner">
                                        <?php //echo "<pre>"; print_r($data['ordersdetails']);  ?>
                                        <div class="cart_subtotal">
                                            <p>Sub Total</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i> <?php echo $data['ordersdetails']['sub_total']; ?></p>
                                        </div>

                                        <div class="cart_subtotal ">
                                            <p>Discount</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo $data['ordersdetails']['coupon_disount']; ?></p>
                                        </div>

                                        <div class="cart_subtotal ">
                                            <p>Delivery Charge</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo $data['ordersdetails']['deliveryboy_commission']; ?></p>
                                        </div>

                                        <div class="cart_subtotal ">
                                            <p>GST</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo $data['ordersdetails']['gst']; ?></p>
                                        </div>
                                        <?php if ($data['ordersdetails']['bid_status'] == 'yes') { ?>
                                            <div class="cart_subtotal">
                                                <p class="fz-20">Grand Total</p>
                                                <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo $data['ordersdetails']['amount']; ?></p>
                                            </div>
                                        <?php } else { ?>

                                            <div class="cart_subtotal">
                                                <p class="fz-20">Grand Total</p>
                                                <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo ($data['ordersdetails']['sub_total'] - $data['ordersdetails']['coupon_disount']) + $data['ordersdetails']['deliveryboy_commission'] + $data['ordersdetails']['gst']; ?></p>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $order_status = $data['ordersdetails']['order_status'];
                        $payment_type = $data['ordersdetails']['payment_type'];
                        if ($order_status == 'Pending' && $payment_type == 'COD') {
                            ?>
                            <div class="input-group mb-3">
                                <button type="button" onclick="cancelOrder('<?php echo $data['ordersdetails']['id']; ?>')" class="btn btn-pink btn-block">Cancel Order</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    /*function order_refund()
     {
     var cart_id = $("#cart_id").val();
     var product_id = $("#product_id").val();
     var order_id = $("#order_id").val();
     var vendor_id = $("#vendor_id").val();
     var message = $("#message").val();

     if(confirm("Are you sure you want to return this product"))
     {
     $.ajax({
     url:"<?php echo base_url(); ?>web/order_refund",
     method:"POST",
     data:{cart_id:cart_id,product_id:product_id,order_id:order_id,vendor_id:vendor_id,message:message},
     success:function(data)
     {
     var str = data;
     var res = str.split("@");
     $('html, body').animate({
     scrollTop: $('#move_to_top_scroll').offset().top - 100
     }, 'slow');

     if(res[1]=='success')
     {
     $('#show_message_alert').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Your return Request sent Successfully</span>');
     $('#show_message_alert').focus();
     location.reload();
     return false;
     }
     else
     {
     $('#show_message_alert').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Something went wrong , please try again</span>');
     $('#show_message_alert').focus();
     return false;
     }

     }
     });
     }

     }*/

    function order_refund()
    {
        var cart_id = $("#cart_id").val();
        var product_id = $("#product_id").val();
        var order_id = $("#order_id").val();
        var vendor_id = $("#vendor_id").val();
        var message = $("#message").val();


        var id = $(this).parents("tr").attr("id");

        swal({

            title: "Are you sure?",

            text: "you want to return this product",

            type: "warning",

            showCancelButton: true,

            confirmButtonClass: "btn-danger",

            confirmButtonText: "Yes",

            cancelButtonText: "Cancel",

            closeOnConfirm: false,

            closeOnCancel: false

        },
                function (isConfirm) {

                    if (isConfirm) {

                        $.ajax({
                            url: "<?php echo base_url(); ?>web/order_refund",
                            method: "POST",
                            data: {cart_id: cart_id, product_id: product_id, order_id: order_id, vendor_id: vendor_id, message: message},
                            success: function (data)
                            {
                                var str = data;
                                var res = str.split("@");
                                $('html, body').animate({
                                    scrollTop: $('#move_to_top_scroll').offset().top - 100
                                }, 'slow');

                                if (res[1] == 'success')
                                {
                                    swal("Your return Request sent Successfully");
                                    location.reload();
                                } else
                                {
                                    swal("Something went wrong , please try again");
                                }

                            }
                        });


                    } else {

                        swal("Cancelled", "", "error");

                    }

                });




    }



    function cancelOrder(order_id) {
        var id = $(this).parents("tr").attr("id");

        swal({

            title: "Are you sure?",

            text: "you want to cancel this order",

            type: "warning",

            showCancelButton: true,

            confirmButtonClass: "btn-danger",

            confirmButtonText: "Yes",

            cancelButtonText: "Cancel",

            closeOnConfirm: false,

            closeOnCancel: false

        },
                function (isConfirm) {

                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url(); ?>web/cancelOrder",
                            method: "POST",
                            data: {order_id: order_id},
                            success: function (data)
                            {
                                var str = data;
                                var res = str.split("@");
                                if (res[1] == 'success')
                                {
                                    swal("Order Cancelled Successfully");
                                    location.reload();
                                } else
                                {
                                    swal("Something went wrong , please try again");
                                }
                            }
                        });
                    } else {

                        swal("Cancelled", "", "error");

                    }

                });



    }



    /*function cancelOrder(order_id)
     {
     if(confirm("Are you sure you want to cancel this order")){

     $.ajax({
     url:"<?php echo base_url(); ?>web/cancelOrder",
     method:"POST",
     data:{order_id:order_id},
     success:function(data)
     {
     var str = data;
     var res = str.split("@");


     if(res[1]=='success')
     {
     $('#show_message_alert').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Order Cancelled Successfully</span>');
     $('#show_message_alert').focus();
     location.reload();
     return false;
     }
     else
     {
     $('#show_message_alert').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Something went wrong , please try again</span>');
     $('#show_message_alert').focus();
     return false;
     }



     }
     });
     }
     }*/
</script>
<!--about section end-->

<script type="text/javascript">
    function goBack() {
        window.history.back()
    }
</script>
<?php include 'includes/footer.php' ?>