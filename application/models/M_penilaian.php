<?php

class M_penilaian extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->model('m_kriteria');
        $this->load->model('m_area');
    }
    public function penilaian_by_area($id){
        return $this->db->from('kriteria k')
            ->join('penilaian p','p.id_kriteria=k.k_kode and p.id_area="'.$id.'"','left')
            ->order_by('k.k_kode','asc')
            ->get();
    }
    public function get_max_kriteria($kriteria){
        return $this->db->select('max(pn_nilai) as max')
            ->from('penilaian p')
            ->where('id_kriteria',$kriteria)
            ->get()->row()->max;
    }
    public function penilaian_kriteria_area($param){
        return $this->db->from('penilaian')
            ->where('id_area',$param['area'])
            ->where('id_kriteria',$param['kriteria'])
            ->get();
    }
    public function penilaian_all(){
        return $this->db->from('kriteria k')
            ->join('penilaian p','p.id_kriteria=k.k_kode','left')
            ->get();
    }
    public function by_id($id){
        return $this->db->from('penilaian p')
            ->join('area a','a.a_kode=p.id_area','inner')
            ->join('kriteria k','k.k_kode=p.id_kriteria','inner')
            ->where('p.pn_id',$id)
            ->get();
    }
    public function save($id){

        $kriteria = $this->penilaian_by_area($id)->result();
        $this->db->trans_begin();
        foreach ($kriteria as $item) {
            $data['id_area']        = $id;
            $data['id_kriteria']    = $item->k_kode;
            $data['pn_nilai']        = $this->input->post($item->k_kode,TRUE);
            $param['area']          = $data['id_area'];
            $param['kriteria']      = $data['id_kriteria'];

            $penilaian = $this->penilaian_kriteria_area($param)->row();
            if (empty($penilaian)){
                $this->insert($data);
            }else{
                $this->update($penilaian->pn_id,$data);
            }
            
        }
        if ($this->db->trans_status()===FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }
        return $this->db->trans_status();
    }
    public function insert($data){
        
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $area = $this->m_area->by_id($data['id_area'])->row();
        $kriteria = $this->m_kriteria->by_id($data['id_kriteria'])->row();
        $this->db->query('SET @a_nama_a="'.$area->a_nama.'"');
        $this->db->query('SET @k_nama_a="'.$kriteria->k_nama.'"');

        return $this->db->insert('penilaian',$data);
    }
    public function update($id,$data){

        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $old = $this->by_id($id)->row();
        $area = $this->m_area->by_id($data['id_area'])->row();
        $kriteria = $this->m_kriteria->by_id($data['id_kriteria'])->row();
        $this->db->query('SET @a_nama_a="'.$area->a_nama.'"');
        $this->db->query('SET @k_nama_a="'.$kriteria->k_nama.'"');
        
        $this->db->query('SET @a_nama_b="'.$old->a_nama.'"');
        $this->db->query('SET @k_nama_b="'.$old->k_nama.'"');

        return $this->db->where('pn_id',$id)->update('penilaian',$data);
    }
}
