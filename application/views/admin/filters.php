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

                    <h5 class="shop_title">Filters</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <a href="<?= base_url() ?>admin/filters/add">
                            <button class="btn btn-primary">+ Add Filters</button>
                        </a>

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


                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Category</th>
                                        <th>Sub-Category</th>
                                        <th>Title</th>
                                        <th>Options</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $kk = 1;
                                    foreach ($filters as $fil) {

                                        $table2 = "filter_options";
                                        $this->db->select("*");
                                        $where = array('filter_id' => $fil->id);
                                        $options = $this->db->where($where)->get($table2)->result();
                                        $cat_name = $this->db->where('id', $fil->cat_id)->get('categories')->row()->category_name;
                                        $sub_cat_ids = explode(',', $fil->sub_cat_id);
                                        ?>
                                        <tr class="gradeX">
                                            <td><?= $kk ?></td>
                                            <td><?= $cat_name ?></td>
                                            <td>
                                                <?php
                                                if($sub_cat_ids[0] != null) {
                                                foreach ($sub_cat_ids as $id) {
                                                    $sub_cat_name = $this->db->where('id', $id)->get('sub_categories')->row()->sub_category_name;
                                                    ?>
                                                    <span style="border: 3px solid" class="badge badge-success"><?php echo $sub_cat_name ?></span>
                                                <?php } } else { ?>
                                                    N/A
                                                <?php } ?>
                                            </td>
                                            <td><?= $fil->title ?></td>
                                            <td>
                                                <div class="container">
                                                    <button type="button" class="btn btn-xs btn-green" data-toggle="modal" data-target="#myModal<?= $fil->id ?>">View Options</button>
                                                </div>

                                            </td>
    <!--                                        <td><?php
                                            if ($fil->status == 1) {
                                                ?>
                                                        <button title="Active" class="btn btn-xs btn-green">Active</button>
                                                <?php
                                            } else {
                                                ?>
                                                        <button title="Inactive" class="btn btn-xs btn-danger">
                                                            Inactive
                                                        </button>
                                                <?php
                                            }
                                            ?>
                                            </td>-->
                                            <td>
                                                <a href="<?= base_url() ?>admin/filters/edit/<?php echo $fil->id; ?>">
                                                    <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Edit</button>
                                                </a>
                                                <a href="<?= base_url() ?>admin/filters/delete/<?php echo $fil->id; ?>">
                                                    <button class="btn btn-xs btn-danger" value="<?= $pr->id; ?>" onclick="if (!confirm('Are you sure you want to delete this filter?'))
                                                                    return false;"><i class="fa fa-trash"></i>Delete</button>
                                                </a>
                                            </td>             
                                        </tr>


                                    <div class="modal fade" id="myModal<?= $fil->id ?>" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Options </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <ol>
                                                        <?php foreach ($options as $value) { ?>

                                                            <li><?= $value->options ?></li>
                                                        <?php } ?>
                                                    </ol>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                    $kk++;
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


    <!-- Update Prices Modal-->
    <style>
        #UpdatePricesModal .form-control{
            margin-bottom: 10px;
        }
    </style>


    <script type="text/javascript">
        function getProducts(value)
        {
            if (value == 1)
            {
                document.getElementById("displaystock").style.display = "block";
            } else
            {
                document.getElementById("displaystock").style.display = "none";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID
            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><div class="input_fields_wrap"><div class="col-sm-12"><label class="col-sm-2 control-label">Attributes</label><div class="col-sm-4"><label class="col-sm-2 control-label">Name: *</label><input type="text" name="title[]" class="form-control" value=""></div><div class="col-sm-4"><label class="col-sm-2 control-label">Value: *</label><input type="text" name="values[]" class="form-control" value=""></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>

    <script type="text/javascript">

        function deleteImage(img_id)
        {

            if (img_id != '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>vendors/products/deleteImage",
                    method: "POST",
                    data: {img_id: img_id},
                    success: function (data)
                    {

                        //alert(JSON.stringify(data));
                        alert("Image delted");
                        //var location = '<?= base_url() ?>vendors/products';
                        //console.log(location);
                        //window.location = location;
                        $('#UploadImagesModal').modal('show');
                        //$('#image_id').show("Image delted");
                    }
                });
            }
        }
        $(document).ready(function () {

            $('#backNavigation').click(function (e) {
                console.log("log something");
                //            window.history.back();
                return false;
            });


            $('.delete_product').on('click', function () {
                var product_id = $(this).attr('data-id');
                console.log(product_id);
                var confirm = window.confirm('Are you sure, you want to delete related Variants and Images ?');
                if (confirm) {
                    var location = '<?= base_url() ?>vendors/products/delete_product?product_id=' + product_id;
                    console.log(location);
                    window.location = location;
                } else {
                    console.log('not confirmed');
                }
            })

            $('.StockLogsModal').on('click', function () {
                var product_id = $(this).attr('data-id');
                console.log(product_id);
                $('#StockLogsModal').modal('show');

                $.post("<?= base_url() ?>api/admin_ajax/vendors/get_stock",
                        {
                            product_id: product_id
                        },
                        function (response, status) {
                            console.log("Data: " + response + "\nStatus: " + status);
                            console.log(JSON.stringify(response));

                            if (response['status'] == 'valid') {
                                //                            $('#manageStockContainer').show();
                                console.log(response['data']);
                                $('#stock_logs').html();
                                var tbody = '';
                                var i = 1;
                                response['data'].forEach(function (obj) {
                                    console.log(obj);
                                    tbody += ` <tr>
                                            <td>` + i + `</td>
                                            <td>` + obj.stock + `</td>
                                            <td>` + obj.type + `</td>
                                            <td>` + obj.note + `</td>
                                            <td>` + obj.balance + `</td>
                                        </tr>`;
                                    i++;

                                });
                                $('#stock_logs').html(tbody);
                            } else {
                                //                            $('#manageStockContainer').hide();
                            }
                        });
                //            $('#product_stock').val(stock);
                //            $('#updatestockModal').modal('show')
            });

            $('.upload_images').on('click', function () {
                $('#UploadImagesModal').modal('show');
            });

            var imagesPreview = function (input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            console.log(event);
                            var div = document.createElement('div');
                            div.setAttribute('class', 'previewImage');

                            var img = document.createElement('img');
                            img.src = event.target.result;
                            img.setAttribute('width', '50%');
                            div.appendChild(img);


                            var fileDisplayEl = document.createElement('p');
                            fileDisplayEl.innerHTML = event.target.fileName;
                            div.appendChild(fileDisplayEl);

                            placeToInsertImagePreview.appendChild(div);
                        };
                        console.log(filesAmount);
                        reader.fileName = input.files[i].name;
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#browseimages').on('change', function () {
                var filelistdisplay = document.getElementById('file-list-display');
                imagesPreview(this, filelistdisplay);
            });


            $('.ShowPricesModal').on('click', function () {
                //            alert('hello');
                $('#UpdatePricesModal').modal('show');
            })






        });
    </script>


