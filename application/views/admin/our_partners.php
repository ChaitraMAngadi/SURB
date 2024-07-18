<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Our Partners</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                        <a href="<?= base_url() ?>admin/our_partners/add">
                            <button class="btn btn-primary">+ Add Partner </button>
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
                                <th>Partner Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($our_partners as $partner) {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><img class="product_image" align="left" src="<?= base_url('uploads/our_partners/').$partner->image ?>"></td>
                                    <td><?php echo $partner->status == 1 ? 'Active' : 'Inactive'; ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/our_partners/edit/<?= $partner->id ?>"><button class="btn btn-xs btn-primary">Edit</button></a>
                                        <a href="<?= base_url() ?>admin/our_partners/delete/<?= $partner->id; ?>"><button class="btn btn-xs btn-danger" onclick="if (!confirm('Are you sure you want to remove this partner?'))
                                                    return false;">Delete</button></a>
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