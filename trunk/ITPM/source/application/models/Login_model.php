<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function cekLogin($data)
	{
		$this->db->select('*');
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));
		$query = $this->db->get('tlogin');
		$results = $query->result_array();
		$num_rows = $query->num_rows();

		if ($num_rows == 1) {
			if ($results[0]['status'] == 0) {
				return $msg = array('error' => '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Oops !!</strong> Akun anda diblokir, Silahkan hubungi Administrator.
                    </div>');
			}else{
				return $results;	
			}
		}else{
			return $msg = array('error' => '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Oops !!</strong> Kombinasi username atau password salah.
                    </div>');
		}
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */