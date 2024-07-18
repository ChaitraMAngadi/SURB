<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Delivery_boy extends MY_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');

        }

        $this->load->model("admin_model");

    }



    function index() {
        $this->data['page_name'] = 'delivery_boy';
        $this->data['title'] = 'Delivery Boy';

        $qry = $this->db->query("select * from deliveryboy");
        $this->data['result']=$qry->result();
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/delivery_boys', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function add() {
        
         $this->data['page_name'] = 'delivery_boy/add';
         
        $this->data['title'] = 'Add Vendor/Shop';

        $this->data['states'] = $this->db->get('states')->result();

        //$this->data['cities'] = $this->db->get('cities')->result();

        $this->data['categories'] = $this->db->get('categories')->result();

        $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_delivery_boy', $this->data);

        $this->load->view('admin/includes/footer');

    }

     function getCities()
    {
       $state_id = $this->input->get_post('state_id');
         
       $chk = $this->admin_model->getCities($state_id);
          die;
    }

    function getLocation()
    {
        $city_id = $this->input->get_post('city_id');
        $chk = $this->admin_model->getLocation($city_id);
    }

function send_message($message = "", $mobile_number) {


         $message = urlencode($message);

         $URL = "http://login.smsmoon.com/API/sms.php"; // connecting url 

         $post_fields = ['username' => 'rythufresh', 'password' => 'vizag@123', 'from' => 'INFOSM', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0];

         //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");

         $ch = curl_init();

         curl_setopt($ch, CURLOPT_URL, $URL);

         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

         curl_exec($ch);

         return true;

      }

    function insert() 
    {
        //$delivery_type = $this->input->get_post('delivery_type');
        $name = $this->input->get_post('name');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        $alternative_mobile = $this->input->get_post('alternative_mobile');
        $password = $this->input->get_post('password');
        
        
        $photo = $this->upload_file('photo');
        $driving_license_image = $this->upload_file('driving_license_image');
        $aadhar_card = $this->upload_file('aadhar_card');

        $document= $this->upload_file('aadhar_card');

        $vehicle_number = $this->input->get_post('vehicle_number');
        $vehicle_type = $this->input->get_post('vehicle_type');
        $driving_license_number= $this->input->get_post('driving_license_number');

        $aadhar_card_number= $this->input->get_post('aadhar_card_number');

        $mobile_verification= $this->input->get_post('mobile_verification');
        $state = $this->input->get_post('state');
        $city_id = $this->input->get_post('city_id');
        $location = $this->input->get_post('location');

        $address = $this->input->get_post('address');
        $pincode = $this->input->get_post('pincode');
        $latitude = $this->input->get_post('latitude');
        $longitude = $this->input->get_post('longitude');


        $data = array(
            //'delivery_type' => $delivery_type,
            'name' => $name,
            'email' => $email,
            'phone' => $mobile,
            'password' => md5($password),
            'alternative_mobiles' => $alternative_mobile,
            'photo' => $photo,
            'driving_license_image' => $driving_license_image,
            'aadhar_card' => $aadhar_card,
            'document' =>$document,
            'vehicle_number' => $vehicle_number,
            'vehicle_type' => $vehicle_type,
            'driving_license_number' => $driving_license_number,
            'aadhar_card_number' => $aadhar_card_number,
            'mobile_verified' => $mobile_verification,
            'country'=>'India',
            'state' => $state,
            'city' => $city_id,
            //'location' => $location,
            'address' => $address,
            'pincode' => $pincode,
            'lat' => $latitude,
            'lang' => $longitude
        );
        
        $otp_message = 'Your Account created by Absolutemens, USERNAME: '.$mobile.'  & PASSWORD : '.$password;

        if($this->send_message($otp_message,$mobile))
        {
          $insert_query = $this->db->insert('deliveryboy', $data);
        }

        if ($insert_query) {

            $this->session->set_tempdata('success_message', 'Delivery Boy Created Successfully',3);

            redirect('admin/delivery_boy');

            die();

        } else {

            $this->session->set_tempdata('error_message', 'Unable to add',3);

            redirect('admin/delivery_boy/add');

            die();

        }

    }



private function upload_file($file_name) {
// echo $file_ext = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
// die;
    if($_FILES[$file_name]['name']!='')
    {

        if($_FILES[$file_name]["size"]<'5114374')
        {
            $upload_path1 = "./uploads/delivery_boy/";
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
        }
        else
        {
            return 'false';
        }
    }
    else
    {
        return '';
    }
    }



    function edit() {

        $this->data['title'] = 'Vendors/Shops';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendors_shops', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function manage_categories() {

        $shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) {

            redirect('admin/vendors_shops/');

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

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendor_manage_categories', $this->data);

        $this->load->view('admin/includes/footer');

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

                redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);

                die();

            } else {

                redirect('admin/vendors_shops/');

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

                redirect('admin/vendors_shops/manage_categories?shop_id=' . $shop_id);

                die();

            } else {

                redirect('admin/vendors_shops/');

                die();

            }

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


    function delete($shop_id) {
        $this->db->where('id', $shop_id);
       $del = $this->db->delete('deliveryboy');

        //echo$del = $this->db->last_query(); die;
        if($del)
        {
            $this->session->set_tempdata('success_message', 'Delivery Boy Deleted Successfully',3);
            redirect('admin/delivery_boy');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/delivery_boy');
        }
    }



}

