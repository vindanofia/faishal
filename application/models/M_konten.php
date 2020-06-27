<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_konten extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_konten');
		if ($id !== NULL) {
			$this->db->where('id_konten', $id);
		}
		$this->db->where('m_konten.deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'judul_konten' => $post['judul_konten'],
			'gambar_konten' => $post['image'],
			'deskripsi_konten' => $post['deskripsi_konten'],
			'deleted' => 1,
			'add_by' => $this->session->userdata('userid'),
		];
		$this->db->insert('m_konten', $params);
	}

	public function edit($post)
	{
		$params = [
			'judul_konten' => $post['judul_konten'],
			'gambar_konten' => $post['image'],
			'deskripsi_konten' => $post['deskripsi_konten'],
			'deleted' => 1,
			'updated_by' => $this->session->userdata('userid'),
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_konten', $post['id']);
		$this->db->update('m_konten', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_konten', $id);
		$this->db->update('m_konten', $params);
	}
}
