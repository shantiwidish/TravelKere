<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function index()
	 {
		 $this->checkPermission();
		 $this->load->model('Trip_model','trip');
		 $this->load->model('Trip_group_model','group');
		 $this->data['page_subtitle'] = "Dashboard";
		 $this->load->view('partial/header', $this->data);
		 $trip_list = $this->trip->get_all(TRUE);
		 $trip_group_list = array();
		 foreach ($trip_list as $key => $value) {
				$trip_group_list[$value["id"]] = $this->group->get_groups_by_trip($value["id"], TRUE);
		 }

		 $content = array("content"=>"dashboard","session_data"=>$this->get_session_data());
		 $this->load->view('partial/body', $content);
		 $this->load->view('partial/footer.php');
	 }

}
