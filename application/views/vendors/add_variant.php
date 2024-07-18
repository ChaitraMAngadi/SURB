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
                        <!-- <a href="<?= base_url() ?>vendors/products/create_variant/<?php echo $pid; ?>">
                            <button class="btn btn-primary">+ Add Variant</button>
                        </a> -->
                        <a href="<?= base_url() ?>vendors/products/linkvariant/<?php echo $pid; ?>/addvariant"><button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Products</button></a>
                        <a href="<?= base_url() ?>vendors/products" >
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

                    <a style=" padding: 10px; color: #1ab394"><?php echo $shop_name;?></a> >> <a style="padding: 10px; color: #1ab394"><?php echo $producttitle;?></a>

                </div>


                <div class="ibox-content">
                    <div class="row">

                    <div class="col-lg-4">
                        <h3 style="text-align: center;">Add Variant</h3>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insert_variant">

                   <input type="hidden" name="product_id" value="<?php echo $pid;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Types</label>
                        <div class="col-sm-6">
                            <select name="types" id="types"  class="form-control js-example-basic-multiple" onchange="getAttributevalues(this.value)">
                                <option value="">Select Attribute Type</option>
                                <?php foreach($types as $v){ ?>
                                <option value="<?php echo $v['id']; ?>"><?php echo $v['title']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Values</label>
                        <div class="col-sm-6">
                            <select name="attribute_values[]" id="attribute_values"  class="form-control js-example-basic-multiple" multiple="multiple">
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_manageattributes" type="submit">Save</button>
                        </div>
                    </div>

                </form>
            </div>


            <div class="col-lg-8">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Product</th>
                                    <th>Option Names</th>
                                    <th>Option Values</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 1;
                                foreach ($variants as $v) {
                                    $qry = $this->db->query("select * from products where id='".$v->product_id."'");
                                    $prod = $qry->row();

                                    $qry1 = $this->db->query("select * from attributes_title where id='".$v->attribute_type."'");
                                    $type = $qry1->row();
                                    $ex = explode(",", $v->attribute_values);
                                    $ar=[];
                                    for ($i=0; $i <count($ex); $i++) { 
                                        $qry2 = $this->db->query("select * from attributes_values where id='".$ex[$i]."'");
                                        $val = $qry2->row();
                                        $ar[]=$val->value;
                                    }
                                    ?>
                                    <tr class="gradeX">
                                        <td><?= $j; ?></td>
                                        <td><?= $prod->name; ?></td>
                                        <td><?= $type->title; ?></td>
                                        <td><?php echo $im = implode(",",$ar); ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>vendors/products/edit_variant/<?php echo $pid; ?>/<?php echo $v->id; ?>">
                                                <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Edit</button>
                                            </a>
                                            <a href="<?= base_url() ?>vendors/products/delete_variant/<?php echo $pid; ?>/<?php echo $v->id; ?>">
                                            <button class="btn btn-xs btn-danger delete_product" data-id="<?= $v->id; ?>" onclick="if(!confirm('Are you sure you want to delete link variants,images,stock ?')) return false;"><i class="fa fa-trash-o"></i> Delete</button></a></td>
                                    </tr>

                                    <?php
                                    $j++;
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
</div>

<script type="text/javascript">

function getAttributevalues(type_id)
{
      if(type_id != '')
      {
         $.ajax({
          url:"<?php echo base_url(); ?>vendors/products/getAttributeValues",
          method:"POST",
          data:{type_id:type_id},
          success:function(data)
          {
            //alert(JSON.stringify(data));
           $('#attribute_values').html(data);
          }
         });
      }
}
  
  $('#btn_manageattributes').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#types').val()=='')
      {
         $('#types').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Attribute Type</span>');
         $('#types').focus();
         return false;
      }
      else if($('#attribute_values').val()=='' || $('#attribute_values').val()==undefined)
      {
         $('#attribute_values').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Attribute Values</span>');
         $('#attribute_values').focus();
         return false;
      }
 });

</script>



