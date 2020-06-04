<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jenis_pelanggaran extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_jenis_pelanggaran');
		if ($id !== NULL) {
			$this->db->where('id_jenis_pel', $id);
		}
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_jenis_pel' => $post['nama_pel'],
			'deleted' => 1,
		];
		$this->db->insert('m_jenis_pelanggaran', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_jenis_pel' => $post['nama_pel'],
			'deleted' => 1,
			'updated' => date('Y-mm-dd H:i:s')
		];
		$this->db->where('id_jenis_pel', $post['id']);
		$this->db->update('m_jenis_pelanggaran', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_jenis_pel', $id);
		$this->db->update('m_jenis_pelanggaran', $params);
	}
}
