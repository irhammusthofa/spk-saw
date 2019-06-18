<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->load->model('m_kriteria');

	}
	public function index()
	{
		$this->title 	= "Data Kriteria";
		$this->content 	= "kriteria/list";
		$this->assets 	= array('assets');

		$param = array(
		);
		$this->template($param);
		$this->load_view('modal_hapus');
	}
	public function add()
	{
		$this->title 	= "Form Tambah";
		$this->content 	= "kriteria/add";
		$this->assets 	= array('assets_form');
		
		$param = array(
		);
		$this->template($param);
	}
	public function edit($id)
	{

		$this->title 	= "Form Edit";
		$this->content 	= "kriteria/edit";
		$this->assets 	= array('assets_form');

		$id = base64_decode($id);
        $data['kriteria'] = $this->m_kriteria->by_id($id)->row();
        
		$param = array(
			'data'	=> $data,
		);
		$this->template($param);

	}
	public function save()
	{
		$this->form_validation->set_rules('kode', 'Kode Kriteria', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

        
		if ($this->form_validation->run() == false) {
			fs_create_alert(['type' => 'danger', 'message' => validation_errors()]);
			redirect('user/kriteria/add');
		} else{

			if ($this->m_kriteria->save()) {
                fs_create_alert(['type' => 'success', 'message' => 'Data kriteria baru berhasil disimpan.']);
                redirect('user/kriteria/add');
            } else {
                $this->session->set_flashdata("temp", $_POST);
                fs_create_alert(['type' => 'danger', 'message' => 'Data kriteria gagal disimpan.']);
                redirect('user/kriteria/add');
            }
		}
	}
	public function update($id)
	{
		$id = base64_decode($id);
		$kriteria = $this->m_kriteria->by_id($id)->row();
		if (empty($kriteria)){
			fs_create_alert(['type' => 'danger', 'message' => 'Data kriteria tidak ditemukan.']);	
			redirect('user/kriteria/edit/'.base64_encode($id));
			return;
		}

		$this->form_validation->set_rules('kode', 'Kode kriteria', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if ($this->form_validation->run() == false) {
			fs_create_alert(['type' => 'danger', 'message' => validation_errors()]);
			redirect('user/kriteria/edit/'.base64_encode($id));
		} else{
			if ($this->m_kriteria->update($id)) {
                fs_create_alert(['type' => 'success', 'message' => 'Data kriteria berhasil diupdate.']);
                redirect('user/kriteria/edit/'.base64_encode($id));
            } else {
                $this->session->set_flashdata("temp", $_POST);
                fs_create_alert(['type' => 'danger', 'message' => 'Data kriteria gagal diupdate.']);
                redirect('user/kriteria/edit/'.base64_encode($id));
            }
		}
	}
	public function ajax_list()
	{

		$list = $this->m_kriteria->get_datatables();
		$data = array();

		$no = $_POST['start'];

		foreach ($list as $tps) {
			$arrParam = array(
				'id' => base64_encode($tps->k_kode),
				'nama' => $tps->k_nama,
			);
			$btnhapus = '<a href="#" onclick="hapusKriteria(\''.htmlspecialchars(json_encode($arrParam),ENT_QUOTES).'\')"><i class="fa fa-trash"></i>Hapus</a>';
			$btngroup_disable = '<div class="input-group">
			<button type="button" class="btn btn-xs btn-default pull-right dropdown-toggle" data-toggle="dropdown" disabled>
				<span> Action
				</span>
				<i class="fa fa-caret-down"></i>
			</button>
		</div>';
			$btngroup = '<div class="input-group">
					<button type="button" class="btn btn-xs btn-default pull-right dropdown-toggle" data-toggle="dropdown">
						<span> Action
						</span>
						<i class="fa fa-caret-down"></i>
					</button>
					<ul class="dropdown-menu">
                        <li>' . anchor("user/kriteria/edit/" . base64_encode($tps->k_kode), "<i class=\"fa fa-edit\"></i>Edit") . '</li>
                        <li>'.$btnhapus.'</li>
					</ul>
                </div>';
                
			$no++;
			$row = array();
			$row[] = $tps->k_kode;
			$row[] = $tps->k_nama;
			$row[] = $tps->k_bobot;
			$row[] = $btngroup;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_kriteria->count_all(),
			"recordsFiltered" => $this->m_kriteria->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	public function delete($id)
	{
		$id = base64_decode($id);
		$data['k_kode'] = $id;
		
		if ($this->m_kriteria->delete($data)) {
			fs_create_alert(['type' => 'success', 'message' => 'Data kriteria berhasil dihapus.']);
		} else {
			fs_create_alert(['type' => 'danger', 'message' => 'Data kriteria gagal dihapus.']);
		}
		redirect('user/kriteria');
	}
	
}
