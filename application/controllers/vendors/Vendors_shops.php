<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors_shops extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['title'] = 'Vendors/Shops';
        $q = $this->input->get_post('q');
        $status = $this->input->get_post('status');
        $city_id = $this->input->get_post('city_id');
        $vm_id = $this->input->get_post('vm_id');
        $cat_id = $this->input->get_post('category_id');
        $deals_of_the_day = $this->input->get_post('deals_of_the_day');

        $this->data['q'] = $q;
        $this->data['status'] = $status;
        $this->data['city_id'] = $city_id;
        $this->data['vm_id'] = $vm_id;
        $this->data['cat_id'] = $cat_id;
        $this->data['deals_of_the_day'] = $deals_of_the_day;

        $this->data['cities'] = $this->admin_model->get_table_data('cities');
        $this->data['visual_merchant'] = $this->admin_model->get_table_data('visual_merchant');
        $this->data['categories'] = $this->admin_model->get_table_data('categories');

        $this->db->order_by('id', 'desc');
        if (isset($q) && $q != '') {
            $this->db->like('shop_name', $q);
        }
        if (isset($status) && $status != '') {
            $this->db->where('status', $status);
        }
        if (isset($city_id) && $city_id != '') {
            $this->db->where('city_id', $city_id);
        }
        if (isset($vm_id) && $vm_id != '') {
            $this->db->where('vm_id', $vm_id);
        }
        if (isset($deals_of_the_day) && $deals_of_the_day != '') {
            $this->db->where('is_deal_of_the_day', $deals_of_the_day);
        }
        if (isset($cat_id) && $cat_id != '') {
            $this->db->where('find_in_set("' . $cat_id . '", cat_ids) <> 0');
        }

        $this->data['vendor_shops'] = $this->db->get('vendor_shop')->result();
        foreach ($this->data['vendor_shops'] as $v) {
            $this->db->where('id', $v->vm_id);
            $vmrow = $this->db->get('visual_merchant')->row();
            if ($vmrow) {
                $v->visual_merchant = $vmrow->name;
            } else {
                $v->visual_merchant = 'N/A';
            }
            $total_products = $this->db->get_where('products', ['shop_id' => $v->id])->result();
            $v->total_products = count($total_products);

            $total_categories = $this->db->get_where('admin_comissions', ['shop_id' => $v->id])->result();
            $v->total_categories = count($total_categories);
        }
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/vendors_shops', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function add() {
        $this->data['title'] = 'Add Vendor/Shop';
        $this->data['cities'] = $this->db->get('cities')->result();
        $this->data['categories'] = $this->db->get('categories')->result();
        $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_vendor_shop', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {

//        echo json_encode($_REQUEST);
//        die();
        $shop_name = $this->input->get_post('shop_name');
        $owner_name = $this->input->get_post('owner_name');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        $password = $this->input->get_post('password');
        $vm_id = $this->input->get_post('vm_id');
        $city_id = $this->input->get_post('city_id');
        $address = $this->input->get_post('address');

        $pincode = $this->input->get_post('pincode');
        $latitude = $this->input->get_post('latitude');
        $longitude = $this->input->get_post('longitude');
        $status = $this->input->get_post('status');

        $min_order_amount = $this->input->get_post('min_order_amount');
        $is_deal_of_the_day = $this->input->get_post('is_deal_of_the_day');
        $deal_start_date = $this->input->get_post('deal_start_date');
        $deal_end_date = $this->input->get_post('deal_end_date');

//        $categories = $this->input->get_post('categories');
//        $cat_Ids = implode(',', $categories);

        $config['upload_path'] = './uploads/shops/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('shop_logo')) {
            $imageDetailArray2 = $this->upload->data();
            $shop_logo = $imageDetailArray2['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
            die();

            $shop_logo = 'default_shop_logo.png';
        }

        $data = array(
            'shop_name' => $shop_name,
            'owner_name' => $owner_name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => md5($password),
            'vm_id' => $vm_id,
            'shop_logo' => $shop_logo,
            'address' => $address,
            'city_id' => $city_id,
            'pincode' => $pincode,
            'lat' => $latitude,
            'lng' => $longitude,
            'status' => $status == 1 ? 1 : 0,
            'min_order_amount' => $min_order_amount,
            'is_deal_of_the_day' => $is_deal_of_the_day,
            'deal_start_date' => $deal_start_date,
            'deal_end_date' => $deal_end_date
        );
        if (!$vm_id) {
            unset($data['vm_id']);
        }
        $insert_query = $this->db->insert('vendor_shop', $data);
