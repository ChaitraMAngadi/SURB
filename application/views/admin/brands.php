<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $title ?></h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <a href="<?= base_url() ?>admin/brands/add">
                            <button class="btn btn-primary">+ Add Brand</button>
                        </a>
                    </div>
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

                <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($brands as $brand) {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $brand->brand_name ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($brand->status == 1) {
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
                                        <a href="<?= base_url() ?>admin/brands/add/<?= $brand->id ?>">
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

