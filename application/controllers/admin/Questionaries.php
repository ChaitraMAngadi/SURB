<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Questionaries extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }

        


        $this->db->where('name', 'Questionary');
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
        if (!in_array('Questionary', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        $this->load->library('pagination');
        $this->load->model("admin_model");
        $this->load->model("questionary_model");
        $this->load->model("vendor_model");
        // $this->db->where('name', 'Questionary');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // $this->data['page_name'] = 'questionaries';
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }
    }

    function index() {

        $this->data['page_name'] = 'questionaries';

        $result = $this->questionary_model->get_data();
        $this->data['questionaries'] = $result;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/questionaries', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add() {
        $this->data['title'] = 'Add Questionaries';
        $result = [];
        $cat = $this->common_model->get_data_with_condition(['status' => 1], 'categories', $order_by_column = 'priority', $order_by = 'asc');
        

        foreach ($cat as $row) {
            $chk_sub_cat = $this->common_model->get_data_with_condition(['cat_id' => $row->id, 'status' => 1], 'sub_categories');
            if (sizeof($chk_sub_cat) > 0) {
                $sub_cat_ids = array_column($chk_sub_cat, 'id');
                $chk_questionary = $this->common_model->get_data_where_in('sub_cat_id', $sub_cat_ids, 'questionaries');
                //chk if all subcategories has questions or not
                $count = sizeof($chk_sub_cat) - sizeof($chk_questionary);

                if ($count > 0) {
                    array_push($result, $row);
                }
            } else {
                $chk_questionary = $this->common_model->count_rows_with_conditions('questionaries', ['cat_id' => $row->id, 'status' => 1]);
                if ($chk_questionary == 0) {
                    array_push($result, $row);
                }
            }
        }

        $this->data['categories'] = $result;
        
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_questionaries', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert_questionary() {
        $cat_id = $this->input->get_post('cat_id');
        $chk = $this->db->like('cat_id', $cat_id)->get('questionaries')->num_rows();
//echo "<pre>";
//print_r($chk);
//exit;
    
        if ($chk > 0 || $chk ==0) {
            // Check if an image was uploaded
            if (!empty($_FILES["app_image"]["name"])) {
                $img_k_image = "questionary_" . date('YmdHis') . ".jpg";
                $upload_path = "./uploads/questionaries/"; // Specify the upload path
                $k_image = $img_k_image;
    
                // exit;
                // die;
                if (!file_exists($upload_path . $img_k_image)) {
                    move_uploaded_file($_FILES["app_image"]["tmp_name"], $upload_path . $img_k_image);
                }
            } else {
                // $k_image = "";
                $this->session->set_tempdata('error_message', 'Something went wrong, unable to insert image',3);
                redirect('admin/questionaries');
            }
    
            $array = array(
                'question' => $this->input->get_post('question'),
                'cat_id' => $this->input->get_post('cat_id'),
                'sub_cat_id' => $this->input->get_post('sub_cat_id'),
                'status' => $this->input->get_post('status'),
                'priority' => $this->input->get_post('priority'),
                'app_image' => $k_image, // Assign the uploaded image name
            );
    
            $ins = $this->questionary_model->insertData($array);
          
            // echo "<pre>"; 
            // print_r($k_image);
            // exit;
         
            
    
            if ($ins) {
                $ques_id = $this->db->insert_id();
                $options = $this->input->get_post('options');
    
                foreach ($options as $option) {
                    $table = "options";
                    $array = array('ques_id' => $ques_id, 'option' => $option);
                    $this->db->insert($table, $array);
                }
                $data = array(
                    'cat_id' =>  $cat_id,
                    'image' => $k_image
                );
                
                $this->db->insert('sub_categories', $data);
    
                $this->session->set_tempdata('success_message', 'Questionary added Successfully',3);
                redirect('admin/questionaries');
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong, please try again',3);
                redirect('admin/questionaries');
            }
        } else {
            $this->session->set_tempdata('error_message', 'Question already exists for this category.',3);
            redirect('admin/questionaries/add');
        }
    }
    

    function edit($id) {

        $this->data['title'] = 'Edit Questionaries';
        $row = $this->questionary_model->get_data_row($id);
        $row->sub_cat_name = ($this->common_model->get_data_row(['id' => $row->sub_cat_id, 'status' => 1], 'sub_categories'))->sub_questionary_name;

        $this->data['questionaries'] = $row;
        //$this->db->where('status', 1);
//        $this->data['categories'] = $this->db->get('categories')->result();
//        $this->data['subcategories'] = $this->db->get('sub_categories')->result();

        $result = [];
        $cat = $this->common_model->get_data_with_condition(['status' => 1], 'categories', $order_by_column = 'priority', $order_by = 'asc');
        foreach ($cat as $row) {
            $chk_sub_cat = $this->common_model->get_data_with_condition(['cat_id' => $row->id, 'status' => 1], 'sub_categories');
            if (sizeof($chk_sub_cat) > 0) {
                $sub_cat_ids = array_column($chk_sub_cat, 'id');
                $this->db->where('id !=', $id);
                $chk_questionary = $this->common_model->get_data_where_in('sub_cat_id', $sub_cat_ids, 'questionaries');
                //chk if all subcategories has questions or not
                $count = sizeof($chk_sub_cat) - sizeof($chk_questionary);
                if ($count > 0) {
                    array_push($result, $row);
                }
            } else {
                $chk_questionary = $this->common_model->count_rows_with_conditions('questionaries', ['cat_id' => $row->id, 'id !=' => $id, 'status' => 1]);
                if ($chk_questionary == 0) {
                    array_push($result, $row);
                }
            }
        }

        $this->data['categories'] = $result;

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_questionaries', $this->data);
        $this->load->view('admin/includes/footer');
    }
    function update_questionary() {
        // echo "<pre>"; print_r($this->input->post()); 
        $id = $this->input->get_post('id');
        $question = $this->input->get_post('question');
        $cat_id = $this->input->get_post('cat_id');
        $sub_cat_id = $this->input->get_post('sub_cat_id');
        $status = $this->input->get_post('status');
        $priority = $this->input->get_post('priority');
  
        
        // Handle image upload
        if (!empty($_FILES["app_image"]["name"])) {
            $img_k_image = "questionary_" . date('YmdHis') . ".jpg";
 //$uploads_url = base_url('../uploads/questionaries/');

        // Use $uploads_url as needed in your controller


            $upload_path = "./uploads/questionaries/"; // Adjust the path to your image upload directory
          // move_uploaded_file($_FILES["app_image"]["tmp_name"], $upload_path . $img_k_image);
    if (file_exists("./uploads/questionaries/" . $img_k_image)) {
                   $app_image = $img_k_image;    
            
} 
            else{

move_uploaded_file($_FILES["app_image"]["tmp_name"], "./uploads/questionaries/". $img_k_image);
$app_image = $img_k_image; 
}

                
              
$this->db->where('id', $id);
$data = array('app_image' => $img_k_image);
$update_query =$this->db->update('questionaries', $data);

               $this->db->where('cat_id', $cat_id);
$this->db->update('sub_categories', array('image' => $img_k_image));
}

          
 //else {
                // Handle the case where image upload fails
                // $app_image = ''; // Set an appropriate default or handle the error
               // $this->session->set_tempdata('error_message', 'unable to update the questionary image',3);
                //redirect('admin/questionaries');
            //}
         else {
            // If no new image is provided, retain the existing image
            $app_image = $this->input->post('existing_app_image');
$this->db->where('id', $id);
$data = array('app_image' =>  $app_image);
$update_query =$this->db->update('questionaries', $data);

               $this->db->where('cat_id', $cat_id);
$this->db->update('sub_categories', array('image' =>  $app_image));

        }
 
    
        // Update the questionary record
$data = array(
            'question' => $question,
            'cat_id' => $cat_id,
            'sub_cat_id' => $sub_cat_id,
            'status' => $status,
            'priority' => $priority,
'app_image'=> $app_image
                   );
      
        // echo "<pre>"; 
        // print_r($app_image);
         //print_r($data);

        //print_r($this->input->post()); 
//echo "</pre>";
       //  die;
    
        // Update the questionary using your model (questionary_model)
        $this->load->model('questionary_model');
        $upd = $this->questionary_model->updateData($data, $id);
        
    
        if ($upd|| $update_query) {
                        $options_id = $this->input->get_post('option_id');
                        $option_data = $this->input->get_post('options');
            
                        $removed_opt_ids = array_filter($this->input->get_post('removed_opt_ids'));
                        if (sizeof($removed_opt_ids) > 0) {
                            foreach ($removed_opt_ids as $id) {
                                $this->db->where('id', $id)->delete('options');
                            }
                        }
            
                        for ($i = 0; $i < count($option_data); $i++) {
                            // echo "<pre>";
                            // print_r($options_id[$i]);
                            
                            // echo "</pre>";
            
                            if ($options_id[$i] == 0) {
                                $table = "options";
                                $array_option = array('ques_id' => $id, 'option' => $option_data[$i]);
                                $this->db->insert($table, $array_option);
                                //echo $this->db->last_query();   
                            } else {
                                $table = "options";
                                $array_data = array('option' => $option_data[$i]);
                                $where = array('id' => $options_id[$i]);
                                $this->db->update($table, $array_data, $where);
                                //echo $this->db->last_query();   
                            }
                        }
                        // die;
                        //die;
                        $this->session->set_tempdata('success_message', 'Questionary updated Successfully',3);
                        redirect('admin/questionaries');
                    } 
        if ($update_query) {
            $this->session->set_tempdata('success_message', "Category updated successfully.",3);
            redirect('admin/questionaries');

           // die();
        } else {
            $this->session->set_tempdata('error_message', "Something went wrong.",3);
            redirect('admin/questionaries/edit_questionaries/' . $cat_id);

            //die();
        }

    }
    
    
