<section class="content-header">
    <h1>
        <?= fs_title() ?>
        <small>Grafik Topsis</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->

    <div id="grafik" class="col-md-12" hidden>

        <?= anchor('user/grafik','Grafik SAW',array('class'=>'btn btn-primary')) ?><br><br>
        <div class="box box-primary">
            <div class="box-body box-profile">
                
                <div id="chart" class="chart" style="height:500px">
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
                
                <!-- <p><strong>Ranking <label class="label label-danger pull-right">belum ada rangking</label></strong></p> -->

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <!-- /.row -->

</section>