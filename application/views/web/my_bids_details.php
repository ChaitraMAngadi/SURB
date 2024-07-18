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
                <?php if($bids['order_status']=='Ongoing'){ ?>
                <div style="padding: 10px; float: right;">
                     <a href="javascript:0;" class="btn btn-sm btn-danger" onclick="cancelBid('<?php echo $bids['id'];?>')"> Cancel Bid</a>
                </div>
              <?php } ?>
               

                <table class="table table-striped">

                  <?php //print_r($bids); ?>
                  <tr>
                    <th colspan="2" class="bg-blue text-center"><h3 class="text-white">Bid Details</h3></th>
                  </tr>
                  <tr>
                    <td>Bid ID</td>
                    <td><strong>#<?php echo $bids['id'];?></strong></td>
                  </tr>
                   <tr>
                    <td>Bid Items</td>
                    <td><?php echo $bids['total_products'];?></td>
                  </tr>
                   <tr>
                    <td>Current Bid Status</td>
                    <td><span class="btn btn-sm btn-warning"><?php echo $bids['bid_status'];?></span></td>
                  </tr>
                   <tr>
                    <td>Current Bid's Received</td>
                    <td><?php echo $bids['recived_quotes'];?></td>
                  </tr>
                   <tr>
                    <td>Lower Bid Value</td>
                    <td><?php echo $bids['lowest_bid'];?></td>
                  </tr>
                  <tr>
                    <td align="right">Bag Value :</td>
                    <td><i class="fal fa-rupee-sign"></i> <strong><?php echo $bids['total_price'];?></strong></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="row pt-3">
              <div class="col-lg-12">
                <h3 class="text-center pb-2">Products List</h3>
                <div class="table-responsive" id="no-more-tables">
                 <table class="table table-striped">
                    <thead class="bg-blue text-white">
                      <tr>
                        <th>Products</th>
                        <th>QTY</th>
                        <th>Price</th>
                      </tr>
                      </thead>
                      <tbody>
                    <?php foreach($bids['products'] as $bidsvalues){ 
                              //print_r($bidsvalues['attributes']);
                      ?>
                        <tr>
                        <td data-title="Bidder's Details" class="text-left">
                          <img src="<?php echo $bidsvalues['image']; ?>" style="width: 30%;"><br>
                          <strong><?php echo $bidsvalues['product_name']; ?></strong> <br>
                          <?php foreach($bidsvalues['attributes'] as $arttr){ ?>
                            <div>
                              <p><b><?php echo $arttr['title']; ?> :</b> <?php echo $arttr['value']; ?></p>
                            </div>
                          <?php } ?><br>
                          <small>Seller: <?php echo $bidsvalues['shop_name']; ?></small>
                          
                        </td>
                        <td data-title="Bid Date and Time"><?php echo $bidsvalues['quantity']; ?></td>
                        <td data-title="Bid Value"><i class="fal fa-rupee-sign"></i> <strong><?php echo $bidsvalues['price']; ?></strong></td>
                        
                      </tr>

                    <?php } ?>
                       
                      </tbody>
                      
                    </table>
                </div>
              </div>
            </div>



            <div class="row pt-3">
              <div class="col-lg-12">
                <h3 class="text-center pb-2">Bidder's Lists</h3>
                <div class="table-responsive" id="no-more-tables">
                 <table class="table table-striped">
                    <thead class="bg-blue text-white">
                      <tr>
                        <th>Bidder's Details</th>
                        <th>Bid Date and Time</th>
                        <th>Bid Value</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                    <?php 
                       //print_r($bidsdata);
                    foreach($bids['bidders_list'] as $bidsdata){ 
                            //print_r($bidsdata); die;
                      ?>
                        <tr>
                        <td data-title="Bidder's Details" class="text-left">
                          <strong><?php echo $bidsdata['shop_name']; ?></strong> <br>
                          <small><?php echo $bidsdata['address']; ?></small>
                        </td>
                        <td data-title="Bid Date and Time"><?php echo $bidsdata['date']; ?></td>
                        <td data-title="Bid Value"><i class="fal fa-rupee-sign"></i> <strong><?php echo $bidsdata['bid_value']; ?></strong></td>
                        <?php if($is_delivered==0){?>
                        <td data-title="Action"><a href="/web/my_bidder_full_details/<?php echo $bids['id'];?>/<?= $bidsdata['vendor_id'] ?>" class="btn btn-outline-success btn-sm text-nowrap">Accept Bid</a></td>
                        <?php }if($is_delivered==1){?>
                          <td data-title="Action"><a href="javascript:0;" class="btn btn-sm btn-success"> Accepted</a></td>
                        <?php }?>
                        <?php if($is_delivered==2){?>
                          <td data-title="Action"><a href="javascript:0;" class="btn btn-sm btn-success"> Completed</a></td>
                        <?php }?>
                        <?php if($is_delivered==3){?>
                          <td data-title="Action"><a href="javascript:0;" class="btn btn-sm btn-success"> Cancelled</a></td>
                        <?php }?>
                      </tr>

                    <?php } ?>
                       
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

<script type="text/javascript">
  function cancelBid(bidid){
        var id = $(this).parents("tr").attr("id");

       swal({

        title: "Are you sure?",

        text: "You want to Cancel this Bid",

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: "Yes",

        cancelButtonText: "Cancel",

        closeOnConfirm: false,

        closeOnCancel: false

      },

      function(isConfirm) {

        if (isConfirm) {

                  $.ajax({
                    url:"<?php echo base_url(); ?>web/createBid",
                    method:"POST",
                    data:{bidid:bidid},
                    success:function(data)
                    {
                        var str = data;
                        var res = str.split("@");
                        if(res[1]=='success')
                        {
                               swal("Bid Cancelled Successfully")
                               window.location.href = "<?php echo base_url(); ?>web/my_bids_details/"+bidid;
                        }
                        else 
                        {
                              swal("Something went Wrong, Please try again")
                        }
                    }
                   });
                

        } else {

          swal("Cancelled", "", "error");

        }

      });

     

    }

</script>
<!--about section end-->