<?php
$features = $this->session->userdata('admin_login')['features'];
$role_name = $this->session->userdata('admin_login')['role_name'];
$this->db->where('status', 1);
$query = $this->db->get('features');
$features_data = $query->result_array();
$active_features = array_column($features_data, 'name');
?>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<style>
    .fa-rupee-sign {
    font-family: 'Font Awesome', Arial, sans-serif;
}

</style>
<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5>My Dashboard</h5>

            </div>

            <div class="ibox-content">

                <div class="row">
                    <div class="col-md-12">
                    <?php if(in_array('Users', $active_features) && in_array('Users', $features)): ?>
                        <div class="col-md-3">
                            <a href="<?php echo base_url(); ?>admin/users">
                                <div class="widget style1 navy-bg"> 
                                    <div class="row">
                                       <div class="col-xs-12 text-center">
                                            <span> Users </span>
                                            <h2 class="font-bold"><?= $total_users ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('Vendors', $active_features) && in_array('Vendors', $features)): ?>
                        <div class="col-md-3">
                            <div class="widget style1 navy-bg">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>admin/vendors_shops"><div class="row">
                                    <?php $qry = $this->db->query("select * from vendor_shop where status=1");
                                                  $shops = $qry->num_rows(); ?>
                                    <div class="col-xs-12 text-center">
                                        <span>Active Vendors/Shops</span>
                                        <h2 class="font-bold"><?= $shops ?></h2>
                                    </div>
                                </div></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget style1 navy-bg">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>admin/inactive_vendors_shops"><div class="row">
                                    <?php $qry = $this->db->query("select * from vendor_shop where status=0");
                                                  $shops = $qry->num_rows(); ?>
                                    <div class="col-xs-12 text-center">
                                        <span>Inactive Vendors/Shops</span>
                                        <h2 class="font-bold"><?= $shops ?></h2>
                                    </div>
                                </div></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    <!-- <div class="col-md-3">
                        <div class="widget style1 bg-danger">
                            <div class="row">
                                <a style="color: #FFF;" href="<?php echo base_url(); ?>admin/visual_merchants"><div class="col-xs-12 text-center">
                                    <span>Visual Merchants</span>
                                    <h2 class="font-bold"><?= $total_visual_merchants ?></h2>
                                </div></a>
                            </div>
                        </div>
                    </div> -->


