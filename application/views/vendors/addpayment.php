<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/request_payment">
                            <button class="btn btn-primary">BACK</button>
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
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/request_payment/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Your Total Amount</label>
                        <div class="col-sm-6">
                            <input type="text" name="vendor_amount" class="form-control" readonly="" value="<?php echo $vendor_amount; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Requested Amount</label>
                        <div class="col-sm-6">
                            <input type="text" id="requested_amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="requested_amount" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control" ></textarea>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_requestpayment" type="submit"> <i class="fa fa-plus-circle"></i> Request Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#btn_requestpayment').click(function(){
        $('.error').remove();
            var errr=0;
        var vendor_amount ='<?php echo $vendor_amount; ?>';   

      if($('#requested_amount').val()=='')
      {
         $('#requested_amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Requested Amount</span>');
         $('#requested_amount').focus();
         return false;
      }
      else if(parseInt(vendor_amount)<parseInt($('#requested_amount').val()))
      {
         $('#requested_amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Please enter less than the Total Amount</span>');
         $('#requested_amount').focus();
         return false;
      }
      else if($('#description').val()=='')
      {
         $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
         $('#description').focus();
         return false;
      }
      
 });

</script>

<script>

    document.onkeydown = function (e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'C'.charCodeAt(0) || e.keyCode == 'c'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'J'.charCodeAt(0) || e.keyCode == 'j'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) {
            return false;
        }
    }
</script>