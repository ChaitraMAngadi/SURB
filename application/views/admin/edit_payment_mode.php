<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/payment_mode">
                        <button class="btn btn-primary">BACK</button>
                    </a>
                </div>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/payment_mode/update">
                    <input type="hidden" name="id" value="<?php echo $payment_mode->id; ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Payment Mode</label>
                        <div class="col-sm-10">
                            <select name="payment_mode" id="payment_mode" class="form-control">
                                <option value="COD" <?= ($payment_mode->payment_mode == 'COD') ? 'selected' : '' ?>>COD</option>
                                <option value="ONLINE" <?= ($payment_mode->payment_mode == 'ONLINE') ? 'selected' : '' ?>>ONLINE</option>
                                <option value="BOTH" <?= ($payment_mode->payment_mode == 'BOTH') ? 'selected' : '' ?>>BOTH</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">                                       
                            <button class="btn btn-primary" id="submit" type="submit">Update</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>