<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_dashboard']);
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['graph1'] = $this->m_dashboard->get_pelanggaran_pegawai();
		$this->template->load('template_member', 'Member/dashboard', $data);
	}
}
