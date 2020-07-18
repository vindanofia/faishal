<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sanksi_mitra extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_sanksi_mitra');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_sanksi_mitra->get();
		$this->template->load('template_member', 'Member/sanksi_mitra', $data);
	}

	public function add()
	{
		$sanksi_mitra = new stdClass();
		$sanksi_mitra->id_sanksi_mitra = null;
		$sanksi_mitra->nama_sanksi_mitra = null;
		$sanksi_mitra->point_sanksi_mitra = null;
		$data = array(
			'page' => 'add',
			'row' => $sanksi_mitra
		);
		$this->template->load('template_member', 'Member/sanksi_mitra_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_sanksi_mitra->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_sanksi_mitra->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Member/sanksi_mitra');
	}

	public function edit($id)
	{
		$query = $this->m_sanksi_mitra->get($id);
		if ($query->num_rows() > 0) {
			$sanksi_mitra = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $sanksi_mitra
			);
			$this->template->load('template_member', 'Member/sanksi_mitra_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/sanksi_mitra') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_sanksi_mitra->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/sanksi_mitra');
	}
}
