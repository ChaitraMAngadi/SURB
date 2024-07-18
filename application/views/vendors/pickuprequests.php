<style>
.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
}
    .shop_image{

        width: 100px;

        height: 100px;

        object-fit: scale-down;

        margin-right:5px;

        border-radius: 10px;

        border: 1px solid #efeded;

    }

    .shop_title{

        font-size:17px !important;

        color: #f39c5a;

    }

</style>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        

        <div class="col-lg-12">

            <div class="ibox float-e-margins">



                <div class="ibox-title">

                    <h5 class="shop_title">pickup requests</h5>

                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/dashboard">
                            <button class="btn btn-primary">BACK</button>
                        </a>

                    </div>

                </div><br><br>

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
                <div>
                <?php
$vendors = $this->db->query("select * from warehouses where vendor_id='".$vendor_info->id."'");
$vendor_list = $vendors->result();
$vendor_name = [];
$pickup_name = [];
$active=[];
foreach ($vendor_list as $vendor) {
    $vendor_name[] = $vendor->warehouse_name;
}

foreach ($pickuprequest as $pickup) {
    // Check if the status is 'completed' or if the warehouse name is not used before
    if ($pickup->status == 'active'){
        // $used_warehouse_names[] = $pickup->warehouse_name; // Mark the warehouse name as used
        $active[]=$pickup->warehouse_name;
        // continue;
    }
    else if($pickup->status == 'completed' || (!in_array($pickup->warehouse_name, $pickuprequest))){
        $pickup_name[] = $pickup->warehouse_name;
    }
}
// print_r($active);

// Now $pickup_name will contain unique warehouse names based on the conditions
// print_r($pickup_name);
// print_r($used_warehouse_names);

// print_r($missing_elements);
$statusArray = array_column($pickuprequest, 'status');
$status=false;
// If there is only one unique status and it is 'completed', show the button
if (count(array_unique($statusArray)) === 1 && reset($statusArray) === 'completed') {
    // echo '<button>Show Button</button>';
    $status=true;
} else {
    // Do something else or don't show the button
    $status=false;
}

if (empty($pickup_name) || (count(array_diff($vendor_name, $pickup_name)) == 0)) {
    // Consider $vendor_name
    $resulting_array = $vendor_name;
} else if($status==false){
$resulting_array=array_diff($vendor_name,$active);
}
 else {
    // Consider $pickup_name
    $resulting_array = $pickup_name;
}
foreach($pickuprequest as $name){
    if($name->status=='active'){
        
        // print_r($name);
        $resulting_array2=array_diff($vendor_name,$active);
            
    }
}
// && !empty($resulting_array2)
// Now $resulting_array will contain the final array based on the conditions
// print_r($resulting_array2);
// $missing_elements = array_diff($vendor_name, $pickup_name);
// print_r($missing_elements);
if ((!empty($resulting_array) && !empty($resulting_array2) &&$vendor_info->delivery_partner == 'delhivery')||($pickuprequest[0]->status == 0 || $pickuprequest[0]->status == '' || $status==true && $vendor_info->delivery_partner == 'delhivery')) {
    ?>
    <button type="button" class="btn btn-success" data-toggle="modal" title="create pickup request" data-target="#exampleModal123" id="pk_up">Create pickup Request</button>
<?php } ?>




                        </div>
                        <div class="modal fade" id="exampleModal123" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <!--        <h5 class="modal-title" id="exampleModalLabel">Shipment</h5>-->
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <!-- <a  href="<?php echo base_url(); ?>vendors/orders/setLocation/<?php echo $vendor_info->id;?>"><button type="button" class="btn btn-success">Pick Up Request</button></a> -->
                                                    <form method="post" id="yourFormId" action="<?php echo base_url(); ?>vendors/orders/setLocation/<?php echo $vendor_info->id;?>">
                                                    <h4 style="margin:0 auto;text-align:center;align-items:center;float:center;margin-bottom:10px;">pick up Form</h4>
                                                        <span style="margin-left: 32px;width: 90%;">Select date:<input type="date"  name="selected_date" id="selected_date" style="margin-left:30px;"></span><br><br>
                                                        <!-- <span style="margin-left: 32px;width: 90%;"> Select a time: <input type="time" name="selected_time" id="selected_time" step="1"style="margin-left:30px;">
                                                    </span><br><br> -->
                                                    <div  style="margin-left: 32px;width: 90%;">
    <!-- <button class="btn btn-primary dropdown-toggle" type="button"  data-bs-toggle="dropdown" aria-expanded="false">
        Select Time Slot
    </button> -->
    <select   name="selected_time" onchange="selectTime(this.value)">
        <option value="7:00:00" style="cursor: pointer;">
        7:00 am 
            <!-- <a href="#" class="dropdown-item" onclick="selectTime('7:00am-10:00am')" ></a> -->
            <!-- <input type="hidden"  value="7:00am-10:00am"> -->
        </option>
        <option value="10:00:00" style="cursor: pointer;">
        10:00 am
            <!-- <a href="#" class="dropdown-item" onclick="selectTime('10:00am-12:30pm')" ></a> -->
            <!-- <input type="hidden"  > -->
        </option>
        <option value="12:30:00" style="cursor: pointer;">
        12:30 pm 
            <!-- <a href="#" class="dropdown-item" onclick="selectTime('12:30pm-3:00pm')" ></a> -->
            <!-- <input type="hidden"  > -->
        </option>
        <option value="3:00:00" style="cursor: pointer;">
            3:00 pm 
            <!-- <a href="#" class="dropdown-item" onclick="selectTime('3:00pm-7:00pm')" ></a> -->
            <!-- <input type="hidden"  > -->
        </option>
        <option value="7:00:00" style="cursor: pointer;">
            7:00 pm 
            <!-- <a href="#" class="dropdown-item" onclick="selectTime('3:00pm-7:00pm')" ></a> -->
            <!-- <input type="hidden"  > -->
        </option>

