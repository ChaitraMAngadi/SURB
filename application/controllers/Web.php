<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {

    public $data;

    function __construct() {


        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept,Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('Web_model');

        $this->load->library("pagination");
        if ($_SESSION['userdata']['logged_in'] != true) {
            $url = $this->uri->segment('2');
            $this->db->where('name', 'Contact');
            $query = $this->db->get('features');
            $feature = $query->row();
          
            if ($url == 'contact_us') {
                // if ($feature && $feature->status == 1){
                $data['contactinfo'] = $this->Web_model->getContactDetails();
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['title'] = 'Contact Us';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/contact_us.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            // }else {
                   
            //         redirect('web');
            //         exit(); 
            //     }
//redirect('web/contact_us');
            } else if ($url == 'about_us') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('4');
                $data['title'] = 'About Us';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/about_us.php', $data);
                $this->load->view("web/includes/footer", $this->data);
//redirect('web/about_us');
            } else if ($url == 'privacy_policy') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('2');
                $data['title'] = 'Privacy Policy';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/privacy_policy.php', $data);
                $this->load->view("web/includes/footer", $this->data);
//redirect('web/privacy_policy');
            } else if ($url == 'refund_policy') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('6');
                $data['title'] = 'Refund Policy';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/refund_policy.php', $data);
                $this->load->view("web/includes/footer", $this->data);
//redirect('web/refund_policy');
            } else if ($url == 'terms_and_conditions') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('1');
                $data['title'] = 'Terms and Conditions';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/terms_and_conditions.php', $data);
                $this->load->view("web/includes/footer", $this->data);
// redirect('web/terms_and_conditions');
            } else if ($url == 'delivery_partner') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('7');
                $data['title'] = 'Delivery Partner';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/terms_and_conditions.php', $data);
                $this->load->view("web/includes/footer", $this->data);
// redirect('web/terms_and_conditions');
            } else if ($url == 'shipping_policy') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('8');
                $data['title'] = 'Shipping Policy';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/terms_and_conditions.php', $data);
                $this->load->view("web/includes/footer", $this->data);
// redirect('web/terms_and_conditions');
            } else if ($url == 'what_we_do') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('9');
                $data['title'] = 'What We Do';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/what_we_do.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else if ($url == 'talk_to_expert') {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['content'] = $this->Web_model->getSMSContent('10');
                $data['title'] = 'Talk To An Expert';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/talk_to_expert.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            }
            /* else
              { */
            /* $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */

            /* if($_SESSION['userdata']['guest_logged_in']==false)
              {
              $data['categories'] = $this->Web_model->getHomeLimitCategories();

              $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data);
              } */
