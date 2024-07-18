<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="shop_title">Vendor Revenue</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                    </div>
                </div>

                <?php if (!empty($this->session->tempdata('success_message'))) : ?>
                    <div class="alert alert-success fade in alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> <?= $this->session->tempdata('success_message') ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($this->session->tempdata('error_message'))) : ?>
                    <div class="alert alert-danger fade in alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Failed!</strong> <?= $this->session->tempdata('error_message') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/process_form_data" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vendor ID</th>
                                <th>Vendor Name</th>
                                <th>Total Vendor Revenue</th>
                                <th>Admin Commission</th>
                                <th>Total GST</th>
                                <th>Net Revenue Vendor</th>
                                <th>Shipping Charges</th>
                                <th>Total Payouts</th>
                                <th>Payouts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($vendor_revenue)) : ?>
                                <?php foreach ($vendor_revenue as $vendor) : ?>
                                    <tr>
                                        <td><?= $vendor->id; ?></td>
                                        <td><?= $vendor->shop_name; ?></td>
                                        <td><?= number_format($vendor->total_vendor_revenue, 2); ?></td>
                                        <td><?= number_format($vendor->admin_commission, 2); ?></td>
                                        <td><?= number_format($vendor->gst, 2); ?></td>
                                        <td><?= number_format($vendor->vendor_commission, 2); ?></td>
                                        <td><?= number_format($vendor->deliveryboy_commission, 2); ?></td>
                                        <td><?= number_format($vendor->total_payouts, 2); ?></td>
                                        <td><?= number_format($vendor->payouts, 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
