<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pegawai extends CI_Model
{
	public function get($id = null)
	{
		$this->db->from('m_pegawai');
		if ($id != null) {
			$this->db->where('id_pegawai', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
