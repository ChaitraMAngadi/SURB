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
                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/update_subproduct">
                    <div class="col-md-12">
                        <div class="row">

                                    <div class="input_fields_wrap">
                                            <?php $attrib=$this->db->query("select * from product_attributes where pid='".$pid."'"); 
                                                  $report = $attrib->result();
                                                  foreach ($report as $value) 
                                                  {
                                            ?>
                                          <div class="form-group">
                                           
                                                <label class="col-sm-2 control-label">Attributes</label>
                                            
                                              <div class="col-sm-4">
                                                <label class="col-sm-2 control-label">Name: *</label>
                                                <input type="hidden" name="id[]" class="form-control" value="<?php echo $value->id; ?>">
                                                  <input type="text" name="title[]" class="form-control" value="<?php echo $value->name; ?>" required>
                                              </div>
                                              <div class="col-sm-4">
                                                <label class="col-sm-2 control-label">Value: *</label>
                                                  <input type="text" name="values[]" class="form-control" value="<?php echo $value->value; ?>" required>
                                              </div>
                                              <div class="col-sm-2">
                                                <!-- <a class="add_field_button btn btn-info" >add More</a> -->
                                              </div>
                                              
                                          </div>
                                        <?php } ?>
                                          
                                    </div>
                            
                            <div class="col-md-6">
                                <input type="hidden" name="pid" value="<?= $pid; ?>">
                                <input type="hidden" name="old_pid" value="<?= $old_pid; ?>">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">MRP: *</label>
                                        <input type="text" name="mrp" class="form-control"  required value="<?php echo $products->mrp; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Sale Price: *</label>
                                        <input type="text" name="sale_price" class="form-control" required value="<?php echo $products->price; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">SKU: *</label>
                                        <input type="text" name="sku" class="form-control" required value="<?php echo $products->sku; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Manage Stock: *</label>
                                       <select class="form-control" name="manage_stock" onchange="getProducts(this.value)" required>
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
                                        <input type="text" name="stock" id="stock" class="form-control" value="<?php echo $products->stock; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Admin Commission: *</label>
                                        <input type="text" name="admin_commission" class="form-control" disabled value="<?php echo $products->admin_commission; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="btn_product" style="margin-top: 21px;">Save</button>
                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                        <br>


                    </div>
                </form>


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
          $(wrapper).append('<div><div class="input_fields_wrap"><div class="col-sm-12"><label class="col-sm-2 control-label">Attributes</label><div class="col-sm-4"><label class="col-sm-2 control-label">Name: *</label><input type="text" name="title[]" class="form-control" value=""></div><div class="col-sm-4"><label class="col-sm-2 control-label">Value: *</label><input type="text" name="values[]" class="form-control" value=""></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });
</script>


<script type="text/javascript">
   
    $('#btn_product').click(function(){
        $('.error').remove();
            var errr=0;

      if($('#mrp').val()=='')
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
