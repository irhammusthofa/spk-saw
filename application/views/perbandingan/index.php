
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= fs_title() ?>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- /.box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">HASIL PERHITUNGAN METODE TOPSIS </h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <table id="table1" class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>Kode</th>
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
                <td><?= $tim->a_kode ?></td>
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
    <!-- /.box -->
    <div class="box">
        <div class="box-header with-border">

        <h3 class="box-title">HASIL PERHITUNGAN METODE SAW</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="dtable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Kode Area</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Rata-rata</th>
                        <th>Rangking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['area-saw'] as $area) { ?>
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
        </div>
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
