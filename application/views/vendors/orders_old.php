<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="ibox-tools">
                            <a href="<?= base_url() ?>vendors/dashboard">
                                <button class="btn btn-primary">BACK</button>
                            </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
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
                                <th>Admin Comission</th>
                                <th>Delivery Details</th>
                                <th>Created Date</th>
                                <th>Vendor Price</th>
                                <th>Coupon Code</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(count($orders)>0)
                            {
                            foreach($orders as $ord){
                                $user = $this->db->query("select * from users where id='".$ord->user_id."'");
                                $users = $user->row();
                                
                                $ads = $this->db->query("select * from user_address where id='".$ord->deliveryaddress_id."'");
                                $address = $ads->row();
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $ord->id; ?></td>
                                <td>
                                    <?php if($user->num_rows()>0){?>
                                    <b>Name : </b><?php echo $users->first_name." ".$users->last_name; ?><br>
                                    <b>Email : </b><?php echo $users->email; ?><br>
                                    <b>Phone : </b><?php echo $users->phone; ?>
                                    <?php } ?>
                                </td>

                                <td><?php echo $ord->user_address; ?>
                                    <!-- <?php echo $address->locality; ?>,<br>
                                    <?php echo $address->city; ?>,<br>
                                    <?php echo $address->state; ?>,<br>
                                    <?php echo $address->pincode; ?>,<br>
                                    <?php if($address->address_type==1){ echo "Home"; }else if($address->address_type==2){ echo "Office"; }else if($address->address_type==3){ echo "Others"; } ?><br> -->
                                </td>
                                
                                <td><?php echo $ord->payment_option; ?></td>
                                <td><?php if($ord->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; } ?></td>
                                <td><?php if($ord->order_status==1){ echo "Pending"; }else if($ord->order_status==2){ echo "Proccessing"; }else if($ord->order_status==3){ echo "Assigned to delivery to pick up"; }else if($ord->order_status==4){ echo "Delivery Boy On the way"; }else if($ord->order_status==5){ echo "Delivered"; }else if($ord->order_status==6){ echo "Cancelled"; }
                                    ?>
                                    <?php if($ord->order_status==1 || $ord->order_status==2){?>
                                    <select name="status" onchange="updateStatus(this.value,'<?php echo $ord->id; ?>')">
                                        <option value="1" <?php if($ord->order_status==1){ echo "selected='selected'"; }?>>Pending</option>
                                        <option value="2" <?php if($ord->order_status==2){ echo "selected='selected'"; }?>>Accept SELF Delivery</option>
                                        <option value="3" <?php if($ord->order_status==3){ echo "selected='selected'"; }?>>Accept and Assign Sector6 Delivery</option>
                                        <option value="6" <?php if($ord->order_status==6){ echo "selected='selected'"; }?>>Cancel</option>
                                    </select>
                                    <?php } ?>
                                </td>
                                <td><?php echo $ord->total_price; ?></td>
                                <td><?php 
                                            $cart_qry = $this->db->query("select * from cart where session_id='".$ord->session_id."'");
                                            $cart_report = $cart_qry->result();
                                            $new_width=0;
                                            foreach ($cart_report as $value) 
                                            {
                                                $variant_id = $value->variant_id;
                                                $lv_qry = $this->db->query("select * from link_variant where id='".$variant_id."'");
                                                $lv_report = $lv_qry->row();

                                                $pro_qry = $this->db->query("select * from products where id='".$lv_report->product_id."'");
                                                $pro_report = $pro_qry->row();

                                                $adm_com = $this->db->query("select * from admin_comissions where id='".$pro_report->cat_id."'");
                                                $admin_comsn = $adm_com->row();
                                                $percentage = $admin_comsn->admin_comission;
                                                $totalWidth = $value->unit_price;

                                                $new_width += ($percentage / 100) * $totalWidth; 
                                                
                                            }
                                            echo $new_width;
                                    ?></td>
                                <td><b>Name: </b>
                                    <?php 
                                    $deli = $this->db->query("select * from deliveryboy where id='".$ord->delivery_boy."'");
                                    if($deli->num_rows()>0)
                                    {
                                        $delivery_person = $deli->row();
                                        echo $delivery_person->name;
                                    } ?><br>                                    
                                    <b>Commission: </b> <?php echo $ord->deliveryboy_commission; ?>
                                   <!--  <?php if($ord->delivery_boy==0){?>
                               <a href="<?php echo base_url(); ?>vendors/orders/delivery/<?php echo $ord->session_id; ?>"><button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  Assign Delivery Boy </button></a>
                                    <?php } ?> -->
                                </td>
                                <td><?php echo date("d M,Y",$ord->created_at);?></td>
                                <td><?php echo $ord->sub_total-$new_width;?></td>
                                <td>
                                        <?php 
                                        if($ord->coupon_id!=0)
                                        {?>
                                            <p><b>Coupon Code : </b><?php echo $ord->coupon_code; ?></p>
                                            <p><b>Coupon Discount : </b><?php echo $ord->coupon_disount." Rs"; ?></p>
                                       <?php  } ?>
                                </td>
                                <td><a href="<?php echo base_url(); ?>vendors/orders/orderDetails/<?php echo $ord->session_id; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button>
                                            </a></td>
                            </tr>
                            <?php $i++; } }else{?>
                            <tr>
                                <td colspan="8" style="text-align: center">
                                    <h4>No Orders Found</h4>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    
    function updateStatus(value,order_id)
    {
            if(value != '')
            {
             $.ajax({
              url:"<?php echo base_url(); ?>/vendors/orders/changeStatus",
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
    }

</script> 


