<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">

                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/sub_categories/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="cat_id" required>
                                <?php
                                foreach ($categories as $cat) {
                                    ?>
                                    <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="sub_category_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea rows="10" cols="10" name="description" class="form-control" required>

                            </textarea>
                        </div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control" required>
                                            </div>
                                        </div>-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="app_image" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       id="status37"
                                       required="required"
                                       value="Active"
                                       data-msg-required="This Status is required" value="1" checked/> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       id="status69"
                                       required="required"
                                       data-msg-required="This Status is required" value="0"/> InActive
                            </label>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit"> <i class="fa fa-plus-circle"></i> Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>