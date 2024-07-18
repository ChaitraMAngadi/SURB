<style type="text/css" media="print">
    @media print
    {
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }
        body  {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .print-btn {
            display: none;
        }

    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <!--                    <h5>Order Details</h5>-->
                    <h5> <b>Order ID :</b> &nbsp;<?php echo $orders->session_id; ?><br> </h5>
                    <div class="ibox-tools">
                        <a onclick="window.print()" class="btn btn-success btn-xs print-btn" style="width: 30px;height: 25px;color: white;"><i class="fa fa-print"></i></a>
                        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="print-btn">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php //echo "<pre>"; print_r($orders); ?>

                    <div class="col-lg-12">
                        <div class="col-lg-6" style="margin-bottom: 10px !important">
                            <h3>[ User Details ]</h3>
                            <?php
                            $ad = $this->db->query("select * from user_address where id='" . $orders->deliveryaddress_id . "'");
                            $address = $ad->row();

                            $city_qry = $this->db->query("select * from cities where id='" . $address->city . "'");
                            $city_row = $city_qry->row();

                            $state_qry = $this->db->query("select * from states where id='" . $address->state . "'");
                            $state_row = $state_qry->row();

                            $area_qry = $this->db->query("select * from areas where id='" . $address->area . "'");
                            $area_row = $area_qry->row();

                            $user = $this->db->query("select * from users where id='" . $address->user_id . "'");
                            $users = $user->row();
                            ?>
                            <b>
                                <?php echo $address->name; ?>,</b><br>

                            <?php echo $orders->user_address; ?><br>
                            <b>PinCode :</b> <?php echo $address->pincode ?><br>
                            <b>Contact Number :</b> <?php echo $address->mobile; ?><br>
                            <b>Email :</b> <?php echo $users->email; ?><br>
                            <b>Address Type :</b>
                            <?php
                            if ($address->address_type == 1) {
                                echo "HOME";
                            } else if ($address->address_type == 2) {
                                echo "OFFICE";
                            } else if ($address->address_type == 3) {
                                echo "OTHERS";
                            }
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <h3>[ Payment Details ]</h3>
                            <b>Payment Status : </b><?php
                            if ($orders->payment_status == 1) {
                                echo "PAID";
                            } else {
                                echo "UNPAID";
                            }
                            ?><br>
                            <!--                                    <b>OrderID : </b><?php echo $orders->id; ?>-->
                            <b>Invoice Generated Date : </b><?php echo date("d-m-Y h:i A", $orders->created_at); ?><br>
                            <b>Payment Type : </b><?php echo $orders->payment_option; ?><br>
                            <b>Order Status : </b>
                          
                            <?php if ($orders->order_status == 1) { ?>

                                <a onclick="return confirm('Are you sure You want to accept this product?')" href="<?php echo base_url(); ?>vendors/orders/view_aceept_status/<?php echo $orders->id; ?>"><button class="btn btn-xs btn-info"><i class="fa fa-check" aria-hidden="true"></i>  Accept </button></a>


                                <a onclick="return confirm('Are you sure You want to cancel this product?')" href="<?php echo base_url(); ?>vendors/orders/cancel_status/<?php echo $orders->id; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-ban"></i>  Cancel </button></a>
                            <?php } else if ($orders->order_status == 6) { ?>

                                <button class="btn btn-xs btn-danger"><i class="fa fa-ban"></i>  Cancelled </button>
                            <?php } else if ($orders->order_status == 2) { ?>
                                <a class="btn btn-xs btn-success">Accepted</a>
                                <a class="print-btn" onclick="return confirm('Are you sure you want to assign to Courier?')" href="<?php echo base_url(); ?>vendors/orders/assigned_deliveryBoy/<?php echo $orders->id; ?>"><button class="btn btn-info" title="Change Assign to Courier"> Assign to Courier </button></a>


                            <?php } else if ($orders->order_status == 3) { ?>
                                <a class="btn btn-xs btn-success">Assigned to Courier</a>
                                <button type="button" class="btn btn-success print-btn" data-toggle="modal" title="Change to shipped"  data-target="#exampleModal<?php echo $orders->id; ?>">Shipment</button>


                            <?php } else if ($orders->order_status == 4) { ?>
                                <a class="btn btn-xs btn-success">Order Shipped</a>
                                <a class="print-btn" onclick="return confirm('Are you sure you want to Complete this order?')" href="<?php echo base_url(); ?>vendors/orders/view_complete_status/<?php echo $orders->id; ?>"><button class="btn btn-warning" title="Change to Delivered"> Complete </button></a>

                                <p><b>Courier Name :</b><?= $orders->tracking_name; ?></p>
                                <p><b>Courier ID :</b><?= $orders->tracking_id; ?></p>
                                <?php
                            } else if ($orders->order_status == 5) {
                                $chk = $this->db->where(['session_id' => $orders->session_id, 'vendor_id' => $orders->vendor_id])->get('refund_exchange')->num_rows();
                                if ($chk == 0) {
                                    ?> 
                                    <button class="btn btn-xs btn-primary"> Delivered </button>
                                    <?php
                                } else {
                                    $chk_zero = $this->db->where(['session_id' => $orders->session_id, 'vendor_id' => $orders->vendor_id, 'status' => 0])->get('refund_exchange')->num_rows();
                                    $chk_one = $this->db->where(['session_id' => $orders->session_id, 'vendor_id' => $orders->vendor_id, 'status' => 1])->get('refund_exchange')->num_rows();
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
                                <p><b>Courier Name :</b><?= $orders->tracking_name; ?></p>
                                <p><b>Courier ID :</b><?= $orders->tracking_id; ?></p>
                            <?php } else if ($orders->order_status == 7) { ?>
                                <button class="btn btn-xs btn-warning"> Returned </button>
                            <?php } ?>
                        </div>
                    </div> 
                    <div class="ibox-content">
                        <center><h3>[ Order Details ]</h3></center>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>ID(Order)</th>
                                    <th>Product Title</th>
                                    <th>Attributes</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Admin commission</th>
                                    <th>Netpayout to vendor</th>
                                    <!-- <th>GST</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $grand_total = 0;
                                $grand_total = 0;
                                $gst_total=0;
                                $vendor_total=0;
                                foreach ($orders->cart_data as $key => $ord) {
                                    $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $ord->prod->cat_id . "' and shop_id='" . $ord->vendor_id . "'");
                                    if ($adm_qry->num_rows() > 0) {
                                        $adm_comm = $adm_qry->row();
                                        $p_gst = $adm_comm->gst;
                                        $admin_commission=$adm_comm->admin_comission;
                                    } else {
                                        $p_gst = '0';
                                        $admin_commission='0';
                                    }
                                    $admin_price = ($ord->unit_price * $admin_commission)/100;
                                    $gst = ($admin_price * $p_gst)/100;
                                    $gst_total += ($admin_price * $p_gst)/100;
                                    $sub_total += $ord->unit_price;
                                    ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td>#<?php echo $orders->id; ?></td>
                                        <td><?php echo $ord->prod->name; ?></td>
                                        <td><?php foreach ($ord->attributes as $at) { ?><b><?php echo $at['type']; ?> : </b> <?php echo $at['value']; ?><br><?php } ?></td>
                                        <td><?php echo $ord->quantity; ?></td>
                                        <td>₹<?php echo $ord->price; ?></td>
                                        <td>₹<?php echo number_format($admin_price, 2); ?></td>
                                        <?php  $vendor=floatval($ord->unit_price - ($gst+$admin_price));?>
                                            <td>₹<?php echo number_format($vendor, 2); ?></td>
                                            <!-- <td>₹<?php echo number_format(floatval($gst), 2); ?></td> -->
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><b>Sub Total</b></td><td>₹<?php echo number_format($sub_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><b>Shipping Charge</b></td><td>₹<?php echo number_format($orders->deliveryboy_commission, 2); ?></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><b>Total GST</b></td><td>₹<?php echo number_format($gst_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <!-- <td><b>Grand Total</b></td><td>₹<?php echo number_format($orders->total_price, 2); ?></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal<?php echo $orders->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/orders/shipment">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $orders->id; ?>"> 
                    <label for="id" style="margin-left:30px">Tracking Name:</label>
                    <input type="text" class="form-control" style="margin-left: 32px;width: 90%;" id="tracking_name" placeholder="Enter Tracking Name" name="tracking_name" required="">
                </div>
                <div class="form-group">
                    <label for="id" style="margin-left:30px">Tracking ID:</label>
                    <input type="text" class="form-control" style="margin-left: 32px;width: 90%;" id="tracking_id" placeholder="Enter TrackingID" name="tracking_id" required="">
                </div>

                <button type="submit" style="margin-left: 15px;margin-bottom: 10px;" class="btn btn-primary">Submit </button>
            </form>

            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>