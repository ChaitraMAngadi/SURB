<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>users</h5>
                    
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($users)>0)
                            {
                                $i=1;
                            foreach($users as $user){ ?>
                                <tr>
                                <td><?php echo $i;?></td>
                                <td><?php if($user->image!=''){?><img src="<?php echo base_url(); ?>/uploads/users/<?php echo $user->image; ?>" style="width: 80px; height: 80px;"><?php } ?></td>
                                <td><?php echo $user->first_name." ".$user->last_name; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->phone; ?></td>
                                <td><a href="<?= base_url() ?>/vendors/users/delete/<?php echo $user->id; ?>"  onclick="if(!confirm('Are you sure you want to delete this user?')) return false;" >
                                                <button title="Delete User" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a></td>
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

