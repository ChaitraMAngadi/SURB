<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?php echo $orders[0]->session_id; ?></title>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>web_assets/img/favicon.png">

<link href="<?= ADMIN_ASSETS_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= ADMIN_ASSETS_PATH ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- Toastr style -->
<link href="<?= ADMIN_ASSETS_PATH ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

<!-- Gritter -->
<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

<link href="<?= ADMIN_ASSETS_PATH ?>assets/css/animate.css" rel="stylesheet">
<link href="<?= ADMIN_ASSETS_PATH ?>assets/css/style.css" rel="stylesheet">
<link href="<?= ADMIN_ASSETS_PATH ?>assets/css/custom_css.css" rel="stylesheet">
<link href="<?= ADMIN_ASSETS_PATH ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-2.1.1.js"></script>
<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

</head>
<style>
    .table-container{
    width:fit-content !important;
    /* margin:0 auto !important; */
    background: white;
    overflow-x: auto;
}
.vertical-line {
    border-left: 1px solid black; /* Adjust the width and color as needed */
    height: 100px; /* Adjust the height as needed */
}

</style>
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
        .logo logo2_sticky{
            float: right;
            justify-content: end;
        }
        .bill{
            float: right;
            justify-content: end;
        }
        .addresses{
            display: flex;
            justify-content: space-between;
            
        }
        .vertical-line {
    border-left: 1px solid black; /* Adjust the width and color as needed */
    height: 100px; /* Adjust the height as needed */
}

        

    }
