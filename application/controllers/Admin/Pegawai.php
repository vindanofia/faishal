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

	public function del($id)
	{
		$this->m_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
		echo "<script>window.location='" . site_url('Admin/pegawai') . "';</script>";
	}
}
