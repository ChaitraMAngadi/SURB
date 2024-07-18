<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5>Pincode</h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                       <!--  <a href="<?= base_url() ?>vendors/pincodes/add">
                            <button class="btn btn-primary">+ Add Pincode</button>
                        </a> -->

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



                    <table class="table table-striped table-bordered table-hover dataTables-example">

                        <thead>

                            <tr>

                                <th>#</th>
                                <!-- <th>State Name</th> -->
                                <th>City Name</th>
                                <th>Pincode</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($pincodes as $loc) {
                                $stat = $this->db->query("select * from states where id='".$loc->state_id."'");
                                $states = $stat->row();
                                $cit = $this->db->query("select * from cities where id='".$loc->city_id."'");
                                $cities = $cit->row();
                                ?>

                                <tr class="gradeX">

                                    <td><?= $i ?></td>

                                   <!--  <td><?= $loc->pincode; ?></td> -->

                                    <td><?= $cities->city_name; ?></td>

                                    <td><?= $loc->pincode; ?></td>
                                    <td><?php if($loc->status==0){ echo "Inactive"; }else if($loc->status==1){ echo "Active"; } ?></td>
                                   
                                    <!-- <td><a href="<?= base_url() ?>vendors/pincodes/edit/<?= $loc->id ?>"><button class="btn btn-xs btn-primary">Edit</button></a>
                                        <a href="<?= base_url() ?>vendors/pincodes/delete/<?= $loc->id; ?>"><button class="btn btn-xs btn-danger" onclick="if(!confirm('Are you sure you want to delete this Pincode?')) return false;">Delete</button></a></td> -->
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



