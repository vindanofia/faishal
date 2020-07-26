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

	public function getSanksiPoint($point = 0)
	{
		return $this->getSanksi($point);
	}

	public function getPotongan($point = 0)
	{
		return $this->getSanksi($point, true);
	}

	public function getSanksi($point = 0, $denda = null)
	{
		$this->db->from('m_sanksi');
		$this->db->order_by('point_sanksi', 'ASC');
		$sanksi = $this->db->get()->result();
		$maxPointPotongan = $this->getMaxPointPotongan();

		$minimum_point = $sanksi[0]->point_sanksi;
		foreach ($sanksi as $key => $s) {
			if ($key < count($sanksi)) {
				if ($point >= $s->point_sanksi && $point < $sanksi[$key + 1]->point_sanksi) {
					if ($denda) {
						$potongan = strpos(strtolower($s->nama_sanksi), 'denda') !== false ?  ($point * 2500) : 0;
						return indo_currency($potongan);
					} else {
						return $s->nama_sanksi;
					}
				} else if ($denda && $point >= $maxPointPotongan) {
					return indo_currency($maxPointPotongan * 2500);
				}
			} else if ($point == $s->point_sanksi) {
				return $denda ? indo_currency($maxPointPotongan * 2500) : $s->nama_sanksi;
			}
			$minimum_point = $s->point_sanksi;
		}
		return $denda ? indo_currency(0) : '-';
	}

	function getMaxPointPotongan()
	{
		$this->db->from('m_sanksi');
		$this->db->order_by('point_sanksi', 'ASC');
		$sanksi = $this->db->get()->result();

		$point = 0;
		foreach ($sanksi as $key => $s) {
			$point = strpos(strtolower($s->nama_sanksi), 'denda') !== false ? $sanksi[$key]->point_sanksi : $point;
		}

		return $point;
	}
}
