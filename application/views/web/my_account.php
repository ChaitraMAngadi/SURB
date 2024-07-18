<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>My Dashboard</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
                        <li>My Dashboard</li>
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
                            <div class="col-lg-12">
                                <h2>Welcome User</h2>
                                <p><i class="fal fa-clock"></i> Last Login & Date :<?php echo $data['login_time']; ?></p>
                            </div>
                        </div><hr>
                        <div class="row justify-content-between">

                            <div class="col-lg-3 col-md-12">
                                <div class="card mb-2">
                                    <div class="card-body pb-0">
                                        <div class="d-flex myaccioc">
                                            <a href="<?php echo base_url(); ?>web/my_orders/total_orders"><div class="col-4"><i class="fal fa-list-ul"></i></div></a>
                                            <a href="<?php echo base_url(); ?>web/my_orders/total_orders"><div class="col-auto icon-text ml-2">
                                                    <h5>Total Orders</h5>
                                                    <h2><?php echo $data['order_total']; ?></h2>
                                                </div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card mb-2">
                                    <div class="card-body pb-0">
                                        <div class="d-flex myaccioc">
                                            <a href="<?php echo base_url(); ?>web/my_orders/ongoing_orders"><div class="col-4"><i class="fal fa-list-ul"></i></div></a>
                                            <a href="<?php echo base_url(); ?>web/my_orders/ongoing_orders"><div class="col-auto icon-text ml-2">
                                                    <h5>Ongoing Orders</h5>
                                                    <h2><?php echo $data['ongoing_orders']; ?></h2>
                                                </div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card mb-2">
                                    <div class="card-body pb-0">
                                        <div class="d-flex myaccioc">
                                            <a href="<?php echo base_url(); ?>web/my_orders/completed_orders"><div class="col-4"><i class="fal fa-list-ul"></i></div></a>
                                            <a href="<?php echo base_url(); ?>web/my_orders/completed_orders"><div class="col-auto icon-text ml-2">
                                                    <h5>Completed Orders</h5>
                                                    <h2><?php echo $data['completed_orders']; ?></h2>
                                                </div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card mb-2">
                                    <div class="card-body pb-0">
                                        <div class="d-flex myaccioc">
                                            <a href="<?php echo base_url(); ?>web/my_orders/cancelled_orders"><div class="col-4"><i class="fal fa-list-ul"></i></div></a>
                                            <a href="<?php echo base_url(); ?>web/my_orders/cancelled_orders"><div class="col-auto icon-text ml-2">
                                                    <h5>Cancelled Orders</h5>
                                                    <h2><?php echo $data['cancelled_orders']; ?></h2>
                                                </div></a>
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