<?php

class M_saw extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kriteria');
        $this->load->model('m_area');
        $this->load->model('m_penilaian');
    }
    public function normalisasi(){

        $kriteria   = $this->m_kriteria->all()->result();
        $area       = $this->m_area->all()->result();
        $max        = '';
        $normalisasi= '';
        foreach ($area as $a) {
            foreach ($kriteria as $item) {
                $param['area'] = $a->a_kode;
                $param['kriteria'] = $item->k_kode;
                $nilai = $this->m_penilaian->penilaian_kriteria_area_2($param)->row();
                $max = $this->m_penilaian->get_max_kriteria($item->k_kode);
                if (empty($nilai)){
                    $nilai = 0;
                    
                }else{
                    $nilai = $nilai->pn_nilai;
                }
                if ($nilai == 0 ){
                    $normalisasi[$a->a_kode][$item->k_kode] = 0;
                }else{
                    $normalisasi[$a->a_kode][$item->k_kode] = round($nilai/$max,2);// * ($item->k_bobot/100);
                }
            }
        }
        return $normalisasi;
    }    
    public function average(){
        $normalisasi = $this->normalisasi();
        $kriteria   = $this->m_kriteria->all()->result();
        $area       = $this->m_area->all()->result();
        $average    = '';
        foreach ($area as $a) {
            $average[$a->a_kode] = 0;
            $i = 0;
            foreach ($kriteria as $item) {
                $average[$a->a_kode] += $normalisasi[$a->a_kode][$item->k_kode] * ($item->k_bobot/100);
                $i++;
            }
            //$average[$a->a_kode] = round($average[$a->a_kode] / $i,2); 
        }
        return $average;
    }
    public function rangking(){
        function cmp($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        }
        
        $average = $this->average();
        if (!empty($average)){
            uasort($average,'cmp');
            $rank = 1;
            foreach ($average as $key => $val) {
                $average[$key] = $rank;
                $rank++;
            }
        }
        
        return $average;
    }
}