//     function update_questionary() {
//         //print_r($_POST);
//         //die;
//         //echo "<pre>"; print_r($this->input->post()); die;
        
//         $id = $this->input->get_post('id');
//         $question = $this->input->get_post('question');
//         $cat_id = $this->input->get_post('cat_id');
//         $sub_cat_id = $this->input->get_post('sub_cat_id');
//         $status = $this->input->get_post('status');
//         $priority = $this->input->get_post('priority');
//         $app_image=$this->input->get_post('app_image');
        
        
//         $array = array(
//             'question' => $question,
//             'cat_id' => $cat_id,
//             'sub_cat_id' => $sub_cat_id,
//             'status' => $status,
//             'priority' => $priority,
//             'app_image'=> $app_image,
//         );
// //        $chk_duplicate_cat = $this->common_model->count_rows_with_conditions('questionaries', ['cat_id' => $cat_id, 'id !=' => $id]);
// //        if ($chk_duplicate_cat == 0) {
//         $upd = $this->questionary_model->updateData($array, $id);

//         if ($upd) {
//             $options_id = $this->input->get_post('option_id');
//             $option_data = $this->input->get_post('options');

//             $removed_opt_ids = array_filter($this->input->get_post('removed_opt_ids'));
//             if (sizeof($removed_opt_ids) > 0) {
//                 foreach ($removed_opt_ids as $id) {
//                     $this->db->where('id', $id)->delete('options');
//                 }
//             }

