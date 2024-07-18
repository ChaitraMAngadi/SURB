<!--breadcrumbs area start-->
<style>
    .table-responsive table tbody tr td{
        min-width: inherit;
    }
    .label {
            font-weight: bold;
            /* float:left; */
        }
    /* .myorder{ */
/* background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0000001A;
border-radius: 10px;
opacity: 1;
padding:20px;
display: grid; */
  /* grid-template-rows: auto; */

    /* } */
</style>
<div class="breadcrumbs_area mb-3 breads">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3>Order Details</h3> -->
                    <!--                    <ul>
                                            <li><a href="<?php echo base_url(); ?>/web">Dashboard</a></li>
                                            <li>Order View</li>
                                        </ul>-->
                                        <span style=" font-size:15px;
        text-transform: capitalize;
        font-weight: bold;line-height:1.5em;"><?php print_r($firstname." ".$lastname);?></span><br>
                    <span style="font-size:13px;"><?php
                     print_r($email);?></span>
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
    <?php 


// echo "<pre>";
// print_r($data);
// exit;
?>
      <div class="row">
         <div class="col-lg-2 col-md-2 order_view ">
            <?php include 'dashboard_menu.php' ?>
         </div>
         <!-- <div class="delivery-details">
            <div class="myorder"> -->
         <div class="col-lg-10 col-md-10 order_viewpage">
            <?php  
            // echo "<pre>";
                    //  print_r($data);
                    //  exit; ?>
                    <?php if ($data['bid_status'] == 'yes') { ?>
               <a class="btn btn-success">Bid Order</a>
               <?php } ?>
               <div id="show_message_alert"></div>
               <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-10 order_view_header">
                  <!--                                    <div class="col-lg-12 col-md-12">
                     <?php 
                    //  $this->load->view("web/steps_menu");
                      ?>
                                                         </div>-->
                  <a href="<?php echo base_url(); ?>web/my_orders" onclick="goBack()" class="backbutton">
                  <span class="angle">  <  </span> &nbsp;&nbsp;Back to My Order
                  </a>
               </div>
            <div class="mycardcontainer">
               
              
               <div class="view_box">
               <div class="row">
                 
                 
                            
                  
                  
                  <div class="col-lg-6 col-12 col-xs-12 col-sm-12 col-md-6 view_card1">
                     <div class="col-lg-2 col-4 col-xs-2 col-sm-2 col-md-2 square">
                        <span width="100" data-title="Product" class="product_thumb1">
                        <?php
                                    $qry = $this->db->query("select seo_url from products where id='" . $data['product_id'] . "'");
                                    $product_row = $qry->row();?>
                        <a href="<?php echo base_url() . 'single-product/' . $product_row->seo_url; ?>" target="_blank"><img src="<?php echo $data['image']; ?>" alt="" class="order-img"></a></span>
                     </div>
                     <div class="col-lg-4 col-8 col-xs-10 col-sm-10 col-md-4 view_details">
                        <div data-title="Product Name" class="productnameview"><a><?php echo $data['product_name']; ?></a>
                        </div>
                        
                        <div class="volume_details">
                           <?php foreach ($data['attributes'] as $attibut) { ?>
                           <span class="volume1"><b><?php echo $attibut['attribute_type']; ?> : <?php echo $attibut['attribute_values']; ?></b>
                           </span>
                           <?php } ?>
                           <span data-title="Quantity" class="quantity_view"> Qty:<?php echo $data['quantity']; ?></span>
                        </div>
                        <div class="price-div">
                           <span width="100" data-title="Price" class="product-price" style="font-weight:bold;"><i class="fal fa-rupee-sign" style="font-weight:bold;"></i> <?php echo $data['price']; ?></span>
                           <?php if ($data['price'] != $data['saleprice']) { ?>
                           <del width="100" data-title="Price" class="product-price" style="opacity:0.8;"><i class="fal fa-rupee-sign"></i> <?php echo $data['saleprice']; ?></del>
                           <?php $discount = (($data['saleprice'] - $data['price']) / ($data['saleprice'])) * 100; ?>
                           <span width="100" data-title="Price" class="discountpercent">(<?php echo round($discount); ?>%OFF)</span>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 col-12 col-xs-12 col-sm-12 col-md-6 view_card" style="display:flex;flex-direction:column;justify-content:space-between;">
                     <div class="padleftreset">
                        <?php $this->load->view("web/individual_steps_menu", $data); ?> 
                    </div>
                    <div class="session_id1"><span><b>Order ID:</b><?php echo $data['session_id']; ?></span></div>
                   
                    <div>
                        <?php if (!empty($data['tracking_id']) && !empty($data['tracking_name'])) { ?>
                        <span class="trackings"><b>Courier Name:</b> <?php echo $data['tracking_name']; ?></span>
                        <span class="track_id"><b>Tracking ID:</b> <?php echo $data['tracking_id']; ?></span>
                    </div>
                    
                    
                        <div style="display:flex;gap:1.2rem;padding-left: 10px;">
                           <?php
                              $order_status = $data['display_status'];
                              $payment_type = $data['payment_type'];
                            //   if ($order_status == '1' && $payment_type == 'COD') {
                                  ?>
                           <!-- <a onclick="cancelOrder('<?php echo $data['id']; ?>')" style="color:red;text-decoration:underline;">Cancel order</a> -->
                           <?php 
                        // } ?>
                           <!-- <a href="#" style="color:#2556B9;text-decoration:underline;">Need Help</a> -->
                        </div>
                        <?php } ?>
                     
                  </div>
               </div><br>
              
               
               <div class="row orderboxview">
                  <div class="col-lg-3 col-12 col-sm-12 col-xs-12 col-md-12">
                     <div class="cardbelow">
                        <div class="bidfulldetails1">
                           <div style="display:flex;gap:1.2rem;">
                              <span class="order_address"> Address </span>
                              <!-- <span><a href="#" style="text-decoration:underline;color:#2556B9;">Change Address</a></span> -->
                           </div>
                           <div style="line-height:1.5em;">
                              <span>
                                 <?php echo $data['customer_name']; ?>,
                                 <?php echo $data['user_address']; ?>
                              </span>
                              <h4 style="line-height:1.5em;margin-top:10px;font-weight:600;">Mobile Number</h4>
                              <span>
                              <?php echo $data['mobile']; ?>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-12 col-xs-12 col-sm-12">
                     <div class="cardbelow">
                     <div class="bidfulldetails" style="display: flex; flex-direction: column; justify-content:space-between;gap:22px;">
    <span style="font-weight:bold;">Payment Details </span>
    <!-- <div class="order_id">
   <span>Order ID</span><span>:</span><span class="order_id1"><?php echo $data['session_id']; ?></span>
    </div> -->
    <!-- <div class="order_on">
    <span>Ordered On</span><span>:</span><span class="order_on1"> <?php echo date('d M, h:i A', strtotime($data['created_date'])); ?></span>
    </div> -->
    <div class="payment_mode col-lg-12 col-12 col-md-12 col-xs-12 col-sm-12 col-xm-12">
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-4">Payment Mode</div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-2">:</div><div  class="payment_mode1 col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-6"><?= ($data['payment_type']) ? $data['payment_type'] : 'N/A' ?></div>
    </div>
    <div class="payment_status col-lg-12 col-12 col-md-12 col-xs-12 col-sm-12 col-xm-12">
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-4"> Payment Status</div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-2">:</div><div class="payment_status1 col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-6"><?php echo $data['payment_status']; ?></div>
    </div>
    <div class="order_status col-lg-12 col-12 col-md-12 col-xs-12 col-sm-12 col-xm-12">
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-4">Order Status</div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-2">:</div><div class="order_status1 col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xm-4 col-6"><a class="link" style="cursor: not-allowed"><?php
                              if ($data['display_status'] == 1) {
                                  echo "Transaction Failed";
                              } else if ($data['display_status']== 2) {
                                  echo "Accepted";
                              } else if ($data['display_status'] == 3) {
                                  echo "Assign to Courier";
                              } else if ($data['display_status'] == 4) {
                                  echo "Shipped";
                              } else if ($data['display_status'] == 5) {
                                  echo "Delivered";
                              } else if ($data['display_status'] == 6) {
                                  echo "Cancelled";
                              } else if ($data['display_status'] == 7) {
                                  echo "Return";
                              }
                              ?></a></div>
</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-12 col-xs-12 col-sm-12 col-md-12" style="padding-top:10px;">
                     <div class="coupon_code right ">
                        <div class="coupon_inner">
                           <?php //echo "<pre>"; print_r($data['ordersdetails']);     ?>
                           <div class="cart_subtotal">
                              <p>Sub Total</p>
                              <p class="cart_amount"><i class="fal fa-rupee-sign"></i> <?php echo number_format($data['sub_total'], 2); ?></p>
                           </div>
                           <div class="cart_subtotal ">
                              <p>Discount</p>
                              <p class="cart_amount">- <i class="fal fa-rupee-sign"></i>  <?php echo number_format($data['coupon_disount'], 2); ?></p>
                           </div>
                           <div class="cart_subtotal ">
                              <p>Delivery Charge</p>
                              <p class="cart_amount">+ <i class="fal fa-rupee-sign"></i>  <?php echo number_format($shipping_charge, 2); ?></p>
                           </div>
                           <div class="cart_subtotal ">
                              <p>GST</p>
                              <p class="cart_amount">+ <i class="fal fa-rupee-sign"></i>  <?php echo number_format($data['gst'], 2); ?></p>
                           </div>
                           <?php if ($data['ordersdetails']['bid_status'] == 'yes') { ?>
                           <div class="cart_subtotal">
                              <p>Order Total</p>
                              <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo number_format($grand_total, 2); ?></p>
                           </div>
                           <?php } else { ?>
                           <div class="cart_subtotal">
                              <p>Order Total</p>
                              <?php
                                 //                                                   if($data['ordersdetails']['gst'] == ""){
                                 //                                                       $gst = 0;
                                 //                                                   } else {
                                 //                                                       $gst = $data['ordersdetails']['gst'];
                                 //                                                   }
                                 //                                                $sub_coupon = ($data['ordersdetails']['sub_total'] - $data['ordersdetails']['coupon_disount']);
                                 //                                                $order_boy = ($data['ordersdetails']['deliveryboy_commission'] + $gst);
                                 ?>
                              <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo number_format($grand_total, 2); ?></p>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                 
               </div>
             
               <!-- <?php if ($data['max_status'] > 4) { ?>
               <div class="product-price">
                  <?php if ($data['refund_status'] == true && $data['status'] == 0) { ?>
                  <button type="button" onclick="order_refund(<?php echo $data['cartid']; ?>,<?php echo $data['product_id']; ?>,<?php echo $data['id']; ?>')" class="btn btn-pink">Return</button>
                  <a  class="btn btn-outline-success btn-sm" data-toggle="collapse" data-target="#refundorder<?php echo $data['cartid']; ?>">Return</a>
                  <div class="row newaddressbox collapse" id="refundorder<?php echo $data['cartid']; ?>">
                     <div class="col-lg-12">
                        <h4>Enter Reason</h4>
                     </div>
                     <form class="form-horizontal" enctype="multipart/form-data"  >
                        <div class="col-lg-12 col-md-12">
                           <div class="form-group">
                              <input type="hidden" class="form-control" id="cart_id_<?php echo $data['cartid']; ?>" value="<?php echo $data['cartid']; ?>">
                              <input type="hidden" class="form-control" id="product_id_<?php echo $data['cartid']; ?>" value="<?php echo $data['product_id']; ?>">
                              <input type="hidden" class="form-control" id="order_id_<?php echo $data['cartid']; ?>" value="<?php echo $data['session_id']; ?>">
                              <input type="hidden" class="form-control" id="vendor_id_<?php echo $data['cartid']; ?>" value="<?php echo $data['vendor_id']; ?>">
                              <textarea name="message"  id="message_<?php echo $data['cartid']; ?>" cols="20" cols="50" ></textarea>
                              <div class="col-lg-12">
                                 <button type="button" class="btn btn-address"  onclick="order_refund('<?php echo $data['cartid']; ?>')">Submit</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <?php } ?>
                     <?php
                        //                                                                $return_data = $this->db->where(['session_id' => $data[0]->session_id, 'cartid' => $cartdata['cartid']])->get('refund_exchange')->row();
                        if ($data['order_condition'] != 7 && $data['status'] == 1 && $data['return_refund_status'] == 0) {
                            ?>
                     <div>
                        <b style="color: green;">Return Request sent</b>
                     </div>
                     <?php } else if ($data['order_condition'] != 7 && $data['status'] == 1 && $data['return_refund_status'] == 1) { ?>
                     <div>
                        <b style="color: blue;">Return accepted</b>
                     </div>
                     <?php } else if ($data['order_condition'] != 7 && $data['status'] == 1 && $data['return_refund_status'] == 2) { ?>
                     <div>
                        <b style="color: red;">Return Rejected</b>
                     </div>
                     <?php } else if ($data['order_condition'] == 7 && $data['status'] == 1 && $data['return_refund_status'] == 1) { ?>  
                     <div>
                        <b style="color: green;">Returned</b>
                     </div>
                     <?php } ?>
                  </div>
               </div> -->
               <!-- <span data-title="Rating" class="product-price">
               <?php if (($data['review'] == "" || $data['comments'] == "") && $data['delivery_status'] == 'Delivered') { ?>
               <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#exampleModal<?php echo $cartdata['product_id']; ?>">Review</button> 
               <?php } else if ($data['review'] != "" && $data['comments'] != "") { ?>
               <?php for ($i = 0; $i < $data['review']; $i++) { ?>
               <span><i class="fas fa-star"></i></span>
               <?php } ?>
               <?php } ?>
               </span>   -->
               <?php } ?>
               <!-- <div class="modal fade" id="exampleModal<?php echo $data['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content" style="margin-top:60%;">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                           <button type="button" class="close" data-dismiss="modal" style="right: 20px;top: 20px;line-height: 2px;" aria-label="Close">
                           <span aria-hidden="true" style="position: relative;bottom: 3px;right: 6px;">&times;</span>
                           </button>
                        </div>
                        <form method="post" class="form-horizontal" >
                           <input type="hidden" class="form-control" id="pid<?php echo $data['product_id']; ?>" value="<?php echo $data['product_id']; ?>">
                           <input type="hidden" class="form-control" id="order_id<?php echo $data['product_id']; ?>" value="<?php echo $data['id']; ?>">
                           <input type="hidden" class="form-control" id="vendor_id<?php echo $data['product_id']; ?>" value="<?php echo $data['vendor_id']; ?>">
                           <input type="hidden" class="form-control" id="user_id<?php echo $data['product_id']; ?>" value="<?php echo $data['user_id']; ?>">
                           <div class="rating">
                              <input type="radio" name="rating" value="5" id="5_<?php echo $data['product_id']; ?>"><label for="5_<?php echo $data['product_id']; ?>">☆</label>
                              <input type="radio" name="rating" value="4" id="4_<?php echo $data['product_id']; ?>"><label for="4_<?php echo $data['product_id']; ?>">☆</label>
                              <input type="radio" name="rating" value="3" id="3_<?php echo $data['product_id']; ?>"><label for="3_<?php echo $data['product_id']; ?>">☆</label>
                              <input type="radio" name="rating" value="2" id="2_<?php echo $data['product_id']; ?>"><label for="2_<?php echo $data['product_id']; ?>">☆</label>
                              <input type="radio" name="rating" value="1" id="1_<?php echo $data['product_id']; ?>"><label for="1_<?php echo $data['product_id']; ?>">☆</label>
                           </div>
                           <div class="form-group">
                              <label for="id">Comments</label>
                              <textarea class="form-control" id="comments<?php echo $data['product_id']; ?>" placeholder="Enter your comment" name="comments"></textarea>
                           </div>
                           <button type="button" onclick="reviewForm('<?php echo $data['product_id']; ?>')" class="btn btn-primary">Submit </button>
                        </form>
                     </div>
                  </div>
               </div> -->
               
               </div> 
            </div>
         </div>
         <!-- </div>    
            </div> -->
      </div>
   </div>
   </div>
</section>

           
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
                                function reviewForm(product_id) {
                                    //alert(product_id); 
                                    $('.error').remove();
                                    var errr = 0;

                                    var pid = $('#pid' + product_id).val();
                                    var order_id = $('#order_id' + product_id).val();
                                    var vendor_id = $('#vendor_id' + product_id).val();
                                    var user_id = $('#user_id' + product_id).val();
                                    var radioValue = $("input[name='rating']:checked").val();
                                    var comments = $('#comments' + product_id).val();
                                    //alert(oid); alert(radioValue); alert(comments); 
                                    if (radioValue != '' && comments != '') {
                                        $.ajax({
                                            url: "<?= base_url(); ?>web/review",
                                            method: "POST",
                                            data: {pid: pid, order_id: order_id, vendor_id: vendor_id, user_id: user_id, radioValue: radioValue, comments: comments},
                                            success: function (data)
                                            {

                                                if (data == '@success') {
                                                    toastr.success('Review done successfully.');
                                                    setTimeout(function () {
                                                        location.reload();
                                                    }, 1000);
                                                } else {
                                                    toastr.error('Something went wrong.');
                                                    //location.reload();
                                                }
                                            }
                                        });
                                    } else {
                                        toastr.error('Please select a rating & write comment.');
                                        return false;
                                    }
                                }
                                
                                function reviewForm1(product_id) {
                                    //alert(product_id); 
                                    $('.error').remove();
                                    var errr = 0;

                                    var pid = $('#pid1' + product_id).val();
                                    var order_id = $('#order_id1' + product_id).val();
                                    var vendor_id = $('#vendor_id1' + product_id).val();
                                    var user_id = $('#user_id1' + product_id).val();
                                    var radioValue = $("input[name='rating1']:checked").val();
                                    var comments = $('#comments1' + product_id).val();
                                    //alert(oid); alert(radioValue); alert(comments); 
                                    if (radioValue != '' && comments != '') {
                                        $.ajax({
                                            url: "<?= base_url(); ?>web/review",
                                            method: "POST",
                                            data: {pid: pid, order_id: order_id, vendor_id: vendor_id, user_id: user_id, radioValue: radioValue, comments: comments},
                                            success: function (data)
                                            {

                                                if (data == '@success') {
                                                    toastr.success('Review done successfully.');
                                                    setTimeout(function () {
                                                        location.reload();
                                                    }, 1000);
                                                } else {
                                                    toastr.error('Something went wrong.');
                                                    //location.reload();
                                                }
                                            }
                                        });
                                    } else {
                                        toastr.error('Please select a rating & write comment.');
                                        return false;
                                    }
                                }

</script>

<style>
    /*    body{
    background: #222225;
    color: white;
    margin: 100px auto;
    }*/

    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
    }

    .rating > input{
        display:none;
    }

    .rating > label {
        position: relative;
        width: 1.1em;
        font-size: 03vw;
        color: #FFD700;
        cursor: pointer;
    }

    .rating > label::before{
        content: "\2605";
        position: absolute;
        opacity: 0;
    }

    .rating > label:hover:before,
    .rating > label:hover ~ label:before {
        opacity: 1 !important;
    }

    .rating > input:checked ~ label:before{
        opacity:1;
    }

    .rating:hover > input:checked ~ label:before{
        opacity: 0.4;
    }
</style>

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

    function order_refund(cart)
    {
        var cart_id = $("#cart_id_"+cart).val();
        var product_id = $("#product_id_"+cart).val();
        var order_id = $("#order_id_"+cart).val();
        var vendor_id = $("#vendor_id_"+cart).val();
        var message = $("#message_"+cart).val();

        if (message == '') {
            swal("Please enter reason");
            return false;
        } else {
            var id = $(this).parents("tr").attr("id");

            swal({

                title: "Are you sure?",

                text: "you want to return this product",

                type: "warning",

                showCancelButton: true,

                confirmButtonClass: "btn-danger",

                confirmButtonText: "Yes",

                cancelButtonClass: "btn-danger",

                cancelButtonText: "No",

                closeOnConfirm: true,

                closeOnCancel: true

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

    }

    function order_refund_mobile(cart)
    {
        var cart_id = $("#cart_id1_"+cart).val();
        var product_id = $("#product_id1_"+cart).val();
        var order_id = $("#order_id1_"+cart).val();
        var vendor_id = $("#vendor_id1_"+cart).val();
        var message = $("#message1_"+cart).val();

        if (message == '') {
            swal("Please enter reason");
            return false;
        } else {
            var id = $(this).parents("tr").attr("id");

            swal({

                title: "Are you sure?",

                text: "you want to return this product",

                type: "warning",

                showCancelButton: true,

                confirmButtonClass: "btn-danger",

                confirmButtonText: "Yes",

                cancelButtonClass: "btn-danger",

                cancelButtonText: "No",

                closeOnConfirm: true,

                closeOnCancel: true

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