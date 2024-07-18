<?php  $this->load->view("web/includes/dashboard_header"); ?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="breadcrumb_content">
          <h3>Bidder Details</h3>
          <ul>
            <li><a href="#">Dashboard</a></li>
            <li>My Bids</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!--breadcrumbs area end-->
<!--about section area -->
<section class="dashboard">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-11">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <?php include 'dashboard_menu.php' ?>
          </div>
          <div class="col-lg-9 col-md-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body bidfulldetails">
                    <strong> Mobile King </strong><br>
                    Dabagardens, Visakhapatnam... <br>
                    <span>Bid Date & Time</span> : 24-03-2020, 11:30 AM <br>
                    <span>Bid Value</span> : <i class="fal fa-rupee-sign"></i> 20000
                  </div>
                </div>
              </div>
            </div>
            <div class="row py-3">
              <div class="col-lg-12">
                <div class="table-responsive" id="no-more-tables">
                  <table class="table table-striped">
                    <thead class="bg-blue text-white">
                      <tr>
                        <th class="product_thumb">Product</th>
                        <th class="product_name">Product Details</th>
                        <th class="product-price">Price</th>
                        <th class="product_quantity">Quantity</th>
                        <th class="product_remove">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-title="Product" class="product_thumb"><a href="#"><img src="assets/img/op-1.jpg" alt="" class="orderimg"></a></td>
                        <td data-title="Product Details" class="product_name"><a href="#">Smart Phone Title</a></td>
                        <td data-title="Price" class="product-price"><i class="fal fa-rupee-sign"></i> 18665.00</td>
                        <td data-title="Quantity" class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="1" type="number"></td>
                        <td data-title="Action" class="product_remove"><a href="#"><i class="fal fa-trash-alt"></i></a></td>
                      </tr>
                      <tr>
                         <td data-title="Product" class="product_thumb"><a href="#"><img src="assets/img/op-1.jpg" alt="" class="orderimg"></a></td>
                        <td data-title="Product Details" class="product_name"><a href="#">Smart Phone Title</a></td>
                        <td data-title="Price" class="product-price"><i class="fal fa-rupee-sign"></i> 18665.00</td>
                        <td data-title="Quantity" class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="1" type="number"></td>
                        <td data-title="Action" class="product_remove"><a href="#"><i class="fal fa-trash-alt"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row justify-content-end pb-5">
              <div class="col-lg-6">
                <div class="coupon_code right">
                  <h3>Bag Totals</h3>
                  <div class="coupon_inner">
                    <div class="cart_subtotal">
                      <p>Bag Value</p>
                      <p class="cart_amount"><i class="fal fa-rupee-sign"></i> 18515.00</p>
                    </div>
                    <div class="cart_subtotal ">
                      <p>Discount</p>
                      <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  1800.00</p>
                    </div>
                     <div class="cart_subtotal ">
                      <p>Bid Value</p>
                      <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  18515.00</p>
                    </div>
                     <div class="cart_subtotal ">
                      <p>Shipping Charges</p>
                      <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  40.00</p>
                    </div>
                    <div class="cart_subtotal">
                      <p class="fz-20">Total</p>
                      <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  36215.00</p>
                    </div>
                    <div class="checkout_btn">
                      <a href="#" class="w-100 text-center">Accept & Pay</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--about section end-->
<?php include 'includes/footer.php'?>