//redirect('web');
//}
        }
        $this->data['user_id'] = $_SESSION['userdata']['user_id'];

        $qry = $this->db->query("select * from categories where status=1 order by priority asc limit 4");
        $this->data['categories'] = $qry->result_array();
    }

    function index() {

        $user_id = $_SESSION['userdata']['user_id'];
        $membership_check_qry=$this->db->query("select * from users where id='".$user_id."'");
        $member_result=$membership_check_qry->row();
        $date= date('Y-m-d');
        // print_r($date);
        // print_r($member_result->expiry_member_date);
        // exit;die;
        if($member_result->membership == ''||$member_result->membership =='no'){

        }
        else if($member_result->membership == 'yes'  && $member_result->expiry_member_date <= $date && $member_result->plan!=0 && $member_result->plan!='' && $member_result->plan!='0' && $member_result->plan!=null){
            $this->db->where('id',$user_id);
            $array_user= array(
                'membership'=>'no',
                'plan'=>'',
                'created_member_date'=>'',
                'expiry_member_date'=>''
            );
            $this->db->update('users',$array_user);
        }
        $data['banners'] = $this->Web_model->getBanners($user_id);
        $data['categories'] = $this->Web_model->getHomeLimitCategories();

        $data['topdeals'] = $this->Web_model->getTopDeals($user_id);

        $data['new_arrival'] = $this->Web_model->getTopDeals($user_id, 'new');
        // print_r($data['topdeals']);die;
        // $data['trending'] = $this->Web_model->getTrendingProducts($user_id, 'limit');
        $data['trending'] = $this->Web_model->getTrendingProducts($user_id);

//echo "<pre>";  print_r($data['topdeals']); die;
        //$data['trending'] = $this->Web_model->getmostViewedProducts($user_id);
        $data['home_video'] = $this->Web_model->home_videos();

        $data['bannerads'] = $this->Web_model->getBannerads($user_id);

        $data['lastbannerads'] = $this->Web_model->getLastBannerads($user_id);

        $data['social_media_links'] = $this->Web_model->socialMediaLinks();

        //$data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
        $data['testimo'] = $this->Web_model->testimonial();
        $data['partners'] = $this->db->where('status', 1)->get('our_partners')->result();

        $session_id = $_SESSION['session_data']['session_id'];
        // $qry = $this->db->query("select id from products");
        
        // $product_row = $qry->row();
        //  $product_ids=[];
        // echo "<pre>";
        // print_r($qry);
        // exit;
        $rate=[];
        // echo "<pre>";
        foreach ($data['topdeals'] as $row){
            // print_r($row);
        $rating_arr = $this->web_model->rating_data($row['id']);
        // print_r($rating_arr);

        if ($rating_arr['rating_data'] > 0) {
            $formula = ($rating_arr['review5'] * 5 + $rating_arr['review4'] * 4 + $rating_arr['review3'] * 3 + $rating_arr['review2'] * 2 + $rating_arr['review1'] * 1) / $rating_arr['rating_data'];
    
            $rate[] = ["product_id" => $row['id'], "rating" => $formula];
        }
    }
   $rate1=[];
   foreach ($data['new_arrival'] as $row){
    // print_r($row);
$rating_arr1 = $this->web_model->rating_data($row['id']);
// print_r($rating_arr);

if ($rating_arr1['rating_data'] > 0) {
    $formula = ($rating_arr1['review5'] * 5 + $rating_arr1['review4'] * 4 + $rating_arr1['review3'] * 3 + $rating_arr1['review2'] * 2 + $rating_arr1['review1'] * 1) / $rating_arr1['rating_data'];

    $rate1[] = ["product_id" => $row['id'], "rating" => $formula];
}
}
$rate2=[];
foreach ($data['trending'] as $row){
 // print_r($row);
$rating_arr2 = $this->web_model->rating_data($row['id']);
// print_r($rating_arr);

if ($rating_arr2['rating_data'] > 0) {
 $formula = ($rating_arr2['review5'] * 5 + $rating_arr2['review4'] * 4 + $rating_arr2['review3'] * 3 + $rating_arr2['review2'] * 2 + $rating_arr2['review1'] * 1) / $rating_arr2['rating_data'];

 $rate2[] = ["product_id" => $row['id'], "rating" => $formula];
}
}

        // if ($qry->num_rows() > 0) {
            
            // $product_ratings = []; 
    // foreach ($qry->result() as $row) {
        // $product_id = $row->id;
        // $data['product_id']=$product_id;
  
        // $data['user_id'] = $user_id;
        // $data['rating'] = $this->Web_model->rating_data($product_id);
        
       
        // $product_ratings[$product_id] = $data['rating'];}
        // echo "<pre>"; 
        // print_r($product_ratings);
        // $data['product_ratings'] = $product_ratings;
        // } else {
            // echo "No records found.";
        // }
       
       
// exit;
$data['rating'] = $rate;
$data['rating1']=$rate1;
$data['rating2']=$rate2;
// print_r($data['rating1']);
// exit;
        $data['title'] = 'Dashboard';
        $data['page'] = 'home';
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/index.php', $data);
        $this->load->view("web/includes/footerone", $this->data);
    }

    function view_subcategories($seo_url) {

        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        $config = array();
        $config["base_url"] = base_url() . "web/view_subcategories/" . $seo_url;
        // print_r($config);
        // $this->pagination->initialize($config);
        $data['banners'] = $this->Web_model->getBanners($user_id);
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['sub_categories'] = $this->Web_model->allSubCategories($seo_url);
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $data['base_url']=$config;
        $data['active_category_url']=$seo_url;
//echo "<pre>"; print_r($data['sub_categories']); die;
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/subcategorylist.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function filter_products_by_questionary() {
         $match_found=[];

        $cat_id = $this->input->get_post('cat_id');
        $sub_cat_id = $this->input->get_post('sub_cat_id');
        $question_id = $this->input->get_post('question_id');
        $ques_options = $this->input->get_post('ques_options');
        $message = $this->input->get_post('message');
        //get from product view page if coming
        $ques_option_arr = explode(",", $this->input->get_post('ques_option_str'));

        //filters--------------
        if ($this->input->get_post('amount_range')) {
            $amount_range_get = $this->input->get_post('amount_range');
            $amount_range_arr = explode('-', $amount_range_get);
            $start_amount = trim(str_replace('Rs.', '', $amount_range_arr[0]));
            $end_amount = trim(str_replace('Rs.', '', $amount_range_arr[1]));
            $data['min_price'] = $start_amount;
            $data['max_price'] = $end_amount;
        } else {
            $data['min_price'] = 1;
            $data['max_price'] = 5000;

//            $start_amount = 1;
//            $end_amount = 5000;
        }

        if ($this->input->get_post('brand_id')) {
            $brand_id = $this->input->get_post('brand_id');
            $data['brand_checked'] = implode(",", $brand_id);
        }

        if ($this->input->get_post('filter')) {
            $option = $this->input->get_post('option');
            if ($option) {
                $filter = $this->input->get_post('filter');
                $data['filter'] = implode(",", $filter);
                $data['option'] = implode(",", $option);
            }
        }

        if ($ques_options) {
            $data['ques_options'] = implode(",", $ques_options);
        } else {
            $data['ques_options'] = implode(",", $ques_option_arr);
        }

        $data['message'] = $message;
        $data['sub_cat_id'] = $sub_cat_id;
        $data['question_id'] = $question_id;

        //filters-----------------
        // echo "<pre>";
        // print_r($data);

        if (!empty($cat_id) && $cat_id > 0 && !empty($question_id) && $question_id > 0) {
            $chk_category = $this->common_model->count_rows_with_conditions('categories', ['id' => $cat_id, 'status' => 1]);
            $chk_question = $this->common_model->count_rows_with_conditions('questionaries', ['id' => $question_id, 'status' => 1]);
            if ($chk_category == 1 && $chk_question == 1) {
                $category = $this->common_model->get_data_row(['id' => $cat_id, 'status' => 1], 'categories');

                if (empty($sub_cat_id)) {
                    $products_get = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'ques_id' => $question_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
                } elseif (!empty($sub_cat_id)) {
                    $products_get = $this->common_model->get_data_with_condition(['sub_cat_id' => $sub_cat_id, 'ques_id' => $question_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
                }

                //check for available products
                $products = [];
                // echo "<pre>";
                // print_r($products_get);
                // exit;
                // $rating=array();
                // echo "<pre>";print_r($products_get); echo "</pre>";  
                // exit;
                // $rating1=[];
                // $rating=[];
                $rate=[];
                foreach ($products_get as $product) {
                    
                    // $rating_arr1= $this->Web_model->rating_data($product->id);
                    // print_r($rating_arr1);
 
                    // array_push($rating1, $rating_arr1);
                    // exit;
                    // echo "<pre>";
                    $rating_arr = $this->web_model->rating_data($product->id);

                    if ($rating_arr['rating_data'] > 0) {
                        $formula = ($rating_arr['review5'] * 5 + $rating_arr['review4'] * 4 + $rating_arr['review3'] * 3 + $rating_arr['review2'] * 2 + $rating_arr['review1'] * 1) / $rating_arr['rating_data'];
                
                        $rate[] = ["product_id" => $product->id, "rating" => $formula];
                    }
                    // print_r($rate);
                    // exit;
                    // array_push($rating, $rating_arr);
                    

                    $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
                    $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                    // echo "<pre>";
                    // print_r($stockArr);
                    // exit;
                    $stock = sizeof($stockArr);
                    $output = (array) $ques_options;
                    if (sizeof($output) > 0) {
                        if (empty($message)) {
                            $match_found = array_intersect($ques_options, explode(',', $product->option_id));
                        } elseif ($message) {
                            $this->db->like('option', $message);
                            $all_options = $this->common_model->get_data_with_condition(['ques_id' => $question_id], 'options');
                            if (sizeof($all_options) > 0) {
                                $match_found = ["1"];
                            }
                        }
                    } else {
                        if (empty($message)) {
                            $match_found = array_intersect($ques_option_arr, explode(',', $product->option_id));
                        } elseif ($message) {
                            $this->db->like('option', $message);
                            $all_options = $this->common_model->get_data_with_condition(['ques_id' => $question_id], 'options');
                            if (sizeof($all_options) > 0) {
                                $match_found = ["1"];
                            }
                        }
                    }

                    if ($chk_shop_status == 1 && $stock > 0 && sizeof($match_found) > 0) {
                        if (empty($start_amount) && empty($end_amount) && empty($brand_id) && empty($filter) && empty($option)) {
                            array_push($products, $product);
                        } else {
                            //filter here
                            $apply_filter = $this->common_model->apply_filter($product->id, $start_amount, $end_amount, $brand_id, $filter, $option);
                            if ($apply_filter == 1) {
                                array_push($products, $product);
                            }
                        }
                    }
                }
              
                // $data['rating']=$rating;

                
               
                // print_r($rating);
                $brands_get = [];
                $filter_data = [];
                // echo "<pre>";print_r($products); echo "</pre>";
                // exit;
                
                foreach ($products as $row) {
                    
                    $row->variant = $this->common_model->get_data_row(['product_id' => $row->id, 'stock >' => 0, 'status' => 1], 'link_variant', 'id', 'desc');
                    if ($this->data['user_id'] == true) {
                        $is_in_wish_list = $this->common_model->get_data_row(['variant_id' => $row->variant->id, 'user_id' => $this->data['user_id']], 'whish_list');
                        if ($is_in_wish_list) {
                            $row->whishlist_status = true;
                        } else {
                            $row->whishlist_status = false;
                        }

                        //check already in cart or not
                        $session_id = $_SESSION['session_data']['session_id'];
                        $row->in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $row->variant->id])->get('cart')->num_rows();
                    } else {
                        $row->whishlist_status = false;
                    }
                    $product_image = ($this->common_model->get_data_row(['variant_id' => $row->variant->id], 'product_images', $order_by_column = 'id', $order_by = 'asc'))->image;
                    if ($product_image) {
                        $row->product_image = $product_image;
                    } else {
                        $row->product_image = 'noproduct.png';
                    }
                    // $product_filters = $this->common_model->get_data_with_condition(['product_id' => $row->id], 'product_filter');
                    

                    // if (sizeof($product_filters) > 0) {
                    //     foreach ($product_filters as $fil) {
                    //         $filter_data[$fil->id]['product_id'] = $fil->product_id;
                    //         $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                    //         $filter_data[$fil->id]['option'] = $fil->filter_options;
                    //     }
                    // }
                    // if (!empty($row->brand)) {
                    //     array_push($brands_get, $row->brand);
                    // }
                }
                $brand_id_array = [];
                $brands_get = [];
                
                foreach ($products_get as $prod) {
                    $brand_id_array[] = $prod->brand;
                    $product_filters = $this->common_model->get_data_with_condition(['product_id' => $prod->id], 'product_filter');
                    // echo "<pre>";
                    // print_r($product_filters);
                    if (sizeof($product_filters) > 0) {
                        foreach ($product_filters as $fil) {
                            // print_r($fil);
                            $filter_data[$fil->id]['product_id'] = $fil->product_id;
                            $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                            $filter_data[$fil->id]['option'] = $fil->filter_options;
                        }
                    }
                }
                
                // Loop through all brand IDs
                foreach ($brand_id_array as $br) {
                    $query1 = $this->db->query("SELECT * FROM attr_brands WHERE id='" . $br . "'");
                    $query1_res = $query1->result();
                
                    // Loop through results for each brand
                    foreach ($query1_res as $res) {
                        // print_r($res->id); // Debugging
                        array_push($brands_get, $res->id);
                    }
                }
// echo "<pre>";print_r($brands_get); echo "</pre>";
// exit;
                //store customer entered message
                if (!empty($message)) {
                    $ins_data['user_id'] = $this->data['user_id'];
                    $ins_data['ques_id'] = $question_id;
                    $ins_data['message'] = $message;
                    $ins_data['created_at'] = time();
                    $chk_duplicacy = $this->common_model->count_rows_with_conditions('questionary_other_message', ['user_id' => $this->data['user_id'], 'ques_id' => $question_id, 'message' => $message]);
                    if ($chk_duplicacy == 0) {
                        $this->common_model->insert_data_get_id('questionary_other_message', $ins_data);
                    }
                    //if subcat id available redirect to subcat related products (as per client)
                    // echo "<pre>";
                    // print_r($ins_data);
                    // exit;
                    
                    if ($sub_cat_id) {
                        $sub_seo = $this->common_model->get_data_row(['id' => $sub_cat_id], 'sub_categories')->seo_url;
                       
                        redirect(base_url().'sub-cat-products/' . $sub_seo);
                      
                    }
                   
                }
                // echo "<pre>";
                // print_r($sub_seo);
            //    exit;
                

                $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));
                // echo "<pre>";
                // print_r( $unique_filter_ids);
                // exit;
                
                $data['categories'] = $this->data['categories'];
                $data['category'] = $category;
                $data['products'] = $products;
                $data['filters'] = $filter_data;
                $data['brands'] = $brands_get;
                $data['unique_filter_ids'] = $unique_filter_ids;
                // $rating=[];
                // if($rating_arr['rating_data']>0){
                    // array_push($rating,$rate);
                //  $data['rating']=$rate;
                // }
                // $data['rating']=$rating;
                // $data->rating=$rate;
                
                // echo "<pre>";
                // $data['rating']=$rate;
                // print_r($data['rating']);
                $data['rating'] = $rate;
                // print_r($data['rating']);
                // exit;
                // echo "<pre>";
                // $rating=array();
                // foreach($data['products'] as $pro){
                    // print_r($pro);
                    // $rating[]=$this->web_model->get_data_rating($pro->id);
                    // print_r($data['rating']);
                // }
                
        // exit;
        // echo "<pre>";
        // print_r($data);
        // exit;
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/products', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                redirect('web');
            }
        } else {
            redirect('web');
        }
    }

    function common_filter() {

        $cat_id = $this->input->post('cat_id');
        $sub_cat_id = $this->input->post('sub_cat_id');
        $question_id = $this->input->post('question_id');
        $ques_options = $this->input->post('ques_options');
        $message = $this->input->post('message');

        $data['cat_id'] = $cat_id;
        $data['sub_cat_id'] = $sub_cat_id;
        $data['question_id'] = $question_id;
        $data['ques_options'] = $ques_options;
        $data['searchdata'] = $searchdata;
       
        if ($cat_id != '') {
            $this->db->where("cat_id", $cat_id);
        }

        if ($sub_cat_id != '') {
            $this->db->where("sub_cat_id", $sub_cat_id);
        }
        //print_r($this->input->post()); die;
        $products = $this->db->get("products")->result();
        // echo "<pre>";
        // print_r($products);
        // exit;
        
        
        // $rating=[];
        foreach ($products as $product_value) {
            $product_filters = $this->common_model->get_data_with_condition(['product_id' => $product_value->id], 'product_filter');

            if (sizeof($product_filters) > 0) {
                foreach ($product_filters as $fil) {
                    $filter_data1[$fil->id]['product_id'] = $fil->product_id;
                    $filter_data1[$fil->id]['filter_id'] = $fil->filter_id;
                    $filter_data1[$fil->id]['option'] = $fil->filter_options;
                }
            }
        }
        //echo $this->db->last_query(); die;
        $data['brands'] = array_unique(array_column($products, 'brand'));

        $data['unique_filter_ids'] = array_unique(array_column($filter_data1, 'filter_id'));
        //print_r($data); die;
        $data['products'] = $this->Web_model->common_filter($cat_id, $sub_cat_id, $question_id, $ques_options, $message);
        

        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/filter_products', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function store($seo_url, $cateurl) {

        if ($this->uri->segment(6) == 'search_data') {
            $data['search_title'] = $this->uri->segment(5);
        } else {
            $data['search_title'] = 'nodata';
        }

        $data['search'] = 'show';
        $qry = $this->db->query("select * from vendor_shop where seo_url='" . $seo_url . "'");
        $vendor_row = $qry->row();
        $vendor_id = $vendor_row->id;

        $data['shop_id'] = $vendor_id;
        $data['shop_name'] = $vendor_row->shop_name;
        $data['cat_url'] = $cateurl;
        $data['subcat_url'] = "nosubcat";
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['vendor_id'] = $vendor_id;
            $data['vendor_seo_url'] = $vendor_row->seo_url;
            $chk = $this->Web_model->getVendorBanners($vendor_id, $user_id);
            $data['banners'] = $chk['bannerslist'];

            $data['categories'] = $this->Web_model->getHomeLimitCategories();

            $data['banneradd1'] = $chk['banneradd1'];
            $data['banneradd2'] = $chk['banneradd2'];

            $data['subcategories'] = $this->Web_model->getcategoryWithshopID($vendor_id);

            $data['best_selling_products'] = $this->Web_model->bestSeller($vendor_id, $user_id);
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
//echo "<pre>"; print_r($data['subcategories']); die;
            $data['title'] = 'Store details';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/store_view.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $guest_user_id = $_SESSION['userdata']['guest_user_id'];
            if ($guest_user_id != '') {
                $user_id = 'guest';
                $data['vendor_id'] = $vendor_id;
                $data['vendor_seo_url'] = $vendor_row->seo_url;
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $chk = $this->Web_model->getVendorBanners($vendor_id, $user_id);
                $data['banners'] = $chk['bannerslist'];
//print_r($data['banners']); die;
                $data['banneradd1'] = $chk['banneradd1'];
                $data['banneradd2'] = $chk['banneradd2'];

                $data['subcategories'] = $this->Web_model->getcategoryWithshopID($vendor_id);
                $data['best_selling_products'] = $this->Web_model->bestSeller($vendor_id, $user_id);
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
//print_r($data['best_selling_products']); die;
                $data['title'] = 'Store details';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/store_view.php', $data);
                $this->load->view("web/includes/header_styles", $this->data);
            } else {
                $data['location'] = $_SERVER['REQUEST_URI'];
                $data['title'] = 'Dashboard';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/index.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            }
        }
    }

    function checkout() {
        $user_id = $_SESSION['userdata']['user_id'];

        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
          

            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {

            $chk = $this->Web_model->checkValidLocation($user_id);

            if ($user_id != null && $chk == true) {
                $session_id = $_SESSION['session_data']['session_id'];
                $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                $del_b = $qry->row();
                $data['shop_id'] = $del_b->vendor_id;
                $shop_qry = $this->db->query("select * from vendor_shop where id='" . $del_b->vendor_id . "'");
                $shop_row = $shop_qry->row();
                $data['shop_name'] = $shop_row->shop_name;
                $data['city'] = $shop_row->city;
                $data['seo_url'] = $shop_row->seo_url;
                if ($qry->num_rows() > 0) {
                    $where = array("session_id" => $session_id);
                    $array = array("check_out" => 1);
                    $this->db->update("cart", $array, $where);
                    $data['firstname']=$users_check->first_name;
                    $data['lastname']=$users_check->last_name;
                    $data['email']=$users_check->email;
                    $data['user_id']=$user_id;
                    $data['categories'] = $this->Web_model->getHomeLimitCategories();
                    
                    $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                    $results = $qry->result();
                    $total_cart_amount=0;
                    foreach($results as $result){
                        $total_cart_amount+=$result->unit_price;
                        
                    }
                    // print_r( $total_cart_amount);
                    // exit;
                   
                    $data['addresslist'] = $this->Web_model->getAddress($user_id);
                    $data['states'] = $this->Web_model->getstates();
                    $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                    $data['title'] = 'Check Out';

                    $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                    $results = $qry->result();
                    // echo "<pre>";
                    // print_r($results);
                    // exit;
                    $result = [];
                    $brands_array=[];
                    // echo "<pre>";
                    foreach ($results as $res) {
                        $price=$res->price;
                        // print_r($price);
                        // exit;
                        $shop = $this->db->where(['id' => $res->vendor_id, 'status' => 1])->get('vendor_shop')->num_rows();
                        if ($shop > 0) {
                            $chk_quant_qry = $this->db->query("select * from link_variant where id='" . $res->variant_id . "' and status = 1 and stock > 0 and saleprice > 0");
                            $chk_quant_row = $chk_quant_qry->row();
                            if ($chk_quant_row) {
                                $product_id = $chk_quant_row->product_id;
                                $qry_result = $this->db->query("select * from link_variant where product_id='" . $product_id . "'");
                                $res1 = []; // Initialize 'number' array for this iteration
                                $res1['number'] = $qry_result->result();

                                $res1['product_id']=$product_id;

                    
                                $products_get = $this->common_model->get_data_row(['id' => $product_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
                                $brands_get=$this->common_model->get_data_row(['id' => $products_get->brand, 'status' => 1], 'attr_brands');
                                // echo "<pre>";
                                // print_r($brands_get);
                                array_push($brands_array,$brands_get->brand_name);
                                // exit;
                                if ($products_get || $brands_get) {
                                    $category = $this->common_model->get_data_row(['id' => $products_get->cat_id, 'status' => 1], 'categories');
                                    if ($category) {
                                        $res->number = $res1['number']; // Assign 'number' array to the current result
                                        array_push($result, $res);
                                        // array_push($result,);
                                       
                                        // print_r($result);
                                        // exit;

                                        $res->product_id= $res1['product_id'];
                                        $brandname=$brands_get->brand_name;
                                        $res->brand_name=$brandname;
                                       

                                    } else {
                                        $this->db->where(['session_id' => $res->session_id, 'variant_id' => $res->variant_id])->delete('cart');
                                        redirect('web/checkout');
                                    }
                                } else {
                                    $this->db->where(['session_id' => $res->session_id, 'variant_id' => $res->variant_id])->delete('cart');
                                    redirect('web/checkout');
                                }
                            } else {
                                $this->db->where(['session_id' => $res->session_id, 'variant_id' => $res->variant_id])->delete('cart');
                                redirect('web/checkout');
                            }
                        } else {
                            $this->db->where(['session_id' => $res->session_id, 'variant_id' => $res->variant_id])->delete('cart');
                            redirect('web/checkout');
                        }
                    }
                    // exit;
                    $data['coupons'] = $this->Web_model->getCouponcodes($user_id, $session_id,$brands_array, $total_cart_amount);
                    $data['result']=$result;
                    $prime_query=$this->db->query("select * from prime_table");
                    $prime_result=$prime_query->result();
                    $data['prime']=$prime_result;
                    // echo "<pre>";
                    // print_r($data['result']);
                    // exit;
                    
                    
                    // $data['products']=$products;
                    // print_r($data['products']);
                    
                    // exit;
                    $this->load->view("web/includes/header_styles", $this->data);
                    $this->load->view('web/cart.php', $data);
                    $this->load->view("web/includes/footer", $this->data);
//$this->load->view('web/checkout.php',$data);
                } else {

//                $data['banners'] = $this->Web_model->getBanners($user_id);
//                $data['categories'] = $this->Web_model->getHomeLimitCategories();
//                $data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
//                $data['topdeals'] = $this->Web_model->getTopDeals($user_id);
//                $data['trending'] = $this->Web_model->getmostViewedProducts($user_id);
//                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
//                $data['title'] = 'Dashboard';
//                $this->load->view("web/includes/header_styles", $this->data);
//                $this->load->view('web/index.php', $data);
//                $this->load->view("web/includes/footer", $this->data);
                    $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                    $results = $qry->result();
                    $total_cart_amount=0;
                    foreach($results as $result){
                        $total_cart_amount+=$result->unit_price;
                        
                    }
                    $prime_query=$this->db->query("select * from prime_table");
                    $prime_result=$prime_query->result();
                    $data['prime']=$prime_result;
                    $data['categories'] = $this->Web_model->getHomeLimitCategories();
                    $data['coupons'] = $this->Web_model->getCouponcodes($user_id, $session_id,$brandname, $total_cart_amount);
                    $data['addresslist'] = $this->Web_model->getAddress($user_id);
                    $data['states'] = $this->Web_model->getstates();
                    $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                    $data['title'] = 'Check Out';

                    $this->load->view("web/includes/header_styles", $this->data);
                    $this->load->view('web/cart.php', $data);
                    $this->load->view("web/includes/footer", $this->data);
                }
            } else {
                $data['location'] = $_SERVER['REQUEST_URI'];

                $data['title'] = 'Dashboard';
                redirect('web');
            }
        }
    }

    function selectVariant() {
        $variant_id = $this->input->post('variantId');
        $cartid = $this->input->post('id');
        $session_id = $this->input->post('session_id');
        $user_id = $this->input->post('user_id');
        $vendor_id = $this->input->post('vendor_id');
        $status = $this->input->post('status');
        $cartstatus = $this->input->post('cartstatus');
        $checkout = $this->input->post('checkout');
        $ischeckout = $this->input->post('ischeckout');
        $quantity = $this->input->post('quantity');
        $default = $this->input->post('defaultvar');
        
        $price = $this->input->post('price');
        $salePrice = $this->input->post('salePrice');
        $product_id=$this->input->post('productId');
        $unitprice= $price * $quantity;
        $array=array(
'id'=>$cartid,
'session_id'=>$session_id,
'variant_id'=>$variant_id,
'vendor_id'=>$vendor_id,
'user_id'=>$user_id,
'price'=>$price,
'quantity'=>$quantity,
'unit_price'=> $unitprice,
'status'=>$status,
'cart_status'=>$cartstatus,
'check_out'=>$checkout,
'is_checkout'=>$ischeckout

        );
        $this->db->where('id',$cartid);
       $update= $this->db->update('cart',$array);

    }
    
    function selectWishlist(){
        $variant_id = $this->input->post('variantId');
        $price = $this->input->post('price');
        $user_id = $this->input->post('user_id');
        $salePrice = $this->input->post('salePrice');
        $wishlistId = $this->input->post('wishlistId');
        $defaultvar = $this->input->post('defaultvar');

        $array= array(
'id'=>$wishlistId,
'user_id'=>$user_id,
'variant_id'=>$variant_id,
'created_date'=>time()
        );

        $this->db->where('id',$wishlistId);
        $update=$this->db->update('whish_list',$array);
    }

    function changeLocation() {

        if ($_SESSION['userdata']['logged_in'] == true) {
            /* $data['categories'] = $this->Web_model->getHomeLimitCategories();
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */
            redirect('web');
        }
    }

    function updateCart() {
        $user_id = $_SESSION['userdata']['user_id'];
        $cartid = $this->input->post('cartid');
        $quantity = $this->input->post('quantity');
        $chk = $this->Web_model->updateCart($cartid, $quantity);
        die;
    }

    function changeQuantity() {
       
        $cartid = $this->input->post('id');
        $quantity = $this->input->post('quantity');
        $variant_id = $this->input->post('variantId');
        $session_id = $this->input->post('session_id');
        $user_id = $this->input->post('user_id');
        $vendor_id = $this->input->post('vendor_id');
        $status = $this->input->post('status');
        $cartstatus = $this->input->post('cartstatus');
        $checkout = $this->input->post('checkout');
        $ischeckout = $this->input->post('ischeckout');
        
        
        $price = $this->input->post('price');
        $unitprice= $price * $quantity;
        $chk_quant_qry = $this->db->query("select * from link_variant where id='" . $variant_id . "'");

        $chk_quant_row = $chk_quant_qry->row();
        
        $products_get = $this->common_model->get_data_row(['id' => $chk_quant_row->product_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');

        $stock = $chk_quant_row->stock;
        

        $qty = $quantity;

        $quantity_f = $quantity;

        if ($stock < $quantity_f) {
            $msg = "Left only " . $stock . " Products";
            echo '@error@' . $msg;
            die;
            //return array('status' =>FALSE,'message'=>$msg);
        }
        
        if($quantity > $products_get->cart_limit) {
                    echo '@cart_limit@'.$products_get->cart_limit;  
                    die;
                }

        // $unitprice = $quantity * $price;

        // $upd = $this->db->update("cart", array('quantity' => $quantity, 'unit_price' => $unitprice), array('id' => $cartid));

        $array=array(
'id'=>$cartid,
'session_id'=>$session_id,
'variant_id'=>$variant_id,
'vendor_id'=>$vendor_id,
'user_id'=>$user_id,
'price'=>$price,
'quantity'=>$quantity,
'unit_price'=> $unitprice,
'status'=>$status,
'cart_status'=>$cartstatus,
'check_out'=>$checkout,
'is_checkout'=>$ischeckout

        );
        $this->db->where('id',$cartid);
       $update= $this->db->update('cart',$array);
       
    }

    function checklimit_cart() {
        $variant_id = $this->input->post('variant_id');
        $quantity = $this->input->post('quantity');
        $product_id = $this->db->where('id', $variant_id)->get('link_variant')->row()->product_id;
        $cart_limit = $this->db->where('id', $product_id)->get('products')->row()->cart_limit;
        if ($quantity <= $cart_limit) {
            echo 'available';
        } else {
            echo $cart_limit;
        }
    }

    function removeCart() {
        $user_id = $_SESSION['userdata']['user_id'];
        $cartid = $this->input->post('cartid');
        $quantity = $this->input->post('quantity');
        $chk = $this->Web_model->descrementCart($cartid, $quantity);
        die;
    }

    function applycoupon() {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $coupon_code = $this->input->post('couponcode');
        $grand_total = $this->input->post('carttotal');
        $total_amount = $this->input->post('total_amount');
        $products=$this->input->post('products');
        
        // print_r($dataToSend);
        // exit;die;
        $chk = $this->Web_model->applyCoupon($coupon_code, $session_id, $grand_total, $total_amount, $user_id,$products);
    }

    function goaddress_page() {
        $user_id = $_SESSION['userdata']['user_id'];

        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {

            $data['coupon_id'] = $this->input->post('coupon_id');
            $data['coupon_code'] = $this->input->post('applied_coupon_code');
            $data['coupon_discount'] = $this->input->post('coupon_discount');
            $data['gst'] = $this->input->post('gst');
            $user_id = $_SESSION['userdata']['user_id'];
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $chk = $this->Web_model->checkValidLocation($user_id);
            if ($user_id != null && $chk == true) {
                $session_id = $_SESSION['session_data']['session_id'];
                $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
// print_r($qry->result()); die;
                $del_b = $qry->row();
                if ($qry->num_rows() > 0) {
                    $data['addresslist'] = $this->Web_model->getAddress($user_id);
                    $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                    $data['states'] = $this->Web_model->getstates();
                    $data['title'] = 'Check Out';
                    $data['payment_mode'] = $this->common_model->get_data_row(['id' => 1], 'payment_mode');

                    $this->load->view("web/includes/header_styles", $this->data);
                    $this->load->view('web/checkout.php', $data);
                    $this->load->view("web/includes/footer", $this->data);
                } else {
                    $data['banners'] = $this->Web_model->getBanners($user_id);
                    $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                    //$data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
                    $data['topdeals'] = $this->Web_model->getTopDeals($user_id);
                    $data['trending'] = $this->Web_model->getmostViewedProducts($user_id);
                    $data['title'] = 'Dashboard';
                    $this->load->view("web/includes/header_styles", $this->data);
                    $this->load->view('web/index.php', $data);
                    $this->load->view("web/includes/footer", $this->data);
                }
            } else {
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */

                redirect('web');
            }
        }
    }

    function checkcartitem() {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];

        $cart_item = $this->Web_model->checkcart_value($user_id, $session_id);
        echo $cart_item;
    }

    function goaddress_bidpage() {
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $session_id = $_SESSION['session_data']['session_id'];
            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
            $del_b = $qry->row();
        }
    }

    function about_us() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('4');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'About Us';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/about_us.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function contact_us() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $this->db->where('name', 'Contact');
            $query = $this->db->get('features');
            $feature = $query->row();
    
            if ($feature && $feature->status == 1) {
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['contactinfo'] = $this->Web_model->getContactDetails();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['title'] = 'Contact Us';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/contact_us.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                // Redirect to a different page
                echo "Feature is not available.";
                exit(); 
            }
        }
    }

    function privacy_policy() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('2');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Privacy Policy';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/privacy_policy.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function refund_policy() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('6');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Refund Policy';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/refund_policy.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function terms_and_conditions() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('1');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Terms and Conditions';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/terms_and_conditions.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function delivery_partner() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('7');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Delivery Partner';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/terms_and_conditions.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function shipping_policy() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('8');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Shipping Policy';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/terms_and_conditions.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function what_we_do() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('9');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'What We Do';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/what_we_do.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function talk_to_expert() {
        if ($_SESSION['userdata']['logged_in'] == true) {
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['content'] = $this->Web_model->getSMSContent('10');
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Talk To An Expert';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/talk_to_expert.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }


    function userRegister() {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $phone = $this->input->post('mobile');
        $token = "";

        $data = array('first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password, 'phone' => $phone, 'token' => $token);
//print_r($data);
        $chk = $this->doRegister($data);
        die;
    }

    // function doRegister($data) {

    //     $email = $data['email'];

    //     $phone = $data['phone'];

    //    $otp = rand(1111, 9999);
    //    $otp1 = rand(1111, 9999);
 
    //     // $otp = 1234;
    //     // $otp1 = 1234;

    //     $otp_message = "Dear customer " . $otp . " is OTP to register with Absolute Mens. Pls do not share OTP to anyone for security reasons. Thanks and Regards Absolute Mens";
    //     $otp_message1 = "Dear Customer, <br>This is to inform you that your OTP for registration is " . $otp1 . ". <br>Please use this OTP to complete your registration and to begin enjoying our services. <br>We thank you for registering with us and look forward to a long and fruitful relationship. <br>Regards, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";

    //     $template_id = '1407165995845244807';

    //     $data['otp'] = $otp;
    //     $data['email_otp'] = $otp1;

    //     $email_verify = $this->db->query("select * from users where email='" . $email . "'");

    //     $phone_verify = $this->db->query("select * from users where phone='" . $phone . "'");

    //     $both = $this->db->query("select * from users where email='" . $email . "' and phone='" . $phone . "' and otp_status=1 and email_otp_status=1");

    //     if ($email_verify->num_rows() > 0) {

    //         echo '@invalid_email';
    //         exit;
    //     } else if ($phone_verify->num_rows() > 0) {

    //         echo '@invalid_phone';
    //         exit;
    //     } else if ($both->num_rows() > 0) {

    //         echo '@both';
    //         exit;
    //     } else {

    //         $chk_both = $this->db->query("select * from users where ( email='" . $email . "' or phone='" . $phone . "' ) and otp_status=0 and email_otp_status=0");

    //         if ($chk_both->num_rows() > 0) {

    //             $get = $chk_both->row();

    //             $wr = array('phone' => $phone);

    //             $ins = $this->db->update("users", $data, $wr);

    //             $last_id = $get->id;

    //             if ($ins) {

    //                 echo '@success@' . $last_id;
    //                 // echo '@success@' . $last_id;
    //                 exit;
    //             }

    //             //}
    //         } else {

    //             $this->web_model->send_message($otp_message, $phone, $template_id);

    //             //send mail otp for forgot password

    //             $config1['protocol'] = MAIL_PROTOCOL;
    //             $config1['smtp_host'] = MAIL_SMTP_HOST;
    //             $config1['smtp_port'] = MAIL_SMTP_PORT;
    //             $config1['smtp_timeout'] = '7';
    //             $config1['smtp_user'] = MAIL_SMTP_USER;
    //             $config1['smtp_pass'] = MAIL_SMTP_PASS;
    //             $config1['charset'] = MAIL_CHARSET;
    //             $config1['newline'] = "\r\n";
    //             $config1['mailtype'] = 'html'; // or html
    //             $config1['validation'] = TRUE; // bool whether to validate email or not      

    //             $this->email->initialize($config1);

    //             $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
    //             $this->email->to($email);
    //             $this->email->subject('Registration OTP');
    //             $this->email->message($otp_message1);

    //             $this->email->send();
    //             // $data['otp']=$otp;
    //             // $data['email_otp']=$otp1;
    //             // $ins1 = $this->db->insert("users", $data);

    //             // $last_id = $this->db->insert_id($ins);

    //             $ins=$this->session->set_userdata("user",$data);
               

                

    //             if ($data) {

    //                 // echo '@success@' .$otp.'@'. $otp1;
    //                 echo '@success' ;
    //                 // $this->db->where('id',$last_id);
    //                 // $this->db->delete('users',$data);
    //                 exit;
    //             }

    //             //}
    //         }
    //     }
    // }
    function doRegister($data) {

        $email = $data['email'];

        $phone = $data['phone'];

       $otp = rand(1111, 9999);
       $otp1 = rand(1111, 9999);
 
        // $otp = 1234;
        // $otp1 = 1234;

        $otp_message = "Dear customer " . $otp . " is OTP to register with Absolute Mens. Pls do not share OTP to anyone for security reasons. Thanks and Regards Absolute Mens";
        $otp_message1 = "Dear Customer, <br>This is to inform you that your OTP for registration is " . $otp1 . ". <br>Please use this OTP to complete your registration and to begin enjoying our services. <br>We thank you for registering with us and look forward to a long and fruitful relationship. <br>Regards, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";

        $template_id = '1407165995845244807';

        $data['otp'] = $otp;
        $data['email_otp'] = $otp1;

        $email_verify = $this->db->query("select * from users where email='" . $email . "'");

        $phone_verify = $this->db->query("select * from users where phone='" . $phone . "'");

        $both = $this->db->query("select * from users where email='" . $email . "' and phone='" . $phone . "' and otp_status=1 and email_otp_status=1");

        if ($email_verify->num_rows() > 0) {

            echo '@invalid_email';
            exit;
        } else if ($phone_verify->num_rows() > 0) {

            echo '@invalid_phone';
            exit;
        } else if ($both->num_rows() > 0) {

            echo '@both';
            exit;
        } else {

            $chk_both = $this->db->query("select * from users where ( email='" . $email . "' or phone='" . $phone . "' ) and otp_status=0 and email_otp_status=0");

            if ($chk_both->num_rows() > 0) {

                $get = $chk_both->row();

                $wr = array('phone' => $phone);

                $ins = $this->db->update("users", $data, $wr);

                $last_id = $get->id;

                if ($ins) {

                    echo '@success@' . $last_id;
                    exit;
                }

                //}
            } else {

                $this->db->query("CREATE TABLE IF NOT EXISTS OTPs (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    mobile_number VARCHAR(15) NOT NULL,
                    mobile_otp INT NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    email_otp INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )");
    
                $this->db->query("INSERT INTO OTPs (mobile_number, mobile_otp, email, email_otp) VALUES ('$phone', $otp, '$email', $otp1)");
    
                $this->web_model->send_message($otp_message, $phone, $template_id);

                //send mail otp for forgot password

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($email);
                $this->email->subject('Registration OTP');
                $this->email->message($otp_message1);

                $this->email->send();

                $ins=$this->session->set_userdata("user",$data);
               

                

                if ($data) {

                    // echo '#success#' .$email.'#'. $phone;
                    // echo '@success@' .$otp.'@'. $otp1;

                    echo '@success@' ;
                
                    exit;
                }

                //}
            }
        }
    }


    function OTPVerification() {
        $user_id = $this->input->post('user_id');
        $otp = $this->input->post('otp');
        $email_otp = $this->input->post('email_otp');
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $mobile=$this->input->post('mobile');
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        // $otp_mob=$this->input->post('otp_mob');
        // $otp_mail=$this->input->post('otp_mail');
        $otp_record = $this->db->query("SELECT mobile_otp, email_otp FROM OTPs WHERE mobile_number='$mobile' AND email='$email' ORDER BY created_at DESC LIMIT 1")->row();
        $otp_mob = $otp_record->mobile_otp;
        $otp_mail = $otp_record->email_otp;
        // print_r($userdata);
        // exit;
        $chk = $this->Web_model->verify_OTP($user_id, $otp, $email_otp,$first_name,$last_name,$mobile,$email,$password,
        $otp_mob,$otp_mail);
        die;
    }

    function logout() {

        $this->session->unset_userdata('session_data');

        $this->session->unset_userdata('admin_login');
        $this->session->unset_userdata('userdata');
        /* $data['title'] = 'Dashboard';
          $this->load->view('web/index.php',$data); */
        redirect('web');
    }

    function userLogin() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $token = "";
        $chk = $this->Web_model->checkLogin($username, $password, $token);
        die;
    }

    function resendOTP() {
        $user_id = $this->input->post('user_id');
        $chk = $this->Web_model->resendOTP($user_id);
        die;
    }

    function forgotPassword() {
        $phone = $this->input->post('username');
        $chk = $this->Web_model->checkForgot($phone);
        die;
    }

    function change_password() {
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $user_id = $_SESSION['userdata']['user_id'];

        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {

            if ($_SESSION['userdata']['logged_in'] == true) {
                $user_id = $_SESSION['userdata']['user_id'];
                $data['title'] = 'Change Password';
                $data['page'] = 'change_password';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/change_password.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                redirect('web');
            }
        }
    }

    function change_pass() {
        $user_id = $_SESSION['userdata']['user_id'];
        $current_password = md5($this->input->post('current_password'));
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $pass = $this->common_model->get_data_row(['id' => $user_id], 'users')->password;

        if ($pass == $current_password) {
            if ($new_password == $confirm_password) {
                $update = $this->common_model->update_record(['id' => $user_id, 'password' => $pass], 'users', ['password' => md5($new_password)]);
                if ($update) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 'mis_match';
            }
        } else {
            echo 'cur_pas_wrong';
        }
    }

    function send_login_otp() {
        $phone = $this->input->post('username');
        $chk = $this->Web_model->sendloginotp($phone);
        die;
    }

    function verify_login_otp() {
        $otp = $this->input->post('otp');
        $user_mobile = $this->input->post('user_mobile');
        $chk = $this->Web_model->verifyloginotp($otp, $user_mobile);
        die;
    }

    function getStates() {
        $state_id = $this->input->post('state_id');
        $chk = $this->Web_model->fetchCities($state_id);
        die;
    }

    function getpincodes() {
        $state_id = $this->input->post('state_id');
        $city_id = $this->input->post('city_id');
        $vendor_id = $this->input->post('vendor_id');
        $chk = $this->Web_model->getPincodes($state_id, $city_id, $vendor_id);
        die;
    }

    function getaddresspincodes() {
        $state_id = $this->input->post('state_id');
        $city_id = $this->input->post('city_id');
        $chk = $this->Web_model->getaddresspincodes($state_id, $city_id);
        die;
    }

    function resetPassword() {
        $otp = $this->input->post('otp');
        $password = $this->input->post('password');
        $user_id = $this->input->post('user_id');
        $chk = $this->Web_model->resetPassword($user_id, $otp, $password);
        die;
    }

    function myprofile() {
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();

        $user_id = $_SESSION['userdata']['user_id'];

        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {

            if ($_SESSION['userdata']['logged_in'] == true) {
                $user_id = $_SESSION['userdata']['user_id'];
                $data['title'] = 'My Profile';
                $data['profiledata'] = $this->Web_model->profileDetails($user_id);
                $data['firstname']=$users_check->first_name;
                $data['lastname']=$users_check->last_name;
                $data['email']=$users_check->email;
                $data['page'] = 'myprofile';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/my_profile.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                /* $data['title'] = 'Home';
                  $this->load->view('web/index.php',$data); */
                redirect('web');
            }
        }
    }

    function updateUserdata() {
        $user_id = $_SESSION['userdata']['user_id'];
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $mobile=$this->input->post('mobile');
        $email=$this->input->post('email');
        $chk = $this->Web_model->updateProfile($user_id, $first_name, $last_name,$mobile,$email);
        die;
    }

    function myaccount() {
        $data['title'] = 'My Account';
        $data['page'] = 'myaccount';
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $data['data'] = $this->Web_model->myAccount($user_id);
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/my_account.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    // function check_avl_userid(){
    //     $user_id = $_SESSION['userdata']['user_id'];
    //     $users_check = $this->common_model->get_data_row(['id'=>$user_id],'users');
    //      if($users_check->id == ''){
    //     echo 0;
    //      } else { 
    //         echo 1;
    //      }
    // }

    function my_orders() {
//total_orders
        if ($this->uri->segment(3)) {
            $order_status = $this->uri->segment(3);
        } else {
            $order_status = 'total_orders';
        }

        $user_id = $_SESSION['userdata']['user_id'];
        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {
            $chk = $this->Web_model->checkValidLocation($user_id);
            if ($user_id != null && $chk == true) {
                $data['title'] = 'My Orders';
                $data['page'] = 'myorders';
                $user_id = $_SESSION['userdata']['user_id'];
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['orders'] = $this->Web_model->orderList($user_id, $order_status);
                // echo "<pre>";
                // print_r($data['orders']);die;
               
                // print_r($data);
                $ordersdata = $data['orders']['orders'];

                // print_r($ordersdata);
                $sessionIds = [];
                $orderDetailsArray = []; // Array to store order details for each session ID
                
                // Collect all session IDs
                foreach ($ordersdata as $order) {
                    $sessionIds[] = $order['session_id'];
                }
                // echo "<pre>";

                $status_array=[];
                $allOrders = array();

                // Iterate through session IDs and fetch order details for each session
                foreach ($sessionIds as $sessionId) {
                    $orders = $this->common_model->get_data_with_condition(['session_id' => $sessionId], 'orders', 'id', 'desc');
                    // $allOrders = array_merge($allOrders, $orders);
                    $order_status_arr = array_column($orders, 'order_status');
                    // print_r($order_status_arr);exit;
                    $display_status = min($order_status_arr);
                    // print_r($display_status);exit;
                    $max_status = max($order_status_arr);

                    foreach ($orders as $ord) {
                      
                        // print_r($ord->waybill_generated);

                        $ord->order = $this->Web_model->orderDetails($ord->id);
                        // echo "<pre>";
                        // print_r($ord->order);
                        // exit;
                        $ord->order['placed_at'] = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Placed'], 'admin_notifications')->created_date;
                    $ord->order['assign_courier_at'] = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Assigned To Courier'], 'admin_notifications')->created_date;
                    $ord->order['shipped_at'] = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Shipped'], 'admin_notifications')->created_date;
                    $ord->order['delivered_at'] = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Delivered'], 'admin_notifications')->created_date;
                    $ord->order['cancelled_at']= $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Cancelled By Admin'], 'admin_notifications')->created_date;
                    $ord->order['returned_at'] = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Product Return Completed'], 'admin_notifications')->created_date;
                    $data['display_status'] = $display_status;
                    $data['max_status'] = $max_status;

                    $ord->order['waybill_generated']=$ord->waybill_generated;
                    
                    // echo "<pre>";
                   
                    // exit;
                   
               
                    
                        $data['firstname']=$users_check->first_name;
                        $data['lastname']=$users_check->last_name;
                        $data['email']=$users_check->email;
                        $data['sub_total'] = array_sum(array_column($orders, 'sub_total'));
                        $data['shipping_charge'] = array_sum(array_column($orders, 'deliveryboy_commission'));
                        $data['gst'] = array_sum(array_column($orders, 'gst'));
                        $data['grand_total'] = (array_sum(array_column($orders, 'total_price'))) - (float)$orders[0]->coupon_disount;
                    // $orderDetailsArray['waybill_generated']=$ord->waybill_generated;
                        $orderDetailsArray[] = $ord->order; // Store order details in the array
                        if($ord->waybill_generated!='' && $ord->order_status==4){
                            $allOrders[] = $ord;
                        }
                       

                    }
                   
                }
                // echo "<pre>";
                // print_r($orderDetailsArray);
                // exit;
                $this->TrackingAPI($orderDetailsArray);
// exit;

                $data['data']=$orderDetailsArray;
                $prime_query=$this->db->query("select * from prime_table");
                $prime_result=$prime_query->result();
                $data['prime']=$prime_result;
                // var_dump($data);
               

                
                
                
           
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/my_orders.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {


                redirect('web');
            }
        }
    }

    function orderview($session_id, $product_id) {
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
    
        $user_id = $_SESSION['userdata']['user_id'];
    
        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {
    
            $chk = $this->Web_model->checkValidLocation($user_id);
            if ($user_id != null && $chk == true) {
                $data['title'] = 'View Order';
                $orders = $this->common_model->get_data_with_condition(['session_id' => $session_id], 'orders', 'id', 'desc');
                $order_status_arr = array_column($orders, 'order_status');
                $display_status = min($order_status_arr);
                $max_status = max($order_status_arr);
                $selectedOrder = [];
                $selectedProduct = [];
                foreach ($orders as $ord) {
                    $ord->order = $this->Web_model->orderDetails($ord->id);
    
                    $ord->placed_at = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Placed'], 'admin_notifications')->created_date;
                    $ord->assign_courier_at = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Assigned To Courier'], 'admin_notifications')->created_date;
                    $ord->shipped_at = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Shipped'], 'admin_notifications')->created_date;
                    $ord->delivered_at = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Delivered'], 'admin_notifications')->created_date;
                    $ord->cancelled_at = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Order Cancelled By Admin'], 'admin_notifications')->created_date;
                    $ord->returned_at = $this->common_model->get_data_row(['order_id' => $ord->id, 'message' => 'Product Return Completed'], 'admin_notifications')->created_date;
    
                    $cart = $ord->order['ordersdetails']['cartdetails'];
                    $ordersdetails=$ord->order['ordersdetails'];
                    // $cartdetails=$ord->order['ordersdetails']['cartdetails'][0];
                    // echo"<pre>";
                    // print_r($cart);
                    // exit;
    
                    foreach ($cart as $cartItem) {
                        if ($cartItem['product_id'] == $product_id) {
                            $selectedOrder['product_id'] = $cartItem['product_id'];
                            $selectedOrder['product_name']=$cartItem['productname'];
                            $selectedOrder['cartid']=$cartItem['cartid'];
                            $selectedOrder['price']=$cartItem['price'];
                            $selectedOrder['saleprice']=$cartItem['saleprice'];
                            $selectedOrder['quantity']=$cartItem['quantity'];
                            $selectedOrder['total_price']=$cartItem['total_price'];
                            $selectedOrder['image']=$cartItem['image'];
                            $selectedOrder['attributes']=$cartItem['attributes'];
                            $selectedOrder['refund_status']=$cartItem['refund_status'];
                            $selectedOrder['refundmsg']=$cartItem['refundmsg'];
                            $selectedOrder['status']=$cartItem['status'];
                            $selectedOrder['shop_name']=$cartItem['shop_name'];
                           
                            
                            $selectedProduct []= $cartItem;
                            break 2; 
                        }
                    }
                    
    
                  
                }
    
                if ($selectedProduct) {
                   

                    
                    $data['selectedProduct'] = $selectedProduct[0];
                } else {
                   
                    $data['selectedProduct'] = null;
                }
               

                $selectedOrder['id']=$ordersdetails['id'];
                $selectedOrder['bid_status']=$ordersdetails['bid_status'];
                $selectedOrder['session_id']=$ordersdetails['session_id'];
                $selectedOrder['delivery_date']=$ordersdetails['delivery_date'];
                $selectedOrder['delivery_status']=$ordersdetails['order_status'];
                $selectedOrder['vendor_name']=$ordersdetails['vendor_name'];
                $selectedOrder['useraddress']=$ordersdetails['useraddress'];
                $selectedOrder['payment_status']=$ordersdetails['payment_status'];
                $selectedOrder['payment_type']=$ordersdetails['payment_type'];
                $selectedOrder['amount']=$ordersdetails['amount'];
                $selectedOrder['sub_total']=$ordersdetails['sub_total'];
                $selectedOrder['created_date']=$ordersdetails['created_date'];
                $selectedOrder['placed_on']=$ordersdetails['placed_on'];
                $selectedOrder['tracking_name']=$ordersdetails['tracking_name'];
                $selectedOrder['tracking_id']=$ordersdetails['tracking_id'];
                $selectedOrder['customer_name']=$ordersdetails['customer_name'];
                $selectedOrder['email']=$ordersdetails['email'];
                $selectedOrder['mobile']=$ordersdetails['mobile'];
                $selectedOrder['coupon_disount']=$ordersdetails['coupon_disount'];
                $selectedOrder['deliveryboy_commission']=$ordersdetails['deliveryboy_commission'];
                $selectedOrder['gst']=$ordersdetails['gst'];
                $selectedOrder['delivery_name']=$ordersdetails['delivery_name'];
                $selectedOrder['delivery_phone']=$ordersdetails['delivery_phone'];
                $selectedOrder['alternative_mobiles']=$ordersdetails['alternative_mobiles'];
                $selectedOrder['order_status1']=$ordersdetails['order_status1'];
                $selectedOrder['vendor_id']=$ordersdetails['vendor_id'];
                $selectedOrder['user_id']=$ordersdetails['user_id'];
                $selectedOrder['owner_name']=$ordersdetails['owner_name'];
                $selectedOrder['vendor_mobile']=$ordersdetails['vendor_mobile'];
                $selectedOrder['address']=$ordersdetails['address'];
                $selectedOrder['city']=$ordersdetails['city'];
                $selectedOrder['order_condition']=$ordersdetails['order_condition'];
                $selectedOrder['user_address']=$ordersdetails['user_address'];
                $selectedOrder['accept_status']=$ordersdetails['accept_status'];
                $selectedOrder['review']=$ordersdetails['review'];
                $selectedOrder['comments']=$ordersdetails['comments'];
                $selectedOrder['return_refund_status']=$ordersdetails['return_refund_status'];
                $selectedOrder['placed_at']=$ord->placed_at;
                $selectedOrder['assign_courier_at']=$ord->assign_courier_at;
                $selectedOrder['shipped_at']= $ord->shipped_at ;
                $selectedOrder['delivered_at']= $ord->delivered_at;
                $selectedOrder['cancelled_at']= $ord->cancelled_at;
                $selectedOrder['returned_at']=$ord->returned_at;
               
                $selectedOrder['order_status']= array_column($orders, 'order_status');
                $selectedOrder['display_status'] = min($selectedOrder['order_status']);
                $selectedOrder['max_status'] = max($selectedOrder['order_status']);
                

                
    
                $data['data'] = $selectedOrder;
                // print_r($data['data']);
                // exit;
                $data['firstname']=$users_check->first_name;
                    $data['lastname']=$users_check->last_name;
                    $data['email']=$users_check->email;
                $data['display_status'] = $display_status;
                $data['max_status'] = $max_status;
                $data['sub_total'] = array_sum(array_column($orders, 'sub_total'));
                $data['shipping_charge'] = array_sum(array_column($orders, 'deliveryboy_commission'));
                $data['gst'] = array_sum(array_column($orders, 'gst'));
                $data['grand_total'] = (array_sum(array_column($orders, 'total_price'))) - $orders[0]->coupon_disount;
    
                // Load the view with the updated data
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/order_view.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                redirect('web');
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                $data['title'] = 'Dashboard';
                $this->load->view('web/index.php', $data); */
            }
        }
    }
    

    function my_wishlist() {
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();

        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {

            $chk = $this->Web_model->checkValidLocation($user_id);
            if ($user_id != null && $chk == true) {
                $data['title'] = 'My Wishlist';
                $data['page'] = 'mywishlist';
                $user_id = $_SESSION['userdata']['user_id'];
                $data['data'] = $this->Web_model->whishList($user_id);
                $data['firstname']=$users_check->first_name;
                $data['lastname']=$users_check->last_name;
                $data['email']=$users_check->email;
                // print_r($user_id);
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/my_wishlist.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */
                  $data['location'] = $_SERVER['REQUEST_URI'];

                  $data['title'] = 'Dashboard';

                redirect('web');
            }
        }
    }

    function my_addressbook() {

        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();

        $users_check = $this->common_model->get_data_row(['id' => $user_id], 'users');
        if ($users_check->id == '') {
            $this->session->unset_userdata('session_data');
            $this->session->unset_userdata('admin_login');
            $this->session->unset_userdata('userdata');
            redirect('web');
        } else {

            $chk = $this->Web_model->checkValidLocation($user_id);
            if ($user_id != null && $chk == true) {
                $data['addresslist'] = $this->Web_model->getAddress($user_id);
                // print_r($data['addresslist']);die;
                $data['states'] = $this->Web_model->getstates();
                $data['firstname']=$users_check->first_name;
                    $data['lastname']=$users_check->last_name;
                    $data['email']=$users_check->email;
                    $data['user_id']=$user_id;

                $data['title'] = 'My Addressbook';
                $data['page'] = 'myaddressbook';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/my_addressbook.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                redirect('web');
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */
            }
        }
    }

    function become_a_vendor() {
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['title'] = 'Become A Vendor';
            $data['page'] = 'becomeavendor';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/become_a_vendor.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */
        }
    }

    function googlemap() {
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */
            redirect('web');
        } else {
            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */
            redirect('web');
        }
    }

    function getuserLocation() {
        $user_id = $_SESSION['userdata']['user_id'];
        $selectedlocation = $this->input->post('selectedlocation');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        if ($user_id == '') {

            $chk = $this->Web_model->getUserLocation('guest', $selectedlocation, $lat, $lng);
        } else {

            $chk = $this->Web_model->getUserLocation($user_id, $selectedlocation, $lat, $lng);
        }

        die;
    }

    function product_view($seo_url, $seach_keyword = null) {
        //echo $this->uri->segment(3); die;
        if ($this->uri->segment(3) != '') {
            //$data['search_title'] = $this->uri->segment(4);
            $data['search_title'] = str_replace("-", " ", $seach_keyword);
        } else {
            $data['search_title'] = 'nodata';
        }
        // print_r($data); die;

        $attr_val_arr=[];
        if ($this->input->post()) {
            //$varient_id = $this->input->post('varient_id');
            // $attr_val_arr = [];
            $post_count = count($this->input->post()); // Get the count of elements in the POST data
            for ($i = 0; $i < $post_count; $i++) { // Change the condition to < instead of <=
                $attr_type = $this->input->post('attribute_type_' . $i);
                $attr_val = $this->input->post('attribute_value_' . $i);
                if (!empty($attr_val)) {
                    array_push($attr_val_arr, ['attribute_type' => $attr_type, 'attribute_value' => $attr_val]);
                }
            }
        }
        

        $session_id = $_SESSION['session_data']['session_id'];
        $qry = $this->db->query("select * from products where seo_url='" . $seo_url . "'");
        $product_row = $qry->row();

        $product_id = $product_row->id;
        $cat_id = $product_row->cat_id;
        $data['seo_url'] = $seo_url;
        $user_id = $_SESSION['userdata']['user_id'];
        $data['user_id'] = $user_id;
        $data['product_id'] = $product_id;
        $chk = $this->Web_model->checkValidLocation($user_id);

        $data['product_qry'] = $this->Web_model->checkProductQTY($product_id, $session_id, $user_id);

        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        // $attr_val_arr=[];
        if (sizeof($attr_val_arr) > 0) {
            $product_details = $this->Web_model->getProductDetails($product_id, $user_id, $attr_val_arr);
            if (!empty($product_details['link_variants'][0])) {
                $data['product_details'] = $product_details;
            } else {
                $data['product_details'] = $this->Web_model->getProductDetails($product_id, $user_id);
                echo "<script>alert('No product available in this variant.');</script>";
            }

            $data['type'] = 'varient_filter';
            $selected_attrIds = [];
            $attribute_values = $data['product_details']['link_variants'][0]['jsondata'];
            foreach ($attribute_values as $val) {
                array_push($selected_attrIds, $val->attribute_value);
            }
            $data['selected_attrIds'] = $selected_attrIds;
        } else {
            $data['product_details'] = $this->Web_model->getProductDetails($product_id, $user_id);
            $attribute_values = $data['product_details']['attributes'];
            $selected_attrIds = [];
            foreach ($attribute_values as $val) {
                array_push($selected_attrIds, $val[0]['value_id']);
            }
            $data['selected_attrIds'] = $selected_attrIds;
        }

        //pr($data['product_details']);
        $data['session_id'] = $session_id;
        $data['rel_pro'] = $this->Web_model->similarProduct($cat_id, $user_id);
//echo "<pre>"; print_r($data['product_details']['link_variants']); die;
        $data['linkvarinats'] = $data['product_details']['link_variants'][0]['jsondata'];
        $data['title'] = 'Product Details';
        $data['searchbar'] = 'hide';
        $data['rating'] = $this->Web_model->rating_data($product_id);
        // pr($data['rating']);
//pr($data['linkvarinats']);
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/product_view.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function remove_whishlist($variant_id) {

        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['title'] = 'My Wishlist';
            $data['page'] = 'mywishlist';
            $user_id = $_SESSION['userdata']['user_id'];

            $chk = $this->Web_model->removewhishList($variant_id, $user_id);
            if ($user_id != null && $chk == true) {

                $this->session->set_tempdata('success_whishlist_message', 'Item removed from WhishList',3);
                redirect('web/my_wishlist');
            }

            $data['data'] = $this->Web_model->whishList($user_id);
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/my_wishlist.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */

            redirect('web');
        }
    }

    function productfilters($product_id) {

        $user_id = $_SESSION['userdata']['user_id'];
        $data['user_id'] = $user_id;
        $data['product_id'] = $product_id;

        $seo_url = $this->input->post('seo_url');
        $session_id=$_SESSION['userdata']['session_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['product_qry'] = $this->Web_model->checkProductQTY($product_id, $session_id, $user_id);
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();

            $total_count = $this->input->post('total_count');
            $json_data = [];
            for ($i = 0;
                    $i < $total_count;
                    $i++) {
                $attribute_type = $this->input->post('attribute_type' . $i);
                $attribute_value = $this->input->post('attribute_value' . $i);
                $json_data[] = array('attribute_type' => $attribute_type, 'attribute_value' => $attribute_value);
            }
            $product_id = $this->input->post('product_id');
            $jsondata = json_encode($json_data);
//echo "<pre>"; print_r($jsondata); die;
            $dat = $this->Web_model->productDetailsFilter($product_id, $jsondata);
            if ($dat == 'false') {
                $this->session->set_tempdata('error_message', 'There is no products,Please select another variant',3);
                $data['title'] = 'Product Details';
                redirect('web/product_view/' . $seo_url);
            } else {
                $data['product_details'] = $dat;
                $data['linkvarinats'] = $data['product_details']['link_variants'][0]['jsondata'];
//echo "<pre>"; print_r($data['product_details']['link_variants']); die;
                $data['title'] = 'Product Details';
                $data['searchbar'] = 'hide';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/product_view.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            }
        } else {

            $guest_user_id = $_SESSION['userdata']['guest_user_id'];

            if ($guest_user_id != '') {
                $user_id = 'guest';
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['product_qry'] = $this->Web_model->checkProductQTY($product_id, $session_id, $user_id);
                $total_count = $this->input->post('total_count');
                $json_data = [];
                for ($i = 0;
                        $i < $total_count;
                        $i++) {
                    $attribute_type = $this->input->post('attribute_type' . $i);
                    $attribute_value = $this->input->post('attribute_value' . $i);
                    $json_data[] = array('attribute_type' => $attribute_type, 'attribute_value' => $attribute_value);
                }
                $product_id = $this->input->post('product_id');
                $jsondata = json_encode($json_data);
                $data['product_details'] = $this->Web_model->productDetailsFilter($product_id, $jsondata);
                $data['linkvarinats'] = $data['product_details']['link_variants'][0]['jsondata'];
                $data['rating'] = $this->Web_model->rating_data($product_id);
                $data['title'] = 'Product Details';
                $data['searchbar'] = 'hide';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/product_view.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */

                redirect('web');
            }
        }
    }

    function addtocart() {
        $user_id = $_SESSION['userdata']['user_id'];
        $variant_id = $this->input->post('variant_id');
        $vendor_id = $this->input->post('vendor_id');
        $price = $this->input->post('saleprice');
        $quantity = $this->input->post('quantity');
        $session_id = $_SESSION['session_data']['session_id'];
        $chk = $this->Web_model->addToCart($variant_id, $vendor_id, $user_id, $price, $quantity, $session_id);
        die;
    }

    function addtocartWithoutLogin() {
        $user_id = $this->input->post('user_id');
        $variant_id = $this->input->post('variant_id');
        $vendor_id = $this->input->post('vendor_id');
        $price = $this->input->post('saleprice');
        $quantity = $this->input->post('quantity');
        $session_id = $this->input->post('session_id');
        $chk = $this->Web_model->addToCart($variant_id, $vendor_id, $user_id, $price, $quantity, $session_id);
        die;
    }

    function product_categories($catseo_url, $shop_seourl, $category_seo_url) {
        $qry = $this->db->query("select * from vendor_shop where seo_url='" . $shop_seourl . "'");
        $vendor_row = $qry->row();
        $shop_id = $vendor_row->id;

        if ($category_seo_url == 'shop') {
            $catid = 'shop';
        } else {
            $catqry = $this->db->query("select * from categories where seo_url='" . $category_seo_url . "'");
            $cat_row = $catqry->row();
            $catid = $cat_row->id;
        }



        $subcatqry = $this->db->query("select * from sub_categories where seo_url='" . $catseo_url . "'");
        $subcatqry_row = $subcatqry->row();
        $subcatid = $subcatqry_row->id;

        $data['search'] = 'show';
        $data['subcatseo_url'] = $subcatqry_row->seo_url;

        $data['catseo_url'] = $catseo_url;
        $data['shop_seourl'] = $shop_seourl;

        $data['cat_url'] = $category_seo_url;
        $data['subcat_url'] = $catseo_url;

        $data['subcategory_title'] = $subcatqry_row->sub_category_name;
        $data['shop_name'] = $vendor_row->shop_name;
        ;
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['attributes'] = $this->Web_model->attributesWithCategory($catid);

// echo "<pre>"; print_r($data['attributes']); die;
            $data['product_details'] = $this->Web_model->getProducts($catid, $shop_id, $user_id, $subcatid);
//echo "<pre>"; print_r($data['product_details']); die;
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $shop_data = $this->Web_model->getShopdata($shop_id);
            $data['shop_name'] = $shop_data->shop_name;
            $data['shop_id'] = $shop_id;
            $data['catid'] = $catid;
            $data['subcatid'] = $subcatid;
            $data['title'] = 'Products';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/product_categories.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $guest_user_id = $_SESSION['userdata']['guest_user_id'];
            if ($guest_user_id != '') {
                $user_id = 'guest';
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['product_details'] = $this->Web_model->getProducts($catid, $shop_id, $user_id, $subcatid);
                $data['shop_id'] = $shop_id;
                $data['catid'] = $catid;
                $data['subcatid'] = $subcatid;
                $data['title'] = 'Products';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/product_categories.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */
            }
        }
    }

    function search_shop_report() {
        $shop_id = $this->input->post('shop_id');
        $category_seo_url = $this->input->post('cat_url');
        $catseo_url = $this->input->post('subcat_url');
        $searchdata = $this->input->post('searchdata');
//$catseo_url,$shop_seourl,$category_seo_url
        $qry = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");
        $vendor_row = $qry->row();
        $shop_id = $vendor_row->id;
        $shop_seourl = $vendor_row->seo_url;

        if ($category_seo_url == 'shop') {
            $catid = 'shop';
        } else {
            $catqry = $this->db->query("select * from categories where seo_url='" . $category_seo_url . "'");
            $cat_row = $catqry->row();
            $catid = $cat_row->id;
        }

        if ($catseo_url == 'nosubcat') {
            $subcatid = 'nosubcat';
        } else {
            $subcatqry = $this->db->query("select * from sub_categories where seo_url='" . $catseo_url . "'");
            $subcatqry_row = $subcatqry->row();
            $subcatid = $subcatqry_row->id;
        }



        $data['search'] = 'show';
        $data['subcatseo_url'] = $subcatqry_row->seo_url;

        $data['catseo_url'] = $catseo_url;
        $data['shop_seourl'] = $shop_seourl;

        $data['cat_url'] = $category_seo_url;
        $data['subcat_url'] = $catseo_url;

        $data['subcategory_title'] = $subcatqry_row->sub_category_name;
        $data['shop_name'] = $vendor_row->shop_name;
        ;
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['attributes'] = $this->Web_model->attributesWithCategory($catid);

// echo "<pre>"; print_r($data['attributes']); die;
            $data['product_details'] = $this->Web_model->getshopwiseProducts($catid, $shop_id, $user_id, $subcatid, $searchdata);
//echo "<pre>"; print_r($data['product_details']); die;
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $shop_data = $this->Web_model->getShopdata($shop_id);
            $data['shop_name'] = $shop_data->shop_name;
            $data['shop_id'] = $shop_id;
            $data['catid'] = $catid;
            $data['subcatid'] = $subcatid;
            $data['title'] = 'Products';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/product_categories.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $guest_user_id = $_SESSION['userdata']['guest_user_id'];
            if ($guest_user_id != '') {
                $user_id = 'guest';
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['product_details'] = $this->Web_model->getProducts($catid, $shop_id, $user_id, $subcatid);
                $data['shop_id'] = $shop_id;
                $data['catid'] = $catid;
                $data['subcatid'] = $subcatid;
                $data['title'] = 'Products';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/product_categories.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */
                redirect('web');
            }
        }
    }

    function product_filter() {
// echo "<pre>"; print_r($this->input->post()); die;
        $attributes_counts = $this->input->post('attributes_counts');
        $json_data = [];
        for ($i = 0;
                $i < $attributes_counts;
                $i++) {
            $attribute_type = $this->input->post('attribute_title_id' . $i);
            $attribute_values = $this->input->post('atributes_value' . $i);
            foreach ($attribute_values as $value) {
                if ($value != '') {
                    $json_data[] = array('attribute_type' => $attribute_type, 'attribute_value' => $value);
                }
            }
        }

        $jsondata = json_encode($json_data);

        $shop_id = $this->input->post('shop_id');
        $catid = $this->input->post('catid');
        $user_id = $_SESSION['userdata']['user_id'];

        $catseo_url = $this->input->post('catseo_url');
        $shop_seourl = $this->input->post('shop_seourl');
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['attributes'] = $this->Web_model->attributesWithCategory($catid);
            $data['product_details'] = $this->Web_model->getfilterProducts($jsondata, $shop_id, $catid, $user_id);

//echo "<pre>"; print_r($data['product_details']); die;
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
//redirect('web/product_categories/'.$catseo_url."/".$shop_seourl);

            $data['shop_id'] = $shop_id;
            $data['catid'] = $catid;
            $data['title'] = 'Products';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/product_categories.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $guest_user_id = $_SESSION['userdata']['guest_user_id'];
            if ($guest_user_id != '') {
                $user_id = 'guest';
                $data['attributes'] = $this->Web_model->attributesWithCategory($catid);
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['product_details'] = $this->Web_model->getfilterProducts($catid, $shop_id, $user_id, $brands, $start_price, $end_price);
//redirect('web/product_categories/'.$catid."/".$shop_id);
                $data['shop_id'] = $shop_id;
                $data['catid'] = $catid;
                $data['title'] = 'Products';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/product_categories.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                /* $data['location'] = $_SERVER['REQUEST_URI'];
                  $data['title'] = 'Dashboard';
                  $this->load->view('web/index.php',$data); */
                redirect('web');
            }
        }
    }

    function sort_products() {
        $catid = $this->input->post('catid');
        $shop_id = $this->input->post('shop_id');
        $subcatid = $this->input->post('subcatid');
        $type = $this->input->post('type');
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);

        $data = $this->Web_model->getsortProducts($catid, $shop_id, $user_id, $type, $subcatid);

        die;
    }

    function addaddress() {
        $user_id = $_SESSION['userdata']['user_id'];
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $state = $this->input->post('state');
        $cities = $this->input->post('cities');
        $pincode = $this->input->post('pincode');
        $landmark = $this->input->post('landmark');
        $address_type = $this->input->post('address_type');
        $chk = $this->Web_model->addAddress($user_id, $name, $mobile, $address, $state, $cities, $pincode, $landmark, $address_type);
        die;
    }

    function addbookaddress() {
        $user_id = $_SESSION['userdata']['user_id'];
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $state = $this->input->post('state');
        $cities = $this->input->post('cities');
        $pincode = $this->input->post('pincode');
        $landmark = $this->input->post('landmark');
        $address_type = $this->input->post('address_type');
        $status=$this->input->post('status');
        $chk = $this->Web_model->addBookAddress($user_id, $name, $mobile, $address, $state, $cities, $pincode, $landmark, $address_type, $status);
        die;
    }

    function updateaddress() {
        $user_id = $_SESSION['userdata']['user_id'];
        $aid = $this->input->post('aid');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $state = $this->input->post('state');
        $cities = $this->input->post('cities');
        $pincode = $this->input->post('pincode');
        $landmark = $this->input->post('landmark');
        $address_type = $this->input->post('address_type');
        $chk = $this->Web_model->updateAddress($aid, $user_id, $name, $mobile, $address, $state, $cities, $pincode, $landmark, $address_type);
        die;
    }

    function updatebookaddress() {
        $user_id = $_SESSION['userdata']['user_id'];
        $aid = $this->input->post('aid');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $state = $this->input->post('state');
        $cities = $this->input->post('cities');
        $pincode = $this->input->post('pincode');
        $landmark = $this->input->post('landmark');
        $address_type = $this->input->post('address_type');
        $status=$this->input->post('status');
        $chk = $this->Web_model->updateBookAddress($aid, $user_id, $name, $mobile, $address, $state, $cities, $pincode, $landmark, $address_type,$status);
        die;
    }

    function deleteaddress() {
        $aid = $this->input->post('address_id');
        $data['coupon_id'] = $this->input->post('coupon_id');
        $data['coupon_code'] = $this->input->post('coupon_code');
        $data['coupon_discount'] = $this->input->post('coupon_discount');
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->deleteAddress($user_id, $aid);
        if ($chk == 'true') {
            $this->session->set_tempdata('success_message', 'Address deleted successfully',3);
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();
            $data['title'] = 'Check Out';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/checkout.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $this->session->set_tempdata('error_message', 'Address deleted successfully',3);
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();
            $data['title'] = 'Check Out';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/checkout.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function deletebidaddress() {

        $data['bid_id'] = $this->input->post('bid_id');
        ;
        $data['vendor_id'] = $this->input->post('vendor_id');

        $bid_id = $this->input->post('bid_id');
        $vendor_id = $this->input->post('vendor_id');

        $aid = $this->input->post('address_id');
        $data['coupon_id'] = $this->input->post('coupon_id');
        $data['coupon_code'] = $this->input->post('coupon_code');
        $data['coupon_discount'] = $this->input->post('coupon_discount');
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->deleteAddress($user_id, $aid);
        if ($chk == 'true') {
            $this->session->set_tempdata('success_message', 'Address deleted successfully',3);
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();
            $data['title'] = 'Check Out';

            redirect('web/my_bidder_full_details/' . $bid_id . "/" . $vendor_id);
//$this->load->view('web/bidder_checkout.php',$data);
        } else {
            $this->session->set_tempdata('error_message', 'Address deleted successfully',3);
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();
            $data['title'] = 'Check Out';
            redirect('web/my_bidder_full_details/' . $bid_id . "/" . $vendor_id);
//$this->load->view('web/bidder_checkout.php',$data);
        }
    }

    function deleteaddressinbook($aid) {
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->deleteAddress($user_id, $aid);
        if ($chk == 'true') {
            $this->session->set_tempdata('success_message', 'Address deleted successfully',3);
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();

            $data['title'] = 'My Addressbook';
            $data['page'] = 'myaddressbook';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/my_addressbook.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $this->session->set_tempdata('error_message', 'Address deleted successfully',3);
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();
            $data['title'] = 'Check Out';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/checkout.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function payment() {

        $user_id = $_SESSION['userdata']['user_id'];

        $session_id = $_SESSION['session_data']['session_id'];
        $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
        $del_b = $qry->row();

        $shop = $this->db->query("select * from vendor_shop where id='" . $del_b->vendor_id . "'");
        $shopdat = $shop->row();
        $min_order_amount = $shopdat->min_order_amount;

        $result = $qry->result();

        $unitprice = 0;
        $gst = 0;
        foreach ($result as $value) {
            $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");
            $product = $pro->row();

            $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
            $link = $var1->row();

            $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "'");
            $product1 = $pro1->row();

            $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");
            if ($adm_qry->num_rows() > 0) {
                $adm_comm = $adm_qry->row();
                $p_gst = $adm_comm->gst;
            } else {
                $p_gst = '0';
            }

            $class_percentage = ($value->unit_price / 100) * $p_gst;

            $unitprice = $value->unit_price + $unitprice;
            $gst = $class_percentage + $gst;
        }

        /* close */


        $data['coupon_id'] = $this->input->post('coupon_id');
        $data['coupon_code'] = $this->input->post('coupon_code');
        $data['coupon_discount'] = $this->input->post('coupon_discount');
        $data['gst'] = $this->input->post('gst');
        $data['shipping_charge'] = $this->input->post('shipping_charge');
        $data['membership']=$this->input->post('membership');
        if($data['membership']==null){
            $data['membership']=0; 
        }
        $total_price = $this->input->post('total_price');
//        if (empty($data['coupon_discount'])) {
//            $grand_t = $min_order_amount + $unitprice + $gst;
//        } else {
//            $grand_t = ($min_order_amount + $unitprice + $gst) - $data['coupon_discount'];
//        }
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $user_address = $this->db->query("select * from users where id='" . $user_id . "'");
        $user_ddata = $user_address->row();
        $data['phone'] = $user_ddata->phone;
        $data['email'] = $user_ddata->email;
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
            $del_b = $qry->row();

            if ($qry->num_rows() > 0) {
                $data['aid'] = $this->input->post('aid');
                $data['total_price'] = $total_price; //$this->input->post('total_price');
                $data['session_id'] = $session_id;
                $data['title'] = 'Payment';
                echo json_encode($data);
                die;
            } else {

                $data['banners'] = $this->Web_model->getBanners($user_id);

                //$data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
                $data['topdeals'] = $this->Web_model->getTopDeals($user_id);

                $data['trending'] = $this->Web_model->getmostViewedProducts($user_id);
                $data['title'] = 'Dashboard';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/index.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            }
        } else {
            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */
            redirect('web');
        }
    }

    function razorPaySuccess() {

        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "ONLINE";
        $grand_total = $this->input->post('totalAmount');
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $coupon_id = $this->input->post('coupon_id');
        $coupon_code = $this->input->post('coupon_code');
        $coupon_disount = $this->input->post('coupon_discount');
        $created_at = time();
        $order_status = 2;

        $chk = $this->Web_model->doOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $razorpay_payment_id, $coupon_id, $coupon_code, $coupon_disount);
        if (is_array($chk)) {
            if ($chk['status'] == '@success') {

                $order_details = $this->Web_model->orderDetails($chk['order_id']);
                $subject = $this->data['order_placed_invoice']->subject;
                $title = $this->data['order_placed_invoice']->title;
                $message = $this->data['order_placed_invoice']->message;
                $footer = $this->data['order_placed_invoice']->footer;

                $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(' . base_url('web_assets/img/') . 'dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>[ ' . $title . ' ]</h1>
            <div id="company" class="clearfix">
                <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
                <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
                <div>' . $order_details['ordersdetails']['mobile'] . '</div>
                <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
            </div>
            <div id="project">
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
                <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
                <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
                <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
                <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div>    
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Price</th>
                        <th class="desc">Quantity</th>
                        <th class="desc">Total</th>
                    </tr>
                </thead>
                <tbody>';

                $count = 1;
                foreach ($order_details['ordersdetails']['cartdetails'] as $item) {

                    $message .= '<tr>
                            <td class="service">' . $count . '</td>
                            <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                ' . $item['productname'] . '<br>
                                [' . ucfirst($item['attributes'][0]['attribute_type']) . ': ' . $item['attributes'][0]['attribute_values'] . ']
                            </td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                            <td class="desc">' . $item['quantity'] . '</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                        </tr>';
                }
                $message .= '<tr>
                        <td colspan="5">Subtotal</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                    </tr>';
                if (!empty($coupon_disount)) {
                    $message .= '<tr>
                        <td colspan="5">Coupon Discount</td>
                        <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                    </tr>';
                }

                if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
                    $message .= '<tr>
                        <td colspan="5">Delivery Charge</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                    </tr>';
                }

                if (!empty($order_details['ordersdetails']['gst'])) {
                    $message .= '<tr>
                        <td colspan="5">GST</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                    </tr>';
                }

                if ($order_details['ordersdetails']['gst'] == "") {
                    $gst = 0;
                } else {
                    $gst = $order_details['ordersdetails']['gst'];
                }

                $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
                $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
                $final_total = $sub_coupon + $order_boy;

                $message .= '<tr>
                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            ' . $footer . '
        </footer>
    </body>
</html>';

//send mail to customer

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($order_details['ordersdetails']['email']);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->email->clear();
                    echo '@success';
                } else {
                    echo '@error';
                }
            }
        }
// $arr = array('msg' => 'Payment successfully credited', 'status' => true);
    }
    function phonepe_payment() {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "ONLINE";
        $order_id = "AM" . rand(111111111, 999999999);
        $grand_total = $this->input->post('totalAmount');
        $coupon_id = $this->input->post('coupon_id') ? $this->input->post('coupon_id') : 0;
        $coupon_code = $this->input->post('coupon_code') ? $this->input->post('coupon_code') : null;
        $coupon_disount = $this->input->post('coupon_discount') ? $this->input->post('coupon_discount') : null;
        $gst = $this->input->post('gst');
        $shipping_charge = $this->input->post('shipping_charge');
        $membership=intval($this->input->post('membership'));
        $created_at = time();
        $order_status = 1;
       
        $chk = $this->Web_model->doOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $order_id, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge);

        if (is_array($chk)) {
            if ($chk['status'] == '@success') {
                $order_details = $this->common_model->get_data_with_condition(['session_id' => $chk['session_id']], 'orders');
                // print_r($order_details);
                $customer = $this->common_model->get_data_row(['id' => $order_details[0]->user_id], 'users');
                $in_paise = intval($grand_total * 100);
                $phn = strval($customer->phone);
                $uid = random_string_generator(7);

                $json = '{
  "merchantId": "ABSOLUTEMENSONLINEUAT",
  "merchantTransactionId": "MT7850590068188104",
  "merchantUserId": "MUID123",
  "amount": 10000,
  "redirectUrl": "https://localhost/absolutemen-prod/web/post_payment_redirection/",
  "redirectMode": "POST",
  "callbackUrl": "https://localhost/absolutemen-prod/web/webhook/",
  "mobileNumber": "9999999999",
  "paymentInstrument": {
    "type": "PAY_PAGE"
  }
}';
                $con = json_decode($json);
                $con->merchantId = MERCHANT_ID;
                $con->merchantTransactionId = $order_id;
                $con->merchantUserId = $uid;
                $con->amount = $in_paise;
                // $con->redirectUrl = "https://absolutemens.com/web/post_payment_redirection/" . $order_id ."/". $membership;
                $con->redirectUrl = "https://localhost/absolutemen-prod/web/post_payment_redirection/" . $order_id ."/". $membership;
                // $con->callbackUrl = "https://absolutemens.com/web/webhook";
                $con->callbackUrl = "https://localhost/absolutemen-prod/web/webhook/";
                $con->mobileNumber = $phn;
                $con->paymentInstrument->type = "PAY_PAGE";

                $encode = json_encode($con);
                $encoded = base64_encode($encode);
                $salt_key = SALT_KEY;
                $salt_index = KEY_INDEX;
                $string = $encoded . API_END_POINT . $salt_key;
                $sha256 = hash("sha256", $string);
                $final_x_header = $sha256 . '###' . $salt_index;
                $request_json = '{
    "request":"ewogICJtZXJjaGFudElkIjogIk1FUkNIQU5UVUFUIiwKICAibWVyY2hhbnRUcmFuc2FjdGlvbklkIjogIk1UNzg1MDU5MDA2ODE4ODEwNCIsCiAgIm1lcmNoYW50VXNlcklkIjogIk1VSUQxMjMiLAogICJhbW91bnQiOiAxMDAwMCwKICAicmVkaXJlY3RVcmwiOiAiaHR0cHM6Ly93ZWJob29rLnNpdGUvcmVkaXJlY3QtdXJsIiwKICAicmVkaXJlY3RNb2RlIjogIlBPU1QiLAogICJjYWxsYmFja1VybCI6ICJodHRwczovL3dlYmhvb2suc2l0ZS9jYWxsYmFjay11cmwiLAogICJtb2JpbGVOdW1iZXIiOiAiOTk5OTk5OTk5OSIsCiAgInBheW1lbnRJbnN0cnVtZW50IjogewogICAgInR5cGUiOiAiUEFZX1BBR0UiCiAgfQp9"
}';
                $request_json_decode = json_decode($request_json);
                $request_json_decode->request = $encoded;
                $request = json_encode($request_json_decode);

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => PAY_URL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_HTTPHEADER => [
                        "Content-Type: application/json",
                        "X-VERIFY: " . $final_x_header,
                        "accept: application/json"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);
                // print_r($err);
                curl_close($curl);
               

                if ($err) {
                    error_log("cURL Error: " . $err);
                    echo "Error #:" . $err;
                } else {
                    error_log("cURL Response: " . print_r($response, true));
                    
                    $res = json_decode($response);
                  
                    // print_r($res);
                    if ($res->code == 'PAYMENT_INITIATED') {
                        
                        // print_r($res->data->instrumentResponse->redirectInfo->url);
                        redirect($res->data->instrumentResponse->redirectInfo->url);
                    } else {
                        redirect('web/checkout');
                    }
                }
            }
        }
    }


