<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Visual Merchants</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/visual_merchants/add">
                            <button class="btn btn-primary">+ Add Visual Merchant</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>City</th>
                                    <th>No.of Shops</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($visual_merchants as $vm) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $vm->name ?></td>
                                        <td><?= $vm->email ?></td>
                                        <td><?= $vm->mobile ?></td>
                                        <td class="center"><?= $vm->city ?></td>
                                        <td class="center">
                                            <a href="<?= base_url() ?>vendors/vendors_shops?vm_id=<?= $vm->id ?>">
                                                <button title="Products" class="btn btn-xs btn-success">
                                                    Stores (<?= $vm->no_of_shops ?>)
                                                </button>
                                            </a>


                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>City</th>
                                    <th>No.of Shops</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>