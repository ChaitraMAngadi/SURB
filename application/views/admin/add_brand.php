<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/brands">
                        <button class="btn btn-primary">BACK</button>
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
                <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/brands/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="brand_id" class="form-control" value="<?php
                            if ($brand) {
                                echo $brand->id;
                            } else {
                                echo '';
                            }
                            ?>">
                            <input type="text" name="brand_name" id="brand" class="form-control" value="<?php
                            if ($brand) {
                                echo $brand->brand_name;
                            } else {
                                echo '';
                            }
                            ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="1" <?php
                                       if ($brand->status == 1) {
                                           echo 'checked';
                                       } else {
                                           echo '';
                                       }
                                       ?>/> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="0" <?php
                                       if ($brand->status == 0) {
                                           echo 'checked';
                                       } else {
                                           echo '';
                                       }
                                       ?>/> InActive
                            </label>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_brands" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_brands').click(function () {
        $('.error').remove();
        var errr = 0;
        if ($('#brand').val() == '' || $('#brand').val().trim() == "")
        {
            $('#brand').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Brands</span>');
            $('#brand').focus();
            return false;
        }

    });

    $("#brand").keypress(function (e) {
        //var key = e.keyCode;
        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
        if (!valid) {
            e.preventDefault();
        }
    });
</script>