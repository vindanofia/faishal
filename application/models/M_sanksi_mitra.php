<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sanksi_mitra extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_sanksi_mitra');
		if ($id !== NULL) {
			$this->db->where('id_sanksi_mitra', $id);
		}
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_sanksi_mitra' => $post['nama_sanksi_mitra'],
			'point_sanksi_mitra' => $post['point_sanksi_mitra'],
			'deleted' => 1,
		];
		$this->db->insert('m_sanksi_mitra', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_sanksi_mitra' => $post['nama_sanksi_mitra'],
			'point_sanksi_mitra' => $post['point_sanksi_mitra'],
			'deleted' => 1,
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_sanksi_mitra', $post['id']);
		$this->db->update('m_sanksi_mitra', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_sanksi_mitra', $id);
		$this->db->update('m_sanksi_mitra', $params);
	}

	public function getSanksi_mitraPoint($point = 0)
	{
		return $this->getSanksi_mitra($point);
	}

	public function getPotongan($point = 0)
	{
		return $this->getSanksi_mitra($point, true);
	}

	public function getSanksi_mitra($point = 0, $denda = null)
	{
		$this->db->from('m_sanksi_mitra');
		$this->db->order_by('point_sanksi_mitra', 'ASC');
		$sanksi_mitra = $this->db->get()->result();
		$maxPointPotongan = $this->getMaxPointPotongan();

		$minimum_point = $sanksi_mitra[0]->point_sanksi_mitra;
		foreach ($sanksi_mitra as $key => $s) {
			if ($key + 1 < count($sanksi_mitra)) {
				if ($point >= $s->point_sanksi_mitra && $point < $sanksi_mitra[$key + 1]->point_sanksi_mitra) {
					if ($denda) {
						$potongan = strpos(strtolower($s->nama_sanksi_mitra), 'denda') !== false ?  ($point * 2500) : 0;
						return indo_currency($potongan);
					} else {
						return $s->nama_sanksi_mitra;
					}
				} else if ($denda && $point >= $maxPointPotongan) {
					return indo_currency($maxPointPotongan * 2500);
				}
			} else if ($point == $s->point_sanksi_mitra) {
				return $denda ? indo_currency($maxPointPotongan * 2500) : $s->nama_sanksi_mitra;
			}
			$minimum_point = $s->point_sanksi_mitra;
		}
		return $denda ? indo_currency(0) : '-';
	}

	function getMaxPointPotongan()
	{
		$this->db->from('m_sanksi_mitra');
		$this->db->order_by('point_sanksi_mitra', 'ASC');
		$sanksi_mitra = $this->db->get()->result();

		$point = 0;
		foreach ($sanksi_mitra as $key => $s) {
			$point = strpos(strtolower($s->nama_sanksi_mitra), 'denda') !== false ? $sanksi_mitra[$key + 1]->point_sanksi_mitra : $point;
		}

		return $point;
	}
}
