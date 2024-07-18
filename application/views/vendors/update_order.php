<style>
    .category_comm_span{
        top: -5px;
        position: relative;
        left: 10px;
    }
    .cat_commission{
        top: -5px;
        position: relative;
        left: 21px;
    }
</style>
<?php 
// echo "<pre>";
// print_r($warehouses);
// die();
// echo "<pre>";
// print_r($update_order);
// exit;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $title ?></h5>
                <div class="ibox-tools">
                    <a href="<?= base_url() ?>vendors/orders">
                        <button class="btn btn-primary">BACK</button>
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
                   
                    <?php } ?>
                    
<div class="col-lg-12">
    <form id="update_order" method="post" class="form-horizontal" enctype="multipart/form-data">
        <h3 class="text-center text-primary">Update order</h3>
        <div class="form-group">
            <div class="col-lg-12">
            <input type="text" name="order_id" id="order_id" class="form-control"  value="<?php print_r($update_order->order_id); ?>" readonly="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
            <input type="text" name="waybill" id="waybill" class="form-control"  value="<?php print_r($update_order->waybill); ?>" readonly="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <input type="text" name="shipment_length" id="shipment_length" class="form-control" placeholder="shipment length" value="<?php echo $update_order->shipment_length;?>">
            </div>
            <div class="col-lg-4">
                <input type="text" name="shipment_width" id="shipment_width" class="form-control" placeholder="shipment width" value="<?php echo $update_order->shipment_width;?>" >
            </div>
            <div class="col-lg-4">
                <input type="text" name="shipment_height" id="shipment_height" class="form-control" placeholder="shipment height" value="<?php echo $update_order->shipment_height;?>" >
            </div>
        </div>
        <div class="form-group">
        <div class="col-lg-6">
                <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter weight in gm" value="<?php echo $update_order->weight;?>"  >
            </div>
            <div class="col-lg-6">
                <input type="text" onkeypress="return isNumberKey(event)"  id="mobile_number" maxlength="10" name="mobile_number" class="form-control" placeholder="Enter Mobile number" value="<?php echo $update_order->phone;?>">
            </div>
            
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                <input type="text" name="payment_mode" id="payment_mode" class="form-control" placeholder="Enter payment mode" value="<?php echo $update_order->payment_mode;?>">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-12">
                <input type="text" name="consignee_name" id="consignee_name" class="form-control" placeholder="Enter consignee name" value="<?php echo $update_order->consignee_name;?>">
            </div>
           
        </div>
        <div class="form-group">
        <div class="col-lg-12">
                <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" value="<?php echo $update_order->address;?>">
        </div>
        </div>

        <div class="form-group">
        <div class="col-lg-12">
                <input type="text" name="productdetails" id="productdetails" class="form-control" placeholder="Enter product details" value="<?php echo $update_order->product_details;?>">
        </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                <input type="submit" value="submit" class="btn btn-primary" onclick="saveData(event)">
            </div>
        </div>
    </form>
</div>
        </div></div></div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script type="text/javascript">			
		function saveData(e) {
    var waybill=$("#waybill").val();
    var shipment_length = $('#shipment_length').val();
    var shipment_width = $('#shipment_width').val();
    var shipment_height = $('#shipment_height').val();
    var weight = $('#weight').val();
    var mobile_number = $('#mobile_number').val();
    var payment_mode = $('#payment_mode').val();
    var consignee_name = $('#consignee_name').val();
    var address = $('#address').val();
    var productdetails=$("#productdetails").val();
    var order_id=$("#order_id").val();
   
    // Validate the data
    if (waybill === '') {
        // toastr.error("Enter warehouse name");
        $('#waybill').focus();
        return false;
    } else if (order_id === '') {
       
        $('#order_id').focus();
        return false;
    } 

    

    // Send data to the server using AJAX
    $.ajax({
        url: "<?php echo base_url(); ?>vendors/orders/updateOrderCreation",
        method: "POST",
        data: {
            waybill:waybill,
            shipment_length: shipment_length,
            shipment_width: shipment_width,
            shipment_height: shipment_height,
            weight: weight,
            mobile_number: mobile_number,
            payment_mode: payment_mode,
            consignee_name: consignee_name,
            address: address,
            order_id: order_id,
            productdetails: productdetails
        },
        success: function (data) {
            // Handle the success response from the server
            // You can show additional toasts or take further actions here
            // toastr.success("Data saved successfully");
            var str = data;
            var res = str.split("@");
            if (res[1] == 'success'){
                console.log("ok");
                toastr.success("Data updated successfully");
                e.preventDefault(); 
            }
            else{
                console.log("not ok");
                toastr.error("not updated");
            }
           
// Handle the result from updateOrderCreation
// if (data.status === true) {
//     // Do something with the successful result
//     console.log("API call successful:", data);
// } else {
//     // Handle API failure
//     console.log("API call failed:", data.status);
// }

},

error: function (xhr, status, error) {
// Handle the error response from the server
// You can show additional toasts or take further actions here
console.log("error");
}


    });
}


    </script>