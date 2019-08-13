<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sensitifitas extends User_Controller
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
		$this->title 	= "Uji Sensitifitas Metode";
		$this->content 	= "sensitifitas/index";
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
		$param = array(
            'data' => $data,
		);
		$this->template($param);
	}
}

