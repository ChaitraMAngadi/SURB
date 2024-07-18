<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.1/chartjs-plugin-zoom.min.js"></script>
</head>
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

                    <h5 class="shop_title">Today Reports </h5>

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
                <div id="total_sales" style="background-color: #2556B9; border-color: rgba(54, 162, 235, 1);text-align:center;padding:10px;fontSize: 16;font-weight:bold;
                fontFamily: Arial;
                Color: white"></div>
              <canvas id="salesChart" width="800" height="200" style="background-color: #fff;"></canvas>

                <div class="ibox-content">
                <div class="row">
                   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/order_daily_reports/datewiseReport">
                   <div class="col-md-2">
                   <label>From Date :</label>
                        <input type="date" name="start_date" value="<?php if($start_date!=''){ echo $start_date; }?>" required="">
                    </div>
                    <div class="col-md-2">
                        <label>To Date</label>
                        <input type="date" name="end_date" value="<?php if($end_date!=''){ echo $end_date; }?>" required="">
                    </div><div class="col-md-2 action" style="bottom:-22px">
                    <input type="submit" class="btn btn-primary" value="GET">
                    <a href="<?php echo base_url(); ?>admin/order_daily_reports" class="btn btn-warning">RESET</a>
                    </div>
                    </form></div><hr/>

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Vendor ID</th>
                                <th>Shop Name</th>
                                <th>Order NO</th>
                                <th>Invoice No</th>
                                <th>Order Details</th>
                                <th>Date</th>
                                <th>Mode of Payment</th>
                                <th>Delivery charges</th>
                                <th>Total Order Amount</th>
                                <th>Comission</th>
                                <th>Net Payout to Vendor</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($orders_commission as $value) {
                                // echo "<pre>";
                                // print_r($value);
                                // echo "</pre>";

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
                                            <th>Product Name</th>
                                            <th>Vendor Name</th>
                                            <th>Variant</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>QTY</th>
                                            <th>Comission(%)</th>
                                            <th>GST(%)</th>
                                            <th>Order Amount</th>
                                        </tr>
                                        <?php 
                                        $vendor_qry=$this->db->query("select * from vendor_shop where id='".$shop->id."'");
                                        $vendor_row=$vendor_qry->row();
                                        $cart_qry = $this->db->query("select * from cart where session_id='".$value->session_id."'");
                                              $cart_result = $cart_qry->result();
                                              $admin_total=0;
                                              $unit_price=0;
                                              $commision=0;
                                              $gst=0;
                                              $cart_price=0;
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
                                        <td><?php echo $prod_row->name;?></td>
                                                <!-- <td><?php echo $prod_row->orders_placed;?></td> -->
                                                    <td><?php echo $vendor_row->owner_name;?></td>
                                                    <td>
                                                        <?php
 $jsonatt = json_decode($link_row->jsondata);
                                    //    print_r($jsonatt);
 if (is_array($jsonatt) && !empty($jsonatt)) {
     foreach ($jsonatt as $attribute) {
         $attribute_type = $attribute->attribute_type;
         $attribute_value = $attribute->attribute_value;
         $title_query = $this->db->query("SELECT * FROM attributes_title WHERE id = ?", array($attribute_type));
         $value_query = $this->db->query("SELECT value FROM attributes_values WHERE id = ?", array($attribute_value));

         if ($title_query && $value_query) {
             $title_res = $title_query->row();
             $value_res = $value_query->row();
            
             $option_price = $r->price;
             $option_sale_price = $r->saleprice;
             $variant_id = $r->id;
             $product_id = $r->product_id;
             echo ucfirst($title_res->title) . ': ' . ucfirst($value_res->value);
            
            }}}
                                                        ?>

                                                    </td>
                                            <td><?php echo $cat_row->category_name; ?></td>
                                            <td><?php echo $scat_row->sub_category_name; ?></td>
                                            <td><?php echo $cart_value->quantity; ?></td>
                                            <?php 
                                            $total_com=$adminc_row->admin_comission+$total_com;
                                            $commision = (($admin_comission* $cart_value->unit_price)/100)+$commision;
                                            ?>
                                            <td><?php echo $admin_comission."%"; ?>(<?php echo (($admin_comission* $cart_value->unit_price)/100);?>)</td>
                                            <td><?php echo ($adminc_row->gst);?>%(<?php 
                                            $total_com_gst=$adminc_row->gst +$total_com_gst;
                                                $gst =$gst + ($adminc_row->gst * (($admin_comission* $cart_value->unit_price)/100))/100;
                                                $com=($admin_comission* $cart_value->unit_price)/100;
                                                echo ($com*$adminc_row->gst)/100 ;?></td>)
                                            <td><?php echo $cart_value->unit_price; ?></td>
                                        </tr>
                                            <?php  $percentage = ($cart_value->unit_price/100)*$admin_comission; 
                                                    $admin_total = $percentage+$admin_total;
                                                    $unit_price=$cart_value->unit_price+$unit_price;
                                                    $cart_price=$cart_value->unit_price+$cart_price;
                                             ?>
                                             
                                        <?php  } ?>
                                    </table>
                                </td>
                                
                                
                                <td><?php echo date("d-m,Y",strtotime($value->order_date)); ?></td>
                                <td><?php echo $value->payment_option; ?></td>
                                <td><?php echo $value->deliveryboy_commission; ?></td>


                                <td><?php echo $unit_price ?></td>
                                <!-- <td><?php echo $unit_price; ?></td> -->

                                <td><?php 
                                echo ($commision); ?></td>
                                
                                <td><?php 

                                    // $totala = $unit_price+$value->deliveryboy_commission;
                                    $vendor=floatval($cart_price - ($gst+$commision));
                                // echo $totala-$value->deliveryboy_commission-$admin_total;
                                echo $vendor;
                                 ?></td>
                                </tr>
                                <?php

                                    $i++;
                            }

                            ?>

                        </tbody>

                    </table>
                    <!-- comission<?php echo $commision;?> -->

                </div>

            </div>

        </div>

    </div>





</div>

<script>

var salesData = <?php echo json_encode($salesData); ?>;
var total_sales=<?php echo json_encode($total_sales);?>;
var total_sales_data = document.getElementById('total_sales');
if (total_sales !== 0) {
    var formatted_total_sales = "$ " + total_sales + "<br> Today total sales";

    // Set the formatted value as the inner text of the element
    total_sales_data.innerHTML = formatted_total_sales;
} else {
    total_sales_data.style.display = "none";
}


// console.log(total_sales);



// Filter out data points with a value of zero
var dates = Object.keys(salesData);
var totalSales = dates.map(date => salesData[date].total_sale);
var orderCounts = dates.map(date => salesData[date].order_count);

var ctx = document.getElementById('salesChart').getContext('2d');
var salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dates,
        datasets: [{
            label: 'Total Sales',
            data: totalSales,
            borderColor: '#20B2AA',
            backgroundColor: '#20B2AA',
            fill: false,
            yAxisID: 'sales-y-axis'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                id: 'sales-y-axis',
                position: 'left',
                ticks: {
                    beginAtZero: true
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Total Sales'
                }
            }],
            xAxes: [{
                ticks: {
                    autoSkip: true,
                    maxTicksLimit: 20
                }
            }]
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            callbacks: {
                label: function(tooltipItem, data) {
                    var datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                    var value = tooltipItem.yLabel;
                    var index = tooltipItem.index;
                    var orderCount = orderCounts[index];

                    return datasetLabel + ': ' + value + ' (Order Count: ' + orderCount + ')';
                }
            }
        }
    }
});



    </script>

