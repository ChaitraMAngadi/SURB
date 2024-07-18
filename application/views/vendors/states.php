<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>States</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/states/add">
                            <button class="btn btn-primary">+ Add State</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Country Name</th>
                                <th>State Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($states as $st) {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $st->country_name ?></td>
                                    <td><?= $st->state_name ?></td>
                                    <td>
                                        <?php
                                        echo $st->status == 1 ? 'Active' : 'Inactive';
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-primary">Edit</button>
                                        <button class="btn btn-xs btn-danger">Delete</button>
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

