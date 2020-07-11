<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Efima extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_flexor');
	}
	public function index()
	{
		$dataIndex = $this->m_flexor->get();
		$data = array(
			'dataIndex' => $dataIndex
		);
		$this->load->view('index', $data);
	}
	public function konten_lengkap()
	{
		$data = array(
			'row' => $this->m_flexor->konten_lengkap($this->uri->segment(3))->row_array()
		);
		$this->load->view('blog-single', $data);
	}
}
