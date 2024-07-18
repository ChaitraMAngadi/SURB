<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
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

                            <!--                            <div class="col-md-2">
                                                            <a href="<?php echo base_url(); ?>admin/Orders_weekly/pending/pending">
                                                                <div class="widget style1 navy-bg">
                                                                    <div class="row">
                            <?php
                            $from_date = date('Y-m-d', strtotime('-1 week', strtotime('yesterday')));
                            $to_date = date('Y-m-d', strtotime('yesterday'));
                            $ord_qry = $this->db->query("select * from orders where order_status=1 and order_date between '".$from_date."' and '".$to_date."'  group by session_id order by id desc");
                            $pending = $ord_qry->num_rows();
                            ?>
                                                                        <div class="col-xs-12 text-center">
                                                                            <span> Pending </span>
                                                                            <h2 class="font-bold"><?php echo $pending; ?></h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>-->

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>admin/Orders_weekly">
                                    <div class="widget style1 blue-bg">
                                        <div class="row">
                                            <?php
                                            $allorder_qry = $this->db->query("select * from orders where order_status != 1 and order_date between '".$from_date."' and '".$to_date."' group by session_id order by id desc");
                                            $allorder_row = $allorder_qry->num_rows();
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> All Orders </span>
                                                <h2 class="font-bold"><?php echo $allorder_row; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>admin/Orders_weekly/pending/accepted_vendor">
                                    <div class="widget style1 navy-bg">
                                        <div class="row">
                                            <?php
                                            $in_accepted_count = 0;
                                            $where = array(
                                                'order_status' => 2, 
                                                'order_date >=' => $from_date, 
                                                'order_date <=' => $to_date 
                                            );
                                            
                                            $table = "orders";
                                            //session id wise data
                                            $this->db->group_by('session_id');
                                            $in_accept = $this->common_model->get_data_with_condition($where, $table);
                                            //multiple vendor orders in one session
                                            foreach ($in_accept as $accept) {
                                                $vendor_orders = $this->common_model->get_data_with_condition(['session_id' => $accept->session_id], 'orders');
                                                //get all status
                                                $status_arr = array_column($vendor_orders, 'order_status');
                                                //check for status match
                                                if (count(array_unique($status_arr)) === 1) {
                                                    //increase in courier count
                                                    $in_accepted_count += 1;
                                                } else {
                                                    //get minimum order status
                                                    $min = min($status_arr);
                                                    if ($min == 2) {
                                                        $in_accepted_count += 1;
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Accepted  </span>
                                                <h2 class="font-bold"><?php echo $in_accepted_count; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>admin/Orders_weekly/pending/pickuorders">
                                    <div class="widget style1 blue-bg">
                                        <div class="row">
                                            <?php
                                            $in_courier_count = 0;
                                            $where_courier = array(
                                                'order_status' => 3, 
                                                'order_date >=' => $from_date, 
                                                'order_date <=' => $to_date 
                                            );
                                            
                                            $table = "orders";
                                            //session id wise data
                                            $this->db->group_by('session_id');
                                            $in_courier = $this->common_model->get_data_with_condition($where_courier, $table);
                                            //multiple vendor orders in one session
                                            foreach ($in_courier as $courier) {
                                                $vendor_orders = $this->common_model->get_data_with_condition(['session_id' => $courier->session_id], 'orders');
                                                //get all status
                                                $status_arr = array_column($vendor_orders, 'order_status');
                                                //check for status match
                                                if (count(array_unique($status_arr)) === 1) {
                                                    //increase in courier count
                                                    $in_courier_count += 1;
                                                } else {
                                                    //get minimum order status
                                                    $min = min($status_arr);
                                                    if ($min == 3) {
                                                        $in_courier_count += 1;
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Assign to Courier </span>
                                                <h2 class="font-bold"><?php echo $in_courier_count; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>admin/Orders_weekly/pending/ondelivery">
                                    <div class="widget style1 blue-bg">
                                        <div class="row">
                                            <?php
                                            $in_shipped_count = 0;
                                            $where_shipped = array(
                                                'order_status' => 4,
                                                'order_date >=' => $from_date, 
                                                'order_date <=' => $to_date 
                                            );
                                            
                                            $table = "orders";
                                            //session id wise data
                                            $this->db->group_by('session_id');
                                            $in_shipped = $this->common_model->get_data_with_condition($where_shipped, $table);
                                            //multiple vendor orders in one session
                                            foreach ($in_shipped as $shipped) {
                                                $vendor_orders = $this->common_model->get_data_with_condition(['session_id' => $shipped->session_id], 'orders');
                                                //get all status
                                                $status_arr = array_column($vendor_orders, 'order_status');
                                                //check for status match
                                                if (count(array_unique($status_arr)) === 1) {
                                                    //increase in courier count
                                                    $in_shipped_count += 1;
                                                } else {
                                                    //get minimum order status
                                                    $min = min($status_arr);
                                                    if ($min == 4) {
                                                        $in_shipped_count += 1;
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Shipped </span>
                                                <h2 class="font-bold"><?php echo $in_shipped_count; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>admin/Orders_weekly/pending/completed">
                                    <div class="widget style1 blue-bg">
                                        <div class="row">
                                            <?php
                                            $in_delivered_count = 0;
                                            $where_delivered = array(
                                                'order_status' => 5, 
                                                'order_date >=' => $from_date, 
                                                'order_date <=' => $to_date 
                                            );
                                            
                                            $table = "orders";
                                            //session id wise data
                                            $this->db->group_by('session_id');
                                            $in_delivered = $this->common_model->get_data_with_condition($where_delivered, $table);
                                            //multiple vendor orders in one session
                                            foreach ($in_delivered as $delivered) {
                                                $vendor_orders = $this->common_model->get_data_with_condition(['session_id' => $delivered->session_id], 'orders');
                                                //get all status
                                                $status_arr = array_column($vendor_orders, 'order_status');
                                                //check for status match
                                                if (count(array_unique($status_arr)) === 1) {
                                                    //increase in courier count
                                                    $in_delivered_count += 1;
                                                } else {
                                                    //get minimum order status
                                                    $min = min($status_arr);
                                                    if ($min == 5) {
                                                        $in_delivered_count += 1;
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Delivered </span>
                                                <h2 class="font-bold"><?php echo $in_delivered_count; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!--                            <div class="col-md-2">
                                                            <a href="<?php echo base_url(); ?>admin/Orders_weekly/pending/cancelled">
                                                                <div class="widget style1 blue-bg">
                                                                    <div class="row">
                            <?php
                            $cancelled_qry = $this->db->query("select * from orders where order_status=6 and order_date between '".$from_date."' and '".$to_date."' group by session_id order by id desc");
                            $cancelled_row = $cancelled_qry->num_rows();
                            ?>
                                                                        <div class="col-xs-12 text-center">
                                                                            <span> Cancelled </span>
                                                                            <h2 class="font-bold"><?php echo $cancelled_row; ?></h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>-->

                            <div class="col-md-2">
                                <a href="<?php echo base_url(); ?>admin/product_return_details">
                                    <div class="widget style1 navy-bg">
                                        <div class="row">
                                            <?php
                                            $return_qry = $this->db->query("select * from orders where order_status=7 and order_date between '".$from_date."' and '".$to_date."' group by session_id order by id desc");
                                            $return_row = $return_qry->num_rows();
                                            ?>
                                            <div class="col-xs-12 text-center">
                                                <span> Returned </span>
                                                <h2 class="font-bold"><?php echo $return_row; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <form method="get" action="<?= base_url() ?>admin/Orders_weekly" id="filter_purchase_form">
                        <div class="form-group row">
                            <div class="col-sm-4"><label for="keyword" class="caption">Order ID / Transaction ID</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-file-text-o" aria-hidden="true"></span></div>
                                    <input class="form-control input-sm w-50 border-primary" type="text" name="keyword" placeholder="Enter Order ID / Transaction ID" value="<?= $filter_keyword != "" ? $filter_keyword : "" ?>" style="width:310px;">
                                </div>
                            </div>
                            <div class="col-sm-4"><label for="invocieno" class="caption">From Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-file-text-o" aria-hidden="true"></span></div>
                                    <input value="<?= $filter_from_dt != "" ? $filter_from_dt : "" ?>" type="date" max="<?= date('Y-m-d') ?>" class="form-control" name="from_date" onchange="setTodate(this)">
                                </div>
                            </div>
                            <div class="col-sm-4"><label for="invocieno" class="caption">To Date </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-bookmark-o" aria-hidden="true"></span></div>
                                    <input value="<?= $filter_to_dt != "" ? $filter_to_dt : "" ?>" type="date" max="<?= date('Y-m-d') ?>" class="form-control" name="to_date" id="to_date" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="submit" class="btn btn-success mt-2" value="Search">&nbsp;&nbsp;
                                    <a href="<?= base_url() ?>admin/Orders_weekly"><input type="button" class="btn btn-danger mt-2" name="reset" value="Reset"></a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>User Details</th>
                                    <th>Delivery address</th>
                                    <th>Payment Option</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Order Amount</th>
                                    <th>Admin Commission</th>
                                    <th>GST</th>
                                    <th>Net payout to vendor</th>
                                    <th>Shipping Charge</th>
                                    <th>Delivery Shipping charge</th>
                                    <th>Created Date</th>
                                    <th></th>
                                    <th> Membership plan</th>
                                    <th class="notexport">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($i == "") {
                                    $i = 1;
                                }
                                if (count($orders) > 0) {
                                    foreach ($orders as $ord) {
                                        $vendor_order = $this->common_model->get_data_with_condition(['session_id' => $ord->session_id], 'orders', 'id', 'desc');
                                        $order_status_arr = array_column($vendor_order, 'order_status');
                                        $display_status = min($order_status_arr);

                                        $user = $this->db->query("select * from users where id='" . $ord->user_id . "'");
                                        $users = $user->row();

                                        $ads = $this->db->query("select * from user_address where id='" . $ord->deliveryaddress_id . "'");
                                        $address = $ads->row();

//                                $ven = $this->db->query("select * from vendor_shop where id='".$ord->vendor_id."'");
//                                $vendor = $ven->row();
                                        $grand_total = 0;
                                        $admin_comission = 0;
                                        $shipping_charge = 0;
                                        $orders_get = $this->db->where(['session_id' => $ord->session_id])->get('orders')->result();
                                        foreach ($orders_get as $rows) {
                                            // $grand_total += $rows->total_price;
                                            // echo "grand".$rows->total_price;
                                            $grand_total += floatval($rows->sub_total);
                                            $gst +=  abs(floatval($rows->gst));
                                            $vendor +=  abs(floatval($rows->vendor_commission));
                                            // $admin_comission += abs($rows->admin_commission);
                                            $admin_comission += abs(floatval($rows->admin_commission));
                                           
                                                $qry=$this->db->query("select * from users where id='".$ord->user_id."'");
                                                $user_qry_res=$qry->row();
                                                $date= date('Y-m-d');
                                                
                                                if($user_qry_res->membership == 'yes'&& $user_qry_res->plan != '' && $user_qry_res->plan!='0' && $user_qry_res->plan!=0 && $user_qry_res->plan!=null && $user_qry_res->expiry_member_date >= $date && $user_qry_res->created_member_date <= $date){
                                                    $shipping_charge=0;
                                                }
                                                else{
                                                    $shipping_charge += $rows->deliveryboy_commission;
                                                }
                                            
                                        }
                                        $state = $this->db->query("select * from states where id='" . $address->state . "'");
                                        $states = $state->row();

                                        $cit = $this->db->query("select * from cities where id='" . $address->city . "'");
                                        $cities = $cit->row();

                                        $loc = $this->db->query("select * from locations where id='" . $address->area . "'");
                                        $localit = $loc->row();
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
                                            <td>
                                                <?php if ($ads->num_rows() > 0) { ?>
                                                    <?php echo $address->address; ?>,<br>
                                                    <?php echo $address->landmark; ?>,<br>
                                                    <?php echo $address->city; ?>,<br>
                                                    <?php echo $states->state_name; ?>,<br>
                                                    <?php echo $address->pincode; ?>,<br>
                                                    <?php
                                                    if ($address->address_type == 1) {
                                                        echo "Home";
                                                    } else if ($address->address_type == 2) {
                                                        echo "Office";
                                                    } else if ($address->address_type == 3) {
                                                        echo "Others";
                                                    }
                                                }
                                                ?><br>
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
                                            if ($display_status == 1) {
                                                echo "Pending";
                                            } else if ($display_status == 2) {
                                                echo "Processing";
                                            } else if ($display_status == 3) {
                                                echo "Assign to Courier";
                                            } else if ($display_status == 4) {
                                                echo "Shipped";
                                            } else if ($display_status == 5) {
                                                echo "Delivered";
                                            } else if ($display_status == 6) {
                                                echo "Cancelled";
                                            }
                                            ?>
                                            </td>-->
                                            <td>
                                                <?php if ($display_status == 6) { ?>

                                                    <button class="btn btn-xs btn-danger" ><i class="fa fa-ban"></i>  Cancelled </button>
                                                <?php } else if ($display_status == 2) { ?>
                                                    <a class="btn btn-xs btn-success">Accepted</a>
                                                    <a onclick="return confirm('Do you want to cancel this order?')" href="<?php echo base_url(); ?>admin/Orders_weekly/orderCancel/<?php echo $ord->session_id; ?>"><button class="btn btn-danger">Cancel</button></a>

                                                <?php } else if ($display_status == 3) { ?>
                                                    <button class="btn btn-xs btn-primary"> Assigned to Courier </button>
                                                    <a onclick="return confirm('Do you want to cancel this order?')" href="<?php echo base_url(); ?>admin/Orders_weekly/orderCancel/<?php echo $ord->session_id; ?>"><button class="btn btn-danger">Cancel</button></a>

                                                <?php } else if ($display_status == 4) { ?>
                                                    <button class="btn btn-xs btn-primary"> Order Shipped </button>
                                                    <a onclick="return confirm('Do you want to cancel this order?')" href="<?php echo base_url(); ?>admin/Orders_weekly/orderCancel/<?php echo $ord->session_id; ?>"><button class="btn btn-danger">Cancel</button></a>
                                                <?php } else if ($display_status == 5) { ?>
                                                    <button class="btn btn-xs btn-primary"> Delivered </button>
            <!--                                                    <p><b>Courier Name :</b><?= $ord->tracking_name; ?></p>
                                                    <p><b>Courier ID :</b><?= $ord->tracking_id; ?></p>-->
                                                <?php } else if ($display_status == 7) { ?>
                                                    <button class="btn btn-xs btn-primary"> Return </button>
                                                <?php } ?>
                                            </td>
                                            <!-- <td><?php 
                                            // echo number_format($grand_total - ($orders_get[0]->coupon_disount),2); ?></td> -->
                                            <td><?php echo number_format((float)$grand_total - (float)$orders_get[0]->coupon_disount, 2); ?></td>

                                            <td><?= number_format($admin_comission, 2) ?></td>
                                            <td><?= number_format($gst, 2) ?></td>
                                            <td><?= number_format($vendor, 2) ?></td>
                                            <td>
                                                <?= number_format($shipping_charge, 2) ?>
                                            </td>
                                            <td>
                                            <?php 
                                                // print_r($ord->id);
                                                $ship_query=$this->db->query("select * from order_details where order_id='".$ord->id."'");
                                                $ship_query_res=$ship_query->row();
                                                print_r($ship_query_res->ship_cost);
                                                ?>
                                            </td>
                                            <td><?php 
                                            echo date("d M,Y", $ord->created_at); ?></td>
                                            <!-- <td><?php
                                            //  echo (new DateTime($ord->created_at))->format("d M, Y"); ?></td> -->
                                            <!-- <td>
                                                <?php 
                                                    $date = DateTime::createFromFormat("Y-m-d H:i:s", $ord->created_at);
                                                    echo $date ? $date->format("d M, Y") : ''; // Check if $date is valid
                                                ?>
                                            </td> -->
                                           
                                            <td>
                                                <?php
                                                if ($ord->coupon_id != 0) {
                                                    ?>
                                                    <p><b>Coupon Code : </b><?php echo $ord->coupon_code; ?></p>
                                                    <p><b>Coupon Discount : </b><?php echo  " Rs". $ord->coupon_disount ; ?></p>
                                                <?php } else { ?>
                                                    <p><b>Coupon Code : </b>    N/A</p>
                                                <?php } ?>
                                               
                                            </td>
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
                                            <td>
                                                <?php if($ord->session_id!=''){?>
                                                <a href="<?php echo base_url(); ?>admin/Orders_weekly/orderDetails/<?php echo $ord->session_id; ?>">
                                                    <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button>
                                                </a><?php }?>
                                                <?php if ($display_status == 1) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/Orders_weekly/orderCancel/<?php echo $ord->id; ?>/<?php echo $ord->user_id; ?>">
                                                        <button class="btn btn-xs btn-danger">  Cancel </button>
                                                    </a>


                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <div class="modal fade" id="exampleModal<?php echo $ord->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Track Order</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!--      <div class="modal-body">
                                                        ...
                                                      </div>-->
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/Orders_weekly/shipment">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="id"  name="id" value="<?php echo $ord->id; ?>"> 
                                                        <label for="id">Tracking Name:</label>
                                                        <input type="text" class="form-control" id="tracking_name" placeholder="Enter Tracking Name" name="tracking_name" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id">Tracking ID:</label>
                                                        <input type="text" class="form-control" id="tracking_id" placeholder="Enter TrackingID" name="tracking_id" required="">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Submit </button>
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
                                    <td colspan="15" style="text-align: center">
                                        <h4>No Orders Found</h4>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-bx  clearfix ">
                        <?= $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

    /*function updateStatus(value,order_id)
     {
     if(value != '')
     {
     $.ajax({
     url:"<?php echo base_url(); ?>/admin/Orders_weekly/changeStatus",
     method:"POST",
     data:{value:value,order_id:order_id},
     success:function(data)
     {
     if(data=='success')
     {
     alert("status changed successfully");
     window.location.href = "<?php echo base_url(); ?>vendors/orders";
     }
     }
     });
     }
     }*/

</script> 

<script>
    function setTodate(ele) {
        var from_date = ele.value;
        $("#to_date").attr('min', from_date);
     }
</script>


