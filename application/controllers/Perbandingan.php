<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbandingan extends User_Controller
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
		$this->title 	= "Hasil Perbandingan Metode";
		$this->content 	= "perbandingan/index";
        $this->assets 	= array();
        
        $data['kriteria'] 			= $this->m_kriteria->all()->result();
        $data['area'] 				= $this->m_area->all()->result();
        $tmp_kriteria 	= [];
		foreach ($data['kriteria'] as $item) {
			$tmp_kriteria[] = $item->k_kode;
		}
		$kriteria = $tmp_kriteria;
    	
    	$alternatif 	= [];
		foreach ($data['area'] as $item) {
			$alternatif[] = $item->a_kode;
		}

    	$data['kriteria-reference'] = $this->m_penilaian->kriteria_reference($kriteria,$alternatif);
		$data['ternormalisasi'] 	= $this->m_penilaian->ternormalisasi($kriteria,$alternatif,$data['kriteria-reference']);
		$data['ideal'] 				= $this->m_penilaian->ideal($kriteria,$data['kriteria-reference'],$data['ternormalisasi']);

		$data['alternatif']			= $alternatif;
		$data['kriteria'] 			= $kriteria;

		$data['kriteria-saw'] 		= $this->m_kriteria->all()->result();
        $data['area-saw'] 			= $this->m_area->all()->result();
        $data['normalisasi'] 		= $this->m_saw->normalisasi();
        $data['average'] 			= $this->m_saw->average();
        $data['rangking'] 			= $this->m_saw->rangking();
		$param = array(
            'data' => $data,
		);
		$this->template($param);
	}
}

