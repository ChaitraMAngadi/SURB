<style>   

.cart_quant::after {
  content: '\25BC'; /* Unicode down arrow character */
  position: absolute;
  top: 50%;
  right: 15px;
  transform: translateY(-50%);
}
.links-column {
    /* Add styles for the left column here */
    /* Assuming you want a vertical layout for the links */
    display: flex;
    flex-direction: column;
    
    gap: 55px; /* Adds some spacing between the links */
}
.scrollable-div{
            height: 300px;
            width: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
            background-color:white;
            /* margin-right:20px; */
            /* margin:auto;
             */
           
            
         }
         /* .custom-select{
            overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
display: block;
         } */
         
         .badge-pill {

    /* color: #007bff;  */
    width: auto;
height: 21px;
background: var(--unnamed-color-2556b91a) 0% 0% no-repeat padding-box;
background: #2556B91A 0% 0% no-repeat padding-box;
border-radius: 16px;
padding: 5px;

/* opacity: 0.5; */
    /* margin-left: 10px; */
 }
 .colortype{
    font-weight: bold;
    color: var(--unnamed-color-2556b9);
/* text-align: left; */
/* font: normal normal 600 10px/34px Muli; */
/* letter-spacing: 0px; */
color: #2556B9;
opacity: 1;
 }
.cart_amount{
font-weight: bold;
}
/* visited link */
/* a:visited {
  color: var(--thm-blue);
} */
a:active{
    color:var(--thm-blue);
}


         .scrollable-div::-webkit-scrollbar {
            width: 5px; /* Set the width of the scrollbar */
            /* background-color: #F5F5F5; Set the background color of the scrollbar */
            position: absolute;
            left: 0; /* Position the scrollbar on the left of the element */
         }
         .scrollable-div::-webkit-scrollbar-thumb {
            background-color: #CDCDCD; /* Set the color of the thumb */
         }
         ::-webkit-scrollbar-track {
            /* background: var(--thm-blue); */

            /* border-radius: 5px; */
         }
    .links-column {
    /* Add styles for the left column here */
    /* Assuming you want a vertical layout for the links */
    display: flex;
    flex-direction: column;
    
    gap: 45px; /* Adds some spacing between the links */
}
         /* .check{
            
height: 35px;
background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
background: #FFFFFF 0% 0% no-repeat padding-box;
opacity: 1;
         }
        */
   
</style>
<?php 
// echo "<pre>"; print_r($result);exit;?>
<!--breadcrumbs area start-->
<div id="scroll_id"></div>
<div class="breadcrumbs_area mb-3 mt-72 breads">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <span style=" font-size:15px;
        text-transform: capitalize;
        font-weight: bold;line-height:1.5em;"><?php print_r($firstname." ".$lastname);?></span><br>
                    <span style="font-size:13px;"><?php
                     print_r($email);?></span>
                    <ul>
<!--                        <li><a href="<?php echo base_url(); ?>"><?php echo $shop_name; ?>, <?php echo $city; ?></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><br>
<!-- <br><br> -->
<!--breadcrumbs area end-->
<!--shopping cart area start -->

<div id="display_msg" style="text-align: center;font-size: 26px;"></div>
<section class="dashboard">
<div class="shopping_cart_area" id="loadCartdiv">
    <div class="container" >
        <div class="row">
            
        <div class="col-lg-2 mydashboard">
                        <?php include 'dashboard_menu.php' ?>
        </div>
        <div class="col-lg-6 mycart" style="display:none;">
        <?php $user_qry=$this->db->query("select * from users where id='".$user_id."'");
                 $user_qry_res=$user_qry->row();
                //  print_r($user_qry_res);
                $cartdata=$this->session->userdata('cart_data');
                // print_r($cartdata);
                if(($user_qry_res->membership == '' || $user_qry_res->membership == 'no') && 
                ($user_qry_res->plan == '' || $user_qry_res->plan == 0 || $user_qry_res->plan =='0' || $user_qry_res->plan == null) && 
                (empty($cartdata))){?>

<?php
    // Fetch the 'Prime' feature from the database
    $this->db->where('name', 'Prime');
    $query = $this->db->get('features');
    $feature = $query->row();

    // Check if  'prime' feature has status 1
    $show_prime = !empty($feature) && $feature->status == 1;
    ?>
    
    <?php if ($show_prime): ?>
<div class="prime-div">
    <div class="col-lg-12 col-md-12 col-xs-12 col-xl-12 col-12 col-xm-12 d-flex">
        <div class=" col-4 ">
            <img src="<?php echo base_url(); ?>web_assets/img/logo.png" class="logo_image_cart" style="vertical-align: middle; margin-right: 5px;">
        </div>
        <div class=" col-6 ">
            <h3 class="membership_header">Prime Membership</h3>
            <span class="membership_span">Enjoy unlimited free delivery</span>
        </div>
        <div style="margin-top: auto;" class="prime-class">
        <button type="button" class="btn-prime" data-toggle="modal" title="Prime Membership" data-target="#PrimeModal" id="prime">Buy Now</button>
        </div>
        
    </div>
    <div style="margin-top: auto;" class="btn-class-prime">
        <button type="button" class="btn-prime" data-toggle="modal" title="Prime Membership" data-target="#PrimeModal" id="prime">Buy Now</button>
    </div>
    
</div>
<?php endif; ?>


<?php }?><br>
        <div class="cart_address_box" style="display:none;"> 
        
            <?php
                                        $session_id = $_SESSION['session_data']['session_id'];
                                        $user_id = $_SESSION['userdata']['user_id'];
                                        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                                        $cart_count = $cart_qry->num_rows();
                                        ?> 
                                      <?php  
                                    //   $cart_id=$result[0]->id;
                                    //   echo "<pre>";
                                        // print_r();
                                        
                                         $cartdata=$this->session->userdata('cart_data');
                                        // print_r($cartdata);
                                        // exit;?>
                 <h4>My Cart <span class="item_counts" id="cart_count">(<?php echo $cart_count." items"; ?>)</span></h4>
                <input type="hidden" id="cart_data" value="<?php print_r($cartdata['price']);?>">

                
  
    
<?php $default=[];
    $qry = $this->db->query("select * from user_address where user_id='" . $user_id . "'");

    $address_list = $qry->result();
foreach ($address_list as $address) { ?>
   <?php  
   if ($address->address_type == '3') {
    // print_r($address);
array_push($default,$address);
?>
   <?php 
   }
    }?>
    <?php 
    // print_r($default);exit;?>
    <?php  foreach ($addresslist as $address) { ?>
    <?php }?>


