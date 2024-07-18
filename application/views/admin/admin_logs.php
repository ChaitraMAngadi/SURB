<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Admin Login Log Details</h5>
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
                    <table  class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Ip Address</th>
                                <th>Date & Time</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             if (isset($logs) && (count($logs) > 0)) {
                                $i=1;
                            foreach($logs as $log){ ?>
                                <tr>
                                <td>#<?php echo $i;?></td>
                                <td><?php echo $log->user_id; ?></td>
                                <td><?php echo $log->admin; ?></td>
                                <td><?php echo $log->ip; ?></td>
                                <td><?php echo date('d M Y , h:i A',strtotime($log->date)); ?></td>

                                <!-- <td><a href="<?= base_url() ?>/admin/logs/delete/<?php echo $contact->id; ?>"  onclick="if(!confirm('Are you sure you want to delete this contact details?')) return false;" >
                                                <button title="Delete User" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a>
                                           
                                        </td> -->
                            </tr>
                            <?php $i++; } }else{ ?>
                            <tr>
                                <td colspan="8" style="text-align: center">
                                    <h4>No Message Found</h4>
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


</div>

