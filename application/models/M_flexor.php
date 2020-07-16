<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_flexor extends CI_Model
{
	private $table = 'm_konten';
	private $pk = 'id_konten';

	function get()
	{
		$this->db->where('deleted', 1);
		// $this->db->limit(4);
		$this->db->order_by('created', 'DESC');
		return $this->db->get('m_konten');
	}

	function konten_lengkap($id_konten)
	{
		$this->db->where('id_konten', $id_konten);
		$this->db->where('deleted', 1);
		// $this->db->limit(4);
		$this->db->order_by('created', 'DESC');
		return $this->db->get('m_konten');
	}
}