//             for ($i = 0; $i < count($option_data); $i++) {

//                 if ($options_id[$i] == 0) {
//                     $table = "options";
//                     $array_option = array('ques_id' => $id, 'option' => $option_data[$i]);
//                     $this->db->insert($table, $array_option);
//                     //echo $this->db->last_query();   
//                 } else {
//                     $table = "options";
//                     $array_data = array('option' => $option_data[$i]);
//                     $where = array('id' => $options_id[$i]);
//                     $this->db->update($table, $array_data, $where);
//                     //echo $this->db->last_query();   
//                 }
//             }
//             //die;
//             $this->session->set_tempdata('success_message', 'Questionary updated Successfully',3);
//             redirect('admin/questionaries');
//         } else {
//             $this->session->set_tempdata('error_message', 'Something went wrong, please try again',3);
//             redirect('admin/questionaries');
//         }
// //        } else {
// //            $this->session->set_tempdata('error_message', 'Question already exists for this category.',3);
// //            redirect('admin/questionaries/edit/'.$id);
// //        }
//     }

    function delete($id) {
        if ((isset($id)) && ($id != '')) {
            $parameters = array();
            $parameters['id'] = $id;

            if ($this->questionary_model->delete($parameters)) {

                $this->session->set_tempdata('success_message', "'Deleted Successfully', 'Success'",3);
                redirect('admin/questionaries');
            } else {
                $this->session->set_tempdata('error_message', "'Please Try Again', 'Error'",3);
                redirect('admin/questionaries');
            }
        } else {
            redirect('admin/questionaries');
        }
    }

    function other_msg($cat_id = null) {
        $this->data['page_name'] = 'questionaries_other';
        
        $this->data['count_data'] = sizeof($this->questionary_model->get_other_msg_data($cat_id));
        $config['base_url'] = base_url() . 'admin/questionaries/other_msg';
        $config['total_rows'] = $this->data['count_data'];
        $config['per_page'] = 10; 
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
            $data['kk'] = 1;
        } else {
            $data['kk'] = $start + 1;
        }
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['page_start'] = $start - $config['per_page'] + 11;
        $this->db->limit($config['per_page'], $start);
        
        $result = $this->questionary_model->get_other_msg_data($cat_id);
        $this->data['other_msg'] = $result;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/questionaries_other_msg', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function delete_other_msg($id) {
        if ((isset($id)) && ($id != '')) {
            $this->db->where('id', $id)->delete('questionary_other_message');
            $this->session->set_tempdata('success_message', "'Deleted Successfully', 'Success'",3);
            redirect('admin/questionaries/other_msg');
        } else {
            $this->session->set_tempdata('error_message', "'Please Try Again', 'Error'",3);
            redirect('admin/questionaries/other_msg');
        }
    }

}
