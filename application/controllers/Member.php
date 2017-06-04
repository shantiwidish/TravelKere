<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {
  private $data;

  function __construct()
  {
     parent::__construct();
     $this->data = array('page_title'=>'Home',
          'page_subtitle'=>'',
          'page_breadcrumb'=>array('User'));
  }

  public function index()
  {
    if($this->isLogin()){
      $this->data['page_subtitle'] = "Dashboard";
      $this->load->view('partial/header', $this->data);
      $content = array("content"=>"dashboard","session_data"=>$this->get_session_data());
      $this->load->view('partial/body', $content);
      $this->load->view('partial/footer.php');
    }
    else {
      redirect('/member/form_login');
    }
  }

  public function edit_profile($id){
    $this->load->model('User_model','user');
    $result = $this->user->get_by_id($id, TRUE);
    $form_data = $result[0];
    $this->data['page_subtitle'] = "Edit Profile";
    $this->load->view('partial/header', $this->data);
    $content = array("content"=>"edit_profile","session_data"=>$this->get_session_data(),
    "form_data"=>$form_data);
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');
  }

  public function form_login(){
    $this->load->view('partial/header', $this->data);
    $this->load->view('login');
    $this->load->view('partial/footer.php');
  }

  public function form_register(){
    $this->load->view('partial/header', $this->data);
    $this->load->view('register');
    $this->load->view('partial/footer.php');
  }

  public function doLogin(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->load->model('User_model','user');
    $enc_passw = $this->user->hidemypassword($password);
    $result = $this->user->authentication($username, $enc_passw);
    if(sizeof($result)>0){
      $user = $result[0];
      $admin = FALSE;
      if($user->is_admin == 1)
        $admin = TRUE;
      $newdata = array(
        'user_id' => $user->id,
        'fullname' => $user->fullname,
        'username'  => $user->username,
        'email'     => $user->email,
        'is_admin' => $admin,
        'profile_picture' => $user->image
      );
      $this->session->set_userdata($newdata);
    }
    redirect('/');
  }

  public function doLogOut(){
    $field = array('user_id','fullname','username','email','is_admin','profile_picture');
    $this->session->unset_userdata($field);
    redirect('/');
  }

  public function add(){
    $this->load->model('User_model','user');
    $form_data = array(
      'username' => $this->input->post('username'),
      'fullname' => $this->input->post('fullname'),
      'email' => $this->input->post('email')
    );
    $result = $this->user->get_by_column(array("username","email"), $form_data);
    if(sizeof($result)>0){
      set_message_error("Username or Email already used!");
      redirect('/member/register');
    }
    if($this->input->post('password') == $this->input->post('re_password')){
      $form_data['password'] = $this->user->hidemypassword($this->input->post('password'));
    }else{
      set_message_error("Password not match!");
      redirect('/member/register');
    }

    $filename =  $this->do_upload();
    if($filename){
      $form_data['image'] = $filename;
    }
    $this->user->add_data($form_data);
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
    $this->user->delete_data($id);
  }

  public function do_upload()
  {
          $config['upload_path']          = './assets/images/upload/';
          $config['allowed_types']        = 'gif|jpg|png';
          // $config['max_size']             = 100;
          // $config['max_width']            = 1024;
          // $config['max_height']           = 768;

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

}
