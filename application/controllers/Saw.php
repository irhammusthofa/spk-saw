<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saw extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->load->model('m_area');
		$this->load->model('m_kriteria');
		$this->load->model('m_penilaian');
		$this->load->model('m_saw');

	}
	public function index()
	{
		$this->title 	= "Hasil Penilaian SAW";
		$this->content 	= "penilaian/saw";
        $this->assets 	= array();
        
        $data['kriteria'] 			= $this->m_kriteria->all()->result();
        $data['area'] 				= $this->m_area->all()->result();
        $data['normalisasi'] 		= $this->m_saw->normalisasi();
        $data['average'] 			= $this->m_saw->average();
        $data['rangking'] 			= $this->m_saw->rangking();
    
		$param = array(
            'data' => $data,
		);
		$this->template($param);
	}
	public function cetak_lengkap(){
        
        $data['kriteria'] 			= $this->m_kriteria->all()->result();
        $data['area'] 				= $this->m_area->all()->result();
        $data['normalisasi'] 		= $this->m_saw->normalisasi();
        $data['average'] 			= $this->m_saw->average();
        $data['rangking'] 			= $this->m_saw->rangking();
    
		$param = array(
            'data' => $data,
		);
		$this->load->view('penilaian/saw_lengkap',$param);
	}
	public function cetak(){
        
        $data['kriteria'] 			= $this->m_kriteria->all()->result();
        $data['area'] 				= $this->m_area->all()->result();
        $data['normalisasi'] 		= $this->m_saw->normalisasi();
        $data['average'] 			= $this->m_saw->average();
        $data['rangking'] 			= $this->m_saw->rangking();
    
		$param = array(
            'data' => $data,
		);
		$this->load->view('penilaian/print',$param);
	}
	
}
