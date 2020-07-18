<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reward extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_reward');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_reward->get();
		$this->template->load('template_member', 'Member/reward', $data);
	}

	public function add()
	{
		$reward = new stdClass();
		$reward->id_reward = null;
		$reward->nama_reward = null;
		$reward->point_reward = null;
		$data = array(
			'page' => 'add',
			'row' => $reward
		);
		$this->template->load('template_member', 'Member/reward_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_reward->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_reward->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Member/reward');
	}

	public function edit($id)
	{
		$query = $this->m_reward->get($id);
		if ($query->num_rows() > 0) {
			$reward = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $reward
			);
			$this->template->load('template_member', 'Member/reward_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/reward') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_reward->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/reward');
	}
}
