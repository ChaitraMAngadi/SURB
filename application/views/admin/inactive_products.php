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
    .dataTables_length, .dataTables_info {
       display: none !important; 
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5 class="shop_title">Products</h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <!-- <a href="<?= base_url() ?>vendors/products/add_product?shop_id=<?= $_SESSION['vendors']['vendor_id'] ?>">
                            <button class="btn btn-primary">+ Add Product</button>
                        </a> -->
                        <!-- <a href="<?= base_url() ?>vendors/products/import_product?shop_id=<?= $_SESSION['vendors']['vendor_id'] ?>">
                            <button class="btn btn-primary">+ Import Excel</button>
                        </a> -->

                        <!--   <?php if ($back1 == 'button1') { ?>
                             <button onclick="goBack()" class="btn btn-primary">Back</button>
                        <?php } ?>
 
                     </div>
 
                      <script>
 function goBack() {
   window.history.back();
 }
 </script>
                        -->

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

                        <form method="get" action="<?= base_url() ?>admin/inactive_products" id="filter_purchase_form">
                            <div class="form-group row">
                                <div class="col-sm-5"><label for="keyword" class="caption">Product name</label>
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon"><i class="fa fa-file"></i></div> -->
                                        <input class="form-control input-sm w-50 border-primary" type="text" name="keyword" placeholder="Enter product name / id" value="<?= $filter_keyword != "" ? $filter_keyword : "" ?>" style="width:350px;">
                                    </div>
                                </div>
                                <div class="col-sm-4"><label for="invocieno" class="caption">Categories</label>
                                    <div class="input-group">
                                        <select class="form-control" name="category">
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $cat) { ?>
                                                <option value="<?= $cat->id ?>" <?= ($filter_category == $cat->id) ? 'selected' : '' ?>><?= $cat->category_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="submit" class="btn btn-success mt-2" value="Search">&nbsp;&nbsp;
                                        <a href="<?= base_url() ?>admin/inactive_products"><input type="button" class="btn btn-danger mt-2" name="reset" value="Reset"></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Product ID</th>
                                        <th>Shop Name</th>
                                        <th>Owner Name</th>
                                        <th>Email Name</th>
                                        <th>Mobile Name</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Status</th>
                                        <th>Added On</th>
                                        <th>Updated On</th>
                                        <th class="notexport">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($kk == "") {
                                        $kk = 1;
                                    }
                                    foreach ($products as $pr) {

                                        $cat = $this->db->query("select * from categories where id='" . $pr->p_cat_id . "'");
                                        $category = $cat->row();
                                        $subcat = $this->db->query("select * from sub_categories where id='" . $pr->sub_cat_id . "'");
                                        $subcategory = $subcat->row();

                                        $vendor = $this->db->query("select * from vendor_shop where id='" . $pr->shop_id . "'");
                                        $vendor_shops = $vendor->row();
                                        ?>
                                        <tr class="gradeX">
                                            <td><?= $kk ?></td>
                                            <td><?= $pr->pid ?></td>
                                            <td>
                                                <a target="_blank" >
                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendors/login/admin_login/">
                                                        <input type="hidden" name="email" class="form-control" value="<?php echo $vendor_shops->mobile; ?>">
                                                        <input type="hidden" name="password" class="form-control" value="<?php echo $vendor_shops->password; ?>">
                                                        <input type="hidden" name="md5" class="form-control" value="1">
                                                        <button type="submit" onclick="this.form.target = '_blank';return true;" style="border: none;outline: none;background: transparent;"><?php echo $vendor_shops->shop_name; ?></button>
                                                    </form>
                                                </a>
                                            </td>
                                            <td><?php echo $vendor_shops->owner_name; ?></td>
                                            <td><?php echo $vendor_shops->email; ?></td>
                                            <td><?php echo $vendor_shops->mobile; ?></td>
                                            <td>

                                                <?php
                                                $pro_im = $this->db->query("select * from product_images where product_id='" . $pr->pid . "'");
                                                $pro_imgs = $pro_im->row();
                                                if ($pro_im->num_rows() > 0) {
                                                    ?>
                                                    <img class="product_image" align="left" src="<?php echo base_url(); ?>uploads/products/<?php echo $pro_imgs->image; ?>" title="Product image">
                                                <?php } else { ?>
                                                    <img class="product_image" align="left" src="<?= DEFAULT_IMAGE_PATH ?>" title="Product image">
                                                <?php } ?>

                                                <?= $pr->name ?>
                                                <p style="color: red;"> <?php
                                                    if ($pr->top_deal == 'yes') {
                                                        echo "TOP DEAL PRODUCT";
                                                    }
                                                    ?></p>

                                            </td>
                                            <td><?= $category->category_name ?></td>
                                            <td><?= $subcategory->sub_category_name ?></td>
                                            <td class="center">
                                                <?php
                                                if ($pr->prod_status == 1) {
                                                    ?>
                                                    <p style="color: green;font-weight: bold;">Active</p>
                                                    <?php
                                                } else if ($pr->prod_status == 0) {
                                                    ?>
                                                    <p style="color: red;font-weight: bold;">Inactive</p>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?= $pr->created ? date('d M Y, h:i A', $pr->created) : 'N/A' ?></td>
                                            <td><?= $pr->updated ? date('d M Y, h:i A', $pr->updated) : 'N/A' ?></td>
                                            <td><?php
                                                if ($pr->prod_status == 1) {
                                                    ?>
                                                    <a href="<?= base_url() ?>admin/products/changeStatus/<?= $pr->pid ?>/0"><button title="Active" class="btn btn-xs btn-danger">Inactive</button></a>
                                                    <?php
                                                } else if ($pr->prod_status == 0) {
                                                    ?>
                                                    <a href="<?= base_url() ?>admin/products/changeStatus/<?= $pr->pid ?>/1"><button title="Change to active" class="btn btn-xs btn-green">
                                                            Active
                                                        </button></a>
                                                    <?php
                                                }
                                                ?>
                                                <a href="<?= base_url() ?>admin/inactive_products/edit/<?php echo $pr->pid; ?>">
                                                    <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>Edit</button>
                                                </a>
                                                <button class="btn btn-xs btn-danger delete_product" data-id="<?= $pr->pid; ?>"><i class="fa fa-trash-o"></i> Delete</button>
                                            </td>


            <!--  <button class="btn btn-xs btn-danger delete_product" data-id="<?= $pr->pid; ?>"><i class="fa fa-trash-o"></i> Delete</button> -->

            <!-- <td>
                                            <?php
                                            $c = $this->db->query("select * from product_images where product_id='" . $pr->pid . "'");
                                            $num_rows = $c->num_rows();
                                            ?>
                <p>Images - <?php echo $num_rows; ?></p>

            </td> -->
            <!-- <td>
                                            <?php
                                            if ($pr->variant_product == 'no') {
                                                
                                            } else {
                                                ?>
                            <a href="<?= base_url() ?>vendors/products/addvariant/<?php echo $pr->pid; ?>">
                                <button class="btn btn-xs btn-info">+ Add Variant</button>
                            </a>

                            
    <?php } ?>
            <a href="<?= base_url() ?>vendors/products/linkvariant/<?php echo $pr->pid; ?>">
                    <button class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i>  Products </button>
                </a>
               
            </td> -->



                                        </tr>
                                        <?php
                                        $kk++;
                                    }
                                    ?>
                                </tbody>

                            </table>
                            <div class="pagination-bx  clearfix ">
<?= $pagination ?>
                            </div>
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
                    var location = '<?= base_url() ?>admin/inactive_products/delete_product?product_id=' + product_id;
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


