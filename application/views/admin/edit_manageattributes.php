<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">


                    <a href="<?= base_url() ?>admin/manage_attributes" style="float: right; margin: 8px;">
                        <button class="btn btn-primary">Back</button>
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
            <?php }
            ?>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/manage_attributes/update">

                    <div class="form-group">
                        
                        <label class="col-sm-2 control-label">Attribute Type</label>

                        <div class="col-sm-6">
                            <?php 
                            $attr_title = $this->db->where('id',$attributes->attribute_titleid)->get('attributes_title')->row()->title;
                            ?>
                            <input type="hidden" name="types" id="types" value="<?= $attributes->attribute_titleid ?>" class="form-control">
                            <input type="text" name="type_name" value="<?= $attr_title ?>" class="form-control" readonly="">
                        </div>

                    </div>


                    <div class="form-group">

                        <label class="col-sm-2 control-label">Categories</label>

                        <div class="col-sm-6">
                            <?php
                            $cat = $this->db->query("select categories from manage_attributes where attribute_titleid='" . $attributes->attribute_titleid . "'");
                            $row = $cat->result();
                            $cate_ids = [];
                            foreach ($row as $value) {
                                $cate_ids[] = $value->categories;
                            }
                            ?>
                            <select name="categories[]" id="categories"  class="form-control js-example-basic-multiple" multiple="multiple">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat) { ?>
                                    <option value="<?php echo $cat->id ?>" <?php
                                    if (in_array($cat->id, $cate_ids)) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?php echo $cat->category_name; ?></option>
                                        <?php } ?>
                            </select>
                        </div>

                    </div>


                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_manageattributes" type="submit">Save</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">


    $('#btn_manageattributes').click(function () {
        $('.error').remove();
        var errr = 0;
        if ($('#types').val() == '')
        {
            $('#types').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Attribute Type</span>');
            $('#types').focus();
            return false;
        } else if ($('#categories').val() == '' || $('#categories').val() == undefined)
        {
            $('#categories').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Categories</span>');
            $('#categories').focus();
            return false;
        }
    });

</script>