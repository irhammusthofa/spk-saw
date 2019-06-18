<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends User_Controller {

	public function __construct(){
		parent::__construct();
        $this->auth();
        $this->load->model('m_area');
        $this->load->model('m_kriteria');
        $this->load->model('m_saw');

	}
	public function index()
	{
		$this->title 	= "Dashboard";
		$this->content 	= "dashboard/index";
		$this->assets 	= array('assets');
        
        $count['area'] = $this->m_area->count();
        $count['kriteria'] = $this->m_kriteria->count();
        $data['rangking'] 			= $this->m_saw->rangking();
        $data['top-ranking'] = "";
        foreach ($data['rangking'] as $key => $value) {
        	$area = $this->m_area->by_id($key)->row();
        	$data['top-ranking'] = $area->a_nama;
        	break;
        }
		$param = array(
        	'count' => $count,
        	'data' => $data,
        );
		$this->template($param);
	}
        public function loadmap(){

                $data['area'] = $this->m_area->all()->result();
                $data['json_area'] = json_encode($data['area']);

                echo $data['json_area'];
        }
}
