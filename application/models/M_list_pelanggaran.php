<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_list_pelanggaran extends CI_Model
{
	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_list_pelanggaran');
		if ($id !== NULL) {
			$this->db->where('id_list_pel', $id);
		}
		$this->db->where('m_list_pelanggaran.deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'nama_list_pel' => $post['nama_pel'],
			'point_pel' => $post['point'],
			'deleted' => 1,
		];
		$this->db->insert('m_list_pelanggaran', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_list_pel' => $post['nama_pel'],
			'point_pel' => $post['point'],
			'deleted' => 1,
			'updated' => date("Y-mm-dd H:i:s"),
		];
		$this->db->where('id_list_pel', $post['id']);
		$this->db->update('m_list_pelanggaran', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_list_pel', $id);
		$this->db->update('m_list_pelanggaran', $params);
	}

	public function chartDataPelPegawai($tahun = 0, $bulan = 0)
	{
		$result = [
			'labels' => [],
			'ket' => [],
			'data' => [],
			'title' => 'Periode '
		];

		if ($tahun != 0 && $bulan != 0) {
			$query = $this->db->query('SELECT m.id_list_pel id_pel, m.nama_list_pel ket, 
				COUNT(*) total FROM m_list_pelanggaran m 
				INNER JOIN t_pelanggaran_pegawai t ON m.id_list_pel = t.id_list_pel 
				WHERE YEAR(t.tanggal)=' . $tahun . ' AND MONTH(t.tanggal) = ' . $bulan . ' AND t.deleted = 1
				GROUP BY m.id_list_pel');

			foreach ($query->result() as $data) {
				array_push($result['labels'], $data->id_pel);
				array_push($result['ket'], $data->ket);
				array_push($result['data'], $data->total);
			}
		}

		return $result;
	}

	public function chartDataPelMitra($tahun = 0, $bulan = 0)
	{
		$result = [
			'labels' => [],
			'ket2' => [],
			'data' => [],
			'title' => 'Periode '
		];

		if ($tahun != 0 && $bulan != 0) {
			$query = $this->db->query('SELECT m.id_list_pel id_pel, m.nama_list_pel ket2, 
				COUNT(*) total FROM m_list_pelanggaran m 
				INNER JOIN t_pelanggaran_mitra t ON m.id_list_pel = t.id_list_pel 
				WHERE YEAR(t.tanggal)=' . $tahun . ' AND MONTH(t.tanggal) = ' . $bulan . ' and t.deleted=1
				GROUP BY m.id_list_pel');

			foreach ($query->result() as $data) {
				array_push($result['labels'], $data->id_pel);
				array_push($result['ket2'], $data->ket2);
				array_push($result['data'], $data->total);
			}
		}

		return $result;
	}
}
