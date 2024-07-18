<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $title ?></h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/tax/add">
                            <button class="btn btn-primary">+ Add Tax</button>
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
                                <th>Tax Name</th>
                                <th>Type</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($tax as $tax) {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i; ?></td>
                                    <td><?= $tax->title; ?></td>
                                    <td><?= $tax->type; ?></td>
                                    <td><?= $tax->amount; ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/tax/add/<?= $tax->id ?>">
                                            <button class="btn btn-xs btn-primary">
                                                Edit
                                            </button>
                                        </a>
                                        <a href="<?= base_url() ?>admin/tax/delete/<?= $tax->id; ?>">
                                            <button class="btn btn-xs btn-danger delete_product" data-id="<?= $v['id']; ?>" onclick="if(!confirm('Are you sure you want to delete this row?')) return false;"><i class="fa fa-trash-o"></i> Delete</button></a>
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

