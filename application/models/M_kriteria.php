<?php

class M_kriteria extends CI_Model
{
    var $_table = 'kriteria';

    var $table = 'kriteria c';
    var $column_order = array('c.k_kode', 'c.k_nama','c.k_bobot'); //set column field database for datatable orderable
    var $column_search = array('c.k_kode', 'c.k_nama','c.k_bobot'); //set column field database for datatable searchable
    var $order = array('c.k_kode' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query($param='')
    {
        $this->db->from($this->table);
        $this->db->where('id_tahun',$this->thn_aktif);
    
        $i = 0;
        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($param='')
    {
        $this->_get_datatables_query($param);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($param='')
    {
        $this->_get_datatables_query($param);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count(){
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->from('kriteria')->count_all_results();
    }
    public function count_all($param='')
    {
        $this->db->from($this->table);
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->count_all_results();
    }
    public function all(){
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->from('kriteria')->order_by('k_kode','asc')->get();
    }
    public function save(){
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $data['k_kode']         = $this->input->post('kode',TRUE);
        $data['k_nama']         = $this->input->post('nama',TRUE);
        $data['k_bobot']       = $this->input->post('bobot',TRUE);
        $data['id_tahun']       = $this->thn_aktif;


        $insert = $this->db->insert('kriteria',$data);
        $this->db->query('SET @user_id = NULL');
        return $insert;
    }
    public function update($kode){
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $data['k_kode']         = $this->input->post('kode',TRUE);
        $data['k_nama']         = $this->input->post('nama',TRUE);
        $data['k_bobot']       = $this->input->post('bobot',TRUE);

        $update = $this->db->where('k_kode',$kode)->update('kriteria',$data);
        $this->db->query('SET @user_id = NULL');
        return $update;
    }
    public function by_id($id){
        return $this->db->where('k_kode',$id)->get('kriteria');
    }
    public function delete($data){
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $delete =  $this->db->delete('kriteria',$data);
        $this->db->query('SET @user_id = NULL');
        return $delete;
    }
}
