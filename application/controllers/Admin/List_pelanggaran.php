<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_pelanggaran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_list_pelanggaran', 'm_jenis_pelanggaran']);
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_list_pelanggaran->get();
		$this->template->load('template', 'Admin/list_pelanggaran', $data);
	}

	public function add()
	{
		$list_pelanggaran = new stdClass();
		$list_pelanggaran->id_list_pel = null;
		$list_pelanggaran->nama_list_pel = null;
		$list_pelanggaran->point_pel = null;

		$query_jenis_pelanggaran = $this->m_jenis_pelanggaran->get();
		$jenis_pelanggaran[null] = '- Pilih -';
		foreach ($query_jenis_pelanggaran->result() as $jenis_pel) {
			$jenis_pelanggaran[$jenis_pel->id_jenis_pel] = $jenis_pel->nama_jenis_pel;
		}
		$data = array(
			'page' => 'add',
			'row' => $list_pelanggaran,
			'jenis_pelanggaran' => $jenis_pelanggaran, 'selectedjenispel' => null,
		);
		$this->template->load('template', 'Admin/list_pelanggaran_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_list_pelanggaran->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_list_pelanggaran->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Admin/list_pelanggaran');
	}

	public function edit($id)
	{
		$query = $this->m_list_pelanggaran->get($id);
		if ($query->num_rows() > 0) {
			$list_pelanggaran = $query->row();
			$query_jenis_pelanggaran = $this->m_jenis_pelanggaran->get();
			$jenis_pelanggaran[null] = '- Pilih -';
			foreach ($query_jenis_pelanggaran->result() as $jenis_pel) {
				$jenis_pelanggaran[$jenis_pel->id_jenis_pel] = $jenis_pel->nama_jenis_pel;
			}
			$data = array(
				'page' => 'edit',
				'row' => $list_pelanggaran,
				'jenis_pelanggaran' => $jenis_pelanggaran, 'selectedjenispel' => $list_pelanggaran->id_jenis_pel,
			);
			$this->template->load('template', 'Admin/list_pelanggaran_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/list_pelanggaran') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_list_pelanggaran->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/list_pelanggaran');
	}
}
