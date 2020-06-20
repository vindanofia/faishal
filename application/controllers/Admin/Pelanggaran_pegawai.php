<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_pelanggaran_pegawai', 'm_pegawai', 'm_jenis_pelanggaran', 'm_list_pelanggaran']);
	}

	function get_ajax()
	{
		$list = $this->m_pelanggaran_pegawai->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $pegawai) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $pegawai->nama_pegawai;
			$row[] = $pegawai->nama_jenis_pel;
			$row[] = $pegawai->nama_list_pel;
			$row[] = $pegawai->tanggal;
			$row[] = $pegawai->lokasi;
			$row[] = $pegawai->deskripsi;
			$row[] = $pegawai->point;
			$row[] = $pegawai->foto;
			$row[] = '<a href="' . site_url('Admin/pelanggaran_pegawai/edit/' . $pegawai->id_pelanggaran_peg) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                   <a href="' . site_url('Admin/pelanggaran_pegawai/del/' . $pegawai->id_pelanggaran_peg) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_pelanggaran_pegawai->count_all(),
			"recordsFiltered" => $this->m_pelanggaran_pegawai->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['row'] = $this->m_pelanggaran_pegawai->get();
		$this->template->load('template', 'Admin/pelanggaran_pegawai', $data);
	}

	public function add()
	{
		$pelanggaran_pegawai = new stdClass();
		$pelanggaran_pegawai->id_pelanggaran_peg = null;
		$pelanggaran_pegawai->id_pegawai = null;
		$pelanggaran_pegawai->id_jenis_pel = null;
		$pelanggaran_pegawai->tanggal = null;
		$pelanggaran_pegawai->lokasi = null;
		$pelanggaran_pegawai->deskripsi = null;
		$pelanggaran_pegawai->foto = null;

		$query_pegawai = $this->m_pegawai->get();
		$query_jenis_pelanggaran = $this->m_jenis_pelanggaran->get();
		$jenis_pelanggaran[null] = '- Pilih -';
		$query_list_pelanggaran = $this->m_list_pelanggaran->get();
		$list_pelanggaran[null] = '- Pilih -';
		foreach ($query_jenis_pelanggaran->result() as $jenis_pel) {
			$jenis_pelanggaran[$jenis_pel->id_jenis_pel] = $jenis_pel->nama_jenis_pel;
		}
		foreach ($query_list_pelanggaran->result() as $list_pel) {
			$list_pelanggaran[$list_pel->id_jenis_pel] = $list_pel->nama_list_pel;
		}

		$data = array(
			'page' => 'add',
			'row' => $pelanggaran_pegawai,
			'pegawai' => $query_pegawai,
			'jenis_pelanggaran' => $jenis_pelanggaran, 'selectedjenispel' => null,
			'list_pelanggaran' => $list_pelanggaran, 'selectedlistpel' => null,
		);
		$this->template->load('template', 'Admin/pelanggaran_pegawai_form', $data);
	}

	public function process()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['file_name'] = 'pelanggaran-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$post['image'] = $this->upload->data('file_name');
					$this->m_pelanggaran_pegawai->add($post);
					$this->m_pegawai->update_point($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Admin/pelanggaran_pegawai');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Admin/pelanggaran_pegawai/add');
				}
			} else {
				$this->m_pelanggaran_pegawai->add($post);
				$this->m_pegawai->update_point($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Admin/pelanggaran_pegawai');
			}
		} else if (isset($_POST['edit'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$list = $this->m_pelanggaran_pegawai->get($post['id'])->row();
					if ($list->foto != null) {
						$target_file = './uploads/' . $list->foto;
						unlink($target_file);
					}
					$post['image'] = $this->upload->data('file_name');
					$this->m_pelanggaran_pegawai->edit($post);
					$this->m_pegawai->update_point($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Admin/pelanggaran_pegawai');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Admin/pelanggaran_pegawai/add');
				}
			} else {
				$this->m_pelanggaran_pegawai->edit($post);
				$this->m_pegawai->update_point($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Admin/pelanggaran_pegawai');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_pelanggaran_pegawai->get($id);
		if ($query->num_rows() > 0) {
			$pelanggaran_pegawai = $query->row();
			$query_pegawai = $this->m_pegawai->get();
			$query_jenis_pelanggaran = $this->m_jenis_pelanggaran->get();
			$query_list_pelanggaran = $this->m_list_pelanggaran->get();
			$jenis_pelanggaran[null] = '- Pilih -';
			foreach ($query_jenis_pelanggaran->result() as $jenis_pel) {
				$jenis_pelanggaran[$jenis_pel->id_jenis_pel] = $jenis_pel->nama_jenis_pel;
			}
			$list_pelanggaran[null] = '- Pilih -';
			foreach ($query_list_pelanggaran->result() as $list_pel) {
				$list_pelanggaran[$list_pel->id_list_pel] = $list_pel->nama_list_pel;
			}

			$data = array(
				'page' => 'edit',
				'row' => $pelanggaran_pegawai,
				'pegawai' => $query_pegawai,
				'jenis_pelanggaran' => $jenis_pelanggaran, 'selectedjenispel' => $pelanggaran_pegawai->id_jenis_pel,
				'list_pelanggaran' => $list_pelanggaran, 'selectedlistpel' => $pelanggaran_pegawai->id_list_pel,
			);
			$this->template->load('template', 'Admin/pelanggaran_pegawai_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/pelanggaran_pegawai') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_pelanggaran_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/pelanggaran_pegawai');
	}
}
