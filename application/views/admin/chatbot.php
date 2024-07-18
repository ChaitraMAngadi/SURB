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
                    <h5>Chat bot</h5>
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Script</th>
                                    <th>Status</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td><?php echo 1; ?></td>
                                    <td>--chatbot script--</td>
                                    <td>
                                        <?php if ($chatbot->status == 'active') { ?>
                                            <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-success">
                                                Active
                                            </button>
                                        <?php } else { ?>
                                            <button title="This operation is disabled in demo !" disabled="" class="btn btn-xs btn-danger">
                                                In Active
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td><?= date('Y-m-d h:i A', $chatbot->updated_at) ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/chatbot/edit/<?= $chatbot->id ?>">
                                            <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                Edit
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>