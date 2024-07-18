<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                  <a href="<?= base_url() ?>vendors/products/addvariant/<?php echo $pid; ?>">
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

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insert_variant">

                   <input type="hidden" name="product_id" value="<?php echo $pid;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attribute Types</label>
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
                        <label class="col-sm-2 control-label">Attributes Values</label>
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