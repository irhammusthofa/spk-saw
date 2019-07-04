<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->load->model('m_histori');

	}
	public function index()
	{
		$this->title 	= "Data Histori";
		$this->content 	= "histori/list";
		$this->assets 	= array('assets');

		$param = array(
		);
		$this->template($param);
		$this->load_view('modal_area');
		$this->load_view('modal_kriteria');
		$this->load_view('modal_nilai');
	}
	
	public function ajax_list()
	{

		$list = $this->m_histori->get_datatables();
		$data = array();

		$no = $_POST['start'];

		foreach ($list as $tps) {
			$arrParam = array(
				'before' => json_decode($tps->h_before),
				'after' => json_decode($tps->h_after),
				'user' => $tps->h_user,
				'tabel' =>$tps->h_table,
				'tipe' =>$tps->h_tipe,
			);
			if ($tps->h_table=="area"){
				$btnmodal = '<a href="#" class="btn btn-xs btn-primary" onclick="showArea(\''.htmlspecialchars(json_encode($arrParam),ENT_QUOTES).'\')"><i class="fa fa-eye"></i> Lihat</a>';	
			}else if ($tps->h_table=="kriteria"){
				$btnmodal = '<a href="#" class="btn btn-xs btn-primary" onclick="showKriteria(\''.htmlspecialchars(json_encode($arrParam),ENT_QUOTES).'\')"><i class="fa fa-eye"></i> Lihat</a>';	
			}else if ($tps->h_table=="penilaian"){
				$btnmodal = '<a href="#" class="btn btn-xs btn-primary" onclick="showNilai(\''.htmlspecialchars(json_encode($arrParam),ENT_QUOTES).'\')"><i class="fa fa-eye"></i> Lihat</a>';	
			}
			
                
			$no++;
			$row = array();
			$row[] = $tps->h_tgl;
			$row[] = $tps->h_user;
			$row[] = $tps->h_tipe;
			$row[] = $tps->h_table;
			$row[] = $btnmodal;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_histori->count_all(),
			"recordsFiltered" => $this->m_histori->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
}
