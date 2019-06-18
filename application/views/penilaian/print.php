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
<b>Hasil Rangking Area  :</b><br><br>
<!-- Main content -->
<table id="dtable" class="table table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th>Kode Area</th>
            <th>Area</th>
            <th>Alamat</th>
            <th>Nilai</th>
            <th>Rangking</th>
        </tr>
    </thead>
    <tbody>
        <?php $terbaik = ""; $terendah= 0;foreach ($data['area'] as $area) {
            if ($data['rangking'][$area->a_kode] == 1) $terbaik = $area->a_nama;
            if ($data['rangking'][$area->a_kode] > $terendah) $terendah = $area->a_nama;

            
         ?>
            <tr>
                <td><?= $area->a_kode ?></td>
                <td><?= $area->a_nama ?></td>
                <td><?= $area->a_alamat ?></td>
                <td><?= $data['average'][$area->a_kode] ?></td>
                <td><?= $data['rangking'][$area->a_kode] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<p>Area dengan nilai <strong>terbaik</strong> adalah <strong><?= $terbaik ?></strong> </p>
<p>Area dengan nilai <strong>terendah</strong> adalah <strong><?= $terendah ?></strong> </p>

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

