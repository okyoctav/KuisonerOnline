<div class="panel-body">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:history.go(-1);" class="btn btn-primary btn-xs"><span class="fa fa-chevron-left" ></span>&nbsp;Kembali</a>
			&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
		</div>
		<div class="panel-body">
			<form class="form-horizontal form-bordered" action="<?= base_url('puskomsi/buat_kuesioner'); ?>" method="post">

            <!-- form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Template</label>
                    <div class="col-sm-8">
                        <select name="id_template" required class="form-control">
                        <?php if (!empty($templates)) { foreach ($templates as $template): ?>
                            <option value="<?= $template['id_template'] ?>"><?= $template['nama_template'] ?></option>
                        <?php endforeach; } else{?> <option value="">-- TEMPLATE KOSONG --</option> <?php } ?>
                        </select>
                    </div>
                </div>
            <!-- form-group -->

            <!-- form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Mulai</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control datepicker" id="tanggal_mulai" onchange="javascript:cekDate();" name="tanggal_mulai" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            <!-- form-group -->

            <!-- form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Selesai</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control datepicker" onchange="javascript:cekDate();" id="tanggal_selesai" name="tanggal_selesai" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            <!-- form-group -->

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input class="btn btn-success btn-xs" type="submit" name="tombol" value="Simpan"> 
                        &nbsp;
                        <input class="btn btn-danger btn-xs" type="reset" value="Reset">
                    </div>
                </div><!-- form-group -->
            </form>
		</div>
	</div>
</div>