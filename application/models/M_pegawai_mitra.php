<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pegawai_mitra extends CI_Model
{

	// start datatables
	var $column_order = array(null, 'm_mitra.nama_mitra', 'm_pegawai_mitra.nama_pegawai_mitra', 'm_pegawai_mitra.nip_pegawai_mitra', 'm_pegawai_mitra.telp_peg_mitra', 'm_pegawai_mitra.point_peg_mitra', 'm_pegawai_mitra.potongan_peg_mitra'); //set column field database for datatable orderable
	var $column_search = array('m_mitra.nama_mitra', 'm_pegawai_mitra.nama_pegawai_mitra', 'm_pegawai_mitra.nip_pegawai_mitra', 'm_pegawai_mitra.telp_peg_mitra'); //set column field database for datatable searchable
	var $order = array('id_pegawai_mitra' => 'desc'); // default order

	private function _get_datatables_query()
	{
		$this->db->from('m_pegawai_mitra');
		$this->db->join('m_mitra', 'm_mitra.id_mitra = m_pegawai_mitra.id_perusahaan');
		$this->db->where('m_pegawai_mitra.deleted = ', 1);
		$i = 0;
		foreach ($this->column_search as $pegawai_mitra) { // loop column
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($pegawai_mitra, $_POST['search']['value']);
				} else {
					$this->db->or_like($pegawai_mitra, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all()
	{
		$this->db->from('m_pegawai_mitra');
		$this->db->where('deleted = ', 1);
		return $this->db->count_all_results();
	}
	// end datatables

	public function get($id = NULL)
	{
		// $deleted = array(1);
		$this->db->from('m_pegawai_mitra');
		if ($id !== NULL) {
			$this->db->where('id_pegawai_mitra', $id);
		}
		$this->db->where('deleted = ', 1);
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'id_perusahaan' => $post['mitra'],
			'nama_pegawai_mitra' => $post['nama_pegawai_mitra'],
			'nip_pegawai_mitra' => $post['nip_pegawai_mitra'],
			'telp_peg_mitra' => $post['telp_peg_mitra'],
			'point_peg_mitra' => 0,
			'potongan_peg_mitra' => 0,
			'deleted' => 1,
		];
		$this->db->insert('m_pegawai_mitra', $params);
	}

	public function edit($post)
	{
		$params = [
			'id_perusahaan' => $post['mitra'],
			'nama_pegawai_mitra' => $post['nama_pegawai_mitra'],
			'nip_pegawai_mitra' => $post['nip_pegawai_mitra'],
			'telp_peg_mitra' => $post['telp_peg_mitra'],
			'deleted' => 1,
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_pegawai_mitra', $post['id']);
		$this->db->update('m_pegawai_mitra', $params);
	}

	public function del($id)
	{
		$params = [
			'updated' => date("Y-m-d H:i:s"),
			'deleted' => 0
		];
		$this->db->where('id_pegawai_mitra', $id);
		$this->db->update('m_pegawai_mitra', $params);
	}

	public function update_point($data)
	{
		$id_list_pel = $data['list_pelanggaran'];
		$id_pegawai_mitra = $data['pegawai_mitra'];
		$this->db->from('m_list_pelanggaran');
		$this->db->where('id_list_pel', $id_list_pel);
		$query = $this->db->get()->row();
		$point_pel = $query->point_pel;
		$sql = 'UPDATE m_pegawai_mitra SET point_peg_mitra = point_peg_mitra + ' . $point_pel . ' WHERE id_pegawai_mitra = ' . $id_pegawai_mitra;
		$this->db->query($sql);
	}

	public function delete_point($data)
	{
		$id_pelanggaran_peg = $data['id_pelanggaran_peg'];
		$id_pegawai = $data['id_pegawai'];
		$this->db->from('t_pelanggaran_pegawai');
		$this->db->where('id_pelanggaran_peg', $id_pelanggaran_peg);
		$query = $this->db->get()->row();
		$point_tpel = $query->point_tpel;
		if ($point <= $point_tpel) {
			$sql = 'UPDATE m_pegawai SET point = 0 WHERE id_pegawai = ' . $id_pegawai;
		} else {
			$sql = 'UPDATE m_pegawai SET point = point - ' . $point_tpel . ' WHERE id_pegawai = ' . $id_pegawai;
		}
		$this->db->query($sql);
	}

	public function resetPointpegawai_mitra()
	{
		$this->db->update('m_pegawai_mitra', [
			'point_peg_mitra' => 0,
		]);
	}

	public function get_mitra($id_mitra)
	{
		$this->db->where('id_perusahaan', $id_mitra);
		$this->db->where('deleted', 1);
		$result = $this->db->get('m_pegawai_mitra')->result();

		return $result;
	}

	public function resetPointPegawai()
	{
		$this->db->update('m_pegawai_mitra', [
			'point_peg_mitra' => 0,
			'potongan_peg_mitra' => 0,
		]);
	}

	public function update_penghargaan($data)
	{
		$id_reward = $data['jenis_penghargaan'];
		$id_pegawai_mitra = $data['pegawai_mitra'];
		$this->db->from('m_jenis_penghargaan');
		$this->db->where('id_reward', $id_reward);
		$query = $this->db->get()->row();
		$point_penghargaan = $query->point_reward;
		$this->db->from('m_pegawai_mitra');
		$this->db->where('id_pegawai_mitra', $id_pegawai_mitra);
		$query1 = $this->db->get()->row();
		$point_peg_mitra = $query1->point_peg_mitra;
		if ($point_peg_mitra <= $point_penghargaan) {
			$sql = 'UPDATE m_pegawai_mitra SET point_peg_mitra = 0 WHERE id_pegawai_mitra = ' . $id_pegawai_mitra;
		} else {
			$sql = 'UPDATE m_pegawai_mitra SET point_peg_mitra = point_peg_mitra - ' . $point_penghargaan . ' WHERE id_pegawai_mitra = ' . $id_pegawai_mitra;
		}
		$this->db->query($sql);
	}

	public function delete_penghargaan($data)
	{
		$id_penghargaan_mitra = $data['id_penghargaan_mitra'];
		$id_pegawai_mitra = $data['id_pegawai_mitra'];
		$this->db->from('t_penghargaan_mitra');
		$this->db->where('id_penghargaan_mitra', $id_penghargaan_mitra);
		$query = $this->db->get()->row();
		$point_penghargaan = $query->point_penghargaan;
		$sql = 'UPDATE m_pegawai_mitra SET point_peg_mitra = point_peg_mitra + ' . $point_penghargaan . ' WHERE id_pegawai_mitra = ' . $id_pegawai_mitra;
		$this->db->query($sql);
	}
}
