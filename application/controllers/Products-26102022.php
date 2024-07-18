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
        $filter = $this->input->get_post('filter');
        $option = $this->input->get_post('option');

        if (!empty($keyword)) {
            $data['searchdata'] = $keyword;
            if ($this->input->post('filter')) {
                $data['filter'] = implode(",", $this->input->post('filter'));
                $data['option'] = implode(",", $this->input->post('option'));
            } else if ($this->input->post('amount_range')) {
                $amount_range_get = $this->input->post('amount_range');
                $amount_range_arr = explode('-', $amount_range_get);
                $start_amount = trim(str_replace('Rs.', '', $amount_range_arr[0]));
                $end_amount = trim(str_replace('Rs.', '', $amount_range_arr[1]));
            } else if ($this->input->post('brand_id')) {
                $brand_id = $this->input->post('brand_id');
            }

            //search products by name & brand & category & subcategory
            $this->db->like('name', $keyword);
            $prod = $this->db->get('products')->row()->id;

            $this->db->like('brand_name', $keyword);
            $brand = $this->db->get('attr_brands')->row()->id;

            $this->db->like('category_name', $keyword);
            $cat_id = $this->db->get('categories')->row()->id;

            $this->db->like('sub_category_name', $keyword);
            $sub_cat_id = $this->db->get('sub_categories')->row()->id;

            if ($prod > 0) {
                $this->db->like('name', $keyword);
                $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            } else if ($brand > 0) {
                $this->db->like('brand', $brand);
                $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            } else if ($cat_id > 0) {
                $this->db->like('cat_id', $cat_id);
                $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            } else if ($sub_cat_id > 0) {
                $this->db->like('sub_cat_id', $sub_cat_id);
                $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            }

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

                if (!empty($filter) && !empty($option)) {
                    $chk_filter = [];
                    foreach ($filter as $val) {
                        $filter_options = explode(',', (($this->common_model->get_data_row(['product_id' => $product->id, 'filter_id' => $val], 'product_filter'))->filter_options));
                        $match = array_intersect($option, $filter_options);
                        if ($match) {
                            array_push($chk_filter, $match);
                        }
                    }
                    if ($chk_shop_status == 1 && $stock > 0 && sizeof($chk_filter) > 0) {
                        array_push($products, $product);
                    }
                } else if (!empty($end_amount)) {
                    $chk_price = $this->common_model->get_data_row(['product_id' => $product->id, 'saleprice >=' => $start_amount, 'saleprice <=' => $end_amount, 'saleprice !=' => 0], 'link_variant', 'id', 'desc');

                    if ($chk_shop_status == 1 && $stock > 0 && !empty($chk_price)) {
                        array_push($products, $product);
                    }
                } else if (!empty($brand_id) && ($brand_id) > 0) {
                    $match_brand = $this->common_model->count_rows_with_conditions('products', ['id' => $product->id, 'brand' => $brand_id]);
                    if ($chk_shop_status == 1 && $stock > 0 && $match_brand > 0) {
                        array_push($products, $product);
                    }
                } else {
                    if ($chk_shop_status == 1 && $stock > 0) {
                        array_push($products, $product);
                    }
                }
            }
            $brands_get = [];
            $filter_data = [];
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

                $product_filters = $this->common_model->get_data_with_condition(['product_id' => $row->id], 'product_filter');

                if (sizeof($product_filters) > 0) {
                    foreach ($product_filters as $fil) {
                        $filter_data[$fil->id]['product_id'] = $fil->product_id;
                        $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                        $filter_data[$fil->id]['option'] = $fil->filter_options;
                    }
                }
                if (!empty($row->brand)) {
                    array_push($brands_get, $row->brand);
                }
            }

            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));

            //pr($products);

            $data['categories'] = $this->data['categories'];
            $data['searchdata'] = $keyword;
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
    }

    function category_products($cat_seo_url, $option_seo_url = null) {

        if ($this->input->post('filter')) {
            $data['filter'] = implode(",", $this->input->post('filter'));
            $data['option'] = implode(",", $this->input->post('option'));
        } else if ($this->input->post('amount_range')) {
            $amount_range_get = $this->input->post('amount_range');
            $amount_range_arr = explode('-', $amount_range_get);
            $start_amount = trim(str_replace('Rs.', '', $amount_range_arr[0]));
            $end_amount = trim(str_replace('Rs.', '', $amount_range_arr[1]));
        } else if ($this->input->post('brand_id')) {
            $brand_id = $this->input->post('brand_id');
        }

        $category = $this->common_model->get_data_row(['seo_url' => $cat_seo_url, 'status' => 1], 'categories');
        $cat_id = $category->id;
        if (!empty($cat_id)) {
            $products_get = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
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

                if (empty($option_seo_url)) {
                    $filter = $this->input->get_post('filter');
                    $option = $this->input->get_post('option');
                } else {
                    $get_filter_details = $this->common_model->get_data_row(['seo_url' => $option_seo_url], 'filter_options');
                    $filter = array($get_filter_details->filter_id);
                    $option = array($get_filter_details->id);
                    $data['option_details'] = $get_filter_details;
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
                    if ($chk_shop_status == 1 && $stock > 0 && sizeof($chk_filter) > 0) {
                        array_push($products, $product);
                    }
                } else if (!empty($end_amount)) {
                    $chk_price = $this->common_model->get_data_row(['product_id' => $product->id, 'saleprice >=' => $start_amount, 'saleprice <=' => $end_amount, 'saleprice !=' => 0], 'link_variant', 'id', 'desc');

                    if ($chk_shop_status == 1 && $stock > 0 && !empty($chk_price)) {
                        array_push($products, $product);
                    }
                } else if (!empty($brand_id) && ($brand_id) > 0) {
                    $match_brand = $this->common_model->count_rows_with_conditions('products', ['id' => $product->id, 'brand' => $brand_id]);
                    if ($chk_shop_status == 1 && $stock > 0 && $match_brand > 0) {
                        array_push($products, $product);
                    }
                } else {
                    if ($chk_shop_status == 1 && $stock > 0) {
                        array_push($products, $product);
                    }
                }
            }
            $brands_get = [];
            $filter_data = [];
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

                $product_filters = $this->common_model->get_data_with_condition(['product_id' => $row->id], 'product_filter');

                if (sizeof($product_filters) > 0) {
                    foreach ($product_filters as $fil) {
                        $filter_data[$fil->id]['product_id'] = $fil->product_id;
                        $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                        $filter_data[$fil->id]['option'] = $fil->filter_options;
                    }
                }
                if (!empty($row->brand)) {
                    array_push($brands_get, $row->brand);
                }
            }

            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));

            //pr($products);

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
    }

    function sub_category_products($sub_cat_seo_url) {

        if ($this->input->post('filter')) {
            $data['filter'] = implode(",", $this->input->post('filter'));
            $data['option'] = implode(",", $this->input->post('option'));
        } else if ($this->input->post('amount_range')) {
            $amount_range_get = $this->input->post('amount_range');
            $amount_range_arr = explode('-', $amount_range_get);
            $start_amount = trim(str_replace('Rs.', '', $amount_range_arr[0]));
            $end_amount = trim(str_replace('Rs.', '', $amount_range_arr[1]));
        } else if ($this->input->post('brand_id')) {
            $brand_id = $this->input->post('brand_id');
        }

        $sub_category = $this->common_model->get_data_row(['seo_url' => $sub_cat_seo_url, 'status' => 1], 'sub_categories');
        $sub_cat_id = $sub_category->id;
        $category = $this->common_model->get_data_row(['id' => $sub_category->cat_id, 'status' => 1], 'categories');
        if (!empty($sub_cat_id)) {
            $products_get = $this->common_model->get_data_with_condition(['sub_cat_id' => $sub_cat_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
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

                    $filter = $this->input->get_post('filter');
                    $option = $this->input->get_post('option');
                
                if (!empty($filter) && !empty($option)) {
                    $chk_filter = [];
                    foreach ($filter as $val) {
                        $filter_options = explode(',', (($this->common_model->get_data_row(['product_id' => $product->id, 'filter_id' => $val], 'product_filter'))->filter_options));
                        $match = array_intersect($option, $filter_options);
                        if ($match) {
                            array_push($chk_filter, $match);
                        }
                    }
                    if ($chk_shop_status == 1 && $stock > 0 && sizeof($chk_filter) > 0) {
                        array_push($products, $product);
                    }
                } else if (!empty($end_amount)) {
                    $chk_price = $this->common_model->get_data_row(['product_id' => $product->id, 'saleprice >=' => $start_amount, 'saleprice <=' => $end_amount, 'saleprice !=' => 0], 'link_variant', 'id', 'desc');

                    if ($chk_shop_status == 1 && $stock > 0 && !empty($chk_price)) {
                        array_push($products, $product);
                    }
                } else if (!empty($brand_id) && ($brand_id) > 0) {
                    $match_brand = $this->common_model->count_rows_with_conditions('products', ['id' => $product->id, 'brand' => $brand_id]);
                    if ($chk_shop_status == 1 && $stock > 0 && $match_brand > 0) {
                        array_push($products, $product);
                    }
                } else {
                    if ($chk_shop_status == 1 && $stock > 0) {
                        array_push($products, $product);
                    }
                }
            }
           
            $brands_get = [];
            $filter_data = [];
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

                $product_filters = $this->common_model->get_data_with_condition(['product_id' => $row->id], 'product_filter');

                if (sizeof($product_filters) > 0) {
                    foreach ($product_filters as $fil) {
                        $filter_data[$fil->id]['product_id'] = $fil->product_id;
                        $filter_data[$fil->id]['filter_id'] = $fil->filter_id;
                        $filter_data[$fil->id]['option'] = $fil->filter_options;
                    }
                }
                if (!empty($row->brand)) {
                    array_push($brands_get, $row->brand);
                }
            }

            $unique_filter_ids = array_unique(array_column($filter_data, 'filter_id'));

            //pr($products);

            $data['categories'] = $this->data['categories'];
            $data['category'] = $category;
            $data['sub_category'] = $sub_category;
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
    }

}
