<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $title ?></h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/sizes/add">
                            <button class="btn btn-primary">+ Add Size</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Size</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($sizes as $size) {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $size->size ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($size->status == 1) {
                                            ?>
                                            <button class="btn btn-xs btn-success">
                                                Active
                                            </button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-xs btn-danger">
                                                InActive
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>vendors/sizes/add/<?= $size->id ?>">
                                            <button class="btn btn-xs btn-primary">
                                                Edit
                                            </button>
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

