<style>
.form-horizontal{
    display:flex;
    /* flex-direction: row-reverse; */
    justify-content: space-between;
    flex-direction:column;
    gap:1.2rem;
}
</style>
<?php 
// echo "<pre>";
// print_r($data);exit;
?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3 breads"> 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3>My Orders</h3> -->
                    <!--                    <ul>
                                            <li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
                                            <li>My Orders</li>
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
<!--about section area -->
<section class="dashboard">
<div id="show_message_alert"></div>
  <div class="delivery-details">
    <div class="container" >
        <div class="row">
        

           
            <?php   
            // echo "<pre>";print_r($data);exit;
                    // exit;
            // echo $data['display_status'];?>
               
               <?php
                // echo "<pre>"; print_r($data);exit;?>
                   
                        
            <div class="col-lg-2 col-md-2 orders_dashboard">
                <?php 
                include 'dashboard_menu.php' ?>
            </div><?php 
            // echo "<pre>";print_r($data);exit;?>
                       
                        <?php $productIds=[];
                        $countpro=0;
                        
                        foreach($data as $order){
                            foreach($order['ordersdetails']['cartdetails'] as $cartdata){
                                // print_r($cartdata['refund_status']);
                                // exit;
                               $productIds[]= $cartdata['product_id'];
                               $countpro++;

                            }

                        }
                        // echo "<pre>" ; print_r($countpro); exit;?>
                       
                       
                        
                    <div class="col-lg-10 col-md-10 order_page" style="display:none;">
                    <div class="order_header" style="display:none;">
                       
                    <h4 class="orders_head">My Order <span class="order_count">(<?php echo $countpro; ?> items)</span></h4>
                    
                    <?php   $user_qry = $this->db->query("select * from users where id='".$user_id."'");
$user_qry_res = $user_qry->row();


$date=date('Y-m-d');


$user_expiry_date = ($user_qry_res->expiry_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->expiry_member_date)) : null;


