<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">

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
                <form method="post" class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url() ?>vendors/businesshours/update">
                       

                         <input type="hidden" name="bid" value="<?php echo $workingdetails->id; ?>" required>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select Week Day</label>

                        
                        <div class="col-sm-6">
                            <select name="weekname" id="weekname" class="form-control" >
                                <option value="sunday" <?php if($workingdetails->weekname=='sunday'){ echo 'selected="selected"'; }?>>Sunday</option>
                                <option value="monday" <?php if($workingdetails->weekname=='monday'){ echo 'selected="selected"'; }?>>Monday</option>
                                <option value="tuesday" <?php if($workingdetails->weekname=='tuesday'){ echo 'selected="selected"'; }?>>Tuesday</option>
                                <option value="wednesday" <?php if($workingdetails->weekname=='wednesday'){ echo 'selected="selected"'; }?>>Wednesday</option>
                                <option value="thursday" <?php if($workingdetails->weekname=='thursday'){ echo 'selected="selected"'; }?>>Thursday</option>
                                <option value="friday" <?php if($workingdetails->weekname=='friday'){ echo 'selected="selected"'; }?>>Friday</option>
                                <option value="saturday" <?php if($workingdetails->weekname=='saturday'){ echo 'selected="selected"'; }?>>Saturday</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select Working</label>
                        <div class="col-sm-6">
                            <select name="working" id="working" class="form-control" >
                                <option value="yes" <?php if($workingdetails->working=='yes'){ echo 'selected="selected"'; }?>>Yes</option>
                                <option value="no" <?php if($workingdetails->working=='no'){ echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Open Time</label>
                        <div class="col-sm-6">
                            <input type="time" name="open_time" id="open_time" class="form-control" value="<?php echo $workingdetails->open_time; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Closed Time</label>
                        <div class="col-sm-6">
                            <input type="time" name="closed_time" id="closed_time" class="form-control" value="<?php echo $workingdetails->closed_time; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit"> <i class="fa fa-plus-circle"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>