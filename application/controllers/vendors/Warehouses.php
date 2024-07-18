<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouses extends MY_Controller {

    public $data;
    

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->load->model('web_model');
        $this->load->model('vendor_model');
        $this->load->library('pagination');
        $this->data['vendor_id'] = $this->session->userdata('vendors')['vendor_id'];
        
    }
    function index() {

        $data['page_name'] = 'warehouses';
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $data=array(
            'shop_id'=>$shop_id,
            'page_name'=>'warehouses'
        );
       
       
       
       

        

        
       

        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/warehouses', $data);
        $this->load->view('vendors/includes/footer');
    }
    function add(){
        
        $this->data['page_name'] = 'warehouses/add';

        $this->data['title'] = 'Add warehouses/vendor';

        

        // $this->data['cities'] = $this->db->get('cities')->result();

        // $this->data['categories'] = $this->common_model->get_data_with_condition(['status' => 1], 'categories');

        // $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/add_warehouse', $this->data);

        $this->load->view('vendors/includes/footer');
    }
    function save_warehouse(){
        $warehouse_name=$this->input->post('warehouse_name');
        $mobile_number=$this->input->post('mobile_number');
        $email=$this->input->post('email');
        $warehouse_address=$this->input->post('warehouse_address');
        $pincode=$this->input->post('pincode');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $country=$this->input->post('country');
        // $returnSameAsPickup=$this->input->post('returnSameAsPickup');
        $return_address=$this->input->post('return_address');
        $return_pincode=$this->input->post('return_pincode');
        $return_city=$this->input->post('return_city');

        $return_state=$this->input->post('return_state');
        $return_country=$this->input->post('return_country');
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $data = array(
            'vendor_id' => $shop_id,
            'warehouse_name' => $warehouse_name, 
            'mobile_number' => $mobile_number,
            'email' => $email, 
            'address'=>$warehouse_address,
            'pincode'=>$pincode,
            'city' => $city,
            'state' => $state,
            'country'=>$country,
            'return_address' => $return_address, 
            'return_pincode'=>$return_pincode,
        'return_city'=>$return_city,
    'return_state'=>$return_state,
'return_country'=>$return_country);
        
      

       $chk_address = $this->common_model->count_rows_with_conditions('warehouses', ['address' => $warehouse_address]);
       
       

            //$imp_pincode = implode(",", $this->input->get_post('pincodes'));

           
         
            $insert_qry= $this->db->insert("warehouses",$data);
            $ven_q = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");

            $ven_row = $ven_q->row();
            $owner_name=$ven_row->owner_name;
            // echo "<pre>";
            // print_r($ven_row);
            // exit;

            

            
            $warehouse_data = $this->createWareHouse($owner_name,$warehouse_name,$mobile_number,$email,$warehouse_address,$pincode,$city,$state,$country,$return_address,$return_pincode,$return_city,$return_state,$return_country);
            // $insert_id = $this->db->insert_id();
            // echo "<pre>";
            // print_r($warehouse_data);
            // exit;
            
            $otp_message = "Hey, You are successfully registered the Warehouse for the vendor";
            $template_id = '1407167151667845984';

            $this->send_message($otp_message, $mobile_number, $template_id);

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
            if ($chk_address > 0) {
                $this->session->set_tempdata('error_message', 'address already exists',3);
                $this->load->view('vendors/includes/header', $this->data);
                $this->load->view('vendors/add_warehouse', $this->data);
                $this->load->view('vendors/includes/footer');
            }  elseif ($chk_address == 0) {
                $this->session->set_tempdata('error_message', 'address already exists',3);
                $this->load->view('vendors/includes/header', $this->data);
                $this->load->view('vendors/add_warehouse', $this->data);
                $this->load->view('vendors/includes/footer');
            } 

            if ($insert_qry) {
                redirect('vendors/warehouses');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Unable to add',3);
                redirect('vendors/Warehouses/add');
                die();
            }
        
       
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

    public function createWareHouse($owner_name,$warehouse_name,$mobile_number,$email,$warehouse_address,$pincode,$city,$state,$country,$return_address,$return_pincode,$return_city,$return_state,$return_country){
        // $api_key = '81b46fee5028f79840ab568b7bf88a65ec6d67ea';//test key
        $url=WAREHOUSE_URL;//live url
        // $bearerToken = '81b46fee5028f79840ab568b7bf88a65ec6d67ea';//testing key
        $api_key=TEST_KEY;//live key
        // $pickupwarehouse = WAREHOUSE_LOCATION;
        // $url = 'https://staging-express.delhivery.com/api/backend/clientwarehouse/create/';//test url
        
        
        
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Token ' .$api_key
        );
        $params=[
            'name'=>$warehouse_name,
            'city'=>$city,
            'state'=>$state,
            'registered_name'=>$owner_name,
            'address'=>$warehouse_address,
            'pin'=>$pincode,
            'phone'=>$mobile_number,
            'email'=>$email,
            'country'=>$country,
            'return_address'=>$return_address,
            'return_pin'=>$return_pincode,
            'return_city'=>$return_city,
            'return_state'=>$return_state,
            'return_country'=>$return_country
        ];
        $json_params=json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url );
      
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        
        // Handle $response as needed
        $result=json_decode($response,true);
        return $response;
    
    }
    function updatewarehouse($warehouse_id){

        $fetch_qry=$this->db->query("select * from warehouses where id='" . $warehouse_id . "'");
        $fetch_qry_result=$fetch_qry->result();

        $data['warehouses']=$fetch_qry_result;
        

        // print_r($fetch_qry_result);
        // die();
        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/update_warehouse', $data);

        $this->load->view('vendors/includes/footer');

        

    }
    function update_warehouse(){
        $owner_name=$this->input->post('owner_name');
        // echo "<pre>";
        // print_r($owner_name);
        // die();
        $warehouse_name=$this->input->post('warehouse_name');
        $mobile_number=$this->input->post('mobile_number');
        $email=$this->input->post('email');
        $warehouse_address=$this->input->post('warehouse_address');
        $pincode=$this->input->post('pincode');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $country=$this->input->post('country');
        // $returnSameAsPickup=$this->input->post('returnSameAsPickup');
        $return_address=$this->input->post('return_address');
        $return_pincode=$this->input->post('return_pincode');
        $return_city=$this->input->post('return_city');

        $return_state=$this->input->post('return_state');
        $return_country=$this->input->post('return_country');
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $data = array(
            
            'vendor_id' => $shop_id,
            'warehouse_name' => $warehouse_name, 
            'mobile_number' => $mobile_number,
            'email' => $email, 
            'address'=>$warehouse_address,
            'pincode'=>$pincode,
            'city' => $city,
            'state' => $state,
            'country'=>$country,
            'return_address' => $return_address, 
            'return_pincode'=>$return_pincode,
        'return_city'=>$return_city,
    'return_state'=>$return_state,
'return_country'=>$return_country);
        
      

       $chk_address = $this->common_model->count_rows_with_conditions('warehouses', ['address' => $warehouse_address]);
       
      

            //$imp_pincode = implode(",", $this->input->get_post('pincodes'));

            $where = array("id" => $owner_name);
           
           
         
            $insert_qry= $this->db->update("warehouses",$data,$where);
            $ven_q = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");

            $ven_row = $ven_q->row();
            $owner_name=$ven_row->owner_name;
            // echo "<pre>";
            // print_r($ven_row);
            // exit;

            

            
            $warehouse_data = $this->update_house($warehouse_name,$warehouse_address,$owner_name,$pincode,$mobile_number,$email,$return_address,$return_pincode);
            // $insert_id = $this->db->insert_id();
            // echo "<pre>";
            // print_r($warehouse_data);
            // exit;
            
            $otp_message = "Hey, You are successfully registered the Warehouse for the vendor";
            $template_id = '1407167151667845984';

            $this->send_message($otp_message, $mobile_number, $template_id);

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

            if ($insert_qry) {
                redirect('vendors/warehouses');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Unable to add',3);
                redirect('vendors/update_warehouse');
                die();
            }
        
       
    }

    public function update_house($warehouse_name,$warehouse_address,$owner_name,$pincode,$mobile_number,$email,$return_address,$return_pincode){
    $api_key = TEST_KEY;//test key

    $url = WAREHOUSE_EDIT_URL;//test url

       
    
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Token ' .$api_key
    );
    $params=[

        'name'=>$warehouse_name,
        'registered_name'=>$owner_name,
        'address'=>$warehouse_address,
        
        'pin'=>$pincode,
        'mobile_number'=>$mobile_number,
        'email'=>$email,

        'return_address'=>$return_address,
        'return_pin'=>$return_pincode,

    ];
    $json_params=json_encode($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url );
  
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }
    
    curl_close($ch);
    
    // Handle $response as needed
    $result=json_decode($response,true);
    return $response;

}

       
}

    