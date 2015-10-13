<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		$this->load->model('P2MI_model');
	}

	public function index()
	{
		redirect(base_url('404'),'refresh');
	}

}

/* End of file Kuesioner.php */
/* Location: ./application/controllers/Kuesioner.php */