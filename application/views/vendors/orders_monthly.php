<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                    </div>
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
                </div>
                


                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-12">    

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=2">
                                    <div class="widget style1 <?= $this->input->get('status') == 2 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                              $end_date = date('Y-m-d');
                                              $start_date = date('Y-m-d', strtotime('-1 month', strtotime($end_date)));
                                              $where_accept=array(
                                                'order_status' => 2, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_accept = $this->common_model->count_rows_with_conditions('orders',$where_accept );
                                            // print_r($in_accept);die;
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Accepted  </span>
                                                <h2 class="font-bold"><?php echo $in_accept; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php 
                            // echo "<pre>";
                            // print_r($orders);
                            // exit;?>
                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=3">
                                    <div class="widget style1 <?= $this->input->get('status') == 3 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                             $where_courier=array(
                                                'order_status' => 3, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_courier = $this->common_model->count_rows_with_conditions('orders', $where_courier);
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Assign To Courier  </span>
                                                <h2 class="font-bold"><?php echo $in_courier; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php $vend_qry=$this->db->query("select * from vendor_shop where id='".$shop_id."'");
                            $vendor_qry_res=$vend_qry->row();
                            // print_r($vendor_qry_res->delivery_partner);
                            if($vendor_qry_res->delivery_partner == 'delhivery'){?>
                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=8">
                                    <div class="widget style1 <?= $this->input->get('status') == 8 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                             $where_pick=array(
                                                'order_status' => 8, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_returned = $this->common_model->count_rows_with_conditions('orders', $where_pick);
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Pick up  </span>
                                                <h2 class="font-bold"><?php echo $in_returned; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php }?>
                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=4">
                                    <div class="widget style1 <?= $this->input->get('status') == 4 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                             $where_shipped=array(
                                                'order_status' => 4, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_shipped = $this->common_model->count_rows_with_conditions('orders', $where_shipped);
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Shipped  </span>
                                                <h2 class="font-bold"><?php echo $in_shipped; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=5">
                                    <div class="widget style1 <?= $this->input->get('status') == 5 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                            $where_delivered=array(
                                                'order_status' => 5, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_delivered = $this->common_model->count_rows_with_conditions('orders', $where_delivered);
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Delivered  </span>
                                                <h2 class="font-bold"><?php echo $in_delivered; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>    

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=6">
                                    <div class="widget style1 <?= $this->input->get('status') == 6 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                            $where_cancel=array(
                                                'order_status' => 6, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_cancelled = $this->common_model->count_rows_with_conditions('orders', $where_cancel);
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Cancelled  </span>
                                                <h2 class="font-bold"><?php echo $in_cancelled; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div> 

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>vendors/orders_monthly?status=7">
                                    <div class="widget style1 <?= $this->input->get('status') == 7 ? 'navy-bg' : 'blue-bg' ?>">
                                        <div class="row">
                                            <?php
                                            $where_return=array(
                                                'order_status' => 7, 'vendor_id' => $shop_id,
                                                'order_date >=' => $start_date, // Start date should be earlier than or equal to end_date
                                                'order_date <=' => $end_date
                                              );
                                            $in_returned = $this->common_model->count_rows_with_conditions('orders', $where_return);
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Returned  </span>
                                                <h2 class="font-bold"><?php echo $in_returned; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <form method="get" action="<?= base_url() ?>vendors/orders_monthly" id="filter_purchase_form">
                        <div class="form-group row">
                            <div class="row">
                            <div class="col-sm-4"><label for="keyword" clxass="caption">Order ID</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-file-text-o" aria-hidden="true"></span></div>
                                    <input class="form-control input-sm w-50 border-primary" type="text" name="keyword" placeholder="Enter Order ID / Transaction ID" value="<?= $filter_keyword != "" ? $filter_keyword : "" ?>" style="width:310px;">
                                </div>
                            </div>
                            <div class="col-sm-4"><label for="invocieno" class="caption">From Date : </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-file-text-o" aria-hidden="true"></span></div>
                                    <input value="<?= $filter_from_dt != "" ? $filter_from_dt : "" ?>" type="date" max="<?= date('Y-m-d') ?>" class="form-control" name="from_date" onchange="setTodate(this)">
                                </div>
                            </div>
                            <div class="col-sm-4"><label for="invocieno" class="caption">To Date :</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-bookmark" aria-hidden="true"></span></div>
                                    <input value="<?= $filter_to_dt != "" ? $filter_to_dt : "" ?>" type="date" max="<?= date('Y-m-d') ?>" class="form-control" name="to_date" id="to_date" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="submit" class="btn btn-success mt-2" value="Search">&nbsp;&nbsp;
                                    <a href="<?= base_url() ?>vendors/orders_monthly"><input type="button" class="btn btn-danger mt-2" name="reset" value="Reset"></a>&nbsp;&nbsp;
                                    <input type="hidden" id="hidden_filed" value="">
                                   
                
                                </div>
                            </div>
                           
                        </div>
                       
                    </div>
                    </form>
                    <hr/>
<div class="ibox-content">
              
 <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>User Details</th>
                                    <th>Delivery address</th>
                                    <th>Payment Option</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>order Date</th>
                                    <th>Order Amount</th>
                                    <th>Delivery shipping Cost</th>
                                    <th>Shipping charge</th>
                                    <th>Admin Commission</th>
                                    <th>GST</th>
                                    <th>Vendor Price: </th>
                                     <th>Delivery Date</th>
                                     <th>Membership Plan</th>
                                    <?php
                                    //  if($vendor_qry_res->delivery_partner == 'delhivery'){?>
                                     <!-- <th>shipping cost</th> -->
                                     <?php
                                    //  }?>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($i == "") {
                                    $i = 1;
                                }
                                if ($orders !== null && count($orders) > 0) {
                                    foreach ($orders as $ord) {
                                        // echo "<pre>";
                                        // print_r($ord);
                                        // exit;
                                        $user = $this->db->query("select * from users where id='" . $ord->user_id . "'");
                                        $users = $user->row();

                                        $delhivery_name_qry=$this->db->query("select delivery_partner from vendor_shop where id='".$ord->vendor_id."'");
                                        $delhivery_name_res=$delhivery_name_qry->row();
                                        // print_r($delhivery_name);
                                        $delhivery_name=$delhivery_name_res->delivery_partner;
                                        // print_r($delhivery_name);

                                        $ads = $this->db->query("select * from user_address where id='" . $ord->deliveryaddress_id . "'");
                                        $address = $ads->row();
                                        // print_r($address);die;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $ord->session_id; ?></td>
                                            <td>
                                                <?php if ($user->num_rows() > 0) { ?>
                                                    <b>Name : </b><?php echo $users->first_name . " " . $users->last_name; ?><br>
                                                    <b>Email : </b><?php echo $users->email; ?><br>
                                                    <b>Phone : </b><?php echo $users->phone; ?>
                                                <?php } ?>
                                            </td>

                                            <td><?php echo $ord->user_address; ?>
                                                <!-- <?php echo $address->locality; ?>,<br>
                                                <?php echo $address->city; ?>,<br>
                                                <?php echo $address->state; ?>,<br>
                                                <?php echo $address->pincode; ?>,<br>
                                                <?php
                                                if ($address->address_type == 1) {
                                                    echo "Home";
                                                } else if ($address->address_type == 2) {
                                                    echo "Office";
                                                } else if ($address->address_type == 3) {
                                                    echo "Others";
                                                }
                                                ?><br> -->
                                            </td>

                                            <td><?php echo $ord->payment_option; ?></td>
                                            <td><?php
                                                if ($ord->payment_status == 1) {
                                                    echo "Paid";
                                                } else {
                                                    echo "Unpaid";
                                                }
                                                ?></td>
            <!--                                <td><?php
                                            if ($ord->order_status == 1) {
                                                echo "Pending";
                                            } else if ($ord->order_status == 2) {
                                                echo "Proccessing";
                                            } else if ($ord->order_status == 3) {
                                                echo "Assigned to delivery to pick up";
                                            } else if ($ord->order_status == 4) {
                                                echo "Delivery Boy On the way";
                                            } else if ($ord->order_status == 5) {
                                                echo "Delivered";
                                            } else if ($ord->order_status == 6) {
                                                echo "Cancelled";
                                            }
                                            ?>
                                            <?php if ($ord->order_status == 1 || $ord->order_status == 2) { ?>
                                                                        <select name="status" onchange="updateStatus(this.value,'<?php echo $ord->id; ?>')">
                                                                            <option value="1" <?php
                                                if ($ord->order_status == 1) {
                                                    echo "selected='selected'";
                                                }
                                                ?>>Pending</option>
                                                                            <option value="2" <?php
                                                if ($ord->order_status == 2) {
                                                    echo "selected='selected'";
                                                }
                                                ?>>Accept SELF Delivery</option>
                                                                            <option value="3" <?php
                                                if ($ord->order_status == 3) {
                                                    echo "selected='selected'";
                                                }
                                                ?>>Accept and Assign Sector6 Delivery</option>
                                                                            <option value="6" <?php
                                                if ($ord->order_status == 6) {
                                                    echo "selected='selected'";
                                                }
                                                ?>>Cancel</option>
                                                                        </select>
                                            <?php } ?>
                                            </td>-->
                                            
                                            <td>
                                                <?php if ($ord->order_status == 1) { ?>

                                                    <a onclick="return confirm('Are you sure You want to accept this product?')" href="<?php echo base_url(); ?>vendors/orders_monthly/view_aceept_status/<?php echo $ord->id; ?>"><button class="btn btn-xs btn-info"><i class="fa fa-check" aria-hidden="true"></i>  Accept </button></a>


                                                    <a onclick="return confirm('Are you sure You want to cancel this product?')" href="<?php echo base_url(); ?>vendors/orders_monthly/cancel_status/<?php echo $ord->id; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-ban"></i>  Cancel </button></a>
                                                <?php } else if ($ord->order_status == 6) { ?>

                                                    <button class="btn btn-xs btn-danger"><i class="fa fa-ban"></i>  Cancelled </button>
                                                <?php } else if ($ord->order_status == 2) { ?>
                                                   
                                                    <a class="btn btn-xs btn-success">Accepted</a>
<?php 
// $qry_delhievry=$this->db->query("select * from vendor_shop where id='".$ord->vendor_id."'");
// $qry_delhievry_res=$qry_delhievry->row();
// print_r($qry_delhievry_res->delivery_partner);
// $delhivery_part=$qry_delhievry_res->delivery_partner;
?>

<?php if($delhivery_name=='self'){?>
                                                    <a onclick="return confirm('Are you sure you want to assign to Courier?')" href="<?php echo base_url(); ?>vendors/orders_monthly/assigned_deliveryBoy/<?php echo $ord->id; ?>"><button class="btn btn-info" title="Change Assign to Courier"> Assign to Courier </button></a><br><br>
                                                   
                                                    <!-- <select class="courierSelection" data-ordid="<?php echo $ord->id; ?>">
        <option value="">Select Delivery Partner</option>
        <option value="delhivery">Delhivery</option>
    </select><br><br> -->
<?php }else if($delhivery_name=='delhivery'){?>
    <form method="post" action="<?php echo base_url(); ?>vendors/orders_monthly/ordercreate/<?php echo $ord->id; ?>" class="delhiveryForm" data-ordid="<?php echo $ord->id; ?>">
        <!-- Your form elements here -->
        <input type="text" name="shipment_length" placeholder="Enter shipment length" class="form-control"><br><br>
        <input type="text" name="shipment_width" placeholder="Enter shipment width" class="form-control"><br><br>
        <input type="text" name="shipment_height" placeholder="Enter shipment height" class="form-control"><br><br>
        <input type="text" name="weight" placeholder="Enter shipment weight" class="form-control"><br><br>
        <select class="form-control" name="mode" id="mode">
                        <option value="">Select way of transport</option>
        
        <option value="E">Express</option>
        <option value="S">Surface</option>
    
    </select><br><br>
        <select class="form-control" name="delivery_id" style="width:200px;">
            <option value="">Select warehouses</option>
        <?php
    $vendors = $this->db->query("select * from warehouses where vendor_id='".$ord->vendor_id."'");
    $vendor_list = $vendors->result();
    foreach ($vendor_list as $vendor) {
    ?>
        <option value="<?php echo $vendor->warehouse_name; ?>"><?php echo $vendor->warehouse_name; ?></option>
    <?php
    }
    ?>
    </select>
<br><br>

    <button class="btn btn-info" title="Change Assign to Courier" type="submit" onclick="return confirm('Are you sure you want to assign to Courier?')"> Assign to Courier </button>
</form><?php }?>



                                                <?php } else if ($ord->order_status == 3) { ?>
                                                    <a class="btn btn-xs btn-success">Assigned to Courier</a>
                                                    <?php $update_qry=$this->db->query("select waybill_generated from orders where id='".$ord->id."'");

$update_qry_res=$update_qry->row();
$waybillgenerated=$update_qry_res->waybill_generated;
// print_r($waybillgenerated);
?>
                                                    <?php 
if($delhivery_name=='self'){?>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" title="Change to shipped"  data-target="#exampleModal<?php echo $ord->id; ?>">Shipment</button>
                                                    
                                                    <?php }
                                                    else if($delhivery_name=='delhivery' && $waybillgenerated!=''){
                                                    ?>
                                                     <a href="<?php echo base_url(); ?>vendors/orders_monthly/update_order/<?php echo $ord->id; ?>/<?php echo $waybillgenerated;?>" class="btn btn-warning" title="update order">update Order</a>
                                                    
                                                    <?php }  ?>
                                                    
                                                    <?php

// print_r($ord);

$db_qry = $this->db->query("SELECT * FROM pickup_table WHERE status='active'");
$result_query1 = $db_qry->result();
// print_r($result_query1[0]->pickup_id);
$displayButton = false;
$count=0;
foreach ($result_query1 as $res) {
    $status = $res->status;
    $pickup_id = $res->pickup_id;
    $order_array = json_decode($res->order_array, true);
    // print_r($res->warehouse_name);
    // print_r($pickup_id);
    // print_r($order_array);
$count++;
    if (
        (!empty($order_array) && in_array($ord->session_id, $order_array))
        && $delhivery_name != 'delhivery'
        && $waybillgenerated == ''
    ) {
        $displayButton = false; 
        break; 
    } else {
        $displayButton = true;
    }
}
// echo $pickup_id;
// Check if the button should be displayed
// echo $displayButton;
// print_r(empty($order_array));
$order_details_qry=$this->db->query("select * from order_details where order_id='".$ord->id."'");
$order_details_qry_res=$order_details_qry->row();
// print_r($order_details_qry_res->warehouse_name);
 $warehouse_name = $order_details_qry_res->warehouse_name;

// Sanitize the warehouse name to allow only alphanumeric characters, dashes, and underscores
$warehouse_name = preg_replace('/[^a-zA-Z0-9-_]/', '', $warehouse_name);

// Encode the sanitized warehouse name
$warehouse_name_encoded = urlencode($warehouse_name);
if ($displayButton && $delhivery_name == 'delhivery' && $waybillgenerated!=''&& $count==1 && $order_details_qry_res->warehouse_name==$result_query1[0]->warehouse_name) {
    ?>
    <button type="button" class="btn btn-primary text-white" title="add to pickup request">
  
        <a href="<?php echo base_url(); ?>vendors/orders_monthly/addOrderDetails/<?php echo $ord->id; ?>/<?php echo $result_query1[0]->pickup_id; ?>/<?php echo $ord->session_id;?>/<?php echo $warehouse_name_encoded;?>" style="color:white;">Add to pickup</a>
    </button>
    <?php
}
else if($displayButton && $delhivery_name == 'delhivery' && $waybillgenerated!=''&& $count>1){
foreach ($result_query1 as $res) {
    if($res->warehouse_name==$order_details_qry_res->warehouse_name){
    // print_r($res->warehouse_name);?>
<button type="button" class="btn btn-primary text-white" title="add to pickup request">
        <a href="<?php echo base_url(); ?>vendors/orders_monthly/addOrderDetails/<?php echo $ord->id; ?>/<?php echo $res->pickup_id; ?>/<?php echo $ord->session_id;?>/<?php echo $warehouse_name_encoded;?>" style="color:white;">Add to pickup</a>
    </button>
<?php } } }
?>




                                                    <?php 
                                                    $qry_waybill=$this->db->query("select waybill_generated from orders where id='".$ord->id."'");
                                                        $waybill_qry=$qry_waybill->row();
                                                        $waybill=$waybill_qry->waybill_generated;
                                                        // echo "<pre>";
                                                        // print_r($waybill);
                                                        // exit;?>
                                                        <?php if($waybill!='' &&  $delhivery_name=='delhivery'){?>
                                                    <!-- <button type="button" class="btn btn-info" id="downloadLabelBtn" data-waybill="<?php echo $waybill; ?>" title="Print the label">Download PDF</button> -->
                                                    <a href="<?php echo base_url(); ?>vendors/orders_monthly/shippingLabelGeneration/<?php echo $waybill; ?>/<?php echo $ord->id;?>" class="btn btn-info" title="Print the label">Download PDF</a>        
                                                    <?php }?>
                                                    
                                                          
                                                <?php }
                                               

                                                  else if ($ord->order_status == 8) {?>
                                                   
                                                    <a class="btn btn-xs btn-success">Pickup</a>
                                               <?php      $update_qry=$this->db->query("select waybill_generated from orders where id='".$ord->id."'");

$update_qry_res=$update_qry->row();
$waybillgenerated=$update_qry_res->waybill_generated; 
// if($waybillgenerated!='' && $vendor_qry_res->delivery_partner == 'delhivery'){?>
                                                    <!-- <a href="<?php echo base_url(); ?>vendors/orders_monthly/shipment_delhivery/<?php echo $ord->id; ?>" class="btn btn-danger" title="Change to shipped">Shipment</a> -->
                                             <?php   
                                             }

                                                else if ($ord->order_status == 4) { ?>
                                                    <a class="btn btn-xs btn-success">Order Shipped</a>
                                                    <a onclick="return confirm('Are you sure you want to Complete this order?')" href="<?php echo base_url(); ?>vendors/orders_monthly/view_complete_status/<?php echo $ord->id; ?>"><button class="btn btn-warning" title="Change to Delivered"> Complete </button></a>

                                                    <p><b>Courier Name :</b><?= $ord->tracking_name; ?></p>
                                                    <p><b>Courier ID :</b><?= $ord->tracking_id; ?></p>
                                                    <?php
                                                } else if ($ord->order_status == 5) {
                                                    $chk = $this->db->where(['session_id' => $ord->session_id, 'vendor_id' => $ord->vendor_id])->get('refund_exchange')->num_rows();
                                                    if ($chk == 0) {
                                                        ?>
                                                        <button class="btn btn-xs btn-primary"> Delivered </button>
                                                        <?php
                                                    } else {
                                                        $chk_zero = $this->db->where(['session_id' => $ord->session_id, 'vendor_id' => $ord->vendor_id, 'status' => 0])->get('refund_exchange')->num_rows();
                                                        $chk_one = $this->db->where(['session_id' => $ord->session_id, 'vendor_id' => $ord->vendor_id, 'status' => 1])->get('refund_exchange')->num_rows();
                                                        ?>
                                                        <button class="btn btn-xs btn-warning"><?php
                                                            if ($chk_zero > 0) {
                                                                echo 'Return Request';
                                                            } else if ($chk_one > 0) {
                                                                echo 'Return Accepted';
                                                            } else {
                                                                echo 'Return Rejected';
                                                            }
                                                            ?></button>
                                                    <?php } ?>
                                                    <p><b>Courier Name :</b><?= $ord->tracking_name; ?></p>
                                                    <p><b>Courier ID :</b><?= $ord->tracking_id; ?></p>
                                                <?php } else if ($ord->order_status == 7) { ?>
                                                    <button class="btn btn-xs btn-warning"> Returned </button> 
                                                <?php } ?>
                                            </td>
                                            <td>
                                               
                                            <b>Ordered On: </b><?php echo date('d-m-Y', strtotime($ord->order_date)); ?>
                                            </td>
                                            
                                            <td><?php echo number_format($ord->sub_total, 2); ?>
                                                </td>
                                                <td>
                                                <?php 
                                                // print_r($ord->id);
                                                $ship_query=$this->db->query("select * from order_details where order_id='".$ord->id."'");
                                                $ship_query_res=$ship_query->row();
                                                print_r($ship_query_res->ship_cost);
                                                ?>
                                                </td>
                                                <td>
                                                    <?php echo $ord->deliveryboy_commission;?>
                                                </td>
                                                <td>
                                                <span style="color:red"><?php echo number_format($ord->admin_commission, 2); ?></span>
                                                </td>
                                                <td>
                                                <?php echo number_format($ord->gst, 2); ?>
                                                </td>
                                                <td>
                                                <?php echo number_format($ord->vendor_commission, 2); ?>
                                                </td>
                                                <td><?= date('d-m-Y h:i A',strtotime($ord->created_date)) ?></td>
                                            <?php 
                                            // if($vendor_qry_res->delivery_partner == 'delhivery'){?>
                                            <!-- <td><a href="#">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#shippingModal_<?php echo $ord->id;?>" data-pin="<?php echo $address->pincode;?>" data-ord-id="<?php echo $ord->id; ?>">
                                            Shipping Cost
                                            </button>

                                                </a><span id="shipValue"></span>
                                   

                                                
                                            </td> -->
                                            <?php 
                                        // }?>
                                         <td>
                                         <?php
                                                $qry=$this->db->query("select * from users where id='".$ord->user_id."'");
                                                $user_qry_res=$qry->row();
                                                $date= date('Y-m-d');
                                                
                                                if($user_qry_res->membership == 'yes'&& $user_qry_res->plan != '' && $user_qry_res->plan!='0' && $user_qry_res->plan!=0 && $user_qry_res->plan!=null && $user_qry_res->expiry_member_date >= $date && $user_qry_res->created_member_date <= $date){
                                                    echo "Rs.". $user_qry_res->plan;
                                                }
                                                else{?>
                                                    NA
                                              <?php  }
                                                
                                                ?>
                                            </td>
                                            <td><a href="<?php echo base_url(); ?>vendors/orders_monthly/orderDetails/<?php echo $ord->id; ?>">
                                                    <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button>
                                                </a></td>
                                                
                                        </tr>

                                        <!-- <div class="modal fade" id="shippingModal_<?php echo $ord->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Shipping Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="shippingForm">
                <p id="pincodeDisplay"></p>
                    <div class="form-group">
                        <label for="weight">Enter shipment weight:</label>
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter shipment weight">
                    </div>
                    <div class="form-group">
                        <label for="mode">Enter shipment mode:</label>
                       
                        <select class="form-control" name="mode" id="mode">
                        <option value="">Select way of transport</option>
        
        <option value="E">Express</option>
        <option value="S">Surface</option>
    
    </select>
                    </div>
                    <div class="form-group">
            <?php $address = $ord->user_address;
            $pattern = '/\b\d{6}\b/';


preg_match_all($pattern, $address, $matches);


$lastPincode = end($matches[0]);

?>
                <input type="hidden" class="form-control" value="<?php echo $lastPincode;?>" name="pincode" id="pincode_<?php echo $ord->id; ?>" readonly>
            </div>
                    <div class="form-group">
                    <select class="form-control" name="delivery_val" id="delivery_val">
            <option value="">Select warehouses</option>
        <?php
    $vendors = $this->db->query("select * from warehouses where vendor_id='".$ord->vendor_id."'");
    $vendor_list = $vendors->result();
    foreach ($vendor_list as $vendor) {
    ?>
        <option value="<?php echo $vendor->warehouse_name; ?>"><?php echo $vendor->warehouse_name; ?></option>
    <?php
    }
    ?>
    </select></div>
                    <button type="button" class="btn btn-info" onclick="submitShippingForm('<?php echo $lastPincode;?>')">Calculate Shipping Cost</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
                                        
                                    <div class="modal fade" id="exampleModal<?php echo $ord->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <!--        <h5 class="modal-title" id="exampleModalLabel">Shipment</h5>-->
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!--      <div class="modal-body">
                                                        ...
                                                      </div>-->
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/orders_monthly/shipment">
                                                    <div class="form-group">
                                                       
                                                        <input type="hidden" class="form-control" id="id"  name="id" value="<?php echo $ord->id; ?>"> 
                                                        <label for="id" style="margin-left:30px">Tracking Name:</label>
                                                        <input type="text" class="form-control" style="margin-left: 32px; width: 90%;" id="tracking_name_<?php echo $ord->id; ?>" placeholder="Enter Tracking Name" name="tracking_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id" style="margin-left:30px">Tracking ID:</label>
                                                        <input type="text" class="form-control" style="margin-left: 32px; width: 90%;" id="tracking_id_<?php echo $ord->id; ?>" placeholder="Enter Tracking ID" name="tracking_id" value="<?php echo $waybill->waybill_generated; ?>">
                                                    </div>

                                                    <button type="submit" style="margin-left: 30px;margin-bottom: 10px;" class="btn btn-primary">Submit </button>
                                                </form>

                                                <div class="modal-footer">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="14" style="text-align: center">
                                        <h4>No Orders Found</h4>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
</div>
</div>
                    <div class="pagination-bx  clearfix ">
                        <?= $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
  

    function updateStatus(value, order_id)
    {
        if (value != '')
        {
            $.ajax({
                url: "<?php echo base_url(); ?>/vendors/orders_monthly/changeStatus",
                method: "POST",
                data: {value: value, order_id: order_id},
                success: function (data)
                {
                    if (data == 'success')
                    {
                        alert("status changed successfully");
                        window.location.href = "<?php echo base_url(); ?>vendors/orders_monthly";
                    }
                }
            });
        }
    }

var isPickupIdGenerated = false;

// function pickupRequest(pickupdate, pickuptime, warehouse, count, vendorId) {
//     // Perform actions with selectedDate, selectedTime, vendorId
//     console.log("Selected Date: " + pickupdate);
//     console.log("Selected Time: " + pickuptime);
//     console.log("Vendor ID: " + vendorId);
//     console.log("warehousename:" + warehouse);
//     console.log("count:" + count);
//     // console.log($('#order<?php echo $ord->id; ?>').val());

//     if (pickupdate != '' && pickuptime != '' && warehouse != '' && count != '') {
//         $('#pk_up').prop('disabled', true);

//         $.ajax({
//             url: "<?php echo base_url(); ?>/vendors/orders_monthly/setLocation",
//             method: "POST",
//             data: { pickupdate: pickupdate, pickuptime: pickuptime, warehouse: warehouse, count: count, vendorId: vendorId},
            
//             success: function (responseData) {
//                 console.log(responseData);
//                 var data=responseData;
               
//                 if (responseData.incoming_center_name !='' && responseData.pickup_location_name) {
//                     // if(data=="@success"){
//                     alert("Pickup Request sent");

//                     pickupId = responseData.pickup_id;

//                     // Enable the button
//                     isPickupIdGenerated = true;
//                     // }
//                 } 
//                 else if (!responseData.success && responseData.pr_exist) {
//                     var errorMessage = responseData.error.message;
//                     alert("Failed to send Pickup Request. " + errorMessage);
//                     $('#pk_up').prop('disabled', false);
//                 }

//                 else {
//                     alert("Failed to send Pickup Request");
//                     // $('#pk_up').prop('disabled', false);
//                 }
//             },
//             error: function () {
//                 alert("Error occurred while sending Pickup Request");
//                 // $('#pk_up').prop('disabled', false);
//             }
//         });
//     }
// }
$(document).ready(function() {
    // Enable the button if the pickup ID is not generated
    if (!isPickupIdGenerated) {
        $('#pk_up').prop('disabled', false);
    }
});

// document.getElementById('downloadLabelBtn').addEventListener('click', function() {
//     // Get the waybill number from the button attribute
//     var waybillNumber = this.getAttribute('data-waybill');
//     console.log(waybillNumber);

//     // Make an AJAX request to the server
//     <?php 
//         $qry_waybill = $this->db->query("select waybill_generated from orders where id='".$ord->id."'");
//         $waybill_qry = $qry_waybill->result();
//         $waybill = $waybill_qry[0];

//         $apiUrl = SHIPPING_LABEL_URL;
//         $api_key = TEST_KEY;
//         $pdf = "true";

//         // Data to be sent in the request
//         $data = ['wbns' => $waybill->waybill_generated, 'pdf' => $pdf];

//         // cURL setup
//         $ch = curl_init($apiUrl . '?' . http_build_query($data));
//         curl_setopt($ch, CURLOPT_HTTPGET, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//             'Content-Type: application/json',
//             'Authorization: Token ' . $api_key
//         ));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//         // Execute cURL request
//         $response = curl_exec($ch);

//         // Check for cURL errors
//         if (curl_errno($ch)) {
//             echo 'console.error("Curl error: ' . curl_error($ch) . '");';
//         } else {
//             $res = json_decode($response, true);

//             if (isset($res['packages']) && is_array($res['packages']) && !empty($res['packages'])) {
//                 // Loop through each package in the array
//                 foreach ($res['packages'] as $package) {
//                     // Check if 'pdf_download_link' exists for the current package
//                     if (isset($package['pdf_download_link'])) {
//                         // Create a hidden link with the download attribute and trigger a click
//                         echo 'var link = document.createElement("a");';
//                         echo 'link.href = "' . $package['pdf_download_link'] . '";';
//                         echo 'link.download = "' . $waybillNumber . '.pdf";';
//                         echo 'link.style.display = "none";';
//                         echo 'document.body.appendChild(link);';
//                         echo 'link.click();';
//                         echo 'document.body.removeChild(link);';
//                     } else {
//                         // Handle the case where 'pdf_download_link' is not present
//                         echo 'console.error("Error: PDF download link not found for a package.");';
//                     }
//                 }
//             } else {
//                 // Handle the case where 'packages' array is not present or empty
//                 echo 'console.error("Error: No packages found.");';
//             }
//         }

//         // Close cURL session
//         curl_close($ch);
//     ?>
// });

// function submitShippingForm(pincode) {
//     // Get values from input fields
//     var weightValue = $('#weight').val();
//     var modeValue = $('#mode').val();
//     var delivery_val = $('#delivery_val').val();

//     // Get the pincode from the clicked button
   
//     console.log(pincode);

//     // Get the unique identifier (ord-id) for the clicked button
//     var ordId = $(document.activeElement).data('ord-id');

//     // Update the form action with dynamic parameters
//     var formAction = "<?php echo base_url(); ?>vendors/orders_monthly/shippingcost/" + ordId;
//     formAction += "?weight=" + encodeURIComponent(weightValue) + "&mode=" + encodeURIComponent(modeValue);

//     // Submit the form using AJAX
//     $.ajax({
//         url: formAction,
//         method: "POST",
//         data: {weightValue: weightValue, modeValue: modeValue, delivery_val: delivery_val, pincode: pincode},
//         success: function(response) {
//             // Handle the success response from the server
//             console.log('AJAX success:', response);

//             $('#shipValue').html('<i class="fal fa-rupee-sign"></i>' + response);

//             // Close the modal if needed
//             $('#shippingModal_' + ordId).modal('hide');
//         },
//         error: function(error) {
//             // Handle the error response from the server
//             console.log('AJAX error:', error);
//         }
//     });
// }


</script> 

<script>
    function setTodate(ele) {
        var from_date = ele.value;
        $("#to_date").attr('min', from_date);
     }
</script>

