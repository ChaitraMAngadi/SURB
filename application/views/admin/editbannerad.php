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

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/banneradds/update">

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Title</label>

                        <div class="col-sm-10">

                            <input type="hidden" name="id" value="<?= $banners->id; ?>" class="form-control" required>

                            <input type="text" name="title" value="<?= $banners->title; ?>" class="form-control" required>

                        </div>

                    </div>



                    <?php

                    if ($banners->web_image) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/bannerads/<?= $banners->web_image ?> "/>

                            </div>

                        </div>

                        <?php

                    }

                    ?>

                    <div class="form-group">



                        <label class="col-sm-2 control-label">App Image</label>

                        <div class="col-sm-10">

                            <input type="file" name="webimage" class="form-control">

                        </div>

                    </div>

                     <?php

                    if ($banners->app_image) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/bannerads/<?= $banners->app_image ?> "/>

                            </div>

                        </div>

                        <?php

                    }

                    ?>

                    <div class="form-group">



                        <label class="col-sm-2 control-label">Web Image</label>

                        <div class="col-sm-10">

                            <input type="file" name="appimage" class="form-control">

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Blocks</label>
                        <div class="col-sm-10">
                           <select name="blocks" id="blocks" required="" class="form-control">
                               <option>Select Block</option>
                               <option value="1" <?php if($banners->blocks==1){ echo 'selected="selected"'; } ?>>Home Banner Ad 1</option>
                               <option value="2" <?php if($banners->blocks==2){ echo 'selected="selected"'; } ?>>Home Banner Ad 2</option>
                           </select>
                             
                        </div>
                    </div>


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