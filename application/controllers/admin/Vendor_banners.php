<?php







defined('BASEPATH') OR exit('No direct script access allowed');







class Vendor_banners extends CI_Controller {







    public $data;







    function __construct() {



        parent::__construct();



        if ($this->session->userdata('admin_login')['logged_in'] != true) {



            //$this->session->set_tempdata('error', 'Session Timed Out',3);



            redirect('admin/login');



        }



    }







    function index() {

        $this->data['page_name'] = 'vendor_banners';

        $qry = $this->db->query("select * from vendor_shop_banners");

        $this->data['banners'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendor_banners', $this->data);

        $this->load->view('admin/includes/footer');

    }







    function add() {



        $this->data['title'] = 'Add Banner';



        $this->load->view('admin/includes/header', $this->data);



        $this->load->view('admin/addbanner', $this->data);



        $this->load->view('admin/includes/footer');



    }







    function insert() {



        $title = $this->input->post('title');



        $web_image = $this->upload_file('webimage');

        $appimage = $this->upload_file('appimage');



        $data = array(

            'shop_id'=>$_SESSION['vendors']['vendor_id'],

            'title' => $title,

            'web_banner' => $web_image,

            'app_banner' => $appimage

        );



        $insert_query = $this->db->insert('vendor_shop_banners', $data);

        //echo $this->db->last_query(); die;



        if ($insert_query) {



            redirect('admin/vendor_banners');



            die();



        } else {



            redirect('admin/vendor_banners/add');



            die();



        }



    }





    function changeStatus($bid,$status)

    {

        $upd = $this->db->update("vendor_shop_banners",array('status' =>$status),array('id' =>$bid));

        if($upd)

        {

            $this->session->set_tempdata('success_message', 'Status changed Successfully',3);

            redirect('admin/vendor_banners');

        }

    }







    function edit($id) {



        $this->data['title'] = 'Edit Banner';



        $data['banners'] = $this->db->get_where('vendor_shop_banners', ['id' => $id])->row();



        $this->load->view('admin/includes/header');



        $this->load->view('admin/editbanner', $data);



        $this->load->view('admin/includes/footer');



    }







    function update() {

        $id=$this->input->post('id');



        $qry = $this->db->query("select * from vendor_shop_banners where id='".$id."'");

        $row = $qry->row();





        $title = $this->input->post('title');



        if($this->upload_file('webimage')!='')

        {

            $webimage=$this->upload_file('webimage');

        }

        else

        {

            $webimage=$row->web_banner;

        }



        if($this->upload_file('appimage')!='')

        {

            $appimage=$this->upload_file('appimage');

        }

        else

        {

            $appimage=$row->app_banner;

        }



       



        $data = array(

             'shop_id'=>$_SESSION['vendors']['vendor_id'],

            'title' => $title,

            'web_banner' => $webimage,

            'app_banner' => $appimage

        );

        $this->db->where('id', $id);

        $update_query = $this->db->update('vendor_shop_banners', $data);

        //echo $this->db->last_query(); die;

        if ($update_query) {



            redirect('admin/vendor_banners');

            die();

        } else {

            redirect('admin/vendor_banners/edit/' . $id);

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

            $upload_path1 = "./uploads/banners/";

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

        if ($this->db->delete('vendor_shop_banners')) {

                $this->session->set_tempdata('success_message', 'Banner Deleted Successfully',3);

                redirect('admin/vendor_banners');

         } 

         else 

         {

                $this->session->set_tempdata('error_message', 'Unable to delete',3);

                redirect('admin/vendor_banners');

         }



    }







}



