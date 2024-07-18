<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Vendor_api extends REST_Controller {

    public function __construct() { 
     header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        parent::__construct();
        
        //load user model
        $this->load->model('vendor');
        //$this->load->library('email'); 
    }

    public function user_post() {
       $userData = array();
        if($this->post('action')=='vendor_registration')
       {
              $first_name = $this->post('first_name');
              $last_name = $this->post('last_name');
              $email = $this->post('email');
              $password = md5($this->post('password'));
              $phone = $this->post('phone');
              $token = $this->post('token');
             

              $date = date('Y-m-d H:i:s');
              if($token!='')
              {
                $token1=$token;
              }
              else
              {
                $token1="";
              }
              $name = $first_name." ".$last_name;
              $data = array('owner_name' =>$name, 'email' =>$email, 'password' =>$password,'mobile'=>$phone,'created_date'=>$date,'token'=>$token1);
               $chk = $this->vendor->doRegister($data);
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
              $username = $this->post('mobile');
              $password = md5($this->post('password'));
              $token = $this->post('token');
               $chk = $this->vendor->checkLogin($username,$password,$token);
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
               $chk = $this->vendor->resendOTP($user_id);
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
              $user_type = $this->post('user_type');
               $chk = $this->vendor->checkForgot($phone,$user_type);
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
               $chk = $this->vendor->verify_OTP($user_id,$otp);
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
              $user_type = $this->post('user_type');
               $chk = $this->vendor->resetPassword($phone,$otp,$password,$user_type);
               if($chk=='error')
               {
                  $this->response($chk, REST_Controller::HTTP_OK);  
               }
               else
               {
                  $this->response($chk, REST_Controller::HTTP_OK);
               }
       }
       else if($this->post('action')=='getProfileDetails')
       {
              $user_id = $this->post('user_id');
              $chk = $this->vendor->getProfile($user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updateMinimumOrder')
       {
              $user_id = $this->post('user_id');
              $min_order_amount = $this->post('min_order_amount');
              $chk = $this->vendor->updateOrder($user_id,$min_order_amount);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getcategories')
       {
             $user_id = $this->post('user_id');
              $chk = $this->vendor->getCategories($user_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getsubcategories')
       {
             $cat_id = $this->post('cat_id');
              $chk = $this->vendor->getSubCategories($cat_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
       else if($this->post('action')=='getbanner')
       {
              $chk = $this->vendor->getBanners();
             
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getProducts')
       {
              $cat_id = $this->post('cat_id'); 
              $subcat_id = $this->post('subcat_id');
              $shop_id = $this->post('shop_id');
              $chk = $this->vendor->get_Products($cat_id,$subcat_id,$shop_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='requestProduct')
       {
              
              
              $variant_product = $this->post('variant_product');
              
              if($this->post('brand')!=''){ $brand = $this->post('brand'); }else{ $brand =0;  }     

              if($this->post('product_tags')!='')
              {
                $producttags=$this->post('product_tags');
              }
              else
              {
                $producttags='';
              }
              
              /*if($this->post('taxname')!='')
              {
                $taxname = $this->post('taxname');
              }
              else
              {
                $taxname = '';
              }*/

              if($this->post('no_of_days')!='' || $this->post('no_of_days')!=undefined || $this->post('no_of_days')!=null)
              {
                $noofdays = $this->post('no_of_days');
              }
              else
              {
                $noofdays = "0";
              }
              $novar = array('price' =>$this->post('price'),'saleprice' =>$this->post('saleprice'),'stock' =>$this->post('stock'));
                  
       $ar = array(
            'shop_id' =>$this->post('shop_id'),
            'name'=>$this->post('name'),
            'cat_id' => $this->post('cat_id'),
            'sub_cat_id' => $this->post('sub_cat_id'),
            'key_features' =>$this->post('key_features'),
            'descp' =>$this->post('description'),
            //'selling_date' =>$this->post('selling_date'),
            'product_tags' =>$producttags,
            'meta_tag_title'=>$this->post('meta_tag_title'),
            'meta_tag_description'=>$this->post('meta_tag_description'),
            'meta_tag_keywords'=>$this->post('meta_tag_keywords'),
            //'tax_class' =>$this->post('tax_class'),
            'brand'=>$brand,
            //'taxname' =>$taxname,
                'cancel_status' =>$this->post('cancel_status'),
            'return_status' =>$this->post('return_status'),
            'return_noof_days' =>$noofdays,
            'variant_product'=>$variant_product,
            'manage_stock'=>$this->post('manage_stock'),
            'availabile_stock_status'=>$this->post('availabile_stock_status')
            );
              $imagepath=$this->post('imagepath');
       
            
            if($variant_product=='no')
            {
                $chk = $this->vendor->insertProduct($ar,$novar,$imagepath);
                $this->response($chk, REST_Controller::HTTP_OK); 
            }
            else if($variant_product=='yes')
            {
                $chk = $this->vendor->novariant_insertProduct($ar);
                $this->response($chk, REST_Controller::HTTP_OK); 
            }
            
        
       }
       else if($this->post('action')=='updateProduct')
       {
              
              
              if($this->post('brand')!=''){ $brand = $this->post('brand'); }else{ $brand =0;  }     

              if($this->post('product_tags')!='')
              {
                $producttags=$this->post('product_tags');
              }
              else
              {
                $producttags='';
              }
              
             /* if($this->post('taxname')!='')
              {
                $taxname = $this->post('taxname');
              }
              else
              {
                $taxname = '';
              }*/

              if($this->post('no_of_days')!='' || $this->post('no_of_days')!=undefined || $this->post('no_of_days')!=null)
              {
                $noofdays = $this->post('no_of_days');
              }
              else
              {
                $noofdays = "0";
              }
              
              $novar = array('price' =>$this->post('price'),'saleprice' =>$this->post('saleprice'),'stock' =>$this->post('stock'));
                  
       $ar = array(
            'shop_id' =>$this->post('shop_id'),
            'name'=>$this->post('name'),
            'cat_id' => $this->post('cat_id'),
            'sub_cat_id' => $this->post('sub_cat_id'),
            'key_features' =>$this->post('key_features'),
            'descp' =>$this->post('description'),
            //'selling_date' =>$this->post('selling_date'),
            'product_tags' =>$producttags,
            'meta_tag_title'=>$this->post('meta_tag_title'),
            'meta_tag_description'=>$this->post('meta_tag_description'),
            'meta_tag_keywords'=>$this->post('meta_tag_keywords'),
            //'tax_class' =>$this->post('tax_class'),
            'brand'=>$brand,
            'return_noof_days' =>$noofdays,
            //'taxname' =>$taxname,
                'cancel_status' =>$this->post('cancel_status'),
            'return_status' =>$this->post('return_status'),
            'manage_stock'=>$this->post('manage_stock'),
            'availabile_stock_status'=>$this->post('availabile_stock_status')
            );

               $chk = $this->vendor->updateProduct($ar,$novar,$this->post('pid'));
               $this->response($chk, REST_Controller::HTTP_OK); 
            // if($variant_product=='no')
            // {
            //     $chk = $this->vendor->updateProduct($ar,$novar,$this->post('pid'));
            //     $this->response($chk, REST_Controller::HTTP_OK); 
            // }
            // else if($variant_product=='yes')
            // {
            //     $chk = $this->vendor->updatenovariant_insertProduct($ar,$this->post('pid'));
            //     $this->response($chk, REST_Controller::HTTP_OK); 
            // }
            
        
       }
       else if($this->post('action')=='getAttributeTypes')
       {
              $product_id = $this->post('product_id');
              $chk = $this->vendor->attributeTypes($product_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getAttributeValues')
       {
              $product_id = $this->post('product_id');
              $attribute_type_id = $this->post('attribute_type_id');
              $chk = $this->vendor->AttributeValues($product_id,$attribute_type_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='addvariant')
       {
              $product_id = $this->post('product_id');
              $attribute_type_id = $this->post('attribute_type_id');
              $attribute_value_ids = $this->post('attribute_value_ids');
              $chk = $this->vendor->addVariant($product_id,$attribute_type_id,$attribute_value_ids);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='upload_productImage')
       {
           $product_id = $this->post('product_id');
           $variant_id = $this->post('variant_id');
            $chk = $this->vendor->browse_file($product_id,$variant_id);
            if($chk=='false')
            {
               $ss = array('status'=>false,'message'=>"please upload below 5mb");
            }
            else
            {
              $img = base_url()."uploads/products/".$chk;
              $ss = array('status'=>true,'file'=>$chk,'fullpath'=>$img);
            }
            $this->response($ss, REST_Controller::HTTP_OK);  
       }
       
       else if($this->post('action')=='getvariantList')
       {
              $product_id = $this->post('product_id');
              
              $chk = $this->vendor->getVariantsList($product_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='getProductImages')
       {
              $product_id = $this->post('product_id');
              $variant_id = $this->post('variant_id');
              $chk = $this->vendor->getProductImages($product_id,$variant_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='deleteProductImages')
       {
              $variant_id = $this->post('variant_id');
              $chk = $this->vendor->deleteProductImages($variant_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='updatePrice')
       {
              $product_id = $this->post('product_id');
              $variant_id = $this->post('variant_id');
              $price = $this->post('price');
              $saleprice = $this->post('saleprice');
              $stock = $this->post('stock');
              $wr = array('id'=>$variant_id);
              $ar = array('product_id'=>$product_id,'price'=>$price,'saleprice'=>$saleprice,'stock'=>$stock);
              $chk = $this->vendor->updatePrice($ar,$wr);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='addStock')
       {
              $product_id = $this->post('product_id');
              $variant_id = $this->post('variant_id');
              $quantity = $this->post('quantity');
              $stockstatus = $this->post('stockstatus');
              $chk = $this->vendor->addStock($product_id,$variant_id,$quantity,$stockstatus);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='stockManagement')
       {
              $product_id = $this->post('pid');
              $variant_id = $this->post('variant_id');
              
              $chk = $this->vendor->getstockManagement($product_id,$variant_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }

       else if($this->post('action')=='shops_list')
       {
              $user_id = $this->post('user_id');
              
              $chk = $this->vendor->shopsList($user_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getproductTags')
       {
              $chk = $this->vendor->getProductTags();
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getBrands')
       {
              $chk = $this->vendor->getBrandslist();
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='gettaxList')
       {
              $chk = $this->vendor->getTaxList();
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getSingleProduct')
       {
              $pid = $this->post('pid');
              $chk = $this->vendor->getSingleProduct($pid);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getaddvariantList')
       {
              $product_id =  $this->post('product_id');
              $chk = $this->vendor->getAddVariantList($product_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updatevariant')
       {
              $product_id = $this->post('product_id');
               $vid = $this->post('vid');
              $attribute_type_id = $this->post('attribute_type_id');
              $attribute_value_ids = $this->post('attribute_value_ids');
              $chk = $this->vendor->updateVariant($product_id,$attribute_type_id,$attribute_value_ids,$vid);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='delete_variant')
       {
              $product_id =  $this->post('product_id');
              $vid =  $this->post('vid');
              $chk = $this->vendor->deleteVariant($product_id,$vid);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getlink_variants')
       {
              $product_id =  $this->post('product_id');
              $chk = $this->vendor->getLinkVariants($product_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='changeStatus')
       {
              $status =  $this->post('status');
              $vid =  $this->post('vid');
              $chk = $this->vendor->changevariantStatus($vid,$status);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='changePassword')
       {
           $login_type =  $this->post('login_type');
           $user_id =  $this->post('user_id');
           $current_password =  $this->post('current_password');
           $new_password =  $this->post('new_password');

           $chk = $this->vendor->updatePassword($login_type,$user_id,$current_password,$new_password);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='termsandconditions')
       {
             $chk = $this->vendor->getTerms();
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getOrdersList')
       {
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->fetchOrdersList($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getProcessingOrdersList')
       {
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->fetchProcessingOrdersList($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getTransmitOrdersList')
       {
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->fetchTransmitOrdersList($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getCompletedOrdersList')
       {
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->fetchCompletedOrdersList($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='pending_settlements')
       {
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->pendingSettlements($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='completed_Settlements')
       {
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->completedSettlements($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getOrdersdetails')
       {
             $oid =  $this->post('oid');
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->getOrdersDetails($oid,$vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }

       else if($this->post('action')=='dashboardDetails')
       {
              $vm_id =  $this->post('vm_id');
             $chk = $this->vendor->fetchdashboardDetails($vm_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getVendorStatus')
       {  
              $vendor_id =  $this->post('vendor_id');
             $tokenId =  $this->post('tokenId');
             $chk = $this->vendor->fetchVendorStatus($vendor_id,$tokenId);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='ChangeVendorStatus')
       {
             $status =  $this->post('status');
             $vendor_id =  $this->post('vendor_id');
             $chk = $this->vendor->changeVendorStatus($vendor_id,$status);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getshopworkinghours')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $chk = $this->vendor->getShopWorkingHours($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='addBusinessHours')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $open_time =  $this->post('open_time'); 
             $closed_time =  $this->post('closed_time'); 
             $weekname =  $this->post('weekname'); 
             $working =  $this->post('working'); 

             $chk = $this->vendor->createBusinessHours($vendor_id,$open_time,$closed_time,$weekname,$working);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updateBusinessHours')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $open_time =  $this->post('open_time'); 
             $closed_time =  $this->post('closed_time'); 
             $weekname =  $this->post('weekname'); 
             $working =  $this->post('working'); 
             $wid =  $this->post('wid'); 

             $chk = $this->vendor->updateBusinessHours($vendor_id,$open_time,$closed_time,$weekname,$working,$wid);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='acceptOrder')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $orderid =  $this->post('order_id'); 

             $chk = $this->vendor->doacceptOrder($vendor_id,$orderid);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='cancelOrder')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $orderid =  $this->post('order_id'); 
             $chk = $this->vendor->docancelOrder($vendor_id,$orderid);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='complete_order')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $orderid =  $this->post('orderid'); 
             $chk = $this->vendor->completeOrder($vendor_id,$orderid);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       
       else if($this->post('action')=='getvendorProfile')
       {
             $vendor_id =  $this->post('vendor_id'); 
             $chk = $this->vendor->getVendorProfile($vendor_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getmarchantProfile')
       {
             $vm_id =  $this->post('vm_id'); 
             $chk = $this->vendor->getMarchantProfile($vm_id);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updatevmProfile')
       {
             $vm_id =  $this->post('vm_id'); 
             $name =  $this->post('name'); 
             $address =  $this->post('address');
             $chk = $this->vendor->updatevmProfile($vm_id,$name,$address);
             $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='upload_shopimage')
       {
           $vendor_id = $this->post('vendor_id');
            $chk = $this->vendor->updateShopImage($vendor_id);
            
              $img = base_url()."uploads/shops/".$chk;
              $ss = array('status'=>true,'file'=>$chk,'fullpath'=>$img);
            
            $this->response($ss, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='upload_logoimage')
       {
            $vendor_id = $this->post('vendor_id');
            $chk = $this->vendor->updateLogoImage($vendor_id);
            
              $img = base_url()."uploads/shops/".$chk;
              $ss = array('status'=>true,'file'=>$chk,'fullpath'=>$img);
            
            $this->response($ss, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='updateProfiledetails')
       {
            $vendor_id = $this->post('vendor_id');
            $shop_name = $this->post('shop_name');
            $owner_name = $this->post('owner_name');
            $description = $this->post('description');
            $address = $this->post('address');
            $alternative_mobile = $this->post('alternative_mobile');
            $pan = $this->post('pan');
            $aadhar = $this->post('aadhar');
            $gst_number = $this->post('gst_number');
            $bankname = $this->post('bankname');
            $accountholder_name = $this->post('accountholder_name');
            $bank_ifsccode = $this->post('bank_ifsccode');
            $account_no = $this->post('account_no');
            $delivery_charges= $this->post('delivery_charges');
            $chk = $this->vendor->updateProfileDetails($vendor_id,$shop_name,$owner_name,$description,$address,$alternative_mobile,$pan,$aadhar,$gst_number,$bankname,$accountholder_name,$bank_ifsccode,$account_no,$delivery_charges);
            $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='vendorReview')
       {
          $vendor_id = $this->post('vendor_id'); 
          $chk = $this->vendor->getvendorReview($vendor_id);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='deleteProduct')
       {
          $pid = $this->post('pid'); 
          $chk = $this->vendor->deleteProduct($pid);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getsalesReport')
       {
          $vendor_id = $this->post('vendor_id'); 
          $chk = $this->vendor->getSalesReport($vendor_id);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='getDatewisesalesReport')
       {
          $vendor_id = $this->post('vendor_id'); 
          $sdate = $this->post('sdate'); 
          $chk = $this->vendor->getDatewisesalesReport($vendor_id,$sdate);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='socialshare')
       {
          $chk = $this->vendor->socialShare();
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='deleteBuss')
       {
        $vendor_id = $this->post('vendor_id');
        $bid = $this->post('bid');
          $chk = $this->vendor->deleteBussness($vendor_id,$bid);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getexchange_orders')
       {
          $vendor_id = $this->post('vendor_id');
          $chk = $this->vendor->getexchangeOrders($vendor_id);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='acceptExchange_orders')
       {
             $oid = $this->post('oid');
             $sid = $this->post('sid');
           $chk = $this->vendor->acceptExchangeOrders($oid,$sid);
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='getbasicsubcategories')
       {
           $chk = $this->vendor->fetchbasicsubcategories();
           $this->response($chk, REST_Controller::HTTP_OK);  
       }
        else if($this->post('action')=='delivery_slots')
       {
               $shop_id  =  $this->post('shop_id');
               $sdate  =  $this->post('sdate');
              $chk = $this->vendor->deliverySlots($shop_id,$sdate);
              $this->response($chk, REST_Controller::HTTP_OK);  
       }
       else if($this->post('action')=='products_filters')
      {
              $shop_id  =  $this->post('shop_id');
              $json_data = $this->post('json_data');
              $cat_id= $this->post('cat_id');
              $chk = $this->vendor->getproductsFilters($json_data,$shop_id,$cat_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='getVendorDiscount')
      {
              $vendor_id  =  $this->post('vendor_id');
              $chk = $this->vendor->getVendorDiscount($vendor_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='getVendorRequests')
      {
              $vendor_id  =  $this->post('vendor_id');
              $chk = $this->vendor->getVendorRequests($vendor_id);
             
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='requestvendorPayments')
      {
              $vendor_id  =  $this->post('vendor_id');
              $requested_amount  =  $this->post('requested_amount');
              $description  =  $this->post('description');
              $total_payment  =  $this->post('total_payment');
              $chk = $this->vendor->requestVendorPayments($vendor_id,$requested_amount,$description,$total_payment);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='deleteRequest')
      {
              $id  =  $this->post('id');
              $chk = $this->vendor->clrRequest($id);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='requestbidslist')
      {
              $vendor_id  =  $this->post('vendor_id');
              $bid_status  =  $this->post('bid_status');
              $chk = $this->vendor->getUsersBids($vendor_id,$bid_status);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='getBidDetails')
      {
              $bid  =  $this->post('bid');
              $vendor_id =  $this->post('vendor_id');
              $chk = $this->vendor->getBidDetails($bid,$vendor_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='shopbanners')
      {
              $vendor_id  =  $this->post('vendor_id');
              $chk = $this->vendor->getShopBanners($vendor_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='uploadBanner')
      {
            $chk = $this->vendor->selectBanner();
            if($chk=='false')
            {
               $ss = array('status'=>false,'message'=>"please upload below 5mb");
            }
            else
            {
              $img = $chk;
            }
            $this->response($img, REST_Controller::HTTP_OK); 
      }
      else if($this->post('action')=='uploadProductImages')
      {
            $chk = $this->vendor->selectProductImages();
            if($chk=='false')
            {
               $ss = array('status'=>false,'message'=>"please upload below 5mb");
            }
            else
            {
              $img = $chk;
            }
            $this->response($img, REST_Controller::HTTP_OK); 
      }
      else if($this->post('action')=='addbanner')
      {
              $vendor_id  =  $this->post('vendor_id');
              $title = $this->post('title');
              $image = $this->post('imagepath');
            $chk = $this->vendor->addBannerImage($vendor_id,$title,$image);
            if($chk=='false')
            {
               $ss = array('status'=>false,'message'=>"Something went wrong ,Please try again");
            }
            else if($chk=='true')
            {
              $ss = array('status'=>true,'message'=>"Banner added Successfully");
            }
            $this->response($ss, REST_Controller::HTTP_OK); 

      }
      else if($this->post('action')=='updatebanner')
      {
              $vendor_id  =  $this->post('vendor_id');
              $title = $this->post('title');
              $image = $this->post('imagepath');
              $id = $this->post('id');
            $chk = $this->vendor->updateBannerImage($vendor_id,$title,$image,$id);
            if($chk=='false')
            {
               $ss = array('status'=>false,'message'=>"Something went wrong ,Please try again");
            }
            else if($chk=='true')
            {
              $ss = array('status'=>true,'message'=>"Banner added Successfully");
            }
            $this->response($ss, REST_Controller::HTTP_OK); 

      }
      else if($this->post('action')=='couponcodes')
      {
              $vendor_id  =  $this->post('vendor_id');
              $chk = $this->vendor->getCouponcodes($vendor_id);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='submitBidQuote')
      {
              $user_id  =  $this->post('user_id');
              $vendor_id  =  $this->post('vendor_id');
              $bid_id  =  $this->post('bid_id');
              $total_price  =  $this->post('total_price');

              $chk = $this->vendor->submitBidQuote($user_id,$vendor_id,$bid_id,$total_price);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='addcouponcodes')
      {
              $vendor_id  =  $this->post('vendor_id');
              $coupon_code  =  $this->post('coupon_code');
              $percentage  =  $this->post('percentage');
              $maximum_amount  =  $this->post('maximum_amount');
              $start_date  =  $this->post('start_date');
              $end_date  =  $this->post('end_date');
              $description  =  $this->post('description');
              $chk = $this->vendor->addCoupon($vendor_id,$coupon_code,$percentage,$maximum_amount,$start_date,$end_date,$description);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='updatecouponcodes')
      {
              $vendor_id  =  $this->post('vendor_id');
              $coupon_code  =  $this->post('coupon_code');
              $percentage  =  $this->post('percentage');
              $maximum_amount  =  $this->post('maximum_amount');
              $start_date  =  $this->post('start_date');
              $end_date  =  $this->post('end_date');
              $description  =  $this->post('description');
              $id  =  $this->post('id');
              $chk = $this->vendor->updateCoupon($vendor_id,$coupon_code,$percentage,$maximum_amount,$start_date,$end_date,$description,$id);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='delete_coupon')
      {
              $cid  =  $this->post('cid');

              $chk = $this->vendor->deleteCoupon($cid);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='delete_banner')
      {
              $cid  =  $this->post('cid');
              $chk = $this->vendor->deleteBanner($cid);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if($this->post('action')=='searchProducts')
      {
              $keyword  =  $this->post('keyword');
              $shopId =  $this->post('shopId');
              $chk = $this->vendor->searchPreLoadedProducts($keyword,$shopId);
              $this->response($chk, REST_Controller::HTTP_OK);  
      }
      else if ($this->post('action') == 'version_control') {
            $chk = $this->vendor->versionControl();
            $this->response($chk, REST_Controller::HTTP_OK);  
        }

      

      

      

      

      


      

      


    }
}

?>