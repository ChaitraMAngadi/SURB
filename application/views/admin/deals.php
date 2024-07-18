<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5><?= $title ?></h5>

                    <div class="ibox-tools">

                        <a href="<?= base_url() ?>admin/deals/add">

                            <button class="btn btn-primary">+ Add Deal</button>

                        </a>

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
                                <th>Category</th>
                                <th>Title</th>
                                <th>Deal Start</th>
                                <th>Deal End</th>
                                <th>Web Image</th>
                                <th>App Image</th>
                                <th>Status</th>
                                <!-- <th>Created At</th>
                                <th>Updated At</th> -->
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                                foreach ($deals as $deal) {
                                    $qry = $this->db->query("select * from categories where id='".$deal->cat_id."'");
                                    $shop = $qry->row();

                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $shop->category_name; ?></td>
                                        <td><?= $deal->title; ?></td>
                                        <td><?= $deal->deal_start; ?></td>
                                        <td><?= $deal->deal_end; ?></td>
                                        <td><img src="<?php echo base_url()."uploads/deals/".$deal->web_image; ?>" style="width: 80px; height: 80px;"></td>
                                        <td><img src="<?php echo base_url()."uploads/deals/".$deal->app_image; ?>" style="width: 80px; height: 80px;"></td>
                                        <td><?php if($deal->status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                                        <!-- <td><?= date("d-m-Y h:i A",$deal->created_at); ?></td>
                                        <td><?= date("d-m-Y h:i A",$deal->updated_at); ?></td> -->
                                        <td>
                                            <a href="<?= base_url() ?>admin/deals/edit/<?= $deal->id ?>">
                                                <button class="btn btn-primary">Edit</button></a>
                                             <a href="<?= base_url() ?>admin/deals/delete/<?= $deal->id; ?>">
                                              <button title="Delete Deal" class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete this row?')) return false;">
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



