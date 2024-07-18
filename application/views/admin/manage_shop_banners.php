<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Shop Banners</h5>
                    <div class="ibox-tools">

                        <button class="btn btn-primary show_add_shop_banners">+ Add Banner</button>

                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner</th>
                                <th>App Banner</th>
                                <th>Title</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            foreach ($shop_banners as $banner) {
                                ?>
                                <tr>
                                    <td>#<?= $i ?></td>
                                    <td><img src="<?= $banner->web_banner ?>" width="30%"/></td>
                                    <td><img src="<?= $banner->app_banner ?>" width="30%"/></td>
                                    <td><?= $banner->title ?></td>
                                    <td>
                                        <button class="btn btn-xs btn-primary show_add_shop_banners">Edit</button>
                                        <button class="btn  btn-xs btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

<!--Upload Shop Banners-->
<div id="upload_shop_banners" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="classModalLabel">
                    Add/Update Shop Banners
                </h4>
            </div>
            <div class="modal-body" id="manageImagesContainer">
                <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/vendors_shops/add_shop_banner">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Web Banner</label>
                        <div class="col-sm-10">
                            <input type="file" name="banner" class="form-control" required>
                            <p>Web Banner Size: 1200X400</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Banner</label>
                        <div class="col-sm-10">
                            <input type="file" name="app_banner" class="form-control" required>
                            <p>App Banner Size: 600X300</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="1" /> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="0" /> InActive
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        console.log('loaded');
        $('.show_add_shop_banners').on('click', function () {
//            alert('hello');
            $('#upload_shop_banners').modal('show');
        });
    });


</script>

