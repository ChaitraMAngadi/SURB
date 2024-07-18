<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/users">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/users/update">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $users->id?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">FirstName</label>
                        <div class="col-sm-6">
                            <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $users->first_name; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">lastName</label>
                        <div class="col-sm-6">
                            <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $users->last_name; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text"  id="email" name="email" class="form-control" value="<?php echo $users->email; ?>"  readonly="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">phone</label>
                        <div class="col-sm-6">
                            <input type="text" id="phone" name="phone"  class="form-control" value="<?php echo $users->phone;?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">

                    <label class="col-sm-2 control-label">Tags</label>

                    <div class="col-sm-6">

                        <?php
                        $tag = $this->db->query("select * from tags");
                        $tags = $tag->result();
                    $tagselected=json_decode($selectedtag_res->Tag);
                        // print_r( );
                        ?>

                        <select name="tags[]" id="tags" class="form-control js-example-basic-multiple" multiple="multiple">

                            <?php foreach ($tags as $value) { ?>

                                <option value="<?php echo $value->title; ?>">
                        <?php echo $value->title; ?>
                    </option>


                            <?php } ?>

                        </select>

                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Membership</label>
                    <div class="col-sm-6">
                        <input type="text" id="membership" name="membership" class="form-control" value="<?php echo $users->membership; ?>"  readonly="">
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">plan</label>
                        <div class="col-sm-6">
                            <input type="number" id="plan" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="plan" value="<?php echo $users->plan; ?>" class="form-control"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">created plan Date</label>
                        <div class="col-sm-6">
                            <input type="date" id="start_date" name="start_date" min="<?= date('Y-m-d')?>" class="form-control" value="<?php echo $users->created_member_date; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry plan Date</label>
                        <div class="col-sm-6">
                            <input type="date" id="expiry_date" name="expiry_date" min="<?= date('Y-m-d')?>" class="form-control" value="<?php echo $users->expiry_member_date; ?>"  readonly="">
                        </div>
                        </div>
                   
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_user" type="submit"> <i class="fa fa-plus-circle"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#btn_user').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#firstname').val()=='')
      {
         $('#firstname').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter First Name</span>');
         $('#firstname').focus();
         return false;
      }
     else if($('#lastname').val()=='')
      {
         $('#lastname').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter last Name</span>');
         $('#lastname').focus();
         return false;
      }
      
      else if($('#email').val()=='')
      {
         $('#email').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Email</span>');
         $('#email').focus();
         return false;
      }
      else if($('#phone').val()=='')
      {
         $('#phone').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter mobile Number</span>');
         $('#phone').focus();
         return false;
      }
      else if($('#tags').val()=='')
      {
         $('#tags').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Any tag</span>');
         $('#tags').focus();
         return false;
      }
     
      

 });

</script>
<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.css" rel="stylesheet" /> 
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery.min.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.js"></script>
<script>
    
                                $(document).ready(function () {
                                    $('.js-example-basic-multiple').select2({
                                        placeholder: "Select"
                                    });
                                });
                                
</script> 

<script>

  $(document).ready(function() {
    $('#start_date').datepicker();
     //$('#start_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');

     $('#expiry_date').datepicker();
     //$('#expiry_date').datepicker('setDate', '<?php echo date('m/d/Y'); ?>');
  });

  </script>