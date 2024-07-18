<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">

                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" action="<?= base_url() ?>vendors/filtergroups/insert">


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Filter Group Name</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="filtergroup_id" class="form-control" value="<?php
                            if ($filtergroup) {
                                echo $filtergroup->id;
                            } else {
                                echo '';
                            }
                            ?>">
                            <input type="text" name="filter_group_name" class="form-control" value="<?php
                            if ($filtergroup) {
                                echo $filtergroup->filter_group_name;
                            } else {
                                echo '';
                            }
                            ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Group Values (coma seperated values)</label>
                        <div class="col-sm-10">
                            <textarea rows="5" cols="10" name="group_values" class="form-control" required><?php
                                if ($filtergroup) {
                                    echo $filtergroup->group_values;
                                } else {
                                    echo '';
                                }
                                ?></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Categories</label>
                        <div class="col-sm-10">
                            <!--<input type="text" name="pincode" class="form-control" required>-->
                            <?php
                            foreach ($categories as $cat) {
                                ?>
                                <label class="checkbox-inline">
                                    <input style="width:20px;height:20px" type="checkbox" name="categories[]" value="<?= $cat->id ?>" id="inlineCheckbox1"
                                    <?php
                                    $hiddenCat = explode(',', $filtergroup->cat_ids);
                                    if (in_array($cat->id, $hiddenCat)) {
                                        echo 'checked';
                                    }
                                    ?>>

                                    <p style="margin: 3px 8px;"><?= $cat->category_name; ?></p>
                                </label>

                                <?php
                            }
                            ?>


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
                                       if ($filtergroup->status == 1) {
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
                                       if ($filtergroup->status == 0) {
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