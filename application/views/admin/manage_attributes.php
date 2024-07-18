<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5><?= $title ?></h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        
                        <a href="<?= base_url() ?>admin/manage_attributes/add">

                            <button class="btn btn-primary">+ Add Manage Attribute</button>

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
                                <th>Attribute Type</th>
                                <th>Categories</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $i = 1;
                                foreach ($attributes as $attribute) {

                                    ?>

                                    <tr class="gradeX">

                                        <td><?= $i ?></td>

                                        <td><?php
                                                    $attr=$this->db->query("select * from attributes_title where id='".$attribute->attribute_titleid."'");
                                                    $attribute1 = $attr->row();
                                                    if($attr->num_rows()>0)
                                                    {
                                                       echo $attribute1->title; 
                                                    } 
                                          ?>

                                          </td>
                                        <td><?php
                                            $qry=$this->db->query("select * from manage_attributes where attribute_titleid='".$attribute->attribute_titleid."'");
                                            $categories = $qry->result();
                                            $ar=[];
                                            foreach ($categories as $cat) {
                                                    $ar[]=$cat->categories;
                                                    $catg=$this->db->query("select * from categories where id='".$cat->categories."'");
                                                    $catgory = $catg->row(); ?>
                                                    <span style="border: 3px solid" class="badge badge-success"><?php echo $catgory->category_name; ?></span>
                                               <?php 
                                            }
                                            
                                            $im = implode(",", $ar);
                                            //print_r($im);
                                         ?></td>

                                       
                                        <td>
                                        <?php 
                                          $ch = $this->db->query("SELECT * FROM `products` where find_in_set(cat_id,'".$im."')");
                                          $num = $ch->num_rows();
                                        /*if($num>0)
                                          {*/ ?>

                                         <?php /*}else{*/ ?>
                                            <a href="<?= base_url() ?>admin/manage_attributes/edit/<?= $attribute->attribute_titleid ?>">
                                                <button class="btn btn-primary">Edit</button></a>

                                             <a href="<?= base_url() ?>admin/manage_attributes/delete/<?= $attribute->attribute_titleid; ?>">
                                              <button title="Delete Attribute" class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete this row?')) return false;">
                                                    Delete
                                                </button>
                                            </a>
                                        <?php //} ?>

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



