<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->load->model('vendor_model');
    }

    function index() {
        $this->data['page_name'] = 'settings';
        $qry = $this->db->query("select * from vendor_shop where id='".$_SESSION['vendors']['vendor_id']."'");
        $data['settings'] = $qry->row();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/settings', $data);
        $this->load->view('vendors/includes/footer');
    }

    function updateVendor()
    {

        // $shop_name = $this->input->post('shop_name');
        // $owner_name = $this->input->post('owner_name');
        // $mail=$this->input->post('email');

        // $mobile = $this->input->post('mobile');
        // $address = $this->input->post('address');
        // $city = $this->input->post('city');
        // $pincode = $this->input->post('pincode');
        //  $image = $this->upload_file('webimage');
        //   $logo = $this->upload_file('logo');

        //   $delivery_time = $this->input->post('delivery_time');
        //   $min_order_amount = $this->input->post('min_order_amount');
        //   $delhivery_partner=$this->input->post('delivery_partner');

        // if($this->upload_file('webimage')!='' && $this->upload_file('logo')!='')
        // {
           
        //     $ar=array(
        //         'shop_name'=>$this->input->post('shop_name'),
        //         'owner_name'=>$this->input->post('owner_name'),
        //         'mobile'=>$this->input->post('mobile'),
        //         'address'=>$this->input->post('address'),
        //         'city'=>$this->input->post('city'),
        //         'pincode'=>$this->input->post('pincode'),
        //         'lat'=>$this->input->post('lat'),
        //         'lng'=>$this->input->post('lng'),
        //         'status'=>$this->input->post('status'),
        //         'delivery_time'=>$delivery_time,
        //         'min_order_amount'=>$min_order_amount,
        //         'shop_logo'=>$image,
        //         'logo'=>$logo,
        //         'delivery_partner'=>$delhivery_partner,
        //         'email'=>$mail
                
        //         );
        // }
        // else if($this->upload_file('webimage')=='' && $this->upload_file('logo')!='')
        // {
           
        //     $ar=array(
        //         'shop_name'=>$this->input->post('shop_name'),
        //         'owner_name'=>$this->input->post('owner_name'),
        //         'mobile'=>$this->input->post('mobile'),
        //         'address'=>$this->input->post('address'),
        //         'city'=>$this->input->post('city'),
        //         'pincode'=>$this->input->post('pincode'),
        //         'lat'=>$this->input->post('lat'),
        //         'lng'=>$this->input->post('lng'),
        //         'status'=>$this->input->post('status'),
        //         'delivery_time'=>$delivery_time,
        //         'min_order_amount'=>$min_order_amount,
        //         'logo'=>$logo,
        //         'delivery_partner'=>$delhivery_partner,
        //         'email'=>$mail
                
        //         );
        // }
        // else if($this->upload_file('webimage')!='' && $this->upload_file('logo')=='')
        // {
           
        //     $ar=array(
        //         'shop_name'=>$this->input->post('shop_name'),
        //         'owner_name'=>$this->input->post('owner_name'),
        //         'mobile'=>$this->input->post('mobile'),
        //         'address'=>$this->input->post('address'),
        //         'city'=>$this->input->post('city'),
        //         'pincode'=>$this->input->post('pincode'),
        //         'lat'=>$this->input->post('lat'),
        //         'lng'=>$this->input->post('lng'),
        //         'status'=>$this->input->post('status'),
        //         'delivery_time'=>$delivery_time,
        //         'min_order_amount'=>$min_order_amount,
        //         'shop_logo'=>$image,
        //         'delivery_partner'=>$delhivery_partner,
        //         'email'=>$mail
                
        //         );
        // }
        // else
        // {
        //    $ar=array(
        //         'shop_name'=>$this->input->post('shop_name'),
        //         'owner_name'=>$this->input->post('owner_name'),
        //         'mobile'=>$this->input->post('mobile'),
        //         'address'=>$this->input->post('address'),
        //         'city'=>$this->input->post('city'),
        //         'pincode'=>$this->input->post('pincode'),
        //         'lat'=>$this->input->post('lat'),
        //         'lng'=>$this->input->post('lng'),
        //         'status'=>$this->input->post('status'),
        //         'delivery_time'=>$delivery_time,
        //         'min_order_amount'=>$min_order_amount,
        //         'delivery_partner'=>$delhivery_partner,
        //         'email'=>$mail
        //         );
        // }
        
        // $wr = array('id'=>$_SESSION['vendors']['vendor_id']);
        // $upd = $this->db->update("vendor_shop",$ar,$wr);
        // if($upd)
        // {
        //     $qry = $this->db->query("select * from vendor_shop where id='".$_SESSION['vendors']['vendor_id']."'");
        //    $data['settings'] = $qry->row();
        //    $this->session->set_tempdata('success_message', 'Profile Updated Successfully',3);
            
        // }
        // $this->load->view('vendors/includes/header', $this->data);
        // $this->load->view('vendors/settings', $data);
        // $this->load->view('vendors/includes/footer');
            // Sanitize inputs
    $shop_name = htmlspecialchars($this->input->post('shop_name'), ENT_QUOTES, 'UTF-8');
    $owner_name = htmlspecialchars($this->input->post('owner_name'), ENT_QUOTES, 'UTF-8');
    $mail = htmlspecialchars($this->input->post('email'), ENT_QUOTES, 'UTF-8');
    $mobile = htmlspecialchars($this->input->post('mobile'), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($this->input->post('address'), ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars($this->input->post('city'), ENT_QUOTES, 'UTF-8');
    $pincode = htmlspecialchars($this->input->post('pincode'), ENT_QUOTES, 'UTF-8');
    $delivery_time = htmlspecialchars($this->input->post('delivery_time'), ENT_QUOTES, 'UTF-8');
    $min_order_amount = htmlspecialchars($this->input->post('min_order_amount'), ENT_QUOTES, 'UTF-8');
    $delivery_partner = htmlspecialchars($this->input->post('delivery_partner'), ENT_QUOTES, 'UTF-8');

    // File uploads
    $image = $this->upload_file('webimage');
    $logo = $this->upload_file('logo');

    // Prepare data array
    $ar = array(
        'shop_name' => $shop_name,
        'owner_name' => $owner_name,
        'mobile' => $mobile,
        'address' => $address,
        'city' => $city,
        'pincode' => $pincode,
        'lat' => $this->input->post('lat'),
        'lng' => $this->input->post('lng'),
        'status' => $this->input->post('status'),
        'delivery_time' => $delivery_time,
        'min_order_amount' => $min_order_amount,
        'delivery_partner' => $delivery_partner,
        'email' => $mail
    );

    // Conditionally add image and logo if they exist
    if ($image) {
        $ar['shop_logo'] = $image;
    }
    if ($logo) {
        $ar['logo'] = $logo;
    }

    // Update database
    $wr = array('id' => $_SESSION['vendors']['vendor_id']);
    $upd = $this->db->update("vendor_shop", $ar, $wr);
    if ($upd) {
        $qry = $this->db->query("SELECT * FROM vendor_shop WHERE id = '" . $_SESSION['vendors']['vendor_id'] . "'");
        $data['settings'] = $qry->row();
        $this->session->set_tempdata('success_message', 'Profile Updated Successfully', 3);
    }

    // Load views
    $this->load->view('vendors/includes/header', $this->data);
    $this->load->view('vendors/settings', $data);
    $this->load->view('vendors/includes/footer');
        
    }


 private function upload_file($file_name) {

    if($_FILES[$file_name]['name']!='')
    {

        if($_FILES[$file_name]["size"]<'5114374')
        {
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



    function changePassword1()
    {

            $vendor_id = $_SESSION['vendors']['vendor_id'];
            $oldpassword = $this->input->get_post('oldpassword');
            $newpassword = $this->input->get_post('newpassword');

        $chk = $this->db->query("select * from vendor_shop where id='".$vendor_id."' and password='".md5($oldpassword)."'");
        if($chk->num_rows()>0)
        {
            $ar = array('password'=>md5($newpassword),'forgot_password'=>$newpassword);
            $wr = array('id'=>$vendor_id);
            $upd = $this->db->update("vendor_shop",$ar,$wr);
            if($upd)
            {
                $this->session->set_tempdata('success_message1', 'Password Changed Successfully.',3);
            redirect('vendors/settings');
            }
            
        }
        else
        {
            $this->session->set_tempdata('error_message1', 'Old Password Wrong.',3);
            redirect('vendors/settings');
        }
    }

}
