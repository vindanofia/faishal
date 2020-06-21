<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_pegawai', 'm_sanksi']);
		// $this->load->library('form_validation');
	}

	function get_ajax()
	{
		$list = $this->m_pegawai->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $pegawai) {
			$no++;
			$row = array();
			// $point = $pegawai->point;
			// $potongan1 = 1000 * $point;
			$row[] = $no . ".";
			// $row[] = $pegawai->barcode . '<br><a href="' . site_url('item/barcode_qrcode/' . $item->item_id) . '" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
			$row[] = $pegawai->nama_pegawai;
			$row[] = $pegawai->nip_pegawai;
			$row[] = $pegawai->telp;
			// $row[] = indo_currency($item->price);
			$row[] = $pegawai->email;
			$row[] = $pegawai->point;
			$row[] = $this->m_sanksi->getSanksiPoint($pegawai->point);
			$row[] = $this->m_sanksi->getPotongan($pegawai->point);
			// $row[] = $item->image != null ? '<img src="' . base_url('uploads/product/' . $item->image) . '" class="img" style="width:100px">' : null;
			// add html for action
			$row[] = '<a href="' . site_url('Admin/pegawai/edit/' . $pegawai->id_pegawai) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                   <a href="' . site_url('Admin/pegawai/del/' . $pegawai->id_pegawai) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_pegawai->count_all(),
			"recordsFiltered" => $this->m_pegawai->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['row'] = $this->m_pegawai->get();
		$this->template->load('template', 'Admin/pegawai', $data);
	}

	public function add()
	{
		$pegawai = new stdClass();
		$pegawai->id_pegawai = null;
		$pegawai->nama_pegawai = null;
		$pegawai->nip_pegawai = null;
		$pegawai->telp = null;
		$pegawai->email = null;
		$data = array(
			'page' => 'add',
			'row' => $pegawai
		);
		$this->template->load('template', 'Admin/pegawai_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_pegawai->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_pegawai->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Admin/pegawai');
	}

	public function edit($id)
	{
		$query = $this->m_pegawai->get($id);
		if ($query->num_rows() > 0) {
			$pegawai = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $pegawai
			);
			$this->template->load('template', 'Admin/pegawai_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Admin/pegawai') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Admin/pegawai');
	}
}
