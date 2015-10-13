<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P2mi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		if (!cekLevel($this->session->userdata('login')[0],0)) {
			show_404(base_url('error_404'),FALSE);
		}
		$this->load->model('P2MI_model');
	}

	public function index()
	{
		$data = array('title' 		=> 'Halaman Utama P2MI',
					  'breadcrumb'	=> 'Halaman Utama',
					  'header'		=> 'Halaman Utama',
					  'fa'			=> 'fa-home',
					  'isi'			=> 'p2mi/beranda');
		$this->load->view('layout/wrapper', $data);
	}

	public function butir_kuesioner()
	{
		$data = array('title' 		=> 'Halaman Utama P2MI - Butir Kuesioner',
					  'breadcrumb'	=> 'Butir Kuesioner',
					  'header'		=> 'Butir Kuesioner',
					  'fa'			=> 'fa-bar-chart-o',
					  'isi'			=> 'p2mi/butir_kuesioner',
					  'butirs'		=> $this->P2MI_model->getButir());
		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_butir()
	{
		if (!$this->input->post('tombol') == 'Simpan') {
			$data = array('title' 		=> 'Halaman Utama P2MI - Tambah Butir Kuesioner',
						  'breadcrumb'	=> 'Tambah Butir Kuesioner',
						  'header'		=> 'Tambah Butir Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'p2mi/tambah_butir',
						  'kompetensi_kuesioners' => $this->P2MI_model->getKompetensiKuesioner() );
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = array('butir' => $this->input->post('butir'),
						  'id_kompetensi' => $this->input->post('id_kompetensi'));
			$this->P2MI_model->tambah_butir($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil disimpan kedalam database.
                    </div>');
			redirect(base_url('p2mi/butir_kuesioner'),'refresh');
		}
	}

	public function kompetensi_kuesioner()
	{
		$data = array('title' 		=> 'Halaman Utama P2MI - Kompetensi Kuesioner',
					  'breadcrumb'	=> 'Kompetensi Kuesioner',
					  'header'		=> 'Data Kompetensi Kuesioner',
					  'fa'			=> 'fa-bar-chart-o',
					  'isi'			=> 'p2mi/kompetensi_kuesioner',
					  'kompetensi_kuesioners'		=> $this->P2MI_model->getKompetensiKuesioner());
		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_kompetensi()
	{
		if (!$this->input->post('tombol') == 'Simpan') {
			$data = array('title' 		=> 'Halaman Utama P2MI - Tambah Kompetensi Kuesioner',
						  'breadcrumb'	=> 'Tambah Kompetensi Kuesioner',
						  'header'		=> 'Tambah Kompetensi Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'p2mi/tambah_kompetensi');
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = array('nama_kompetensi' => $this->input->post('kompetensi'));
			$this->P2MI_model->tambahKompetensi($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil disimpan kedalam database.
                    </div>');
			redirect(base_url('p2mi/kompetensi_kuesioner'),'refresh');
		}
	}

	public function edit_kompetensi($id = null)
	{
		if (!$this->input->post('tombol') == 'Edit') {
			$data = array('title' 		=> 'Halaman Utama P2MI - Edit Kompetensi Kuesioner',
						  'breadcrumb'	=> 'Kompetensi Kuesioner',
						  'header'		=> 'Edit Kompetensi Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'p2mi/edit_kompetensi',
						  'kompetensi'		=> $this->P2MI_model->getKompetensiKuesioner($id));
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = array('nama_kompetensi'	=> $this->input->post('kompetensi'),
						  'id_kompetensi'	=> $this->input->post('id_kompetensi'));
			$this->P2MI_model->editKompetensi($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil diedit.
                    </div>');
			redirect(base_url('p2mi/kompetensi_kuesioner'),'refresh');
		}
	}

	public function hasil_kuesioner($id_settings = null, $id_matkul = null, $id_dosen = null)
	{
		if (empty($id_settings)) {
			$data = array('title' 		=> 'Halaman Utama P2MI - Hasil Kuesioner',
						  'breadcrumb'	=> 'Hasil Kuesioner',
						  'header'		=> 'Data Hasil Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'p2mi/hasil_kuesioner',
						  'settings'	=> $this->P2MI_model->getSetting());
			$this->load->view('layout/wrapper', $data);
		}elseif ($id_dosen != null && $id_matkul != null) {
			$data = $this->P2MI_model->ngetes($id_matkul, $id_dosen, $id_settings, array('i.npm'));
			if (!empty($data)) {
				$data = array('title' 		=> 'Halaman Utama P2MI - Hasil Kuesioner',
							  'breadcrumb'	=> 'Hasil Kuesioner',
							  'header'		=> 'Data Hasil Kuesioner',
							  'fa'			=> 'fa-bar-chart-o',
							  'isi'			=> 'p2mi/show_chart_dosen',
							  'dosen'		=> $this->P2MI_model->getDosen($id_settings, $id_matkul, $id_dosen),
							  'total_responden'	=> $this->P2MI_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(i.npm)')),
							  'nama_kuesioner'	=> $this->P2MI_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(e.nama), e.id_template')),
							  'kompetensi'		=> $this->P2MI_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('DISTINCT(j.nama_kompetensi), j.id_kompetensi')),
							  'butir'			=> $this->P2MI_model->ngetes($id_matkul,$id_dosen, $id_settings,
							  													  array('j.id_kompetensi,j.nama_kompetensi,c.butir'),'',true),
							  'sarans'			=> $this->P2MI_model->getSaran($id_matkul,$id_dosen, $id_settings, array('e.saran'))
							  );
				$this->load->view('layout/wrapper', $data);
			}else{
				$this->load->view('404');
				return false;
			}
		}else if(!empty($id_settings)){
			$data = array('title' 		=> 'Halaman Utama P2MI - Hasil Kuesioner',
						  'breadcrumb'	=> 'Hasil Kuesioner',
						  'header'		=> 'Data Hasil Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'p2mi/show_chart',
						  'kuesioners'	=> $this->P2MI_model->getKuesioner($id_settings),
						  'dosens'		=> $this->P2MI_model->getDosen($id_settings));
			$this->load->view('layout/wrapper', $data);
		}
	}

	public function edit_butir($id 	= null)
	{
		if (!$this->input->post('tombol') == 'Edit') {
			$data = array('title' 		=> 'Halaman Utama P2MI - Edit Butir Kuesioner',
						  'breadcrumb'	=> 'Edit Butir Kuesioner',
						  'header'		=> 'Edit Butir Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'p2mi/edit_butir',
						  'butir'		=> $this->P2MI_model->getButir($id),
						  'kompetensis'	=> $this->P2MI_model->getKompetensiKuesioner());
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = array('butir' 		=> $this->input->post('butir'),
						  'id_butir'	=> $this->input->post('id_butir'),
						  'id_kompetensi' => $this->input->post('id_kompetensi'));
			$this->P2MI_model->edit_butir($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil diedit.
                    </div>');
			redirect(base_url('p2mi/butir_kuesioner'),'refresh');
		}
	}

}

/* End of file P2mi.php */
/* Location: ./application/controllers/P2mi.php */