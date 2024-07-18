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

                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>admin/banners/update">
                    <input type="hidden" name="id" value="<?= $banners->id; ?>" class="form-control" >
                    <!--                    <div class="form-group">
                    
                                            <label class="col-sm-2 control-label">Title</label>
                    
                                            <div class="col-sm-10">
                    
                                               
                    
                                                <input type="text" name="title" id="title" value="<?= $banners->title; ?>" class="form-control" >
                    
                                            </div>
                    
                                        </div>-->



                    <?php
                    if ($banners->web_image) {
                        ?>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">Preview</label>

                            <div class="col-sm-10">

                                <img width="200px" src="<?= base_url() ?>uploads/banners/<?= $banners->web_image ?> "/>

                            </div>

                        </div>

                        <?php
                    }
                    ?>

                    <!--                    <div class="form-group">
                    
                    
                    
                                            <label class="col-sm-2 control-label">App Image</label>
                    
                                            <div class="col-sm-10">
                    
                                                <input type="file" name="webimage" class="form-control">
                    
                                            </div>
                    
                                        </div>-->

                    <?php
                    if ($banners->app_image) {
                        ?>

                        <!--                        <div class="form-group">
                        
                                                    <label class="col-sm-2 control-label">Preview</label>
                        
                                                    <div class="col-sm-10">
                        
                                                        <img width="200px" src="<?= base_url() ?>uploads/banners/<?= $banners->app_image ?> "/>
                        
                                                    </div>
                        
                                                </div>-->

                        <?php
                    }
                    ?>

                    <div class="form-group">



                        <label class="col-sm-2 control-label">Banner Image</label>

                        <div class="col-sm-10">

                            <input type="file" name="appimage" accept="image/*" class="form-control">
                            <span class="help-block m-b-none" style="color:red;">Banner Image Width : 1024px and height : 400px</span>
                        </div>

                    </div>

                    <!--                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Location</label>
                                            <div class="col-sm-10">
                                                <select name="location_id" id="location_id" class="form-control">
                    <?php
                    $city = $this->db->query("select * from cities");
                    $cities = $city->result();
                    foreach ($cities as $value) {
                        ?>
                                                                <option value="<?php echo $value->id; ?>" <?php
                        if ($banners->location_id == $value->id) {
                            echo 'selected="selected"';
                        }
                        ?>><?php echo $value->city_name; ?></option>
<?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->
                    <!--                    <div class="form-group">
                    
                                                    <label class="col-sm-2 control-label">Select Type: *</label><br>
                                                    <div class="col-sm-10">
                                                    <label>
                                                        <input type="radio" name="type" id="type" <?php
if ($banners->type == 'products') {
    echo 'checked';
}
?> onclick="getStatus('products')" value="products"> Products
                                                    </label>
                                                </div>
                                        </div>-->

<?php //if($banners->type=='products'){   ?>

                    <!--                        <div class="form-group" id="show_products" >
                                            <label class="col-sm-2 control-label">Products</label>
                                            <div class="col-sm-10">
                                                <select name="product_id" id="product_id" class="form-control">
                    <?php
                    $pro = $this->db->query("select * from products");
                    $products = $pro->result();
                    foreach ($products as $product) {
                        ?>
                                                                <option value="<?php echo $product->id; ?>" <?php
                    if ($banners->product_id == $product->id) {
                        echo 'selected="selected"';
                    }
                    ?>><?php echo $product->name; ?></option>
<?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->


                    <!--                    <div class="form-group" id="show_shops" style="display: none;">
                                            <label class="col-sm-2 control-label">Shops</label>
                                            <div class="col-sm-10">
                                                <select name="shop_id" id="shop_id" class="form-control">
                    <?php
                    $shp = $this->db->query("select * from vendor_shop");
                    $shops = $shp->result();
                    foreach ($shops as $shp) {
                        ?>
                                                                <option value="<?php echo $shp->id; ?>" <?php
                        if ($banners->shop_id == $shp->id) {
                            echo 'selected="selected"';
                        }
                        ?>><?php
                        if ($shp->shop_name == '') {
                            echo $shp->owner_name;
                        } else {
                            echo $shp->shop_name;
                        }
                        ?></option>
<?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->


                    <?php //}else if($banners->type=='shops'){ ?>

                    <!--                        <div class="form-group" id="show_shops">
                                            <label class="col-sm-2 control-label">Shops</label>
                                            <div class="col-sm-10">
                                                <select name="shop_id" id="shop_id" class="form-control">
                    <?php
                    $shp = $this->db->query("select * from vendor_shop");
                    $shops = $shp->result();
                    foreach ($shops as $shp) {
                        ?>
                                                                <option value="<?php echo $shp->id; ?>" <?php
                        if ($banners->shop_id == $shp->id) {
                            echo 'selected="selected"';
                        }
                        ?>><?php
                        if ($shp->shop_name == '') {
                            echo $shp->owner_name;
                        } else {
                            echo $shp->shop_name;
                        }
                        ?></option>
                    <?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->

                    <!--                    <div class="form-group" id="show_products" style="display: none;">
                                            <label class="col-sm-2 control-label">Products</label>
                                            <div class="col-sm-10">
                                                <select name="product_id" id="product_id" class="form-control">
                    <?php
                    $pro = $this->db->query("select * from products");
                    $products = $pro->result();
                    foreach ($products as $product) {
                        ?>
                                                                <option value="<?php echo $product->id; ?>" <?php
                        if ($banners->product_id == $product->id) {
                            echo 'selected="selected"';
                        }
                        ?>><?php echo $product->name; ?></option>
                                <?php } ?>
                                                </select>
                                               
                                            </div>
                                        </div>-->

<?php //}   ?>

                    <div class="form-group" id="show_products" style="display: ">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-10">
                            <select name="tag_id" id="tag_id" class="form-control">
                                <option>Select tags</option>
<?php
$tag = $this->db->query("select * from tags");
$tags = $tag->result();
foreach ($tags as $t) {
    ?>
                                    <option value="<?php echo $t->id; ?>"<?php
                                    if ($banners->tag_id == $t->id) {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?php echo $t->title; ?></option>
                                          <?php } ?>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Position: *</label><br>
                        <div class="col-sm-10" id="position">
                            <label><input type="radio" name="position" <?php
                                          if ($banners->position == 1) {
                                              echo 'checked';
                                          }
                                          ?> value="1"> First Banner</label> &nbsp;&nbsp;
                            <label><input type="radio" name="position" <?php
                                          if ($banners->position == 2) {
                                              echo 'checked';
                                          }
                                          ?> value="2"> Second Banner</label>&nbsp;&nbsp;
                            <label><input type="radio" name="position" <?php
                                          if ($banners->position == 3) {
                                              echo 'checked';
                                          }
                                          ?> value="3"> Third Banner</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-10">
                            <input type="text" name="priority" id="priority" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" class="form-control" value="<?= $banners->priority ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Flat Discount</label>
                        <div class="col-sm-10">
                            <input type="text" name="discount" id="discount" class="form-control number" value="<?= $banners->flat_discount; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="1" <?php
                                          if ($banners->status == 1) {
                                              echo "selected='selected'";
                                          }
                                          ?>>Active</option>
                                <option value="0" <?php
                                          if ($banners->status == 0) {
                                              echo "selected='selected'";
                                          }
                                          ?>>InActive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_banner" type="submit"> <i class="fa fa-floppy-o"></i> Update</button>

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