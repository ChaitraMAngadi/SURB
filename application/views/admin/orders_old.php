<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
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
                    <div class="col-md-12">

                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/pending">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <?php $ord_qry = $this->db->query("select * from orders where order_status=1");
                                               $pending =$ord_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> Pending </span>
                                            <h2 class="font-bold"><?php echo $pending; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/accepted_vendor">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <?php  $selford_qry = $this->db->query("select * from orders where order_status=2");
                                               $self_delivries =$selford_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> Accepted  </span>
                                            <h2 class="font-bold"><?php echo $self_delivries; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/pickuorders">
                                <div class="widget style1 blue-bg">
                                    <div class="row">
                                        <?php  $pickup_qry = $this->db->query("select * from orders where order_status=3");
                                               $pickup_row =$pickup_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> ON PickUp </span>
                                            <h2 class="font-bold"><?php echo $pickup_row; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/ondelivery">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <?php  $del_qry = $this->db->query("select * from orders where order_status=4");
                                               $del_row =$del_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> ON Deliveries </span>
                                            <h2 class="font-bold"><?php echo $del_row; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/completed">
                                <div class="widget style1 blue-bg">
                                    <div class="row">
                                        <?php  $delComplete_qry = $this->db->query("select * from orders where order_status=5");
                                               $delComplete_row =$delComplete_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> Delivered </span>
                                            <h2 class="font-bold"><?php echo $delComplete_row; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/cancelled">
                                <div class="widget style1 blue-bg">
                                    <div class="row">
                                        <?php  $cancelled_qry = $this->db->query("select * from orders where order_status=6");
                                               $cancelled_row =$cancelled_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> Cancelled </span>
                                            <h2 class="font-bold"><?php echo $cancelled_row; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/return">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                         <?php  $return_qry = $this->db->query("select * from orders where order_status=7");
                                               $return_row =$return_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> Return </span>
                                            <h2 class="font-bold"><?php echo $return_row; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>admin/orders/pending/allorders">
                                <div class="widget style1 blue-bg">
                                    <div class="row">
                                         <?php  $allorder_qry = $this->db->query("select * from orders");
                                               $allorder_row =$allorder_qry->num_rows();
                                         ?>
                                       <div class="col-xs-12 text-center">
                                            <span> All Orders </span>
                                            <h2 class="font-bold"><?php echo $allorder_row; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            
                            <tr>
                                <th>#</th>
                                <th>Vendor Name</th>
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

                                $ven = $this->db->query("select * from vendor_shop where id='".$ord->vendor_id."'");
                                $vendor = $ven->row();

                                $state = $this->db->query("select * from states where id='".$address->state."'");
                                $states = $state->row();

                                $cit = $this->db->query("select * from cities where id='".$address->city."'");
                                $cities = $cit->row();

                                $loc = $this->db->query("select * from locations where id='".$address->area."'");
                                $localit = $loc->row();

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <p><b>Shop Name : </b><?php echo $vendor->shop_name; ?></p>
                                            <p><b>Owner Name :</b> <?php echo $vendor->shop_name; ?></p>
                                            <p><b>Email :</b> <?php echo $vendor->email; ?></p>
                                            <p><b>Mobile :</b> <?php echo $vendor->mobile; ?></p>
                                            <p><b>City :</b> <?php echo $vendor->city; ?></p>
                                            <p><b>Address :</b> <?php echo $vendor->address; ?></p>
                                         

                                </td>
                                <td><?php echo $ord->id; ?></td>
                                <td>
                                    <?php if($user->num_rows()>0){?>
                                    <b>Name : </b><?php echo $users->first_name." ".$users->last_name; ?><br>
                                    <b>Email : </b><?php echo $users->email; ?><br>
                                    <b>Phone : </b><?php echo $users->phone; ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($ads->num_rows()>0){ ?>
                                    <?php echo $address->address; ?>,<br>
                                    <?php echo $localit->location_name; ?>,<br>
                                    <?php echo $cities->city_name; ?>,<br>
                                    <?php echo $states->state_name; ?>,<br>
                                    <?php echo $address->pincode; ?>,<br>
                                    <?php if($address->address_type==1){ echo "Home"; }else if($address->address_type==2){ echo "Office"; }else if($address->address_type==3){ echo "Others"; } 
                                }
                                    ?><br>
                                </td>
                                
                                <td><?php echo $ord->payment_option; ?></td>
                                <td><?php if($ord->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; } ?></td>
                                <td><?php if($ord->order_status==1){ echo "Pending"; }else if($ord->order_status==2){ echo "Proccessing"; }else if($ord->order_status==3){ echo "Assigned to delivery to pick up"; }else if($ord->order_status==4){ echo "Delivery Boy On the way"; }else if($ord->order_status==5){ echo "Delivered"; }else if($ord->order_status==6){ echo "Cancelled"; }
                                    ?>
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
                                <td>
                                    <?php 
                                    $deli = $this->db->query("select * from deliveryboy where id='".$ord->delivery_boy."'");
                                    if($deli->num_rows()>0)
                                    {
                                        $delivery_person = $deli->row();  ?>
                                         <p><b>Name: </b> <?php echo $delivery_person->name; ?></p>
                                        <p><b>Mobile: </b> <?php echo $delivery_person->phone; ?></p>
                                        <p><b>Address: </b> <?php echo $delivery_person->address; ?></p>
                                        
                                       
                                   <?php } ?><br>                                    
                                    <b>Commission: </b> <?php echo $ord->deliveryboy_commission; ?>

                                    <?php if($ord->order_status==2 || $ord->order_status==3){?>
                               <a href="<?php echo base_url(); ?>admin/orders/delivery/<?php echo $ord->id; ?>"><button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  Assign Delivery Boy </button></a>
                                    <?php } ?>
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
                                <td>
                                    <a href="<?php echo base_url(); ?>admin/orders/orderDetails/<?php echo $ord->session_id; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button>
                                            </a>
                                                <?php if($ord->order_status==1){ ?>
                                            <a href="<?php echo base_url(); ?>admin/orders/orderCancel/<?php echo $ord->id; ?>/<?php echo $ord->user_id; ?>">
                                                <button class="btn btn-xs btn-danger">  Cancel </button>
                                            </a>

                                            
                                        <?php } ?>
                                         <?php if($ord->order_status==2){ ?>
                                        <a href="<?php echo base_url(); ?>admin/orders/assignCourier/<?php echo $ord->session_id; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View Courier </button>
                                            </a>
                                             <?php } ?>
                                        </td>
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
    
    /*function updateStatus(value,order_id)
    {
            if(value != '')
            {
             $.ajax({
              url:"<?php echo base_url(); ?>/admin/orders/changeStatus",
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
    }*/

</script> 


