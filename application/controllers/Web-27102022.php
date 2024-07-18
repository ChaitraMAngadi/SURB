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
            if ($url == 'contact_us') {
                $data['contactinfo'] = $this->Web_model->getContactDetails();
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['title'] = 'Contact Us';
                $this->load->view("web/includes/header_styles", $this->data);
                $this->load->view('web/contact_us.php', $data);
                $this->load->view("web/includes/footer", $this->data);
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
        $data['banners'] = $this->Web_model->getBanners($user_id);
        $data['categories'] = $this->Web_model->getHomeLimitCategories();

        $data['topdeals'] = $this->Web_model->getTopDeals($user_id);

//echo "<pre>";  print_r($data['topdeals']); die;
        $data['home_video'] = $this->Web_model->home_videos();

        $data['trending'] = $this->Web_model->getmostViewedProducts($user_id);

        $data['bannerads'] = $this->Web_model->getBannerads($user_id);

        $data['lastbannerads'] = $this->Web_model->getLastBannerads($user_id);

        $data['social_media_links'] = $this->Web_model->socialMediaLinks();

        $data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
        $data['testimo'] = $this->Web_model->testimonial();
//print_r($data['trending']); die;
        $data['title'] = 'Dashboard';
        $this->load->view("web/includes/header_styles", $this->data);
        $this->load->view('web/index.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function view_subcategories($seo_url) {

        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {

            $user_id = $_SESSION['userdata']['user_id'];
            $data['banners'] = $this->Web_model->getBanners($user_id);
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['sub_categories'] = $this->Web_model->allSubCategories($seo_url);
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
//echo "<pre>"; print_r($data['sub_categories']); die;
            $this->load->view("web/includes/subpage_header", $this->data);
            $this->load->view('web/subcategorylist.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            $guest_user_id = $_SESSION['userdata']['guest_user_id'];

            if ($_SESSION['userdata']['guest_logged_in'] == true) {
                $user_id = 'guest';
                $data['banners'] = $this->Web_model->getBanners($user_id);
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['sub_categories'] = $this->Web_model->allSubCategories($seo_url);
//                 $sub_categories = $this->Web_model->allSubCategories($seo_url);
//                $available_sub_cat = [];
//                foreach($sub_categories as $row) {
//                    $chk = $this->common_model->count_rows_with_conditions('questionaries', ['sub_cat_id' => $row->id, 'status' => 1]);
//                    if($chk > 0) {
//                        array_push($available_sub_cat,$row);
//                    }
//                }
//                $data['sub_categories'] = $available_sub_cat;
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
// echo "<pre>"; print_r($data['sub_categories']); die;
                $this->load->view("web/includes/subpage_header", $this->data);
                $this->load->view('web/subcategorylist.php', $data);
                $this->load->view("web/includes/footer", $this->data);
            }
        }
    }

    function filter_products_by_questionary() {
//pr($_POST);
        $cat_id = $this->input->post('cat_id');
        $sub_cat_id = $this->input->post('sub_cat_id');
        $question_id = $this->input->post('question_id');
        $ques_options = $this->input->post('ques_options');
        $message = $this->input->post('message');
//get from product view page if coming
        $ques_option_arr = explode(",", $this->input->post('ques_option_str'));
//filters
        $filter = $this->input->post('filter');
        $option = $this->input->post('option');
//amount range
        $amount_range = $this->input->post('amount_range');
//brand
        $brand_id = $this->input->post('brand_id');

        if ($filter) {
            $data['filter'] = implode(",", $filter);
            $data['option'] = implode(",", $option);
        } else if ($amount_range) {
            $amount_range_arr = explode('-', $amount_range);
            $start_amount = trim(str_replace('Rs.', '', $amount_range_arr[0]));
            $end_amount = trim(str_replace('Rs.', '', $amount_range_arr[1]));
        }

        if ($ques_options) {
            $data['ques_options'] = implode(",", $ques_options);
            $data['message'] = $message;
            $data['sub_cat_id'] = $sub_cat_id;
            $data['question_id'] = $question_id;
        } else {
            $data['ques_options'] = implode(",", $ques_option_arr);
            $data['message'] = $message;
            $data['sub_cat_id'] = $sub_cat_id;
            $data['question_id'] = $question_id;
        }

        if (!empty($cat_id) && $cat_id > 0 && !empty($question_id) && $question_id > 0) {
            $chk_category = $this->common_model->count_rows_with_conditions('categories', ['id' => $cat_id, 'status' => 1]);
            $chk_question = $this->common_model->count_rows_with_conditions('questionaries', ['id' => $question_id, 'status' => 1]);
            if ($chk_category == 1 && $chk_question == 1) {
                $category = $this->common_model->get_data_row(['id' => $cat_id, 'status' => 1], 'categories');

                if (empty($sub_cat_id)) {
                    $get_products = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'ques_id' => $question_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
                } elseif (!empty($sub_cat_id)) {
                    $get_products = $this->common_model->get_data_with_condition(['sub_cat_id' => $sub_cat_id, 'ques_id' => $question_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
                }

                $products = [];
                $brands_get = [];
                $filter_data = [];

                foreach ($get_products as $product) {

                    $product_image = ($this->common_model->get_data_row(['product_id' => $product->id], 'product_images', $order_by_column = 'id', $order_by = 'asc'))->image;
                    if ($product_image) {
                        $product->product_image = $product_image;
                    } else {
                        $product->product_image = 'noproduct.png';
                    }

                    if ($this->data['user_id'] > 0) {
                        $is_in_wish_list = $this->common_model->get_data_row(['product_id' => $product->id, 'user_id' => $this->data['user_id']], 'whish_list');

                        if ($is_in_wish_list) {
                            $product->whishlist_status = true;
                        } else {
                            $product->whishlist_status = false;
                        }
                    } else {
                        $product->whishlist_status = false;
                    }

                    $product->variant = $this->common_model->get_data_row(['product_id' => $product->id, 'saleprice >' => 0], 'link_variant', 'id', 'desc');

                    $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);

                    $stock_exists = [];
                    $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'link_variant');
                    foreach ($stockArr as $stock) {
                        if ($stock->stock > 0) {
                            array_push($stock_exists, $stock);
                        }
                    }
                    $stock = sizeof($stock_exists);

                    if (sizeof($ques_options) > 0) {
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

                    if (!empty($filter) && !empty($option)) {
                        $chk_filter = [];
                        foreach ($filter as $val) {
                            $filter_options = explode(',', (($this->common_model->get_data_row(['product_id' => $product->id, 'filter_id' => $val], 'product_filter'))->filter_options));
                            $match = array_intersect($option, $filter_options);
                            if ($match) {
                                array_push($chk_filter, $match);
                            }
                        }

                        if ($chk_shop_status == 1 && $stock > 0 && sizeof($match_found) > 0 && sizeof($chk_filter) > 0) {
                            $product_filters = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'product_filter');

                            if (sizeof($product_filters) > 0) {
                                foreach ($product_filters as $fil) {
                                    $filter_data[$fil->id]['product_id'] = $fil->product_id;
                                    $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                                    $filter_data[$fil->id]['option'] = $fil->filter_options;
                                }
                            }

                            if (!empty($product->brand)) {
                                array_push($brands_get, $product->brand);
                            }
                            array_push($products, $product);
                        }
                    } else if (!empty($end_amount)) {

                        $chk_price = $this->common_model->get_data_row(['product_id' => $product->id, 'saleprice >=' => $start_amount, 'saleprice <=' => $end_amount, 'saleprice !=' => 0], 'link_variant', 'id', 'desc');

                        if ($chk_shop_status == 1 && $stock > 0 && sizeof($match_found) > 0 && !empty($chk_price)) {
                            $product_filters = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'product_filter');

                            if (sizeof($product_filters) > 0) {
                                foreach ($product_filters as $fil) {
                                    $filter_data[$fil->id]['product_id'] = $fil->product_id;
                                    $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                                    $filter_data[$fil->id]['option'] = $fil->filter_options;
                                }
                            }

                            if (!empty($product->brand)) {
                                array_push($brands_get, $product->brand);
                            }
                            array_push($products, $product);
                        }
                    } else if (!empty($brand_id) && ($brand_id) > 0) {
                        $match_brand = $this->common_model->count_rows_with_conditions('products', ['id' => $product->id, 'brand' => $brand_id]);
                        if ($chk_shop_status == 1 && $stock > 0 && sizeof($match_found) > 0 && $match_brand > 0) {
                            $product_filters = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'product_filter');

                            if (sizeof($product_filters) > 0) {
                                foreach ($product_filters as $fil) {
                                    $filter_data[$fil->id]['product_id'] = $fil->product_id;
                                    $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                                    $filter_data[$fil->id]['option'] = $fil->filter_options;
                                }
                            }

                            if (!empty($product->brand)) {
                                array_push($brands_get, $product->brand);
                            }
                            array_push($products, $product);
                        }
                    } else {
                        if ($chk_shop_status == 1 && $stock > 0 && sizeof($match_found) > 0) {
                            $product_filters = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'product_filter');

                            if (sizeof($product_filters) > 0) {
                                foreach ($product_filters as $fil) {
                                    $filter_data[$fil->id]['product_id'] = $fil->product_id;
                                    $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                                    $filter_data[$fil->id]['option'] = $fil->filter_options;
                                }
                            }

                            if (!empty($product->brand)) {
                                array_push($brands_get, $product->brand);
                            }
                            array_push($products, $product);
                        }
                    }
                }

                $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));

                $data['categories'] = $this->data['categories'];
                $data['category'] = $category;
                $data['products'] = $products;
                $data['filters'] = $filter_data;
                $data['brands'] = $brands_get;
                $data['unique_filter_ids'] = $unique_filter_ids;
                $this->load->view("web/includes/subpage_header", $this->data);
                $this->load->view('web/products', $data);
                $this->load->view("web/includes/footer", $this->data);
            } else {
                redirect('web');
            }
        } else {
            redirect('web');
        }
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
        if ($chk == true) {
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
            $this->load->view("web/includes/subpage_header", $this->data);
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
                $this->load->view("web/includes/subpage_header", $this->data);
                $this->load->view('web/store_view.php', $data);
                $this->load->view("web/includes/subpage_header", $this->data);
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

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
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
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['coupons'] = $this->Web_model->getCouponcodes($user_id, $session_id);
                $data['addresslist'] = $this->Web_model->getAddress($user_id);
                $data['states'] = $this->Web_model->getstates();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['title'] = 'Check Out';
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

                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['coupons'] = $this->Web_model->getCouponcodes($user_id, $session_id);
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
        $chk = $this->Web_model->applyCoupon($coupon_code, $session_id, $grand_total, $total_amount, $user_id);
    }

    function goaddress_page() {
        $data['coupon_id'] = $this->input->post('coupon_id');
        $data['coupon_code'] = $this->input->post('applied_coupon_code');
        $data['coupon_discount'] = $this->input->post('coupon_discount');
        $data['gst'] = $this->input->post('gst');
//print_r($data); die;
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
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
                $data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
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

    function goaddress_bidpage() {
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
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
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['contactinfo'] = $this->Web_model->getContactDetails();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['title'] = 'Contact Us';
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/contact_us.php', $data);
            $this->load->view("web/includes/footer", $this->data);
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
        $chk = $this->Web_model->doRegister($data);
        die;
    }

    function OTPVerification() {
        $user_id = $this->input->post('user_id');
        $otp = $this->input->post('otp');
        $email_otp = $this->input->post('email_otp');
        $chk = $this->Web_model->verify_OTP($user_id, $otp, $email_otp);
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
        if ($_SESSION['userdata']['logged_in'] == true) {
            $user_id = $_SESSION['userdata']['user_id'];
            $data['title'] = 'My Profile';
            $data['profiledata'] = $this->Web_model->profileDetails($user_id);
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

    function updateUserdata() {
        $user_id = $_SESSION['userdata']['user_id'];
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $chk = $this->Web_model->updateProfile($user_id, $first_name, $last_name);
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

    function my_orders() {
//total_orders
        if ($this->uri->segment(3)) {
            $order_status = $this->uri->segment(3);
        } else {
            $order_status = 'total_orders';
        }
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $data['title'] = 'My Orders';
            $data['page'] = 'myorders';
            $user_id = $_SESSION['userdata']['user_id'];
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $data['orders'] = $this->Web_model->orderList($user_id, $order_status);
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/my_orders.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {

            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */

            redirect('web');
        }
    }

    function orderview($session_id) {
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $data['title'] = 'View Order';
            $orders = $this->common_model->get_data_with_condition(['session_id' => $session_id], 'orders', 'id', 'desc');
            $order_status_arr = array_column($orders, 'order_status');
            $display_status = min($order_status_arr);
            $max_status = max($order_status_arr);
            foreach ($orders as $ord) {
                $ord->order = $this->Web_model->orderDetails($ord->id);
            }
            $data['data'] = $orders;
            $data['display_status'] = $display_status;
            $data['max_status'] = $max_status;
            $data['sub_total'] = array_sum(array_column($orders, 'sub_total'));
            $data['shipping_charge'] = array_sum(array_column($orders, 'deliveryboy_commission'));
            $data['gst'] = array_sum(array_column($orders, 'gst'));
            $data['grand_total'] = (array_sum(array_column($orders, 'total_price'))) - $orders[0]->coupon_disount;
//pr($data['data']);
            $this->load->view("web/includes/subpage_header", $this->data);
            $this->load->view('web/order_view.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
            /* $data['location'] = $_SERVER['REQUEST_URI'];
              $data['title'] = 'Dashboard';
              $this->load->view('web/index.php',$data); */
        }
    }

    function my_wishlist() {
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $data['title'] = 'My Wishlist';
            $data['page'] = 'mywishlist';
            $user_id = $_SESSION['userdata']['user_id'];
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

    function my_addressbook() {

        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $data['addresslist'] = $this->Web_model->getAddress($user_id);
            $data['states'] = $this->Web_model->getstates();

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

    function become_a_vendor() {
        $user_id = $_SESSION['userdata']['user_id'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
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
        if ($chk == true) {
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

    function product_view($seo_url) {
        if ($this->uri->segment(5) != '') {
            $data['search_title'] = $this->uri->segment(4);
        } else {
            $data['search_title'] = 'nodata';
        }
        if($this->input->post()) {
            $varient_id = $this->input->post('varient_id');
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
        if ($chk == true) {
            $data['product_qry'] = $this->Web_model->checkProductQTY($product_id, $session_id, $user_id);

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            if(!empty($varient_id)) {
            $data['product_details'] = $this->Web_model->getProductDetails($product_id, $user_id, $varient_id);
            $data['type'] = 'varient_filter';
            $data['selected_varient_id'] = $data['product_details']['link_variants'][0]['jsondata'][0]->attribute_value;
            
            } else {
            $data['product_details'] = $this->Web_model->getProductDetails($product_id, $user_id);    
            }
            $data['rel_pro'] = $this->Web_model->similarProduct($cat_id, $user_id);
//echo "<pre>"; print_r($data['product_details']['link_variants']); die;
            $data['linkvarinats'] = $data['product_details']['link_variants'][0]['jsondata'];
            $data['title'] = 'Product Details';
            $data['searchbar'] = 'hide';
            $data['rating'] = $this->Web_model->rating_data($product_id);
//pr($data['linkvarinats']);
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/product_view.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {

            $guest_user_id = $_SESSION['userdata']['guest_user_id'];

            if ($guest_user_id != '') {
                $user_id = 'guest';
                $data['product_qry'] = $this->Web_model->checkProductQTY($product_id, $session_id, $user_id);
                $data['categories'] = $this->Web_model->getHomeLimitCategories();
                $data['social_media_links'] = $this->Web_model->socialMediaLinks();
                $data['product_details'] = $this->Web_model->getProductDetails($product_id, $user_id);
                $data['rel_pro'] = $this->Web_model->similarProduct($cat_id, $user_id);
                $data['title'] = 'Product Details';
                $data['rating'] = $this->Web_model->rating_data($product_id);
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

    function remove_whishlist($product_id) {


        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $data['title'] = 'My Wishlist';
            $data['page'] = 'mywishlist';
            $user_id = $_SESSION['userdata']['user_id'];

            $chk = $this->Web_model->removewhishList($product_id, $user_id);
            if ($chk == true) {

                $this->session->set_tempdata('success_whishlist_message', 'Removed from the Favourites',3);
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

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
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
        if ($chk == true) {
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
            $this->load->view("web/includes/subpage_header", $this->data);
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
                $this->load->view("web/includes/subpage_header", $this->data);
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
        if ($chk == true) {
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
            $this->load->view("web/includes/subpage_header", $this->data);
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
                $this->load->view("web/includes/subpage_header", $this->data);
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
        if ($chk == true) {
            $data['attributes'] = $this->Web_model->attributesWithCategory($catid);
            $data['product_details'] = $this->Web_model->getfilterProducts($jsondata, $shop_id, $catid, $user_id);

//echo "<pre>"; print_r($data['product_details']); die;
            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
//redirect('web/product_categories/'.$catseo_url."/".$shop_seourl);

            $data['shop_id'] = $shop_id;
            $data['catid'] = $catid;
            $data['title'] = 'Products';
            $this->load->view("web/includes/subpage_header", $this->data);
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
                $this->load->view("web/includes/subpage_header", $this->data);
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
        $chk = $this->Web_model->addBookAddress($user_id, $name, $mobile, $address, $state, $cities, $pincode, $landmark, $address_type);
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
        $chk = $this->Web_model->updateBookAddress($aid, $user_id, $name, $mobile, $address, $state, $cities, $pincode, $landmark, $address_type);
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
            $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "'");
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
        if ($chk == true) {
            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
            $del_b = $qry->row();

            if ($qry->num_rows() > 0) {
                $data['aid'] = $this->input->post('aid');
                $data['total_price'] = $total_price; //$this->input->post('total_price');
                $data['session_id'] = $session_id;
                $data['title'] = 'Payment';
                echo json_encode($data);die;
            } else {

                $data['banners'] = $this->Web_model->getBanners($user_id);

                $data['shops'] = $this->Web_model->getAllshopsWithoutcategory($user_id);
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
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['id'] . '</div>
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
                    echo '@success';
                } else {
                    echo '@error';
                }
            }
        }
// $arr = array('msg' => 'Payment successfully credited', 'status' => true);
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
                $mode = "TEST"; //<------------ Change to TEST for test server, PROD for production
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
                    "notifyUrl" => base_url('web/do_cashfree_order'),
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
                foreach ($order_detail as $row) {
                    $this->common_model->update_record(['id' => $row->id], 'orders', $insert);

                    $order_details = $this->Web_model->orderDetails($row->id);

//sms send to customer
//                    $phone = $order_details['ordersdetails']['mobile'];
//                    $otp_message = "Dear " . $order_details['ordersdetails']['customer_name'] . ", your order with order ID #" . $order_details['ordersdetails']['id'] . " placed successfully. Thank you for shopping with Absolute Mens. In case of any queries pls contact customer care. Thanks and Regards Absolute Mens";
//                    $template_id = '1407165995915174281';
//                    $this->Web_model->send_message($otp_message, $phone, $template_id);
//sms send to vendor (check if multiple vendors)
//                    $vendor_mobile = ($this->common_model->get_data_row(['id' => $order_details['ordersdetails']['vendor_id']], 'vendor_shop'))->mobile;
//                    $vendor_otp_message = "Dear vendor thank you for accepting order no #" . $order_details['ordersdetails']['id'] . " & pls prepare goods as requested and pack them for delivery. Thanks and Regards Absolute mens";
//                    $vendor_template_id = '1407165996082020881';
//                    $this->Web_model->send_message($vendor_otp_message, $vendor_mobile, $vendor_template_id);
//email send

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
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['id'] . '</div>
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
                    if (!empty($order_details['ordersdetails']['coupon_disount'])) {
                        $message .= '<tr>
                        <td colspan="5">Coupon Discount</td>
                        <td class="total">(' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['coupon_disount'] . ')</td>
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
                        echo '@success';
                    } else {
                        echo '@error';
                    }

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
                        }
                    }
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

                $session_id_new = rand(11111111111111, 99999999999999);
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);

                redirect('web/thankYou');
            } else {
                $user_id_get = $this->db->get_where('orders', ['pay_transaction_id' => $orderId])->row()->user_id;
                $user_data = $this->db->get_where('users', ['id' => $user_id_get])->row();
                $sess_arr = array(
                    'user_id' => $user_id_get,
                    'email' => $user_data->email,
                    'phone' => $user_data->phone,
                    'logged_in' => true
                );
                $this->session->set_userdata('userdata', $sess_arr);

                $session_id_new = rand(11111111111111, 99999999999999);
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);

                $this->db->where('pay_transaction_id', $orderId)->delete('orders');
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

                $session_id_new = rand(11111111111111, 99999999999999);
                $sess = array(
                    'session_id' => $session_id_new,
                    'session_status' => true
                );
                $this->session->set_userdata('session_data', $sess);
                $orders = $this->common_model->get_data_with_condition(['session_id' => $chk['session_id']], 'orders');
                foreach ($orders as $row) {
                    $order_details = $this->Web_model->orderDetails($row->id);
//sms send to customer
//                $phone = $order_details['ordersdetails']['mobile'];
//                $otp_message = "Dear " . $order_details['ordersdetails']['customer_name'] . ", your order with order ID #" . $order_details['ordersdetails']['id'] . " placed successfully. Thank you for shopping with Absolute Mens. In case of any queries pls contact customer care. Thanks and Regards Absolute Mens";
//                $template_id = '1407165995915174281';
//                $this->Web_model->send_message($otp_message, $phone, $template_id);
//sms send to vendor
                    $vendor_mobile = ($this->common_model->get_data_row(['id' => $order_details['ordersdetails']['vendor_id']], 'vendor_shop'))->mobile;
                    $vendor_otp_message = "Dear vendor thank you for accepting order no #" . $order_details['ordersdetails']['id'] . " & pls prepare goods as requested and pack them for delivery. Thanks and Regards Absolute mens";
                    $vendor_template_id = '1407165996082020881';

                    $this->Web_model->send_message($vendor_otp_message, $vendor_mobile, $vendor_template_id);

//email send

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
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['id'] . '</div>
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

//                    $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
//                    $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
//                    $final_total = $sub_coupon + $order_boy;

                    $message .= '<tr>
                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['amount'] . '</td>
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
                        echo '@success';
                    } else {
                        echo '@error';
                    }
                }
            }
        }
// $arr = array('msg' => 'Payment successfully credited', 'status' => true);
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
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $data['title'] = 'Dashboard';
        $this->load->view("web/includes/subpage_header", $this->data);
        $this->load->view('web/order_confirm.php', $data);
        $this->load->view("web/includes/footer", $this->data);
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
        $product_id = $this->input->post('pid');
        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

        $chk = $this->Web_model->addRemoveTopdealWhishList($product_id, $user_id);
        die;
    }

    function add_most_viewed_removewhishList() {
        $product_id = $this->input->post('pid');
        $user_id = $_SESSION['userdata']['user_id'];

        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }

        $chk = $this->Web_model->add_most_viewed_removewhishList($product_id, $user_id);
        die;
    }

    function searchdata() {
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {

            $user_id = 'guest';
        }
        $keyword = $this->input->post('keyword');
        $chk = $this->Web_model->fetchProducts($keyword, $user_id);
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

        $data['sub_category_list'] = $det['sub_category_list'];
        $data['categories'] = $this->Web_model->getHomeLimitCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $subcat = $det['sub_category_list'][0]['id'];
        $chk = $this->Web_model->checkValidLocation($_SESSION['userdata']['user_id']);
        if ($chk == true) {
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
        if ($chk == true) {
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
        $ar = array('name' => $name, 'mobile' => $mobile, 'email' => $email, 'message' => $message);
        $ins = $this->Web_model->saveContact($ar);
        die;
    }

    function viewAllCategories() {
        $data['categories'] = $this->Web_model->getHomeAllCategories();
        $data['social_media_links'] = $this->Web_model->socialMediaLinks();
        $data['title'] = 'View All Categories';
        $this->load->view("web/includes/subpage_header", $this->data);
        $this->load->view('web/allcategories.php', $data);
        $this->load->view("web/includes/footer", $this->data);
    }

    function viewallProducts($url) {
        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
            $user_id = $_SESSION['userdata']['user_id'];
        } else {
            $user_id = 'guest';
        }

        if ($url == 'topdeals') {
            $data['title'] = 'TOP DEALS';
            $config = array();
            $config["base_url"] = base_url() . "web/viewallProducts/topdeals/";
            $config["total_rows"] = $this->Web_model->getTopDealscount($user_id);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
//print_r($config); die;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["links"] = $this->pagination->create_links();

            $data['products'] = $this->Web_model->getAllTopDeals($config["per_page"], $page, $user_id);

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/viewallproducts.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else if ($url == 'trending') {
            $data['title'] = 'TRENDING OFFERS';
            $config = array();
            $config["base_url"] = base_url() . "web/viewallProducts/trending/";
            $config["total_rows"] = $this->Web_model->getmostViewedProducts_count($user_id);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
//print_r($config); die;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["links"] = $this->pagination->create_links();

            $data['products'] = $this->Web_model->getmostViewedProductsAll($config["per_page"], $page, $user_id);

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $data['social_media_links'] = $this->Web_model->socialMediaLinks();
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/viewallproducts.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else if ($url == 'new_arrival') {
            $data['title'] = 'NEW ARRIVAL OFFERS';
            $config = array();
            $config["base_url"] = base_url() . "web/viewallProducts/new_arrival/";
            $config["total_rows"] = $this->Web_model->getmostViewedProducts_count($user_id);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
//print_r($config); die;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["links"] = $this->pagination->create_links();

            $data['products'] = $this->Web_model->getmostViewedProductsAll($config["per_page"], $page, $user_id);

            $data['categories'] = $this->Web_model->getHomeLimitCategories();
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/viewallproducts.php', $data);
            $this->load->view("web/includes/footer", $this->data);
        }
    }

    function viewallshops() {

        $user_id = $_SESSION['userdata']['user_id'];
        $chk = $this->Web_model->checkValidLocation($user_id);
        if ($chk == true) {
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
        $this->load->view("web/includes/subpage_header", $this->data);
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
        if ($chk == true) {
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
            $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "'");
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
        if ($chk == true) {
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
        if ($chk == true) {

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
        if ($chk == true) {
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

    function banner_product_view($random_number) {
//print_r($random_number); die;
//$this->$data['banners_data'] = $this->common_model->banners_product_data($random_number);
//$bann = $this->db->where(array("random_number"=>$random_number))->get("banners")->row();
//$tag = $bann->tag_id;

        $bann = $this->common_model->get_data_row(['random_number' => $random_number], 'banners');
        $this->db->where("(FIND_IN_SET($bann->tag_id, product_tags))");
        $this->db->where(['status' => 1, 'availabile_stock_status' => 'available']);
        $products_get = $this->db->get('products')->result();
        $products = [];
        foreach ($products_get as $product) {
            $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);

            $stock_exists = [];
            $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id], 'link_variant');
            foreach ($stockArr as $stock) {
                if ($stock->stock > 0) {
                    array_push($stock_exists, $stock);
                }
            }
            $stock = sizeof($stock_exists);

            if ($chk_shop_status == 1 && $stock > 0) {
                array_push($products, $product);
            }
        }

        foreach ($products as $row) {
            $product_image = ($this->common_model->get_data_row(['product_id' => $row->id], 'product_images', $order_by_column = 'id', $order_by = 'asc'))->image;
            if ($product_image) {
                $row->product_image = $product_image;
            } else {
                $row->product_image = 'noproduct.png';
            }
            if ($this->data['user_id'] == true) {
                $is_in_wish_list = $this->common_model->get_data_row(['product_id' => $row->id, 'user_id' => $this->data['user_id']], 'whish_list');
                if ($is_in_wish_list) {
                    $row->whishlist_status = true;
                } else {
                    $row->whishlist_status = false;
                }
            } else {
                $row->whishlist_status = false;
            }
            $row->variant = $this->common_model->get_data_row(['product_id' => $row->id, 'saleprice >' => 0], 'link_variant', 'id', 'desc');
        }

        $data['banner_products'] = $products;

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
}
