<style>

    .shop_title{

        font-size:17px !important;

        color: #f39c5a;

    }

</style>





<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5 class="shop_title">Manage Categories - <?= $shop_name ?></h5>

                    <div class="ibox-tools">

                        <a href="<?= base_url() ?>admin/vendors_shops">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                    </div>

                </div>

                <?php if (!empty($this->session->tempdata('success_message'))) { ?>

                    <div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                        <?= $this->session->tempdata('success_message') ?>

                    </div>

                <?php } ?>

                <?php if (!empty($this->session->tempdata('error_message'))) { ?>

                    <div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                        <?= $this->session->tempdata('error_message') ?>

                    </div>

                <?php }

                ?>

                <div class="ibox-content">
                    <?php if($shop_status=='add'){ ?>
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/vendors_shops/insert_cat_comission/"

                          style="background: #f4f4f5;padding: 10px;border-radius: 10px;">

                        <h3>Add Admin Comission</h3>



                        <div class="form-group">



                            <div class="col-sm-3">
                                <label class="control-label">Category: *</label>
                                <input type="hidden" name="shop_id" class="form-control" value="<?= $shop_id ?>" required>
                                <select class="form-control js-example-basic-multiple" name="cat_id" id="shop_category" required onchange="getSubcategories(this.value,<?= $shop_id ?>)">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($categories as $cat) {
                                        ?>
                                        <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label">Sub Category: </label>
                                <select class="form-control js-example-basic-multiple" multiple="" id="sub_categories" name="sub_categories[]">

                                   

                                </select>

                            </div>





                            <div class="col-sm-3">

                                <label class="control-label">Admin Comission (%): *</label>

                                <input type="text" name="admin_comission" onkeyup="this.value = minmax(this.value, '', 100)" id="admin_comm_value" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" required>

                            </div>

                            <div class="col-sm-3">

                                <label class="control-label">GST (%): *</label>

                                <!-- <input type="text" name="gst" onkeyup="this.value = minmax(this.value, '', 100)" id="admin_gst_value" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" required> -->
                                <input type="text" name="gst"  id="admin_gst_value" class="form-control" value="18.0" readonly>

                            </div>


                            <div class="col-sm-3" style="margin-top: 6px;">

                                <label class="control-label">Status: *</label><br>

                                <label class='text-success'>

                                    <input type="radio"

                                           name="status"

                                           id="admin_comm_status1"

                                           required="required"

                                           data-msg-required="This Status is required" value="1" /> Active

                                </label> &nbsp;&nbsp;

                                <label class='text-danger'>

                                    <input type="radio"

                                           name="status"

                                           id="admin_comm_status0"

                                           required="required"

                                           data-msg-required="This Status is required" value="0" /> InActive

                                </label>

                            </div>

                            <div class="col-sm-3">

                                <button class="btn btn-primary" type="submit" style="margin-top:25px">

                                    Add

                                </button>

                            </div>

                        </div>





                    </form>

                    <?php }else if($shop_status=='edit'){ ?>

                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>admin/vendors_shops/update_cat_comission/"

                          style="background: #f4f4f5;padding: 10px;border-radius: 10px;">

                        <h3>Update Admin Comission</h3>



                        <div class="form-group">



                            <div class="col-sm-3">
                                <label class="control-label">Category: *</label>
                                <input type="hidden" name="com_id" class="form-control" value="<?= $com_id ?>">
                                <input type="hidden" name="shop_id" class="form-control" value="<?= $shop_id ?>" required>
                                <select class="form-control js-example-basic-multiple" name="cat_id" id="shop_category" required onchange="getSubcategories(this.value,<?= $shop_id ?>,'edit')">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($categories as $cat) {
                                        ?>
                                        <option value="<?= $cat->id ?>" <?php if($admin_edit_comissions->cat_id==$cat->id){ echo 'selected="selected"'; }?>><?= $cat->category_name ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <?php
                                 $subcat_ids = explode(",", $admin_edit_comissions->subcategory_ids); 
                                         ?>
                                <label class="control-label">Sub Category: </label>
                                <select class="form-control js-example-basic-multiple" multiple="" id="sub_categories" name="sub_categories[]">
                                     <?php              
                                        $sub_cat_get = $this->db->where(['cat_id' => $admin_edit_comissions->cat_id, 'status' => 1])->get('sub_categories')->result();
                                        foreach ($sub_cat_get as $subcat) { ?>
                                        <option value="<?= $subcat->id ?>" <?php if(in_array($subcat->id, $subcat_ids)){ echo 'selected="selected"'; }?>><?= $subcat->sub_category_name ?></option>
                                            <?php } ?>
                                </select>

                            </div>





                            <div class="col-sm-3">

                                <label class="control-label">Admin Comission: *</label>

                                <input type="text" name="admin_comission" class="form-control" value="<?php echo $admin_edit_comissions->admin_comission; ?>" required>

                            </div>

                            <div class="col-sm-3">

                                <label class="control-label">GST: *</label>

                                <input type="text" name="gst" class="form-control" value="<?php echo $admin_edit_comissions->gst; ?>" required>

                            </div>


                            <div class="col-sm-3" style="margin-top: 6px;">

                                <label class="control-label">Status: *</label><br>

                                <label class='text-success'>

                                    <input type="radio"

                                           name="status"

                                           id="admin_comm_status1"

                                           required="required"

                                           data-msg-required="This Status is required" <?= $admin_edit_comissions->status == 1 ? 'checked' : '' ?> value="1" /> Active

                                </label> &nbsp;&nbsp;

                                <label class='text-danger'>

                                    <input type="radio"

                                           name="status"

                                           id="admin_comm_status0"

                                           required="required"

                                           data-msg-required="This Status is required" <?= $admin_edit_comissions->status == 0 ? 'checked' : '' ?> value="0" /> InActive

                                </label>

                            </div>

                            <div class="col-sm-3">

                                <button class="btn btn-primary" type="submit" style="margin-top:25px">

                                    Update

                                </button>

                            </div>

                        </div>





                    </form>
                    <?php } ?>
                    <div>
                        
                    </div>

                    

                    <br>

                    <h3>Category Comissions</h3>



                    <table id="classTable" class="table table-bordered">

                        <thead>

                            <tr>

                                <th>S.NO</th>

                                <th>Category</th>

                                <th>Sub Categories</th>

                                <th>Admin Comission(%)</th>

                                <th>GST(%)</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($admin_comissions as $com) {

                                ?>

                                <tr>

                                    <td>#<?= $i ?></td>

                                    <td><?= $com->category_name ?></td>

                                    <td><?php
                                    $ex = explode(",", $com->subcategory_ids);
                                    for ($i=0; $i <count($ex); $i++) 
                                    { 
                                      $qry = $this->db->query("select * from sub_categories where id='".$ex[$i]."'");
                                      $subcat = $qry->row();
                                      
                                        echo $subcat->sub_category_name.", ";
                                    }
                                    
                                      ?></td>

                                    <td><?= $com->admin_comission ?></td>

                                     

                                    <td><?= $com->gst ?></td>

                                    <td>

                                        <?php

                                        if ($com->status == 1) {

                                            ?>

                                            <button title="Active" class="btn btn-xs btn-green">

                                                Active

                                            </button>

                                            <?php

                                        } else {

                                            ?>

                                            <button title="Inactive" class="btn btn-xs btn-danger">

                                                Inactive

                                            </button>

                                            <?php

                                        }

                                        ?>

                                    </td>

                                    <td>

                                         <!-- <button class="btn btn-xs btn-success edit_admin_comission"

                                                data-id="<?= $com->id ?>"

                                                data-cat-id="<?= $com->cat_id ?>"
                                                data-subcategory-ids="<?= $com->subcategory_ids ?>"

                                                data-admin_com="<?= $com->admin_comission ?>"
                                                data-gst="<?= $com->gst ?>"


                                                data-status="<?= $com->status ?>">Edit</button>  -->

                                                 <a href="<?= base_url() ?>admin/vendors_shops/edit_manage_categories/<?= $shop_id ?>/<?= $com->id ?>"><button class="btn btn-xs btn-success">Edit</button></a>

                                        <button class="btn btn-xs btn-danger delete_admin_comission"

                                                data-id="<?= $com->id ?>">Delete</button>

                                    </td>

                                </tr>

                                <?php

                                $i++;

                            }

                            ?>



                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>





</div>


<script type="text/javascript">
    function getSubcategories(cid,shop_id,edit)
    {
      if(cid != '')
      {
         $.ajax({
          url:"<?php echo base_url(); ?>admin/products/loadSubcategories",
          method:"POST",
          data:{cid:cid,shop_id:shop_id,type:edit},
          success:function(data)
          {
           $('#sub_categories').html(data);
          }
         });
      }
    }
</script>
<script type="text/javascript">

    $(document).ready(function () {

        console.log('loaded');

        $('.edit_admin_comission').on('click', function () {

            console.log($(this).attr('data-admin_com'));

            var id = $(this).attr('data-id');

            var cat_id = $(this).attr('data-cat-id');

            var subcategory_ids = $(this).attr('data-subcategory-ids');  

            var admin_com = $(this).attr('data-admin_com');

            var gst = $(this).attr('data-gst');

            var status = $(this).attr('data-status');


            $('#shop_category').val(cat_id);

            $('#shop_category').val(cat_id);

            $('#admin_comm_value').val(admin_com);

            $('#admin_gst_value').val(gst);

            if (status === '1') {

                $("input[name='status'][value='1']").attr("checked", true);

            } else {

                $("input[name='status'][value='0']").attr("checked", true);

            }

        });





        $('.delete_admin_comission').on('click', function () {

            var admin_com_id = $(this).attr('data-id');

            console.log(admin_com_id);

            var confirm = window.confirm('Are you sure, want to delete this admin comission ?');

            if (confirm) {

                var location = '<?= base_url() ?>admin/vendors_shops/delete_vendor_admin_comission?admin_com_id=' + admin_com_id + '&shop_id=' + <?= $shop_id ?>;

                console.log(location);

                window.location = location;

            } else {

                console.log('not confirmed');

            }

        });











    });



</script>
<script type="text/javascript">
function minmax(value, min, max) 
{
    if(parseInt(value) < min || isNaN(parseInt(value))) 
        return min; 
    else if(parseInt(value) > max) 
        return max; 
    else return value;
}
</script>