//     function phonepe_payment() {
//         $user_id = $_SESSION['userdata']['user_id'];
//         $session_id = $_SESSION['session_data']['session_id'];
//         $deliveryaddress_id = $this->input->post('address_id');
//         $payment_option = "ONLINE";
//         $order_id = "AM" . rand(111111111, 999999999);
//         $grand_total = $this->input->post('totalAmount');
//         $coupon_id = $this->input->post('coupon_id') ? $this->input->post('coupon_id') : 0;
//         $coupon_code = $this->input->post('coupon_code') ? $this->input->post('coupon_code') : null;
//         $coupon_disount = $this->input->post('coupon_discount') ? $this->input->post('coupon_discount') : null;
//         $gst = $this->input->post('gst');
//         $shipping_charge = $this->input->post('shipping_charge');
//         $membership=intval($this->input->post('membership'));
//         $created_at = time();
//         $order_status = 1;
       
//         $chk = $this->Web_model->doOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $order_id, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge);

//         if (is_array($chk)) {
//             if ($chk['status'] == '@success') {
//                 $order_details = $this->common_model->get_data_with_condition(['session_id' => $chk['session_id']], 'orders');
//                 // print_r($order_details);
//                 $customer = $this->common_model->get_data_row(['id' => $order_details[0]->user_id], 'users');
//                 $in_paise = intval($grand_total * 100);
//                 $phn = strval($customer->phone);
//                 $uid = random_string_generator(7);

