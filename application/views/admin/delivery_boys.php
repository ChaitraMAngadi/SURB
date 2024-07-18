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

                    <h5 class="shop_title">Delivery Boys </h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                        <a href="<?= base_url() ?>admin/delivery_boy/add">
                            <button class="btn btn-primary">+ Add Delivery Boy</button>
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

                                <th>#</th>
                                <th>Delivery Boy Type</th>
                                <th>Delivery Boy Details</th>

                                <th>Photo</th>

                                <th>Vehicle Number</th>

                                <th>Vehicle Type</th>
                                <th>Driving License Image</th>
                                <th>Driving License Number</th>
                                <th>Adhaar Card</th>
                                <th>Adhaar Card Number</th>
                                <th>Mobile Number Verification</th>
                                <th>Location</th>
                                <th>Additional Document</th>
                                <th>Actions</th> 

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($result as $v) {

                                ?>

                                <tr class="gradeX">

                                    <td>#<?= $i ?></td>
                                    <td><?php echo ucwords(str_replace("_", " ", $v->delivery_type));  ?></td>
                                    <td>

                                        <p><b>Name: </b><span class="font-weight500"><?= $v->name ?></span></p>

                                        <p><b>Email: </b><span class="font-weight500"><?= $v->email ?></span></span></p>
                                        <p><b>Phone: </b><span class="font-weight500"><?= $v->phone ?></span></span></p>
                                        <p><b>Alternative Mobiles: </b><span class="font-weight500"><?= $v->alternative_mobiles ?></span></span></p>
                                    </td>

                                    <td>
                                        <?php if($v->photo!=''){?>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/delivery_boy/<?= $v->photo ?>" title="">
                                        <?php } ?>
                                    </td>

                                    <td><?= $v->vehicle_number ?></td>

                                    <td class="center"><?= $v->vehicle_type ?></td>
                                    <td class="center">
                                    <?php if($v->driving_license_image!=''){?>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/delivery_boy/<?= $v->driving_license_image ?>" title="">
                                    <?php } ?>
                                    </td>
                                    <td class="center"><?= $v->driving_license_number ?></td>

                                    <td class="center">
                                    <?php if($v->aadhar_card!=''){?>
                                        <img class="shop_image" align="left" src="<?= base_url() ?>uploads/delivery_boy/<?= $v->aadhar_card ?>" title="">
                                    <?php } ?>
                                    </td>

                                    <td class="center"><?= $v->aadhar_card_number ?></td>
                                    <td class="center"><?= $v->mobile_verified ?></td>
                                        
                                    <td>
                                        <?php $state = $this->db->query("select * from states where id='".$v->state."'");
                                              $states = $state->row();

                                              $city = $this->db->query("select * from cities where id='".$v->city."'");
                                              $cities = $city->row();

                                              $loc = $this->db->query("select * from locations where id='".$v->location."'");
                                              $location = $loc->row();
                                              
                                         ?>
                                        <p><b>Country: </b><span class="font-weight500"><?= $v->country ?></span></p>
                                        <p><b>State: </b><span class="font-weight500"><?= $states->state_name ?></span></span></p>
                                        <p><b>City: </b><span class="font-weight500"><?= $cities->city_name ?></span></span></p>
                                        <p><b>Location: </b><span class="font-weight500"><?= $location->location_name ?></span></span></p>
                                        <p><b>Address: </b><span class="font-weight500"><?= $v->address ?></span></span></p>
                                        <p><b>Pincode: </b><span class="font-weight500"><?= $v->pincode ?></span></span></p>
                                    </td>
                                    <td class="center">
                                        <?php if($v->document!=""){?>
                                    <a href="<?= base_url() ?>uploads/delivery_boy/<?php echo $v->document; ?>" target="_blank">Additional Document</a>
                                    <?php } ?>
                                    </td>

                                    <td class="center">
                                         <a href="<?= base_url() ?>/admin/delivery_boy/delete/<?php echo $v->id; ?>"  onclick="if(!confirm('Are you sure you want to delete this Delivery Boy?')) return false;" >
                                                <button title="Delete Shop" class="btn btn-xs btn-danger">
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



