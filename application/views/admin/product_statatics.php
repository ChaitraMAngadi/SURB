
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

                    <h5 class="shop_title"><?=$products->name;?></h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/products">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                        <!-- <a href="<?= base_url() ?>vendors/products/add_product?shop_id=<?= $_SESSION['vendors']['vendor_id'] ?>">
                            <button class="btn btn-primary">+ Add Product</button>
                        </a> -->
                        <!-- <a href="<?= base_url() ?>vendors/products/import_product?shop_id=<?= $_SESSION['vendors']['vendor_id'] ?>">
                            <button class="btn btn-primary">+ Import Excel</button>
                        </a> -->

                       <!--   <?php 
                        if($back1=='button1'){?>
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>User Details</th>   
<!--                                    <th>Product ID</th>-->
                                    <th>Is in Whistlist</th>
                                    <th>Is in Cart</th>
                                    <th>Is in Check Out</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                foreach ($users as $value) {
                                    // $link_variant = $this->db->where(array("product_id"=>$products->id))->get("link_variant")->row();

                                    $whistlist_count = $this->db->where(array("user_id"=>$value->id,"variant_id"=>$link_variant->id))->get("whish_list")->num_rows();
                                    if($whistlist_count > 0){
                                        $whist = "Yes";
                                    }else{
                                        $whist = "No";
                                    }
                                    
                                    $cart_count = $this->db->where(array("user_id"=>$value->id,"variant_id"=>$link_variant->id))->get("cart")->row();
                                    $checkitem = $cart_count->check_out;
                                    // echo $this->db->last_query();die;
                                    if($checkitem == 1 ){
                                        $cart = "Yes";
                                    }else{
                                        $cart = "No";
                                    }
                                   
                                    $cart_data = $this->db->where(array("user_id"=>$value->id,"variant_id"=>$link_variant->id))->get("cart")->row();
                                    $check_out1 = $cart_data->is_checkout;
                                    if($check_out1 == 1){
                                        $check = "Yes";
                                    }else{
                                        $check = "No";
                                    }
                                    
                                    $whistlist = $this->db->where(array("user_id"=>$value->id,"variant_id"=>$link_variant->id))->get("whish_list")->row();
                                   
                                    $cart_list = $this->db->where(array("user_id"=>$value->id,"variant_id"=>$link_variant->id))->get("cart")->row();

                                if($value->id==$whistlist->user_id || ($cart_list->check_out == 1 || $cart_list->is_checkout == 1)){
                                    
                                ?>
                            <tr class="gradeX">
                            <td><?=$i?></td>
                            <td>
                                First name : <?=$value->first_name;?><br/>
                                Last name : <?=$value->last_name;?><br/>
                                Email : <?=$value->email;?><br/>
                                Phone number : <?=$value->phone;?><br/>                           
                            </td>
<!--                            <td><?=$products->id;?></td>-->
                            <td><?php echo $whist;?></td>
                            <td><?php echo $cart;?></td>
                            <td><?php echo $check;?></td>
                            </tr>
                            <?php
                                 $i++;
                                    }
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
    if(value==1)
    {
      document.getElementById("displaystock").style.display = "block";
    }
    else
    {
      document.getElementById("displaystock").style.display = "none";
    }
  }
</script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div><div class="input_fields_wrap"><div class="col-sm-12"><label class="col-sm-2 control-label">Attributes</label><div class="col-sm-4"><label class="col-sm-2 control-label">Name: *</label><input type="text" name="title[]" class="form-control" value=""></div><div class="col-sm-4"><label class="col-sm-2 control-label">Value: *</label><input type="text" name="values[]" class="form-control" value=""></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });
</script>

<script type="text/javascript">

    function deleteImage(img_id)
    {

                if(img_id != '')
                {
                   $.ajax({
                    url:"<?php echo base_url(); ?>vendors/products/deleteImage",
                    method:"POST",
                    data:{img_id:img_id},
                    success:function(data)
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


