<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P2mi extends CI_Controller {

	public function index()
	{
		isLogin();
		$data = array('title' 		=> 'Halaman Utama P2MI',
					  'breadcrumb'	=> 'Halaman Utama',
					  'header'		=> 'Halaman Utama',
					  'fa'			=> 'fa-home',
					  'isi'			=> 'p2mi/beranda');
		$this->load->view('layout/wrapper', $data);
	}

}

/* End of file P2mi.php */
/* Location: ./application/controllers/P2mi.php */