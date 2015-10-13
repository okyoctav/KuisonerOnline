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
		alreadyLogin($this->session->userdata('login')[0]);

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
				if ($this->session->userdata('login')[0]['level'] == 2) {
					$kontrak_matkuls = $this->Login_model->getKontrakMatkul($this->session->userdata('login')[0]['username'],'',false);
					if (!empty($kontrak_matkuls)) {
						$this->session->set_userdata('kuesioner_aktif',$this->Login_model->getKontrakMatkul($this->session->userdata('login')[0]['username'],'',true));
						if (!empty($this->session->userdata('kuesioner_aktif')[0])) {
							$this->session->set_flashdata('msg', '
				                    <div class="alert alert-warning">
				                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                        <strong>Info: </strong> Batas waktu pengisian kuesioner telah habis, silahkan isi kuesioner agar menu dapat diakses kembali.
				                    </div>');
							redirect(base_url('mahasiswa/kuesioner'),'refresh');
						}
					}
				}
				alreadyLogin($this->session->userdata('login')[0]);
			}
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */