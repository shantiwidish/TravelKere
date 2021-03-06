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
    $this->checkPermission();
  }

  public function edit_profile($id){
    $this->checkPermission();
    $this->load->model('User_model','user');
    $result = $this->user->get_traveller_by_id($id, TRUE);
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
    $content = array("content"=>"registration_form","session_data"=>NULL);
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');
  }

  public function doLogin(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->load->model('User_model','user');
    $enc_passw = $this->user->hidemypassword($password);
    $result = $this->user->authentication($username, $enc_passw);
          // var_dump($result);die();
    if(sizeof($result)>0){
      $user = $result[0];
      $admin = FALSE;
      $isAdmin  = $this->user->checkIfAdmin($user->id);
      // var_dump($isAdmin);die();
      if(sizeof($isAdmin)>0)
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
    $data_user = array(
      'username' => $this->input->post('username'),
      'fullname' => $this->input->post('fullname'),
      'email' => $this->input->post('email'),
      'created_at' => date('Y-m-d H:i:s'),
      'modified_at' => date('Y-m-d H:i:s'),
      'isActive' => 1
    );
    $data_additional = array(
      'phone_number' => $this->input->post('phone_number'),
      'address' => $this->input->post('address')
    );
    $result = $this->user->get_by_column(array("username","email"), $data_user);
    if(sizeof($result)>0){
      set_message_error("Username or Email already used!");
      redirect('/member/register');
    }
    if($this->input->post('password') == $this->input->post('re_password')){
      $data_user['password'] = $this->user->hidemypassword($this->input->post('password'));
    }else{
      set_message_error("Password not match!");
      redirect('/member/register');
    }

    $filename =  $this->do_upload();
    if($filename){
      $data_additional['image'] = $filename;
    }else{
      $data_additional['image'] = "default_user.jpg";
    }
    $form_data = array($data_user, $data_additional);
    $this->user->add_user($form_data,0);
    redirect('/');
  }

  public function edit(){
    $this->load->model('User_model','user');
    $form_data = array(
      'fullname' => $this->input->post('fullname'),
      'phone_number' => $this->input->post('phone_number'),
      'created_at' => date('Y-m-d H:i:s'),
      'address' => $this->input->post('address')
    );

    $filename =  $this->do_upload();
    if($filename!=NULL){
      $form_data['image'] = $filename;
    }else{
      $data_additional['image'] = "default_user.jpg";
    }
    $this->user->update_user($this->input->post('id'), $form_data);
    redirect('/admin/user/');
  }

  public function delete($id){
    $this->load->model('User_model', 'user');
    $this->user->delete_user($id, 0);
    redirect('/');
  }

  public function setInactive($id){
    $data_user = array(
      'isActive' => 1
    );
    $this->user->update_user($id, $data_user);
    redirect('/');
  }

  public function trip($id=NULL){
    $this->checkPermission();
    if($id == NULL){
      redirect('/');
    }
    $this->load->model('Trip_model','trip');
    $this->load->model('Trip_group_model','group');
    $this->data['page_subtitle'] = "Dashboard";
    $this->load->view('partial/header', $this->data);
    $trip_list = $this->trip->get_all_my_trip($id,  TRUE);
    // var_dump($trip_list);die();
    $trip_group_list = array();
    foreach ($trip_list as $key => $value) {
       $trip_group_list[$value["id"]]["member"] = $this->group->get_groups_by_trip($value["id"], TRUE);
       $participate = 0;
       $member = 0;
       foreach ($trip_group_list[$value["id"]]["member"] as $key => $trip_group) {
         $participate += $trip_group["numberOfParty"];
         $member +=1;
       }
       $trip_group_list[$value["id"]]["participate"] = $participate;
       $trip_group_list[$value["id"]]["count_member"] = $member;
    }
   //  var_dump($trip_group_list[3]);die();
    $data_trip = array("trip_list"=>$trip_list, "trip_group"=>$trip_group_list);
    $content = array("content"=>"my_trip","session_data"=>$this->get_session_data(),
               "data_trip"=>$data_trip);
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');
  }

}
