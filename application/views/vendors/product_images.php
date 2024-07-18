<style>
    .product_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
        border: 1px solid #edecec;
    }
    .shop_title{
        font-size:17px !important;
        color: #f39c5a;
    }
    .mangeImagesGrid{
        border: 1px solid #ebe9e9;
    }
    .manageImagesGridImgView{
        width:100%;
        /*border: 1px solid #e5e5e5;*/
        margin-bottom: 4px;
    }
    .previewImage{
        padding: 3px;
        border: 1px solid #ccc;
        margin:4px;
        width:30%;
        float:left;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5 class="shop_title"><?= $title ?>'s Products</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/products/linkvariant/<?php echo $pid; ?>">
                            <button class="btn btn-primary">Back</button>
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
                    <?php }
                    ?>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <?php
                            $qry = $this->db->query("select * from product_images where product_id='" . $pid . "' and variant_id='" . $vid . "'");
                            $result = $qry->result();
                            foreach ($result as $value) {
                                ?>
                                <div class="col-md-4 mangeImagesGrid" style="margin: 10px;">
                                    <a href="<?= base_url() ?>vendors/products/deleteImage/<?php echo $value->id; ?>/<?php echo $pid; ?>/<?php echo $value->variant_id; ?>" style="color: red;"><i class="fa fa-trash"></i></a>
                                    <img src="<?php echo base_url(); ?>uploads/products/<?php echo $value->image; ?>" style="width: 80%;"/>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-6 mb-5" style="text-align: center;margin-top: 25px">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/uploadImages/">
                            <input type="hidden" name="pid" value="<?= $pid; ?>">
                            <input type="hidden" name="vid" value="<?= $vid; ?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="image">
                                    <span style="color:red;">Image Width : 640px and height : 640px</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Priority</label>
                                <div class="col-sm-10">
                                    <input type="text" name="priority" id="priority" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" class="form-control" required="">
                                </div>
                            </div>
                            <button class="btn btn-primary" id="product_images" >Upload</button>
                    </div>

                    </form>
                </div>





            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#product_images').click(function () {
        $('.error').remove();
        var errr = 0;
        var FileUploadPath = $('#image').val();
        var FileSize = document.getElementById("image").files[0];
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        if (FileUploadPath == '')
        {
            $('#image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Image</span>');
            $('#image').focus();
            return false;
        } else if (FileSize.size > 2097152)
        {
            $('#image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">File size must under 2mb!</span>');
            $('#image').focus();
            return false;
        } else if (Extension == "png" || Extension == "jpeg" || Extension == "jpg")
        {
            if (fuData.files && fuData.files[0])
            {
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(fuData.files[0]);
            }
        } else
        {
            $('#image').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Image only allows file types of PNG , JPG, and JPEG.</span>');
            $('#image').focus();
            return false;
        }





    });
</script>