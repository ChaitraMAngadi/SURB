<?php
$features = $this->session->userdata('admin_login')['features'];
?>
<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                    <a href="<?= base_url() ?>admin/sub_categories">
                        <button class="btn btn-primary">BACK</button>
                    </a>

                </div>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/sub_categories/insert">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="cat_id" id="cat_id">
                                <option value="">--Select--</option>
                                <?php foreach ($categories as $cat) { ?>
                                    <option value="<?= $cat->id ?>" <?= $cat_id == $cat->id ? "selected" : "" ?>><?= $cat->category_name ?></option>
    <!--                                    <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>-->
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Sub Category Name</label>

                        <div class="col-sm-10">

                            <input type="text" id="sub_category_name" name="sub_category_name" class="form-control">

                        </div>

                    </div>


                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Brands</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="brand" name="brand" class="form-control" required>
                    
                                                 <select class="form-control" name="brand" required>
                                                 <?php
$this->db->where('name', 'Brands');
$query = $this->db->get('features');
$feature = $query->row();
$show_attributes = !empty($feature) && $feature->status == 1;
?>

<?php if($show_attributes  && in_array('Brands', $features)): ?>
                    <?php
                    $brand = $this->db->query("select * from attr_brands");
                    $brands = $brand->result();
                    foreach ($brands as $brnd) {
                        ?>
                                                            <option value="<?= $brnd->id ?>"><?= $brnd->brand_name; ?></option>
                        <?php
                    }
                    ?>
                                                </select> 
                                            </div>
                                        </div>-->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brands</label>
                        <div class="col-sm-10">
<!--                          <input type="text" id="brand" name="brand" class="form-control" required>-->

                            <select class="form-control js-example-basic-multiple" multiple="multiple" id="brand"  name="brand[]">
                                <?php
                                $brand = $this->db->query("select * from attr_brands where status=1");
                                $brands = $brand->result();
                                foreach ($brands as $brnd) {
                                    ?>
                                    <option value="<?= $brnd->id ?>"><?= $brnd->brand_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                  
                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea rows="10" cols="10" id="description" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>-->

                    <!--                    <div class="form-group">

                                            <label class="col-sm-2 control-label">Image</label>

                                            <div class="col-sm-10">

                                                <input type="file" name="image" class="form-control" required>

                                            </div>

                                        </div>-->
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Sub Category Image</label>

                        <div class="col-sm-10">

                            <input type="file" id="app_image" name="app_image" class="form-control">

                            <span class="help-block m-b-none" style="color:red;">Sub Category Image Width : 500px and height : 500px</span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10" style="margin-top: 6px;">

                            <label class='text-success'>

                                <input type="radio"

                                       name="status"

                                       id="status37"

                                       required="required"

                                       value="1"

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

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_subcategory" type="submit"> <i class="fa fa-plus-circle"></i> Add</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    $('#btn_subcategory').click(function () {
        $('.error').remove();
        var errr = 0;
        if (($('#cat_id').val() == '') || ($('#cat_id').val().trim() == ""))
        {
            $('#cat_id').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Category</span>');
            $('#cat_id').focus();
            return false;
        } else if (($('#sub_category_name').val() == '') || ($('#sub_category_name').val().trim() == ""))
        {
            $('#sub_category_name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Sub Category Name</span>');
            $('#sub_category_name').focus();
            return false;
        } else if ($('#description').val() == '')
        {
            $('#description').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Description</span>');
            $('#description').focus();
            return false;
        } else if ($('#app_image').val() == '')
        {
            $('#app_image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Sub Category Image</span>');
            $('#app_image').focus();
            return false;
        } else if ($('#status').val() == '')
        {
            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Status</span>');
            $('#status').focus();
            return false;
        }
//      else if($('#brand').val() < 1)
//      {
//         $('#brand').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select brand</span>');
//         $('#brand').focus();
//         return false;
//      }
    });

    function validateEmail($email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test($email)) {
            return false;
        } else
        {
            return true;
        }
    }

//$("#sub_category_name").keypress(function (e) {
//        //var key = e.keyCode;
//        var valid = (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which == 32);
//        if (!valid) {
//            e.preventDefault();
//        }
//    });
</script>