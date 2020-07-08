<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
		$data['row'] = $this->m_user->get();
		$this->template->load('template_member', 'Member/user', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[user.username]');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules(
			'passconf',
			'Konfirmasi Password',
			'required|matches[password]',
			array('matches' => '%s tidak sesuai')
		);
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
		$this->form_validation->set_message('min_length', '%s minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '%s sudah digunakan');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if ($this->form_validation->run() == false) {
			$this->template->load('template', 'Member/user_form_add');
		} else {
			$post = $this->input->post(null, TRUE);
			$this->m_user->add($post);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				// echo "<script>alert('Data berhasil ditambahkan');</script>";
			}
			redirect('Member/user');
			// echo "<script>window.location='" . site_url('Member/user') . "';</script>";
		}
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

		$this->form_validation->set_rules('level', 'Level', 'required');

		$this->form_validation->set_message('required', '%s tidak boleh kosong');
		$this->form_validation->set_message('min_length', '%s minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '%s sudah digunakan');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if ($this->form_validation->run() == false) {
			$query = $this->m_user->get($id);
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->template->load('template', 'Member/user_form_edit', $data);
			} else {
				echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('Member/user') . "';</script>";
			}
		} else {
			$post = $this->input->post(null, TRUE);
			$this->m_user->edit($post);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Data berhasil diubah');
				// echo "<script>alert('Data berhasil diubah');</script>";
			}
			redirect('Member/user');
			// echo "<script>window.location='" . site_url('Member/user') . "';</script>";
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
	public function del()
	{
		$id = $this->input->post('user_id');
		$this->m_user->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			// echo "<script>alert('Data berhasil dihapus');</script>";
		}
		redirect('Member/user');
		// echo "<script>window.location='" . site_url('Member/user') . "';</script>";
	}
}
