<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class User_api extends REST_Controller {

    public function __construct() 
    { 
      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        //load user model
        $this->load->model('user');
        //$this->load->library('email'); 
    }

    public function user_post() {
       $userData = array();

       if($this->post('action')=='user_registration')
       {
              $first_name = $this->post('first_name');
              $last_name = $this->post('last_name');
              $email = $this->post('email');
              $password = md5($this->post('password'));
              $phone = $this->post('phone');
              $token = $this->post('token');

              if($token=='' || $token==null || $token==undefined)
              {
                $token1="";
              }
              else
              {
                $token1=$token;
              }
              
              $data = array('first_name' =>$first_name,'last_name' =>$last_name, 'email' =>$email, 'password' =>$password,'phone'=>$phone,'token'=>$token,'loginstatus'=>'normal');
               $chk = $this->user->doRegister($data);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='resend_otp')
       {
               $user_id = $this->post('user_id');
               $chk = $this->user->resendOTP($user_id);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='social_login')
       {
              $username = $this->post('username');
              $email = $this->post('email');
              $loginstatus = $this->post('loginstatus');

              $data = array('first_name' =>$username,'email' =>$email,'loginstatus'=>$loginstatus);
               $chk = $this->user->doFacebookRegister($data);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='otp_verification')
       {
              $user_id = $this->post('user_id');
              $otp = $this->post('otp');
               $chk = $this->user->verify_OTP($user_id,$otp);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='login')
       {
              $username = $this->post('username');
              $password = md5($this->post('password'));
              $token = $this->post('token');
               $chk = $this->user->checkLogin($username,$password,$token);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='forgotpassword')
       {
              $phone = $this->post('phone');
               $chk = $this->user->checkForgot($phone);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
        else if($this->post('action')=='resetPassword')
       {
              $otp = $this->post('otp');
              $password = $this->post('password');
              $phone = $this->post('phone');
               $chk = $this->user->resetPassword($phone,$otp,$password);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='add_useraddress')
       {
              $user_id = $this->post('user_id');
              $name = $this->post('name');
              $mobile = $this->post('mobile');
              $address = $this->post('address');
              $city = $this->post('city');
              $state = $this->post('state');
              $pincode = $this->post('pincode');
              $address_type  = $this->post('address_type');
              $landmark  = $this->post('landmark');
               $chk = $this->user->addAddress($user_id,$name,$mobile,$address,$city,$state,$pincode,$address_type,$landmark);
             
                  $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='edit_useraddress')
       {
            $address_id = $this->post('aid');
              $user_id = $this->post('user_id');
              $name = $this->post('name');
              $mobile = $this->post('mobile');
              $address = $this->post('address');
              $city = $this->post('city');
              $state = $this->post('state');
              $pincode = $this->post('pincode');
              $address_type  = $this->post('address_type');

               $chk = $this->user->editUseraddress($address_id,$user_id,$name,$mobile,$address,$city,$state,$pincode,$address_type);
             
                  $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='update_useraddress')
       {
            $address_id = $this->post('address_id');
              $user_id = $this->post('user_id');
              $name = $this->post('name');
              $mobile = $this->post('mobile');
              $address = $this->post('address');
              $locality = $this->post('locality');
              $city = $this->post('city');
              $state = $this->post('state');
              $pincode = $this->post('pincode');
              $address_type  = $this->post('address_type');

               $chk = $this->user->updateAddress($address_id,$user_id,$name,$mobile,$address,$locality,$city,$state,$pincode,$address_type);
             
                  $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getstates')
       {
              $chk = $this->user->getstates();
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='gethomepagecities')
       {
              $chk = $this->user->getHomeCities();
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getselectedcities')
       {
              $state = $this->post('state');
              $chk = $this->user->getSelectedCities($state);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='getlocationpincodes')
       {
              $city_id = $this->post('city');
              $chk = $this->user->getselectedPincodes($city_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
       else if($this->post('action')=='saveUserhomeLocation')
       {
              $user_id = $this->post('user_id');
              $state = $this->post('state');
              $city_id = $this->post('city_id');
              $pincode = $this->post('pincode');
              $chk = $this->user->saveUserHomeLocation($user_id,$city_id,$state,$pincode);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='checkLocationpageCondition')
       {
              $user_id = $this->post('user_id');
              $chk = $this->user->checkLocationCondition($user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
       else if($this->post('action')=='getcities1')
       {
              $state_id = $this->post('state_id');
              $shopId = $this->post('shopId');
              $chk = $this->user->getCities1($state_id,$shopId);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='geteditcities1')
       {
              $state_id = $this->post('state_id');
              $chk = $this->user->getEditCities1($state_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
        else if($this->post('action')=='getpincodes')
       {
              $state_id = $this->post('state_id');
              $city_id = $this->post('city_id');
              $vendor_id = $this->post('vendor_id');
              $chk = $this->user->getPincodes($state_id,$city_id,$vendor_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='add_cartaddress')
       {
              $user_id = $this->post('user_id');
              $name = $this->post('name');
              $mobile = $this->post('mobile');
              $address = $this->post('address');
              $city = $this->post('city');
              $state = $this->post('state');
              $pincode = $this->post('pincode');
              $address_type  = $this->post('address_type');
              $landmark  = $this->post('landmark');
              $vendor_id  = $this->post('vendor_id');
               $chk = $this->user->addCartAddress($user_id,$name,$mobile,$address,$city,$state,$pincode,$address_type,$landmark,$vendor_id);
             
                  $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='shopwiseProductSearch')
       {
              $cat_id = $this->post('cat_id');
              //$shop_id = $this->post('shop_id');
              $user_id = $this->post('user_id');
              //$subcat_id = $this->post('subcat_id');
              $start_from = $this->post('start_from');
              $perpage = $this->post('perpage');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $keyword = $this->post('keyword');
              $chk = $this->user->shopWiseProductSearch($cat_id,$user_id,$start_from,$perpage,$lat,$lng,$keyword);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getuserpincodes')
       {
              $state_id = $this->post('state_id');
              $city_id = $this->post('city_id');
              $chk = $this->user->getuserPincodes($state_id,$city_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getareas')
       {
              $state_id = $this->post('state_id');
              $city_id = $this->post('city_id');
              $vendor_id = $this->post('vendor_id');
              $pincode = $this->post('pincode');
              $chk = $this->user->getAreas($state_id,$city_id,$vendor_id,$pincode);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getuserareas')
       {
              $state_id = $this->post('state_id');
              $city_id = $this->post('city_id');
              $pincode = $this->post('pincode');
              $chk = $this->user->getuserAreas($state_id,$city_id,$pincode);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='user_addresslist')
       {
              $user_id = $this->post('user_id');
              $chk = $this->user->getAddress($user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='usersavedAddress')
       {
              $user_id = $this->post('user_id');
              $chk = $this->user->getAddress1($user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='userhomesavedAddress')
       {
              $user_id = $this->post('user_id');
              $chk = $this->user->userSavedAddress($user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getbanner')
       {

              $user_id = $this->post('user_id'); 
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->getBanners($user_id,$lat,$lng);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getvendorbanner')
       {  
              $vendor_id = $this->post('vendor_id');
              $user_id = $this->post('user_id');
              $chk = $this->user->getVendorBanners($vendor_id,$user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
      else if($this->post('action')=='getcategories')
       {
              $chk = $this->user->getCategories();
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='gethome_categories1')
       {
              $user_id = $this->post('user_id');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->getHomeLimitCategories($user_id,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='gethome_categories')
       {
              $chk = $this->user->getHomeCategories();
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='selected_categories')
       {
              $catid = $this->post('catid');
              $chk = $this->user->getseleHomeCategories($catid);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
       else if($this->post('action')=='getshopsWithcategory')
       {
              $cat_id = $this->post('cat_id');
              $user_id = $this->post('user_id');
              $subcatid = $this->post('subcatid');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->getshopsWithcategoryID($cat_id,$subcatid,$user_id,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }

       else if($this->post('action')=='getallshopsWithoutcategory')
       {
              $user_id = $this->post('user_id');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $start_from = $this->post('start_from');
              $perpage = $this->post('perpage');
              $chk = $this->user->getAllshopsWithoutcategory($user_id,$lat,$lng,$start_from,$perpage);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getcategoryWithshop')
       {
              $shop_id = $this->post('shop_id');
              $chk = $this->user->getcategoryWithshopID($shop_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getSubcategories1')
       {
              $shop_id = $this->post('shop_id');
              $cat_id = $this->post('cat_id');
              $user_id = $this->post('user_id');
              $chk = $this->user->getSublimitCategories($shop_id,$cat_id,$user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getSubcategories')
       {
              $shop_id = $this->post('shop_id');
              $cat_id = $this->post('cat_id');
              $user_id = $this->post('user_id');
              $chk = $this->user->getSubCategories($shop_id,$cat_id,$user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getProducts')
       {
              $cat_id = $this->post('cat_id');
              //$shop_id = $this->post('shop_id');,$shop_id
              $user_id = $this->post('user_id');
              //$subcat_id = $this->post('subcat_id');,$subcat_id
              $start_from = $this->post('start_from');
              $perpage = $this->post('perpage');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->getProducts($cat_id,$user_id,$start_from,$perpage,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='fetchsubcategories')
       {
              $cat_id = $this->post('cat_id');
              $subcat_id = $this->post('subcat_id');
              $shopId = $this->post('shopId');
              $chk = $this->user->fetchsubcategories($cat_id,$subcat_id,$shopId);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='search_products')
       {
              $cat_id = $this->post('cat_id');
              $shop_id = $this->post('shop_id');
              $user_id = $this->post('user_id');
              $keyword = $this->post('keyword');
              $chk = $this->user->searchProducts($cat_id,$shop_id,$user_id,$keyword);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='filterProducts')
       {
              $type = $this->post('type');
              //$shopId = $this->post('shop_id'); 
              $catId = $this->post('catId'); 
              $user_id= $this->post('user_id'); 
              //$subcat_id= $this->post('subcat_id'); 
              $lat= $this->post('lat'); 
              $lng= $this->post('lng'); 
              $chk = $this->user->filterProductslist($type,$catId,$user_id,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='searchProducts')
       {
              $keyword = $this->post('keyword');
              $chk = $this->user->fetchProducts($keyword);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='productDetails')
       {
              $product_id = $this->post('product_id');
              $chk = $this->user->getProductDetails($product_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='productDetails_filter')
       {
              $product_id = $this->post('product_id');
              $json_data = $this->post('json_data');
              $chk = $this->user->productDetailsFilter($product_id,$json_data);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getDeals')
       {
              $chk = $this->user->getDeals();
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='addToCart')
       {
       		$session_id = $this->post('sid');
       		$variant_id = $this->post('variant_id');
       		$vendor_id = $this->post('vendor_id');
       		$user_id = $this->post('user_id');
       		$price = $this->post('price');
       		$quantity = $this->post('quantity');
              $chk = $this->user->addToCart($session_id,$variant_id,$vendor_id,$user_id,$price,$quantity);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='cartList')
       {
       		$session_id = $this->post('sid');
              $chk = $this->user->getCartList($session_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='increment_quantity')
       {
          $cart_id = $this->post('cart_id');
          $sid = $this->post('sid');
              $chk = $this->user->incrementQuantity($cart_id,$sid);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='decrement_quantity')
       {
          $cart_id = $this->post('cart_id');
          $sid = $this->post('sid');
              $chk = $this->user->decrementQuantity($cart_id,$sid);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='removeCart')
       {
       		  $cart_id = $this->post('cart_id');
              $chk = $this->user->removeCart($cart_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='coupon_codes')
       {
            $shop_id = $this->post('shop_id');
            $user_id = $this->post('user_id');
              $chk = $this->user->getCouponcodes($shop_id,$user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='apply_coupon')
       {
       		  $coupon_code = $this->post('coupon_code');
       		  $session_id = $this->post('sid');
       		  $coupon_status= $this->post('coupon_status');
            $grand_total= $this->post('grand_total');
              $chk = $this->user->applyCoupon($coupon_code,$session_id,$coupon_status,$grand_total);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='apply_manualcoupon')
       {
            $coupon_code = $this->post('coupon_code');
            $session_id = $this->post('sid');
            $coupon_status= $this->post('coupon_status');
            $grand_total= $this->post('grand_total');
              $chk = $this->user->applyManualCoupon($coupon_code,$session_id,$coupon_status,$grand_total);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       /*else if($this->post('action')=='remove_coupon')
       {
              $chk = $this->user->removeCoupon();
              $this->response($chk, REST_Controller::HTTP_OK);  
       }*/
       else if($this->post('action')=='doOrder')
       {
       		$session_id = $this->post('sid');
       		$user_id = $this->post('user_id');
       		$deliveryaddress_id = $this->post('deliveryaddress_id');
       		$payment_option = $this->post('payment_option');

       		$sub_total = $this->post('sub_total');
       		$delivery_amount = $this->post('delivery_amount');
       		$grand_total = $this->post('grand_total');
       		$coupon_id= $this->post('coupon_id');
       		$coupon_code= $this->post('coupon_code');
       		$coupon_disount= $this->post('coupon_disount');
          $gst= $this->post('gst');
       		$created_at = time();
       		$order_status = 1;

            $chk = $this->user->doOrder($session_id,$user_id,$deliveryaddress_id,$payment_option,$created_at,$order_status,$sub_total,$delivery_amount,$grand_total,$coupon_id,$coupon_code,$coupon_disount,$gst);
            $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='doBidOrder')
       {
          $bid = $this->post('bid');
          $session_id = $this->post('sid');
          $total_price = $this->post('total_price');
          $user_id = $this->post('user_id');
          $deliveryaddress_id = $this->post('deliveryaddress_id');
          $payment_option = $this->post('payment_option');
          $vendor_id = $this->post('vendor_id');
          $created_at = time();
          $order_status = 1;

            $chk = $this->user->doBidorder($bid,$session_id,$total_price,$user_id,$deliveryaddress_id,$payment_option,$order_status,$created_at,$vendor_id);
            $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='gettime_slots')
       {
       		  $date =  $this->post('date');
              $chk = $this->user->timeSlots($date);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='myorders')
       {
            $user_id =  $this->post('user_id');
            $order_status =  $this->post('order_status');
              $chk = $this->user->orderList($user_id,$order_status);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='completed_orders')
       {
            $user_id =  $this->post('user_id');
              $chk = $this->user->completedOrders($user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='orderDetails')
       {
              $order_id =  $this->post('order_id');
              $chk = $this->user->orderDetails($order_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='add_removewhishlist')
       {
              $product_id =  $this->post('product_id');
              $user_id =  $this->post('user_id');
              $chk = $this->user->add_removewhishList($product_id,$user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='whishlist')
       {
              $user_id =  $this->post('user_id');
              $chk = $this->user->whishList($user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='profile_details')
       {
              $user_id =  $this->post('user_id');
              $chk = $this->user->profileDetails($user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='upload_file')
       {
            $user_id =  $this->post('user_id');
            $chk = $this->user->browse_file($user_id);
            $this->response($chk, REST_Controller::HTTP_OK); 
       }
       else if($this->post('action')=='update_profile')
       {
              $user_id =  $this->post('user_id');
              $first_name =  $this->post('first_name');
              $last_name =  $this->post('last_name');
              //$image =  $this->post('image');
              $chk = $this->user->updateProfile($user_id,$first_name,$last_name);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='attributeswithCategory')
       {
              $cat_id =  $this->post('cat_id');
              $chk = $this->user->attributesWithCategory($cat_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='attributeValues')
       {
              $attribute_id =  $this->post('attribute_id');
              $chk = $this->user->fetchattributeValues($attribute_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='userreviews')
       {
              $user_id =  $this->post('user_id');
              $order_id =  $this->post('order_id');
              $vendor_id =  $this->post('vendor_id');
              $review =  $this->post('review');
              $rating =  $this->post('rating');
              $createdat =  time();
              $chk = $this->user->userReviews($user_id,$order_id,$vendor_id,$review,$rating,$createdat);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getNearByShops')
       {
              $lat =  $this->post('lat');
              $lng =  $this->post('lng');

              $chk = $this->user->getNearByShops($lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getVenodorShopswithCatId')
       {
              $catid =  $this->post('catid');

              $chk = $this->user->getVenodorShopswithCatId($catid);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='searchNearByShops')
       {
              $title =  $this->post('title');
              $lat =  $this->post('lat');
              $lng =  $this->post('lng');
              $chk = $this->user->searchByNearByShops($title,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getshopsLogo')
       {
              $lat =  $this->post('lat');
              $lng =  $this->post('lng');

              $chk = $this->user->shopsLogo($lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getvendorDetails')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $chk = $this->user->getVendorProfile($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='add_removeFavorites')
       {
              $shop_id =  $this->post('shop_id');
              $user_id =  $this->post('user_id');
              $chk = $this->user->add_removeFavorites($shop_id,$user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getOrdersdetails')
       {
            $oid =  $this->post('oid'); 
             $chk = $this->user->getOrdersDetails($oid);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='cancelOrder')
       {
             $user_id =  $this->post('user_id'); 
             $orderid =  $this->post('order_id'); 
             $chk = $this->user->docancelOrder($user_id,$orderid);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='favoritelist')
       {
              $user_id =  $this->post('user_id');
              $chk = $this->user->favoriteList($user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='deleteCartDetails')
       {
              $session_id =  $this->post('sid');
              $user_id =  $this->post('user_id');
              $chk = $this->user->deleteCartData($session_id,$user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='exchange_refund')
       {
              $session_id =  $this->post('order_id');
              $product_id =  $this->post('product_id');
              $user_id =  $this->post('user_id');
              $vendor_id  =  $this->post('vendor_id');
              $cartid  =  $this->post('cartid');
              $delivery_type  =  $this->post('delivery_type');
              $reson = $this->post('message');

              $chk = $this->user->exchangeRefund($session_id,$product_id,$user_id,$vendor_id,$cartid,$delivery_type,$reson);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }

       else if($this->post('action')=='delivery_slots')
       {
               $shop_id  =  $this->post('shop_id');
               $date  =  $this->post('date'); 
              $chk = $this->user->delivery_slots($shop_id,$date);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='razerpay_orderId')
       {
               /*$razorpay_keyid = 'rzp_test_rC5oDcF6UOxH3A';
            $razorpay_secret = 'T66zdBX27AjeUjcTvRBRHsJ4';*/
	          $razorpay_keyid = 'rzp_live_G0qYK68h4rJwFt';
              $razorpay_secret = 'gw7vHGXSC6iGT8plI2YHxNdD';
            
            $total_amount = $this->post('grand_total');

              $explode = explode(".", $total_amount);
              if($explode[1]!='')
              {
                if(strlen($explode[1])==1)
                {
                  $final = $explode[0]."".$explode[1]."0";
                }
                else
                {
                  $final = $explode[0]."".$explode[1];
                }
              }
              else
              {
                $final = $explode[0]."00";
              }
              
            $data = array(
                'amount' => $final, 
                'currency' => 'INR'
            );
            $payload = json_encode($data);
            $ch = curl_init('https://api.razorpay.com/v1/orders');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_USERPWD, "$razorpay_keyid:$razorpay_secret");  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
            ); 
            $result = curl_exec($ch);
             $order_id = json_decode($result)->id; 

            $session_id = $this->post('sid');
          $user_id = $this->post('user_id');
          $vendor_id = $this->post('vendor_id');
          $deliveryaddress_id = $this->post('deliveryaddress_id');

          $sub_total = $this->post('sub_total');
          $delivery_amount = $this->post('delivery_amount');
          $grand_total = $this->post('grand_total');
          $coupon_id= $this->post('coupon_id');
          $coupon_code= $this->post('coupon_code');
          $coupon_disount= $this->post('coupon_disount');
          $gst= $this->post('gst');
          $created_at = time();
          $order_status = 1;

         $chk = $this->user->dorazerpayOrder($session_id,$user_id,$vendor_id,$deliveryaddress_id,$created_at,$order_status,$sub_total,$delivery_amount,$grand_total,$coupon_id,$coupon_code,$coupon_disount,$order_id,$gst);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='razerpay_doOrder')
       {
          $order_id = $this->post('order_id');
          $razerpay_orderid = $this->post('razerpay_orderid');
          $razerpay_txnid = $this->post('razerpay_txnid');
          $payment_option = $this->post('payment_option');
           $chk = $this->user->dorazerpaysuccessOrder($order_id,$razerpay_orderid,$razerpay_txnid,$payment_option);
         $this->response($chk, REST_Controller::HTTP_OK); 
      }
      else if($this->post('action')=='getmostViewedProducts')
      {
              $user_id = $this->post('user_id');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->getmostViewedProducts($user_id,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='top_deals')
      {
              $user_id = $this->post('user_id');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->getTopDeals($user_id,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='view_alltop_deals')
      {
              $user_id = $this->post('user_id');
              $start_from = $this->post('start_from');
              $perpage = $this->post('perpage');
              $lat = $this->post('lat');
              $lng = $this->post('lng');
              $chk = $this->user->viewAlltopDeals($user_id,$start_from,$perpage,$lat,$lng);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      
      else if($this->post('action')=='products_filters')
      {
              //$shop_id  =  $this->post('shop_id');
              $json_data = $this->post('json_data');
              $cat_id= $this->post('cat_id');
              //$subcat_id= $this->post('subcat_id');
              $chk = $this->user->getproductsFilters($json_data,$cat_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='socialshare')
      {
          $chk = $this->user->socialShare();
           $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='getDistance')
      {
          $clat  =  $this->post('clat');
          $clng  =  $this->post('clng');
          $userlat  =  $this->post('userlat');
          $userlng  =  $this->post('userlng');
          $chk = $this->user->getDistance($clat,$clng,$userlat,$userlng);
          $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='userTransactions')
      {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->getTransactions($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='getuserWallet')
      {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->getUserWallet($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='wallet_razerpay_orderID')
       {
            //$razorpay_keyid = 'rzp_test_ywjRok0nPJdn2M';
            //$razorpay_secret = 'peGeVXRIW7EM4Kn0gBuxUqYP';
			    

            $razorpay_keyid = 'rzp_test_rC5oDcF6UOxH3A';
            $razorpay_secret = 'T66zdBX27AjeUjcTvRBRHsJ4';
            
            $user_id = $this->post('user_id');
            $total_amount = $this->post('wallet_amount');
            $data = array(
                'amount' => $total_amount . '00', 
                'currency' => 'INR'
            );
            $payload = json_encode($data);
            $ch = curl_init('https://api.razorpay.com/v1/orders');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_USERPWD, "$razorpay_keyid:$razorpay_secret");  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
            ); 
            $result = curl_exec($ch);
            $order_id = json_decode($result)->id;

          
          $created_at = time();
          $order_status = 1;

          $chk = $this->user->getWalletRazerpayOrderId($user_id,$total_amount,$order_id);

          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='addamounttoWallet')
       {
          $user_id  =  $this->post('user_id');
          $payment_id  =  $this->post('payment_id');
          $razerpay_orderid  =  $this->post('razerpay_orderid');
          $order_id  =  $this->post('order_id');
          $chk = $this->user->addAmountToWallet($user_id,$payment_id,$razerpay_orderid,$order_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getUserbonupoints')
       {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->getUserBonuPoints($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='doredeemAmount')
       {
          $user_id  =  $this->post('user_id');
          $redeem_amount  =  $this->post('redeem_amount');
          $chk = $this->user->doRedeemAmount($user_id,$redeem_amount);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getcities')
       {
          $chk = $this->user->getCities();
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='select_useraddress')
       {
          $user_id  =  $this->post('user_id');
          $address_id  =  $this->post('address_id');
          $chk = $this->user->selectUseraddress($user_id,$address_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getOrderCoins')
       {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->fetchOrderCoins($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='createUserBid')
       {
          $user_id  =  $this->post('user_id');
          $ar = array(
                  'user_id'=>$this->post('user_id'),
                  'session_id'=>$this->post('sid'),
                  'vendor_id'=>$this->post('vendor_id'),
                  'sub_total'=>$this->post('sub_total'),
                  'delivery_amount'=>$this->post('delivery_amount'),
                  'grand_total'=>$this->post('grand_total'),
                  'gst'=>$this->post('gst'),
                  'created_at'=>time()
                );

          $chk = $this->user->createUserBid($ar);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getBidList')
       {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->fetchOrderCoins($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='mybids')
       {
          $user_id  =  $this->post('user_id');
          $order_status  =  $this->post('order_status');
          $chk = $this->user->mybids($user_id,$order_status);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='cancelBid')
       {
          $bid  =  $this->post('bid');
          $chk = $this->user->cancelBid($bid);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getcontent')
       {
          $cid  =  $this->post('cid');
          $chk = $this->user->getcontent($cid);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='delete_address')
       {
          $user_id  =  $this->post('user_id');
          $aid  =  $this->post('aid');
          $chk = $this->user->deleteAddress($user_id,$aid);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='userNotifications')
       {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->userNotifications($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updateNotifications')
       {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->updateNotifications($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='sendPushnotification')
       {
          $user_id  =  $this->post('user_id');
          $chk = $this->user->sendPushnotification($user_id);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='become_vendor')
       {
              $shopname = $this->post('shopname');
              $ownername = $this->post('ownername');
              $email = $this->post('email');
              $mobile = $this->post('mobile');
              $state = $this->post('state');
              $city = $this->post('city');
              $location = $this->post('location');

              $data = array('shopname' =>$shopname, 'ownername' =>$ownername, 'email' =>$email,'mobile'=>$mobile,'state'=>$state,'city'=>$city,'location'=>$location,'created_at'=>time());

               $chk = $this->user->becomeVendor($data);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='checkLocation')
       {
          $area_id  =  $this->post('area_id');
          $city_id  =  $this->post('city_id');
          $vendor_id  =  $this->post('vendor_id');
          $pincode  =  $this->post('pincode');
          $chk = $this->user->checkLocation($area_id,$city_id,$vendor_id,$pincode);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updateUserToken')
       {
          $user_id  =  $this->post('user_id');
          $tokenId  =  $this->post('tokenId');
          $chk = $this->user->updateUserToken1($user_id,$tokenId);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updatecustomeraddress')
       {
          $user_id  =  $this->post('user_id');
          $lat  =  $this->post('lat');
          $lng  =  $this->post('lng');
          $address  =  $this->post('address');
          $chk = $this->user->updateCustomerAddress($user_id,$lat,$lng,$address);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='distanceinkm')
       {
          $chk = $this->user->distanceInKm();
          $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if ($this->post('action') == 'version_control') {
            $chk = $this->user->versionControl();
            $this->response($chk, REST_Controller::HTTP_OK);  
        }
        else if ($this->post('action') == 'promotional_notifications') {
            $user_id  =  $this->post('user_id');
            $chk = $this->user->promotionalNotifications($user_id);
            $this->response($chk, REST_Controller::HTTP_OK);  
        }
        else if ($this->post('action') == 'courier_api') 
        {
                $timestamp    = time();
                $appID        = 7071;
                $key          = 'qqguv845+z4=';
                $secret       = 'iXlfZZiW3/nZvKPos/tXYioWsCyi0GttMCo7MDVwH4LHilE8ZsTL3xSw1+bUxNASYv1Mtln2ets17KzPoRhgPw==';

                $sign = "key:".$key."id:".$appID.":timestamp:".$timestamp;
                $authtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));  
                //echo $authtoken;
                //echo $timestamp;

                $vendorid=117531;
                      $ch = curl_init();

                $data = Array(
                    "orders" => Array(
                        "0" => Array(
                            "orderId" => "123456sss78901",
                            "customerName" => "Satish",
                            "customerAddress" => "dwaraka nagar, 5th lane, visakapatnam",
                            "customerCity" => "visakapatnam",
                            "customerPinCode" => "530016",
                            "customerContact" => "9542921119",
                            "orderType" => "COD",
                            "modeType" => "Surface",
                            "orderDate" => "2021-08-10",
                            "package" => Array( 
                                "itemLength" => 12,
                                "itemWidth" => 15,
                                "itemHeight"=> 20,
                                "itemWeight" => 1.5
                            ),
                            "skuList" => Array(
                                "0" => Array(
                                    "sku" => "Test",
                                    "itemName" => "Item1",
                                    "quantity" => 1,
                                    "price" => 45.00,
                                    "itemLength" => 10, //optional
                                    "itemWidth" => 3, //optional
                                    "itemHeight"=> 2, //optional
                                    "itemWeight" => 2 //optional
                                ),
                                "1" => Array(
                                    "sku" => "Test1",
                                    "itemName" => "Item2",
                                    "quantity" => 1,
                                    "price" => 45.00,
                                    "itemLength" => null, //optional
                                    "itemWidth" => null, //optional
                                    "itemHeight"=> null, //optional
                                    "itemWeight" => null //optional
                                )
                            ),
                            "totalValue" => 1320,
                            "sellerAddressId" => 56509,
                        )
                    )
                );

                $data_json = json_encode($data);

                $header = array(
                    "x-appid: $appID",
                    "x-sellerid:$vendorid",
                    "x-timestamp: $timestamp",
                    "x-version:3", // for auth version 3.0 only
                    "Authorization: $authtoken",
                    "Content-Type: application/json",
                    "Content-Length: ".strlen($data_json)
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/order?method=sku');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response  = curl_exec($ch);

                print_r($response); 
                var_dump($response);
                exit;
                curl_close($ch);

                die;
         }
         else if($this->post('action')=='apply_user_coupon')
       {
            $coupon_code = $this->post('coupon_code');
            $session_id = $this->post('sid');
            $coupon_status= $this->post('coupon_status');
            $grand_total= $this->post('grand_total');
            $user_id= $this->post('user_id');
              $chk = $this->user->applyUserCoupon($coupon_code,$session_id,$coupon_status,$grand_total,$user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if ($this->post('action') == 'change_seo_url') {
            $chk = $this->user->changeSeoUrl('4');
            $this->response($chk, REST_Controller::HTTP_OK);  
        }
        else if ($this->post('action') == 'get_state_city') {
            $pincode= $this->post('pincode');
            $chk = $this->user->getStateCity($pincode);
            $this->response($chk, REST_Controller::HTTP_OK);  
        }

       /*else if($this->post('action')=='getPincodes')
       {
          $from_pincode  =  $this->post('from_pincode');
          $to_pincode  =  $this->post('to_pincode');

          $chk = $this->user->calc_distance($from_pincode,$to_pincode);
          $this->response($chk, REST_Controller::HTTP_OK);  
       }*/


       

       

       

       

       


       

       

       

       



       
    }
}



?>