<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function isLogin(){
		// var_dump($_SESSION);die();
		$username = $this->session->userdata('username');
		if(isset($username) or $username != NULL){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function control_view($data, $content){
		$this->load->view('partial/admin/header', $data);
		$this->load->view('partial/admin/body', $content);
		$this->load->view('partial/admin/footer.php');
	}
}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */
