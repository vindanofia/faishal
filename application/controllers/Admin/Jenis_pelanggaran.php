<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pelanggaran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_jenis_pelanggaran');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_jenis_pelanggaran->get();
		$this->template->load('template', 'Admin/jenis_pelanggaran', $data);
	}

	public function add()
	{
		$jenis_pelanggaran = new stdClass();
		$jenis_pelanggaran->id_jenis_pel = null;
		$jenis_pelanggaran->nama_jenis_pel = null;
		$data = array(
			'page' => 'add',
			'row' => $jenis_pelanggaran
		);
		$this->template->load('template', 'Admin/jenis_pelanggaran_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_jenis_pelanggaran->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_jenis_pelanggaran->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Admin/jenis_pelanggaran');
	}

	public function edit($id)
	{
		$query = $this->m_jenis_pelanggaran->get($id);
		if ($query->num_rows() > 0) {
			$jenis_pelanggaran = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $jenis_pelanggaran
			);
			$this->template->load('template', 'Admin/jenis_pelanggaran_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/jenis_pelanggaran') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_jenis_pelanggaran->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/jenis_pelanggaran');
	}
}
