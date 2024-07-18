<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5>Cities</h5>

                    <div class="ibox-tools">

                        <!-- <a href="<?= base_url() ?>vendors/cities/add">

                            <button class="btn btn-primary">+ Add City</button>

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
                    <?php } ?>

                </div>

                <div class="ibox-content">



                    <table class="table table-striped table-bordered table-hover dataTables-example">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>State Name</th>
                                <th>City Name</th>
                                <!-- <th>Action</th> -->
                            </tr>

                        </thead>

                        <tbody>

                            <?php
                                $stat = $this->db->query("select * from states where id='".$cities->state_id."'");
                                $states = $stat->row();
                                $i=1;
                                ?>

                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $states->state_name; ?></td>
                                    <td><?= $cities->city_name; ?></td>

                                    <!-- <td><a href="<?= base_url() ?>vendors/cities/edit/<?= $ct->id ?>"><button class="btn btn-xs btn-primary">Edit</button></a>
                                        <a href="<?= base_url() ?>vendors/cities/delete/<?= $ct->id; ?>"><button class="btn btn-xs btn-danger" onclick="if(!confirm('Are you sure you want to delete this City?')) return false;">Delete</button></a></td> -->



                                </tr>


                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>





</div>