</style>
<?php 
// echo "<pre>";print_r($orders[0]->vendor_details->address);exit;?>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top:20px;">
    <div class="row" style="width:fit-content;margin:0 auto;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 col-xs-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="line-height: 1.5em;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 col-xs-12 addresses">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 col-6 col-xs-6">
                     <h3 style="size: 20px;"><b>Tax Invoice</b></h3><br>
                      <span style="size: 18px;"> <b>Order Number :</b> &nbsp;<?php echo $orders[0]->session_id; ?> </span><br>
                      <span style="size: 18px;"><b>Invoice  Date : </b><?php echo date("d M Y", $orders[0]->created_at); ?></span><br>
                      <span style="size: 18px;"><b>Order Date: </b><?php echo date('d M Y', strtotime($orders[0]->order_date)); ?></span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 col-6 col-xs-6 bill">
                    <h4 style="size: 20px;"><b>Bill From:</b></h4><br>
                    <span style="size: 18px;"><b>Company Name: </b>Absolutemens.com</span><br>
                    <span style="size: 18px;"><b>Company Address: </b>No102 1st Floor BVR Lake Front,<br>
                    Veeerannapalya, Main Road Nagavara, Bengaluru,<br> 
                    Karnataka, 560045.</span><br>
                    <span style="size: 18px;"><b>GST IN - 29AAVCA8849F1ZU</b></span><br>
                    </div>
                </div>
                    <div class="ibox-tools">
                    
                        <a onclick="window.print()" class="btn btn-success btn-xs print-btn" style="width: 30px;height: 25px;color: white;margin:0 auto;padding:5px;"><i class="fa fa-print"></i></a>
                        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="print-btn">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content col-lg-12 col-md-12 col-sm-12 col-xm-12 col-xs-12 col-12">
                    <?php //echo "<pre>"; print_r($orders); ?>

                    <!-- <div class="col-lg-12"> -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 col-6 col-xs-6" style="margin-bottom: 10px !important">
                            <h4 style="size: 20px;">Bill to/Ship to:</h4>
                            <?php
                            $ad = $this->db->query("select * from user_address where id='" . $orders[0]->deliveryaddress_id . "'");
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

                                <?php echo $address->name; ?></b>

                            <?php echo $orders[0]->user_address; ?>
                            <!-- <b>PinCode :</b> -->
                             <?php echo $address->pincode ?>
                            <!-- <b>Contact Number :</b>  -->
                            <?php echo $address->mobile; ?>
                            <!-- <b>Email :</b> -->
                             <?php echo $users->email; ?><br>
                            <!-- <b>Address Type :</b> -->
                            <?php
                            if ($address->address_type == 1) {
                                echo "HOME";
                            } else if ($address->address_type == 2) {
                                echo "OFFICE";
                            } else if ($address->address_type == 3) {
                                echo "OTHERS";
                            }
                            ?>
                            <!-- <h4 style="size: 20px;">Bill From:</h4> -->
                           <!-- <?php 
                        //    echo  $orders[0]->vendor_details->address;?> -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 col-6 col-xs-6" style="margin-bottom: 10px !important">
                            <h4 style="size: 20px;"> Payment Details </h4>
                            <b>Payment Status : </b><?php
                            if ($orders[0]->payment_status == 1) {
                                echo "PAID";
                            } else {
                                echo "UNPAID";
                            }
                            ?><br>
                            <!--                                    <b>OrderID : </b><?php echo $orders->id; ?>-->
                            
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
                    <!-- </div>  -->
                    <div class="ibox-content ">
                        <h4 style="size: 20px;">Order Details </h4><br>

                        <table class="table table-striped table-container">
                            <thead>
                                <tr>
                                    <!-- <th>ID(Order)</th> -->
                                    <th>S/N</th>
                                    <th>Ship From:</th>
                                    <th>Courier</th>
                                   
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>GST</th>
                                    <th>Amount</th>
                                    <th>subtotal</th>
                                    <th>Shipping Charge</th>
                                    <th>GST</th>
                                    <th>Total</th>
                                    <th>Coupon Discount</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = sizeof($orders);
                                $grand_total = 0;
                                foreach ($orders as $row) {
                                    $i = 1;
                                    $sub_total = 0;
                                    $grand_total += $row->total_price;
                                    foreach ($row->cart_data as $key => $ord) {
                                        $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $ord->prod->cat_id . "' and shop_id='" . $ord->vendor_id . "'");
                                        if ($adm_qry->num_rows() > 0) {
                                            $adm_comm = $adm_qry->row();
                                            $p_gst = $adm_comm->gst;
                                        } else {
                                            $p_gst = '0';
                                        }

                                        $class_percentage = ($ord->unit_price / 100) * $p_gst;
                                        $sub_total += $ord->unit_price;
                                        ?>
                                        <tr>
                                            <!-- <td>#<?= $row->id ?>
                                                <a target="_blank" class="print-btn">
                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/login/admin_login/">
                                                        <input type="hidden" name="email" class="form-control" value="<?php echo $row->vendor_details->mobile; ?>">
                                                        <input type="hidden" name="password" class="form-control" value="<?php echo $row->vendor_details->password; ?>">
                                                        <input type="hidden" name="md5" class="form-control" value="1">
                                                        <button type="submit" onclick="this.form.target = '_blank';return true;" style="border: none;outline: none;background: transparent;"><i class="fa fa-external-link"></i> vendor panel</button>
                                                    </form>
                                                </a>
                                            </td> -->
                                            <td><?php echo $i; ?></td>
                                            <td><?php if ($key == 0) { ?>
                                                    <!-- <b>Name: </b><?= $row->vendor_details->shop_name ?><br> -->
                                                    <!-- <b>Email: </b><?= $row->vendor_details->email ?><br> -->
                                                    <!-- <b>Mobile: </b><?= $row->vendor_details->mobile ?><br> -->
                                                    <b>Address: </b><?= $row->vendor_details->address ?>, <?= $row->vendor_details->city ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <b>Name : </b> <?= $row->tracking_name ? $row->tracking_name : 'N/A' ?><br>
                                                <!-- <b>Tracking ID : </b> <?= $row->tracking_id ? $row->tracking_id : 'N/A' ?> -->
                                            </td>
                                           
                                            <td>
                                                <?php echo $ord->prod->name; ?><br>
                                                <?php foreach ($ord->attributes as $at) { ?><b><?php echo ucfirst($at['type']); ?> : </b> <?php echo $at['value']; ?><br><?php } ?>
                                            </td>
                                            <td><?php echo $ord->quantity; ?></td>
                                            <td>Rs.<?php echo $ord->price; ?></td>
                                            <td>Rs.<?php echo number_format($class_percentage, 2); ?></td>
                                            <td>Rs.<?php echo number_format($ord->unit_price, 2); ?></td>
                                            <td>Rs.<?php echo number_format($sub_total, 2); ?></td>
                                            <td>Rs.<?php echo number_format($row->deliveryboy_commission, 2); ?></td>
                                            <td>Rs.<?php echo number_format($row->gst, 2); ?></td>
                                            <td>Rs.<?php echo number_format($row->total_price, 2); ?></td>
                                            <td style="color:red">- Rs.<?php echo number_format($orders[0]->coupon_disount, 2); ?></td>
                                            <td>Rs.<?php echo number_format($grand_total - ($orders[0]->coupon_disount), 2); ?></td>
                                        </tr>
                                        <?php $i++;
                                    } ?>
                                    <!-- <tr>
                                        <td></td><td></td><td></td><td></td><td></td><td></td>
                                        <td><b>Sub Total</b></td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td></td><td></td><td></td><td></td><td></td><td></td>
                                        <td><b>Shipping Charge</b></td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td></td><td></td><td></td><td></td><td></td><td></td>
                                        <td><b>GST</b></td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td></td><td></td><td></td><td></td><td></td><td></td>
                                        <td><b>Total</b></td>
                                    </tr> -->
    <?php if ($j > 1) { ?>
                                        <tr>
                                            <!-- <th>Order ID</th>     -->
                                            <th>S/N</th>
                                            <th>Ship From: </th>
                                            <th>Courier</th>
                                           
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>GST</th>
                                            <th>Amount</th>
                                            <th>subtotal</th>
                                    <th>Shipping Charge</th>
                                    <th>GST</th>
                                    <th>Total</th>
                                    <th>Coupon Discount</th>
                                    <th>Grand Total</th>
                                        </tr>
                                    <?php } ?>

    <?php $j--;
} ?>
                                <!-- <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                </tr> -->
                                <!-- <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><b>Coupon Discount</b></td>
                                </tr> -->
                                <!-- <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><b>Grand Total</b></td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 col-xs-12">
                                        <p>Declaration:The goods sold as part of this shipment are intended for end-user consumption and are not for retail sale</p>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-12  col-md-12 col-sm-12 col-xm-12 col-12 col-xs-12">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xm-10 col-10 col-xs-10 ">
                   <p> Reg Address: <?= $row->vendor_details->address ?>, <?= $row->vendor_details->city ?> <p>
                   For any clarification, please feel free to contact our customer care at support@absolutemens.com
</div>
<div class="col-lg-2  col-md-2 col-sm-2 col-xm-2 col-2 col-xs-2 logo logo2_sticky">
<img src="<?php echo base_url(); ?>web_assets/img/logo.png" style="width:90px;height:50px;float:right;">
</div>
                    </div>
    </div>
   
</div>

