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
    $params = array('url'=>"http://localhost/TravelServices");
    $this->load->library('travelapi', $params);
    $result = json_decode($this->travelapi->get_locations());
    $province = array();
    $province_city = array();
    $city_area = array();
    foreach ($result as $key => $value) {
      array_push($province,$value->province);
      if(isset($province_city[$value->province])){
        array_push($province_city[$value->province],$value->city);
      }else{
        $province_city[$value->province] = array($value->city);
      }
      if(isset($city_area[$value->city])){
        array_push($city_area[$value->city],$value->area);
      }else{
        $city_area[$value->city] = array($value->area);
      }
      array_unique($province);
      array_unique($province_city[$value->province]);
      array_unique($city_area[$value->city]);
    }
    $this->data['page_subtitle'] = "make trip";
    $this->load->view('partial/header', $this->data);
    $content = array("content"=>"form_trip",
    "session_data"=>$this->get_session_data(),
    "side_search" => array("province"=>$province, "city"=>$province_city, "area" => $city_area));
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');
  }

}