<!--                        <div class="col-md-3">
                            <a href="<?php echo base_url(); ?>admin/delivery_boy">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <span> Delivery Boys </span>
                                            <?php $del = $this->db->query("select * from deliveryboy");
                                              $delivery = $del->num_rows(); ?>
                                            <h2 class="font-bold"><?= $delivery ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>-->

                    
                    </div>

                </div>
                



                <div class="row" >

                    <div class="col-md-12">

                        <h2>Statistics</h2><hr>

                    </div>
                    

                    <?php if(in_array('Product', $active_features)&& in_array('Product', $features)  ): ?>
                    <div class="col-md-4">
                       <a href="<?php echo base_url(); ?>admin/products">
                        <!-- <a href="javascript:void(0)"> -->
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Products </span>

                                    <h2 class="font-bold"><?= $total_products ?></h2>

                                </div>

                            </div>

                        </div>
                    </a>

                    </div>
                    <?php endif; ?>
                    <?php if(in_array('Categories', $active_features)  && in_array('Categories', $features)): ?>
                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/categories">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Categories </span>
                                            <?php $cat = $this->db->query("select * from categories");
                                              $category = $cat->num_rows(); ?>

                                            <h2 class="font-bold"><?= $category ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>
                        <?php endif; ?>

                   
                    <?php if(in_array('Orders', $active_features)  && in_array('Orders', $features)): ?> 
                    <div class="col-md-4">

                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <a style="color: #FFF;" href="<?php echo base_url(); ?>admin/orders"><div class="col-xs-12 text-center">

                                    <span>Orders </span>
                                    <?php $qry1 = $this->db->query("select * from orders group by session_id");
                                              $orders = $qry1->num_rows(); ?>
                                    <h2 class="font-bold"><?= $orders ?></h2>

                                </div></a>

                            </div>

                        </div>

                    </div>
                    <?php endif; ?>
                    <?php if(in_array('Transaction', $active_features) && in_array('Transaction', $features)): ?>
                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/transactions">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Transactions </span>
                                            <?php $trans = $this->db->query("select * from transactions");
                                              $transactions = $trans->num_rows(); ?>

                                            <h2 class="font-bold"><?= $transactions ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>
                        <?php endif; ?>
                        <?php if(in_array('Product', $active_features)&& in_array('Product', $features)  ): ?>
                        <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/products">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Active Products </span>
                                            <?php $product = $this->db->query("select * from products where status=1");
                                              $product_num = $product->num_rows(); ?>
                                            <h2 class="font-bold"><?= $product_num ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/inactive_products">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Inactive Products </span>
                                            <?php $inactive_products = $this->db->query("select * from products where status=0");
                                              $inactive_products_num = $inactive_products->num_rows(); ?>
                                            <h2 class="font-bold"><?= $inactive_products_num ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>
                        <?php endif; ?>


                </div>



               <!--   <div class="row" >

                    <div class="col-md-12">

                        <h2>Today Statistics</h2><hr>

                    </div>

                        <?php  
                            $cdate=date('Y-m-d'); 
                            $qry = $this->db->query("select SUM(total_price) as today_totalorder_amount,SUM(vendor_commission) as vendor_commission,SUM(admin_commission) as admin_commission,SUM(gst) as tgst,SUM(deliveryboy_commission) as tdeliveryboy_commission,SUM(coupon_disount) as coupontotal from orders where created_date LIKE '%".$cdate."%' and order_status=5");
                            $result = $qry->row();
                            
                        ?>

                    <div class="col-md-4">
                        <a href="<?php echo base_url(); ?>admin/order_reports">
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Today Total Orders Amount </span>

                                    <h2 class="font-bold">₹<?= number_format($result->today_totalorder_amount,2); ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>

                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/order_reports">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Today Admin Commission </span>

                                            <h2 class="font-bold">₹<?= number_format($result->admin_commission,2); ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/order_reports">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Today Vendors Commission </span>

                                            <h2 class="font-bold">₹<?= number_format($result->vendor_commission,2); ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>


                   

                    <div class="col-md-4">

                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <a style="color: #FFF;" href="<?php echo base_url(); ?>admin/order_reports"><div class="col-xs-12 text-center">

                                    <span>Today GST </span>
                                    
                                    <h2 class="font-bold">₹<?= number_format($result->tgst,2); ?></h2>

                                </div></a>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/order_reports">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Today Delivery Boys Commission </span>
                                           
                                            <h2 class="font-bold">₹<?= number_format($result->tdeliveryboy_commission,2); ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>
                    </div>




                </div>
 




                 <div class="row" >
                    

                    <div class="col-md-12">

                        <h2>Total Statistics</h2>


                       
                    <hr>
                    </div>

                    


                        

                    <div class="col-md-4">
                        <a href="<?php echo base_url(); ?>admin/order_reports/allreports">
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Total Orders Amount </span>

                                    <h2 class="font-bold">₹<?= $today_totalorder_amount; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>

                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/order_reports/allreports">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Total Admin Commission </span>

                                            <h2 class="font-bold">₹<?= $admin_commission; ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/order_reports/allreports">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Total Vendors Commission </span>

                                            <h2 class="font-bold">₹<?= $vendor_commission; ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>


                   

                    <div class="col-md-4">

                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <a style="color: #FFF;" href="<?php echo base_url(); ?>admin/order_reports/allreports"><div class="col-xs-12 text-center">

                                    <span>Total GST </span>
                                    
                                    <h2 class="font-bold">₹<?= $tgst; ?></h2>

                                </div></a>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/order_reports/allreports">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Total Delivery Boys Commission </span>
                                           
                                            <h2 class="font-bold">₹<?= number_format($result->tdeliveryboy_commission,2); ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>
                    </div>

                   


                </div>  -->

