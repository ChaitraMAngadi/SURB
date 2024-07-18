<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>admin/banners">
                        <button class="btn btn-primary">BACK</button>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/banners/insert">
                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" id="title" class="form-control">
                                            </div>
                                        </div>-->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="webimage" id="webimage" class="form-control" accept="image/*" required>
                            <span class="help-block m-b-none" style="color:red;">Banner Image Width : 1024px and height : 400px</span>
                        </div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">App Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="appimage" id="appimage" class="form-control" required>
                                                 <span class="help-block m-b-none" style="color:red;">App Image Width : 900px and height : 400px</span>
                                            </div>
                                        </div>-->


                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Location</label>
                                            <div class="col-sm-10">
                                                <select name="location_id" id="location_id" class="form-control">
                    <?php
                    $city = $this->db->query("select * from cities");
                    $cities = $city->result();
                    foreach ($cities as $value) {
                        ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->city_name; ?></option>
<?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->
                    <!--                    <div class="form-group">
                    
                                                    <label class="col-sm-2 control-label">Select Type: *</label><br>
                                                    <div class="col-sm-10">
                                                    <label>
                                                        <input type="radio" name="type" id="type" onclick="getStatus('products')" value="products" checked=""> Products
                    
                                                    </label> &nbsp;&nbsp;
                    
                                                    <label><input type="radio" name="type" id="type" onclick="getStatus('shops')" checked="" value="shops"> Shops
                                                    </label>
                                                </div>
                                        </div>-->

                    <!--                    <div class="form-group" id="show_shops">
                                            <label class="col-sm-2 control-label">Shops</label>
                                            <div class="col-sm-10">
                                                <select name="shop_id" id="shop_id" class="form-control">
                    <?php
                    $shp = $this->db->query("select * from vendor_shop");
                    $shops = $shp->result();
                    foreach ($shops as $shp) {
                        ?>
                                                            <option value="<?php echo $shp->id; ?>"><?php if ($shp->shop_name == '') {
                            echo $shp->owner_name;
                        } else {
                            echo $shp->shop_name;
                        } ?></option>
<?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->

                    <div class="form-group" id="show_products" style="display: ">
                        <label class="col-sm-2 control-label">Tags *</label>
                        <div class="col-sm-10">
                            <select name="tag_id" id="tag_id" class="form-control">
                                <option value="">Select tags</option>
<?php
$tag = $this->db->query("select * from tags");
$tags = $tag->result();
foreach ($tags as $t) {
    ?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->title; ?></option>
<?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">

                        <label class="col-sm-2 control-label">Position: *</label><br>
                        <div class="col-sm-10" id="position">
                            <label><input type="radio" name="position" checked="" value="1"> First Banner</label> &nbsp;&nbsp;
                            <label><input type="radio" name="position" value="2"> Second Banner</label>&nbsp;&nbsp;
                            <label><input type="radio" name="position" value="3"> Third Banner</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-10">
                            <input type="text" name="priority" id="priority" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Flat Discount</label>
                        <div class="col-sm-10">
                            <input type="text" name="discount" id="discount" class="form-control number">
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
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="btn_banner" type="submit"> <i class="fa fa-plus-circle"></i> Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getStatus(typ)
    {
        if (typ == 'products') {
            document.getElementById("show_shops").style.display = "none";
            document.getElementById("show_products").style.display = "block";
        } else if (typ == 'shops') {
            document.getElementById("show_shops").style.display = "block";
            document.getElementById("show_products").style.display = "none";
        }
    }
</script>


<script type="text/javascript">


    $('#btn_banner').click(function () {
        $('.error').remove();
        var errr = 0;
        if (($("input[name='position']:checked").val()) == '')
        {
            $('#position').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select a position</span>');
            $('#position').focus();
            return false;
        } else if ($('#webimage').val() == '')
        {
            $('#webimage').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Banner Image</span>');
            $('#webimage').focus();
            return false;
        } else if ($('#tag_id').val() == '')
        {
            $('#tag_id').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Tag</span>');
            $('#tag_id').focus();
            return false;
        } else if ($('#priority').val() == '')
        {
            $('#priority').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Provide a priority</span>');
            $('#priority').focus();
            return false;
        } else if ($('#status').val() == '')
        {
            $('#status').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select status</span>');
            $('#status').focus();
            return false;
        }
    });


</script>