<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Business Hours</h5>
                    <div class="ibox-tools">

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
                    <?php } ?>
                    
                </div>
                <a href="<?= base_url() ?>vendors/businesshours/addbusiness" class="btn btn-primary" style="float: right;">Add Business Hours</a>
                <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            
                            <tr>
                                <th>#</th>
                                <th>Week Day</th>
                                <th>Working</th>
                                <th>Open Time</th>
                                <th>Closed Time</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(count($business_hours)>0)
                            {
                            foreach($business_hours as $bhours){
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $bhours->weekname; ?></td>
                                <td><?php echo $bhours->working; ?></td>
                                <td><?php echo $bhours->open_time; ?></td>
                                <td><?php echo $bhours->closed_time; ?></td> 
                                <td>
                                    <a href="<?= base_url() ?>vendors/businesshours/edit/<?= $bhours->id ?>">
                                        <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                            Edit
                                        </button>
                                    </a>
                                    <a href="<?= base_url() ?>vendors/businesshours/delete/<?= $bhours->id ?>" onclick="if(!confirm('Are you sure you want to delete this Row?')) return false;">
                                        <button title="Delete Business Hours" class="btn btn-xs btn-danger" >
                                            Delete
                                        </button>
                                    </a>
                                </td>                          
                            </tr>
                            <?php $i++; } }else{?>
                            <tr>
                                <td colspan="8" style="text-align: center">
                                    <h4>No Business Hours Found</h4>
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