$user_created_date = ($user_qry_res->created_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->created_member_date)) : null;
// echo $user_created_date;
if (($user_expiry_date != null && $user_expiry_date >= $date && $user_qry_res->expiry_member_date!='') && 
    ($user_created_date != null && $user_created_date <= $date && $user_qry_res->created_member_date!='')&& $user_qry_res->membership=='yes' && $user_qry_res->plan!=0 && $user_qry_res->plan!=''&& $user_qry_res->plan!=null&& $user_qry_res->plan!='0' ) {
    // Your code if the condition is true


                           
                           ?>
                    <div class="date-flex">
                            
                            <?php
                            $current_timestamp = time();

                            // Convert the expiry date to a timestamp
                            $expiry_timestamp = strtotime($user_expiry_date);
                            
                            // Calculate the difference in seconds
                            $difference_seconds = $expiry_timestamp - $current_timestamp;
                            
                            // Convert seconds to days
                            $days_difference = ceil($difference_seconds / (60 * 60 * 24));
                            
                            // echo "Days remaining until expiry: " . $days_difference;
                            ?>
                           <?php if ($days_difference <= 7) {?>
                            
                            <div class="date-expires-info">
                                <span class="date-label">Membership</span>
                                <!-- <span class="date-value"><?php echo date('d-m-Y', strtotime($user_created_date));?></span> -->
                                <?php if ($days_difference == 0) {?>
                                    <span class="date-label">Expires</span>
                                    <span class="date-value">today</span>
                                <?php } elseif ($days_difference == 1) {?>
                                    <span class="date-label">Expires in</span>
                                    <span class="date-value"><?php echo $days_difference;?> day</span>
                                <?php } else {?>
                                    <span class="date-label">Expires in</span>
                                    <span class="date-value"><?php echo $days_difference;?> days</span>
                                <?php }?>
                            </div>
                            <span style="color:#2556B9;text-decoration:underline;margin-top:10px;">
                            <a href="<?php echo base_url();?>web/membership">Renew Now
                            </span>
                            <?php } else {?>
                            <div class="date-info">
                                <span class="date-label">Membership</span>
                                <!-- <span class="date-value"><?php echo date('d-m-Y', strtotime($user_created_date));?></span> -->
                                <span class="date-label">Expires in</span>
                                <span class="date-value"><?php echo $days_difference;?> days</span>
                            </div>
                        <?php }?>


                        </div><?php }?>
                        </div>
                       <div class="mycontainer" style="display:none;">
                    <?php  
                   
                                    // print_r($max_status);
                                    // exit;
                                    
                                    //  exit;
                                foreach ($data as $order) {
                                    // echo "<pre>";
                                    // print_r($order['ordersdetails']['vendor_id']);
                                    
                                ?>
                                
                               
                           
                            
                                
                                
                                
                                
                                <!-- <a href="<?php echo base_url(); ?>web/orderview/<?php echo $order['ordersdetails']['session_id']; ?>" class="btn btn-sm btn-success">View </a> -->
                                <?php foreach ($order['ordersdetails']['cartdetails'] as $cartdata) {
                                    
                                    
                                ?>  
                                 <div class="row myorder">
                        <div class="col-lg-6 col-12 col-xs-12 col-sm-12 col-md-6 mycard1">
                                <div class="col-lg-2 col-2 col-xs-2 col-sm-2 col-md-2 square" >
                                    <span width="100" data-title="Product" class="product_thumb1">
                                    <?php
                                    $qry = $this->db->query("select seo_url from products where id='" . $cartdata['product_id'] . "'");
                                    $product_row = $qry->row();
                                    // print_r($product_row->seo_url);
// Assuming $str is your input string
// $str =$cartdata['productname'];

// Generate SEO-friendly URL
// $string = preg_replace('/[^a-zA-Z0-9\.]/', "-", strtolower($str));
// $hyphens_str = preg_replace('/-+/', '-', $string);
// $seo_url = trim(preg_replace("![^a-z0-9]+!i", "-", $hyphens_str), '-');

// Generate a random number between 111 and 999
// $random_char = rand(111, 999);

// Construct the final URL
// $final_seo_url = $cartdata['product_id']."_".$seo_url;
?>

<a href="<?php echo base_url() . 'single-product/' . $product_row->seo_url; ?>" target="_blank">
    <img src="<?php echo $cartdata['image']; ?>" alt="" class="order-img">
</a>
                                    </span>
                                </div>
                            <div class="col-lg-4 col-10 col-xs-10 col-sm-10 col-md-4 order_det">
                                <div data-title="Product Name" class="product-name1"><a><?php echo $cartdata['productname']; ?></a></div>
                                <div class="volume_details">
                                <?php foreach ($cartdata['attributes'] as $attibut) { ?>
                                    <span class="volume"><b><?php echo $attibut['attribute_type']; ?> : </b><?php echo $attibut['attribute_values']; ?>
                                </span>
                                <?php } ?>
                                <span data-title="Quantity" class="quantity1"> Qty:<?php echo $cartdata['quantity']; ?></span>
                                </div>
                                <div class="price-div">
                                <span width="100" data-title="Price" class="productprice1"><i class="fal fa-rupee-sign"></i> <?php echo $cartdata['price']; ?></span>
                                <?php if ($cartdata['price'] != $cartdata['saleprice']) { ?>
                                    <del width="100" data-title="Price" class="productprice1" style="opacity:0.7;"><i class="fal fa-rupee-sign"></i> <?php echo $cartdata['saleprice']; ?></del>
                                    <?php $discount = (($cartdata['saleprice'] - $cartdata['price']) / ($cartdata['saleprice'])) * 100; ?>
                                    <span width="100" data-title="Price" class="discount_text">(<?php echo round($discount); ?>%OFF)</span>
                                    <?php } ?>
                                </div>
                                <div class="rate_button2"><?php 
                            //   if ($max_status > 4) { ?>
                               
                                    <span data-title="Rating" class="productprice1" style="justify-content:end;float:right;">
                    <?php if (($order['ordersdetails']['review'] == "" || $order['ordersdetails']['comments'] == "") && $order['ordersdetails']['order_status'] == 'Delivered') { ?>
                    <h4 style="font-size:14px;">Rate the Product</h4><span><button type="button"  data-toggle="modal"  data-target="#exampleModal1<?php echo $cartdata['product_id']; ?>" style=" background: transparent;border: none;padding: 0;margin: 0;cursor: pointer;"><?php for ($i = 0; $i <5; $i++) { ?>
                    <span><i class="fal fa-star" style="color:#FFD136"></i></span>
                    <?php } ?></button> </span>
                    <?php }else if ($order['ordersdetails']['review'] != "" && $order['ordersdetails']['comments'] != "") { ?>
                    <?php for ($i = 0; $i < $order['ordersdetails']['review']; $i++) { ?>
                    <span><i class="fas fa-star" style="color:#FFD136"></i></span>
                    <?php } ?>
                    <?php } else if($order['ordersdetails']['review'] !="" && $order['ordersdetails']['comments'] == ""){?>
                        <?php for ($i = 0; $i < $order['ordersdetails']['review']; $i++) { ?>
                    <span><i class="fas fa-star" style="color:#FFD136"></i></span>
                    <?php } ?>
<?php }?>
                    </span>
                    <div class="modal fade" id="exampleModal1<?php echo $cartdata['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div id="ratingModal">
                                                    <div class="modal-dialog" role="document">
														<div class="modal-content" style="margin-top:60%;">
																<div class="modal-body">
																	<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                                        
																			<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Rating</h5>
																			</div>
                                                                <!--      <div class="modal-body">
                                                                        ...
                                                                      </div>-->
                                                                <form method="post" class="form-horizontal" >
                                                                    <input type="hidden" class="form-control" id="pid1<?php echo $cartdata['product_id']; ?>" value="<?php echo $cartdata['product_id']; ?>">
                                                                    <input type="hidden" class="form-control" id="order_id1<?php echo $cartdata['product_id']; ?>" value="<?php echo $order['ordersdetails']['id']; ?>">
                                                                    <input type="hidden" class="form-control" id="vendor_id1<?php echo $cartdata['product_id']; ?>" value="<?php echo $order['ordersdetails']['vendor_id'];?>">
                                                                    <input type="hidden" class="form-control" id="user_id1<?php echo $cartdata['product_id']; ?>" value="<?php echo $order['ordersdetails']['user_id']; ?>">
                                                                    <div class="rate">

                                                                        <input type="radio" name="rating1" value="5" id="5_mob_<?php echo $cartdata['product_id']; ?>"><label for="5_mob_<?php echo $cartdata['product_id']; ?>">☆</label>
                                                                        <input type="radio" name="rating1" value="4" id="4_mob_<?php echo $cartdata['product_id']; ?>"><label for="4_mob_<?php echo $cartdata['product_id']; ?>">☆</label>
                                                                        <input type="radio" name="rating1" value="3" id="3_mob_<?php echo $cartdata['product_id']; ?>"><label for="3_mob_<?php echo $cartdata['product_id']; ?>">☆</label>
                                                                        <input type="radio" name="rating1" value="2" id="2_mob_<?php echo $cartdata['product_id']; ?>"><label for="2_mob_<?php echo $cartdata['product_id']; ?>">☆</label>
                                                                        <input type="radio" name="rating1" value="1" id="1_mob_<?php echo $cartdata['product_id']; ?>"><label for="1_mob_<?php echo $cartdata['product_id']; ?>">☆</label>

                                                                    </div>
                                                                    <div class="form-group comments">

                                                                       <label for="id" style="display:flex;padding:2px 0px 10px 0px;margin: 0px;color: #333;font-size: 17px;font-weight: bold;z-index: 9999; position: relative">Comments</label>
                                            <textarea class="form-control" id="comments1<?php echo $cartdata['product_id']; ?>" placeholder="Enter your comment" name="comments"></textarea>
                                                                    </div>
                                                                    <button type="button" onclick="reviewForm1('<?php echo $cartdata['product_id']; ?>')" class="btn btn-primary" style="background-color:#2556B9;color:#ffff;margin-left:15px;border-color: #2556B9;">Submit </button>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												</div>

                <?php 
            // } ?> </div>
                            </div><!--rate_button2-->
                            <!-- <td width="100" data-title="Total" class="productprice1"><i class="fal fa-rupee-sign"></i> <?php echo $cartdata['total_price']; ?></td> -->
                        </div><!-- order_det -->
            <div class="col-lg-6 mycard">
                <div class="padleftreset">
                                                            
                                                           
                                                           
                    <!-- <?php $this->load->view("web/individual_steps_menu", $order['order']); ?> -->
                   
                    <?php 
                    //  var_dump($order);
                    // echo "<pre>";
                    // print_r($order['waybill_generated']); ?> <?php 
                    // print_r($order['display_status']);?>
                
            
                <ul class="step d-flex flex-nowrap">
                    <li class="step-item <?php if ($order['ordersdetails']['order_condition'] == '1') { ?>active <?php } ?>">
                        <a class="step_text">Pending</a>
                        <br><span class="step_text"><?= date('D,jS M', strtotime($order['ordersdetails']['created_date'])) ?></span>
                    </li>
                    <li class="step-item <?php if ($order['ordersdetails']['order_condition'] == '2') { ?>active <?php } ?>">
                        <a class="step_text">Accepted</a>
                        <br><span class="step_text"><?php if ($order['placed_at']) {
                            echo date('D,jS M', $order['placed_at']);
                        } ?></span>
                    </li>
                    <?php if ($order['ordersdetails']['order_condition'] == '6') { echo $order['order_status'];?>
                            <li class="step-item active">
                                <a class="step_text">Cancelled</a>
                                <br><span class="step_text"><?php if ($order['cancelled_at']) {
                                    echo date('D,jS M', $order['cancelled_at']);
                                } ?></span>
                            </li>
                    <?php } else { ?>
                            <li class="step-item <?php if ($order['ordersdetails']['order_condition'] == '3') { ?>active <?php } ?>">
                                <a class="step_text">Assigned Courier</a>
                                <br><span class="step_text"><?php if ($order['assign_courier_at']) {
                                    echo date('D,jS M', $order['assign_courier_at']);
                                } ?></span>
                            </li>
                           <?php if ($order['ordersdetails']['order_condition'] == '8' && $order['waybill_generated'] != '' && $order['waybill_generated'] != NULL) { ?>
                            <li class="step-item active">
    <a class="step_text">Picked up</a>
    <!-- <br><span class="step_text"><?php if ($order['pickup']) {
        // echo date('D,jS M', $order['pickup']);
    } ?></span> -->
</li><?php }?>

                            <li class="step-item <?php if ($order['ordersdetails']['order_condition'] == '4') { ?>active <?php } ?>">
                                <a class="step_text">Shipped</a>
                                <br><span class="step_text"><?php if ($order['shipped_at']) {
                                    echo date('D,jS M', $order['shipped_at']);
                                } ?></span>
                            </li>
                            <li class="step-item <?php if ($order['ordersdetails']['order_condition'] == '5') { ?>active <?php } ?>">
                                <a class="step_text">Delivered</a>
                                <br><span class="step_text"><?php if ($order['delivered_at']) {
                                    echo date('D,jS M', $order['delivered_at']);
                                } ?></span>
                            </li>
                            <?php if ($order['ordersdetails']['order_condition'] == '7') { 
                                // print_r($data['order_condition']);?>
                                    <li class="step-item active">
                                        <a class="step_text">Returned</a>
                                        <br><span class="step_text"><?php if ($order['returned_at']) {
                                            echo date('D,jS M', $order['returned_at']);
                                        } ?></span>
                                    </li>
                            <?php } ?>
                    <?php } ?>
                        
                  
                </ul>
                                                                
                </div><br>
               
                <div>
                    <div style="display:flex;flex-direction:column;justify-content:space-between;">
                <div class="session_id"><b>Order ID:</b><?php echo $order['ordersdetails']['session_id']; ?></div>
                <?php if (!empty($order['ordersdetails']['tracking_id']) && !empty($order['ordersdetails']['tracking_name'])) { ?>
                    <div><span class="trackings"><b>Courier Name:</b> <?php echo $order['ordersdetails']['tracking_name']; ?></span>
                    <span class="track_id"><b>Tracking ID:</b> <?php echo $order['ordersdetails']['tracking_id']; ?></span></div>
                    <?php } ?></div><br>
                    
                    <div class="orders_links col-lg-12 col-12">
                    <?php
                    // $order['ordersdetails']['order_condition'] = $order['display_status'];
                    $order['payment_type'] = $order['ordersdetails']['payment_type'];
                    // print_r($order['payment_type']);
                    // 
                    // if ($order['ordersdetails']['payment_type']== 'COD' && $order['ordersdetails']['order_condition']=='1') {
                     ?>
                    <!-- <a onclick="cancelOrder('<?php echo $order['ordersdetails']['id']; ?>')" style="color:red;text-decoration:underline;">Cancel order</a> -->
                    <?php 
                    // } 
                    ?>
                                                                
                    <?php $orderDetailsLink = base_url() . "web/orderview/{$order['ordersdetails']['session_id']}/{$cartdata['product_id']}"; ?>
                    <a href="<?php echo $orderDetailsLink; ?>" style="color:#2556B9;text-decoration:underline;
                    color: var(--unnamed-color-2556b9);
text-align: left;
text-decoration: underline;
font: normal normal 600 12px/15px Muli;
letter-spacing: 0px;
color: #2556B9;
opacity: 1;">Order Details</a> 
                    <!-- <a href="#" style="color:#2556B9;text-decoration:underline;">Need Help</a> -->
                    <?php
                    // echo "<pre>";
                    //  print_r($order['waybill_generated']);
                    // exit;
                    // print_r($max_status);?>
                    <?php if ($order['ordersdetails']['order_condition'] == '4' && $order['waybill_generated']!='') { ?>
                        <!-- <a onclick="checkTrackingStatus('<?= $order['ordersdetails']['id'] ?>')" style="color:#2556B9;text-decoration:underline;">Track the Order</a> -->
                        <a href="https://delhivery.com/track/package/<?=$order['waybill_generated'] ?>" style="color:#2556B9;text-decoration:underline;">Track the Order</a>

                   <?php  }?>
                    <?php
                         
                    if ($order['ordersdetails']['order_condition'] == '5') { ?>
                        <a onclick="re_order('<?= $order['ordersdetails']['session_id'] ?>')" style="color:#2556B9;text-decoration:underline;color: var(--unnamed-color-2556b9);
text-align: left;
text-decoration: underline;
font: normal normal 600 12px/15px Muli;
letter-spacing: 0px;
color: #2556B9;
opacity: 1;">Re-Order </a>
                       <?php $invoice= base_url() . "web/invoice/{$order['ordersdetails']['session_id']}";?>
                        <a href="<?php echo $invoice;?>" style="color:#2556B9;text-decoration:underline;color: var(--unnamed-color-2556b9);
text-align: left;
text-decoration: underline;
font: normal normal 600 12px/15px Muli;
letter-spacing: 0px;
color: #2556B9;
opacity: 1;">Invoice</a>
                    <span class="productprice1">
                    <?php 
                    // print_r($cartdata['status']);
                    if ($cartdata['refund_status'] == 1 && $cartdata['status'] == 0) { 
                    //     print_r($cartdata);
                    // exit;
                        ?>
                 
                    <!-- <button type="button" onclick="order_refund(<?php echo $cartdata['cartid']; ?>,<?php echo $cartdata['product_id']; ?>,<?php echo $order->order['ordersdetails']['id']; ?>')" class="btn btn-pink">Return</button> -->
                    <span class="refund_desktop"><a data-toggle="modal" data-target="#refundorder<?php echo $cartdata['cartid']; ?>" class="return_order">Return Order</a>
                    <div class="modal fade" id="refundorder<?php echo $cartdata['cartid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div id="refundorder">
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-body">

                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                    <div>
                                    <h4>Return</h4>
                                    </div>
                                <form class="form-horizontal" enctype="multipart/form-data">
                                    <div class="col-lg-12 col-md-12"><?php 
                                    // print_r($cartdata['cartid']);?>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="cart_id_<?php echo $cartdata['cartid']; ?>" value="<?php echo $cartdata['cartid']; ?>">
                                            <input type="hidden" class="form-control" id="product_id_<?php echo $cartdata['cartid']; ?>" value="<?php echo $cartdata['product_id']; ?>">
                                            <input type="hidden" class="form-control" id="order_id_<?php echo $cartdata['cartid']; ?>" value="<?php echo $order['ordersdetails']['session_id']; ?>">
                                            <input type="hidden" class="form-control" id="vendor_id_<?php echo $cartdata['cartid']; ?>" value="<?php echo $order['ordersdetails']['vendor_id']; ?>">
                                            <textarea name="message"  id="message_<?php echo $cartdata['cartid']; ?>" cols="20" cols="50" class="message" placeholder="Enter Reason For Return"></textarea>
                                            <div class="col-lg-12 center-div">
                                                <button type="button" class="btn btn-address" style="background-color:#2556B9;color:#ffff;justify-content: center;"  onclick="order_refund('<?php echo $cartdata['cartid']; ?>')">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php }?>
                                
                                <?php
                                // $return_data = $this->db->where(['session_id' => $data[0]->session_id, 'cartid' => $cartdata['cartid']])->get('refund_exchange')->row();
                                // var_dump($return_data);
                                // die();
                                if ($order['ordersdetails']['order_condition'] != 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 0) {
                                ?>
                                <div>
                                    <b style="color: green;">Return Request sent</b>
                                </div>
                                <?php } else if ($order['ordersdetails']['order_condition'] != 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 1) { ?>
                                    <div>
                                        <b style="color: blue;">Return accepted</b>
                                    </div>
                                    <?php } else if ($order['ordersdetails']['order_condition'] != 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 2) { ?>
                                        <div>
                                            <b style="color: red;">Return Rejected</b>
                                        </div>
                                        <?php } else if ($order['ordersdetails']['order_condition'] == 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 1) { ?>
                                            <div>
                                                <b style="color: green;">Returned</b>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </span>
                    <span class="refund_mobile"><a data-toggle="modal" data-target="#refundorder1<?php echo $cartdata['cartid']; ?>" class="return_order">Return Order</a>
                    <div class="modal fade" id="refundorder1<?php echo $cartdata['cartid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div id="refundorder">
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-body">

                                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                    <div>
                                    <h4>Return</h4>
                                    </div>

                                                                        <form class="form-horizontal" enctype="multipart/form-data"  >
                                                                            <div class="col-lg-12 col-md-12">

                                                                                <div class="form-group">
                                                                                    <input type="hidden" class="form-control" id="cart_id1_<?php echo $cartdata['cartid']; ?>" value="<?php echo $cartdata['cartid']; ?>">
                                                                                    <input type="hidden" class="form-control" id="product_id1_<?php echo $cartdata['cartid']; ?>" value="<?php echo $cartdata['product_id']; ?>">
                                                                                    <input type="hidden" class="form-control" id="order_id1_<?php echo $cartdata['cartid']; ?>" value="<?php echo $order['ordersdetails']['session_id']; ?>">
                                                                                    <input type="hidden" class="form-control" id="vendor_id1_<?php echo $cartdata['cartid']; ?>" value="<?php echo $order['ordersdetails']['vendor_id']; ?>">

                                                                                    <textarea name="message"  id="message1_<?php echo $cartdata['cartid']; ?>" cols="20" cols="50" class="message" placeholder="Enter Reason For Return"></textarea>
                                                                                    <div class="col-lg-12 center-div">
                                                                                        <button type="button" class="btn btn-address" style="background-color:#2556B9;color:#ffff;justify-content: center;" onclick="order_refund_mobile('<?php echo $cartdata['cartid']; ?>')">Submit</button>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                

                                                                   

                                                                    <?php
                                                                //    $return_data = $this->db->where(['session_id' => $data[0]->session_id, 'cartid' => $cartdata['cartid']])->get('refund_exchange')->row();
                                                                
                                                                  if ($order['ordersdetails']['order_condition'] != 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 0) {
                                                                        ?>
                                                                        <div>
                                                                            <b style="color: green;">Return Request sent</b>
                                                                        </div>
                                                                    <?php } else if ($order['ordersdetails']['order_condition'] != 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 1) { ?>
                                                                        <div>
                                                                            <b style="color: blue;">Return accepted</b>
                                                                        </div>
                                                                    <?php } else if ($order['ordersdetails']['order_condition'] != 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 2) { ?>
                                                                        <div>
                                                                            <b style="color: red;">Return Rejected</b>
                                                                        </div>
                                                                    <?php } else if ($order['ordersdetails']['order_condition'] == 7 && $cartdata['status'] == 1 && $order['ordersdetails']['return_refund_status'] == 1) {  ?>  
                                                                        <div>
                                                                            <b style="color: green;">Returned</b>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>   
                                                            </div>
                                                        </div>
                                                    </div>
                    </div>

                </span>
                    </span><?php }?>
                   
                    <span data-title="Rating" class="productprice1  rate_button" style="justify-content:end;float:right;">
                    <?php 
                    // if($order['ordersdetails']['review'] == ""){?>
                    <?php if (($order['ordersdetails']['review'] == "" || $order['ordersdetails']['comments'] == "") && $order['ordersdetails']['order_status'] == 'Delivered') { ?>
                    <h4 style="font-size:14px;">Rate the Product</h4><span><button type="button"  data-toggle="modal"  data-target="#exampleModal<?php echo $cartdata['product_id']; ?>" style=" background: transparent;border: none;padding: 0;margin: 0;cursor: pointer;"><?php for ($i = 0; $i <5; $i++) { ?>
                    <span><i class="fal fa-star" style="color:#FFD136"></i></span>
                    <?php } ?></button> </span>
                    <?php } else if ($order['ordersdetails']['review'] != "" && $order['ordersdetails']['comments'] != "") { ?>
                    <?php for ($i = 0; $i < $order['ordersdetails']['review']; $i++) { ?>
                    <span><i class="fas fa-star" style="color:#FFD136"></i></span>
                    <?php } ?>
                    <?php } else if($order['ordersdetails']['review'] !="" && $order['ordersdetails']['comments'] == ""){?>
                        <?php for ($i = 0; $i < $order['ordersdetails']['review']; $i++) { ?>
                    <span><i class="fas fa-star" style="color:#FFD136"></i></span>
                    <?php } ?>

                    </span>  
                  
                                                   
                    <?php } ?>                                 
                      

                       


                                                            
                <div class="modal fade" id="exampleModal<?php echo $cartdata['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div id="ratingModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-top:60%;">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                                        
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                                    </div>
                                    <form method="post" class="form-horizontal">
                                        <input type="hidden" class="form-control" id="pid<?php echo $cartdata['product_id']; ?>" value="<?php echo $cartdata['product_id']; ?>">
                                        <input type="hidden" class="form-control" id="order_id<?php echo $cartdata['product_id']; ?>" value="<?php echo $order['ordersdetails']['id']; ?>">
                                        <input type="hidden" class="form-control" id="vendor_id<?php echo $cartdata['product_id']; ?>" value="<?php echo $order['ordersdetails']['vendor_id']; ?>">
                                        <input type="hidden" class="form-control" id="user_id<?php echo $cartdata['product_id']; ?>" value="<?php echo $order['ordersdetails']['user_id']; ?>">
                                        <div class="rate">
                                            <input type="radio" name="rating" value="5" id="5_<?php echo $cartdata['product_id']; ?>"><label for="5_<?php echo $cartdata['product_id']; ?>">☆</label>
                                            <input type="radio" name="rating" value="4" id="4_<?php echo $cartdata['product_id']; ?>"><label for="4_<?php echo $cartdata['product_id']; ?>">☆</label>
                                            <input type="radio" name="rating" value="3" id="3_<?php echo $cartdata['product_id']; ?>"><label for="3_<?php echo $cartdata['product_id']; ?>">☆</label>
                                            <input type="radio" name="rating" value="2" id="2_<?php echo $cartdata['product_id']; ?>"><label for="2_<?php echo $cartdata['product_id']; ?>">☆</label>
                                            <input type="radio" name="rating" value="1" id="1_<?php echo $cartdata['product_id']; ?>"><label for="1_<?php echo $cartdata['product_id']; ?>">☆</label>
                                        </div>
                                        <div class="form-group comments">
                                            <label for="id" style="display:flex;padding:2px 0px 10px 0px;margin: 0px;color: #333;font-size: 17px;font-weight: bold;z-index: 9999; position: relative">Comments</label>
                                            <textarea class="form-control" id="comments<?php echo $cartdata['product_id']; ?>" placeholder="Enter your comment" name="comments"></textarea>
                                        </div>
                                        <button type="button" onclick="reviewForm('<?php echo $cartdata['product_id']; ?>')" class="btn btn-primary" style="background-color:#2556B9;color:#ffff;margin-left:15px;border-color: #2556B9;">Submit </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div></div>    
                    </div> 
                    



































































            <?php }?>
              <?php }?>
                                        </div> 
                                        
                                    </div>  
                                    <?php if ($countpro == 0) { ?>
                                        <div class="col-lg-10 orderempty" style="display:none;"><center><img src="<?php echo base_url();?>web_assets/img/dog.png"/>  <div class="cart_page" style=" display: flex;
            justify-content: center;
            align-items: center; margin: 0;
            padding: 0;"><a class="btn-shop" href="<?php echo base_url(); ?>">START SHOPPING!</a> </div></center>
                        <!-- <center> -->
                            <!-- <div class="cart_page" style=" display: flex;
            justify-content: center;
            align-items: center; margin: 0;
            padding: 0;"> -->
                                
                                   
                                
                            <!-- </div> -->
                        </div><br><br><br><br><br><br><br><br><br><br><br>
                        <!-- </center>  -->
                           
                    <?php } ?>  
    </div>
                   
                    </div>
                    
</div>
</div>
           
        
    
</section>
<!--about section end-->

<script   src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script async defer  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
    function validateForm(id) {
        $('.error').remove();
        var errr = 0;

        var oid = $('#oid' + id).val();

        var radioValue = $("input[name='rating']:checked").val();
        var comments = $('#comments' + id).val();
        //alert(oid); alert(radioValue); alert(comments); 

        $.ajax({
            url: "<?= base_url(); ?>web/review",
            method: "POST",
            data: {oid: oid, radioValue: radioValue, comments: comments},
            success: function (data)
            {

                if (data == '@success') {
                    alert('review done');
                    location.reload();
                } else {
                    alert('failed');
                    location.reload();
                }
            }
        });
    }
  
</script>

<style>
    /*    body{
    background: #222225;
    color: white;
    margin: 100px auto;
    }*/
</style>

<script type="text/javascript">

    var current_session_id = '<?= $_SESSION['session_data']['session_id']; ?>';
    function re_order(session_id)
    {
        //var session_vendor_id = $("#vendor_id").val();

        //var session_id = $("#session_id").val();
        //var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';

        //alert(user_id);
        //alert(variant_id); alert(vendor_id); alert(saleprice); alert(quantity); alert(session_vendor_id);

        $('.error').remove();
        var errr = 0;

        $.ajax({
            url: "<?php echo base_url(); ?>web/re_order",
            method: "POST",
            data: {session_id: session_id},
            success: function (data)
            {
                var res = $.parseJSON(data);
                var count = 0;
                if (res.length > 0) {
                    $.each(res, function (key, val) {
                        var variant_id = val.variant_id;
                        var vendor_id = val.vendor_id;
                        var saleprice = val.price;
                        var quantity = val.quantity;
                        $.ajax({
                            url: "<?php echo base_url(); ?>web/re_addtocart",
                            method: "POST",
                            data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: current_session_id},
                            success: function (data)
                            {
                                var str = data;
                                var res = str.split("@");
                                if (res[1] == 'success')
                                {
                                    count += 1;
                                    $('#cart_count').html(count);
                                    toastr.success("Added to cart!");

                                } else if (res[1] == 'shopclosed')
                                {
                                    toastr.error("Shop Closed!")
                                } else
                                {
                                    toastr.error("OUT OF STOCK!")
                                }
                            }
                        });
                    });
                    setTimeout(function () {
                        location.href = '<?= base_url() ?>web/checkout';
                    }, 2000);
                } else {
                    toastr.error("Products not available for sale!");
                }
            }
        });


    }

    function checkTrackingStatus(order_id) {
    $('.error').remove();
    var errr = 0;
    console.log(order_id);

    $.ajax({
        url: "<?php echo base_url(); ?>web/checkTrackingStatus",
        method: "POST",
        data: { order_id: order_id },
        dataType: "json", // Specify the expected data type
        success: function (response) {
            console.log(response)
            if (response && response.status === 'success') {
                // Process successful response
                console.log('Tracking status:', response.data.ShipmentData);

                // Redirect to the tracking URL
                var awbNumber = response.data.ShipmentData[0].Shipment.AWB;
 // Replace with the actual property name in your response
                var trackingUrl = "https://delhivery.com/track/package/" + awbNumber;
                window.location.href = trackingUrl;
            } else {
                console.error('Error:', response ? response.error : 'Unknown error');
                // Handle error, show a message, etc.
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', error);
            console.log('XHR:', xhr);
            console.log('Status:', status);
            // Handle AJAX error, show a message, etc.
        }
    });
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

                    swal("Product added to cart!")
                } else if (res[1] == 'shopclosed')
                {

                    swal("Shop Closed!")
                } else
                {
                    swal("OUT OF STOCK!")
                }
            }
        });
    }

   
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
                                    if (radioValue != '') {
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
                                        toastr.error('Please select a rating');
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
                                    // if (radioValue != '' && comments != '') {
                                    if (radioValue != '') {
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
                                        toastr.error('Please select a rating');
                                        return false;
                                    }
                                }


