<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edit_profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['row'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('user_id')])->row_array();
		$this->template->load('template', 'Admin/edit_profile', $data);
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
			$this->form_validation->set_rules(
				'passconf',
				'Konfirmasi Password',
				'matches[password]',
				array('matches' => '%s tidak sesuai')
			);
		}

		if ($this->input->post('passconf')) {
			$this->form_validation->set_rules(
				'passconf',
				'Konfirmasi Password',
				'matches[password]',
				array('matches' => '%s tidak sesuai')
			);
		}

		$this->form_validation->set_message('required', '%s tidak boleh kosong');
		$this->form_validation->set_message('min_length', '%s minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '%s sudah digunakan');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if ($this->form_validation->run() == false) {
			$query = $this->m_user->get($id);
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->template->load('template', 'Admin/edit_profile', $data);
			} else {
				echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('Admin/dashboard') . "';</script>";
			}
		} else {
			$post = $this->input->post(null, TRUE);
			$this->m_user->edit($post);
			if ($this->db->affected_rows() > 0) {
				// $this->session->set_flashdata('success', 'Data berhasil diubah');
				echo "<script>alert('Data berhasil diubah');</script>";
			}
			redirect('Admin/dashboard');
			// echo "<script>window.location='" . site_url('Admin/user') . "';</script>";
		}
	}

	function username_check()
	{
		$post = $this->input->post(null, TRUE);
		// $query = $this->db->query('SELECT * from user WHERE username = ' . $post['username'] . ' AND id_user != ' . $post['user_id']);
		$query = $this->db->query("SELECT * from user WHERE username = '$post[username]' AND id_user != '$post[user_id]'");
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '%s sudah digunakan');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// public function edit($id)
	// {
	// 	$query = $this->m_user->get($id);
	// 	if ($query->num_rows() > 0) {
	// 		$user = $query->row();
	// 		$data = array(
	// 			'page' => 'edit',
	// 			'row' => $user
	// 		);
	// 		$this->template->load('template', 'Admin/edit_profile', $data);
	// 	} else {
	// 		echo "<script>alert('Data tidak ditemukan');";
	// 		echo "window.location='" . site_url('Admin/dashboard') . "';</script>";
	// 	}
	// }
}
