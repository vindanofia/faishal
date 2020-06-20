<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pegawai extends CI_Model
{

	// start datatables
	var $column_order = array(null, 'm_pegawai.nama_pegawai', 'm_pegawai.nip_pegawai', 'm_pegawai.telp', 'm_pegawai.email', 'm_pegawai.point', 'm_pegawai.potongan'); //set column field database for datatable orderable
	var $column_search = array('m_pegawai.nama_pegawai', 'm_pegawai.nip_pegawai'); //set column field database for datatable searchable
	var $order = array('id_pegawai' => 'desc'); // default order

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->from('m_pegawai');
		$this->db->where('deleted = ', 1);
		$i = 0;
		foreach ($this->column_search as $pegawai) { // loop column
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($pegawai, $_POST['search']['value']);
				} else {
					$this->db->or_like($pegawai, $_POST['search']['value']);
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
		$this->db->from('m_pegawai');
		$this->db->where('deleted = ', 1);
		return $this->db->count_all_results();
	}
	// end datatables

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

	public function add($post)
	{
		$params = [
			'nama_pegawai' => $post['nama_peg'],
			'nip_pegawai' => $post['nip_peg'],
			'telp' => $post['telp'],
			'email' => $post['email'],
			'point' => 0,
			// 'created' => now($timezone),
			'deleted' => 1,
		];
		$this->db->insert('m_pegawai', $params);
	}

	public function edit($post)
	{
		$params = [
			'nama_pegawai' => $post['nama_peg'],
			'nip_pegawai' => $post['nip_peg'],
			'telp' => $post['telp'],
			'email' => $post['email'],
			'deleted' => 1,
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_pegawai', $post['id']);
		$this->db->update('m_pegawai', $params);
	}

	public function del($id)
	{
		$params['deleted'] = 0;
		$this->db->where('id_pegawai', $id);
		$this->db->update('m_pegawai', $params);
	}

	public function update_point($data)
	{
		$id_list_pel = $data['list_pelanggaran'];
		$this->db->select('point_pel');
		$this->db->from('m_list_pelanggaran');
		$this->db->where('id_list_pel', $id_list_pel);
		$point_pel = $this->db->get()->result();
		$id_pegawai = $data['id_pegawai'];
		$sql = 'UPDATE m_pegawai SET point = point + ' . $point_pel . ' WHERE id_pegawai = ' . $id_pegawai;
		$this->db->query($sql);
	}
}
