<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model(['m_pegawai', 'm_pegawai_mitra']);
    }
    
    public function resetPointPegawai(){
        $this->m_pegawai->resetPointPegawai();
    }

    public function resetPointMitra(){
        $this->m_pegawai_mitra->resetPointPegawai();
    }
}