<?php if(sizeof($addresslist)>0){?>
    <h5>Delivery Address</h5>
<!-- <input type="hidden" value="<?php echo $addresslist[0]['id']; ?>"> -->
<div class="custom-dropdown">
    <div class="dropdown-toggle custom-select check_address_back" name="flexRadioDefault" id="dropdownToggle" onclick="
        var dropdownMenu = document.querySelector('.custom-dropdown .dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
        
    " ><?php if($default!=null){print_r($default[0]->name . ', ' . $default[0]->address . ', ' . $default[0]->landmark . ', ' . $default[0]->city . ', ' . $default[0]->state . ', PinCode: ' . $default[0]->pincode . ', Ph: ' . $default[0]->mobile);}
   
    else{?>
    <!-- Choose one of the delivery address -->
   <?php print_r($address['name'] . ', ' . $address['address'] . ', ' . $address['landmark'] . ', ' . $address['city'] . ', ' . $address['state'] . ', PinCode: ' . $address['pincode'] . ', Ph: ' . $address['mobile']);?>
      <?php  }?>
    <!-- <?php print_r($addresslist[0]['name'] . ', ' . $addresslist[0]['address'] . ', ' . $addresslist[0]['landmark'] . ', ' . $addresslist[0]['city'] . ', ' . $addresslist[0]['state'] . ', PinCode: ' . $addresslist[0]['pincode'] . ', Ph: ' . $addresslist[0]['mobile']);?>
    <span class="badge badge-pill"><span class="colortype"><?php echo $addresslist[0]['address_type']; ?></span></span> -->
</div>
    <div class="dropdown-menu">
        <?php foreach ($addresslist as $address) { ?>
            <?php 
            $optionText = $address['name'] . ', ' . $address['address'] . ', ' . $address['landmark'] . ', ' . $address['city'] . ', ' . $address['state'] . ', PinCode: ' . $address['pincode'] . ', Ph: ' . $address['mobile'];
            
            // Truncate the option text if it's too long
            if (strlen($optionText) > 100) {
                $optionText = substr($optionText, 0, 78) . '...';
            }
            ?>
            <div class="dropdown-item pin" onclick="
                var dropdownToggle = document.getElementById('dropdownToggle');
                var hiddenInput = document.querySelector('.custom-dropdown input[type=\'hidden\']');

                dropdownToggle.innerHTML = '<?php echo $optionText; ?> ';

                // Create a new span element for the badge
                var badgeSpan = document.createElement('span');
                badgeSpan.className = 'badge badge-pill';

                // Create a nested span element for the address type
                var colortypeSpan = document.createElement('span');
                colortypeSpan.className = 'colortype';
                colortypeSpan.textContent = '<?php echo $address['address_type']; ?>';

                // Append the nested span to the badge span
                badgeSpan.appendChild(colortypeSpan);

                // Append the badge span to the dropdownToggle
                dropdownToggle.appendChild(badgeSpan);

                dropdownToggle.setAttribute('data-selected-id', '<?php echo $address['id']; ?>');
                hiddenInput.value = '<?php echo $address['id']; ?>';

                var dropdownMenu = document.querySelector('.custom-dropdown .dropdown-menu');
                dropdownMenu.style.display = 'none';

                getDeliveryAddressID('<?php echo $address['id']; ?>');
                ">
                <input type="hidden" value="<?php echo $address['id']; ?>">
                <?php echo $optionText; ?>
                <span class="badge badge-pill"><span class="colortype"><?php echo $address['address_type']; ?></span></span>
            </div>
        <?php } ?>
    </div>
</div><?php } else{?>
<button class="checkout_btn text-white" type="button" data-toggle="modal" data-target="#addnewaddress">Add Address</button>
<div class="modal fade" id="addnewaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-body">

            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>

                    
                    
                    
                    <div class="row newaddressbox" id="addnewaddress">
                        <form class="form-horizontal row" enctype="multipart/form-data"  >
                            <div class="col-lg-12 col-md-12">
                                <h4>Add Address</h4>

                                <div class="form-group">

                                    <input type="text" class="styling name onlyCharacter" minlength="3" maxlength="20" id="name" placeholder="Name">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">

                                    <input type="text" class="styling mobile" id="mobile" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">

                                    <input type="text" class="styling" id="address" placeholder="Address (Building number, street etc)" style="height:96px;padding:0px 0px 60px 5px;">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <select class="styling" id="state" onchange="getCities(this.value)">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $state) { ?>
                                            <option value="<?php echo $state->id; ?>"><?php echo $state->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <!-- <select class="form-control downarrow cities" id="cities" onchange="getPincodes(this.value)">
                                        <option value="">Select City</option>
                                    </select> -->
                                    <input class="styling" type="text" name="cities" id="cities" placeholder="Enter City">

                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <!-- <select class="form-control downarrow pincode" id="pincode">
                                    </select> -->
                                    <input class="styling" type="text" name="pincode" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="pincode" placeholder="Pincode">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <input type="text" class="styling" id="landmark" placeholder="Location / Landmark">

                                </div>

                            </div>

                            
                                <!-- <h4>Type of Address</h4> -->

                            

                            <div class="col-lg-12 check_rad">

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" checked="" name="inlineRadioOptions" id="inlineRadio1" value="1">

                                    <label class="form-check-label" for="inlineRadio1">Home</label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2">

                                    <label class="form-check-label" for="inlineRadio2">Office</label>

                                </div>
                                <?php
                                  $qry = $this->db->query("select * from user_address where user_id='" . $user_id . "'");

                                  $address_list = $qry->result();
// Extracting the 'address_type' column from the $addresslist array
$address_types = array_column($address_list, 'address_type');

// Checking if 'default address' is present in the $address_types array
if (!in_array('3', $address_types)):
?>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
        <label class="form-check-label" for="inlineRadio3">Default Address</label>
    </div>
<?php endif; ?>



                            </div>

                            <div class="col-lg-12"  style="padding-left:40px;">

                                <button type="button" class="btn btn-address"  onclick="validateAddressForm1()">Continue</button>

                            </div>
                        </form>
                    </div>

                   
                   
        </div>
    </div>
</div>
</div>
    <?php }?>
<!-- <div id="avail"></div> -->
</div>
<br>
<?php

$this->db->where('name', 'Prime');
$query = $this->db->get('features');
$feature = $query->row();


$show_prime = !empty($feature) && $feature->status == 1;
?>
<?php if ($show_prime): ?>
<div class="modal fade" id="PrimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 10001;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prime Plans</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="prime_member" onsubmit="return memberform()" action="<?php echo base_url(); ?>web/CreateMember/<?php echo $user_id; ?>/<?php echo $session_id;?>">
                    <div class="row">
                        <?php foreach($prime as $p){ ?>
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="card-title"> <?php if($p->image != '') { ?>
                                        <div class="coup_image col-12 justify-center">
                                            <img src="<?php echo base_url(); ?>uploads/prime/<?php echo $p->image;?>" class="centered-image" />
                                        </div>
                                        <?php } else{ echo $p->Name; }?></h6>
                                        <p class="card-text"><?php echo $p->Description;?></p>
                                        <div class="form-check">
                                            <input class="form-check-input buttonradio2" type="radio" name="options" id="option_<?php echo $p->value;?>" value="<?php echo $p->value;?>" >
                                            <label class="form-check-label" for="option_<?php echo $p->value;?>"><?php echo $p->Name;?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-block prime_btn">Become a member</button>
                </form>
            </div>
        </div>
    </div>


</div>



<?php endif; ?>
            <div class=" mycategorybox" style="display: none;">
            
            
   
                        
                        <?php
                        $session_id = $_SESSION['session_data']['session_id'];

                        $user_id = $_SESSION['userdata']['user_id'];                    
                        $vara=0;

                        $unitprice = 0;
                        $gst = 0;
                        $shop_ids = [];
                        $totalPriceDiscount = 0;

                        $totalprice=0;
                        $initialprice=0;
                        // $cart_id=0;
                       
                        // echo "<pre>";
                        // print_r($result);
                        // exit;

                         $cartdata=$this->session->userdata('cart_data');
                        //  print_r($cartdata);
 ?>
 <?php

$this->db->where('name', 'Prime');
$query = $this->db->get('features');
$feature = $query->row();


$show_prime = !empty($feature) && $feature->status == 1;
?>

<?php if ($show_prime): ?>

<?php if(isset($cartdata)) { ?>
    <div class="card" style="margin-bottom:20px;padding:10px;">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-5 col-xs-2 col-sm-3 position-relative">
                <img src="<?php echo base_url(); ?>web_assets/img/logo.png" class="img-responsive logo_image_cart prime_cart" style="vertical-align:middle;align-items:center;margin-top:10px;object-fit:contain;">
            </div>
            <div class="col-lg-10 col-md-10 col-7 col-xs-10 col-sm-9 details_cartpage">
               <a href="<?php echo base_url();?>web/deletePrimeItem" class="remove-prime"><i class="fas fa-times"></i></a>
                <div class="details_gap"> 
                    <span class="prod_name">Prime Membership</span>
               
                <div class="pro-price"> 
                    <span><i class="fal fa-rupee-sign"></i><?php echo $cartdata['price']; ?></span>
                    
                </div> 
                <div>
                <a href="#" id="prime" data-toggle="modal" data-target="#primeModal" style="color:#2556B9;text-decoration:underline;">Change plan</a>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php endif; ?>
<?php // exit;
                       
                      
                        // exit;
                        if (!is_null($result) && is_array($result)) {
                        if (sizeof($result) > 0) {

                            foreach ($result as  $value) {

                               
                                $unitprice = $value->unit_price + $unitprice;
                                $gst = $class_percentage + $gst;
                                // print_r($value->jsondata);
                                // $initialprice += ($value->price * $value->quantity);
                                // $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
                                // $link = $var1->row();
                               
                                
                            //    $initialprice+=($value->price * $value->quantity);
                                // $totalprice+=$value->price;

                                $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");
                                $product = $pro->row();

                                $shop = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");
                                $shopid = $shop->row()->id;
                                array_push($shop_ids, $shopid);

                                if ($product->image != '') {
                                    $img = base_url() . "uploads/products/" . $product->image;
                                } else {
                                    $img = base_url() . "uploads/noproduct.png";
                                }
                                $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
                                $link = $var1->row();
                                // print_r($link);


                                $jsondata_row = $link->jsondata;
                                $jsonrow = json_decode($jsondata_row);
                                // echo "<pre>";
                                // print_r($jsonrow);
                                // foreach($jsonrow as $json){
                                //     $type_row = $this->db->query("select * from attributes_title where id='" . $json->attribute_type . "'");
                                //     $type_get = $type_row->row();
                                //     $val_row = $this->db->query("select * from attributes_values where id='" . $json->attribute_value . "'");
                                //     $value_get = $val_row->row();
                                //     $values['type']=$type_get;
                                //     $values['value']=$value_get;
                                // }
                                // print_r($values);

                                $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "'");
                                $product1 = $pro1->row();

                                $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                                if ($wish->num_rows() > 0) {

                                    $stat = true;
                                } else {

                                    $stat = false;
                                }



                                $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");

                                if ($adm_qry->num_rows() > 0) {
                                    $adm_comm = $adm_qry->row();
                                    // $p_gst = $adm_comm->gst;
                                    $p_gst = '0';
                                } else {
                                    $p_gst = '0';
                                }

                                $class_percentage = ($value->unit_price / 100) * $p_gst;

                              
                              
                                
                                    
                               
 ?>


                                <div class="cartproductrow">
                                    <div class="row">
                                    
                                        <div class="col-lg-2 col-md-2 col-4 col-xs-2 col-sm-3 position-relative image_cartpage">
                                            <a href="<?php echo base_url(); ?>product/<?php echo url_title($product1->id, '-', TRUE); ?>/<?php echo url_title($product1->name, '-', TRUE); ?>/<?php echo url_title(substr($product1->descp, 0, 20), '-', TRUE); ?>/<?php echo url_title($product1->meta_tag_keywords, '-', TRUE); ?>" ><img src="<?php echo $img; ?>" alt="" class="img-responsive img-thumbnail pro_img"></a>
     
                                        </div>
                                        
                                        <div class="col-lg-10 col-md-10 col-8 col-xs-10 col-sm-9 details_cartpage">
                                        <span class="text-center"><a onclick="deletecartitems(<?php echo $value->id; ?>)" class="remove-item"><i class="fas fa-times"></i></a></span>
                                           <div class="details_gap"> <span class="prod_name"><a href="<?php echo base_url(); ?>product/<?php echo url_title($product1->id, '-', TRUE); ?>/<?php echo url_title($product1->name, '-', TRUE); ?>/<?php echo url_title(substr($product1->descp, 0, 20), '-', TRUE); ?>/<?php echo url_title($product1->meta_tag_keywords, '-', TRUE); ?>" ><?php echo $product1->name; ?></a></span>
                                           <?php
                                              // Convert $all_brand_names to an array if it's not already an array    
                                            $all_brand_names_array = is_array($value->brand_name) ? $value->brand_name : [$value->brand_name];
                                            ?>
                                            <span  value="<?php echo implode(",", $all_brand_names_array); ?>">
                                           <?php echo $value->brand_name; ?></span>
                                           <div style="display:flex;">
                                            <?php 
                                            echo '<div class="product" style="display:none;">';
                                            echo '<span class="brand_id">' . $value->brand_name . '</span>';
                                            echo '<span class="price_id">' . $value->price . '</span>';
                                            echo '</div>';
                                            
                                       
                                           
                                            
                                           $num_rows = sizeof($value->number);

                                           echo '<span>';
                                           if($num_rows>1){
                                           echo '<select class="attributeDropdown" onchange="attributeDropdown(this)">';?>
                                           <!-- <option selected disabled>select values</option> -->
                                          <?php foreach ($value->number as $r) {
                                               $c++;
                                               $jsonatt = json_decode($r->jsondata);
                                       
                                               if (is_array($jsonatt) && !empty($jsonatt)) {
                                                   foreach ($jsonatt as $attribute) {
                                                       $attribute_type = $attribute->attribute_type;
                                                       $attribute_value = $attribute->attribute_value;
                                                       $title_query = $this->db->query("SELECT * FROM attributes_title WHERE id = ?", array($attribute_type));
                                                       $value_query = $this->db->query("SELECT value FROM attributes_values WHERE id = ?", array($attribute_value));
                                       
                                                       if ($title_query && $value_query) {
                                                           $title_res = $title_query->row();
                                                           $value_res = $value_query->row();
                                                          
                                                           $option_price = $r->price;
                                                           $option_sale_price = $r->saleprice;
                                                           $variant_id = $r->id;
                                                           $product_id = $r->product_id;
                                                           $selected= ($variant_id==$value->variant_id)?'selected':'';
                                                          
                                                          echo '<option data-id="'.$value->id.'"
                                                            data-sessionid="'.$value->session_id.'"
                                                             data-userId="'.$value->user_id.'"
                                                              data-vendorid="'.$value->vendor_id.'"
                                                               data-status="'.$value->status.'"
                                                                data-cart_status="'.$value->cart_status.'" 
                                                                data-check_out="'.$value->check_out.'"
                                                                data-quantity="'.$value->quantity.'"
                                                                data-variantId="'.$value->variant_id.'"

                                                           data-is_checkout="'.$value->is_checkout.'"
                                                            data-productId="' . $product_id . '" 
                                                            value="' . $variant_id . '" 
                                                            data-price="' . $option_price . '"
                                                             data-saleprice="' . $option_sale_price . '" '.$selected.'>';
                                                           echo ucfirst($title_res->title) . ': ' . ucfirst($value_res->value);
                                                           echo '</option>';
                                                       }
                                                   }
                                               }
                                           }
                                           echo '</select>';
                                        }
                                           echo '</span>';

                                            
                                            ?>
                                           
                                            
                                           <span class="bg-grey">

    <span>Qty.</span>
    <select name="quantity"  onchange="attributeQuantity(this)" class="cart_quant">
    <?php $cart_limit = $this->db->where('id', $value->product_id)->get('products')->row()->cart_limit;
    ?>
<?php $stock=$link->stock;
  if($stock<$cart_limit){
    $limit=$stock;
}
else{
    $limit = $cart_limit <= 10  || $cart_limit <= $stock? $cart_limit :10;
}
// $limit= $stock < 10 ? $stock : 10; 
?>
        <?php for ($i = 1; $i <= $limit; $i++): ?>
            <option value="<?php echo $i; ?>" <?php if ($i == $value->quantity) echo 'selected'; ?>
			
			data-value="<?php echo $i;?>" data-cartid="<?php echo $value->id;?>"
			  data-sessionid="<?php echo $value->session_id ;?>"
                                                             data-userId="<?php echo $value->user_id;?>"
                                                              data-vendorid="<?php echo $value->vendor_id;?>"
                                                               data-status="<?php echo $value->status;?>"
                                                                data-cart_status="<?php echo $value->cart_status;?>" 
                                                                data-check_out="<?php echo $value->check_out;?>"
                                                                data-quantity="<?php echo $i;?>"
                                                                data-variantId="<?php echo $value->variant_id;?>"

                                                           data-is_checkout="<?php echo  $value->is_checkout;?>"
                                                           
                                                           
                                                            data-price="<?php echo $value->price;?>"
                                                            ><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>

</span></span></div>                                         
<?php 
$price_discount=$link->price - $value->price;
 $totalPriceDiscount +=$price_discount;

 $discountpercent=  round(($price_discount) * 100 / $link->price); ?>
                                                   <div class="pro-price"> <span  value="<?php echo $value->price;?>"><i class="fal fa-rupee-sign"></i><?php echo $value->price; ?></span>
                                                   <?php if($value->price != $link->price){?><span><del><i class="fal fa-rupee-sign"></i>  <?php echo $link->price; ?></del></span>
                                                    <span class="discount-text"><?php echo $discountpercent; ?> % OFF</span><?php } ?></div>

                                                    <div> 
                                                        <a title="Add to Wishlist"><i id="favoritecls_<?php echo $value->variant_id; ?>"></i>
                                                            <?php if ($stat == false) { ?>
                                                                <button type="button" onclick="addremoveTOpDealsFavorite(<?php echo $value->variant_id; ?>,<?= $key ?>)" id="wish_list_btn_<?= $key ?>" class="checkout_btn1 text-white">Move to Wishlist</button>
                                                            <?php } ?>
                                                        </a>
                                                    </div>
                                                
                                                           
                                        </div>
                                        
                                                            </div> </div>
                                </div>
                                <?php
                            }
                            
                            // exit;
                            $unique_shop_ids = array_unique($shop_ids);
                            $shipping_charge = array_sum(array_column($this->common_model->get_data_where_in('id', $unique_shop_ids, 'vendor_shop'), 'min_order_amount'));
                           $user_qry=$this->db->query("select * from users where id='".$user_id."'");
                            $user_qry_res=$user_qry->row();
                           //  print_r($user_qry_res);
                           $date=date("Y-m-d");
                            if((($user_qry_res->membership =='yes' && $user_qry_res->plan != '' && $user_qry_res->plan!='0' && $user_qry_res->plan!=0 && $user_qry_res->plan!=null && $user_qry_res->expiry_member_date >= $date && $user_qry_res->created_member_date <= $date )|| isset($cartdata) )){
                                $shipping_charge=0;
                            }
                            else{
                                $shipping_charge=$shipping_charge;
                            }
                                        if(isset($cartdata)) {
                                            $membership = floatval($cartdata['price']); // Convert to a number
                                            // $unitprice = $unitprice + $membership;
                                           
                                        } else {
                                            $membership = 0; // Set default value if not set
                                          
                                           
                                        }
                                      
                                        if(isset($cartdata)) {     
                                             $grand_t = $shipping_charge + $unitprice + $gst + $membership;
                                        }
                                        else{
                                            $grand_t = $shipping_charge + $unitprice + $gst;
                                        }
                            ?>
                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>">Continue Shopping</a>
                                </div>
                            </div> -->
                        <?php } }?>
                        <div class="table_desc" style="display:none">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <!-- <th class="product_remove">Delete</th> -->
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                            <th class="product_total">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="product_thumb">
                                                <a href="<?php echo base_url(); ?>product/<?php echo url_title($product1->id, '-', TRUE); ?>/<?php echo url_title($product1->name, '-', TRUE); ?>/<?php echo url_title(substr($product1->descp, 0, 20), '-', TRUE); ?>/<?php echo url_title($product1->meta_tag_keywords, '-', TRUE); ?>" ><img src="<?php echo $img; ?>" alt=""></a>
                                                <!-- <a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><img src="<?php echo $img; ?>" alt=""></a> -->
                                            
                                            </td>
                                            <td class="product_name"><a href="<?php echo base_url(); ?>product/<?php echo url_title($product1->id, '-', TRUE); ?>/<?php echo url_title($product1->name, '-', TRUE); ?>/<?php echo url_title(substr($product1->descp, 0, 20), '-', TRUE); ?>/<?php echo url_title($product1->meta_tag_keywords, '-', TRUE); ?>" ><?php echo $product1->name; ?></a><br>

                                                <?php /* <p class="mb-0"><a href="<?php echo base_url(); ?>web/store/<?php echo $shopdat->seo_url; ?>/shop"><b>Shop Name :</b> <?php echo $shopdat->shop_name; ?></a></p>

                                                  <p><b>Location:</b><?php echo $shopdat->city; ?></p> */ ?>
                                            </td>
                                            <td class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $value->price; ?></td>
                                    <form class="form-horizontal" enctype="multipart/form-data"  >
                                        <td class="product_quantity"><label></label>
                                            <a  onclick="decreaseQuantity(<?php echo $value->id; ?>)"><i class="fas fa-minus"></i></a>
                                            <input min="0" max="100" name="quantity" id="quantity<?php echo $value->id; ?>" value="<?php echo $value->quantity; ?>" type="text" readonly>
                                            <a onclick="increaseQuantity(<?php echo $value->id; ?>)"><i class="fas fa-plus"></i></a>
                                            <div id="quantityshow<?php echo $value->id; ?>"></div>
                                        </td>
                                        <td class="product_total"><i class="fal fa-rupee-sign"></i> <?php echo $value->unit_price; ?></td>
                                        <td>
                                            <a onclick="deletecartitems(<?php echo $value->id; ?>)" class="remove-item"><i class="fal fa-trash-alt"></i></a>
                                        </td>
                                    </form>
                                    </tr>

                                    <tr>
                                        <td colspan="6">
                                            <a class="btn pink-btn float-right" href="<?php echo base_url(); ?>">Continue Shopping</a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div></div>
                    <?php if (is_null($result) && is_null($cartdata)) {
                    ?><div class="col-lg-10 cartempty"><center><img src="<?php echo base_url();?>web_assets/img/cartempty.jpg"/></center></div>
                        <center>
                            <div class="cart_page" style=" display: flex;
            justify-content: center;
            align-items: center; margin: 0;
            padding: 0;">
                                
                                    <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>">START SHOPPING!</a>
                                
                            </div><br><br><br><br><br><br><br><br><br><br><br>
                        </center> 
                    <?php } ?>
                

           
        
        
        
        
            <?php if ((is_array($result) && sizeof($result) > 0 && !is_null($result)) || isset($cartdata))  {
            ?>
                        <div class="col-lg-4 box" style="display: none;">
                            <h4 style="font-weight: 900;padding-left:10px;">Order Summary</h4>

                            <?php
$this->db->where('name', 'Coupons');
$query = $this->db->get('features');
$feature = $query->row();
$show_coupons = !empty($feature) && $feature->status == 1;
?>






                            <div class="coupon_code left">
                              
                                <div class="coupon_inner">
                                 
                                    <div id="coupon_msg"></div>
                                    <?php if($show_coupons): ?>
                                    <form class="form-horizontal d-flex pl-2" enctype="multipart/form-data"  >
                                        <input placeholder="Coupon Code" class="couponcode" type="text" autocomplete="off" >
                                        <button type="button" class="apply" onclick="validatecouponcode()">Apply</button>
                                        
                                        <button type="button" class="remove"  onclick="remove()" style="display:none">Remove</button>
                                    </form>
                                  
                                </div>

                                <?php if (count($coupons) > 0 && (!is_null($result) && is_array($result))) { ?>
                                    <div class="row justify-content-center" id="show_button">
                                        <div class="">
                                            <a   onclick="showhide()" style="color: #2556B9;float:right;text-align:right;text-decoration:underline;">View Coupon</a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php endif; ?>  
<div class="couponlist-box modal" id="viewcoup">
<div class="modal-dialog">

<div class="modal-content">

    <div class="modal-body">
    <div class="without-scroll">
    <button type="button" class="btn-close" onclick="closeModalBox()" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
    <h4>Apply Coupon</h4>
    <?php if ((is_array($result) && sizeof($result) > 0) || isset($cartdata)) {?>
    <div class="coupon_inner">
                                   
                                    <div id="coupon_msg"></div>

                                    <form class="form-horizontal d-flex pl-2" enctype="multipart/form-data"  >
                                        <input placeholder="Coupon Code" class="couponcode" type="text"  autocomplete="off">
                                        <button type="button" class="apply" onclick="validatecouponcode()">Apply</button>
                                        
                                        <button type="button" class="remove" onclick="remove()" style="display:none">Remove</button>
                                    </form>
                                    <!-- <a data-toggle="modal"  onclick="showhide()" data-target="#viewcoup" style="color: #2556B9;;text-align:right;text-decoration:underline;padding-right:55px;">View Coupon</a> -->
    </div></div>
<?php }?>
   
<div class="scroll-coupon">
<?php 
// Define a function to compare coupons based on their maximum_amount
function compareCoupons($a, $b) {
    if ($a['maximum_amount'] == $b['maximum_amount']) {
        return 0;
    }
    return ($a['maximum_amount'] > $b['maximum_amount']) ? -1 : 1;
}

// Sort the $coupons array using the defined function
usort($coupons, 'compareCoupons');?>
<?php foreach ($coupons as $coup) { ?>
    <div class="row">
        <div style="display:flex;gap:1.2rem;">
            <div>
                <form class="form-horizontal">
                    <!-- Use a unique identifier for each checkbox -->
                    <!-- <input type="checkbox" name="mycheck" class="coupon-checkbox" id="myInput<?php echo $coup['id']; ?>"
                        value="<?php echo $coup['coupon_code']; ?>"
                        onchange="(this.checked) ? applyCouponcode('<?php echo $coup['coupon_code']; ?>') : remove('<?php echo $coup['coupon_code']; ?>')"> -->

                        <input type="checkbox" name="mycheck" class="coupon-checkbox" id="myInput<?php echo $coup['id']; ?>" 
       value="<?php echo $coup['coupon_code']; ?>"
       onchange="(this.checked) ? $('.couponcode').val('<?php echo $coup['coupon_code']; ?>') : $('.couponcode').val(''); this.enabled = this.checked;" style="text-align:center;justify-content: center;align-items: center;margin-top:10px;cursor: pointer;"> 

                        <!-- <h6><input type="text" style="width: 100px; border: none; background: none; cursor: pointer" value="<?php echo $coup['coupon_code']; ?>" id="myInput<?php echo $coup['id']; ?>" onclick="applyCouponcode('<?php echo $coup['coupon_code']; ?>')" title="Apply this coupon" class="coupontoggle" readonly=""></h6> -->
            </div>
            <div>
                <h6><input type="text" class="myinput" value="<?php echo $coup['coupon_code']; ?>" id="myInput<?php echo $coup['id']; ?>" readonly=""></h6>
                </form>
            </div>
        </div>
        <?php if($coup['image'] != '') { ?>
        <div class="coup_image col-12 justify-center">
            <img src="<?php echo base_url(); ?>uploads/coupons/<?php echo $coup['image'];?>" class="centered-image" />
        </div>
        <?php } ?>
        <h5><?php echo $coup['percentage']; ?>% OFF</h5>
        <p><strong><?php echo $coup['description']; ?></strong></p>
        <p><strong>save upto Rs.<?php echo $coup['maximum_amount'];?>/- on orders above 
        Rs.</i><?php echo $coup['minimum_order_amount'];?> using this coupon</strong</p>
    </div>
<?php } ?>


<script>
    // JavaScript code to handle checkbox interactions
    // const checkboxes = document.querySelectorAll('.coupon-checkbox');
    // checkboxes.forEach(checkbox => {
    //     checkbox.addEventListener('change', () => {
    //         if (checkbox.checked) {
    //             checkboxes.forEach(otherCheckbox => {
    //                 if (otherCheckbox !== checkbox) {
    //                     otherCheckbox.checked = false;
                       
    //                 }
    //             });
    //         }
    //     });
    // });
//     

</script>

                                <div class="coupon_inner">
                                <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer;float:left;" title="Remove Coupon"></p>
                                <button type="button" class="apply1" onclick="validatecouponcode()">Apply</button>
                                </div> </div>

                            </div>
                                </div>
                                </div>
                                </div>

                                </div>
                            <div class="coupon_code right" style="display: block;">
                                <!-- <h3 class="pb-2"><i class="fal fa-shopping-bag"></i> Cart Totals</h3> -->
                                <div class="coupon_inner">

                                    <div class="cart_subtotal">

                                        <p>Subtotal</p>
                                        <p class="cart_amount" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i> <?php echo number_format($unitprice, 2); ?></p>
                                        <input type="hidden" id="sub_total" value="<?php echo $unitprice; ?>" style="font-weight:bold;">
                                    </div>
                                 <?php   $user_qry=$this->db->query("select * from users where id='".$user_id."'");
                            $user_qry_res=$user_qry->row();
                           //  print_r($user_qry_res);
                           $date=date("Y-m-d");
                            if((($user_qry_res->membership =='yes' && $user_qry_res->plan != ''  && $user_qry_res->plan!=0 &&  $user_qry_res->plan!='0' && $user_qry_res->plan!=null &&  $user_qry_res->expiry_member_date >= $date && $user_qry_res->created_member_date <= $date)|| isset($cartdata))){
                                $shipping_charge=0;
                            }
                            else{
                                $shipping_charge=$shipping_charge;
                            }?>
                                    <div class="cart_subtotal ">
                                        <p>Shipping Charges</p>
                                        <p class="cart_amount" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i>  <?php echo number_format($shipping_charge, 2); ?></p>
                                        <input type="hidden" id="min_order_amount" value="<?php echo $shipping_charge; ?>" style="font-weight:bold;">
                                    </div>
                                    <div class="cart_subtotal">
                                        <p>GST</p>
                                        <!-- <p class="cart_amount" id="gst" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i> <?= number_format($gst, 2) ?></p> -->
                                        <p class="cart_amount" id="gst" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i> 0</p>
                                    </div>

                                    <?php
$this->db->where('name', 'Coupons');
$query = $this->db->get('features');
$feature = $query->row();


$show_coupons = !empty($feature) && $feature->status == 1;
?>

<?php if($show_coupons): ?>

                                    <div class="cart_subtotal">
                                        <p>Coupon Discount</p>
                                        <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer" title="Remove Coupon" onclick="remove()"></p>
                                        <p class="cart_amount" id="discount" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i> 0</p>
                                    </div>
                                    <?php endif; ?>   
                                    <div class="cart_subtotal">
                                        <p>Discount</p>
                                        <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer"></p>
                                        <p class="cart_amount1" id="discount1" style="font-weight:bold;"><i class="fal fa-rupee-sign" style="font-size:12px;"></i><?php echo $totalPriceDiscount;?></p>
                                    </div>
                                    <?php $cartdata=$this->session->userdata('cart_data');?>
                                    <?php if(isset($cartdata)){?>
                                    <div class="cart_subtotal" id="member">
                                    <p>Membership</p>
                                  
                                    <?php $membership = floatval($cartdata['price']);?>
                                    <p class="cart_amount" style="font-weight:bold;" ><i class="fal fa-rupee-sign"></i> <input type="hidden" id="membership"  value="<?php echo floatval($cartdata['price']); ?>" ><?php echo floatval($cartdata['price']);?></p>
                                    </div><?php }?>
                                    <div class="cart_subtotal" id="total_default">
                                        <p>Total</p>
                                        <p class="cart_amount" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i> <input type="hidden" id="cart_total" value="<?php echo $grand_t; ?>" > <?php echo number_format($grand_t, 2); ?></p>
                                    </div>
                                   
                                    <div class="cart_subtotal" id="total_default_show" style="display: none;">
                                        <p>Total</p>
                                        <p class="cart_amount" id="total_p" style="font-weight:bold;"><?php echo number_format($grand_t,2); ?></p>
                                    </div>
                                    <hr>
                                    <!-- <form name="checkout" id="checkall-product" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>web/goaddress_page">
                                        <input type="hidden" name="coupon_id" id="coupon_id" value="0">
                                        <input type="hidden" name="applied_coupon_code" id="applied_coupon_code" value="0">
                                        <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
                                        <input type="hidden" name="gst" value="<?php echo $gst; ?>">
                                        <div class="checkout_btn">
                                         <button type="button" onclick="checkcartitem()">Proceed to Checkout</button>
                                        </div>
                                    </form> -->
                                    <?php 
                                    // echo "<pre>";
                                    // print_r($coupon_code);
                                    $total=($grand_t - $coupon_discount);
                                    // print_r($coupon_discount);?>
                                  <?php if (!is_null($result) && is_array($result)){?>
                                    <div class="text-center">
                                <form method="post" id="checkout-form" class="form-horizontal" onclick="return chk_address_place_order()">
                                <input type="hidden" name="aid" id="selected_address" value="<?php echo $address['id']; ?>">
                                   
                                    <input type="hidden" name="gst" value="0">
                               <?php     $user_qry=$this->db->query("select * from users where id='".$user_id."'");
                            $user_qry_res=$user_qry->row();
                           //  print_r($user_qry_res);
                           $date=date("Y-m-d");
                            if((($user_qry_res->membership =='yes' && $user_qry_res->plan != '' &&  $user_qry_res->plan!=0 && $user_qry_res->plan!=null && $user_qry_res->plan!='0' && $user_qry_res->expiry_member_date >= $date && $user_qry_res->created_member_date <= $date) || isset($cartdata))){
                                $shipping_charge=0;
                            }
                            else{
                                $shipping_charge=$shipping_charge;
                            }?>

                                    <input type="hidden" name="shipping_charge" id="shipping_charge" value="<?php echo $shipping_charge; ?>">
                                    <input type="hidden" name="coupon_id" id="coupon_id" value="<?php echo $coupon_id;?>">
                                        <input type="hidden" name="coupon_code" id="applied_coupon_code" value="<?php echo $coupon_code; ?>">
                                        <input type="hidden" name="coupon_discount" id="coupon_discount" value="<?php echo $coupon_discount; ?>">
                                        <input type="hidden" name="total_price" id="order_total_payment">
                                        <?php $cartdata=$this->session->userdata('cart_data');?>
                                        <?php if(isset($cartdata)){?>
                                        <input type="hidden" name="membership" id="membership_payment" value="<?php echo floatval($cartdata['price']);?>">
                                        <?php }?>
                                    <button type="button" id="payment_modal" class="btn btn-address">Proceed to Payment</button>
                                </form>
                            </div><?php }else if(isset($cartdata)){?>
                                <form method="post" class="form-horizontal" action="<?= base_url();?>web/renewal" enctype="multipart/form-data">
                                    <input type="hidden" value="<?php print_r($cartdata['price']);?>" name="renewal" id="renewal">
                                    <input type="hidden" value="<?php echo $user_qry_res->phone;?>" name="cust_phone" id="cust_phone">
                               <button type="submit" class="btn btn-address"> Proceed to Payment </button>
                                </form>
                                <?php }?>
                            <!-- <div class="text-center">
                                <form method="post" id="checkout-form" class="form-horizontal" onclick="return chk_address_place_order1()">
                                <input type="hidden" name="aid" id="selected_address" value="<?php echo $address['id']; ?>">
                                   
                                    <input type="hidden" name="gst" value="0">
                                    <input type="hidden" name="shipping_charge" id="shipping_charge" value="<?php echo $shipping_charge; ?>">
                                    <input type="hidden" name="coupon_id" id="coupon_id" value="<?php echo $coupon_id;?>">
                                        <input type="hidden" name="coupon_code" id="applied_coupon_code" value="<?php echo $coupon_code; ?>">
                                        <input type="hidden" name="coupon_discount" id="coupon_discount" value="<?php echo $coupon_discount; ?>">
                                        <input type="hidden" name="total_price" id="order_total_payment">
                                    <button type="button" id="payment_modal" class="btn btn-address">simulate Payment</button>
                                </form>
                            </div> -->

                                                                                   <!-- <p class="bid-text"><a data-toggle="modal" onclick="doBidProducts()">BID ABOVE PRODUCTS </a> <a href="#bidModal" data-toggle="modal" class="text-dark"><i class="fal fa-comment-exclamation"></i></a></p> -->

                                </div>
                            </div>
                        </div>
                    <?php }?>
        </div>



    </div>
</div>
                               

<div id="stock-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Stock Alert</h5>
        
      </div>
      <div class="modal-body" id="stock-list">
        
        
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-close" onclick="closeModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div></section>



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-sm" id="chkout" style="position: relative;left: 30%;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Place Order</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <?php if ($payment_mode->payment_mode == 'BOTH') { ?>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="ONLINE" onclick="selectPayment('ONLINE')">
                                <label class="form-check-label" for="inlineRadio2">ONLINE</label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="COD" onclick="selectPayment('COD')">
                                <label class="form-check-label" for="inlineRadio3">COD</label>
                            </div>
                        <?php } else if ($payment_mode->payment_mode == 'COD') { ?>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="COD" onclick="selectPayment('COD')">
                                <label class="form-check-label" for="inlineRadio3">COD</label>
                            </div>
                        <?php } else if ($payment_mode->payment_mode == 'ONLINE') { ?>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="ONLINE" onclick="selectPayment('ONLINE')">
                                <label class="form-check-label" for="inlineRadio2">ONLINE</label>
                            </div>
                        <?php } ?>
                        <div id="payment">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
                                        function showhide()
                                        {
                                            $("#viewcoup").show();
                                            $("#close_button").show();
                                            $("#show_button").show();
                                        }

                                        function closecoupon()
                                        {
                                            $("#viewcoup").hide();
                                            $("#close_button").hide();
                                            $("#show_button").show();
                                        }

                                        function checkcartitem(){
                                            var title="check";
                                            var status;
                                             $.ajax({
                                                    url: "<?php echo base_url(); ?>web/checkcartitem",
                                                    data: {title:title},
                                                    method: "POST",
                                                    success: function (data)
                                                    {
                                                        
                                                        if(data!=0){
                                                            status=0;
                                                            $("#stock-list").html(data);
                                                            $("#stock-modal").show();
                                                            
                                                        }
                                                        else{
                                                            status=1;
                                                            document.checkout.submit();
                                                        }
                                                        
                                                    }
                                                });
                                             // alert(status);
                                            // if(status==1 || status==""){
                                            //     // alert(status);
                                                
                                            // }
                                           
                                        }

    // Wait for the DOM to be ready
document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('.coupon-checkbox');

    // Clear all checkboxes by setting their checked property to false
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    // Add event listeners to handle checkbox behavior
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                       
                    }
                });
            }
        });
    });
});




                                        function closeModalBox(){
                                            $('#viewcoup').hide();
                                        }


                                        function closeModal(){
                                            $("#stock-modal").hide();
                                        }


