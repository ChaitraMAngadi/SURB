<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Users</h5>
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
                <form method="post" action="<?= base_url() ?>admin/users">

                <input class="form-control input-sm w-50 border-primary" type="text" name="keyword" value="<?= set_value('keyword') ?>" required="" placeholder="Enter keyword" style="width:350px;"><br>
                <input type="submit" class="btn btn-success mt-2" name="submit" value="Search">
                <a href="<?= base_url('admin/users') ?>"><input type="button" class="btn btn-danger mt-2" name="reset" value="Reset"></a>
                </form><br><br>
                    <table  class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr class="gradeX">
                                <th>#</th>
<!--                                <th>Image</th>-->
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Tags</th>
                                <th>Membership</th>
                                <th>Plan</th>
                                <th>Created plan date</th>
                                <th>Expiry plan date</th>
                                <th class="notexport">Action</th>
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
                                <td><?php echo $user->first_name." ".$user->last_name; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->phone; ?></td>
                                <td><?php echo $user->Tag;?></td>
                                <td><?php echo $user->membership;?></td>
                                <td><?php echo $user->plan;?></td>
                                <td><?php echo $user->created_member_date;?></td>
                                <td><?php echo $user->expiry_member_date;?></td>
                                <td><a href="<?= base_url() ?>admin/users/delete/<?php echo $user->id; ?>"  onclick="if(!confirm('Are you sure you want to delete this user?')) return false;" >
                                                <button title="Delete User" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/users/view/<?php echo $user->id; ?>"><button title="View User" class="btn btn-xs btn-success">View</button></a>
                                            <a href="<?= base_url() ?>admin/users/edit/<?php echo $user->id; ?>"><button title="Edit User" class="btn btn-xs btn-success">Edit</button></a>
                                        </td>
                            </tr>
                            <?php $i++; } }else{ ?>
                            <tr>
                                <td colspan="8" style="text-align: center">
                                    <h4>No users Found</h4>
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

