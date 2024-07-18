

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>My Dashboard</h5>
            </div>
            <div class="ibox-content">


                <div class="row" >
                    <div class="col-md-12">
                        <h2>Today Stats</h2><hr>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <span> Products </span>
                    <?php
                    $qry_t = $this->db->query("select * from products where shop_id='" . $_SESSION['vendors']['vendor_id'] . "'");
                    $num_rows_toa = $qry_t->num_rows();
                    ?>
                                    <h2 class="font-bold"><?= $num_rows_toa ?></h2>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/categories"><div class="col-xs-12 text-center">
                                        <span> Categories </span>
                                        <h2 class="font-bold"><?= $total_category ?></h2>
                                    </div></a>
                            </div>
                        </div>
                    </div>


                    <!--                    <div class="col-md-3">
                                            <div class="widget style1 blue-bg">
                                                <div class="row">
                                                    <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/orders"><div class="col-xs-12 text-center">
                                                        <span> Today Orders </span>
                                                        <h2 class="font-bold"><?= $today_orders ?></h2>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>-->

                  


                   

                    <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/products"><div class="col-xs-12 text-center">
                                        <span> Active Products </span>

                                        <?php
                                        $qry = $this->db->query("select * from products where status=1 and shop_id='" . $_SESSION['vendors']['vendor_id'] . "'");
                                        $num_rows = $qry->num_rows();
                                        ?>
                                        <h2 class="font-bold"><?= $num_rows ?></h2>
                                    </div></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/inactive_products"><div class="col-xs-12 text-center">
                                        <span> Inactive Products </span>
                                        <?php
                                        $qry1 = $this->db->query("select * from products where status=0 and shop_id='" . $_SESSION['vendors']['vendor_id'] . "'");
                                        $num_rows1 = $qry1->num_rows();
                                        ?>
                                        <h2 class="font-bold"><?= $num_rows1 ?></h2>
                                    </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/orders/?type=today_orders"><div class="col-xs-12 text-center">
                                        <span> Today Orders </span>
                                        <h2 class="font-bold"><?= $count_today_orders ?></h2>
                                    </div></a>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/orders"><div class="col-xs-12 text-center">
                                        <span>Orders <i class="fa fa-bell"></i></span>
                                        <h2 class="font-bold"><?= $total_orders ?></h2>
                                    </div></a>
                            </div>
                        </div>
                    </div>

              

                    <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>vendors/orders/return?type=new_request">
                            <div class="widget style1 blue-bg">
                                <div class="row">
                                    <?php
                                    $return_qry = $this->db->query("select * from refund_exchange where status=0 and admin_accept=1 and vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'");
                                    $return_row = $return_qry->num_rows();
                                    ?>
                                    <div class="col-xs-12 text-center">
                                        <span> Return Request </span>
                                        <h2 class="font-bold"><?php echo $return_row; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>vendors/pickuprequests">
                            <div class="widget style1 blue-bg">
                                <div class="row">
                                    <?php
                                    $pickup_qry=$this->db->query("select * from pickup_table where vendor_id='".$_SESSION['vendors']['vendor_id']."'");
                                    $pickup_qry_res=$pickup_qry->num_rows();
                                  
                                    ?>
                                    <div class="col-xs-12 text-center">
                                        <span> Pickup Requests </span>
                                        <h2 class="font-bold"><?php echo $pickup_qry_res; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <?php
