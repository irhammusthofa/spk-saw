<?php

class M_area extends CI_Model
{
    var $_table = 'area';

    var $table = 'area c';
    var $column_order = array('c.a_kode', 'c.a_nama','c.a_alamat','c.a_telp'); //set column field database for datatable orderable
    var $column_search = array('c.a_kode', 'c.a_nama','c.a_alamat','c.a_telp'); //set column field database for datatable searchable
    var $order = array('c.a_kode' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_juri_tim');
    }

    private function _get_datatables_query($param='')
    {
        $this->db->from($this->table);
        $this->db->where('c.id_tahun',$this->thn_aktif);
        if ($this->user->u_role=='juri'){
            $this->db->join('juri_tim jt','jt.id_tim=c.a_kode','inner');
            $this->db->where('jt.id_juri',$param['id_juri']);
        }
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

    public function count_all($param='')
    {
        $this->db->from($this->table);
        $this->db->where('id_tahun',$this->thn_aktif);
        if ($this->user->u_role=='juri'){
            $this->db->join('juri_tim jt','jt.id_tim=c.a_kode','inner');
            $this->db->where('jt.id_juri',$param['id_juri']);
        }
        return $this->db->count_all_results();
    }
    public function all(){
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->from('area')->order_by('a_kode','asc')->get();
    }
    public function save(){
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $data['a_kode']         = $this->input->post('kode',TRUE);
        $data['a_nama']         = $this->input->post('nama',TRUE);
        $data['a_alamat']       = $this->input->post('alamat',TRUE);
        $data['a_telp']         = $this->input->post('telp',TRUE);
        $data['a_kordinat']     = $this->input->post('kordinat',TRUE);
        $data['id_tahun']       = $this->thn_aktif;

        $insert = $this->db->insert('area',$data);
        $this->db->query('SET @user_id = NULL');
        return $insert;
    }
    public function update($kode){
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $data['a_kode']         = $this->input->post('kode',TRUE);
        $data['a_nama']         = $this->input->post('nama',TRUE);
        $data['a_alamat']       = $this->input->post('alamat',TRUE);
        $data['a_telp']         = $this->input->post('telp',TRUE);
        $data['a_kordinat']     = $this->input->post('kordinat',TRUE);

        $update = $this->db->where('a_kode',$kode)->update('area',$data);
        $this->db->query('SET @user_id = NULL');
        return $update;
    }
    public function by_id($id){
        return $this->db->where('a_kode',$id)->get('area');
    }
    public function delete($data){
        $this->db->query('SET @user_id="'.$this->user->u_name.'"');
        $delete = $this->db->delete('area',$data);
        $this->db->query('SET @user_id = NULL');
        return $delete;
    }
    public function count(){
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->from('area')->count_all_results();
    }
    public function tim_belum_dipilih($juri){
        $juri_tim = $this->m_juri_tim->by_juri($juri)->result();
        $id_tim = '';
        foreach ($juri_tim as $item) {
            $id_tim[] = $item->id_tim;
        }
        $this->db->from('area c');
        if (!empty($id_tim)){
            $this->db->where_not_in('c.a_kode',$id_tim); 
        }
        
        return $this->db->get();
    }
    public function generate_id(){
        // nomor/CIP-PTG/Tahun contoh (12/CIP-PTG/2019)
        $tabel = 'cip';
        $kolom = 'id_temp';
        $lebar = 3;
        $awalan = "CIP-PTG/".date('Y');
        if(empty($awalan)){
            $query="select $kolom from $tabel order by $kolom desc limit 1";
        }else{
            $query="select $kolom from $tabel where $kolom like '%$awalan%' order by $kolom desc limit 1";
        }
        $hasil          = $this->db->query($query)->row();
        $jumlahrecord   = count($hasil);
        if($jumlahrecord == 0)
            $nomor=1;
        else
        {
            $row=$hasil;
            $nomor=intval(substr($row->$kolom,strlen($awalan)))+1;
        }
        if($lebar>0){
            $origin = str_pad($nomor,$lebar,"0",STR_PAD_LEFT)."/".$awalan;
            $angka = $awalan."/".str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        }else{
            $origin = $nomor."/".$awalan;
            $angka = $awalan."/".$nomor;
        }
        return array('temp'=>$angka,'origin'=>$origin);
    }
}
