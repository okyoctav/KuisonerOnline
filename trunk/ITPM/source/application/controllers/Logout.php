<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('kuesioner_aktif');
		redirect(base_url('login'),'refresh');
	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */