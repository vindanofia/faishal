<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('typography');
		$this->load->model('m_flexor');
	}
	public function index()
	{
		$this->load->view('blog-single');
	}
}
