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
                    <h5>Request Payments</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        
                        <a>
                            <button class="btn btn-primary">Total: Rs. <?= ($vendor_amount) ? $vendor_amount : '0' ?></button>
                        </a>
                        <?php if($vendor_amount > 0) { ?>
                        <a href="<?= base_url() ?>vendors/request_payment/add/">
                            <button class="btn btn-primary">+ Request Payment</button>
                        </a>
                        <?php } ?>
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
                                    <th>Vendor Amount</th>
                                    <th>Requested Amount</th>
                                     <th>Created Date</th>
                                     <th>Payment Details</th>
                                     <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($vendor_requests as $v) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v->vendor_amount; ?></td>
                                        <td><?php echo $v->request_amount; ?></td>
                                        <td><?php echo date("d-m-Y h:i A",$v->created_at); ?></td>
                                        <td><?php if($v->status==0){ ?>
                                                <span style="color: red;"><?php echo "Pending"; ?></span>
                                             <?php }else if($v->status==1){ ?> 
                                                <span style="color: green;"><?php echo "Payment Completed"; ?></span>
                                            <?php } ?>
                                            </td>

                                            <td>
                                            <?php
                                                if($v->mode_payment!=''){

                                             if($v->mode_payment=='online'){?>
                                                 <p><b>Payment Mode :</b><?php echo $v->mode_payment; ?></p>
                                                 <p><b>Transaction ID :</b><?php echo $v->transaction_id; ?></p>
                                                 <p><b>Image :</b> <img src="<?php echo base_url()."uploads/payments/".$v->image; ?>" style="width: 60px; height: 60px;"></p>
                                            <?php }else{?>
                                                <p><b>Payment Mode :</b><?php echo $v->mode_payment; ?></p>
                                                <p><b>Sender Name :</b><?php echo $v->sender_name; ?></p>
                                                <p><b>Receiver Name :</b><?php echo $v->receiver_name; ?></p>
                                            <?php } ?>
                                            <p><b>Description :</b><?php echo $v->admin_description; ?></p>
                                            <p><b>Payment Date :</b><?php echo date("d-m-Y",$v->updated_at); ?></p>
                                        <?php } ?>
                                          </td>
                                        <td>
                                            <?php if($v->status==0){ ?>
                                                <a href="<?= base_url() ?>vendors/request_payment/delete/<?= $v->id ?>">
                                                        <button title="Delete Category" class="btn btn-xs btn-danger">
                                                            Delete
                                                        </button>
                                                    </a>
                                                <?php }else if($v->status==1){ ?> 
                                                        <button disabled="" title="Delete" class="btn btn-xs btn-danger">
                                                            Delete
                                                        </button>
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
</script>