<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puskomsi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		if (!cekLevel($this->session->userdata('login')[0],1)) {
			show_404(base_url('error_404'),FALSE);
		}
		$this->load->model('puskomsi_model');
	}

	public function index()
	{
		$data = array('title' 		=> 'Halaman Utama Puskomsi',
					  'breadcrumb'	=> 'Halaman Utama',
					  'header'		=> 'Halaman Utama',
					  'fa'			=> 'fa-home',
					  'isi'			=> 'puskomsi/beranda');
		$this->load->view('layout/wrapper', $data);
	}

	public function buat_kuesioner()
	{
		if (!$this->input->post('tombol') == 'Simpan') {
			$data = array('title' 		=> 'Halaman Puskomsi - Buat Kuesioner',
					  'breadcrumb'	=> 'Kuesioner',
					  'header'		=> 'Buat Kuesioner',
					  'fa'			=> 'fa-bar-chart-o',
					  'isi'			=> 'puskomsi/buat_kuesioner',
					  'templates'	=> $this->puskomsi_model->getTemplate());
			$this->load->view('layout/wrapper', $data);
		}elseif ($this->input->post('tombol') == 'Simpan' ) {
			$data = array('id_template' 	=> $this->input->post('id_template'), 
						  'tanggal_mulai'	=> $this->input->post('tanggal_mulai'),
						  'tanggal_selesai'	=> $this->input->post('tanggal_selesai'));
			$this->puskomsi_model->buatKuesioner($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Kuesioner berhasil dibuat..
                    </div>');
			redirect(base_url('puskomsi/kuesioner'),'refresh');
		}
	}

	public function edit_kuesioner($id = null)
	{
		if (!$this->input->post('tombol') == 'Edit') {
			$data = array('title' 		=> 'Halaman Puskomsi - Edit Kuesioner',
						  'breadcrumb'	=> 'Kuesioner',
						  'header'		=> 'Edit Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'puskomsi/edit_kuesioner',
						  'templates'	=> $this->puskomsi_model->getTemplate(),
						  'kuesioner'		=> $this->puskomsi_model->getKuesioner($id)[0]);
			$this->load->view('layout/wrapper', $data);
		}elseif ($this->input->post('tombol') == 'Edit') {
			$id_kuesioner = $this->input->post('id_kuesioner');
			$id_template = $this->input->post('id_template');
			$tanggal_mulai = $this->input->post('tanggal_mulai');
			$tanggal_selesai = $this->input->post('tanggal_selesai');
			$data = array('id_kuesioner'	=> $id_kuesioner,
						  'id_template'		=> $id_template,
						  'tanggal_mulai'	=> $tanggal_mulai,
						  'tanggal_selesai'	=> $tanggal_selesai);
			$this->puskomsi_model->editKuesioner($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil diubah..
                    </div>');
			redirect(base_url('puskomsi/kuesioner'),'refresh');
		}
	}

	public function template_kuesioner()
	{

		$data = array('title' 		=> 'Halaman Puskomsi - Template Kuesioner',
					  'breadcrumb'	=> 'Template Kuesioner',
					  'header'		=> 'Data Template Kuesioner',
					  'fa'			=> 'fa-bar-chart-o',
					  'isi'			=> 'puskomsi/template_kuesioner',
					  'templates'	=> $this->puskomsi_model->fullTemplate());
		$this->load->view('layout/wrapper', $data); 
	}

	public function edit_template($id_template = null)
	{
		if (!$this->input->post('tombol') == 'Edit') {

			$data = array('title' 		=> 'Halaman Puskomsi - Edit Template Kuesioner',
						  'breadcrumb'	=> 'Template Kuesioner',
						  'header'		=> 'Edit Template Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'puskomsi/edit_template',
						  'templates'	=> $this->puskomsi_model->fullTemplate($id_template)[0],
						  'butirs'		=> $this->puskomsi_model->getButir());
			$this->load->view('layout/wrapper', $data);
		}elseif ($this->input->post('tombol') == 'Edit' ) {

			$id_template = $this->input->post('id_template');
			$nama_template = $this->input->post('nama');
			$butirs = $this->input->post('butir');
			$data = array('id_template'	=> $id_template,	
						  'nama'		=> $nama_template,
						  'butirs'		=> $butirs);
			$this->puskomsi_model->editTemplate($data);
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Berhasil !!</strong> Data berhasil diubah..
                    </div>');
			redirect(base_url('puskomsi/template_kuesioner'),'refresh');
		}
	}

	public function tambah_template()
	{
		if ($this->input->post('tombol') == 'Simpan') {
			$data = array('nama' => $this->input->post('nama'),
						  'butirs' => $this->input->post('butir'));
			$this->puskomsi_model->tambahTemplate($data);
			$this->session->set_flashdata('msg', '
						        <div class="alert alert-success">
						            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						            <strong>Berhasil !!</strong> Data berhasil disimpan.
						        </div>');
			redirect(base_url('puskomsi/template_kuesioner'),'refresh');
		}elseif (!$this->input->post('tombol') == 'Simpan') {
			$data = array('title' 		=> 'Halaman Puskomsi - Tambah Template Kuesioner',
						  'breadcrumb'	=> 'Template Kuesioner',
						  'header'		=> 'Tambah Template Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'puskomsi/tambah_template',
						  'butirs'		=> $this->puskomsi_model->getButir());
			$this->load->view('layout/wrapper', $data);
		}
	}

	public function kuesioner()
	{
		$data = array('title' 		=> 'Halaman Puskomsi - Kuesioner',
					  'breadcrumb'	=> 'Kuesioner',
					  'header'		=> 'Data Kuesioner',
					  'fa'			=> 'fa-bar-chart-o',
					  'isi'			=> 'puskomsi/kuesioner',
					  'kuesioners'	=> $this->puskomsi_model->getKuesioner());
		$this->load->view('layout/wrapper', $data);
	}
}

/* End of file Puskomsi.php */
/* Location: ./application/controllers/Puskomsi.php */