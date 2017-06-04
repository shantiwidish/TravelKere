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
		$username = $this->session->userdata('username');
		if(isset($username) or $username != NULL){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function doLogin($username, $password){
		$this->load->model('User_model','user');
		$enc_passw = $this->user->hidemypassword($password);
		$result = $this->user->authentication($username, $enc_passw);
		if(sizeof($result)>0){
			$this->session->set_userdata('username', $result->username);
		}
	}

	public function doLogOut(){
		$this->session->unset_userdata('username');
	}

	public function control_view($data, $content){
		$this->load->view('partial/admin/header', $data);
		$this->load->view('partial/admin/body', $content);
		$this->load->view('partial/admin/footer.php');
	}
}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */
