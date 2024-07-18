<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/banneradds">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/banneradds/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Web Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="webimage" class="form-control" required>
                             <span class="help-block m-b-none" style="color:red;">Web Image Width : 1024px and height : 400px</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="appimage" class="form-control" required>
                             <span class="help-block m-b-none" style="color:red;">App Image Width : 900px and height : 400px</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Blocks</label>
                        <div class="col-sm-10">
                           <select name="blocks" id="blocks" class="form-control" required="">
                               <option>Select Block</option>
                               <option value="1">Home Banner Ad 1</option>
                               <option value="2">Home Banner Ad 2</option>
                           </select>
                             
                        </div>
                    </div>
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