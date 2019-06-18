<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grafik extends User_Controller
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
		$this->title 	= "Grafik Penilaian" ;
		$this->content 	= "grafik/index";
        $this->assets 	= array('assets');
    
		$param = array(
		);
		$this->template($param);
    }
    public function loadgrafik(){
        $data['area'] 				= $this->m_area->all()->result();
        $data['normalisasi'] 		= $this->m_saw->normalisasi();
        $data['average'] 			= $this->m_saw->average();
        $data['rangking'] 			= $this->m_saw->rangking();

        $arrArea = [];
        $arrVal = [];
        foreach ($data['area'] as $area) {
            $arrArea[]  = $area->a_kode.' - '.$area->a_nama;
            $arrVal[]   = $data['average'][$area->a_kode];
            $arrRank[]  = $data['rangking'][$area->a_kode];
        }
        echo json_encode(array(
            'status' => true,
            'messag' => 'Berhasil',
            'area'   => $arrArea,
            'rata'   => $arrVal,
            'rank'   => $arrRank,
        ));
    }
	
}
