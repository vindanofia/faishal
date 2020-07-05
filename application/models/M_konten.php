<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_konten extends CI_Model
{
	// start datatables
	var $column_order = array(null, 'm_konten.judul_konten', 'm_konten.deskripsi_konten'); //set column field database for datatable orderable
	var $column_search = array('m_konten.judul_konten', 'm_konten.deskripsi_konten'); //set column field database for datatable searchable
	var $order = array('id_konten' => 'desc'); // default order

	private function _get_datatables_query()
	{
		$this->db->from('m_konten');
		$this->db->where('m_konten.deleted = ', 1);
		$i = 0;
		foreach ($this->column_search as $konten) { // loop column
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($konten, $_POST['search']['value']);
				} else {
					$this->db->or_like($konten, $_POST['search']['value']);
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
		$this->db->from('m_konten');
		$this->db->where('deleted = ', 1);
		return $this->db->count_all_results();
	}
	// end datatables

	public function get($id = NULL)
	{
		$this->db->from('m_konten');
		if ($id != null) {
			$this->db->where('id_konten', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'judul_konten' => $post['judul_konten'],
			'deskripsi_konten' => $post['deskripsi_konten'],
			'foto' => $post['image'],
			'deleted' => 1,
		];
		$this->db->insert('m_konten', $params);
	}

	public function edit($post)
	{
		$params = [
			'judul_konten' => $post['judul_konten'],
			'deskripsi_konten' => $post['deskripsi_konten'],
			'foto' => $post['image'],
			'deleted' => 1,
			'updated' => date("Y-m-d H:i:s"),
		];
		if ($post['image'] != null) {
			$params['foto'] = $post['image'];
		}
		$this->db->where('id_konten', $post['id']);
		$this->db->update('m_konten', $params);
	}

	public function del($id)
	{
		$params = [
			'deleted' => 0,
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_konten', $id);
		$this->db->update('m_konten', $params);
	}
}