</script>
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
                                    // $('html, body').animate({
                                        // scrollTop: $('#move_to_top_scroll').offset().top - 100
                                    // }, 'slow');

                                    if (res[1] == 'success')
                                    {
                                        // swal("Your return Request sent Successfully");
                                        toastr.success("Your return Request sent Successfully");
                                        $('#refundorder').hide();
                                        setTimeout(function () {
                                                                location.reload();
                                                            }, 1000);
                                    } else
                                    {
                                        swal("Something went wrong , please try again");
                                        toastr.error("something wents wrong");
                                    }

                                }
                            });


                        } else {

                            swal("Cancelled", "", "error");
                            toastr.error("something wents wrong");

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
                                    // $('html, body').animate({
                                        // scrollTop: $('#move_to_top_scroll').offset().top - 100
                                    // }, 'slow');

                                    if (res[1] == 'success')
                                    {
                                        toastr.success("Your return Request sent Successfully");
                                        $('#refundorder1').hide();
                                        setTimeout(function () {
                                                                location.reload();
                                                            }, 1000);
                                    } else
                                    {
                                        swal("Something went wrong , please try again");
                                        toastr.error("something wents wrong");
                                    }

                                }
                            });


                        } else {

                            swal("Cancelled", "", "error");
                            toastr.error("something wents wrong");

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function(e) {
            // Get the count value from PHP
            var count = <?php echo $countpro; ?> ;
            
            // Check the count and hide/show the div accordingly
            if (count > 0) {
                $('.mycontainer').show();
                $('.order_page').show();
                $('.order_header').show();
                $('.orderempty').hide();
            } else {
                $('.mycontainer').hide();
                $('.order_page').hide();
                $('.order_header').hide();
                $('.orderempty').show();
            }
        });
    </script>
    