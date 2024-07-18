<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pickuprequests extends MY_Controller {

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

        $data['page_name'] = 'pickuprequest';
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $data['shop_id']=$shop_id;
        $vendor_qry=$this->db->query("select * from vendor_shop where id='".$shop_id."'");
        $vendor_qry_res=$vendor_qry->row();
        // echo "<pre>";
        // print_r($vendor_qry_res);
        // exit;
        $data['vendor_info']=$vendor_qry_res;
       

        $pickup_qry=$this->db->query("select * from pickup_table where vendor_id='".$shop_id."'");
        $pickup_qry_res=$pickup_qry->result();
        $data['pickuprequest']=$pickup_qry_res;
        // echo "<pre>";
        // print_r($pickup_qry_res);
        // exit;

        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/pickuprequests', $data);
        $this->load->view('vendors/includes/footer');
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

       
}

    