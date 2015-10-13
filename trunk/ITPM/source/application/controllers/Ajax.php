<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		$this->load->model('dosen_model');
		$this->load->model('prodi_model');
		$this->load->model('puskomsi_model');
	}

	public function index()
	{
		$this->load->view('404');
	}

	public function hasil_kuesioner()
	{
		$level = $this->input->post('level');
		switch ($level) {
			case 'dosen':
				if (!cekLevel($this->session->userdata('login')[0],3)) {
					show_404(base_url('error_404'),FALSE);
				}
				$id_dosen = $this->input->post('id_dosen');
				echo json_encode($this->dosen_model->ngetes('',$id_dosen,'',
						  												array('h.id_matkul, h.nama, f.id AS id_settings, COUNT(DISTINCT(b.npm)) AS responden'),'','',array('h.nama')));
				//echo '[{"id_matkul":"2","nama":"asd Arab","id_settings":"1","responden":"15"},{"id_matkul":"2","nama":"Bahasa asd","id_settings":"1","responden":"15"},{"id_matkul":"2","nama":"Bahasa Arab","id_settings":"1","responden":"15"},{"id_matkul":"2","nama":"Bahasa Arab","id_settings":"2","responden":"1"},{"id_matkul":"3","nama":"Bahasa Qolbu","id_settings":"2","responden":"10"}]';
			break;
			case 'prodi':
				if (!cekLevel($this->session->userdata('login')[0],4)) {
					show_404(base_url('error_404'),FALSE);
				}
				echo json_encode($this->prodi_model->ngetesLagi());
				//echo '[{"id_settings":"1","id_dosen":"1","id_matkul":"1","nama_dosen":"Hardi Jamhur","nama_matkul":"Research Methodd","tahap_belajar":"1","semester":"genap","thn_akademik":"2013\/2014","responden":"19"},{"id_settings":"1","id_dosen":"1","id_matkul":"1","nama_dosen":"Hardi Jamhur","nama_matkul":"Research Method","tahap_belajar":"1","semester":"genap","thn_akademik":"2013\/2014","responden":"19"}]';
			break;
			case 'p2mi':
				if (!cekLevel($this->session->userdata('login')[0],0)) {
					show_404(base_url('error_404'),FALSE);
				}
				echo json_encode($this->prodi_model->ngetesLagi());
				//echo '[{"id_settings":"1","id_dosen":"1","id_matkul":"1","nama_dosen":"Hardi Jamhur","nama_matkul":"Research Methodd","tahap_belajar":"1","semester":"genap","thn_akademik":"2013\/2014","responden":"101"},{"id_settings":"1","id_dosen":"1","id_matkul":"1","nama_dosen":"Hardi Jamhur","nama_matkul":"Research Method","tahap_belajar":"1","semester":"genap","thn_akademik":"2013\/2014","responden":"19"}]';
			break;
			
			default:
			$this->load->view('404');
			break;
		}
	}

	public function butir_kuesioner()
	{
		if (!cekLevel($this->session->userdata('login')[0],1)) {
			show_404(base_url('error_404'),FALSE);
		}
		$data['total_butir'] = $this->puskomsi_model->totalButir();
		echo json_encode($data);
		//echo '{"total_butir":2}';
	}

}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */