<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trip extends MY_Controller {
  private $data;

	function __construct()
  {
		 parent::__construct();
     $this->data = array('page_title'=>'Manage Trip',
          'page_subtitle'=>'',
          'page_breadcrumb'=>array('Trip'));
	}

  public function index()
	{
    $this->data['page_subtitle'] = "Trip List";
    $this->data['page_breadcrumb'][1] = 'list';
    $this->load->model('Trip_model','trip');
    $result = $this->trip->get_all(TRUE);
    $content = array('content'=>'admin/list_trip', 'form_data'=> $result);
		$this->control_view($this->data, $content);
	}

  public function closeTrip($id){
    $this->load->model('Trip_model', 'trip');
    $this->user->update_data($id, array('isActive'=>0));
    redirect('/admin/trip/');
  }
}
