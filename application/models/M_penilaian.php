<?php

class M_penilaian extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->model('m_kriteria');
        $this->load->model('m_area');
    }
    public function penilaian_by_area($id,$juri){
        return $this->db->from('kriteria k')
            ->join('penilaian p','p.id_kriteria=k.k_kode and p.id_area="'.$id.'" and p.id_juri="'.$juri.'"','left')
            ->order_by('k.k_kode','asc')
            ->get();
    }
    public function penilaian_kriteria_area_2($param){
        return $this->db->select('avg(pn_nilai) as pn_nilai')
            ->from('penilaian')
            ->where('id_area',$param['area'])
            ->where('id_kriteria',$param['kriteria'])
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
            ->where('id_juri',$param['juri'])
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
    public function save($id,$juri){

        $kriteria = $this->penilaian_by_area($id,$juri)->result();
        $this->db->trans_begin();
        foreach ($kriteria as $item) {
            $data['id_juri']        = $juri;
            $data['id_area']        = $id;
            $data['id_kriteria']    = $item->k_kode;
            $data['pn_nilai']        = $this->input->post($item->k_kode,TRUE);
            $param['area']          = $data['id_area'];
            $param['kriteria']      = $data['id_kriteria'];
            $param['juri']      = $juri;

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

    public function kriteria_reference($kriteria,$alternatif,$kode_kriteria=''){
        foreach ($kriteria as $item) {
            $bobot = $this->get_bobot($item,$alternatif,$kode_kriteria);
            $pembagi = $this->get_pembagi($item,$alternatif);
            $kriteria_reference[] = array(
                'kode'          => $item,
                'data'          => array(
                    'c/b'       => 'BENEFIT',//($bobot<2) ? 'COST' : 'BENEFIT',
                    'bobot'     => $bobot,
                    'pembagi'   => $pembagi,
                ),
            );
        }
        return $kriteria_reference;
    }
    public function rata2_kriteria($alternatif,$kriteria){
        //$count = count($this->list_sub_kriteria($kriteria)->result());
        $sum = $this->db->select('avg(pn_nilai) AS nilai')
            ->from('penilaian p')
            ->join('kriteria k','k.k_kode=p.id_kriteria','inner')
            ->where('k.id_tahun',$this->thn_aktif)
            ->where('p.id_area',$alternatif)
            ->where('k.k_kode',$kriteria)
            ->get()->row()->nilai;
        //if ($sum==0) return 0;
        return round($sum,2);
    }
    private function get_bobot($kode_kriteria,$alternatif,$kode_kriteria_uji=''){
        // $tim_saya =  $this->m_cip->by_id($kode)->row();
        // $tim   = $this->m_cip->by_jenis($tim_saya->id_jenis)->result();
        // $tim   = $this->m_cip->all()->result();
        $kriteria = $this->m_kriteria->by_id($kode_kriteria)->row();
        if ($kode_kriteria_uji==$kriteria->k_kode){
            return ($kriteria->k_bobot/100) + 0.5;
        }else{
            return $kriteria->k_bobot/100;    
        }
        

        // $bobot      = [];
        // foreach ($alternatif as $item) {
        //     $rata2 = $this->rata2_kriteria($item,$kode_kriteria);
        //     $bobot[]    = array('nilai'=>$rata2);
        // }
        // $tmp = 0;
        // foreach ($bobot as $val) {
        //     $tmp += $val['nilai'];
        // }
        // if ($tmp==0) return 0;
        // return $tmp/count($alternatif);
    }
    private function get_pembagi($kode_kriteria,$alternatif){
        //$tim_saya =  $this->m_cip->by_id($kode)->row();
        //$tim   = $this->m_cip->by_jenis($tim_saya->id_jenis)->result();
        //$tim   = $this->m_cip->all()->result();
        $bobot      = [];
        foreach ($alternatif as $item) {
            $rata2 = $this->rata2_kriteria($item,$kode_kriteria);
            $bobot[]    = array('nilai'=>$rata2);
        }
        $tmp = 0;
        foreach ($bobot as $val) {
            $tmp += ($val['nilai']*$val['nilai']);
        }
        return sqrt($tmp);
    }
    public function ternormalisasi($kriteria,$alternatif,$kriteria_reference){

        //$kriteria       = $this->list_kriteria()->result();
        //$alternatif     = $this->alternatif()->result();
        $alternatif_reference = [];
        foreach ($alternatif as $val) {
            $data = "";
            foreach ($kriteria as $val_k) {
                $nilai              = 0;
                $ref_kriteria       = $this->find_refkriteria($kriteria_reference,$val_k);
                $pembagi            = $ref_kriteria['data']['pembagi'];
                $nilai              = $this->get_nilai($val,$val_k);
                // if ($nilai==0){
                //     $ternormalisasi     = 0;
                // }else{
                //     $ternormalisasi     = $nilai/$pembagi;
                // }
                
                if ($nilai!=0){
                    $ternormalisasi     = $nilai/$pembagi;  
                }else{
                    $ternormalisasi     = 0;
                }

                $bobot              = $ref_kriteria['data']['bobot'];

                $alternatif_reference[] = array(
                    'id_cip'        => $val,
                    'kriteria'      => $val_k,
                    'nilai'         => $nilai,
                    'ternormalisasi'=> $ternormalisasi,
                    'terbobot'      => $ternormalisasi * $bobot,
                );
            }
            
        }
        return $alternatif_reference;
    }
    private function alternatif(){
        return $this->db->select('id_cip')
            ->from('penilaian')
            ->group_by('id_cip')
            ->get();
    }

    private function find_refkriteria($source,$kriteria){
        for($i=0;$i<count($source);$i++){
            if ($kriteria==$source[$i]['kode']){
                return $source[$i];
            }
        }
        return FALSE;
    }

    private function get_nilai($cip,$kode){
        $nilai          = $this->rata2_kriteria($cip,$kode);
        if ($nilai==0) return 0;
        return $nilai;
    }
    public function ideal($kriteria,$kriteria_reference,$alternatif_reference){

        foreach ($kriteria as $item) {
            $ref_kriteria       = $this->find_refkriteria($kriteria_reference,$item);
            $cb                 = $ref_kriteria['data']['c/b'];
            $ref_terbobot       = $this->find_refterbobot($alternatif_reference,$item,'kriteria');
            if ($cb=='BENEFIT'){
                $a_plus = max($ref_terbobot);
                $a_min  = min($ref_terbobot);
            }else{
                $a_plus = min($ref_terbobot);
                $a_min  = max($ref_terbobot);
            }
            $tab_ideal[] = array(
                'kriteria'  => $item,
                'a_plus'    => $a_plus,
                'a_min'     => $a_min,
            );
        }
        return $tab_ideal;
    }
    private function find_refterbobot_kriteria($source,$id_cip,$key,$kriteria){
        $tmp = "";
        for($i=0;$i<count($source);$i++){
            if ($id_cip==$source[$i][$key] && $kriteria==$source[$i]['kriteria']){
                return $source[$i]['terbobot'];
            }
        }
        return 0;
    }
    private function find_refterbobot($source,$kriteria,$key){
        $tmp = [];
        for($i=0;$i<count($source);$i++){
            if ($kriteria==$source[$i][$key]){
                $tmp[] = $source[$i]['terbobot'];
            }
        }
        return $tmp;
    }
    public function relative_closeness($id_cip,$kriteria,$alternatif,$kode_kriteria=''){
        $array = $this->get_relative_closeness($kriteria,$alternatif,$kode_kriteria);
        for($i=0;$i<count($array);$i++){
            if (@$array[$i]['id_cip']==$id_cip){
                $relative_closeness = array(
                    'id_cip'   => $id_cip,
                    's_plus'        => $array[$i]['s_plus'],
                    's_min'         => $array[$i]['s_min'],
                    'rc'            => $array[$i]['rc']
                );
                return $relative_closeness;
            }
        }
        $relative_closeness = array(
            'id_cip'   => $id_cip,
            's_plus'        => 0,
            's_min'         => 0,
            'rc'            => 0
        );
        return $relative_closeness;
    }

    private function get_relative_closeness($kriteria,$alternatif,$kode_kriteria=''){
        //$kriteria       = $this->list_kriteria()->result();
        $count_kriteria = count($kriteria);
        //$alternatif     = $this->alternatif($month,$year)->result();
        $count_alternatif = count($alternatif);
        if ($count_alternatif<=0 || $count_kriteria <=0){
            $relative_closeness = array(
                's_plus'        => 0,
                's_min'         => 0,
                'rc'            => 0
            );
            return $relative_closeness;
        }
        $kriteria_reference = $this->kriteria_reference($kriteria,$alternatif,$kode_kriteria);
        $alternatif_reference = $this->ternormalisasi($kriteria,$alternatif,$kriteria_reference);
        
        $tab_ideal = $this->ideal($kriteria,$kriteria_reference,$alternatif_reference);
        
        $relative_closeness = [];
        foreach ($alternatif as $val) {
            $s_plus = 0;
            $s_min  = 0;
            foreach ($tab_ideal as $tab) {
                $ref_terbobot       = $this->find_refterbobot_kriteria($alternatif_reference,$val,'id_cip',$tab['kriteria']);
                $s_plus += ($tab['a_plus']-$ref_terbobot)*($tab['a_plus']-$ref_terbobot);
                $s_min += (($tab['a_min']-$ref_terbobot)*($tab['a_min']-$ref_terbobot));
            }
            $s_plus = sqrt($s_plus);
            $s_min = sqrt($s_min);

            $relative_closeness[] = array(
                'id_cip'        => $val,
                's_plus'        => $s_plus,
                's_min'         => $s_min,
                'rc'            => ($s_min!=0) ? $s_min / ($s_min+$s_plus) : 0,
            );
            
        }
        return $relative_closeness;
        
    }
    public function rangking($id_cip,$kriteria,$alternatif){
        $array = $this->get_relative_closeness($kriteria,$alternatif);
        $rank   = [];
        for($i=0;$i<count($array);$i++){
            $rank[] = array(
                'rc'            => @$array[$i]['rc'],
                'id_cip'   => @$array[$i]['id_cip'],
            );
        }
        arsort($rank);
        $i = 0;
        foreach ($rank as $val) {
            $i++;
            if ($val['id_cip']==$id_cip){
                return $i;
            }
        }
    }
}
