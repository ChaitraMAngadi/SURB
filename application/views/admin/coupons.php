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
                    <h5>Coupon codes</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <a href="<?= base_url() ?>admin/coupons/add">
                            <button class="btn btn-primary">+ Add Coupon code</button>
                        </a>
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
                    <?php }
                    ?>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Coupon Code</th>
                                    <th>Percentage</th>
                                    <th>Maximum Amount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Utilization</th>
                                    <th> Minimum Order Amount</th> 
                                    <th>Limit</th>
                                    <th>Tags</th>   
                                    <th>Brands</th>                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($coupons as $v) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v->coupon_code; ?></td>
                                        <td><?php echo $v->percentage."%"; ?></td>
                                        <td><?php echo $v->maximum_amount; ?></td>
                                        <td><?php echo $v->start_date; ?></td>
                                        <td><?php echo $v->expiry_date; ?></td>
                                       <td><?php echo $v->utilization; ?></td>
                                        <td><?php echo $v->minimum_order_amount; ?></td>
                                        <td><?php echo $v->limit_user;?></td>
                                        <td><?php print_r($v->Tag);?></td>
                                        <td><?php echo $v->brands;?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/coupons/edit/<?= $v->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="<?= base_url() ?>admin/coupons/delete/<?= $v->id ?>">
                                                <button title="Delete Coupon" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a>
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
</div>
