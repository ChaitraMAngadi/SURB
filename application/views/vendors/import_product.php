<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5>Import Product</h5>

                <div class="ibox-tools">

                    <a href="<?= base_url() ?>vendors/products" style="float: right; margin: 8px;">
                        <button class="btn btn-primary">Back</button>
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

                <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/inactive_products/importExcel">
                    <input type="hidden" name="shop_id" class="form-control" value="<?= $shop_id ?>" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Import CSV: *</label>
                        <div class="col-sm-10">
                            <input type="file" id="uploadFile" name="uploadFile" class="form-control">
                        </div>
                    </div>

                   

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" id="btn_excelfile" >Save</button>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" style="width: 108px;color:#f37a20;text-align: center;margin:auto;">
                                <span class="fa fa-spinner fa-spin fa-3x" style="font-size:80px;"></span>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">
     $('#btn_excelfile').click(function(){
  $('.error').remove();
 var errr=0;
 var FileUploadPath = $('#uploadFile').val();
      if (FileUploadPath == '') 
      {
           $('#uploadFile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select CSV File</span>');
           $('#uploadFile').focus();
           return false;
      } 



    
 });
</script>