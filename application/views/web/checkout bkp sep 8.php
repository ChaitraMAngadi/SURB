<?php  $this->load->view("web/includes/header_styles"); ?>
<!--breadcrumbs area start-->

<div class="breadcrumbs_area">

	<div class="container">

		<div class="row">

			<div class="col-12">

				<div class="breadcrumb_content">

					<h3>Checkout</h3>

				</div>

			</div>

		</div>

	</div>

</div>

<!--breadcrumbs area end-->

<div class="shopping_cart_area pb-5">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-lg-10">

				<div class="row pb-5">

					<div class="col-lg-12 col-md-12">

						<?php  $this->load->view("web/steps_menu"); ?>

					</div>

				</div>

				<div class="row">
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
						<p id="addressmsg"></p>

						<div id="show_checkout_errormsg1"></div>


					<div class="col-lg-8 col-md-8 order-lg-0 order-md-0 order-1">

						<h4>Deliver To</h4>
						<?php 
								$adminqry = $this->db->query("select * from admin where id=1");
								$adminrow = $adminqry->row();
								
						?>
						<p style="color: #cf1673;">Delivery available around <?php echo $adminrow->distance; ?> kms distance from Shop location only</p>
						<div class="row">
							<?php foreach($addresslist as $address){ 
								?>
							<div class="col-lg-6 col-md-6">
								<div class="card p-3 mb-3">
									<p><strong><?php echo $address['name']; ?></strong> <br>
									<?php echo $address['address']; ?>,<?php echo $address['landmark']; ?>,<br><?php echo $address['state']; ?>,<?php echo $address['city']; ?> - <?php echo $address['pincode']; ?> <br>
								Ph: <?php echo $address['mobile']; ?></p>
								<div class="row justify-content-between">
									<div class="col-lg-5 col-md-5 col-6">
										<a data-toggle="collapse" data-target="#editaddress<?php echo $address['id']; ?>" class="btn btn-success btn-sm"><i class="fal fa-edit"></i> Edit</a>
									</div>
									<div class="col-lg-5 col-md-5 col-6 text-right">
										<form method="post" class="form-horizontal" action="<?= base_url() ?>web/deleteaddress">
											<input type="hidden" name="address_id" value="<?php echo $address['id']; ?>">
											<input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">
											<input type="hidden" name="coupon_code" value="<?php echo $coupon_code; ?>">
											<input type="hidden" name="coupon_discount" value="<?php echo $coupon_discount; ?>">
											<button type="submit" class="btn btn-danger  btn-sm">Delete</button>
										</form>
										<!-- <a href="<?php echo base_url(); ?>web/deleteaddress/<?php echo $address['id']; ?>" onclick="if(!confirm('Are you sure you want to delete this address?')) return false;" class="btn btn-danger  btn-sm"><i class="fal fa-trash-alt"></i> Delete</a> -->
									</div>
								</div>
								

							<form method="post" class="form-horizontal" action="<?= base_url() ?>web/payment">
								<input type="hidden" name="aid" value="<?php echo $address['id']; ?>">
								<input type="hidden" name="total_price" id="order_total_payment">

								<input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">
								<input type="hidden" name="coupon_code" value="<?php echo $coupon_code; ?>">
								<input type="hidden" name="coupon_discount" value="<?php echo $coupon_discount; ?>">

								<button type="submit" class="btn btn-sm btn-address">Deliver to this Address</button>
								</form>
								</div>
							</div>


			<div class="row newaddressbox collapse" id="editaddress<?php echo $address['id']; ?>">
				<h3>Update Address</h3>
				 <form class="form-horizontal" enctype="multipart/form-data"  >
					<div class="col-lg-12 col-md-12">

						<div class="form-group">
							<label>Name : </label>
							<input type="hidden" class="form-control" id="aid" value="<?php echo $address['id']; ?>">
							<input type="text" class="form-control" id="name<?php echo $address['id']; ?>" placeholder="Name" value="<?php echo $address['name']; ?>">

						</div>

					</div>

					<div class="col-lg-12 col-md-12">

						<div class="form-group">
							<label>Mobile : </label>
							<input type="text" class="form-control" id="mobile<?php echo $address['id']; ?>" placeholder="Mobile No." value="<?php echo $address['mobile']; ?>">

						</div>

					</div>

					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label>Address : </label>
							<input type="text" class="form-control" id="address<?php echo $address['id']; ?>" placeholder="Address (House No. Building...)" value="<?php echo $address['address']; ?>">
						</div>
					</div>

					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label>State : </label>
							<select class="form-control downarrow" id="state<?php echo $address['id']; ?>" onchange="getCities(this.value)">
								<option value="">Select State</option>
								<?php foreach($states as $state){ ?>
								<option value="<?php echo $state->id; ?>" <?php if($state->id==$address['state_id']){ echo "selected='selected'"; }?>><?php echo $state->state_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label>City : </label>
							<select class="form-control downarrow" id="cities<?php echo $address['id']; ?>" onchange="getPincodes(this.value)">
								<?php
								$city_qry = $this->db->query("select * from cities where state_id='".$address['state_id']."'");
								$city_row = $city_qry->result(); 
								 foreach($city_row as $cit){ ?>
								<option value="<?php echo $cit->id; ?>" <?php if($cit->id==$address['city_id']){ echo "selected='selected'"; }?>><?php echo $cit->city_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label>Pincode : </label>
							<select class="form-control downarrow" id="pincode<?php echo $address['id']; ?>">
								<?php
								$pincode_qry = $this->db->query("select * from pincodes where state_id='".$address['state_id']."' and city_id='".$address['city_id']."'");
								$pincode_result = $pincode_qry->result(); 
								 foreach($pincode_result as $pinc){ ?>
								<option value="<?php echo $pinc->id; ?>" <?php if($pinc->id==$address['city_id']){ echo "selected='selected'"; }?>><?php echo $pinc->pincode; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-lg-12 col-md-12">

						<div class="form-group">
						<label>Landmark : </label>
						<input type="text" class="form-control" id="landmark<?php echo $address['id']; ?>" placeholder="Locaiton / Landmark" value="<?php echo $address['landmark']; ?>">

						</div>

					</div>

					<div class="col-lg-12 col-md-12 pt-2">

						<h4>Type of Address</h4>

					</div>
					<div class="col-lg-12">

						<div class="form-check form-check-inline">

						  <input class="form-check-input" type="radio" <?php if($address['address_status']==1){ echo "checked='checked'"; } ?> name="inlineRadioOptions" id="inlineRadio1<?php echo $address['id']; ?>" value="1">

						  <label class="form-check-label" for="inlineRadio1">Home</label>

						</div>

						<div class="form-check form-check-inline">

						  <input class="form-check-input" type="radio" <?php if($address['address_status']==2){ echo "checked='checked'"; } ?> name="inlineRadioOptions" id="inlineRadio1<?php echo $address['id']; ?>" value="2">

						  <label class="form-check-label" for="inlineRadio2">Office / Commercial</label>

						</div>

						<!-- <div class="form-check form-check-inline">

						  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">

						  <label class="form-check-label" for="inlineRadio3">Make this my Default Address</label>

						</div> -->

					</div>

					<div class="col-lg-12">

						<button type="button" class="btn btn-address"  onclick="validateupdateAddressForm('<?php echo $address['id']; ?>')">UPDATE ADDRESS</button>

					</div>
				</form>

				</div>



							<?php } ?>

						</div>

						<button class="btn btn-blue mb-2" type="button" data-toggle="collapse" data-target="#addnewaddress"><i class="fal fa-plus-circle"></i> Add New Address</button>

						<div class="row newaddressbox collapse" id="addnewaddress">
				 <form class="form-horizontal" enctype="multipart/form-data"  >
					<div class="col-lg-12 col-md-12">

						<div class="form-group">

							<input type="text" class="form-control" id="name" placeholder="Name">

						</div>

					</div>

					<div class="col-lg-12 col-md-12">

						<div class="form-group">

							<input type="text" class="form-control" id="mobile" placeholder="Mobile No.">

						</div>

					</div>

					<div class="col-lg-12 col-md-12">

						<div class="form-group">

							<input type="text" class="form-control" id="address" placeholder="Address (House No. Building...)">

						</div>

					</div>
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<select class="form-control downarrow" id="state" onchange="getCities(this.value)">
								<option value="">Select State</option>
								<?php foreach($states as $state){ ?>
								<option value="<?php echo $state->id; ?>"><?php echo $state->state_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<select class="form-control downarrow" id="cities" onchange="getPincodes(this.value)">
								<option value="">Select City</option>
							</select>
						</div>
					</div>
				
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<select class="form-control downarrow" id="pincode">
								<option value="">Select Pincode</option>
							</select>
						</div>
					</div>

					<div class="col-lg-12 col-md-12">

						<div class="form-group">

						<input type="text" class="form-control" id="landmark" placeholder="Locaiton / Landmark">

						</div>

					</div>

					<div class="col-lg-12 col-md-12 pt-2">

						<h4>Type of Address</h4>

					</div>

					<div class="col-lg-12">

						<div class="form-check form-check-inline">

						  <input class="form-check-input" type="radio" checked="" name="inlineRadioOptions" id="inlineRadio1" value="1">

						  <label class="form-check-label" for="inlineRadio1">Home</label>

						</div>

						<div class="form-check form-check-inline">

						  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2">

						  <label class="form-check-label" for="inlineRadio2">Office / Commercial</label>

						</div>

						<!-- <div class="form-check form-check-inline">

						  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">

						  <label class="form-check-label" for="inlineRadio3">Make this my Default Address</label>

						</div> -->

					</div>

					<div class="col-lg-12">

						<button type="button" class="btn btn-address"  onclick="validateAddressForm()">SAVE ADDRESS</button>

					</div>
				</form>

				</div>

					</div>

					<div class="col-lg-4 col-md-4 order-lg-1 order-md-0 order-0">

						<div class="card mb-3">

						  <div class="card-header bg-blue">

						    <h4 class="text-white">Your Order</h4>

						  </div>

						 <table class="table table-striped">

						 	 <?php 
						 	 $user_id = $_SESSION['userdata']['user_id'];
						 	 $session_id = $_SESSION['session_data']['session_id'];
    $qry = $this->db->query("select * from cart where session_id='".$session_id."' and user_id='".$user_id."'");
    $del_b = $qry->row();


    
    $shop = $this->db->query("select * from vendor_shop where id='".$del_b->vendor_id."'");
    $shopdat = $shop->row();
    $min_order_amount = $shopdat->min_order_amount;

    $result = $qry->result();
    
        $unitprice=0;
        $gst=0;
        foreach ($result as $value) 
        {
            $pro = $this->db->query("select * from  product_images where variant_id='".$value->variant_id."'");
            $product = $pro->row();

            if($product->image!='')
            {
                $img = base_url()."uploads/products/".$product->image;
            }
            else
            {
                $img = base_url()."uploads/noproduct.png";
            }
            //$value->variant_id
                $var1 = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                $link = $var1->row();

                 $pro1 = $this->db->query("select * from  products where id='".$link->product_id."'");
                 $product1 = $pro1->row();

                 $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                 if( $adm_qry->num_rows()>0)
                 {
                    $adm_comm = $adm_qry->row();
                    $p_gst = $adm_comm->gst;

                 }
                 else
                 {
                    $p_gst = '0';
                 }

                 $class_percentage = ($value->unit_price/100)*$p_gst;

                 

                    $variants1 = $var1->result();
                    $att1=[];
                    foreach ($variants1 as $value1) 
                    {

                        

                        $jsondata = $value1->jsondata;

                        $values_ar=[];

                        $json =json_decode($jsondata);
                        foreach ($json as $value123) 
                        {
                            $type = $this->db->query("select * from attributes_title where id='".$value123->attribute_type."'");
                            $types = $type->row();
                        
                            $val = $this->db->query("select * from attributes_values where id='".$value123->attribute_value."'");
                            $value1 = $val->row();
                            $values_ar[]=array('id'=>$value1->id,'title'=>$types->title,'value'=>$value1->value);
                        }

                        

                    }


          /* $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img,'attributes'=>$values_ar,'product_name'=>$product1->name,'shop_name'=>$shopdat->shop_name,'shop_id'=>$del_b->vendor_id,'gst'=>$class_percentage,'maximum_quantity'=>$link->stock);*/

           $unitprice = $value->unit_price+$unitprice;
            $gst = $class_percentage+$gst;
                ?>


						 	<tr>

						 		<td><?php echo $product1->name; ?></td>

						 		<td align="right"><i class="fal fa-rupee-sign"></i> <span><?php echo $value->price; ?></span></td>

						 	</tr>

						 	


						 	 <?php } 

                $grand_t =  $min_order_amount+$unitprice+$gst;
            ?>

            			
            			<tr>

						 		<td align="right"><strong>Sub Total :</strong></td>

						 		<td align="right"><i class="fal fa-rupee-sign"></i> <span><?php echo $unitprice; ?></span></td>

						 	</tr>
						 	<tr>

						 		<td align="right"><strong>Shipping Charges :</strong></td>

						 		<td align="right"><i class="fal fa-rupee-sign"></i> <span><?php echo $min_order_amount; ?></span></td>

						 	</tr>

						 	<tr>

						 		<td align="right"><strong>Discount : </strong></td>

						 		<td align="right"><i class="fal fa-rupee-sign"></i> <span id="coupon_discount_price"><?php echo $coupon_discount; ?></span></td>
						 		<input type="hidden" id="coupon_discount" value="<?php echo $coupon_discount; ?>">
						 	</tr>

						 	

						 	<tr>

						 		<td align="right"><strong>Total :</strong></td>

						 		<td align="right" width="100"><i class="fal fa-rupee-sign"></i> <span><?php echo $grand_t-$coupon_discount; ?></span>
						 			<input type="hidden" id="total_payment" value="<?php echo $grand_t-$coupon_discount; ?>">
						 	</td>

						 	</tr>

						 </table>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
   // $('#btn_register').click(function(){
   	


function readyFn( jQuery ) 
{
    var total_payment = $('#total_payment').val();
   //$('#order_total_payment').val(total_payment);
    var els = document.getElementsByName("total_price");
	for (var i=0;i<els.length;i++) 
	{
		els[i].value = total_payment
	}
}

$( document ).ready( readyFn );
// or:
$( window ).on( "load", readyFn );

    function validateupdateAddressForm(aid)
    {
        $('.error').remove();
            var errr=0;
            var ph = $('#mobile'+aid).val();
      
      if($('#name'+aid).val()=='')
      {
         $('#name'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Name</span>');
         $('#name'+aid).focus();
         return false;
      }
      else if($('#mobile'+aid).val()=='')
      {
         $('#mobile'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Mobile</span>');
         $('#mobile'+aid).focus();
         return false;
      }
       else if(ph.length!=10)
      {
         $('#mobile'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 10 digit Phone Number</span>');
         $('#mobile'+aid).focus();
         return false;
      }  
      else if($('#address'+aid).val()=='')
      {
         $('#address'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Address</span>');
         $('#address'+aid).focus();
         return false;
      }
      else if($('#state'+aid).val()=='')
      {
         $('#state'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select State</span>');
         $('#state'+aid).focus();
         return false;
      }
      else if($('#cities'+aid).val()=='')
      {
         $('#cities'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select City</span>');
         $('#cities'+aid).focus();
         return false;
      }
      else if($('#pincode'+aid).val()=='')
      {
         $('#pincode'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select pincode</span>');
         $('#pincode'+aid).focus();
         return false;
      }
      else if($('#landmark'+aid).val()=='')
      {
         $('#landmark'+aid).after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Landmark</span>');
         $('#landmark'+aid).focus();
         return false;
      }
      else
      {
        var name= $('#name'+aid).val();
        var mobile= $('#mobile'+aid).val();
        var address= $('#address'+aid).val();
        var state= $('#state'+aid).val();
        var cities = $('#cities'+aid).val();
        var pincode = $('#pincode'+aid).val();
        var landmark = $('#landmark'+aid).val();
        var inlineRadio1 = $('#inlineRadio1'+aid).val();
         var coupon_discount= $('#coupon_discount').val();
            $.ajax({
              url:"<?php echo base_url(); ?>web/updateaddress",
              method:"POST",
              data:{name:name,mobile:mobile,address:address,state:state,cities:cities,pincode:pincode,landmark:landmark,address_type:inlineRadio1,aid:aid},
              success:function(data)
              {
                 var str = data;
              var res = str.split("@");
              //alert(JSON.stringify(res));
                        if(res[1]=='success')
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
                        }
                        else if(res[1]=='nolocation')
                        {
                              $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">No shops in this location,Please change your location</span>');
			                  $('#pincode').focus();
			                   return false;
                        }
              }
             });
      }
      

 }




      function validateAddressForm()
      {
        $('.error').remove();
            var errr=0;
            var ph = $('#mobile').val();
      
      if($('#name').val()=='')
      {
         $('#name').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Name</span>');
         $('#name').focus();
         return false;
      }
      else if($('#mobile').val()=='')
      {
         $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Mobile</span>');
         $('#mobile').focus();
         return false;
      }
       else if(ph.length!=10)
      {
         $('#mobile').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Valid 10 digit Phone Number</span>');
         $('#mobile').focus();
         return false;
      }  
      else if($('#address').val()=='')
      {
         $('#address').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Address</span>');
         $('#address').focus();
         return false;
      }
      else if($('#state').val()=='')
      {
         $('#state').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select State</span>');
         $('#state').focus();
         return false;
      }
      else if($('#cities').val()=='')
      {
         $('#cities').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select City</span>');
         $('#cities').focus();
         return false;
      }
      else if($('#pincode').val()=='')
      {
         $('#pincode').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Select pincode</span>');
         $('#pincode').focus();
         return false;
      }
      else if($('#landmark').val()=='')
      {
         $('#landmark').after('<span class="error" style="color:red;font-size: 18px;margin-left: 18px; width:100%">Enter Landmark</span>');
         $('#landmark').focus();
         return false;
      }
      else
      {
      	 var coupon_discount= $('#coupon_discount').val();
        var name= $('#name').val();
        var mobile= $('#mobile').val();
        var address= $('#address').val();
        var state= $('#state').val();
        var cities = $('#cities').val();
        var pincode = $('#pincode').val();
        var landmark = $('#landmark').val();
        var inlineRadio1 = $('#inlineRadio1').val();
            $.ajax({
              url:"<?php echo base_url(); ?>web/addaddress",
              method:"POST",
              data:{name:name,mobile:mobile,address:address,state:state,cities:cities,pincode:pincode,landmark:landmark,address_type:inlineRadio1,coupon_discount:coupon_discount},
              success:function(data)
              {
                 var str = data;
              var res = str.split("@");
              
              //alert(JSON.stringify(res));
              //alert(coupon_discount);

              
                        if(res[1]=='success')
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
                        }
                        else if(res[1]=='nolocation')
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
    if( !emailReg.test( $email) ) {
      return false;
    } 
    else
    {
        return true;
    }
}

</script>
<script type="text/javascript">
	function getCities(state_id)
	{
		 $.ajax({
              url:"<?php echo base_url(); ?>web/getStates",
              method:"POST",
              data:{state_id:state_id},
              success:function(data)
              {
                       $('#cities').html(data)
          
              }
             });
	}


	function getPincodes(city_id)
	{
		var state_id = $("#state").val();
		 $.ajax({
              url:"<?php echo base_url(); ?>web/getpincodes",
              method:"POST",
              data:{state_id:state_id,city_id:city_id},
              success:function(data)
              {
                       $('#pincode').html(data)
          
              }
             });
	}
</script>
<?php  $this->load->view("web/includes/footer"); ?>