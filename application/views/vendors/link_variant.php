<style>
    .product_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
        border: 1px solid #edecec;
    }
    .shop_title{
        font-size:17px !important;
        color: #f39c5a;
    }
    .mangeImagesGrid{
        border: 1px solid #ebe9e9;
    }
    .manageImagesGridImgView{
        width:100%;
        /*border: 1px solid #e5e5e5;*/
        margin-bottom: 4px;
    }
    .previewImage{
        padding: 3px;
        border: 1px solid #ccc;
        margin:4px;
        width:30%;
        float:left;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <div class="ibox-tools">
                        

                            <!-- <?php $prod = $this->db->query("select * from products where id='".$pid."'");
                                  $check = $prod->row();
                                  if($check->variant_product!='no'){ ?>
                        <a href="<?= base_url() ?>vendors/products/create_link_variant/<?php echo $pid; ?>">
                            <button class="btn btn-primary">+ Add Link Variant</button>
                        </a>
                    <?php } ?> -->
                    
                    <a href="<?= base_url() ?>vendors/products">
                            <button class="btn btn-primary">Back</button>
                        </a>
                   
                    </div>


                     <?php if (!empty($this->session->tempdata('success_message1'))) { ?>
                        <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong> Success!</strong> <?= $this->session->tempdata('success_message') ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($this->session->tempdata('error_message1'))) { ?>
                        <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Failed!</strong> <?= $this->session->tempdata('error_message') ?>
                        </div>
                    <?php }
                    ?>

                <a style="border: 1px solid #1ab394; padding: 10px; color: #1ab394"><?php echo $shop_name;?></a> >> <a style="border: 1px solid #1ab394; padding: 10px; color: #1ab394"><?php echo $producttitle;?></a>
                </div>


                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Attributes</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                               // print_r($link_variant_list);
                                foreach ($link_variant_list as $v) {
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $i ?></td>
                                        <td>
                                       <?php foreach ($v['attributes'] as $value) 
                                            { ?>
                                                    <b><?php echo $value['type']; ?> :</b><span><?php echo $value['value']; ?></span>
                                            <?php } ?>
                                            
                                        </td>
                                        <td><b>Price : </b><?= $v['price']; ?><br>
                                            <b>Sale Price :</b> <?= $v['saleprice']; ?><br>
                                            <a href="<?= base_url() ?>vendors/products/create_link_variant/<?php echo $pid; ?>/<?php echo $v['id']; ?>"><br>
                                                <button class="btn btn-xs btn-success upload_images">Update Price</button>
                                            </a> 
                                        </td>
                                        <td><?php echo $v['stock']; if($v['stock']!=''){ ?>
                                             <a href="<?= base_url() ?>vendors/products/stockManagement/<?php echo $pid; ?>/<?php echo $v['id']; ?>"><br>
                                                <button class="btn btn-xs btn-success upload_images"><i class="fa fa-picture-o"></i> Stock Management</button>
                                            </a>   
                                             <?php } ?>
                                        </td>
                                        
                                        <td><b>Count: </b><?php
                                          $qr = $this->db->query("select * from product_images where product_id='".$v['product_id']."' and variant_id='".$v['id']."'");
                                                    echo $qr->num_rows(); ?><br>
                                         <a href="<?= base_url() ?>vendors/products/product_images/<?php echo $pid; ?>/<?php echo $v['id']; ?>">
                                                <button class="btn btn-xs btn-success upload_images"><i class="fa fa-picture-o"></i> Upload Images</button>
                                            </a>
                                        </td>
                                        <td><?php if($v['stock']==1){ ?> 
                                            <p style="color: green;"><?php echo "Active"; ?></p>
                                         <?php  }else if($v['stock']==0){ ?>
                                         <p style="color: red;"><?php  echo "Inactive"; ?></p>
                                         <?php }else if($v['stock']>1){ ?>
                                         <p style="color: green;"><?php  echo "Active"; }?></p>
                                        </td>
                                         <td>
                                            

                                          <!--   <a href="<?= base_url() ?>vendors/products/edit_link_variant/<?php echo $pid; ?>/<?php echo $v['id']; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Edit</button>
                                            </a>
                                            <a href="<?= base_url() ?>vendors/products/delete_link_variant/<?php echo $pid; ?>/<?php echo $v['id']; ?>">
                                            <button class="btn btn-xs btn-danger delete_product" data-id="<?= $v['id']; ?>" onclick="if(!confirm('Are you sure you want to delete this row?')) return false;"><i class="fa fa-trash-o"></i> Delete</button></a> -->
                                            <?php if($v['stock']==1){?>
                                            <a href="<?= base_url() ?>vendors/products/inactive/<?php echo $pid; ?>/<?php echo $v['id']; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Inactive</button>
                                            </a>
                                        <?php }else if($v['stock']==0){  ?>
                                            <a href="<?= base_url() ?>vendors/products/active/<?php echo $pid; ?>/<?php echo $v['id']; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Active</button>
                                            </a>
                                        <?php } else if($v['stock']>1){ ?> 
                                            <a href="<?= base_url() ?>vendors/products/inactive/<?php echo $pid; ?>/<?php echo $v['id']; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Inactive</button>
                                            </a>
                                        <?php }?>
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
</div>


<script>
function goBack() {
  window.history.back();
}
</script>
