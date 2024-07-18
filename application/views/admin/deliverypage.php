<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Assign Delivery Boy</h5>
                <div class="ibox-tools">

                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/orders/assignDeliveryBoy">
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <label class="col-sm-2 control-label">Select Delivery Boy</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="db_id" required>
                                <?php
                                foreach ($deliverypersons as $del) {
                                    ?>
                                    <option value="<?php echo $del->id; ?>"><?php echo $del->name." - ".$del->phone; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit"> <i class="fa fa-plus-circle"></i> Assign</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>