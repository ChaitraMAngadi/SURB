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
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/testimonials/insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Designation</label>
                        <div class="col-sm-10">
                            <input type="text" id="designation" name="designation" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea rows="10" cols="10" id="description" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="image" name="image" class="form-control">
                             <span class="help-block m-b-none" style="color:red;">App Image Width : 500px and height : 500px</span>
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
      if($('#name').val()=='' || $('#name').val().trim()=="")
      {
         $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Name</span>');
         $('#name').focus();
         return false;
      }
      else if($('#designation').val()=='' || $('#designation').val().trim()=="")
      {
         $('#designation').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Designation</span>');
         $('#designation').focus();
         return false;
      }
      else if($('#description').val()=='' || $('#description').val().trim()=="")
      {
         $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
         $('#description').focus();
         return false;
      }
      else if($('#image').val()=='')
      {
         $('#image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select App Image</span>');
         $('#image').focus();
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

$("#name").keypress(function (e) {
        //var key = e.keyCode;
        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
        if (!valid) {
            e.preventDefault();
        }
    });
</script>
