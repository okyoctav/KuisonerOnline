<div class="panel-body">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:history.go(-1);" class="btn btn-primary btn-xs"><span class="fa fa-chevron-left" ></span>&nbsp;Kembali</a>
			&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
		</div>
		<div class="panel-body">
			<form class="form-horizontal form-bordered" action="<?= base_url('puskomsi/edit_kuesioner'); ?>" method="post">
                <input type="hidden" name="id_kuesioner" value="<?= $kuesioner['id_kuesioner'] ?>">
            <!-- form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Template</label>
                    <div class="col-sm-8">
                        <select name="id_template" class="form-control">
                        <?php if (!empty($templates)) { foreach ($templates as $template): ?>
                            <option value="<?= $template['id_template'] ?>" <?php if ($template['id_template'] == $kuesioner['id_template']) {echo "selected";} ?>><?= $template['nama_template'] ?></option>
                        <?php endforeach; } else{?> <option value="">TEMPLATE KOSONG</option> <?php } ?>
                        </select>
                    </div>
                </div>
            <!-- form-group -->
    
            <!-- form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Mulai</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control datepicker" required value="<?= $kuesioner['tanggal_mulai'] ?>" name="tanggal_mulai" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            <!-- form-group -->

            <!-- form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Selesai</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control datepicker" required value="<?= $kuesioner['tanggal_selesai']; ?>" name="tanggal_selesai" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            <!-- form-group -->

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input class="btn btn-success btn-xs" type="submit" name="tombol" value="Edit"> 
                        &nbsp;
                        <input class="btn btn-danger btn-xs" type="reset" value="Reset">
                    </div>
                </div><!-- form-group -->
            </form>
		</div>
	</div>
</div>