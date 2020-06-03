<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mitra extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_mitra');
		if ($id !== NULL) {
			$this->db->where('id_mitra', $id);
		}
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_mitra' => $post['nama_peg'],
			'nip_mitra' => $post['nip_peg'],
			'telp' => $post['telp'],
			'email' => $post['email'],
			'point' => 0,
			// 'created' => now($timezone),
			'deleted' => 1,
		];
		$this->db->insert('m_mitra', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_mitra' => $post['nama_peg'],
			'nip_mitra' => $post['nip_peg'],
			'telp' => $post['telp'],
			'email' => $post['email'],
			'point' => 0,
			'deleted' => 1,
			'updated' => date('Y-mm-dd H:i:s')
		];
		$this->db->where('id_mitra', $post['id']);
		$this->db->update('m_mitra', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_mitra', $id);
		$this->db->update('m_mitra', $params);
	}
}
