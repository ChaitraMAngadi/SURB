<style>

    .shop_image{

        width: 100px;

        height: 100px;

        object-fit: scale-down;

        margin-right:5px;

        border-radius: 10px;

        border: 1px solid #efeded;

    }

    .shop_title{

        font-size:17px !important;

        color: #f39c5a;

    }

</style>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        

        <div class="col-lg-12">

            <div class="ibox float-e-margins">



                <div class="ibox-title">

                    <h5 class="shop_title">Vendors Payouts</h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                    </div>

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

                <div class="ibox-content">

                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/order_daily_reports/datewiseReport">
                        <label>To Date</label>
                        <input type="date" name="start_date" value="<?php if($start_date!=''){ echo $start_date; }?>" required="">
                        <label>From Date</label>
                        <input type="date" name="end_date" value="<?php if($end_date!=''){ echo $end_date; }?>" required="">
                        <input type="submit" class="btn btn-primary" value="GET">
                    </form>

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Vendor ID</th>
                                <th>Shop Name</th>
                                <th>Order NO</th>
                                <th>Invoice No</th>
                                <th>Order Details</th>
                                
                                <th>Delivery charges</th>
                                <th>Total Order Amount</th>
                                <th>Comission</th>
                                <th>Net Payout to Vendor</th>
                                <th>Date</th>
                                <th>Mode of Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($orders_commission as $value) {
                                $qry = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                                $shop = $qry->row();
                                ?>
                                <tr class="gradeX">
                                        
                                <td><?php echo $i;?></td>
                                <td><?php echo $shop->id; ?></td>
                                <td><?php echo $shop->shop_name; ?></td>
                                <td><?php echo $value->id; ?></td>
                                <td>Sector6<?php echo $value->id; ?></td>
                               <td style="width: 100%; height:100%;">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>QTY</th>
                                            <th>Comission(%)</th>
                                            <th>Order Amount</th>
                                        </tr>
                                        <?php $cart_qry = $this->db->query("select * from cart where session_id='".$value->session_id."'");
                                              $cart_result = $cart_qry->result();
                                              $admin_total=0;
                                              $unit_price=0;
                                              foreach ($cart_result as $cart_value) 
                                              { 
                                                $link_qry = $this->db->query("select * from link_variant where id='".$cart_value->variant_id."'");
                                                $link_row = $link_qry->row();

                                                $prod_qry = $this->db->query("select * from products where id='".$link_row->product_id."'");
                                                $prod_row = $prod_qry->row();

                                                $cat_id = $prod_row->cat_id;
                                                $sub_cat_id = $prod_row->sub_cat_id;
                                                $cart_vendor_id = $cart_value->vendor_id;
                                            $adminc_qry = $this->db->query("select * from admin_comissions where shop_id='".$cart_vendor_id."' and cat_id='".$cat_id."' and find_in_set('".$sub_cat_id."',subcategory_ids)");
                                            $adminc_row = $adminc_qry->row();
                                                    $cat_qry = $this->db->query("select * from categories where id='".$cat_id."'");
                                                    $cat_row = $cat_qry->row();

                                                    $scat_qry = $this->db->query("select * from sub_categories where id='".$sub_cat_id."'");
                                                    $scat_row = $scat_qry->row();


                                                    if($adminc_row->admin_comission!='')
                                                    {
                                                        $admin_comission=$adminc_row->admin_comission;
                                                    }
                                                    else
                                                    {
                                                        $admin_comission=0;
                                                    }
                                              ?>

                                        <tr>
                                            <td><?php echo $cat_row->category_name; ?></td>
                                            <td><?php echo $scat_row->sub_category_name; ?></td>
                                            <td><?php echo $cart_value->quantity; ?></td>
                                            <td><?php echo $admin_comission."%"; ?></td>
                                            <td><?php echo $cart_value->unit_price; ?></td>
                                        </tr>
                                            <?php  $percentage = ($cart_value->unit_price/100)*$admin_comission; 
                                                    $admin_total = $percentage+$admin_total;
                                                    $unit_price=$cart_value->unit_price+$unit_price;
                                             ?>
                                             
                                        <?php  } ?>
                                    </table>
                                </td>
                                
                                <td><?php echo $value->deliveryboy_commission; ?></td>


                                <td><?php echo $unit_price+$value->deliveryboy_commission; ?></td>
                                <td><?php echo $admin_total; ?></td>
                                <td><?php 

                                    $totala = $unit_price+$value->deliveryboy_commission;

                                echo $totala-$value->deliveryboy_commission-$admin_total; ?></td>
                                <td><?php echo date("d-m,Y",strtotime($value->created_date)); ?></td>
                                <td><?php echo $value->payment_option; ?></td>
                                
                                </tr>
                                <?php

                                    $i++;
                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>





</div>



