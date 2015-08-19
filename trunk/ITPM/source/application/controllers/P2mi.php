<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P2mi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
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
						  'isi'			=> 'p2mi/tambah_butir');
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = array('butir' => $this->input->post('butir'));
			$this->P2MI_model->tambah_butir($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil disimpan kedalam database.
                    </div>');
			redirect(base_url('p2mi/butir_kuesioner'),'refresh');
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
						  'butir'		=> $this->P2MI_model->getButir($id));
			$this->load->view('layout/wrapper', $data);
		}else{
			$data = array('butir' 		=> $this->input->post('butir'),
						  'id_butir'	=> $this->input->post('id_butir'));
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