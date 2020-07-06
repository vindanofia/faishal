<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excel
{
	public function __construct(){
		$CI =&get_instance();

		$CI->load->model(['m_sanksi', 'm_pegawai', 'm_pegawai_mitra']);
		$this->m_sanksi = $CI->m_sanksi;
		$this->m_pegawai = $CI->m_pegawai;
		$this->m_pegawai_mitra = $CI->m_pegawai_mitra;
	}

    public function getExcel($type){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	
		$excel = new PHPExcel();
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		switch($type){
			case 'pegawai' :
				$data = $this->m_pegawai->get()->result();
				$key_data = array('nama_pegawai', 'nip_pegawai', 'point', 'potongan');
				$header = 'DATA PEGAWAI';
				break;
			case 'pegawai_mitra' :
				$data = $this->m_pegawai_mitra->get()->result();
				$key_data = ['nama_pegawai_mitra', 'nip_pegawai_mitra', 'point_peg_mitra', 'potongan_peg_mitra'];
				$header = 'DATA PEGAWAI MITRA';
				break;
			default :
				$data = null;
		}

		$excel->setActiveSheetIndex(0)->setCellValue('A1', $header);
		$excel->getActiveSheet()->mergeCells('A1:F1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

		$excel->getActiveSheet()->getStyle('A2')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B2')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C2')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D2')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E2')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F2')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('A2', 'NO.');
		$excel->setActiveSheetIndex(0)->setCellValue('B2', 'NAMA PEGAWAI');
		$excel->setActiveSheetIndex(0)->setCellValue('C2', 'NIP PEGAWAI');
		$excel->setActiveSheetIndex(0)->setCellValue('D2', 'SANKSI');
		$excel->setActiveSheetIndex(0)->setCellValue('E2', 'POINT');
		$excel->setActiveSheetIndex(0)->setCellValue('F2', 'POTONGAN');

		$no = 1;
		$numrow = 3;
		if($data != null){
			foreach($data as $pegawai){
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $pegawai->{$key_data[0]});
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $pegawai->{$key_data[1]});
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $this->m_sanksi->getSanksi($pegawai->{$key_data[2]}));
				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $pegawai->{$key_data[2]});
				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $this->m_sanksi->getSanksi($pegawai->{$key_data[3]}, true));
	
				$excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$excel->getActiveSheet()->getStyle('E'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$excel->getActiveSheet()->getStyle('F'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
	
				$numrow++;
				$no++;
			}
		}
		
        return $excel;
    }
}