function attributeQuantity(selectElement) {
    // Get the selected option
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var quantity = selectedOption.getAttribute('value');
    var price = selectedOption.getAttribute('data-price');
    var id = selectedOption.getAttribute('data-cartid');
    var session_id = selectedOption.getAttribute('data-sessionid');
    var user_id = selectedOption.getAttribute('data-userId');
    var vendor_id = selectedOption.getAttribute('data-vendorid');
    var status = selectedOption.getAttribute('data-status');
    var cartstatus = selectedOption.getAttribute('data-cart_status');
    var checkout = selectedOption.getAttribute('data-check_out');
    var ischeckout= selectedOption.getAttribute('data-is_checkout');
  
    
    // console.log(quantity);
   
    var variantId=selectedOption.getAttribute('data-variantId');
    // Create a data object to pass to the AJAX call
    var data = {
        id:id,
        variantId: variantId,
        session_id:session_id,
        user_id:user_id,
        vendor_id:vendor_id,
        status:status,
        cartstatus:cartstatus,
        checkout:checkout,
        ischeckout:ischeckout,
        quantity:quantity,
        price: price,
    };

    
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>web/changeQuantity", // Change this to the URL of your PHP script
         data: data,
         success: function(response) {
            //  window.location.href = "<?php echo base_url(); ?>web/checkout";
            var str = response;
            var res = str.split("@");
            if (res[1] == 'error')
            {
                toastr.error(res[2]);
                return false;
            } else if (res[1] == 'cart_limit')
            {
                // console.log(res[1]);
                toastr.error("You have exceeded the cart limit of "+res[2]+" for this product!");
            } else
            {
                window.location.replace("<?php echo base_url(); ?>web/checkout");

            }

        },
       error: function(xhr, status, error) {
             // Handle errors
             console.error(xhr.responseText);
         }
    });
}



                                        function increaseQuantity(id)
                                        {



                                            var quantity = $("#quantity" + id).val()-1;
                                            var qty = 1;
                                            var final = parseInt(qty) + parseInt(quantity);

                                            $.ajax({
                                                url: "<?php echo base_url(); ?>web/updateCart",
                                                method: "POST",
                                                data: {cartid: id, quantity: final},
                                                success: function (data)  
                                                {
                                                    var str = data;
                                                    var res = str.split("@");
                                                    if (res[1] == 'error')
                                                    {
                                                        toastr.error(res[2]);
                                                        $('#quantityshow' + id).html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">' + res[2] + '</span>');
                                                        $('#quantityshow').focus();
                                                        return false;
                                                    } else if (res[1] == 'cart_limit')
                                                    {
                                                        toastr.error("You have exceeded the cart limit of "+res[2]+" for this product!");
                                                    } else
                                                    {
                                                        $("#loadCartdiv").html(data);
                                                    }



                                                    //alert(JSON.stringify(data));
                                                    /*$('html, body').animate({
                                                     scrollTop: $('#scroll_id').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                                                     }, 'slow');
                                                     if(res[1]=='success')
                                                     {
                                                     
                                                     $("#quantity"+id).val(final);
                                                     
                                                     $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Quantity updated to cart</span>');
                                                     $('#display_msg').focus();
                                                     location.reload();
                                                     return false;
                                                     }
                                                     else
                                                     {
                                                     $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">'+res[2]+'</span>');
                                                     $('#display_msg').focus();
                                                     return false;
                                                     }*/
                                                }
                                            });

                                        }

                                        function decreaseQuantity(id)
                                        {

                                            var quantity = $("#quantity" + id).val();

                                            if (quantity <= 1)
                                            {
                                                $.ajax({
                                                    url: "<?php echo base_url(); ?>web/deleteCartItem",
                                                    method: "POST",
                                                    data: {cartid: id},
                                                    success: function (data)
                                                    {
                                                        var str = data;
                                                        var res = str.split("@");
                                                        $('html, body').animate({
                                                            scrollTop: $('#scroll_id').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                                                        }, 'slow');
                                                        if (res[1] == 'success')
                                                        {
                                                            toastr.success('Removed from cart successfully.');
                                                            setTimeout(function () {
                                                                location.reload();
                                                            }, 1000);
                                                        } else
                                                        {
                                                            swal("Something went wrong , please try again");
                                                        }
                                                    }
                                                });
                                            } else
                                            {
                                                var qty = 1;
                                                var final = parseInt(quantity) - parseInt(qty);

                                                $.ajax({
                                                    url: "<?php echo base_url(); ?>web/removeCart",
                                                    method: "POST",
                                                    data: {cartid: id, quantity: final},
                                                    success: function (data)
                                                    {
                                                        var str = data;
                                                        var res = str.split("@");
                                                        $("#loadCartdiv").html(data);
                                                        /* $('html, body').animate({
                                                         scrollTop: $('#scroll_id').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                                                         }, 'slow');
                                                         if(res[1]=='success')
                                                         {
                                                         
                                                         $("#quantity"+id).val(final);
                                                         
                                                         $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Quantity updated to cart</span>');
                                                         $('#display_msg').focus();
                                                         location.reload();
                                                         return false;
                                                         }
                                                         else
                                                         {
                                                         $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">'+res[2]+'</span>');
                                                         $('#display_msg').focus();
                                                         return false;
                                                         }*/
                                                    }
                                                });
                                            }
                                        }

                                        function getCoup(code) {
                                            /* Get the text field */
                                            var copyText = document.getElementById("myInput" + code);

                                            /* Select the text field */
                                            copyText.select();
                                            copyText.setSelectionRange(0, 99999); /* For mobile devices */

                                            /* Copy the text inside the text field */
                                            document.execCommand("copy");

                                            /* Alert the copied text */
                                            alert("Copied the text: " + copyText.value);
                                        }
