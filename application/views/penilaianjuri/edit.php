<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Form Penilaian
    </h1>
</section>

<section class="content">
    <div class="row">
        <?= fs_show_alert() ?>
        <div class="col-md-5">
            <div class="row">
            	<div class="col-md-12">
            		<div class="box box-info">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Form Area</h3>
		                </div>
		                <!-- /.box-header -->
		                <div class="box-body">
		                    <div class="col-md-12 form-horizontal">
		                        <div class="form-group">
		                            <label class="col-sm-3 control-label">Kode Area <b style="color:red">*</b></label>
		                            <div class="col-sm-9">
		                                <input id="kode" name="kode" type="text" class="form-control" placeholder="Kode Area" value="<?= $data['area']->a_kode ?>"
		                                disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-sm-3 control-label">Nama <b style="color:red">*</b></label>
		                            <div class="col-sm-9">
		                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Area" value="<?= $data['area']->a_nama ?>" disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-sm-3 control-label">Alamat</label>
		                            <div class="col-sm-9">
		                                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Alamat" value="<?= $data['area']->a_alamat ?>" disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-sm-3 control-label">Telp</label>
		                            <div class="col-sm-9">
		                                <input id="telp" name="telp" type="text" class="form-control" placeholder="Telp" value="<?= $data['area']->a_telp ?>" disabled>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
            	</div>
            	<div class="col-md-12">
            		<div class="box box-info">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Info</h3>
		                </div>
		                <!-- /.box-header -->
		                <div class="box-body">
		                    <table id="dtable" class="table table-bordered">
		                        <thead>
		                            <tr>
		                                <th>Pembobotan HSE Meeting</th>
		                                <th>Keterangan</th>
		                                <th width="100px">Bobot</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<tr>
		                        		<td>4 Kali/Tahun</td>
		                        		<td>Sangat Rendah</td>
		                        		<td>1</td>
		                        	</tr>
		                        	<tr>
		                        		<td>6 Kali/Tahun</td>
		                        		<td>Rendah</td>
		                        		<td>2</td>
		                        	</tr>
		                        	<tr>
		                        		<td>8 Kali/Tahun</td>
		                        		<td>Cukup</td>
		                        		<td>3</td>
		                        	</tr>
		                        	<tr>
		                        		<td>10 Kali/Tahun</td>
		                        		<td>Tinggi</td>
		                        		<td>4</td>
		                        	</tr>
		                        	<tr>
		                        		<td>12 Kali/Tahun</td>
		                        		<td>Sangat Tinggi</td>
		                        		<td>5</td>
		                        	</tr>
		                        </tbody>
		                    </table>
		                    <br>
		                    <table id="dtable" class="table table-bordered">
		                        <thead>
		                            <tr>
		                                <th>Fire Drill (Latihan Penggunaan Alat)</th>
		                                <th>Keterangan</th>
		                                <th width="100px">Bobot</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<tr>
		                        		<td>2 Kali/Tahun</td>
		                        		<td>Sangat Rendah</td>
		                        		<td>1</td>
		                        	</tr>
		                        	<tr>
		                        		<td>3 Kali/Tahun</td>
		                        		<td>Rendah</td>
		                        		<td>2</td>
		                        	</tr>
		                        	<tr>
		                        		<td>4 Kali/Tahun</td>
		                        		<td>Cukup</td>
		                        		<td>3</td>
		                        	</tr>
		                        	<tr>
		                        		<td>5 Kali/Tahun</td>
		                        		<td>Tinggi</td>
		                        		<td>4</td>
		                        	</tr>
		                        	<tr>
		                        		<td>6 Kali/Tahun</td>
		                        		<td>Sangat Tinggi</td>
		                        		<td>5</td>
		                        	</tr>
		                        </tbody>
		                    </table>
		                    <br>
		                    <table id="dtable" class="table table-bordered">
		                        <thead>
		                            <tr>
		                                <th>Simulasi Tanggap Darurat (Latihan Tim)</th>
		                                <th>Keterangan</th>
		                                <th width="100px">Bobot</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<tr>
		                        		<td>2 Kali/Tahun</td>
		                        		<td>Sangat Rendah</td>
		                        		<td>1</td>
		                        	</tr>
		                        	<tr>
		                        		<td>3 Kali/Tahun</td>
		                        		<td>Rendah</td>
		                        		<td>2</td>
		                        	</tr>
		                        	<tr>
		                        		<td>4 Kali/Tahun</td>
		                        		<td>Cukup</td>
		                        		<td>3</td>
		                        	</tr>
		                        	<tr>
		                        		<td>5 Kali/Tahun</td>
		                        		<td>Tinggi</td>
		                        		<td>4</td>
		                        	</tr>
		                        	<tr>
		                        		<td>6 Kali/Tahun</td>
		                        		<td>Sangat Tinggi</td>
		                        		<td>5</td>
		                        	</tr>
		                        </tbody>
		                    </table>
		                    <br><table id="dtable" class="table table-bordered">
		                        <thead>
		                            <tr>
		                                <th>Management Walk Through (MWT)</th>
		                                <th>Keterangan</th>
		                                <th width="100px">Bobot</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<tr>
		                        		<td>Tidak sesuai dengan SOP</td>
		                        		<td>Sangat Rendah</td>
		                        		<td>1</td>
		                        	</tr>
		                        	<tr>
		                        		<td>Sesuai dengan SOP</td>
		                        		<td>Sangat Tinggi</td>
		                        		<td>5</td>
		                        	</tr>
		                        </tbody>
		                    </table>
		                    <br><table id="dtable" class="table table-bordered">
		                        <thead>
		                            <tr>
		                                <th>Training Aspek QC & HSE</th>
		                                <th>Keterangan</th>
		                                <th width="100px">Bobot</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<tr>
		                        		<td>Tidak ada dilakukan / Tahun</td>
		                        		<td>Sangat Rendah</td>
		                        		<td>1</td>
		                        	</tr>
		                        	<tr>
		                        		<td>Ada dilakukan / Tahun</td>
		                        		<td>Sangat Tinggi</td>
		                        		<td>5</td>
		                        	</tr>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
            	</div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Penilaian</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= form_open('juri/penilaian/simpan/'.base64_encode($data['area']->a_kode).'/'.base64_encode($data['juri']->j_id),array('method'=>'post','class'=>'form-horizontal')) ?>
                <div class="box-body">
                    <table id="dtable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th width="100px">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['penilaian'] as $item) { ?>
                                <tr>
                                    <td><?= $item->k_kode ?></td>
                                    <td><?= $item->k_nama ?></td>
                                    <td><input name="<?= $item->k_kode ?>" type="number" class="form-control" value="<?= @$item->pn_nilai ?>"/></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
                <!-- /.box-body -->
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>