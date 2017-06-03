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

  public function test(){
    $this->load->model('User_model','user');
    $form_data = array(
      'fullname' => "asdf",
      'email' => "asdf@123123.com",
      'username'=> "asdf"
    );
    $result = $this->user->get_by_column(array("email"), $form_data);
    print_r($result);die();

    $message =    $this->user->add_data($form_data);
    var_dump($message);
  }

  public function add(){
    $this->load->model('User_model','user');
    $form_data = array(
      'username' => $this->input->post('username'),
      'fullname' => $this->input->post('fullname'),
      'email' => $this->input->post('email')
    );
    $result = $this->user->get_by_column(array("username","email"), $form_data);
    if(sizeof($result)==0){
      set_message_error("Username or Email already used!");
      redirect('/admin/user/form');
    }
    if($this->input->post('password') == $this->input->post('re_password')){
      $form_data['password'] = $this->input->post('password');
    }else{
      set_message_error("Password not match!");
      redirect('/admin/user/form');
    }
    if($this->input->post('is_admin')!=NULL){
      $form_data['is_admin'] = 1;
    }else{
      $form_data['is_admin'] = 0;
    }
    $this->user->add_data($form_data);
    redirect('/admin/user/');
  }
}
