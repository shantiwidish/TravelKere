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
    $this->load->library('api', $params);
    $result = json_decode($this->api->get_locations());
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
    $this->load->library('api', $params);
    $content = array("destinations"=>json_decode($this->api->get_search_destinations($area)));
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
      $destination_id = $this->input->post('destination_id');
      // if($result){
        $data_api = array(
          'destination_id' => $destination_id,
          'start_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('start_at'))->format('Y-m-d'),
          'end_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('end_at'))->format('Y-m-d'),
          'quantity' => $this->input->post('participate')
        );
        $params = array('url'=>$this->config->item("travel_api"));
        if($destination_id>=6 && $destination_id<=20){
            $params = array('url'=>$this->config->item("travel_api_2"));
        }

        $this->load->library('api', $params);
        $this->api->booked_trip($data_api);
      // }

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
    $result = $this->trip->add_trip_group($data_group);
    $destination_id = $this->input->post('destination_id');
    // if($result){
      $data_api = array(
        'destination_id' => $destination_id,
        'start_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('start_at'))->format('Y-m-d'),
        'end_date' => DateTime::createFromFormat('Y-m-d H:i:s', $this->input->post('end_at'))->format('Y-m-d'),
        'quantity' => $this->input->post('participate')
      );
      $params = array('url'=>$this->config->item("travel_api"));
      if($destination_id>=6 && $destination_id<=20){
          $params = array('url'=>$this->config->item("travel_api_2"));
      }

      $this->load->library('api', $params);
      $this->api->booked_trip($data_api);
    // }

    redirect('/');
  }

  function cancelTrip(){
    $this->load->model('Trip_group_model','trip_group');
    $this->load->model('Trip_model','trip');
    $result = $this->trip_group->get_trip_group($this->input->post('trip_id'),$this->input->post('traveller_id'),TRUE);
    // var_dump($result[0]["role"]);die();
    if($result[0]["role"]==1){
      $data = array(
        "isActive"=>0
      );
      $this->trip->update_data($result[0]["trip_id"],$data);
    }else{
      $this->trip_group->cancel_trip($this->input->post('trip_id'),$this->input->post('traveller_id'));
    }
    $quantity = 0;
    if($result[0]["numberOfParty"]>0){
      $quantity = (int)$result[0]["numberOfParty"];
    }
    $destination_id = $this->input->post('destination_id');
    // if($result){
      $data_api = array(
      'destination_id' => $destination_id,
      'start_date' => DateTime::createFromFormat('Y-m-d H:i:s', $result[0]['start_at'])->format('Y-m-d'),
      'end_date' => DateTime::createFromFormat('Y-m-d H:i:s', $result[0]['end_at'])->format('Y-m-d'),
      'quantity' => $quantity * -1
    );
    $params = array('url'=>$this->config->item("travel_api"));
    if($destination_id>=6 && $destination_id<=20){
        $params = array('url'=>$this->config->item("travel_api_2"));
    }
    $this->load->library('api', $params);
    $this->api->booked_trip($data_api);
    redirect('/');
  }

  function searchTrip(){
    $this->checkPermission();
    $this->load->model('Trip_model','trip');
    $this->load->model('Trip_group_model','group');
    $this->data['page_subtitle'] = "Dashboard";
    $this->load->view('partial/header', $this->data);
    $area = str_replace(" ","%20",$this->input->get('area'));
    $destination_key = NULL;
    if($area){
      $params = array('url'=>$this->config->item("travel_api"));
      $this->load->library('api', $params);
      $destinations = json_decode($this->api->get_search_destinations($area));
      $destination_key = array();
      foreach ($destinations as $key => $value) {
        array_push($destination_key, $value->id);
      }
    }

    $trip_list = $this->trip->search_trip($destination_key,$this->input->get('budget'),$this->input->get('day'),TRUE);
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
    $data_trip = array("trip_list"=>$trip_list, "trip_group"=>$trip_group_list);

    $params = array('url'=>$this->config->item("travel_api"));
    $this->load->library('api', $params);
    $location_result = json_decode($this->api->get_locations());

    $content = array("content"=>"dashboard","session_data"=>$this->get_session_data(),
               "data_trip"=>$data_trip, "locations"=>$location_result);
    $this->load->view('partial/body', $content);
    $this->load->view('partial/footer.php');

  }

}
