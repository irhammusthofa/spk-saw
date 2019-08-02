<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topsis extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->load->model('m_area');
		$this->load->model('m_kriteria');
		$this->load->model('m_penilaian');

	}
	public function index()
	{
		$this->title 	= "Hasil Penilaian Topsis";
		$this->content 	= "penilaian/topsis";
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
		$param = array(
            'data' => $data,
		);
		$this->template($param);
	}
}

