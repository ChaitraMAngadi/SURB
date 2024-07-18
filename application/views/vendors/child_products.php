<style>
    .shop_title{
        font-size:17px !important;
        color: #f39c5a;
    }
    .bd-example-modal-lg .modal-dialog{
        display: table;
        position: relative;
        margin: 0 auto;
        top: calc(50% - 24px);
    }

    .bd-example-modal-lg .modal-dialog .modal-content{
        /*        background-color: transparent;
                border: none;*/
    }
</style>

<div class="row">
    <div class="col-lg-12">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 class="shop_title"><?= $title ?> - Add Product</h5>
                <div class="ibox-tools"></div>
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
            <div class="ibox-content" style="background-color: #f3f3f3;">
                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insert_subproduct">
                    <div class="col-md-12">
                        <div class="row">

                            
                                    <div class="input_fields_wrap">
                                          <div class="form-group">
                                           
                                                <label class="col-sm-2 control-label">Attributes</label>
                                            
                                              <div class="col-sm-4">
                                                <label class="col-sm-2 control-label">Name: *</label>
                                                  <input type="text" id="title" name="title[]" class="form-control" value="" >
                                              </div>
                                              <div class="col-sm-4">
                                                <label class="col-sm-2 control-label">Value: *</label>
                                                  <input type="text" id="values" name="values[]" class="form-control" value="" >
                                              </div>
                                              <div class="col-sm-2">
                                                <a class="add_field_button btn btn-info" >add More</a>
                                              </div>
                                              
                                          </div>
                                          
                                    </div>
                            
                            <div class="col-md-6">
                                <input type="hidden" name="pid" value="<?= $pid; ?>">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">MRP: *</label>
                                        <input type="text" id="mrp" name="mrp" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Sale Price: *</label>
                                        <input type="text" id="price" name="sale_price" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">SKU: *</label>
                                        <input type="text" id="sku" name="sku" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Manage Stock: *</label>
                                       <select class="form-control" id="manage_stock" name="manage_stock" onchange="getProducts(this.value)">
                                            <option value="">Select Stock</option>
                                            <option value="1">Yes</option>
                                            <option value="0" selected="">No</option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="displaystock" style="display: none;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Stock: *</label>
                                        <input type="text" name="stock" id="stock" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Admin Commission: *</label>
                                        <input type="text" name="admin_commission" class="form-control" value="10" disabled >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="btn_product1" style="margin-top: 21px;">Save</button>
                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                        <br>


                    </div>
                </form>


                <div class="row">
                    <table id="classTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>S.NO</td>
                                <td>SKU</td>
                                <td>Price</td>
                                <td>Stock</td>
                                <td>Attributes</td>
                                <td>Stock Visibility</td>
                                <td>Admin Comm (%)</td>
                                <td>Images</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $row1 = $this->db->query("select * from products where parent_id='".$pid."'");
                                $resu = $row1->result();
                                $i=1;
                                foreach ($resu as $value) 
                                {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value->sku; ?></td>
                                <td><?php echo $value->price; ?></td>
                                <td><?php echo $value->stock; ?></td>
                               <td>
                                                <?php $at1 = $this->db->query("select * from product_attributes where pid='".$value->id."'");
                                                      $result1 = $at1->result();
                                                      foreach ($result1 as $value1) 
                                                      { ?>
                                                            <div>
                                                                <?php echo $value1->name; ?> : <?php echo $value1->value; ?>
                                                            </div>
                                                <?php } ?>
                                        </td>
                                
                                <td><?php if($value->manage_stock==1){ echo "Yes"; }else{ echo "No"; } ?></td>
                                <td><?php echo $value->admin_commission; ?> %</td>
                                <td><a href="<?= base_url() ?>vendors/products/product_images/<?php echo $value->id; ?>">
                                                <button class="btn btn-xs btn-success upload_images"><i class="fa fa-picture-o"></i> Upload Images</button>
                                            </a></td> 
                                <td>
                                     <a href="<?= base_url() ?>vendors/products/editsubproduct/<?php echo $pid; ?>/<?php echo $value->id; ?>"><button class="btn btn-xs btn-primary" onclick="editProduct()">Edit</button> </a>
                                    

                                    <a href="<?= base_url() ?>vendors/products/delete_subproduct/<?php echo $pid; ?>/<?php echo $value->id; ?>">
                                      <button class="btn btn-xs btn-primary" onclick="if(!confirm('Are you sure you want to delete this product?')) return false;">Delete</button></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>


            </div>






        </div>
    </div>

</div>


<script type="text/javascript">
  function getProducts(value)
  {
    if(value==1)
    {
      document.getElementById("displaystock").style.display = "block";
    }
    else
    {
      document.getElementById("displaystock").style.display = "none";
    }
  }
</script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div><div class="input_fields_wrap"><div class="col-sm-12"><label class="col-sm-2 control-label">Attributes</label><div class="col-sm-4"><label class="col-sm-2 control-label">Name: *</label><input type="text" id="title" name="title[]" class="form-control" value=""></div><div class="col-sm-4"><label class="col-sm-2 control-label">Value: *</label><input type="text" id="values" name="values[]" class="form-control" value=""></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });
</script>


<script type="text/javascript">
   
    $('#btn_product1').click(function(){
        $('.error').remove();
            var errr=0;
            
      if($('#title').val()=='')
      {
         $('#title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Title</span>');
         $('#title').focus();
         return false;
      }
      else if($('#values').val()=='')
      {
         $('#values').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Value</span>');
         $('#values').focus();
         return false;
      }
      else if($('#mrp').val()=='')
      {
         $('#mrp').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter MRP</span>');
         $('#mrp').focus();
         return false;
      }
      else if($('#price').val()=='')
      {
         $('#price').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter price</span>');
         $('#price').focus();
         return false;
      }
      else if(parseInt($('#mrp').val())<=parseInt($('#price').val()))
      {
                $('#mrp').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Please enter Less than the mrp price</span>');
                 $('#mrp').focus();
                 return false;
      }
      else if($('#sku').val()=='')
      {
         $('#sku').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter SKU</span>');
         $('#sku').focus();
         return false;
      }
      
      

 });

  
</script>
