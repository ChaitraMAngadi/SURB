<style>
    .cat_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Order Placed Invoice</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        
<!--                        <a href="<?= base_url() ?>vendors/banners/add">
                            <button class="btn btn-primary">+ Add Banner</button>
                        </a>-->
                    </div>

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
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>sl</th>
                                    <th>Subject</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Footer</th>
                                    <th>Update Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    <tr class="gradeX">
                                        <td>1</td>
                                       
                                        <td><?php echo $delivered_invoice->subject; ?></td>
                                        <td><?php echo $delivered_invoice->title; ?></td>
                                        <td><?php echo $delivered_invoice->message; ?></td>
                                        <td><?php echo $delivered_invoice->footer; ?></td>
                                        <td><?php echo $delivered_invoice->updated_at; ?></td>
                                       
                                        <td>
                                            <a href="<?= base_url() ?>admin/order_placed_invoice/edit/<?= $delivered_invoice->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                           
                                        </td>


                                    </tr>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
