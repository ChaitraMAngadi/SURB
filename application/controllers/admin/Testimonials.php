<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Testimonials extends CI_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');

        }

        $this->db->where('name', 'Testimonials'); 
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit();
        }
        
        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Testimonials', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");

    }

    function index() {
      
        $this->data['page_name'] = 'testimonials';
        $this->data['title'] = 'Testimonial';

        $this->db->order_by('priority', 'asc');

        $this->data['testimonial'] = $this->db->get('testimonials')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/testimonials', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function add() {

        $this->data['title'] = 'Add Testimonial';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_testimonials', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function insert() {

        $name = $this->input->get_post('name');
        $designation = $this->input->get_post('designation');
        $description = $this->input->get_post('description');

        $status = $this->input->get_post('status');
        $priority = $this->input->get_post('priority');
        $image = $this->upload_file('image');

//        if(!empty($_FILES["image"]["name"]))
//            {
//                $img_k_image = "Category_".$i."_".date('YmdHis').".jpg";
//                if (file_exists("./uploads/testimonials/" . $img_k_image))
//                {
//                     $k_image= $img_k_image;
//                }
//                else
//                {
//                  move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/testimonials/" . $img_k_image);
//                 $k_image=$img_k_image;
//                }
//            }
//            else
//            {
//                $k_image="";
//            }


        $data = array(

            'name' => $name,
            
            'designation' => $designation,

            'description' => $description,

            'status' => $status,

            'created_at' => time(),

            'image' => $image,
            'priority'=>$priority

        );

        $insert_query = $this->db->insert('testimonials', $data);

        if ($insert_query) {

            redirect('admin/testimonials');

            die();

        } else {

            redirect('admin/testimonials/add');

            die();

        }

    }

    function upload_file($file){
    $config['upload_path'] = './uploads/testimonials/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000'; // max_size in kb
            //$config['file_name'] = $_FILES['table_image']['name'][$i];
            $config['file_name'] = time(). rand();
            $config['overwrite'] = TRUE;

            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload($file)){
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];
                    $file_name = $filename;
            }
            return $file_name;
    }

    function edit($id) {

        $this->data['title'] = 'Edit Testimonials';

        $this->data['testimonials'] = $this->db->get_where('testimonials', ['id' => $id])->row();

        $this->load->view('admin/includes/header');

        $this->load->view('admin/edit_testimonials', $this->data);

        $this->load->view('admin/includes/footer');

    }

function update() {
        $id = $this->input->get_post('id');

        $qry = $this->db->query("select * from testimonials where id='".$id."'");
        $row = $qry->row();

        if($this->upload_file('image')!='')
        {
             $image = $this->upload_file('image');
        }
        else
        {
            $image=$row->image;
        }

        $name = $this->input->get_post('name');
        $designation = $this->input->get_post('designation');
        $description = $this->input->get_post('description');

        $status = $this->input->get_post('status');
        $priority = $this->input->get_post('priority');

        $data = array(
            'name' => $name,
            
            'designation' => $designation,

            'description' => $description,

            'status' => $status,

            'created_at' => time(),

            'image' => $image,
            'priority'=>$priority
        );
        $this->db->where('id', $id);
        $update_query = $this->db->update('testimonials', $data);
        //echo $this->db->last_query(); die;
        if ($update_query) {

            redirect('admin/testimonials');
            die();
        } else {
            redirect('admin/testimonials/edit/' . $id);
            die();
        }

    }

    



    
  
    function delete($id) {

        $this->db->where('id', $id);
        if ($this->db->delete('testimonials')) {
                $this->session->set_tempdata('success_message', 'Testimonials Deleted Successfully',3);
                redirect('admin/testimonials');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/testimonials');
         }

    }


}


