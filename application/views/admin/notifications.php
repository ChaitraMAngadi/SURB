<style>
    .product_image {
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
        border: 1px solid #edecec;
    }
    .shop_title {
        font-size: 17px !important;
        color: #f39c5a;
    }
    .mangeImagesGrid {
        border: 1px solid #ebe9e9;
    }
    .manageImagesGridImgView {
        width: 100%;
        margin-bottom: 4px;
    }
    .previewImage {
        padding: 3px;
        border: 1px solid #ccc;
        margin: 4px;
        width: 30%;
        float: left;
    }
    .dataTables_paginate {
        display: none !important;
    }
    #DataTables_Table_0_filter label {
        display: none !important;
    }
    .notification-row {
        cursor: pointer;
    }
    .notification-unread {
        font-weight: bold;
    }
    .notification-read {
        font-weight: normal;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="shop_title">Notifications</h5>
                    <div class="ibox-tools">
                        <?php if ($count_data > 0) { ?>
                            <a href="<?= base_url() ?>admin/notifications/?action=clear" onclick="return confirm('Do you want to clear all notifications?')">
                                <button class="btn btn-primary">Clear All</button>
                            </a>
                        <?php } ?>
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                        <?php if (!empty($this->session->tempdata('success_message'))) { ?>
                            <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($this->session->tempdata('error_message'))) { ?>
                            <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>Failed!</strong> <?= $this->session->tempdata('error_message') ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                        <div class="form-group">
                            <label for="notificationFilter">Filter by:</label>
                            <select id="notificationFilter" class="form-control">
                                <option value="all">All</option>
                                <option value="payment">Payment</option>
                                <option value="inactive">Product Inactive</option>
                                <option value="order placed">Order placed</option>
                                <option value="order shipped">Order shipped</option>
                                <option value="delivered">Order delivered</option>
                                <option value="transit">Transit</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vendor Name</th>
                                        <th>Notification</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($kk == "") {
                                        $kk = 1;
                                    }
                                    if ($count_data > 0) {
                                        foreach ($notifications as $row) {
                                            $readClass = $row->is_read ? 'notification-read' : 'notification-unread';
                                            ?>
                                            <tr class="gradeX notification-row <?= $readClass ?>" data-id="<?= $row->id ?>" data-type="<?= strtolower($row->message) ?>">
                                                <td><?= $kk ?></td>
                                                <td>
                                                    <a target="_blank">
                                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/login/admin_login/">
                                                            <input type="hidden" name="email" class="form-control" value="<?php echo $row->vendor_data->mobile; ?>">
                                                            <input type="hidden" name="password" class="form-control" value="<?php echo $row->vendor_data->password; ?>">
                                                            <input type="hidden" name="md5" class="form-control" value="1">
                                                            <button type="submit" onclick="this.form.target = '_blank';return true;" style="border: none; outline: none; background: transparent;"><?php echo $row->vendor_data->shop_name; ?></button>
                                                        </form>
                                                    </a>
                                                </td>
                                                <td><?= $row->message ?><?= $row->session_id ? ' (Ref. ID: ' . $row->session_id . ')' : '' ?></td>
                                                <td><?= date('d M, Y h:i A', $row->created_date) ?></td>
                                            </tr>
                                            <?php
                                            $kk++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5" style="text-align: center">
                                                <h4>No Notification Found</h4>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="pagination-bx clearfix">
                                <?= $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Prices Modal-->
    <style>
        #UpdatePricesModal .form-control {
            margin-bottom: 10px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
       $(document).ready(function(){
        $('#notificationFilter').change(function(){
            var filter = $(this).val();
            $('.notification-row').each(function(){
                var messageType = $(this).data('type');
                if(filter === 'all') {
                    $(this).show();
                }else if(filter === 'others') {
                    if(!messageType.includes('payment') && !messageType.includes('order placed') && !messageType.includes('order shipped') && !messageType.includes('delivered') && !messageType.includes('transit') && !messageType.includes('inactive')){
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }  else {
                    if(messageType.includes(filter)){
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        });

        $('.notification-row').click(function(){
            var row = $(this);
            var notificationId = row.data('id');
            $.ajax({
                url: '<?= base_url() ?>admin/notifications/mark_as_read',
                method: 'POST',
                data: {id: notificationId},
                success: function(){
                    row.removeClass('notification-unread').addClass('notification-read');
                }
            });
        });
    });
    </script>
</div>
