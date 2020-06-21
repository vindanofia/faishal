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

	public function getSanksiByPoint($point = 0){
		$this->db->from('m_sanksi');
		$this->db->order_by('point_sanksi', 'ASC');
		$sanksi = $this->db->get()->result();

		$minimum_point = $sanksi[0]->point_sanksi;
		foreach($sanksi as $key => $s){
			if($key+1 < count($sanksi)){
				if($point >= $s->point_sanksi && $point < $sanksi[$key+1]->point_sanksi){
					return strpos(strtolower($s->nama_sanksi), 'denda') !== false ? 'Denda Rp. '.($point*1000) : $s->nama_sanksi;
				}
			}else if($point == $s->point_sanksi){
				return $s->nama_sanksi;
			}
			$minimum_point = $s->point_sanksi;
		}
		return '-';
	}
}
