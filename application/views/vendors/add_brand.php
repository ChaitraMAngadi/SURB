<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">

                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" action="<?= base_url() ?>vendors/brands/insert">
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
                            <input type="text" name="brand_name" class="form-control" value="<?php
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
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>