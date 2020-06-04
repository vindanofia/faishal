<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sanksi extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_sanksi');
		if ($id !== NULL) {
			$this->db->where('id_sanksi', $id);
		}
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_sanksi' => $post['nama_sanksi'],
			'point_sanksi' => $post['point_sanksi'],
			'deleted' => 1,
		];
		$this->db->insert('m_sanksi', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_sanksi' => $post['nama_sanksi'],
			'point_sanksi' => $post['point_sanksi'],
			'deleted' => 1,
			'updated' => date('Y-mm-dd H:i:s')
		];
		$this->db->where('id_sanksi', $post['id']);
		$this->db->update('m_sanksi', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_sanksi', $id);
		$this->db->update('m_sanksi', $params);
	}
}
