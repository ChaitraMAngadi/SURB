<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Reviews </h5>
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
                                    <th>Product Details</th>
                                    <th>User Details</th>
                                    <th>Review </th>
                                    <th>Comments </th>
                                    <th>Created Date </th>
<!--                                    <th>Action</th>-->
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(count($reviews)>0)
                            {
                            foreach($reviews as $ord){
                                $user = $this->db->query("select * from users where id='".$ord->user_id."'");
                                $users = $user->row();
                                
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
                                    <?php if($user->num_rows()>0){?>
                                    <b>Name : </b><?php echo $users->first_name." ".$users->last_name; ?><br>
                                    <b>Email : </b><?php echo $users->email; ?><br>
                                    <b>Phone : </b><?php echo $users->phone; ?>
                                    <?php } ?>
                                </td>
                                
                                <td><?php echo $ord->review; ?></td>
                                <td><?php echo $ord->comments; ?></td>
                                <td><?php echo $ord->createdat; ?></td>
                               

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
      <label for="id">Product ID:</label>
      <input type="text" class="form-control" id="tracking_name" placeholder="Enter ProductID" name="tracking_name" required>
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