//                 $json = '{
//   "merchantId": "MERCHANTUAT",
//   "merchantTransactionId": "MT7850590068188104",
//   "merchantUserId": "MUID123",
//   "amount": 10000,
//   "redirectUrl": "https://webhook.site/redirect-url",
//   "redirectMode": "POST",
//   "callbackUrl": "https://webhook.site/callback-url",
//   "mobileNumber": "9999999999",
//   "paymentInstrument": {
//     "type": "PAY_PAGE"
//   }
// }';
//                 $con = json_decode($json);
//                 $con->merchantId = MERCHANT_ID;
//                 $con->merchantTransactionId = $order_id;
//                 $con->merchantUserId = $uid;
//                 $con->amount = $in_paise;
//                 $con->redirectUrl = "https://absolutemens.com/web/post_payment_redirection/" . $order_id ."/". $membership;
//                 $con->callbackUrl = "https://absolutemens.com/web/webhook";
//                 $con->mobileNumber = $phn;
//                 $con->paymentInstrument->type = "PAY_PAGE";

//                 $encode = json_encode($con);
//                 $encoded = base64_encode($encode);
//                 $salt_key = SALT_KEY;
//                 $salt_index = KEY_INDEX;
//                 $string = $encoded . API_END_POINT . $salt_key;
//                 $sha256 = hash("sha256", $string);
//                 $final_x_header = $sha256 . '###' . $salt_index;
//                 $request_json = '{
//     "request":"ewogICJtZXJjaGFudElkIjogIk1FUkNIQU5UVUFUIiwKICAibWVyY2hhbnRUcmFuc2FjdGlvbklkIjogIk1UNzg1MDU5MDA2ODE4ODEwNCIsCiAgIm1lcmNoYW50VXNlcklkIjogIk1VSUQxMjMiLAogICJhbW91bnQiOiAxMDAwMCwKICAicmVkaXJlY3RVcmwiOiAiaHR0cHM6Ly93ZWJob29rLnNpdGUvcmVkaXJlY3QtdXJsIiwKICAicmVkaXJlY3RNb2RlIjogIlBPU1QiLAogICJjYWxsYmFja1VybCI6ICJodHRwczovL3dlYmhvb2suc2l0ZS9jYWxsYmFjay11cmwiLAogICJtb2JpbGVOdW1iZXIiOiAiOTk5OTk5OTk5OSIsCiAgInBheW1lbnRJbnN0cnVtZW50IjogewogICAgInR5cGUiOiAiUEFZX1BBR0UiCiAgfQp9"
// }';
//                 $request_json_decode = json_decode($request_json);
//                 $request_json_decode->request = $encoded;
//                 $request = json_encode($request_json_decode);

//                 $curl = curl_init();

//                 curl_setopt_array($curl, [
//                     CURLOPT_URL => PAY_URL,
//                     CURLOPT_RETURNTRANSFER => true,
//                     CURLOPT_ENCODING => "",
//                     CURLOPT_MAXREDIRS => 10,
//                     CURLOPT_TIMEOUT => 30,
//                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                     CURLOPT_CUSTOMREQUEST => "POST",
//                     CURLOPT_POSTFIELDS => $request,
//                     CURLOPT_HTTPHEADER => [
//                         "Content-Type: application/json",
//                         "X-VERIFY: " . $final_x_header,
//                         "accept: application/json"
//                     ],
//                 ]);

//                 $response = curl_exec($curl);
//                 $err = curl_error($curl);

//                 curl_close($curl);
               

