<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sanksi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_sanksi');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_sanksi->get();
		$this->template->load('template_member', 'Member/sanksi', $data);
	}

	public function add()
	{
		$sanksi = new stdClass();
		$sanksi->id_sanksi = null;
		$sanksi->nama_sanksi = null;
		$sanksi->point_sanksi = null;
		$data = array(
			'page' => 'add',
			'row' => $sanksi
		);
		$this->template->load('template', 'Member/sanksi_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_sanksi->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_sanksi->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Member/sanksi');
	}

	public function edit($id)
	{
		$query = $this->m_sanksi->get($id);
		if ($query->num_rows() > 0) {
			$sanksi = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $sanksi
			);
			$this->template->load('template', 'Member/sanksi_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/sanksi') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_sanksi->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/sanksi');
	}
}
