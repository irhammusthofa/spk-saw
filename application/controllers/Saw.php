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
    
    	$data['kriteria_topsis'] 			= $this->m_kriteria->all()->result();
        $data['area_topsis'] 				= $this->m_area->all()->result();
        $tmp_kriteria 	= [];
		foreach ($data['kriteria_topsis'] as $item) {
			$tmp_kriteria[] = $item->k_kode;
		}
		$kriteria = $tmp_kriteria;
    	
    	$alternatif 	= [];
		foreach ($data['area_topsis'] as $item) {
			$alternatif[] = $item->a_kode;
		}

    	$data['kriteria-reference'] = $this->m_penilaian->kriteria_reference($kriteria,$alternatif);
		$data['ternormalisasi'] 	= $this->m_penilaian->ternormalisasi($kriteria,$alternatif,$data['kriteria-reference']);
		$data['ideal'] 				= $this->m_penilaian->ideal($kriteria,$data['kriteria-reference'],$data['ternormalisasi']);

		$data['alternatif']			= $alternatif;
		$data['kriteria_topsis'] 	= $kriteria;

		$sensitifitas = $this->sensitifitas();
		$jml_topsis = 0;
		foreach ($sensitifitas['sensitifitas_topsis'] as $key => $value){
			if ($key=='presentase') {
				foreach ($sensitifitas['sensitifitas_topsis'][$key]['data'] as $key2 => $value2){
					if($key=='presentase'){
						$jml_topsis = $sensitifitas['sensitifitas_topsis'][$key]['jumlah'];
					}
				}
			}
		}
		$jml_saw = 0;
		foreach ($sensitifitas['sensitifitas'] as $key => $value){
			if ($key=='presentase') {
				foreach ($sensitifitas['sensitifitas'][$key]['data'] as $key2 => $value2){
					if($key=='presentase'){
						$jml_saw = $sensitifitas['sensitifitas'][$key]['jumlah'];
					}
				}
			}
		}
		if($jml_topsis > $jml_saw){
			$data['recomended_method'] = 'Topsis';
			$data['jml_sensitifitas'] = $jml_topsis;
		}else{
			$data['recomended_method'] = 'SAW';
			$data['jml_sensitifitas'] = $jml_saw;
		}
		$param = array(
            'data' => $data,
		);
		$this->load->view('penilaian/print',$param);
	}
	private function sensitifitas(){
		$data['kriteria'] 			= $this->m_kriteria->all()->result();
        $data['area'] 				= $this->m_area->all()->result();
        $tmp_kriteria 	= [];
		
		$kriteria = $tmp_kriteria;
    	$sensitifitas = [];
    	$alternatif 	= [];
    	$max = 0;
		foreach ($data['area'] as $area) {
			$val = 0;
			foreach ($data['kriteria'] as $kriteria) {
				$param['area'] 		= $area->a_kode;
				$param['kriteria'] 	= $kriteria->k_kode;
				$nilai = $this->m_penilaian->penilaian_kriteria_area_2($param)->row();
				
				if (!empty($nilai)){
					$tmp_val = $nilai->pn_nilai/5;
					$tmp_val = $tmp_val * ($kriteria->k_bobot/100);
					$val = $val + $tmp_val;
				}
			}
			if ($max<$val){
				$max = $val;
			}
			$alternatif[$area->a_kode] = $val;
		}
		$sensitifitas['awal'] = array('data'=>$alternatif,'max'=>$max,'perubahan'=>0);
		$max_awal = $max;
		$i = 0;
		$presentase = [];
		$jumlah_presentase = 0;
		foreach ($data['kriteria'] as $k) {
			$max = 0;
			$i++;
			$alternatif = [];
			foreach ($data['area'] as $area) {
				$val = 0;
				foreach ($data['kriteria'] as $kriteria) {
					$param['area'] 		= $area->a_kode;
					$param['kriteria'] 	= $kriteria->k_kode;
					$nilai = $this->m_penilaian->penilaian_kriteria_area_2($param)->row();
					
					if (!empty($nilai)){
						$tmp_val = $nilai->pn_nilai/5;
						if ($k->k_kode==$kriteria->k_kode){
							$tmp_val = $tmp_val * (($kriteria->k_bobot/100)+0.5);	
						}else{
							$tmp_val = $tmp_val * ($kriteria->k_bobot/100);
						}
						
						$val = $val + $tmp_val;
					}
				}
				$alternatif[$area->a_kode] = $val;

				if ($max<$val){
					$max = $val;
				}
			}
			$perubahan = $max-$max_awal;
			$sensitifitas['K'.$i] = array('data'=>$alternatif,'max'=>$max,'perubahan'=>round($perubahan,2));
			$presentase['K'.$i] = round($perubahan,2);
			$jumlah_presentase += round($perubahan,2);
			//$max_awal = $max;
		}
		$sensitifitas['presentase'] = array('data'=>$presentase,'jumlah'=>$jumlah_presentase);
		$data['sensitifitas'] = $sensitifitas;

		// Topsis
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
		$data['kriteria_lengkap'] 	= $this->m_kriteria->all()->result();

		// awal
		$max = 0;
		$topsis_alternatif = [];
		foreach ($data['area'] as $area) {
			$nilai = round($this->m_penilaian->relative_closeness($area->a_kode,$data['kriteria'],$data['alternatif'])['rc'],4);	
			if ($max<$nilai){
				$max = $nilai;
			}
			$topsis_alternatif[$area->a_kode] = $nilai;
		}
		$sensitifitas_topsis['awal'] = array('data'=>$topsis_alternatif,'max'=>$max,'perubahan'=>0);
		
		$topsis_alternatif = [];
		$i = 0;
		$max_awal = $max;
		$presentase_topsis = [];
		$jumlah_presentase_topsis = 0;
		foreach ($data['kriteria_lengkap'] as $k) {
			$i++;
			$max = 0;
			$topsis_alternatif = [];
			foreach ($data['area'] as $area) {
				$nilai = round($this->m_penilaian->relative_closeness($area->a_kode,$data['kriteria'],$data['alternatif'],$k->k_kode)['rc'],4);	
				if ($max<$nilai){
					$max = $nilai;
				}
				$topsis_alternatif[$area->a_kode] = $nilai;
			}
			$perubahan = $max-$max_awal;
			//$max_awal = $max;
			$sensitifitas_topsis['K'.$i] = array('data'=>$topsis_alternatif,'max'=>$max,'perubahan'=>round($perubahan,4));
			$presentase_topsis['K'.$i] = round($perubahan,4);
			$jumlah_presentase_topsis += round($perubahan,4);
		}
		$sensitifitas_topsis['presentase'] = array('data'=>$presentase_topsis,'jumlah'=>$jumlah_presentase_topsis);
		$data['sensitifitas_topsis'] = $sensitifitas_topsis;

		return $data;
	}
	
}
