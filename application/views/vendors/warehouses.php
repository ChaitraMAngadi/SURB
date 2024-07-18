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

                    <h5 class="shop_title">WareHouses</h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                        <a href="<?= base_url() ?>vendors/Warehouses/add">

                            <button class="btn btn-primary">+ Add WareHouse</button>

                        </a>

                    </div>

                </div><br><br>

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
              
 <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Vendor ID</th>
                                
                                <th>WareHouse Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Pincode</th>
                                <th>city</th>
                                <th>state</th>
                                <th>country</th>
                              
                                <th>Return_address</th>
                                <th>Return_pincode</th>

                                <th>Return_city</th>
                                <th>Return state</th>
                                <th>Return Country</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ks = 1;
                            $select_qry=$this->db->query("select * from warehouses where vendor_id='" . $shop_id . "'");
                            $warehouses=$select_qry->result();
                            // echo "<pre>";
                            // print_r($warehouses);
                            // die;
                            foreach ($warehouses as $warehouse) {
                                ?>
                                <tr class="gradeX">
                                    <td>#<?= $warehouse->id; ?></td>
                                    <td>#<?= $warehouse->vendor_id; ?>
                                   </td>
                                   
                                 
                                   
                                    <td><?= $warehouse->warehouse_name ?></td>
                                    <td><?= $warehouse->mobile_number ?></td>
                                    <td> <?= $warehouse->Email ?></td>
                                    <td> <?= $warehouse->address ?></td>
                                    <td> <?= $warehouse->pincode ?></td>
                                    <td> <?= $warehouse->city ?></td>


                                    
                                   

                                    <td> <?= $warehouse->state ?></td>
                                    <td> <?= $warehouse->country ?></td>
                                    <!-- <td> warehouse</td> -->
                                   
                                    <td>
                                        <?= $warehouse->return_address?></td>
                                    
                                    <td>
                                        <?= $warehouse->return_pincode?></td>
                                  
                                    <td>
                                        <?= $warehouse->return_city?></td>
                                    
                                    <td>
                                        <?= $warehouse->return_state?></td>
                                 
                                    <td>
                                        <?= $warehouse->return_country?></td>
                                        <td> 
                                    <a href="<?= base_url() ?>vendors/Warehouses/updatewarehouse/<?= $warehouse->id ?>">
                                            <button  class="btn btn-xs btn-success">
                                                Update WareHouse
                                            </button></a>
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

    </div>





</div>