<!--                 <div class="row" >

                    <div class="col-md-12">

                        <h2>Daily Reports</h2><hr>

                    </div>

                     <div class="col-md-4">
                        <a href="<?php echo base_url(); ?>admin/order_daily_reports">
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Daily Reports </span>
                                    <?php $vendor_ord_qry = $this->db->query("select * from orders where order_status=5");
                                          $vendor_num_rows = $vendor_ord_qry->num_rows(); ?>
                                    <h2 class="font-bold"><?php echo $vendor_num_rows; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>

                </div>-->
<?php if(in_array('Sales_report', $active_features) && in_array('Sales_report', $features)): ?>
                <div class="row" >

                    <div class="col-md-12">

                        <h2>Sales Reports</h2><hr>

                    </div>

                     <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>admin/order_daily_reports">
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Today Reports </span>
                                    <?php 
                                    $start_date = date('Y-m-d');
                                    $end_date = date('Y-m-d',strtotime($start_date."-1 days"));
                                    $strtime = strtotime($end_date);
                                    $vendor_ord_qry = $this->db->query("select * from orders where order_status=2 and order_date= '".$start_date."'");
                                          $vendor_num_rows = $vendor_ord_qry->num_rows(); ?>
                                    <h2 class="font-bold"><?php echo $vendor_num_rows; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>
                     

                   
                     
                     <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>admin/order_weekly_reports">
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Weekly Reports </span>
                                    <?php 
                                    $start_date_w = date('Y-m-d', strtotime('-1 day'));
                                    $end_date_w = date('Y-m-d',strtotime($start_date_w."-7 days"));
                                    
                                    $vendor_ord_qry1 = $this->db->query("SELECT * FROM `orders` where order_status=2 and order_date between '".$end_date_w."' AND '".$start_date_w."'");
                                    $vendor_num_rows1 = $vendor_ord_qry1->num_rows(); ?>
                                    <h2 class="font-bold"><?php echo $vendor_num_rows1; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>
                     
                     <div class="col-md-3">
                        <a href="<?php echo base_url(); ?>admin/order_monthly_reports">
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Monthly Reports </span>
                                    <?php 
                                    $start_date_m = date('Y-m-d');
                                    $end_date_m = date('Y-m-d',strtotime($start_date_m."-1 month "));
                                    
                                    $vendor_ord_qry2 = $this->db->query("select * from orders where order_status=2 and order_date between '".$end_date_m."' AND '".$start_date_m."'");
                                          $vendor_num_rows2 = $vendor_ord_qry2->num_rows(); ?>
                                    <h2 class="font-bold"><?php echo $vendor_num_rows2; ?></h2>

                                </div>

                            </div>

                        </div></a>

                    </div>

                    <div class="col-md-3">
                       
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> lifetime Reports </span>
                                    <?php 
                                    $start_date_m = date('Y-m-d');
                                    $end_date_m = date('Y-m-d',strtotime($start_date_m."-1 month "));
                                    
                                    $vendor_ord_qry2 = $this->db->query("select * from orders where order_status=2");
                                          $vendor_num_rows2 = $vendor_ord_qry2->num_rows(); ?>
                                    <h2 class="font-bold"><?php echo $vendor_num_rows2; ?></h2>

                                </div>

                            </div>

                        </div>

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

 <?php if(in_array('AOV', $active_features) && in_array('AOV', $features)): ?>
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
                <?php if(in_array('Payouts', $active_features) && in_array('Payouts', $features)): ?>

                <div class="row" >

                    <div class="col-md-12">

                        <h2>Vendor Payouts</h2><hr>

                    </div>

                        <?php  
                            // $payouts_qry = $this->db->query("select * from orders  where order_status=5");
                            // $pay_result = $payouts_qry->result();
                            // $total_vendor_amount=0;
                            // foreach ($pay_result as $value) 
                            // {
                            //         $total_vendor_amount += $value->vendor_commission;
                            // }



                            $payouts_qry=$this->db->query("SELECT * FROM `orders` where order_status=5");
                            $life_time_qry_count=$payouts_qry->num_rows();
                            $pay_result=$payouts_qry->result();
                            $unit_price_life=0;
                            $vendor_amount_l=0;
                            if($life_time_qry_count>0){
                            foreach($pay_result as $vl) {
                                $cart_qry_l = $this->db->query("SELECT * FROM cart WHERE session_id='" . $vl->session_id . "' AND vendor_id='" . $vl->vendor_id . "'");
                                $cart_result_l = $cart_qry_l->result();
                                
                        
                                foreach ($cart_result_l as $cart_value_l) {
                                    $link_qry_l = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value_l->variant_id . "'");
                                    $link_row_l = $link_qry_l->row();
                        
                                    $prod_qry_l = $this->db->query("SELECT * FROM products WHERE id='" . $link_row_l->product_id . "'");
                                    $prod_row_l = $prod_qry_l->row();
                        
                                    $cat_id_l = $prod_row_l->cat_id;
                                    $sub_cat_id_l = $prod_row_l->sub_cat_id;
                        
                                    $cat_qry_l = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id_l . "'");
                                    $cat_row_l = $cat_qry_l->row();
                        
                                    $scat_qry_l = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id_l . "'");
                                    $scat_row_l = $scat_qry_l->row();
                        
                                    $cart_vendor_id_l = $cart_value_l->vendor_id;
                                    if ($sub_cat_id_l) {
                                        $find_in_set_l = "AND find_in_set('" . $sub_cat_id_l . "',subcategory_ids)";
                                    } else {
                                        $find_in_set_l = "";
                                    }
                                    $adminc_qry_l = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id_l . "' AND cat_id='" . $cat_id_l . "' " . $find_in_set_l . " ");
                                    $adminc_row_l = $adminc_qry_l->row();
                                    if ($adminc_row_l->admin_comission != '') {
                                        $admin_comission_l = $adminc_row_l->admin_comission;
                                    } else {
                                        $admin_comission_l = 0;
                                    }
                                    $commision_l = floatval($cart_value_l->unit_price * $admin_comission_l) / 100;
                                    $gst_l = ($adminc_row_l->gst * $commision_l) / 100;
                                    $unit_price_life += $cart_value_l->unit_price;
                                    // print_r($cart_value->unit_price);
                                }
                                $vendor_amount_l = floatval($unit_price_life - ($gst_l + $commision_l))+ $vendor_amount_l;
                                // $unit_price += $cart_value->unit_price;
                            }
                            }
                           
                
                           
                
                            
                        ?>

                    <div class="col-md-4">
                        <!-- <a href="<?php echo base_url(); ?>admin/vendor_commission"> -->
                        <div class="widget style1 blue-bg">

                            <div class="row">

                                <div class="col-xs-12 text-center">

                                    <span> Total Payouts </span>

                                    <h2 class="font-bold">₹<?= number_format($vendor_amount_l,2); ?></h2>

                                </div>

                            </div>

                        </div>
                    <!-- </a> -->

                    </div>

                    <!-- <div class="col-md-4">

                            <a href="<?php echo base_url(); ?>admin/vendor_commission">

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Pending / Requested Payouts </span>
                                            <?php 
                                            $pending = $this->db->query("SELECT SUM(request_amount) as vendor_requested_amount FROM `request_payment`");
                                            $pending_row = $pending->row(); ?>
                                            <h2 class="font-bold">₹<?= number_format($pending_row->vendor_requested_amount,2); ?></h2>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div> -->
                        <div class="col-md-4">

                            <!-- <a href="<?php echo base_url(); ?>admin/vendor_commission"> -->

                                <div class="widget style1 navy-bg">

                                    <div class="row">

                                        <div class="col-xs-12 text-center">

                                            <span> Completed Payouts </span>
                                            <?php 
                                            $complete = $this->db->query("SELECT SUM(request_amount) as vendor_requested_amount FROM `request_payment` where status=1");
                                            $complete_row = $complete->row(); ?>

                                            <h2 class="font-bold">₹<?= number_format($complete_row->vendor_requested_amount,2); ?></h2>

                                        </div>

                                    </div>

                                </div>

                            <!-- </a> -->

                        </div>

                        <?php endif; ?>


                </div>







            </div>

        </div>

    </div>

</div>







</div>

<script type="text/javascript">
    $(document).ready(function () {
        setInterval(function () {
            $("#here").load(window.location.href + " #here");
            //alert("hi");
        }, 5000);
    });
</script>