//                 if ($err) {
//                     echo "Error #:" . $err;
//                 } else {
//                     $res = json_decode($response);
//                     if ($res->code == 'PAYMENT_INITIATED') {
//                         redirect($res->data->instrumentResponse->redirectInfo->url);
//                     } else {
//                         redirect('web/checkout');
//                     }
//                 }
//             }
//         }
//     }

    function phonepe_payment1() {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "ONLINE";
        $order_id = "AM" . rand(111111111, 999999999);
        $grand_total = $this->input->post('totalAmount');
        $coupon_id = $this->input->post('coupon_id') ? $this->input->post('coupon_id') : 0;
        $coupon_code = $this->input->post('coupon_code') ? $this->input->post('coupon_code') : null;
        $coupon_disount = $this->input->post('coupon_discount') ? $this->input->post('coupon_discount') : null;
        $gst = $this->input->post('gst');
        $shipping_charge = $this->input->post('shipping_charge');
        $created_at = time();
        $order_status = 2;


        $delivery_ad_row = $this->db->where(array('id' => $deliveryaddress_id))->get('user_address')->row();

        $state_qry_row = $this->db->where(array('id' => $delivery_ad_row->state))->get('states')->row();

        $cities_qry_row = $this->db->where(array('id' => $delivery_ad_row->city))->get('cities')->row();

        $pincode_qry_row = $this->db->where(array('id' => $delivery_ad_row->pincode))->get('pincodes')->row();

        if ($delivery_ad_row->address_type == 1) {

            $add_type = "Home";
        } else if ($delivery_ad_row->address_type == 1) {

            $add_type = "Office";
        }

        //$user_address = $add_type . ": " . $delivery_ad_row->name . ", " . $state_qry_row->state_name . ", " . $cities_qry_row->city_name . ", " . $pincode_qry_row->pincode . ", " . $delivery_ad_row->address . ", " . $delivery_ad_row->landmark;

        $cart_result = $this->db->where(array('session_id' => $session_id, 'vendor_id' => '338'))->get('cart')->result();

         $user_address = $delivery_ad_row->address.", ".$delivery_ad_row->landmark.", ".$delivery_ad_row->city.", ".$state_qry_row->state_name.",".$delivery_ad_row->pincode;
         $unitprice = 0;
         $admin_total = 0;
         $gst_amount = 0;
         foreach ($cart_result as $cart_value) {
             $link_variants = $this->db->where(array('id' => $cart_value->variant_id))->get('link_variant')->row();

             $product = $this->db->where(array('id' => $link_variants->product_id, 'delete_status' => 0))->get('products')->row();

             

             $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $cart_value->vendor_id . "' and cat_id='" . $product->cat_id . "'");
             $admin = $adm->row();

             $admin_price = ($admin->admin_comission / 100) * $cart_value->unit_price;

             $gst = ($admin->gst / 100) * $cart_value->unit_price;
             $gst_amount = $gst + $gst_amount;
             $unitprice = $cart_value->unit_price + $unitprice;
             $admin_total = $admin_price + $admin_total;
         }

         $vendor = ($unitprice - $admin_total) + $gst_amount;


         $coupon_qry = $this->db->query("select * from coupon_codes where id='" . $coupon_id . "'");
         $coupon_row = $coupon_qry->row();
         if ($coupon_qry->num_rows() > 0) {
             if ($coupon_row->shop_id == 0) {
                 $admin_total1 = $admin_total - $coupon_disount;
                 $vendor1 = $vendor;
             } else {
                 $vendor1 = $vendor - $coupon_disount;
                 $admin_total1 = $admin_total;
             }
         } else {
             $admin_total1 = $admin_total;
             $vendor1 = $vendor;
         }

         $date = date("Y-m-d");
         $razorpay_payment_id="MT7850590068188104";
         

        $chk = $this->Web_model->doOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $order_id, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge);

        // echo "<pre>";
        // print_r($chk);
        // exit;
        if (is_array($chk)) {

            // $this->db->where('id',)
            // if ($chk['status'] == '@success') {
                // $order_details = $this->common_model->get_data_with_condition(['session_id' => $chk['session_id']], 'orders');
                // print_r($order_details);
                // $customer = $this->common_model->get_data_row(['id' => $order_details[0]->user_id], 'users');
                // $in_paise = intval($grand_total * 100);
                // $phn = strval($customer->phone);
                // $uid = random_string_generator(7);

//                 $json = '{
//   "merchantId": "MERCHANTUAT",
//   "merchantTransactionId": "MT7850590068188104",
//   "merchantUserId": "MUID123",
//   "amount": 10000,
//   "redirectUrl": "https://webhook.site/redirect-url",
//   "redirectMode": "POST",
//   "callbackUrl": "https://webhook.site/callback-url",
//   "mobileNumber": "9999999999",
//   "paymentInstrument": {
//     "type": "PAY_PAGE"
//   }
// }';
//                 $con = json_decode($json);
//                 $con->merchantId = MERCHANT_ID;
//                 $con->merchantTransactionId = $order_id;
//                 $con->merchantUserId = $uid;
//                 $con->amount = $in_paise;
//                 $con->redirectUrl = "https://absolutemens.com/web/post_payment_redirection/" . $order_id;
//                 $con->callbackUrl = "https://absolutemens.com/web/webhook";
//                 $con->mobileNumber = $phn;
//                 $con->paymentInstrument->type = "PAY_PAGE";

//                 $encode = json_encode($con);
//                 $encoded = base64_encode($encode);
//                 $salt_key = SALT_KEY;
//                 $salt_index = KEY_INDEX;
//                 $string = $encoded . API_END_POINT . $salt_key;
//                 $sha256 = hash("sha256", $string);
//                 $final_x_header = $sha256 . '###' . $salt_index;
//                 $request_json = '{
//     "request":"ewogICJtZXJjaGFudElkIjogIk1FUkNIQU5UVUFUIiwKICAibWVyY2hhbnRUcmFuc2FjdGlvbklkIjogIk1UNzg1MDU5MDA2ODE4ODEwNCIsCiAgIm1lcmNoYW50VXNlcklkIjogIk1VSUQxMjMiLAogICJhbW91bnQiOiAxMDAwMCwKICAicmVkaXJlY3RVcmwiOiAiaHR0cHM6Ly93ZWJob29rLnNpdGUvcmVkaXJlY3QtdXJsIiwKICAicmVkaXJlY3RNb2RlIjogIlBPU1QiLAogICJjYWxsYmFja1VybCI6ICJodHRwczovL3dlYmhvb2suc2l0ZS9jYWxsYmFjay11cmwiLAogICJtb2JpbGVOdW1iZXIiOiAiOTk5OTk5OTk5OSIsCiAgInBheW1lbnRJbnN0cnVtZW50IjogewogICAgInR5cGUiOiAiUEFZX1BBR0UiCiAgfQp9"
// }';
//                 $request_json_decode = json_decode($request_json);
//                 $request_json_decode->request = $encoded;
//                 $request = json_encode($request_json_decode);

//                 $curl = curl_init();

//                 curl_setopt_array($curl, [
//                     CURLOPT_URL => PAY_URL,
//                     CURLOPT_RETURNTRANSFER => true,
//                     CURLOPT_ENCODING => "",
//                     CURLOPT_MAXREDIRS => 10,
//                     CURLOPT_TIMEOUT => 30,
//                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                     CURLOPT_CUSTOMREQUEST => "POST",
//                     CURLOPT_POSTFIELDS => $request,
//                     CURLOPT_HTTPHEADER => [
//                         "Content-Type: application/json",
//                         "X-VERIFY: " . $final_x_header,
//                         "accept: application/json"
//                     ],
//                 ]);

//                 $response = curl_exec($curl);
//                 $err = curl_error($curl);

//                 curl_close($curl);

                // if ($err) {
                //     echo "Error #:" . $err;
                // }
                //  else {
                    // $res = json_decode($response);
                    // if ($res->code == 'PAYMENT_INITIATED') {
                        // redirect($res->data->instrumentResponse->redirectInfo->url);
                    // } else {
                        // redirect('web/checkout');
                        // $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => '338', 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'order_status' => $order_status, 'deliveryboy_commission' => $delivery_amount, 'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $grand_total, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'pay_transaction_id' => $razorpay_payment_id, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id, 'coupon_disount' => $coupon_disount, 'payment_status' => 1);

                        //,'coupon_code'=>$coupon_code,'coupon_id'=>$coupon_id,'coupon_disount'=>$coupon_disount,'gst'=>$gst
                
                
                
                        // $ins = $this->db->insert("orders", $ar);
                        $transcation_id= "TM" . rand(111111111, 999999999);
                        $ar2=array('payment_status'=>1,'pay_transaction_id'=>$transcation_id);
                        $date=date("Y-m-d");

                        $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => '338', 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'payment_status'=>'1','transaction_time'=>time(),'order_status' => $order_status, 'pay_orderid' => $order_id,'pay_transaction_id'=>$transcation_id,  'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $grand_total, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id, 'coupon_disount' => $coupon_disount, 'gst' => $gst_amount, 'order_date' => $date);

                       $this->db->insert('orders',$ar);
                       $this->db->where('session_id',$session_id);
$this->db->update('orders',$ar2);
                        $this->load->view('web/order_confirm.php');
                    // }
                }
            }

    function webhook() {
        $payload = file_get_contents('php://input');
        echo "hi";
        $json_decode = json_decode($payload);
        echo $json_decode;
        exit();
        $decode = base64_decode($json_decode->response);
        $dec = json_decode($decode);
        $data = new stdClass();
        $data->pay_transaction_id = $dec->data->merchantTransactionId;
        $data->json_file = $decode;
        $data->created_at = time();
        $this->db->insert('webhook_response', $data);
    }

    function post_payment_redirection($order_id,$membership) {
    //    print_r($order_id);
        $user_id_get = $this->db->get_where('orders', ['pay_orderid' => $order_id])->row()->user_id;
        // print_r($user_id_get);
        $user_data = $this->db->get_where('users', ['id' => $user_id_get])->row();
        $sess_arr = array(
            'user_id' => $user_id_get,
            'email' => $user_data->email,
            'phone' => $user_data->phone,
            'logged_in' => true
        );
       
        $this->session->set_userdata('userdata', $sess_arr);
         

        $session_id_new = generate_session_id();
        $sess = array(
            'session_id' => $session_id_new,
            'session_status' => true
        );
        $this->session->set_userdata('session_data', $sess);
        
        $response = $this->db->where('pay_transaction_id', $order_id)->get('webhook_response')->row()->json_file;
        // echo  $response;
        // exit();
        $res = json_decode($response);
        print_r($res);

        if ($res->code == 'PAYMENT_SUCCESS') {
            $insert['payment_option'] = $res->data->paymentInstrument->type;
            $insert['transaction_time'] = time();
            $insert['pay_transaction_id'] = $res->data->transactionId;
            $insert['payment_status'] = 1;
            $insert['order_status'] = 2;
            if($membership != 0 ){
                $date = date("Y-m-d");
            if($membership==299){
                    $expiryDate = date('Y-m-d', strtotime('+1 month'));
                }
                else if($membership==1499){
                    $expiryDate = date('Y-m-d', strtotime('+1 year'));
                }
                else if($membership == 599){
                    $expiryDate = date('Y-m-d', strtotime('+3 months'));
                }
                else if($membership == 799){
                    $expiryDate = date('Y-m-d', strtotime('+6 months'));
                }
                else if($membership == 1){
                    $expiryDate = date('Y-m-d', strtotime('+1 day'));

                }
                else if($membership ==2){
                    $expiryDate = date('Y-m-d', strtotime('+2 days')); 
                }
                $array_user=array(
                    'membership'=>'yes',
                    'plan'=>$membership,
                    'created_member_date'=>$date,
                    'expiry_member_date'=>$expiryDate

                );
                $this->db->where('id', $user_id_get);
                
                $this->db->update('users',$array_user);
            }
            $user_query=$this->db->query("select * from users where id='".$user_id_get."'");
            $user_query_row=$user_query->row();
            if($membership!=0){
                $subject = 'Prime Membership';
                $title = 'Prime Membership';
                $message = '<p>Dear Customer,</p>

                <p>Greetings of the day.</p>';
                $footer = '<p>Thank You.</p>

                <p>Absolutemens Team,</p>
                
                <p>----------------------------------------------------</p>
                
                <p>[It&#39;s a computer generated invoice.]</p>';
    
                $message .= '<!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="utf-8">
                        <title>Invoice</title>
                        <style>
    
                            body {
                                position: relative;
                                width: 21cm;
                                height: auto;
                                margin: 0 auto;
                                color: #001028;
                                background: #FFFFFF;
                                font-family: Arial, sans-serif;
                                font-size: 12px;
                                font-family: Arial;
                            }
    
                            header {
                                padding: 10px 0;
                                margin-bottom: 30px;
                            }
    
                            #logo {
                                text-align: center;
                                margin-bottom: 10px;
                            }
    
                            #logo img {
                                width: 90px;
                            }
    
                            h1 {
                                border-top: 1px solid  #5D6975;
                                border-bottom: 1px solid  #5D6975;
                                color: #5D6975;
                                font-size: 2.4em;
                                line-height: 1.4em;
                                font-weight: normal;
                                text-align: center;
                                margin: 0 0 20px 0;
                                background: url(' . base_url('web_assets/img/') . 'dimension.png);
                            }
                            footer {
                                color: #5D6975;
                                width: 100%;
                                height: 30px;
                                position: absolute;
                                bottom: 0;
                                border-top: 1px solid #C1CED9;
                                padding: 8px 0;
                                text-align: center;
                                margin-bottom:20px;
                            }
                        </style>
                    </head>
                    <body>
                        <header class="clearfix">
                            <div id="logo">
                                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
                            </div>
                            <h1>[ ' . $title . ' ]</h1>
                           
                        </header>
                        <main>
                           <p> Dear customer, Congratulations you got Prime Membership. This is valid from "'.$date.'" till "'.$expiryDate.'".
                        </main>
                        <footer>
                            ' . $footer . '
                        </footer><br>
                    </body>
                </html>';
                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      
    
                $this->email->initialize($config1);
    
                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($user_query_row->email);
                $this->email->subject($subject);
                $this->email->message($message);
    
                $this->email->send(); 
                  
            
            }
            $this->session->unset_userdata('cart_data');

            $order_detail = $this->common_model->get_data_with_condition(['pay_orderid' => $order_id], 'orders');
            
            $user_address = $this->common_model->get_data_row(['id' => $order_detail[0]->deliveryaddress_id], 'user_address');
            $phone = $user_address->mobile;
            $template_id = '1407168363575948790';
            $emailData = [];
            // print_r("membership".$membership);echo "<br>";
            // print_r("result data".$res->data);exit;die;
            foreach ($order_detail as $key => $row) {
                //sms send to customer
                if($key == 0) {
                    $otp_message = "Congratulations! Your order ".$row->session_id." has been successfully placed. Thank you for choosing us. We'll keep you updated on the status of your order.";
                    $this->Web_model->send_message($otp_message, $phone, $template_id);
                }
                $this->common_model->update_record(['id' => $row->id], 'orders', $insert);
                //update cart
                $this->common_model->update_record(['session_id' => $row->session_id, 'vendor_id' => $row->vendor_id], 'cart', ['is_checkout' => 1, 'check_out' => 0]);

                $order_details = $this->Web_model->orderDetails($row->id);

                //notification to admin
                $msg = "Order Placed";
                $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
                $this->db->insert("admin_notifications", $array);

                //sms send to vendor
                $vendor = $this->common_model->get_data_row(['id' => $order_details['ordersdetails']['vendor_id']], 'vendor_shop');
                $vendor_mobile = $vendor->mobile;
                $vendor_otp_message = "Dear " . str_replace(' ', '', $vendor->owner_name) . ", You have a new order no " . $order_details['ordersdetails']['session_id'] . " please check the order contents and delivery details on our platform Happy Business:) Team Absolutemens.com";
                $vendor_template_id = '1407167151708526454';
                $this->Web_model->send_message($vendor_otp_message, $vendor_mobile, $vendor_template_id);

                //send mail to vendor regarding new order
                $sub = "New Order (" . $order_details['ordersdetails']['session_id'] . ")";
                $mesg = "Hey " . $vendor->owner_name . ", <br>You have a new order with Order id " . $order_details['ordersdetails']['session_id'] . ". Please check your order management portal for order related information. <br>Please try to ship the order with in 24 working hours. <br>Thank you, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($vendor->email);
                $this->email->subject($sub);
                $this->email->message($mesg);

                $this->email->send();

                //Manage stock here
                $vendor_quanity_arr = [];
                $session_id = $order_details['ordersdetails']['session_id'];
                $cart = $this->common_model->get_data_with_condition(['session_id' => $session_id, 'vendor_id' => $row->vendor_id], 'cart');
                foreach ($cart as $value) {
                    array_push($vendor_quanity_arr, ['variant_id' => $value->variant_id, 'quantity' => $value->quantity]);
                    $link_variants=$this->db->query("select * from link_variant where id='".$value->variant_id."'");
                    $link_variants_res=$link_variants->row();
                    $product_info = $this->db->where('id', $link_variants_res->product_id)->get('products')->row();
               
        if ($product_info->orders_placed == NULL || $product_info->orders_placed =='' || $product_info->orders_placed ==0) {
            $this->db->set('orders_placed', 1);
            $this->db->where('id', $link_variants_res->product_id);
            $this->db->update('products');
            
           
          
        }
        else{
            $qry = $this->db->query("SELECT orders_placed FROM products WHERE id='" . $link_variants_res->product_id . "'");
            $qry_res = $qry->row(); 
            
            if ($qry_res) {
                $this->db->set('orders_placed', $qry_res->orders_placed + 1);
                $this->db->where('id', $link_variants_res->product_id);
                $this->db->update('products');
            }
            
        }
                }

                $stockObj = json_decode(json_encode($vendor_quanity_arr));

                //send notification to vendor regarding stock reduce
                foreach ($stockObj as $row_stock) {
                    $row_stock->variant = $this->common_model->get_data_row(['id' => $row_stock->variant_id], 'link_variant');
                    $row_stock->product = $this->common_model->get_data_row(['id' => $row_stock->variant->product_id], 'products');
                    $this->db->order_by('priority', 'asc');
                    $product_image = $this->common_model->get_data_row(['variant_id' => $row_stock->variant_id], 'product_images')->image;
                    $row_stock->product_image = base_url('uploads/products/') . $product_image;
                    $row_stock->vendor = $this->common_model->get_data_row(['id' => $row_stock->product->shop_id], 'vendor_shop');
                    $row_stock->stock_left = (int) $row_stock->variant->stock - (int) $row_stock->quantity;
                    $attribute = (json_decode($row_stock->variant->jsondata))[0];
                    $row_stock->attr_title = $this->common_model->get_data_row(['id' => $attribute->attribute_type], 'attributes_title')->title;
                    $row_stock->attr_value = $this->common_model->get_data_row(['id' => $attribute->attribute_value], 'attributes_values')->value;

                    $ar = array('varient_id' => $row_stock->variant_id, 'product_id' => $row_stock->variant->product_id, 'quantity' => $row_stock->quantity, 'paid_status' => 'Debit', 'message' => 'New Order', 'total_stock' => $row_stock->stock_left, 'created_at' => time());

                    $ins11 = $this->db->insert("stock_management", $ar);

                    if ($ins11) {
                        $this->db->update("link_variant", array('stock' => $row_stock->stock_left), array('id' => $row_stock->variant_id));
                    }

                    //check stock limit set
                    $stock_limit = $this->data['site']->stock_limit;
                    if ($row_stock->stock_left <= $stock_limit) {

                        $subject = 'Stock Deducted';
                        $message = 'Dear Vendor,<br>';
                        $message .= 'Find out the stock details for your product ID: #' . $row_stock->product->id . '<br>';
                        $message .= '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="utf-8">
                            <title>Invoice</title>
                            <style>
                            .clearfix:after {
                                content: "";
                                display: table;
                                clear: both;
                            }

                            a {
                                color: #5D6975;
                                text-decoration: underline;
                            }

                            body {
                                position: relative;
                                width: 21cm;
                                height: auto;
                                margin: 0 auto;
                                color: #001028;
                                background: #FFFFFF;
                                font-family: Arial, sans-serif;
                                font-size: 12px;
                                font-family: Arial;
                            }

                            header {
                                padding: 10px 0;
                                margin-bottom: 30px;
                            }

                            #logo {
                                text-align: center;
                                margin-bottom: 10px;
                            }

                            #logo img {
                                width: 90px;
                            }

                            h1 {
                                border-top: 1px solid  #5D6975;
                                border-bottom: 1px solid  #5D6975;
                                color: #5D6975;
                                font-size: 2.4em;
                                line-height: 1.4em;
                                font-weight: normal;
                                text-align: center;
                                margin: 0 0 20px 0;
                                background: url(' . base_url('web_assets/img/') . 'dimension.png);
                            }

                            #project {
                                float: left;
                                inline-height:1.5em;
                            }

                            #project span {
                                color: #5D6975;
                                text-align: right;
                                margin-right: 10px;
                                display: inline-block;
                                font-size: 0.9em;
                                inline-height:1.5em;
                            }
                            #company {
                                float: right;
                                text-align: right;
                                inline-height:1.5em;
                            }

                            #project div,
                            #company div {
                                white-space: nowrap;
                                inline-height:1.5em;
                            }

                            table {
                                width: 100%;
                                border-collapse: collapse;
                                border-spacing: 0;
                                margin-bottom: 20px;
                            }
                            table tr:nth-child(2n-1) td {
                                background: #F5F5F5;
                            }

                            table th,
                            table td {
                                text-align: center;
                            }

                            table th {
                                padding: 5px 20px;
                                color: #5D6975;
                                border-bottom: 1px solid #C1CED9;
                                white-space: nowrap;
                                font-weight: normal;
                            }

                            table .service,
                            table .desc {
                                text-align: center;
                            }

                            table td {
                                padding: 10px;
                                text-align: right;
                            }

                            table td.service,
                            table td.desc {
                                vertical-align: top;
                            }

                            table td.unit,
                            table td.qty,
                            table td.total {
                                font-size: 1.2em;
                            }

                            table td.grand {
                                border-top: 1px solid #5D6975;
                                ;
                            }

                            #notices .notice {
                                color: #5D6975;
                                font-size: 1.2em;
                            }

                            footer {
                                color: #5D6975;
                                width: 100%;
                                height: 30px;
                                position: absolute;
                                bottom: 0;
                                border-top: 1px solid #C1CED9;
                                padding: 8px 0;
                                text-align: center;
                                margin-bottom:10px;
                            }
                            </style>
                        </head>
                        <body>
                            <header class="clearfix">
                                <div id="logo">
                                    <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
                                </div>
                                <h1>Stock Notification</h1>
                            </header>
                            <main>
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="service">#</th>
                                            <th class="service">Product</th>
                                            <th class="desc">Product Name</th>
                                            <th class="desc">Total Stock</th>
                                            <th class="desc">Stock Deducted</th>
                                            <th class="desc">Final Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                                <td class="service">1</td>
                                                <td class="service"><img src ="' . $row_stock->product_image . '" style="width:50px;height:50px" /></td>
                                                <td class="desc">
                                                ' . $row_stock->product->name . '<br>
                                                    [' . ucfirst($row_stock->attr_title) . ': ' . $row_stock->attr_value . ']
                                                </td>
                                                <td class="desc">' . $row_stock->variant->stock . '</td>
                                                <td class="desc">' . $row_stock->quantity . '</td>
                                                <td class="desc">' . $row_stock->stock_left . '</td>

                                            </tr>
                                    </tbody>
                                </table>
                            </main>
                        </body>
                        </html>';

                        $config1['protocol'] = MAIL_PROTOCOL;
                        $config1['smtp_host'] = MAIL_SMTP_HOST;
                        $config1['smtp_port'] = MAIL_SMTP_PORT;
                        $config1['smtp_timeout'] = '7';
                        $config1['smtp_user'] = MAIL_SMTP_USER;
                        $config1['smtp_pass'] = MAIL_SMTP_PASS;
                        $config1['charset'] = MAIL_CHARSET;
                        $config1['newline'] = "\r\n";
                        $config1['mailtype'] = 'html'; // or html
                        $config1['validation'] = TRUE; // bool whether to validate email or not      

                        $this->email->initialize($config1);

                        $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                        $this->email->to($row_stock->vendor->email);
                        $this->email->subject($subject);
                        $this->email->message($message);

                        $this->email->send();
                        $this->email->clear();
                    }
                }
                //prepair email invoice data
                array_push($emailData, $order_details['ordersdetails']);
            }

            //Merged data for invoice
            $CartData = array_column($emailData, 'cartdetails');
            $merged_cart = $CartData[0];
            for ($i = 1; $i < sizeof($CartData); $i++) {
                $merge = array_merge($merged_cart, $CartData[$i]);
                $merged_cart = $merge;
            }
            $sub_total = array_sum(array_column($emailData, 'sub_total'));
            $shipping_charge = array_sum(array_column($emailData, 'deliveryboy_commission'));
            $gst = array_sum(array_column($emailData, 'gst'));
            $grand_total = ($sub_total + $shipping_charge + $gst) - $emailData[0]['coupon_disount'];

            //email send to customer

            $subject = $this->data['order_placed_invoice']->subject;
            $title = $this->data['order_placed_invoice']->title;
            $message = $this->data['order_placed_invoice']->message;
            $footer = $this->data['order_placed_invoice']->footer;

            $message .= '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>Invoice</title>
                    <style>
                        .clearfix:after {
                            content: "";
                            display: table;
                            clear: both;
                        }

                        a {
                            color: #5D6975;
                            text-decoration: underline;
                        }

                        body {
                            position: relative;
                            width: 21cm;
                            height: auto;
                            margin: 0 auto;
                            color: #001028;
                            background: #FFFFFF;
                            font-family: Arial, sans-serif;
                            font-size: 12px;
                            font-family: Arial;
                        }

                        header {
                            padding: 10px 0;
                            margin-bottom: 30px;
                        }

                        #logo {
                            text-align: center;
                            margin-bottom: 10px;
                        }

                        #logo img {
                            width: 90px;
                        }

                        h1 {
                            border-top: 1px solid  #5D6975;
                            border-bottom: 1px solid  #5D6975;
                            color: #5D6975;
                            font-size: 2.4em;
                            line-height: 1.4em;
                            font-weight: normal;
                            text-align: center;
                            margin: 0 0 20px 0;
                            background: url(' . base_url('web_assets/img/') . 'dimension.png);
                        }

                        #project {
                            float: left;
                            inline-height:1.5em;
                        }

                        #project span {
                            color: #5D6975;
                            text-align: right;
                            margin-right: 10px;
                            display: inline-block;
                            font-size: 0.9em;
                            inline-height:1.5em;
                        }

                        #company {
                            float: right;
                            text-align: right;
                            inline-height:1.5em;
                        }

                        #project div,
                        #company div {
                            white-space: nowrap;
                            inline-height:1.5em;
                        }

                        table {
                            width: 100%;
                            border-collapse: collapse;
                            border-spacing: 0;
                            margin-bottom: 20px;
                        }

                        table tr:nth-child(2n-1) td {
                            background: #F5F5F5;
                        }

                        table th,
                        table td {
                            text-align: center;
                        }

                        table th {
                            padding: 5px 20px;
                            color: #5D6975;
                            border-bottom: 1px solid #C1CED9;
                            white-space: nowrap;
                            font-weight: normal;
                        }

                        table .service,
                        table .desc {
                            text-align: center;
                        }

                        table td {
                            padding: 10px;
                            text-align: right;
                        }

                        table td.service,
                        table td.desc {
                            vertical-align: top;
                        }

                        table td.unit,
                        table td.qty,
                        table td.total {
                            font-size: 1.2em;
                        }

                        table td.grand {
                            border-top: 1px solid #5D6975;
                            ;
                        }

                        #notices .notice {
                            color: #5D6975;
                            font-size: 1.2em;
                        }

                        footer {
                            color: #5D6975;
                            width: 100%;
                            height: 30px;
                            position: absolute;
                            bottom: 0;
                            border-top: 1px solid #C1CED9;
                            padding: 8px 0;
                            text-align: center;
                            margin-bottom:10px;
                        }
                    </style>
                </head>
                <body>
                    <header class="clearfix">
                        <div id="logo">
                            <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
                        </div>
                        <h1>[ ' . $title . ' ]</h1>
                        <div id="company" class="clearfix">
                            <div>' . $emailData[0]['customer_name'] . '</div>
                            <div><a href="mailto:' . $emailData[0]['email'] . '">' . $emailData[0]['email'] . '</a></div>
                            <div>' . $emailData[0]['mobile'] . '</div>
                            <div>' . $emailData[0]['useraddress'] . '</div>
                        </div><br>
                        <div id="project">
                            <div><span>Order ID</span> #' . $emailData[0]['session_id'] . '</div>
                            <div><span>Placed On</span> ' . $emailData[0]['created_date'] . '</div>
                            <div><span>Payment Status</span> ' . $emailData[0]['payment_status'] . '</div>
                            <div><span>Payment Method</span> ' . $emailData[0]['payment_type'] . '</div>
                            <div><span>Order status</span> ' . $emailData[0]['order_status'] . '</div>    
                        </div><br>
                    </header>
                    <main>
                        <table>
                            <thead>
                                <tr>
                                    <th class="service">#</th>
                                    <th class="service">Product</th>
                                    <th class="desc">Product Name</th>
                                    <th class="desc">Price</th>
                                    <th class="desc">Quantity</th>
                                    <th class="desc">Total</th>
                                </tr>
                            </thead>
                            <tbody>';

                        $count = 1;
                        foreach ($merged_cart as $item) {

                            $message .= '<tr>
                                        <td class="service">' . $count . '</td>
                                        <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                                        <td class="desc">
                                            ' . $item['productname'] . '<br>';
                            foreach ($item['attributes'] as $attr) {
                                $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . ' ';
                            }
                            $message .= '</td>
                                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                                        <td class="desc">' . $item['quantity'] . '</td>
                                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                                    </tr>';
                            $count++;
                        }
                        $message .= '<tr>
                                    <td colspan="5">Subtotal</td>
                                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $sub_total . '</td>
                                </tr>';
                        if (!empty($emailData[0]['coupon_disount'])) {
                            $message .= '<tr>
                                    <td colspan="5">Coupon Discount</td>
                                    <td class="total">(' . DEFAULT_CURRENCY . '. ' . $emailData[0]['coupon_disount'] . ')</td>
                                </tr>';
                        }

                        if (!empty($shipping_charge)) {
                            $message .= '<tr>
                                    <td colspan="5">Delivery Charge</td>
                                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $shipping_charge . '</td>
                                </tr>';
                        }

                        if (!empty($gst)) {
                            $message .= '<tr>
                                    <td colspan="5">GST</td>
                                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $gst . '</td>
                                </tr>';
                        }

                        $message .= '<tr>
                                    <td colspan="5" class="grand total">GRAND TOTAL</td>
                                    <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $grand_total . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </main>
                    <footer>
                        ' . $footer . '
                    </footer>
                </body>
            </html>';
            $config1['protocol'] = MAIL_PROTOCOL;
            $config1['smtp_host'] = MAIL_SMTP_HOST;
            $config1['smtp_port'] = MAIL_SMTP_PORT;
            $config1['smtp_timeout'] = '7';
            $config1['smtp_user'] = MAIL_SMTP_USER;
            $config1['smtp_pass'] = MAIL_SMTP_PASS;
            $config1['charset'] = MAIL_CHARSET;
            $config1['newline'] = "\r\n";
            $config1['mailtype'] = 'html'; // or html
            $config1['validation'] = TRUE; // bool whether to validate email or not      

            $this->email->initialize($config1);

            $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
            $this->email->to($emailData[0]['email']);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->email->clear();
                echo '@success';
            } else {
                echo '@error';
            }

           

            redirect('web/thankYou');
        } else {
            $prev_session_id = $this->db->get_where('orders', ['pay_orderid' => $order_id])->row()->session_id;
            //            $user_id_get = $this->db->get_where('orders', ['pay_orderid' => $order_id])->row()->user_id;
            //            $user_data = $this->db->get_where('users', ['id' => $user_id_get])->row();
            //            $sess_arr = array(
            //                'user_id' => $user_id_get,
            //                'email' => $user_data->email,
            //                'phone' => $user_data->phone,
            //                'logged_in' => true
            //            );
            //            $this->session->set_userdata('userdata', $sess_arr);
            //
            //            $session_id_new = generate_session_id();
            //            $sess = array(
            //                'session_id' => $session_id_new,
            //                'session_status' => true
            //            );
            //            $this->session->set_userdata('session_data', $sess);
            $new_session_id = $_SESSION['session_data']['session_id'];
            $this->db->where('session_id', $prev_session_id)->update('cart', ['session_id' => $new_session_id]);
            //$this->db->where('pay_orderid', $order_id)->delete('orders');
            redirect('web/failed');
        }
    }

    function failed() {
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/includes/payment_failure');
        $this->load->view("web/includes/footer", $this->data);
    }

    function cashfree_payment() {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "ONLINE";
        $order_id = "AM" . rand(111111111, 999999999);
        $grand_total = $this->input->post('totalAmount');
        $coupon_id = $this->input->post('coupon_id');
        $coupon_code = $this->input->post('coupon_code');
        $coupon_disount = $this->input->post('coupon_discount');
        $gst = $this->input->post('gst');
        $shipping_charge = $this->input->post('shipping_charge');
        $created_at = time();
        $order_status = 1;

        $chk = $this->Web_model->doOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $order_id, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge);

        if (is_array($chk)) {
            if ($chk['status'] == '@success') {
                $order_details = $this->common_model->get_data_with_condition(['session_id' => $chk['session_id']], 'orders');
                $customer = $this->common_model->get_data_row(['id' => $order_details[0]->user_id], 'users');
                $mode = "PROD"; //<------------ Change to TEST for test server, PROD for production
//extract($_POST);
                $secretKey = TEST_SECRET_KEY;
                $postData = array(
                    "appId" => TEST_APP_ID,
                    "orderId" => $order_id,
                    "orderAmount" => $grand_total,
                    "orderCurrency" => DEFAULT_CURRENCY,
                    "orderNote" => 'ABSOLUTEMENS ORDER',
                    "customerName" => $customer->first_name . ' ' . $customer->last_name,
                    "customerPhone" => $customer->phone,
                    "customerEmail" => $customer->email,
                    "returnUrl" => base_url('web/do_cashfree_order'),
                    "notifyUrl" => base_url('web/'),
                    "coupon_discount" => $coupon_disount,
                    'total_price' => $grand_total,
                    'coupon_id' => $coupon_id
                );

//pr($postData); 
                ksort($postData);
                $signatureData = "";
                foreach ($postData as $key => $value) {

                    $signatureData .= $key . $value;
                }
                $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
                $signature = base64_encode($signature);

                if ($mode == "PROD") {
                    $url = "https://www.cashfree.com/checkout/post/submit";
                } else {
                    $url = "https://test.cashfree.com/billpay/checkout/post/submit";
                }

                $this->load->view('web/includes/payment-checkout', ['post_data' => $postData, 'signature' => $signature, 'url' => $url]);
            }
        }
    }

    function do_cashfree_order() {
        $secretkey = TEST_SECRET_KEY;
        $orderId = $_POST["orderId"];
        $orderAmount = $_POST["orderAmount"];
        $referenceId = $_POST["referenceId"];
        $txStatus = $_POST["txStatus"];
        $paymentMode = $_POST["paymentMode"];
        $txMsg = $_POST["txMsg"];
        $txTime = $_POST["txTime"];
        $signature = $_POST["signature"];
        if ($txStatus == "SUCCESS") {
            $trans_status = 1;
        } else {
            $trans_status = 0;
        }

        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;

        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
        if ($signature == $computedSignature) {
            $insert['pay_orderid'] = $orderId;
            $insert['payment_option'] = $paymentMode;
            $insert['transaction_time'] = $txTime;
            $insert['pay_transaction_id'] = $referenceId;
            $insert['payment_status'] = $trans_status;
            $insert['order_status'] = 2;
            if ($txStatus == "SUCCESS") {
                $order_detail = $this->common_model->get_data_with_condition(['pay_orderid' => $orderId], 'orders');
                //sms send to customer
                $user_address = $this->common_model->get_data_row(['id' => $order_detail[0]->deliveryaddress_id], 'user_address');
                $phone = $user_address->mobile;
                $otp_message = "Dear customer, your order with Order ID #" . $order_detail[0]->session_id . " placed successfully. Thank you for shopping with Absolute Mens. In case of any queries pls contact customer care. Thanks and Regards Absolute Mens";
                $template_id = '1407165995915174281';
                //$this->Web_model->send_message($otp_message, $phone, $template_id);
                $emailData = [];
                foreach ($order_detail as $row) {
                    $this->common_model->update_record(['id' => $row->id], 'orders', $insert);
                    //update cart
                    $this->common_model->update_record(['session_id' => $row->session_id, 'vendor_id' => $row->vendor_id], 'cart', ['is_checkout' => 1, 'check_out' => 0]);

                    $order_details = $this->Web_model->orderDetails($row->id);

                    //notification to admin
                    $msg = "Order Placed";
                    $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
                    $this->db->insert("admin_notifications", $array);

                    //sms send to vendor
                    $vendor = $this->common_model->get_data_row(['id' => $order_details['ordersdetails']['vendor_id']], 'vendor_shop');
                    $vendor_mobile = $vendor->mobile;
                    $vendor_otp_message = "Dear " . str_replace(' ', '', $vendor->owner_name) . ", You have a new order no " . $order_details['ordersdetails']['session_id'] . " please check the order contents and delivery details on our platform Happy Business:) Team Absolutemens.com";
                    $vendor_template_id = '1407167151708526454';
                    $this->Web_model->send_message($vendor_otp_message, $vendor_mobile, $vendor_template_id);

                    //send mail to vendor regarding new order
                    $sub = "New Order (" . $order_details['ordersdetails']['session_id'] . ")";
                    $mesg = "Hey " . $vendor->owner_name . ", <br>You have a new order with Order id " . $order_details['ordersdetails']['session_id'] . ". Please check your order management portal for order related information. <br>Please try to ship the order with in 24 working hours. <br>Thank you, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";

                    $config1['protocol'] = MAIL_PROTOCOL;
                    $config1['smtp_host'] = MAIL_SMTP_HOST;
                    $config1['smtp_port'] = MAIL_SMTP_PORT;
                    $config1['smtp_timeout'] = '7';
                    $config1['smtp_user'] = MAIL_SMTP_USER;
                    $config1['smtp_pass'] = MAIL_SMTP_PASS;
                    $config1['charset'] = MAIL_CHARSET;
                    $config1['newline'] = "\r\n";
                    $config1['mailtype'] = 'html'; // or html
                    $config1['validation'] = TRUE; // bool whether to validate email or not      

                    $this->email->initialize($config1);

                    $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                    $this->email->to($vendor->email);
                    $this->email->subject($sub);
                    $this->email->message($mesg);

                    $this->email->send();

                    //Manage stock here
                    $vendor_quanity_arr = [];
                    $session_id = $order_details['ordersdetails']['session_id'];
                    $cart = $this->common_model->get_data_with_condition(['session_id' => $session_id, 'vendor_id' => $row->vendor_id], 'cart');
                    foreach ($cart as $value) {
                        array_push($vendor_quanity_arr, ['variant_id' => $value->variant_id, 'quantity' => $value->quantity]);
                    }

                    $stockObj = json_decode(json_encode($vendor_quanity_arr));

                    //send notification to vendor regarding stock reduce
                    foreach ($stockObj as $row_stock) {
                        $row_stock->variant = $this->common_model->get_data_row(['id' => $row_stock->variant_id], 'link_variant');
                        $row_stock->product = $this->common_model->get_data_row(['id' => $row_stock->variant->product_id], 'products');
                        $this->db->order_by('priority', 'asc');
                        $product_image = $this->common_model->get_data_row(['variant_id' => $row_stock->variant_id], 'product_images')->image;
                        $row_stock->product_image = base_url('uploads/products/') . $product_image;
                        $row_stock->vendor = $this->common_model->get_data_row(['id' => $row_stock->product->shop_id], 'vendor_shop');
                        $row_stock->stock_left = (int) $row_stock->variant->stock - (int) $row_stock->quantity;
                        $attribute = (json_decode($row_stock->variant->jsondata))[0];
                        $row_stock->attr_title = $this->common_model->get_data_row(['id' => $attribute->attribute_type], 'attributes_title')->title;
                        $row_stock->attr_value = $this->common_model->get_data_row(['id' => $attribute->attribute_value], 'attributes_values')->value;

                        $ar = array('varient_id' => $row_stock->variant_id, 'product_id' => $row_stock->variant->product_id, 'quantity' => $row_stock->quantity, 'paid_status' => 'Debit', 'message' => 'New Order', 'total_stock' => $row_stock->stock_left, 'created_at' => time());

                        $ins11 = $this->db->insert("stock_management", $ar);

                        if ($ins11) {
                            $this->db->update("link_variant", array('stock' => $row_stock->stock_left), array('id' => $row_stock->variant_id));
                        }

                        //check stock limit set
                        $stock_limit = $this->data['site']->stock_limit;
                        if ($row_stock->stock_left <= $stock_limit) {

                            $subject = 'Stock Deducted';
                            $message = 'Dear Vendor,<br>';
                            $message .= 'Find out the stock details for your product ID: #' . $row_stock->product->id . '<br>';
                            $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(' . base_url('web_assets/img/') . 'dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>Stock Notification</h1>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Total Stock</th>
                        <th class="desc">Stock Deducted</th>
                        <th class="desc">Final Stock</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                            <td class="service">1</td>
                            <td class="service"><img src ="' . $row_stock->product_image . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                            ' . $row_stock->product->name . '<br>
                                [' . ucfirst($row_stock->attr_title) . ': ' . $row_stock->attr_value . ']
                            </td>
                            <td class="desc">' . $row_stock->variant->stock . '</td>
                            <td class="desc">' . $row_stock->quantity . '</td>
                            <td class="desc">' . $row_stock->stock_left . '</td>

                        </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>';

                            $config1['protocol'] = MAIL_PROTOCOL;
                            $config1['smtp_host'] = MAIL_SMTP_HOST;
                            $config1['smtp_port'] = MAIL_SMTP_PORT;
                            $config1['smtp_timeout'] = '7';
                            $config1['smtp_user'] = MAIL_SMTP_USER;
                            $config1['smtp_pass'] = MAIL_SMTP_PASS;
                            $config1['charset'] = MAIL_CHARSET;
                            $config1['newline'] = "\r\n";
                            $config1['mailtype'] = 'html'; // or html
                            $config1['validation'] = TRUE; // bool whether to validate email or not      

                            $this->email->initialize($config1);

                            $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                            $this->email->to($row_stock->vendor->email);
                            $this->email->subject($subject);
                            $this->email->message($message);

                            $this->email->send();
                            $this->email->clear();
                        }
                    }
                    //prepair email invoice data
                    array_push($emailData, $order_details['ordersdetails']);
                }

                //Merged data for invoice
                $CartData = array_column($emailData, 'cartdetails');
                $merged_cart = $CartData[0];
                for ($i = 1; $i < sizeof($CartData); $i++) {
                    $merge = array_merge($merged_cart, $CartData[$i]);
                    $merged_cart = $merge;
                }
                $sub_total = array_sum(array_column($emailData, 'sub_total'));
                $shipping_charge = array_sum(array_column($emailData, 'deliveryboy_commission'));
                $gst = array_sum(array_column($emailData, 'gst'));
                $grand_total = ($sub_total + $shipping_charge + $gst) - $emailData[0]['coupon_disount'];

                //email send to customer

                $subject = $this->data['order_placed_invoice']->subject;
                $title = $this->data['order_placed_invoice']->title;
                $message = $this->data['order_placed_invoice']->message;
                $footer = $this->data['order_placed_invoice']->footer;

                $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(' . base_url('web_assets/img/') . 'dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>[ ' . $title . ' ]</h1>
            <div id="company" class="clearfix">
                <div>' . $emailData[0]['customer_name'] . '</div>
                <div><a href="mailto:' . $emailData[0]['email'] . '">' . $emailData[0]['email'] . '</a></div>
                <div>' . $emailData[0]['mobile'] . '</div>
                <div>' . $emailData[0]['useraddress'] . '</div>
            </div>
            <div id="project">
                <div><span>Order ID</span> #' . $emailData[0]['session_id'] . '</div>
                <div><span>Placed On</span> ' . $emailData[0]['created_date'] . '</div>
                <div><span>Payment Status</span> ' . $emailData[0]['payment_status'] . '</div>
                <div><span>Payment Method</span> ' . $emailData[0]['payment_type'] . '</div>
                <div><span>Order status</span> ' . $emailData[0]['order_status'] . '</div>    
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Price</th>
                        <th class="desc">Quantity</th>
                        <th class="desc">Total</th>
                    </tr>
                </thead>
                <tbody>';

                $count = 1;
                foreach ($merged_cart as $item) {

                    $message .= '<tr>
                            <td class="service">' . $count . '</td>
                            <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                ' . $item['productname'] . '<br>[';
                    foreach ($item['attributes'] as $attr) {
                        $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . ' ';
                    }
                    $message .= ']</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                            <td class="desc">' . $item['quantity'] . '</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                        </tr>';
                    $count++;
                }
                $message .= '<tr>
                        <td colspan="5">Subtotal</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $sub_total . '</td>
                    </tr>';
                if (!empty($emailData[0]['coupon_disount'])) {
                    $message .= '<tr>
                        <td colspan="5">Coupon Discount</td>
                        <td class="total">(' . DEFAULT_CURRENCY . '. ' . $emailData[0]['coupon_disount'] . ')</td>
                    </tr>';
                }

                if (!empty($shipping_charge)) {
                    $message .= '<tr>
                        <td colspan="5">Delivery Charge</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $shipping_charge . '</td>
                    </tr>';
                }

                if (!empty($gst)) {
                    $message .= '<tr>
                        <td colspan="5">GST</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $gst . '</td>
                    </tr>';
                }

                $message .= '<tr>
                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $grand_total . '</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            ' . $footer . '
        </footer>
    </body>
</html>';
                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($emailData[0]['email']);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->email->clear();
                    echo '@success';
                } else {
                    echo '@error';
                }

                $sess_arr_old = array(
                    'session_id' => false,
                    'session_status' => false
                );

                $this->session->unset_userdata('session_data', $sess_arr_old);
                $user_id_get = $this->db->get_where('orders', ['pay_orderid' => $orderId])->row()->user_id;
                $user_data = $this->db->get_where('users', ['id' => $user_id_get])->row();
                $sess_arr = array(
                    'user_id' => $user_id_get,
                    'email' => $user_data->email,
                    'phone' => $user_data->phone,
                    'logged_in' => true
                );
                $this->session->set_userdata('userdata', $sess_arr);

                $session_id_new = generate_session_id();
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);

                redirect('web/thankYou');
            } else if ($txStatus == "FAILED") {
                $prev_session_id = $this->db->get_where('orders', ['pay_orderid' => $orderId])->row()->session_id;
                $user_id_get = $this->db->get_where('orders', ['pay_orderid' => $orderId])->row()->user_id;
                $user_data = $this->db->get_where('users', ['id' => $user_id_get])->row();
                $sess_arr = array(
                    'user_id' => $user_id_get,
                    'email' => $user_data->email,
                    'phone' => $user_data->phone,
                    'logged_in' => true
                );
                $this->session->set_userdata('userdata', $sess_arr);

                $session_id_new = generate_session_id();
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);
                $new_session_id = $_SESSION['session_data']['session_id'];
                $this->db->where('session_id', $prev_session_id)->update('cart', ['session_id' => $new_session_id]);
                $this->db->where('pay_orderid', $orderId)->delete('orders');
                redirect('web/failure_cashfree');
            } else if ($txStatus == "CANCELLED") {
                $prev_session_id = $this->db->get_where('orders', ['pay_orderid' => $orderId])->row()->session_id;
                $user_id_get = $this->db->get_where('orders', ['pay_orderid' => $orderId])->row()->user_id;
                $user_data = $this->db->get_where('users', ['id' => $user_id_get])->row();
                $sess_arr = array(
                    'user_id' => $user_id_get,
                    'email' => $user_data->email,
                    'phone' => $user_data->phone,
                    'logged_in' => true
                );
                $this->session->set_userdata('userdata', $sess_arr);

                $session_id_new = generate_session_id();
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);
                $new_session_id = $_SESSION['session_data']['session_id'];
                $this->db->where('session_id', $prev_session_id)->update('cart', ['session_id' => $new_session_id]);
                $this->db->where('pay_orderid', $orderId)->delete('orders');
                redirect('web/failure_cashfree');
            }
        }
    }

    function failure_cashfree() {
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/includes/payment_failure');
        $this->load->view("web/includes/footer", $this->data);
    }

    function bidrazorPaySuccess() {

        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "ONLINE";
        $grand_total = $this->input->post('totalAmount');
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $coupon_id = $this->input->post('coupon_id');
        $coupon_code = $this->input->post('coupon_code');
        $coupon_disount = $this->input->post('coupon_discount');
        $vendor_id = $this->input->post('vendor_id');
        $bid_id = $this->input->post('bid_id');
        $created_at = time();
        $order_status = 2;

        $chk = $this->Web_model->biddoOrder($user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $razorpay_payment_id, $coupon_id, $coupon_code, $coupon_disount, $vendor_id, $bid_id);

// $arr = array('msg' => 'Payment successfully credited', 'status' => true);
    }

    function doOrder() {

        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $this->input->get_post('session_id');
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "COD";

        $grand_total = $this->input->post('totalAmount');

        $coupon_id = $this->input->post('coupon_id');
        $coupon_code = $this->input->post('coupon_code');
        $coupon_disount = $this->input->post('coupon_discount');
        $gst = $this->input->post('gst');
        $shipping_charge = $this->input->post('shipping_charge');
        $created_at = time();
        $order_status = 2;

        $chk = $this->Web_model->doUserCODOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge);
        if (is_array($chk)) {
            if ($chk['status'] == '@success') {

                $session_id_new = generate_session_id();
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);
                $orders = $this->common_model->get_data_with_condition(['session_id' => $chk['session_id']], 'orders');
                //sms send to customer
                $user_address = $this->common_model->get_data_row(['id' => $orders[0]->deliveryaddress_id], 'user_address');
                $phone = $user_address->mobile;
                $otp_message = "Dear customer, your order with Order ID #" . $orders[0]->session_id . " placed successfully. Thank you for shopping with Absolute Mens. In case of any queries pls contact customer care. Thanks and Regards Absolute Mens";
                $template_id = '1407165995915174281';
                $this->Web_model->send_message($otp_message, $phone, $template_id);
                $emailData = [];
                foreach ($orders as $row) {
                    $order_details = $this->Web_model->orderDetails($row->id);
                    //notification to admin
                    $msg = "Order Placed";
                    $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
                    $this->db->insert("admin_notifications", $array);
                    //sms send to vendor
                    $vendor_mobile = ($this->common_model->get_data_row(['id' => $order_details['ordersdetails']['vendor_id']], 'vendor_shop'))->mobile;
                    $vendor_otp_message = "Dear vendor thank you for accepting order no #" . $order_details['ordersdetails']['session_id'] . " & pls prepare goods as requested and pack them for delivery. Thanks and Regards Absolute mens";
                    $vendor_template_id = '1407165996082020881';
                    $this->Web_model->send_message($vendor_otp_message, $vendor_mobile, $vendor_template_id);

                    //prepair email invoice data
                    array_push($emailData, $order_details['ordersdetails']);
                }

                //Merged data for invoice
                $CartData = array_column($emailData, 'cartdetails');
                $merged_cart = $CartData[0];
                for ($i = 1; $i < sizeof($CartData); $i++) {
                    $merge = array_merge($merged_cart, $CartData[$i]);
                    $merged_cart = $merge;
                }
                $sub_total = array_sum(array_column($emailData, 'sub_total'));

                //email send to customer

                $subject = $this->data['order_placed_invoice']->subject;
                $title = $this->data['order_placed_invoice']->title;
                $message = $this->data['order_placed_invoice']->message;
                $footer = $this->data['order_placed_invoice']->footer;

                $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(' . base_url('web_assets/img/') . 'dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>[ ' . $title . ' ]</h1>
            <div id="company" class="clearfix">
                <div>' . $emailData[0]['customer_name'] . '</div>
                <div><a href="mailto:' . $emailData[0]['email'] . '">' . $emailData[0]['email'] . '</a></div>
                <div>' . $emailData[0]['mobile'] . '</div>
                <div>' . $emailData[0]['useraddress'] . '</div>
            </div>
            <div id="project">
                <div><span>Order ID</span> #' . $emailData[0]['session_id'] . '</div>
                <div><span>Placed On</span> ' . $emailData[0]['created_date'] . '</div>
                <div><span>Payment Status</span> ' . $emailData[0]['payment_status'] . '</div>
                <div><span>Payment Method</span> ' . $emailData[0]['payment_type'] . '</div>
                <div><span>Order status</span> ' . $emailData[0]['order_status'] . '</div>    
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Price</th>
                        <th class="desc">Quantity</th>
                        <th class="desc">Total</th>
                    </tr>
                </thead>
                <tbody>';

                $count = 1;
                foreach ($merged_cart as $item) {

                    $message .= '<tr>
                            <td class="service">' . $count . '</td>
                            <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                ' . $item['productname'] . '<br>[';
                    foreach ($item['attributes'] as $attr) {
                        $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . ' ';
                    }
                    $message .= ']</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                            <td class="desc">' . $item['quantity'] . '</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                        </tr>';
                    $count++;
                }
                $message .= '<tr>
                        <td colspan="5">Subtotal</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $sub_total . '</td>
                    </tr>';
                if (!empty($coupon_disount)) {
                    $message .= '<tr>
                        <td colspan="5">Coupon Discount</td>
                        <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                    </tr>';
                }

                if (!empty($shipping_charge)) {
                    $message .= '<tr>
                        <td colspan="5">Delivery Charge</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $shipping_charge . '</td>
                    </tr>';
                }

                if (!empty($gst)) {
                    $message .= '<tr>
                        <td colspan="5">GST</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $gst . '</td>
                    </tr>';
                }

                $message .= '<tr>
                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $grand_total . '</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            ' . $footer . '
        </footer>
    </body>
</html>';
                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($emailData[0]['email']);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->email->clear();
                    echo '@success';
                } else {
                    echo '@error';
                }
            }
        }
    }

    function doBidOrder() {

        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];
        $deliveryaddress_id = $this->input->post('address_id');
        $payment_option = "COD";

        $grand_total = $this->input->post('totalAmount');
        $vendor_id = $this->input->post('totalAmount');

        $coupon_id = $this->input->post('coupon_id');
        $coupon_code = $this->input->post('coupon_code');
        $coupon_disount = $this->input->post('coupon_discount');
        $bid_id = $this->input->post('bid_id');
        $vendor_id = $this->input->post('vendor_id');
        /* $gst= $this->post('gst'); */
        $created_at = time();
        $order_status = 2;

        $chk = $this->Web_model->doBidOrderCOD($user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $coupon_id, $coupon_code, $coupon_disount, $bid_id, $vendor_id);

