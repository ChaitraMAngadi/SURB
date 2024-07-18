<style type="text/css" media="print">
    @media print
    {
        @page {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 3px;
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
                     <!-- <h5>Order Details</h5> -->
                      <h5> <b>Order ID :</b> &nbsp;<?php echo $orders[0]->session_id; ?><br> </h5>
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
                        
                            <b>Invoice Generated Date : </b><?php echo date("d-m-Y h:i A", $orders[0]->created_at); ?><br>
                            <b>Payment Type : </b><?php echo $orders[0]->payment_option; ?><br>
                            <b>Order Status : </b><a class="btn btn-xs btn-success"><?php
                                $order_status_arr = array_column($orders, 'order_status');
                                $display_status = min($order_status_arr);
                                if ($display_status == 1) {
                                    echo "Transaction Failed";
                                } else if ($display_status == 2) {
                                    echo "Accepted";
                                } else if ($display_status == 3) {
                                    echo "Assign to Courier";
                                } else if ($display_status == 4) {
                                    echo "Shipped";
                                } else if ($display_status == 5) {
                                    echo "Delivered";
                                } else if ($display_status == 6) {
                                    echo "Cancelled";
                                } else if ($display_status == 7) {
                                    echo "Refund";
                                }
                                ?></a>
                        </div>
                    </div> 
                    <div class="ibox-content">
                        <center><h3>[ Order Details ]</h3></center>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID(Order)</th>
                                    <th>Vendor Details</th>
                                   
                                    <th>S/N</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <!-- <th>GST</th> -->
                                    <th>Admin commission</th>
                                    <th>Net Payout to vendor</th>
                                    <!-- <th>Amount</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = sizeof($orders);
                                $grand_total = 0;
                                $gst_total=0;
                                $vendor_total=0;
                                foreach ($orders as $row) {
                                    $i = 1;
                                    $sub_total = 0;
                                    $grand_total += $row->total_price;
                                    foreach ($row->cart_data as $key => $ord) {
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
                                            <td>#<?= $row->id ?>
                                                <a target="_blank" class="print-btn">
                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/login/admin_login/">
                                                        <input type="hidden" name="email" class="form-control" value="<?php echo $row->vendor_details->mobile; ?>">
                                                        <input type="hidden" name="password" class="form-control" value="<?php echo $row->vendor_details->password; ?>">
                                                        <input type="hidden" name="md5" class="form-control" value="1">
                                                        <button type="submit" onclick="this.form.target = '_blank';return true;" style="border: none;outline: none;background: transparent;"><i class="fa fa-external-link"></i> vendor panel</button>
                                                    </form>
                                                </a>
                                            </td>
                                            <td><?php if ($key == 0) { ?>
                                                    <b>Name: </b><?= $row->vendor_details->shop_name ?><br>
                                                    <b>Email: </b><?= $row->vendor_details->email ?><br>
                                                    <b>Mobile: </b><?= $row->vendor_details->mobile ?><br>
                                                    <b>Address: </b><?= $row->vendor_details->address ?>, <?= $row->vendor_details->city ?>
                                                <?php } ?>
                                            </td>
                                           
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php echo $ord->prod->name; ?><br>
                                                <?php foreach ($ord->attributes as $at) { ?><b><?php echo ucfirst($at['type']); ?> : </b> <?php echo $at['value']; ?><br><?php } ?>
                                            </td>
                                            <td><?php echo $ord->quantity; ?></td>
                                            <td>₹<?php echo $ord->price; ?></td>
                                            <!-- <td>₹<?php echo number_format($gst, 2); ?></td> -->
                                            <td>₹<?php echo number_format($admin_price, 2); ?></td>
                                           <?php  $vendor=floatval($ord->unit_price - ($gst+$admin_price));?>
                                            <td>₹<?php echo number_format($vendor, 2); ?></td>
                                            <!-- <td>₹<?php echo number_format($ord->unit_price, 2); ?></td> -->
                                        </tr>
                                        <?php $i++;
                                    } ?>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td><b>Sub Total</b></td><td>₹<?php echo number_format($sub_total, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td><b>Shipping Charge</b></td><td>₹<?php echo number_format($row->deliveryboy_commission, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td><b>Total GST</b></td><td>₹<?php echo number_format(floatval($gst_total), 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <!-- <td><b>Total</b></td><td>₹<?php echo number_format($row->total_price, 2); ?></td> -->
                                    </tr>
    <?php if ($j > 1) { ?>
                                        <tr>
                                            <th>Order ID</th>    
                                            <th>Vendor Details</th>
                                            
                                            <th>S/N</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <!-- <th>GST</th> -->
                                            <th>Net payout to vendor</th>
                                            <!-- <th>Amount</th> -->
                                        </tr>
                                    <?php } ?>

    <?php $j--;
} ?>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td>
                                    <!-- <td><b>Coupon Discount</b></td><td style="color:red">- ₹<?php echo number_format($orders[0]->coupon_disount, 2); ?></td> -->
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td>
                                    <!-- <td><b>Grand Total</b></td><td>₹<?php echo number_format($grand_total - ($orders[0]->coupon_disount), 2); ?></td> -->
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

