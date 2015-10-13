<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {
	
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

	public function ngetesLagi()
	{
		$this->db->select('b.id AS id_settings, c.id_dosen, d.id_matkul, c.nama AS nama_dosen, d.nama AS nama_matkul, b.tahap_belajar, b.semester, b.thn_akademik, COUNT(a.npm) AS responden');
		$this->db->from('kontrak_matkul a');
		$this->db->join('settings b', 'a.id_settings = b.id');
		$this->db->join('ddosen c', 'a.id_dosen = c.id_dosen');
		$this->db->join('dmatkul d', 'a.id_matkul = d.id_matkul');
		$this->db->where('isi_kuesioner', '1');
		$this->db->group_by(array('b.id','d.id_matkul','c.id_dosen'));
		$query = $this->db->get();
		return $query->result_array();
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

	public function getSetting()
	{
		$this->db->select('*');
		$query = $this->db->get('settings');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function getKuesioner($id_settings)
	{
		$this->db->select('a.*, e.nama_kompetensi');
		$this->db->select("SUM(IF(c.jawaban = '1',1,0)) * 1 AS skala_likert1",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '2',1,0)) * 2 AS skala_likert2",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '3',1,0)) * 3 AS skala_likert3",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '4',1,0)) * 4 AS skala_likert4",FALSE);
		$this->db->select("SUM(IF(c.jawaban = '5',1,0)) * 5 AS skala_likert5",FALSE);
		$this->db->select("SUM(c.jawaban) AS total_likert_per_kompetensi",FALSE);
		$this->db->from('settings a');
		$this->db->where('a.id', $id_settings);
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

}

/* End of file Prodi_model.php */
/* Location: ./application/models/Prodi_model.php */