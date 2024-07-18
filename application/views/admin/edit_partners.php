<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/our_partners">
                        <button class="btn btn-primary">BACK</button>
                    </a>

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

            </div>

            <div class="ibox-content">

                <form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url() ?>admin/our_partners/update">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Partner Image</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="id" name="id" value="<?= $our_partners->id ?>">
                            <input type="file" id="image" name="image" accept="image/*" class="form-control">
                            <span class="help-block m-b-none" style="color:red;">Category Image Width : 245px and height : 80px</span>
                        </div>
                        <div style="position: relative;left: 16%"><img class="product_image" align="left" src="<?= base_url('uploads/our_partners/').$our_partners->image ?>"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="1" <?= $our_partners->status == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $our_partners->status == 0 ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">                                       

                            <button class="btn btn-primary" id="add_partner" type="submit">Save</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    $('#add_partner').click(function () {
        $('.error').remove();
        var errr = 0;

        if (($('#status').val() == '') || ($('#status').val().trim() == ""))
        {
            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
            $('#status').focus();
            return false;
        }

    });

</script>