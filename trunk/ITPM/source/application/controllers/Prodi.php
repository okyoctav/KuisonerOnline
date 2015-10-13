<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		if (!cekLevel($this->session->userdata('login')[0],4)) {
			show_404(base_url('error_404'),FALSE);
		}
		$this->load->model('prodi_model');
	}

	public function index()
	{
		$data = array('title' 		=> 'Halaman Utama Program Study - Beranda',
					  'breadcrumb'	=> 'Halaman Utama',
					  'header'		=> 'Halaman Utama',
					  'fa'			=> 'fa-home',
					  'isi'			=> 'prodi/beranda');
		$this->load->view('layout/wrapper', $data);
	}

	public function hasil_kuesioner($id_settings = null, $id_matkul = null, $id_dosen = null)
	{
		if (empty($id_settings)) {
			$data = array('title' 		=> 'Halaman Utama Program Study - Hasil Kuesioner',
						  'breadcrumb'	=> 'Hasil Kuesioner',
						  'header'		=> 'Data Hasil Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'prodi/hasil_kuesioner',
						  'settings'	=> $this->prodi_model->getSetting());
			$this->load->view('layout/wrapper', $data);
		}elseif ($id_dosen != null && $id_matkul != null) {
			$data = $this->prodi_model->ngetes($id_matkul, $id_dosen, $id_settings, array('i.npm'));
			if (!empty($data)) {
				$data = array('title' 		=> 'Halaman Utama Program Study - Hasil Kuesioner',
							  'breadcrumb'	=> 'Hasil Kuesioner',
							  'header'		=> 'Data Hasil Kuesioner',
							  'fa'			=> 'fa-bar-chart-o',
							  'isi'			=> 'prodi/show_chart_dosen',
							  'dosen'		=> $this->prodi_model->getDosen($id_settings, $id_matkul, $id_dosen),
							  'total_responden'	=> $this->prodi_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(i.npm)')),
							  'nama_kuesioner'	=> $this->prodi_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(e.nama), e.id_template')),
							  'kompetensi'		=> $this->prodi_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(j.nama_kompetensi), j.id_kompetensi')),
							  'butir'			=> $this->prodi_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('j.id_kompetensi,j.nama_kompetensi,c.butir'),'',true),
							  'sarans'			=> $this->prodi_model->getSaran($id_matkul,$id_dosen, $id_settings, array('e.saran'))
							  );
				$this->load->view('layout/wrapper', $data);
			}else{
				$this->load->view('404');
				return false;
			}
		}else if(!empty($id_settings)){
			$data = array('title' 		=> 'Halaman Utama Program Study - Hasil Kuesioner',
						  'breadcrumb'	=> 'Hasil Kuesioner',
						  'header'		=> 'Data Hasil Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'prodi/show_chart',
						  'kuesioners'	=> $this->prodi_model->getKuesioner($id_settings),
						  'dosens'		=> $this->prodi_model->getDosen($id_settings));
			$this->load->view('layout/wrapper', $data);
		}
	}

}

/* End of file Program_study.php */
/* Location: ./application/controllers/Program_study.php */