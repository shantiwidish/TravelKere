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

  public function index()
  {
    $this->checkPermission();
  }

  public function make_trip(){
    $this->checkPermission();
    $params = array('url'=>$this->config->item("travel_api"));
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
      $province = array_unique($province);
      $province_city[$value->province] = array_unique($province_city[$value->province]);
      $city_area[$value->city] = array_unique($city_area[$value->city]);
    }
    $this->data['page_subtitle'] = "make trip";
    $this->load->view('partial/header', $this->data);
    $content = array("content"=>"form_trip",
    "session_data"=>$this->get_session_data(),
    "side_search" => array("province"=>$province, "city"=>$province_city, "area" => $city_area));
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');
  }

  function search_destination($area){
    $params = array('url'=>$this->config->item("travel_api"));
    $this->load->library('travelapi', $params);
    $content = array("destinations"=>json_decode($this->travelapi->get_search_destinations($area)));
    echo $this->load->view('search_destination_form',$content, TRUE);
  }

  function create(){
      $this->load->model('Trip_model','trip');
      $data_trip = array(
        'destination_id' => $this->input->post('destination_id'),
        'title' => $this->input->post('title'),
        'description' => $this->input->post('description'),
        'meetup_at' => $this->input->post('meetup_at'),
        'start_at' => $this->input->post('start_at'),
        'end_at' => $this->input->post('end_at'),
        'budget' => $this->input->post('budget'),
        'quota' => $this->input->post('quota'),
        'isPublic'=> $this->input->post('visibility'),
        'created_at' => date('Y-m-d H:i:s'),
        'modified_at' => date('Y-m-d H:i:s'),
        'isActive' => 1
      );

      $filename =  $this->do_upload();
      if($filename){
        $data_trip['cover_image'] = $filename;
      }
      $data_group = array(
        'traveller_id' => $this->input->post('traveller_id'),
        'role' => 1,
        'numberOfParty' => $this->input->post('participate'),
        'created_at' => date('Y-m-d H:i:s'),
        'modified_at' => date('Y-m-d H:i:s')
      );
      $form_data = array($data_trip, $data_group);
      $result = $this->trip->add_trip($form_data,0);
      if($result){
        $data_api = array(
          'destination_id' => $this->input->post('destination_id'),
          'start_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('start_at'))->format('Y-m-d'),
          'end_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('end_at'))->format('Y-m-d'),
          'quantity' => $this->input->post('participate')
        );
        $params = array('url'=>$this->config->item("travel_api"));
        $this->load->library('travelapi', $params);
        $this->travelapi->booked_trip($data_api);
      }

      redirect('/');
  }

  function joinTrip(){
    $this->load->model('Trip_model','trip');
    $data_group = array(
      'trip_id' => $this->input->post('trip_id'),
      'traveller_id' => $this->input->post('traveller_id'),
      'role' => 0,
      'numberOfParty' => $this->input->post('participate'),
      'created_at' => date('Y-m-d H:i:s'),
      'modified_at' => date('Y-m-d H:i:s')
    );
    $form_data = array($data_trip, $data_group);
    $result = $this->trip->add_trip_group($form_data,0);
    if($result){
      $data_api = array(
        'destination_id' => $this->input->post('destination_id'),
        'start_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('start_at'))->format('Y-m-d'),
        'end_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('end_at'))->format('Y-m-d'),
        'quantity' => $this->input->post('participate')
      );
      $params = array('url'=>$this->config->item("travel_api"));
      $this->load->library('travelapi', $params);
      $this->travelapi->booked_trip($data_api);
    }

    redirect('/');
  }

}