// $arr = array('msg' => 'Payment successfully credited', 'status' => true);
    }

    function thankYou() {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];

        if ($user_id != null) {
            $data['order_latest'] = $this->db->where('user_id', $user_id)->order_by('id', 'desc')->get('orders')->row();

            // print_r($data['order_latest']);die;

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Dashboard';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/order_confirm.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
        }
    }

    function renewal_Approved($data) {
        $user_id = $_SESSION['userdata']['user_id'];
        $session_id = $_SESSION['session_data']['session_id'];

        if ($user_id != null) {
            $array=array(
                'session_id'=>$session_id,
                'pay_transaction_id'=>$data['pay_transaction_id'],
                'created_date'=>$data['transaction_time']
            );
            // $data['order_latest'] = $this->db->where('user_id', $user_id)->order_by('id', 'desc')->get('orders')->row();
           $data['order_latest']=$array;
            // print_r($data['order_latest']);die;

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Dashboard';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/order_confirm.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
        }
    }

    function become_vendor() {
        $shopname = $this->input->post('shopname');
        $ownername = $this->input->post('ownername');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $location = $this->input->post('location');

        $data = array('shopname' => $shopname, 'ownername' => $ownername, 'email' => $email, 'mobile' => $mobile, 'state' => $state, 'city' => $city, 'location' => $location, 'created_at' => time());
        $chk = $this->Web_model->becomeVendor($data);
        die;
    }

    function add_remove_topdeal_whishList() {
        $varient_id = $this->input->post('vid');
        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

        $chk = $this->Web_model->addRemoveTopdealWhishList($varient_id, $user_id);
        die;
    }

    function add_remove_topdeal_whishList2() {
        $varient_id = $this->input->post('vid');
        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

        $chk = $this->Web_model->moveToWishlist($varient_id, $user_id);
        die;
    }

    function add_most_viewed_removewhishList() {
        $product_id = $this->input->post('pid');
        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

        $chk = $this->Web_model->add_most_viewed_removewhishList($product_id, $user_id);
        die;
    }

    function searchstore(){
        $user_id = $_SESSION['userdata']['user_id'];
 
        if ($user_id != null) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }
        $keyword = $this->input->post('keyword');
        // $keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
        if($keyword!=''){
        $array_keywords=array(
            'user_id'=>$user_id,
            'keywords'=>$keyword,
            'created_at'=>date('Y-m-d H:i:s')
        );

       $insertquery= $this->db->insert('search_keywords',$array_keywords);
       if($insertquery){
        echo "@success";
       }
       else{
        echo "@fail";
       }
       }
      

    }

    function searchdata() {
        $user_id = $_SESSION['userdata']['user_id'];
        // var_dump($user_id);
        // die();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }
        $keyword = $this->input->post('keyword');
        $chk = $this->Web_model->fetchProducts($keyword, $user_id);
        // echo "<pre>";
        // print_r($chk);
        // exit;  
        die;
    }

    function storesearchdata() {
        $user_id = $_SESSION['userdata']['user_id'];
        $keyword = $this->input->post('keyword');
        $shop_id = $this->input->post('shop_id');
        $chk = $this->Web_model->fetchstorewisesearchProducts($keyword, $user_id, $shop_id);
        die;
    }

    function deleteCartItem() {
        $user_id = $_SESSION['userdata']['user_id'];
        $cart_id = $this->input->post('cartid');
        $chk = $this->Web_model->deleteCartRow($cart_id, $user_id);
        die;
    }

    function cancelOrder() {
        $user_id = $_SESSION['userdata']['user_id'];
        $orderid = $this->input->post('order_id');
        $chk = $this->Web_model->docancelOrder($user_id, $orderid);
        die;
    }

    function order_refund() {
        $session_id = $this->input->post('order_id');
        $product_id = $this->input->post('product_id');
        $user_id = $_SESSION['userdata']['user_id'];
        $vendor_id = $this->input->post('vendor_id');
        $cartid = $this->input->post('cart_id');
        $delivery_type = 1;
        $reson = $this->input->post('message');
        $chk = $this->Web_model->exchangeRefund($session_id, $product_id, $user_id, $vendor_id, $cartid, $delivery_type, $reson);
        die;
    }

    function store_categories($seo_url) {
        $qry = $this->db->query("select * from categories where seo_url='" . $seo_url . "'");
        $cat_row = $qry->row();
        $cat_id = $cat_row->id;
        $data['seo_url'] = $seo_url;
        $det = $this->Web_model->getHomeCategories($cat_id);
        $user_id=$_SESSION['userdata']['user_id'];

        $data['sub_category_list'] = $det['sub_category_list'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $subcat = $det['sub_category_list'][0]['id'];
        $chk = $this->Web_model->checkValidLocation($_SESSION['userdata']['user_id']);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

        $data['category_name'] = $det['category_name'];
        $data['subcatid'] = $subcat;
        $data['catid'] = $cat_id;

        $config = array();
        $config["base_url"] = base_url() . "web/store_categories/" . $seo_url;
        $config["total_rows"] = $this->Web_model->getshopsWithcategoryID_count($cat_id, $subcat, $user_id);
        $config["per_page"] = 8;
        $config["uri_segment"] = 4;
//print_r($config); die;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['shops'] = $this->Web_model->getshopsWithcategoryID_storecat($config["per_page"], $page, $cat_id, $subcat, $user_id);

//echo "<pre>"; print_r($data['shops']); die;
        $data['title'] = 'Stores';
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/store_categories.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function store_wise_categories($cat_seo, $subcat_seo) {
        $qry = $this->db->query("select * from categories where seo_url='" . $cat_seo . "'");
        $cat_row = $qry->row();

        $subqry = $this->db->query("select * from sub_categories where seo_url='" . $subcat_seo . "'");
        $subqry_row = $subqry->row();

        $cat_id = $cat_row->id;
        $subcat = $subqry_row->id;

        $det = $this->Web_model->getHomeCategories($cat_id);
//print_r($det);
        $data['sub_category_list'] = $det['sub_category_list'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();

        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($_SESSION['userdata']['user_id']);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

//$chk = $this->Web_model->getshopsWithcategoryID($cat_id,$subcat,$user_id);
        $data['category_name'] = $det['category_name'];
        $data['subcatid'] = $subcat;
        $data['catid'] = $cat_id;

        $data['seo_url'] = $cat_seo;

        $config = array();
        $config["base_url"] = base_url() . "web/store_wise_categories/" . $cat_seo . "/" . $subcat_seo;
        $config["total_rows"] = $this->Web_model->getshopsWithcategoryID_count($cat_id, $subcat, $user_id);
        $config["per_page"] = 8;
        $config["uri_segment"] = 5;
//print_r($config); die;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['shops'] = $this->Web_model->getshopsWithcategoryID_storecat($config["per_page"], $page, $cat_id, $subcat, $user_id);

//$data['shops'] = $chk['shop_list'];
//echo "<pre>"; print_r($data['shops']); die;
        $data['title'] = 'Stores';
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/store_categories.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function savecontactus() {
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $message = $this->input->post('message');
        $request_type = $this->input->post('request_type');
        $company_name=$this->input->post('company_name');
        $Designation=$this->input->post('Designation');
        $date = date('Y-m-d');
        $ar = array('name' => $name, 'mobile' => $mobile, 'email' => $email, 'message' => $message,'request_type' => $request_type, 'created_at' => $date,'company_name'=>$company_name,'Designation'=>$Designation);
        $ins = $this->Web_model->saveContact($ar);
        die;
    }

    function viewAllCategories() {
        $data['categories'] = $this->Web_model->getHomeAllCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $data['title'] = 'View All Categories';
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/allcategories.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function viewallProducts($url) {
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {
            $user_id = 'guest';
        }

        if ($url == 'topdeals') {
            $data['title'] = 'TOP DEALS';
            $config = array();
            $config["base_url"] = base_url() . "web/viewallProducts/topdeals/";
            $config["total_rows"] = $this->Web_model->getTopDealscount($user_id);
            $config["per_page"] = 12;
            $config["uri_segment"] = 4;
            // print_r($config); die;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["links"] = $this->pagination->create_links();

            $data['products'] = $this->Web_model->getAllTopDeals($config["per_page"], $page, $user_id);
            // print_r($data['products']);die;

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            // $products=array();
            // $products=$data['products'];
           
            // foreach($products as $product){
                // $row->rating[]= $this->Web_model->rating_data($product['id']);
                // print_r($product['id']);
            // }
            // echo "<pre>";
            // print_r($data);
            // exit;
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/viewallproducts.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else if ($url == 'trending') {
            $data['title'] = 'TRENDING OFFERS';
            $config = array();
            $config["base_url"] = base_url() . "web/viewallProducts/trending/";
            $config["total_rows"] = $this->Web_model->getTrendingProductsCount($user_id);
            $config["per_page"] = 12;
            $config["uri_segment"] = 4;
            // print_r($config); die;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["links"] = $this->pagination->create_links();

            $data['products'] = $this->Web_model->getTrendingProductspagination($config["per_page"], $page, $user_id);

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            // echo "<pre>";
            // print_r($data);
            // exit;
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/viewallproducts.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else if ($url == 'new_arrival') {
            $data['title'] = 'NEW ARRIVAL OFFERS';
            $config = array();
            $config["base_url"] = base_url() . "web/viewallProducts/new_arrival/";
            $config["total_rows"] = $this->Web_model->getTopDealscount($user_id, 'new');
            $config["per_page"] = 12;
            $config["uri_segment"] = 4;
            // print_r($config); die;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["links"] = $this->pagination->create_links();

            $data['products'] = $this->Web_model->getAllTopDeals($config["per_page"], $page, $user_id, 'new');
            // print_r($data['products']);die;
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/viewallproducts.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function viewallshops() {

        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {
            $user_id = 'guest';
        }



        $config = array();
        $config["base_url"] = base_url() . "web/viewallshops/";
        $config["total_rows"] = $this->Web_model->get_count($user_id);
        $config["per_page"] = 8;
        $config["uri_segment"] = 3;
//print_r($config); die;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['shops'] = $this->Web_model->getAllshopsWithoutcategoriesList($config["per_page"], $page, $user_id);

        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $data['title'] = 'View All Shops';
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/viewallshops.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function add_remove_favourite() {
        $product_id = $this->input->post('pid');
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->add_removewhishList($product_id, $user_id);
        die;
    }

    function search_report() {

        $searchdata = $this->input->post('searchdata');

        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }
        $keyword = $this->input->post('keyword');
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $chk = $this->Web_model->searchAllProductsandShops($searchdata, $user_id);
        $data['products'] = $chk['products'];
        $data['shops'] = $chk['shops'];
        $data['search_count'] = $chk['search_count'];

//echo "<pre>"; print_r($chk); die;
        $data['title'] = $searchdata;
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/search_result.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function createUserBid() {
        $user_id = $_SESSION['userdata']['user_id'];

        /* Start */
        $session_id = $_SESSION['session_data']['session_id'];
        $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
        $del_b = $qry->row();

        $shop = $this->db->query("select * from vendor_shop where id='" . $del_b->vendor_id . "'");
        $shopdat = $shop->row();
        $min_order_amount = $shopdat->min_order_amount;

        $result = $qry->result();

        $unitprice = 0;
        $gst = 0;
        foreach ($result as $value) {
            $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");
            $product = $pro->row();

            $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
            $link = $var1->row();

            $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "'");
            $product1 = $pro1->row();

            $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");
            if ($adm_qry->num_rows() > 0) {
                $adm_comm = $adm_qry->row();
                $p_gst = $adm_comm->gst;
            } else {
                $p_gst = '0';
            }
            $class_percentage = ($value->unit_price / 100) * $p_gst;
            $unitprice = $value->unit_price + $unitprice;
            $gst = $class_percentage + $gst;
        }

        $grand_t = $min_order_amount + $unitprice + $gst;
        /* close */

        $ar = array(
            'user_id' => $user_id,
            'session_id' => $_SESSION['session_data']['session_id'],
            'vendor_id' => $this->input->post('vendor_id'),
            'sub_total' => $unitprice,
            'delivery_amount' => $min_order_amount,
            'grand_total' => $grand_t,
            'gst' => $gst,
            'created_at' => time()
        );
        $ins = $this->Web_model->createUserBid($ar);
        die;
    }

    function my_bids() {
        $user_id = $_SESSION['userdata']['user_id'];
        $order_status = 'ongoing';  //$this->input->post('order_status')
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $data['title'] = 'My Orders';
            $data['page'] = 'my_bids';
            $user_id = $_SESSION['userdata']['user_id'];
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['bids'] = $this->Web_model->mybids($user_id);
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/my_bids.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            
        }
    }

    function my_bids_details($bid) {
        $user_id = $_SESSION['userdata']['user_id'];
        $order_status = 'ongoing';  //$this->input->post('order_status')
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {

            $data['title'] = 'My Orders';
            $data['page'] = 'my_bids';
            $user_id = $_SESSION['userdata']['user_id'];
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['bids'] = $this->Web_model->mybidDetails($user_id, $bid);

            $check_stat = $this->db->where(array("id" => $bid, "user_id" => $user_id))->get("user_bids")->result()[0];
            $data['bid_da'] = $check_stat->id;
            $data['is_delivered'] = $check_stat->bid_status;

// print_r($data); die;
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/my_bids_details.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            
        }
    }

//my_bidder_full_details

    function my_bidder_full_details($bid, $vendor_id) {
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        $data['title'] = 'View Orders';
        $data['page'] = 'view_selected_bid';
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $current_bid = $this->db->where(array("id" => $bid, "user_id" => $user_id))->get("user_bids");
        $data['bid_data'] = $current_bid;
        $data['bid_id'] = $bid;
        $data['vendor_id'] = $vendor_id;

        $bid_ven = $this->db->query("select * from vendor_bids where bid_id='" . $bid . "' and vendor_id='" . $vendor_id . "'");
        $bid_ven_row = $bid_ven->row();
        $data['total_price'] = $bid_ven_row->total_price;

        $data['bid_products'] = $this->Web_model->mybidDetails($user_id, $bid)['products'];

// print_r($data['bid_products']);

        $data['addresslist'] = $this->Web_model->getAddress($user_id);
        $data['states'] = $this->Web_model->getstates();
        $data['title'] = 'Check Out';
// $this->load->view('web/checkout.php',$data);
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/bidder_checkout.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function bid_payment($bid) {
        $vendor_id = $this->input->post('vendor_id');
        $data['bid_id'] = $bid;
        $user_id = $_SESSION['userdata']['user_id'];

        $session_id = $_SESSION['session_data']['session_id'];
        $qry = $this->Web_model->mybidDetails($user_id, $bid)['products'];
        $del_b = $qry[0];

        $shop = $this->db->query("select * from vendor_shop where id='" . $del_b['vendor_id'] . "'");
        $shopdat = $shop->row();
        $min_order_amount = $shopdat->min_order_amount;

        $result = $qry;
        $bid_ven = $this->db->query("select * from vendor_bids where bid_id='" . $bid . "' and vendor_id='" . $vendor_id . "'");
        $bid_ven_row = $bid_ven->row();

        $data['coupon_id'] = $this->input->post('coupon_id');
        $data['coupon_code'] = $this->input->post('coupon_code');
        $data['coupon_discount'] = $this->input->post('coupon_discount');
        $data['vendor_id'] = $vendor_id;
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $user_address = $this->db->query("select * from users where id='" . $user_id . "'");
        $user_ddata = $user_address->row();
        $data['phone'] = $user_ddata->phone;
        $data['email'] = $user_ddata->email;
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($user_id != null && $chk == true) {
            $session_id = $_SESSION['session_data']['session_id'];
            $qry = $this->Web_model->mybidDetails($user_id, $bid)['products'];
            /* if(sizeof($qry)>0)
              { */
            $data['aid'] = $this->input->post('aid');
            $data['total_price'] = $bid_ven_row->total_price; //$this->input->post('total_price');
            $data['title'] = 'Payment';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/bid_payment.php', $data);
            $this->load->view("web/includes/footer", $this->data);
            /* }else{ */

            /* $data['banners'] = $this->Web_model->getBanners($user_id);




              $data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
              $data['topdeals'] = $this->Web_model->getTopDeals($user_id);

              $data['trending'] = $this->Web_model->getmostViewedProducts($user_id);
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */

//}
        } else {
            
        }
    }

    function createBid() {
        $bidid = $this->input->post('bidid');
        $chk = $this->Web_model->createBid($bidid);
        die;
    }

    function review() {
        $pid = $this->input->post('pid');
        $order_id = $this->input->post('order_id');
        $vendor_id = $this->input->post('vendor_id');
        $user_id = $this->input->post('user_id');
        $rating = $this->input->post('radioValue');
        $comments = $this->input->post('comments');
        $createdat = date("d/m/Y");
//print_r($this->input->post('')); die;
        $ins = $this->Web_model->insertRating($pid, $order_id, $vendor_id, $user_id, $rating, $comments, $createdat);

        echo $ins;
    }

    function re_order() {

        $session_id = $this->input->get_post('session_id');
        $chk = $this->Web_model->reOrder($session_id);

        echo json_encode($chk);
    }

    function re_addtocart() {
        $user_id = $_SESSION['userdata']['user_id'];
        $variant_id = $this->input->post('variant_id');
        $vendor_id = $this->input->post('vendor_id');
        $price = $this->input->post('saleprice');
        $quantity = $this->input->post('quantity');
        $session_id = $this->input->post('session_id');

        $chk = $this->Web_model->re_addToCart($variant_id, $vendor_id, $user_id, $price, $quantity, $session_id);
        echo $chk;
    }

    function banner_product_view($tag_id) {
//        if ($this->data['user_id'] == null) {  
//            redirect('web');
//        }
//print_r($random_number); die;
//$this->$data['banners_data'] = $this->common_model->banners_product_data($random_number);
//$bann = $this->db->where(array("random_number"=>$random_number))->get("banners")->row();
//$tag = $bann->tag_id;

$bann = $this->common_model->get_data_row(['tag_id' => $tag_id], 'banners');

if ($bann) {
    $tag_id = $bann->tag_id;
    $this->db->where("FIND_IN_SET('$tag_id', product_tags)");
    $this->db->where(['status' => 1, 'availabile_stock_status' => 'available']);
    $products_get = $this->db->get('products')->result();
} else {
    // echo "No products found";
}

        $products = [];
        // echo "<pre>";
        // print_r($products_get);
        // exit;
        foreach ($products_get as $product) {
            $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
            $cat_status = $this->common_model->count_rows_with_conditions('categories', ['id' => $product->cat_id, 'status' => 1]);
            $stock_exists = [];
            $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'link_variant');
            foreach ($stockArr as $stock) {
                if ($stock->stock > 0) {
                    array_push($stock_exists, $stock);
                }
            }
            $stock = sizeof($stock_exists);

            if ($chk_shop_status == 1 && $stock > 0 && $cat_status > 0) {
                array_push($products, $product);
            }
        }
        // echo "<pre>";
        $re=array();
        foreach ($products as $row) {
            // print_r($row);
            $row->rating= $this->Web_model->rating_data($row->id);
            $product_image = ($this->common_model->get_data_row(['product_id' => $row->id], 'product_images', $order_by_column = 'priority', $order_by = 'asc'))->image;
            if ($product_image) {
                $row->product_image = $product_image;
            } else {
                $row->product_image = 'noproduct.png';
            }

            $row->variant = $this->common_model->get_data_row(['product_id' => $row->id, 'saleprice >' => 0], 'link_variant', 'id', 'desc');
            if ($this->data['user_id'] == true) {
                $is_in_wish_list = $this->common_model->get_data_row(['variant_id' => $row->variant->id, 'user_id' => $this->data['user_id']], 'whish_list');
                if ($is_in_wish_list) {
                    $row->whishlist_status = true;
                } else {
                    $row->whishlist_status = false;
                }

                //check already in cart or not
                $session_id = $_SESSION['session_data']['session_id'];
                $row->in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $row->variant->id])->get('cart')->num_rows();
            } else {
                $row->whishlist_status = false;
            }
            
      
        // echo "<pre>";
        //         $qry_var = $this->db->query("SELECT variant_id, vendor_id, COUNT(*) as row_count
        //         FROM cart
        //         WHERE variant_id = '" . $row->variant->id . "' 
        //         AND vendor_id = '" . $row->shop_id . "' 
        //         AND is_checkout = 1 
        //         AND check_out = 0
        //         GROUP BY variant_id, vendor_id
        //         ORDER BY row_count DESC
        //         LIMIT 3");
        
        // $re_var = $qry_var->result();
        
        // If you also want to see the result set, you can print it
        // echo "<pre>";
       
        
        // $count_arr=array();
        // foreach($re_var as $va){
        // $re[]=$va->row_count;
        
        
        
        // // $data['order_count']=$re;
        // // print_r($row->shop_id);
        // // array_push($products, $row->row_count);
        // $row->row_count=$va->row_count;
        // }
      
        // print_r($data['order_count']);
        }
        $data['banner_products'] = $products;
       

// exit;
        // $rating=array();
        // foreach($products as $product) {
            // $rating[]=$this->Web_model->rating_data($product->id);
            // array_push($rating, $this->Web_model->rating_data($product->id));
        // }
        // echo"<pre>";
        // print_r($products);
        // exit;

        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/banner_product_view', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

//    function rating(){
//       $data['title'] = 'Rating';
//       $product_id =  $this->input->post('product_id');
//       $data['rating'] = $this->Web_model->Rating_data($product_id);
//       $this->load->view('web/product_view.php', $data);
//   }

    function chatwithus() {
        $this->session->set_userdata('chatscript', true);
    }
    function invoice($session_id) {

        $this->data['page_name'] = 'orders';

        $qry = $this->db->query("select * from orders where session_id='" . $session_id . "'");

        $orders = $qry->result();

        foreach ($orders as $order) {
            $order->vendor_details = $this->db->where(['id' => $order->vendor_id])->get('vendor_shop')->row();
            $qry_cart = $this->db->query("select * from cart where vendor_id='" . $order->vendor_id . "' and session_id='" . $order->session_id . "'");
            $order->cart_data = $qry_cart->result();

            foreach ($order->cart_data as $ord) {
                $var = $this->db->query("select * from link_variant where id='" . $ord->variant_id . "'");

                $ord->variant = $var->row();

                $pro = $this->db->query("select * from products where id='" . $ord->variant->product_id . "'");

                $ord->prod = $pro->row();

                $jsondata = json_decode($ord->variant->jsondata);

                //print_r($jsondata); die;

                $ord->attributes = [];

                foreach ($jsondata as $row) {

                    $att_title = $this->db->query("select * from attributes_title where id='" . $row->attribute_type . "'");

                    $att_title_row = $att_title->row();

                    $att_value = $this->db->query("select * from attributes_values where id='" . $row->attribute_value . "'");

                    $att_value_row = $att_value->row();

                    $ord->attributes[] = array('type' => $att_title_row->title, 'value' => $att_value_row->value);
                }
            }
        }
        //pr($orders);
        $this->data['orders'] = $orders;
        // $this->load->view('admin/includes/header', $this->data);

        $this->load->view('web/invoice', $this->data);

        // $this->load->view('admin/includes/footer');
    }
    // function file(){
    //     $this->load->view('web/file');
    // }
    function checkpincode($pincode){
        // $apiUrl = 'https://staging-express.delhivery.com/c/api/pin-codes/json/';//testing url
        $apiUrl= PIN_URL;//live url
        // $bearerToken = '81b46fee5028f79840ab568b7bf88a65ec6d67ea';//testing key
        $bearerToken=TEST_KEY;//live key
    
        // Data to be sent in the request
        $data = ['filter_codes' => $pincode];
    
        // cURL setup
        $ch = curl_init($apiUrl . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $bearerToken
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute cURL request
        $response = curl_exec($ch);
    
        // Check for cURL errors
        if (curl_errno($ch)) {
            return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
        }
    
        // Close cURL session
        curl_close($ch);
    
        return $response;
    }
    
//                function checkPincodeServiceability() {
//                 // $pincode = $this->input->get('pincode');
//                 // error_log('Received pincode: ' . $pincode);
//                 // $pincode='521366';
//                 $pincode = $this->input->get('pincode');
//                 print_r($pincode);

//                 if ($pincode != '') {
//                     $res = $this->checkpincode($pincode);

// // Check for errors in the cURL request
// $decodedRes = json_decode($res, true);
// if (isset($decodedRes['error'])) {
//     echo $decodedRes['error'];
//     return;
// }
//                     $delivery_data = json_decode($res, true);
//                     $delivery_pin = $delivery_data['delivery_codes'][0]['postal_code']['pin'];
            
//                     if ($pincode == $delivery_pin) {
//                         $stringData = "This product is deliverable";
//                     } else {
//                         $stringData = "This product is not deliverable";
//                     }
            
//                     $data['stringData'] = $stringData;
//                     $this->load->view("web/includes/header_styles", $data);
//                     $this->load->view('web/product_view.php', $data);
//                     $this->load->view("web/includes/footer", $data);
//                 } else {
//                     echo json_encode(['error' => 'Pincode is required']);
//                 }
//             }
public function checkPincodeServiceability() {
    $pincode = $this->input->post('pincode');

    if ($pincode != '') {
        $res = $this->checkpincode($pincode);
        // echo "<pre>";
        // print_r($res);
        // echo "</pre>";
        $delivery_data = json_decode($res, true);
        

        if (!empty($delivery_data['delivery_codes'])) {
            $delivery_pin = $delivery_data['delivery_codes'][0]['postal_code']['pin'];
            $deliveryCodes = $delivery_data['delivery_codes'];
            $firstDeliveryCode = $deliveryCodes[0]['postal_code'];
             if ($firstDeliveryCode['pre_paid'] == 'Y') {
        
        $estimatedDeliveryDate = $firstDeliveryCode['center'][3]['s'];

        $response['data']='Estimated Delivery Date: '.$estimatedDeliveryDate;
    } else {
        $response['data']='Pre-paid service not available for this postal code.';
    }

            if ($pincode == $delivery_pin) {
                $response['status'] = 'success';
                
            } else {
                $response['status'] = 'failure';
            }
        } else {
            $response['status'] = 'failure';
        }
    } else {
        $response['status'] = 'failure';
    }

    // Return the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

function checkTrackingStatus() {
    $order_id=$this->input->post('order_id');
    $apiUrl = TRACKING_URL; 
    $api_key = TEST_KEY;

    $data = array('ref_ids' => $order_id);
    // print_r($order_id);

    $ch = curl_init($apiUrl . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Token ' . $api_key
        ));
        // curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    
        // Execute cURL request
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
        }
    
        // Close cURL session
        curl_close($ch);
        $decoded_response = json_decode($response, true);
        // echo $response;

    // Check if decoding was successful
    if ($decoded_response === null) {
        echo json_encode(['status' => 'error', 'error' => 'Invalid JSON response']);
        exit;
    }

    // Set Content-Type header
    header('Content-Type: application/json; charset=utf-8');
    

    // Return the decoded response
    echo json_encode(['status' => 'success', 'data' => $decoded_response]);
}





function TrackingAPI($orders) {
    // echo "<pre>";
    // print_r($orders);
    foreach ($orders as $key=>$ord) {
        // print_r("key".$key."value".$ord->waybill_generated."<br>");
        $apiUrl = TRACKING_URL;
        $api_key = TEST_KEY;

        $data1 = array('waybill' => $ord->waybill_generated);

        $ch = curl_init($apiUrl . '?' . http_build_query($data1));
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Token ' . $api_key
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
        }

        curl_close($ch);
        $decoded_response = json_decode($response, true);

        if ($decoded_response === null) {
            echo json_encode(['status' => 'error', 'error' => 'Invalid JSON response']);
            exit;
        }

        $trackdata = $decoded_response['ShipmentData'][0];
        $status_data = $trackdata['Shipment'];
        $status = $status_data['Status']['Status'];
        $statusType = $status_data['Status']['StatusType'];

        $status_array = array(
            'status' => $status,
            'statusType' => $statusType
        );

        if ($status_array['status'] == 'Delivered' && $status_array['statusType'] == 'DL') {
            $orderstatus = array(
                'order_status' => 5
            );
            $this->db->where('id', $ord->id);
            $update = $this->db->update('orders', $orderstatus);
            if ($update) {
                $order_details = $this->web_model->orderDetails($ord->id);
                //sms send to customer
    
                $phone = $order_details['ordersdetails']['mobile'];
                $otp_message = "Dear " . str_replace(' ', '', $order_details['ordersdetails']['customer_name']) . ", Your order from Absolutemens.com your order has been successfully delivered . We look forward to serving you again Team Absolutemens.com";
                $template_id = '1407167151718602797';
                $this->web_model->send_message($otp_message, $phone, $template_id);
    
                //notification to admin
                $msg = "Order Delivered";
                $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
                $this->db->insert("admin_notifications", $array);
    
                $coupon_disount = $order_details['ordersdetails']['coupon_disount'];
                $subject = 'Order Delivered ('.$order_details['ordersdetails']['session_id'].')';
                $title = 'Order Delivered';
                $message = "Dear Customer, Your order with Order id ".$order_details['ordersdetails']['session_id']." has been successfully delivered, hope we have served you well. <br>We are looking forward to serving you again. <br>Thank you, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";
                $footer = $this->data['order_delivered_invoice']->footer;
    
                $message .= '<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Invoice</title>
            <style>
                .clearfix:after {
                    content: "";
                    display: table;
                    clear: both;
                }
    
                a {
                    color: #5D6975;
                    text-decoration: underline;
                }
    
                body {
                    position: relative;
                    width: 21cm;
                    height: auto;
                    margin: 0 auto;
                    color: #001028;
                    background: #FFFFFF;
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    font-family: Arial;
                }
    
                header {
                    padding: 10px 0;
                    margin-bottom: 30px;
                }
    
                #logo {
                    text-align: center;
                    margin-bottom: 10px;
                }
    
                #logo img {
                    width: 90px;
                }
    
                h1 {
                    border-top: 1px solid  #5D6975;
                    border-bottom: 1px solid  #5D6975;
                    color: #5D6975;
                    font-size: 2.4em;
                    line-height: 1.4em;
                    font-weight: normal;
                    text-align: center;
                    margin: 0 0 20px 0;
                    background: url(' . base_url('web_assets/img/') . 'dimension.png);
                }
    
                #project {
                    float: left;
                }
    
                #project span {
                    color: #5D6975;
                    text-align: right;
                    width: 87px;
                    margin-right: 10px;
                    display: inline-block;
                    font-size: 0.9em;
                }
    
                #company {
                    float: right;
                    text-align: right;
                }
    
                #project div,
                #company div {
                    white-space: nowrap;
                }
    
                table {
                    width: 100%;
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin-bottom: 20px;
                }
    
                table tr:nth-child(2n-1) td {
                    background: #F5F5F5;
                }
    
                table th,
                table td {
                    text-align: center;
                }
    
                table th {
                    padding: 5px 20px;
                    color: #5D6975;
                    border-bottom: 1px solid #C1CED9;
                    white-space: nowrap;
                    font-weight: normal;
                }
    
                table .service,
                table .desc {
                    text-align: left;
                }
    
                table td {
                    padding: 20px;
                    text-align: right;
                }
    
                table td.service,
                table td.desc {
                    vertical-align: top;
                }
    
                table td.unit,
                table td.qty,
                table td.total {
                    font-size: 1.2em;
                }
    
                table td.grand {
                    border-top: 1px solid #5D6975;
                    ;
                }
    
                #notices .notice {
                    color: #5D6975;
                    font-size: 1.2em;
                }
    
                footer {
                    color: #5D6975;
                    width: 100%;
                    height: 30px;
                    position: absolute;
                    bottom: 0;
                    border-top: 1px solid #C1CED9;
                    padding: 8px 0;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <header class="clearfix">
                <div id="logo">
                    <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
                </div>
                <h1>[ ' . $title . ' ]</h1>
                <div id="company" class="clearfix">
                    <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
                    <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
                    <div>' . $order_details['ordersdetails']['mobile'] . '</div>
                    <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
                </div>
                <div id="project">
                    <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
                    <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
                    <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
                    <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
                    <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div>
                </div>
            </header>
            <main>
                <table>
                    <thead>
                        <tr>
                            <th class="service">#</th>
                            <th class="service">Product</th>
                            <th class="desc">Product Name</th>
                            <th class="desc">Price</th>
                            <th class="desc">Quantity</th>
                            <th class="desc">Total</th>
                        </tr>
                    </thead>
                    <tbody>';
    
                $count = 1;
                foreach ($order_details['ordersdetails']['cartdetails'] as $item) {
    
                    $message .= '<tr>
                                <td class="service">' . $count . '</td>
                                <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                                <td class="desc">
                                    ' . $item['productname'] . '<br>[';
                        foreach ($item['attributes'] as $attr) {
                            $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . '<br>';
                        }
                        $message .= ']</td>
                                <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                                <td class="desc">' . $item['quantity'] . '</td>
                                <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>
    
                            </tr>';
                }
                $message .= '<tr>
                            <td colspan="5">Subtotal</td>
                            <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                        </tr>';
                if (!empty($coupon_disount)) {
                    $message .= '<tr>
                            <td colspan="5">Coupon Discount</td>
                            <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                        </tr>';
                }
    
                if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
                    $message .= '<tr>
                            <td colspan="5">Delivery Charge</td>
                            <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                        </tr>';
                }
    
                if (!empty($order_details['ordersdetails']['gst'])) {
                    $message .= '<tr>
                            <td colspan="5">GST</td>
                            <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                        </tr>';
                }
    
                if ($order_details['ordersdetails']['gst'] == "") {
                    $gst = 0;
                } else {
                    $gst = $order_details['ordersdetails']['gst'];
                }
    
                $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
                $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
                $final_total = $sub_coupon + $order_boy;
    
                $message .= '<tr>
                            <td colspan="5" class="grand total">GRAND TOTAL</td>
                            <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                        </tr>
                    </tbody>
                </table>
            </main>
            <footer>
                ' . $footer . '
            </footer>
        </body>
    </html>';
                //send mail to customer
    
                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      
    
                $this->email->initialize($config1);
    
                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($order_details['ordersdetails']['email']);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
            } else {
                return json_encode(['error' => 'Failed to update order status']);
            }
        }
    }
    // exit;
}


