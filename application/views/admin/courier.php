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


                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            
                            <tr>
                                <th>#</th>
                                <th>Vendor Name</th>
                              
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Products</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(count($orders)>0)
                            {
                            foreach($orders as $ord){
                                    $vendr_qry = $this->db->query("select * from vendor_shop where id='".$ord->vendor_id."'");
                                    $vendor_row = $vendr_qry->row();

                                    $ord_qry = $this->db->query("select * from orders where session_id='".$ord->session_id."'");
                                    $ord_row = $ord_qry->row();

                                    $vendorname = $vendor_row->shop_name;

                                    if($ord_row->payment_status==1)
                                    {
                                        $pay_status = "PAID";
                                    }
                                    else
                                    {
                                        $pay_status = "NOT PAID";
                                    }

                                    if($ord_row->order_status==1)
                                    {
                                        $ord_stat = "Pending";
                                    }
                                    else if($ord_row->order_status==2)
                                    {
                                        $ord_stat = "Accepted by vendor";
                                    }

                            ?>
                            <tr>
                               <td><?php echo $i; ?></td>
                               <td><?php echo $vendorname; ?></td>
                               <td><?php echo $pay_status; ?></td>
                               <td><?php echo $ord_stat; ?></td>
                               <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart<?php echo $ord->id; ?>">
                                      Products
                                    </button></td>
                               
                                
                               
                                <td>
                                    <a href="<?php echo base_url(); ?>admin/orders/sendCourier/<?php echo $ord->session_id; ?>/<?php echo $ord->vendor_id; ?>">
                                        <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  Send Courier </button>
                                    </a>
                                </td>
                            </tr>

                            

                                    <!-- Modal -->
                                    <div class="modal fade" id="cart<?php echo $ord->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $vendorname; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <div class="css-grid-table">

                                                    <div class="css-grid-table-header">
                                                    <div>Item</div>
                                                    <div>Price</div>
                                                    <div>Quantity</div>
                                                    <div>Total</div>
                                                    </div>
                                                    <?php $cart_qry = $this->db->query("select * from cart where session_id='".$ord->session_id."' and vendor_id='".$ord->vendor_id."'");
                                                            $cart_result = $cart_qry->result();
                                                            foreach ($cart_result as $value) 
                                                            {
                                                                $prod = $this->db->query("SELECT link_variant.product_id,products.name from link_variant LEFT JOIN products ON products.id=link_variant.product_id WHERE link_variant.id='".$value->variant_id."'");
                                                                $products = $prod->row();
                                                    ?>
                                                    <div class="css-grid-table-body">
                                                        <div><?php echo $products->name; ?></div>
                                                        <div><?php echo $value->price; ?></div>
                                                        <div><?php echo $value->quantity; ?></div>
                                                        <div><?php echo $value->unit_price; ?></div>
                                                    </div>
                                                    <?php } ?>


                                           
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

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
<style type="text/css">
    .css-grid-table,
.css-grid-table-header,
.css-grid-table-body {
display: grid;
}

.css-grid-table {
grid-template-rows: 24px 72px;
width: 100%;
}

.css-grid-table-header,
.css-grid-table-body {
grid-template-columns: auto auto auto minmax(150px, 25%);
line-height: 24px; 
}

.css-grid-table-header {
grid-column-gap: 2px;
grid-template-rows: auto;
}

.css-grid-table-body {
grid-template-rows: auto auto auto;
}

.css-grid-table-header div {
text-align: center;
font-weight: bold;
background-color: rgb(191, 191, 191);
}
</style>