$this->db->where('name', 'Sales_report');
$query = $this->db->get('features');
$feature = $query->row();
$show_sales = !empty($feature) && $feature->status == 1;
?>
<?php if($show_sales): ?>
                <div class="row">
                       <div class="col-md-12">
                       <h2>sales Reporths</h2> <hr>

                        </div>
                        <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>vendors/order_daily_reports">
                            <div class="widget style1 blue-bg">

                                <div class="row">

                                    <div class="col-xs-12 text-center">

                                        <span> Today Sales Report </span>
                                        <?php
                                        $vendor_id = $this->session->userdata('vendors')['vendor_id'];
                                        // $strtime = strtotime(date('Y-m-d 00:00:00'));
                                        // $endtime = strtotime(date('Y-m-d 23:59:59'));
                                        $current_date = date('Y-m-d');
                                        $qry_today = $this->db->query("SELECT * 
                                        FROM `orders` 
                                        WHERE order_status=2 and vendor_id = '".$vendor_id."' 
                                        AND order_date = '".$current_date."'
                                        ORDER BY id DESC");

                                        $vendor_num_rows = $qry_today->num_rows();
                                        ?>
                                        <h2 class="font-bold"><?php echo $vendor_num_rows; ?></h2>

                                    </div>

                                </div>

                            </div></a>

                    </div>

                                       <div class="col-md-3">
                                            <a href="<?php echo base_url(); ?>vendors/order_weekly_reports">
                                            <div class="widget style1 blue-bg">
                    
                                                <div class="row">
                    
                                                    <div class="col-xs-12 text-center">
                    
                                                        <span> Weekly Sales Report </span>
                    <?php
                    
                    $start_date_w = date('Y-m-d', strtotime('-1 day'));
                    $end_date_w = date('Y-m-d', strtotime($start_date_w . ' -7 days'));

                    $vendor_ord_qry1 = $this->db->query("SELECT * FROM `orders` where vendor_id='".$vendor_id."'  and order_status=2 and order_date between '".$end_date_w."' AND '".$start_date_w."'");

                    $vendor_num_rows1 = $vendor_ord_qry1->num_rows();
                    ?>
                                                        <h2 class="font-bold"><?php echo $vendor_num_rows1; ?></h2>
                    
                                                    </div>
                    
                                                </div>
                    
                                            </div></a>
                    
                                        </div>

                    <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>vendors/order_monthly_reports">
                            <div class="widget style1 blue-bg">

                                <div class="row">

                                    <div class="col-xs-12 text-center">

                                        <span> Monthly Sales Report </span>
                                        <?php
                                        
           
                                        $start_date = date('Y-m-d');
                                        $end_date = date('Y-m-d', strtotime($start_date . "-1 month "));

                                        $vendor_ord_qry2 = $this->db->query("SELECT * FROM `orders` where  order_status=2 and vendor_id='" . $vendor_id . "' AND order_date between '" . $end_date . "' AND '" . $start_date . "' order by id desc");
                                        $vendor_num_rows2 = $vendor_ord_qry2->num_rows();
                                        ?>
                                        <h2 class="font-bold"><?php echo $vendor_num_rows2; ?></h2>

                                    </div>

                                </div>

                            </div></a>

                    </div> 
                    <div class="col-md-3">
                        <!-- <a href="<?php echo base_url(); ?>vendors/order_monthly_reports"> -->
                            <div class="widget style1 blue-bg">

                                <div class="row">

                                    <div class="col-xs-12 text-center">

                                        <span> lifetime Sales Report </span>
                                        <?php
                                        
           
                                        // $start_date = date('Y-m-d');
                                        // $end_date = date('Y-m-d', strtotime($start_date . "-1 month "));

                                        $vendor_ord_qry2 = $this->db->query("SELECT * FROM `orders` where  order_status=2 and vendor_id='" . $vendor_id . "'  order by id desc");
                                        $vendor_num_rows2 = $vendor_ord_qry2->num_rows();
                                        ?>
                                        <h2 class="font-bold"><?php echo $vendor_num_rows2; ?></h2>

                                    </div>

                                </div>

                            </div>
                        <!-- </a> -->

                    </div>             
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2> Sales revenue<h2><hr>
                     </div>
                     <div class="col-md-3">
                        
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Today sales </span>
                                    
                                    <h2 class="font-bold">&#8377;<?php echo $daily_sales; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>
                    <div class="col-md-3">
                        
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> weekly sales </span>
                                    
                                    <h2 class="font-bold">&#8377;<?php echo $weekly_sales; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>
                    <div class="col-md-3">
                        
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> monthly sales </span>
                                    
                                    <h2 class="font-bold">&#8377;<?php echo $monthly_sales; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>
                    <div class="col-md-3">
                        
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> lifetime sales </span>
                                    
                                    <h2 class="font-bold">&#8377;<?php echo $lifetime_sales; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>
                </div>

                <?php endif; ?>
                <?php
$this->db->where('name', 'AOV');
$query = $this->db->get('features');
$feature = $query->row();
$show_AOV = !empty($feature) && $feature->status == 1;
?>
<?php if($show_AOV): ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Average Order Value(AOV)</h2><hr>

                    </div>
                    <div class="col-md-3">
                    <div class="widget style1 blue-bg">

                        <div class="row">

                            <div class="col-xs-12 text-center">

                                <span> Today Average Revenue </span>

                                <h2 class="font-bold">&#8377;<?= $daily_average ?></h2>

                            </div>

                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="widget style1 blue-bg">

                        <div class="row">

                            <div class="col-xs-12 text-center">

                                <span> weekly Average Revenue </span>

                                <h2 class="font-bold">&#8377;<?= $weekly_average ?></h2>

                            </div>

                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="widget style1 blue-bg">

                        <div class="row">

                            <div class="col-xs-12 text-center">

                                <span> monthly average Revenue </span>

                                <h2 class="font-bold">&#8377;<?= $monthly_average ?></h2>

                            </div>

                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="widget style1 blue-bg">

                        <div class="row">

                            <div class="col-xs-12 text-center">

                                <span> Total Average Revenue </span>

                                <h2 class="font-bold">&#8377;<?= $lifetime_average ?></h2>

                            </div>

                        </div>
                    </div>
                    </div>

                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Payouts</h2><hr>

                    </div>
                </div>
               
                 <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <!-- <a style="color: #FFF;" href="<?php echo base_url(); ?>vendors/request_payment"> -->
                                <div class="col-xs-12 text-center">
                                        <span>Total amount to be payout</span>

                                    <?php    
                                    $qry = $this->db->query("select * from orders where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "' and order_status=5");
        $result = $qry->result();
        $vendor_amount = 0;
        foreach($result as $v) {
            $cart_qry = $this->db->query("SELECT * FROM cart WHERE session_id='" . $v->session_id . "' AND vendor_id='" . $v->vendor_id . "'");
            $cart_result = $cart_qry->result();
            $unit_price = 0;
    
            foreach ($cart_result as $cart_value) {
                $link_qry = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value->variant_id . "'");
                $link_row = $link_qry->row();
    
                $prod_qry = $this->db->query("SELECT * FROM products WHERE id='" . $link_row->product_id . "'");
                $prod_row = $prod_qry->row();
    
                $cat_id = $prod_row->cat_id;
                $sub_cat_id = $prod_row->sub_cat_id;
    
                $cat_qry = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id . "'");
                $cat_row = $cat_qry->row();
    
                $scat_qry = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id . "'");
                $scat_row = $scat_qry->row();
    
                $cart_vendor_id = $cart_value->vendor_id;
                if ($sub_cat_id) {
                    $find_in_set = "AND find_in_set('" . $sub_cat_id . "',subcategory_ids)";
                } else {
                    $find_in_set = "";
                }
                $adminc_qry = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id . "' AND cat_id='" . $cat_id . "' " . $find_in_set . " ");
                $adminc_row = $adminc_qry->row();
                if ($adminc_row->admin_comission != '') {
                    $admin_comission = $adminc_row->admin_comission;
                } else {
                    $admin_comission = 0;
                }
                $commision = floatval($cart_value->unit_price * $admin_comission) / 100;
                $gst = ($adminc_row->gst * $commision) / 100;
                $unit_price += $cart_value->unit_price;
            }
            $vendor_amount = floatval($unit_price - ($gst + $commision))+ $vendor_amount;
        }
        ?>                               
                                        <h2 class="font-bold">₹<?=  $vendor_amount ?></h2>
                                    </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                
                                    <div class="col-xs-12 text-center">
                                        <span>completed Payouts </span>
                                        <?php 
                                            $complete = $this->db->query("SELECT SUM(request_amount) as vendor_requested_amount FROM `request_payment` where status=1 and vendor_id= '$shop_id' and payment_status='completed'");
                                            $complete_row = $complete->row(); ?>

                                            <h2 class="font-bold">₹<?= number_format($complete_row->vendor_requested_amount,2); ?></h2>
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                    </div>

            </div>
        </div>
    </div>
</div>



</div>
