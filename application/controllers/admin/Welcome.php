<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	function __construct()
  {
		 parent::__construct();
	}
	public function index()
	{
		$data = array('page_title'=>'Dashboard', 'page_subtitle'=>'','page_breadcrumb'=>array('dashboard'));
		$content = array('content'=>"");
		$this->control_view($data, $content);
	}
}
