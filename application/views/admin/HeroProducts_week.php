<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Top 10 selling products weekly</h5>
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
                                    <th>Product Details</th>
                                    <th>Vendor details</th>
                                    <th>Review </th>
                                    
                                    <th>order Date </th>

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
                                $vendor_qry=$this->db->query("select * from vendor_shop where id='".$ord->vendor_id."'");
                                $vendor_qry_row=$vendor_qry->row();
                                
                                $product_image = $this->db->query("select * from product_images where product_id='".$ord->product_id."'");
                                $image = $product_image->row();
                                
                                $pro = $this->db->query("select * from products where id='".$ord->product_id."'");
                                $product = $pro->row();
                                
                                

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                               <td>
                                    <p><b>Product Name : </b><?php echo $product->name; ?></p>
                                    <p><b>Description :</b> <?php echo $product->descp; ?></p>
                                    <p><b>image :</b> <img src="<?= base_url()?>uploads/products/<?= $image->image ?>" width="50" height="50"</p>
                                    


                                </td>
                                
                                
                                <td>
                                    <?php if($vendor_qry->num_rows()>0){?>
                                    <b>Shop Name : </b><?php echo $vendor_qry_row->shop_name." ".$users->last_name; ?><br>
                                    <b>Owner name : </b><?php echo $vendor_qry_row->owner_name; ?><br>
                                    <b>Phone : </b><?php echo $vendor_qry_row->mobile; ?>
                                    <?php } ?>
                                </td>
                                
                                <td><?php echo $ord->review; ?></td>
                                <!-- <td><?php echo $ord->comments; ?></td> -->
                                <td><?php echo $ord->order_date; ?></td>
                               

                            </tr>
                            
                            

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
    
  

</script> 