</script>
<script type="text/javascript">
    function doBidProducts() {


        var coupon_discount = $("#coupon_discount").val();
        if (coupon_discount != 0)
        {
            swal('Please remove the coupon, if you want to add bidding');
        } else
        {
            var shop_id = "<?php echo $shop_id; ?>";
            var id = $(this).parents("tr").attr("id");

            swal({

                title: "Confirm!",

                text: "Are you sure you want to add the Bid ",

                type: "warning",

                showCancelButton: true,

                confirmButtonClass: "btn-danger",

                confirmButtonText: "Yes",

                cancelButtonText: "Cancel",

                closeOnConfirm: false,

                closeOnCancel: false

            },
                    function (isConfirm) {

                        if (isConfirm) {

                            $.ajax({
                                url: "<?php echo base_url(); ?>web/createUserBid",
                                method: "POST",
                                data: {vendor_id: shop_id},
                                success: function (data)
                                {
                                    var str = data;
                                    var res = str.split("@");
                                    if (res[1] == 'success')
                                    {
                                        swal('Bid Created Successfully');
                                        window.location.href = "<?php echo base_url(); ?>";
                                    } else if (res[1] == 'minimum')
                                    {
                                        swal("Bidding is applicable on minimum amount of 10,000");
                                    } else
                                    {
                                        swal("Something went wrong,Please try again");
                                    }

                                }
                            });


                        } else {

                            swal("Cancelled", "", "error");

                        }

                    });

        }

    }
