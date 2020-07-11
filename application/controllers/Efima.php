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
}
