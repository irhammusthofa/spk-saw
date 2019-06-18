<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= fs_title() ?>
        <small>Penilaian SAW</small>
    </h1>
</section>
<!-- Default box -->

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">

        <h3 class="box-title">Data Matrix Awal</h3>
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
                        <?php foreach ($data['kriteria'] as $kriteria) { ?>
                            <th><?= $kriteria->k_kode ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['area'] as $area) { ?>
                        <tr>
                            <td><?= $area->a_kode ?></td>
                            <?php foreach ($data['kriteria'] as $kriteria) {
                                $param['area'] = $area->a_kode;
                                $param['kriteria'] = $kriteria->k_kode;
                                $nilai = $this->m_penilaian->penilaian_kriteria_area($param)->row();
                                $nilai = (empty($nilai)) ? 0 : @$nilai->pn_nilai;
                            ?>
                                <td><?= @$nilai ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box -->
    <div class="box">
        <div class="box-header with-border">

        <h3 class="box-title">Normalisasi</h3>
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
                        <?php foreach ($data['kriteria'] as $kriteria) { ?>
                            <th><?= $kriteria->k_kode ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['area'] as $area) { ?>
                        <tr>
                            <td><?= $area->a_kode ?></td>
                            <?php foreach ($data['kriteria'] as $kriteria) {
                                $param['area'] = $area->a_kode;
                                $param['kriteria'] = $kriteria->k_kode;
                                $nilai = $this->m_penilaian->penilaian_kriteria_area($param)->row();
                            ?>
                                <td><?= @$data['normalisasi'][$area->a_kode][$kriteria->k_kode] ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box -->
    <div class="box">
        <div class="box-header with-border">

        <h3 class="box-title">Rangking</h3>
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
                    <?php foreach ($data['area'] as $area) { ?>
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