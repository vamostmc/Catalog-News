<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// Them du lieu vao database
	public function insertTin($tieude, $mota)
	{
		$data = array(
			'tieude' => $tieude,
			'mota'   => $mota,
		);
		$this->db->insert('danhmuctin', $data);
		return $this->db->insert_id();
	}

	// Lay du lieu tu database
	public function showTin()
	{
		$this->db->select('*');
		$data = $this->db->get('danhmuctin');
		$data = $data->result_array();
		return $data;
	}

	// Xoa du lieu 
	public function doDelete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('danhmuctin');;		
	}

	// Lay du lieu can sua tu database thong qua id
	public function editTinID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$data = $this->db->get('danhmuctin');
		$data = $data->result_array();
		return $data;
	}

	// Sua du lieu thong qua bien id
	public function doEdit($id, $tieude, $description)
	{
		$this->db->where('id', $id);
		$data = array(
			'tieude' => $tieude,
			'mota'   => $description,
		);
		return $this->db->update('danhmuctin', $data);
	}
	
}

/* End of file Tin_model.php */
/* Location: ./application/models/Tin_model.php */