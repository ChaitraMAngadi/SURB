<style>
.links-column {
    /* Add styles for the left column here */
    /* Assuming you want a vertical layout for the links */
    display: flex;
    flex-direction: column;
    
    gap: 45px; /* Adds some spacing between the links */
}
.scrollable-div{
            height: 300px;
            width: 200px;
            overflow-y: scroll;
            background-color:white;
            /* margin:auto;
             */
           
            
         }
      

/* visited link */
/* a:visited {
  color: var(--thm-blue);
} */
a:active{
    color:var(--thm-blue);
}


         .scrollable-div::-webkit-scrollbar {
            width: 5px; /* Set the width of the scrollbar */
            /* background-color: #F5F5F5; Set the background color of the scrollbar */
            position: absolute;
            left: 0; /* Position the scrollbar on the left of the element */
         }
         .scrollable-div::-webkit-scrollbar-thumb {
            background-color: #CDCDCD; /* Set the color of the thumb */
         }
         ::-webkit-scrollbar-track {
            /* background: var(--thm-blue); */

            /* border-radius: 5px; */
         }

</style>


<!-- <ul class="dashboardlist d-none d-lg-block">
  <li <?php if ($page == 'my_account.php') { ?>class="active"<?php } ?>><a href="my_account.php"><i class="fal fa-user-tag"></i> My Account</a></li>
  <li <?php if ($page == 'my_orders.php') { ?>class="active"<?php } ?>><a href="my_orders.php"><i class="fal fa-list-ul"></i> My Orders</a></li>
  <li <?php if ($page == 'my_bids.php') { ?>class="active"<?php } ?>><a href="my_bids.php"><i class="fal fa-badge-percent"></i> My Bids</a></li>
  <li <?php if ($page == 'my_wishlist.php') { ?>class="active"<?php } ?>><a href="my_wishlist.php"><i class="fal fa-heart"></i> My Wishlist</a></li>
  <li <?php if ($page == 'my_addressbook.php') { ?>class="active"<?php } ?>><a href="my_addressbook.php"><i class="fal fa-address-book"></i> My Addressbook</a></li>
  <li <?php if ($page == 'my_profile.php') { ?>class="active"<?php } ?>><a href="my_profile.php"><i class="fal fa-user"></i> My Profile</a></li>
  <li <?php if ($page == 'become_a_vendor.php') { ?>class="active"<?php } ?>><a href="become_a_vendor.php"><i class="fal fa-store"></i> Become a Vendor</a></li>
  <li><a href="#"><i class="fal fa-sign-out"></i> Logout</a></li>
</ul> -->
<button class="btn btn-primary d-lg-none d-md-block d-sm-block d-block mb-3" type="button" data-toggle="collapse" data-target="#dashMenu" aria-expanded="false" aria-controls="collapseExample">
    Dashboard Menu
</button>
<!-- <div class="collapse show d-lg-block" id="dashMenu">
    <ul class="dashboardlist">
      <li <?php if ($page == 'myaccount') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/myaccount"><i class="fal fa-user-tag"></i> My Dashboard</a></li>-->
        <!-- <li <?php if ($page == 'myorders') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/my_orders"><i class="fal fa-list-ul"></i> My Orders</a></li>
        <li <?php if ($page == 'mywishlist') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/my_wishlist"><i class="fal fa-heart"></i> My Wishlist</a></li>
        <li <?php if ($page == 'myaddressbook') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/my_addressbook"><i class="fal fa-address-book"></i> My Addressbook</a></li>
        <li <?php if ($page == 'myprofile') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/myprofile"><i class="fal fa-user"></i> My Profile</a></li>
        <li <?php if ($page == 'change_password') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/change_password"><i class="fal fa-cog"></i> Change Password</a></li> -->
<!--        <li <?php if ($page == 'becomeavendor') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>web/become_a_vendor"><i class="fal fa-store"></i> Become a Vendor</a></li>-->
        <!-- <li><a href="<?php echo base_url(); ?>web/logout"><i class="fal fa-sign-out"></i> Logout</a></li>
    </ul>
</div> --> 
<div class="col-lg-2 scrollable-div links-column" id="dashMenu">
  <div class="scrolllink">
		<a href="<?= base_url('web/myprofile') ?>" > <img src="<?php echo base_url(); ?>uploads/images/person.svg" alt="noimg" width= "20px"
