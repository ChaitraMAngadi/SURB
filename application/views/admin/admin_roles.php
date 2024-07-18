<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Roles</h5>
                        <div class="ibox-tools">
                            <a href="<?= base_url() ?>admin/dashboard">
                                <button class="btn btn-primary">BACK</button>
                            </a>
                            <a href="<?= base_url() ?>admin/add_role">
                                <button class="btn btn-primary">+ Add Role</button>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Max Users</th>
                                        <th>Features</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($roles as $role) {
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $role->role_name; ?></td>
                                            <td><?php echo $role->max_users; ?></td>
                                            <td><?php echo $role->features; ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>admin/add_role/edit/<?= $role->id ?>">
                                                    <button class="btn btn-xs btn-primary">Edit</button>
                                                </a>
                                                <a href="<?= base_url() ?>admin/roles/delete/<?= $role->id ?>">
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </a>
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