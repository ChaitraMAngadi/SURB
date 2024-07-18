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
                    <h5>Product Return Details</h5>

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

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID </th>
                                    <th>User Details</th>
                                    <th>Product Details</th>
                                    <th>Order Details</th>
                                    <th>Reason & Timing</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($refund_details as $value) {
                                    $order = $this->common_model->get_data_row(['session_id' => $value->session_id, 'vendor_id' => $value->vendor_id], 'orders');
                                    $user_data = $this->db->where(array("id" => $value->user_id))->get("users")->row();
                                    $vendor_shops = $this->db->where(array("id" => $value->vendor_id))->get("vendor_shop")->row();
                                    $product_data = $this->db->where(array("id" => $value->product_id))->get("products")->row();
                                    $cart = $this->db->where(array("id" => $value->cartid))->get("cart")->row();
                                    $variant_data = $this->db->where(array("id" => $cart->variant_id))->get("link_variant")->row();
                                    $product_image_name = $this->common_model->get_data_row(['variant_id' => $cart->variant_id], 'product_images')->image;
                                    if (!empty($product_image_name)) {
                                        $product_image = base_url('uploads/products/') . $product_image_name;
                                    } else {
                                        $product_image = base_url('uploads/products/noproduct.png');
                                    }
                                    ?>

                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <?= $value->session_id ?>
                                            <a target="_blank" >
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/login/admin_login/">
                                                    <input type="hidden" name="email" class="form-control" value="<?php echo $vendor_shops->mobile; ?>">
                                                    <input type="hidden" name="password" class="form-control" value="<?php echo $vendor_shops->password; ?>">
                                                    <input type="hidden" name="md5" class="form-control" value="1">
                                                    <button type="submit" onclick="this.form.target = '_blank';return true;" style="border: none;outline: none;background: transparent;"><?php echo $vendor_shops->shop_name; ?></button>
                                                </form>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($user_data) { ?>
                                                <b>Name : </b><?php echo $user_data->first_name . " " . $user_data->last_name; ?><br>
                                                <b>Email : </b><?php echo $user_data->email; ?><br>
                                                <b>Phone : </b><?php echo $user_data->phone; ?>
                                            <?php } ?>
                                        </td>
                                        <td><img class="product_image" align="left" style="width:100px; height:100px;" src="<?= $product_image ?>" title="Product image">
                                            <b>Product Name:</b> <?= $product_data->name; ?> <br>
                                            <?php
                                            $attributes = (json_decode($variant_data->jsondata));
                                            foreach ($attributes as $attribute) {
                                                $attr_title = $this->common_model->get_data_row(['id' => $attribute->attribute_type], 'attributes_title')->title;
                                                $attr_value = $this->common_model->get_data_row(['id' => $attribute->attribute_value], 'attributes_values')->value;
                                                ?>
                                                <b><?= ucfirst($attr_title) ?>:</b> <?= $attr_value; ?> <br>
                                            <?php } ?>
                                            <b>Price:</b> <?= $cart->price; ?><br>
                                            <b>Quantity:</b> <?= $cart->quantity; ?>
                                        </td>
                                        <td><b>Payment Mode: </b><?php echo $order->payment_option; ?><br>
                                            <b>Payment Status: </b><?php
                                            if ($order->payment_status == 1) {
                                                echo "Paid";
                                            } else {
                                                echo "Unpaid";
                                            }
                                            ?><br>
                                            <b>Total:</b> <?= $cart->unit_price; ?>
                                        </td>
                                        <td><b>Reason: </b><?= $value->message; ?><br>
                                            <b>Return Placed: </b><?php echo date("d M,Y h:i A", strtotime($value->created_date)); ?><br>
                                            <?php if ($value->exchange_completed_date) { ?><b>Return Completed: </b><?php echo date("d M,Y h:i A", $value->exchange_completed_date); ?><?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($value->admin_accept == 0) { ?>

                                                <a onclick="return confirm('Are you sure You want to accept this return?')" href="<?php echo base_url(); ?>admin/product_return_details/return_status/accept/<?php echo $value->id; ?>"><button class="btn btn-xs btn-info"><i class="fa fa-check" aria-hidden="true"></i>  Accept </button></a> 

                                                <a onclick="return confirm('Are you sure You want to cancel this return?')" href="<?php echo base_url(); ?>admin/product_return_details/return_status/reject/<?php echo $value->id; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-ban"></i>  Reject </button></a>

                                            <?php } else if ($value->admin_accept == 1) { ?>
                                                <button class="btn btn-xs btn-primary">Accepted</button>
                                            <?php } else if ($value->admin_accept == 2) { ?>
                                                <button class="btn btn-xs btn-danger">Rejected</button>
                                            <?php } ?>
                                            <?php if ($order->order_status != 7 && $value->status == 1) { ?>
                                                <button class="btn btn-xs btn-warning">Vendor Accepted</button>
                                            <?php } else if ($order->order_status != 7 && $value->status == 2) { ?>
                                                <button class="btn btn-xs btn-danger">Vendor Rejected</button>
                                            <?php } else if ($order->order_status == 7 && $value->status == 1) { ?> 
                                                <button class="btn btn-xs btn-success">Return Completed</button>
                                            <?php } ?>
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
