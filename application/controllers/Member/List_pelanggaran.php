<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_pelanggaran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_list_pelanggaran');
		// $this->load->library('form_validation');
	}
	public function index()
	{
		$data['row'] = $this->m_list_pelanggaran->get();
		$this->template->load('template_member', 'Member/list_pelanggaran', $data);
	}

	public function add()
	{
		$list_pelanggaran = new stdClass();
		$list_pelanggaran->id_list_pel = null;
		$list_pelanggaran->nama_list_pel = null;
		$list_pelanggaran->point_pel = null;

		$data = array(
			'page' => 'add',
			'row' => $list_pelanggaran,
		);
		$this->template->load('template', 'Member/list_pelanggaran_form', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->m_list_pelanggaran->add($post);
		} else if (isset($_POST['edit'])) {
			$this->m_list_pelanggaran->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('Member/list_pelanggaran');
	}

	public function edit($id)
	{
		$query = $this->m_list_pelanggaran->get($id);
		if ($query->num_rows() > 0) {
			$list_pelanggaran = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $list_pelanggaran,
			);
			$this->template->load('template', 'Member/list_pelanggaran_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('Member/list_pelanggaran') . "';</script>";
		}
	}

	public function del($id)
	{
		$this->m_list_pelanggaran->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('Member/list_pelanggaran');
	}


	public function get_chart_data($period = null){
		$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 
		'Oktober', 'Nopember', 'Desember'];
		if($period != null){
			$period = explode("_",$period);
			$bulan = intval(date("m", strtotime($period[0])));
			$tahun = $period[1];
			$title = 'bulan '.$months[$bulan-1].' tahun '.$tahun;
		}else{
			$tahun = $bulan = 0;
			$title = 'Bulan - Tahun -';
		}
		
		$result = $this->m_list_pelanggaran->chartDataPelPegawai($tahun, $bulan);
		$result['title'] .= $title;

		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
