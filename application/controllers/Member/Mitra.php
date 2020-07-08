<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_mitra');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_mitra->get();
		$this->template->load('template_member', 'Member/mitra', $data);
	}

	public function add()
	{
		$mitra = new stdClass();
		$mitra->id_mitra = null;
		$mitra->nama_mitra = null;
		$mitra->kode_mitra = null;
		$mitra->telp = null;
		$mitra->email = null;
		$data = array(
			'page' => 'add',
			'row' => $mitra
		);
		$this->template->load('template', 'Member/mitra_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_mitra->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_mitra->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Member/mitra');
	}

	public function edit($id)
	{
		$query = $this->m_mitra->get($id);
		if ($query->num_rows() > 0) {
			$mitra = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $mitra
			);
			$this->template->load('template', 'Member/mitra_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/mitra') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_mitra->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/mitra');
	}
}
