<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		if (!cekLevel($this->session->userdata('login')[0],3)) {
			show_404(base_url('error_404'),FALSE);
		}
		$this->load->model('dosen_model');
	}

	public function index()
	{
		$data = array('title' 		=> 'Halaman Utama Dosen',
					  'breadcrumb'	=> 'Halaman Utama',
					  'header'		=> 'Halaman Utama',
					  'fa'			=> 'fa-home',
					  'isi'			=> 'dosen/beranda');
		$this->load->view('layout/wrapper', $data);
	}

	public function kotak_saran($id_matkul = null, $id_settings = null)
	{
		if (empty($id_matkul) or empty($id_settings)) {
			$this->load->view('404');
			return false;
		}
		$id_dosen = $this->session->userdata('login')[0]['real_id'];
		$saran = $this->dosen_model->getSaran($id_matkul,$id_dosen, $id_settings, array('e.saran'));
		if (!empty($saran)) {
			$data = array('title' 		=> 'Halaman Utama Dosen - Kotak Saran',
						  'breadcrumb'	=> 'Hasil Kuesioner',
						  'header'		=> 'Kotak Saran',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'dosen/kotak_saran',
						  'saran'		=> $saran);
			$this->load->view('layout/wrapper', $data);
		}else{
			$this->load->view('404');
		}
	}

	public function hasil_kuesioner($id_matkul = null, $id_settings = null)
	{
		$id_dosen = $this->session->userdata('login')[0]['real_id'];
		if (empty($id_matkul)) {
			$data = array('title' 		=> 'Halaman Utama Dosen - Hasil Kuesioner',
						  'breadcrumb'	=> 'Hasil Kuesioner',
						  'header'		=> 'Data Hasil Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'dosen/hasil_kuesioner',
						  'ngehek'		=> $this->dosen_model->ngetes('',$id_dosen,'',
						  												array('h.id_matkul, h.nama, f.id AS id_settings, f.tahap_belajar, f.semester, f.thn_akademik')));
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = $this->dosen_model->ngetes($id_matkul, $id_dosen, $id_settings, array('i.npm'));
			if (!empty($data)) {
				$id_dosen = $this->session->userdata('login')[0]['real_id'];
				$data = array('title' 		=> 'Halaman Utama Dosen - Hasil Kuesioner',
							  'breadcrumb'	=> 'Hasil Kuesioner',
							  'header'		=> 'Data Hasil Kuesioner',
							  'fa'			=> 'fa-bar-chart-o',
							  'isi'			=> 'dosen/show_chart',
							  'dosen'		=> $this->dosen_model->getDosen($id_settings, $id_matkul, $id_dosen),
							  'total_responden'	=> $this->dosen_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(i.npm)')),
							  'nama_kuesioner'	=> $this->dosen_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(e.nama), e.id_template')),
							  'kompetensi'		=> $this->dosen_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(j.nama_kompetensi), j.id_kompetensi')),
							  'butir'			=> $this->dosen_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('j.id_kompetensi,j.nama_kompetensi,c.butir'),'',true),
							  'sarans'			=> $this->dosen_model->getSaran($id_matkul,$id_dosen, $id_settings, array('e.saran'))
							  );
				$this->load->view('layout/wrapper', $data);
			}else{
				$this->load->view('404');
				return false;
			}
		}
	}

}

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */