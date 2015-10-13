<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

	
	public function getKuesioner($id_kuesioner = null,$data = null)
	{
		if (is_array($data)) {
			$this->db->where($data);
		}
		if ($id_kuesioner != null) {
			$this->db->where('a.id_kuesioner', $id_kuesioner);
		}
		$this->db->select('a.id_template, a.id_kuesioner, b.nama AS nama_kuesioner, a.tanggal_mulai, a.tanggal_selesai');
		$this->db->from('tkuesioner a');
		$this->db->join('ttemplate b', 'a.id_template = b.id_template');
		$query = $this->db->get();
		if (!$query->num_rows() == 0) {
			return $query->result_array()[0];
		}else{
			return null;
		}
		//echo $this->db->last_query();//
	}

	public function getKontrakMatkul($npm,$id_kontrak_matkul = null)
	{

		$this->db->select('a.id AS id_kontrak_matkul,
						   g.id AS id_settings, 
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
		$this->db->where('e.tanggal_mulai < CURDATE()');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function testing($id_kontrak_matkul = null, $npm)
	{
		$data = array();
		foreach ($this->getKontrakMatkul($npm, $id_kontrak_matkul) as $kontrak_matkul) {
			$fullTemplate = $this->fullTemplate($kontrak_matkul['id_template']);
		}
		if (empty($fullTemplate)) {
			return false;
		}else{
			return $data[] = $kontrak_matkul + array('kuesioner'=>$fullTemplate);
		}
	}

	public function submitJawaban($data)
	{
		foreach ($data['hasil_kuesioner'] as $hasil_kuesioner) {
			foreach ($hasil_kuesioner['butir_jawab'] as $butir_jawab) {
				$data_insert[] = array('id_kontrak_matkul' => $data['id_kontrak_matkul'], 
									   'id_template'	=> $data['id_template'],
									 'id_kuesioner' => $data['id_kuesioner'],
									 'id_kompetensi' => $hasil_kuesioner['id_kompetensi'],
									 'id_butir' => $butir_jawab['id_butir'],
									 'jawaban' => $butir_jawab['jawaban']);
			}
		}
		$this->db->insert_batch('fjawaban', $data_insert);
		$this->db->reset_query();
		$this->db->insert('tbl_saran', array('id_kontrak_matkul' => $data['id_kontrak_matkul'],'id_settings' => $data['id_settings'], 'saran' => $data['saran']));
		$this->db->reset_query();
		$this->db->where('id ='.$data['id_kontrak_matkul']);
		$this->db->update('kontrak_matkul', array('isi_kuesioner'=> '1'));
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

	public function getTemplate($id_template = null)
	{
		if (!empty($id_template)) {
			$this->db->where('id_template', $id_template);
		}
		$this->db->select('id_template, nama AS nama_template');
		$query = $this->db->get('ttemplate');
		return $query->result_array();
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
				if (!empty($butirs)) {
					$kompeten_butir[] = $kompetensi + array('butir_kuesioner' => $butirs);
					unset($butirs);
				}
			}
			$data[] = $template + array('kompetensi' => $kompeten_butir);
		}
		return $data;
	}

}

/* End of file Mahasiswa_model.php */
/* Location: ./application/models/Mahasiswa_model.php */