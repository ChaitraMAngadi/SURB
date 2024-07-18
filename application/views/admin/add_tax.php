<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h5><?= $title ?></h5>

                <div class="ibox-tools">

                  <a href="<?= base_url() ?>admin/tags" >
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

                <form method="post" class="form-horizontal" action="<?= base_url() ?>admin/tax/insert">

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Tax Name</label>

                        <div class="col-sm-10">

                            <input type="hidden" name="id" class="form-control" value="<?php if ($tax) { echo $tax->id; } else { echo ''; } ?>">

                            <input type="text" name="title" id="title" class="form-control" value="<?php if ($tax) { echo $tax->title; } else { echo ''; } ?>">
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Type</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="type" id="type">
                                    <option value="">Select Type </option>
                                    <option value="pecentage" <?php if($tax->type=='pecentage'){ echo 'selected="selected"';}?>>Percentage </option>
                                    <option value="fixamount" <?php if($tax->type=='fixamount'){ echo 'selected="selected"';}?>>Fix Amount </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Rate</label>

                        <div class="col-sm-10">
                            <input type="text" name="amount" id="amount" class="form-control" value="<?php if ($tax) { echo $tax->amount; } else { echo ''; } ?>">
                        </div>

                    </div>

                    

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" id="btn_tags" type="submit">Save</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<script type="text/javascript">
  $('#btn_tags').click(function(){
        $('.error').remove();
            var errr=0;
      if($('#title').val()=='')
      {
         $('#title').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Tax Name</span>');
         $('#title').focus();
         return false;
      }
      else if($('#type').val()=='')
      {
         $('#type').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Select Type</span>');
         $('#type').focus();
         return false;
      }
      else if($('#amount').val()=='')
      {
         $('#amount').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px;">Enter Rate</span>');
         $('#amount').focus();
         return false;
      }

 });

</script>