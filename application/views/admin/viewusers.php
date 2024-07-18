<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


        <div class="col-lg-12">

            <div class="ibox-tools" style="margin: 5px 30px; ">
                <a href="<?= base_url() ?>admin/users">
                    <button class="btn btn-primary">BACK</button>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Users Details</h5>


                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped">
    <!--                        <tr>
                                <td>Image</td>
                                <td><?php if ($users->image != '') { ?><img src="<?php echo base_url(); ?>/uploads/users/<?php echo $users->image; ?>" style="width: 80px; height: 80px;"><?php } ?></td>
                            </tr>-->
                            <tr>
                                <td>Name</td>
                                <td><?php echo $users->first_name . "" . $users->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $users->email; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><?php echo $users->phone; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <!--  -->

            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>User Address</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Landmark</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pin code</th>
                                    <th>Address Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qry = $this->db->query("select * from user_address where user_id='" . $users->id . "'");
                                $address = $qry->result();
                                $i = 1;
                                if ($qry->num_rows() > 0) {
                                    foreach ($address as $value) {
                                        $state_qry = $this->db->query("select * from states where id='" . $value->state . "'");
                                        $state_row = $state_qry->row();

                                        $city_qry = $this->db->query("select * from cities where id='" . $value->city . "'");
                                        $city_row = $city_qry->row();
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value->name; ?></td>
                                            <td><?php echo $value->mobile; ?></td>
                                            <td><?php echo $value->address; ?></td>
                                            <td><?php echo $value->landmark; ?></td>
                                            <td><?php echo $value->city; ?></td>
                                            <td><?php echo $state_row->state_name; ?></td>
                                            <td><?php echo $value->pincode; ?></td>
                                            <td><?php
                                                if ($value->address_type == 1) {
                                                    echo "HOME";
                                                } else if ($value->address_type == 2) {
                                                    echo "OFFICE";
                                                } else if ($value->address_type == 3) {
                                                    echo "DEFAULT";
                                                }
                                                ?> </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="9" style="text-align: center">
                                            <h4>No Address Found</h4>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>User Orders</h5>


                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>

                            <tr>
                                <th>#</th>
<!--                                <th>Vendor Name</th>-->
<!--                                <th>Order ID</th>-->
                                <th>Ref. ID</th>
                                <th>Payment Option</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Order Amount</th>
                                <th>Admin Comission</th>
                                <th>Shipping Charge</th>
                                <th>Created Date</th>
<!--                                <th>Vendor Price</th>-->
                                <th>Coupon Code</th>
                                <th class="notexport">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;

                            $where = array('order_status !=' => 1, 'user_id' => $users->id);
                            $table = "orders";
                            $this->db->select("*");
                            $this->db->order_by('id', 'desc');
                            $qry = $this->db->where($where)->group_by('session_id')->get($table);
                            $orders = $qry->result();

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
                                            $grand_total += $rows->total_price;
                                            $admin_comission += abs($rows->admin_commission);
                                            $shipping_charge += $rows->deliveryboy_commission;
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
            <!--                                <td>
                                                <p><b>Shop Name : </b><?php echo $vendor->shop_name; ?></p>
                                                        <p><b>Owner Name :</b> <?php echo $vendor->shop_name; ?></p>
                                                        <p><b>Email :</b> <?php echo $vendor->email; ?></p>
                                                        <p><b>Mobile :</b> <?php echo $vendor->mobile; ?></p>
                                                        <p><b>City :</b> <?php echo $vendor->city; ?></p>
                                                        <p><b>Address :</b> <?php echo $vendor->address; ?></p>
                                                     
            
                                            </td>-->
            <!--                                <td><?php echo $ord->id; ?></td>-->
                                            <td>
                                                <?php echo $ord->session_id; ?>
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
                                                  <!-- <a onclick="return confirm('Change Assign to Courier?')" href="<?php echo base_url(); ?>admin/orders/assigned_deliveryBoy/<?php echo $ord->id; ?>"><button class="btn btn-xs btn-info"> Accepted </button></a> -->

                                                <?php } else if ($display_status == 3) { ?>
                                                    <button class="btn btn-xs btn-primary"> Assigned to Courier </button>
                                                   <!-- <button type="button" class="btn btn-xs btn-success" data-toggle="modal"  data-target="#exampleModal<?php echo $ord->id; ?>">Assign to Courier</button> -->


                                                <?php } else if ($display_status == 4) { ?>
                                                    <button class="btn btn-xs btn-primary"> Order Shipped </button>
                                                <!-- <a onclick="return confirm('Are you sure You want to Complete this order?')" href="<?php echo base_url(); ?>admin/orders/view_complete_status/<?php echo $ord->id; ?>"><button class="btn btn-xs btn-primary"> Shipped </button></a> -->
                                                    <p><b>Courier Name :</b><?= $ord->tracking_name; ?></p>
                                                    <p><b>Courier ID :</b><?= $ord->tracking_id; ?></p>
                                                <?php } else if ($display_status == 5) { ?>
                                                    <button class="btn btn-xs btn-primary"> Delivered </button>
                                                    <p><b>Courier Name :</b><?= $ord->tracking_name; ?></p>
                                                    <p><b>Courier ID :</b><?= $ord->tracking_id; ?></p>
                                                <?php } else if ($display_status == 7) { ?>
                                                    <button class="btn btn-xs btn-primary"> Return </button>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $grand_total - ($orders_get[0]->coupon_disount); ?></td>
                                            <td><?= $admin_comission ?></td>
                                            <td>
                                                <?= $shipping_charge ?>
                                            </td>
                                            <td><?php echo date("d M,Y", $ord->created_at); ?></td>
            <!--                                <td><?php echo $ord->sub_total - $new_width; ?></td>-->
                                            <td>
                                                <?php
                                                if ($ord->coupon_id != 0) {
                                                    ?>
                                                    <p><b>Coupon Code : </b><?php echo $ord->coupon_code; ?></p>
                                                    <p><b>Coupon Discount : </b><?php echo $ord->coupon_disount . " Rs"; ?></p>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/orders/orderDetails/<?php echo $ord->session_id; ?>">
                                                    <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button>
                                                </a>
                                                <?php if ($display_status == 1) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/orders/orderCancel/<?php echo $ord->id; ?>/<?php echo $ord->user_id; ?>">
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
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/orders/shipment">
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
            </div>

            <!--        <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Transactions</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sender Name</th>
                                            <th>Receiver Name</th>
                                            <th>Amount</th>
                                            <th>Message</th>
                                             <th>Order ID</th>
                                            <th>Transaction</th>
                                            <th>Razer Pay</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php
            $trans = $this->db->query("select * from user_transactions where sender_id='" . $users->id . "'");
            $transactions = $trans->result();
            $i = 1;
            if (count($transactions) > 0) {
                $i = 1;
                foreach ($transactions as $v) {
                    $us = $this->db->query("select * from users where id='" . $v->sender_name . "'");
                    $row = $us->row();
                    ?>
                                                                    <tr>
                                                                    <td><?php echo $i; ?></td>
                                                                    <td><?php echo $row->first_name . " " . $row->last_name; ?></td>
                                                                    <td><?php echo $v->receiver_name ?></td>
                                                                    <td><?php echo $v->amount; ?></td>
                                                                    <td><?php echo $v->message; ?></td>
                                                                    <td><?php echo $v->order_id; ?></td>
                                                                    <td><?php echo $v->transaction_id; ?></td>
                                                                    <td><?php echo $v->razerpay; ?></td>
                                                                    <td><?php echo date("d M,Y h:i A", $v->created_date); ?></td>
                                                                </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                                                    <tr>
                                                        <td colspan="8" style="text-align: center">
                                                            <h4>No Transactions Found</h4>
                                                        </td>
                                                    </tr>
            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->


        </div>

    </div>


</div>

