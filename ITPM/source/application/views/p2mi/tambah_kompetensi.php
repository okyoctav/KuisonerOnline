<div class="panel-body">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:history.go(-1);" class="btn btn-primary btn-xs"><span class="fa fa-chevron-left" ></span>&nbsp;Kembali</a>
			&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
		</div>
		<div class="panel-body">
			<form class="form-horizontal form-bordered" action="<?= base_url('p2mi/tambah_kompetensi'); ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kompetensi Kuesioner</label>
                    <div class="col-sm-8">
                        <input placeholder="Kompetensi Kuesioner.." required class="form-control" name="kompetensi" type="text">
                    </div>
                </div><!-- form-group -->

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