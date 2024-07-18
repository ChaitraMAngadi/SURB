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
                        <!-- <a href="<?= base_url() ?>vendors/products/create_stock/<?php echo $pid; ?>/<?php echo $vid; ?>">
                            <button class="btn btn-primary">+ Add Stock</button>
                        </a> -->

                        <a href="<?= base_url() ?>vendors/products/linkvariant/<?php echo $pid; ?>" >
                            <button class="btn btn-primary">Back</button>
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

                    <div class="row">

                    <div class="col-lg-4">
                        <h3 style="text-align: center;">Add Stock</h3>
                                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insertStock">
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">Select Type</label>
                                    <div class="col-sm-6">

                                <select name="stock_status" class="form-control"  id="stock_status">
                                    <option value="add">Add</option>
                                    <option value="remove">Remove</option>
                                </select>
                            </div>
                        </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Stock</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="vid" class="form-control" value="<?php echo $vid; ?>">
                                        <input type="hidden" name="pid" class="form-control" value="<?php echo $pid; ?>">
                                        <input type="number" name="quantity" id="quantity" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">                                       
                                        <button class="btn btn-primary" id="btn_stock" type="submit">Add</button>
                                    </div>
                                </div>
                            </form>

                            <script type="text/javascript">
                                 $('#btn_stock').click(function(){
                                        $('.error').remove();
                                            var errr=0;
                                      if($('#quantity').val()=='')
                                      {
                                         $('#quantity').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Stock</span>');
                                         $('#quantity').focus();
                                         return false;
                                      }
                                 });

                            </script>
                    </div>
                    <div class="col-lg-8">
                   

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Total Stock</th>
                                    <th>Message</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($stock as $v) {
                                        $qry = $this->db->query("select * from products where id='".$v->product_id."'");
                                        $prod = $qry->row();
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $i; ?></td>
                                        <!-- <td><?php echo $v->varient_id; ?></td> -->
                                        <td><?php if($qry->num_rows()>0){ echo $prod->name; } ?></td>
                                        <td><?php echo $v->paid_status; ?></td>
                                        <td><?php echo $v->quantity; ?></td>
                                        <td><?php echo $v->total_stock; ?></td>
                                        <td><?php echo $v->message; ?></td>
                                        <td><?php echo date("d-m-Y, h:i A",$v->created_at); ?></td>

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
</div>



