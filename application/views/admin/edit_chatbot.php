<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                    <a href="<?= base_url() ?>admin/chatbot">
                        <button class="btn btn-primary">BACK</button>
                    </a>
                </div>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/chatbot/update">
                    <input type="hidden" name="id" value="<?php echo $chatbot->id; ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Script</label>
                        <div class="col-sm-10">
                            <textarea rows="20" cols="20" id="script" name="script" class="form-control"><?php echo $chatbot->script; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control">
                                <option value="active" <?= ($chatbot->status == 'active') ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= ($chatbot->status == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">                                       
                            <button class="btn btn-primary" id="submit" type="submit">Update</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>