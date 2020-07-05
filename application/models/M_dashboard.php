<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
	public function get_pelanggaran_pegawai($id = NULL)
	{
		$this->db->group_by('id_list_pel');
		$this->db->select('id_list_pel');
		$this->db->select('count(*) as total');
		$this->db->from('t_pelanggaran_pegawai');
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}
}
