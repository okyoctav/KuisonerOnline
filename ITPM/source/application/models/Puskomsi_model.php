<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puskomsi_model extends CI_Model {

	public function getTemplate($id_template = null)
	{
		if (!empty($id_template)) {
			$this->db->where('id_template', $id_template);
		}
		$this->db->select('id_template, nama AS nama_template');
		$query = $this->db->get('ttemplate');
		return $query->result_array();
	}

	public function getKompetensiKuesioner($id = null)
	{
		if (!empty($id)) {
			$this->db->where('id_kompetensi', $id);
		}
		$this->db->select('*');
		$query = $this->db->get('tkompetensi');
		return $query->result_array();
	}

	public function getButir($id_butir = null, $id_kompetensi = null )
	{
		if (!empty($id_butir)) {
			$this->db->where('id_butir', $id_butir);
			$this->db->join('tbutir a', 'a.id_kompetensi = b.id_kompetensi');
			$query = $this->db->get('tkompetensi b');
			$data = $query->result_array();
		}else{
			$butirs = array();
			foreach ($this->getKompetensiKuesioner($id_kompetensi) as $kompetensi) {
				$this->db->select('*');
				$this->db->where('id_kompetensi', $kompetensi['id_kompetensi']);
				$query = $this->db->get('tbutir');
				$num_rows = $query->num_rows();
				if ($num_rows > 0) {
					foreach ($query->result_array() as $butir) {
						$butirs[] =  $butir;
					}
					$this->db->reset_query();
					$butirss = array('butir_kuesioner' => $butirs);
					$data[] = $kompetensi + $butirss;
				}else{
					$this->db->reset_query();
					$butirss = array('butir_kuesioner' => null);
					$data[] = $kompetensi + $butirss;
				}
				unset($butirss);
				unset($butirs);
			}
		}
		if (!empty($data)) {
			return $data;
		}else{
			return array();
		}
	}

	public function tButirTemplate($id_template)
	{
		$this->db->where('c.id_template', $id_template);
		$this->db->select('b.butir, a.id_butir, b.id_kompetensi');
		$this->db->from('tbutir_template a');
		$this->db->join('tbutir b', 'a.id_butir = b.id_butir');
		$this->db->join('ttemplate c', 'a.id_template = c.id_template');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function ambil_butir($id_butir = null)
	{
		$this->db->select('*');
		if (!empty($id_butir)) {
			$this->db->where('id_butir', $id_butir);
		}
		$query = $this->db->get('tbutir');
		return $query->result_array();
	}

	public function totalButir()
	{
		$this->db->select('*');
		$query = $this->db->get('tbutir');
		return $query->num_rows();
	}

	public function ambil_kompeten($id_kompetensi = null)
	{
		$this->db->select('*');
		if (!empty($id_kompetensi)) {
			$this->db->where('id_kompetensi', $id_kompetensi);
		}
		$query = $this->db->get('tkompetensi');
		return $query->result_array();
	}

	public function fullTemplate($id_template = null)
	{
		$data = array();
		foreach ($this->getTemplate($id_template) as $template) {
			foreach ($this->ambil_kompeten() as $kompetensi) {
				foreach ($this->tButirTemplate($template['id_template']) as $butir) {
					if ($kompetensi['id_kompetensi'] == $butir['id_kompetensi']) {
						$butirs[] = $butir;
					}
				}
				$kompeten_butir[] = $kompetensi + array('butir_kuesioner' => @$butirs);
				unset($butirs);
			}
			$data[] = $template + array('kompetensi' => $kompeten_butir);
			unset($kompeten_butir);
		}
		return $data;
	}

	public function editTemplate($data)
	{
		$this->db->where('id_template', $data['id_template']);
		$this->db->update('ttemplate', array('nama' => $data['nama']));

		$this->db->reset_query();

		$this->db->where('id_template', $data['id_template']);
		$this->db->delete('tbutir_template');

		$butirs = $data['butirs'];
		if (is_array($butirs)) {
			foreach ($butirs as $butir) {
				$this->db->insert('tbutir_template', array( 'id_template' => $data['id_template'],
															'id_butir'	  => $butir ));
			}
		}
	}

	public function getSettings()
	{
		$this->db->select('id AS id_settings, tahap_belajar, semester, thn_akademik');
		$this->db->where('aktif', '1');
		$query = $this->db->get('settings');
		return $query->result_array()[0];
	}

	public function tambahTemplate($data)
	{
		$this->db->insert('ttemplate', array('nama' => $data['nama']));
		$id_template = $this->db->insert_id();
		$butirs = $data['butirs'];
		if (is_array($butirs)) {
			foreach ($butirs as $butir) {
				$this->db->insert('tbutir_template', array( 'id_template' => $id_template,
															'id_butir'	  => $butir ));
			}
		}
	}

	public function editKuesioner($data)
	{	
		$this->db->select('*');
		$this->db->where('id_template', $data['id_template']);
		$cekButir = $this->db->get('tbutir_template')->num_rows();
		if (empty($cekButir)) {
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Gagal !!</strong> Kuesioner gagal dibuat.. <strong>Butir <a class="alert-link" href="'.base_url('puskomsi/edit_template/'.$data['id_template']).'">Template</a> Kosong</strong>.
                    </div>');
			redirect(base_url('puskomsi/kuesioner'),'refresh');
			return false;
		}
		$this->db->where('id_kuesioner', $data['id_kuesioner']);
		$this->db->update('tkuesioner', $data);
	}

	public function getKuesioner($id_kuesioner = null)
	{
		if ($id_kuesioner != null) {
			$this->db->where('id_kuesioner', $id_kuesioner);
		}
		$this->db->select('*');
		$this->db->from('tkuesioner a');
		$this->db->join('ttemplate b', 'a.id_template = b.id_template');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function buatKuesioner($data)
	{	
		$this->db->select('*');
		$this->db->where('id_template', $data['id_template']);
		$cekButir = $this->db->get('tbutir_template')->num_rows();
		if (empty($cekButir)) {
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Gagal !!</strong> Kuesioner gagal dibuat.. Butir <a class="alert-link" href="'.base_url('puskomsi/edit_template/'.$data['id_template']).'">Template</a> Kosong.
                    </div>');
			redirect(base_url('puskomsi/kuesioner'),'refresh');
			return false;
		}
		$settings = $this->getSettings();
		$this->db->where(array('id_settings' => $settings['id_settings']));

		$query = $this->db->get('tkuesioner');
		$num_rows = $query->num_rows();

		if ($num_rows == 0) {
			$this->db->reset_query();
			$data = $data + array('id_settings' => $settings['id_settings']);
			$this->db->insert('tkuesioner', $data);
		}else{
			$this->session->set_flashdata('msg', '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Gagal !!</strong> Kuesioner gagal dibuat.. Kuesioner <strong>Tahap: '.$settings['tahap_belajar'].', Semester: '.$settings['semester'].', Tahun Akademik: '.$settings['thn_akademik'].'</strong> Sudah dibuat.
                    </div>');
			redirect(base_url('puskomsi/kuesioner'),'refresh');
		}
	}

}

/* End of file puskomsi_model.php */
/* Location: ./application/models/puskomsi_model.php */