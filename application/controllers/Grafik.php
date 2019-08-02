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
    public function index2()
    {
        $this->title    = "Grafik Penilaian" ;
        $this->content  = "grafik/index2";
        $this->assets   = array('assets2');
    
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
        $arrRank = [];
        foreach ($data['area'] as $area) {
            $arrArea[]  = $area->a_kode.' - '.$area->a_nama;
            $arrVal[]   = $data['average'][$area->a_kode];
            $arrRank[]  = $data['rangking'][$area->a_kode];
        }
        echo json_encode(array(
            'status' => (count($data['area'])>0),
            'message' => (count($data['area'])>0) ? 'Berhasil' : 'Tidak ada data',
            'area'   => $arrArea,
            'rata'   => $arrVal,
            'rank'   => $arrRank,
        ));
    }
	public function loadgrafik2(){
        $data['kriteria']          = $this->m_kriteria->all()->result();
        $data['area']               = $this->m_area->all()->result();
        $tmp_kriteria   = [];
        foreach ($data['kriteria'] as $item) {
            $tmp_kriteria[] = $item->k_kode;
        }
        $kriteria = $tmp_kriteria;
        
        $alternatif     = [];
        foreach ($data['area'] as $item) {
            $alternatif[] = $item->a_kode;
        }

        $data['kriteria-reference'] = $this->m_penilaian->kriteria_reference($kriteria,$alternatif);
        $data['ternormalisasi']     = $this->m_penilaian->ternormalisasi($kriteria,$alternatif,$data['kriteria-reference']);
        $data['ideal']              = $this->m_penilaian->ideal($kriteria,$data['kriteria-reference'],$data['ternormalisasi']);

        $data['alternatif']         = $alternatif;
        $data['kriteria']           = $kriteria;
        $data['average']            = [];
        $data['rangking']            = [];
        foreach (@$data['area'] as $tim) {
              $data['average'][$tim->a_kode] = round($this->m_penilaian->relative_closeness($tim->a_kode,$data['kriteria'],$data['alternatif'])['rc'],4);
              $data['rangking'][$tim->a_kode] = $this->m_penilaian->rangking($tim->a_kode,$data['kriteria'],$data['alternatif']) ;
        }

        $arrArea = [];
        $arrVal = [];
        $arrRank = [];
        foreach ($data['area'] as $area) {
            $arrArea[]  = $area->a_kode.' - '.$area->a_nama;
            $arrVal[]   = $data['average'][$area->a_kode];
            $arrRank[]  = $data['rangking'][$area->a_kode];
        }
        echo json_encode(array(
            'status' => (count($data['area'])>0),
            'message' => (count($data['area'])>0) ? 'Berhasil' : 'Tidak ada data',
            'area'   => $arrArea,
            'rata'   => $arrVal,
            'rank'   => $arrRank,
        ));
    }
}
