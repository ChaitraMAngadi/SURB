<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Banneradds extends CI_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('vendors/login');

        }

    }



    function index() {
        $this->data['page_name'] = 'banneradds';
        $qry = $this->db->get('bannerads')->result();

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $qry = $this->db->query("select * from bannerads where shop_id='".$shop_id."'");
        $data['banners'] = $qry->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/bannerads', $data);
        $this->load->view('vendors/includes/footer');
    }



    function add() {

        $this->data['title'] = 'Add Banner Ad';

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/addbannerad', $this->data);

        $this->load->view('vendors/includes/footer');

    }



    function insert() {

        $title = $this->input->post('title');

        $web_image = $this->upload_file('webimage');
        $appimage = $this->upload_file('appimage');

        $data = array(
            'title' => $title,
            'shop_id'=>$_SESSION['vendors']['vendor_id'],
            'web_image' => $web_image,
            'app_image' => $appimage,
            'blocks' => $this->input->post('blocks')
        );

        $insert_query = $this->db->insert('bannerads', $data);
        //echo $this->db->last_query(); die;

        if ($insert_query) {

            redirect('vendors/banneradds');

            die();

        } else {

            redirect('vendors/bannerads/add');

            die();

        }

    }



    function edit($id) {

        $this->data['title'] = 'Edit Banner Ad';

        $data['banners'] = $this->db->get_where('bannerads', ['id' => $id])->row();

        $this->load->view('vendors/includes/header');

        $this->load->view('vendors/editbannerad', $data);

        $this->load->view('vendors/includes/footer');

    }



    function update() {
        $id=$this->input->post('id');

        $qry = $this->db->query("select * from bannerads where id='".$id."'");
        $row = $qry->row();


        $title = $this->input->post('title');

        if($this->upload_file('webimage')!='')
        {
            $webimage=$this->upload_file('webimage');
        }
        else
        {
            $webimage=$row->web_image;
        }

        if($this->upload_file('appimage')!='')
        {
            $appimage=$this->upload_file('appimage');
        }
        else
        {
            $appimage=$row->app_image;
        }

       

        $data = array(
            'title' => $title,
            'shop_id'=>$_SESSION['vendors']['vendor_id'],
            'web_image' => $webimage,
            'app_image' => $appimage,
            'blocks' => $this->input->post('blocks')
        );
        $this->db->where('id', $id);
        $update_query = $this->db->update('bannerads', $data);
        //echo $this->db->last_query(); die;
        if ($update_query) {

            redirect('vendors/banneradds');
            die();
        } else {
            redirect('vendors/bannerads/edit/' . $id);
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
            $upload_path1 = "./uploads/bannerads/";
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



    function delete($id) {

        $this->db->where('id', $id);
        if ($this->db->delete('bannerads')) {
                $this->session->set_tempdata('success_message', 'Banner Deleted Successfully',3);
                redirect('vendors/banneradds');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/banneradds');
         }

    }



}

