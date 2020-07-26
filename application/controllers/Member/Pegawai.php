<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_pegawai', 'm_sanksi']);
		$this->load->helper(array('url', 'download'));
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
			$row[] = '<a href="' . site_url('Member/pegawai/edit/' . $pegawai->id_pegawai) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Ubah</a>
                   <a href="' . site_url('Member/pegawai/del/' . $pegawai->id_pegawai) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>';
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
		$this->template->load('template_member', 'Member/pegawai', $data);
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
		$this->template->load('template_member', 'Member/pegawai_form', $data);
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
		redirect('Member/pegawai');
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
			$this->template->load('template_member', 'Member/pegawai_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/pegawai') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_pegawai->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/pegawai');
	}

	public function downloadFormat()
	{
		force_download('./uploads/data_pegawai/Format import excel pegawai.xlsx', NULL);
	}

	public function import()
	{
		$data = array(
			'page' => 'Import',
		);
		$this->template->load('template_member', 'Member/pegawai_form_import', $data);
	}

	public function processImport()
	{
		$this->load->helper('url');
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$config['upload_path'] = './uploads/excel_pegawai';
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['max_size'] = '10000';
		$config['file_name'] = 'data_pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);

		if (isset($_FILES['file_excel'])) {
			if ($this->upload->do_upload('file_excel')) {
				$data_upload 	= $this->upload->data();
				$excelreader	= new PHPExcel_Reader_Excel2007();
				$loadexcel		= $excelreader->load('uploads/excel_pegawai/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
				$sheet       	= $loadexcel->getActiveSheet()->toArray(null, true, true, true);

				foreach ($sheet as $key => $data) {
					if ($key > 2) {
						$this->m_pegawai->add([
							'nama_peg' => $data['A'],
							'nip_peg' => $data['B'],
							'telp' => $data['C'],
							'email' => $data['D'],
						]);
					}
				}
				redirect('/Member/pegawai', 'refresh');
			}
		} else {
			echo "<script>alert('Input File Excel');";
			echo "window.location='" . site_url('Member/pegawai') . "';</script>";
		}
	}

	public function export()
	{
		require_once(APPPATH . 'controllers/Excel.php');
		$exportExcel =  new Excel();
		$excel = $exportExcel->getExcel('pegawai');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pegawai_' . date('ymd') . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}