</select>
</div>
                                                        <span style="margin-left: 32px;"> select warehouse location:
                                                        <select class="form-control" name="delivery_id" id="warehouses" style="margin-left:30px;width: 60%;">
        <option value="">Select warehouses</option>
        <?php
$vendors = $this->db->query("select * from warehouses where vendor_id='".$vendor_info->id."'");
$vendor_list = $vendors->result();

$vendor_name = [];
$pickup_name = [];
$active=[];
$completed=[];

foreach ($vendor_list as $vendor) {
    $vendor_name[] = $vendor->warehouse_name;
}

foreach ($pickuprequest as $pickup) {
    // Check if the status is 'completed' or if the warehouse name is not used before
    if ($pickup->status == 'active'){
        // $used_warehouse_names[] = $pickup->warehouse_name; // Mark the warehouse name as used
       $active[]=$pickup->warehouse_name;
    //    continue;
    }
    else if($pickup->status == 'completed' || (!in_array($pickup->warehouse_name, $pickuprequest))){
        $pickup_name[] = $pickup->warehouse_name;
    }
    else if($pickup->status == 'completed'){
        $completed[]=$pickup->warehouse_name;
    }

}

if (empty($pickup_name) || count(array_diff($vendor_name, $pickup_name)) == 0) {
    // Consider $vendor_name
    $resulting_array = $vendor_name;
}  
else {
    // Consider $pickup_name
    $resulting_array = $pickup_name;
}
foreach($pickuprequest as $name){
    if($name->status=='active'){
        
        $resulting_array=array_diff($vendor_name,$active);
            
    }
    else if($name->status=='completed'){
        $resulting_array=$vendor_name;
    }
}

if (!empty($resulting_array)) {
    foreach ($resulting_array as $ven) {
        ?>
        <option value="<?php echo $ven; ?>"><?php echo $ven; ?></option>
        <?php 
    }
}
?>

    </select></sapn><br> <span style="margin-left: 32px;width: 90%;"><input type="number" name="count" id="count" placeholder="Enter package count" style="width:60%;"></span><br><br>
                                                        <input type="submit" value="Create Pick Up Request" class="btn btn-success"style="margin:10px;width:90%;text-align:center;align-items:center;float:center;margin-bottom:10px;">
                                                    </form></div></div></div>
 <div class="ibox-content">
              
 <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                               
                               
                                
                                <th>pickup id</th>
                                <th>warehouse name</th>
                                <th>creation date</th>
                                <th>pickup date</th>
                                <th>pickup time</th>
                                <th>order id - waybill</th>
                                <th>packages count</th>
                              
                                <th>status</th>
                                <th>action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                          
                            foreach ($pickuprequest as $request) {
                                ?>
                                <tr class="gradeX">
                                    
                                   
                                   </td>
                                   
                                 
                                   
                                    <td><?= $request->pickup_id ?></td>
                                    <td><?= $request->warehouse_name ?></td>
                                    <td> <?= $request->created_at ?></td>
                                    <td> <?= $request->pickup_date ?></td>
                                    <td> <?= $request->pickup_time ?></td>
                                    <td> <?= $request->order_array ?></td>


                                    
                                   

                                    
                                    <td> <?= $request->packages_count ?></td>
                                  
                                    <td>
                                        <?= $request->status?></td>
                                        <td>
                                        <?php if($vendor_info->delivery_partner=='delhivery' && $request->status=='active'){?>
                                        
                                        <?php
$url = base_url('vendors/orders/pickUp_update/'.$request->id.'/'.$request->pickup_id.'/'.$request->status);
// echo "Generated URL: $url";
?>
<a href="<?php echo $url; ?>">
    <button class="btn btn btn-success" title="Complete pick up request">Complete this pick up request</button>
</a>
                           
                            <?php }
                            else if($vendor_info->delivery_partner=='delhivery' && $request->status=='completed'){?>
                                     
    <button class="btn btn btn-primary" title="Completed">completed</button>
 
                               <?php }?> </td>

                                </tr>

                                <?php

                                    $ks++;
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





</div>

<script>
    // function selectTime(selectedTime) {
    //     document.getElementById('dropdownMenuButton1').innerText = `${selectedTime}`;
    //     document.querySelectorAll('input[name="selected_time"]').forEach(item => {
    //         item.value = selectedTime;
    //     });
    // }
</script>

<!-- Add Bootstrap JS and Popper.js scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

