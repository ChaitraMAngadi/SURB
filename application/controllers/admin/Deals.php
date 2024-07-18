<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Deals extends CI_Controller {



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
        $this->data['page_name'] = 'deals';
        $this->data['title'] = 'Offers';
        $qry=$this->db->query("select * from deals order by id desc");
        $this->data['deals'] = $qry->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/deals', $this->data);
        $this->load->view('admin/includes/footer');
    }



    function cat_list($cat_ids) {

        $categories_list = array();

        if ($cat_ids) {

            $catArray = explode(',', $cat_ids);

            foreach ($catArray as $cat) {

                $catRow = $this->admin_model->get_table_row('categories', 'id', $cat);

                if ($catRow) {

                    array_push($categories_list, $catRow);

                }

            }

        }

        return $categories_list;

    }



    function add() {

        $this->data['title'] = 'Add Offer';

        $this->data['shops'] = $this->db->get('vendor_shop')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_deal', $this->data);

        $this->load->view('admin/includes/footer');

    }


function edit($id) {
        $qry=$this->db->query("select * from deals where id='".$id."'");
        $this->data['deals'] = $qry->row();

        $this->data['title'] = 'Edit Offer';

        $this->data['shops'] = $this->db->get('vendor_shop')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/edit_deal', $this->data);

        $this->load->view('admin/includes/footer');

    }

    function update()
    {
        $id = $this->input->post('id');
       
       $qry = $this->db->query("select * from deals where id='".$id."'");
       $row = $qry->row();


       if($this->upload_file1('webimage')!='')
        {
            $web_img = "./uploads/deals/".$row->web_image; 
            unlink($web_img);
            $webimage=$this->upload_file1('webimage');
        }
        else
        {
            $webimage=$row->web_image;
        }

        if($this->upload_file1('appimage')!='')
        {
            $app_img = "./uploads/deals/".$row->app_image;
            unlink($app_img);
            $appimage=$this->upload_file1('appimage');
        }
        else
        {
            $appimage=$row->app_image;
        }

        $cat_id = $this->input->post('cat_id');
        $title = $this->input->post('title');
        $deal_start = $this->input->post('deal_start');
        $deal_end = $this->input->post('deal_end');

        $status = $this->input->post('status');

            $data = array(
                'cat_id' => $cat_id,
                'title' => $title,
                'deal_start' => $deal_start,
                'deal_end' => $deal_end,
                'web_image' => $webimage,
                'app_image' => $appimage,
                'status' => $status,
                'updated_at'=>time()
            );
            $wrr = array('id'=>$id);
            $insert_query = $this->db->update('deals',$data,$wrr);
            if($insert_query) 
            {
                redirect('admin/deals');
                die();
            } 
            else 
            {
                redirect('admin/deals/edit');
                die();
            }
    }

    function insert() {
        $cat_id = $this->input->post('cat_id');
        $title = $this->input->post('title');
        $deal_start = $this->input->post('deal_start');
        $deal_end = $this->input->post('deal_end');

        $web_image = $this->upload_file1('webimage');
        $appimage = $this->upload_file1('appimage');

        $status = $this->input->post('status');

            $data = array(
                'cat_id' => $cat_id,
                'title' => $title,
                'deal_start' => $deal_start,
                'deal_end' => $deal_end,
                'web_image' => $web_image,
                'app_image' => $appimage,
                'status' => $status,
                'created_at'=>time()
            );
            $insert_query = $this->db->insert('deals', $data);
        if($insert_query) 
        {
             $this->session->set_tempdata('success_message', 'Deal added Successfully',3);
            redirect('admin/deals');
            die();
        } 
        else 
        {
            redirect('admin/deals/add');
            die();
        }
    }


     function upload_file1($file_name) {
 //echo $file_ext = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
       // print_r($_FILES); 
 //die;
    if($_FILES[$file_name]['name']!='')
    {

        if($_FILES[$file_name]["size"]<'5114374')
        {
            $upload_path1 = "./uploads/deals/";
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
            $qry = $this->db->query("select * from deals where id='".$id."'");
            $row = $qry->row();
            $imgpath = "./uploads/deals/".$row->app_image;
            $web_image = "./uploads/deals/".$row->web_image;
            unlink($imgpath);
            unlink($web_image);
        $this->db->where('id', $id);
        if ($this->db->delete('deals')) {
                $this->session->set_tempdata('success_message', 'Deal Deleted Successfully',3);
                redirect('admin/deals');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/deals');
         }

    }



}