function shipment_delhivery($id) {
       

    $tracking_name = 'delhivery';
    $tracking_id_qry=$this->db->query("select waybill_generated from orders where id='".$id."'");
    $tracking_id_qry_res=$tracking_id_qry->row();
    $tracking_id=$tracking_id_qry_res->waybill_generated;
   
    $shipment_status = $this->vendor_model->update_shipment_status($tracking_name, $tracking_id, $id);
    if ($shipment_status) {
        
        $order_details = $this->web_model->orderDetails($id);
//             //notification to admin
        $msg = "Order Shipped";
        $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
        $this->db->insert("admin_notifications", $array);
        
//             //sms to customer
        $phone = $order_details['ordersdetails']['mobile'];
        $otp_message ="Dear Customer, Your order from Absolutemens.com has been picked up by our delivery partner. Track the order here: https://delhivery.com/track/package/" . $tracking_id . ". Thank you for shopping with us! Team Absolutemens.com";

        $template_id = '1407167151675544556';
        $this->web_model->send_message($otp_message, $phone, $template_id);

        $coupon_disount = $order_details['ordersdetails']['coupon_disount'];
        $subject = $this->data['order_shipped_invoice']->subject;
        $title = $this->data['order_shipped_invoice']->title;
        $message = $this->data['order_shipped_invoice']->message;
        $footer = $this->data['order_shipped_invoice']->footer;

        $message .= '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: auto;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(' . base_url('web_assets/img/') . 'dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 87px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.9em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="clearfix">
        <div id="logo">
            <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
        </div>
        <h1>[ ' . $title . ' ]</h1>
        <span>Track the order here: https://delhivery.com/track/package/'. $tracking_id . '</span>
        <div id="company" class="clearfix">
            <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
            <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
            <div>' . $order_details['ordersdetails']['mobile'] . '</div>
            <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
        </div>
        <div id="project">
            <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
            <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
            <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
            <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
            <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div> 
            <div><span>Tracking ID</span> <b>' . $tracking_id . '</b></div>    
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">#</th>
                    <th class="service">Product</th>
                    <th class="desc">Product Name</th>
                    <th class="desc">Price</th>
                    <th class="desc">Quantity</th>
                    <th class="desc">Total</th>
                </tr>
            </thead>
            <tbody>';

        $count = 1;
        foreach ($order_details['ordersdetails']['cartdetails'] as $item) {

            $message .= '<tr>
                        <td class="service">' . $count . '</td>
                        <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                        <td class="desc">
                            ' . $item['productname'] . '<br>[';
                foreach ($item['attributes'] as $attr) {
                    $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . '<br>';
                }
                $message .= ']</td>
                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                        <td class="desc">' . $item['quantity'] . '</td>
                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                    </tr>';
        }
        $message .= '<tr>
                    <td colspan="5">Subtotal</td>
                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                </tr>';
        if (!empty($coupon_disount)) {
            $message .= '<tr>
                    <td colspan="5">Coupon Discount</td>
                    <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                </tr>';
        }

        if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
            $message .= '<tr>
                    <td colspan="5">Delivery Charge</td>
                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                </tr>';
        }

        if (!empty($order_details['ordersdetails']['gst'])) {
            $message .= '<tr>
                    <td colspan="5">GST</td>
                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                </tr>';
        }

        if ($order_details['ordersdetails']['gst'] == "") {
            $gst = 0;
        } else {
            $gst = $order_details['ordersdetails']['gst'];
        }

        $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
        $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
        $final_total = $sub_coupon + $order_boy;

        $message .= '<tr>
                    <td colspan="5" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        ' . $footer . '
    </footer>
</body>
</html>';

$config1['protocol'] = MAIL_PROTOCOL;
$config1['smtp_host'] = MAIL_SMTP_HOST;
$config1['smtp_port'] = MAIL_SMTP_PORT;
$config1['smtp_timeout'] = '7';
$config1['smtp_user'] = MAIL_SMTP_USER;
$config1['smtp_pass'] = MAIL_SMTP_PASS;
$config1['charset'] = MAIL_CHARSET;
$config1['newline'] = "\r\n";
$config1['mailtype'] = 'html'; // or html
$config1['validation'] = TRUE; // bool whether to validate email or not

// Reinitialize the Email library for each email
$this->email->initialize($config1);

$this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
$this->email->to($order_details['ordersdetails']['email']);
$this->email->subject($subject);
$this->email->message($message);

if ($this->email->send()) {
// $this->session->set_flashdata('success_message', 'Status Changed.');
// redirect('vendors/orders'); // Commented out to allow processing of multiple emails
} else {
// $this->session->set_flashdata('error_message', 'Something Went Wrong.');
// redirect('vendors/orders'); // Commented out to allow processing of multiple emails
}
    } else {
        // $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
        // redirect('vendors/orders');
    }
    // redirect('vendors/orders');
}

