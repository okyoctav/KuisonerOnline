<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index()
	{
		alreadyLogin();

		if ($this->input->post('tombol') != 'L O G I N') {
			$this->load->view('login');
		}else{
			$dataLogin = array('username' => $this->input->post('username'), 
						       'password' => $this->input->post('password'));

			$results = $this->Login_model->cekLogin($dataLogin);

			if (!empty($results['error'])) {
				$this->session->set_flashdata('msg', $results['error']);
				redirect(base_url('login'),'refresh');
			}else{
				$this->session->set_userdata('login',$results);
				alreadyLogin();
			}
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */