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

	public function get_session_data(){
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'fullname' => $this->session->userdata('fullname'),
			'username'  => $this->session->userdata('username'),
			'email'     => $this->session->userdata('email'),
			'is_admin' => $this->session->userdata('is_admin'),
			'profile_picture' => $this->session->userdata('profile_picture')
		);
		return $data;
	}

	public function checkPermission(){
		if(!$this->isLogin()){
		// 		redirect('/');
		// }
		// else {
			redirect('/member/form_login');
		}
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

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */
