<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Number of orders per day of the vendor</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/vendor_ratings">
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
                                    
                                    <th>Vendor Details</th>
                                    <th>Order Date</th>
                                    <th>Number of orders</th>

                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(sizeof($no_of_orders_day)>0)
                            {
                            foreach($no_of_orders_day as $ord){
                               
                                $vendor_qry=$this->db->query("select * from vendor_shop where id='".$ord->vendor_id."'");
                                $vendor_qry_row=$vendor_qry->row();
                                
                                
                                

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                
                                <td>
                                    <?php if($vendor_qry->num_rows()>0){?>
                                    <b>Shop Name : </b><?php echo $vendor_qry_row->shop_name." ".$users->last_name; ?><br>
                                    <b>Owner name : </b><?php echo $vendor_qry_row->owner_name; ?><br>
                                    <b>Phone : </b><?php echo $vendor_qry_row->mobile; ?>
                                    <?php } ?>
                                </td>
                                
                                
                                
                                
                                
                               
                                <td>
                                        <?php echo $ord->order_day;?>
                                </td>
                                <td>
                                        <?php echo $ord->orders_count;?>
                                </td>
                               

                            </tr>
                            
                            

    </div>
  </div>
</div>
                            
                            
                            <?php $i++; } }else{?>
                            <tr>
                                <td colspan="8" style="text-align: center">
                                    <h4>No orders found</h4>
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


