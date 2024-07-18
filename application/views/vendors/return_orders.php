<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Returns Products</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
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

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Order ID </th>
                                <th>User Details</th>
                                <th>Product Details</th>
                                <th>Payment Details</th>
                                <th>Delivery address</th>
                                <th>Reason & Timing</th>
                                <th>Return Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (count($orders) > 0) {
                                foreach ($orders as $ord) {
                                    $order_data = $this->common_model->get_data_row(['session_id' => $ord->session_id, 'vendor_id' => $ord->vendor_id], 'orders');
                                    $oid = $order_data->id;

                                    $cart = $this->common_model->get_data_row(['id' => $ord->cartid], 'cart');
                                    $variant = $this->common_model->get_data_row(['id' => $cart->variant_id], 'link_variant');
                                    $product = $this->common_model->get_data_row(['id' => $variant->product_id], 'products');
                                    $product_image_name = $this->common_model->get_data_row(['variant_id' => $cart->variant_id], 'product_images')->image;
                                    if (!empty($product_image_name)) {
                                        $product_image = base_url('uploads/products/') . $product_image_name;
                                    } else {
                                        $product_image = base_url('uploads/products/noproduct.png');
                                    }

                                    $user = $this->db->query("select * from users where id='" . $ord->user_id . "'");
                                    $users = $user->row();

                                    $ads = $this->db->query("select * from user_address where user_id='" . $ord->user_id . "'");
                                    $address = $ads->row();

                                    $ven = $this->db->query("select * from vendor_shop where id='" . $ord->vendor_id . "'");
                                    $vendor = $ven->row();

                                    $state = $this->db->query("select * from states where id='" . $address->state . "'");
                                    $states = $state->row();

                                    $cit = $this->db->query("select * from cities where id='" . $address->city . "'");
                                    $cities = $cit->row();

                                    $loc = $this->db->query("select * from locations where id='" . $address->area . "'");
                                    $localit = $loc->row();

                                    $cart_data = $this->common_model->get_data_row(['id' => $ord->cartid], 'cart');
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?= $ord->session_id ?></td>
                                        <td>
                                            <?php if ($user->num_rows() > 0) { ?>
                                                <b>Name : </b><?php echo $users->first_name . " " . $users->last_name; ?><br>
                                                <b>Email : </b><?php echo $users->email; ?><br>
                                                <b>Phone : </b><?php echo $users->phone; ?>
                                            <?php } ?>
                                        </td>
                                        <td><img class="product_image" align="left" style="width:100px; height:100px;" src="<?= $product_image ?>" title="Product image">
                                            <b>Product Name:</b> <?= $product->name; ?> <br>
                                            <?php
                                            $attributes = (json_decode($variant->jsondata));
                                            foreach ($attributes as $attribute) {
                                                $attr_title = $this->common_model->get_data_row(['id' => $attribute->attribute_type], 'attributes_title')->title;
                                                $attr_value = $this->common_model->get_data_row(['id' => $attribute->attribute_value], 'attributes_values')->value;
                                                ?>
                                                <b><?= ucfirst($attr_title) ?>:</b> <?= $attr_value; ?> <br>
                                            <?php } ?>
                                            <b>Price:</b> <?= $cart->price; ?><br>
                                            <b>Quantity:</b> <?= $cart->quantity; ?>
                                        </td>
                                        <td><b>Payment Mode: </b><?php echo $order_data->payment_option; ?><br>
                                            <b>Payment Status: </b><?php
                                            if ($order_data->payment_status == 1) {
                                                echo "Paid";
                                            } else {
                                                echo "Unpaid";
                                            }
                                            ?><br>
                                            <b>Total:</b> <?= $cart->unit_price; ?>
                                        </td>
                                        <td>
                                            <?php echo $order_data->user_address; ?>

                                            <!-- address
                                            <?php if ($ads->num_rows() > 0) { ?>
                                                <?php echo $address->address; ?>,<br>
                                                <?php echo $address->landmark; ?>,<br>
                                                <?php echo $address->city; ?>,<br>
                                                <?php echo $states->state_name; ?>,<br>
                                                <?php echo $address->pincode; ?>,<br>
                                                <?php
                                                if ($address->address_type == 1) {
                                                    echo "Home";
                                                } else if ($address->address_type == 2) {
                                                    echo "Office";
                                                } else if ($address->address_type == 3) {
                                                    echo "Others";
                                                }
                                            }
                                            ?>
                                            address -->
                                            <br>
                                        </td>
        <!--                                <td><?php
                                        if ($order_data->payment_status == 1) {
                                            echo "Pending";
                                        } else if ($order_data->payment_status == 2) {
                                            echo "Accepted";
                                        } else if ($order_data->payment_status == 3) {
                                            echo "Assigned to delivery boy";
                                        } else if ($order_data->payment_status == 4) {
                                            echo "Shipped";
                                        } else if ($order_data->payment_status == 5) {
                                            echo "Delivered";
                                        } else if ($order_data->payment_status == 6) {
                                            echo "Cancelled";
                                        }
                                        ?>
                                        </td>-->
                                        
                                        <td><b>Reason: </b><?= $ord->message; ?><br>
                                            <b>Return Placed: </b><?php echo date("d M,Y h:i A", strtotime($ord->created_date)); ?><br>
                                            <?php if($ord->exchange_completed_date) { ?><b>Return Completed: </b><?php echo date("d M,Y h:i A", $ord->exchange_completed_date); ?><?php } ?>
                                        </td>

                                        <td>
                                            <?php if ($order_data->order_status != 7 && $ord->status == 0) { ?>

                                                <a onclick="return confirm('Are you sure You want to accept this return?')" href="<?php echo base_url(); ?>vendors/orders/return_status/<?php echo $ord->cartid; ?>/accept/<?php echo $oid; ?>"><button class="btn btn-xs btn-info"><i class="fa fa-check" aria-hidden="true"></i>  Accept </button></a> 

                                                <a onclick="return confirm('Are you sure You want to cancel this product?')" href="<?php echo base_url(); ?>vendors/orders/return_status/<?php echo $ord->cartid; ?>/reject/<?php echo $oid; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-ban"></i>  Reject </button></a>

                                            <?php } else if ($order_data->order_status != 7 && $ord->status == 1) { ?>
                                                <button class="btn btn-xs btn-primary">Accepted</button>
                                                <a onclick="return confirm('Are you sure You want to complete this return?')" href="<?php echo base_url(); ?>vendors/orders/complete_return/<?php echo $ord->cartid; ?>/<?php echo $oid; ?>"><button class="btn btn-info"><i class="fa fa-check" aria-hidden="true"></i>  Complete </button></a> 
                                            <?php } else if ($order_data->order_status != 7 && $ord->status == 2) { ?>
                                                <button class="btn btn-xs btn-danger">Rejected</button>
                                            <?php } else if ($order_data->order_status == 7 && $ord->status == 1) { ?> 
                                                <button class="btn btn-xs btn-success">Completed</button>
                                            <?php } ?>
                                        </td>
                                    </tr>


                                <div class="modal fade" id="exampleModal<?php echo $ord->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--      <div class="modal-body">
                                                    ...
                                                  </div>-->
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/orders/shipment">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id" placeholder="Enter ProductID" name="id" value="<?php echo $ord->id; ?>"> 
                                                    <label for="id">Tracking Name:</label>
                                                    <input type="text" class="form-control" id="tracking_name" placeholder="Enter TrackingName" name="tracking_name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id">Tracking ID:</label>
                                                    <input type="text" class="form-control" id="tracking_id" placeholder="Enter TrackingID" name="tracking_id" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit </button>
                                            </form>

                                            <div class="modal-footer">


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9" style="text-align: center">
                                    <h4>New request not found</h4>
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