//     $(document).ready(function() {
//   $('.coupontoggle').on('change', function() {
//     if ($(this).prop('checked')) {
//       // When the checkbox is checked, apply the 'allowed' cursor style to all elements with class 'coupontoggle'
//     //   $('.coupontoggle').css('cursor', 'allowed');
//     applyCouponcode(couponcode);
//     } else {
//       // When the checkbox is unchecked, remove the custom cursor style (let the default cursor apply)
//       remove();
//     }
//   });
// });
// <?php foreach ($coupons as $coup) { ?>
// $(document).ready(function() {
//     $('#mycheck').on('change', function() {
//   if ($('#mycheck').is(':not(:checked)')) {
//     remove();

//   }
//   else if($('#mycheck').prop('checked')){
//     applyCouponcode('<?php echo $coup['coupon_code']; ?>');
//   }
// });
// });
// <?php }?>



    function applyCouponcode(couponcode)
    {
        $('.error').remove();
        var errr = 0;
        var carttotal = $("#sub_total").val();
        var min_order_amount = $("#min_order_amount").val();
        var gst = '<?= $gst ?>';
        var total_amount = $("#cart_total").val();
        var products = []; // Array to hold products data

$('.product').each(function() {
    var brandName = $(this).find('.brand_id').text();
    var price = $(this).find('.price_id').text();
    products.push({ brand_name: brandName, price: price });
});

// console.log(products);
       
    

        // var checkbox = document.getElementById('myInput<?php echo $coup['id']; ?>');
        // console.log(checkbox);
      
        $.ajax({
            url: "<?php echo base_url(); ?>web/applycoupon",
            method: "POST",
            data: {couponcode: couponcode, carttotal: carttotal, total_amount: total_amount,products:products},
            success: function (data)
            {
                var str = data;
                var res = str.split("@");


                if (res[1] == 'success')
                {
                    console.log(res);
                    //$("#couponcode").val();
                    var msg = 'maximum saving: <br>'+'[' + res[6] + '% OFF]';
                    $('#couponName').show();
                    $('#couponName').html(msg);
                    $('#discount').html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + res[3]);
                    $(".couponcode").val(couponcode);
                   
                    var membership= $("#membership").val();
                    var cartdata=$('#cart_data').val();
                    console.log("cartdata",cartdata);
                    console.log("membership",membership);
                    if(cartdata!=''){
                    var total_p = parseFloat(min_order_amount) + parseFloat(res[2]) + parseFloat(gst) + parseFloat(membership);
                    }
                    else{
                        var total_p = parseFloat(min_order_amount) + parseFloat(res[2]) + parseFloat(gst) 
                    }
                    $('#total_p').html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + total_p);

                    $('#total_default').hide();
                    $('#total_default_show').show();

                    $('#coupon_id').val(res[4]);
                    $('#applied_coupon_code').val(res[5]);
                    $('#coupon_discount').val(res[3]);

                    // $('.coupontoggle').attr('onclick', '');
                    // $('.coupontoggle').css('cursor', 'not-allowed');
                    // $('.coupontoggle').css('cursor', 'allowed');

                    
                    // $('#myInput' + res[4]).val('Applied');
                    // $('#viewcoup').hide();
                   
                  
                    $('.couponcode').prop('disabled', true);
                    $('#viewcoup').hide();
                    $('.apply').hide();
                    $('.apply1').hide();
                    $('.remove').show();
                    toastr.success('Coupon Applied successfully.');

                    

//                    $('#coupon_msg').html('<div class="btn btn-success mb-4" >Coupon Applied successfully <span onclick="remove()" class="pr-2"><i class="fal fa-times"></i></span></div>');
//                    $('#coupon_msg').focus();
                    return false;
                } else if (res[1] == 'minorder') {
                    var min = 'Minimum Order Amount ' + res[2];
                    $('#couponName').hide();
                    toastr.error(min);
                    // $('#viewcoup').hide();
                    $('.couponcode').val('');
                    $('.coupon-checkbox').val('');
                    setTimeout(function () {
            location.reload();
        }, 1000);
//                    $('#coupon_msg').html('<div class="btn btn-danger mb-4" >Minimum Order Amount' + res[2] + '</div>');
//                    $('#coupon_msg').focus();
                    return false;
                } else
                {
                    $('.couponcode').val('');
                    $('#couponName').hide();
                    $('.coupon-checkbox').val('');
                    toastr.error('Invalid coupon code');
                    setTimeout(function () {
            location.reload();
        }, 1000);
//                    $('#coupon_msg').html('<div class="btn btn-danger mb-4" >Invalid Coupon</div>');
//                    $('#coupon_msg').focus();
                    return false;
                }
            }

            
        });
    }

   
   


    function validatecouponcode()
    {
        $('.error').remove();
        var errr = 0;
        var couponcode = $(".couponcode").val();
        var carttotal = $("#sub_total").val();

        var total_amount = $("#cart_total").val();
        var products = []; // Array to hold products data

$('.product').each(function() {
    var brandName = $(this).find('.brand_id').text();
    var price = $(this).find('.price_id').text();
    products.push({ brand_name: brandName, price: price });
});

// console.log(products);

        var min_order_amount = $("#min_order_amount").val();
        var gst = '<?= $gst ?>';
        var mycoupon=$('#mycoupon').val('');

        if (couponcode == ''&& mycoupon == '')
        {
            toastr.error('Enter coupon code');
//            $('#coupon_msg').html('<div class="btn btn-danger mb-4" >Enter Coupon code</div>');
//            $('#coupon_msg').focus();
            return false;
        } else
        {

            $.ajax({
                url: "<?php echo base_url(); ?>web/applycoupon",
                method: "POST",
                data: {couponcode: couponcode, carttotal: carttotal, total_amount: total_amount,products:products},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");

                    if (res[1] == 'success')
                    {
                        console.log(res);
                        var msg = 'maximum saving: <br>'+'[' + res[6] + '% OFF]';
                        $('#couponName').show();
                        $('#couponName').html(msg);
                        $('#discount').html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + res[3]);
                        var membership= $("#membership").val();
                        var cartdata=$('#cart_data').val();
                        // console.log("cartdata",cartdata);
                        // console.log("membership",membership);
                        if(cartdata!=''){
                        var total_p = parseFloat(min_order_amount) + parseFloat(res[2]) + parseFloat(gst) + parseFloat(membership);
                        }
                        else{
                            var total_p = parseFloat(min_order_amount) + parseFloat(res[2]) + parseFloat(gst) 
                        }


                        $('#total_p').html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + total_p);


                        $('#total_default').hide();
                        $('#total_default_show').show();

                        $('#coupon_id').val(res[4]);
                        $('#applied_coupon_code').val(res[5]);
                        $('#coupon_discount').val(res[3]);
                        $('.coupon-checkbox').prop('disabled',true);

                        toastr.success('Coupon Applied successfully.');
                        $('#viewcoup').hide();
                        $('.couponcode').prop('disabled', true);
                        $('.apply').hide();
                        $('.apply1').hide();
                        $('.remove').show();

//                        $('#coupon_msg').html('<div class="btn btn-success mb-4" >Coupon Applied successfully <span onclick="remove()" class="pr-2"><i class="fal fa-times"></i></span></div>');
//                        $('#coupon_msg').focus();
                        return false;
                    } else if (res[1] == 'minorder') {
                        var min = 'Minimum Order Amount ' + res[2];
                        toastr.error(min);
                        $('.couponcode').val('');
                        $('.coupon-checkbox').val('');
                         setTimeout(function () {
            location.reload();
        }, 1000);
//                        $('#coupon_msg').html('<div class="btn btn-danger mb-4" >Minimum Order Amount' + res[2] + '</div>');
//                        $('#coupon_msg').focus();
                        return false;
                    } else
                    {
                        $('.couponcode').val('');
                        $('.coupon-checkbox').val('');
                        toastr.error('Invalid coupon code');
                        setTimeout(function () {
            location.reload();
        }, 1000);
//                        $('#coupon_msg').html('<div class="btn btn-danger mb-4" >Invalid Coupon</div>');
//                        $('#coupon_msg').focus();
                        return false;
                    }
                }
            });
        }
    }

    

    function remove()
    {
       
        $('.couponcode').val('');
        $('.remove').hide();
        $('.apply').show();
        $('.apply1').show();
        $('.couponcode').prop('disabled', false);
        $('#couponName').hide();
        $('.coupon-checkbox').val('');
       
        // $('#discount').val('');
        toastr.error('Coupon removed successfully');

        $('#discount').html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + "0");

      
        
        setTimeout(function () {
            location.reload();
        }, 1000);
    }

    function updateCart(cartid)
    {
        var quantity = $("#quantity" + cartid).val();
        $.ajax({
            url: "<?php echo base_url(); ?>web/updateCart",
            method: "POST",
            data: {cartid: cartid, quantity: quantity},
            success: function (data)
            {
                var str = data;
                var res = str.split("@");

                $('html, body').animate({
                    scrollTop: $('#scroll_id').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                }, 'slow');
                if (res[1] == 'success')
                {

                    $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Quantity updated to cart</span>');
                    $('#display_msg').focus();
                    location.reload();
                    return false;
                } else
                {
                    $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">' + res[2] + '</span>');
                    $('#display_msg').focus();
                    return false;
                }
            }
        });
    }

    function getDeliveryAddressID(aid) {
        $('#selected_address').val(aid);
        console.log(aid);
    }

    // document.addEventListener("DOMContentLoaded", function() {
