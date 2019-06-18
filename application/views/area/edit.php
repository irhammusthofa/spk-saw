<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Form Area
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= fs_show_alert() ?>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Area</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= form_open('user/area/update/'.base64_encode($data['area']->a_kode),array('method'=>'post','class'=>'form-horizontal')) ?>
                <div class="box-body">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Kode Area <b style="color:red">*</b></label>
                            <div class="col-sm-6">
                                <input id="kode" name="kode" type="text" class="form-control" placeholder="Kode Area" value="<?= $data['area']->a_kode ?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Nama <b style="color:red">*</b></label>
                            <div class="col-sm-6">
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Area" value="<?= $data['area']->a_nama ?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Alamat</label>
                            <div class="col-sm-6">
                                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Alamat" value="<?= $data['area']->a_alamat ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Telp</label>
                            <div class="col-sm-6">
                                <input id="telp" name="telp" type="text" class="form-control" placeholder="Telp" value="<?= $data['area']->a_telp ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Kordinat</label>
                            <div class="col-sm-6">
                                <input id="kordinat" name="kordinat" type="text" class="form-control" placeholder="Kordinat" value="<?= $data['area']->a_kordinat ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <?= anchor('user/area/','Batal', array('class'=>'btn btn-default')) ?> &nbsp;
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <!-- /.box-footer -->
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>