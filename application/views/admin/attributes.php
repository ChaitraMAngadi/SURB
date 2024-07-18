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
                        <a href="<?= base_url() ?>admin/attributes/add">
                            <button class="btn btn-primary">+ Add Attributes</button>
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
                                <!-- <th>Attribute ID</th> -->
                                <th>Title</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($attributes as $attribute) {
                                     $chk = $this->db->query("select * from attributes_values where attribute_titleid='".$attribute->id."'"); 
                                     $chking = $chk->row();   
                                     $code = $chking->code;
                                     if($chking->code!='')
                                     {
                                        $col = 'color';
                                     }
                                     else
                                     {
                                        $col = 'nocolor';
                                     }
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <!-- <td><?= $attribute->id; ?></td> -->
                                    <td><?= $attribute->title; ?></td>
                                    <td>
                                        <a >
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $attribute->id ?>">
                                                View Values
                                            </button>
                                        </a>
                                        <?php 
                                          $ch = $this->db->query("select * from add_variant where attribute_type='".$attribute->id."' ");
                                          $num = $ch->num_rows();
                                        // if($num>0)
                                        //   { ?>

                                         <?php /*}else{*/ ?>
                                          <a href="<?= base_url() ?>admin/attributes/edit/<?= $attribute->id; ?>/<?= $col; ?>">
                                            <button class="btn btn-primary">
                                                Edit
                                            </button>
                                        </a>
                                        <a href="<?= base_url() ?>admin/attributes/delete/<?= $attribute->id; ?>">
                                          <button title="Delete Attribute" class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete this attribute?')) return false;">
                                                Delete
                                            </button>
                                        </a>
                                         <?php //} ?>
                                        
                                        
                                    </td>


                                    <!--Start Upload Images Modal-->
                                                
                                                            

<td>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $attribute->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Attributes Values</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table class="table table-striped">
                <tr>
<!--                    <th>Attribute Value ID</th>-->
                    <th>Value</th>
                    <th>Action</th>
                </tr>
                <?php 
        $qry = $this->db->query("select * from attributes_values where attribute_titleid='".$attribute->id."' order by id desc"); 
              $result = $qry->result();
              foreach ($result as $value) 
              {
           ?>
                <tr>
<!--                  <td><?php echo $value->id; ?></td>-->
                    <td><?php echo $value->value; ?></td>
                     <td>
                                              
                                              <?php 
                                                    $qry1 = $this->db->query("select * from add_variant where find_in_set('".$value->id."',attribute_values)"); 
                                                    $row = $qry1->num_rows();
                                                    /*if($row>0){}else{*/
                                                    ?>
                                            <a href="<?= base_url() ?>admin/attributes/valuedelete/<?= $value->id; ?>">
                                            <button title="Delete Attribute" class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete this attribute?')) return false;">Delete</button></a>
                                          <?php //} ?>
                                          </td>
                </tr>
            <?php } ?>
            </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
         </td>
                                  <!--Close Upload Images Modal-->

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

