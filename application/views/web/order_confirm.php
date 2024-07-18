<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_content">
					<h3>Order Confirm</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumbs area end-->
<div class="shopping_cart_area pb-100" style="min-height: 400px">
	<div class="container">
		<div class="row pb-5 justify-content-center">
<!--			<div class="col-lg-10 col-md-10">
				<?php include 'steps_menu.php'?> 
			</div>-->
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<img src="<?php echo base_url(); ?>web_assets/img/checkmark.gif" alt="" width="80" height="80">
				<h3 class="pt-3">Order placed, Thank you!</h3>
				<p>We will notify you once the order is shipped</p>
				<?php if(!empty($user_id)){?>
				<div>
				<h4> Order ID : &nbsp;<small><?= $order_latest->session_id ?></small></h4>
				<h4> Transaction ID : &nbsp;<small><?= $order_latest->pay_transaction_id ?></small></h4>
				<h4> Order Date : &nbsp;<small><?= date('Y-m-d h:i A',strtotime($order_latest->created_date)) ?></small></h4>
			    </div>
			    <br> 
			<?php } ?>

				<a href="<?php echo base_url(); ?>web" class="btn_continue">Continue Shopping</a>
			</div>
		</div>
	</div>
</div>