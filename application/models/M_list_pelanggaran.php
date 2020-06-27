<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_list_pelanggaran extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_list_pelanggaran');
		if ($id !== NULL) {
			$this->db->where('id_list_pel', $id);
		}
		$this->db->where('m_list_pelanggaran.deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_list_pel' => $post['nama_pel'],
			'point_pel' => $post['point'],
			'deleted' => 1,
		];
		$this->db->insert('m_list_pelanggaran', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_list_pel' => $post['nama_pel'],
			'point_pel' => $post['point'],
			'deleted' => 1,
			'updated' => date("Y-mm-dd H:i:s"),
		];
		$this->db->where('id_list_pel', $post['id']);
		$this->db->update('m_list_pelanggaran', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_list_pel', $id);
		$this->db->update('m_list_pelanggaran', $params);
	}
}
