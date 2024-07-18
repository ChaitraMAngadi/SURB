<?php $this->load->view("web/includes/header_styles"); ?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>My Orders</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
                        <li>My Orders</li>
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
                    <div class="col-lg-3 col-md-12">
                        <?php include 'dashboard_menu.php' ?>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="row pb-5">
                            <div class="col-lg-12 col-md-12">
                                <?php $this->load->view("web/steps_menu"); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive" id="no-more-tables">

                                    <table class="table table-striped">
                                        <thead class="bg-blue text-white">
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Payment Status</th>
                                                <th>Price</th>
<!--                                                <th>Seller</th>-->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($orders['orders']) > 0) {
                                                foreach ($orders['orders'] as $ord) {
                                                    ?>
                                                    <tr>
                                                        <td data-title="Product Image">#<?php echo $ord['id']; ?></td>
                                                        <td data-title="Product Details" class="text-left"><?php echo $ord['payment_status_name']; ?></td>


                                                        <td data-title="Price"><i class="fal fa-rupee-sign"></i> <?php echo $ord['amount']; ?></td>


        <!--                                                        <td data-title="Seller"><small class="text-muted"><?php echo $ord['vendor_name']; ?></small></td>-->
                                                        <td data-title="Status"><a class="btn btn-sm btn-primary"> <?php echo $ord['service_status']; ?> </a></td>
                                                        <td data-title="Status"><a href="<?php echo base_url(); ?>web/orderview/<?php echo $ord['id']; ?>" class="btn btn-sm btn-success">View </a></td>

                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>

                                                <tr>
                                                    <td colspan="6">
                                                        <img src="<?php echo base_url(); ?>/uploads/my_order.png" style="width: 150px">
                                                        <h4 style="text-align: center;">No Orders </h4>
                                                    </td>
                                                </tr>
<?php } ?>
                                <!--  <tr>
                                   <td data-title="Product Image"><img src="assets/img/op-2.jpg" alt="" class="orderimg"></td>
                                   <td data-title="Product Details" class="text-left">Product Title <br>6 GB Ram</td>
                                   <td data-title="Price"><i class="fal fa-rupee-sign"></i> 12000</td>
                                   <td data-title="Seller"><small class="text-muted"> Cell Point</small></td>
                                    <td data-title="Status"><a href="#" class="btn btn-sm btn-success"> Ongoing</a></td>
                                 </tr>
                                 <tr>
                                   <td data-title="Product Image"><img src="assets/img/op-3.jpg" alt="" class="orderimg"></td>
                                   <td data-title="Product Details" class="text-left">Product Title <br>6 GB Ram</td>
                                   <td data-title="Price"><i class="fal fa-rupee-sign"></i> 12000</td>
                                   <td data-title="Seller"><small class="text-muted">Cell Point</small></td>
                                   <td data-title="Status"><a href="#" class="btn btn-sm btn-danger"> Ongoing</a></td>
                                 </tr> -->
                                        </tbody>
                                    </table>
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
<?php include 'includes/footer.php' ?>