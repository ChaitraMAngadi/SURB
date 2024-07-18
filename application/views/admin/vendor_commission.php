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

                    <h5 class="shop_title">Vendors Payouts</h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
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

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                
                                <th>Order ID</th>
                                <th>Vendor Details</th>
                                <th>Total Commission</th>
                                <th>Requested Amount</th>
                                <th>Settled Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ks = 1;
                            foreach ($vendor_commissions as $value) {
                                $qry = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                                $shop = $qry->row();
                                ?>
                                   <tr class="gradeX">
                                        <tr>                                            
                                            <td>#<?= $value->id; ?></td>
                                            <td><?php if($shop->shop_logo!=''){ ?>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/shops/<?= $shop->shop_logo ?>" title="">
                                        <?php }else{ ?>
                                            <img class="shop_image" align="left" src="<?= base_url() ?>uploads/noproduct.png" title="">
                                        <?php } ?>
                                        <p><b>Vendor: </b><span class="font-weight500"><?= $shop->shop_name ?></span></p>
                                         <b>Owner Name:</b> <?= $shop->owner_name ?><br>
                                        <b>Email:</b> <?= $shop->email ?><br>
                                        <b>Mobile:</b> <?= $shop->mobile ?>
                                        <p><b>Address: </b><span class="font-weight500"><?= $shop->address ?></span></p></td>
                                            <td>₹<?= $value->tvendorc; ?></td>
                                            <td><?php 
                                        $pending = $this->db->query("SELECT SUM(request_amount) as vendor_requested_amount FROM `request_payment` where vendor_id='".$value->vendor_id."' and status=0");
                                            $pending_row = $pending->row();
                                            if($pending_row->vendor_requested_amount!=''){
                                  
                                         echo "₹".$pending_row->vendor_requested_amount; } ?>
                                    </td>
                                            <td> <?php 
                                        $complete = $this->db->query("SELECT SUM(request_amount) as vendor_completed_amount FROM `request_payment` where vendor_id='".$value->vendor_id."' and status=1");
                                            $complete_row = $complete->row();
                                            if($complete_row->vendor_completed_amount!=''){
                                    ?>
                                    ₹<?php echo $complete_row->vendor_completed_amount; } ?></td>
                                             <td><a href="<?php echo base_url(); ?>admin/vendor_commission/categoryDetails/<?php echo $value->vendor_id; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  View </button></a></td>
                                        </tr>
                                   </tr>

                                <?php
                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>





</div>



