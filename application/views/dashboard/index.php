<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= fs_title() ?>
        <small>Dashboard</small>
    </h1>
</section>
<!-- Default box -->

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= @$count['area'] ?></h3>

                    <p>Are</p>
                </div>
                <div class="icon">
                    <i class="fa fa-globe"></i>
                </div>
                <?= anchor("user/area",'More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= @$count['kriteria'] ?></h3>

                    <p>Kriteria</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <?= anchor("user/kriteria",'More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= @$data['top-ranking'] ?></h3>

                    <p>Top Ranking</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <?= anchor("user/saw",'More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
            </div>
        </div>
        
    </div>
    
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title">Tentang HSE</h3>
        </div>
        <div class="box-body table-responsive">
            <p>Kesehatan, Keselamatan dan Lindungan Lingkungan (K3LL) atau yang dikenal juga dengan Health, Safety, and the Environment (HSE) menjadi satu bagian penting yang tidak pernah luput dari perhatian Perusahaan. Bidang usaha Perusahaan sangat erat kaitannya dengan risiko yang mengancam para pekerjanya mengingat sifat gas alam yang disalurkan tersebut sangat mudah terbakar. Pertamina Gas sangat peduli terhadap keselamatan para pekerjanya, oleh karena itu kewajiban yang diamanatkan kepada Perusahaan telah berkembang menjadi komitmen kuat yang membuat kami senantiasa melakukan upaya peningkatan HSE.</p>
        </div>
    </div>
    <!-- /.box -->
    <div class="row">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Map
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 450px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-12 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">AREA</div>
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
</section>