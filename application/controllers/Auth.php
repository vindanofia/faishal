<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('m_user');
			$query = $this->m_user->login($post);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'userid' => $row->id_user,
					'level' => $row->id_role
				);
				$this->session->set_userdata($params);
				$role = $this->session->userdata('level');
				if ($role == 1) {
					echo "<script language=\"javascript\">
					swal('Please adjust the values in user' , 'Bad data format', 'error');
				  </script>";
					redirect('Admin/dashboard');
					// echo "<script>
					// alert('Selamat, login berhasil');
					// window.location='" . site_url('Admin/dashboard') . "';
					// </script>";
				} else {
					echo "<script>
					alert('Selamat, login berhasil');
					window.location='" . site_url('Member/dashboard') . "';
					</script>";
				}
			} else {
				echo "<script>
				alert('Login gagal');
				window.location='" . site_url('auth/login') . "';
				</script>";
			}
		}
	}

	public function change_password()
	{
		$this->load->view('changepassword');
	}

	public function logout()
	{
		$params = array('userid', 'level');
		$this->session->unset_userdata($params);
		redirect('efima');
	}
}
