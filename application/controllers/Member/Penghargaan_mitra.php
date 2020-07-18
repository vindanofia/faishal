<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penghargaan_mitra extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model([
			'm_penghargaan_mitra',
			'm_mitra',
			'm_pegawai_mitra',
			'm_reward',
		]);
	}

	function get_ajax()
	{
		$list = $this->m_penghargaan_mitra->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $mitra) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $mitra->nama_mitra;
			$row[] = $mitra->nama_pegawai_mitra;
			$row[] = $mitra->nama_reward;
			$row[] = $mitra->tanggal;
			$row[] = $mitra->lokasi;
			$row[] = $mitra->deskripsi;
			$row[] = $mitra->point_penghargaan;
			$row[] = '<img src="' . base_url() . 'uploads/apresiasi/' . $mitra->foto . '" style="width:80%">';
			$row[] = '<a href="' . site_url('Member/penghargaan_mitra/del/' . $mitra->id_penghargaan_mitra) . '/' . $mitra->id_mitra . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_penghargaan_mitra->count_all(),
			"recordsFiltered" => $this->m_penghargaan_mitra->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['row'] = $this->m_penghargaan_mitra->get();
		$this->template->load('template_member', 'Member/penghargaan_mitra', $data);
	}

	public function add()
	{
		$penghargaan_mitra = new stdClass();
		$penghargaan_mitra->id_penghargaan_mitra = null;
		$penghargaan_mitra->id_mitra = null;
		$penghargaan_mitra->id_pegawai_mitra = null;
		$penghargaan_mitra->id_reward = null;
		$penghargaan_mitra->tanggal = null;
		$penghargaan_mitra->lokasi = null;
		$penghargaan_mitra->deskripsi = null;
		$penghargaan_mitra->foto = null;

		$query_mitra = $this->m_mitra->get();
		$mitra[null] = '- Pilih -';
		$id_mitra = $this->input->post('id_mitra');
		$query_pegawai_mitra = $this->m_pegawai_mitra->get_mitra($id_mitra);
		$pegawai_mitra[null] = '- Pilih -';
		$query_jenis_penghargaan = $this->m_reward->get();
		$jenis_penghargaan[null] = '- Pilih -';
		foreach ($query_mitra->result() as $mitra1) {
			$mitra[$mitra1->id_mitra] = $mitra1->nama_mitra;
		}
		foreach ($query_pegawai_mitra as $peg_mitra) {
			$pegawai_mitra[$peg_mitra->id_pegawai_mitra] = $peg_mitra->nama_pegawai_mitra;
		}
		foreach ($query_jenis_penghargaan->result() as $jenis_reward) {
			$jenis_penghargaan[$jenis_reward->id_reward] = $jenis_reward->nama_reward;
		}

		$data = array(
			'page' => 'add',
			'row' => $penghargaan_mitra,
			'mitra' => $mitra, 'selectedmitra' => null,
			'pegawai_mitra' => $pegawai_mitra, 'selectedpegmitra' => null,
			'jenis_penghargaan' => $jenis_penghargaan, 'selectedjenispel' => null,
		);
		$this->template->load('template', 'Member/penghargaan_mitra_form', $data);
	}

	public function process()
	{
		$config['upload_path'] = './uploads/apresiasi';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 20480;
		$config['file_name'] = 'apresiasi-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$post['image'] = $this->upload->data('file_name');
					$this->m_penghargaan_mitra->add($post);
					$this->m_pegawai_mitra->update_penghargaan($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Member/penghargaan_mitra');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Member/penghargaan_mitra/add');
				}
			} else {
				$this->m_penghargaan_mitra->add($post);
				$this->m_pegawai_mitra->update_penghargaan($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Member/penghargaan_mitra');
			}
		} else if (isset($_POST['edit'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$list = $this->m_penghargaan_mitra->get($post['id'])->row();
					if ($list->foto != null) {
						$target_file = './uploads/apresiasi' . $list->foto;
						unlink($target_file);
					}
					$post['image'] = $this->upload->data('file_name');
					$this->m_penghargaan_mitra->edit($post);
					$this->m_pegawai_mitra->update_penghargaan($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Member/penghargaan_mitra');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Member/penghargaan_mitra/add');
				}
			} else {
				$this->m_penghargaan_mitra->edit($post);
				$this->m_pegawai_mitra->update_penghargaan($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Member/penghargaan_mitra');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_penghargaan_mitra->get($id);
		if ($query->num_rows() > 0) {
			$penghargaan_mitra = $query->row();
			$query_mitra = $this->m_mitra->get();
			$mitra[null] = '- Pilih -';
			$query_pegawai_mitra = $this->m_pegawai_mitra->get();
			$pegawai_mitra[null] = '- Pilih -';
			$query_jenis_penghargaan = $this->m_jenis_penghargaan->get();
			$jenis_penghargaan[null] = '- Pilih -';
			foreach ($query_mitra->result() as $mitra1) {
				$mitra[$mitra1->id_mitra] = $mitra1->nama_mitra;
			}
			foreach ($query_pegawai_mitra->result() as $peg_mitra) {
				$pegawai_mitra[$peg_mitra->id_pegawai_mitra] = $peg_mitra->nama_pegawai_mitra;
			}
			foreach ($query_jenis_penghargaan->result() as $jenis_apresiasi) {
				$jenis_penghargaan[$jenis_apresiasi->id_reward] = $jenis_apresiasi->nama_reward;
			}

			$data = array(
				'page' => 'edit',
				'row' => $penghargaan_mitra,
				'mitra' => $mitra, 'selectedmitra' => null,
				'pegawai_mitra' => $pegawai_mitra, 'selectedpegmitra' => null,
				'jenis_penghargaan' => $jenis_penghargaan, 'selectedjenispel' => $penghargaan_mitra->id_jenis_pel,
			);
			$this->template->load('template', 'Member/penghargaan_mitra_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/penghargaan_mitra') . "';</script>";
		}
	}

	public function del($id)
	{
		$id_penghargaan_mitra = $this->uri->segment(4);
		$id_mitra = $this->uri->segment(5);
		$point_penghargaan = $this->m_penghargaan_mitra->get($id_penghargaan_mitra)->row()->point_penghargaan;
		$data = ['point_penghargaan' => $point_penghargaan, 'id_mitra' => $id_mitra, 'id_penghargaan_mitra' => $id_penghargaan_mitra];
		$this->m_mitra->delete_penghargaan($data);
		$this->m_penghargaan_mitra->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/penghargaan_mitra');
	}
}
