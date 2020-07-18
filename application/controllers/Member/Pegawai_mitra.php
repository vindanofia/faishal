<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_mitra extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_pegawai_mitra', 'm_sanksi_mitra', 'm_mitra']);
		// $this->load->library('form_validation');
	}

	function get_ajax()
	{
		$list = $this->m_pegawai_mitra->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $pegawai_mitra) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $pegawai_mitra->nama_mitra;
			$row[] = $pegawai_mitra->nama_pegawai_mitra;
			$row[] = $pegawai_mitra->nip_pegawai_mitra;
			$row[] = $pegawai_mitra->telp_peg_mitra;
			$row[] = $pegawai_mitra->point_peg_mitra;
			$row[] = $this->m_sanksi_mitra->getSanksi_mitraPoint($pegawai_mitra->point_peg_mitra);
			$row[] = $this->m_sanksi_mitra->getPotongan($pegawai_mitra->point_peg_mitra);
			$row[] = '<a href="' . site_url('Member/pegawai_mitra/edit/' . $pegawai_mitra->id_pegawai_mitra) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                   <a href="' . site_url('Member/pegawai_mitra/del/' . $pegawai_mitra->id_pegawai_mitra) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_pegawai_mitra->count_all(),
			"recordsFiltered" => $this->m_pegawai_mitra->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['row'] = $this->m_pegawai_mitra->get();
		$this->template->load('template_member', 'Member/pegawai_mitra', $data);
	}

	public function add()
	{
		$pegawai_mitra = new stdClass();
		$pegawai_mitra->id_pegawai_mitra = null;
		$pegawai_mitra->nama_pegawai_mitra = null;
		$pegawai_mitra->nip_pegawai_mitra = null;
		$pegawai_mitra->telp_peg_mitra = null;

		$query_mitra = $this->m_mitra->get();
		$mitra[null] = '- Pilih -';
		foreach ($query_mitra->result() as $mitra1) {
			$mitra[$mitra1->id_mitra] = $mitra1->nama_mitra;
		}

		$data = array(
			'page' => 'add',
			'row' => $pegawai_mitra,
			'mitra' => $mitra, 'selectedmitra' => null,
		);
		$this->template->load('template_member', 'Member/pegawai_mitra_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_pegawai_mitra->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_pegawai_mitra->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Member/pegawai_mitra');
	}

	public function edit($id)
	{
		$query = $this->m_pegawai_mitra->get($id);
		if ($query->num_rows() > 0) {
			$pegawai_mitra = $query->row();
			$query_mitra = $this->m_mitra->get();
			$mitra[null] = '- Pilih -';
			foreach ($query_mitra->result() as $mitra1) {
				$mitra[$mitra1->id_mitra] = $mitra1->nama_mitra;
			}

			$data = array(
				'page' => 'edit',
				'row' => $pegawai_mitra,
				'mitra' => $mitra, 'selectedmitra' => $pegawai_mitra->id_perusahaan,
			);
			$this->template->load('template_member', 'Member/pegawai_mitra_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/pegawai_mitra') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_pegawai_mitra->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/pegawai_mitra');
	}

	public function export()
	{
		require_once(APPPATH . 'controllers/Excel.php');
		$exportExcel =  new Excel();
		$excel = $exportExcel->getExcel('pegawai_mitra');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pegawai Mitra_' . date('ymd') . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}