//   var selectElement = document.querySelector(".custom-select");

  // Loop through each option and update its text to fit the select's width
//   for (var i = 0; i < selectElement.options.length; i++) {
    // var option = selectElement.options[i];
    // var optionText = option.text;

    // Check if the option's text exceeds the select's width
    // if (optionText.length > 100) { // Adjust the character limit as needed
    //   optionText = optionText.substring(0, 90) + '...'; // Truncate the text
    // }

    // option.text = optionText; // Update the option's text
//   }
// });

    function deletecartitems(cartid)
    {

        var id = $(this).parents("tr").attr("id");

        swal({

            title: "Are you sure?",

            text: "You want to remove this item",

            type: "warning",

            showCancelButton: true,

            confirmButtonClass: "btn-danger",

            confirmButtonText: "Yes",

            cancelButtonClass: "btn-danger",

            cancelButtonText: "No",

            closeOnConfirm: true,

            closeOnCancel: true

        },
                function (isConfirm) {

                    if (isConfirm) {


                        $.ajax({
                            url: "<?php echo base_url(); ?>web/deleteCartItem",
                            method: "POST",
                            data: {cartid: cartid},
                            success: function (data)
                            {
                                var str = data;
                                var res = str.split("@");
                                $('html, body').animate({
                                    scrollTop: $('#scroll_id').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                                }, 'slow');
                                if (res[1] == 'success')
                                {
                                    toastr.success('Removed from cart successfully.');
                                    // $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Cart Item deleted successfully</span>');
                                    //  $('#display_msg').focus();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);

                                    //    return false;




                                } else
                                {
                                    swal("Something went wrong , please try again");
                                    // $('#display_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Something went wrong , please try again</span>');
                                    // $('#display_msg').focus();
                                    //   return false;
                                }



                            }
                        });
                    } else {

                        swal("Cancelled", "Cancelled", "error");

                    }

                });









    }
</script>
<!--shopping cart area end -->

