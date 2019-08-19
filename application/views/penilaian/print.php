<!DOCTYPE html>
<html>
<head>
    <title>Cetak</title>
    <style type="text/css">
        table {
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
      padding: 5px;
    }
    </style>
</head>
<body>
<!-- Content Header (Page header) -->
<table width="100%" style="border: 0px">
    <tr>
        <td style="border: 0px"><img width="80%" src="<?= base_url('assets/img/logo_lap.png') ?>"></td>
        <td style="border: 0px"><h2>SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN AREA TERBAIK</h2></td>
    </tr>
</table>
<!-- Default box -->
<hr><br>
<b>Hasil Rangking Area SAW :</b><br><br>
<!-- Main content -->
<table id="dtable" class="table table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th rowspan="2">Kode Area</th>
            <th rowspan="2">Area</th>
            <th rowspan="2">Alamat</th>
            <th colspan="2">SAW</th>
            <th colspan="2">Topsis</th>
        </tr>
        <tr>
            <th>Nilai</th>
            <th>Rangking</th>
            <th>Nilai</th>
            <th>Rangking</th>
        </tr>
    </thead>
    <tbody>
        <?php $terbaik = ""; $terendah= 0; $terendah_topsis_desc= 0;$terendah_desc= 0; $terbaik_topsis = ""; $terendah_topsis= 0;foreach ($data['area'] as $area) {
            $rangking_topsis = $this->m_penilaian->rangking($area->a_kode,$data['kriteria_topsis'],$data['alternatif']);
            if ($data['rangking'][$area->a_kode] == 1) $terbaik = $area->a_nama;
            if ($data['rangking'][$area->a_kode] > $terendah){
                $terendah = $data['rangking'][$area->a_kode];
                $terendah_desc = $area->a_nama;
            } 

            if ($rangking_topsis == 1) $terbaik_topsis = $area->a_nama;
            if ($rangking_topsis > $terendah_topsis){
                $terendah_topsis = $rangking_topsis;
                $terendah_topsis_desc = $area->a_nama;
            } 
         ?>
            <tr>
                <td><?= $area->a_kode ?></td>
                <td><?= $area->a_nama ?></td>
                <td><?= $area->a_alamat ?></td>
                <td><?= $data['average'][$area->a_kode] ?></td>
                <td><?= $data['rangking'][$area->a_kode] ?></td>
                <td><?= round($this->m_penilaian->relative_closeness($area->a_kode,$data['kriteria_topsis'],$data['alternatif'])['rc'],4) ?></td>
                <td><?= $rangking_topsis ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<p>Area dengan nilai <strong>terbaik</strong> menggunakan metode SAW adalah <strong><?= $terbaik ?></strong> </p>
<p>Area dengan nilai <strong>terendah</strong> menggunakan metode SAW adalah <strong><?= $terendah_desc ?></strong> </p>
<p>Area dengan nilai <strong>terbaik</strong> menggunakan metode Topsis adalah <strong><?= $terbaik_topsis ?></strong> </p>
<p>Area dengan nilai <strong>terendah</strong> menggunakan metode Topsis adalah <strong><?= $terendah_topsis_desc ?></strong> </p>

<p>Sesuai dengan hasil perbandingan dengan uji sensitifitas maka sistem merekomendasikan metode yang digunakan adalah <?= $data['recomended_method']?>, karena memiliki presentase sebesar <?= $data['jml_sensitifitas'] ?></p>

<table width="100%" style="border: 0px">
    <tr>
        <td style="border: 0px" width="50%"></td>
        <td style="border: 0px" align="center">Diketahui Oleh,<br><br><br><br><br>Manager HSE</td>
    </tr>
</table>



                                                   

<script type="text/javascript">
    function wprint(){
        window.print();
    }
    setTimeout(function() {
        wprint();   
    }, 1000);
    
</script>
</body>
</html>

