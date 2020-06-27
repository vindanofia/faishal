<?php
defined('BASEPATH') or exit('No direct script access allowed');

class konten extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_konten');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_konten->get();
		$this->template->load('template', 'Admin/konten', $data);
	}

	public function add()
	{
		$konten = new stdClass();
		$konten->id_konten = null;
		$konten->judul_konten = null;
		$konten->gambar_konten = null;
		$konten->deskripsi_konten = null;

		$data = array(
			'page' => 'add',
			'row' => $konten,
		);
		$this->template->load('template', 'Admin/konten_form', $data);
	}

	public function process()
	{
		$config['upload_path'] = './uploads/konten';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['file_name'] = 'konten-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$post['image'] = $this->upload->data('file_name');
					$this->m_konten->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Admin/konten');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Admin/konten/add');
				}
			} else {
				$this->m_konten->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Admin/konten');
			}
		} else if (isset($_POST['edit'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$list = $this->m_konten->get($post['id'])->row();
					if ($list->foto != null) {
						$target_file = './uploads/konten' . $list->foto;
						unlink($target_file);
					}
					$post['image'] = $this->upload->data('file_name');
					$this->m_konten->edit($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Admin/konten');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Admin/konten/add');
				}
			} else {
				$this->m_konten->edit($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Admin/konten');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_konten->get($id);
		if ($query->num_rows() > 0) {
			$konten = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $konten,
			);
			$this->template->load('template', 'Admin/konten_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/konten') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_konten->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/konten');
	}
}
