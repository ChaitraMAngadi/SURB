<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                    <a href="<?= base_url() ?>vendors/products/linkvariant/<?php echo $pid; ?>">
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

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insert_link_variant">

                  
                 
                    
                          <!-- <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                              <input type="hidden" name="total_cont" value="<?php echo count($link_variant);?>">
                                   <ul style="list-style: none;">
                                    <?php 
                                      $i=1;
                                      foreach($link_variant as $v){  
                                        ?>
                                      <li>
                                         <b> <?php echo $v['title']; ?></b> <input type="radio" name="parent<?php echo $i; ?>" id="parent" class="parent" value="<?php echo $v['attribute_type']; ?>" />
                                          <ul style="list-style: none;">     
                                           <?php foreach($v['attribute_values'] as $value){?>       
                                              <li><?php echo $value['value']; ?><input type="radio" name="atrribute_value<?php echo $i; ?>" class="child" value="<?php echo $value['id']; ?>" /></li>
                                            <?php } ?>
                                          </ul>
                                      </li>

                                      <?php   $i++; } ?>
                                  </ul>
                            </div>
                          </div> -->


                   <input type="hidden" name="product_id" value="<?php echo $pid;?>">
                   <input type="hidden" name="vl_id" value="<?php echo $vid;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-6">
                          <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="price" id="price" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sale Price</label>
                        <div class="col-sm-6">
                          <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="saleprice" id="saleprice" class="form-control">
                        </div>
                    </div>
                    <?php if($stock_status=='yes'){ ?>
<!--                    <div class="form-group">
                        <label class="col-sm-2 control-label">Stock</label>
                        <div class="col-sm-6">
                          <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="stock" class="form-control">
                        </div>
                    </div>-->
                  <?php } ?>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_manageattributes" type="submit">Save</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">

  $('input[type="radio"]').on('change', function() {
    //$('.child').prop("checked", false); 

    if ($(this).hasClass('parent')) {
        $('.child').prop('required', false); 
        $(this).next('ul').find('.child').prop('required', true);   
    }
    else if ($(this).hasClass('child')) 
    {
        $(this).prop("checked", true); 
        $(this).parent().parent().prev('.parent').prop('checked', true); 
    }
});


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
            
      if($('#parent').val()=='')
      {
         $('#parent').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select AttributeType</span>');
         $('#parent').focus();
         return false;
      }
      else if($('#price').val()=='')
      {
         $('#price').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Price</span>');
         $('#price').focus();
         return false;
      }
      else if($('#saleprice').val()=='')
      {
         $('#saleprice').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Sale Price</span>');
         $('#saleprice').focus();
         return false;
      }
      else if(parseInt($('#price').val())<parseInt($('#saleprice').val()))
      {
         $('#saleprice').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Please enter less than the Price</span>');
         $('#saleprice').focus();
         return false;
      }
      
 });

</script>