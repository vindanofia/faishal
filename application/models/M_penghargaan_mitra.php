<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_penghargaan_mitra extends CI_Model
{
	// start datatables
	var $column_order = array(null, 'm_mitra.nama_mitra', 'm_pegawai_mitra.nama_pegawai_mitra', 'm_jenis_penghargaan.nama_reward', 't_penghargaan_mitra.tanggal', 't_penghargaan_mitra.lokasi', 't_penghargaan_mitra.deskripsi'); //set column field database for datatable orderable
	var $column_search = array('m_mitra.nama_mitra', 'm_pegawai_mitra.nama_pegawai_mitra', 'm_jenis_penghargaan.nama_reawrd', 't_penghargaan_mitra.lokasi'); //set column field database for datatable searchable
	var $order = array('id_penghargaan_mitra' => 'desc'); // default order

	private function _get_datatables_query()
	{
		$this->db->from('t_penghargaan_mitra');
		$this->db->join('m_mitra', 'm_mitra.id_mitra = t_penghargaan_mitra.id_mitra');
		$this->db->join('m_pegawai_mitra', 'm_pegawai_mitra.id_pegawai_mitra = t_penghargaan_mitra.id_pegawai_mitra');
		$this->db->join('m_jenis_penghargaan', 'm_jenis_penghargaan.id_reward = t_penghargaan_mitra.id_reward');
		$this->db->where('t_penghargaan_mitra.deleted = ', 1);
		$i = 0;
		foreach ($this->column_search as $pelmitra) { // loop column
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($pelmitra, $_POST['search']['value']);
				} else {
					$this->db->or_like($pelmitra, $_POST['search']['value']);
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
		$this->db->from('t_penghargaan_mitra');
		$this->db->where('deleted = ', 1);
		return $this->db->count_all_results();
	}
	// end datatables

	public function get($id = NULL)
	{
		$this->db->from('t_penghargaan_mitra');
		$this->db->join('m_mitra', 'm_mitra.id_mitra = t_penghargaan_mitra.id_mitra');
		$this->db->join('m_pegawai_mitra', 'm_pegawai_mitra.id_pegawai_mitra = t_penghargaan_mitra.id_pegawai_mitra');
		$this->db->join('m_jenis_penghargaan', 'm_jenis_penghargaan.id_reward = t_penghargaan_mitra.id_reward');
		$this->db->where('t_penghargaan_mitra.deleted = ', 1);
		if ($id != null) {
			$this->db->where('id_penghargaan_mitra', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$id_reward = $post['jenis_penghargaan'];
		$this->db->from('m_jenis_penghargaan');
		$this->db->where('id_reward', $id_reward);
		$query = $this->db->get()->row();
		$point_pel = $query->point_reward;

		$params = [
			'id_mitra' => $post['mitra'],
			'id_pegawai_mitra' => $post['pegawai_mitra'],
			'id_reward' => $post['jenis_penghargaan'],
			'tanggal' => $post['tanggal'],
			'lokasi' => $post['lokasi'],
			'deskripsi' => $post['deskripsi'],
			'foto' => $post['image'],
			'point_penghargaan' => $point_pel,
			'deleted' => 1,
			'created_by' => $this->session->userdata('userid')
		];
		$this->db->insert('t_penghargaan_mitra', $params);
	}

	public function edit($post)
	{
		$params = [
			'id_mitra' => $post['mitra'],
			'id_pegawai_mitra' => $post['pegawai_mitra'],
			'id_reward' => $post['jenis_penghargaan'],
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
		$this->db->where('id_penghargaan_mitra', $post['id']);
		$this->db->update('t_penghargaan_mitra', $params);
	}

	public function del($id)
	{
		$params = [
			'deleted' => 0,
			'updated_by' => $this->session->userdata('userid'),
			'updated' => date("Y-m-d H:i:s"),
		];
		$this->db->where('id_penghargaan_mitra', $id);
		$this->db->update('t_penghargaan_mitra', $params);
	}
}
