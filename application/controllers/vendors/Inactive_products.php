<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inactive_products extends MY_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        $this->load->library('image_lib');

        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('vendors/login');
        }

        $this->load->model("admin_model");
        $this->load->model("vendor_model");
        $this->load->library('pagination');
    }

    function index() {
        $keyword = $this->input->post('keyword');
        $this->data['page_name'] = 'inactive_products';

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $count = $this->db->query("select * from products where status=0 and shop_id=$shop_id order by id desc");
        $this->data['count_data'] = $count->num_rows();

        $config['base_url'] = base_url() . 'vendors/inactive_products';
        $config['total_rows'] = $this->data['count_data'] = $count->num_rows();
        $config['per_page'] = 100;
        // $this->data['page_title'] = 'Total '.$config['total_rows'].' Books';
        $config['page_query_string'] = true;
        $config['num_links'] = 5;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['reuse_query_string'] = true;
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li class="button grey">';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li class="button grey">';
        $config['next_tag_close'] = '</li>';

        $start = ($this->input->get_post('per_page')) ? $this->input->get_post('per_page') : 0;
        if ($start == "") {
            $this->data['kk'] = 1;
        } else {
            $this->data['kk'] = $start + 1;
        }
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['page_start'] = $start - $config['per_page'] + 11;
        $this->db->limit($config['per_page'], $start);

//        if($keyword!=""){
//            $this->data['filter']=true;
//            //print_r($keyword); die;
//            $this->db->where("(name LIKE '%".$keyword."%')");
//        }

        $this->db->select('p.*,c.id as cat_id,sub.id as sub_id, s.shop_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.cat_id');
        $this->db->join('sub_categories sub', 'sub.id = p.sub_cat_id', 'left');
        $this->db->join('vendor_shop s', 's.id = p.shop_id');
        $this->db->where('p.status', '0');
        $this->db->where("(p.name LIKE '%" . $keyword . "%' OR c.category_name LIKE '%" . $keyword . "%' OR sub.sub_category_name LIKE '%" . $keyword . "%')");
        $this->db->order_by('p.id', 'desc');

        if (isset($shop_id)) {

            $this->data['shop_id'] = $shop_id;

            $this->db->where('p.shop_id', $shop_id);
        }



        $this->data['products'] = $this->db->get()->result();

        if (count($this->data['products'])) {

            $this->data['title'] = $this->data['products'][0]->shop_name;

            foreach ($this->data['products'] as $pr) {

                $this->db->where('id', $pr->id);

                $product_images = $this->db->get('product_images')->result();

                $pr->product_images = $product_images;

                if (count($product_images) > 0) {

                    $pr->image = $product_images[0]->image;
                } else {

                    $pr->image = 'default.png';
                }
            }
        } else {

            $this->data['title'] = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id)->shop_name;
        }



        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/inactive_products', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function product_images($pid, $vid) {

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $this->data['title'] = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id)->shop_name;

        $this->data['pid'] = $pid;

        $this->data['vid'] = $vid;

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/product_images', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function stockManagement($pid, $vid) {

        $this->data['pid'] = $pid;

        $this->data['vid'] = $vid;

        $qry = $this->db->query("select * from stock_management where varient_id='" . $vid . "' and product_id='" . $pid . "'");

        $this->data['stock'] = $qry->result();

        //redirect('http://demoworks.in/php/absolutemens.com/vendors/products/stock_management/'.$pid."/".$vid);



        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/stock_management', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function create_stock($pid, $vid) {

        $this->data['pid'] = $pid;

        $this->data['vid'] = $vid;

        $this->data['title'] = "Add Stock";

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/add_stock', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function insertStock() {

        $pid = $this->input->get_post('pid');

        $vid = $this->input->get_post('vid');

        $quantity = $this->input->get_post('quantity');

        $created_at = time();

        $status = "Credit";

        $message = "Stock Added";

        $qry = $this->db->query("select * from link_variant where id='" . $vid . "'");

        $row = $qry->row();

        $stock = $row->stock;

        $final = $stock + $quantity;

        $ar = array('varient_id' => $vid, 'product_id' => $pid, 'quantity' => $quantity, 'total_stock' => $final, 'paid_status' => $status, 'message' => $message, 'created_at' => $created_at);

        $ins = $this->db->insert("stock_management", $ar);

        if ($ins) {

            $this->db->update("link_variant", array('stock' => $final), array('id' => $vid));

            $this->data['pid'] = $pid;

            $this->data['vid'] = $vid;

            $this->session->set_tempdata('success_message', 'Stock added Successfully',3);

            redirect(base_url() . 'vendors/products/stockManagement/' . $pid . "/" . $vid);

            /* $this->load->view('vendors/includes/header', $this->data);

              $this->load->view('vendors/stock_management', $this->data);





              $this->load->view('vendors/includes/footer'); */
        }
    }

    function childproducts() {

        $this->data['pid'] = $this->uri->segment(4);

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/child_products', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function add_product() {

        $this->data['title'] = 'Add Product';

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $shop_data = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id);

        $this->data['shop_id'] = $shop_id;

        $this->data['title'] = $shop_data->shop_name;

        $this->data['filters'] = $this->db->get('filters')->result();

        $this->data['cities'] = $this->db->get('cities')->result();

        $qry = $this->db->query("select * from admin_comissions where shop_id='" . $shop_id . "' group by cat_id");

        $resul = $qry->result();

        $ar = [];

        foreach ($resul as $value) {

            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

            $category = $cat->row();

            $data = $this->db->where("cat_id", $value->cat_id)->get("questionaries")->result();

            $ar[] = array('id' => $category->id, 'category_name' => $category->category_name, 'ques_id' => $data->id, 'question' => $data->question);
        }

        $this->data['categories'] = $ar;

