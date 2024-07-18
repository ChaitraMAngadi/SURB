<style>
    .cat_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Vendor payouts</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        
                        <a>
                            <button class="btn btn-primary">Total: Rs. <?= ($vendor_amount) ? $vendor_amount : '0' ?></button>
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
                   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/vendor_payouts/datewiseReport">
                   <div class="col-md-2">
                   <label>From Date :</label>
                        <input type="date" name="start_date" value="<?php if($start_date!=''){ echo $start_date; }?>" required="">
                    </div>
                    <div class="col-md-2">
                        <label>To Date</label>
                        <input type="date" name="end_date" value="<?php if($end_date!=''){ echo $end_date; }?>" required="">
                    </div><div class="col-md-2 action" style="bottom:-22px">
                    <input type="submit" class="btn btn-primary" value="GET">
                    <a href="<?php echo base_url(); ?>vendors/vendor_payouts" class="btn btn-warning">RESET</a>
                    </div>
                    </form></div><hr/>

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Vendor Name</th>
                                    <th>Item Details</th>
                                     <th>Shipping Charge</th>
                                     <th>vendor amount</th>
                                     <th>payment Date</th>
                                     <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($orders as $v) {
                                    ?>
                                    <tr class="gradeX">
                                  <?php  $vendor_qry=$this->db->query("select * from vendor_shop where id='".$v->vendor_id."'");
                                            $vendor_row=$vendor_qry->row();?>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v->session_id; ?></td>
                                        <td><?php echo $vendor_row->owner_name;?></td>
                                     <?php    $qry = $this->db->query("select * from vendor_shop where id='" . $v->vendor_id . "'");
                                              $shop = $qry->row();?>
                                               <td style="width: 100%; height:100%;">
                                               <?php
                                            $admin_total=0;
                                           
                                            $cart_qry = $this->db->query("select * from cart where session_id='" . $v->session_id . "' and vendor_id='" . $v->vendor_id . "'");
                                            $cart_result = $cart_qry->result();
                                            foreach ($cart_result as $cart_value) {
                                                $link_qry = $this->db->query("select * from link_variant where id='" . $cart_value->variant_id . "'");
                                                $link_row = $link_qry->row();

                                                $prod_qry = $this->db->query("select * from products where id='" . $link_row->product_id . "'");
                                                $prod_row = $prod_qry->row();

                                                $cat_id = $prod_row->cat_id;
                                                $sub_cat_id = $prod_row->sub_cat_id;
                                                $cat_qry = $this->db->query("select * from categories where id='" . $cat_id . "'");
                                                $cat_row = $cat_qry->row();

                                                $scat_qry = $this->db->query("select * from sub_categories where id='" . $sub_cat_id . "'");
                                                $scat_row = $scat_qry->row();

                                                $cart_vendor_id = $cart_value->vendor_id;
                                                if ($sub_cat_id) {
                                                    $find_in_set = "and find_in_set('" . $sub_cat_id . "',subcategory_ids)";
                                                } else {
                                                    $find_in_set = "";
                                                }
                                                $adminc_qry = $this->db->query("select * from admin_comissions where shop_id='" . $cart_vendor_id . "' and cat_id='" . $cat_id . "' " . $find_in_set . " ");
                                                $adminc_row = $adminc_qry->row();
                                                if ($adminc_row->admin_comission != '') {
                                                    $admin_comission = $adminc_row->admin_comission;
                                                } else {
                                                    $admin_comission = 0;
                                                }
                                                ?>
                                               <b>Product Name:</b> <?php echo $prod_row->name;?><br>
                                               <b>Variant:</b> <?php
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
                                                        ?><br>

                                                <b> QTY: </b><?php echo $cart_value->quantity; ?><br>
                                                <?php 
                                                $commision =floatval($cart_value->unit_price * $admin_comission)/100;
                                                ?>
                                                <b>Admin Commission(%): </b><?php echo $admin_comission . "%"; ?>(<?php echo $commision;?>)<br>
                                                <b>GST: </b><?php 
                                                $gst =($adminc_row->gst * $commision)/100;
                                                echo $gst;

                                                ?><br>
                                                <b>Price: </b><?php echo $cart_value->unit_price; ?><br>
                                                <!-- <b>Total: </b><?php  $percentage = ($cart_value->unit_price/100)*$admin_comission; 
                                                    $admin_total = $percentage+$admin_total;
                                                    $unit_price=$cart_value->unit_price+$unit_price;
                                             ?>
                                                    <?php echo $unit_price+$v->deliveryboy_commission+$v->gst; ?> -->
                                      <?php }?>
                                    </td>

                                        
                                        
                                        <td><?php echo $v->deliveryboy_commission;?></td>
                                        <td><?php 
                                        // $remove=
                                        $vendorAmount= floatval($cart_value->unit_price - ($gst + $commision));
                                        echo $vendorAmount;
                                        ?></td>
                                        <td><?php 
                                         $payment_qry = $this->db->query("select * from request_payment where reference_id='".$v->id."' and vendor_id='".$v->vendor_id."'");
                                         $payment_qry_res = $payment_qry->row();
                                         if($payment_qry_res->updated_at !=''){
                                           echo date("d-m-Y h:i A",$payment_qry_res->updated_at);
                                         }
                                        ?></td>

                                            <td>
                                            <?php
                                                $payment_qry = $this->db->query("select * from request_payment where reference_id='".$v->id."' and vendor_id='".$v->vendor_id."'");
                                                $payment_qry_res = $payment_qry->row();
                                                if($payment_qry_res->status == 1){?>
                                                       <span style="color: green;"><?php echo "payment completed"; ?></span>
                                                <?php }else{
                                                ?>
                                                <span style="color: red;"><?php echo "pending"; ?></span>
                                               
                                           <?php }?>
                                          </td>
                                          <td>
                                          <?php if($v->session_id!=''){?>
                                                <a href="<?php echo base_url(); ?>admin/Admin_payouts/orderDetails/<?php echo $v->session_id; ?>">
                                                    <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button>
                                                </a><?php }?>
                                          <!-- <button class="btn btn-info" onclick="printRowData(this)">invoice</button> -->
                                          <!-- <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/request_payment/insert">
                                          <input type="hidden" name="vendor_amount" class="form-control" readonly="" value="<?php echo $vendor_amount; ?>">
                                          <input type="hidden" id="requested_amount"  name="requested_amount" class="form-control" value="<?php echo $v->vendor_commission;?>">  
                                          <input type ="hidden" id="description" name="description" class="form-control" value="please pay">
                                          <button type ="submit" class="btn btn-primary">Request Amount</td>
                                          </form> -->
                                            
                                           
                                        </td>
                                       


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
</div>
<script>

    document.onkeydown = function (e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'C'.charCodeAt(0) || e.keyCode == 'c'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'J'.charCodeAt(0) || e.keyCode == 'j'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) {
            return false;
        }
    }
    function printRowData(button) {
    var row = button.parentNode.parentNode; // Get the parent row of the button
    var rowData = Array.from(row.cells).map(cell => cell.textContent); // Get data from all cells in the row
    var rowDataString = rowData.join('</td><td>'); // Join data into a string

    // Create a new window to print row data
    var printWindow = window.open('', '_self');
    printWindow.document.write('<html><head><title>vendor Payout Data</title></head><body>');
    printWindow.document.write('<table border="1">');
    printWindow.document.write('<tr><td colspan="' + row.cells.length + '">vendor Payout Data</td></tr>');
    printWindow.document.write('<tr><td>' + rowDataString + '</td></tr>');
    printWindow.document.write('</table>');
    // printWindow.document.close(); // Close the document for printing

    // Print the window
    printWindow.print();
    
    // Optional: Close the print window after printing
    // printWindow.close();
    window.location.reload();
}

</script>