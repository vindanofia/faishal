<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pegawai extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_pegawai');
		if ($id !== NULL) {
			$this->db->where('id_pegawai', $id);
		}
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_pegawai' => $post['nama_peg'],
			'nip_pegawai' => $post['nip_peg'],
			'telp' => $post['telp'],
			'email' => $post['email'],
			'point' => 0,
			// 'created' => now($timezone),
			'deleted' => 1,
		];
		$this->db->insert('m_pegawai', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_pegawai' => $post['nama_peg'],
			'nip_pegawai' => $post['nip_peg'],
			'telp' => $post['telp'],
			'email' => $post['email'],
			'point' => 0,
			'deleted' => 1,
			'updated' => date('Y-mm-dd H:i:s')
		];
		$this->db->where('id_pegawai', $post['id']);
		$this->db->update('m_pegawai', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_pegawai', $id);
		$this->db->update('m_pegawai', $params);
	}
}
