<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trip extends MY_Controller {
  private $data;

  function __construct()
  {
     parent::__construct();
     $this->data = array('page_title'=>'Home',
          'page_subtitle'=>'',
          'page_breadcrumb'=>array('User'));
  }

  public function make_trip(){
    $this->data['page_subtitle'] = "make trip";
    $this->load->view('partial/header', $this->data);
    $content = array("content"=>"form_trip","session_data"=>$this->get_session_data());
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');
  }

}
