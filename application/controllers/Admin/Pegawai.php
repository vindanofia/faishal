<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_pegawai');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_pegawai->get();
		$this->template->load('template', 'Admin/pegawai', $data);
	}

	public function add()
	{
		$pegawai = new stdClass();
		$pegawai->id_pegawai = null;
		$pegawai->nama_pegawai = null;
		$pegawai->nip_pegawai = null;
		$pegawai->telp = null;
		$pegawai->email = null;
		$data = array(
			'page' => 'add',
			'row' => $pegawai
		);
		$this->template->load('template', 'Admin/pegawai_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_pegawai->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_pegawai->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Admin/pegawai');
	}

	public function edit($id)
	{
		$query = $this->m_pegawai->get($id);
		if ($query->num_rows() > 0) {
			$pegawai = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $pegawai
			);
			$this->template->load('template', 'Admin/pegawai_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/pegawai') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/pegawai');
	}
}
