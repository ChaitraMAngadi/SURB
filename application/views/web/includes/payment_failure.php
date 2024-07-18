<section class="breadcrumb-area" style="background: url(<?= base_url()?>assets/images/breadcrumb-bg.jpg)no-repeat; background-size: cover;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-content">
					<h1 class="breadcrumb-hrading">Payment Failure</h1>
					<ul class="breadcrumb-links">
                                            <li><a href="<?= base_url()?>">Home</a></li>
						<li>Try Again</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- cart area start -->
<div class="cart-main-area mtb-60px">
    <div class="container" id="thank_you">
		<!-- <h3 class="cart-page-title">Your cart items</h3> -->
		<a href="<?= base_url()?>" style="margin-bottom:20px;"><button class="cart-btn-2" type="button">Continue Shopping</button></a>
		<h1 class="breadcrumb-hrading">Payment Failure</h1>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.error('Something went wrong. Your payment failed.');
    setTimeout(function(){
      location.href = '<?= base_url() ?>';
    },2000);
</script>    