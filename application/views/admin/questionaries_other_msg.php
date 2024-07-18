<style>
    .product_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
        border: 1px solid #edecec;
    }
    .shop_title{
        font-size:17px !important;
        color: #f39c5a;
    }
    .mangeImagesGrid{
        border: 1px solid #ebe9e9;
    }
    .manageImagesGridImgView{
        width:100%;
        /*        border: 1px solid #e5e5e5;*/
        margin-bottom: 4px;
    }
    .previewImage{
        padding: 3px;
        border: 1px solid #ccc;
        margin:4px;
        width:30%;
        float:left;
    }
    .dataTables_paginate{
        display: none !important;
    }
    #DataTables_Table_0_filter label{
        display: none !important;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5 class="shop_title">Other Messages</h5>
                    <div class="ibox-tools">

                        <a href="javascript:void(0)" onclick="window.history.go(-1)">
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
                        <?php }
                        ?>

                    </div>


                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Questionary Details</th>
                                        <th>User Details</th>
                                        <th>Message</th>
                                        <th>Searched On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($kk == "") {
                                        $kk = 1;
                                    }
                                    if (sizeof($other_msg) > 0) {
                                        foreach ($other_msg as $row) {
                                            ?>
                                            <tr class="gradeX">
                                                <td><?= $kk ?></td>
                                                <td>
                                                    <b>Question : </b><?php echo $row->question; ?><br>
                                                    <b>Category : </b><?php echo $row->cat_name; ?><br>
                                                    <b>Sub-category : </b><?= $row->sub_cat_name ? $row->sub_cat_name : 'N/A' ?>
                                                </td>
                                                <td>
                                                    <b>Name : </b><?php echo $row->customer_name; ?><br>
                                                    <b>Email : </b><?php echo $row->customer_email; ?><br>
                                                    <b>Phone : </b><?php echo $row->customer_phone; ?>
                                                </td>
                                                <td>
                                                   <?= $row->message ?>
                                                </td>
                                                <td>
                                                    <?= date('d M, Y h:i A', $row->created_at) ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>admin/questionaries/delete_other_msg/<?= $row->id; ?>"><button class="btn btn-xs btn-danger" onclick="if(!confirm('Are you sure you want to delete?')) return false;">Delete</button></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $kk++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center">
                                                <h4>No Message Found</h4>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>

                            <div class="pagination-bx  clearfix ">
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
        #UpdatePricesModal .form-control{
            margin-bottom: 10px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>