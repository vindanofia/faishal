<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model([
			'm_pelanggaran_pegawai',
			'm_pegawai',
			'm_jenis_pelanggaran',
			'm_list_pelanggaran',
			'm_sanksi'
		]);
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
			$row[] = $pegawai->nama_list_pel;
			$row[] = $pegawai->tanggal;
			$row[] = $pegawai->lokasi;
			$row[] = $pegawai->deskripsi;
			$row[] = $pegawai->point_pel;
			$row[] = $pegawai->foto;
			$row[] = '<a href="' . site_url('Member/pelanggaran_pegawai/del/' . $pegawai->id_pelanggaran_peg) . '/' . $pegawai->id_pegawai . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
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
		$this->template->load('template_member', 'Member/pelanggaran_pegawai', $data);
	}

	public function add()
	{
		$pelanggaran_pegawai = new stdClass();
		$pelanggaran_pegawai->id_pelanggaran_peg = null;
		$pelanggaran_pegawai->id_pegawai = null;
		$pelanggaran_pegawai->id_list_pel = null;
		$pelanggaran_pegawai->tanggal = null;
		$pelanggaran_pegawai->lokasi = null;
		$pelanggaran_pegawai->deskripsi = null;
		$pelanggaran_pegawai->foto = null;

		$query_pegawai = $this->m_pegawai->get();
		$query_list_pelanggaran = $this->m_list_pelanggaran->get();
		$list_pelanggaran[null] = '- Pilih -';
		foreach ($query_list_pelanggaran->result() as $list_pel) {
			$list_pelanggaran[$list_pel->id_list_pel] = $list_pel->nama_list_pel;
		}

		$data = array(
			'page' => 'add',
			'row' => $pelanggaran_pegawai,
			'pegawai' => $query_pegawai,
			'list_pelanggaran' => $list_pelanggaran, 'selectedlistpel' => null,
		);
		$this->template->load('template', 'Member/pelanggaran_pegawai_form', $data);
	}

	public function process()
	{
		$config['upload_path'] = './uploads/pegawai';
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
					redirect('Member/pelanggaran_pegawai');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Member/pelanggaran_pegawai/add');
				}
			} else {
				$this->m_pelanggaran_pegawai->add($post);
				$this->m_pegawai->update_point($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Member/pelanggaran_pegawai');
			}
		} else if (isset($_POST['edit'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$list = $this->m_pelanggaran_pegawai->get($post['id'])->row();
					if ($list->foto != null) {
						$target_file = './uploads/pegawai' . $list->foto;
						unlink($target_file);
					}
					$post['image'] = $this->upload->data('file_name');
					$this->m_pelanggaran_pegawai->edit($post);
					$this->m_pegawai->update_point($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Member/pelanggaran_pegawai');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Member/pelanggaran_pegawai/add');
				}
			} else {
				$this->m_pelanggaran_pegawai->edit($post);
				$this->m_pegawai->update_point($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Member/pelanggaran_pegawai');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_pelanggaran_pegawai->get($id);
		if ($query->num_rows() > 0) {
			$pelanggaran_pegawai = $query->row();
			$query_pegawai = $this->m_pegawai->get();
			$query_list_pelanggaran = $this->m_list_pelanggaran->get();
			$list_pelanggaran[null] = '- Pilih -';
			foreach ($query_list_pelanggaran->result() as $list_pel) {
				$list_pelanggaran[$list_pel->id_list_pel] = $list_pel->nama_list_pel;
			}

			$data = array(
				'page' => 'edit',
				'row' => $pelanggaran_pegawai,
				'pegawai' => $query_pegawai,
				'list_pelanggaran' => $list_pelanggaran, 'selectedlistpel' => $pelanggaran_pegawai->id_list_pel,
			);
			$this->template->load('template', 'Member/pelanggaran_pegawai_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/pelanggaran_pegawai') . "';</script>";
		}
	}

	public function del($id)
	{
		$id_pelanggaran_peg = $this->uri->segment(4);
		$id_pegawai = $this->uri->segment(5);
		$point_tpel = $this->m_pelanggaran_pegawai->get($id_pelanggaran_peg)->row()->point_tpel;
		$data = ['point_pel' => $point_tpel, 'id_pegawai' => $id_pegawai, 'id_pelanggaran_peg' => $id_pelanggaran_peg];
		$this->m_pegawai->delete_point($data);
		$this->m_pelanggaran_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/pelanggaran_pegawai');
	}
}
