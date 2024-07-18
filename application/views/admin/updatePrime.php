<style>
    .category_comm_span{
        top: -5px;
        position: relative;
        left: 10px;
    }
    .cat_commission{
        top: -5px;
        position: relative;
        left: 21px;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/prime">
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
                    <?php } ?>
   <?php foreach($prime as $p){?>                 
<div class="col-lg-12">
    <form id="prime" method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url(); ?>admin/prime/updatePrime">
        <h3 class="text-center text-primary">Update Prime</h3>
        <input type="hidden" name="id" id="ID" class="form-control" value="<?php echo $p->id;?>">
        <div class="form-group">
            <div class="col-lg-12">
                <input type="text" name="Name" id="Name" class="form-control" placeholder="Enter Name of the prime" value="<?php echo $p->Name;?>">
            </div>
        </div>
        
       
        
        <div class="form-group">
            <div class="col-lg-12">
                <input type="text" name="Description" id="Description" class="form-control" placeholder="Enter description"  value="<?php echo $p->Description;?>">
            </div>
            
        </div>
        <div class="form-group">
                        
                        <div class="col-lg-12">
                            <input type="number" id="value_prime" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" name="value_prime" class="form-control"  value="<?php echo $p->value;?>" placeholder="Enter value of the prime">
                        </div>
        </div>
        <div class="form-group">



        <label class="col-sm-2 control-label">Prime Image</label>

        <div class="col-sm-10">

            <input type="file" name="app_image"  id ="app_image" class="form-control">

            <span class="help-block m-b-none" style="color:red;">Prime Image Width : 500px and height : 500px</span>

        </div>

        </div>
       

      
       

        <div class="form-group">
            <div class="col-lg-12">
                <input type="submit" id="prime_btn" class="btn btn-primary">
            </div>
        </div>
    </form>
</div><?php }?>
        </div></div></div>
<script type="text/javascript">			
 $('#prime_btn').click(function(){
    $('.error').remove();
    var errr=0;
    var Name = $('#Name').val();
    var Description = $('#Description').val();
    var Value = $('#value_prime').val();
    var id=$('#ID').val();

 
   
    // Validate the data
    if ($('#Name').val() == '') {
        $('#Name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Name of the prime</span>');
        $('#Name').focus();
        return false;
    } else if ($('#Description').val() == '') {
        $('#Description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
        $('#Description').focus();
        return false;
    } else if ($('#value_prime').val() == '') {
        $('#value_prime').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter value of the prime</span>');
        $('#value_prime').focus();
        return false;
    } 
    // Additional validation for the return address form if returnSameAsPickup is unchecked
   

    // Send data to the server using AJAX
    
});


    </script>