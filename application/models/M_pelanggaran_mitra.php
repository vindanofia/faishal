<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggaran_mitra extends CI_Model
{
	// start datatables
	var $column_order = array(null, 'm_mitra.nama_mitra', 'm_mitra_mitra.nama_mitra_mitra', 'm_list_pelanggaran.nama_list_pel', 't_pelanggaran_mitra.tanggal', 't_pelanggaran_mitra.lokasi', 't_pelanggaran_mitra.deskripsi'); //set column field database for datatable orderable
	var $column_search = array('m_mitra.nama_mitra', 'm_mitra_mitra.nama_mitra_mitra', 'm_list_pelanggaran.nama_list_pel', 't_pelanggaran_mitra.lokasi'); //set column field database for datatable searchable
	var $order = array('id_pelanggaran_mitra' => 'desc'); // default order

	private function _get_datatables_query()
	{
		$this->db->from('t_pelanggaran_mitra');
		$this->db->join('m_mitra', 'm_mitra.id_mitra = t_pelanggaran_mitra.id_mitra');
		$this->db->join('m_pegawai_mitra', 'm_pegawai_mitra.id_pegawai_mitra = t_pelanggaran_mitra.id_pegawai_mitra');
		$this->db->join('m_list_pelanggaran', 'm_list_pelanggaran.id_list_pel = t_pelanggaran_mitra.id_list_pel');
		$this->db->where('t_pelanggaran_mitra.deleted = ', 1);
		$i = 0;
		foreach ($this->column_search as $pelmit) { // loop column
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($pelmit, $_POST['search']['value']);
				} else {
					$this->db->or_like($pelmit, $_POST['search']['value']);
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
		$this->db->from('t_pelanggaran_mitra');
		$this->db->where('deleted = ', 1);
		return $this->db->count_all_results();
	}
	// end datatables

	public function get($id = NULL)
	{
		$this->db->select('id_pelanggaran_mitra');
		$this->db->from('t_pelanggaran_mitra');
		if ($id != null) {
			$this->db->where('id_pelanggaran_mitra', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$id_list_pel = $post['list_pelanggaran'];
		$this->db->from('m_list_pelanggaran');
		$this->db->where('id_list_pel', $id_list_pel);
		$query = $this->db->get()->row();
		$point_pel = $query->point_pel;

		$params = [
			'id_mitra' => $post['mitra'],
			'id_pegawai_mitra' => $post['pegawai_mitra'],
			'id_list_pel' => $post['list_pelanggaran'],
			'tanggal' => $post['tanggal'],
			'lokasi' => $post['lokasi'],
			'deskripsi' => $post['deskripsi'],
			'foto' => $post['image'],
			'point_tpel' => $point_pel,
			'deleted' => 1,
			'add_by' => $this->session->userdata('userid')
		];
		$this->db->insert('t_pelanggaran_mitra', $params);
	}

	public function edit($post)
	{
		$params = [
			'id_mitra' => $post['mitra'],
			'id_pegawai_mitra' => $post['pegawai_mitra'],
			'id_list_pel' => $post['list_pelanggaran'],
			'tanggal' => $post['tanggal'],
			'lokasi' => $post['lokasi'],
			'deskripsi' => $post['deskripsi'],
			'foto' => $post['image'],
			'deleted' => 1,
			'updated_by' => $this->session->userdata('userid'),
			'updated' => date("Y-m-d H:i:s"),
		];
		if ($post['image'] != null) {
			$params['foto'] = $post['image'];
		}
		$this->db->where('id_pelanggaran_mitra', $post['id']);
		$this->db->update('t_pelanggaran_mitra', $params);
	}

	public function del($id)
	{
		$params = [
			'deleted' => 0,
			'updated_by' => $this->session->userdata('userid'),
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_pelanggaran_mitra', $id);
		$this->db->update('t_pelanggaran_mitra', $params);
	}
}
