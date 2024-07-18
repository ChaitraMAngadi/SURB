<?php include 'includes/subpage_header.php'?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_content">
					<h3>Order Review</h3>
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
						<?php include 'steps_menu.php'?> 
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<table class="table table-striped">
							<thead class="bg-dark text-white">
								<tr>
								<th>Product Name</th>
								<th>Price</th>
								<th>Qty.</th>
								<th>Sub Total</th>
							   </tr>
							</thead>
							<tr>
								<td>Product Title</td>
								<td><i class="fal fa-rupee-sign"></i> 13000/-</td>
								<td>1</td>
								<td><i class="fal fa-rupee-sign"></i> 13400</td>
							</tr>
							<tr>
								<td>Product Title</td>
								<td><i class="fal fa-rupee-sign"></i> 13000/-</td>
								<td>1</td>
								<td><i class="fal fa-rupee-sign"></i> 13400</td>
							</tr>
							<tr>
								<td>Product Title</td>
								<td><i class="fal fa-rupee-sign"></i> 13000/-</td>
								<td>1</td>
								<td><i class="fal fa-rupee-sign"></i> 13400</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right"><strong>Grand Total :</strong></td>
								<td><i class="fal fa-rupee-sign"></i> 11899</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<a href="payment.php" class="btn btn-address">CONFIRM ORDER</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'includes/footer.php'?>