<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Coupons extends CI_Controller {



    public $data;



    function __construct() {

        parent::__construct();
 if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }

        $this->db->where('name', 'Coupons');
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit(); // Stop further execution
        }

        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Coupons', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
      
        $this->load->model("admin_model");

    }



    function index() {
        $this->data['page_name'] = 'coupons';

        $qry = $this->db->query("select * from coupon_codes where shop_id='0'");
        $data['coupons'] = $qry->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/coupons', $data);
        $this->load->view('admin/includes/footer');
    }



    function add() {
        $this->data['page_name'] = 'coupons';
        $this->data['title'] = 'Add Coupon';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/addcoupon', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function insert() {
        $brand=$this->input->get_post('brand');
        // $image=$this->input->get_post('app_image');
        if (!empty($_FILES["app_image"]["name"])) {
            $img_k_image = "coupons_" . date('YmdHis') . ".jpg";
            $upload_path = "./uploads/coupons/"; // Specify the upload path
            $k_image = $img_k_image;
           
            // exit;
            // die;
            if (!file_exists($upload_path . $img_k_image)) {
                move_uploaded_file($_FILES["app_image"]["tmp_name"], $upload_path . $img_k_image);
            }
        } else {
            $k_image = "";
            // $this->session->set_tempdata('error_message', 'Something went wrong, unable to insert image',3);
            // redirect('admin/coupons');
        }
        // print_r($k_image);
        // exit;die;

        
        $tags=$this->input->get_post('tags');
        $brandJson=json_encode($brand);
        $tagJson = json_encode($tags);
        if ($this->input->get_post('tags') != '') {

            $producttags = implode(",", $this->input->get_post('tags'));
        } else {

            $producttags = '';
        }
        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'percentage' => $this->input->post('percentage'),
            'start_date' => date("Y-m-d",strtotime($this->input->post('start_date'))),
            'expiry_date' => date("Y-m-d",strtotime($this->input->post('expiry_date'))),
            'maximum_amount' => $this->input->post('maximum_amount'),
            'description' => $this->input->post('description'),
            'utilization' => $this->input->post('utilization'),
            'minimum_order_amount'=> $this->input->post('minimum_order_amount'),
            'limit_user'=>$this->input->post('limit'),
            'Tag'=>$tagJson,
            'brands'=>$brandJson,
            'image'=>$k_image

        );
        if(strtotime($this->input->post('start_date')) > strtotime($this->input->post('expiry_date'))){
            $this->session->set_tempdata('error_message', 'expiry date can not be less than start date',3);
            redirect('admin/coupons/add');

            die();

        } else {
             $insert_query = $this->db->insert('coupon_codes', $data);
             if ($insert_query) {

            redirect('admin/coupons');

            die();

        }
     }  
    }



    function edit($id) {
        $this->data['page_name'] = 'coupons';
        $this->data['title'] = 'Edit Coupons';

        $data['coupons'] = $this->db->get_where('coupon_codes', ['id' => $id])->row();
        $data['id']=$id;

        $this->load->view('admin/includes/header');

        $this->load->view('admin/editcoupon', $data);

        $this->load->view('admin/includes/footer');

    }



    function update() {
        $id=$this->input->post('id');
        $tags=$this->input->get_post('tags');
        
        $brand=$this->input->get_post('brand');
        if (!empty($_FILES["app_image"]["name"])) {
            $img_k_image = "coupons_" . date('YmdHis') . ".jpg";
            $upload_path = "./uploads/coupons/"; // Specify the upload path
            $k_image = $img_k_image;
            
            // Check if the file already exists
            if (file_exists($upload_path . $img_k_image)) {
                // Remove the existing file
                unlink($upload_path . $img_k_image);
            }
            
            // Move the new file to the upload directory
            move_uploaded_file($_FILES["app_image"]["tmp_name"], $upload_path . $img_k_image);
        } else{
            $k_image="";
        }
        
      

        // Convert tags array to JSON format
        $tagJson = json_encode($tags);
        $brandJson =json_encode($brand);
        if($tagJson==null){
            $tagJson='';
        }
        // print_r($tags);
        // exit;die;
        if ($this->input->get_post('tags') != '') {

            $producttags = implode(",", $this->input->get_post('tags'));
        } else {

            $producttags = '';
        }


       

        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'percentage' => $this->input->post('percentage'),
            'start_date' => date("Y-m-d",strtotime($this->input->post('start_date'))),
            'expiry_date' => date("Y-m-d",strtotime($this->input->post('expiry_date'))),
            'maximum_amount' => $this->input->post('maximum_amount'),
            'description' => $this->input->post('description'),
            'utilization' => $this->input->post('utilization'),
            'minimum_order_amount'=> $this->input->post('minimum_order_amount'),
            'limit_user'=>$this->input->post('limit'),
            'Tag'=>$tagJson,
            'brands'=>$brandJson,
            'image'=>$k_image
        );

        $this->db->where('id', $id);
        $update_query = $this->db->update('coupon_codes', $data);
        //echo $this->db->last_query(); die;
        if ($update_query) {

            redirect('admin/coupons');
            die();
        } else {
            redirect('admin/coupons/edit/' . $id);
            die();
        }

    }




    function delete($id) 
    {
        $this->db->where('id', $id);
        if ($this->db->delete('coupon_codes')) {
                $this->session->set_tempdata('success_message', 'Coupon Deleted Successfully',3);
                redirect('admin/coupons');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/coupons');
         }
    }



}

