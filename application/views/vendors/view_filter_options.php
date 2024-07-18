<style>
    .cat_image{
        width: 100px;
        height: 100px;
        object-fit: scale-down;
        border-radius: 10px;
        margin: 0px 5px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Filter</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/products">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        
<!--                        <a href="<?= base_url() ?>vendors/banners/add">
                            <button class="btn btn-primary">+ Add Banner</button>
                        </a>-->
                    </div>

                   
                    
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Filters</th>
                                    <th>Filter Options </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filters as $v) {
                                    ?>
                                    <tr class="gradeX">
                                        
                                        <td><?php
                                   $filter_row = $this->vendor_model->get_data_row('filters',['id'=>$v->filter_id]);
                                     echo $filter_row->title;?>
                                     </td>
                                        
                                     <td><?php
                                     $filter_options = explode(',',$v->filter_options);
                                     //print_r($filter_options);die;
                                     $options_array = [];
                                     $i = 0;
                                     foreach ($filter_options as $explode){
                                   $filter_rows = $this->vendor_model->get_data_row('filter_options',['id'=>$explode]);
                                   $options_array[$i] = $filter_rows->options;
                                      $i++; } ?>
                                       <?php echo implode(',', $options_array); ?>
                                     </td> 
                                    </tr>
                                    <?php

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
