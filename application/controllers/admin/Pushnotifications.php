<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Pushnotifications extends MY_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');

        }

    }



    function index() {



         $this->data['page_name'] = 'pushnotifications';

        $this->data['title'] = 'Send Pushnotification';

        $push_qry = $this->db->query("select * from promotion_notifications");

        $this->data['push_notifications'] =$push_qry->result();

        $this->load->view('admin/includes/header', $this->data);



        $this->load->view('admin/pushnotifications_list', $this->data);



        $this->load->view('admin/includes/footer');



    }



    function send() {



         $this->data['page_name'] = 'pushnotifications';

        $this->data['title'] = 'Send Pushnotification';

        $push_qry = $this->db->query("select * from promotion_notifications");

        $this->data['push_notifications'] =$push_qry->result();

        $this->load->view('admin/includes/header', $this->data);



        $this->load->view('admin/pushnotifications', $this->data);



        $this->load->view('admin/includes/footer');



    }



    function insert()

    {



        $user_type = $this->input->get_post('user_type'); 



        $user_id = $this->input->get_post('user_id');

                $title = $this->input->get_post('title');

                $message = $this->input->get_post('description');



        if($user_type=='all')

        {

            $this->db->insert("promotion_notifications",array('select_user_type'=>$user_type,'title'=>$title,'description'=>$message,'user_id'=>"0"));

                   $user_qry1 = $this->db->query("select * from users");

                   $user_result = $user_qry1->result();

                   $i=1;

                   foreach ($user_result as $value) 

                   {

                      //$ins = $this->push_notification_android1($device_id1,$message,$title);

                      



                      $user_id = $value->token;

                        $fields = array(

					        'app_id' => 'e072cc7b-595d-4c4c-a451-b07832b073f9',

					        'include_player_ids' => [$user_id],

					        'contents' => array("en" =>$message),

					        'headings' => array("en"=>$title),

							'android_channel_id' => 'ea6c19aa-e55f-4243-af28-605a32901234'

					    );

					    

					    $fields = json_encode($fields);

					    //print("\nJSON sent:\n");

					    //print($fields);



					    $ch = curl_init();

					    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

					    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

					        'Content-Type: application/json; charset=utf-8', 

					        'Authorization: Basic NzhjMmI5YjItZmViMy00YjNlLWFlMDItY2ZiZTI3OTY0YzYz'

					    ));

					    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

					    curl_setopt($ch, CURLOPT_HEADER, FALSE);

					    curl_setopt($ch, CURLOPT_POST, TRUE);

					    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

					    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

					                                           

					    $response = curl_exec($ch);

					    curl_close($ch);

					    

					    if($user_qry1->num_rows()==$i)

					    {

					    	$this->session->set_tempdata('success_message', 'Notification sent Successfully',3);

		                    redirect('admin/pushnotifications');

		                    die();

					    }



                        $i++;

                   }

                 

                    

               



        }

        else

        {

                $this->db->insert("promotion_notifications",array('select_user_type'=>$user_type,'title'=>$title,'description'=>$message,'user_id'=>$user_id));



                            $user_qry = $this->db->query("select * from users where id='".$user_id."'");

                            $user_row = $user_qry->row();



                            $device_id = $user_row->token;



                $ins = $this->push_notification_android($device_id,$message,$title);

                if ($ins) {

                    $this->session->set_tempdata('success_message', 'Notification sent Successfully',3);

                    redirect('admin/pushnotifications');

                    die();

                } else {

                   $this->session->set_tempdata('success_message', 'Notification sent Successfully',3);

                    redirect('admin/pushnotifications');

                    die();

                }

        }

        



        

    }



    function push_notification_android($device_id,$message,$title){

                        if($device_id!='')

                        {  

                         $user_id = $device_id; 

                        //$user_id="e01f3cce-cd1e-4426-98b0-2661a2582c63";

                        $fields = array(

	        'app_id' => '4b59783f-818b-45fd-8d62-0f23bc163a71',

	        'include_player_ids' => [$user_id],

	        'contents' => array("en" =>$message),

	        'headings' => array("en"=>$title),

			'android_channel_id' => 'b8be1c48-6ba0-44cd-ac04-447b526e5ee7'

	    );

	    

	    $fields = json_encode($fields);

	    //print("\nJSON sent:\n");

	    //print($fields);



	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

	        'Content-Type: application/json; charset=utf-8', 

	        'Authorization: Basic NzhjMmI5YjItZmViMy00YjNlLWFlMDItY2ZiZTI3OTY0YzYz'

	    ));

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	    curl_setopt($ch, CURLOPT_HEADER, FALSE);

	    curl_setopt($ch, CURLOPT_POST, TRUE);

	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	                                           

	    $response = curl_exec($ch);

	    curl_close($ch);

	    //print_r($response); die;

                    }

 

} 





function push_notification_android1($device_id,$message,$title){



                        if($device_id!='')

                        {  

                         

	    //print_r($response); die;

                    }

 

} 







}



