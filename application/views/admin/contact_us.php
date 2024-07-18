<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Contact us Details</h5>
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
                    <table  class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>designation</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Request Type</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($contact_us)>0)
                            {
                                $i=1;
                            foreach($contact_us as $contact){ ?>
                                <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $contact->name; ?></td>
                                <td><?php echo $contact->company_name;?>
                                <td><?php echo $contact->Designation;?>
                                <td><?php echo $contact->email; ?></td>
                                <td><?php echo $contact->mobile; ?></td>
                                <td><?php echo $contact->request_type; ?></td>
                                <td><?php echo $contact->message; ?></td>
                                <td><?php echo $contact->created_at; ?></td>
                                <td><a href="<?= base_url() ?>/admin/contact_us/delete/<?php echo $contact->id; ?>"  onclick="if(!confirm('Are you sure you want to delete this contact details?')) return false;" >
                                                <button title="Delete User" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a>
                                           
                                        </td>
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

