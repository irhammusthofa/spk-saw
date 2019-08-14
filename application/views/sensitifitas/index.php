
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= fs_title() ?>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">SAW</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php foreach ($data['sensitifitas'] as $key => $value) { ?>
            <div class="col-md-3">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">
                     <?php 
                      if ($key=='awal') {
                        echo 'Hasil Nilai Awal';
                      }else if ($key=='presentase') {
                        echo 'Presentase Sensitifitas';
                      }else{
                        echo 'Sensitifitas '.$key;
                      }
                    ?>
                  </h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                      <i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body table-responsive">
                  <?php echo '<table id="table1" class="table table-bordered table-hover table-responsive">'; ?>

                  <?php foreach ($data['sensitifitas'][$key]['data'] as $key2 => $value2) {
                      echo '<tr>';
                      echo '<td>'.$key2.'</td>';
                      echo '<td>'.$value2.'</td>';
                      echo '</tr>';
                  } ?>
                  <?php 
                      if($key!='presentase'){
                        echo '<tr>';
                        echo '<td><b>Max</b></td>';
                        echo '<td><b>'.$data['sensitifitas'][$key]['max'].'</b></td>';
                        echo '</tr>';
                      }
                      if($key!='awal' && $key!='presentase'){
                        echo '<tr>';
                        echo '<td><b>Perubahan</b></td>';
                        echo '<td><b>'.$data['sensitifitas'][$key]['perubahan'].'</b></td>';
                        echo '</tr>';
                      }else if($key=='presentase'){
                        echo '<tr>';
                        echo '<td><b>Jumlah</b></td>';
                        echo '<td><b>'.$data['sensitifitas'][$key]['jumlah'].'</b></td>';
                        echo '</tr>';
                      }

                  echo '</table>' ?>
                    
                  
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer-->
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Topsis</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php foreach ($data['sensitifitas_topsis'] as $key => $value) { ?>
            <div class="col-md-3">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">
                     <?php 
                      if ($key=='awal') {
                        echo 'Hasil Nilai Awal';
                      }else if ($key=='presentase') {
                        echo 'Presentase Sensitifitas';
                      }else{
                        echo 'Sensitifitas '.$key;
                      }
                    ?>
                  </h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                      <i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body table-responsive">
                  <?php echo '<table id="table1" class="table table-bordered table-hover table-responsive">'; ?>

                  <?php foreach ($data['sensitifitas_topsis'][$key]['data'] as $key2 => $value2) {
                      echo '<tr>';
                      echo '<td>'.$key2.'</td>';
                      echo '<td>'.$value2.'</td>';
                      echo '</tr>';
                  } ?>
                  <?php 
                      if($key!='presentase'){
                        echo '<tr>';
                        echo '<td><b>Max</b></td>';
                        echo '<td><b>'.$data['sensitifitas_topsis'][$key]['max'].'</b></td>';
                        echo '</tr>';
                      }
                      if($key!='awal' && $key!='presentase'){
                        echo '<tr>';
                        echo '<td><b>Perubahan</b></td>';
                        echo '<td><b>'.$data['sensitifitas_topsis'][$key]['perubahan'].'</b></td>';
                        echo '</tr>';
                      }else if($key=='presentase'){
                        echo '<tr>';
                        echo '<td><b>Jumlah</b></td>';
                        echo '<td><b>'.$data['sensitifitas_topsis'][$key]['jumlah'].'</b></td>';
                        echo '</tr>';
                      }

                  echo '</table>' ?>
                    
                  
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer-->
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
