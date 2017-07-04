<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
  private $data;

	function __construct()
  {
		 parent::__construct();
     $this->data = array('page_title'=>'User Administration',
          'page_subtitle'=>'',
          'page_breadcrumb'=>array('User'));
	}

  public function index()
	{
    $this->data['page_subtitle'] = "User List";
    $this->data['page_breadcrumb'][1] = 'list';
    $this->load->model('User_model','user');
    $result = $this->user->get_all(TRUE);
    $content = array('content'=>'admin/list_user', 'form_data'=> $result);
		$this->control_view($this->data, $content);
	}

  public function form($id=NULL){
    $this->data['page_subtitle'] = "User Form";
    $this->data['page_breadcrumb'][1] = 'Add';
    $content = array('content'=>'admin/add_user');
    if($id != NULL){
      $this->data['page_breadcrumb'][1] = 'Edit';
      $this->load->model('User_model','user');
      $result = $this->user->get_by_id($id, TRUE);
      $form_data = $result[0];
      $content = array('content'=>'admin/edit_user',
                'form_data'=>$form_data);
    }

    $this->control_view($this->data, $content);
  }

  public function add(){
    $this->load->model('User_model','user');
    $this->load->model('Admin_model','admin');
    $form_data = array(
      'username' => $this->input->post('username'),
      'fullname' => $this->input->post('fullname'),
      'email' => $this->input->post('email')
    );
    $result = $this->user->get_by_column(array("username","email"), $form_data);
    if(sizeof($result)>0){
      set_message_error("Username or Email already used!");
      redirect('/admin/user/form');
    }
    if($this->input->post('password') == $this->input->post('re_password')){
      $form_data['password'] = $this->user->hidemypassword($this->input->post('password'));
    }else{
      set_message_error("Password not match!");
      redirect('/admin/user/form');
    }
    if($this->input->post('isActive')!=NULL){
      $form_data['isActive'] = 1;
    }else{
      $form_data['isActive'] = 0;
    }
    // $filename =  $this->do_upload();
    // if($filename){
    //   $form_data['image'] = $filename;
    // }
    $user_id = $this->user->add_data($form_data);
    $admin_data = array("user_id"=>$user_id,
    'created_at' => date('Y-m-d H:i:s'),
    'modified_at' => date('Y-m-d H:i:s'));
    $this->admin->add_data($admin_data);
    redirect('/admin/user/');
  }

  public function edit(){
    $this->load->model('User_model','user');
    $form_data = array(
      'fullname' => $this->input->post('fullname')
    );

    $filename =  $this->do_upload();
    if($filename!=NULL){
      $form_data['image'] = $filename;
    }
    $this->user->update_data($this->input->post('id'), $form_data);
    redirect('/admin/user/');
  }

  public function delete($id){
    $this->load->model('User_model', 'user');
    $this->user->update_data($id, array('isActive'=>0));
    redirect('/admin/user/');
  }

  public function do_upload()
  {
          $config['upload_path']          = './assets/images/upload/';
          $config['allowed_types']        = 'gif|jpg|png';

          $this->load->library('upload', $config);
          if ( ! $this->upload->do_upload('image'))
          {
                  $error = array('error' => $this->upload->display_errors());
          }
          else
          {
                  $data = array('upload_data' => $this->upload->data());
                  // var_dump($data['upload_data']['file_name']);die();
                  return $data['upload_data']['file_name'];
          }
  }

  //Test Function Email not working
  public function sendEmail(){
    $this->load->helper('mailin');
    $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'xVBkG3Jthc5m6EvZ', 5000);    //Optional parameter: Timeout in MS
    var_dump($mailin->get_account());
    $data = array( "to" => array("bobbisenatarachman@gmail.com"=>"Bobbi Senata Rachman"),
            "from" => array("travelkere.info@gmail.com", "Travel Kere"),
            "subject" => "My subject",
            "html" => "This is the <h1>HTML</h1>"
      );

    var_dump($mailin->send_email($data));die();

    // $this->load->library('email');
    //
    // $this->email->from('travelkere.info@gmail.com', 'Travel Kere');
    // $this->email->to('bobbi.senata@gmail.com');
    // $this->email->cc('shantiwidiyawati@gmail.com');
    //
    // $this->email->subject('Email Test');
    // $this->email->message('Testing the email class.');
    // var_dump($this->email->send());
    // $this->email->print_debugger();die();
  }
}
