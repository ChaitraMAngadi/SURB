<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">



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

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/update_link_variant">

                  
                          <?php     $a_type=[];
                                    foreach ($att_type as $value1) {
                                      $a_type[]=$value1;
                                    }

                                    $a_val=[];
                                    foreach ($att_value as $value) {
                                      $a_val[]=$value;
                                    }

                              //print_r($a_type);

                          ?>
                  
                          <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                              <input type="hidden" name="total_cont" value="<?php echo count($link_variant);?>">
                                   <ul style="list-style: none;">
                                    <?php 
                                      $i=1;
                                      foreach($link_variant as $v){  
                                        ?>
                                      <li>
                                          <?php echo $v['title']; ?> <input type="radio" name="parent<?php echo $i; ?>" id="parent" class="parent" <?php if(in_array($v['attribute_type'], $a_type)){ echo "checked='checked'"; } ?> value="<?php echo $v['attribute_type']; ?>" />
                                          <ul style="list-style: none;">     
                                           <?php foreach($v['attribute_values'] as $value){?> 

                                              <li>
                                                <!-- <input type="hidden" name="attribute_id<?php echo $i; ?>" value="<?php echo $value['id']; ?>"> -->
                                                <?php echo $value['value']; ?><input type="radio" name="atrribute_value<?php echo $i; ?>" <?php if(in_array($value['id'], $a_val)){ echo "checked='checked'"; } ?> class="child" value="<?php echo $value['id']; ?>" /></li>
                                            <?php } ?>
                                          </ul>
                                      </li>

                                      <?php   $i++; } ?>
                                  </ul>
                            </div>
                          </div>


                   <input type="hidden" name="product_id" value="<?php echo $pid;?>">
                   <input type="hidden" name="link_id" value="<?php echo $report->id;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-6">
                          <input type="text" name="price" id="price" class="form-control" value="<?php echo $report->price; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sale Price</label>
                        <div class="col-sm-6">
                          <input type="text" name="saleprice" id="saleprice" class="form-control" value="<?php echo $report->saleprice; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Stock</label>
                        <div class="col-sm-6">
                          <input type="text" name="stock" id="stock" class="form-control" value="<?php echo $report->stock; ?>">
                        </div>
                    </div>

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
 });

</script>