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

    public function count_all($param='')
    {
        $this->db->from($this->table);
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->count_all_results();
    }
    public function all(){
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->from('area')->order_by('a_kode','asc')->get();
    }
    public function save(){
        $data['a_kode']         = $this->input->post('kode',TRUE);
        $data['a_nama']         = $this->input->post('nama',TRUE);
        $data['a_alamat']       = $this->input->post('alamat',TRUE);
        $data['a_telp']         = $this->input->post('telp',TRUE);
        $data['a_kordinat']     = $this->input->post('kordinat',TRUE);
        $data['id_tahun']       = $this->thn_aktif;

        return $this->db->insert('area',$data);
    }
    public function update($kode){
        $data['a_kode']         = $this->input->post('kode',TRUE);
        $data['a_nama']         = $this->input->post('nama',TRUE);
        $data['a_alamat']       = $this->input->post('alamat',TRUE);
        $data['a_telp']         = $this->input->post('telp',TRUE);
        $data['a_kordinat']     = $this->input->post('kordinat',TRUE);

        return $this->db->where('a_kode',$kode)->update('area',$data);
    }
    public function by_id($id){
        return $this->db->where('a_kode',$id)->get('area');
    }
    public function delete($data){
        return $this->db->delete('area',$data);
    }
    public function count(){
        $this->db->where('id_tahun',$this->thn_aktif);
        return $this->db->from('area')->count_all_results();
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
