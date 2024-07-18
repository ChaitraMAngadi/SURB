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

                    <h5 class="shop_title">Inactive Vendors-Shops </h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                        <!-- <a href="<?= base_url() ?>admin/inactive_vendors_shops/add">

                            <button class="btn btn-primary">+ Add Vendor</button>

                        </a> -->

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

                   <!--  <form class="form" action="">

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


                        <div class="form-group col-md-3">
                            <button type="submit" class="btn btn-info" style="margin-top: 24px">Submit</button>

                            <a href="<?= base_url() ?>admin/inactive_vendors_shops" class="btn btn-danger" style="margin-top: 24px">Reset</a>
                        </div>
                        </div>

                    </form> -->

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                
                                <th>Vendor ID</th>
                                <th class="notexport">Shop Logo</th>
                                <th class="notexport">Shop Image</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Owner Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Location</th>
                                <!-- <th>Vendor Pincodes</th> -->
                                <th>Joining Date</th>
                                <th>No. of Days</th>
                                <th>Refferal Code</th>
                                <th>Status</th>
<!--                                <th>Profile Update Status</th>-->
                                <th class="notexport">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ks = 1;
                            foreach ($vendor_shops as $shop) {
                                ?>
                                <tr class="gradeX">
                                    
                                    <td>#<?= $shop->id; ?></td>
                                    <td>
                                        <?php if($shop->logo!=''){?>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/shops/<?= $shop->logo ?>" title="">
                                        <?php }else{ ?>
                                            <img class="shop_image" align="left" src="<?= base_url() ?>uploads/noproduct.png" title="">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($shop->shop_logo!=''){ ?>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/shops/<?= $shop->shop_logo ?>" title="">
                                        <?php }else{ ?>
                                            <img class="shop_image" align="left" src="<?= base_url() ?>uploads/noproduct.png" title="">
                                        <?php } ?>
                                    </td>
                                    <td><?= $shop->shop_name ?></td>
                                    <td><?= $shop->address ?></td>
                                    <td><?= $shop->owner_name ?></td>
                                    <td> <?= $shop->email ?></td>
                                    <td> <?= $shop->mobile ?></td>

                                    <td>
                                        <?php 
                                            $state_qry=$this->db->query("select * from states where id='".$shop->state_id."'"); 
                                            $state_row = $state_qry->row();

                                            $city_qry=$this->db->query("select * from cities where id='".$shop->city_id."'"); 
                                            $city_row = $city_qry->row();

                                            $loc_qry=$this->db->query("select * from locations where id='".$shop->city_id."'"); 
                                            $loc_row = $loc_qry->row();
                                        ?>
                                        <b>State:</b> <?= ($state_row->state_name) ? $state_row->state_name.'<br>' : 'N/A<br>' ?>
                                        <b>City:</b> <?= ($city_row->city_name) ? $city_row->city_name.'<br>' : 'N/A<br>' ?>
                                        <b>Location:</b> <?= ($loc_row->location_name) ? $loc_row->location_name.'<br>' : 'N/A<br>' ?>
                                        <b>Address:</b> <?= ($shop->address) ? $shop->address : 'N/A' ?>
                                    </td>
                                    <!-- <td><?php $ex=explode(",", $shop->vendor_pincodes);
                                    $pincode=[];
                                                for ($ks=0; $ks <count($ex); $ks++) 
                                                { 
                                                    $pincode_qry=$this->db->query("select * from pincodes where id='".$ex[$ks]."'"); 
                                                    $pincode_row = $pincode_qry->row();
                                                    $pincode[] =$pincode_row->pincode;
                                                }

                                                $im = implode(",", $pincode);
                                                echo $im;
                                     ?></td> -->

                                    <td><?php 
                                            if($shop->created_date!='0000-00-00 00:00:00')
                                            {
                                                echo date('d-m-Y',strtotime($shop->created_date)); 
                                            }
                                        ?></td>
                                        <td><?php 
                                            
                                            if($shop->created_date!='0000-00-00 00:00:00')
                                            {
                                                $ydate = date('d-m-Y',strtotime($shop->created_date));

                                                $now = time(); // or your date as well
                                            $your_date = strtotime($ydate);
                                            $datediff = $now - $your_date;

                                            echo round($datediff / (60 * 60 * 24));

                                            }
                                            
                                        ?></td>

                                        <td><?= $shop->refferalcode ?></td>
                                    <td class="center">
                                        <?php
                                        if ($shop->status == 1) {
                                            ?>
                                        <p style="color: green;font-weight: bold;">Active</p>
                                            <?php
                                        } else if ($shop->status == 0) {
                                            ?>
                                            <p style="color: red;font-weight: bold;">Inactive</p>
                                            <?php
                                        }
                                        ?>
                                    </td>
<!--                                    <td class="center">
                                        <?php
                                        if ($shop->update_status == 1) {
                                            echo 'NO';
                                        } else {
                                            echo 'YES';
                                        }
                                        ?>
                                    </td>-->
                                    <td class="center">
                                            <!-- <a href="<?= base_url() ?>/admin/inactive_vendors_shops/delete/<?php echo $shop->id; ?>"  onclick="if(!confirm('Are you sure you want to delete this Shop?')) return false;" >
                                                <button title="Delete Shop" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </a> --> 
                                        
                                        <?php
                                        if ($shop->status == 1) {
                                            ?>
                                            <a href="<?= base_url() ?>admin/inactive_vendors_shops/changeStatus/<?= $shop->id ?>/0"><button title="Click to inactive" class="btn btn-xs btn-danger">Inactive</button></a>
                                            <?php
                                        } else if ($shop->status == 0) {
                                            ?>
                                            <a href="<?= base_url() ?>admin/inactive_vendors_shops/changeStatus/<?= $shop->id ?>/1"><button title="Click to active" class="btn btn-xs btn-green">
                                                Active
                                            </button></a>
                                            <?php
                                        }
                                        ?>

                                       <a href="<?= base_url() ?>admin/inactive_vendors_shops/edit/<?= $shop->id ?>">
                                                <button title="This operation is disabled in demo !" class="btn btn-xs btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                            <button title="Products" class="btn btn-xs btn-success">
                                                Products (<?= $shop->total_products ?>)
                                            </button>
                                        <!-- </a> -->
                                        <a href="<?= base_url() ?>admin/inactive_vendors_shops/manage_categories?shop_id=<?= $shop->id ?>">
                                            <button title="Products" class="btn btn-xs btn-success">
                                                Manage Categories(<?= $shop->total_categories ?>)
                                            </button>
                                        </a>
                                        <!-- <a href="<?= base_url() ?>admin/inactive_vendors_shops/manage_locations?shop_id=<?= $shop->id ?>">
                                            <button title="Products" class="btn btn-xs btn-success">
                                                Manage Locations
                                            </button>
                                        </a> -->
                                        <!-- <a href="<?= base_url() ?>admin/inactive_vendors_shops/manage_shop_banners?shop_id=<?= $shop->id ?>"> -->

                                            <!-- <button title="Products" class="btn btn-xs btn-success">
                                                Banners(0)
                                            </button> -->

                                        <!-- </a> -->
                                        <a target="_blank" ><form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/login/admin_login/">
                                            <input type="hidden" name="email" class="form-control" value="<?php echo $shop->mobile; ?>">
                                            <input type="hidden" name="password" class="form-control" value="<?php echo $shop->password; ?>">
                                            <input type="hidden" name="md5" class="form-control" value="1">

                                                <button class="btn btn-primary" type="submit" onclick="this.form.target='_blank';return true;">Manage Vendor</button>
                                        </form></a>


                                    </td>

                                </tr>

                                <?php

                                    $ks++;
                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>





</div>



