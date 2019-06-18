<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->load->model('m_area');

	}
	public function index()
	{
		$this->title 	= "Data Area";
		$this->content 	= "area/list";
		$this->assets 	= array('assets');

		$param = array(
		);
		$this->template($param);
		$this->load_view('modal_hapus');
	}
	public function add()
	{
		$this->title 	= "Form Tambah";
		$this->content 	= "area/add";
		$this->assets 	= array('assets_form');
		
		$param = array(
		);
		$this->template($param);
	}
	public function edit($id)
	{

		$this->title 	= "Form Edit";
		$this->content 	= "area/edit";
		$this->assets 	= array('assets_form');

		$id = base64_decode($id);
        $data['area'] = $this->m_area->by_id($id)->row();
        
		$param = array(
			'data'	=> $data,
		);
		$this->template($param);

	}
	public function save()
	{
		$this->form_validation->set_rules('kode', 'Kode Area', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

        
		if ($this->form_validation->run() == false) {
			fs_create_alert(['type' => 'danger', 'message' => validation_errors()]);
			redirect('user/area/add');
		} else{

			if ($this->m_area->save()) {
                fs_create_alert(['type' => 'success', 'message' => 'Data Area baru berhasil disimpan.']);
                redirect('user/area/add');
            } else {
                $this->session->set_flashdata("temp", $_POST);
                fs_create_alert(['type' => 'danger', 'message' => 'Data Area gagal disimpan.']);
                redirect('user/area/add');
            }
		}
	}
	public function update($id)
	{
		$id = base64_decode($id);
		$area = $this->m_area->by_id($id)->row();
		if (empty($area)){
			fs_create_alert(['type' => 'danger', 'message' => 'Data Area tidak ditemukan.']);	
			redirect('user/area/edit/'.base64_encode($id));
			return;
		}

		$this->form_validation->set_rules('kode', 'Kode Area', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if ($this->form_validation->run() == false) {
			fs_create_alert(['type' => 'danger', 'message' => validation_errors()]);
			redirect('user/area/edit/'.base64_encode($id));
		} else{
			if ($this->m_area->update($id)) {
                fs_create_alert(['type' => 'success', 'message' => 'Data Area berhasil diupdate.']);
                redirect('user/area/edit/'.base64_encode($id));
            } else {
                $this->session->set_flashdata("temp", $_POST);
                fs_create_alert(['type' => 'danger', 'message' => 'Data Area gagal diupdate.']);
                redirect('user/area/edit/'.base64_encode($id));
            }
		}
	}
	public function ajax_list()
	{

		$list = $this->m_area->get_datatables();
		$data = array();

		$no = $_POST['start'];

		foreach ($list as $tps) {
			$arrParam = array(
				'id' => base64_encode($tps->a_kode),
				'nama' => $tps->a_nama,
			);
			$btnhapus = '<a href="#" onclick="hapusArea(\''.htmlspecialchars(json_encode($arrParam),ENT_QUOTES).'\')"><i class="fa fa-trash"></i>Hapus</a>';
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
                        <li>' . anchor("user/area/edit/" . base64_encode($tps->a_kode), "<i class=\"fa fa-edit\"></i>Edit") . '</li>
                        <li>'.$btnhapus.'</li>
					</ul>
                </div>';
                
			$no++;
			$row = array();
			$row[] = $tps->a_kode;
			$row[] = $tps->a_nama;
			$row[] = $tps->a_alamat;
			$row[] = $tps->a_telp;
			$row[] = $tps->a_kordinat;
			$row[] = $btngroup;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_area->count_all(),
			"recordsFiltered" => $this->m_area->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	public function delete($id)
	{
		$id = base64_decode($id);
		$data['a_kode'] = $id;
		
		if ($this->m_area->delete($data)) {
			fs_create_alert(['type' => 'success', 'message' => 'Data Area berhasil dihapus.']);
		} else {
			fs_create_alert(['type' => 'danger', 'message' => 'Data Area gagal dihapus.']);
		}
		redirect('user/area');
	}
	
}
