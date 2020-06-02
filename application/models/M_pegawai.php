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

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_pegawai', $id);
		$this->db->update('m_pegawai', $params);
	}
}