//        echo $this->db->last_query();
//        die();
        if ($insert_query) {
            $work_hrs_data = $this->work_hours($this->db->insert_id());
            foreach ($work_hrs_data as $w) {
                $this->db->insert('shop_work_hours', $w);
            }
            $this->session->set_tempdata('success_message', 'Vendor Created Successfully',3);
            redirect('vendors/vendors_shops');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Unable to add',3);
            redirect('vendors/vendors_shops/add');
            die();
        }
    }

    function edit() {
        $this->data['title'] = 'Vendors/Shops';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/vendors_shops', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function manage_categories() {
        $shop_id = $this->input->get_post('shop_id');
        if (!$shop_id) {
            redirect('vendors/vendors_shops/');
            die();
        }
        $this->data['shop_id'] = $shop_id;
        $this->data['shop_name'] = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id)->shop_name;
        $this->data['categories'] = $this->admin_model->get_table_data('categories', 'id', 'desc');

        $this->db->select('ad_com.*, c.category_name');
        $this->db->from('admin_comissions ad_com');
        $this->db->join('categories c', 'c.id=ad_com.cat_id');
        $this->db->where('ad_com.shop_id', $shop_id);
        $res = $this->db->get()->result();
        if (count($res) > 0) {
            $this->data['admin_comissions'] = $res;
        }
        $this->data['title'] = 'Manage Categories';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/vendor_manage_categories', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert_cat_comission() {
        $shop_id = $this->input->get_post('shop_id');
        $cat_id = $this->input->get_post('cat_id');
        $admin_commission = $this->input->get_post('admin_comission');
        $status = $this->input->get_post('status');

        $this->db->where('cat_id', $cat_id);
        $this->db->where('shop_id', $shop_id);
        $res = $this->db->get('admin_comissions')->result();

        if (count($res) > 0) {
            $data = array(
                'admin_comission' => $admin_commission,
                'status' => $status,
                'updated_at' => time());

            $this->db->where('cat_id', $cat_id);
            $this->db->where('shop_id', $shop_id);
            if ($this->db->update('admin_comissions', $data)) {
                redirect('vendors/vendors_shops/manage_categories?shop_id=' . $shop_id);
                die();
            } else {
                redirect('vendors/vendors_shops/');
                die();
            }
        } else {
            $data = array('shop_id' => $shop_id,
                'cat_id' => $cat_id,
                'admin_comission' => $admin_commission,
                'status' => $status,
                'created_at' => time());
            $insert = $this->db->insert('admin_comissions', $data);
            if ($insert) {
                redirect('vendors/vendors_shops/manage_categories?shop_id=' . $shop_id);
                die();
            } else {
                redirect('vendors/vendors_shops/');
                die();
            }
        }
    }

    function delete_vendor_admin_comission() {
        $admin_com_id = $this->input->get_post('admin_com_id');
        $shop_id = $this->input->get_post('shop_id');

        if ($this->admin_model->delete_vendor_admin_comission($admin_com_id)) {
            $this->session->set_tempdata('success_message', 'Comission Deleted Successfully',3);
            redirect('vendors/vendors_shops/manage_categories?shop_id=' . $shop_id);
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('vendors/vendors_shops/manage_categories?shop_id=' . $shop_id);
            die();
        }
    }

    function manage_shop_banners() {
        $shop_id = $this->input->get_post('shop_id');
        $shop_banners = $this->db->get_where('vendor_shop_banners', ['shop_id' => $shop_id, 'status' => 1])->result();
        $this->data['shop_banners'] = $shop_banners;
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/manage_shop_banners', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function add_shop_banner() {
        $title = $this->input->get_post('title');
    }

    function manage_work_hours($shop_id) {
        $this->data['title'] = 'Edit Shop Work Hours';
        $this->data['work_hours'] = $this->db->get_where('shop_work_hours', ['shop_id' => $shop_id])->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/manage_work_hours', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    private function work_hours($shop_id) {
        $work_hrs_data[] = array(
            'week_name' => 'Monday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00:00',
            'close_time' => '20:00:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        $work_hrs_data[] = array(
            'week_name' => 'Tuesday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00:00',
            'close_time' => '20:00:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        $work_hrs_data[] = array(
            'week_name' => 'Wednesday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00',
            'close_time' => '20:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        $work_hrs_data[] = array(
            'week_name' => 'Thursday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00',
            'close_time' => '20:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        $work_hrs_data[] = array(
            'week_name' => 'Friday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00',
            'close_time' => '20:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        $work_hrs_data[] = array(
            'week_name' => 'Saturday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00',
            'close_time' => '20:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        $work_hrs_data[] = array(
            'week_name' => 'Sunday',
            'is_working_day' => 'Yes',
            'open_time' => '10:00',
            'close_time' => '20:00',
            'shop_id' => $shop_id,
            'status' => 1
        );
        return $work_hrs_data;
    }

}
