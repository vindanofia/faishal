<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pelanggaran_mitra extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model([
			'm_pelanggaran_mitra',
			'm_mitra',
			'm_pegawai_mitra',
			'm_list_pelanggaran',
			'm_sanksi_mitra'
		]);
	}

	function get_ajax()
	{
		$list = $this->m_pelanggaran_mitra->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $mitra) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $mitra->nama_mitra;
			$row[] = $mitra->nama_pegawai_mitra;
			$row[] = $mitra->nama_list_pel;
			$row[] = $mitra->tanggal;
			$row[] = $mitra->lokasi;
			$row[] = $mitra->deskripsi;
			$row[] = $mitra->point_tpel;
			$row[] = $mitra->foto;
			$row[] = '<a href="' . site_url('Admin/pelanggaran_mitra/del/' . $mitra->id_pelanggaran_mitra) . '/' . $mitra->id_pegawai_mitra . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_pelanggaran_mitra->count_all(),
			"recordsFiltered" => $this->m_pelanggaran_mitra->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['row'] = $this->m_pelanggaran_mitra->get();
		$this->template->load('template', 'Admin/pelanggaran_mitra', $data);
	}

	public function add()
	{
		$pelanggaran_mitra = new stdClass();
		$pelanggaran_mitra->id_pelanggaran_mitra = null;
		$pelanggaran_mitra->id_mitra = null;
		$pelanggaran_mitra->id_pegawai_mitra = null;
		$pelanggaran_mitra->id_list_pel = null;
		$pelanggaran_mitra->tanggal = null;
		$pelanggaran_mitra->lokasi = null;
		$pelanggaran_mitra->deskripsi = null;
		$pelanggaran_mitra->foto = null;

		$query_mitra = $this->m_mitra->get();
		$mitra[null] = '- Pilih -';
		$id_mitra = $this->input->post('id_mitra');
		$query_pegawai_mitra = $this->m_pegawai_mitra->get_mitra($id_mitra);
		$pegawai_mitra[null] = '- Pilih -';
		$query_list_pelanggaran = $this->m_list_pelanggaran->get();
		$list_pelanggaran[null] = '- Pilih -';
		foreach ($query_mitra->result() as $mitra1) {
			$mitra[$mitra1->id_mitra] = $mitra1->nama_mitra;
		}
		foreach ($query_pegawai_mitra as $peg_mitra) {
			$pegawai_mitra[$peg_mitra->id_pegawai_mitra] = $peg_mitra->nama_pegawai_mitra;
		}
		foreach ($query_list_pelanggaran->result() as $list_pel) {
			$list_pelanggaran[$list_pel->id_jenis_pel] = $list_pel->nama_list_pel;
		}

		$data = array(
			'page' => 'add',
			'row' => $pelanggaran_mitra,
			'mitra' => $mitra, 'selectedmitra' => null,
			'pegawai_mitra' => $pegawai_mitra, 'selectedpegmitra' => null,
			'list_pelanggaran' => $list_pelanggaran, 'selectedlistpel' => null,
		);

		// print_r($pegawai_mitra);
		$this->template->load('template', 'Admin/pelanggaran_mitra_form', $data);
	}

	public function process()
	{
		$config['upload_path'] = './uploads/mitra';
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
					$this->m_pelanggaran_mitra->add($post);
					$this->m_pegawai_mitra->update_point($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Admin/pelanggaran_mitra');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Admin/pelanggaran_mitra/add');
				}
			} else {
				$this->m_pelanggaran_mitra->add($post);
				$this->m_pegawai_mitra->update_point($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Admin/pelanggaran_mitra');
			}
		} else if (isset($_POST['edit'])) {
			if (@$_FILES['image']['name'] != null) {
				if ($this->upload->do_upload('image')) {
					$list = $this->m_pelanggaran_mitra->get($post['id'])->row();
					if ($list->foto != null) {
						$target_file = './uploads/' . $list->foto;
						unlink($target_file);
					}
					$post['image'] = $this->upload->data('file_name');
					$this->m_pelanggaran_mitra->edit($post);
					$this->m_pegawai_mitra->update_point($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('Admin/pelanggaran_mitra');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('Admin/pelanggaran_mitra/add');
				}
			} else {
				$this->m_pelanggaran_mitra->edit($post);
				$this->m_mitra->update_point($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('Admin/pelanggaran_mitra');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_pelanggaran_mitra->get($id);
		if ($query->num_rows() > 0) {
			$pelanggaran_mitra = $query->row();
			$query_mitra = $this->m_mitra->get();
			$mitra[null] = '- Pilih -';
			$query_pegawai_mitra = $this->m_pegawai_mitra->get();
			$pegawai_mitra[null] = '- Pilih -';
			$query_list_pelanggaran = $this->m_list_pelanggaran->get();
			$list_pelanggaran[null] = '- Pilih -';
			foreach ($query_mitra->result() as $mitra1) {
				$mitra[$mitra1->id_mitra] = $mitra1->nama_mitra;
			}
			foreach ($query_pegawai_mitra->result() as $peg_mitra) {
				$pegawai_mitra[$peg_mitra->id_pegawai_mitra] = $peg_mitra->nama_pegawai_mitra;
			}
			foreach ($query_list_pelanggaran->result() as $list_pel) {
				$list_pelanggaran[$list_pel->id_jenis_pel] = $list_pel->nama_list_pel;
			}

			$data = array(
				'page' => 'edit',
				'row' => $pelanggaran_mitra,
				'mitra' => $mitra, 'selectedmitra' => null,
				'pegawai_mitra' => $pegawai_mitra, 'selectedpegmitra' => null,
				'list_pelanggaran' => $list_pelanggaran, 'selectedlistpel' => null,
			);
			$this->template->load('template', 'Admin/pelanggaran_mitra_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/pelanggaran_mitra') . "';</script>";
		}
	}

	public function del($id)
	{
		$id_pelanggaran_mitra = $this->uri->segment(4);
		$id_pegawai_mitra = $this->uri->segment(5);
		$point_tpel = $this->m_pelanggaran_mitra->get($id_pelanggaran_mitra)->row()->point_tpel;
		$data = ['point_pel' => $point_tpel, 'id_mitra' => $id_pegawai_mitra, 'id_pelanggaran_mitra' => $id_pelanggaran_mitra];
		$this->m_pegawai_mitra->delete_point($data);
		$this->m_pelanggaran_mitra->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/pelanggaran_mitra');
	}

	public function pegawai_mitra($id_mitra = 0){
		$pegawai = $this->m_pegawai_mitra->get_mitra($id_mitra);
		header('Content-Type: application/json');
    	echo json_encode( $pegawai );
	}
}
