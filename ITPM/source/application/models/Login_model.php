<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getKontrakMatkul($npm,$id_kontrak_matkul = null, $cekexpire)
	{

		$this->db->select('a.id AS id_kontrak_matkul, 
						   a.npm, 
						   c.nama AS nama_mahasiswa, 
						   c.jurusan, 
						   c.kelas,
						   a.id_matkul,
						   b.nama AS nama_matkul, 
						   d.nama AS nama_dosen,
						   g.tahap_belajar,
						   g.semester, 
						   g.thn_akademik,
						   a.isi_kuesioner, 
						   e.id_template, 
						   e.id_kuesioner, 
						   f.nama AS nama_kuesioner, 
						   e.tanggal_mulai, 
						   e.tanggal_selesai');
		$this->db->where('a.npm', $npm);
		if (!empty($id_kontrak_matkul)) {
			$this->db->where('a.id', $id_kontrak_matkul);
		}
		$this->db->where('a.isi_kuesioner', '0');
		$this->db->from('kontrak_matkul a, tkuesioner e, settings g');
		$this->db->join('dmatkul b', 'b.id_matkul = a.id_matkul');
		$this->db->join('dmahasiswa c', 'c.npm = a.npm');
		$this->db->join('ddosen d', 'd.id_dosen = a.id_dosen');
		$this->db->join('ttemplate f', 'e.id_template = f.id_template','left');
		$this->db->where('e.id_settings = g.id');
		$this->db->where('e.id_settings = a.id_settings');
		if ($cekexpire == false) {
			$this->db->where('e.tanggal_mulai < CURDATE()');
		}
		if($cekexpire == true){
			$this->db->where('e.tanggal_selesai < CURDATE()');
		}

		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

	public function cekLogin($data, $level = null)
	{
		$this->db->select('*');
		if (!empty($level)) {
			$this->db->where('level', $level);
		}
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));
		$query = $this->db->get('tlogin');
		$results = $query->result_array();
		$num_rows = $query->num_rows();

		if ($num_rows == 1) {
			if ($results[0]['status'] == 0) {
				$this->lastLogFail($data['username'],'fail');
				return $msg = array('error' => '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Oops !!</strong> Akun anda diblokir, Silahkan hubungi Administrator.
                    </div>');
			}else{
				$this->lastLogFail($data['username'],'lastlog');
				return $results;	
			}
		}else{
			$this->lastLogFail($data['username'],'fail');
			return $msg = array('error' => '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Oops !!</strong> Kombinasi username atau password salah.
                    </div>');
		}
	}

	public function lastLogFail($username,$cause)
	{	
		if ($cause == 'fail') {
			$this->db->set('counter_fail','counter_fail + 1',FALSE);
			$this->db->where('username', $username);
			$this->db->update('tlogin');
		}elseif ($cause == 'lastlog') {
			$this->db->set('last_login', 'CURRENT_TIMESTAMP', FALSE);
			$this->db->where('username', $username);
			$this->db->update('tlogin');
		}
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */