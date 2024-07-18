<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                  <a href="<?= base_url() ?>admin/testimonials">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                </div>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/testimonials/update">

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">

                            <input type="hidden" name="id" value="<?= $testimonials->id; ?>" class="form-control">

                            <input type="text" id="name" name="name" value="<?= $testimonials->name; ?>" class="form-control">

                        </div>

                    </div>
                    
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Designation</label>

                        <div class="col-sm-10">

                            <input type="text" id="designation" name="designation" value="<?= $testimonials->designation; ?>" class="form-control">

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Description</label>

                        <div class="col-sm-10">

                            <textarea rows="10" cols="10" id="description" name="description" class="form-control"><?= $testimonials->description; ?></textarea>

                        </div>

                    </div>


                    <?php

                    if ($testimonials->image) {

                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/testimonials/<?= $testimonials->app_image ?> "/>

                            </div>

                        </div>

                        <?php

                    }

                    ?>

                    <div class="form-group">



                        <label class="col-sm-2 control-label">App Image</label>

                        <div class="col-sm-10">

                            <input type="file" name="image" class="form-control">

                             <span class="help-block m-b-none" style="color:red;">App Image Width : 500px and height : 500px</span>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" <?php if($testimonials->status==1){ echo "selected='selected'"; }?>>Active</option>
                                    <option value="0" <?php if($testimonials->status==0){ echo "selected='selected'"; }?>>InActive</option>
                            </select>
                        </div>
                    </div>


                    <!-- <div class="form-group">

                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       id="status"
                                       required="required"
                                       <?= $category->status == 1 ? 'checked' : '' ?>
                                       data-msg-required="This Status is required" value="1" /> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       <?= $category->status == 0 ? 'checked' : '' ?>
                                       id="status"
                                       required="required"
                                       data-msg-required="This Status is required" value="0"/> InActive
                            </label>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-10">
                            <input type="number" id="priority" name="priority" class="form-control" value="<?php echo $testimonials->priority;?>">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_category" type="submit"> <i class="fa fa-floppy-o"></i> Update</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">

  $('#btn_category').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#name').val()=='')
      {
         $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Name</span>');
         $('#name').focus();
         return false;
      }
      else if($('#designation').val()=='')
      {
         $('#designation').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Designation</span>');
         $('#designation').focus();
         return false;
      }
      else if($('#description').val()=='')
      {
         $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
         $('#description').focus();
         return false;
      }
      else if($('#app_image').val()=='')
      {
         $('#app_image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select App Image</span>');
         $('#app_image').focus();
         return false;
      }
      else if($('#status').val()=='')
      {
         $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
         $('#status').focus();
         return false;
      }
      else if($('#priority').val()=='')
      {
         $('#priority').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter priority</span>');
         $('#priority').focus();
         return false;
      }
 });

  function validateEmail($email) 
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( $email) ) {
      return false;
    } 
    else
    {
        return true;
    }
}
</script>
