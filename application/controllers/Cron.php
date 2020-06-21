<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('m_pegawai');
    }
    
    public function resetPoint(){
        $this->m_pegawai->resetPointPegawai();
    }
}
