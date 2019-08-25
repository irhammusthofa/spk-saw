<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaianjuri extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->load->model('m_area');
		$this->load->model('m_juri');
		$this->load->model('m_penilaian');

	}
	public function index()
	{
		$this->title 	= "Data Penilaian";
		$this->content 	= "penilaianjuri/list";
		$this->assets 	= array('assets');

		$param = array(
		);
		$this->template($param);
	}
	public function edit($id)
	{

		$this->title 	= "Form Edit Penilaian";
		$this->content 	= "penilaianjuri/edit";
		$this->assets 	= array('assets_form');

		$id = base64_decode($id);
		$data['juri'] = $this->m_juri->by_user($this->user->u_id)->row();
        $data['area'] = $this->m_area->by_id($id)->row();
        $data['penilaian'] = $this->m_penilaian->penilaian_by_area($id,$data['juri']->j_id)->result();

		$param = array(
			'data'	=> $data,
		);
		$this->template($param);

	}
	public function save($id,$juri)
	{
        $id = base64_decode($id);
        $juri = base64_decode($juri);

        if ($this->m_penilaian->save($id,$juri)) {
            fs_create_alert(['type' => 'success', 'message' => 'Data Penilaian berhasil disimpan.']);
            redirect('juri/penilaian/edit/'.base64_encode($id));
        } else {
            $this->session->set_flashdata("temp", $_POST);
            fs_create_alert(['type' => 'danger', 'message' => 'Data Penilaian gagal disimpan.']);
            redirect('juri/penilaian/edit/'.base64_encode($id));
        }
	}
	
	public function ajax_list()
	{
		$juri = $this->m_juri->by_user($this->user->u_id)->row();
		$param['id_juri'] = $juri->j_id;
		$list = $this->m_area->get_datatables($param);
		$data = array();

		$no = $_POST['start'];

		foreach ($list as $tps) {
			$arrParam = array(
				'id' => base64_encode($tps->a_kode),
				'nama' => $tps->a_nama,
			);

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
                        <li>' . anchor("juri/penilaian/edit/" . base64_encode($tps->a_kode), "<i class=\"fa fa-edit\"></i>Edit") . '</li>
					</ul>
                </div>';
            $btninsert = anchor("juri/penilaian/edit/" . base64_encode($tps->a_kode), "<i class=\"fa fa-edit\"></i> Input Nilai",array('class'=>'btn btn-xs btn-primary'));
			$no++;
			$row = array();
			$row[] = $tps->a_kode;
			$row[] = $tps->a_nama;
			$row[] = $tps->a_alamat;
			$row[] = $btninsert;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_area->count_all($param),
			"recordsFiltered" => $this->m_area->count_filtered($param),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
}
