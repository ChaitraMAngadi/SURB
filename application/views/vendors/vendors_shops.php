<style>
    .shop_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        margin-right:5px;
        border-radius: 10px;
        border: 1px solid #efeded;
    }
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
                    <h5 class="shop_title">Vendors-Shops </h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/vendors_shops/add">
                            <button class="btn btn-primary">+ Add Vendor</button>
                        </a>
                    </div>
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
                <div class="ibox-content">
                    <form class="form" action="">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Search key</label>
                                <input type="q" class="form-control" id="q" name="q" value="<?= isset($q) ? $q : '' ?>" placeholder="Search by Store Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="">All</option>
                                    <option value="1" <?= isset($status) ? $status == '1' ? 'selected' : '' : '' ?>>Active</option>
                                    <option value="0" <?= isset($status) ? $status == '0' ? 'selected' : '' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Deals of the day</label>
                                <select class="form-control" name="deals_of_the_day">
                                    <option value="">Select</option>
                                    <option value="Yes" <?= isset($deals_of_the_day) ? $deals_of_the_day == 'Yes' ? 'selected' : '' : '' ?>>Yes</option>
                                    <option value="No" <?= isset($deals_of_the_day) ? $deals_of_the_day == 'No' ? 'selected' : '' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>City</label>
                                <select class="form-control chosen-select" name="city_id">
                                    <option value="">All Cities</option>
                                    <?php
                                    foreach ($cities as $ct) {
                                        ?>
                                        <option value="<?= $ct->id ?>" <?= isset($city_id) ? $city_id == $ct->id ? 'selected' : '' : '' ?>><?= $ct->city_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Visual Merchants</label>
                                <select class="form-control chosen-select" name="vm_id">
                                    <option value="">All</option>
                                    <?php
                                    foreach ($visual_merchant as $vm) {
                                        ?>
                                        <option value="<?= $vm->id ?>" <?= isset($vm_id) ? $vm_id == $vm->id ? 'selected' : '' : '' ?>><?= $vm->name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Categories</label>
                                <select class="form-control chosen-select" name="category_id">
                                    <option value="">All</option>
                                    <?php
                                    foreach ($categories as $cat) {
                                        ?>
                                        <option value="<?= $cat->id ?>" <?= isset($cat_id) ? $cat_id == $cat->id ? 'selected' : '' : '' ?>><?= $cat->category_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <!--                            <div class="form-group col-md-3">
                                                            <label>Show Deals Based Stores</label>
                                                            <select class="form-control chosen-select" name="deal_of_the_day">
                                                                <option value="">All</option>
                                                                <option  value="yes">Yes</option>
                                                                <option  value="no">No</option>
                                                                <option  value="expired">Expired Deals</option>
                                                            </select>
                                                        </div>-->

                            <!--                            <div class="form-group col-md-3">
                                                            <label>Agreement Status</label>
                                                            <select class="form-control chosen-select" name="agreement_status">
                                                                <option value="">All</option>
                                                                <option  value="Accepted">Accepted</option>
                                                                <option  value="Pending">Pending</option>
                                                            </select>
                                                        </div>-->

                            <button type="submit" class="btn btn-info" style="margin-top: 24px">Submit</button>
                            <a href="<?= base_url() ?>vendors/vendors_shops" class="btn btn-danger" style="margin-top: 24px">Reset</a>
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor Details</th>
                                <th>Contact Details</th>
                                <th>Visual Merchant</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($vendor_shops as $shop) {
                                ?>
                                <tr class="gradeX">
                                    <td>#<?= $i ?></td>
                                    <td>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/shops/<?= $shop->shop_logo ?>" title="">

                                        <p><b>Vendor: </b><span class="font-weight500"><?= $shop->shop_name ?></span></p>
                                        <p><b>Address: </b><span class="font-weight500"><?= $shop->address ?></span></span></p>

                                    </td>
                                    <td>
                                        <b>Owner Name:</b> <?= $shop->owner_name ?><br>
                                        <b>Email:</b> <?= $shop->email ?><br>
                                        <b>Mobile:</b> <?= $shop->mobile ?>
                                    </td>
                                    <td class="center"><?= $shop->visual_merchant ?></td>
                                    <td class="center">
                                        <?php
                                        if ($shop->status == 1) {
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
                                    <td class="center">
                                        <button title="Disabled" disabled="" class="btn btn-xs btn-primary">
                                            Edit
                                        </button>
                                        <a href="<?= base_url() ?>vendors/vendors_shops/manage_work_hours/<?= $shop->id ?>">
                                            <button title="Manage Work Hours" class="btn btn-xs btn-primary">
                                                Manage Work Hours
                                            </button>
                                        </a>
                                        <a href="<?= base_url() ?>vendors/products?shop_id=<?= $shop->id ?>">
                                            <button title="Products" class="btn btn-xs btn-success">
                                                Products (<?= $shop->total_products ?>)
                                            </button>
                                        </a>
                                        <a href="<?= base_url() ?>vendors/vendors_shops/manage_categories?shop_id=<?= $shop->id ?>">
                                            <button title="Products" class="btn btn-xs btn-success">
                                                Manage Categories(<?= $shop->total_categories ?>)
                                            </button>
                                        </a>
                                        <a href="<?= base_url() ?>vendors/vendors_shops/manage_shop_banners?shop_id=<?= $shop->id ?>">
                                            <button title="Products" class="btn btn-xs btn-success">
                                                Manage Banners(0)
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

