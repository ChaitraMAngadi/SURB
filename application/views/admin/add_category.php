<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                  <a href="<?= base_url() ?>admin/categories">
                            <button class="btn btn-primary">BACK</button>
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
                    <?php } ?>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/categories/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="category_name" name="category_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea rows="10" cols="10" id="description" name="description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control" required>
                                            </div>
                                        </div>-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="app_image" name="app_image" class="form-control">
                             <span class="help-block m-b-none" style="color:red;">Category Image Width : 500px and height : 500px</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>


                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10" style="margin-top: 6px;">
                            <label class='text-success'>
                                <input type="radio"
                                       name="status"
                                       id="status37"
                                       required="required"
                                       value="Active"
                                       data-msg-required="This Status is required" value="1" checked/> Active
                            </label> &nbsp;&nbsp;
                            <label class='text-danger'>
                                <input type="radio"
                                       name="status"
                                       id="status69"
                                       required="required"
                                       data-msg-required="This Status is required" value="0"/> InActive
                            </label>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-10">
                            <input type="number" id="priority" name="priority" class="form-control">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" id="btn_category"> <i class="fa fa-plus-circle"></i> Add</button>
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
      if(($('#category_name').val()=='') || ($('#category_name').val().trim()==""))
      {
         $('#category_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Category Name</span>');
         $('#category_name').focus();
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
         $('#app_image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Category Image</span>');
         $('#app_image').focus();
         return false;
      }
      else if($('#status').val()=='')
      {
         $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
         $('#status').focus();
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

$("#category_name").keypress(function (e) {
        //var key = e.keyCode;
        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
        if (!valid) {
            e.preventDefault();
        }
    });
</script>