public function deletePrimeItem(){
    $this->session->unset_userdata('cart_data');
    redirect('web/checkout');

}
public function changePlan(){
    $planvalue=intval($this->input->get_post('options'));
    $in_paise=intval($planvalue * 100);
    $membership=intval($this->input->get_post('options'));
    $phone=$this->input->get_post('custmer_phone');
    $user_id = $_SESSION['userdata']['user_id'];
    $session_id = $_SESSION['session_data']['session_id'];
    $payment_option = "ONLINE";
    $order_id = "AM" . rand(111111111, 999999999);
    $phn = strval($phone);
    $uid = random_string_generator(7);
    $json = '{
        "merchantId": "MERCHANTUAT",
        "merchantTransactionId": "MT7850590068188104",
        "merchantUserId": "MUID123",
        "amount": 10000,
        "redirectUrl": "https://webhook.site/redirect-url",
        "redirectMode": "POST",
        "callbackUrl": "https://webhook.site/callback-url",
        "mobileNumber": "9999999999",
        "paymentInstrument": {
        "type": "PAY_PAGE"
        }
        }';
        $con = json_decode($json);
        $con->merchantId = MERCHANT_ID;
        $con->merchantTransactionId = $order_id;
        $con->merchantUserId = $uid;
        $con->amount = $in_paise;
        $con->redirectUrl = "https://absolutemens.com/web/post_payment_renewal/" . $order_id ."/". $membership ."/".$user_id;
        $con->callbackUrl = "https://absolutemens.com/web/webhook";
        $con->mobileNumber = $phn;
        $con->paymentInstrument->type = "PAY_PAGE";
    
        $encode = json_encode($con);
        $encoded = base64_encode($encode);
        $salt_key = SALT_KEY;
        $salt_index = KEY_INDEX;
        $string = $encoded . API_END_POINT . $salt_key;
        $sha256 = hash("sha256", $string);
        $final_x_header = $sha256 . '###' . $salt_index;
        $request_json = '{
        "request":"ewogICJtZXJjaGFudElkIjogIk1FUkNIQU5UVUFUIiwKICAibWVyY2hhbnRUcmFuc2FjdGlvbklkIjogIk1UNzg1MDU5MDA2ODE4ODEwNCIsCiAgIm1lcmNoYW50VXNlcklkIjogIk1VSUQxMjMiLAogICJhbW91bnQiOiAxMDAwMCwKICAicmVkaXJlY3RVcmwiOiAiaHR0cHM6Ly93ZWJob29rLnNpdGUvcmVkaXJlY3QtdXJsIiwKICAicmVkaXJlY3RNb2RlIjogIlBPU1QiLAogICJjYWxsYmFja1VybCI6ICJodHRwczovL3dlYmhvb2suc2l0ZS9jYWxsYmFjay11cmwiLAogICJtb2JpbGVOdW1iZXIiOiAiOTk5OTk5OTk5OSIsCiAgInBheW1lbnRJbnN0cnVtZW50IjogewogICAgInR5cGUiOiAiUEFZX1BBR0UiCiAgfQp9"
        }';
        $request_json_decode = json_decode($request_json);
        $request_json_decode->request = $encoded;
        $request = json_encode($request_json_decode);
    
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => PAY_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: " . $final_x_header,
                "accept: application/json"
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
       
    
        if ($err) {
            error_log("cURL Error: " . $err);
            echo "Error #:" . $err;
        } else {
            error_log("cURL Response: " . print_r($response, true));
            $res = json_decode($response);
            error_log("Decoded Response: " . print_r($res, true));
            if ($res->code == 'PAYMENT_INITIATED') {
                redirect($res->data->instrumentResponse->redirectInfo->url);
            } else {
                redirect('web/my_orders');
            }
        }


}
public function membership(){
    $user_id = $_SESSION['userdata']['user_id'];
    $session_id = $_SESSION['session_data']['session_id'];
    $qry=$this->db->query("select * from prime_table");
    $user_qry=$this->db->query("select * from users where id='".$user_id."'");
    $data['user']=$user_qry->row();
    $data['prime']=$qry->result();
    $data['user_id']=$user_id;
    $data['session_id']=$session_id;
    $this->load->view("web/includes/header_styles", $this->data);
    $this->load->view('web/membership.php', $data);
    $this->load->view("web/includes/footer", $this->data);

}
public function renewal(){
    $planvalue=intval($this->input->get_post('renewal'));
    $in_paise=intval($planvalue * 100);
    $membership=intval($this->input->get_post('renewal'));
    $phone=$this->input->get_post('cust_phone');
    $user_id = $_SESSION['userdata']['user_id'];
    $session_id = $_SESSION['session_data']['session_id'];
    $payment_option = "ONLINE";
    $order_id = "AM" . rand(111111111, 999999999);
    $phn = strval($phone);
    $uid = random_string_generator(7);

        $json = '{
    "merchantId": "MERCHANTUAT",
    "merchantTransactionId": "MT7850590068188104",
    "merchantUserId": "MUID123",
    "amount": 10000,
    "redirectUrl": "https://webhook.site/redirect-url",
    "redirectMode": "POST",
    "callbackUrl": "https://webhook.site/callback-url",
    "mobileNumber": "9999999999",
    "paymentInstrument": {
    "type": "PAY_PAGE"
    }
    }';
    $con = json_decode($json);
    $con->merchantId = MERCHANT_ID;
    $con->merchantTransactionId = $order_id;
    $con->merchantUserId = $uid;
    $con->amount = $in_paise;
    $con->redirectUrl = "https://absolutemens.com/web/post_payment_renewal/" . $order_id ."/". $membership ."/".$user_id;
    $con->callbackUrl = "https://localhost/absolutemen-prod/web/webhook/";
    $con->mobileNumber = $phn;
    $con->paymentInstrument->type = "PAY_PAGE";

    $encode = json_encode($con);
    $encoded = base64_encode($encode);
    $salt_key = SALT_KEY;
    $salt_index = KEY_INDEX;
    $string = $encoded . API_END_POINT . $salt_key;
    $sha256 = hash("sha256", $string);
    $final_x_header = $sha256 . '###' . $salt_index;
    $request_json = '{
    "request":"ewogICJtZXJjaGFudElkIjogIk1FUkNIQU5UVUFUIiwKICAibWVyY2hhbnRUcmFuc2FjdGlvbklkIjogIk1UNzg1MDU5MDA2ODE4ODEwNCIsCiAgIm1lcmNoYW50VXNlcklkIjogIk1VSUQxMjMiLAogICJhbW91bnQiOiAxMDAwMCwKICAicmVkaXJlY3RVcmwiOiAiaHR0cHM6Ly93ZWJob29rLnNpdGUvcmVkaXJlY3QtdXJsIiwKICAicmVkaXJlY3RNb2RlIjogIlBPU1QiLAogICJjYWxsYmFja1VybCI6ICJodHRwczovL3dlYmhvb2suc2l0ZS9jYWxsYmFjay11cmwiLAogICJtb2JpbGVOdW1iZXIiOiAiOTk5OTk5OTk5OSIsCiAgInBheW1lbnRJbnN0cnVtZW50IjogewogICAgInR5cGUiOiAiUEFZX1BBR0UiCiAgfQp9"
    }';
    $request_json_decode = json_decode($request_json);
    $request_json_decode->request = $encoded;
    $request = json_encode($request_json_decode);

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => PAY_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $final_x_header,
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
   

    if ($err) {
        echo "Error #:" . $err;
    } else {
        $res = json_decode($response);
        if ($res->code == 'PAYMENT_INITIATED') {
            redirect($res->data->instrumentResponse->redirectInfo->url);
        } else {
            redirect('web/my_orders');
        }
    }
    // print_r($planvalue);
    // print_r($in_paise);
}

public function post_payment_renewal($order_id,$membership,$user_id){
    $response = $this->db->where('pay_transaction_id', $order_id)->get('webhook_response')->row()->json_file;
        $res = json_decode($response);
        $user_qry=$this->db->query("select * from users where id='".$user_id."'");
        $user_qry_res=$user_qry->row();
        $sess_arr = array(
            'user_id' => $user_id_get,
            'email' => $user_data->email,
            'phone' => $user_data->phone,
            'logged_in' => true
        );
       
        $this->session->set_userdata('userdata', $sess_arr);
         

        $session_id_new = generate_session_id();
        $sess = array(
            'session_id' => $session_id_new,
            'session_status' => true
        );
        $this->session->set_userdata('session_data', $sess);

        if ($res->code == 'PAYMENT_SUCCESS') {
            $insert['payment_option'] = $res->data->paymentInstrument->type;
            $insert['transaction_time'] = time();
            $insert['pay_transaction_id'] = $res->data->transactionId;
            // $insert['payment_status'] = 1;
            // $insert['order_status'] = 2;
            if( $membership != 0){
                $date = date("Y-m-d");
                if($membership==299){
                    $expiryDate = date('Y-m-d', strtotime('+1 month'));
                }
                else if($membership==1499){
                    $expiryDate = date('Y-m-d', strtotime('+1 year'));
                }
                else if($membership == 599){
                    $expiryDate = date('Y-m-d', strtotime('+3 months'));
                }
                else if($membership == 799){
                    $expiryDate = date('Y-m-d', strtotime('+6 months'));
                }
                else if($membership == 1){
                    $expiryDate = date('Y-m-d', strtotime('+1 day'));

                }
                else if($membership ==2){
                    $expiryDate = date('Y-m-d', strtotime('+2 days')); 
                }
                $array_user=array(
                    'membership'=>'yes',
                    'plan'=>$membership,
                    'created_member_date'=>$date,
                    'expiry_member_date'=>$expiryDate

                );
                $this->db->where('id', $user_id);
                
                $this->db->update('users',$array_user);
            }
            if($membership!=0 ){
                $subject = 'Prime Membership';
                $title = 'Prime Membership';
                $message = '<p>Dear Customer,</p>

                <p>Greetings of the day.</p>';
                $footer = '<p>Thank You.</p>

                <p>Absolutemens Team,</p>
                
                <p>----------------------------------------------------</p>
                
                <p>[It&#39;s a computer generated invoice.]</p>';
    
                $message .= '<!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="utf-8">
                        <title>Invoice</title>
                        <style>
    
                            body {
                                position: relative;
                                width: 21cm;
                                height: auto;
                                margin: 0 auto;
                                color: #001028;
                                background: #FFFFFF;
                                font-family: Arial, sans-serif;
                                font-size: 12px;
                                font-family: Arial;
                            }
    
                            header {
                                padding: 10px 0;
                                margin-bottom: 30px;
                            }
    
                            #logo {
                                text-align: center;
                                margin-bottom: 10px;
                            }
    
                            #logo img {
                                width: 90px;
                            }
    
                            h1 {
                                border-top: 1px solid  #5D6975;
                                border-bottom: 1px solid  #5D6975;
                                color: #5D6975;
                                font-size: 2.4em;
                                line-height: 1.4em;
                                font-weight: normal;
                                text-align: center;
                                margin: 0 0 20px 0;
                                background: url(' . base_url('web_assets/img/') . 'dimension.png);
                            }
                            footer {
                                color: #5D6975;
                                width: 100%;
                                height: 30px;
                                position: absolute;
                                bottom: 0;
                                border-top: 1px solid #C1CED9;
                                padding: 8px 0;
                                text-align: center;
                                margin-bottom:20px;
                            }
                        </style>
                    </head>
                    <body>
                        <header class="clearfix">
                            <div id="logo">
                                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
                            </div>
                            <h1>[ ' . $title . ' ]</h1>
                           
                        </header>
                        <main>
                           <p> Dear customer, Congratulations you got Prime Membership. This is valid from "'.$date.'" till "'.$expiryDate.'".
                        </main>
                        <footer>
                            ' . $footer . '
                        </footer><br>
                    </body>
                </html>';
                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      
    
                $this->email->initialize($config1);
    
                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($user_qry_res->email);
                $this->email->subject($subject);
                $this->email->message($message);
    
                $this->email->send(); 
                  
            
            }

            redirect('web/renewal_Approved/'.$insert);
        }
        else {
          
            redirect('web/failed');
        }
}

public function CreateMember($user_id,$session_id){
    $option=$this->input->post('options');
    // if($option==299){
        $array=array(
            'session_id'=>$session_id,
            'variant_id'=>1620,
            'vendor_id'=>338,
            'user_id'=>$user_id,
            'price'=>$option,
            'quantity'=>1,
            'unit_price'=>$option,
            'status'=>0,
            'cart_status'=>0,
            'check_out'=>1
        
        
        );
        $this->session->set_userdata("cart_data",$array);
        redirect('web/checkout'); 
        
        // $this->db->insert('cart',$array);
    // }
// print_r($user_id);


// exit;die;
}
public function shippingcost(){
  
  $apiUrl=SHIPPING_COST_URL;
$api_key=TEST_KEY;
$md='E';
$cgm='1000';
$o_pin='560045';
$d_pin='521366';
$ss='DTO';

  // Data to be sent in the request
  $data = ['md' => $md,'cgm'=>$cgm,'o_pin'=>$o_pin,'d_pin'=>$d_pin,'ss'=>$ss];

  // cURL setup
  $ch = curl_init($apiUrl . '?' . http_build_query($data));
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Authorization: Token ' .$api_key
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Execute cURL request
  $response = curl_exec($ch);

  // Check for cURL errors
  if (curl_errno($ch)) {
      return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
  }

  // Close cURL session
  curl_close($ch);

  echo $response;
}
// function selectedsalePrice() {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         // Get the values from the AJAX request
//         $itemId = $_POST['itemId'];
//         $selectedSalePrice = $_POST['selectedSalePrice'];

//         // Pass the selected sale price data to the view
//         $data['selectedSalePrice'] = $selectedSalePrice;
//         $data['itemId'] = $itemId;

//         // Return the data as JSON
//         echo json_encode($data);
//     } else {
//         echo json_encode(['error' => 'Method not allowed']);
//     }
// }





        }            