<script type="text/javascript">
   function memberform() {   
    var selectedOption = $("input[name='options']:checked").val();
    console.log("selected option", selectedOption);

    if (selectedOption === undefined) {
        toastr.error('Select at least one option from the list to proceed');
        return false; // No option is selected
    } 
    // No need for else block here because if an option is selected, the function will continue execution
}


    function addremoveTOpDealsFavorite(vid, key)
    {
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        if (user_id == '')
        {
            $('#loginModal').modal('show');
            return false;
        } else
        {
            $.ajax({
                url: "<?php echo base_url(); ?>web/add_remove_topdeal_whishList2",
                method: "POST",
                data: {vid: vid},
                success: function (data)
                {

                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    //location.reload();
                    // $("#topdeals").load(location.href + " #topdeals");

                    // $('html, body').animate({
                    //           scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                    //       }, 'slow');

                    if (res[1] == 'remove')
                    {

                        /* $("#topdeals").load(location.href + " #topdeals");
                         $('#top_fav_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Removed from the Favourites</span>');
                         $('#top_fav_msg').focus();
                         location.reload();
                         return false;*/
                        $("#favoritecls_" + vid).removeClass("fas");
                        $("#favoritecls_" + vid).addClass("fal");
                        $('#wish_list_btn_' + key).css({"background": "white", "color": "#0857c0"});
                        toastr.info('Removed from wishlist.');
                        $('#wish_list_btn_' + key).html('MOVE TO WISHLIST');

                    } else if (res[1] == 'add')
                    {
                        $("#favoritecls_" + vid).removeClass("fal");
                        $("#favoritecls_" + vid).addClass("fas");

                        toastr.info('Added to wishlist.');
//                        $('#wish_list_btn_' + key).css({"background": "#0857c0", "color": "white"});
//                        $('#wish_list_btn_' + key).html('REMOVE FROM WISHLIST');
                        window.location.href = "<?php echo base_url(); ?>web/checkout";
                        /*$('#top_fav_msg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Added to Favourites</span>');
                         $('#top_fav_msg').focus();
                         
                         location.reload();
                         return false;*/
                    }



                }
            });
        }
    }

    function addFavorite_NEW(vid)
    {
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        if (user_id == '')
        {
            $('#loginModal').modal('show');
            return false;
        } else
        {
            $.ajax({
                url: "<?php echo base_url(); ?>web/add_most_viewed_removewhishList",
                method: "POST",
                data: {vid: vid},
                success: function (data)
                {

                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    //location.reload();
                    //$("#trending_now").load(location.href + " #trending_now");
                    /*$('html, body').animate({
                     scrollTop: $('#show_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                     }, 'slow');*/
                    if (res[1] == 'remove')
                    {

                        /*$("#topdeals").load(location.href + " #topdeals");
                         $('#top_fav_msg').html('<span class="error" style="color:red;font-size: 16px;margin-left: 18px; width:100%">Removed from the Favourites</span>');
                         $('#top_fav_msg').focus();
                         location.reload();
                         return false;*/
                        $("#rendingfavorites_" + vid).removeClass("fas");
                        $("#rendingfavorites_" + vid).addClass("fal");

                    } else if (res[1] == 'add')
                    {

                        /*$('#top_fav_msg').html('<span class="error" style="color:green;font-size: 16px;margin-left: 18px; width:100%">Added to Favourites</span>');
                         $('#top_fav_msg').focus();
                         
                         location.reload();
                         return false;*/


                        $("#rendingfavorites_" + vid).removeClass("fal");
                        $("#rendingfavorites_" + vid).addClass("fas");
                    }



                }
            });
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

// $(document).ready(function(){
//         $('.pin').click(function(){
//             // Extract PinCode from innerHTML
//             var innerHTML = dropdownToggle.innerHTML;
//             // console.log(innerHTML);
//             var pinCode = extractPinCode(innerHTML);

//             // Log the extracted PinCode
//             // console.log(pinCode);

//             // Call the validatepincode function with the extracted PinCode
//             validatepincode(pinCode);
//         });

//         // Function to extract PinCode from innerHTML
//         function extractPinCode(html) {
//             // Assuming PinCode is in the format "PinCode: <pincode>"
//             var regex = /\b\d{6}\b/;
//             var match = html.match(regex);

//             // Return the extracted PinCode or an empty string if not found
//             return match ? match[0] : '';
//         }
//     });


                                function selectPayment(payment_type)
                                {
                                    if (payment_type == 'ONLINE')
                                    {
                                        document.getElementById("online").style.display = "block";
                                        document.getElementById("offline").style.display = "none";
                                    } else if (payment_type == 'COD')
                                    {
                                        document.getElementById("offline").style.display = "block";
                                        document.getElementById("online").style.display = "none";
                                    }
                                }
                                var SITEURL = "<?php echo base_url() ?>";

                                function payoffline(price, aid, session_id)
                                {
                                    $('#offline').prop('disabled', true);
                                    var totalAmount = price;
                                    var coupon_id = '<?php echo $coupon_id; ?>';
                                    var coupon_code = '<?php echo $coupon_code; ?>';
                                    var coupon_discount = '<?php echo $coupon_discount; ?>';
                                    var gst = '0';
                                    var shipping_charge = '<?php echo $shipping_charge; ?>';
                                    $.ajax({
                                        url: SITEURL + 'web/doOrder',
                                        method: "POST",
                                        data: {totalAmount: totalAmount, address_id: aid, coupon_id: coupon_id, coupon_code: coupon_code, coupon_discount: coupon_discount, session_id: session_id, gst: gst, shipping_charge: shipping_charge},
                                        success: function (data)
                                        {
                                            var str = data;
                                            var res = str.split("@");
                                            if (res[1] == 'success')
                                            {
                                                window.location.href = SITEURL + 'web/thankYou';
                                            } else if (res[1] == 'noprod')
                                            {
                                                toastr.error(res[2]);
                                            } else if (res[1] == 'shopclosed')
                                            {
                                                toastr.error("Shop Closed")
                                            } else
                                            {
                                                toastr.error("Something went wrong, Please try again")
                                            }
                                        }
                                    });
                                }

                                function paynow(price, aid)
                                {
                                    var totalAmount = '<?php echo $total_price; ?>';
                                    // print_r(totalAmount);
                                    // console.log(totalAmount + "Hi");
                                    var coupon_id = '<?php echo $coupon_id; ?>';
                                    var coupon_code = '<?php echo $coupon_code; ?>';
                                    var coupon_discount = '<?php echo $coupon_discount; ?>';
                                    var phone = '<?php echo $phone; ?>';
                                    var email = '<?php echo $email; ?>';

                                }

</script>
<script type="text/javascript">
    // $('#btn_register').click(function(){



    function readyFn(jQuery)
    {
        $('.coupon-checkbox').val('');
        // var price='<?php echo $grand_t; ?>';
        // var discount=$('#coupon_discount').val();
        // var total_price= price-discount;
        // var total_payment = $('#order_total_payment').val();
        
        // console.log(total_price);
        //$('#order_total_payment').val(total_payment);
        // var els = document.getElementsByName("total_price");
        // console.log(els);
        // for (var i = 0; i < els.length; i++)
        // {
            // els[i].value = total_price;
            // console.log(els[i].value);
        // }
      
        // console.log(total_payment);
    }

    $(document).ready(readyFn);
// or:
    $(window).on("load", readyFn);

    function validateupdateAddressForm(aid)
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile' + aid).val();
        var pn1 = $('#pincode' + aid).val();

        if ($('#name' + aid).val() == '')
        {
            $('#name' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Name</span>');
            $('#name' + aid).focus();
            return false;
        } else if ($('#mobile' + aid).val() == '')
        {
            $('#mobile' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Mobile</span>');
            $('#mobile' + aid).focus();
            return false;
        } else if (ph.length != 10)
        {
            $('#mobile' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 10 digit Phone Number</span>');
            $('#mobile' + aid).focus();
            return false;
        } else if ($('#address' + aid).val() == '')
        {
            $('#address' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Address</span>');
            $('#address' + aid).focus();
            return false;
        } else if ($('#state' + aid).val() == '')
        {
            $('#state' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select State</span>');
            $('#state' + aid).focus();
            return false;
        } else if ($('#cities' + aid).val() == '')
        {
            $('#cities' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter City</span>');
            $('#cities' + aid).focus();
            return false;
        } 
        else if ($('#pincode' + aid).val() == '')
        {
            $('#pincode' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Pincode</span>');
            $('#pincode' + aid).focus();
            return false;
        } 
         else if (pn1.length != 6)
        {
            $('#pincode' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 6 Digit Pincode</span>');
            $('#pincode' + aid).focus();
            return false;
        }
        else if ($('#landmark' + aid).val() == '')
        {
            $('#landmark' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Landmark</span>');
            $('#landmark' + aid).focus();
            return false;
        } else
        {
            var name = $('#name' + aid).val();
            var mobile = $('#mobile' + aid).val();
            var address = $('#address' + aid).val();
            var state = $('#state' + aid).val();
            var cities = $('#cities' + aid).val();
            var pincode = $('#pincode' + aid).val();
            var landmark = $('#landmark' + aid).val();
            var type_name = 'inlineRadioOption' + aid;
            var inlineRadio1 = $("input[name=" + type_name + "]:checked").val();
            var coupon_discount = $('#coupon_discount').val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/updateaddress",
                method: "POST",
                data: {name: name, mobile: mobile, address: address, state: state, cities: cities, pincode: pincode, landmark: landmark, address_type: inlineRadio1, aid: aid},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        $('html, body').animate({
                            scrollTop: $('#show_checkout_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                        }, 'slow');
                        location.reload();

                        //window.location.href = "<?php echo base_url(); ?>web/goaddress_page";
                        $('#coupon_discount_price').val(coupon_discount);

                        $('#addressmsg').html('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Address updated successfully</span>');
                        $('#addressmsg').focus();
                        return false;
                    } else if (res[1] == 'nolocation')
                    {
                        $('#pincode' + aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">No shops in this location,Please change your location</span>');
                        $('#pincode' + aid).focus();
                        return false;
                    }
                }
            });
        }


    }




    function validateAddressForm()
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile').val();
         var pn = $('#pincode').val();

        if ($('#name').val() == '')
        {
            $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Name</span>');
            $('#name').focus();
            return false;
        } else if ($('#mobile').val() == '')
        {
            $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Mobile</span>');
            $('#mobile').focus();
            return false;
        } else if (ph.length != 10)
        {
            $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 10 digit Phone Number</span>');
            $('#mobile').focus();
            return false;
        } else if ($('#address').val() == '')
        {
            $('#address').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Address</span>');
            $('#address').focus();
            return false;
        } else if ($('#state').val() == '')
        {
            $('#state').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select State</span>');
            $('#state').focus();
            return false;
        } else if ($('#cities').val() == '')
        {
            $('#cities').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter City</span>');
            $('#cities').focus();
            return false;
        }
         else if ($('#pincode').val() == '')
        {
            $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Pincode</span>');
            $('#pincode').focus();
            return false;
        } 
          else if (pn.length != 6)
        {
             $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 6 Digit Pincode</span>');
             $('#pincode').focus();
            return false;
        }
        else if ($('#landmark').val() == '')
        {
            $('#landmark').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Landmark</span>');
            $('#landmark').focus();
            return false;
        } else
        {
            var coupon_discount = $('#coupon_discount').val();
            var name = $('#name').val();
            var mobile = $('#mobile').val();
            var address = $('#address').val();
            var state = $('#state').val();
            var cities = $('#cities').val();
            var pincode = $('#pincode').val();
            var landmark = $('#landmark').val();
            var inlineRadio1 = $("input[name='inlineRadioOptions']:checked").val();
            $.ajax({
                url: "<?php echo base_url(); ?>web/addaddress",
                method: "POST",
                data: {name: name, mobile: mobile, address: address, state: state, cities: cities, pincode: pincode, landmark: landmark, address_type: inlineRadio1, coupon_discount: coupon_discount},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");

                    //alert(JSON.stringify(res));
                    //alert(coupon_discount);


                    if (res[1] == 'success')
                    {
                        $('html, body').animate({
                            scrollTop: $('#show_checkout_errormsg1').offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                        }, 'slow');
                        location.reload();

                        //window.location.href = "<?php echo base_url(); ?>web/goaddress_page";
                        $('#coupon_discount_price').val(coupon_discount);
                        $('#addressmsg').html('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Address added successfully</span>');
                        $('#addressmsg').focus();

                        return false;
                    } else if (res[1] == 'nolocation')
                    {
                        $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">No shops in this location,Please change your location</span>');
                        $('#pincode').focus();
                        return false;
                    }



                }
            });
        }


    }

    function validateEmail($email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test($email)) {
            return false;
        } else
        {
            return true;
        }
    }

</script>
<script type="text/javascript">
    function getCities(state_id)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>web/getStates",
            method: "POST",
            data: {state_id: state_id},
            success: function (data)
            {
                $('.pincode').html('');
                $('.cities').html(data);

            }
        });
    }


    function getPincodes(city_id, state = null)
    {
        if (state == null) {
            var state_id = $("#state").val();
        } else {
            var state_id = $("#state" + state).val();
        }
        $.ajax({
            url: "<?php echo base_url(); ?>web/getaddresspincodes",
            method: "POST",
            data: {state_id: state_id, city_id: city_id},
            success: function (data)
            {
                $('.pincode').html(data)

            }
        });
    }

    

    function chk_address_place_order() {
        var selected_address = $('#selected_address').val();


        $('.check_address_back').each(function(){
            if($(this).prop('checked') == true){
                selected_address = $(this).val();
                $('#selected_address').val(selected_address);
                // console.log(selected_address);
            }
        });
        
        if (selected_address == '') {
            toastr.error("Please select delivery address to proceed")
            return false;
        } else {
            $.ajax({
                url: "<?= base_url() ?>web/payment",
                method: "POST",
                data: $('#checkout-form').serialize(),
                success: function (data)
                {
//                    $('#exampleModalCenter').modal('show');
                    var result = $.parseJSON(data);
                //    var coupon_id= $('#coupon_id').val();
                    //  var coupon_code=   $('#applied_coupon_code').val();
                    //  var coupon_discount=   $('#coupon_discount').val();
                    //  var total_price =  '<?php echo number_format($grand_t,2); ?>'
                    // var total_price=$('#order_total_payment').val();
                    // console.log(total_price);
                    // var price='<?php echo $grand_t; ?>';
                    // var total_price= price-result.coupon_discount;
                    // console.log(result.total_amount);
                   
                    var price='<?php echo $grand_t; ?>';
        var discount=$('#coupon_discount').val();
        var total_price= price-discount;
        var membership=$('#membership').val();
        // console.log("membership value"+membership);

                    var form = `<form method="post" id="payment-form" action="<?= base_url('web/phonepe_payment') ?>">
                            <input type="hidden" name="totalAmount" value="` + total_price + `" />
                            <input type="hidden" name="address_id" value="` + result.aid + `" />
                            <input type="hidden" name="coupon_id" value="` + result.coupon_id + `" />
                            <input type="hidden" name="coupon_code" value="` + result.coupon_code + `" />
                            <input type="hidden" name="coupon_discount" value="` + result.coupon_discount + `" />
                            <input type="hidden" name="gst" value="` + result.gst + `" />
                            <input type="hidden" name="shipping_charge" value="` + result.shipping_charge + `" />
                            <input type="hidden" name="membership" value="` + result.membership + `" />
                            <button type="submit" class="btn btn-pink btn-block custom" id="online" style="display: none;position: relative;left: 26%;">Pay Now</button>
                        </form>`;

                    $('#payment').html(form);
                    document.getElementById("payment-form").submit();
                    const checkboxes = document.querySelectorAll('.coupon-checkbox');

// Clear all checkboxes by setting their checked property to false
checkboxes.forEach(checkbox => {
    checkbox.checked = false;
});
                }
            });
        }
    }



//    $(document).ready(function () {
//     $("#attributeDropdown_<?php echo $value->id; ?>").change(function () {
//         updateDisplayedPrices(<?php echo $value->id; ?>);
//     });

//     // Initial update when the page loads
//     updateDisplayedPrices(<?php echo $value->id; ?>);

//     function updateDisplayedPrices(itemId) {
//         // Get the selected option's price and sale price
//         var selectedOption = $("#attributeDropdown_" + itemId + " :selected");
//         var selectedPrice = selectedOption.data('price');
//         var selectedSalePrice = selectedOption.data('saleprice');

//         // Update the displayed price
//         $("#displayedPrice_" + itemId + " span").text(selectedPrice.toFixed(0));
//         console.log(selectedPrice);
//         // Update the sale price
//         $("#salePrice_" + itemId + " span").text(selectedSalePrice.toFixed(0));
//         console.log(selectedSalePrice);
// var discounttext=selectedPrice - selectedSalePrice;
// var disvalue = (discounttext.toFixed(0) * 1) + <?php echo $totalPriceDiscount; ?>;
// console.log(disvalue);
//         var discount = ((selectedPrice - selectedSalePrice) * 100) / selectedPrice;

// $("#disvar_"+itemId + " span").text(discount.toFixed(2)+" %OFF");
// // <i class="fal fa-rupee-sign" style="font-size:12px;"></i>
// // $("#discount_var_"+itemId + " p"+"#discount12").text(discounttext);
// // var proprice=selectedPrice + <?php echo $unit_price; ?>;
// $("#discount_var_" + itemId + " p#discount12").html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + discounttext);
// // $("#total_" + itemId + " p#am").html('<i class="fal fa-rupee-sign" style="font-size:12px;"></i>' + selectedPrice.toFixed(0));


// <?php
//  $qry = $this->db->query("select * from link_variant where product_id='" . $link->product_id . "'");
                                            
//  $res1=$qry->result();
//  if ($variants1[0]->jsondata!= '') {
//  $unitprice = $r->saleprice + $unitprice;
// $gst = $class_percentage + $gst;
//  }
//                                        ?>


//     }

// });
// Define the onchange function for the select dropdown
function attributeDropdown(selectElement) {
    // Get the selected option
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var variantId = selectedOption.getAttribute('value');
    var price = selectedOption.getAttribute('data-price');
    var id = selectedOption.getAttribute('data-id');
    var session_id = selectedOption.getAttribute('data-sessionid');
    var user_id = selectedOption.getAttribute('data-userId');
    var vendor_id = selectedOption.getAttribute('data-vendorid');
    var status = selectedOption.getAttribute('data-status');
    var cartstatus = selectedOption.getAttribute('data-cart_status');
    var checkout = selectedOption.getAttribute('data-check_out');
    var ischeckout= selectedOption.getAttribute('data-is_checkout');
    var quantity= selectedOption.getAttribute('data-quantity');
    
    // console.log(quantity);
    var salePrice = selectedOption.getAttribute('data-saleprice');
    var productId=selectedOption.getAttribute('data-productId');
    var defaultvar=selectedOption.getAttribute('data-variantId');
    // Create a data object to pass to the AJAX call
    var data = {
        id:id,
        variantId: variantId,
        session_id:session_id,
        user_id:user_id,
        vendor_id:vendor_id,
        status:status,
        cartstatus:cartstatus,
        checkout:checkout,
        ischeckout:ischeckout,
        quantity:quantity,
        price: price,
        defaultvar:defaultvar,
        salePrice: salePrice,
        productId:productId
    };

    
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>web/selectVariant", // Change this to the URL of your PHP script
         data: data,
         success: function(response) {
             // Handle the response from the server
             window.location.href = "<?php echo base_url(); ?>web/checkout";
            //  console.log(response);
            // You can update any elements on the page based on the response
        },
       error: function(xhr, status, error) {
             // Handle errors
             console.error(xhr.responseText);
         }
    });
}

function validateAddressForm1()
    {
        $('.error').remove();
        var errr = 0;
        var ph = $('#mobile').val();
        var pn = $('#pincode').val();

        if (($('#name').val() == '') || ($('#name').val().trim() == ''))
        {
            // $('#name').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px; margin-top:5px;width:100%">Enter Name</span>');
            toastr.error('Enter Name');
            $('#name').focus();
            return false;
        } else if ($('#mobile').val() == '')
        {
            // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Mobile</span>');
            toastr.error('Enter Mobile');
            $('#mobile').focus();
            return false;
        } else if (ph.length != 10)
        {
            // $('#mobile').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Valid 10 digit Phone Number</span>');
            toastr.error('Enter Valid 10 digit Phone Number');
            $('#mobile').focus();
            return false;
        } else if ($('#address').val() == '')
        {
            // $('#address').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Address</span>');
            toastr.error('Enter Address');
            $('#address').focus();
            return false;
        } else if ($('#state').val() == '')
        {
            // $('#state').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Select State</span>');
            toastr.error('Select State');
            $('#state').focus();
            return false;
        } else if ($('#cities').val() == '')
        {
            // $('#cities').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter City</span>');
            toastr.error('Enter City');
            $('#cities').focus();
            return false;
        } 
        else if ($('#pincode').val() == '')
        {
            // $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Pincode</span>');
            toastr.error('Enter Pincode');
            $('#pincode').focus();
            return false;
        } 
         else if (pn.length != 6)
        {
            //  $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 18px;margin-top:5px; width:100%">Enter Valid 6 Digit Pincode</span>');
            toastr.error('Enter Valid 6 Digit Pincode');
             $('#pincode').focus();
            return false;
        }
        else if ($('#landmark').val() == '')
        {
            // $('#landmark').after('<span class="error" style="color:red;font-size: 15px;margin-left: 3px;margin-top:5px; width:100%">Enter landmark</span>');
            toastr.error('Enter landmark');
            $('#landmark').focus();
            return false;
        } else
        {
            var name = $('#name').val();
            var mobile = $('#mobile').val();
            var address = $('#address').val();
            var state = $('#state').val();
            var cities = $('#cities').val();
            var pincode = $('#pincode').val();
            var landmark = $('#landmark').val();
            var inlineRadio1 = $("input[name='inlineRadioOptions']:checked").val();
            var status ='no';
            if(inlineRadio1 == '3'){
                status ='yes';

            }
            else{
                status ='no';
            }
            $.ajax({
                url: "<?php echo base_url(); ?>web/addbookaddress",
                method: "POST",
                data: {name: name, mobile: mobile, address: address, state: state, cities: cities, pincode: pincode, landmark: landmark, address_type: inlineRadio1,status:status},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    //alert(JSON.stringify(res));
                    if (res[1] == 'success')
                    {
                        window.location.href = "<?php echo base_url(); ?>web/checkout";
                        toastr.success("Address added successfully");
                        setTimeout(function () {
                        location.reload();
                        }, 2000,slow);

                        // $('#addressmsg').html('<span class="error" style="color:green;font-size: 15px;margin-left: 15px; width:100%">Address added successfully</span>');
                        $('#addressmsg').focus();
                        return false;
                    } else if (res[1] == 'nolocation')
                    {
                        toastr.error("No shops in this location,Please change your location");
                        // $('#pincode').after('<span class="error" style="color:red;font-size: 15px;margin-left: 15px; width:100%">No shops in this location,Please change your location</span>');
                        $('#pincode').focus();
                        return false;
                    }



                }
            });
        }


    }
    
// JavaScript
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("prime_member");
    var radioButtons = document.querySelectorAll(".buttonradio2");

    // Check if there's a stored active button index in local storage
    var activeButtonIndex = localStorage.getItem("activeButtonIndex3");
    if (activeButtonIndex !== null) {
        // Apply checked state to the stored active button
        radioButtons[activeButtonIndex].checked = true;
    } 

    // Handle form submission
    form.addEventListener("submit", function(event) {
        // Find the checked radio button and submit its value
        var checkedButton = document.querySelector('.buttonradio2:checked');
        if (checkedButton) {
            // Submit the value of the checked radio button here
            console.log("Selected value:", checkedButton.value);
            // Update local storage with the index of the checked radio button
            var selectedIndex = Array.from(radioButtons).indexOf(checkedButton);
            localStorage.setItem("activeButtonIndex3", selectedIndex.toString());
        } else {
            console.log("No radio button selected.");
        }
        window.location.href = "<?php echo base_url(); ?>web/checkout";
    });
    var cartdata = $('#cart_data').val();
    console.log("cartdata", cartdata);
    if (cartdata == '') {
            // Uncheck the checked radio button
            var checkedButton = document.querySelector('.buttonradio2:checked');
            if (checkedButton) {
                checkedButton.checked = false;
            }
            // Clear the local storage
            localStorage.clear();
        }
});




</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function(e) {
            // Get the count value from PHP
            var count = <?php echo $cart_count; ?>;
            var cart_data=$('#cart_data').val();
            // Check the count and hide/show the div accordingly
            if (count > 0 || cart_data!='' ) {
                $('.mycategorybox').show();
                $('.box').show();
                $('.mycart').show();
                $('.cart_address_box').show();
            } else {
                $('.mycategorybox').hide();
                $('.box').hide();
                $('.mycart').hide();
                $('.cart_address_box').hide();
            }
        });
    </script>