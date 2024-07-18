<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/banners">
                            <button class="btn btn-primary">BACK</button>
                        </a>


                </div>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/banners/update">

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Title</label>

                        <div class="col-sm-10">

                            <input type="hidden" name="id" value="<?= $banners->id; ?>" class="form-control" required>

                            <input type="text" name="title" value="<?= $banners->title; ?>" class="form-control" required>

                        </div>

                    </div>



                    <?php
                    if ($banners->web_banner) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/banners/<?= $banners->web_banner ?> "/>

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

                    if ($banners->app_banner) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/banners/<?= $banners->app_banner ?> "/>

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

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" type="submit"> <i class="fa fa-floppy-o"></i> Update</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>