height=" 20px" class="linked-img" style="margin-right:10px;">
<img src="<?php echo base_url(); ?>uploads/images/active-profile.svg" alt="noimg" width= "20px"
height=" 20px" class="linked-img-active" style="margin-right:10px;display:none">
 Profile</a></div>
 <div class="scrolllink">
                    <a href="<?= base_url('web/my_addressbook') ?>" ><img src="<?php echo base_url(); ?>uploads/images/manageaddress.svg" alt="noimg" width= "20px"
height=" 20px" class="linked-img" style="margin-right:10px;"><img src="<?php echo base_url(); ?>uploads/images/active-address.svg" alt="noimg" width= "20px"
height=" 20px" class="linked-img-active" style="margin-right:10px;display:none" > Manage Address</a></div>
<div class="scrolllink">
                    <a href="<?= base_url('web/checkout') ?>" ><img src="<?php echo base_url(); ?>uploads/images/cart.svg" alt="noimg" width= "18px"
height=" 18px" class="linked-img" style="margin-right:10px;"><img src="<?php echo base_url(); ?>uploads/images/active-cart.svg" alt="noimg" width= "18px"
height=" 18px" class="linked-img-active" style="margin-right:10px;display:none"> My Cart</a></div>
<div class="scrolllink">
                    <a href="<?= base_url('web/my_wishlist') ?>" ><img src="<?php echo base_url(); ?>uploads/images/wishicon.svg" alt="noimg" width= "18px"
height=" 18px" class="linked-img" style="margin-right:10px;"><img src="<?php echo base_url(); ?>uploads/images/active-wishlist.svg" alt="noimg" width= "18px"
height=" 18px" class="linked-img-active" style="margin-right:10px;display:none"> My Wishlist</a></div>
<div class="scrolllink">
<a href="<?= base_url('web/my_orders') ?>" ><img src="<?php echo base_url(); ?>uploads/images/Myorders.svg" alt="noimg" width= "20px"
height=" 20px" class="linked-img" style="margin-right:10px;">
<img src="<?php echo base_url(); ?>uploads/images/active-orders.svg" alt="noimg" width= "20px"
height=" 20px" class="linked-img-active" style="margin-right:10px;display:none"> My Orders</a></div>
<?php $user_qry = $this->db->query("select * from users where id='".$user_id."'");
$user_qry_res = $user_qry->row();
$date=date('Y-m-d');
$user_expiry_date = ($user_qry_res->expiry_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->expiry_member_date)) : null;

$user_created_date = ($user_qry_res->created_member_date != null) ? date('Y-m-d', strtotime($user_qry_res->created_member_date)) : null;
// print_r($user_qry_res);
?>
 <?php 
                       if (($user_expiry_date != null && $user_expiry_date >= $date && $user_qry_res->expiry_member_date!='') && 
                       ($user_created_date != null && $user_created_date <= $date && $user_qry_res->created_member_date!='')&& $user_qry_res->membership=='yes' && $user_qry_res->plan!=0 && $user_qry_res->plan!=''&& $user_qry_res->plan!=null&& $user_qry_res->plan!='0' ) {?>
<div class="scrolllink">
<a href="<?= base_url('web/membership') ?>" ><img src="<?php echo base_url(); ?>uploads/images/membership.png" alt="noimg" width= "20px"
height=" 20px" class="linked-img" style="margin-right:10px;">
<img src="<?php echo base_url(); ?>uploads/images/membership.png" alt="noimg" width= "20px"
height=" 20px" class="linked-img-active" style="margin-right:10px;display:none"> Membership</a></div>
<?php }?>
		 </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script>
document.addEventListener("DOMContentLoaded", function() {
    var buttons = document.querySelectorAll(".scrolllink");
    var url = window.location.href;

    buttons.forEach(function(button) {
        var buttonUrl = button.querySelector('a').getAttribute('href');
        if (url.includes(buttonUrl)) {
            activateButton(button);
        }

        button.addEventListener("click", function() {
            activateButton(button);
        });
    });

    function activateButton(button) {
        buttons.forEach(function(btn) {
            btn.style.color = "";
            var img = btn.querySelector('.linked-img');
            var activeImg = btn.querySelector('.linked-img-active');
            img.style.display = "";
            activeImg.style.display = "none";
        });

        button.style.color = "#2556B9";
        var img = button.querySelector('.linked-img');
        var activeImg = button.querySelector('.linked-img-active');
        img.style.display = "none";
        activeImg.style.display = "";
    }
});



</script>

