
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3 breads">
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
</div>
<!--breadcrumbs area end-->
<!--about section area -->
<?php 
?>
<section class="dashboard">
    <div class="container">
        <div class="row">
                
               <?php 
            //    echo "<pre>";print_r($data['product_list']);exit; ?>
                    <div class="col-lg-2 col-md-12 wishing">
                    

                        <?php $this->load->view("web/dashboard_menu"); ?>
                    </div>

                    <?php if($data['wish_count']==0){?>  <div class="col-lg-10 wishlistempty" style="display:none;"><center><img src="<?php echo base_url();?>web_assets/img/wishlistempty.jpeg"/></center></div><center>
                        
                            <div class="cart_page" style=" display: flex;
            justify-content: center;
            align-items: center; margin: 0;
            padding: 0;">
                                <div class="col-lg-10">
                                    
                                    <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>">Start Shopping!</a>
                                </div>
                            </div><br><br><br><br><br><br><br><br><br><br><br>
                       </center> <?php }?>
              
                    
                    <div class="col-lg-10 col-md-12 wish_boarder" style="display:none;">
                    <div class="wish-div" style="display:none;">
                   
                    <h4 class="wishcontent" style="display:none;">wish List</h4>
                    
                    </div>
                    <div class="newcategorybox" style="display:none;">
                                <?php if (!empty($this->session->tempdata('success_whishlist_message'))) { ?>
                                    <div style=" color: green;display:none;" class="alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong> Success!</strong> <?= $this->session->tempdata('success_whishlist_message') ?>
                                    </div>
                                <?php } ?> 
                               
                                            <?php
                                            
                                            // if (count($data['product_list']) > 0) {
                                                foreach ($data['product_list'] as $whishlist) {
                                                    // echo "<pre>";
                                                    // print_r( $whishlist['wishlist_id']);
                                                    // echo "</pre>";
// print_r($whishlist['wish_details'][0]->stock);
                                                    ?>
                                                    
                                                
<div class="product-card col-lg-12 col-12 col-xs-12 col-sm-12 col-md-12">
                                                   
                                                   
    <div class="product-image col-lg-2 col-3 col-xs-3 col-sm-3 col-md-2">
    <a><form method="post" name="radio-form" id="radio-form" action="<?php echo base_url(); ?>web/product_view/<?php echo $whishlist['seo_url']; ?>" autocomplete="off">
                                                                <input type="hidden" name="product_id" value="<?php echo $whishlist['id']; ?>" autocomplete="off">
                                                                <input type="hidden" name="seo_url" value="<?php echo $whishlist['seo_url']; ?>" autocomplete="off">
                                                                <input type="hidden" name="total_count" value="<?php echo $size; ?>" autocomplete="off">
                                                                <?php foreach ($whishlist['attribute'] as $key => $value) { ?>
                                                                    <label>
                                                                        <input type="hidden" name="attribute_type_<?= $key ?>" value="<?php echo $value['type_id']; ?>" autocomplete="off">
                                                                        <input type="hidden" name="attribute_value_<?= $key ?>" value="<?php echo $value['value_id']; ?>" autocomplete="off">
                                                                    </label>
                                                                <?php } ?>
                                                                <button type="submit" class="button_wishimg"><img src="<?php echo $whishlist['image']; ?>" alt="" class="img-responsive orderimg"></button>
                                                            </form></a>
                                                                </div>

    <div class="col-lg-10 col-md-10 col-xs-9 col-sm-9 col-9">
    <span class="text-center"><a href="<?php echo base_url(); ?>web/remove_whishlist/<?php echo $whishlist['variant_id']; ?>"class="remove-item1"><i class="fas fa-times"></i></a></span>
      <div class="product-details">
      
        <div data-title="Product Details" class="productname">
     
            <a ><?php echo $whishlist['name']; ?></a>
           
        </div>
        <div class="brandname">
        <a style="opacity: 0.7;">Brand: <?php echo $whishlist['brand']; ?></a>
        </div> 
        <div class="wish_det">
        <?php 
        if(sizeof($whishlist['wish_details'])>1){
         echo '<span>';
         
        
       
         echo '<select class="attributeDropdown" onchange="attributeSelector(this)">';?>
        <?php foreach ($whishlist['wish_details'] as $r) {
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
                       
                         $selected= ($variant_id==$whishlist['variant_id'])?'selected':'';
                        
                        echo '<option 
                           data-userId="'.$whishlist['userid'].'"
                          data-variantId="'.$whishlist['variant_id'].'"
                          data-wishlistId="' .$whishlist['wishlist_id']. '" 
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
    //   }
         echo '</span>';
        }?>
       

<span class="bg-grey"> <?php 
// print_r($whishlist['wish_details'][0]->stock);?>
     <span class="qty1">Qty.</span>
    <select name="quantity" id="quantity<?php echo $value->id; ?>" onchange="checkcart_limit(<?php echo $whishlist['link_variants'][0]['id']; ?>,'single')" class="wish_var">
   
   <?php  $stock =$whishlist['wish_details'][0]->stock;
   $cartlimit=$whishlist['cart_limit'];
   if($stock<$cartlimit){
    $limit=$stock;
}
else{
    $limit = $cartlimit <= 10  || $cartlimit <= $stock? $cartlimit :10;
}
    // $limit = $stock < 10 ? $stock : 10;
    ?>
        <?php for ($i = 1; $i <= $limit; $i++): ?>
            <option value="<?php echo $i; ?>" <?php if ($i == $whishlist['link_variants'][0]['id']) echo 'selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
</span>
</div>
<?php
//  print_r($whishlist['variant_id']);?>

        
       
        <div class="price_wish">
        <span data-title="Price" class="product-price" ><i class="fal fa-rupee-sign"></i> <?php echo $whishlist['saleprice']; ?></span>
        <?php if($whishlist['saleprice']!=$whishlist['price']){?>
        <del data-title="Price" class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $whishlist['price']; ?></del>
        <?php $discount=round(($whishlist['price']-$whishlist['saleprice'])/$whishlist['price']*100);?><span class="discountpercent"><?php echo $discount; ?>% OFF</span>
        <?php }?>
    
    </div>
   
        
        <div class="product-buttons">
        <a onclick="addtocart_wishlist(<?php echo $whishlist['variant_id']; ?>, <?php echo $whishlist['shop_id']; ?>, '<?php echo $whishlist['saleprice']; ?>', document.getElementById('quantity<?php echo $value->id; ?>').value)">Add to Cart</a>

            
        </div>
                        </div></div>
</div>

                                                   
                                                                






















                                                            
                                                                

                                                       
                                                                
                                                   
                                                    <?php
                                                }?>
                                                 
                                             


                                        
                                   
                               
                                          
                            
                    </div>
        </div>
    </div>
</div>



</section>
<!--about section end-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">

    

  function addtocart_wishlist(variant_id, vendor_id, saleprice, quantity)
    {
        var session_vendor_id = $("#vendor_id").val();
        var session_id = '<?= $session_id ?>';
        var user_id = '<?php echo $_SESSION['userdata']['user_id']; ?>';
        //alert(user_id);
        if (user_id == '')
        {
            $("#login_quantity").val(quantity);
            $("#login_vendor_id").val(vendor_id);
            $("#login_session_id").val(session_id);
            $("#login_variant_id").val(variant_id);
            $("#login_saleprice").val(saleprice);
            //$('#loginModal').modal('show');
            showLogin();
            return false;
        } else
        {
            //alert(variant_id); alert(vendor_id); alert(saleprice); alert(quantity); alert(session_vendor_id);

            $('.error').remove();
            var errr = 0;
            $.ajax({
                url: "<?php echo base_url(); ?>web/addtocart",
                method: "POST",
                data: {variant_id: variant_id, vendor_id: vendor_id, saleprice: saleprice, quantity: quantity, session_id: session_id},
                success: function (data)
                {
                    var str = data;
                    var res = str.split("@");
                    if (res[1] == 'success')
                    {
                        $("#vendor_id").val(vendor_id);
                        $("#session_id").val(res[3]);
                        $('#cart_count').html(res[2]);
                        toastr.success("Product added to cart!");
                        $(".not_in_cart_" + variant_id).remove();
                        $(".in_cart_" + variant_id).show();
                        window.location.href = "<?php echo base_url(); ?>web/my_wishlist";
                    } else if (res[1] == 'shopclosed')
                    {
                        toastr.error("Shop Closed!")
                    } else if (res[1] == 'success_quantity')
                    {
                        toastr.success("Quantity increased successfully!");
                         window.location.href = "<?php echo base_url(); ?>web/my_wishlist";
                    } else
                    {
                        toastr.error("OUT OF STOCK!")
                    }
                }
            });
        }
    }

</script>

<script type="text/javascript">

    setTimeout(function () {
        $('.alert-success').fadeOut('slow');
    }, 5000);

    function submitForm() {
//        $('#varient').val(varient_id);
        document.getElementById("radio-form").submit();
    }
    function increaseQuantity()
    {
        var quantity = $("#quantity").val();
        var qty = 1;
        var final = parseInt(qty) + parseInt(quantity);
        $("#quantity").val(final);
    }

    function decreaseQuantity()
    {
        var quantity = $("#quantity").val();
        if (quantity == 1)
        {
            return false;
        } else
        {
            var qty = 1;
            var final = parseInt(quantity) - parseInt(qty);
            $("#quantity").val(final);
        }
    }

    $(document).ready(function(e) {
            // Get the count value from PHP
            var count = <?php echo $data['wish_count'];?>;
            // console.log(count);
            // Check the count and hide/show the div accordingly
            if (count > 0) {
                $('.wish_boarder').show();
                $('.wish-div').show();
                $('.wishcontent').show();
                $('.newcategorybox').show();
                $('.wishlistempty').hide();
            } else {
                $('.wish_boarder').hide();
                $('.wish-div').hide();
                $('.newcategorybox').hide();
                $('.wishcontent').hide();
                $('.wishlistempty').show();
            }
        });

        function attributeSelector(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var variantId = selectedOption.getAttribute('value');
    var price = selectedOption.getAttribute('data-price');
    var user_id = selectedOption.getAttribute('data-userId');
    var salePrice = selectedOption.getAttribute('data-saleprice');
    var wishlistId=selectedOption.getAttribute('data-wishlistId');
    var defaultvar=selectedOption.getAttribute('data-variantId');
    // Create a data object to pass to the AJAX call
    var data = {
        variantId: variantId,
        price: price,
        user_id:user_id,
        salePrice: salePrice,
        wishlistId:wishlistId,
        defaultvar:defaultvar
    };
    // console.log("variant id",variantId);
    // console.log("wishlistId",wishlistId);
    // console.log("price",price);
    // console.log("salePrice",salePrice);
    // console.log("userId",user_id);


    
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>web/selectWishlist", // Change this to the URL of your PHP script
         data: data,
         success: function(response) {
             // Handle the response from the server
             window.location.href = "<?php echo base_url(); ?>web/my_wishlist";
            //  console.log(response);
            // You can update any elements on the page based on the response
        },
       error: function(xhr, status, error) {
             // Handle errors
             console.error(xhr.responseText);
         }
    });
}

</script>

       