<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?= $title ?></h5>
                            <div class="ibox-tools">
                               
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?= base_url() ?>vendors/products/insertStock">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Stock</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="vid" class="form-control" value="<?php echo $vid; ?>">
                                        <input type="hidden" name="pid" class="form-control" value="<?php echo $pid; ?>">
                                        <input type="text" name="quantity" class="form-control" required>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">                                       
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>