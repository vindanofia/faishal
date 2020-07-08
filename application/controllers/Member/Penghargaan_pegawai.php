<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penghargaan_pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model([
			'm_penghargaan_pegawai',
			'm_pegawai',
			'm_reward',
		]);
	}

	function get_ajax()
	{
		$list = $this->m_penghargaan_pegawai->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $pegawai) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $pegawai->nama_pegawai;
			$row[] = $pegawai->nama_reward;
			$row[] = $pegawai->tanggal;
			$row[] = $pegawai->lokasi;
			$row[] = $pegawai->deskripsi;
			$row[] = $pegawai->point_penghargaan;
			$row[] = $pegawai->foto;
			$row[] = '<a href="' . site_url('Member/penghargaan_pegawai/del/' . $pegawai->id_penghargaan_peg) . '/' . $pegawai->id_pegawai . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_penghargaan_pegawai->count_all(),
			"recordsFiltered" => $this->m_penghargaan_pegawai->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['row'] = $this->m_penghargaan_pegawai->get();
		$this->template->load('template_member', 'Member/penghargaan_pegawai', $data);
	}

	public function add()
	{
		$penghargaan_pegawai = new stdClass();
		$penghargaan_pegawai->id_penghargaan_peg = null;
		$penghargaan_pegawai->id_pegawai = null;
		$penghargaan_pegawai->id_reward = null;
		$penghargaan_pegawai->tanggal = null;
		$penghargaan_pegawai->lokasi = null;
		$penghargaan_pegawai->deskripsi = null;
		$penghargaan_pegawai->foto = null;

		$query_pegawai = $this->m_pegawai->get();
		$query_jenis_penghargaan = $this->m_reward->get();
		$jenis_penghargaan[null] = '- Pilih -';
		foreach ($query_jenis_penghargaan->result() as $jenis_reward) {
			$jenis_penghargaan[$jenis_reward->id_reward] = $jenis_reward->nama_reward;
		}

		$data = array(
			'page' => 'add',
			'row' => $penghargaan_pegawai,
			'pegawai' => $query_pegawai,
			'jenis_penghargaan' => $jenis_penghargaan, 'selectedjenispel' => null,
		);
		$this->template->load('template', 'Member/penghargaan_pegawai_form', $data);
	}

	public function process()
	{
		$config['upload_path'] = './uploads/apresiasi';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['file_name'] = 'apresiasi-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$post['image'] = $this->upload->data('file_name');
					$this->m_penghargaan_pegawai->add($post);
					$this->m_pegawai->update_penghargaan($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Member/penghargaan_pegawai');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Member/penghargaan_pegawai/add');
				}
			} else {
				$this->m_penghargaan_pegawai->add($post);
				$this->m_pegawai->update_penghargaan($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Member/penghargaan_pegawai');
			}
		} else if (isset($_POST['edit'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$list = $this->m_penghargaan_pegawai->get($post['id'])->row();
					if ($list->foto != null) {
						$target_file = './uploads/apresiasi' . $list->foto;
						unlink($target_file);
					}
					$post['image'] = $this->upload->data('file_name');
					$this->m_penghargaan_pegawai->edit($post);
					$this->m_pegawai->update_penghargaan($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Member/penghargaan_pegawai');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Member/penghargaan_pegawai/add');
				}
			} else {
				$this->m_penghargaan_pegawai->edit($post);
				$this->m_pegawai->update_penghargaan($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Member/penghargaan_pegawai');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_penghargaan_pegawai->get($id);
		if ($query->num_rows() > 0) {
			$penghargaan_pegawai = $query->row();
			$query_pegawai = $this->m_pegawai->get();
			$query_jenis_penghargaan = $this->m_jenis_penghargaan->get();
			$jenis_penghargaan[null] = '- Pilih -';
			foreach ($query_jenis_penghargaan->result() as $jenis_apresiasi) {
				$jenis_penghargaan[$jenis_apresiasi->id_reward] = $jenis_apresiasi->nama_reward;
			}

			$data = array(
				'page' => 'edit',
				'row' => $penghargaan_pegawai,
				'pegawai' => $query_pegawai,
				'jenis_penghargaan' => $jenis_penghargaan, 'selectedjenispel' => $penghargaan_pegawai->id_jenis_pel,
			);
			$this->template->load('template', 'Member/penghargaan_pegawai_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/penghargaan_pegawai') . "';</script>";
		}
	}

	public function del($id)
	{
		$id_penghargaan_peg = $this->uri->segment(4);
		$id_pegawai = $this->uri->segment(5);
		$point_penghargaan = $this->m_penghargaan_pegawai->get($id_penghargaan_peg)->row()->point_penghargaan;
		$data = ['point_penghargaan' => $point_penghargaan, 'id_pegawai' => $id_pegawai, 'id_penghargaan_peg' => $id_penghargaan_peg];
		$this->m_pegawai->delete_penghargaan($data);
		$this->m_penghargaan_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/penghargaan_pegawai');
	}
}