//        $table = "questionaries";
//        $this->db->select("*");
//        $data = $this->db->get($table)->result();
//        $this->data['questionary'] = $data;

        $this->data['shops'] = $this->db->get('vendor_shop')->result();

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/add_product', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function edit() {

        $pid = $this->uri->segment(4);

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $products = $qry->row();

        $this->data['products'] = $products;

        $this->data['title'] = 'Update Product';

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $shop_data = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id);

        $this->data['shop_id'] = $shop_id;

        $this->data['title'] = $shop_data->shop_name;

        $this->data['cities'] = $this->db->get('cities')->result();

        $query = $this->db->query("select * from admin_comissions where status=1 and shop_id='" . $shop_id . "' group by cat_id");
        $resul = $query->result();
        $ar = [];
        foreach ($resul as $value) {
            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");
            $category = $cat->row();

            $ar[] = array('id' => $category->id, 'category_name' => $category->category_name);
        }
        $this->data['categories'] = $ar;

        //$this->data['subcategories'] = $this->db->where(array("id" => $products->sub_cat_id))->get('sub_categories')->result();

        $this->data['questionaries'] = $this->db->where(array("cat_id" => $products->cat_id))->get('questionaries')->result();

        $this->data['options'] = $this->db->where(array("ques_id" => $products->ques_id))->get('options')->result();

        $this->data['shops'] = $this->db->get('vendor_shop')->result();

        $this->data['filters'] = $this->db->where(array("cat_id" => $products->cat_id))->get('filters')->result();
        $this->data['selected_filters'] = $this->db->where(array("product_id" => $products->id))->get('product_filter')->result();

        $this->data['product_id'] = $pid;

        //print_r($this->data); die;

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/edit_product', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function addvariant($pid) {

        $this->data['pid'] = $pid;

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $product = $qry->row();

        $this->data['producttitle'] = $product->name;

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $vnd = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");

        $vendor = $vnd->row();

        $this->data['shop_name'] = $vendor->shop_name;

        $category_id = $product->cat_id;

        $mang = $this->db->query("select * from manage_attributes where categories='" . $category_id . "'");

        $attribute = $mang->result();

        $ar = [];

        foreach ($attribute as $value) {

            $at = $this->db->query("select * from attributes_title where id='" . $value->attribute_titleid . "'");

            $title = $at->row();

            $ar[] = array('id' => $title->id, 'title' => $title->title);
        }

        $this->data['types'] = $ar;

        $qry = $this->db->query("select * from add_variant where product_id='" . $pid . "'");

        $this->data['variants'] = $qry->result();

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/add_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function edit_variant($pid, $vid) {



        $this->data['pid'] = $pid;

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $product = $qry->row();

        $category_id = $product->cat_id;

        $mang = $this->db->query("select * from manage_attributes where categories='" . $category_id . "'");

        $attribute = $mang->result();

        $ar = [];

        foreach ($attribute as $value) {

            $at = $this->db->query("select * from attributes_title where id='" . $value->attribute_titleid . "'");

            $title = $at->row();

            $ar[] = array('id' => $title->id, 'title' => $title->title);
        }

        $this->data['types'] = $ar;

        $qry = $this->db->query("select * from add_variant where id='" . $vid . "'");

        $varin = $qry->row();

        $this->data['variant'] = $varin;

        $aa = $this->db->query("select * from attributes_values where attribute_titleid='" . $varin->attribute_type . "'");

        $this->data['attribute_values'] = $aa->result();

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/update_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function edit_link_variant($pid, $vid) {



        $edit_qry = $this->db->query("select * from link_variant where id='" . $vid . "'");

        $edit_row = $edit_qry->row();

        $json = json_decode($edit_row->jsondata);

        $type = [];

        $values = [];

        foreach ($json as $value) {

            $type[] = $value->attribute_type;

            $values[] = $value->attribute_value;
        }



        $this->data['report'] = $edit_row;

        $this->data['att_type'] = $type;

        $this->data['att_value'] = $values;

        $this->data['pid'] = $pid;

        $mang = $this->db->query("select * from add_variant where product_id='" . $pid . "'");

        $attribute = $mang->result();

        $ar = [];

        foreach ($attribute as $value) {

            $at = $this->db->query("select * from attributes_title where id='" . $value->attribute_type . "'");

            $title = $at->row();

            $ex = explode(",", $value->attribute_values);

            $attribute_values = [];

            for ($i = 0; $i < count($ex); $i++) {

                $at_val = $this->db->query("select * from attributes_values where id='" . $ex[$i] . "'");

                $at_values = $at_val->row();

                $attribute_values[] = array('id' => $ex[$i], 'value' => $at_values->value);
            }

            $ar[] = array('id' => $value->id, 'attribute_type' => $value->attribute_type, 'title' => $title->title, 'attribute_values' => $attribute_values);
        }

        $this->data['link_variant'] = $ar;

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/update_link_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function create_variant($pid) {

        $this->data['pid'] = $pid;

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $product = $qry->row();

        $category_id = $product->cat_id;

        $mang = $this->db->query("select * from manage_attributes where categories='" . $category_id . "'");

        $attribute = $mang->result();

        $ar = [];

        foreach ($attribute as $value) {

            $at = $this->db->query("select * from attributes_title where id='" . $value->attribute_titleid . "'");

            $title = $at->row();

            $ar[] = array('id' => $title->id, 'title' => $title->title);
        }

        $this->data['types'] = $ar;

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/create_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function update_variant() {

        $this->data['pid'] = $this->input->get_post('product_id');

        $pid = $this->input->get_post('product_id');

        $vid = $this->input->get_post('vid');

        $attribute_values = $this->input->get_post('attribute_values');

        $im = implode(",", $attribute_values);

        $ar = array(
            'product_id' => $this->input->get_post('product_id'),
            'attribute_type' => $this->input->get_post('types'),
            'attribute_values' => $im,
            'created_at' => time()
        );

        $wr = array('id' => $vid);

        $ins = $this->db->update("add_variant", $ar, $wr);

        //echo $this->db->last_query(); die;

        if ($ins) {



            $product_id = $this->input->get_post('product_id');

            $where = array('product_id' => $product_id);

            $del = $this->db->delete("link_variant", $where);

            if ($del) {

                $check_var = $this->db->query("select * from add_variant where product_id='" . $product_id . "'");

                if ($check_var->num_rows() > 0) {

                    $get_var = $check_var->result();

                    foreach ($get_var as $value) {

                        $att_values1[] = $value->attribute_type;

                        $att_values[] = explode(",", $value->attribute_values);
                    }



                    $result = array();

                    $arrays = array_values($att_values);

                    $sizeIn = sizeof($arrays);

                    $size = $sizeIn > 0 ? 1 : 0;

                    foreach ($arrays as $array)
                        $size = $size * sizeof($array);

                    for ($i = 0; $i < $size; $i++) {

                        $result[$i] = array();

                        for ($j = 0; $j < $sizeIn; $j++)
                            array_push($result[$i], current($arrays[$j]));

                        for ($j = ($sizeIn - 1); $j >= 0; $j--) {

                            if (next($arrays[$j]))
                                break;

                            elseif (isset($arrays[$j]))
                                reset($arrays[$j]);
                        }
                    }

                    for ($sp = 0; $sp < count($result); $sp++) {

                        $values = $result[$sp];

                        $types = $att_values1;

                        $value_array = [];

                        for ($p = 0; $p < count($values); $p++) {

                            $value_array[] = array('attribute_type' => $types[$p], 'attribute_value' => $values[$p]);
                        }

                        $jsondata = json_encode($value_array);

                        $ins11 = $this->db->insert("link_variant", array('product_id' => $product_id, 'jsondata' => $jsondata));
                    }
                }
            }

            $this->session->set_tempdata('success_message', 'Variant updated Successfully',3);
        }

        redirect('vendors/products/addvariant/' . $pid);

        $this->load->view('vendors/includes/header', $this->data);

        //$this->load->view('vendors/create_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function delete_variant($pid, $vid) {

        $del = $this->db->delete("add_variant", array('id' => $vid));

        if ($del) {

            $this->db->delete("link_variant", array('product_id' => $pid));

            $this->db->delete("product_images", array('variant_id' => $vid, 'product_id' => $pid));

            $this->db->delete("stock_management", array('variant_id' => $vid, 'product_id' => $pid));

            $this->session->set_tempdata('success_message', 'Variant Deleted Successfully',3);

            redirect('vendors/products/addvariant/' . $pid);
        }
    }

    function delete_link_variant($pid, $vid) {

        $del = $this->db->delete("link_variant ", array('id' => $vid));

        if ($del) {

            $this->session->set_tempdata('success_message', 'Link Variant Deleted Successfully',3);

            redirect('vendors/products/linkvariant/' . $pid);
        }
    }

    // function insert_product() {

    //     $productimage = $this->upload_multiplefile('images');

    //     $variant_product = $this->input->get_post('variant_product');

    //     if ($this->input->get_post('brand') != '') {
    //         $brand = $this->input->get_post('brand');
    //     } else {
    //         $brand = 0;
    //     }

    //     if ($this->input->get_post('product_tags') != '') {

    //         $producttags = implode(",", $this->input->get_post('product_tags'));
    //     } else {

    //         $producttags = '';
    //     }

    //     if ($this->input->get_post('priority') != '') {

    //         $priority = $this->input->get_post('priority');
    //     } else {

    //         $priority = "";
    //     }
        
    //     if ($this->input->get_post('cart_limit') != '') {

    //         $cart_limit = $this->input->get_post('cart_limit');
    //     } else {

    //         $cart_limit = "";
    //     }
    //     $optionIdString = $this->input->get_post('option_id');

      
    //     if (!empty($optionIdString) && is_string($optionIdString)) {
    //         $optionIdArray = explode(",", $optionIdString);
            
            
    //         $implodedOptionIds = implode(",", $optionIdArray);
        
     
    //     }

    //     $ar = array(
    //         'shop_id' => $_SESSION['vendors']['vendor_id'],
    //         'name' => $this->input->get_post('name'),
    //         'cat_id' => $this->input->get_post('cat_id'),
    //         'sub_cat_id' => $this->input->get_post('sub_cat_id'),
    //         'ques_id' => $this->input->get_post('ques_id'),
          
    //         'option_id' => $implodedOptionIds,
    //         'key_features' => $this->input->get_post('key_features'),
    //         'descp' => $this->input->get_post('description'),
    //         'about' => $this->input->get_post('about'),
    //         'how_to_use' => $this->input->get_post('how_to_use'),
    //         'status' => 0,
    //         'created_at' => time(),
    //         'product_tags' => $producttags,
    //         'return_noof_days' => $this->input->get_post('return_noof_days'),
    //         'meta_tag_title' => $this->input->get_post('meta_tag_title'),
    //         'meta_tag_description' => $this->input->get_post('meta_tag_description'),
    //         'meta_tag_keywords' => $this->input->get_post('meta_tag_keywords'),
    //         'brand' => $brand,
    //         'cancel_status' => $this->input->get_post('cancel_status'),
    //         'top_deal' => $this->input->get_post('deal_product'),
    //         'priority' => $priority,
    //         'cart_limit' => $cart_limit,
    //         'variant_product' => $variant_product,
    //         'availabile_stock_status' => $this->input->get_post('availabile_stock_status'),
    //         'manage_stock' => $this->input->get_post('manage_stock'),
    //         'package_weight' => $this->input->get_post('package_weight'),
    //         'package_length' => $this->input->get_post('package_length'),
    //         'package_breadth' => $this->input->get_post('package_breadth'),
    //         'package_height' => $this->input->get_post('package_height')
    //     );
        
    //     $insert_query = $this->db->insert('products', $ar);
     
    //     $product_id = $this->db->insert_id();
    //     $mix = $product_id . '-' . $this->input->get_post('name');
    //     $seo_url = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($mix))));
    //     $this->common_model->update_record(['id' => $product_id], 'products', ['seo_url' => $seo_url]);
    //     $filter_title = $this->input->get_post('filter');
    //     if (isset($filter_title) && is_array($filter_title)) {
    //     for ($i = 0; $i < count($filter_title); $i++) {
    //         $filter_options = implode(",", $this->input->get_post('filters_' . $filter_title[$i]));

    //         $filter_ar = array(
    //             'filter_id' => $filter_title[$i],
    //             'filter_options' => $filter_options,
    //             'product_id' => $product_id
    //         );

    //         $this->db->insert('product_filter', $filter_ar);
    //     }
    // }
    // else{
    //     $filter_title=0;
    // }

    //     if ($insert_query) {

      
    //         $msg = "Product Inactive: Product having ID #" . $product_id . " created";
    //         $array = array('vendor_id' => $_SESSION['vendors']['vendor_id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
    //         $this->db->insert("admin_notifications", $array);

    //         if ($variant_product == 'no') {

    //             $insert = array('product_id' => $product_id, 'price' => $this->input->get_post('price'), 'saleprice' => $this->input->get_post('saleprice'), 'stock' => $this->input->get_post('stock'), 'status' => 1, 'created_at' => time());

    //             $ins = $this->db->insert('link_variant', $insert);

    //             $vid = $this->db->insert_id($ins);

    //             foreach ($productimage as $image) {

    //                 $ar = array('product_id' => $product_id, 'variant_id' => $vid, 'image' => $image);

    //                 $this->db->insert("product_images", $ar);
    //             }

    //             $this->session->set_tempdata('success_message', 'Product Added Successfully',3);

    //             redirect('vendors/inactive_products');
    //         } else {

    //             $this->session->set_tempdata('success_message', 'Product Added Successfully',3);

    //             redirect('vendors/inactive_products');
    //         }


    //         die();
    //     } else {

    //         $this->session->set_tempdata('error_message', 'Unable to add',3);


    //         redirect('vendors/inactive_products');

    //         die();
    //     }
    // }




    function insert_product() {
        $productimage = $this->upload_multiplefile('images');
        $variant_product = $this->sanitize($this->input->get_post('variant_product'));
    
        if ($this->input->get_post('brand') != '') {
            $brand = $this->sanitize($this->input->get_post('brand'));
        } else {
            $brand = 0;
        }
    
        if ($this->input->get_post('product_tags') != '') {
            $producttags = implode(",", array_map([$this, 'sanitize'], $this->input->get_post('product_tags')));
        } else {
            $producttags = '';
        }
    
        if ($this->input->get_post('priority') != '') {
            $priority = $this->sanitize($this->input->get_post('priority'));
        } else {
            $priority = "";
        }
    
        if ($this->input->get_post('cart_limit') != '') {
            $cart_limit = $this->sanitize($this->input->get_post('cart_limit'));
        } else {
            $cart_limit = "";
        }
    
        $optionIdString = $this->input->get_post('option_id');
        $implodedOptionIds = '';
        if (!empty($optionIdString) && is_string($optionIdString)) {
            $optionIdArray = array_map([$this, 'sanitize'], explode(",", $optionIdString));
            $implodedOptionIds = implode(",", $optionIdArray);
        }
    
        $ar = array(
            'shop_id' => $this->sanitize($_SESSION['vendors']['vendor_id']),
            'name' => $this->sanitize($this->input->get_post('name')),
            'cat_id' => $this->sanitize($this->input->get_post('cat_id')),
            'sub_cat_id' => $this->sanitize($this->input->get_post('sub_cat_id')),
            'ques_id' => $this->sanitize($this->input->get_post('ques_id')),
            'option_id' => $implodedOptionIds,
            'key_features' => $this->sanitize($this->input->get_post('key_features')),
            'descp' => $this->sanitize($this->input->get_post('description')),
            'about' => $this->sanitize($this->input->get_post('about')),
            'how_to_use' => $this->sanitize($this->input->get_post('how_to_use')),
            'status' => 0,
            'created_at' => time(),
            'product_tags' => $producttags,
            'return_noof_days' => $this->sanitize($this->input->get_post('return_noof_days')),
            'meta_tag_title' => $this->sanitize($this->input->get_post('meta_tag_title')),
            'meta_tag_description' => $this->sanitize($this->input->get_post('meta_tag_description')),
            'meta_tag_keywords' => $this->sanitize($this->input->get_post('meta_tag_keywords')),
            'brand' => $brand,
            'cancel_status' => $this->sanitize($this->input->get_post('cancel_status')),
            'top_deal' => $this->sanitize($this->input->get_post('deal_product')),
            'priority' => $priority,
            'cart_limit' => $cart_limit,
            'variant_product' => $variant_product,
            'availabile_stock_status' => $this->sanitize($this->input->get_post('availabile_stock_status')),
            'manage_stock' => $this->sanitize($this->input->get_post('manage_stock')),
            'package_weight' => $this->sanitize($this->input->get_post('package_weight')),
            'package_length' => $this->sanitize($this->input->get_post('package_length')),
            'package_breadth' => $this->sanitize($this->input->get_post('package_breadth')),
            'package_height' => $this->sanitize($this->input->get_post('package_height'))
        );
    
        $insert_query = $this->db->insert('products', $ar);
        $product_id = $this->db->insert_id();
        $mix = $product_id . '-' . $this->sanitize($this->input->get_post('name'));
        $seo_url = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($mix))));
        $this->common_model->update_record(['id' => $product_id], 'products', ['seo_url' => $seo_url]);
    
        $filter_title = $this->input->get_post('filter');
        if (isset($filter_title) && is_array($filter_title)) {
            for ($i = 0; $i < count($filter_title); $i++) {
                $filter_options = implode(",", array_map([$this, 'sanitize'], $this->input->get_post('filters_' . $filter_title[$i])));
    
                $filter_ar = array(
                    'filter_id' => $this->sanitize($filter_title[$i]),
                    'filter_options' => $filter_options,
                    'product_id' => $product_id
                );
    
                $this->db->insert('product_filter', $filter_ar);
            }
        } else {
            $filter_title = 0;
        }
    
        if ($insert_query) {
            $msg = "Product Inactive: Product having ID #" . $product_id . " created";
            $array = array('vendor_id' => $this->sanitize($_SESSION['vendors']['vendor_id']), 'message' => $this->sanitize($msg), 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);
    
            if ($variant_product == 'no') {
                $insert = array(
                    'product_id' => $product_id,
                    'price' => $this->sanitize($this->input->get_post('price')),
                    'saleprice' => $this->sanitize($this->input->get_post('saleprice')),
                    'stock' => $this->sanitize($this->input->get_post('stock')),
                    'status' => 1,
                    'created_at' => time()
                );
    
                $ins = $this->db->insert('link_variant', $insert);
                $vid = $this->db->insert_id($ins);
    
                foreach ($productimage as $image) {
                    $ar = array('product_id' => $product_id, 'variant_id' => $vid, 'image' => $this->sanitize($image));
                    $this->db->insert("product_images", $ar);
                }
    
                $this->session->set_tempdata('success_message', 'Product Added Successfully', 3);
                redirect('vendors/inactive_products');
            } else {
                $this->session->set_tempdata('success_message', 'Product Added Successfully', 3);
                redirect('vendors/inactive_products');
            }
    
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Unable to add', 3);
            redirect('vendors/inactive_products');
            die();
        }
    }
    
    private function sanitize($input) {
        return str_replace(
            ['<', '>', '"', "'"],
            ['&lt;', '&gt;', '&quot;', '&#039;'],
            $input
        );
    }
    

    function update_product() {

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $pid = $this->input->get_post('pid');

        $vid = $this->input->get_post('vid');

        $name = $this->input->get_post('name');

        $cat_id = $this->input->get_post('cat_id');

        $sub_cat_id = $this->input->get_post('sub_cat_id');

        $ques_id = $this->input->get_post('ques_id');

        $option_id = implode(",", $this->input->get_post('option_id'));

        $key_features = $this->input->get_post('key_features');

        $description = $this->input->get_post('description');

        $about = $this->input->get_post('about');

        $how_to_use = $this->input->get_post('how_to_use');

        $selling_date = $this->input->get_post('selling_date');

        $product_tags = $this->input->get_post('product_tags');

        if (!empty($_FILES["images"]["name"])) {
            $productimage = $this->upload_multiplefile('images');
        }



        $cancel_status = $this->input->get_post('cancel_status');

    

        $brand = $this->input->get_post('brand');

        $deal_product = $this->input->get_post('deal_product');

        if ($this->input->get_post('price') != '') {
            $price = $this->input->get_post('price');
        } else {
            $price = "";
        }
        if ($this->input->get_post('saleprice') != '') {
            $saleprice = $this->input->get_post('saleprice');
        } else {
            $saleprice = "";
        }
        if ($this->input->get_post('stock') != '') {
            $stock = $this->input->get_post('stock');
        } else {
            $stock = "";
        }
        if ($this->input->get_post('priority') != '') {
            $priority = $this->input->get_post('priority');
        } else {
            $priority = "";
        }
        if ($this->input->get_post('cart_limit') != '') {

            $cart_limit = $this->input->get_post('cart_limit');
        } else {

            $cart_limit = "";
        }

        $data = array(
            'name' => $name,
            'cat_id' => $cat_id,
            'sub_cat_id' => $sub_cat_id,
            'ques_id' => $ques_id,
            'option_id' => $option_id,
            'key_features' => $key_features,
            'descp' => $description,
            'about' => $about,
            'how_to_use' => $how_to_use,
            'selling_date' => $selling_date,
            'availabile_stock_status' => $this->input->get_post('availabile_stock_status'),
            'brand' => $brand,
            'status' => $this->input->get_post('status'),
            'product_tags' => implode(',', $product_tags),
            'meta_tag_title' => $this->input->get_post('meta_tag_title'),
            'meta_tag_description' => $this->input->get_post('meta_tag_description'),
            'meta_tag_keywords' => $this->input->get_post('meta_tag_keywords'),
            'shop_id' => $_SESSION['vendors']['vendor_id'],
            'manage_stock' => $this->input->get_post('manage_stock'),
            'cancel_status' => $cancel_status,
            'top_deal' => $this->input->get_post('deal_product'),
            'return_noof_days' => $this->input->get_post('return_noof_days'),
            'top_deal' => $deal_product,
            'priority' => $priority,
            'cart_limit' => $cart_limit,
            'updated_at' => time(),
            'package_weight' => $this->input->get_post('package_weight'),
            'package_length' => $this->input->get_post('package_length'),
            'package_breadth' => $this->input->get_post('package_breadth'),
            'package_height' => $this->input->get_post('package_height')
        );

        $wr = array('id' => $pid);

        $insert_query = $this->db->update('products', $data, $wr);
        
        $mix = $pid . '-' . $name;
        $seo_url = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($mix))));
        $this->common_model->update_record(['id' => $pid], 'products', ['seo_url' => $seo_url]);

        $filter_title = $this->input->get_post('filter');

        for ($i = 0; $i < count($filter_title); $i++) {
            $filter_options = implode(",", $this->input->get_post('filters_' . $filter_title[$i]));

            $filter_ar = array(
             
                'filter_options' => $filter_options,
                   
            );
          
            $check = $this->admin_model->count_filters($pid, $filter_title[$i]);

            if ($check > 0) {
               
                $this->admin_model->update_filter($pid, $filter_title[$i], $filter_ar);
              
            } else {
                $filter_ar = array(
                    'filter_id' => $filter_title[$i],
                    'filter_options' => $filter_options,
                    'product_id' => $pid
                );
                
                $this->db->insert('product_filter', $filter_ar);
            }
        }

        if ($insert_query) {

            
            $msg = "Product Inactive: Product ID #" . $pid . " updated";
            $array = array('vendor_id' => $shop_id, 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

            if ($price > 0 && $saleprice > 0 && $stock > 0) {

                $update = array('product_id' => $pid, 'price' => $price, 'saleprice' => $saleprice, 'stock' => $stock, 'status' => 1, 'updated_at' => time());
                $this->db->where('id', $vid);
                $this->db->update('link_variant', $update);

                if ($productimage) {
                    foreach ($productimage as $image) {

                        $ar = array('product_id' => $pid, 'variant_id' => $vid, 'image' => $image);

                        $this->db->insert("product_images", $ar);
                    }

                    $this->session->set_tempdata('success_message', 'Product Updated Successfully',3);

                    redirect('vendors/inactive_products');
                } else {

                    $this->session->set_tempdata('success_message', 'Product Updated Successfully',3);

                    redirect('vendors/inactive_products');
                }
            } else {
                $this->session->set_tempdata('success_message', 'Product Updated Successfully',3);

                redirect('vendors/inactive_products');
            }
        } else {

            $this->session->set_tempdata('error_message', 'Unable to update',3);

            redirect('vendors/products');

            die();
        }
    }

   
    private function upload_multiplefile($file_name) {

        $config = array(
            'upload_path' => "./uploads/products/",
            'allowed_types' => '*',
            'overwrite' => 1,
        );

        $this->load->library('upload', $config);

        $images = array();
        $files = $_FILES[$file_name];

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];

            $fileName = date("YmdHis") . rand(0, 9999999) . "" . $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $images;
    }

    function insert_variant() {

        $attribute_values = $this->input->get_post('attribute_values');

        $im = implode(",", $attribute_values);

        $chk = $this->db->query("select * from add_variant where product_id='" . $this->input->get_post('product_id') . "' and attribute_type='" . $this->input->get_post('types') . "'");

        if ($chk->num_rows() > 0) {

            $this->session->set_tempdata('error_message', 'Attribute Type already exist',3);

            redirect(base_url() . 'vendors/inactive_products/addvariant/' . $this->input->get_post('product_id'));
        } else {

            $ar = array(
                'product_id' => $this->input->get_post('product_id'),
                'attribute_type' => $this->input->get_post('types'),
                'attribute_values' => $im,
                'created_at' => time()
            );

            $ins = $this->db->insert("add_variant", $ar);

            if ($ins) {



                $product_id = $this->input->get_post('product_id');

                /* $where=array('product_id'=>$product_id);

                  $del = $this->db->delete("link_variant",$where);

                  if($del)

                  { */

                $check_var = $this->db->query("select * from add_variant where product_id='" . $product_id . "'");

                if ($check_var->num_rows() > 0) {

                    $get_var = $check_var->result();

                    foreach ($get_var as $value) {

                        $att_values1[] = $value->attribute_type;

                        $att_values[] = explode(",", $value->attribute_values);
                    }



                    $result = array();

                    $arrays = array_values($att_values);

                    $sizeIn = sizeof($arrays);

                    $size = $sizeIn > 0 ? 1 : 0;

                    foreach ($arrays as $array)
                        $size = $size * sizeof($array);

                    for ($i = 0; $i < $size; $i++) {

                        $result[$i] = array();

                        for ($j = 0; $j < $sizeIn; $j++)
                            array_push($result[$i], current($arrays[$j]));

                        for ($j = ($sizeIn - 1); $j >= 0; $j--) {

                            if (next($arrays[$j]))
                                break;

                            elseif (isset($arrays[$j]))
                                reset($arrays[$j]);
                        }
                    }

                    for ($sp = 0; $sp < count($result); $sp++) {

                        $values = $result[$sp];

                        $types = $att_values1;

                        $value_array = [];

                        for ($p = 0; $p < count($values); $p++) {

                            $value_array[] = array('attribute_type' => $types[$p], 'attribute_value' => $values[$p]);
                        }

                        $jsondata = json_encode($value_array);

                        $jsondata1 = json_encode($jsondata);

                        $ins11 = $this->db->insert("link_variant", array('product_id' => $product_id, 'jsondata' => $jsondata, 'filter_jsondata' => $jsondata1));
                    }

                    //}
                }
            }

            $this->session->set_tempdata('success_message', 'Variant added Successfully',3);

            redirect(base_url() . 'vendors/inactive_products/addvariant/' . $this->input->get_post('product_id'));
        }
    }

    function insert_link_variant() {

        $pid = $this->input->get_post('product_id');

        $chking = $this->db->query("select * from products where id='" . $pid . "'");

        $row_check = $chking->row();

        if ($row_check->manage_stock == 'yes') {

            $vl_id = $this->input->get_post('vl_id');

            $chk = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

            $result = $chk->result();

            if ($chk->num_rows() > 0) {



                $ar = array('product_id' => $this->input->get_post('product_id'), 'price' => $this->input->get_post('price'), 'saleprice' => $this->input->get_post('saleprice'), 'stock' => $this->input->get_post('stock'), 'status' => 1);

                $wr = array('id' => $vl_id);

                $ins = $this->db->update("link_variant", $ar, $wr);

                if ($ins) {

                    $stock_ar = array('varient_id' => $vl_id, 'product_id' => $pid, 'paid_status' => 'Credit', 'quantity' => $this->input->get_post('stock'), 'total_stock' => $this->input->get_post('stock'), 'message' => 'Stock Added', 'created_at' => time());

                    $this->db->insert("stock_management", $stock_ar);

                    $this->session->set_tempdata('success_message', 'Link Variant added Successfully',3);

                    redirect(base_url() . 'vendors/inactive_products/linkvariant/' . $pid);
                }
            }
        } else if ($row_check->manage_stock == 'no') {

            $vl_id = $this->input->get_post('vl_id');

            $chk = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

            $result = $chk->result();

            if ($chk->num_rows() > 0) {

                $ar = array('product_id' => $this->input->get_post('product_id'), 'price' => $this->input->get_post('price'), 'saleprice' => $this->input->get_post('saleprice'), 'status' => 1);

                $wr = array('id' => $vl_id);

                $ins = $this->db->update("link_variant", $ar, $wr);

                //echo $this->db->last_query(); die;

                if ($ins) {

                    $this->db->insert("stock_management", $stock_ar);

                    $this->session->set_tempdata('success_message', 'Link Variant added Successfully',3);

                    redirect(base_url() . 'vendors/inactive_products/linkvariant/' . $pid);
                }
            }
        }
    }

    function update_link_variant() {



        $pid = $this->input->get_post('product_id');

        $link_id = $this->input->get_post('link_id');

        $chk = $this->db->query("select * from link_variant where id='" . $link_id . "'");

        $result = $chk->row();

        $total_cont = $this->input->get_post('total_cont');

        $json = [];

        for ($i = 1; $i <= $total_cont; $i++) {

            $json[] = array('attribute_type' => $this->input->get_post('parent' . $i), 'attribute_value' => $this->input->get_post('atrribute_value' . $i));
        }

        $jsondata = json_encode($json);

        $qry_check = $chk = $this->db->query("select * from link_variant where product_id='" . $pid . "' and jsondata='" . $jsondata . "'");

        if ($qry_check->num_rows() > 0) {

            $this->session->set_tempdata('success_message', 'Already added ( link variant )',3);

            redirect(base_url() . 'vendors/inactive_products/linkvariant/' . $pid);
        } else {

            $ar = array('product_id' => $this->input->get_post('product_id'), 'price' => $this->input->get_post('price'), 'saleprice' => $this->input->get_post('saleprice'), 'stock' => $this->input->get_post('stock'), 'jsondata' => $jsondata, 'filter_jsondata' => $jsondata);

            $wr = array('id' => $link_id);

            $ins = $this->db->update("link_variant", $ar, $wr);

            //echo $this->db->last_query(); die;



            if ($ins) {

                $this->session->set_tempdata('success_message', 'Link Variant added Successfully',3);

                redirect(base_url() . 'vendors/inactive_products/linkvariant/' . $pid);
            }
        }
    }

    function insert_subproduct() {

        $pid = $this->input->post('pid');

        $get = $this->db->query("select * from products where id='" . $pid . "'");

        $row = $get->row();

        $name = $row->name;

        $cat_id = $row->cat_id;

        $sub_cat_id = $row->sub_cat_id;

        $tax_class = $row->tax_class;

        $description = $row->descp;

        $status = $row->status;

        $shop_id = $row->shop_id;

        $meta_tag_title = $row->meta_tag_title;

        $meta_tag_description = $row->meta_tag_description;

        $meta_tag_keywords = $row->meta_tag_keywords;

        $product_tags = $row->product_tags;

        $mrp = $this->input->post('mrp');

        $price = $this->input->post('sale_price');

        $sku = $this->input->post('sku');

        $admin_commission = $this->input->post('admin_commission');

        $manage_stock = $this->input->post('manage_stock');

        if ($manage_stock == 1) {

            $stock = $this->input->get_post('stock');
        } else {

            $stock = 0;
        }

        $data = array(
            'name' => $name,
            'cat_id' => $cat_id,
            'sub_cat_id' => $sub_cat_id,
            'mrp' => $mrp,
            'price' => $price,
            'sku' => $sku,
            'tax_class' => $tax_class,
            'descp' => $description,
            'shop_id' => $_SESSION['vendors']['vendor_id'],
            'status' => $status,
            'stock' => $stock,
            'manage_stock' => $manage_stock,
            'meta_tag_title' => $meta_tag_title,
            'meta_tag_description' => $meta_tag_description,
            'meta_tag_keywords' => $meta_tag_keywords,
            'product_tags' => $product_tags,
            'admin_commission' => '10',
            'parent_id' => $pid
        );

        $insert_query = $this->db->insert('products', $data);

        if ($insert_query) {

            $last_id = $this->db->insert_id($insert_query);

            $title = $this->input->get_post('title');

            $values = $this->input->get_post('values');

            for ($i = 0; $i < count($title); $i++) {

                $name = $title[$i];

                $value = $values[$i];

                $ar = array('pid' => $last_id, 'name' => $name, 'value' => $value);

                $this->db->insert("product_attributes", $ar);
            }



            $this->session->set_tempdata('success_message', 'Product Added Successfully',3);

            redirect('vendors/inactive_products/childproducts/' . $pid);

            die();
        } else {

            $this->session->set_tempdata('error_message', 'Unable to add',3);

            redirect('vendors/inactive_products/childproducts/' . $pid);

            die();
        }
    }

    function update_subproduct() {

        $old_pid = $this->input->post('old_pid');

        $pid = $this->input->post('pid');

        $get = $this->db->query("select * from products where id='" . $pid . "'");

        $row = $get->row();

        $mrp = $this->input->post('mrp');

        $price = $this->input->post('sale_price');

        $sku = $this->input->post('sku');

        $admin_commission = $this->input->post('admin_commission');

        $manage_stock = $this->input->post('manage_stock');

        if ($manage_stock == 1) {

            $stock = $this->input->get_post('stock');
        } else {

            $stock = 0;
        }

        $data = array(
            'mrp' => $mrp,
            'price' => $price,
            'sku' => $sku,
            'shop_id' => $_SESSION['vendors']['vendor_id'],
            'stock' => $stock,
            'manage_stock' => $manage_stock,
            'admin_commission' => $this->input->post('admin_commission'),
            'parent_id' => $old_pid
        );

        $wr = array('id' => $pid);

        $insert_query = $this->db->update('products', $data, $wr);

        if ($insert_query) {

            $last_id = $pid;

            $title = $this->input->post('title');

            $values = $this->input->post('values');

            $id = $this->input->post('id');

            //print_r($id); die;



            for ($i = 0; $i < count($id); $i++) {

                $id1 = $id[$i];

                $name = $title[$i];

                $value = $values[$i];

                $at_wr = array('id' => $id1);

                $ar1 = array('name' => $name, 'value' => $value);

                $this->db->update("product_attributes", $ar1, $at_wr);

                //echo $this->db->last_query(); die;
            }



            $this->session->set_tempdata('success_message', 'Product updated Successfully',3);

            redirect('vendors/inactive_products/childproducts/' . $old_pid);

            die();
        } else {

            $this->session->set_tempdata('error_message', 'Unable to add',3);

            redirect('vendors/inactive_products/childproducts/' . $old_pid);

            die();
        }
    }

    function delete_subproduct($opid, $pid) {

        if ($this->admin_model->delete_product($pid)) {



            $this->db->delete("add_variant", array('product_id' => $pid));

            $this->db->delete("link_variant", array('product_id' => $pid));

            $this->db->delete("product_images", array('product_id' => $pid));

            $this->db->delete("stock_management", array('product_id' => $pid));

            $this->session->set_tempdata('success_message', 'Product Deleted Successfully',3);

            redirect('vendors/inactive_products/childproducts/' . $opid);

            die();
        } else {

            $this->session->set_tempdata('error_message', 'Unable to delete',3);

            redirect('vendors/inactive_products/childproducts/' . $opid);

            die();
        }
    }

    function editsubproduct($opid, $pid) {

        $this->data['pid'] = $pid;

        $this->data['old_pid'] = $opid;

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $this->data['products'] = $qry->row();

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/edit_subproduct', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function delete_product() {

        $product_id = $this->input->get_post('product_id');

        if ($this->admin_model->delete_product($product_id)) {

            $this->session->set_tempdata('success_message', 'Product Deleted Successfully',3);

            redirect('vendors/inactive_products');

            die();
        } else {

            $this->session->set_tempdata('error_message', 'Unable to delete',3);

            redirect('vendors/inactive_products');

            die();
        }
    }

    function deleteImage($id, $pid, $vid) {

        $img_id = $id;

        $del = $this->db->delete("product_images", array('id' => $img_id));

        if ($del) {

            $this->session->set_tempdata('success_message', 'Product Deleted Successfully',3);

            $this->data['pid'] = $pid;

            $this->load->view('vendors/includes/header', $this->data);

            //$this->load->view('vendors/product_images', $this->data);
            //$this->load->view('vendors/product_images', $this->data);

            redirect('vendors/inactive_products/product_images/' . $pid . "/" . $vid);

            $this->load->view('vendors/includes/footer');
        }
    }

    function deleteProductImageInEdit($id, $pid, $vid) {

        $img_id = $id;

        $del = $this->db->delete("product_images", array('id' => $img_id));

        if ($del) {

            $this->session->set_tempdata('success_message', 'Product Deleted Successfully',3);

            $this->data['pid'] = $pid;

            $this->load->view('vendors/includes/header', $this->data);

            //$this->load->view('vendors/product_images', $this->data);
            //$this->load->view('vendors/product_images', $this->data);

            redirect('vendors/inactive_products/edit/' . $pid);

            $this->load->view('vendors/includes/footer');
        }
    }

    function uploadImages() {

        $pid = $this->input->post('pid');

        $vid = $this->input->post('vid');

        $image = $this->upload_file('image');

        if ($image != '') {



            $config['source_image'] = './uploads/products/' . $image;

            //The image path,which you would like to watermarking

            $config['wm_text'] = 'Sector6';

            $config['wm_type'] = 'text';

            $config['wm_font_path'] = './fonts/atlassol.ttf';

            $config['wm_font_size'] = 16;

            $config['wm_font_color'] = 'ff6ab5';

            $config['wm_vrt_alignment'] = 'middle';

            $config['wm_hor_alignment'] = 'center';

            $config['wm_padding'] = '20';

            $this->image_lib->initialize($config);

            if (!$this->image_lib->watermark()) {

                //echo $this->image_lib->display_errors();
            } else {

                // echo 'Successfully updated image with watermark';









                $ar = array('product_id' => $pid, 'variant_id' => $vid, 'image' => $image);

                $ins = $this->db->insert("product_images", $ar);

                if ($ins) {

                    $image == '';

                    $this->session->set_tempdata('success_message', 'Product Image added Successfully',3);
                }
            }
        }



        $this->data['pid'] = $this->input->post('pid');

        $this->data['vid'] = $this->input->post('vid');

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/product_images', $this->data);

        redirect('vendors/inactive_products/product_images/' . $pid . "/" . $vid);

        $this->load->view('vendors/includes/footer');
    }

    private function upload_file($file_name) {

// echo $file_ext = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
// die;











        if ($_FILES[$file_name]['name'] != '') {



            if ($_FILES[$file_name]["size"] < '5114374') {

                $upload_path1 = "./uploads/products/";

                $config1['upload_path'] = $upload_path1;

                $config1['allowed_types'] = "*";

                // $config1['allowed_types'] = "*";

                $config1['max_size'] = "204800000";

                $img_name1 = strtolower($_FILES[$file_name]['name']);

                $img_name1 = preg_replace('/[^a-zA-Z0-9\.]/', "_", $img_name1);

                $config1['file_name'] = date("YmdHis") . rand(0, 9999999) . "_" . $img_name1;

                $this->load->library('upload', $config1);

                $this->upload->initialize($config1);

                $this->upload->do_upload($file_name);

                $fileDetailArray1 = $this->upload->data();

                // echo $this->upload->display_errors();
                // die;

                return $fileDetailArray1['file_name'];
            } else {

                return 'false';
            }
        } else {

            return '';
        }
    }

    function getPreloadedProducts() {

        $title = $this->input->get_post('title');

        $qry = $this->db->query("select * from products where name LIKE '%" . $title . "%'");

        $query = $qry->result();

        $output = '<option value="">Select PreLoaded Product</option>';

        foreach ($query as $row) {

            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }



        print_r($output);
        die;
    }

    function getPreloadedProductList() {

        $pid = $this->input->get_post('pid');

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $row = $qry->row();

        /* $ar = array('id'=>$row->id,'name'=>$row->name,'descp'=>$row->descp,'cat_id'=>$row->cat_id,'sub_cat_id'=>$row->sub_cat_id,'brand'=>$row->brand,'variant_product'=>$row->variant_product,'manage_stock'=>$row->manage_stock,'meta_tag_title'=>$row->meta_tag_title,'meta_tag_description'=>$row->meta_tag_description,'meta_tag_keywords'=>$row->meta_tag_keywords,'product_tags'=>$row->product_tags,'cancel_status'=>$row->cancel_status,'return_status'=>$row->return_status,'availabile_stock_status'=>$row->availabile_stock_status); */

        if ($row->availabile_stock_status == 'yes') {

            $price = '';

            $saleprice = '';

            $stock = '';
        } else {

            $linkqry = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

            $linkrow = $linkqry->row();

            $price = $linkrow->price;

            $saleprice = $linkrow->saleprice;

            $stock = $linkrow->stock;
        }



        echo "@" . $row->id . "@" . $row->name . '@' . $row->descp . '@' . $row->key_features . '@' . $row->brand . '@' . $row->cancel_status . '@' . $row->meta_tag_title . '@' . $row->meta_tag_description . '@' . $row->meta_tag_keywords . '@' . $row->top_deal . '@' . $row->manage_stock . '@' . $row->variant_product . '@' . $price . '@' . $saleprice . '@' . $stock;

        die;
    }

    function loadSubcategories() {

        $cid = $this->input->get_post('cid');

        $shop_id = $this->input->get_post('shop_id');

        $chk = $this->vendor_model->subcategoriesforproducts($cid, $shop_id);

        die;
    }

    function loadattributes() {

        $category = $this->input->post('category');

        $subcatid = $this->input->post('subcatid');

        $chk = $this->vendor_model->getAttributes($category, $subcatid);

        die;
    }

    function loadattributesvalue() {

        $category = $this->input->post('category');

        $subcatid = $this->input->post('subcatid');

        $title = $this->input->post('title');

        $chk = $this->vendor_model->getAttributesvalues($category, $subcatid, $title);

        die;
    }

    function getAttributeValues() {

        $type_id = $this->input->get_post('type_id');

        $chk = $this->vendor_model->getAttributeValues($type_id);

        die;
    }

    function linkvariant($pid) {

        $this->data['pid'] = $pid;

        $this->data['variant_type'] = 'addvariant';

        $pr = $this->db->query("select * from products where id='" . $pid . "'");

        $pro = $pr->row();

        $this->data['producttitle'] = $pro->name;

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $vnd = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");

        $vendor = $vnd->row();

        $this->data['shop_name'] = $vendor->shop_name;

        $mang = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

        $varint = $mang->result();

        $ar = [];

        foreach ($varint as $value) {

            /* $qry = $this->db->query("select * from link_variant_attributes where link_variant_id='".$value->id."'");

              $row = $qry->result();

              $attributes=[];

              foreach ($row as $value1)

              {

              $att_type_qry = $this->db->query("select * from attributes_title where id='".$value1->attribute_type."'");

              $types = $att_type_qry->row();



              $values_qry = $this->db->query("select * from attributes_values where id='".$value1->attribute_value."'");

              $values = $values_qry->row();

              $attributes[]=array('id'=>$value1->id,'type'=>$types->title,'value'=>$values->value);

              } */

            $json = json_decode($value->jsondata);

            $attributes = [];

            foreach ($json as $value1) {

                $att_type_qry = $this->db->query("select * from attributes_title where id='" . $value1->attribute_type . "'");

                $types = $att_type_qry->row();

                $values_qry = $this->db->query("select * from attributes_values where id='" . $value1->attribute_value . "'");

                $values = $values_qry->row();

                $attributes[] = array('type' => $types->title, 'value' => $values->value);
            }

            $ar[] = array('id' => $value->id, 'status' => $value->status, 'product_id' => $value->product_id, 'price' => $value->price, 'saleprice' => $value->saleprice, 'stock' => $value->stock, 'attributes' => $attributes);
        }

        $this->data['link_variant_list'] = $ar;

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/link_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function active($pid, $vid) {

        $chk = $this->db->query("select * from link_variant where id='" . $vid . "'");

        if ($chk->num_rows() > 0) {



            $upd = $this->db->update("link_variant", array('status' => 1), array('id' => $vid));

            if ($upd) {

                $this->session->set_tempdata('success_message1', 'Status changed Successfully',3);

                $this->data['pid'] = $pid;

                $mang = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

                $varint = $mang->result();

                $ar = [];

                foreach ($varint as $value) {

                    $json = json_decode($value->jsondata);

                    $attributes = [];

                    foreach ($json as $value1) {

                        $att_type_qry = $this->db->query("select * from attributes_title where id='" . $value1->attribute_type . "'");

                        $types = $att_type_qry->row();

                        $values_qry = $this->db->query("select * from attributes_values where id='" . $value1->attribute_value . "'");

                        $values = $values_qry->row();

                        $attributes[] = array('type' => $types->title, 'value' => $values->value);
                    }

                    $ar[] = array('id' => $value->id, 'status' => $value->status, 'product_id' => $value->product_id, 'price' => $value->price, 'saleprice' => $value->saleprice, 'stock' => $value->stock, 'attributes' => $attributes);
                }

                $this->data['link_variant_list'] = $ar;

                $this->load->view('vendors/includes/header', $this->data);

                $this->load->view('vendors/link_variant', $this->data);

                $this->load->view('vendors/includes/footer');
            }
        } else {

            $this->data['pid'] = $pid;

            $mang = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

            $varint = $mang->result();

            $ar = [];

            foreach ($varint as $value) {

                $json = json_decode($value->jsondata);

                $attributes = [];

                foreach ($json as $value1) {

                    $att_type_qry = $this->db->query("select * from attributes_title where id='" . $value1->attribute_type . "'");

                    $types = $att_type_qry->row();

                    $values_qry = $this->db->query("select * from attributes_values where id='" . $value1->attribute_value . "'");

                    $values = $values_qry->row();

                    $attributes[] = array('type' => $types->title, 'value' => $values->value);
                }

                $ar[] = array('id' => $value->id, 'status' => $value->status, 'product_id' => $value->product_id, 'price' => $value->price, 'saleprice' => $value->saleprice, 'stock' => $value->stock, 'attributes' => $attributes);
            }

            $this->data['link_variant_list'] = $ar;

            $this->session->set_tempdata('error_message1', 'Please update the Price',3);

            $this->load->view('vendors/includes/header', $this->data);

            $this->load->view('vendors/link_variant', $this->data);

            $this->load->view('vendors/includes/footer');
        }
    }

    function inactive($pid, $vid) {

        $upd = $this->db->update("link_variant", array('status' => 0), array('id' => $vid));

        if ($upd) {

            $this->session->set_tempdata('success_message', 'Status changed Successfully',3);

            $this->data['pid'] = $pid;

            $mang = $this->db->query("select * from link_variant where product_id='" . $pid . "'");

            $varint = $mang->result();

            $ar = [];

            foreach ($varint as $value) {

                $json = json_decode($value->jsondata);

                $attributes = [];

                foreach ($json as $value1) {

                    $att_type_qry = $this->db->query("select * from attributes_title where id='" . $value1->attribute_type . "'");

                    $types = $att_type_qry->row();

                    $values_qry = $this->db->query("select * from attributes_values where id='" . $value1->attribute_value . "'");

                    $values = $values_qry->row();

                    $attributes[] = array('type' => $types->title, 'value' => $values->value);
                }

                $ar[] = array('id' => $value->id, 'status' => $value->status, 'product_id' => $value->product_id, 'price' => $value->price, 'saleprice' => $value->saleprice, 'stock' => $value->stock, 'attributes' => $attributes);
            }

            $this->data['link_variant_list'] = $ar;

            $this->load->view('vendors/includes/header', $this->data);

            $this->load->view('vendors/link_variant', $this->data);

            $this->load->view('vendors/includes/footer');
        }
    }

    function create_link_variant($pid, $vid) {



        $this->data['pid'] = $pid;

        $this->data['vid'] = $vid;

        $qry = $this->db->query("select * from products where id='" . $pid . "'");

        $product = $qry->row();

        $this->data['stock_status'] = $product->manage_stock;

        $this->data['producttitle'] = $product->name;

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $vnd = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");

        $vendor = $vnd->row();

        $this->data['shop_name'] = $vendor->shop_name;

        $mang = $this->db->query("select * from add_variant where product_id='" . $pid . "'");

        $attribute = $mang->result();

        $ar = [];

        foreach ($attribute as $value) {

            $at = $this->db->query("select * from attributes_title where id='" . $value->attribute_type . "'");

            $title = $at->row();

            $ex = explode(",", $value->attribute_values);

            $attribute_values = [];

            for ($i = 0; $i < count($ex); $i++) {

                $at_val = $this->db->query("select * from attributes_values where id='" . $ex[$i] . "'");

                $at_values = $at_val->row();

                $attribute_values[] = array('id' => $ex[$i], 'value' => $at_values->value);
            }

            $ar[] = array('id' => $value->id, 'attribute_type' => $value->attribute_type, 'title' => $title->title, 'attribute_values' => $attribute_values);
        }

        $this->data['link_variant'] = $ar;

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/create_link_variant', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function import_product() {

        $this->data['title'] = 'Import Product';

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/import_product', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function importExcel() {

        $filename = $_FILES['uploadFile']['name'];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if ($ext != 'csv') {

            $this->session->set_tempdata('error_message', 'Only Excel/CSV File Import',3);

            $shop_id = $_SESSION['vendors']['vendor_id'];

            redirect(base_url() . 'vendors/inactive_products/import_product?shop_id=' . $shop_id);
        }

        $file = $_FILES['uploadFile']['tmp_name'];

        $handle = fopen($file, "r");

        $c = 0; //



        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {

            $zero = $filesop[0];

            $one = $filesop[1];

            $two = $filesop[2];

            $three = $filesop[3];

            $four = $filesop[4];

            $five = $filesop[5];

            $six = $filesop[6];

            $seven = $filesop[7];

            $eight = $filesop[8];

            $nine = $filesop[9];

            $ten = $filesop[10];

            $eleven = $filesop[11];

            $twelve = $filesop[12];

            $thirteen = $filesop[13];

            $fourteen = $filesop[14];

            $fifteen = $filesop[15];

            $sixteen = $filesop[16];

            $seventeen = $filesop[17];

            $eighteen = $filesop[18];

            $nineteen = $filesop[19];

            $twenty = $filesop[20];

            $twentyone = $filesop[21];

            $data = array('name' => $zero, 'descp' => $one, 'cat_id' => $two, 'sub_cat_id' => $three, 'brand' => $four, 'tax_class' => $five, 'taxname' => $six, 'manage_stock' => $seven, 'variant_product' => $eight, 'shop_id' => $nine, 'status' => $ten, 'meta_tag_title' => $eleven, 'meta_tag_description' => $twelve, 'meta_tag_keywords' => $thirteen, 'product_tags' => $fourteen, 'key_features' => $fifteen, 'selling_date' => $sixteen, 'cancel_status' => $seventeen, 'return_status' => $eighteen);

            if ($c <> 0) {

                //echo "<pre>"; print_r($data); 

                if ($zero != '') {



                    $response = $this->db->insert("products", $data);
                }
            }



            $c = $c + 1;
        }

        //die; 

        $this->session->set_tempdata('success_message', 'Product Added Successfully',3);

        redirect('vendors/inactive_products');


    }

}





