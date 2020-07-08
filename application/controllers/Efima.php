<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Efima extends CI_Controller
{

	// function __construct()
	// {
	// 	parent::__construct();
	// 	check_not_login();
	// 	$this->load->model('m_flexor');
	// 	// $this->load->library('form_validation');
	// }
	public function index()
	{
		$this->load->view('index');
	}
}
