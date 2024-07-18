<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">

                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/categories/update">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="cat_id" value="<?= $category->id; ?>" class="form-control" required>
                            <input type="text" name="category_name" value="<?= $category->category_name; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea rows="10" cols="10" name="description" class="form-control" required><?= $category->description; ?></textarea>
                        </div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control" required>
                                            </div>
                                        </div>-->

                    <?php
                    if ($category->app_image) {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Preview</label>
                            <div class="col-sm-10">
                                <img width="200px" src="<?= base_url() ?>uploads/categories/<?= $category->app_image ?> "/>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">App Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="app_image" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       id="status"
                                       required="required"
                                       <?= $category->status == 1 ? 'checked' : '' ?>
                                       data-msg-required="This Status is required" value="1" /> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       <?= $category->status == 0 ? 'checked' : '' ?>
                                       id="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="0"/> InActive
                            </label>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit"> <i class="fa fa-floppy-o"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>