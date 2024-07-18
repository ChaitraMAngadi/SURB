<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require_once APPPATH . 'controllers/Web.php';

class Vendors_shops extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->load->model("admin_model");
        $this->load->library("pagination");
        // $this->load->library("session");
    }

    function index() {

        $this->data['page_name'] = 'vendors_shops';
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

        $categories = $this->common_model->get_data_with_condition(['status' => 1], 'categories');
        $valid_cats = [];
        //check if categories have active subcategories or not
        foreach ($categories as $cat) {
            $sub_cats = $this->common_model->get_data_with_condition(['cat_id' => $cat->id, 'status' => 1], 'sub_categories');
            if (sizeof($sub_cats) > 0) {
                array_push($valid_cats, $cat);
            }
        }

        $this->data['categories'] = $valid_cats;
        $this->db->where('status', 1);
        $this->db->order_by('id', 'desc');
        $this->data['vendor_shops'] = $this->db->get('vendor_shop')->result();

        foreach ($this->data['vendor_shops'] as $v) {


            $total_products = $this->db->get_where('products', ['shop_id' => $v->id])->result();

            $v->total_products = count($total_products);

            $total_categories = $this->db->get_where('admin_comissions', ['shop_id' => $v->id])->result();

            $v->total_categories = count($total_categories);
        }

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendors_shops', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function view($shop_id) {
        $this->data['page_name'] = 'vendors_shops';
        $this->data['title'] = 'Vendors/Shops';

        $categories = $this->common_model->get_data_with_condition(['status' => 1], 'categories');
        $valid_cats = [];
        //check if categories have active subcategories or not
        foreach ($categories as $cat) {
            $sub_cats = $this->common_model->get_data_with_condition(['cat_id' => $cat->id, 'status' => 1], 'sub_categories');
            if (sizeof($sub_cats) > 0) {
                array_push($valid_cats, $cat);
            }
        }

        $this->data['categories'] = $valid_cats;
        $this->db->where('status', 1);
        $this->db->order_by('id', 'desc');

        $this->data['vendor_shops'] = $this->db->where(array('id' => $shop_id))->get('vendor_shop')->result();

        foreach ($this->data['vendor_shops'] as $v) {


            $total_products = $this->db->get_where('products', ['shop_id' => $v->id, 'status' => 1])->result();

            $v->total_products = count($total_products);

            $total_categories = $this->db->get_where('admin_comissions', ['shop_id' => $v->id])->result();

            $v->total_categories = count($total_categories);
        }

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendors_shops', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function delete($shop_id) {
        /* $this->db->where('id', $shop_id);
          $del = $this->db->delete('vendor_shop'); */

        //echo$del = $this->db->last_query(); die;

        $del = $this->db->update("vendor_shop", array('status' => 1, 'delete_status' => 1), array('id' => $shop_id));
        if ($del) {
            $this->db->delete('products', array('shop_id' => $shop_id));
            $this->db->delete('products', array('shop_id' => $shop_id));
            $this->session->set_tempdata('success_message', 'Shop Deleted Successfully',3);
            redirect('admin/vendors_shops');
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/vendors_shops');
        }
    }

    function changeStatus($shop_id, $status) {
        $upd = $this->db->update("vendor_shop", array('status' => $status), array('id' => $shop_id));
        if ($upd) {
            redirect('admin/vendors_shops');
        }
    }

    function add() {

        $this->data['page_name'] = 'vendors_shops/add';

        $this->data['title'] = 'Add Vendor/Shop';

        $this->data['cities'] = $this->db->get('cities')->result();

        $this->data['categories'] = $this->common_model->get_data_with_condition(['status' => 1], 'categories');

        $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_vendor_shop', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function send_message($message = "", $mobile_number, $template_id) {

        $message = urlencode($message);
        $template_name = urlencode('Registration OTP Verification');
        $URL = "https://2factor.in/API/R1/"; // connecting url
        $mobile_number = urlencode($mobile_number);
        $template_id = urlencode($template_id);

        //$URL = "http://login.smsmoon.com/API/sms.php"; // connecting url

        // $post_fields = ['username' => 'Absolutemens', 'password' => 'vizag@123', 'from' => 'abmens', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0, 'template_id' => $template_id];

        //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://2factor.in/API/R1/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'module=TRANS_SMS&apikey=a08b66ad-8118-11ed-9158-0200cd936042&to='.$mobile_number.'&from=abmens&msg='.$message
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return true;
    }

    function update() {
        $sid = $this->input->get_post('sid');
        $shop_name = $this->input->get_post('shop_name');
        $owner_name = $this->input->get_post('owner_name');
        $description = $this->input->get_post('description');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        // $password = $this->input->get_post('password');
        $vm_id = $this->input->get_post('vm_id');
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        $address = $this->input->get_post('address');
        //$location_id = $this->input->get_post('location_id');
        $pincode = $this->input->get_post('pincode');
        $latitude = $this->input->get_post('latitude');
        $longitude = $this->input->get_post('longitude');
        $status = 0;
        $delhivery_partner=$this->input->get_post('delivery_partner');

        $delivery_time = $this->input->get_post('delivery_time');
        $min_order_amount = $this->input->get_post('min_order_amount');
        $is_deal_of_the_day = $this->input->get_post('is_deal_of_the_day');
        $deal_start_date = $this->input->get_post('deal_start_date');
        $deal_end_date = $this->input->get_post('deal_end_date');
        $update_status = $this->input->get_post('update_status');

        $pan = $this->input->get_post('pan');
        $aadhar = $this->input->get_post('aadhar');
        $gst_number = $this->input->get_post('gst_number');
        $bankname = $this->input->get_post('bankname');
        $account_no = $this->input->get_post('account_no');
        $accountholder_name = $this->input->get_post('accountholder_name');
        $bank_ifsccode = $this->input->get_post('bank_ifsccode');
        $refferalcode = $this->input->get_post('refferalcode');
        /* $config['upload_path'] = './uploads/shops/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size'] = 2000;
          $config['max_width'] = 1500;
          $config['max_height'] = 1500;
          $this->load->library('upload', $config);
          if ($this->upload->do_upload('shop_logo'))
          {
          $imageDetailArray2 = $this->upload->data();
          $shop_logo = $imageDetailArray2['file_name'];
          }
          else {
          $error = array('error' => $this->upload->display_errors());
          echo json_encode($error);
          die();
          $shop_logo = 'default_shop_logo.png';
          } */
        // $email = $this->input->post('email');
        // $phone = $this->input->get_post('mobile');
        $chk_email = $this->common_model->count_rows_with_conditions('vendor_shop', ['email' => $email, 'id!=' => $sid]);
        $chk_mobile = $this->common_model->count_rows_with_conditions('vendor_shop', ['mobile' => $mobile, 'id!=' => $sid]);
        if ($chk_email > 0 && $chk_mobile > 0) {
            //print_r($chk_email);die;
            $this->session->set_tempdata('error_message', 'Email & Mobile already exists.',3);
            redirect('admin/vendors_shops/edit/' . $sid);
            // redirect('admin/vendors_shops');
//            $this->load->view('admin/includes/header', $this->data);
//            $this->load->view('admin/edit_vendor_shops/edit'.$sid, $this->data);
//            $this->load->view('admin/includes/footer');
        } elseif ($chk_email > 0 && $chk_mobile == 0) {
            //print_r($chk_email);die;
            $this->session->set_tempdata('error_message', 'Email already exists.',3);
            redirect('admin/vendors_shops/edit/' . $sid);
            // redirect('admin/vendors_shops');
//            $this->load->view('admin/includes/header', $this->data);
//            $this->load->view('admin/edit_vendor_shops/edit'.$sid, $this->data);
//            $this->load->view('admin/includes/footer');
        } elseif ($chk_email == 0 && $chk_mobile > 0) {
            // print_r($chk_mobile);die;
            $this->session->set_tempdata('error_message', 'Mobile already exists.',3);
            redirect('admin/vendors_shops/edit/' . $sid);
            // redirect('admin/vendors_shops');

//            $this->load->view('admin/includes/header', $this->data);
//            $this->load->view('admin/edit_vendor_shops/edit'., $this->data);
//            $this->load->view('admin/includes/footer');
        } else {



            $qry = $this->db->query("select * from vendor_shop where id='" . $sid . "'");
            $row = $qry->row();
            if ($this->upload_file('shop_image') != '') {
                $shop_image = $this->upload_file('shop_image');
            } else {
                $shop_image = $row->shop_logo;
            }

            if ($this->upload_file('shop_logo') != '') {
                $shop_logo = $this->upload_file('shop_logo');
            } else {
                $shop_logo = $row->logo;
            }


            //$imp_pincode = implode(",", $this->input->get_post('pincodes'));



            $data = array(
                'shop_name' => $shop_name,
                'owner_name' => $owner_name,
                'email' => $email,
                'mobile' => $mobile,
                //'password' => md5($password),
                'shop_logo' => $shop_image,
                'logo' => $shop_logo,
                'address' => $address,
                'state_id' => $state_id,
                'city_id' => $city_id,
                //'location_id'=>$location_id,
                'address' => $address,
                'pincode' => $pincode,
                'lat' => $latitude,
                'lng' => $longitude,
                'status' => 1,
                'pan' => $pan,
                'aadhar' => $aadhar,
                'gst_number' => $gst_number,
                'bankname' => $bankname,
                'account_no' => $account_no,
                'accountholder_name' => $accountholder_name,
                'bank_ifsccode' => $bank_ifsccode,
                //'delivery_time'=>$delivery_time,
                'update_status' => $update_status,
                'description' => $description,
                'refferalcode' => $refferalcode,
                'min_order_amount' => $this->input->get_post('min_order_amount'),
                'delivery_partner'=>$delhivery_partner
                    //'vendor_pincodes'=>$imp_pincode
            );

            if (!$vm_id) {
                unset($data['vm_id']);
            }

            //echo ($this->db->last_query());die;
            $insert_query = $this->db->update('vendor_shop', $data, array('id' => $sid));

            if ($insert_query) {


                $work_hrs_data = $this->work_hours($this->db->insert_id());

                foreach ($work_hrs_data as $w) {

                    $this->db->insert('shop_work_hours', $w);
                }

                $this->session->set_tempdata('success_message', 'Vendor Updated Successfully',3);

                redirect('admin/vendors_shops');

                die();
            } else {

                $this->session->set_tempdata('error_message', 'Unable to add',3);

                redirect('admin/vendors_shops/edit');

                die();
            }
        }
    }
    

    function insert() {
        $this->data['old_data'] = ['shop_name' => $this->input->get_post('shop_name'),
            'owner_name' => $this->input->get_post('owner_name'),
            'email' => $this->input->get_post('email'),
            'mobile' => $this->input->get_post('mobile'),
            'password' => $this->input->get_post('password'),
            'shop_logo' => $this->input->get_post('shop_image'),
            'logo' => $this->input->get_post('shop_logo'),
            'address' => $this->input->get_post('address'),
            'state_id' => $this->input->get_post('state_id'),
            'city_id' => $this->input->get_post('city_id'),
            'lat' => $this->input->get_post('latitude'),
            'lng' => $this->input->get_post('longitude'),
            'update_status' => $this->input->get_post('update_status'),
            'min_order_amount' => $this->input->get_post('min_order_amount'),
            'description' => $this->input->get_post('description')];
            $delhivery_partner=$this->input->get_post('delivery_partner');
        $email = $this->input->post('email');
        $phone = $this->input->get_post('mobile');
        

        // print_r($warehouse_data);
        // die;






        $chk_email = $this->common_model->count_rows_with_conditions('vendor_shop', ['email' => $email]);
        $chk_mobile = $this->common_model->count_rows_with_conditions('vendor_shop', ['mobile' => $phone]);
        if ($chk_email > 0 && $chk_mobile > 0) {
            $this->session->set_tempdata('error_message', 'Email & Mobile already exists.',3);
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/add_vendor_shop', $this->data);
            $this->load->view('admin/includes/footer');
        } elseif ($chk_email > 0 && $chk_mobile == 0) {
            $this->session->set_tempdata('error_message', 'Email already exists.',3);
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/add_vendor_shop', $this->data);
            $this->load->view('admin/includes/footer');
        } elseif ($chk_email == 0 && $chk_mobile > 0) {
            $this->session->set_tempdata('error_message', 'Mobile already exists.',3);
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/add_vendor_shop', $this->data);
            $this->load->view('admin/includes/footer');
        } else {
            $password = $this->input->get_post('password');
            $gorget_password = $this->input->get_post('password');

            $shop_image = $this->upload_file('shop_image');
            $shop_logo = $this->upload_file('shop_logo');

            if ($this->input->get_post('refferalcode') != '') {
                $refferalcode = $this->input->get_post('refferalcode');
            } else {
                $refferalcode = "";
            }

            //$imp_pincode = implode(",", $this->input->get_post('pincodes'));

            $data = array(
                'shop_name' => $this->input->get_post('shop_name'),
                'owner_name' => $this->input->get_post('owner_name'),
                'email' => $this->input->get_post('email'),
                'mobile' => $this->input->get_post('mobile'),
                'password' => md5($password),
                'shop_logo' => $shop_image,
                'logo' => $shop_logo,
                'address' => $this->input->get_post('address'),
                'state_id' => $this->input->get_post('state_id'),
                'city_id' => $this->input->get_post('city_id'),
                //'location_id'=>$this->input->get_post('location_id'),
                //'pincode' => $this->input->get_post('pincode'),
                'lat' => $this->input->get_post('latitude'),
                'lng' => $this->input->get_post('longitude'),
                'status' => 0,
                'update_status' => $this->input->get_post('update_status'),
                //'delivery_time'=>$this->input->get_post('delivery_time'),
                'min_order_amount' => $this->input->get_post('min_order_amount'),
                'created_date' => date('Y-m-d H:i:s'),
                'description' => $this->input->get_post('description'),
                'refferalcode' => $refferalcode,
                'forgot_password' => $gorget_password,
                'delivery_partner' => $delhivery_partner
                    //'vendor_pincodes'=>$imp_pincode
            );
            $shop_name=$this->input->get_post('shop_name');
        $city=$this->input->get_post('city_id');
        $state=$this->input->get_post('state_id');
        $registered_name=$this->input->get_post('owner_name');
        $address=$this->input->get_post('address');
        $pin=$this->input->get_post('pincode');
        // $phone=$this->input->get_post('mobile');
        // $email=$this->input->get_post('email');
        // $warehouse_data=array();
        // $delhiveryController = new Web();
        // $warehouse_data = $this->createWareHouse($email, $phone, $shop_name, $city, $state, $registered_name, $address, $pin);

        // echo "<pre>";
        // print_r($warehouse_data);
        // exit;
            $insert_query = $this->db->insert('vendor_shop', $data);
            $insert_id = $this->db->insert_id();
            
            $otp_message = "Hey, You are successfully registered at Absolutemens.com, we are glad to be a part of your entrepreneurial journey. Welcome Aboard Absolutemens.com";
            $template_id = '1407167151667845984';

            $this->send_message($otp_message, $phone, $template_id);

            //send mail for vandor registration complete
            $message = "Hey, <br>We are glad to welcome you onboard to our Absolutemens.com Community, We are glad to be part of your entrepreneurial Journey. <br>If you need any help regarding the onboarding procedure please contact Info@absolutemens.com. <br>A dedicated manager will be assigned to you shortly. <br>Once again thank you for being one of us. <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";

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
            $this->email->to($this->input->get_post('email'));
            $this->email->subject('Welcome Aboard');
            $this->email->message($message);

            $this->email->send();

            if ($insert_query) {
                redirect('admin/vendors_shops');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Unable to add',3);
                redirect('admin/vendors_shops/add');
                die();
            }
        }
    }
  
    private function upload_file($file_name) {
// echo $file_ext = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
// die;
        if ($_FILES[$file_name]['name'] != '') {

            if ($_FILES[$file_name]["size"] < '5114374') {
                $upload_path1 = "./uploads/shops/";
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
                return 'default_shop_logo.png';
            }
        } else {
            return '';
        }
    }

    function edit($id) {

        $qry = $this->db->query("select * from vendor_shop where id='" . $id . "'");
        $row = $qry->row();
        $this->data['vendor_data'] = $row;

        $this->data['cities'] = $this->db->get('cities')->result();

        $this->data['categories'] = $this->common_model->get_data_with_condition(['status' => 1], 'categories');

        $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();

        $this->data['title'] = 'Vendors/Shops';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/edit_vendor_shops', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function manage_categories() {

        $shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) {
            redirect('admin/vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

        $this->data['shop_status'] = 'add';

        $this->data['shop_name'] = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id)->shop_name;

        $categories = $this->common_model->get_data_with_condition(['status' => 1], 'categories');
//        $valid_cats = [];
//        //check if categories have active subcategories or not
//        foreach ($categories as $cat) {
//            $sub_cats = $this->common_model->get_data_with_condition(['cat_id' => $cat->id, 'status' => 1], 'sub_categories');
//            if (sizeof($sub_cats) > 0) {
//                array_push($valid_cats, $cat);
//            }
//        }

        $valid_cats = [];
        //check if categories already added for this vendor or not
        foreach ($categories as $cat) {
            $chk = $this->common_model->get_data_with_condition(['cat_id' => $cat->id, 'shop_id' => $shop_id], 'admin_comissions');
            if (sizeof($chk) == 0) {
                array_push($valid_cats, $cat);
            }
        }

        $this->data['categories'] = $valid_cats;

        $this->db->select('ad_com.*, c.category_name');

        $this->db->from('admin_comissions ad_com');

        $this->db->join('categories c', 'c.id=ad_com.cat_id');

        $this->db->where('ad_com.shop_id', $shop_id);

        $res = $this->db->get()->result();

        if (count($res) > 0) {

            $this->data['admin_comissions'] = $res;
        }

        $this->data['title'] = 'Manage Categories';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendor_manage_categories', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function edit_manage_categories($shop_id, $com_id) {

        if (!$shop_id) {
            redirect('admin/vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;
        $this->data['com_id'] = $com_id;
        $this->data['shop_status'] = 'edit';

        $shop_qry = $this->db->query("select * from admin_comissions where id='" . $com_id . "'");
        $this->data['admin_edit_comissions'] = $shop_qry->row();

        $this->data['shop_name'] = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id)->shop_name;

        $categories = $this->common_model->get_data_with_condition(['status' => 1], 'categories');
        $valid_cats = [];
        //check if categories already added for this vendor or not
        foreach ($categories as $cat) {
            $chk = $this->common_model->get_data_with_condition(['cat_id' => $cat->id, 'shop_id' => $shop_id, 'id !=' => $com_id], 'admin_comissions');
            if (sizeof($chk) == 0) {
                array_push($valid_cats, $cat);
            }
        }

        $this->data['categories'] = $valid_cats;

//        $this->data['subcategories'] = $this->common_model->get_data_with_condition(['status' => 1], 'sub_categories');

        $this->db->select('ad_com.*, c.category_name');

        $this->db->from('admin_comissions ad_com');

        $this->db->join('categories c', 'c.id=ad_com.cat_id');

        $this->db->where('ad_com.shop_id', $shop_id);

        $res = $this->db->get()->result();

        if (count($res) > 0) {

            $this->data['admin_comissions'] = $res;
        }

        $this->data['title'] = 'Manage Categories';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendor_manage_categories', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function manage_locations() {

        /* $shop_id = $this->input->get_post('shop_id');

          if (!$shop_id)
          {
          redirect('admin/vendors_shops/');
          die();
          }

          $this->data['shop_id'] = $shop_id;



          $this->data['page_name'] = 'pincodes';
          $this->data['title'] = 'Pincodes';
          $qry = $this->db->query("select * from pincodes where shop_id='".$shop_id."'");
          $this->data['pincodes'] = $qry->result();

          $this->load->view('admin/includes/header', $this->data);
          $this->load->view('admin/pincodes', $this->data);
          $this->load->view('admin/includes/footer'); */


        $shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) {
            redirect('admin/vendors_shops/');
            die();
        }
        $this->data['shop_id'] = $shop_id;

        $this->data['page_name'] = 'cities';
        $this->data['title'] = 'Cities';
        $qry = $this->db->query("select * from cities where vendor_id='" . $shop_id . "'");
        $this->data['cities'] = $qry->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/cities', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function manage_pincodes() {

        $shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) {
            redirect('admin/vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

        $this->data['page_name'] = 'pincodes';
        $this->data['title'] = 'Pincodes';
        $qry = $this->db->query("select * from pincodes where shop_id='" . $shop_id . "'");
        $this->data['pincodes'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/pincodes', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function manage_areas() {

        $shop_id = $this->input->get_post('shop_id');
        if (!$shop_id) {
            redirect('admin/vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

        $this->data['page_name'] = 'locations';
        $this->data['title'] = 'Areas';

        $qry = $this->db->query("select * from areas where vendor_id='" . $shop_id . "'");
        $this->data['locations'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/locations', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert_cat_comission() {

        $shop_id = $this->input->get_post('shop_id');

        $cat_id = $this->input->get_post('cat_id');
        $sub_categories = $this->input->get_post('sub_categories');
        if ($sub_categories) {
            $subcategory_ids = implode(",", $sub_categories);
        }
        $admin_commission = $this->input->get_post('admin_comission');
        $gst = $this->input->get_post('gst');

        $status = $this->input->get_post('status');

        $this->db->where('cat_id', $cat_id);

        $this->db->where('shop_id', $shop_id);

        $res = $this->db->get('admin_comissions')->result();

        /* if (count($res) > 0) {

          $data = array(

          'admin_comission' => $admin_commission,
          'subcategory_ids' =>$subcategory_ids,
          'gst' =>$gst,
          'status' => $status,
          'updated_at' => time());

          $this->db->where('cat_id', $cat_id);

          $this->db->where('shop_id', $shop_id);

          if ($this->db->update('admin_comissions', $data)) {

          redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);

          die();

          } else {

          redirect('admin/vendors_shops/');

          die();

          }

          } else { */
        if (empty($res)) {
            $data = array('shop_id' => $shop_id,
                'cat_id' => $cat_id,
                'admin_comission' => $admin_commission,
                'gst' => $gst,
                'status' => $status,
                'created_at' => time());
            if ($sub_categories) {
                $sub_cats = ['subcategory_ids' => $subcategory_ids];
                $final = array_merge($data, $sub_cats);
            } else {
                $final = $data;
            }

            $insert = $this->db->insert('admin_comissions', $final);
            if ($insert) {
                $this->session->set_tempdata('success_message', 'Admin commission added successfully.',3);
                redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong.',3);
                redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);
            }
        } else {
            $this->session->set_tempdata('error_message', 'Category already exists for this vendor.',3);
            redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);
        }

        //}
    }

    function update_cat_comission() {

        $com_id = $this->input->get_post('com_id');
        $shop_id = $this->input->get_post('shop_id');
        $cat_id = $this->input->get_post('cat_id');
        $sub_categories = $this->input->get_post('sub_categories');
        if ($sub_categories) {
            $subcategory_ids = implode(",", $sub_categories);
        }
        $admin_commission = $this->input->get_post('admin_comission');
        $gst = $this->input->get_post('gst');
        $status = $this->input->get_post('status');

        $this->db->where('cat_id', $cat_id);
        $this->db->where('shop_id', $shop_id);
        $this->db->where('id !=', $com_id);
        $res = $this->db->get('admin_comissions')->result();
        if (empty($res)) {
            $wr = array("id" => $com_id);
            $data = array(
                'shop_id' => $shop_id,
                'cat_id' => $cat_id,
                'admin_comission' => $admin_commission,
                'gst' => $gst,
                'status' => $status,
                'updated_at' => time());

            if ($sub_categories) {
                $sub_cats = ['subcategory_ids' => $subcategory_ids];
                $final = array_merge($data, $sub_cats);
            } else {
                $final = $data;
            }

            $insert = $this->db->update('admin_comissions', $final, $wr);
            if ($insert) {
                $this->session->set_tempdata('success_message', 'Admin commission updated successfully.',3);
                redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong.',3);
                redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);
            }
        } else {
            $this->session->set_tempdata('error_message', 'Category already exists for this vendor.',3);
            redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);
        }
    }

    function delete_vendor_admin_comission() {

        $admin_com_id = $this->input->get_post('admin_com_id');

        $shop_id = $this->input->get_post('shop_id');

        if ($this->admin_model->delete_vendor_admin_comission($admin_com_id)) {

            $this->session->set_tempdata('success_message', 'Comission Deleted Successfully',3);

            redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);

            die();
        } else {

            $this->session->set_tempdata('error_message', 'Unable to delete',3);

            redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);

            die();
        }
    }

    function manage_shop_banners() {

        $shop_id = $this->input->get_post('shop_id');

        $shop_banners = $this->db->get_where('vendor_shop_banners', ['shop_id' => $shop_id, 'status' => 1])->result();

        $this->data['shop_banners'] = $shop_banners;

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/manage_shop_banners', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function add_shop_banner() {

        $title = $this->input->get_post('title');
    }

    function manage_work_hours($shop_id) {

        $this->data['title'] = 'Edit Shop Work Hours';

        $this->data['work_hours'] = $this->db->get_where('shop_work_hours', ['shop_id' => $shop_id])->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/manage_work_hours', $this->data);

        $this->load->view('admin/includes/footer');
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

    function chk_duplicate() {
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $chk_email = $this->common_model->count_rows_with_conditions('vendor_shop', ['email' => $email]);
        $chk_mobile = $this->common_model->count_rows_with_conditions('vendor_shop', ['mobile' => $mobile]);
        if ($chk_email > 0 && $chk_mobile > 0) {
            echo 'email_mobile_exists';
        } elseif ($chk_email > 0 && $chk_mobile == 0) {
            echo 'email_exists';
        } elseif ($chk_email == 0 && $chk_mobile > 0) {
            echo 'mobile_exists';
        } else {
            echo 1;
        }
    }

    function vendor_products() {
        $this->data['page_name'] = 'Vendors Products';
        $shop_id = $this->input->get_post('shop_id');
        $this->data['shop_id'] = $shop_id;
        //$shop_id = $_SESSION['vendors']['vendor_id'];
        if ($this->input->post()) {
            $keyword = trim($this->input->post('keyword'));
        }
        $count = $this->db->query("select * from products where shop_id='" . $shop_id . "' order by id desc");
        $this->data['count_data'] = $count->num_rows();

        $config['base_url'] = base_url() . 'admin/vendors_shops/vendor_products';
        $config['total_rows'] = $this->data['count_data'] = $count->num_rows();
        $config['per_page'] = 10;
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
//            $this->db->where("(p.name LIKE '%".$keyword."%')");
//        }
//        $where = array('status'=>1);
//        $table = "products";
//        $this->db->select("*");
//        $qry = $this->db->where($where)->get($table);
//        $this->data['products'] = $qry->result();

        $this->db->select('p.*,c.id as cat_id,sub.id as sub_id, s.shop_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.cat_id');
        $this->db->join('sub_categories sub', 'sub.id = p.sub_cat_id', 'left');
        $this->db->join('vendor_shop s', 's.id = p.shop_id');
        $this->db->where('p.shop_id', $shop_id);
        if ($keyword) {
            $this->db->where("(p.name LIKE '%" . $keyword . "%' OR c.category_name LIKE '%" . $keyword . "%' OR sub.sub_category_name LIKE '%" . $keyword . "%')");
        }
        $this->db->order_by('p.id', 'desc');

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

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/vendor_products', $this->data);
        $this->load->view('admin/includes/footer');
    }
    public function save_vendor(){

        $warehouse_name=$this->input->post('warehouse_name');
        echo "<pre>";
        print_r($this->input->post());
        die;
    }

}
