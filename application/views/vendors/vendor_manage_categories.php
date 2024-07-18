<style>
    .shop_title{
        font-size:17px !important;
        color: #f39c5a;
    }
</style>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="shop_title">Manage Categories - <?= $shop_name ?></h5>
                    <div class="ibox-tools">

                    </div>
                </div>
                <?php if (!empty($this->session->tempdata('success_message'))) { ?>
                    <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <?= $this->session->tempdata('success_message') ?>
                    </div>
                <?php } ?>
                <?php if (!empty($this->session->tempdata('error_message'))) { ?>
                    <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <?= $this->session->tempdata('error_message') ?>
                    </div>
                <?php }
                ?>
                <div class="ibox-content">

                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/vendors_shops/insert_cat_comission/"
                          style="background: #f4f4f5;padding: 10px;border-radius: 10px;">
                        <h3>Add/Update Admin Comission</h3>

                        <div class="form-group">

                            <div class="col-sm-3">
                                <label class="control-label">Category Name: *</label>
                                <input type="hidden" name="shop_id" class="form-control" value="<?= $shop_id ?>" required>
                                <select class="form-control" name="cat_id" id="shop_category" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($categories as $cat) {
                                        ?>
                                        <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>


                            <div class="col-sm-3">
                                <label class="control-label">Admin Comission: *</label>
                                <input type="text" name="admin_comission" id="admin_comm_value" class="form-control" required>
                            </div>
                            <div class="col-sm-3" style="margin-top: 6px;">
                                <label class="control-label">Status: *</label><br>
                                <label class='text-success'>
                                    <input type="radio"
                                           name="status"
                                           id="admin_comm_status1"
                                           required="required"
                                           data-msg-required="This Status is required" value="1" /> Active
                                </label> &nbsp;&nbsp;
                                <label class='text-danger'>
                                    <input type="radio"
                                           name="status"
                                           id="admin_comm_status0"
                                           required="required"
                                           data-msg-required="This Status is required" value="0" /> InActive
                                </label>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-primary" type="submit" style="margin-top:25px">
                                    Add/Update
                                </button>
                            </div>
                        </div>


                    </form>
                    <br>
                    <h3>Category Comissions</h3>

                    <table id="classTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Category</th>
                                <th>Admin Comission(%)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($admin_comissions as $com) {
                                ?>
                                <tr>
                                    <td>#<?= $i ?></td>
                                    <td><?= $com->category_name ?></td>
                                    <td><?= $com->admin_comission ?></td>
                                    <td>
                                        <?php
                                        if ($com->status == 1) {
                                            ?>
                                            <button title="Active" class="btn btn-xs btn-green">
                                                Active
                                            </button>
                                            <?php
                                        } else {
                                            ?>
                                            <button title="Inactive" class="btn btn-xs btn-danger">
                                                Inactive
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-success edit_admin_comission"
                                                data-id="<?= $com->id ?>"
                                                data-cat_id="<?= $com->cat_id ?>"
                                                data-admin_com="<?= $com->admin_comission ?>"
                                                data-status="<?= $com->status ?>">Edit</button>
                                        <button class="btn btn-xs btn-danger delete_admin_comission"
                                                data-id="<?= $com->id ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function () {
        console.log('loaded');
        $('.edit_admin_comission').on('click', function () {
            console.log($(this).attr('data-admin_com'));
            var id = $(this).attr('data-id');
            var cat_id = $(this).attr('data-cat_id');
            var admin_com = $(this).attr('data-admin_com');
            var status = $(this).attr('data-status');

            $('#shop_category').val(cat_id);
            $('#admin_comm_value').val(admin_com);
            if (status === '1') {
                $("input[name='status'][value='1']").attr("checked", true);
            } else {
                $("input[name='status'][value='0']").attr("checked", true);
            }
        });


        $('.delete_admin_comission').on('click', function () {
            var admin_com_id = $(this).attr('data-id');
            console.log(admin_com_id);
            var confirm = window.confirm('Are you sure, want to delete this admin comission ?');
            if (confirm) {
                var location = '<?= base_url() ?>vendors/vendors_shops/delete_vendor_admin_comission?admin_com_id=' + admin_com_id + '&shop_id=' + <?= $shop_id ?>;
                console.log(location);
                window.location = location;
            } else {
                console.log('not confirmed');
            }
        });





    });

</script>