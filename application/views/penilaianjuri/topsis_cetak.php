<!DOCTYPE html>
<html>
<head>
  <title>Penilaian Topsis</title>
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
  <section class="content-header">
    <h1>
      <?= fs_title() ?>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Kriteria</h3>
      </div>
      <div class="box-body table-responsive">
        <table id="table1" width="100%" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Kriteria</th>
              <?php foreach ($data['kriteria-reference'] as $row) { ?>
                  <th><?= @$row['kode'] ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Kepentingan atau Bobot</td>
              <?php foreach (@$data['kriteria-reference'] as $row) { ?>
                  <th><?= round(@$row['data']['bobot'],4) ?></th>
              <?php } ?>
            </tr>
            <tr>
              <td>Cost/Benefit</td>
              <?php foreach (@$data['kriteria-reference'] as $row) { ?>
                  <th><?= @$row['data']['c/b'] ?></th>
              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Nilai Alternatif</h3>
      </div>
      <div class="box-body table-responsive">
        <table id="table1" width="100%" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Alternatif/Kriteria</th>
              <?php foreach (@$data['kriteria-reference'] as $row) { ?>
              <th><?= $row['kode'] ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach (@$data['area'] as $row) { ?>
              <tr>
                <td><?= $row->a_nama ?></td>
                <?php foreach (@$data['kriteria-reference'] as $kriteria) { ?>
                <th><?= $this->m_penilaian->rata2_kriteria($row->a_kode,$kriteria['kode']) ?></th>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Keputusan Ternormalisasi</h3>
      </div>
      <div class="box-body table-responsive">
        <table id="table1" width="100%" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Kriteria</th>
              <?php foreach (@$data['kriteria-reference'] as $row) { ?>
              <th><?= $row['kode'] ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach (@$data['area'] as $tim) { ?>
              <tr>
                <td><?= $tim->a_nama ?></td>
                <?php foreach (@$data['kriteria-reference'] as $kriteria) { ?>
                  <?php foreach (@$data['ternormalisasi'] as $row) {
                    if($row['id_cip']==$tim->a_kode && $row['kriteria']==$kriteria['kode']){ 
                  ?>
                      <td><?= round($row['ternormalisasi'],4) ?></td>
                  <?php } } ?>
                <?php  } ?>
              </tr>
            <?php } ?>
            
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Keputusan Ternormalisasi dan Terbobot</h3>
      </div>
      <div class="box-body table-responsive">
        <table id="table1" width="100%" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Kriteria</th>
              <?php foreach (@$data['kriteria-reference'] as $row) { ?>
              <th><?= $row['kode'] ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach (@$data['area'] as $tim) { ?>
              <tr>
                <td><?= $tim->a_nama ?></td>
                <?php foreach (@$data['kriteria-reference'] as $kriteria) { ?>
                  <?php foreach (@$data['ternormalisasi'] as $row) {
                    if($row['id_cip']==$tim->a_kode && $row['kriteria']==$kriteria['kode']){ 
                  ?>
                      <td><?= round($row['terbobot'],4) ?></td>
                  <?php } } ?>
                <?php  } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">HASIL PERHITUNGAN SOLUSI IDEAL POSITIF DAN SOLUSI IDEAL NEGATIF</h3>
      </div>
      <div class="box-body table-responsive">
        <table id="table1" width="100%" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Kriteria</th>
              <?php foreach (@$data['ideal'] as $row) { ?>
                  <th><?= @$row['kriteria'] ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>A+</td>
              <?php foreach (@$data['ideal'] as $row) { ?>
                  <td><?= round(@$row['a_plus'],4) ?></td>
              <?php } ?>
            </tr>
            <tr>
              <td>A-</td>
              <?php foreach (@$data['ideal'] as $row) { ?>
                  <td><?= round(@$row['a_min'],4) ?></td>
              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">HASIL PERHITUNGAN KEDEKATAN RELATIF (RELATIVE CLOSENESS)</h3>
      </div>
      <div class="box-body">
        <table id="table1" width="100%" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Alternatif/Kriteria</th>
              <th>S+</th>
              <th>S-</th>
              <th>RC</th>
              <th>Rangking</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (@$data['area'] as $tim) { ?>
              <tr>
                <td><?= $tim->a_nama ?></td>
                <td><?= round($this->m_penilaian->relative_closeness($tim->a_kode,$data['kriteria'],$data['alternatif'])['s_plus'],4) ?></td>
                <td><?= round($this->m_penilaian->relative_closeness($tim->a_kode,$data['kriteria'],$data['alternatif'])['s_min'],4) ?></td>
                <td><?= round($this->m_penilaian->relative_closeness($tim->a_kode,$data['kriteria'],$data['alternatif'])['rc'],4) ?></td>
                <td><?= $this->m_penilaian->rangking($tim->a_kode,$data['kriteria'],$data['alternatif']) ?></td>
              </tr>
            <?php } ?>
            
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
                                      

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
 