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
                    <h5>Prime Membership</h5>
                   
                         <div class="ibox-tools">
                         <a href="<?= base_url() ?>admin/prime/addPrime">
                         <button class="btn btn-primary">Add Prime&nbsp;&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i></button>
                         </a>
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

                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Name</th>
                                    <th>Prime Membership value</th>
                                    <th>Prime Membership validity in days</th>
                                    <th class="notexport">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($prime as $v) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <?php echo $v->Description;?>
                                         </td>
                                          <td>
                                            <?php echo $v->Name;?>
                                          </td>
                                          <td>
                                            <?php echo $v->value;?>
                                            </td>
                                            <td>
                                            <?php echo !empty($v->validity) ? $v->validity : 'Lifetime';?>
                                          </td>
                                        <td>
                                            <div><a href="<?php echo base_url();?>admin/prime/edit/<?php echo $v->id;?>">
                                           <button class="btn btn-info">Edit</button>
                                            </a> 
                                            <a href="<?php echo base_url();?>admin/prime/delete/<?php echo $v->id;?>">
                                                <button class="btn btn-danger">
                                                    Delete
                                               </button>
                                            </a></div>
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
