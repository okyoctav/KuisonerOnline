<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		isLogin();
		if (!cekLevel($this->session->userdata('login')[0],2)) {
			show_404(base_url('error_404'),FALSE);
		}
		$this->load->model('mahasiswa_model');
		if (!empty($this->session->userdata('kuesioner_aktif')[0])) {
			if ( $this->uri->segment(2) == 'isi_kuesioner') {
				$this->isi_kuesioner($this->uri->segment(3));
			}else if ($this->uri->segment(2) == 'kuesioner') {
				$this->kuesioner();
			}else{
				show_404(base_url('error_404'),FALSE);
			}
		}
	}

	public function index()
	{
		$data = array('title' 		=> 'Halaman Utama Mahasiswa',
					  'breadcrumb'	=> 'Halaman Utama',
					  'header'		=> 'Halaman Utama',
					  'fa'			=> 'fa-home',
					  'isi'			=> 'mahasiswa/beranda');
		$this->load->view('layout/wrapper', $data);
	}

	public function jadwal_kuliah()
	{
		$data = array('title' 		=> 'Halaman Utama Mahasiswa - Jadwal Kuliah',
					  'breadcrumb'	=> 'Jadwal Kuliah',
					  'header'		=> 'Jadwal Kuliah',
					  'fa'			=> 'fa-clock-o',
					  'isi'			=> 'mahasiswa/jadwal_kuliah');
		$this->load->view('layout/wrapper', $data);
	}

	public function kuesioner()
	{
		$data = array('title' 		=> 'Halaman Utama Mahasiswa - Kuesioner',
					  'breadcrumb'	=> 'Kuesioner',
					  'header'		=> 'Data Kuesioner',
					  'fa'			=> 'fa-bar-chart-o',
					  'isi'			=> 'mahasiswa/kuesioner',
					  'kontrak_matkuls'	=> $this->mahasiswa_model->getKontrakMatkul($this->session->userdata('login')[0]['username']));
		$this->load->view('layout/wrapper', $data);
	}

	public function isi_kuesioner($id_kontrak_matkul = null)
	{	
		if ($this->mahasiswa_model->testing($id_kontrak_matkul,$this->session->userdata('login')[0]['username']) == false) {
			$this->load->view('404');
			return false;
		}
		if (!$this->input->post('tombol') == 'Simpan') {
			$data = array('title' 		=> 'Halaman Utama Mahasiswa - Isi Kuesioner',
						  'breadcrumb'	=> 'Kuesioner',
						  'header'		=> 'Isi Kuesioner',
						  'fa'			=> 'fa-bar-chart-o',
						  'isi'			=> 'mahasiswa/isi_kuesioner',
						  'kuesioners'	=> $this->mahasiswa_model->testing($id_kontrak_matkul,$this->session->userdata('login')[0]['username']),
						  'id_kontrak_matkul' => $id_kontrak_matkul);
			$this->load->view('layout/wrapper', $data);
		}elseif($this->input->post('tombol') == 'Simpan'){
			if ( $this->mahasiswa_model->testing($this->input->post('id_kontrak_matkul'),$this->session->userdata('login')[0]['username']) != false ) {
				$kuesioners = $this->mahasiswa_model->testing($this->input->post('id_kontrak_matkul'),$this->session->userdata('login')[0]['username']);
				$data['id_kontrak_matkul'] = $kuesioners['id_kontrak_matkul'];
				$data['id_kuesioner'] = $kuesioners['id_kuesioner'];
				$data['id_template'] = $kuesioners['id_template'];
				$data['id_settings'] = $kuesioners['id_settings'];
				$data['saran'] = htmlentities($this->input->post('saran'));
				foreach ($kuesioners['kuesioner'] as $template) {
					foreach ($template['kompetensi'] as $kompetensi) {
						foreach ($kompetensi['butir_kuesioner'] as $butirs) {
							if (!in_array($this->input->post('jawaban'.$butirs['id_butir']), array('1','2','3','4','5'))) {

								$this->session->set_flashdata('msg', '
					                    <div class="alert alert-danger">
					                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					                        <strong>Oppss !!</strong> Jawaban yang anda berika tidak valid !!!
					                    </div>');
								redirect(base_url('mahasiswa/kuesioner'),'refresh');

							}
							$butir_jawaban[] = array('id_butir'=> $butirs['id_butir'],
												     'jawaban' => $this->input->post('jawaban'.$butirs['id_butir']));
						}
						$kompetensi_butir[] = array('id_kompetensi' => $kompetensi['id_kompetensi'],
													'butir_jawab' => $butir_jawaban); 

						unset($butir_jawaban);
					}
					$data['hasil_kuesioner'] = $kompetensi_butir;
				}
			}
			$this->mahasiswa_model->submitJawaban($data);
			if (empty($this->mahasiswa_model->getKontrakMatkul($this->session->userdata('login')[0]['username'])[0])) {
				unset($_SESSION['kuesioner_aktif']);
			}
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Terimakasih !!</strong> Informasi yang Saudara berikan akan dipergunakan sebagai bahan masukan bagi dosen.
                    </div>');
			redirect(base_url('mahasiswa/kuesioner'),'refresh');
		}
	}

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */