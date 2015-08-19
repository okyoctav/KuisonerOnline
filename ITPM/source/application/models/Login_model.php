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