<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P2MI_model extends CI_Model {
	
	public function ngetes($id_matkul = null, $id_dosen = null, $id_settings = null, $select = null, $where = null, $sum = false)
	{
		$this->db->select($select, FALSE);
		if (!empty($where)) {
			$this->db->where($where);
		}
		if ($sum == true) {
			$this->db->select("SUM(IF(a.jawaban = '1',1,0)) AS jawab1, 
							   SUM(IF(a.jawaban = '1',1,0)) / COUNT(DISTINCT(i.npm)) * 100 AS presentase1,
							   SUM(IF(a.jawaban = '1',1,0)) * 1 AS skala_likert1",FALSE);
			$this->db->select("SUM(IF(a.jawaban = '2',1,0)) AS jawab2, 
							   SUM(IF(a.jawaban = '2',1,0)) / COUNT(DISTINCT(i.npm)) * 100 AS presentase2,
							   SUM(IF(a.jawaban = '2',1,0)) * 2 AS skala_likert2",FALSE);
			$this->db->select("SUM(IF(a.jawaban = '3',1,0)) AS jawab3,
							   SUM(IF(a.jawaban = '3',1,0)) / COUNT(DISTINCT(i.npm)) * 100 AS presentase3,
							   SUM(IF(a.jawaban = '3',1,0)) * 3 AS skala_likert3",FALSE);
			$this->db->select("SUM(IF(a.jawaban = '4',1,0)) AS jawab4,
							   SUM(IF(a.jawaban = '4',1,0)) / COUNT(DISTINCT(i.npm)) * 100 AS presentase4,
							   SUM(IF(a.jawaban = '4',1,0)) * 4 AS skala_likert4",FALSE);
			$this->db->select("SUM(IF(a.jawaban = '5',1,0)) AS jawab5,
							   SUM(IF(a.jawaban = '5',1,0)) / COUNT(DISTINCT(i.npm)) * 100 AS presentase5,
							   SUM(IF(a.jawaban = '5',1,0)) * 5 AS skala_likert5",FALSE);
		}
		//fjawaban a
		$this->db->where('a.id_kontrak_matkul = b.id');
		$this->db->where('a.id_butir = c.id_butir');
		$this->db->where('a.id_kuesioner = d.id_kuesioner');
		$this->db->where('a.id_template = e.id_template');
		$this->db->where('a.id_kompetensi = j.id_kompetensi');
		//kontrak_matkul b
		if (!empty($id_matkul)) {
			$this->db->where('b.id_matkul', $id_matkul);
		}else{
			$this->db->where('d.tanggal_mulai <= CURDATE()');
			$this->db->group_by('f.id');
			$this->db->group_by('h.id_matkul');
		}
		$this->db->where('b.id_dosen', $id_dosen);
		$this->db->where('b.id_settings = f.id');
		if (!empty($id_settings)) {
			$this->db->where('f.id', $id_settings);
		}
		$this->db->where('b.id_dosen = g.id_dosen');
		$this->db->where('b.id_matkul = h.id_matkul');
		$this->db->where('b.npm = i.npm');
		if ($sum == true) {
			$this->db->group_by('a.id_butir');
		}
		$this->db->from('fjawaban a, 
						kontrak_matkul b, 
						tbutir c, 
						tkuesioner d, 
						ttemplate e, 
						settings f, 
						ddosen g, 
						dmatkul h,
						dmahasiswa i,
						tkompetensi j');

		$query = $this->db->get();
		//echo $this->db->last_query().'<br><br><br>';
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function getSaran($id_matkul = null,$id_dosen = null, $id_settings = null , $select = null)
	{
		$this->db->select($select);
		$this->db->from('kontrak_matkul a');
		$this->db->where('a.id_matkul', $id_matkul);
		$this->db->where('a.id_dosen', $id_dosen);
		if (!empty($id_settings)) {
			$this->db->where('d.id', $id_settings);
		}
		$this->db->where('a.id_settings = e.id_settings');
		$this->db->join('dmatkul b', 'a.id_matkul = b.id_matkul');
		$this->db->join('ddosen c', 'a.id_dosen = c.id_dosen');
		$this->db->join('settings d', 'a.id_settings = d.id');
		$this->db->join('tbl_saran e', 'e.id_kontrak_matkul = a.id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function getDosen($id_settings, $id_matkul = null, $id_dosen = null)
	{
		$this->db->select('a.id_matkul, 
						   a.id_dosen, 
						   a.id_settings, 
						   c.nama AS nama_dosen, 
						   d.nama AS nama_matkul,
						   b.tahap_belajar,
						   b.semester,
						   b.thn_akademik');
		$this->db->from('kontrak_matkul a');
		$this->db->where('a.id_settings', $id_settings);
		$this->db->where('a.isi_kuesioner', '1');
		if (!empty($id_matkul)) {
			$this->db->where('a.id_matkul', $id_matkul);
		}
		if (!empty($id_dosen)) {
			$this->db->where('a.id_dosen', $id_dosen);
		}
		$this->db->join('settings b', 'b.id = a.id_settings');
		$this->db->join('ddosen  c', 'c.id_dosen = a.id_dosen');
		$this->db->join('dmatkul d', 'd.id_matkul = a.id_matkul');
		$this->db->group_by('d.nama');
		$this->db->group_by('c.nama');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function getSetting()
	{
		$this->db->select('*');
		$query = $this->db->get('settings');
		return $query->result_array();
	}

	public function getKuesioner($id_setting)
	{
		$this->db->select('a.*, e.nama_kompetensi');
		$this->db->select("SUM(IF(c.jawaban = '1',1,0)) * 1 AS skala_likert1",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '2',1,0)) * 2 AS skala_likert2",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '3',1,0)) * 3 AS skala_likert3",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '4',1,0)) * 4 AS skala_likert4",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '5',1,0)) * 5 AS skala_likert5",FALSE);
		$this->db->select("SUM(c.jawaban) AS total_likert_per_kompetensi",FALSE);
		$this->db->from('settings a');
		$this->db->where('a.id', $id_setting);
		$this->db->join('kontrak_matkul b', 'b.id_settings = a.id');
		$this->db->join('fjawaban c', 'c.id_kontrak_matkul = b.id');
		$this->db->join('tbutir d', 'd.id_butir = c.id_butir');
		$this->db->join('tkompetensi e', 'e.id_kompetensi = c.id_kompetensi');
		$this->db->group_by('e.nama_kompetensi');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return array();
		}
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
		if (empty($data)) {
			return array();
		}else{
			return $data;
		}
	}

	public function tambah_butir($data)
	{
		$this->db->set('`created`','NOW()',FALSE);
		if (is_array($data['butir'])) {
			foreach ($data['butir'] as $butir) {
				$this->db->insert('tbutir', array('id_kompetensi' => $data['id_kompetensi'],
												  'butir'		  => $butir));
			}
		}else{
			$this->db->insert('tbutir', $data);
		}
	}

	public function tambahKompetensi($data)
	{
		$this->db->insert('tkompetensi', $data);
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

	public function edit_butir($data)
	{
		$this->db->where('id_butir', $data['id_butir']);
		$this->db->update('tbutir', $data);
	}

	public function editKompetensi($data)
	{
		$this->db->where('id_kompetensi', $data['id_kompetensi']);
		$this->db->update('tkompetensi', $data);
	}

}

/* End of file P2MI_model.php */
/* Location: ./application/models/P2MI_model.php */