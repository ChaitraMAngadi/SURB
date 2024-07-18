<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Transactions</h5>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sender Name</th>
                                <th>Receiver Name</th>
                                <th>Amount</th>
                                <th>Message</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($transactions)>0)
                            {
                                $i=1;
                            foreach($transactions as $v){ ?>
                                <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $v->sender_name ?></td>
                                <td><?php echo $v->receiver_name ?></td>
                                <td><?php echo $v->amount; ?></td>
                                <td><?php echo $v->message; ?></td>
                                <td><?php echo date("d M,Y h:i A",$v->created_at);?></td>
                            </tr>
                            <?php $i++; } }else{ ?>
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

