<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="breadcrumb_content">
          <h3>My Bids</h3>
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
              <div class="col-lg-12">
                <div class="table-responsive-md table-responsive-sm" id="no-more-tables">
                    <table class="table table-striped">
                     <thead class="bg-blue text-white">
                        <tr>
                          <th>Bid ID</th>
                          <th>Bid <br>Items</th>
                          <th>Current Bid <br>Status</th>
                          <th>Current Bid's <br>Received</th>
                          <th>Lower Bid <br>Value</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php foreach($bids as $bid){  ?>
                       <tr>
                       <td data-title="Bid ID"><?php echo $bid['id']; ?></td>
                       <td data-title="Bid Items"><?php echo $bid['total_products']; ?></td>
                       <td data-title="Current Bid Status"><?php echo $bid['bid_status']; ?></td>
                       <td data-title="Current Bid's Received"><?php echo $bid['recived_quotes']; ?></td>
                       <td data-title="Lower Bid Value"><?php echo $bid['lowest_bid']; ?></td>
                       <td data-title="Status"><a href="#" class="btn btn-sm btn-success"> <?php echo $bid['order_status']; ?></a></td>
                       <td data-title="Action"><a href="<?php echo base_url(); ?>web/my_bids_details/<?php echo $bid['id']; ?>" class="btn btn-outline-info btn-sm text-nowrap"><i class="fal fa-eye"></i> View</a></td>
                     </tr>
                      <?php } ?>
                      <!-- <tr>
                       <td data-title="Bid ID">Ret001</td>
                       <td data-title="Bid Items">40</td>
                       <td data-title="Current Bid Status">Waiting for Bid</td>
                       <td data-title="Current Bid's Received">0</td>
                       <td data-title="Lower Bid Value">N/A</td>
                       <td data-title="Status"><a href="#" class="btn btn-sm btn-success"> Completed</a></td>
                       <td data-title=""><a href="my_bids_details.php" class="btn btn-outline-info btn-sm text-nowrap"><i class="fal fa-eye"></i> View</a></td>
                     </tr>
                      <tr>
                      <td data-title="Bid ID">Ret001</td>
                       <td data-title="Bid Items">40</td>
                       <td data-title="Current Bid Status">Waiting for Bid</td>
                       <td data-title="Current Bid's Received">0</td>
                       <td data-title="Lower Bid Value">N/A</td>
                       <td data-title="Status"><a href="#" class="btn btn-sm btn-danger"> Cancelled</a></td>
                       <td data-title=""><a href="my_bids_details.php" class="btn btn-outline-info btn-sm text-nowrap"><i class="fal fa-eye"></i> View</a></td>
                     </tr>
                      <tr>
                       <td data-title="Bid ID">Ret001</td>
                       <td data-title="Bid Items">40</td>
                       <td data-title="Current Bid Status">Waiting for Bid</td>
                       <td data-title="Current Bid's Received">0</td>
                       <td data-title="Lower Bid Value">N/A</td>
                       <td data-title="Status"><a href="#" class="btn btn-sm btn-danger"> Cancelled</a></td>
                       <td data-title=""><a href="my_bids_details.php" class="btn btn-outline-info btn-sm text-nowrap"><i class="fal fa-eye"></i> View</a></td>
                     </tr>
                     <tr>
                       <td data-title="Bid ID">Ret001</td>
                       <td data-title="Bid Items">40</td>
                       <td data-title="Current Bid Status">Waiting for Bid</td>
                       <td data-title="Current Bid's Received">0</td>
                       <td data-title="Lower Bid Value">N/A</td>
                       <td data-title="Status"><a href="#" class="btn btn-sm btn-success"> Completed</a></td>
                       <td data-title=""><a href="my_bids_details.php" class="btn btn-outline-info btn-sm text-nowrap"><i class="fal fa-eye"></i> View</a></td>
                     </tr>
                      <tr>
                      <td data-title="Bid ID">Ret001</td>
                       <td data-title="Bid Items">40</td>
                       <td data-title="Current Bid Status">Waiting for Bid</td>
                       <td data-title="Current Bid's Received">0</td>
                       <td data-title="Lower Bid Value">N/A</td>
                       <td data-title="Status"><a href="#" class="btn btn-sm btn-danger"> Cancelled</a></td>
                       <td data-title=""><a href="my_bids_details.php" class="btn btn-outline-info btn-sm text-nowrap"><i class="fal fa-eye"></i> View</a></td>
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