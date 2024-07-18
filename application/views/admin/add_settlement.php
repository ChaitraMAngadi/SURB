<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">

                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/settlements/insert">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Total Amount<br> ( <?php echo $shop_name; ?>)</label>
                        <div class="col-sm-6">
                            <input type="text" name="vendor_amount" class="form-control" readonly="" value="<?php echo $vendor_amount; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Requested Amount</label>
                        <div class="col-sm-6">
                            <input type="text" id="requested_amount" name="requested_amount" class="form-control" readonly="" value="<?php echo $request_amount; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mode Of Payment</label>
                        <div class="col-sm-6">
                            <select name="mode_payment" onchange="getPayment(this.value)" class="form-control">
                                 <option value="offline">By Cash</option>
                                 <option value="online">Online Payment</option>
                            </select>
                        </div>
                    </div>

                    <div id="offline">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Sender Name</label>
                              <div class="col-sm-6">
                                  <input type="text" id="sender_name" name="sender_name" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Receiver Name</label>
                              <div class="col-sm-6">
                                  <input type="text" id="receiver_name" name="receiver_name" class="form-control">
                              </div>
                          </div>
                    </div>

                    <div id="transaction" style="display: none;">
                        <div class="form-group" >
                            <label class="col-sm-2 control-label">Transaction ID</label>
                            <div class="col-sm-6">
                                <input type="text" id="transaction_id" name="transaction_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-6">
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                    </div>

                    
                    <div class="form-group" id="buttondiv1">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_offline" type="submit"> <i class="fa fa-plus-circle"></i> Settlement</button>
                        </div>
                    </div>
                    <div class="form-group" id="buttondiv2" style="display: none;">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_requestpayment" type="submit"> <i class="fa fa-plus-circle"></i> Settlement</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function getPayment(value)
  {
    if(value=='offline')
    {
      document.getElementById("buttondiv1").style.display = "block";
      document.getElementById("buttondiv2").style.display = "none";
       document.getElementById("offline").style.display = "block";
       document.getElementById("transaction").style.display = "none";

    }
    else if(value=='online')
    {
      document.getElementById("buttondiv1").style.display = "none";
       document.getElementById("buttondiv2").style.display = "block";
      document.getElementById("offline").style.display = "none";
       document.getElementById("transaction").style.display = "block";
    }
  }

    $('#btn_requestpayment').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#transaction_id').val()=='')
      {
         $('#transaction_id').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter TransactionID</span>');
         $('#transaction_id').focus();
         return false;
      }
      else if($('#description').val()=='')
      {
         $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
         $('#description').focus();
         return false;
      }
      
 });


    

    $('#btn_offline').click(function(){
        $('.error').remove();
            var errr=0; 

      if($('#sender_name').val()=='')
      {
         $('#sender_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Sender Name</span>');
         $('#sender_name').focus();
         return false;
      }
      else if($('#receiver_name').val()=='')
      {
         $('#receiver_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Receiver Name</span>');
         $('#receiver_name').focus();
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