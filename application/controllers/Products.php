<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

    public $data;

    function __construct() {

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept,Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();

//        if ($_SESSION['userdata']['logged_in'] != true) {  
//            redirect('web');
//        }
        $this->data['user_id'] = $_SESSION['userdata']['user_id'];

        $qry = $this->db->query("select * from categories where status=1 order by priority asc limit 4");
        $this->data['categories'] = $qry->result_array();
    }

    function index() {
        $keyword = $this->input->get_post('searchdata');
        $keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');





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
            // print_r($data['brand_checked']);
            // exit;
        }

        if ($this->input->get_post('filter')) {
            $option = $this->input->get_post('option');
            if ($option) {
                $filter = $this->input->get_post('filter');
                $data['filter'] = implode(",", $filter);
                $data['option'] = implode(",", $option);
            }
        }

        //filters-----------------

        if (!empty($keyword)) {

            //search products by name & brand & category & subcategory & filter names
            // $this->db->where(['status' => 1, 'availabile_stock_status' => 'available']);
            // $this->db->like('name', $keyword);
            // $prod = $this->db->get('products')->row()->id;
            $this->db->where(['status' => 1, 'availabile_stock_status' => 'available']);
            $this->db->like('LOWER(REPLACE(name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $prod = $this->db->get('products')->row()->id;
            // $this->db->like('brand_name', $keyword);
            // $brand = $this->db->get('attr_brands')->row()->id;

            $this->db->like('LOWER(REPLACE(brand_name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $brand = $this->db->get('attr_brands')->row()->id;

            $this->db->like('LOWER(REPLACE(descp, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $descp = $this->db->get('products')->row()->id;

            // $this->db->where(['status' => 1]);
            // $this->db->like('category_name', $keyword);
            // $cat_id = $this->db->get('categories')->row()->id;
            $this->db->where('status', 1);
            $this->db->like('LOWER(REPLACE(category_name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $category = $this->db->get('categories')->row();
            if ($category) {
                $cat_id = $category->id;
            } else {
                // Handle case where no matching category is found
                $cat_id = null;
            }

            // $this->db->where(['status' => 1]);
            // $this->db->like('sub_category_name', $keyword);
            // $sub_cat_id = $this->db->get('sub_categories')->row()->id;
            $this->db->where(['status' => 1]);
            $this->db->like('LOWER(REPLACE(sub_category_name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $sub_cat_id = $this->db->get('sub_categories')->row()->id;

            // $this->db->like('options', $keyword);
            // $filter_option_id = $this->db->get('filter_options')->row()->id;
            $this->db->like('LOWER(REPLACE(options, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $filter_option_id = $this->db->get('filter_options')->row()->id;

            // $this->db->like('option', $keyword);
            // $quest_option_id = $this->db->get('options')->row()->id;
            // $this->db->like('LOWER(REPLACE(option, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            // $quest_option_id = $this->db->get('options')->row()->id;
            $this->db->select('*');
            $this->db->where("LOWER(REPLACE(`option`, ' ', '')) LIKE '%" . strtolower(str_replace(' ', '', $keyword)) . "%'", NULL, FALSE);
            $quest_option = $this->db->get('options')->row();
            if ($quest_option) {
                $quest_option_id = $quest_option->id;
            } else {
                $quest_option_id = null; // or handle the case when no result is found
            }

            // $this->db->like('title', $keyword);
            // $tag_id = $this->db->get('tags')->row()->id;
            $this->db->like('LOWER(REPLACE(title, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $tag_id = $this->db->get('tags')->row()->id;

            // $this->db->like('meta_tag_keywords', $keyword);
            // $meta_keywords = $this->db->get('products')->num_rows();
            $this->db->like('LOWER(REPLACE(meta_tag_keywords, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
            $meta_keywords = $this->db->get('products')->num_rows();


            // if ($prod > 0) {
            //     $this->db->like('name', $keyword);
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // } else if ($brand > 0) {
            //     $this->db->where('brand', $brand);
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // } else if ($cat_id > 0) {
            //     $this->db->where('cat_id', $cat_id);
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // } else if ($sub_cat_id > 0) {
            //     $this->db->where('sub_cat_id', $sub_cat_id);
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // } else if ($filter_option_id > 0) {
            //     $products_get = [];
            //     $products_getto = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            //     foreach ($products_getto as $getto) {
            //         $this->db->where("(FIND_IN_SET($filter_option_id, filter_options))");
            //         $this->db->where("product_id", $getto->id);
            //         $chk = $this->db->get('product_filter')->num_rows();
            //         if ($chk > 0) {
            //             array_push($products_get, $getto);
            //         }
            //     }
            // } else if ($quest_option_id > 0) {
            //     $this->db->where("(FIND_IN_SET($quest_option_id, option_id))");
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // } else if ($tag_id > 0) {
            //     $this->db->where("(FIND_IN_SET($tag_id, product_tags))");
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // } else if ($meta_keywords > 0) {
            //     $this->db->like('meta_tag_keywords', $keyword);
            //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // }

            

         $products_get = [];

            if ($prod > 0) {
                // $this->db->like('name', $keyword);
                $this->db->like('LOWER(REPLACE(name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
                $products_get2 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get2);
            } if ($brand > 0) {
                $this->db->where('brand', $brand);
                $products_get3 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                array_push($products_get, $products_get3);
            } if ($cat_id > 0) {
                $this->db->where('cat_id', $cat_id);
                $products_get4 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get4);
            } if ($sub_cat_id > 0) {
                $this->db->where('sub_cat_id', $sub_cat_id);
                $products_get5 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get5);
            } if ($filter_option_id > 0) {
                $products_get1 = [];
                $products_getto = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                foreach ($products_getto as $getto) {
                    $this->db->where("(FIND_IN_SET($filter_option_id, filter_options))");
                    $this->db->where("product_id", $getto->id);
                    $chk = $this->db->get('product_filter')->num_rows();
                    if ($chk > 0) {
                        array_push($products_get, $getto);
                    }
                      array_push($products_get, $products_get1);
                }
              

            } if ($quest_option_id > 0) {
                $this->db->where("(FIND_IN_SET($quest_option_id, option_id))");
                $products_get6 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get6);
            } if ($tag_id > 0) {
                $this->db->where("(FIND_IN_SET($tag_id, product_tags))");
                $products_get7 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get7);
            } if ($meta_keywords > 0) {
                // $this->db->like('meta_tag_keywords', $keyword);
                $this->db->like('LOWER(REPLACE(meta_tag_keywords, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
                $products_get8 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get8);
            }
            if($descp>0){
                $this->db->like('LOWER(REPLACE(descp, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
                $products_get9 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get9);
            }

//pr($products_get);

            //check for available products
            $products = [];
           
            foreach ($products_get[0] as $product) {
                $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
                $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                $stock = sizeof($stockArr);
                $category_status = $this->common_model->count_rows_with_conditions('categories', ['id' => $product->cat_id, 'status' => 1]);

                if ($chk_shop_status == 1 && $stock > 0 && $category_status > 0) {
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
            // exit;

            $brands_get = [];
            $filter_data = [];
            $rate=[];
            foreach ($products as $row) {
                // $rating_arr= $this->web_model->rating_data($row->id);
                // print_r($rating_arr);
                // exit;
                // array_push($rating, $rating_arr);
                $rating_arr = $this->web_model->rating_data($row->id);

                    if ($rating_arr['rating_data'] > 0) {
                        $formula = ($rating_arr['review5'] * 5 + $rating_arr['review4'] * 4 + $rating_arr['review3'] * 3 + $rating_arr['review2'] * 2 + $rating_arr['review1'] * 1) / $rating_arr['rating_data'];
                
                        $rate[] = ["product_id" => $row->id, "rating" => $formula];
                    }
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
                $row->variant = $this->common_model->get_data_row(['product_id' => $row->id, 'stock >' => 0, 'status' => 1], 'link_variant', 'id', 'desc');

                $product_image = ($this->common_model->get_data_row(['variant_id' => $row->variant->id], 'product_images', $order_by_column = 'priority', $order_by = 'asc'))->image;
                if ($product_image) {
                    $row->product_image = $product_image;
                } else {
                    $row->product_image = 'noproduct.png';
                }
               
                // echo "<pre>";
                // foreach($products_get[0] as $pro){
                //     // print_r($pro->option_id);
                //     $filter_data[$fil->id]['product_id']=$pro->id;
                //     // $filter_data[$fil->id]['option'] = $pro->option_id;
                // }

                // if (!empty($row->brand)) {
                    
                    // array_push($brands_get, $row->brand);
                    // print_r($row->brand);
                // }
            }
            // $brand_id_array=[];
            // foreach($products as $prod){
            //     // print_r($prod->brand);
            //     $brand_id_array[]=$prod->brand;
            // }
            // // print_r($brand_id_array);
            // foreach($brand_id_array as $br){
            //     $query1=$this->db->query("select * from attr_brands where id='".$br."'");
            //     $query1_res=$query1->result();
            // }
           
            // foreach($query1_res as $res){
            //     print_r($res->id);
            //     array_push($brands_get, $res->id);
            // }
            
            // exit;
           
            // print_r($filter_data);
            // exit;
            
$brand_id_array = [];
$brands_get = [];


foreach ($products_get[0] as $prod) {

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


foreach ($brand_id_array as $br) {
    $query1 = $this->db->query("SELECT * FROM attr_brands WHERE id='" . $br . "'");
    $query1_res = $query1->result();

    // Loop through results for each brand
    foreach ($query1_res as $res) {
        // print_r($res->id); // Debugging
        array_push($brands_get, $res->id);
    }
}

$name_array = array();
foreach($products as $pro) {
    $name_array[] = $pro->name;
}

// JSON encode the array before storing it
$search_results_json = json_encode($name_array);

// Update the database
$this->db->where('keywords', $keyword);
$this->db->update('search_keywords', array('search_results' => $search_results_json));

// print_r($name_array); // Debugging
// exit;
// print_r($filter_data);
// exit;



            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));
            $data['keyword'] = $keyword;
            $data['categories'] = $this->data['categories'];
            $data['searchdata'] = $keyword;
            $data['products'] = $products;
            $data['filters'] = $filter_data;
            $data['brands'] = $brands_get;
            $data['unique_filter_ids'] = $unique_filter_ids;
            $data['rating'] = $rate;
            // $data['rating']=$rating;
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/products', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
        }
    }

    function category_products($cat_seo_url, $subcat_seo_url = null) {
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

        //filters-----------------

        $category = $this->common_model->get_data_row(['seo_url' => $cat_seo_url, 'status' => 1], 'categories');
        $cat_id = $category->id;
        if (!empty($cat_id)) {
            if (!empty($subcat_seo_url)) {
                $sub_category = $this->common_model->get_data_row(['seo_url' => $subcat_seo_url, 'status' => 1], 'sub_categories');
                $sub_cat_id = $sub_category->id;
                $products_get = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'sub_cat_id' => $sub_cat_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
            } else {
                $products_get = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
            }

            //check for available products
            $products = [];
            foreach ($products_get as $product) {
                $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
                $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                $stock = sizeof($stockArr);

                if ($chk_shop_status == 1 && $stock > 0) {
                    if (empty($this->input->get())) {
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

            $brands_get = [];
            $filter_data = [];
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
            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));

            $data['categories'] = $this->data['categories'];
            $data['category'] = $category;
            $data['products'] = $products;
            $data['filters'] = $filter_data;
            $data['brands'] = $brands_get;
            $data['unique_filter_ids'] = $unique_filter_ids;
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/products', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
        }
    }

    function sub_category_products($sub_cat_seo_url) {

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

        //filters-----------------

        $sub_category = $this->common_model->get_data_row(['seo_url' => $sub_cat_seo_url, 'status' => 1], 'sub_categories');
        $sub_cat_id = $sub_category->id;
        $category = $this->common_model->get_data_row(['id' => $sub_category->cat_id, 'status' => 1], 'categories');
        if (!empty($sub_cat_id)) {
            $products_get = $this->common_model->get_data_with_condition(['sub_cat_id' => $sub_cat_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
            //check for available products
            $products = [];
            foreach ($products_get as $product) {
                $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
                $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                $stock = sizeof($stockArr);

                if ($chk_shop_status == 1 && $stock > 0) {
                    if (empty($this->input->get())) {
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

            $brands_get = [];
            $filter_data = [];
            $rate=[];
            foreach ($products as $row) {
                $rating_arr = $this->web_model->rating_data($row->id);

                if ($rating_arr['rating_data'] > 0) {
                    $formula = ($rating_arr['review5'] * 5 + $rating_arr['review4'] * 4 + $rating_arr['review3'] * 3 + $rating_arr['review2'] * 2 + $rating_arr['review1'] * 1) / $rating_arr['rating_data'];
            
                    $rate[] = ["product_id" => $row->id, "rating" => $formula];
                }
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

            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));

            $data['categories'] = $this->data['categories'];
            $data['category'] = $category;
            $data['sub_category'] = $sub_category;
            $data['products'] = $products;
            $data['filters'] = $filter_data;
            $data['brands'] = $brands_get;
            // echo "<pre>";
            // print_r($rating);
            // exit;
            $data['rating']=$rate;
            
            $data['unique_filter_ids'] = $unique_filter_ids;
            $this->load->view("web/includes/header_styles", $this->data);
            $this->load->view('web/products', $data);
            $this->load->view("web/includes/footer", $this->data);
        } else {
            redirect('web');
        }
    }

//    function category_products($cat_seo_url, $option_seo_url = null) {
//        //filters--------------
//        if ($this->input->post('amount_range')) {
//            $amount_range_get = $this->input->post('amount_range');
//            $amount_range_arr = explode('-', $amount_range_get);
//            $start_amount = trim(str_replace('Rs.', '', $amount_range_arr[0]));
//            $end_amount = trim(str_replace('Rs.', '', $amount_range_arr[1]));
//            $data['min_price'] = $start_amount;
//            $data['max_price'] = $end_amount;
//        }
//
//        if ($this->input->post('brand_id')) {
//            $brand_id = $this->input->post('brand_id');
//            $data['brand_checked'] = implode(",", $brand_id);
//        }
//
//        if (empty($option_seo_url)) {
//            $filter = $this->input->get_post('filter');
//            $option = $this->input->get_post('option');
//            $data['filter'] = implode(",", $filter);
//            $data['option'] = implode(",", $option);
//        } else {
//            if (empty($this->input->post())) {
//                $get_filter_details = $this->common_model->get_data_row(['seo_url' => $option_seo_url], 'filter_options');
//                $filter = array($get_filter_details->filter_id);
//                $option = array($get_filter_details->id);
//                $data['option_details'] = $get_filter_details;
//            } else {
//                $filter = $this->input->get_post('filter');
//                $option = $this->input->get_post('option');
//            }
//            $data['filter'] = implode(",", $filter);
//            $data['option'] = implode(",", $option);
//        }
//        //filters-----------------
//
//        $category = $this->common_model->get_data_row(['seo_url' => $cat_seo_url, 'status' => 1], 'categories');
//        $cat_id = $category->id;
//        if (!empty($cat_id)) {
//            $products_get = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
//            //check for available products
//            $products = [];
//            foreach ($products_get as $product) {
//                $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
//                $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id, 'stock >' => 0, 'status' => 1], 'link_variant');
//                $stock = sizeof($stockArr);
//                //check if filter option is selected or not (navbar: categories)
//                if ($option_seo_url) {
//                    $chk_filter = [];
//                    foreach ($filter as $val) {
//                        $filter_options = explode(',', (($this->common_model->get_data_row(['product_id' => $product->id, 'filter_id' => $val], 'product_filter'))->filter_options));
//                        $match = array_intersect($option, $filter_options);
//                        if ($match) {
//                            array_push($chk_filter, $match);
//                        }
//                    }
//                    if ($chk_shop_status == 1 && $stock > 0 && sizeof($chk_filter) > 0) {
//                        if (empty($this->input->post())) {
//                            array_push($products, $product);
//                        } else {
//                            //filter here
//                            $apply_filter = $this->common_model->apply_filter($product->id, $start_amount, $end_amount, $brand_id, $filter, $option);
//                            if ($apply_filter == 1) {
//                                array_push($products, $product);
//                            }
//                        }
//                    }
//                } else {
//                    if ($chk_shop_status == 1 && $stock > 0) {
//                        if (empty($this->input->post())) {
//                            array_push($products, $product);
//                        } else {
//                            //filter here
//                            $apply_filter = $this->common_model->apply_filter($product->id, $start_amount, $end_amount, $brand_id, $filter, $option);
//                            if ($apply_filter == 1) {
//                                array_push($products, $product);
//                            }
//                        }
//                    }
//                }
//            }
//
//            $brands_get = [];
//            $filter_data = [];
//            foreach ($products as $row) {
//                $row->variant = $this->common_model->get_data_row(['product_id' => $row->id, 'stock >' => 0, 'status' => 1], 'link_variant', 'id', 'desc');
//                if ($this->data['user_id'] == true) {
//                    $is_in_wish_list = $this->common_model->get_data_row(['variant_id' => $row->variant->id, 'user_id' => $this->data['user_id']], 'whish_list');
//                    if ($is_in_wish_list) {
//                        $row->whishlist_status = true;
//                    } else {
//                        $row->whishlist_status = false;
//                    }
//                    //check already in cart or not
//                        $session_id = $_SESSION['session_data']['session_id'];
    //                       $row->in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $row->variant->id])->get('cart')->num_rows();
//                } else {
//                    $row->whishlist_status = false;
//                }
//                $product_image = ($this->common_model->get_data_row(['variant_id' => $row->variant->id], 'product_images', $order_by_column = 'priority', $order_by = 'asc'))->image;
//                if ($product_image) {
//                    $row->product_image = $product_image;
//                } else {
//                    $row->product_image = 'noproduct.png';
//                }
//                $product_filters = $this->common_model->get_data_with_condition(['product_id' => $row->id], 'product_filter');
//
//                if (sizeof($product_filters) > 0) {
//                    foreach ($product_filters as $fil) {
//                        $filter_data[$fil->id]['product_id'] = $fil->product_id;
//                        $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
//                        $filter_data[$fil->id]['option'] = $fil->filter_options;
//                    }
//                }
//                if (!empty($row->brand)) {
//                    array_push($brands_get, $row->brand);
//                }
//            }
//
//            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));
//
//            $data['categories'] = $this->data['categories'];
//            $data['category'] = $category;
//            $data['products'] = $products;
//            $data['filters'] = $filter_data;
//            $data['brands'] = $brands_get;
//            $data['unique_filter_ids'] = $unique_filter_ids;
//            $this->load->view("web/includes/header_styles", $this->data);
//            $this->load->view('web/products', $data);
//            $this->load->view("web/includes/footer", $this->data);
//        } else {
//            redirect('web');
//        }
//    }
}
