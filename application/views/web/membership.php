
<!--breadcrumbs area start-->
<div class="breadcrumbs_area mb-3 breads">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <!-- <h3>My Profile</h3> -->
<!--                    <ul>
                        <li><a href="<?php echo base_url(); ?>web">Dashboard</a></li>
                        <li>My Profile</li>
                    </ul>-->
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
<section class="dashboard">
    <div class="container">
        <div class="row">
                    <div class="col-lg-2 col-md-12 my_profile">
                        <?php include 'dashboard_menu.php' ?>
                    </div>
                    <div class="col-lg-10 col-md-12 member">
                    <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            
                            <div class="input-group mb-3">
                            <span style="color:#2556B9">
                                Memeber on:<?php echo $user->created_member_date; ?>
                             </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            
                            <div class="input-group mb-3">
                                <!-- <span class="input-group-text"><i class="fal fa-user"></i></span> -->
                                <span style="color:#2556B9">
                                Expiry date:<?php echo $user->expiry_member_date; ?>
                             </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 member-flex">
                    <?php   


                    $date=date('Y-m-d');


                    $user_expiry_date = ($user->expiry_member_date != null) ? date('Y-m-d', strtotime($user->expiry_member_date)) : null;


                    $user_created_date = ($user->created_member_date != null) ? date('Y-m-d', strtotime($user->created_member_date)) : null;
                    // echo $user_created_date;
                    if (($user_expiry_date != null && $user_expiry_date >= $date && $user->expiry_member_date!='') && 
                        ($user_created_date != null && $user_created_date <= $date && $user->created_member_date!='')&& $user->membership=='yes' && $user->plan!=0 && $user->plan!=''&& $user->plan!=null&& $user->plan!='0' ) {
                        // Your code if the condition is true


                           
                           ?>
                   
                            
                            <?php
                            $current_timestamp = time();

                            // Convert the expiry date to a timestamp
                            $expiry_timestamp = strtotime($user_expiry_date);
                            
                            // Calculate the difference in seconds
                            $difference_seconds = $expiry_timestamp - $current_timestamp;
                            
                            // Convert seconds to days
                            $days_difference = ceil($difference_seconds / (60 * 60 * 24));
                            
                            // echo "Days remaining until expiry: " . $days_difference;
                            ?>
                           <?php if ($days_difference <= 7) {?>

                            <div>
                                <?php 
                                // print_r($user);?>
                                <form method="post" class="form-horizontal" action="<?= base_url();?>web/renewal" enctype="multipart/form-data">
                                    <input type="hidden" value="<?php echo $user->plan;?>" name="renewal" id="renewal">
                                    <input type="hidden" value="<?php echo $user->phone;?>" name="cust_phone" id="cust_phone">
                               <button type="submit" class="button" style="color:#2556B9;background:white;border:1px solid #2556B9;border-radius:15px;font-weight:bold;"> Renew Now </button>
                                </form>
                            </div>
                            <div>
                            
                               <button type="button" class="button" data-toggle="modal" title="Prime Membership" data-target="#PrimeModal" id="prime" style="color:#2556B9;background:white;border:1px solid #2556B9;border-radius:15px;font-weight:bold;"> Change Plan </button>
                                <div class="modal fade" id="PrimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 10001;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Prime Plans</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" id="prime_member" onsubmit="return memberform()" action="<?= base_url();?>web/changePlan">
                                                    <div class="row">
                                                        <?php foreach($prime as $p){ ?>
                                                            <div class="col-md-12">
                                                                <div class="card mb-4">
                                                                    <div class="card-body">
                                                                        <h6 class="card-title"> <?php if($p->image != '') { ?>
                                                                        <div class="coup_image col-12 justify-center">
                                                                            <img src="<?php echo base_url(); ?>uploads/prime/<?php echo $p->image;?>" class="centered-image" />
                                                                        </div>
                                                                        <?php } else{ echo $p->Name; }?></h6>
                                                                        <p class="card-text"><?php echo $p->Description;?></p>
                                                                        <div class="form-check">
                                                                            <input type="hidden" value="<?php echo $user->phone;?>" name="custmer_phone" id="custmer_phone">
                                                                            <input class="form-check-input buttonradio2" type="radio" name="options" id="option_<?php echo $p->value;?>" value="<?php echo $p->value;?>" >
                                                                            <label class="form-check-label" for="option_<?php echo $p->value;?>"><?php echo $p->Name;?></label>
                                                                            <?php 
                                                                            // print_r($p->value);?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <button type="submit" class="btn btn-block prime_btn">Buy Plan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div><?php }}?>

                    </div>
                    </div>
                    </div>
</div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function memberform() {   
    var selectedOption = $("input[name='options']:checked").val();
    console.log("selected option", selectedOption);

    if (selectedOption === undefined) {
        toastr.error('Select at least one option from the list to proceed');
        return false; // No option is selected
    } 
    // No need for else block here because if an option is selected, the function will continue execution
}
</script>

<!--about section end-->